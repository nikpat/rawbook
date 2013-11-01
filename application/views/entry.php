<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Request a software</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.css';?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Bubblegum+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
    <style>
    h3 {
     font-family: 'Shadows Into Light Two', cursive;
    }
    h1 {
      /*font-family: 'Lily Script One', cursive; */
      font-family: 'Bubblegum Sans', cursive;
    }
    body {
      background-color: #E6E6E6 ;
          }


input[type="range"] {
    width: 100%;
    /*margin: 100px; */
    background: rgb(124, 209, 180);
    -webkit-appearance: none;
    border-radius: 10px;
    padding: 5px;
    transition: opacity 0.5s;
    position: relative;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    border-radius: 10px;
    background: #fff;
    z-index: 1;
    width: 75px;
    position: relative;
    height: 55px;
}

input[type="range"]:before {
    content: "slide to submit";
    color: #8a8a8a;
    position: absolute;
    left: 100px;
    top: 10px;
    z-index: 1;
    font-size: 32px;
}

input[type="range"]::-webkit-slider-thumb:before {
    color: rgb(70, 188, 149);
    position: absolute;
    left: 10px;
    top: -10px;
    z-index: 1;
    font-size: 56px;
    font-weight: bold;
    content: "→";
}
    </style>
  </head>

  <body>
    <div class="container">

      <div class="page-header">
        <h1 >Snoogle</h1>
      </div>

      <div class="row">
        <div class="col-md-6">
          You have an Idea !<br> 
          <p>We welcome you to make request and we will get back to you with details.
          All you need to do is just fill the form and that done.</p>
          <h3>No Login</h3>
          <h3>No Signup</h3>
          <h3>No Packages</h3>
        </div>
        <div class="col-md-6">
          <?php if($this->session->flashdata('req_id')) { ?>
            <div class="alert alert-success">
              <a href="#" class="alert-link">Your Request No : <?php echo $this->session->flashdata('req_id');?></a>
            </div>
          <?php } else {  ?>

          <?php if(isset($_POST['error_log'])) {  ?>
            <div class="alert alert-danger">
              <a href="#" class="alert-link"><?php echo $_POST['error_log'];?></a>
            </div>
          <?php } ?>

          <form role="form" action="<?php echo base_url().'home/register';?>" method="POST">
          
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="John@cage.com" value="<?php echo isset($_POST['email'])?$_POST['email']:'' ?>" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="John@cage.com" value="<?php echo isset($_POST['email'])?$_POST['email']:'' ?>" required>
            </div>
            <div class="form-group">
              <?php
               // require("/assets/recaptchalib.php");
                $publickey = "6LcXCekSAAAAANYtz83YU8KFJKwunq8mrKn9Q-T3"; // you got this from the signup page
                  echo recaptcha_get_html($publickey);
                ?>
            </div>
            <!--input type="range" class="slideToUnlock" value="0" max="100" -->
            <button type="submit" class="btn btn-default btn-primary">Submit</button>
          </form>
            <?php } ?> 
        </div>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
