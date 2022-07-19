<?php
include '../template/header.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/select.css">
    <style>
       
    </style>
</head>

<main class="contenedor sombra">

    <body>
        <!-- Crea el contenedor de la herramienta -->
        <div id="tshirt-div">
            <!-- 
                Inicialmente, la imagen tendrá la camiseta de fondo que tiene transparencia.
                Entonces, simplemente podemos actualizar el color con CSS o JavaScript dinámicamente
            -->
            <img id="tshirt-backgroundpicture" src="./img/background_tshirt.png" />

            <div id="drawingArea" class="drawing-area">
                <div class="canvas-container">
                    <canvas id="tshirt-canvas" width="200" height="400"></canvas>
                </div>
            </div>
        </div>
        <br><br>
        <span class="label-sus info" style="font-weight:bold;">Para remover una imagen agregada, seleccionela y presione la tecla <kbd>DEL</kbd>.</span>
        <!-- La selección que permitirá al usuario elegir uno de los diseños estáticos. -->
        <br><br>
        <!-- El Select que permite al usuario cambiar el color de la camiseta -->
        <label for="tshirt-design" style="font-weight:bold; font-family: sans-serif; font-size: 30px;">Diseños Personalizados</label>
        <div class="form-group">
            <select id="tshirt-design" style="font-size: medium; font-weight: bold;width:350px; height:50px ;">
                <option value="" style="font-size: medium; font-weight: bold;" hidden="hidden">Selecciona una de nuestras imagenes ...</option>
                <option value="./img/batman.png" style="font-size: medium; font-weight: bold;">Batman</option>
                <option value="./img/nike.png" style="font-size: medium; font-weight: bold;">Nike</option>
                <option value="./img/adidas.png" style="font-size: medium; font-weight: bold;">Adidas</option>
                <option value="./img/cocacola.png" style="font-size: medium; font-weight: bold;">Coca Cola</option>
                <option value="./img/inacap.png" style="font-size: medium; font-weight: bold;">Inacap</option>
                <option value="./img/mercedes.png" style="font-size: medium; font-weight: bold;">Mercedes</option>
                <option value="./img/ferrari.png" style="font-size: medium; font-weight: bold;">Ferrari</option>

            </select>
        </div>
        <br>
        <label for="tshirt-color" style="font-weight:bold; font-family: sans-serif; font-size: 30px;">Color de Polera</label>
        <div class="form-group">
            <select id="tshirt-color" style="font-size: medium; font-weight: bold;width:180px; height:50px ;">
                <!-- Puede agregar cualquier color con una nueva opción y definiendo su código hexadecimal -->
                <option value="0" style="font-size: medium; font-weight: bold;" hidden="hidden">Seleccione color</option>
                <option value="#fff" style="font-size: medium; font-weight: bold;">Blanco</option>
                <option value="#000" style="font-size: medium; font-weight: bold;">Negro</option>
                <option value="#f00" style="font-size: medium; font-weight: bold;">Rojo</option>
                <option value="#008000" style="font-size: medium; font-weight: bold;">Verde</option>
                <option value="#ff0" style="font-size: medium; font-weight: bold;">Amarillo</option>
                <option value="#dd14bb" style="font-size: medium; font-weight: bold;">Morado</option>
            </select>
        </div>
        <br>
        <label for="tshirt-custompicture" style="font-weight:bold; font-family: sans-serif; font-size: 30px;">Sube tus imagenes:</label>
        <br>
        <div>
            <input type="file" id="tshirt-custompicture" class="form-control-lg form-group" style="font-size: large;" />
        </div>


        <!-- Incluya Fabric.js en la página -->
        <script src="./fabric.js-521/dist/fabric.min.js"></script>

        <script>
            let canvas = new fabric.Canvas('tshirt-canvas');

            function updateTshirtImage(imageURL) {
                fabric.Image.fromURL(imageURL, function(img) {
                    img.scaleToHeight(300);
                    img.scaleToWidth(300);
                    canvas.centerObject(img);
                    canvas.add(img);
                    canvas.renderAll();
                });
            }

            // Actualiza el color de la camiseta según el color seleccionado por el usuario.
            document.getElementById("tshirt-color").addEventListener("change", function() {
                document.getElementById("tshirt-div").style.backgroundColor = this.value;
            }, false);

            // Actualiza el color de la camiseta según el color seleccionado por el usuario.
            document.getElementById("tshirt-design").addEventListener("change", function() {

                // Llame al método updateTshirtImage proporcionando como primer argumento la URL
                // de la imagen proporcionada por la selección
                updateTshirtImage(this.value);
            }, false);

            // Cuando el usuario hace clic en cargar una imagen personalizada
            document.getElementById('tshirt-custompicture').addEventListener("change", function(e) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var imgObj = new Image();
                    imgObj.src = event.target.result;

                    // Cuando se cargue la imagen, cree la imagen en Fabric.js
                    imgObj.onload = function() {
                        var img = new fabric.Image(imgObj);

                        img.scaleToHeight(300);
                        img.scaleToWidth(300);
                        canvas.centerObject(img);
                        canvas.add(img);
                        canvas.renderAll();
                    };
                };

                // Si el usuario seleccionó una imagen, cárgala
                if (e.target.files[0]) {
                    reader.readAsDataURL(e.target.files[0]);
                }
            }, false);

            // Cuando el usuario selecciona una imagen que se ha agregado y presiona la tecla SUPR
            // ¡El objeto será eliminado!
            document.addEventListener("keydown", function(e) {
                var keyCode = e.keyCode;

                if (keyCode == 46) {
                    console.log("Removing selected element on Fabric.js on DELETE key !");
                    canvas.remove(canvas.getActiveObject());
                }
            }, false);
        </script>
        <br>
        <center>
            <button id="btnCapturar" class="button-87" role="button">Descargar polera</button>  
        </center>
        
        <!--
    En este elemento vamos a poner al canvas que será generado.
  -->
        <div id="contenedorCanvas">
        </div>
        <!--
    Cargar el script de html2canvas, podría ser desde un servidor
    propio o como yo lo hago: desde jsdelivr
  -->
        
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
    <!--
      Después de eso, cargar el script que contiene nuestra lógica
    -->
    <script src="../public/js/script.js"></script>
    </body>
</main>

<?php
include '../template/footer.php';
?>