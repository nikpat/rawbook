
    <div class="col-sm-9">
        <form method="POST" action="<?php echo base_url();?>messages/compose" >
        	this is asdsad
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
