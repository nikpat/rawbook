<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Request a software</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.css';?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
    <style>
    h3 {
     font-family: 'Shadows Into Light Two', cursive;
    }
    h1 {
      /*font-family: 'Lily Script One', cursive; */
      font-family: 'Lobster', cursive;
    }
    body {
      background-color: #E6E6E6 ;
          }


input[type="range"] {
    width: 100%;
    /*margin: 100px; */
    background: rgb(124, 209, 180);
    -webkit-appearance: none;
    border-radius: 10px;
    padding: 5px;
    transition: opacity 0.5s;
    position: relative;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    border-radius: 10px;
    background: #fff;
    z-index: 1;
    width: 75px;
    position: relative;
    height: 55px;
}

input[type="range"]:before {
    content: "slide to submit";
    color: #8a8a8a;
    position: absolute;
    left: 100px;
    top: 10px;
    z-index: 1;
    font-size: 32px;
}

input[type="range"]::-webkit-slider-thumb:before {
    color: rgb(70, 188, 149);
    position: absolute;
    left: 10px;
    top: -10px;
    z-index: 1;
    font-size: 56px;
    font-weight: bold;
    content: "→";
}
    </style>
  </head>

  <body>
    <div class="container">

      <div class="page-header">
        <h1 >Request List </h1>
      </div>

      <div class="row">
            <table class="table">
             <tr>
              <th style="width: 25%;"> Email ID </th>
              <th> Description </th>
             </tr>
             <?php foreach($requests as $req) { ?>
              <tr>
                <td> <?php echo $req['email']; ?> </td>
                <td> <?php echo $req['description']; ?> </td>
              </tr>
             <?php } ?>
            </table>
      </div>

    </div> <!-- /container -->

<script>

document.querySelector("input[type=\"range\"]").onmouseup = function() {
    var theRange = this.value;
    if(theRange == 100) {

      unlock();

    } else {
      document.init = setInterval(function() {
        if(document.querySelector("input[type=\"range\"]").value != 0) {
          document.querySelector("input[type=\"range\"]").value = theRange--;
        }
      }, 1);
    }
}

document.querySelector("input[type=\"range\"]").onmousedown = function() {
    clearInterval(document.init);
}

function unlock() {
    document.querySelector("input[type=\"range\"]").style.opacity = "0";
    setTimeout(function() {
        
    document.querySelector("input[type=\"range\"]").value = "0";    document.querySelector("input[type=\"range\"]").style.opacity = "1";
    }, 1000);
}
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44989355-1', 'requestasoftware.com');
  ga('send', 'pageview');

</script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
