<?php
require_once "../../includes.php";
require_once "v_estils.php";
require_once "v_capsalera.php";


@$comp=$_GET['comp'];
@$comp_lol=$_GET['comp_lol'];


//Inscriure usuari a la competició "League Of Legends" AMD ID --->  1  <-----

if ($comp == "lol"){
	
	
	if ($comp_lol=="form1"){
		?>
		
		<div data-role="content" id="programa">
		
		<h1> Inscripció League Of Legends (Nom del grup): </h1> 
		<form action="v_inscripcio_comp.php?comp=lol&comp_lol=form2" method="post" name="formulari">
             
            <div>
            	<!-- CAMP NOM DEL GRUP -->
              <label for="nomGrup" class="ui-hidden-accessible">Nom del grup:</label>
              <input type="text" name="nomGrup" id="nomGrup" value="" placeholder="Nom del grup" data-theme="a" required>
          
            </div>   
 			<button type="button" data-theme="b" data-icon="back" onclick="history.back()">Cancelar</button>
            <input type="submit" value="Següent" data-theme="b"  data-corners="false" data-icon="check"></li>
		
        </form>  
        <?php
        
      }elseif ($comp_lol=="form2"){
        
			$_SESSION['nomGrup']=$_POST['nomGrup'];
			
          ?>
		
		<div data-role="content" id="programa">
		<!--<?=$_SESSION['nomGrup'];?>-->
		<h1> Inscripció League Of Legends (1r membre): </h1> 
		<form action="v_inscripcio_comp.php?comp=lol&comp_lol=form3" method="post" name="formulari2">
             
            <div>
            		<!-- CAMP DEL 1r MEMBRE -->
              <?php	
                  @$idUsuari = $_SESSION['idUsuari']; 
				  $usuariLoguejat = new Usuari(0,0);
				  $usuariLoguejat->inicialitza($idUsuari);

					$nom=$usuariLoguejat->get_usu_nom();
					$cognom1=$usuariLoguejat->get_usu_cognom1();
					$cognom2=$usuariLoguejat->get_usu_cognom2();	
              ?>	
              	
              <label for="Membre1" class="ui-hidden-accessible">Nom:</label>
              <input type="text" name="Membre1" id="Membre1" readonly value="<?=$nom?> <?=$cognom1?> <?=$cognom2?>" placeholder="1r membre" data-theme="a" required>
              
            </div>   
 			<button type="button" data-theme="b" data-icon="back" onclick="history.back()">Atras</button>
            <input type="submit" value="Següent" data-theme="b"  data-corners="false" data-icon="check"></li>
		
        </form>  
        <?php
          
          
	  }elseif ($comp_lol=="form3"){
		  
 			
		?>
		
		<div data-role="content" id="programa">
		
		<!--<?=$_SESSION['idUsuari'];?> --><br> <br>
		  <!-- CAMP DEL 2n MEMBRE -->
		  <h1> Inscripció League Of Legends (2n membre): </h1> 
           <label for="Membre2" class="ui-hidden-accessible">Nom:</label>
              <ul data-role="listview" data-inset="true" data-filter="true" data-filter-reveal="true"   data-filter-placeholder>
               <?php //******************* BUSCADOR *****************************/?>

                        
                        <?php
						$usuari6= new Usuari(0,0);
	 
						$items=$usuari6->llistat_usuari();
						if ($items){
							foreach($items as $item){
							$usuari6=unserialize($item);
						?>    
    
   							<li><a href="v_inscripcio_comp.php?comp=lol&comp_lol=form4&membre=<?=$usuari6->get_usu_id()?>"><?=$usuari6->get_usu_nom()?> <?=$usuari6->get_usu_cognom1()?> <?=$usuari6->get_usu_cognom2()?></a></li>
      
							<?php 
							}
							?>
							</ul>
       						<?php
						}
						?>
      					<br><br>
                        <?php //*****************************************************************************/
      					
	                    
		        
	  }elseif ($comp_lol=="form4"){
		
		
			$_SESSION['membre2']=$_GET['membre'];
		?>
		
		
		<div data-role="content" id="programa">
		
		<!--<?=$_SESSION['membre2'];?>--> <br> <br>
		  <!-- CAMP DEL 3r MEMBRE -->
		  <h1> Inscripció League Of Legends (3r membre): </h1>
           <label for="Membre3" class="ui-hidden-accessible">Nom:</label>
              <ul data-role="listview" data-inset="true" data-filter="true" data-filter-reveal="true"   data-filter-placeholder>
               <?php //******************* BUSCADOR *****************************/?>

                        
                        <?php
						$usuari6= new Usuari(0,0);
	 
						$items=$usuari6->llistat_usuari();
						if ($items){
							foreach($items as $item){
							$usuari6=unserialize($item);
						?>    
    
   							<li><a href="v_inscripcio_comp.php?comp=lol&comp_lol=form5&membre=<?=$usuari6->get_usu_id()?>"><?=$usuari6->get_usu_nom()?> <?=$usuari6->get_usu_cognom1()?> <?=$usuari6->get_usu_cognom2()?></a></li>
      
							<?php 
							}
							?>
							</ul>
       						<?php
						}
						?>
      					<br><br>
                        <?php //*****************************************************************************/
      					
	                    
		  
		  
	  }elseif ($comp_lol=="form5"){

		  
		
			$_SESSION['membre3']=$_GET['membre'];
		?>
		
		
		<div data-role="content" id="programa">
		
		<!--<?=$_SESSION['membre3'];?>--> <br> <br>
		  <!-- CAMP DEL 4t MEMBRE -->
		  <h1> Inscripció League Of Legends (4t membre): </h1>
           <label for="Membre4" class="ui-hidden-accessible">Nom:</label>
              <ul data-role="listview" data-inset="true" data-filter="true" data-filter-reveal="true"   data-filter-placeholder>
               <?php //******************* BUSCADOR *****************************/?>

                        
                        <?php
						$usuari6= new Usuari(0,0);
	 
						$items=$usuari6->llistat_usuari();
						if ($items){
							foreach($items as $item){
							$usuari6=unserialize($item);
						?>    
    
   							<li><a href="v_inscripcio_comp.php?comp=lol&comp_lol=form6&membre=<?=$usuari6->get_usu_id()?>"><?=$usuari6->get_usu_nom()?> <?=$usuari6->get_usu_cognom1()?> <?=$usuari6->get_usu_cognom2()?></a></li>
      
							<?php 
							}
							?>
							</ul>
       						<?php
						}
						?>
      					<br><br>
                        <?php //*****************************************************************************/
      					
		  
	  }elseif ($comp_lol=="form6"){


			$_SESSION['membre4']=$_GET['membre'];
		?>
		
		
		<div data-role="content" id="programa">
		
		<!--<?=$_SESSION['membre4'];?>--> <br> <br>
		  <!-- CAMP DEL 5e MEMBRE -->
		  <h1> Inscripció League Of Legends (5é membre): </h1>
           <label for="Membre5" class="ui-hidden-accessible">Nom:</label>
              <ul data-role="listview" data-inset="true" data-filter="true" data-filter-reveal="true"   data-filter-placeholder>
               <?php //******************* BUSCADOR *****************************/?>

                        
                        <?php
						$usuari6= new Usuari(0,0);
	 
						$items=$usuari6->llistat_usuari();
						if ($items){
							foreach($items as $item){
							$usuari6=unserialize($item);
						?>    
    
   							<li><a href="v_inscripcio_comp.php?comp=lol&comp_lol=form7&membre=<?=$usuari6->get_usu_id()?>"><?=$usuari6->get_usu_nom()?> <?=$usuari6->get_usu_cognom1()?> <?=$usuari6->get_usu_cognom2()?></a></li>
      
							<?php 
							}
							?>
							</ul>
       						<?php
						}
						?>
      					<br><br>
                        <?php //*****************************************************************************/
      					

	  }elseif ($comp_lol=="form7"){

			$_SESSION['membre5']=$_GET['membre'];
		?>
		
		
		<div data-role="content" id="programa">
		
		<!--<?=$_SESSION['membre5'];?>--> <br> <br>
		  
		  <h1>RESUM:</h1>
		  
		  <p><b>Nom del grup:</b>  <?=$_SESSION['nomGrup']?></p>

		   <?php	
                  @$idUsuari = $_SESSION['idUsuari']; 
				  $usuari = new Usuari(0,0);
				  $usuari->inicialitza($idUsuari);
			?>	
		  
		  <p><b>Primer membre:</b> <?=$usuari->get_usu_nom();?> <?=$usuari->get_usu_cognom1();?> <?=$usuari->get_usu_cognom2();?> </p>
		  
		  
		  
		   <?php	
                  @$idUsuari = $_SESSION['membre2']; 
				  $usuari = new Usuari(0,0);
				  $usuari->inicialitza($idUsuari);
			?>	
		  
		  <p><b>Segon membre:</b> <?=$usuari->get_usu_nom();?> <?=$usuari->get_usu_cognom1();?> <?=$usuari->get_usu_cognom2();?></p>
		  
		 <?php
		 
		   
                  @$idUsuari = $_SESSION['membre3']; 
				  $usuari = new Usuari(0,0);
				  $usuari->inicialitza($idUsuari);
			?>	
		  
		  <p><b>Tercer membre:</b> <?=$usuari->get_usu_nom();?> <?=$usuari->get_usu_cognom1();?> <?=$usuari->get_usu_cognom2();?></p>
		  
		 <?php
		   
		          @$idUsuari = $_SESSION['membre4']; 
				  $usuari = new Usuari(0,0);
				  $usuari->inicialitza($idUsuari);
			?>	
		  
		  <p><b>Quart membre:</b> <?=$usuari->get_usu_nom();?> <?=$usuari->get_usu_cognom1();?> <?=$usuari->get_usu_cognom2();?></p>
		  
		 <?php
		 
		   
		          @$idUsuari = $_SESSION['membre5']; 
				  $usuari = new Usuari(0,0);
				  $usuari->inicialitza($idUsuari);
			?>	
		  
		  <p><b>Cinqué membre:</b> <?=$usuari->get_usu_nom();?> <?=$usuari->get_usu_cognom1();?> <?=$usuari->get_usu_cognom2();?></p>
		  

			
			<a data-role="button" href="v_inscripcio_comp.php?comp=lol&comp_lol=form8" data-corners="false" data-theme="b" data-icon="plus" data-c>Inscriure grup</a>
						
			<a data-role="button" href="v_inscri_competicions.php" data-corners="false" data-theme="b" data-icon="home" data-c>Tornar al menú d'inscripcions</a>
			
		 <?php

	}elseif ($comp_lol=="form8"){

		$compe = new Competicions();
		$retorn_comp = $compe->afegir_inscrit(1, $_SESSION['idUsuari'], "grup");
	?>


	<div data-role="content" id="programa">
	<?php
	if ($retorn_comp==0){
				
				?>
				<center><h1> Grup inscrit a la competició de League Of Legends. <h1></center>
				
				<a data-role="button" href="v_inici.php" data-corners="false" data-theme="b" data-icon="home" data-c>Pàgina inici</a>
						
				<!-- <a data-role="button" href="v_inscri_competicions?refresh=1.php" data-corners="false" data-theme="b" data-icon="plus" data-c>Més inscripcions</a> -->
				
				
				<?php
			}else{
				echo "Nu va";
				header ('Location:v_inici.php');
	}		


	  }

//Inscriure usuari a la competició "HEARTHSTONE" AMD ID --->  2  <-----

}elseif ($comp == "hearthstone"){
	$compe = new Competicions();
	$retorn_comp = $compe->afegir_inscrit(2, $_SESSION['idUsuari'], "individual");
	?>


	<div data-role="content" id="programa">
	<?php
	if ($retorn_comp==0){
				
				?>
				<center><h1> Inscrit a la competició del Hearthstone. <h1></center>
				
				<a data-role="button" href="v_inici.php" data-corners="false" data-theme="b" data-icon="home" data-c>Pàgina inici</a>
						
				<!-- <a data-role="button" href="v_inscri_competicions?refresh=1.php" data-corners="false" data-theme="b" data-icon="plus" data-c>Més inscripcions</a> -->
				
				
				<?php
			}else{
				echo "Nu va";
				header ('Location:v_inici.php');
	}		

	//Inscriure usuari a la competició "COUNTER STRIKE" AMD ID --->  3  <-----

}elseif ($comp == "counter"){
	$compe = new Competicions();
	$retorn_comp = $compe->afegir_inscrit(3, $_SESSION['idUsuari'], "individual");
	?>


	<div data-role="content" id="programa">
	<?php
	if ($retorn_comp==0){
				
				?>
				<center><h1> Inscrit a la competició de Counter Strike - Global Offensive <h1></center>
				
				<a data-role="button" href="v_inici.php" data-corners="false" data-theme="b" data-icon="home" data-c>Pàgina inici</a>
						
				<!-- <a data-role="button" href="v_inscri_competicions?refresh=1.php" data-corners="false" data-theme="b" data-icon="plus" data-c>Més inscripcions</a> -->
				
				
				<?php
			}else{
				echo "Nu va";
				header ('Location:v_inici.php');
	}

//Inscriure usuari a la competició "FIFA 14" AMD ID --->  4  <-----

}elseif ($comp == "fifa"){
	$compe = new Competicions();
	$retorn_comp = $compe->afegir_inscrit(4, $_SESSION['idUsuari'], "individual");
	?>


	<div data-role="content" id="programa">
	<?php
	if ($retorn_comp==0){
				
				?>
				<center><h1> Inscrit a la competició de FIFA 15. <h1></center>
				
				<a data-role="button" href="v_inici.php" data-corners="false" data-theme="b" data-icon="home" data-c>Pàgina inici</a>
						
				<!-- <a data-role="button" href="v_inscri_competicions?refresh=1.php" data-corners="false" data-theme="b" data-icon="plus" data-c>Més inscripcions</a> -->
				
				
				<?php
			}else{
				echo "Nu va";
				header ('Location:v_inici.php');
	}
//Inscriure usuari a la competició "MUNTATGE D'ORDINADORS" AMD ID --->  5  <-----

}elseif ($comp == "muntatge"){
	$compe = new Competicions();
	$retorn_comp = $compe->afegir_inscrit(5, $_SESSION['idUsuari'], "individual");
	?>


	<div data-role="content" id="programa">
	<?php
	if ($retorn_comp==0){
				
				?>
				<center><h1> Inscrit a la competició de muntatge d'ordinadors. <h1></center>
				
				<a data-role="button" href="v_inici.php" data-corners="false" data-theme="b" data-icon="home" data-c>Pàgina inici</a>
						
				<!-- <a data-role="button" href="v_inscri_competicions?refresh=1.php" data-corners="false" data-theme="b" data-icon="plus" data-c>Més inscripcions</a> -->
				
				
				<?php
			}else{
				echo "Nu va";
				header ('Location:v_inici.php');
	}

//Inscriure usuari a la competició "PROGRAMACIÓ" AMD ID --->  6  <-----

}elseif ($comp == "programacio"){
	$compe = new Competicions();
	$retorn_comp = $compe->afegir_inscrit(6, $_SESSION['idUsuari'], "individual");
	?>


	<div data-role="content" id="programa">
	<?php
	if ($retorn_comp==0){
				
				?>
				<center><h1> Inscrit a la competició de programació. <h1></center>
				
				<a data-role="button" href="v_inici.php" data-corners="false" data-theme="b" data-icon="home" data-c>Pàgina inici</a>
						
				<!-- <a data-role="button" href="v_inscri_competicions?refresh=1.php" data-corners="false" data-theme="b" data-icon="plus" data-c>Més inscripcions</a> -->
				
				
				<?php
			}else{
				echo "Nu va";
				header ('Location:v_inici.php');
	}

}








?>


