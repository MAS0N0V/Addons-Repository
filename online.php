<?php
header("Content-type: text/html; charset=windows-1251");
//-----Настройки--------------
$server = '127.0.0.1';  // адрес сервера
$port_ls = '2106';              // порт логин-сервера
$port_gs = '7777';              // порт гейм-сервера
//----------------------------
$host = 'localhost';    // адрес базы данных сервера
$user = 'root';                 // имя администратора
$password = 'pass';                 // пароль администратора
$gs = 'aion_gs';                // имя базы данных гейм-сервера
//---------------------------
$login = @fsockopen($server, $port_ls, $errno, $errstr, '10');
$game = @fsockopen($server, $port_gs, $errno, $errstr, '10');
if($game){
mysql_connect($host, $user, $password);
mysql_select_db($gs);
mysql_query("SET NAMES 'utf8'"); 	//возможно кодировка базы другая (cp1251)
$result = mysql_query("SELECT * FROM players WHERE online=1"); //players - таблица с игроками; online - если 1, игрок онлайн; 0 игрок оффлайн.
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
				<TD><strong>В игре</strong></TD>
        </TR>
        <TR>
                <TD><?php echo $login; ?></TD> <TD><?php echo $game; ?></TD>
				<TD><?php echo $online; ?></TD>
        </TR>
</TABLE>