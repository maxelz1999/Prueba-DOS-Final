<?php
    include '../template/header.php';
  
?>
<main class="contenedor sombra">
    <body>
     <?php
            include("../db/conexion.php");

            if(empty($_POST['nombre'] )){
                echo "<h2 class='label-sus infocom' style='font-family: sans-serif; font-size: 35px; font-weight: bold;'>Completar todos los campos</h2>";        
            }else {
                $nombre = $_POST['nombre'];
                $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name'])) ;
                
                $correo = $_POST['correo'];
                $descripcion = $_POST['descripcion'];
                $region = $_POST['region'];
                $query="INSERT into disenadores (nombre, imagen, correo, descripcion, region) VALUES ('$nombre','$imagen','$correo','$descripcion','$region')";
                $resultado = $conn->query($query);
                if($resultado){
                    echo"<h2 class='label-sus infocomsus' style='font-family: sans-serif; font-size: 35px; font-weight: bold;'>Se guardo el disenador</h2>";
                }else{
                    echo "<h2 class='label-sus dangercom' style='font-family: sans-serif; font-size: 20px; font-weight: bold;'>No se guardo, error</h2>";
                }
            }
        ?>
  
<form method="POST" enctype="multipart/form-data" style="" class="formregistro">

<label style="font-weight:bold; font-family: sans-serif; font-size: 20px;">Nombre</label>
<input class="form-control" type="text" name="nombre" style="font-family: sans-serif; font-size: 20px; width:400px; height:50px; position: relative; margin: 0 auto; display:block">

<label style="font-weight:bold; font-family: sans-serif; font-size: 20px;">Foto</label>
<input class="form-control" type="file" name="imagen" style="font-family: sans-serif; font-size: 20px; width:400px; height:40px; position: relative; margin: 0 auto; display:block" required="">

<label style="font-weight:bold; font-family: sans-serif; font-size: 20px;">Correo</label>
<input class="form-control" type="email" id="correo" name="correo" style="font-family: sans-serif; font-size: 20px; width:400px; height:50px;  position: relative; margin: 0 auto; display:block">

<label style="font-weight:bold; font-family: sans-serif; font-size: 20px;">Descripcion</label>
<input class="form-control" type="text" name="descripcion" style="font-family: sans-serif; font-size: 20px; width:500px; height:50px ;  position: relative; margin: 0 auto; display:block" required="">


<label style="font-weight:bold; font-family: sans-serif; font-size: 20px;">Region</label>
<select class="form-select" name="region" style="font-family: sans-serif; font-size: 20px; width:240px; height:50px ;  position: relative; margin: 0 auto; display:block">
        <option value="1" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Arica y Parinacota</option>
        <option value="2" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Tarapaca</option>
        <option value="3" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Antofagasta</option>
        <option value="4" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Atacama</option>
        <option value="5" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Coquimbo</option>
        <option value="6" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Valparaiso</option>
        <option value="7" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Santiago</option>
        <option value="8" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">O'Higgins</option>
        <option value="9" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Maule</option>
        <option value="10" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Bio-Bio</option>
        <option value="11" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Araucania</option>
        <option value="12" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Los Rios</option>
        <option value="13" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Los Lagos</option>
        <option value="14" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Aysen</option>
        <option value="15" style="font-weight:bold; font-family: sans-serif; font-size: 20px; ">Magallanes</option>

</select>        
<br><br>

<center>
    <input type="submit" name="Guardar" value="Guardar" class="button-87" role="button">
</center>
</form>
    </body>
</main>
<?php
    include '../template/footer.php';
?>
