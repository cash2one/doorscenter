<?switch ($_GET['sub']) {
    case "template":
?>
<p align="left"><font size="3" face="Verdana">�������<br></font></p>
<form name="form1" method="post">
    <div align="left">
        <p>[<b>����� ��������</b>]<br>
������ ���������� ������������ Smarty. Help �� ������������� ����� ������� <a href="http://www.smarty.net/distributions/manual/ru/Smarty-2.6.7-docs.chm">�����</a>.</p>
        <p>[<b>�������� ���������</b>]<br>
�� ������ ��� �������������� ������ �����, ��� � ������������ �������. ��� ��� �������������� �����:<br>
{include file=&quot;header.html&quot;} - �������� ��������� ��������. ������������ ���������� {$name}, {$title}, {$keywords}, {$description} � ������������ ����� default.css ������������ ������������ index.conf<br>
{include file=&quot;logo.html&quot;} - ������� ������� (�������� ����� ���� ������). ������������ ���������� {$name} {$slogan} ��� �� ����������� id ���� (#logo#) ������������ � �����. ������� id ���� ����� � ����� index.conf ���������� logo.<br>
{include file=&quot;news.html&quot;} - ���� ��������. ����� ������� ��� ����� �������� #newstype# (����������� � index.conf). ��� �� � ����� ������������ ����� ������� {#newsid#} - id ��������� div. {#newsclass#} - ����� ��������� div. ��� �� ������������ ������ �������� {$news}<br>
{include file=&quot;menu.html&quot;} - ���� ����. ���� � ����� ������� #menu# �� ����� ������������ ���� �� 4-� ���������, ���� ������ �� ������� #menu# �� ����� ������������ ���� �� ���� ���������. �������� ����������� � ���� ������� {$m}<br>
{include file=&quot;sidebar.html&quot;} - ���� ������������. ����� ������� id ���� div #sidebar# � ����� index.conf. � ���� ���� ������������ ���� {$m}&nbsp;� ���� ������������ {$blockul.7}.<br>
{include file=&quot;footer.html&quot;} - ��� ��������, ���������. ������������ ���������� {$year}.</p>
        <p>[<b>�������� ����������</b>]<br>
{$blockol.visable} - ���������� �� ���� ������������<br>
{$blockul.title} - �������� ����� ������������<br>
{$blockul.1} - ���� ������������ 1&nbsp;������<br>
{$blockul.2} - ���� ������������ 2&nbsp;������<br>
{$blockul.3} - ���� ������������ 3&nbsp;������<br>
{$blockul.4} - ���� ������������ 4&nbsp;������<br>
{$blockul.5} - ���� ������������ 5&nbsp;������<br>
{$blockul.6} - ���� ������������ 6&nbsp;������<br>
{$blockul.7} - ���� ������������ 7 ������<br>
{$blockol.visable} - ���������� �� ���� ������������<br>
{$blockol.title} - �������� ����� ������������<br>
{$blockol.1} - ���� ������������ 1&nbsp;������<br>
{$blockol.2} - ���� ������������ 2&nbsp;������<br>
{$blockol.3} - ���� ������������ 3&nbsp;������<br>
{$blockol.4} - ���� ������������ 4&nbsp;������<br>
{$blockol.5} - ���� ������������ 5&nbsp;������<br>
{$blockol.6} - ���� ������������ 6&nbsp;������<br>
{$blockol.7} - ���� ������������ 7 ������<br>
{$year} - ���<br>
{$name} - �������� ����� (���� �����)<br>
{$title} - ��������� ��������<br>
{$content} - ���������� ������<br>
{$keywords} - �������� �����<br>
{$description} - �������� ��������<br>
{$slogan} - �������� ��� (�� �������� ������ �������)<br>
{$m} - ������ ���� (�������� 5)<br>
{$m.0.activ} - ���� ��� ������� �������� �� ����������� ��� ���� ��� �� �����<br>
{$m.0.url} - ������ �� �������� ��&nbsp;������ ����<br>
{$m.0.str} - ��������� ������ ����<br>
{$news.title} - �������� ������� ��������<br>
{$news} - ������ �������� (�� ���������� �� ����������)<br>
{$news.0.title} - ��������� �������<br>
{$news.0.content} - ���������� �������<br>
{$news.0.url} - ������ �� �������<br>
{$news.0.date} - ����� ���������� �������, �������� {$news.0.date|date_format:&quot;%e %B %Y&quot;}<br>
&nbsp;</p>
    </div>
</form>
<?
      break;
    case "video":
?>
<p align="left"><font size="3" face="Verdana">�����<br></font></p>
<form name="form1" method="post">
    <div align="left">
        <p>[<b>������ �� �����</b>]<br>
           <a href="http://vipbablo.ru/download/video.exe">����� 1</a><br>
           <a href="http://vipbablo.ru/download/video1.exe">����� 2</a><br>
           <a href="http://vipbablo.ru/download/video2.exe">����� 3</a><br>
           <a href="http://vipbablo.ru/download/video3.exe">����� 4</a><br>
        </p>
    </div>
</form>
<?
      break;
    default:
?>
<p align="left"><font size="3" face="Verdana">�������<br></font></p>
<form name="form1" method="post">
    <div align="left">

        <p>[<b>����� ��������</b>]<br>
������ ������������ ��� ��������� ��������� ������ - ����������. ������ ��������� ���������������: �� ��� ������� ������� ��������� ���������, ��� ������� �����������, ��� ��������� ����, ��������� �������� �����, ��������, �������� � ������ ��������,&nbsp;��� ��������������� ��������. ������ ����� ����� ��������� �������� � ��������� ������������ ����� �������� ����� �������. ������� �������� �� ���������� � ����� ������ ������������� Smarty, ������� ������������ � ����������� CMS � ��� ����� � WordPress. ������ ����� ��������� �������� ��� � HTML ��� � � PHP ������.</p>
        <p>[<b>�������� ������</b>]<br>
<font size="2"><b>��� 1</b></font> ��������������� ������ ��� �������.&nbsp;������ �������� �����, �������� �����, ���������� ��������
�������, �������� ������, ��������� ��������� �� ���������� �������<br>
<font size="2"><b>��� 2</b></font>&nbsp;������ ���� � ��������� � ������� ������ �� �����<br>
<font size="2"><b>��� 3</b></font>&nbsp;������ ���� �� ������ ���� �� ������ � ����� ������ ������ ������ (���������� �����, ��������� ������ �����)<br>
<b><font size="2">��� 4</font></b>&nbsp;���� ���������� ���������� ������� ������ ��������� ������ ��
���������� � ����� ����� �� ������� � ����� ���������� ������� ��
��������� � 30-40%<br>
<font size="2"><b>��� 5</b></font> ���� ������������ ������, ������ ����� ���������������� ������.<br>
<b><font size="2">��� 6</font></b>&nbsp;������ ���� � ����� �� ��������� � �� ����� ���� ��������<br>
<font size="2"><b>��� 7</b></font>&nbsp;������ ����������� ���������� ������ ��������� �������������
����������, ��������� �������� �����, ����� ��� ����, ���������
�������� (���� ��������� � �������)<br>
<font size="2"><b>��� 8</b></font>&nbsp;������ ��������� �������� � ���������� ������.<br>
<font size="2"><b>��� 9</b></font>&nbsp;�� ������ ���������� ������� ������ ��������� html �������� ���� ������ ��� php ������<br>
<font size="2"><b>��� 10</b></font>&nbsp;������ ���������� ����� ������� (�������� � �����) � ��������� � ����� ��������������� ��������<br>
<font size="2"><b>��� 11</b></font>&nbsp;����� ������������ � ��������� ����� � ������ �� ����� ���������� ������������<br>
<font size="2"><b>��� 12</b></font> ���� ������������ ������ ������ ����� ������ ���������&nbsp;�� ���.</p>
        <p>[<b>�����������</b>]<br>
<u>- ������������</u> - �� ������ �������������� ������� ����� ������ ������������ � ���������, ������ ��������������� ������<br>
<u>- ������ SAPE</u> - ������������� ��������� ��� SAPE, �� ������ ������� � ����� ����� ��������� ������<br>
<u>- ������������ ����� �����</u> - ������ ������������� ���������� ����� ����� (map.html)<br>
<u>- ������������� ��������</u> - ������ ����� ��������� �������� ������������ � ���������� ������, ��� �������� ������ � ����.<br>
<u>- ���������� ���������� �������� �������</u> - �� ������ ������ ��� ������ ������ ����������<br>
<u>- </u><u>������������� �������� ���������</u> - �� ��������� ����������� �������� � ������.<br>
<u>- ������������</u> - �������� ���������������� ���������� ������ ����� �������� ���������� �������<br>
<u>- ������������</u> - �� ������ ��������� ������ �� ���������� � ����� ����� �� ������� ����� �������� ���������� ������<br>
<u>- ��������� �������� ������������� </u>- �� ������ ������� ������� �������� ������������� �� ��������<br>
<u>- ����� ������</u> - �� ������ ������� ��� �������� ����, ������, ������ � �.�.<br>
<u>- ��� ����������</u> - ������ ����� ��������� �������� ��� � html, ��� � � php ������<br>
<u>- ������ ��������</u> - ����� ���������� �� ������� ������ ��������� ������<br>
<u>- ������� ���������� �������</u> - �� ������ ����������� ������� ���������� ������� ������� ����� �� 15 ��� 150...<br>
<u>- �������� �����������&nbsp;����� ������ </u>- ���� ����� ������ ��������� ������ �� �� ������������� �� �����<br>
<u>- �������� ������������ �����</u> - ���� ����� ������, �� ����� �������<br>
<u>- �������� ���� �������</u> - �� ������ �������������� ������ ����������� ������ ����<br>
<u>- ��������� zip</u> - �� ������ �������� ��������������� �������� � ���� zip ������.<br>
<u>- ������� �� ��� </u>- �� ������ ������������� �������� ��������������� �������� �� ��������� ����&nbsp;��� ������.<br>
<u>- ���������� help</u> - �� ������ �������� ������� ����� � ��������</p>
        <p>[<b>��������� �� ��������� ���������</b>]<br>
<font size="2"><b>��� 1</b></font> �������� � ���������� Denwer, � ����� denwer.ru<br>
<font size="2"><b>��� 2</b></font> ���������� &nbsp;���������� ������ � ����� /home/<br>
<font size="2"><b>��� 3</b></font> ������������� Denwer<br>
<font size="2"><b>��� 4</b></font> ��������� ������� FireFox<br>
<font size="2"><b>��� 5</b></font> � ��������� ������ ������� <a href="http://vipbablo">http://vipbablo</a></p>
        <p>[<b>��������� �� �������</b>]<br>
<font size="2"><i>��������! �� �� ���� �������� ��� ������ ����� �������� �� ����� ��������. ���� ��������� ��� �� �����-�� CMS ��� ������� ����������. ���������� � ������� � ��� ���������� ������� ���������� � �������� ������ ����� �������� ���������.</i></font><br>
<font size="2"><b>��� 1</b></font>&nbsp;���������� &nbsp;���������� ������ � �������� ������ ������<br>
<b><font size="2">��� 2</font></b>&nbsp;���������� ����� �� ������ ��� ����� config.php � ����� compile, zip, pages, googleim, google, out<br>
<b><font size="2">��� 3</font></b>&nbsp;��������� ������� FireFox<br>
<font size="2"><b>��� 4</b></font>&nbsp;� ��������� ������ ������� ��� ����� � ������ ��������</p>
        <p>[<b>����������</b>]<br>
1. ������� ���������<br>
2. Apache<br>
3. PHP 4 � ����<br>
4. �������� ������������ TimeOut<br>
5. Firefox - ������� �������<br>
&nbsp;</p>
    </div>
</form>
<?
      break;
  }

?>