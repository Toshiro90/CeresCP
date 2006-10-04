<?php
/*
Ceres Control Panel

This is a control pannel program for Athena and Freya
Copyright (C) 2005 by Beowulf and Nightroad

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

To contact any of the authors about special permissions send
an e-mail to cerescp@gmail.com
*/

//include_once 'config.php'; // loads config variables

function email($contas) {
	global $CONFIG_smtp_server, $CONFIG_smtp_port, $CONFIG_smtp_server, $CONFIG_smtp_username, $CONFIG_smtp_password;

	$assunto = "$CONFIG_name Account Info";
	$mensagem = "";
	$mensagem.= "Your account information is as follows:\n\n";
	$mensagem.= "----------------------------\n";
	for ($i = 0; isset($contas[$i][0]); $i++) {
		$mensagem.= "Username: ".$contas[$i][0];
		$mensagem.= "\nPassword: ".$contas[$i][1];
		$mensagem.= "\n----------------------------\n";
	}
	$mensagem.= "\nThank you for playing in and support our server\n\n";
	$mensagem.= "In case of doubt or problem send a mail to $CONFIG_smtp_mail for support.\n\n";
	$mensagem.= "\n\nIf you didn't request account information, ignore this message and nothing will happen.\n\n";
	$mensagem.= "DO NOT REPLY TO THIS MESSAGE";

////////////////////////////////////////////////////////////////////////////////////////////
/// não era pra mudar a mensagem, aqui muito menos
	$errno = 0;
	echo "Connect.<BR>\n";
	do {
		$conn = fsockopen($CONFIG_smtp_server, $CONFIG_smtp_port, $errno, $errstr); //Abrir Conexão
	} while ($errno > 0);

	echo "Start Communication.<BR>\n";
	envia($conn, "HELO ".$CONFIG_smtp_server."\r\n");
	ler($conn); //return 250 = ok, other = error
	envia($conn, "EHLO ".$CONFIG_smtp_server."\r\n");
	ler($conn); //return 250 = ok, 502 = don't exist this function, other = error

	echo "Request Login.<BR>\n";
	envia($conn, "AUTH LOGIN\r\n");
	ler($conn); //return 250 = ok, other means error or don't need
	$str_out = base64_encode($CONFIG_smtp_username)."\r\n";
	envia($conn, $str_out);
	ler($conn); //return 250 means it got the message
	$str_out = base64_encode($CONFIG_smtp_password)."\r\n";
	envia($conn, $str_out);
	ler($conn); //return 250 i think it means you'r logged or return other code that means error

	echo "Send Message.<BR>\n";
	envia($conn, "MAIL FROM:".$CONFIG_smtp_mail."\r\n");
	$str_out = "RCPT TO:".$contas[0][2]."\r\n";
	envia($conn, $str_out);
	envia($conn, "DATA\r\n");
	$str_out = "Subject: ".$assunto."\r\n\r\n".$mensagem."\r\n.\r\n";
	envia($conn, $str_out);

	echo "Close.<BR>\n";
	envia($conn, "QUIT\r\n");
	ler($conn); //return 250 means mail sent, other = error
	fclose($conn);
}

function envia($conn, $str_out) {
	if(!fwrite($conn, $str_out)) { //manda mensagem
		die("Can't Send: ".$str_out);
	}
//	echo $str_out;
	return;	
}
function ler($conn) {
	$str_in = "";
	while (substr($str_in, 3, 1) != " ") {
		$str_in = fgets($conn, 256);
		$str_in = print_r($str_in, TRUE);
//		echo $str_in;
	}
	return (substr($str_in, 0, 3));
}

?>
