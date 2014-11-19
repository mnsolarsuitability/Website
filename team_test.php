<!DOCTYPE html>
<html>
<head>
  <!-- University of Minnesota Web template:  v5.101021 -->
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <meta content="Chris Martin" name="author">
  <meta content="Solar Suitability Analysis - UMN" name="description">
  <meta content="solar, Minnesota, University of Minnesota, UMN" name=
  "keywords">
  <meta content="09/16/2014" name="date">

  <title>Our Team | Minnesota Solar Suitability Analysis</title>
  
  <?php include_once("assets/nav/header.php"); ?>
  
  <script type="text/javascript" src="lib/jssor.js"></script>
  <script type="text/javascript" src="lib/jssor.slider.js"></script>

</head>

<body>

  <!-- Top Nav -->
<?php include_once ("assets/nav/top_nav.php");?>

  <!-- Image slider script -->
  <script>

        jQuery(document).ready(function ($) {

            var _SlideshowTransitions = [
            //Fade
            { $Duration: 1200, $Opacity: 2 }
            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                $SlideWidth: 743,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                $SlideHeight: 216,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };
            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            //function ScaleSlider() {
            //    var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
            //    if (parentWidth)
            //        jssor_slider1.$ScaleWidth(Math.min(parentWidth, 600));
            //    else
            //        window.setTimeout(ScaleSlider, 30);
            //}

            //ScaleSlider();

            //if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
            //    $(window).bind('resize', ScaleSlider);
            //}


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end*/
        });  
  </script>
  <!-- START OUR CONTENT -->
  <div class="boundingbox">
    <div class="container-full">
      <div class="row">
        <div class="col-md-8">
          <div class="topleftwideColumn">
		    <h1>Our Team</h1>
		  
		    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 743px; height: 216px; overflow: hidden; ">

              <!-- Loading Screen -->
              <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <div style="position: absolute; display: block; background: url(assets/img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
              </div>

            <!-- Slides Container -->
              <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 743px; height: 216px; overflow: hidden;">
                <div>
                  <img u="image" src="/assets/img/fall14SolarTeam.png" />
				  <div u="caption" t="L-R" style="position: absolute; top: 170px; left: 570px; width: 175px;height: 40px; color:white;text-align:center;line-height:40px;background:#7a0019;opacity:.5">
                    <span style="opacity:1.0;font-weight:bold; font-size:16px">Fall 2014 Semester</span>
                  </div>
                </div>
                <div>
                  <img u="image" src="/assets/img/SolarPteam627.png" />
				  <div u="caption" t="L-R" style="position: absolute; top: 170px; left: 560px; width: 185px;height: 40px; color:white;text-align:center;line-height:40px;background:#7a0019;opacity:.5">
                    <span style="opacity:1.0; font-weight:bold; font-size:16px">Spring 2014 Semester</span>
                  </div>
                </div>
			  </div>
            </div>
		
            <!--<p><img alt="Solar Dream Team" src="./assets/img/fall14SolarTeam.png" style=
            "width:100%"><br>-->
            <br>
            Our research team comprises 7 graduate students and a faculty
            advisor from the Masters of Geographic Information Science <a href=
            "http://mgis.umn.edu/">(MGIS)</a> degree program at the University
            of Minnesota - Twin Cities Campus. However, this project would not
            be possible without the generous help of <a href=
            "./references.html">many other contributors</a>.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="toprightnarrowColumn" style="margin-top:40px">
            <p>To contact us, please email <a href=
            "mailto:solarp@umn.edu?Subject=Solar%20information%20request"
            target="_top">solarp@umn.edu</a>.</p>
          </div>

          <div class="linkbox">
            <ul class="sidebarlinks">
              
                <a href="http://mgis.umn.edu/" target="_blank"><li style="margin-top:20px">MGIS University of Minnesota</li></a>
              
              
                <a href="https://uspatial.umn.edu/" target="_blank"><li>U-Spatial Support for
                Spatial Research</li></a>
              
                <a href="http://www.cleanenergyresourceteams.org/ target="_blank""><li style="margin-bottom:0px">Clean Energy
                Resource Teams</li></a>

            </ul>
          </div>
        </div>


		<!-- END ROW -->

        <div class="row">
          <div class="col-lg-8">
            <div class="bottomtable" style=
            "border-collapse: collapse; table-layout: fixed; padding-left:15px;">
			
			<!-- NEW MEMBER TEMPLATE
			<tr>
                <td><strong><a href="https://www.linkedin.com/in/andrewwalz"
                  rel="nofollow" target="_blank">Andrew Walz</a>     <a href=
                  "mailto:walz0053@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt=""></a></strong></td>

                <td><em>University of Minnesota, B.S. Computer
                  Science</em><br>
                  Interests: Spatial databases and web development</td>
            </tr>
				
			-->
			
			
			  <br>
              <p>Current Members:</p>
              <table>
			    <col width="215">
  				<col width="510">
			    <!-- Create two column table -->
                <tr style="height:5px">
                  <td></td>

                  <td></td>
                </tr>
			<tr>
                <td><strong><a href="http://www.deadpioneer.com/portfolio/index.htm"
                  rel="nofollow" target="_blank">Andrew Munsch </a><a href=
                  "mailto:munsc005@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/pub/andrew-munsch/92/b76/781/"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
</strong></td>

                <td><em>University of Minnesota, B.S. Geography</em><br>
                  Interests: Historical GIS and cartography</td>
            </tr>
                <tr>
                  <td><strong><a href="https://www.linkedin.com/in/andrewwalz"
                  rel="nofollow" target="_blank">Andrew Walz</a> **
				  <a href="mailto:walz0053@umn.edu" rel="nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/in/andrewwalz"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                  <td><em>University of Minnesota, B.S. Computer
                  Science</em><br>
                  Interests: Spatial databases and web development</td>
                </tr>

                <tr>
                  <td><strong><a href=
                  "http://cmartin616.wix.com/portfolio"
                  rel="nofollow" target="_blank">Christopher Martin</a> **<a href=
                  "mailto:mart3565@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/pub/christopher-martin/64/130/825"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
</strong></td>
                  <td><em>University of Vermont, B.S. Wildlife and Fisheries
                  Biology</em><br>
                  Interests: GIS development; web development; spatial
                  analysis</td>
                </tr>
				
				<tr>
                <td><strong><a href="https://www.linkedin.com/"
                  rel="nofollow" target="_blank">Christopher Brink</a><a href=
                  "mailto:brink331@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
			  <a href="https://www.linkedin.com/"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
			  </strong></td>

                <td><em>University of Wisconsin, Stout-Menomonie, B.A. Applied Social Sciences</em><br>
                  
Interests: Archaeology/anthropology and GIS</td>
            </tr>
				
				<tr>
                  <td><strong><a href=
                  "https://www.linkedin.com/in/devonpiernot" rel="nofollow"
                  target="_blank">Devon Piernot</a> **<a href=
                  "mailto:piern002@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
  				  <a href="https://www.linkedin.com/in/devonpiernot"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
			  </strong></td>

                  <td><em>University of Wisconsin - Madison, B.S. Cartography
                  and GIS</em><br>
                  Interests: Participatory GIS, open-source GIS, cartographic
                  modeling</td>
                </tr>
					
			<tr>
                <td><strong><a href="https://www.linkedin.com/"
                  rel="nofollow" target="_blank">Yiqun (Ian) Xie </a><a href=
                  "mailto:xiexx347@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                <td><em>Nanjing Normal University, B.S. Geographic Information Science</em><br>
                  Interests: Spatial data mining; web mapping</td>
            </tr>
			
			<tr>
                <td><strong><a href="www.linkedin.com/pub/yuanyuan-luo/30/3b7/b5a/"
                  rel="nofollow" target="_blank">Yuanyuan Luo</a><a href=
                  "mailto:luoxx269@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                <td><em>Tongji University, B.Eng. Surveying and Mapping</em><br>
                  Interests: Spatial decision-making in business or public affairs</td>
            </tr>

              </table>

			  <p> ** - indicates returning member.</p>
			  <br>
              <p>Former Members:</p>

              <table>
			    
			    <col width="215">
  				<col width="510">
			    <!-- Create two column table -->
                <tr style="height:5px">
              
                  <td></td>

                  <td></td>
                </tr>
				
				                <tr>
                  <td><strong><a href=
                  "https://www.linkedin.com/pub/benjamin-gosack/45/3b2/21a"
                  rel="nofollow" target="_blank">Ben Gosack</a><a href=
                  "mailto:gosa0004@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/pub/benjamin-gosack/45/3b2/21a"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                  <td><em>University of Minnesota, MGIS<br>
                  University of Minnesota, B.S. Environment and Natural
                  Resources</em><br>
                  Interests: Spatial Analysis, Cartography, Natural resource
                  management</td>
                </tr>


                <tr>
                  <td><strong><a href="https://www.linkedin.com/in/stuporglue"
                  rel="nofollow" target="_blank">Michael Moore</a><a href=
                  "mailto:moor1090@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/in/stuporglue"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                  <td><em>University of Minnesota, MGIS<br>
                  Brigham Young University, B.S. Information
                  Technology</em><br>
                  Interests: Software development</td>
                </tr>
				
				<tr>
                  <td><strong><a href=
                  "https://www.linkedin.com/pub/molly-mcdonald/65/47a/393" rel=
                  "nofollow" target="_blank">Molly McDonald</a><a href=
                  "mailto:wyni0014@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/pub/molly-mcdonald/65/47a/393"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                  <td><em>University of Minnesota, MGIS<br>
                  University of Minnesota - Duluth, B.A. Environmental
                  Studies</em><br>
                  Interests: Natural resource management applications of
                  GIS</td>
                </tr>

                <tr>
                  <td><strong><a href=
                  "https://www.linkedin.com/pub/stephen-palka/33/b64/701" rel=
                  "nofollow" target="_blank">Stephen Palka</a><a href=
                  "mailto:palka005@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/pub/stephen-palka/33/b64/701"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                  <td><em>University of Minnesota, MGIS<br>
                  University of Pittsburgh, B.S. Information Science</em><br>
                  Interests: Human-environment interaction, water resources
                  management</td>
                </tr>
              </table>
			  
			  <br>
              <p>Advisors:</p>

              <table>
			 
			    <col width="215">
  				<col width="510">
			    <!-- Create two column table -->
                <tr style="height:5px">
              
                  <td></td>

                  <td></td>
                </tr>

                <tr>
                  <td><strong><a href="https://www.linkedin.com/in/lenkne" rel=
                  "nofollow" target="_blank">Len Kne</a> - Faculty<a href=
                  "mailto:lenkne@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="https://www.linkedin.com/in/lenkne"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                  <td><span>U-Spatial Associate Director, University of
                  Minnesota</span><br>
                  Interests: web mapping, spatial database management and
                  administration</td>
                </tr>
				<tr>
                  <td><strong><a href="https:www.danthiede.com/" rel=
                  "nofollow" target="_blank">Dan Thiede</a> - Liaison<a href=
                  "mailto:thie0235@umn.edu" rel=
                  "nofollow"><img src="./assets/img/email-icon.jpg" width="24" height="24" alt="" align="right"></a>
				  <a href="http://www.linkedin.com/in/danthiede/"><img src="./assets/img/linkedin-icon.png" width="24" height="24" alt="" align="right"></a>
				  </strong></td>

                  <td><span>CERTs Communications Manager - Clean Energy Resource Teams</span><br>
                  Interests: web mapping, spatial database management and
                  administration</td>
                </tr>
              </table>
            </div>
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