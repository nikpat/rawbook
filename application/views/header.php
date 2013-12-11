<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Snoogle</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.css';?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/docs.css';?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Bubblegum+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
    <!-- script src="https://code.jquery.com/jquery-1.10.2.min.js"></script-->
    <script src = "<?php echo base_url().'assets/js/jquery.js';?>"></script>
    <script src = "<?php echo base_url().'assets/js/bootstrap.min.js';?>"></script>
    <script src = "<?php echo base_url().'assets/js/widgets.js';?>"></script>
    <script src = "<?php echo base_url().'assets/js/holders.js';?>"></script>
    <script src = "<?php echo base_url().'assets/js/jquery.wookmark.js';?>"></script>
    <script src = "<?php echo base_url().'assets/js/jquery.imagesloaded.js';?>"></script>
    <!--[if lt IE 9]><script src="../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../docs-assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="../docs-assets/ico/favicon.png">

    <style>
    h3 {
     font-family: 'Shadows Into Light Two', cursive;
    }
    .logofont {
      font-size: 40px;
      color: whitesmoke;
      /*font-family: 'Lily Script One', cursive; */
      font-family: 'Bubblegum Sans', cursive;
    }
   body {
    padding-top: 70px;
    padding-bottom: 20px;
    }

    .navform {
      width: 220px;
    }

    .logoutbtn {
      margin-right: 10px;
      margin-top: 8px;
    }

    .logoimage {
      width: 150px;
    }

    .customnav{
      box-shadow: 3px 3px 5px #888888;
    }
    </style>
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         
          <img class="logoimage" src="<?php echo base_url().'assets/img/newSnogle.png';?>" />
        </div>
        <div class="collapse navbar-collapse customnav">
          <ul class="nav navbar-nav">
            <li class="<?php echo $main_pg=='home'?'active':'' ?>"><a href="<?php echo base_url();?>">Home</a></li>
            <li class="<?php echo $main_pg=='message'?'active':'' ?>"><a href="<?php echo base_url().'messages';?>">Message</a></li>
            <li class="<?php echo $main_pg=='buy'?'active':'' ?>"><a href="<?php echo base_url().'buy';?>">Buy</a></li>
            <li class="<?php echo $main_pg=='sell'?'active':'' ?>"><a href="<?php echo base_url().'sell';?>">Sell</a></li>
            <li class="<?php echo $main_pg=='news'?'active':'' ?>"><a href="<?php echo base_url().'news';?>">News</a></li>
            <li class="<?php echo $main_pg=='interest'?'active':'' ?>"><a href="<?php echo base_url().'interest';?>">Interest</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a class="<?php echo $main_pg=='account'?'active':'' ?>" href="<?php echo base_url().'account';?>">Account</a></li>
            <li>
             <button id="logout" href="<?php echo base_url().'home/logout';?>" type="button" class="btn btn-danger logoutbtn">Logout</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $('#logout').on("click",function(){
          window.location = "<?php echo base_url().'home/logout';?>";
        });
      });
    </script>


