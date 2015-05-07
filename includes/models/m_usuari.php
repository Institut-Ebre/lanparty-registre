<?php
class Usuari extends Inici{
	var $usu_id;
	var $usu_dni;
	var $usu_nom;
	var $usu_cognom1;
	var $usu_cognom2;
	var $usu_nick;
	var $usu_correu;
	var $usu_pwd;
	var $data_registre;
	var $est_id;
	var $rol_id;
	
	
		
	function Usuari($usuar, $pass){
		//crida i instancia, crea així una connexió
		parent::Inici();
		//if ($pass==0 && $usuar==0){
			$this->set_usu_nick(@$usuar);
			$this->set_usu_pwd(@$pass);
		//}
		
	}
	
	function Usuari2(){
		//crida i instancia, crea així una connexió
		parent::Inicial();
	}
	
	
	function get_usu_id(){return $this->usu_id;}
	function get_usu_dni(){return $this->usu_dni;}
	function get_usu_nom(){return $this->usu_nom;}
	function get_usu_cognom1(){return $this->usu_cognom1;}
	function get_usu_cognom2(){return $this->usu_cognom2;}
	function get_usu_nick(){return $this->usu_nick;}
	function get_usu_correu(){return $this->usu_correu;}
	function get_usu_pwd(){return $this->usu_pwd;}
	function get_data_registre(){return $this->data_registre;}
	function get_est_id(){return $this->est_id;}
	function get_rol_id(){return $this->rol_id;}
	
	function set_usu_id($valor){$this->usu_id=$valor;}
	function set_usu_dni($valor){$this->usu_DNI=$valor;}
	function set_usu_nom($valor){$this->usu_nom=$valor;}
	function set_usu_cognom1($valor){$this->usu_cognom1=$valor;}
	function set_usu_cognom2($valor){$this->usu_cognom2=$valor;}
	function set_usu_nick($valor){$this->usu_nick=$valor;}
	function set_usu_correu($valor){$this->usu_correu=$valor;}
	function set_usu_pwd($valor){$this->usu_pwd=$valor;}
	function set_data_registre($valor){$this->data_registre=$valor;}
	function set_est_id($valor){$this->est_id=$valor;}
	function set_rol_id($valor){$this->rol_id=$valor;}
	
	function inicialitza($id){
		$this->usu_id=$id;
		if ($this->usu_id==0){
			$this->usu_dni="";
			$this->usu_nom="";
			$this->usu_cognom1="";
			$this->usu_cognom2="";
			$this->usu_nick="";
			$this->usu_correu="";
			$this->usu_pwd="";
			$this->data_registre="";
			$this->est_id=1;
			$this->rol_id=1;
			
		}
		else{
			$sql="select * from usuaris where usuaris.usu_id=".$this->usu_id;
			
			$rs=$this->db->db_Select($sql);
			$rs=$this->db->db_Fetch($rs);
			$this->usu_dni=$rs['usu_dni'];
			$this->usu_nom=$rs['usu_nom'];
			$this->usu_cognom1=$rs['usu_cognom1'];
			$this->usu_cognom2=$rs['usu_cognom2'];
			$this->usu_nick=$rs['usu_nick'];
			$this->usu_correu=$rs['usu_correu'];
			$this->usu_pwd=$rs['usu_pwd'];
			$this->data_registre=$rs['data_registre'];
			$this->est_id=$rs['est_id'];
			$this->rol_id=$rs['rol_id'];
		}
	}
	
	function llistat_usuari(){
		$sql="select * from usuaris";
		$rs=$this->db->db_Select($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$usu=new Usuari(0,0);
			$usu->inicialitza($rs2['usu_id']);
			$items[$i]=serialize($usu);
			$i=$i+1;
			}
		return $items;
	}
	
	function login(){
		//Buscar l'usuari
		$sql="SELECT COUNT( * ) FROM usuaris U WHERE U.usu_nick =  '".$this->get_usu_nick()."'" ;
		
		$rst = mysql_query($sql);
		$usuari= mysql_fetch_array($rst);
		if ($usuari[0] == 0){
			$u = 0;
			}
		else{
			$u = 1;
		}
		//Buscar la pass
		$sql="SELECT COUNT( * ) FROM usuaris U WHERE U.usu_pwd =  '".$this->get_usu_pwd()."'" ;
		
		$rst = mysql_query($sql);
		$password= mysql_fetch_array($rst);
		if ($password[0] == 0){
			$p = 0;
		}else {
			$p = 1;
		}
		
		//Si els dos són trobats fem la consulta completa
		$sql="SELECT * FROM usuaris WHERE usu_pwd =  '".$this->get_usu_pwd()."' AND usu_nick =  '".$this->get_usu_nick()."'" ;
		
		$rst = mysql_query($sql);
		$complet= mysql_fetch_assoc($rst);
		
		if ($complet['usu_id'] ==0){
			$c=0;
		}else{
			//retornar >= 0 == "OK"
			
			return 	($complet['usu_id']);
		}
		if ($p==0 && $u==0){
			//retornar 3 == "ususari i pass incorrecte"
			return -3;
		}elseif ($p==0){
			//retornar 2 == "password incorrecte"
			return -2;
		}else{
			//retornar 1 == "usuari incorrecte"
			return -1;	
		}		
	}
	
	
	function rol_usuari($id){
		$sql="SELECT rol_nom FROM rols WHERE rol_id='".$id."'";
		$rst = mysql_query($sql);
		$nom=  mysql_fetch_row($rst);
		return $nom[0];
	}
	
	function eliminar_usuari($id){
			$sql= "delete from usuaris where usu_id=".$id ;
			mysql_query($sql);
	}
	
	function modificar_usuari($id,$DNI,$nom,$cognom1,$cognom2,$nick,$correu,$pass){
		$sql= "update usuaris set usu_dni='".$DNI."', usu_nom='".$nom."', usu_cognom1='".$cognom1."', usu_cognom2='".$cognom2."', usu_nick='".$nick."', usu_correu='".$correu."', usu_pwd=md5('".$pass."') where usu_id=".$id ;  
		
		mysql_query($sql);
	}
	
	function modificar_usuari_sense_pwd($id,$DNI,$nom,$cognom1,$cognom2,$nick,$correu){
		$sql= "update usuaris set usu_dni='".$DNI."', usu_nom='".$nom."', usu_cognom1='".$cognom1."', usu_cognom2='".$cognom2."', usu_nick='".$nick."', usu_correu='".$correu."' where usu_id=".$id ;  
		
		mysql_query($sql);
	}
	
	function alta_usuari($DNI,$nom,$cognom1,$cognom2,$nick,$correu,$pass){
		$sql= "insert into usuaris (usu_dni,usu_nom,usu_cognom1,usu_cognom2,usu_nick,usu_correu,usu_pwd,rol_id)	values ".
		"('".$DNI."','".$nom."','".$cognom1."','".$cognom2."','".$nick."','".$correu."',md5('".$pass."'), 2)";
		mysql_query($sql);	
		
		return mysql_errno();
		
	}
	
	function combo() {
		$sql="select tus_id, tus_nom from tipus_usuari";
		$rs = mysql_query($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$items[$i]=array('tus_id'=>$rs2['tus_id'],'tus_nom'=>$rs2['tus_nom']);
			$i=$i+1;
			}
		return $items;
		}
		
	function validar_usuari($id){
		$sql="update usuaris set est_id=2 where usu_id=".$id;
		mysql_query($sql);
	}	
	
	function assignar_numero($idUsu, $idMot){
		$sql="insert into assigancions (usu_id, mot_id) values(".$idUsu.",".$idMot.")";		
		mysql_query($sql);
	}
	
	//** 2014 ***//
	
	function nom_usuari($usu_id){
		$sql="SELECT `usu_nom`, `usu_cognom1`, `usu_cognom2`, `usu_nick`  FROM `usuaris` WHERE `usu_id` = ".$usu_id." ";
		
		$rs = mysql_query($sql);
		$i=1;
		while($rs2=$this->db->db_Fetch($rs)){
			$items[$i]=array('usu_nom'=>$rs2['usu_nom'], 'usu_cognom1'=>$rs2['usu_cognom1'], 'usu_cognom2'=>$rs2['usu_cognom2'], 'usu_nick'=>$rs2['usu_nick']);
			$i=$i+1;
			}
		return $items;
		
		}	
	
}

?>			
