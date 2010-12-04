<?php

session_start();
include_once 'config.php'; // loads config variables
include_once 'query.php'; // imports queries
include_once 'functions.php';

if (!empty($_SESSION[$CONFIG_name.'account_id'])) {
    if ($_SESSION[$CONFIG_name.'account_id'] > 0) {

        if (!empty($GET_opt)) {

            if (is_online())
                redir("motd.php", "main_div", $lang['NEED_TO_LOGOUT_F']);

            if ($GET_opt == 1 && isset($GET_frm_name) && !strcmp($GET_frm_name, "sex_m")) {

                $query = sprintf(Z_SET_SEXM, $_SESSION[$CONFIG_name.'account_id']);
                $result = execute_query($query, 'changesex.php');
            }

            if ($GET_opt == 2 && isset($GET_frm_name) && !strcmp($GET_frm_name, "sex_f")) {

                $query = sprintf(Z_SET_SEXF, $_SESSION[$CONFIG_name.'account_id']);
                $result = execute_query($query, 'changesex.php');
            }

        }


    $query = sprintf(Z_GET_SEX, $_SESSION[$CONFIG_name.'account_id']);
    $result = execute_query($query, 'changesex.php');

    $csex = $result->fetch_row();

    opentable("Sex Changer");
        echo "
        <table width=\"504\">
        <tr>
            <td align=\"right\">
                <b>Current account sex</b>
            </td>
        ";
        if (!strcmp($csex[0], "M")) {
            echo "
                <td align=\"left\">
                    Male
                </td>";
        }

        if (!strcmp($csex[0], "F")) {
            echo "
                <td align=\"left\">
                    Female
                </td>";
        }

        echo "
        </tr>
        <tr>
            <td align=\"center\">
                <b>Change to...</b>
            </td>
            <td align=\"center\">
                <b>Change to...</b>
            </td>
        </tr>
        <tr>
            <td align=\"center\">
                <form id=\"sex_m\" onsubmit=\"return GET_ajax('changesex.php','main_div','sex_m')\">
                    <input type=\"hidden\" name=\"opt\" value=1>
                    <input type=\"submit\" value=\"Male\">
                </form>
            </td>
            <td align=\"center\">
                <form id=\"sex_f\" onsubmit=\"return GET_ajax('changesex.php','main_div','sex_f')\">
                    <input type=\"hidden\" name=\"opt\" value=2>
                    <input type=\"submit\" value=\"Female\">
                </form>
            </td>
        </tr>
        ";
    closetable();
    fim();
    }
}
redir("motd.php", "main_div", $lang['NEED_TO_LOGIN']);
?>