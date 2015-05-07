<?php
class Inici {
	var $db;
	
	function Inici(){
		$this->db=new Connexio();
		$this->db->db_open();
		}
		
}

?>