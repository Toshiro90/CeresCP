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

//Do not change tags %s e %d ou %%

//misc
$lang['LOGGED'] = 'Tu es maintenant connecté.';
$lang['LOGGEDOFF'] = 'Tu es maintenant déconnecté.';
$lang['COOKIE_REJECTED'] = 'Cookie rejeté.';
$lang['INCORRECT_CHARACTER'] = 'Character incorecte détecté.';
$lang['UNKNOWN_MAIL'] = 'email rejeté.';
$lang['INCORRECT_CODE'] = 'Code incorrect.';
$lang['INCORRECT_PASSWORD'] = 'Password incorrecte.';
$lang['PASSWORD_CHANGED'] = 'Password Changé.';
$lang['CHANGE_PASSWORD'] = 'Changer de Password';
$lang['USERNAME_LENGTH'] = 'Votre nom d\'account doit être entre 4 et 23 characters.';
$lang['PASSWORD_LENGTH_OLD'] = 'Votre password doit être entre 4 et 23 characters.';
$lang['PASSWORD_LENGTH'] = 'Votre password doit être entre 6 et 23 characters.';
$lang['WRONG_USERNAME_PASSWORD'] = 'Mauvais nom d\'account/Password.';
$lang['USERNAME'] = 'Nom d\'account';
$lang['PASSWORD'] = 'Password';
$lang['NEW_PASSWORD'] = 'Nouveau Password';
$lang['CONFIRM'] = 'Confirmer';
$lang['CODE'] = 'Code';
$lang['SECURITY_CODE'] = 'Code de sécurité';
$lang['RECOVER'] = 'Recover';
$lang['PASSWORD_NOT_MATCH'] = 'Passwords non similaire.';
$lang['PASSWORD_REJECTED'] = 'Password rejecté: Non sécuritaire.\nBesoin de 2 lettres, 2 chiffres et au moins 6 characters.\nEx: cake48';
$lang['EMAIL_NEEDED'] = 'Besoin d\'un email.';
$lang['INVALID_BIRTHDAY'] = 'Date de naissance invalide.';
$lang['SEX'] = 'Sexe';
$lang['REAL_SEX'] = 'Vrai sexe';
$lang['JANUARY'] = 'Janvier';
$lang['FEBRUARY'] = 'Février';
$lang['MARCH'] = 'Mars';
$lang['APRIL'] = 'Avril';
$lang['MAY'] = 'Mai';
$lang['JUNE'] = 'Juin';
$lang['JULY'] = 'Juillet';
$lang['AUGUST'] = 'Août';
$lang['SEPTEMBER'] = 'Septembre';
$lang['OCTOBER'] = 'Octobre';
$lang['NOVEMBER'] = 'Novembre';
$lang['DECEMBER'] = 'Decembre';
$lang['MAIL'] = 'E-Mail';
$lang['CREATE'] = 'Créer';
$lang['NEED_TO_LOGIN'] = 'Besoin d\'être connecté pour acceder à cette page.';
$lang['NEED_TO_LOGIN_F'] = 'Besoin d\'être connecté pour cette fonction.';
$lang['DB_ERROR'] = 'Désolé! Erreur de DB trouvée. S\'il vous plait, essayer plus tard.';
$lang['TXT_ERROR'] = 'Erreur dans le text file.';
$lang['NEED_TO_LOGOUT_F'] = 'Tu dois être déconnecté du jeux pour cette fonction.';
$lang['CHANGE'] = 'Change';
$lang['SUNDAY'] = 'Dimanche';
$lang['MONDAY'] = 'Lundi';
$lang['TUESDAY'] = 'Mardi';
$lang['WEDNSDAY'] = 'Mercredi';
$lang['THURSDAY'] = 'Jeudi';
$lang['FRIDAY'] = 'Vendredi';
$lang['SATURDAY'] = 'Samedi';
$lang['BLOCKED'] = 'You have been blocked, try again in %d min';
$lang['LEVEL'] = 'Level'; // TODO: translate
$lang['GMLEVEL'] = 'GM Level'; // TODO: translate
$lang['SHOW_ALL'] = 'Show All'; // TODO: translate

//menu.php
$lang['MENU_HOME'] = 'Home';
$lang['MENU_MYACCOUNT'] = 'Mon Account';
$lang['MENU_MYCHARS'] = 'Mes Chars';
$lang['MENU_RANKING'] = 'Rang';
$lang['MENU_INFORMATION'] = 'Information';
$lang['MENU_PROBLEMS'] = 'Problemes';
$lang['MENU_MESSAGE'] = 'Message';
$lang['MENU_CHANGEPASS'] = 'Changer de Password';
$lang['MENU_CHANGEMAIL'] = 'Changer de e-mail';
$lang['MENU_TRANFMONEY'] = 'Transferer de l\'argent';
$lang['MENU_CHANGESLOT'] = 'Changer de Slot';
$lang['MENU_MARRIAGE'] = 'Marriage';
$lang['MENU_PLAYERLADDER'] = 'Rang des players';
$lang['MENU_GUILDLADDER'] = 'Rang des guilds';
$lang['MENU_ZENYLADDER'] = 'Rang des Zenny';
$lang['MENU_WHOSONLINE'] = 'Qui est connecté?';
$lang['MENU_ABOUT'] = 'à propos';
$lang['MENU_RESETPOS'] = 'Reseter la Position';
$lang['MENU_RESETLOOK'] = 'Reseter le look';
$lang['MENU_OTHER'] = 'Autre';
$lang['MENU_LINKS'] = 'Liens';
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
$lang['NAME'] = 'Nom';
$lang['CLASS'] = 'Classe';
$lang['BLVLJLVL'] = 'Blvl/Jlvl';
$lang['MAP'] = 'Map';
$lang['UNKNOWN'] = 'Unknown';
$lang['POS'] = 'Pos';
$lang['ZENY'] = 'Zeny';
$lang['SLOT'] = 'Slot';
$lang['ONE_CHAR'] = 'Tu dois avoir au moins un character.';
$lang['WOE_TIME'] = 'Vous ne pouvez pas utilisez cette fonction pendant WoE.';
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
$lang['WHOISONLINE_WHOISONLINE'] = 'Qui est connecté';
$lang['WHOISONLINE_COORDS'] = 'Coords';

//top100zeny.php
$lang['TOP100ZENY_TOP100ZENY'] = 'Top 100 Zeny';

//slot.php
$lang['SLOT_NOT_SELECTED'] = 'Aucun nouveau slot choisi.';
$lang['SLOT_CHANGE_FAILED'] = 'Changement raté.';
$lang['SLOT_WRONG_NUMBER'] = 'Mauvais numero de slot.';
$lang['SLOT_CHANGE_SLOT'] = 'Changer de Char Slot';
$lang['SLOT_NEW_SLOT'] = 'Nouveau Slot';
$lang['SLOT_PS1'] = '*Si le slot choisi à déja un character, il échangeront de place';
$lang['SLOT_PS2'] = '*Tu ne peux que changer un char à la fois';

//server_status.php
$lang['SERVERSTATUS_LOGIN'] = 'Login Server';
$lang['SERVERSTATUS_CHAR'] = 'Char Server';
$lang['SERVERSTATUS_MAP'] = 'Map Server';
$lang['SERVERSTATUS_ONLINE'] = 'Online';
$lang['SERVERSTATUS_OFFLINE'] = 'Offline';
$lang['SERVERSTATUS_USERSONLINE'] = 'Connectés';
$lang['AGIT'] = 'WoE';
$lang['AGIT_OFF'] = 'Off';
$lang['AGIT_ON'] = 'On';

//resetlook.php
$lang['RESETLOOK_RESET_LOOK'] = 'Reset du Look échoué.';
$lang['RESETLOOK_EQUIP_OK'] = 'L\'equipment à été reseté.';
$lang['RESETLOOK_HAIRC_OK'] = 'Hair Color à été reseté.';
$lang['RESETLOOK_HAIRS_OK'] = 'Hair Style à été reseté.';
$lang['RESETLOOK_CLOTHESC_OK'] = 'Clothes Color à été reseté.';
$lang['RESETLOOK_SELECT'] = 'Choisie au moins un look à reseter.';
$lang['RESETLOOK_RESETLOOK'] = 'Reset Look';
$lang['RESETLOOK_EQUIP'] = 'Equipment'; // TODO: translate
$lang['RESETLOOK_HAIRC'] = 'Hair Color'; // TODO: translate
$lang['RESETLOOK_HAIRS'] = 'Hair Style'; // TODO: translate
$lang['RESETLOOK_CLOTHESC'] = 'Clothes Color'; // TODO: translate

//recover.php
$lang['RECOVER_RECOVER'] = 'Recover Password';

//position.php
$lang['POSITION_RESET'] = 'Reseter la Position échoué.';
$lang['POSITION_NO_ZENY'] = 'Pas asser de zenny.';
$lang['POSITION_OK'] = 'Position à été reseter.';
$lang['POSITION_ONE_CHAR'] = 'Tu dois avoir au moins un character.';
$lang['POSITION_TITLE'] = 'Reset Position';
$lang['POSITION_LEVEL'] = 'Level';
$lang['POSITION_SELECT'] = 'Choisi';
$lang['POSITION_RESET'] = 'Reset';
$lang['POSITION_PS1'] = '*Il y aura un prix de %d zenys pour utiliser cette fonction';
$lang['POSITION_JAIL'] = 'You may not use this while in jail.';

//motd.php
$lang['NEWS_MESSAGE'] = 'Message';

//money.php
$lang['MONEY_INCORRECT_NUMBER'] = 'Nombre incorrecte détecté.';
$lang['MONEY_CHEAT_DETECTED'] = 'Cheat Detecté.';
$lang['MONEY_OPER_IMPOSSIBLE'] = 'Cette opération est impossible.';
$lang['MONEY_OK'] = 'Argent transferée.';
$lang['MONEY_AMMOUNT'] = 'Transfer le montant d\'argent.';
$lang['MONEY_AVAILABLE'] = 'Montant valide';
$lang['MONEY_TRANSFER'] = 'Montant à transferer';
$lang['MONEY_CHANGE'] = 'Changer';
$lang['MONEY_TWO_CHAR'] = 'Tu dois avoir au moins 2 characters.';
$lang['MONEY_TRANSFER_FROM'] = 'Transferer l\'argent de';
$lang['MONEY_TRANSFER_TO'] = 'Transferer l\'argent à';
$lang['MONEY_PS1'] = '*Il y aura un prix de %.2f%% du montant transferée pour cette fonction';
$lang['MONEY_SELECT'] = 'Select'; // TODO: translate

//marriage.php
$lang['MARRIAGE'] = 'Marriage';
$lang['MARRIAGE_COUPLE_OFF'] = 'Cette fonction peut selement être utilisée quand le couple est déconnecté. Votre partenaire est présentement connecté.';
$lang['MARRIAGE_DIVORCE_OK'] = 'Votre character est maintenant divorcé.';
$lang['MARRIAGE_NOTHING'] = 'Rien ne sera fait.';
$lang['MARRIAGE_PARTNER'] = 'Partenaire';
$lang['MARRIAGE_DIVORCE'] = 'Divorce';
$lang['MARRIAGE_SINGLE'] = 'Célibataire';
$lang['MARRIAGE_PS1'] = '*Vous devez être tous les deux déconnectés pour comfirmer le divorce';
$lang['MARRIAGE_PS2'] = '*Tu ne peux que changer un character à la foix';
$lang['MARRIAGE_PS3'] = '*You will be banned for 2 minutes to save the changes';

//ladder.php
$lang['LADDER_GUILD'] = 'Guild';
$lang['LADDER_TOP100'] = 'Ladder Top 100 Rang';
$lang['LADDER_STATUS'] = 'Status';
$lang['LADDER_STATUS_ON'] = 'On';
$lang['LADDER_STATUS_OFF'] = 'Off';

//guild.php
$lang['GUILD_TOP50'] = 'Top 50 Guild Ladder';
$lang['GUILD_EMBLEM'] = 'Emblem';
$lang['GUILD_GNAME'] = 'Guild Name';
$lang['GUILD_GLEVEL'] = 'Level';
$lang['GUILD_GEXPERIENCE'] = 'Experience';
$lang['GUILD_GAVLEVEL'] = 'Average Level';
$lang['GUILD_GCASTLES'] = 'Guild Castles';
$lang['GUILD_GCASTLE'] = 'Castle';
$lang['GUILD_MEMBERS'] = 'Membres';

//changemail.php
$lang['CHANGEMAIL_MAIL_INVALID'] = 'Nouveau email n\'est pas un email valid.';
$lang['CHANGEMAIL_CHANGEMAIL'] = 'Changer de E-Mail';
$lang['CHANGEMAIL_CHANGE'] = 'Changer';
$lang['CHANGEMAIL_NEW_MAIL'] = 'Neuveau e-mail';
$lang['CHANGEMAIL_CURRENT_MAIL'] = 'Courant e-mail';

//account.php
$lang['USERNAME_IN_USE'] = 'Nom d\'utilisateur déja utilisé.';
$lang['ABR_SEX_MALE'] = 'M';
$lang['ABR_SEX_FEMALE'] = 'F';
$lang['SEX_MALE'] = 'Male';
$lang['SEX_FEMALE'] = 'Femelle';
$lang['ACCOUNT_CREATED'] = 'Account Créée. Tu peux maintenant te connecter.';
$lang['ACCOUNT_PROBLEM'] = 'Erreur créer le compte, S\'il vous plait, essayer plus tard.';
$lang['INTERNAL_STATISTIC'] = '(pour statistiques internes)';
$lang['BIRTHDAY'] = 'Date de naissance (AAAAMMJJ)';
$lang['ACCOUNT_MAX_REACHED'] = 'There are too many accounts registered, please try again later.';

//index.php
$lang['NEW_ACCOUNT'] = 'Nouvel Account';
$lang['NEW_ACCOUNT_EXPL'] = 'Create a new account'; // TODO: translate
$lang['RECOVER_PASSWORD'] = 'Retrouver ton password';
$lang['RECOVER_PASSWORD_EXPL'] = 'Send the account info to your e-mail'; // TODO: translate

//links.php
$lang['LINKS_LINKS'] = 'Liens';
$lang['LINKS_NAME'] = 'Nom';

//login.php
$lang['LOGIN'] = 'Login'; // TODO: translate
$lang['LOGIN_WELCOME'] = 'Bienvenue';
$lang['LOGIN_HELLO'] = 'Bonjour';
$lang['LOGIN_REMEMBER'] = 'Ne pas oublier';
$lang['LOGOFF'] = 'Logoff'; // TODO: translate
$lang['LOGOFF_EXPL'] = 'Logoff the server and, if any, reset the cookies'; // TODO: translate

//about.php
$lang['ABOUT_ABOUT'] = 'À propos du server';
$lang['ABOUT_SERVER_NAME'] = 'Nom du server';
$lang['ABOUT_RATE'] = 'Rate';
$lang['ABOUT_TOTAL_ACCOUNTS'] = 'Accounts totales';
$lang['ABOUT_TOTAL_CHAR'] = 'Total des Characteres';
$lang['ABOUT_TOTAL_ZENY'] = 'Total des Zeny';
$lang['ABOUT_TOTAL_CLASS'] = 'Total par classes';
$lang['ABOUT_WOE_TIMES'] = 'Programmes de WoE'; //temp des WoE

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

