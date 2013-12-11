<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Snoogle</title>

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
    .logofont {
      margin-top: 7px;
      font-size: 60px;
      color: white;
      /*font-family: 'Lily Script One', cursive; */
      font-family: 'Bubblegum Sans', cursive;
    }
   body {
    padding-top: 50px;
    padding-bottom: 20px;
    }

    .navform {
      width: 220px;
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
          <img src="<?php echo base_url().'assets/img/newSnogle.png';?>"  />
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" style="width: 555px;" action="<?php echo base_url().'home/login';?>" method="POST">
            <div class="form-group navform">
              <input type="text" name="usernameEmail" style="margin-top: 2px;" placeholder="Username Or Email" class="form-control">
              <?php if($this->session->flashdata('error')) { ?>
                    <span style="color:red"><?php echo $this->session->flashdata('error') ;?></span>
               <? } else {?>
               <input id="persist_box" type="checkbox" name="persistent" value="1" checked="1" class="uiInputLabelCheckbox">
               Keep me logged in
               <?php }?>
            </div>
            <div class="form-group navform">
              <input type="password" name="password" placeholder="Password" class="form-control">
               <a style="color:black">Forgot Password</a>
            </div>
            <button type="submit" class="btn btn-success" style="margin-bottom:20px">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>


    <div class="container">
      <!-- Example row of columns -->
      <div class="row" style="margin-top: 40px;">    
        <div class="col-md-6">
          <div class="panel panel-default">
             This is reserved place for image
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">SignUp</div>
            <div class="panel-body">
              <?php echo validation_errors(); ?>

                <form role="form" action="<?php echo base_url().'home/signup';?>" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <input name="firstname" type="text" class="form-control" id="exampleInputEmail1" placeholder="John" value="<?php echo isset($_POST['firstname'])?$_POST['firstname']:'' ?>" required>
                  <label for="exampleInputEmail1">Last Name</label>
                  <input name="lastname" type="text" class="form-control" id="exampleInputEmail1" placeholder="terry" value="<?php echo isset($_POST['lastname'])?$_POST['lastname']:'' ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="John" value="<?php echo isset($_POST['username'])?$_POST['username']:'' ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="John@cage.com" value="<?php echo isset($_POST['email'])?$_POST['email']:'' ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input name="password" type="password" class="form-control" id="exampleInputEmail1"  required>
                </div>
                <div class="form-group">
                  <label class=".radio-inline" >
                  <input type="radio" name="userType" id="optionsRadios1" value="2" checked>
                    Buyer
                  </label>
                  <label class=".radio-inline">
                  <input type="radio" name="userType" id="optionsRadios1" value="3" checked>
                    Seller
                  </label>
                  <label class=".radio-inline">
                  <input type="radio" name="userType" id="optionsRadios1" value="agent" checked>
                    Agent
                  </label>
                </div>
                
                <!--input type="range" class="slideToUnlock" value="0" max="100" -->
                <button type="submit" class="btn btn-default btn-primary">Signup</button>
              </form>
            </div>
          </div>
          
            
        </div>
      </div>

    </div> <!-- /container -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src = "<?php echo base_url().'assets/js/bootstrap.js';?>"></script>
  </body>
</html>
