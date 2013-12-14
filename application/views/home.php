
    <style type="text/css">
      #map-canvas { 
        box-shadow: 5px 7px 5px #888888;
        margin-top: 25px;
        height: 100% }
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
          center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

         var markers = [];

        var users = <?php echo $users ; ?>;
        console.log(users);

        for (var i = 0; i < users.length ; i++) { 
          markers.push(setMarker( map ,users[i])); 
        }

        

        /*
        for (var i = 0; i < 100; i++) {
          var dataPhoto = data.photos[i];
          var latLng = new google.maps.LatLng(dataPhoto.latitude,
              dataPhoto.longitude);
          var marker = new google.maps.Marker({
            position: latLng
          });
          markers.push(marker);
        } */
      
        

        var markerCluster = new MarkerClusterer(map, markers);
      }

      google.maps.event.addDomListener(window, 'load', initialize);
      prev_infowindow = false;

      function setMarker(map, usrdata) {     
        var p = usrdata;    
        var latLng = new google.maps.LatLng(usrdata.lat,usrdata.lng);

        var contentString =   '<div class="row cards" >'+
                                '<div class="col-xs-12">'+
                                   '<div class="row">'+
                                      '<div class="col-xs-5"><img src="<?php echo base_url() ; ?>assets/img/male.png" style="width:100px" /></div>'+
                                      '<div class="col-xs-7">'+
                                        '<div class="row">'+
                                          '<div class="usrname"><a href = "<?php echo base_url()?>'+'account?id='+usrdata.id+'">'+usrdata.firstname+' '+usrdata.lastname+'</a></div>'+
                                          '<div class="usrtype">'+usrdata.role+'</div>'+
                                        '</div>'+
                                      '</div>'+
                                    '</div>'+
                                   '<div class="row"><div class="col-xs-12"><a class=" col-xs-6 btn btn-warning msg_user" href="#data" alt="" uname='+usrdata.username+'>Message</a></div></div>'+
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

        <div class="col-sm-9">
            <div style="height:570px;">
              <ul class="nav nav-pills">
                <li class="active"><a href="#">Map View</a></li>
                <li><a href="#">Grid View</a></li>
                <li><a href="#">List View</a></li>
              </ul>
              <div id="map-canvas"/>
            </div>
        </div><!--/span-->

        
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Snoogle Company 2013</p>
      </footer>
      <script>
        $(document).ready(function(e){
            $(".category").on("click",function(){
              $(".category").removeClass('active');
              $(this).addClass('active');  
            });
        });
      </script>
    </div><!--/.container-->
