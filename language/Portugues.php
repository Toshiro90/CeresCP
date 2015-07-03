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

//Nгo mude tags %s e %d ou %%

//misc
$lang['LOGGED'] = 'Vocк estб logado.';
$lang['LOGGEDOFF'] = 'Vocк estб deslogado.';
$lang['COOKIE_REJECTED'] = 'Cookie rejeitado.';
$lang['INCORRECT_CHARACTER'] = 'Caracter incorreto detectado.';
$lang['UNKNOWN_MAIL'] = 'E-Mail desconhecido.';
$lang['INCORRECT_CODE'] = 'Cуdigo Incorreto.';
$lang['INCORRECT_PASSWORD'] = 'Senha Incorreta.';
$lang['PASSWORD_CHANGED'] = 'Senha Alterada.';
$lang['CHANGE_PASSWORD'] = 'Alterar Senha';
$lang['USERNAME_LENGTH'] = 'Nome de Usuбrio deve conter entre 4 a 23 caracteres.';
$lang['PASSWORD_LENGTH_OLD'] = 'Senha deve conter entre 4 a 23 caracteres.';
$lang['PASSWORD_LENGTH'] = 'Senha deve conter entre 6 a 23 caracteres.';
$lang['WRONG_USERNAME_PASSWORD'] = 'Usuбrio/Senha Incorreta.';
$lang['USERNAME'] = 'Usuбrio';
$lang['PASSWORD'] = 'Senha';
$lang['NEW_PASSWORD'] = 'Nova Senha';
$lang['CONFIRM'] = 'Confirmar';
$lang['CODE'] = 'Cуdigo';
$lang['SECURITY_CODE'] = 'Cуdigo de Seguranзa';
$lang['RECOVER'] = 'Recuperar';
$lang['PASSWORD_NOT_MATCH'] = 'As senhas nгo conferem.';
$lang['PASSWORD_REJECTED'] = 'Senha rejeitada: Insegura.\nEla Precisa conter ao menos 2 nъmeros e 2 letras e ter um tamanho de 6 caracteres no minimo.\nEx: cake48';
$lang['EMAIL_NEEDED'] = 'Email й necessбrio.';
$lang['INVALID_BIRTHDAY'] = 'Aniversбrio Invalido.';
$lang['SEX'] = 'Sexo';
$lang['REAL_SEX'] = 'Sexo real';
$lang['JANUARY'] = 'Janeiro';
$lang['FEBRUARY'] = 'Fevereiro';
$lang['MARCH'] = 'Marзo';
$lang['APRIL'] = 'Abril';
$lang['MAY'] = 'Maio';
$lang['JUNE'] = 'Junho';
$lang['JULY'] = 'Julho';
$lang['AUGUST'] = 'Agosto';
$lang['SEPTEMBER'] = 'Setembro';
$lang['OCTOBER'] = 'Outubro';
$lang['NOVEMBER'] = 'Novembro';
$lang['DECEMBER'] = 'Dezembro';
$lang['MAIL'] = 'E-Mail';
$lang['CREATE'] = 'Criar';
$lang['NEED_TO_LOGIN'] = 'Vocк precisa estar logado para acessar estб pagina.';
$lang['NEED_TO_LOGIN_F'] = 'Vocк precisa estar logado para usufluir dessa funзгo.';
$lang['DB_ERROR'] = 'Desculpe! Um erro foi encontrado no acesso ao banco de dados, tente novamente mais tarde.';
$lang['TXT_ERROR'] = 'Erro no arquivo texto.';
$lang['NEED_TO_LOGOUT_F'] = 'Vocк deve estar deslogado do jogo, para usufluir desta funзгo.';
$lang['CHANGE'] = 'Alterar';
$lang['SUNDAY'] = 'Domingo';
$lang['MONDAY'] = 'Segunda';
$lang['TUESDAY'] = 'Terзa';
$lang['WEDNSDAY'] = 'Quarta';
$lang['THURSDAY'] = 'Quinta';
$lang['FRIDAY'] = 'Sexta';
$lang['SATURDAY'] = 'Sбbado';
$lang['BLOCKED'] = 'Vocк foi bloqueado, tente novamente em %d min';
$lang['LEVEL'] = 'Level'; // TODO: translate
$lang['GMLEVEL'] = 'GM Level'; // TODO: translate
$lang['SHOW_ALL'] = 'Show All'; // TODO: translate

//menu.php
$lang['MENU_HOME'] = 'Principal';
$lang['MENU_MYACCOUNT'] = 'Minha Conta';
$lang['MENU_MYCHARS'] = 'Meus Personagens';
$lang['MENU_RANKING'] = 'Ranking';
$lang['MENU_INFORMATION'] = 'Informaзхes';
$lang['MENU_PROBLEMS'] = 'Problemas';
$lang['MENU_MESSAGE'] = 'Mensagem';
$lang['MENU_CHANGEPASS'] = 'Alterar Senha';
$lang['MENU_CHANGEMAIL'] = 'Alterar e-mail';
$lang['MENU_TRANFMONEY'] = 'Transferir Dinheiro';
$lang['MENU_CHANGESLOT'] = 'Mudar Slot';
$lang['MENU_MARRIAGE'] = 'Casamento';
$lang['MENU_PLAYERLADDER'] = 'Ladder de Jogadores';
$lang['MENU_GUILDLADDER'] = 'Ladder de Guildas';
$lang['MENU_ZENYLADDER'] = 'Ladder de Zenny';
$lang['MENU_WHOSONLINE'] = 'Quem Estб Online';
$lang['MENU_ABOUT'] = 'Sobre';
$lang['MENU_RESETPOS'] = 'Reset de Posiзгo';
$lang['MENU_RESETLOOK'] = 'Reset de Aparкncia';
$lang['MENU_OTHER'] = 'Outro';
$lang['MENU_LINKS'] = 'Links';
$lang['MENU_STORAGE'] = 'Storage'; // TODO: translate
$lang['MENU_VENDING'] = 'Vending'; // TODO: translate
$lang['MENU_PURCHASING'] = 'Purchasing'; // TODO: translate
$lang['MENU_LOGS'] = 'Logs'; // TODO: translate
$lang['MENU_LOG_ATCOMMAND'] = 'Atcommand Logs'; // TODO: translate
$lang['MENU_LOG_CASH'] = 'Cash Logs'; // TODO: translate
$lang['MENU_LOG_CHAR'] = 'Char Logs'; // TODO: translate
$lang['MENU_LOG_BRANCH'] = 'Dead Branch Logs'; // TODO: translate
$lang['MENU_LOG_ITEM'] = 'Item Logs'; // TODO: translate
$lang['MENU_LOG_LOGIN'] = 'Login Logs'; // TODO: translate
$lang['MENU_LOG_MVP'] = 'MVP Logs'; // TODO: translate
$lang['MENU_LOG_NPC'] = 'NPC Logs'; // TODO: translate
$lang['MENU_LOG_ZENY'] = 'Zeny Logs'; // TODO: translate
$lang['MENU_ADMIN'] = 'Administration'; // TODO: translate
$lang['MENU_ADMIN_ACC'] = 'Accounts'; // TODO: translate
$lang['MENU_ADMIN_CHAR'] = 'Chars'; // TODO: translate

//common
$lang['NAME'] = 'Nome';
$lang['CLASS'] = 'Classe';
$lang['BLVLJLVL'] = 'Blvl/Jlvl';
$lang['MAP'] = 'Mapa';
$lang['UNKNOWN'] = 'Desconhecido';
$lang['POS'] = 'Pos';
$lang['ZENY'] = 'Zeny';
$lang['SLOT'] = 'Slot';
$lang['ONE_CHAR'] = 'Vocк deve ter no mнnimo um personagem.';
$lang['WOE_TIME'] = 'Nгo й possнvel ver essa funзгo durante o WoE.';
$lang['SEARCH'] = 'Search'; // TODO: translate
$lang['DETAIL'] = 'Detail'; // TODO: translate
$lang['ACCOUNT_ID'] = 'Account ID'; // TODO: translate
$lang['CHAR_ID'] = 'Char ID'; // TODO: translate
$lang['MOB_ID'] = 'Mob ID'; // TODO: translate
$lang['TIME'] = 'Time'; // TODO: translate
$lang['REFRESH_PAGE'] = 'Refresh'; // TODO: translate
$lang['MESSAGE'] = 'Message'; // TODO: translate
$lang['COMMAND'] = 'Command'; // TODO: translate
$lang['TYPE'] = 'Type'; // TODO: translate
$lang['EXP'] = 'Experience'; // TODO: translate
$lang['ABR_EXP'] = 'Exp'; // TODO: translate
$lang['HAIR_COLOR'] = 'Hair Color'; // TODO: translate
$lang['HAIR_STYLE'] = 'Hair Style'; // TODO: translate
$lang['IP_ADDRESS'] = 'IP'; // TODO: translate
$lang['EDIT'] = 'Edit'; // TODO: translate
$lang['STATUS'] = 'Status'; // TODO: translate
$lang['STATUS_ON'] = 'On'; // TODO: translate
$lang['STATUS_OFF'] = 'Off'; // TODO: translate
$lang['LINK_BACK'] = 'Back'; // TODO: translate


//items
$lang['ITEM_NAME'] = 'Item Name'; // TODO: translate
$lang['ITEM_AMOUNT'] = 'Amount'; // TODO: translate
$lang['ITEM_CARD'] = 'Card'; // TODO: translate
$lang['ITEM_SIGNED_BY'] = 'signed by'; // TODO: translate
$lang['ITEM_FORGED_BY'] = 'forged by'; // TODO: translate
$lang['ITEM_PET'] = 'Pet'; // TODO: translate
$lang['ITEM_TYPE'] = 'Type'; // TODO: translate
$lang['CASH_TYPE'] = 'Cash Type'; // TODO: translate

//whoisonline.php
$lang['WHOISONLINE_WHOISONLINE'] = 'Quem estб online';
$lang['WHOISONLINE_COORDS'] = 'Coords';

//top100zeny.php
$lang['TOP100ZENY_TOP100ZENY'] = 'Top 100 Zeny';

//slot.php
$lang['SLOT_NOT_SELECTED'] = 'Nenhum slot novo selecionado.';
$lang['SLOT_CHANGE_FAILED'] = 'A mudanзa falhou.';
$lang['SLOT_WRONG_NUMBER'] = 'Detectado nъmero incorreto de slot.';
$lang['SLOT_CHANGE_SLOT'] = 'Mudanзa de Slot de Personagem';
$lang['SLOT_NEW_SLOT'] = 'Novo Slot';
$lang['SLOT_PS1'] = '*Se o slot selecionado conter um personagem, ele serб mudado de posiзгo tambem';
$lang['SLOT_PS2'] = '*Vocк sу й capaz de mudar um personagem de posiзгo por vez.';

//server_status.php
$lang['SERVERSTATUS_LOGIN'] = 'Login Server';
$lang['SERVERSTATUS_CHAR'] = 'Char Server';
$lang['SERVERSTATUS_MAP'] = 'Map Server';
$lang['SERVERSTATUS_ONLINE'] = 'Online';
$lang['SERVERSTATUS_OFFLINE'] = 'Offline';
$lang['SERVERSTATUS_USERSONLINE'] = 'Usuбrios On';
$lang['AGIT'] = 'WoE';
$lang['AGIT_OFF'] = 'Off';
$lang['AGIT_ON'] = 'On';

//resetlook.php
$lang['RESETLOOK_RESET_LOOK'] = 'Reset de aparкncia falhou.';
$lang['RESETLOOK_EQUIP_OK'] = 'Equipamento foi resetado.';
$lang['RESETLOOK_HAIRC_OK'] = 'Cor de cabelo foi resetada.';
$lang['RESETLOOK_HAIRS_OK'] = 'Estilo de cabelo foi resetado.';
$lang['RESETLOOK_CLOTHESC_OK'] = 'Cor de roupa foi resetada.';
$lang['RESETLOOK_SELECT'] = 'Selecione ao menos uma aparкncia a ser resetada.';
$lang['RESETLOOK_RESETLOOK'] = 'Reset de Aparкncia';
$lang['RESETLOOK_EQUIP'] = 'Equipment'; // TODO: translate
$lang['RESETLOOK_HAIRC'] = 'Hair Color'; // TODO: translate
$lang['RESETLOOK_HAIRS'] = 'Hair Style'; // TODO: translate
$lang['RESETLOOK_CLOTHESC'] = 'Clothes Color'; // TODO: translate

//recover.php
$lang['RECOVER_RECOVER'] = 'Recuperar Senha';

//position.php
$lang['POSITION_RESET_FAILED'] = 'Reset de Posiзгo Falhou.';
$lang['POSITION_NO_ZENY'] = 'Vocк nгo possui zeny o suficiente.';
$lang['POSITION_OK'] = 'Posiзгo resetada com sucesso.';
$lang['POSITION_TITLE'] = 'Reset de Posiзгo';
$lang['POSITION_LEVEL'] = 'Nнvel';
$lang['POSITION_SELECT'] = 'Selecionar';
$lang['POSITION_RESET'] = 'Resetar';
$lang['POSITION_PS1'] = '*Haverб um custo de %d zenys para utilizaзгo deste serviзo';
$lang['POSITION_JAIL'] = 'Nгo pode suar isto enquanto estiver na prisгo.';

//motd.php
$lang['NEWS_MESSAGE'] = 'Mensagem';

//money.php
$lang['MONEY_INCORRECT_NUMBER'] = 'Nъmero incorreto detectado.';
$lang['MONEY_CHEAT_DETECTED'] = 'Cheat Detectado.';
$lang['MONEY_OPER_IMPOSSIBLE'] = 'Estб operaзгo й impossivel.';
$lang['MONEY_OK'] = 'Zeny Transferido com sucesso.';
$lang['MONEY_AMMOUNT'] = 'Quantidade de Zeny a transferir';
$lang['MONEY_AVAILABLE'] = 'Quantidade disponivel';
$lang['MONEY_TRANSFER'] = 'Quantidade a transferir';
$lang['MONEY_CHANGE'] = 'Transferir';
$lang['MONEY_TWO_CHAR'] = 'Vocк deve possuir ao menos dois personagens.';
$lang['MONEY_TRANSFER_FROM'] = 'Transferir Zeny De';
$lang['MONEY_TRANSFER_TO'] = 'Transferir Zeny Para';
$lang['MONEY_PS1'] = '*Haverб um custo de %.2f%%, do montante transferido, para utilizaзгo deste serviзo';
$lang['MONEY_SELECT'] = 'Select'; // TODO: translate
$lang['MONEY_NO_ZENY'] = 'Vocк nгo possui zeny o suficiente.';

//marriage.php
$lang['MARRIAGE'] = 'Casamento';
$lang['MARRIAGE_COUPLE_OFF'] = 'Estб funзгo sу estб disponivel quando o casal esta desconectado do jogo. Porem seu/sua companheiro(a) estб online no momento.';
$lang['MARRIAGE_DIVORCE_OK'] = 'Personagem foi divorciado.';
$lang['MARRIAGE_NOTHING'] = 'Nothing to be done.';
$lang['MARRIAGE_PARTNER'] = 'Companheiro';
$lang['MARRIAGE_DIVORCE'] = 'Divorcio';
$lang['MARRIAGE_SINGLE'] = 'Solteiro';
$lang['MARRIAGE_PS1'] = '*Para execuзгo do divorcio, ambos devem estar offline do jogo';
$lang['MARRIAGE_PS2'] = '*Vocк sу pode alterar um personagem por vez';
$lang['MARRIAGE_PS3'] = '*Vocк serб banido por 2 minutos para fazer efeito';

//ladder.php
$lang['LADDER_TOP100'] = 'Ladder Top 100 Rank';
$lang['LADDER_GUILD'] = 'Guilda';
$lang['LADDER_STATUS'] = 'Estado';
$lang['LADDER_STATUS_ON'] = 'on';
$lang['LADDER_STATUS_OFF'] = 'off';

//guild.php
$lang['GUILD_TOP50'] = 'Top 50 Ladder de Guildas';
$lang['GUILD_EMBLEM'] = 'Emblema';
$lang['GUILD_GNAME'] = 'Nome da Guilda';
$lang['GUILD_GLEVEL'] = 'Nнvel';
$lang['GUILD_GEXPERIENCE'] = 'Experiencia';
$lang['GUILD_GAVLEVEL'] = 'Nнvel Mйdio';
$lang['GUILD_GCASTLES'] = 'Castelos de Guildas';
$lang['GUILD_GCASTLE'] = 'Castelo';
$lang['GUILD_MEMBERS'] = 'Membros';

//changemail.php
$lang['CHANGEMAIL_MAIL_INVALID'] = 'Novo e-mail nгo й um e-mail vбlido.';
$lang['CHANGEMAIL_CHANGEMAIL'] = 'Alterar E-Mail';
$lang['CHANGEMAIL_CHANGE'] = 'Alterar';
$lang['CHANGEMAIL_NEW_MAIL'] = 'Novo e-mail';
$lang['CHANGEMAIL_CURRENT_MAIL'] = 'e-mail Atual';

//account.php
$lang['USERNAME_IN_USE'] = 'Nome de Usuбrio em uso.';
$lang['ABR_SEX_MALE'] = 'M';
$lang['ABR_SEX_FEMALE'] = 'F';
$lang['SEX_MALE'] = 'Masculino';
$lang['SEX_FEMALE'] = 'Feminino';
$lang['ACCOUNT_CREATED'] = 'Conta criada. Vocк pode se logar agora.';
$lang['ACCOUNT_PROBLEM'] = 'Error ao criar conta, por favor tente mais tarde.';
$lang['INTERNAL_STATISTIC'] = '(para estatнstica interna)';
$lang['BIRTHDAY'] = 'Nascimento (AAAAMMDD)';
$lang['ACCOUNT_MAX_REACHED'] = 'Jб existem muitas contas registradas, tente mais tarde.';

//index.php
$lang['NEW_ACCOUNT'] = 'Nova Conta';
$lang['NEW_ACCOUNT_EXPL'] = 'Create a new account'; // TODO: translate
$lang['RECOVER_PASSWORD'] = 'Recuperar sua senha';
$lang['RECOVER_PASSWORD_EXPL'] = 'Send the account info to your e-mail'; // TODO: translate

//links.php
$lang['LINKS_LINKS'] = 'Links';
$lang['LINKS_NAME'] = 'Nome';

//login.php
$lang['LOGIN'] = 'Login'; // TODO: translate
$lang['LOGIN_WELCOME'] = 'Bem vindo';
$lang['LOGIN_HELLO'] = 'Olб';
$lang['LOGIN_REMEMBER'] = 'lembrar-se';
$lang['LOGOFF'] = 'Logoff'; // TODO: translate
$lang['LOGOFF_EXPL'] = 'Logoff the server and, if any, reset the cookies'; // TODO: translate

//about.php
$lang['ABOUT_ABOUT'] = 'Sobre o Servidor';
$lang['ABOUT_SERVER_NAME'] = 'Nome do Servidor';
$lang['ABOUT_RATE'] = 'Rate';
$lang['ABOUT_TOTAL_ACCOUNTS'] = 'Total de Contas';
$lang['ABOUT_TOTAL_CHAR'] = 'Total de Personagens';
$lang['ABOUT_TOTAL_ZENY'] = 'Total de Zeny';
$lang['ABOUT_TOTAL_CLASS'] = 'Total por classe';
$lang['ABOUT_WOE_TIMES'] = 'Horбrios do WoE';

//ceres.php
$lang['ABOUT_CERES'] = 'Ceres Control Panel Information'; // TODO: translate
$lang['CERES_TITLE'] = 'Ceres Control Panel';

//storage.php
$lang['STORAGE'] = 'Storage'; // TODO: translate
$lang['STORAGE_YOUR'] = 'Your Storage'; // TODO: translate
$lang['STORAGE_COUNT'] = '%d items found'; // TODO: translate

//vending.php
$lang['VENDING'] = 'Vending'; // TODO: translate
$lang['VENDING_NOUSER'] = 'There is currently no character using vending.'; // TODO: translate

//purchasing.php
$lang['PURCHASING'] = 'Purchasing'; // TODO: translate
$lang['PURCHASING_NOUSER'] = 'There is currently no character having a purchasing store.'; // TODO: translate

//selectlang.php
$lang['LANGUAGE'] = 'Language'; // TODO: translate

//admin
$lang['ADMIN_TYPE_MIN_CHARS'] = 'Please type at least %d chars'; // TODO: translate

//adminaccounts.php
$lang['ADMIN_ACCS'] = 'View Accounts'; // TODO: translate
$lang['ADMIN_ACCS_CHARS'] = 'Chars'; // TODO: translate
$lang['ADMIN_ACCS_CHARS_EXPL'] = 'View Chars'; // TODO: translate
$lang['ADMIN_ACCS_BAN_UNBAN'] = '(Un)Ban'; // TODO: translate
$lang['ADMIN_ACCS_BAN_UNBAN_EXPL'] = 'Ban, Block, Unban or Unblock'; // TODO: translate
$lang['ADMIN_ACCS_EDIT'] = 'Account Edit'; // TODO: translate
$lang['ADMIN_ACCS_ID'] = 'Account - %d'; // TODO: translate
$lang['ADMIN_ACCS_BAN_BLOCK'] = 'Account BAN/BLOCK'; // TODO: translate

//adminchars.php
$lang['ADMIN_CHARS'] = 'View Chars'; // TODO: translate

//adminaccban.php
$lang['ADMIN_ACCBAN_LAST_LOGIN'] = 'Last Login'; // TODO: translate
$lang['ADMIN_ACCBAN_BAN_UNTIL'] = 'Ban until'; // TODO: translate
$lang['ADMIN_ACCBAN_BLOCK'] = 'Block'; // TODO: translate
$lang['ADMIN_ACCBAN_UNBLOCK'] = 'Unlock'; // TODO: translate

