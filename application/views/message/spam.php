<div class="col-sm-9">
      <div class="row" id="inbox">
          <div class="col-xs-12" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" class="btn btn-default btn-danger delete" >Delete</a>
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