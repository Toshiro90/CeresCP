<?php
session_start();
include_once './config.php'; // loads config variables
include_once './query.php'; // imports queries
include_once './functions.php';

if (!empty($_SESSION[$CONFIG_name.'account_id'])) {
    if ($_SESSION[$CONFIG_name.'account_id'] > 0) {

        if (!empty($GET_opt)) {

            if (is_online())
                redir("motd.php", "main_div", "You cannot change the name of your chars if you are online..");

            if ($GET_opt == 1) {

                if (checkName($GET_Nnombre))
                    alert("There are some characters in the name that are not allowed.");

                if (strlen(trim($GET_Nnombre)) < 1 || strlen(trim($GET_Nnombre)) > 24)
                    alert("Wrong size of name.");

                $query = sprintf(Z_NAME_COUNT, $GET_GID1);
                $result = execute_query($query, 'changename.php');

                if ($result->count())
                    alert("You cannot change the name of your char more than three times.");

                $query = sprintf(Z_CHECK_NAME, trim($GET_Nnombre));
                $result = execute_query($query, 'changename.php');

                if ($result->count())
                    alert("That name is allready in use.");

                $query = sprintf(Z_CHECK_CHAR, $GET_GID1);
                $result = execute_query($query, 'changename.php');

                if ($result->count())
                    alert("You cannot change the name of a char in guild or party.");

                $query = sprintf(Z_LOG_CHANGENAME, $GET_oldname, trim($GET_Nnombre));
                $result = execute_query($query, 'changename.php');

                $query = sprintf(Z_CHANGE_NAME_1, trim($GET_Nnombre), $GET_GID1);
                $result = execute_query($query, 'changename.php');

                // $query = sprintf(Z_CHANGE_NAME_2, trim($GET_Nnombre), $GET_GID1);
                // $result = execute_query($query, 'changename.php');

                // $query = sprintf(Z_CHANGE_NAME_3, trim($GET_Nnombre), $GET_GID1);
                // $result = execute_query($query, 'changename.php');

                $query = sprintf(Z_CHANGE_NAME_4, trim($GET_Nnombre), $GET_oldname);
                $result = execute_query($query, 'changename.php');

                $query = sprintf(Z_CHANGE_NAME_5, trim($GET_Nnombre), $GET_oldname);
                $result = execute_query($query, 'changename.php');

            }

        }


    $query = sprintf(GET_SLOT, $_SESSION[$CONFIG_name.'account_id']);
    $result = execute_query($query, "changename.php");

    if ($result->count() < 0)
            redir("motd.php", "main_div", "You don't have chars in this account");

    opentable("Name Changer - (requires to have no guild or party)");
        echo "
        <table width=\"504\">
        <tr>
            <td align=\"left\" class=\"head\">
                Slot
            </td>
            <td align=\"left\" class=\"head\">
                Current Name
            </td>
            <td align=\"center\" class=\"head\">
                New Name
            </td>
            <td align=\"right\" class=\"head\">
                Change counter
            </td>
        ";
        while ($line = $result->fetch_row()) {
            $GID = $line[0];
            $slot = $line[1];
            $cambios = 3 - $line[3];
            $charname = htmlformat($line[2]);
            echo "
                <tr>
                    <td align=\"left\">$slot</td>
                    <td align=\"left\">$charname</td>
                    <td align=\"center\">
                        <form id=\"ranura$slot\" onsubmit=\"return GET_ajax('changename.php','main_div','ranura$slot')\">
                            <input type=\"text\" name=\"Nnombre\"maxlength=\"24\" size=\"24\" onKeyPress=\"return force(this.name,this.form.id,event);\">
                            <input type=\"submit\" value=\"Change\">
                            <input type=\"hidden\" name=\"opt\" value=\"1\">
                            <input type=\"hidden\" name=\"GID1\" value=\"$GID\">
                            <input type=\"hidden\" name=\"oldname\" value=\"$charname\">
                        </form>
                    </td>
                    <td align=\"right\">$cambios</td>
                </tr>
            ";
        }
    closetable();
    fim();
    }
}
redir("motd.php", "main_div", $lang['NEED_TO_LOGIN']);
?>