# coding=utf8
from django.db.models import Max, Q
from doorsadmin.models import Niche, Net, Domain, Host, IPAddress, SnippetsSet, XrumerBaseSpam, XrumerBaseDoors, XrumerBaseProfiles, Agent, Event, EventLog
import datetime

def CronHourly():
    '''Функция вызывается по расписанию'''
    RenewSnippets()
    RenewBasesSpam()
    ResumeAfterReg()
    UpdateIndexCount()
    CheckAgentsActivity()

def CronDaily():
    '''Функция вызывается по расписанию'''
    ExpandNets()
    #GenerateSpamTasks()  # вызывается по событию апдейта агента доргена
    ClearEventLog()

def Helper():
    '''Запуск из командной строки'''
    '''UpdateIndexCount()'''
    for niche in Niche.objects.filter(active=True).order_by('pk').all():
        niche.GenerateSpamTasksMultiple()
    '''Net.objects.get(pk=269).AddDomains()'''
    '''with open('/home/admin/tmp/domains.txt') as fd:
        addDomains = ''.join(fd.readlines())'''
    pass

def ExpandNets():
    '''Плетем сети: добавляем домены и генерим доры'''
    xrumersCount = 2  # настройка: количество хрумеров
    avgSpamTaskDuration = 12  # настройка: средняя продолжительность прогона по базе R, минут
    avgSpamLinksPerTask = 12  # настройка: среднее количество ссылок в задании на спам
    linksLimitBase = int(xrumersCount * 1440 * 0.9 / avgSpamTaskDuration * avgSpamLinksPerTask)  # максимум ссылок, которые можно проспамить за сутки
    domainsLimitBase = 999  # настройка: лимит расхода доменов в сутки
    doorwaysLimitBase = 999  # настройка: лимит доров в папках / на субдоменах в сутки
    
    linksLimitActual = linksLimitBase
    domainsLimitActual = domainsLimitBase
    doorwaysLimitActual = doorwaysLimitBase
    dd = datetime.date.today()
    for net in Net.objects.filter(active=True).order_by('?').all():
        if (net.domainsPerDay > 0) and ((net.dateStart==None) or (net.dateStart <= dd)) and ((net.dateEnd==None) or (net.dateEnd >= dd)):
            domainsLimitActual, linksLimitActual = net.AddDomains(None, domainsLimitActual, linksLimitActual)
        if (domainsLimitActual <= 0) or (linksLimitActual <= 0):
            break
        if (net.doorsPerDay > 0) and ((net.dateStart==None) or (net.dateStart <= dd)) and ((net.dateEnd==None) or (net.dateEnd >= dd)):
            doorwaysLimitActual, linksLimitActual = net.GenerateDoorways(None, None, doorwaysLimitActual, linksLimitActual)
        if (doorwaysLimitActual <= 0) or (linksLimitActual <= 0):
            break
    EventLog('info', 'Domains limit: %d/%d' % (domainsLimitBase - domainsLimitActual, domainsLimitBase))
    EventLog('info', 'Doorways limit: %d/%d' % (doorwaysLimitBase - doorwaysLimitActual, doorwaysLimitBase))
    EventLog('info', 'Links limit: %d/%d' % (linksLimitBase - linksLimitActual, linksLimitBase))

def RenewSnippets():
    '''Перегенерируем сниппеты'''
    dt = datetime.datetime.now()
    for snippetsSet in SnippetsSet.objects.filter(Q(active=True), Q(stateManaged='done')).order_by('pk').all():
        if (snippetsSet.dateLastParsed==None) or (snippetsSet.dateLastParsed + datetime.timedelta(0, snippetsSet.interval * 60 * 60, 0) < dt):
            snippetsSet.stateManaged = 'new'
            snippetsSet.save()

def RenewBasesSpam():
    '''Перегенерируем изношенные базы'''
    interval = 10  # настройка: интервал перегенерации баз R в днях
    dt = datetime.datetime.now()
    for xrumerBaseSpam in XrumerBaseSpam.objects.filter(Q(active=True), Q(stateManaged='done')).order_by('pk').all():
        if (xrumerBaseSpam.linksCount < 2) or (xrumerBaseSpam.dateLastParsed==None) or (xrumerBaseSpam.dateLastParsed + datetime.timedelta(0, interval * 24 * 60 * 60, 0) < dt):
            xrumerBaseSpam.ResetNames()
            xrumerBaseSpam.stateManaged = 'new'
            xrumerBaseSpam.save()

def ResumeAfterReg():
    '''Заново создаем базы и профили после регистрации'''
    _ResumeAfterRegEntity(XrumerBaseSpam)
    _ResumeAfterRegEntity(XrumerBaseDoors)
    _ResumeAfterRegEntity(XrumerBaseProfiles)

def _ResumeAfterRegEntity(entity):
    '''То же самое по заданному типу'''
    dt = datetime.datetime.now()
    for item in entity.objects.filter(Q(active=True), Q(registerRun=True), Q(stateManaged='done')).order_by('pk').all():
        if (item.registerRunDate != None) and (item.registerRunDate + datetime.timedelta(0, item.registerRunTimeout * 60 * 60, 0) < dt):
            item.registerRun = False
            item.stateManaged = 'new'
            item.save()

def UpdateIndexCount():
    '''Чекаем индекс доменов в гугле'''
    '''Проверяем последнюю дату'''
    lastIndexCountDate = Domain.objects.filter(Q(active=True), Q(stateSimple='ok')).all().aggregate(xx=Max('indexCountDate'))['xx']
    delta = datetime.datetime.now() - lastIndexCountDate
    if (delta.days * 24 * 60 * 60 + delta.seconds) / 60 < 55:  # настройка: интервал парсинга в минутах
        return
    '''Апдейтим индекс'''
    bannedDomains = []
    domains = Domain.objects.filter(Q(active=True), Q(stateSimple='ok')).order_by('indexCountDate', 'pk').all()
    for domain in domains[:50]:  # настройка: по сколько доменов проверять
        indexCountOld = domain.indexCount
        domain.UpdateIndexCount()
        indexCountNew = domain.indexCount
        if (indexCountNew == 0) and (indexCountOld > 0):
            bannedDomains.append(domain.name)
            domain.active = False
            domain.stateSimple = 'error'
            domain.lastError = 'banned'
            domain.save()
    if len(bannedDomains) > 0:
        EventLog('error', 'Domains banned: %s.' % ', '.join(bannedDomains))
    
def CheckOwnershipTk():
    '''Проверяем .tk на отбор'''
    processed = 0
    failed = 0
    for domain in Domain.objects.filter(Q(stateSimple='ok'), Q(name__contains='.tk')):
        if not domain.CheckOwnership():
            failed += 1
            print(domain)
        processed += 1
    print("%d checked, %d failed." % (processed, failed))

def CheckAgentsActivity():
    '''Проверяем активность агентов'''
    dt = datetime.datetime.now()
    for agent in Agent.objects.filter(active=True).order_by('pk').all():
        if (agent.stateSimple == 'ok') and (agent.dateLastPing != None) and (agent.dateLastPing + datetime.timedelta(0, agent.interval * 60 * 60, 0) < dt):
            EventLog('error', 'Agent long inactivity', agent)
            agent.stateSimple = 'error'
            agent.save()

def ClearEventLog():
    '''Удаляем старые записи из лога событий'''
    dt = datetime.datetime.now() - datetime.timedelta(30)  # старше 30 дней
    Event.objects.filter(date__lt=dt).delete()