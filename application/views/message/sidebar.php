
    <style type="text/css">
      #map-canvas { 
        margin-top: 25px;
        height: 100% }
    </style>


    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-md-3">
          <div class="bs-sidebar hidden-print affix" role="complementary">
            <ul class="nav bs-sidenav">

                <li class="category <?php echo $selected == 'inbox' ? 'active' : ''?>">
                  <a  href="<?php echo base_url().'messages/inbox';?>">Inbox</a>
                </li>
                <li class="compose <?php echo $selected == 'compose' ? 'active' : ''?>">
                  <a  href="<?php echo base_url().'messages/compose';?>">Compose</a>
                </li>
                <li class="sent <?php echo $selected == 'sent' ? 'active' : ''?>" >
                	<a href="<?php echo base_url().'messages/sent';?>">Sent</a>
                </li>
                <li class="spam <?php echo $selected == 'spam' ? 'active' : ''?>" >
                  <a href="<?php echo base_url().'messages/spam';?>">Spam</a>
                </li>
                <li class="thrash <?php echo $selected == 'thrash' ? 'active' : ''?>" >
                  <a href="<?php echo base_url().'messages/thrash';?>">Thrash</a>
                </li>             
            </ul>
          </div>
        </div>