<?php
require "priprav-obsah.php"; 
?>
<!DOCTYPE html>
<html lang="cs">
<head>
   <meta charset="utf-8">
   <title><?php echo $title; ?></title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <link rel="shortcut icon" href="img/logo.png">
   <meta name="robots" content="index,follow">
   <meta name="description" content="<?php echo $metapopis; ?>">
   <meta name="keywords" content="<?php echo $klicovaslova; ?>">
</head>
<body>	
   <div class="container">
      <!-- Hlavička -->
      <a href="index.php" style="text-decoration:none;color:inherit;">
      <div class="jumbotron text-center bg-dark text-white">
         <h1 class="display-3">Dynamický web</h1>
         <p>Obsah načítaný z databáze</p>
      </div>
      </a>
      <!-- Menu -->
      <nav class="navbar navbar-expand-md bg-secondary navbar-dark" style="margin-top:-36px;margin-bottom: 1em;">
         <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="Logo" style="width:40px;"></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
               <?php
               require "menu.php";
               ?>    
            </ul>
         </div>  
      </nav>	
      <!-- Obsah -->
      <div class="row">
         <div class="col-sm-10">
            <h3><?php echo $nazev; ?></h3>
            <p><?php echo $text; ?></p>
         </div>
      </div> 
      <!-- Patička -->
      <div class="jumbotron text-center text-secondary bg-dark">
      <p>&copy; <?php echo date('Y') . " | " . $_SERVER['HTTP_HOST'] ;?></p>
      </div>
   </div>
</body>
</html>
