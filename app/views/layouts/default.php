<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$this->siteTitle();?></title>

    <link  rel="stylesheet" href="<?=PROOT?>css/bootstrap.min.css" media="screen"  title="no title" charset= "utf-8"><!-- the symbols before proot means echo -->
    <link  rel="stylesheet" href="<?=PROOT?>css/custom.css" media="screen"  title="no title" charset= "utf-8">
    <script src="<?=PROOT?>js/jQuery-2.2.4.min.js"></script>
    <script src="<?=PROOT?>js/bootstrap.min.js"></script>

    <?= $this -> content('head'); ?>

  </head>
  <body>
    <?= $this->content('body'); ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>