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

class ResultClass {
	var $result;
	var $row;

	function ResultClass($arg1) {
		$this->row = FALSE;
		$this->result = $arg1;
	}

	function fetch_row() {
		if ($this->result !== TRUE && $this->result !== FALSE)
			$this->row = mysqli_fetch_row($this->result);
		else
			$this->row = FALSE;
		return $this->row;
	}

	function count() {
		if ($this->result)
			return mysqli_num_rows($this->result);
		return 0;
	}

	function row($pos) {
		if (isset($this->row[$pos]))
			return $this->row[$pos];
		return FALSE;
	}

	function free() {
		if (empty($this->result))
			return;
		if ($this->result !== TRUE && $this->result !== FALSE)
			mysqli_free_result($this->result);
	}

}

class QueryClass {
	var $rag_table;
	var $cp_table;
	var $link;
	var $result;

	function QueryClass($db_addr, $db_username, $db_password, $rag, $cp) {
		global $lang;

		$this->rag_table = $rag;
		$this->cp_table = $cp;

		$this->link = mysqli_connect($db_addr,$db_username,$db_password) or die($lang['DB_ERROR']);
	}

	function Query($query, $table = 0) {
		global $lang;

		if ($table)
			mysqli_select_db($this->link,$this->cp_table) or die ($lang['DB_ERROR']);
		else
			mysqli_select_db($this->link,$this->rag_table) or die ($lang['DB_ERROR']);
		
		$this->result = mysqli_query($this->link, $query);

		if (strpos($query,"SELECT") === 0)
			return new ResultClass($this->result);

		if ($this->result === FALSE)
			return FALSE;

		return TRUE;
	}

	function finish() {
		if (empty($this->result))
			return;
		if ($this->result !== TRUE && $this->result !== FALSE)
			mysqli_free_result($this->result);
	}
}

?>
