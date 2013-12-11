
    <div class="col-sm-9">
        <?php echo validation_errors(); ?>
        <form role="form" method="POST" action="<?php echo base_url();?>messages/compose">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Username">
        </div>
        <div class="form-group">
          <label for="article">Article</label>
          <select class="form-control" name="article" >
              <option value="groundnut" >groundnut</option>
              <option value="cashewnut">cashewnut</option>
              <option value="soya">soya</option>
              <option value="rice">rice</option>
          </select>
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea name="message" type="text" class="form-control" id="message" placeholder="Message"></textarea>
        </div>
        <button type="submit" class="btn btn-default btn-success">Send</button>
      </form>
    </div><!--/span-->

    
  </div><!--/row-->



  <script>
    $(document).ready(function(e){
        $(".category").on("click",function(){
          $(".category").removeClass('active');
          $(this).addClass('active');  
        });
    });
  </script>
</div><!--/.container-->
