

  <!-- Global CSS for the page and tiles -->

  <link href="<?php echo base_url().'assets/css/main.css';?>" rel="stylesheet">
  <!-- Add fancyBox -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/fancybox/jquery.fancybox.css?v=2.1.5' ?>" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php echo base_url().'assets/fancybox/jquery.fancybox.pack.js?v=2.1.5'?>"></script>

  <!-- link href="<?php echo base_url().'assets/css/reset.css';?>" rel="stylesheet" -->
  <style>
  .cards {
    background-color:white;
    box-shadow: 3px 3px 5px #888888;
    margin:10px;
  }   
  .usrname{
    color: #428bca;
    margin-top: 10px;
    font-size: 20px;
  }
  .usrtype{
    color: gray;
  }
 
  </style>
    <div class="container">

      <div class="row">

        <div class="col-md-4">
         <div class="row cards">
                <div class="row">
                  <div class="col-xs-5"><img src="<?php echo base_url().'assets/img/male.png';?>" style="width:100px"></div>
                  <div class="col-xs-7">
                    <div class="row">
                      <div class="usrname"><?php echo !empty($user["firstname"]) ? $user["firstname"]:"Not mentioned" ; ?>
                          <?php echo !empty($user["lastname"]) ? $user["lastname"]:"" ; ?>  
                      </div>
                      <div class="usrtype">Buyer</div>
                      <div class="userplace"><?php echo !empty($user["city"]) ? $user["city"]:"" ; ?>,India <?php echo !empty($user["county"]) ? $user["county"]:"" ; ?></div>
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <div class="col-xs-12">
                     <?php if($this->session->userdata('userId') == $user["id"] ){
                          ?>
                          <a class="col-xs-12 btn btn-primary" href="<?php echo base_url().'account/settings/'.$user["id"];?>">Settings</a>
                        <?php }
                        else{ 
                          if($isFollowing){
                            ?>
                            <a class="col-xs-12 btn btn-warning connectionReq" id="unfollow" uid="<?php echo $user["id"]; ?>" href="javascript:void(0)">Unfollow</a>
                            <?php
                          } else {
                          ?>
                            <a class="col-xs-12 btn btn-success connectionReq" id="follow" uid="<?php echo $user["id"]; ?>" href="javascript:void(0)">Follow</a>
                        <?php } 

                        } ?>
                  </div>
               
                  <div class="col-xs-12">
                    <a class="col-xs-12 btn btn-info selectPanel" alt="network" href="javascript:void(0)">Network</a>
                  </div>
                  <div class="col-xs-12">
                    <a class="col-xs-12 btn btn-primary selectPanel" alt="interest" href="javascript:void(0)">Interests</a>
                  </div>
                   <div class="col-xs-12">
                    <a class="col-xs-12 btn btn-info selectPanel"  alt="product" href="javascript:void(0)">Products</a>
                  </div>
                   <div class="col-xs-12">
                    <a class="col-xs-12 btn btn-primary selectPanel" alt="instock" href="javascript:void(0)">In Stock</a>
                  </div>
                </div>
              </div>   
        </div>
        <div class="col-sm-8 account_panel network" alt="network">
          <?php $this->load->view('account/network');?>
        </div><!--/span-->
        <div class="col-sm-8 account_panel interest" alt="interest">
          <?php $this->load->view('account/interest');?>
        </div><!--/span-->
        <div class="col-sm-8 account_panel  products" alt="products">
          <?php $this->load->view('account/products');?>
        </div><!--/span-->
        <div class="col-sm-8 account_panel instock" alt="instock">
          <?php $this->load->view('account/instock');?>
        </div><!--/span-->
      </div><!--/row-->
      <br style='clear:both'/>
      <hr>



    </div><!--/.container-->
    <script type="text/javascript">
    $(document).ready(function(){

      hide();
      $(".network").show();
      $(".connectionReq").on("click",function(){
        var action = $(this).attr('id');
        var uid = $(this).attr('uid');

        var that = $(this);
        if(action == "follow"){
          $.get("<?php echo base_url().'account/follow/'?>"+uid,function(data){
              $(that).attr('id','unfollow');
              $(that).html('Unfollow');
              $(that).removeClass('btn-success');
              $(that).addClass('btn-danger');
              console.log("unfollow");
          });
        } 
        else{
          $.get("<?php echo base_url().'account/unfollow/'?>"+uid,function(data){
              $(that).attr('id','follow');
              $(that).html('Follow');

              $(that).removeClass('btn-danger');
              $(that).addClass('btn-success');
              console.log("follow");
          });
        } 
      });

      
      $(".selectPanel").on('click',function(){
        var selected  = $(this).attr("alt");
        hide();
        $("."+selected).show();
      })
      
      function hide(){
        $(".account_panel").hide();
      }   
    });

  </script>