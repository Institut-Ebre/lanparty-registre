<?php
require_once "../../includes.php";
require_once "v_estils.php";
require_once "v_capsalera.php";

@$error=$_GET['err'];
?>
<script> 

letra=["T","R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E","F"] 

function comprobar(){ 
tecleado=document.forms[0].nouDNI.value.toUpperCase(); 
caracteres=tecleado.length; 
if(caracteres<7){mal("NIF massa curt");return false;} 
letrapuesta=tecleado.charAt(caracteres-1); 
if(letrapuesta==letrapuesta.toLowerCase()){mal("Falta la letra del NIF");return false;} 
numero=tecleado.substring(0,caracteres-1); 
if (isNaN(numero)){mal("Número del NIF invàlid");return false;} 
if(letrapuesta.toUpperCase()!=letra[numero%23]){mal("NIF Invàlid");return false;} 
document.forms[0].submit(); 
} 

function mal(mensaje){ 
alert(mensaje); 
document.forms[0].nouDNI.value=""; 
document.forms[0].nouDNI.focus(); 

} 
</script> 

<div data-role="content">	
	<center><h3>Tots els camps són obligatoris</h3><center>
	<?php if (@$error==1){?>
    <center><h3 style="color:red">Nick ja en ús</h3><center>
	<?php }elseif (@$error==2){?>
			<center><h3 style="color:red">Error a la paraula de pas.</h3><center>
		<?php }
	
	?>
    <div>

        <form action="v_inici.php?gestio=1" method="post" name="formulari">
             
            <div>
            	<!-- CAMP DEL DNI -->
              <label for="nouDNI" class="ui-hidden-accessible">DNI:</label>
              <input type="text" name="nouDNI" id="nouDNI" value="" placeholder="DNI" data-theme="a" required>
              	<!-- CAMP DEL NOM -->
              <label for="nouNom" class="ui-hidden-accessible">Nom:</label>
              <input type="text" name="nouNom" id="nouNom" value="" placeholder="Nom" data-theme="a" required>
              	<!-- CAMP DEL 1R COGNOM -->
              <label for="nouCognom1" class="ui-hidden-accessible">1r Cognom:</label>
              <input type="text" name="nouCognom1" id="nouCognom1" value="" placeholder="1r cognom" data-theme="a" required>
              	<!-- CAMP DEL 2N COGNOM -->
              <label for="nouCognom2" class="ui-hidden-accessible">2n Cognom:</label>
              <input type="text" name="nouCognom2" id="nouCognom2" value="" placeholder="2n cognom" data-theme="a" required>
                <!-- CAMP DEL NICK -->
              <label for="nouNick" class="ui-hidden-accessible">Nick:</label>
              <input type="text" name="nouNick" id="nouNick" value="" placeholder="Nickname" data-theme="a" required>
                <!-- CAMP DEL CORREU -->
              <label for="nouCorreu" class="ui-hidden-accessible">Correu:</label>
              <input type="email" name="nouCorreu" id="nouCorreu" value="" placeholder="Correu electrònic" 
              data-theme="a" required>
              	<!-- CAMP DE LA CLAU DE PAS -->
              <label for="nouPass" class="ui-hidden-accessible">Password:</label>
              <input type="password" name="nouPass" id="nouPass" value="" placeholder="Password" data-theme="a" required>
              	<!-- CAMP DE VERIFICACIÓ DE LA CLAU DE PAS -->
              <label for="nouPass2" class="ui-hidden-accessible">Password:</label>
              <input type="password" name="nouPass2" id="nouPass2" value="" placeholder="Repetir password" data-theme="a" required >
            </div>   
 			<button type="button" data-theme="b" data-icon="back" onclick="history.back()">Cancelar</button>
            <input type="submit" value="Registrar" data-theme="b" onclick="comprobar()" data-corners="false" data-icon="check"></li>
		
        </form>     
	</div>   
            
       
</div>


