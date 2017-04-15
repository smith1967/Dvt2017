<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CSTC Radius User Administrator">
        <meta name="author" content="<?php echo $auhtor; ?>">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title><?php echo $title ?></title>

        <!-- Bootstrap core CSS -->
        <link href = "<?php echo BOOTSTRAP_URL ?>css/bootstrap.min.css" rel = "stylesheet">
        <!--<link href = "<?php echo BOOTSTRAP_URL ?>css/bootstrap.css" rel = "stylesheet">-->
        <link href = "<?php echo BOOTSTRAP_URL ?>css/bootstrap-theme.min.css" rel = "stylesheet">
        <!--<link href = "<?php echo BOOTSTRAP_URL ?>css/bootstrap-theme.css" rel = "stylesheet">-->

         
        <!-- Custom styles for this template -->
        <link href="<?php echo CSS_URL ?>bootcomplete.css" rel="stylesheet">
        <link href="<?php echo CSS_URL ?>sticky-footer-navbar.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href = "<?php echo CSS_URL ?>jquery-ui.css" rel = "stylesheet">
        <link href = "<?php echo CSS_URL ?>select2.min.css" rel = "stylesheet">
        <script src = "<?php echo JS_URL ?>jquery.js"></script>
        <script src = "<?php echo JS_URL ?>jquery-ui.js"></script>     
        <script src = "<?php echo JS_URL ?>select2.min.js"></script>     
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->        
        <!--<script type="text/javascript" src="<?php echo JS_URL ?>jquery-3.2.0.slim.min.js"></script>-->
        <script type="text/javascript" src="<?php echo JS_URL ?>jquery.bootcomplete.js"></script>

    </head>

    <body>
        <!-- Wrap all page content here -->
        <div id="wrap">
            <!-- Fixed navbar -->
            <?php require_once 'nav-main.php'; ?>

