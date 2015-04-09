<!DOCTYPE html>
<html>
<head>
  <!-- University of Minnesota Web template:  v5.101021 -->
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <meta content="Chris Martin" name="author">
  <meta content="Solar Suitability Analysis - UMN" name="description">
  <meta content="solar, Minnesota, University of Minnesota, UMN" name="keywords">
  <meta content="09/16/2014" name="date">

  <title>Products & Results | Minnesota Solar Suitability Analysis</title>
 
  <?php include_once("assets/nav/header.php"); ?>

      <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<!--<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	<script src="http://cdn-geoweb.s3.amazonaws.com/esri-leaflet/1.0.0-rc.4/esri-leaflet.js"></script> 
	<script src="/lib/leaflet.ajax.min.js"></script>
	<script src="/lib/counties.js"></script>
	<script> $(function() {
		
		/*$("body").on("shown.bs.tab", "#tester", function() {
			console.log("Changing size");
            //ap.invalidateSize(false);
            L.Util.requestAnimFrame(map.invalidateSize,map,!1,map._container);
        });*/
    });
    </script>
    	<!-- Add jQuery library -->
	<script type="text/javascript" src="/lib/fancyBox/lib/jquery-1.10.1.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="/lib/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="/lib/fancyBox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="/lib/fancyBox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<script type="text/javascript">
		$(document).ready(function() {

			$('.fancybox').fancybox();

		});
	</script>
</head>

<body>

	

<!-- Top Nav -->
<?php include_once ("assets/nav/top_nav.php");?>
<!-- START OUR CONTENT -->

 <div class="boundingbox">
   <div class="container-full">
     <div class="row">
	   <div class="col-md-3">
	     <ul class="nav nav-tabs nav-stacked">
                
              <a href="#gisdata" data-toggle="tab" class="noUnderline"><li style="margin-top:20px">GIS Data</li></a>
			  
			  <a href="#currentIssues" data-toggle="tab" class="noUnderline" id="mapResize"><li>Current Data Issues</li></a>
			  
			  <a href="#presentations" data-toggle="tab" class="noUnderline"><li>Presentations</li></a>
			  
              <a href="#gallery" data-toggle="tab" class="noUnderline"><li>Map Gallery</li></a>
              
			  <a href="#media" data-toggle="tab" class="noUnderline"><li>Video/Photos</li></a>
		
              <a href="#press" data-toggle="tab" class="noUnderline"><li>Press/Publications</li></a>

              <a href="#scripts" data-toggle="tab" class="noUnderline"><li>Scripts</li></a>

          </ul>
	   </div>
       <div class="col-md-9 col-lg-9">
         <div class="products">
		   <h1 style="margin-left:-20px">Products & Results</h1>
		   <div class="tab-content">  
             <div class="tab-pane active" id="gisdata">
			   <p style="margin-top:10px">For more information about the availability of data products, contact the 
    		   <a href="mailto:uspatial@umn.edu?Subject=Solar%20information%20request" target="_top">U-Spatial help desk</a>.</p>
	    	   <h4>Solar Insolation Raster</h4>
    	       <p>To view and query insolation values by location <a href="app">view our webmap</a>.</p>
			   <p>Please click <a href="#currentIssues" data-toggle="tab">here</a> for a list of current issues with our data.</p>
               <p style="text-decoration:underline">Pending a full production license for one of the software tools used, the data will be made available for public consumption through a web map 
               service (WMS), or on other media upon request.</p>

               <h4>Digital Surface Model</h4>

               <p>As an intermediate data product we created a 1 meter DSM (digital surface model) for the entire state. If you are interested in this data please email the <a 
               href="mailto:uspatial@umn.edu?Subject=Solar%20information%20request" target="_top">U-Spatial help desk</a>.</p>
			   
			   <br>
			   <p style="color:#7a0019;font-size:20px">"I used the map today to determine whether to include an additional roof for Solar placing on a group of buildings. It was going to 
                   be touch or go whether I was going to include it in an initial quotation. I can now make my determination instantly!" - Matthew Blackler, Founder, ZEF Energy</p>
			 </div>
			 
			 <div class="tab-pane" id="currentIssues">
			   <h4>Current Data Issues:</h4>
			   
    		   <h3>&quot;Gaps&quot; in the Solar Suitability Data</h3>
    		   <p>There are presently what appear to be large  &quot;gaps&quot; in the solar suitability data available via our  app. These gaps correspond to areas where the existing publicly available county level lidar data did not conform to the standards used for the rest of the state due to early adoption from these counties. The data provided by these counties was either missing full classification of lidar points other than &quot;ground&quot; (buildings, vegetation, etc.), or the non-ground point returns were removed entirely.  Our processing model ignored unclassified points, resulting in a digital surface model devoid of non-ground features for these areas, creating what look like county-wide swaths with no shade. </p>
    		   
			   <p>We are currently working to remedy these blank areas where suitable data exists. However, non-ground returns are totally absent for three counties, and new data will need to become available before they can be fixed.    </p>
		       <!--<p><img src="/assets/img/reprocessmap-11-17-14.jpg" class="prodImg" style="margin-bottom:0px"></p>-->
		       <div id="map" style="width:800px; height:800px"></div>
    		   <h3>Final Stages of Reprocessing:</h3>
		         <ul>
		           <li>Crow Wing</li>
				   <li>Pine</li>
				   <li>Stearns</li>
				   <li>Wright</li>
    		     </ul>

    		   <h3>Counties Requiring New Data:</h3>
		       <ul>
  		         <li>Chisago</li>
                 <li>McLeod</li>
                 <li>Rice</li>
               </ul>
			   
			   <h3 style="border-top:1px solid black; border-bottom:1px solid black; margin-bottom:15px;">Data Examples:</h3>
			   <p><img src="/assets/img/crowwinggap.jpg" class="prodImg"><br>
    		   Incomplete solar data is evident in Crow Wing County. </p>
    		   <p><img src="/assets/img/pinestriping.jpg" class="prodImg"><br>
    		   Our processing model caught a non-standard classification for flight-path overlap in Pine County, resulting in a visible striping pattern in the solar data. </p>
    		   <p><img src="/assets/img/crowingwinglaz.jpg" class="prodImg"><br>
    		   Crow Wing County lidar point cloud, colored by classification. 
			   <br>Brown is ground, gray is unclassified.  Points representing buildings, trees, and more are present but unclassified in the lidar data. </p>
    		   <p><img src="/assets/img/chisagolaz.jpg" class="prodImg"><br>
      		   Chisago County lidar point cloud, colored by classification. 
			   <br>
    		   Only the ground points are contained in the lidar data. <u>New data will be required to create a digital surface model</u>. </p>
    		   <p><img src="/assets/img/goodlaz.jpg" class="prodImg"><br>
      		   Pope County lidar point cloud, colored by classification. 
			   <br>This is the standard point cloud classification found in the majority of the lidar data. 
			   <br>Accurate classification for vegetation points (green) and buildings (orange) on a small farmstead in western Pope County. 
		       </p>
    		   
			 </div>
			 
			 <div class="tab-pane" id="presentations">
			   <h4>Presentations:</h4>
			   <ul>
			     <li>
			       <p style="font-size:18px"><strong>2014 GIS/LIS presentation slides available <a href="assets/docs/GISLIS_2014_Slides.zip">here</a>.</strong></p>
				 </li>
				 <li>
				 	<p style="font-size:18px"><strong>Five Minute Solar Project Crash Course PDF available <a href="assets/pdf/5minSolar.pdf" target="_blank">here</a></strong></p>
				 	<!--<iframe src="http://prezi.com/embed/i5pzk4gs5709/?bgcolor=ffffff&amp;lock_to_path=1&amp;autoplay=0&amp;autohide_ctrls=0&amp;features=undefined&amp;token=undefined&amp;disabled_features=undefined" width="550" height="400" frameBorder="0" webkitAllowFullScreen mozAllowFullscreen allowfullscreen></iframe>
				 -->
				 </li>
			   </ul>
			 </div>
			<div class="tab-pane" id="gallery">
  
    <div class="row" style="margin-top:10px">
      
	
      <div class="col-md-12">
            <h3><strong>Solar Map Gallery</strong></h3>
      <p><em>(click to enlarge and use arrow keys to advance as slideshow)</em></p>
	<p>
		<a class="fancybox" href="/assets/maps/Andy_Dinktown_Rooftop_Map.png" data-fancybox-group="gallery" title="Rooftop Solar Suitability - Dinkytown, Minneapolis"><img src="/assets/maps/tn/Andy_Dinktown_Rooftop_Map.png" alt="" height="150px" /></a>
        
        <a class="fancybox" href="/assets/maps/contracted_point_density.jpg" data-fancybox-group="gallery" title="Lidar Point Density for Minnesota"><img src="/assets/maps/tn/contracted_point_density.jpg" alt="" height="150px" /></a>

		<a class="fancybox" href="/assets/maps/dinkytown7c.PNG" data-fancybox-group="gallery" title="Lidar Point Cloud - Dinkytown, Minneapolis"><img src="/assets/maps/tn/dinkytown7c.PNG" alt="" height="150px" /></a>
        
        <a class="fancybox" href="/assets/maps/DSM2_dinkytown_draped.png" data-fancybox-group="gallery" title="Satellite Imagery Draped over Digital Surface Model - Dinkytown, Minneapolis"><img src="/assets/maps/tn/DSM2_dinkytown_draped.png" alt="" height="150px" /></a>
        
        <a class="fancybox" href="/assets/maps/DSM_Progress.png" data-fancybox-group="gallery" title="Real-time Progress Map used to Monitor Parallel Processing of the DSM"><img src="/assets/maps/tn/DSM_Progress.png" alt="" height="150px" /></a>
        
        <a class="fancybox" href="/assets/maps/hinkley-notnoiseexample.jpg" data-fancybox-group="gallery" title="Tall Structures Identified in Lidar Point Cloud"><img src="/assets/maps/tn/hinkley-notnoiseexample.jpg" alt="" height="150" /></a>
        
        <a class="fancybox" href="/assets/maps/MN-SunniestPts.png" data-fancybox-group="gallery" title="Map of the Sunniest Points in Minnesota"><img src="/assets/maps/tn/MN-SunniestPts.png" alt="" height="150" /></a>
        
        <a class="fancybox" href="/assets/maps/processed_data.JPG" data-fancybox-group="gallery" title="Progress Map used to Monitor Parallel Processing of the Solar Analysis"><img src="/assets/maps/tn/processed_data.JPG" alt="" height="150" /></a>
        
        <a class="fancybox" href="/assets/maps/processed_data_zoom1.JPG" data-fancybox-group="gallery" title="Inset of Solar Progress Map Showing 1sqkm Sections"><img src="/assets/maps/tn/processed_data_zoom1.JPG" alt="" height="150" /></a>
        
         <a class="fancybox" href="/assets/maps/reprocessmap.png" data-fancybox-group="gallery" title="County Lidar Data to be Reprocessed"><img src="/assets/maps/tn/reprocessmap.png" alt="" height="150" /></a>
         
         <a class="fancybox" href="/assets/maps/Solar_class_byTime.PNG" data-fancybox-group="gallery" title="Map showing Total Processing Time of Each Solar Analysis Tile"><img src="/assets/maps/tn/Solar_class_byTime.PNG" alt="" height="150" /></a>
        
        <a class="fancybox" href="/assets/maps/solar_day400x600.gif" data-fancybox-group="gallery" title="Animation of Sunlight Per Hour - Dinkytown, Minneapolis"><img src="/assets/maps/tn/solar_day400x600.gif" alt="" height="150" /></a>
        
        <a class="fancybox" href="assets/maps/solar_year400x600.gif" data-fancybox-group="gallery" title="Animation of Sunlight Per Month - Dinkytown, Minneapolis"><img src="assets/maps/tn/solar_year400x600.gif" alt="" height="150" /></a>
        
        <a class="fancybox" href="assets/maps/tile_overlay_with_tiles.JPG" data-fancybox-group="gallery" title="Fishnets Used for Parallel Processing - DSM (Red) and Solar (Black)"><img src="assets/maps/tn/tile_overlay_with_tiles.JPG" alt="" height="150" /></a>
        
         <a class="fancybox" href="/assets/maps/tornado.png" data-fancybox-group="gallery" title="Visible Scar in Landscape due to Tornado Damage - Minneapolis"><img src="/assets/maps/tn/tornado.png" alt="" height="150" /></a>        
         </p>
         </div>
         </div>

            </div>
            
            
			 <div class="tab-pane" id="media">
			   <br>
			   
			   <div class="videoTitle">
			     ESRI 2014 User Conference Award Presentation:
			   </div>
			   
			   <div class="aspect-ratio">
			     <iframe frameBorder="0" seamless src="http://video.esri.com/iframe/3664/000000/width/700/0/00:00:00"></iframe>
		       </div>
			   
			   <br>
			   <br>
			   
			   <div class="videoTitle">
			     Video overview of methods:
			   </div>
			   <div class="aspect-ratio">
			     <iframe src="//www.youtube.com/embed/CWt8PwjzHPM"></iframe>
			   </div>
			   
			   <br>
			   <br>
				 
			   <!--<div class="videoTitle">
			     Web app video for Minnesota GIS/LIS Conference:
			   </div>
			   <div class="aspect-ratio">
			   	  <video controls>
					  <source src="assets/vid/webApp_Ver2.mp4" type="video/mp4">
					  Your browser does not support HTML5 video.
					</video>
		       </div>-->
			   
			   <br>
			   <br>
			   
			   <div class="videoTitle">
			     XYHT Interview (Esri UC 2014):
			   </div>
			   
			   <div class="aspect-ratio">
			     <iframe width=100% src="//www.youtube.com/embed/NDUR8a39CVA" frameborder="0" allowfullscreen></iframe>
			   </div>
			 </div>
			 
			 <div class="tab-pane" id="press">
			 
			   <!-------------------
			   FEATURED
			   -------------------->
			   <h4>Featured:</h4>
			   <!--headline, publisher, date-->
			   <div class="pubimage">
			     <a href="http://www.startribune.com/business/268636802.html"><img src="/assets/img/stribonline.jpg"></a>
			   </div>
			   <div class="pubheadline">
			     <a href="http://www.startribune.com/business/268636802.html">U of M grad students take a sunny look at Minnesota</a>
			   </div>
			   <div class="publisher">
			     Star Tribune - July 27, 2014
			   </div>
			   
			   <div class="pubimage">
			     <a href="http://www.esri.com/software/landing_pages/climate-app"><img src="/assets/img/esriclimateresiliancebanner.PNG"></a>
			   </div>
			   <div class="pubheadline">
			       <a href="http://www.esri.com/software/landing_pages/climate-app">Esri Climate Resilience App Challenge 2014 Winners Announcement</a>
			     </div>
			     <div class="publisher">
			       Esri - 2014
			   </div>
			   
			   <!--------------------
			   OTHERS
			   --------------------->
			   <h4>Other:</h4>
			   <ul>
			      <li>
				   <div class="pubheadline"><a href="/map_gallery.php">Our Map Gallery
			       </a></div>
			     </li>
			     <li>
			       <div class="pubheadline"><a href="http://venturebeat.com/2014/07/02/these-13-apps-use-mapping-tech-to-fight-climate-change/">These 13 apps use mapping tech to fight climate change</a>
		           </div>
			       <div class="publisher">
			         Venture Beat - July 2, 2014
		           </div>
		         </li>
			   
			   
			   <!-------------------->
			     <li>
			       <div class="pubheadline">
			       <a href="http://www10.giscafe.com/nbc/articles/1/1292401/Esri-App-Challenge-Winners-Create-Actionable-Tools-Strengthen-Resilience-Efforts">Esri App Challenge Winners Create Actionable Tools to Strengthen Resilience Efforts</a>
			       </div>
			       <div class="publisher">
			         GIS Cafe - July 2, 2014
			       </div>
				 </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.gisuser.com/content/view/33521/2/">Esri App Challenge Winners Create Actionable Tools to Strengthen Resilience Efforts</a>
			     </div>
			     <div class="publisher">
			       GIS User - July 15, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <!-- ONLY OUR VIDEO
			   <li>
			     <div class="pubheadline">
			       <a href="http://geospatialstream.com/?p=798">http://geospatialstream.com/?p=798</a>
			     </div>
			     <div class="publisher">
			   
			     </div>
			   </li>
			   -->
			   
			   <!-------------------->
			   <!-- ONLY ESRI VIDEO
			   <li>
			     <div class="pubheadline">
			       <a href="http://video.esri.com/watch/3664/esri-climate-app-challenge">http://video.esri.com/watch/3664/esri-climate-app-challenge</a>
			     </div>
			     <div class="publisher">
			   
			     </div>
			   </li>
			   -->
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.govtech.com/applications/Esri-Names-Climate-Resilience-App-Challenge-Winners.html">Esri Names Climate Resilience App Challenge Winners</a>
			     </div>
			     <div class="publisher">
			       Government Technology - July 15, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.directionsmag.com/channels/esri/pressreleases/esri-app-challenge-winners-create-actionable-tools-to-strengthen-resil/408627">Esri App Challenge Winners Create Actionable Tools to Strengthen Resilience Efforts</a>
			     </div>
			     <div class="publisher">
			       Directions Magazine - July 15, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
				   <a href="http://www.cleanenergyresourceteams.org/blog/solar-dream-team-wins-national-award-mn-solar-suitability-app">Solar Dream Team wins national award for MN Solar Suitability App</a>
			     </div>
			     <div class="publisher">
			       Clean Energy Resource Teams - July 16, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
				   <a href="http://spatialnews.geocomm.com/dailynews/2014/jul/16/news2.html">Esri App Challenge Winners Create Actionable Tools to Strengthen Resilience Efforts</a	       
			     ></div>
			     <div class="publisher">
			       Spatial News - 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://wgl.asprs.org/2014/07/congrats-to-university-of-minnesota-for-winning-esri-climate-resilience-app-challenge/">Congrats to University of Minnesota for winning Esri Climate Resilience App Challenge</a>
			     </div>
			     <div class="publisher">
			       Western Great Lakes Region American Society for Photogrammetry & Remote Sensing - July 18, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://tech.mn/news/2014/07/23/u-of-m-gis-team-solar-suitability-analysis-app/">U of M GIS team wins 1st place at Esri Challenge for solar webapp</a>
			     </div>
			     <div class="publisher">
			       Tech{dot}MN - July 23, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://mn.gov/commerce/energy/topics/resources/Newsletters/Renewable-Energy/2014-Renewable-Energy-News/July-2014/uofm-dream-team-national-award.jsp">U of M Solar Dream Team wins top national honor for solar suitability app</a>
			     </div>
			     <div class="publisher">
			       Minnesota Department of Commerce .energy - July 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.sco.wisc.edu/news/congrats-to-university-of-minnesota-for-winning-esri-climate-resilience-app-challenge.html">Congrats to University of Minnesota for winning Esri Climate Resilience App Challenge</a>
			     </div>
			     <div class="publisher">
			       Wisconsin State Cartographer's Office - July 18, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://bringmethenews.com/2014/07/28/solar-study-u-of-m-students-seek-states-sunniest-places/">Solar study: U of M students seek state’s sunniest places</a>
			     </div>
			     <div class="publisher">
			       BringMeTheNews - July 28, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.postbulletin.com/life/lifestyles/greenspace-award-winning-app-can-tell-you-where-the-sun/article_b7557bef-69d0-5edd-aca2-e283c2e2b546.html">Greenspace: Award-winning app can tell you where the sun shines</a>
			     </div>
			     <div class="publisher">
			       Post Bulletin - August 5, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.minnpost.com/letters/2014/08/minnesota-could-be-solar-leader-if-we-move-forward-smart-policies">Minnesota could be a solar leader if we move forward with smart policies</a>
			     </div>
			     <div class="publisher">
			       MinnPost - August 11, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   
			   <!-- JUST MNGeo LIDAR PAGE?
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.mngeo.state.mn.us/chouse/elevation/lidar.html">http://www.mngeo.state.mn.us/chouse/elevation/lidar.html</a>
			     </div>
			     <div class="publisher">
			   
			     </div>
			   </li>
			   -->
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.mndaily.com/news/metro-state/2014/09/02/new-data-portal-opens-doors-research">New data portal opens doors for research</a>
			     </div>
			     <div class="publisher">
			       Minnesota Daily - September 3, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.messagemedia.co/aitkin/news/local/article_d89d06ca-32b4-11e4-a4cf-0017a43b2370.html">Mapping the world to ‘make it a better place’</a>
			     </div>
			     <div class="publisher">
			       Aitkin Independent Age - September 9, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://www.mndaily.com/news/metro-state/2014/09/09/students-help-solar-industry-find-its-hot-spots">Students help solar industry find its hot spots</a>
			     </div>
			     <div class="publisher">
			       Minnesota Daily - September 10, 2014
			     </div>
			   </li>

			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://gcn.com/Articles/2014/09/15/Citizen-developers.aspx?Page=2">Citizen developers as a force multiplier in the enterprise</a>
			     </div>
			     <div class="publisher">
			       GCN - September 15, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://solarenergy.net/News/new-solar-map-minneapolis-shows-solar-potential-every-roof/">A New Solar Map for Minneapolis Shows Solar Potential for Every Roof</a>
			     </div>
			     <div class="publisher">
			       Solar Energy - August 15, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			   <li>
			     <div class="pubheadline">
			       <a href="http://solarenergy.net/News/exploring-next-generation-solar-maps/">Exploring the Next Generation of Solar Maps</a>
			     </div>
			     <div class="publisher">
			       Solar Energy - October 2, 2014
			     </div>
			   </li>
			   
			   <!-------------------->
			 </div>
			 </ul>
			 
			 <div class="tab-pane" id="scripts">
			   <h4>Scripts</h4>

               <p>To view the scripts we used to process our data follow the link to our GitHub repository. Along with the code, there is a readme that will help guide you along our process.
               <br>
               <br>
               <a href="https://github.com/stuporglue/solar_scripts"><img src="./assets/img/Octocat.png" height="80" width="80" style="padding-left:10; padding-bottom:10" alt="GitHub"></a>
               <br>
               <a href="https://github.com/stuporglue/solar_scripts">Git Hub/Solar Scripts</a></p>
			 </div>
		   </div>
		 </div>
       </div>
     </div>
<!-- end row -->
   </div>
<!-- END BOUNDING BOX -->
 </div>
	
    <!-- BEGIN UofM FOOTER -->
<?php //include_once ("assets/nav/footer.php");?>

 <div class="footer">
    <div class="grid_7 alpha" id="footer_inner">
      <ul class="copyright">
        <li>&copy; 2010 Regents of the University of Minnesota. All rights
        reserved.</li>

        <li>The University of Minnesota is an equal opportunity educator and
        employer</li>

        <li>Last modified on August 26, 2010</li>
      </ul>
    </div>

    <div class="grid_5 omega" id="footer_right">
      <ul class="footer_links">
        <li>Twin Cities Campus:</li>

        <li>
          <a href="http://www1.umn.edu/pts/">Parking &amp; Transportation</a>
        </li>

        <li>
          <a href="http://www.umn.edu/twincities/maps/index.html">Maps &amp;
          Directions</a>
        </li>
      </ul><br class="clearabove">

      <ul class="footer_links">
        <li>
          <a href="http://www.directory.umn.edu/">Directories</a>
        </li>

        <li>
          <a href="http://www.umn.edu/twincities/contact/">Contact U of M</a>
        </li>

        <li>
          <a href="http://www.privacy.umn.edu/">Privacy</a>
        </li>
      </ul><br class="clearabove">
    </div>
	</div>
<script src="/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script> 

</body>
</html>