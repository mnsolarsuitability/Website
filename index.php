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
  
<?php include_once("assets/nav/header.php"); ?>

</head>

<body>

<!-- Top Nav -->
<?php include_once ("assets/nav/top_nav.php");?>
  
<!-- START OUR CONTENT -->
<div class="boundingbox">
  <div class="container">
    <div class="row">
      <div class="col-md-8" style="margin-top:40px">
	  
        <div class="row">
	      <div class="col-md-6" style="margin-top:15px">
	        <div class="topleft3Column">
              <p><em>The Minnesota Solar Suitability Analysis is an ongoing 
              project led by graduate students in the Masters of Geographic Information Science program at
              the University of Minnesota. The project aims to map solar potential
              on a large scale across Minnesota using Lidar data and GIS
              technology with the goal of providing free and open source tools and data to the GIS community.</em>	        </p>
	        </div>
          </div>
          <div class="col-md-6">
	        <div class="topcenter3Column">
              <p><span style="color:#7a0019; font-size:30px">&quot;Solar is Minnesota’s single
              largest energy resource.&quot;</span> <br>
              <span style="color:#7a0019; font-size:15px"><br>
              -National Renewable Energy Laboratory (NREL)</span></p>
            </div>
	      </div>
	    </div>
		
        <div class="row">
	      <div class="col-md-12">
		    <div class="bottomleft2Column" style="height:auto;width:auto;max-width:720px;max-height:720px">
            <a href="/app"><img src="./assets/img/webapp_welcomefull4.jpg"
            style="width:100%" alt=" "></a>
            </div>
		  </div>
		</div>
		  		
      </div>
	  
	  <div class="col-md-4" style="margin-top:40px">
	    <div class="topright3Column">
		  <h4>Latest news:</h4>
		  <br>
		  
          <script type="text/javascript" src="http://mnsolarsuitability.tumblr.com/api/read/json"></script>
          <script type="text/javascript">
	  	  for(i=0; i<3; i++){
		      document.write('<div class="tumblrBox">');
		      if (tumblr_api_read['posts'][i]['regular-title'] !=null) {
                document.write('<div class="tumblrTitle">' + tumblr_api_read['posts'][i]['regular-title'] + '</div>')
              }else{
	  		    document.write('<div class="tumblrTitle">Untitled</div>')
		  	    }
				
				var regpost = tumblr_api_read['posts'][i]['regular-body'];
				
				if (regpost.length > 320) {
					
					regpost = regpost.substring(0,320) + '... <a href=\'' + tumblr_api_read['posts'][i]['url'] + '\' target=\'_blank\'>Read More &gt;&gt;</a>';

					
					}
   
					
  	          document.write('<div class="tumblrDate">' + tumblr_api_read['posts'][i]['date'] + '</div>\
                       		<br>\<div class="tumblrPost">' + regpost + '</div></div>');
			  };

          </script>
          <br>
          <br>
	    </div>
	  </div>	 
    </div>
  </div>
</div>
<!-- END OF BOUNDING BOX -->

    <!-- BEGIN UofM FOOTER -->
<?php include_once ("assets/nav/footer.php");?>
</body>
</html>