
<div style="display:none">
    <div id="data">
      <div style="width:800px" >
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="msgUname" placeholder="Username" required>
          </div>
          <div class="form-group">
            <label for="article">Article</label>
            <select class="form-control" name="msgArticle" id="msgArticle">
                <option value="groundnut" >groundnut</option>
                <option value="cashewnut">cashewnut</option>
                <option value="soya">soya</option>
                <option value="rice">rice</option>
            </select>
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input name="subject" type="text" class="form-control" id="msgSubject" placeholder="Subject">
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" type="text" class="form-control" id="msgContent" placeholder="Message"></textarea>
          </div>
          <button id="msgSend" class="btn btn-default btn-success">Send</button>
      </div><!--/span-->
    </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <ul class="nav nav-pills">
      <li class="active network_selector" alt="showUserFollower"><a href="javascript:void(0)">Followers</a></li>
      <li class="network_selector" alt="showUserFollowing"><a href="javascript:void(0)">Following</a></li>
    </ul>
  </div>
</div>
<div class="row user_network user_follower">
 
  
  <?php foreach ($user_follower as $value) { ?>
  <div class="col-xs-6">
      <div class="row cards" >
      <div class="row">
        <div class="col-xs-5"><img src="<?php echo base_url().'assets/img/male.png';?>" style="width:100px"></div>
        <div class="col-xs-7">
          <div class="row">
            <div class="usrname"><a href = "<?php echo base_url().'account?id='.$value['id'];?>" ><?php echo $value['firstname']." ".$value['lastname'] ; ?></a></div>
            <div class="usrtype"><?php echo $value['type']; ?></div>
            <div class="userrole" title="<?php echo $value['interest']; ?>"><?php echo $value['interest']; ?></div>
          </div>
        </div>
      </div>
       <div class="row">
        <div class="col-xs-12">
          <?php 

          if(strrpos($following_ids, $value['id'])) { ?>
            <a class=" col-xs-6 btn btn-danger connectionReq" uid="<?php echo $value['id'] ;?>" id="unfollow">Unfollow</a>  
          <?php } 
            else
            { ?>
            <a class=" col-xs-6 btn btn-success connectionReq" uid="<?php echo $value['id'] ;?>" id="follow">Follow</a>  
          <?php } ?>
          <a class=" col-xs-6 btn btn-warning msg_user" href="#data" alt="<?php echo $value['id'] ;?>" uname="<?php echo $value['username']?>">Message</a>
        </div>
      </div>
    </div>
  </div>
  <?php  }?> 
</div>
<div class="row user_network user_following">
  <?php foreach ($user_following as $value) { ?>
  <div class="col-xs-6">
      <div class="row cards" >
      <div class="row">
        <div class="col-xs-5"><img src="<?php echo base_url().'assets/img/male.png';?>" style="width:100px"></div>
        <div class="col-xs-7">
          <div class="row">
            <div class="usrname"><a href = "<?php echo base_url().'account?id='.$value['id'];?>" > <?php echo $value['firstname']." ".$value['lastname'] ; ?></a></div>
            <div class="usrtype"><?php echo $value['type']; ?></div>
            <div class="userrole" title="<?php echo $value['interest']; ?>"><?php echo $value['interest']; ?></div>
          </div>
        </div>
      </div>
       <div class="row">
        <div class="col-xs-12">
         <?php if(strrpos($following_ids, $value['id'])) { ?>
            <a class=" col-xs-6 btn btn-danger connectionReq" uid="<?php echo $value['id'] ;?>" id="unfollow" >Unfollow</a>  
          <?php } 
            else
            { ?>
            <a class=" col-xs-6 btn btn-success connectionReq" uid="<?php echo $value['id'] ;?>" id="follow" >Follow</a>  
          <?php } ?>
          <a class=" col-xs-6 btn btn-warning msg_user" href="#data" alt="<?php echo $value['id'] ;?>" uname="<?php echo $value['username']?>">Message</a>
        </div>
      </div>
    </div>
  </div>
  <?php  }?> 
</div>
<script>
$(document).ready(function(){ 

  $(".msg_user").fancybox({
      scrolling   : 'hidden',
      helpers     : {
            overlay: {
              locked: true 
            }
          },
     afterShow : function(){
      var currentDiv = this.element[0];
      var msgUname = $(currentDiv).attr('uname');
      $("#msgUname").val(msgUname);
    }
  });

  $("#msgSend").on("click",function(){
    $.fancybox.close() ;
    var payload = {
      username:$("#msgUname").val() ,article : $("#msgArticle").val() , subject : $("#msgSubject").val() , message : $("#msgContent").val() 
    }
    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>messages/ajax_compose",
      data: payload,
      success: function(data){
        console.log(data);
      }
      //dataType: 'JSON'
    });
  });

  $('.user_network').hide();
  $('.user_follower').show();
  $('.network_selector').on('click',function(){
    var show = $(this).attr('alt');
    if(show == 'showUserFollower'){
      $('.active').removeClass('active');
      $(this).addClass('active');
      $('.user_network').hide();
      $('.user_follower').show();
    }
    if(show == 'showUserFollowing'){
      $('.active').removeClass('active');
      $(this).addClass('active');
      $('.user_network').hide();
      $('.user_following').show();
    }
  });
});
</script>
