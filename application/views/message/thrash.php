<div class="col-sm-9">
      <div class="row" id="inbox">
          <div class="col-xs-12" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" class="btn btn-default btn-danger delete" >Delete Forever</a>
            <a href="javascript:void(0)" class="btn btn-default btn-success recover" >Recover</a>
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
        			  	<th>Subject</th>
        			  	<th>Date</th>
                </tr>
                <?php 
                    //print_r($messages);exit;
                  foreach( $messages as $message ) { ?>
                    <tr  >
                      <td><input type="checkbox" class="select_msg" alt="<?php echo $message['id'] ?>" /></td>
                      <td><?php echo $message['username'] ?></td>
                      <td class="show_msg" alt="<?php echo $message['id'] ?>"><?php echo $message['subject'] ?></td>
                      <td><?php echo $message['created_on'] ?></td>
                    </tr>
                  <?php } ?>
        			</table>
            </form>
        </div>
      </div>
</div>
</div><!--/row-->
</div><!--/.container-->
<script>
$(document).ready(function(){
  var selected_mid = "" ;
  $(".recover").on('click',function(){

  });

  $(".delete").on('click',function(){
    if(confirm("Are you sure?")){
      $.get( "<?php echo base_url() ?>messages/delete_forever?mid="+selected_mid, function( data ) {
          if(Number(data) == 1){
            //$(".alert-danger").show();
            location.href = "<?php echo base_url() ?>messages/thrash";
          }
      });
    }
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
});
</script>