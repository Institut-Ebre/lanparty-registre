<?php
require_once "../../includes.php";
require_once "v_estils.php";
require_once "v_capsalera.php";


@$refresh=$_GET['refresh'];

if ($refresh==1){
	?>
	<meta http-equiv="refresh" content="0;url=v_inscri_competicions">
	<?php
	}

//@$error=$_GET['err'];
?>
<div data-role="content" id="programa">
<?php	
//echo $_SESSION['idUsuari'];
?>	
<h1>Inscripció a les competicions:</h1>
<!--
<a data-role="button" href="v_inscripcio_comp.php?comp=lol&comp_lol=form1" data-corners="false" data-theme="b" data-icon="plus" data-c>League of Legends</a>
						
<a data-role="button" href="v_inscripcio_comp.php?comp=hearthstone" data-corners="false" data-theme="b" data-icon="plus" data-c>Hearthstone</a>
												
<a data-role="button" href="v_inscripcio_comp.php?comp=counter" data-corners="false" data-theme="b" data-icon="plus" data-c>Counter Strike 1.6</a>
						
<a data-role="button" href="v_inscripcio_comp.php?comp=fifa" data-corners="false" data-theme="b" data-icon="plus" data-c>FIFA 14</a>

<a data-role="button" href="v_inscripcio_comp.php?comp=muntatge" data-corners="false" data-theme="b" data-icon="plus" data-c>Muntatge d'ordinadors</a>
-->

<!-- LEAGUE OF LEGENDS -->

<?php

$competicio = new Competicions();

$comp_return= $competicio->consulta_usuari_inscrit(1,$_SESSION['idUsuari']);

if ($comp_return){
	?>
	<button disabled="" data-corners="false" data-icon="check" data-theme="b">League of Legends</button>
	<?php
}else{
	?>
	<a data-role="button" href="v_inscripcio_comp.php?comp=lol&comp_lol=form1" data-corners="false" data-theme="b" data-icon="plus" data-c>League of Legends</a>
	<?php
		
}
?>
<!-- HEARTSTONE -->

<?php

$competicio = new Competicions();

$comp_return= $competicio->consulta_usuari_inscrit(2,$_SESSION['idUsuari']);

if ($comp_return){
	?>
	<button disabled="" data-corners="false" data-icon="check" data-theme="b">Hearthstone</button>
	<?php
}else{
	?>
	<a data-role="button" href="v_inscripcio_comp.php?comp=hearthstone" data-corners="false" data-theme="b" data-icon="plus" data-c>Hearthstone</a>
	<?php
}
?>
<!-- Counter Strike -->

<?php

$competicio = new Competicions();

$comp_return= $competicio->consulta_usuari_inscrit(3,$_SESSION['idUsuari']);

if ($comp_return){
	?>
	<button disabled="" data-corners="false" data-icon="check" data-theme="b">Counter Strike - Global Offensive</button>
	<?php
}else{
	?>
	<a data-role="button" href="v_inscripcio_comp.php?comp=counter" data-corners="false" data-theme="b" data-icon="plus" data-c>Counter Strike - Global Offensive</a>
	<?php
}
?>
<!-- FIFA 14 -->

<?php

$competicio = new Competicions();

$comp_return= $competicio->consulta_usuari_inscrit(4,$_SESSION['idUsuari']);

if ($comp_return){
	?>
	<button disabled="" data-corners="false" data-icon="check" data-theme="b">FIFA 15</button>
	<?php
}else{
	?>
	<a data-role="button" href="v_inscripcio_comp.php?comp=fifa" data-corners="false" data-theme="b" data-icon="plus" data-c>FIFA 15</a>
	<?php
}

?>
<!-- Muntatge -->

<?php

$competicio = new Competicions();

$comp_return= $competicio->consulta_usuari_inscrit(5,$_SESSION['idUsuari']);

if ($comp_return){
	?>
	<button disabled="" data-corners="false" data-icon="check" data-theme="b">Muntatge d'ordinadors</button>
	<?php
}else{
	?>
	<a data-role="button" href="v_inscripcio_comp.php?comp=muntatge" data-corners="false" data-theme="b" data-icon="plus" data-c>Muntatge d'ordinadors</a>
	<?php
}


?>
	
<!-- Programacio -->

<?php

$competicio = new Competicions();

$comp_return= $competicio->consulta_usuari_inscrit(6,$_SESSION['idUsuari']);

if ($comp_return){
	?>
	<button disabled="" data-corners="false" data-icon="check" data-theme="b">Programació</button>
	<?php
}else{
	?>
	<a data-role="button" href="v_inscripcio_comp.php?comp=programacio" data-corners="false" data-theme="b" data-icon="plus" data-c>Programació</a>
	<?php
}


?>	
	
					
<?php
require_once "v_peu_usuari.php";
?>
