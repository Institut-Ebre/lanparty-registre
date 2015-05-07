<?php
class Premi extends Inici{
	var $pre_id;
	var $pre_nom;
	var $pre_empresa;
	
	function Premi(){
		//crida i instancia, crea així una connexió
		parent::Inici();
		}
	
	function get_pre_id(){return $this->pre_id;}
	function get_pre_nom(){return $this->pre_nom;}
	function get_pre_empresa(){return $this->pre_empresa;}
		
	
	function set_pre_id($valor){$this->pre_id=$valor;}
	function set_pre_nom($valor){$this->pre_nom=$valor;}
	function set_pre_empresa($valor){$this->pre_empresa=$valor;}
	
	function inicialitza($premi){
		$this->pre_id=$premi;
		if ($this->pre_id==0){
			$this->pre_nom="";
			$this->pre_empresa="";
			}
		else{
			$sql="select * from premis where (pre_id=".$this->pre_id.")";
							
			$rs=$this->db->db_Select($sql);
			$rs=$this->db->db_Fetch($rs);
			$this->pre_id=$rs['pre_id'];
			$this->pre_nom=$rs['pre_nom'];
			$this->pre_empresa=$rs['pre_empresa'];
		}
	}
	
	function llistat_premis(){
		$sql="select * from premis";
		
		$rs=$this->db->db_Select($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$num=new Premi();
			$num->inicialitza($rs2['pre_id']);
			$items[$i]=serialize($num);
			$i=$i+1;
			}
			
		return @$items;
		}
	
}
	
?>