<!DOCTYPE html>
<html>
<head>
  <!-- University of Minnesota Web template:  v5.101021 -->
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <meta content="Chris Martin" name="author">
  <meta content="Solar Suitability Analysis - UMN" name="description">
  <meta content="solar, Minnesota, University of Minnesota, UMN" name="keywords">
  <meta content="09/16/2014" name="date">

  <title>Minnesota Solar Suitability Analysis</title>
  
    <?php>$path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/assets/nav/header.php";
        include_once($path);?>

</head>

<body>

<!-- Top Nav -->
<?php>$path = $_SERVER['DOCUMENT_ROOT'];
      $path .= "/assets/nav/top_nav.php";
      include_once($path);?>
	  
<!-- START OUR CONTENT -->

<div class="boundingbox">
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="margin-top:40px">
	    <h4>News Stream</h4>
		<script type="text/javascript" src="http://mnsolarsuitability.tumblr.com/api/read/json"></script>
		<script>
		  
		  for(i=0; i<tumblr_api_read['posts-total']; i++){
		    document.write('<div class="tumblrBox">')
		    if (tumblr_api_read['posts'][i]['regular-title'] !=null) {
              document.write('<div class="tumblrTitle">' + tumblr_api_read['posts'][i]['regular-title'] + '</div>')
            }else{
			  document.write('<div class="tumblrTitle">Untitled</div>')
			  }
			document.write('<div class="tumblrDate">' + tumblr_api_read['posts'][i]['date'] + '</div>\
			<br>\
            <div class="tumblrPost">' + tumblr_api_read['posts'][i]['regular-body'] + '</div></div>');
			};
		  //alert(tumblr_api_read['posts-total']);
		</script> 		
      </div>				 
    </div>
  </div>
</div>
<!-- END OF BOUNDING BOX -->


  <!-- BEGIN UofM FOOTER -->
<?php>$path = $_SERVER['DOCUMENT_ROOT'];
      $path .= "/assets/nav/footer.php";
      include_once($path);?>
</body>
</html>