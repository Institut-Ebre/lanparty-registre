<?php
class Numeros extends Inici{
	var $ass_numero;
	var $usu_id;
	var $mot_id;
	var $data_assig;
	var $pre_id;
	
	function Numeros(){
		//crida i instancia, crea així una connexió
		parent::Inici();
		}
	
	function get_ass_numero(){return $this->ass_numero;}
	function get_usu_id(){return $this->usu_id;}
	function get_mot_id(){return $this->mot_id;}
	function get_data_assig(){return $this->data_assig;}
	function get_pre_id(){return $this->pre_id;}	
	
	
	
	function set_ass_numero($valor){$this->ass_numero=$valor;}
	function set_usu_id($valor){$this->usu_id=$valor;}
	function set_mot_id($valor){$this->mot_id=$valor;}
	function set_data_assig($valor){$this->data_assig=$valor;}
	function set_pre_id($valor){$this->pre_id=$valor;}
	
	
	
	function inicialitza($numero){
		$this->ass_numero=$numero;
		if ($this->ass_numero==0){
			$this->usu_id="";
			$this->mot_id="";
			$this->data_assig="";
			$this->pre_id=0;
			}
		else{
			$sql="select * from assigancions where (ass_numero=".$this->ass_numero.")";
							
			$rs=$this->db->db_Select($sql);
			$rs=$this->db->db_Fetch($rs);
			$this->usu_id=$rs['usu_id'];
			$this->ass_numero=$rs['ass_numero'];
			$this->mot_id=$rs['mot_id'];
			$this->data_assig=$rs['data_assig'];
			$this->pre_id=$rs['pre_id'];
		}
	}
	
	function llistat_numeros($usuari){
		$sql="select * from assigancions where usu_id =".$usuari."";
		
		
		
		$rs=$this->db->db_Select($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$num=new Numeros();
			$num->inicialitza($rs2['ass_numero']);
			$items[$i]=serialize($num);
			$i=$i+1;
			}
			
		return @$items;
		}
	
	function llistat_tots_numeros(){
		$sql="select * from assigancions";
		
		$rs=$this->db->db_Select($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$num=new Numeros();
			$num->inicialitza($rs2['ass_numero']);
			$items[$i]=serialize($num);
			$i=$i+1;
			}
			
		return @$items;
		}
	
	function nom_premi($id){
		$sql="select * from premis where pre_id=".$id."";
		
		$rst = mysql_query($sql);
		$items= mysql_fetch_array($rst);
	
		return $items[1];
	}
	
	function nom_empresa($id){
		$sql="select * from premis where pre_id=".$id."";
		
		$rst = mysql_query($sql);
		$items= mysql_fetch_array($rst);
	
		return $items[2];
	}
	
	function nom_motiu($id){
		$sql="select * from motius where mot_id=".$id."";
		
		$rst = mysql_query($sql);
		$items= mysql_fetch_array($rst);
	
		return $items[1];
	}
	
	function borrar_num($num){
		$sql="delete from assigancions where ass_numero=".$num."";
		
		mysql_query($sql);	
	
	}
	
	function numero_pertany($num){
		$sql="select usu_id from assigancions where ass_numero=".$num."";
		
		$rst = mysql_query($sql);
		$items= mysql_fetch_array($rst);
	
		return $items[0];
		}
		
	function nom_usuari($num){
		$sql="select usu_nom, usu_cognom1, usu_cognom2 from usuaris where usu_id=".$num."";
		$rst = mysql_query($sql);
		$items= mysql_fetch_array($rst);
		return $items[0]." ".$items[1]." ".$items[2];
	}
	
	function assignar_premi($num, $premi){
		$sql="update assigancions set pre_id=".$premi." where ass_numero=".$num."";
		
		mysql_query($sql);
		}
		
	function borrar_premi($num){
		$sql="update assigancions set pre_id= 1  where ass_numero=".$num."";			
		
		mysql_query($sql);
	}
	
	//** 2014 **//
	
	function num_max(){
		$sql="select MAX(ass_numero) from assigancions";
		
		$rst = mysql_query($sql);
		$items= mysql_fetch_array($rst);
	
		return $items[0];
		
		}
	
	

}
	
?>
