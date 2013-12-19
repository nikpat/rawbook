<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>fixsir</title>

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
      /* font-family: 'Bubblegum Sans', cursive; */
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
            <img src="<?php echo base_url();?>assets/img/unity.jpg" style="margin: 45px;width: 460px;" />
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
                  <input class="userType" type="checkbox" name="userType" alt="buy" id="optionsRadios1" value="2"  />
                  <input type="hidden" id="buy_items" name="buy_items" value=""/>
                    Buyer
                  </label>
                  <label class=".radio-inline">
                  <input class="userType" type="checkbox" name="userType" alt="sell" id="optionsRadios1" value="3" />
                  <input type="hidden" id="sell_items" name="sell_items" value=""/>
                    Seller
                  </label>
                  <label class=".radio-inline">
                  <input class="userType" type="checkbox" name="userType" alt="trade" id="optionsRadios1" value="agent"  />
                  <input type="hidden" id="trade_items" name="trade_items"  value=""/>
                    Agent
                  </label>
                </div>
                
                <!--input type="range" class="slideToUnlock" value="0" max="100" -->
                <button type="submit" class="btn btn-default btn-primary" onclick="checkForm()">Signup</button>
              </form>
            </div>
          </div>
          
            
        </div>
      </div>

    </div> <!-- /container -->

    <!-- Modal -->
  

       <!-- Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">What do you like to buy ?</h4>
          </div>
          <div class="modal-body">
            <?php foreach ($categories as $cat) { if( $cat['parent_id'] == 0 ){ echo '<h3>'.$cat['title'].'</h3>';} ?>
              <?php foreach ($categories as $subcat) { 
                if( $subcat['parent_id'] != 0 && $subcat['parent_id'] == $cat['id']){ 
                  echo "<input type='checkbox' class='buy_cat' value='".$subcat['id']."'' />  ".$subcat['title']. " | " ;
                } 
              } ?> 
            <? } ?>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

       <!-- Modal -->
    <div class="modal fade" id="sellModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">What do you like to sell ?</h4>
          </div>
          <div class="modal-body">
            <?php foreach ($categories as $cat) { if( $cat['parent_id'] == 0 ){ echo '<h3>'.$cat['title'].'</h3>';} ?>
              <?php foreach ($categories as $subcat) { 
                if( $subcat['parent_id'] != 0 && $subcat['parent_id'] == $cat['id']){ 
                  echo "<input type='checkbox' class='sell_cat' value='".$subcat['id']."'' />  ".$subcat['title']. " | " ;
                } 
              } ?> 
            <? } ?>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

           <!-- Modal -->
    <div class="modal fade" id="dealinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">What do you like to deal in ?</h4>
          </div>
          <div class="modal-body">
            <?php foreach ($categories as $cat) { if( $cat['parent_id'] == 0 ){ echo '<h3>'.$cat['title'].'</h3>';} ?>
              <?php foreach ($categories as $subcat) { 
                if( $subcat['parent_id'] != 0 && $subcat['parent_id'] == $cat['id']){ 
                  echo "<input type='checkbox' class='trade_cat' value='".$subcat['id']."'' />  ".$subcat['title']. " | " ;
                } 
              } ?> 
            <? } ?>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src = "<?php echo base_url().'assets/js/jquery.js';?>"></script>
    <script src = "<?php echo base_url().'assets/js/bootstrap.js';?>"></script>
    <script>
      var checkedCount = 1;
      $('.userType').on('click',function(){
        console.log('checkedCount'+checkedCount)
        
      
          var purpose = $(this).attr('alt');
          $('#purpose').html(purpose);
          if( $(this).is(':checked') ){
            if(checkedCount > 2){
              $(this).prop('checked', false);
              alert("You can select only 2 !");
            }
            else{

              if(purpose=="buy"){
                $('#'+purpose+'Modal').modal('show'); 
              }
              else if(purpose=="sell"){
                $('#'+purpose+'Modal').modal('show'); 
              }
              else{
                $('#'+purpose+'Modal').modal('show'); 
              }
              
              checkedCount++;
            }
            
          } 
          else{
             checkedCount--;
          }
        
      });

      function checkForm(){
        //form validation ehre
      }

      // for buy
      var buy_cat_ids = [] ;
      $(".buy_cat").on('click',function(){
         select_cat($(this),trade_cat_ids,"#buy_items");
      });

      // for sell
      var sell_cat_ids = [] ;
      $(".sell_cat").on('click',function(){
        select_cat($(this),sell_cat_ids,"#sell_items");
      });

      // for trade
      var trade_cat_ids = [] ;
      $(".trade_cat").on('click',function(){
        select_cat($(this),trade_cat_ids,"#trade_items");
      });


      function select_cat(that,cat_array,insert_into){
        var cat_id = that.val() ;
        if(that.is(':checked')){
          // add to array
          cat_array.push(cat_id);
        }
        else{
          //remove from array
          cat_array.splice(cat_array.indexOf(cat_id),1);
        }
        console.log(cat_array);
        $(insert_into).val(cat_array.join(','));
      }

    </script>
  </body>
</html>
