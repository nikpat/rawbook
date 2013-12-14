

  <!-- Global CSS for the page and tiles -->
  <link href="<?php echo base_url().'assets/css/main.css';?>" rel="stylesheet">
  <!-- link href="<?php echo base_url().'assets/css/reset.css';?>" rel="stylesheet" -->
  <style>
  .cards {
    background-color:white;
    box-shadow: 5px 7px 5px #888888;
    margin:10px;
  }
  .settingfrom{
    margin: 20px;
  }
  
  #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      } 
    
  </style>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQyK6vL5GbHnP4r1RcQ6xQWjt82MnXZgI&sensor=true">
    </script>
    
    <div class="container">

      <div class="row">

        <div class="col-md-3">
         <ul class="nav nav-pills nav-stacked">
          <li class="active selector" alt="account"><a href="#">Account</a></li>
          <li class="selector" alt="changepass"><a href="#">Change Password</a></li>
          <li class="selector" alt="privacy"><a href="#">Privacy</a></li>
          <li class="selector" alt="notification"><a href="#">Notification</a></li>
        </ul>
        </div>
        <div class="col-sm-9">


          <div class="account settings row cards">
            <?php echo validation_errors(); ?>
            <form class="settingfrom form-horizontal" method="POST" action="<?php echo base_url().'account/settings/'.$user_info['id'] ; ?>" enctype="multipart/form-data" role="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Profile Image</label>
                <div class="col-sm-10">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                      <img src="<?php echo  ($user_info['img_url'] != "") ? base_url().'pics/'.$user_info['img_url'] : base_url().'assets/img/male.png' ?>" data-src="" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                      <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="file"></span>
                      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">First name</label>
                <div class="col-sm-10">
                  <input type="text" name="firstname" class="form-control" id="inputEmail3" placeholder="Firstname" value="<?php echo $user_info['firstname']?>" >
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Middle name</label>
                <div class="col-sm-10">
                  <input type="text" name="middlename" class="form-control" id="inputEmail3" placeholder="middlename" value="<?php echo $user_info['middlename']?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Last name</label>
                <div class="col-sm-10">
                  <input type="text" name="lastname" class="form-control" id="inputEmail3" placeholder="Lastname" value="<?php echo $user_info['lastname']?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                <div class="col-sm-10">
                  <label class="radio-inline">
                    <input type="radio" name="gender" id="inlineCheckbox2" value="1" <?php echo ($user_info['gender'] == 1 )?'checked':'' ?> > Male
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="gender" id="inlineCheckbox3" value="0" <?php echo ($user_info['gender'] == 0 )?'checked':'' ?> > Female
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Date of birth</label>
                <div class="col-sm-10">
                  <input type="text" name="dob" class="form-control" id="datepicker" placeholder="date of birth" value="<?php echo $user_info['dob']?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?php echo $user_info['email']?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-3">
                  <select name="country" class="form-control" id="select_counrty">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) { ?>
                        <option code="<?php echo $country['Code']; ?>" value="<?php echo $country['Name']; ?>" <?php echo ($country['Name'] == $user_info['country'])?'selected':'' ?>><?php echo $country['Name'] ; ?></option>
                    <? }?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">City</label>
                <div class="col-sm-3">
                  <select name="city" class="form-control" id="select_city">
                    <option value="<?php echo $user_info['city']; ?>"><?php echo $user_info['city']; ?></option>
                  </select>
                </div>
              </div>
              
             
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </div>
            </form>
          </div>




          <div class="changepass settings row cards">
            <form class="settingfrom form-horizontal" method="POST" action="<?php echo base_url().'account/password_change/'.$user_info['id'] ; ?>" role="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Old Password</label>
                <div class="col-sm-10">
                  <input type="password" name="old_pass" class="form-control" id="old_pass" placeholder="Old Password">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                  <input type="password" name="new_pass" class="form-control" id="new_pass" placeholder="password">
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                  <input type="password" name="confirm_pass" class="form-control" id="confirm_pass" placeholder="confirmpassword">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-success">Change</button>
                </div>
              </div>
            </form>
          </div>
          <div class="privacy settings row cards">
            <form class="settingfrom form-horizontal" role="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Restrict Follow</label>
                <div class="col-sm-10">
                 On : <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                 Off : <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </div>
            </form>
          </div>
          <div class="notification settings row cards">
            <form class="settingfrom form-horizontal" role="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Message Notification</label>
                <div class="col-sm-10">
                 On : <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                 Off : <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Follow Notification</label>
                <div class="col-sm-10">
                 On : <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                 Off : <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-success">Sign in</button>
                </div>
              </div>
            </form>
          </div>
        </div><!--/span-->
      </div><!--/row-->
      <br style='clear:both'/>
      <hr>



    </div><!--/.container-->
    <script type="text/javascript">
    $(document).ready(function(){
      
      $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

      hideall();

      $(".account").show();
      $(".selector").on("click",function(){
        hideall();
        var selected = $(this).attr("alt");
        $(".selector").removeClass('active');
        $(this).addClass('active');
        $("."+selected).show();
      });

      function hideall(){
        $(".settings").hide();
      }

      $("#select_counrty").on("change",function(){
        var code = $('#select_counrty :selected').attr('code');
        $.get("<?php echo base_url().'account/get_cities/';?>"+code,function(data){
          var cities = JSON.parse(data);
          var innerString = "";
          cities.forEach(function(e){
            console.log(e);
            innerString += "<option value="+e.Name+">"+e.Name+"</option>"
          });
           
          $("#select_city").html(innerString);

        });
      });

    });
  </script>