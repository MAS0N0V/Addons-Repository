<?php
header("Content-type: text/html; charset=windows-1251");
//-----���������--------------
$server = '127.0.0.1';  // ����� �������
$port_ls = '2106';              // ���� �����-�������
$port_gs = '7777';              // ���� ����-�������
//----------------------------
$host = 'localhost';    // ����� ���� ������ �������
$user = 'root';                 // ��� ��������������
$password = 'pass';                 // ������ ��������������
$gs = 'aion_gs';                // ��� ���� ������ ����-�������
//---------------------------
$login = @fsockopen($server, $port_ls, $errno, $errstr, '10');
$game = @fsockopen($server, $port_gs, $errno, $errstr, '10');
if($game){
mysql_connect($host, $user, $password);
mysql_select_db($gs);
mysql_query("SET NAMES 'utf8'"); 	//�������� ��������� ���� ������ (cp1251)
$result = mysql_query("SELECT * FROM players WHERE online=1"); //players - ������� � ��������; online - ���� 1, ����� ������; 0 ����� �������.
$online = mysql_num_rows($result);
mysql_close();
} else $online = 0;
$login = $login ? "<font color=green>On</font>" : "<font color=red>OFF</font>";
$game = $game ? "<font color=green>On</font>" : "<font color=red>OFF</font>";
?>
<TABLE width="100%">
        <TR>
                <TD rowspan=2><strong>Servtest 1</strong></TD>
                <TD><strong>Login</strong></TD>
				<TD><strong>Game</strong></TD>
				<TD><strong>� ����</strong></TD>
        </TR>
        <TR>
                <TD><?php echo $login; ?></TD> <TD><?php echo $game; ?></TD>
				<TD><?php echo $online; ?></TD>
        </TR>
</TABLE>