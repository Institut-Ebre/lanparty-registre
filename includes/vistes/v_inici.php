<?php
require_once "../../includes.php";
require_once "v_estils.php";
require_once "v_capsalera.php";

//CONTROLADOR


@$usu=$_GET['usu'];
@$rol=$_GET['rol'];
@$validar=$_GET['validar'];

	if ($usu==0){
		//header('Location:../vistes/v_login.php?usu=0');	
		//echo "Dins del controlador d'usuaris";
	}	//LOGUIN 
	elseif ($usu==1){
			//echo "Dins de usu==1";
			//Valors que ens venen del formulari v_login.php
			$nick=$_POST['nick'];
			$pass=md5($_POST['pass']);
			$usuari1 = new Usuari($nick,$pass);
			$retorn=$usuari1->login();
				
			/*	
			$fp = fopen("ejemplo.txt","a");
				fwrite($fp, "Retorn: $retorn" . PHP_EOL);
				fclose($fp);	
			*/
			/****************************
			
			positius -> ID.
			
			negatiu -> error de login.
			
			/***************************/
		
	
			if ($retorn >= 0){
				//echo "OK";
				session_name("login");
				session_start();
				$_SESSION['idUsuari'] = $retorn;
				?>
				<meta http-equiv="refresh" content="0;url=v_inici.php">
				<?php
				//header('Location:v_inici.php');
			}
			elseif ($retorn == -1){
				echo "usuari incorrecte";
				header('Location:../vistes/v_inici.php?usu=3');
			}
			elseif ($retorn==-2){
				echo "password incorrecte";
				header('Location:../vistes/v_inici.php?usu=4');
			}
			elseif ($retorn==-3){
				echo "usuari i password incorrecte";
				header('Location:../vistes/v_inici.php?usu=5');
			}
		}elseif ($usu==2){
			//tancar la sessió
			
			session_name("login");
			session_start();
			session_unset();
			session_destroy();
			header('Location:../vistes/v_inici.php');
			}	
		
	@$gestio=$_GET['gestio'];
	
	if (@$gestio==1){
		//Afegir usuari
		$nouDNI = $_POST['nouDNI'];
		$nouNom = $_POST['nouNom'];
		$nouCognom1 = $_POST['nouCognom1'];
		$nouCognom2 = $_POST['nouCognom2'];
		$nouNick = $_POST['nouNick'];
		$nouCorreu = $_POST['nouCorreu'];
		$nouPass = $_POST['nouPass'];
		$nouPass2 = $_POST['nouPass2'];
		$nouRol = $_POST['nouRol'];
		
		if ($nouPass != $nouPass2){
			header ('Location:v_registre.php?err=2');
		}else{
		
			$usuari2 = new Usuari(0,0);
			$retorn2=$usuari2->alta_usuari($nouDNI,$nouNom,$nouCognom1,$nouCognom2,$nouNick,$nouCorreu,$nouPass,$nouRsol);
		
			if ($retorn2==0){
				header ('Location:v_inici.php');
			}else{
				echo "Nick o Correu ia en ús.";
				header ('Location:v_registre.php?err=1');
			}		
		}
		
		
	}elseif(@$gestio==2){
		//Modificar usuari
		$id = $_POST['editId'];
		$editDNI = $_POST['editDNI'];
		$editNom = $_POST['editNom'];
		$editCognom1 = $_POST['editCognom1'];
		$editCognom2 = $_POST['editCognom2'];
		$editUser = $_POST['editUser'];
		$editCorreu = $_POST['editCorreu'];
		$editPass = $_POST['editPass'];
		$editPass2 = $_POST['editPass2'];
		
	
		$usuari3 = new Usuari(0,0);
		if ($_POST['editPass2']=="" && $_POST['editPass']==""){
			$usuari3->modificar_usuari_sense_pwd($id,$editDNI,$editNom,$editCognom1,$editCognom2,$editUser,$editCorreu);	
		}else{
			$usuari3->modificar_usuari($id,$editDNI,$editNom,$editCognom1,$editCognom2,$editUser,$editCorreu,$editPass);
		}
	}elseif(@$gestio==3){
		//Eliminar usuari
		@$idUsuari=$_GET['idUsuari'];
		
		$usuari2 = new Usuari(0,0);
		$usuari2->eliminar_usuari($idUsuari);
	}elseif(@$gestio==4){
		//Validar usuari
		@$idUsuari=$_GET['idUsuari'];
		
		$usuari2 = new Usuari(0,0);
		$usuari2->validar_usuari($idUsuari);
		header ("Location:../vistes/v_inici.php?qr=$idUsuari");
	}elseif(@$gestio==5){
		//Assignar numero
		@$idUsuari=$_GET['idUsuari'];
		@$assigMotiu=$_GET['assigMotiu'];
		$usuari2 = new Usuari(0,0);
		$usuari2->assignar_numero($idUsuari, $assigMotiu);
		header ("Location:../vistes/v_inici.php?qr=$idUsuari");
	}elseif(@$gestio==6){
		//Borrar un num. assignat
		@$idUsuari=$_GET['idUsuari'];
		@$numA = $_GET['numA'];
		$numBorrar = new Numeros();
		$numBorrar->borrar_num($numA);
		header ("Location:../vistes/v_inici.php?qr=$idUsuari");
	}elseif(@$gestio==7){
		//Assignar premi a un número
		@$idUsuari=$_GET['idUsuari'];
		@$assigPremi = $_GET['assigPremi'];
		@$assigNum = $_GET['assigNum'];
		$numPremiat = new Numeros();
		$numPremiat->assignar_premi($assigNum, $assigPremi);
		header ("Location:../vistes/v_inici.php");
	}elseif(@$gestio==8){
		//Borrar premi a un número
		
		@$idUsuari=$_GET['idUsuari'];
		@$numA = $_GET['numA'];
		$numBorrar = new Numeros();
		$numBorrar->borrar_premi($numA);
		if (isset($_GET['idUsuari'])){
				header ("Location:../vistes/v_inici.php?qr=$idUsuari");
			}else{
				header ('Location:v_premiats.php');
			}
		}
	
	
// VISTA

	
?>
<div data-role="content">	
	
   <?php 		//MIRAR SI HI HA UN USUARI O ADMINISTRADOR LOGUEJAT (DIFERENCIAR ENTRE ELS ROLS)
			   if (isset($_SESSION['idUsuari'])){
				   
				  @$idUsuari = $_SESSION['idUsuari']; 
				  $usuariLoguejat = new Usuari(0,0);
				  $usuariLoguejat->inicialitza($idUsuari);

					$nom=$usuariLoguejat->get_usu_nom();
					$cognom1=$usuariLoguejat->get_usu_cognom1();
					$rol=$usuariLoguejat->get_rol_id();
						//echo "<center> ".$usuariLoguejat->rol_usuari($rol).": ".$nom." ".$cognom1." </center>";
					
						//QUE MOSTREM SI ES UN ADMINISTRADOR ($rol == 1) 
					if ($rol==1){
						/* Si ets ADMINISTRADOR i acabes de llegir un QR o buscar un usuari mostra la info del usuari del QR */
						$usuari = new Usuari(0,0);
						$usuari->inicialitza($idUsuari);
						$rol=$usuari->get_rol_id();
		
						if (isset($_GET['num'])){
							$numVista=$_GET['num'];
							$num3= new Numeros();
							$usuari->inicialitza($num3->numero_pertany($numVista));
							$num3->inicialitza($numVista);
							echo "<h2>Número ".$numVista." assignat a:</h2>";
							echo "<p>".$usuari->get_usu_nom()." ".$usuari->get_usu_cognom1()." ".$usuari->get_usu_cognom2()."</p>";
								//Mirar si té un numero premiat
								$numero7 = new Numeros();
								$numeros7 = $numero7->llistat_numeros($usuari->get_usu_id());
								if ($numeros7){
									foreach($numeros7 as $num7){
										$numero7=unserialize($num7);
										if ($numero7->get_pre_id()!=1){
											echo "<p style=\"color:red\">USUARI PREMIAT</p>";
											}
									}
								}
								
								
							echo "<p>".$num3->get_data_assig()."</p>";
							echo "<p>".$num3->nom_motiu($num3->get_mot_id())."</p>";
							/*ASSIGNAR PREMI*/ ?>
							 <div data-role="collapsible" data-theme="b" data-content-theme="d" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
    							<h4>Assignar premi</h4>
    							<ul data-role="listview" data-inset="false">
        						<?php
                                $premi = new Premi();
								$premis=$premi->llistat_premis();
								
								if($premis){
									foreach($premis as $prem){
									$premi=unserialize($prem);
										if ($premi->get_pre_id()!=1){
										?>
											<li><a href="v_inici.php?gestio=7&idUsuari=<?=$usuari->get_usu_id()?>&assigPremi=<?=$premi->get_pre_id()?>&assigNum=<?=$num3->get_ass_numero()?>" ><?php echo $premi->get_pre_nom()." --> ".$premi->get_pre_empresa()?></a></li>
										<?php
										}
									}
								}
								?>
                               		
        						
   							    </ul>
							</div>
							<?php
							//////////////////////////////////////////////
						}elseif (isset($_GET['qr']) && $rol==1){
							@$idQR = $_GET['qr'];
							$usuari2 = new Usuari(0,0);
							$usuari2->inicialitza($idQR);
							//NAVBAR
							?>
							
    						<div data-role="navbar">
								<ul>
                                    <li><a href="v_form_editar.php?idUsuari=<?=$usuari2->get_usu_id()?>" data-theme="b">Modificar</a></li>	 	   
                                    <li><a href="#popupBorrar" data-rel="popup" data-position-to="window" data-inline="true" data-transition="pop"  data-theme="b">Esborrar</a></li>	
                                </ul>
        					</div><!-- /navbar -->
                           
                           <!-- ASSIGNAR NUMERO -->
                           
                           <div data-role="collapsible" data-theme="b" data-content-theme="d" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
    							<h4>Assignar número</h4>
    							<ul data-role="listview" data-inset="false">
        						<?php
                                $motiu = new Motiu();
								$motius=$motiu->llistat_motius();
								
								if($motius){
									foreach($motius as $mot){
									$motiu=unserialize($mot);
										?>
										<li><a href="v_inici.php?gestio=5&idUsuari=<?=$usuari2->get_usu_id()?>&assigMotiu=<?=$motiu->get_mot_id()?>" ><?php echo $motiu->get_mot_nom()?></a></li>
										<?php
									}
								}
								?>
                               		
        						
   							    </ul>
							</div>
							<?php
							////NAVBAR
							
							echo "<h1>Dades de l'usuari:</h1>";
							//echo "<b>ID del QR =</b> ".$idQR; 
		
							$nom=$usuari2->get_usu_nom();
							$cognom1=$usuari2->get_usu_cognom1();
							$cognom2=$usuari2->get_usu_cognom2();
							$rol=$usuari2->get_rol_id();
							echo " <br><b>Nom:</b> ".$nom." ".$cognom1." ".$cognom2." &nbsp;&nbsp;&nbsp;&nbsp; <b>Correu:</b> ".$usuari2->get_usu_correu()." &nbsp;&nbsp;&nbsp; <a href=\"mailto:".$usuari2->get_usu_correu()."\" >Contactar</a>";
							echo " <p><b>Hora registre:</b> ".$usuari2->get_data_registre()."</p>";
							if ($usuari2->get_est_id() == 1){
								echo "<a data-role=\"button\" href=\"v_inici.php?gestio=4&idUsuari=".$usuari2->get_usu_id()."\" >Validar</a>";	
							}else{
								echo "<a data-role=\"button\" class=\"ui-disabled\">Pagat</a>";
							}
							//Numeros de l'usuari
							$num2= new Numeros();
							$items=$num2->llistat_numeros($usuari2->get_usu_id());
				
							if ($items){
								$parell=0;
								?><center>
								<table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke">
                                  <thead>
                                    <tr>
                                      <th data-priority="6">Eliminar</th>	
                                      <th data-priority="persist">Número</th>
                                      <th data-priority="persist">Motiu</th>
                                      <th data-priority="2"><abbr title="Hora d'assiganció">Hora</abbr></th>
                                      <th data-priority="3">Premi</abbr></th>
                                      <th data-priority="4">Empresa</th>
                                      <th data-priority="5">Eliminar premi</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody><?php 
								
								foreach($items as $item){
									$num2=unserialize($item);
										
										?>
										<tr>
                                        	<th data-priority="6"><a href="v_inici.php?gestio=6&idUsuari=<?=$usuari2->get_usu_id()?>&numA=<?=$num2->get_ass_numero()?>" data-role="button" data-icon="delete" data-iconpos="notext"></a></th>
                                            <th data-priority="persist"><?=$num2->get_ass_numero()?></th>
                                            <th data-priority="persist"><?php echo $num2->nom_motiu($num2->get_mot_id())?></th>
                                            <th data-priority="2"><abbr title="Hora d'assiganció"><?=$num2->get_data_assig()?></abbr></th>
                                            <th data-priority="3"><?php if ($num2->get_pre_id()!=1){  echo $num2->nom_premi($num2->get_pre_id());} ?></abbr></th>
                                            <th data-priority="4"><?php if ($num2->get_pre_id()!=1){echo $num2->nom_empresa($num2->get_pre_id());} ?></th>
                                            <th data-priority="5"><?php if ($num2->get_pre_id()!=1){ ?><a data-role="button" data-icon="delete" data-iconpos="notext" href="v_inici.php?gestio=8&idUsuari=<?=$usuari2->get_usu_id()?>&numA=<?=$num2->get_ass_numero()?>"></a><?php } ?></th> 
                                        </tr><?php
										
									$parell++;
								} //tancar foreach
								?>
								</tbody>
								</table></center><?php

								
							} /*tancar if*/  else{
							echo "<center><h2>No té cap número assignat.</h2></center>";
							}	
							/**** POPUP CONFIRMACIÓ PER BORRAR UN USUARI **************************/
						?>
						<div data-role="popup" id="popupBorrar" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:400px;" class="ui-corner-all">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h1>Borrar usuari </h1>
    </div>
    <div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
        <h3 class="ui-title">Borrar l'usuari: <?=$usuari2->get_usu_nom()?> <?=$usuari2->get_usu_cognom1()?> <?=$usuari2->get_usu_cognom2()?> ?</h3>
        <p>Un cop borrat no hi ha volta atràs.</p>
        <a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Cancelar</a>
        <a href="v_inici.php?gestio=3&idUsuari=<?=$usuari2->get_usu_id()?>" data-role="button" data-inline="true" data-theme="b">Esborrar</a>
    </div></div><?php
						
						/****************************/
						
						}else{
							echo "<h3>Buscar usuari:</h3>";
						?>	
						<ul data-role="listview" data-inset="true" data-filter="true" data-filter-reveal="true" 	
                        data-filter-placeholder>
                        
                        <?php //******************* BUSCADOR *****************************/?>
                        
                        <?php
						$usuari6= new Usuari(0,0);
	 
						$items=$usuari6->llistat_usuari();
						if ($items){
							foreach($items as $item){
							$usuari6=unserialize($item);
						?>    
    
   							<li><a href="v_inici.php?qr=<?=$usuari6->get_usu_id()?>"><?=$usuari6->get_usu_nom()?> <?=$usuari6->get_usu_cognom1()?> <?=$usuari6->get_usu_cognom2()?></a></li>
      
							<?php 
							}
							?>
							</ul>
       						<?php
						}
						?>
      					<br><br>
                        <?php //*****************************************************************************/
      					
	                    echo "<h3>Buscar Numero:</h3>";
						?>	
						<ul data-role="listview" data-inset="true" data-filter="true" data-filter-reveal="true" 	
                        data-filter-placeholder>
                        
                        <?php //******************* BUSCADOR *****************************/?>
                        
                        <?php
						$numero6= new Numeros();
	 
						$nums=$numero6->llistat_tots_numeros();
						if ($nums){
							foreach($nums as $num){
							$numero6=unserialize($num);
			
			
						?>    
    
   							<li><a href="v_inici.php?num=<?=$numero6->get_ass_numero()?>"><?=$numero6->get_ass_numero()?> </a></li>
      
							<?php 
							}
							?>
							</ul>
       						<?php
						}
						?>
                        
						<?php	
						}
					
						//MOSTRAR EL PEU DE PÀGINA DE l'ADMIN
						require_once "v_peu_admin.php";
			  		}
						//ENTRA UN USUARI NORMAL
					if ($rol==2){
						//echo "Hola Usuari";
						
						// MOSTRAR O EL CODI QR O ELS NUMEROS DEL USUARI CONNECTAT
						if (@$_GET['num']!="y"){
							
							//** 2014 **//
						?>
						
						
						<a data-role="button" href="v_inscri_competicions.php" data-corners="false" data-theme="b" data-icon="alert" data-c>Inscripció a competicions</a>
						
						
						<?php
						//** **//
							echo "<center><p><b>Usuari: </b>".$usuariLoguejat->get_usu_nom()." ".$usuariLoguejat->get_usu_cognom1()."</p></center>";
							echo "<center><img class=\"popphoto\" src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3a%2f%2flanparty.iesebre.com/registre/includes/vistes/v_inici.php?qr=".$idUsuari."\" style=\"max-height:512px;\"></center>";
							
							// si no està l'usuari VALIDAT avís de passar per un administrador a validar-se.
							if ($usuariLoguejat->get_est_id()==1){
								echo "<center>";
								echo "<p style=\"color:red\">Contacta amb un encarregat per validar el teu compte.</p>";
								echo "</center>"; 
							}
							
						}else{
							?>
							<ul data-role="listview" data-theme="a" >
            				<li data-theme="b"><center>Números per al sorteig</center></li>

							<?php
							$num= new Numeros();
	 						$items=$num->llistat_numeros($_SESSION['idUsuari']);
								if ($items){
									$parell=0;
									foreach($items as $item){
										$num=unserialize($item);
										if ($parell%2==0){	
											?>    
            								<li style="background:#999"><center><font style="color:#FF0"><?=$num->get_ass_numero()?><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;  Motiu:    ".$num->nom_motiu($num->get_mot_id()) ?></font></center></li>
            								<?php
										}else{
											?>	
											<li style="background:#666"><center><font style="color:#FF0"><?=$num->get_ass_numero()?><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;  Motiu:    ".$num->nom_motiu($num->get_mot_id()) ?></font></center></li>
            		          				<?php
										}//tancar else
										$parell++;
									} //tancar foreach
								} /*tancar if*/  else{
								echo "<center><h2>No tens cap número assignat encara</h2></center>";
							}
						}
						//MOSTRAR EL PEU DE PÀGINA DE l'USUARI
						require_once "v_peu_usuari.php";
					}	
					
			   }
			  
			   if(!isset($_SESSION['idUsuari'])){
	?>		   
    
    
	<div align="center" >
    	<h2>Benvingut a la LAN Party.</h2>
    	<p>Introdueix usuari:</p>
     	<div>
            	<p style="text-decoration:underline"><font color="#FF0000"><b>
					<?php
					if ($usu==3){
						echo "<font color=red ><h4>L'usuari és incorrecte</h4></font>";
					}
					if ($usu==4){
						echo "<font color=red ><h4>La clau és incorrecta</h4></font>";
					}if ($usu==5){	
						echo "<font color=red ><h4>Ni usuari ni clau correctes</h4></font>";
					}
			   }
			   
			   if(!isset($_SESSION['idUsuari'])){
					?>
                </b></font></p>
        </div>  

        <form action="v_inici.php?usu=1" method="post" name="formulari">
             
            <div>
            	<!-- Introduïr el nickname -->
              <label for="nick" class="ui-hidden-accessible">Nickname:</label>
              <input type="text" name="nick" id="nick" value="" placeholder="Nickname" data-theme="a" required>
              	<!-- CAMP DE LA CLAU DE PAS -->
              <label for="pass" class="ui-hidden-accessible">Password:</label>
              <input type="password" name="pass" id="pass" value="" placeholder="Password" data-theme="a" required>
            </div>   
           
            <!-- Realitzar el registre del nou usuari -->
        	<input type="submit"  data-theme="b" data-corners="false" data-icon="check" value="Accedir">              
        </div>   
            
      <center> <h3>Si encara no us heu registrat accedir a:</h3> </center>
       
       <a data-role="button" href="v_registre.php" data-corners="false" data-theme="b" data-icon="plus" data-c>Registrar-se</a>
</div>
 		</form>
        <?php
			   }
		?>
       
