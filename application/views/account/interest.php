<style>
.cat_title {
font-size: 15px;
background-color: black;
position: absolute;
opacity: 0.6;
color: white;
}
</style>
<div class="row">
  <div class="col-xs-12">
    <ul class="nav nav-pills">
      <li class="selector active show_following" alt="show_following" ><a href="javascript:void(0)"  >Following</a></li>
      <li class="selector show_categories " alt=""><a href="javascript:void(0)" >Add More</a></li>
    </ul>
  </div>
</div>

<div class="row interestPanels userInterest">
  <?php foreach ($user_cats as $value) { ?>
  <div class="col-xs-4">
      <div class="row cards" >
      <div class="row">
        <div class="col-xs-12"><span class="cat_title"><?php echo $value['title']?></span><img src="<?php echo base_url().$value['img']?>" style="width:210px"></div>
      </div>
       <div class="row">
        <div class="col-xs-12">
          <a class=" col-xs-12 btn btn-danger followUnfollowCat" alt="<?php echo $value['id'] ;?>" action="unfollow">Unfollow</a>
        </div>
      </div>
    </div>
  </div>
  <?php  }?> 
</div>

<div class="row interestPanels allCat">
  <?php foreach ($cats as $value) { ?>

  <div class="col-xs-4">
      <div class="row cards" >
      <div class="row">
        <div class="col-xs-12"><span class="cat_title"><?php echo $value['title']?></span><img src="<?php echo base_url().$value['img']?>" style="width:210px"></div>
      </div>
       <div class="row">
        <div class="col-xs-12">
          <a class=" col-xs-12 btn btn-success followUnfollowCat" alt="<?php echo $value['id'] ;?>" action="follow" >Follow</a>
        </div>
      </div>
    </div>
  </div>
  <?php  }?> 
</div>


<script>
$(document).ready(function(){
    hide();
    $(".userInterest").show();
    $(".show_categories").on("click",function(){
      hide();
      $(".active").removeClass('active');
      $(this).addClass('active');
      $(".allCat").show();
    });

    $(".show_following").on("click",function(){
      hide();
      $(".active").removeClass('active');
      $(this).addClass('active');
      $(".userInterest").show();
    });


    $(".followUnfollowCat").on('click',function(){
      var category_id = $(this).attr("alt");
      var action  = $(this).attr("action");
      var that = $(this);
   
      if(action == "follow"){
        $.get( "<?php echo base_url();?>account/follow_category/"+category_id, function( data ) {
          that.html("Unfollow");
          that.attr("action","unfollow");
          that.removeClass("btn-success");
          that.addClass("btn-danger");
        });
      }
      else{
        $.get( "<?php echo base_url();?>account/unfollow_category/"+category_id, function( data ) {
          that.html("Follow");
          that.attr("action","follow");
          that.removeClass("btn-danger");
          that.addClass("btn-success");
        });
      }
    });

    function hide(){
     $(".interestPanels").hide();  
    }

});


</script>