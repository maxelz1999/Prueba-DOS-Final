<?php
include '../template/header.php';

?><?php

   include("../db/conexion.php");

   session_start();

   if (isset($_POST['submit'])) {

      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = md5($_POST['password']);


      $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

      $result = mysqli_query($conn, $select);

      if (mysqli_num_rows($result) > 0) {

         $row = mysqli_fetch_array($result);

         if ($row['user_type'] == 'admin') {

            $_SESSION['admin_name'] = $row['name'];
            header('location:singup.php');
         }
      } else {
         $error[] = 'incorrect email or password!';
      }
   };
   ?>
<link rel="stylesheet" href="/public/css/login.css">
<main class="contenedor sombra">



   <div class="form-container">
   <span>¿Tienes interes en convertirte en diseñador?</span>
      <form action="" method="post">
         
         <h2 style="font-family: Impact; font-weight: bold; font-size: xx-large; color: whitesmoke;">Inciar sesion</h2>
         <br>
         <input type="email" name="email" required placeholder="Ingresa tu email" class="form-control-lg form-group" style="font-size: large; font-weight: bold;">
         <br><br>
         <input type="password" name="password" required placeholder="Ingresa tu contraseña" class="form-control-lg form-group" style="font-size: large; font-weight: bold;">
         <br><br>
         <input type="submit" name="submit" value="Iniciar Sesion" class="button-87" role="button" style="position: relative; margin: 0 auto; display:block">
         <br><br>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg label-sus danger">Email o contraseña incorrecta.</span>';
            };
         };
         ?>
         
      </form>
      
   </div>
   
</main>

<?php
include '../template/footer.php';
?>

<!-- HTML !-->