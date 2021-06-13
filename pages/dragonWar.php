<?php 
  include_once('../shared/navLinks.php');
  include_once('../models/test.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/dragonWar.css">
  <title>Document</title>
</head>

<body>
  <nav>
    <div class="navUp">
      <?php foreach ($links as $key => $link){
        echo '<li><a href="'. ($link==='index.php'?'../':'') .'' . $link . '">' . $key . '</a></li>';
      };
      ?>
    </div>
  </nav>
  <div class="fond">
    <img src="../images/dragon.png" alt="dragon">
    <div class="displayHero">
      <div class="heroesWar">
        <?php foreach($heroes as $hero){
           echo $hero->displayHtmlWar();
          }; ?>
      </div>
    </div>
  </div>

</body>

</html>