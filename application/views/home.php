
    <style type="text/css">
    #map-canvas {
        height: 100%;
        position: fixed !important;
        top: 0;
        bottom: 0px;
        left: 0;
        right: 0;
        z-index: 0;
      }

    .container {
      z-index: 100;
      position: relative;
    }

      /*    
      #map-canvas { 
        box-shadow: 5px 7px 5px #888888;
        margin-top: 25px;
        height: 100% } */

        .gm-style-iw div{
          overflow: hidden !important ;
        }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQyK6vL5GbHnP4r1RcQ6xQWjt82MnXZgI&sensor=true">
    </script>
    <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/data.json"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/markerclusterer_compiled.js"></script>
    <script type="text/javascript">
      function initialize() {
        var myLatlng = new google.maps.LatLng(43, 12);
        var mapOptions = {
          zoom: 2,
          center: myLatlng,
          minZoom: 2, 
          maxZoom: 9 
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

         var markers = [];

        var users = <?php echo $users ; ?>;
        console.log(users);

        for (var i = 0; i < users.length ; i++) { 
          markers.push(setMarker( map ,users[i])); 
        }
      
        var markerCluster = new MarkerClusterer(map, markers);
      }

      google.maps.event.addDomListener(window, 'load', initialize);
     
      prev_infowindow = false;
      function setMarker(map, usrdata) {     
        var p = usrdata;    
        var latLng = new google.maps.LatLng(usrdata.lat,usrdata.lng);
         var img_url = ""
        if(usrdata.img_url != "" ) { img_url = '<?php echo base_url()."pics/";?>'+usrdata.img_url ; } else { img_url = '<?php echo base_url()."assets/img/male.png";?>'; }
        var interest = "";
        if(usrdata.interest != null ){
             interest = '<div class="usrint">'+usrdata.interest+'</div>';                      
        }
        var contentString =   '<div class="row cards" style="width:250px;" >'+
                                '<div class="col-xs-12">'+
                                   '<div class="row">'+
                                      '<div class="col-xs-5"><img src="'+ img_url +'" style="width:100px" /></div>'+
                                      '<div class="col-xs-7">'+
                                        
                                          '<div class="usrname"><a href = "<?php echo base_url()?>'+'account?id='+usrdata.id+'">'+usrdata.firstname+' '+usrdata.lastname+'</a></div>'+
                                          '<div class="usrtype">'+usrdata.type+'</div>'+
                                          interest
                                          +
                                          '<a class=" col-xs-12 btn btn-warning msg_user" href="#data"  alt="" uname='+usrdata.username+'>Message</a>'+
                                      '</div>'+
                                    '</div>'+
                                   '<div class="row"></div>'+
                                '</div>'+
                              '</div>';

        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
            html: contentString
        });
        
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

      
        google.maps.event.addListener(marker, "click", function () {
            if (prev_infowindow) {
                prev_infowindow.close();
            }
            infowindow.setContent(this.html);
            infowindow.open(map, this);
            prev_infowindow = infowindow;
        });

        return marker;
      }



    </script>

    <div class="container">

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

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-md-3">
          <div class="bs-sidebar hidden-print affix" role="complementary">
            <ul class="nav bs-sidenav">
                <li class="category active">
                  <a  href="#js-overview">Agriculture</a>
                  <ul class="nav">
                    <li class=""><a href="#js-individual-compiled">Soyabeans</a></li>
                    <li class=""><a href="#js-data-attrs">Rice</a></li>
                    <li class=""><a href="#js-programmatic-api">Apples</a></li>
                    <li><a href="#js-noconflict">Groundnuts</a></li>
                    <li class=""><a href="#js-events">Cashewnuts</a></li>
                  </ul>
                </li>
                <li class="category" class=""><a href="#transitions">Raw Materials</a></li>
                <li class="category" class="">
                  <a href="#modals">Chemical</a>
                  <ul class="nav">
                    <li class=""><a href="#modals-examples">Iodine</a></li>
                    <li class=""><a href="#modals-usage">Carbon</a></li>
                  </ul>
                </li>
                <li class="category" class="">
                  <a href="#dropdowns">Computers</a>
                  <ul class="nav">
                    <li class=""><a href="#dropdowns-examples">Keyboard</a></li>
                    <li><a href="#dropdowns-usage">Monitor</a></li>
                  </ul>
                </li>
 
              
            </ul>
          </div>
        </div>

        <!-- div class="col-sm-9">
            <div style="height:570px;">
              <ul class="nav nav-pills">
                <li class="active"><a href="#">Map View</a></li>
                <li><a href="#">Grid View</a></li>
                <li><a href="#">List View</a></li>
              </ul>
              <div id="map-canvas"/>
            </div>
        </div -->

        
      </div><!--/row-->
     
    </div><!--/.container-->

    <div id="map-canvas"/>

    <script>

   

$(document).ready(function(){ 
  $(".category").on("click",function(){
              $(".category").removeClass('active');
              $(this).addClass('active');  
            });

  /*
  $(".msg_user").on('click',function(){
    alert("hello");
  }); */

  
    $('.msg_user').fancybox({
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
});
</script>
