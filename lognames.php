<?php

session_start();
include_once 'config.php'; // loads config variables
include_once 'query.php'; // imports queries
include_once 'functions.php';

if (!empty($GET_opt)) $query = sprintf(Z_GET_LOGNAMEX, $GET_buscar, $GET_buscar);
else $query = sprintf(Z_GET_LOGNAME);

$result = execute_query($query, "lognames.php");

opentable("Change name Log");
echo "
    <table>
        <tr>
            <td align=\"center\" class=\"head\">
                Search for a name
            </td>
        </tr>
        <tr>
            <td align=\"center\">
                <form id=\"busqueda\" onsubmit=\"return GET_ajax('lognames.php','main_div','busqueda')\">
                    <input type=\"text\" name=\"buscar\"maxlength=\"24\" size=\"24\" onKeyPress=\"return force(this.name,this.form.id,event);\">
                    <input type=\"hidden\" name=\"opt\" value=1>
                    <input type=\"submit\" value=\"Search\">
                </form>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td align=\"left\" class=\"head\">Date|Time</td>
            <td align=\"center\" class=\"head\"> | </td>
            <td align=\"left\" class=\"head\">Old Name</td>
            <td align=\"center\" class=\"head\"> | </td>
            <td align=\"left\" class=\"head\">New Name</td>
        </tr>
";
if ($result) {
    while ($line = $result->fetch_row()) {
        $old_name = htmlformat($line[0]);
        $new_name = htmlformat($line[1]);
        $fecha = htmlformat($line[2]);

        echo "
            <tr>
                <td align=\"left\">$fecha</td>
                <td align=\"center\" class=\"head\"> | </td>
                <td align=\"left\">$old_name</td>
                <td align=\"center\" class=\"head\"> | </td>
                <td align=\"left\">$new_name</td>
            </tr>
        ";
    }
}
echo "</table>";
closetable();
fim();
?>