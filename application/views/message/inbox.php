<style>
#msg_box , #msg_reply {
  display: none; 
}
</style>
    <div class="col-sm-9">
      <div class="row" id="inbox">
          <div class="col-xs-12" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" class="btn btn-default btn-danger delete" >Delete</a>
            <a href="javascript:void(0)" class="btn btn-default btn-warning spam">Report Spam</a>
          </div>
          <div class="col-xs-12">
            <div class="alert alert-success" style="display:none">Message Sent</div>
            <?php if($this->session->flashdata("msg_sent")) { ?>
              <div class="alert alert-success" ><?php echo $this->session->flashdata("msg_sent");?></div>
            <?php } ; ?>
            <?php if($this->session->flashdata("msg_log")) { ?>
              <div class="alert alert-danger" >Message Deleted</div>
            <?php } ; ?>
            <form  method="POST" action="<?php echo base_url();?>messages/compose" >
            	<table class="table table-striped">
        			  <tr>
                  <th><input type="checkbox" id="main_check" /></th>
        			  	<th>From</th>
        			  	<th>Article</th>
                  <th>Subject</th>
        			  	<th>Date</th>
                </tr>
                <?php 
                    //print_r($messages);exit;
                  foreach( $messages as $message ) { ?>
                    <tr  >
                      <td><input type="checkbox" class="select_msg" alt="<?php echo $message['id'] ?>" /></td>
                      <td><?php echo $message['username'] ?></td>
                      <td><?php echo $message['article'] ?></td>
                      <td class="show_msg" alt="<?php echo $message['id'] ?>"><?php echo $message['subject'] ?></td>
                      <td><?php echo $message['created_on'] ?></td>
                    </tr>
                  <?php } ?>
        			</table>
            </form>
        </div>
      </div>
      <div class="row" id="msg_box">
          <div class="col-xs-12" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" class="btn btn-default btn-primary" id="back" >Back</a>
            <a href="javascript:void(0)" class="btn btn-default btn-success" id="reply" >Reply</a>
            <a href="javascript:void(0)" class="btn btn-default btn-danger delete"   >Delete</a>
            <a href="javascript:void(0)" class="btn btn-default btn-warning spam" >Spam</a>
          </div>
          <div class=" col-xs-12 mail-cont">
            <div class="mail-header">
              Date      : <span id="msg_date"></span> <br>
              From      : <span id="msg_from"></span> <br>
              To        : <span id="msg_to"></span> <br>
              Subject   : <span id="msg_subject"></span> <br>
            </div>
            <hr>
            <div class="mail-body" id="msg_body">
               
            </div>
          </div>
        </div>
        <div class="row" id="msg_reply">
          <div class="col-xs-12" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" class="btn btn-default btn-primary" id="re_back" >Back</a>
            <a href="javascript:void(0)" class="btn btn-default btn-success re_reply"  >Send</a>
          </div>
          <div class=" col-xs-12 mail-cont">
            <div class="mail-header">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label for="re_to" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="re_to" placeholder="username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="re_subject" class="col-sm-2 control-label">Subject</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="re_subject" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="re_message" class="col-sm-2 control-label">Message</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows = 10 id="re_message" placeholder="you message here!"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-xs-12" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" class="btn btn-default btn-success re_reply"  >Send</a>
          </div>
        </div>
    </div><!--/span-->
  </div><!--/row-->
</div><!--/.container-->
<script>
  $(document).ready(function(e){

      var article = "";
      var selected_mid = "";

      $(".category").on("click",function(){
        $(".category").removeClass('active');
        $(this).addClass('active');  
      });

      $(".alert").on("click",function(){
        $(this).hide();
      });

      $(".show_msg").on('click',function(){
        var id = $(this).attr('alt');
        $.get( "<?php echo base_url() ?>messages/message?id="+id, function( data ) {
            //console.log(data);
            //data.username;
            var msg = JSON.parse(data);

            $("#msg_date").text(msg.created_on);
            $("#msg_from").text(msg.from_user);
            $("#msg_to").text(msg.to_user);
            $("#msg_body").text(msg.message);
            $("#msg_subject").text(msg.subject);
            article = msg.article;
            $("#msg_box").show();
            $("#inbox").hide();
            selected_mid = msg.id; // to delete id
        });
  
      });

      $("#back").on('click',function(){
        var id = $(this).attr('alt');
        $("#msg_box").hide();
        $("#inbox").show();
      });

      $("#reply").on('click',function(){
        var username = $("#msg_from").text();
        var subject = $("#msg_subject").text();
        $("#re_to").val(username);
        $("#re_subject").val("RE : "+subject);
        $("#msg_reply").show();
        $("#msg_box").hide();
      });

      $("#re_back").on("click",function(){
        $("#msg_reply").hide();
        $("#msg_box").show();
      });

      $(".re_reply").on("click",function(){
        var username  = $("#re_to").val();
        var subject   = $("#re_subject").val();
        var message   = $("#re_message").val();
        var payload   = {
          username : username,
          subject : subject,
          message : message,
          article : article
        };
        $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>messages/reply",
          data: payload,
          success: function(data){
            console.log(typeof data);
            console.log(data);
            if(Number(data) == 1){
              console.log(" asdsad ere");
              $(".alert").text("Message sent");
              //$(".alert").addClass("alert-success");
              $(".alert").show();
              $("#msg_reply").hide();
              $("#inbox").show();
            }
            else{
              console.log("ere");
            }
          }
        }); 
      });

      $(".delete").on("click",function(){
        $.get( "<?php echo base_url() ?>messages/delete?mid="+selected_mid, function( data ) {
            if(Number(data) == 1){
              $(".alert-danger").show();
              location.href = "<?php echo base_url() ?>messages";
            }
        });
      });

      var main_selected = false;
      $("#main_check").on("click",function(){
        selected_mid =""
        if(main_selected)
        {
          $('.select_msg').prop('checked', false)
          main_selected = false;
        }
        else{
          $('.select_msg').prop('checked', true);
          $('.select_msg').each(function(key,val){
              selected_mid = selected_mid +','+val.alt;
          });
          selected_mid = selected_mid.replace(',','');
          main_selected = true;
        }
      });

      //selection algo for sending msg id 
      $(".select_msg").on('click',function(){
        var msg_id = $(this).attr('alt');
        var ischked = $(this).is(':checked');
      
        if(selected_mid.length > 0){
          if(selected_mid.indexOf(',') >= 0){
            var selectedArr = selected_mid.split(',');
            var tmpArr = [];
            selectedArr.forEach(function(e){
              if(e != msg_id){
                tmpArr.push(e);
              }
            });
            if(ischked){
              tmpArr.push(msg_id);
            }
            selected_mid = tmpArr.join(',');
          }
          else{
            if(selected_mid != msg_id && ischked )
              selected_mid = selected_mid+','+msg_id;
            else
              selected_mid = "";
          }
        }
        else{
          if(ischked){
              selected_mid = msg_id;
            }
          else{
            selected_mid = "";
          }
        }
        console.log(selected_mid);
      });

      $('.spam').on("click",function(){
        $.get( "<?php echo base_url() ?>messages/mark_spam?mid="+selected_mid, function( data ) {
            if(Number(data) == 1){
              $(".alert-danger").show();
              location.href = "<?php echo base_url() ?>messages";
            }
        });
      });

  });
</script>
