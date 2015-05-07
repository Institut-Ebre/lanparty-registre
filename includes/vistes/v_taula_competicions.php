<?php
require_once "../../includes.php";
require_once "v_estils.php";
require_once "v_capsalera.php";
?>

<div data-role="content" id="programa"  data-theme="b">
	<center><h1>Taules de competicions</h1></center>
	<div data-role="collapsible" >
		<h4>League Of Legends</h4>
		<?php
		$comp_taula_league = new Competicions();
		$comp_usuaris_league = $comp_taula_league->inscrits_comp_grup(1);
    
    
		if($comp_usuaris_league){
			?>
		
			<?php
			foreach($comp_usuaris_league as $comp_usuaris_lol){
				
				$nom_grup = $comp_taula_league->nom_grup($comp_usuaris_lol['comp_grup_id']);
				
				if ($nom_grup[1]["comp_grup_nom"] == ""){
					
				}else{
				
				?><div data-role="collapsible" data-theme="b" data-content-theme="d" data-inset="false"><?php										
				//nom de la competicio
								
				
				?>
				
				<h3><?=$nom_grup[1]["comp_grup_nom"]?></h3>
				
				<!--membres del grup-->
				<ul data-role="listview">
				<?php
				$membre_grup = $comp_taula_league->membres_grup($comp_usuaris_lol['comp_grup_id']);	
				
				
				foreach ($membre_grup as $membre){
					
					$usuari_lol = new Usuari(0,0); 
					
					$usu_lol = $usuari_lol->nom_usuari($membre["usu_id"])
					?>
		<li>(<font color="blue"><?=$usu_lol[1]["usu_nick"]?></font>)      <?=$usu_lol[1]["usu_nom"]?> <?=$usu_lol[1]["usu_cognom1"]?> <?=$usu_lol[1]["usu_cognom2"]?>    </li>
				<?php
				}
				?>
				</ul>
				
				<?php
			?>
			</div>
			<?php
		}
			}	
		};
		
		?>
	</div>
	<div data-role="collapsible"   >
		<h4>Hearthstone</h4>
		<?php
		$comp_taula_hearthstone = new Competicions();
		$comp_usuaris_hearthstone = $comp_taula_hearthstone->inscrits_comp(2);
    
		//var_dump($comp_usuaris_hearthstone);
    
		if($comp_usuaris_hearthstone){
			?>
			<ol data-role="listview" data-theme="c">
			<?php
			foreach($comp_usuaris_hearthstone as $comp_usuaris_hearth){
		
				//echo '<br><br> 1  <br><br>';
				//$comp_taula_hearthstone = unserialize($comp_usuaris_hearth);
				if ($comp_usuaris_hearth["comp_grup_nom"]==""){
			
				}else{
					?>
					<li><?=$comp_usuaris_hearth["comp_grup_nom"];?></li>
					<?php	
				}
			
			}	
			?>
			</ol>
			<?php
		};
		?>
	</div>
	<div data-role="collapsible" >
		<h4>Counter Strike - Global Offensive</h4>
		<?php
		$comp_taula_counter = new Competicions();
		$comp_usuaris_counter = $comp_taula_counter->inscrits_comp(3);
    
		//var_dump($comp_usuaris_hearthstone);
    
		if($comp_usuaris_counter){
			?>
			<ol data-role="listview" data-theme="c">
			<?php
			foreach($comp_usuaris_counter as $comp_usuaris_count){
		
				//echo '<br><br> 1  <br><br>';
				//$comp_taula_hearthstone = unserialize($comp_usuaris_hearth);
				if ($comp_usuaris_count["comp_grup_nom"]==""){
			
				}else{
					?>
					<li><?=$comp_usuaris_count["comp_grup_nom"];?></li>
					<?php	
				}
			
			}	
			?>
			</ol>
			<?php
		};
		?>
	</div>
	<div data-role="collapsible" >
		<h4>FIFA 15</h4>
		<?php
		$comp_taula_fifa = new Competicions();
		$comp_usuaris_fifa = $comp_taula_fifa->inscrits_comp(4);
    
		//var_dump($comp_usuaris_hearthstone);
    
		if($comp_usuaris_fifa){
			?>
			<ol data-role="listview" data-theme="c">
			<?php
			foreach($comp_usuaris_fifa as $comp_usuaris_fif){
		
				//echo '<br><br> 1  <br><br>';
				//$comp_taula_hearthstone = unserialize($comp_usuaris_hearth);
				if ($comp_usuaris_fif["comp_grup_nom"]==""){
			
				}else{
					?>
					<li><?=$comp_usuaris_fif["comp_grup_nom"];?></li>
					<?php	
				}
			
			}	
			?>
			</ol>
			<?php
		};
		?>
	</div>
	<div data-role="collapsible" >
		<h4>Muntatge d'ordinadors</h4>
		<?php
	$comp_taula_muntatge = new Competicions();
    $comp_usuaris_muntatge = $comp_taula_muntatge->inscrits_comp(5);
    
    //var_dump($comp_usuaris_hearthstone);
    
    if($comp_usuaris_muntatge){
		?>
		<ol data-role="listview" data-theme="c">
		<?php
		foreach($comp_usuaris_muntatge as $comp_usuaris_muntat){
		
			//echo '<br><br> 1  <br><br>';
			//$comp_taula_hearthstone = unserialize($comp_usuaris_hearth);
			if ($comp_usuaris_muntat["comp_grup_nom"]==""){
			
			}else{
				?>
				<li><?=$comp_usuaris_muntat["comp_grup_nom"];?></li>
				<?php	
			}
			
	}	
		?>
			</ol>
			<?php
	};
	?>
	</div>
	
	<div data-role="collapsible" >
		<h4>Programació</h4>
		<?php
	$comp_taula_programacio = new Competicions();
    $comp_usuaris_programacio = $comp_taula_programacio->inscrits_comp(6);
    
    
    
    if($comp_usuaris_programacio){
		?>
		<ol data-role="listview" data-theme="c">
		<?php
		foreach($comp_usuaris_programacio as $comp_usuaris_programador){
		
			//echo '<br><br> 1  <br><br>';
			//$comp_taula_hearthstone = unserialize($comp_usuaris_hearth);
			if ($comp_usuaris_programador["comp_grup_nom"]==""){
			
			}else{
				?>
				<li><?=$comp_usuaris_programador["comp_grup_nom"];?></li>
				<?php	
			}
			
	}	
		?>
			</ol>
			<?php
	};
	?>

<?php
require_once "v_peu_usuari.php";
?>
