<?php
require_once "../../includes.php";
require_once "v_estils.php";
require_once "v_capsalera.php";

@$idUsuari= $_GET['idUsuari'];
	$usuariEdit = new Usuari(0,0);
	$usuariEdit->inicialitza($idUsuari);
		
?><div data-role="content" id="programa"  data-theme="a" >
        <form action="v_inici.php?gestio=2" method="post" name="formulari">
           
              <h3><font color="#FFFFFF" style="background:none; border:none">Formulari d'edició:</font></h3>
                            <input type="text" name="editId" id="editId" value="<?=$usuariEdit->get_usu_id()?>" placeholder="id" data-theme="a" required readonly>

              <input type="text" name="editDNI" id="editDNI" value="<?=$usuariEdit->get_usu_dni()?>" placeholder="nom" data-theme="a" required >
              <label for="editNom" class="ui-hidden-accessible">Nom:</label>
              <input type="text" name="editNom" id="editNom" value="<?=$usuariEdit->get_usu_nom()?>" placeholder="nom" data-theme="a" required>
               <label for="editCognom1" class="ui-hidden-accessible">1r Cognom:</label>
              <input type="text" name="editCognom1" id="editCognom1" value="<?=$usuariEdit->get_usu_cognom1()?>" placeholder="1r cognom" data-theme="a" required>
               <label for="editCognom2" class="ui-hidden-accessible">2n Cognom:</label>
              <input type="text" name="editCognom2" id="editCognom2" value="<?=$usuariEdit->get_usu_cognom2()?>" placeholder="2n cognom" data-theme="a" required>
              <label for="editUser" class="ui-hidden-accessible">Nick:</label>
              <input type="text" name="editUser" id="editUser" value="<?=$usuariEdit->get_usu_nick()?>" placeholder="username" data-theme="a" required>
               <label for="editCorreu" class="ui-hidden-accessible">Correu:</label>
              <input type="text" name="editCorreu" id="editCorreu" value="<?=$usuariEdit->get_usu_correu()?>" placeholder="correu" data-theme="a" required>
              <label for="editPass" class="ui-hidden-accessible">Password:</label>
              <input type="password" name="editPass" id="editPass" value="" placeholder="password" data-theme="a" >
              <label for="editPass2" class="ui-hidden-accessible">Password:</label>
              <input type="password" name="editPass2" id="editPass2" value="" placeholder="repetir password" data-theme="a"  pattern="">             
              <button type="button" data-theme="b" data-icon="back" onclick="history.back()">Cancelar</button>
              <button type="submit" data-theme="b" data-icon="check" >Aceptar</button>
          
        </form>    
</div>