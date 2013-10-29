<?php require_once($_SERVER['DOCUMENT_ROOT'].'/db/database.php'); ?>
<html>
  <head>
    <title>PHP Framework Test</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <h1>WebPage Title</h1>

    <div class="yield_container" style="border:1px solid black;">
      <?php
        if(!isset($view_path)){
          $view_path = '404.html';
        }
        require_once($view_path);
      ?>
    </div>
  </body>
</html>
<?php mysql_instance::get_instance()->close_instance() ?>
