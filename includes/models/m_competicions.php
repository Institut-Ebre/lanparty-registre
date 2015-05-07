<?php
class Competicions extends Inici{
	var $comp_id;
	var $usu_id;
	var $comp_grup_id;
	var $comp_grup_nom;
	var $comp_grup_validat;
	
	function Competicions(){
		//crida i instancia, crea així una connexió
		parent::Inici();
		}
	
	function get_comp_id(){return $this->comp_id;}
	function get_usu_id(){return $this->usu_id;}
	function get_comp_grup_id(){return $this->comp_grup_id;}
	function get_comp_grup_nom(){return $this->comp_grup_nom;}
	function get_comp_grup_validat(){return $this->comp_grup_validat;}

	
	
	function set_comp_id($valor){$this->comp_id=$valor;}
	function set_usu_id($valor){$this->usu_id=$valor;}
	function set_comp_grup_id($valor){$this->comp_grup_id=$valor;}	
	function set_comp_grup_nom($valor){$this->comp_grup_nom=$valor;}
	function set_comp_grup_validat($valor){$this->comp_grup_validat=$valor;}

	
	function inicialitza($competicio){
		$this->comp_id=$competicio;
		if ($this->comp_id==0){
			$this->usu_id="";
			$this->comp_grup_id="";
			$this->comp_grup_nom="";
			$this->comp_grup_validat="";			
			}
		else{
			$sql="select * from competicions where (comp_id=".$this->comp_id.")";
							
			$rs=$this->db->db_Select($sql);
			$rs=$this->db->db_Fetch($rs);
			$this->comp_id=$rs['comp_id'];
			$this->usu_id=$rs['usu_id'];
			$this->comp_grup_id=$rs['comp_grup_id'];
			$this->comp_grup_nom=$rs['comp_grup_nom'];
			$this->comp_grup_validat=$rs['comp_grup_validat'];
		}
	}

	function afegir_inscrit($comp_id, $usu_id, $comp_grup_nom){
		
		//Si la variable $comp_grup_nom == individual  el nom del grups és el nom del usuari
		if ($comp_grup_nom == "individual"){
			
			$sql="insert into `lanparty_registre`.`competicions` (`comp_id` ,`usu_id` ,`comp_grup_id` ,`comp_grup_nom` ,`comp_grup_validat`) values ('".$comp_id."', '".$usu_id."', (select * from (select max(`comp_grup_id`)+1 from competicions where `comp_id` = ".$comp_id.") as t),  (select  CONCAT(usu_nom, ' ', (select usu_cognom1 from usuaris where usu_id=".$usu_id."), ' ', (select usu_cognom2 from usuaris where usu_id=".$usu_id.")) from usuaris where usu_id=".$usu_id." ), '0' ); ";

			mysql_query($sql);
		}elseif ($comp_grup_nom == "grup"){
			
			$sql="insert into `lanparty_registre`.`competicions` (`comp_id` ,`usu_id` ,`comp_grup_id` ,`comp_grup_nom` ,`comp_grup_validat`) values ('".$comp_id."', '".$usu_id."', (select * from (select max(`comp_grup_id`)+1 from competicions where `comp_id` = ".$comp_id.") as t),  '".$_SESSION['nomGrup']."', '0' ), ('".$comp_id."', '".$_SESSION['membre2']."', (select * from (select max(`comp_grup_id`)+1 from competicions where `comp_id` = ".$comp_id.") as t),  '".$_SESSION['nomGrup']."', '0' ), ('".$comp_id."', '".$_SESSION['membre3']."', (select * from (select max(`comp_grup_id`)+1 from competicions where `comp_id` = ".$comp_id.") as t),  '".$_SESSION['nomGrup']."', '0' ), ('".$comp_id."', '".$_SESSION['membre4']."', (select * from (select max(`comp_grup_id`)+1 from competicions where `comp_id` = ".$comp_id.") as t),  '".$_SESSION['nomGrup']."', '0' ), ('".$comp_id."', '".$_SESSION['membre5']."', (select * from (select max(`comp_grup_id`)+1 from competicions where `comp_id` = ".$comp_id.") as t),  '".$_SESSION['nomGrup']."', '0' ); ";
			

			mysql_query($sql);
		};
		
	}
	function consulta_usuari_inscrit($comp, $usuari){
		
		$sql="SELECT ".$usuari." FROM competicions WHERE comp_id = ".$comp." AND usu_id = ".$usuari." "; 
		
		$rst = mysql_query($sql);
		$nom=  mysql_fetch_row($rst);
		return $nom[0];
		
	}

	function inscrits_comp($comp_id){
		$sql="SELECT `comp_grup_nom`, comp_grup_validat FROM `competicions` WHERE `comp_id` = ".$comp_id."";
		
		$rs = mysql_query($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$items[$i]=array('comp_grup_nom'=>$rs2['comp_grup_nom'],'comp_grup_validat'=>$rs2['comp_grup_validat']);
			$i=$i+1;
			}
		return $items;
		
		}

	function inscrits_comp_grup($comp_id){
		$sql="SELECT `comp_grup_id` FROM `competicions` WHERE `comp_id` = ".$comp_id." group by comp_grup_id";
		
		$rs = mysql_query($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$items[$i]=array('comp_grup_id'=>$rs2['comp_grup_id']);
			$i=$i+1;
			}
		return $items;
		
		}
		
		
	function nom_grup($comp_grup_id){
		$sql="SELECT `comp_grup_nom` FROM `competicions` WHERE `comp_grup_id` = ".$comp_grup_id." and comp_id = 1 group by comp_grup_nom";
		
		$rs = mysql_query($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$items[$i]=array('comp_grup_nom'=>$rs2['comp_grup_nom']);
			$i=$i+1;
			}
		return $items;
		
		}	
		
	function membres_grup($comp_grup_id){
		$sql="SELECT `usu_id` FROM `competicions` WHERE `comp_grup_id` = ".$comp_grup_id." and comp_id = 1 ";
		
		$rs = mysql_query($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$items[$i]=array('usu_id'=>$rs2['usu_id']);
			$i=$i+1;
			}
		return $items;
		
		}	

}
	
?>
