<?php
require_once "../../includes.php";
require_once "v_estils.php";
require_once "v_capsalera.php";
?>
<div data-role="content" id="premiats" >
<?php
$numero = new Numeros();
$numeros=$numero->llistat_tots_numeros();

	if ($numeros){
		?><center>
		<table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke">
		<thead>
			<tr>
				<th data-priority="1">Número</th>
				<th data-priority="2">Nom</th>
				<th data-priority="persist">Motiu</th>
				<th data-priority="3"><abbr title="Hora d'assiganció">Hora</abbr></th>
				<th data-priority="4">Premi</abbr></th>
				<th data-priority="5">Empresa</th>
                <th data-priority="6">Eliminar Premi</th>
			</tr>
		</thead>
		<tbody><?php 
		foreach($numeros as $num){
			$numero=unserialize($num);
			if ($numero->get_pre_id()!=1){
					?>
										<tr>
                                            <th data-priority="1"><?=$numero->get_ass_numero()?></th>
                                            <th data-priority="1"><?=$numero->nom_usuari($numero->get_usu_id())?></th>
                                            <th data-priority="persist"><?php echo $numero->nom_motiu($numero->get_mot_id())?></th>
                                            <th data-priority="2"><abbr title="Hora d'assiganció"><?=$numero->get_data_assig()?></abbr></th>
                                            <th data-priority="3"><?php if ($numero->get_pre_id()!=1){echo $numero->nom_premi($numero->get_pre_id());} ?></abbr></th>
                                            <th data-priority="4"><?php if ($numero->get_pre_id()!=1){echo $numero->nom_empresa($numero->get_pre_id());} ?></th>
                                            <th data-priority="5"><?php if ($numero->get_pre_id()!=1){ ?><a data-role="button" data-icon="delete" data-iconpos="notext" href="v_inici.php?gestio=8&numA=<?=$numero->get_ass_numero()?>"></a><?php } ?></th> 
                                        </tr>
										
										<?php
				}
			
		}
		?>
								</tbody>
								</table></center><?php
	}


require_once "v_peu_admin.php";
?>