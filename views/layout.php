<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Salón</title>
    <link type="image/png" sizes="96x96" rel="icon" href="https://img.icons8.com/office/16/null/barbershop.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>


  <div class="contenedor-app">
    <div class="imagen"></div>
    <div class="app">
    <?php echo $contenido; ?>

    </div>
  </div>
            
</body>
<?php 
echo $script ?? "";

?>
</html>