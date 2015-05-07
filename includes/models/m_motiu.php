<?php
class Motiu extends Inici{
	var $mot_id;
	var $mot_nom;
	
	function Motiu(){
		//crida i instancia, crea així una connexió
		parent::Inici();
		}
	
	function get_mot_id(){return $this->mot_id;}
	function get_mot_nom(){return $this->mot_nom;}
		
	
	function set_mot_id($valor){$this->mot_id=$valor;}
	function set_mot_nom($valor){$this->mot_nom=$valor;}
	
	function inicialitza($motiu){
		$this->mot_id=$motiu;
		if ($this->mot_id==0){
			$this->mot_nom="";
			}
		else{
			$sql="select * from motius where (mot_id=".$this->mot_id.")";
							
			$rs=$this->db->db_Select($sql);
			$rs=$this->db->db_Fetch($rs);
			$this->mot_id=$rs['mot_id'];
			$this->mot_nom=$rs['mot_nom'];
		}
	}
	
	function llistat_motius(){
		$sql="select * from motius";
		
		$rs=$this->db->db_Select($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$num=new Motiu();
			$num->inicialitza($rs2['mot_id']);
			$items[$i]=serialize($num);
			$i=$i+1;
			}
			
		return @$items;
		}
	
}
	
?>