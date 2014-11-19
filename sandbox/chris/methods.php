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

  <title>Methods | Minnesota Solar Suitability Analysis</title>
  
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
    

    <div class="row" style="margin-top:15px" class="test">
      <div class="col-md-3" style="margin-top:0px">
        <div class="topleft2Column">
          <ul class="nav nav-tabs nav-stacked">
                
            <a href="#methods" data-toggle="tab"><li style="margin-top:20px">Methods</li></a>
		
            <a href="#methods_lidar" data-toggle="tab"><li>LiDAR Data</li></a>

            <a href="#methods_dsm" data-toggle="tab"><li>Digital Surface Model
            (DSM)</li></a>
               
            <a href="#methods_solar" data-toggle="tab"><li>Solar Radiation
            Analysis</li></a>
                
            <a href="#methods_parallel" data-toggle="tab"><li style="margin-bottom:0px">Parallel
            Processing</li></a>
          </ul>
        </div>
      </div>

      <div class="col-md-9">
        <div class="topright10Column">
          <div class="content">
            <div class="tab-content">  
              <div class="tab-pane active" id="methods">
				
                <h1>Methods</h1>

                <p style="max-width:80%">The purpose of this study was to develop
                a method for calculating solar insolation at a high resolution (1
                meter) across a large area (the state of Minnesota). The results
                were intended to provide a conservative estimate of solar
                insolation for determining the suitability of potential
                photovoltaic solar installations. This project relies on 800+ GB
                of Digital Surface Model (DSM) Rasters covering the extent of
                Minnesota. This input data is processed using ArcGIS spatial
                analysis functions in a python scripting process. The analysis
                creates a sky view for each location of the raster and calculates
                incident solar radiation across a year. The overall process
                relies on a PostgreSQL database to manage individual tasks and
                provides a mechanism to track the progress of the data analysis.
                The output product is a 800+ GB Area Solar Radiation Raster.<br>
                <br>
                Video overview:</p><iframe frameborder="0" height="360" src=
                "//www.youtube.com/embed/CWt8PwjzHPM" width="640"></iframe><br>
                <br>
				<br>
                <a class="top">^^ TOP ^^</a>
				<a class="changePage" href="#methods_lidar" data-toggle="tab">NEXT &gt&gt</a>

              </div>
				
			  <div class="tab-pane" id="methods_lidar">
				
				<h1>Lidar Data</h1>

                <p style="max-width:80%">The primary source data used in this
                study was <a href=
                "http://en.wikipedia.org/wiki/Lidar">LiDAR</a> elevation points
                gathered for Minnesota between 2006 and 2012 and made <a href=
                "http://www.mngeo.state.mn.us/chouse/elevation/lidar.html#data">
                publicly available</a> by the <a href=
                "http://www.dnr.state.mn.us/maps/mntopo/index.html">Minnesota
                Department of Natural Resources</a> and cooperating
                agencies.<br>
                <br>
                Lidar is a type of active remote sensing technology where light
                pulses (most commonly in the near-infrared wavelengths) are
                emmitted from a laser scanner and response times are measured.
                The information collected allows data processors to generate a
                point cloud, where each point represents one return from a
                laser pulse. The input data in this study was collected using
                airborne laser scanners mounted to airplanes. The data was
                originally collected between 2006 and 2012 through an
                intergovernmental initiative with the primary objective of
                providing improved elevation data for flood mapping. While we
                analyzed this data as a whole, the data is the rusult of a
                number of different collection efforts and contracts that have
                been made public through the <a href=
                "http://www.mngeo.state.mn.us/chouse/elevation/lidar.html#uses">
                Minnesota Geospatial Information Office</a>.</p>

                <p><br>
                <br>
                <iframe frameborder="0" height="360" src=
                "//www.youtube.com/embed/9Pl_i63zF4s" width="640"></iframe><br>
                <br>
                <img alt="LiDAR crane" border="0" src=
                "/assets/img/25_c_d_CRANE.jpg" width="600"></p>

                <p>LiDAR Point Cloud of UMN East Bank Campus</p>

                <br>
				<a class="changePage" href="#methods" data-toggle="tab">&lt&lt PREVIOUS</a>
                <a class="top">^^ TOP ^^</a>
				<a class="changePage" href="#methods_dsm" data-toggle="tab">NEXT &gt&gt </a>
              </div>
				
              <div class="tab-pane" id="methods_dsm">  
                <h1>Digital Surface Model (DSM) Development</h1>

                <p>In order to conduct the Solar Analysis process a Digital
                Surface Model (DSM) was needed to represent the earths surface
                and all objects that lie above that surface in grid. In other
                words irregularly spaced lidar points had to be converted into a
                grid (raster) whereby each point (pixel) represents the elevation
                at that location. We generated our DSM using a <a href=
                "https://www.youtube.com/watch?v=DRCGTF2y_tM">Streaming Delauney
                Triangulation</a> process developed by <a href=
                "http://www.cs.unc.edu/~isenburg/">Martin Isenburg</a> (now part
                of the <a href=
                "http://www.cs.unc.edu/~isenburg/lastools/download/blast2dem_README.txt">
                LAStools</a> software package). Triangles are iteratively
                generated using nearby lidar returns and values for each point
                are determined by extracting interpolated elevation from the
                surface of the triangle.</p><br>
                <br>
                <img width="600" alt="dinkytown" border="0" src=
                "/assets/img/DSM_dinkytown_draped.png" width="800">

                <p>ABOVE: A lidar-derived elevation raster DSM (of Dinkytown, MN)
                draped by an aerial photo for demonstration. The photo is
                stretched according to the elevation values of each corresponding
                cell in the DSM. BELOW: A screenshot of our state-wide DSM. Here
                dark colors represent low elevation and lighter color = higer
                elevation.</p><img alt="MN_DSM_Mosaic" border="0" src=
                "/assets/img/Full_State_MN_DSM_Mosaic.png" width="600">
		  
                <br>
				<br>
				<br>
				<a class="changePage" href="#methods_lidar" data-toggle="tab">&lt &lt PREVIOUS</a>
                <a class="top">^^ TOP ^^</a>
				<a class="changePage" href="#methods_solar" data-toggle="tab">NEXT &gt&gt </a>
 
              </div>  
				
              <div class="tab-pane" id="methods_solar">  
                <h1>Solar Radiation Analysis</h1>

                <p>The Solar Radiation Analysis is completed using <a href=
                "http://www.esri.com/software/arcgis/extensions/spatialanalyst">
                ESRI's ArcGIS Spatial Analyst</a> software via <a href=
                "https://www.python.org/">Python</a> programming and the
                <a href=
                "http://resources.arcgis.com/en/help/main/10.1/index.html#//000v000000v7000000">
                ArcPy package</a>. The <a href=
                "http://resources.arcgis.com/en/help/main/10.1/index.html#/Modeling_solar_radiation/009z000000t9000000/">
                Area Solar Radiation</a> tool allows the user to input a DSM to
                analyze the landscape and the sun's path across the sky
                (throughout the day and the year) to measure the amount of
                incoming direct and diffuse solar radiation for a particular
                place on the landscape.<br>
                <br>
                These calculations, which can be performed for point locations
                or entire geographic areas, are carried out using these four
                steps:</p><br>
                <br>

                <ol>
                  <li>An upward-looking hemispherical viewshed is calculated
                  based on topography.</li>

                  <li>The viewshed is overlaid on a direct sunmap to estimate
                  direct radiation.</li>

                  <li>The viewshed is overlaid on a diffuse skymap to estimate
                  diffuse radiation.</li>

                  <li>The process is repeated for every location of interest to
                  produce an insolation map.</li>
      
                </ol>
				  
				<p>For our analysis, these calculations are repeated for
                every square meter across Minnesota.</p><br>
                <br>
                <img alt="solar_equation" border="0" height="231" src=
                "/assets/img/solar_equation_sml.png" width="628"><br>
                <br>

                <p>For each location in the output raster, the Area Solar
                Radiation tool utilizes the DSM to create a sky obstruction
                view. This sky obstruction view is an upward facing circular
                view depicting the portion of the sky visible at this location.
                The skyview limits the amount of area direct radiation can be
                captured by looking at the elevation of nearby features (such
                as trees, buildings, hills, etc.). Next, sunmaps (sun
                position/direct radiation throughout the day and the year) and
                skymaps (directional diffuse radiation for each sky sector) are
                taking into consideration. Direct + diffuse radiation,
                constrained to the viewshed and calculated as represented
                above, yields total solar insolation for each one meter cell
                measued in watt-hours per meter2. The equation pictured above
                represents the starred point, a rooftop in close proximity to
                several tall buildings.<br>
                <br>
                BELOW: More interesting imagery...these animations represent
                sunlight analysis throughout the day and the year for
                Dinkytown, MN. These images are intermediary data products
                extracted from the process described above.<br>
                <br>
                <img alt="" border="0" height="593" src=
                "/assets/img/solar_day400x600.gif" width="415"><br>
                <em>Sunlight throughout the day in Dinkytown on July
                4th.</em><br>
                <br>
                <img alt="" border="0" height="572" src=
                "/assets/img/solar_year400x600_0.gif" width="400"><br>
                <em>Sunlight throughout the year. See why South facing is
                preffered?</em></p>
              
                <br>
				<a class="changePage" href="#methods_dsm" data-toggle="tab">&lt &lt PREVIOUS</a>
                <a class="top">^^ TOP ^^</a>
				<a class="changePage" href="#methods_parallel" data-toggle="tab">NEXT &gt &gt </a>

              </div>
				
	          <div class="tab-pane" id="methods_parallel">  
                <h1>Parallel Processing</h1>
				
                <p>Lidar for Minnesota amasses 940Gb of data (compressed as
                .laz files). Calculating solar capacity for every square meter
                of the state would take about 1,000 days on an average desktop
                computer running a sequential process. Using Python and a
                PostGIS database for storing metadata and tracking progress we
                wrote software that:<br>
                <br></p>

                <ul>
                  <li>Uses fishnets to divide the state into manageably sized
                  tiles that function as a job queue</li>

                  <li>Efficiently generates DSMs by spatially querying only the
                  necessary .laz files for each tile</li>

                  <li>Avoids edge artifacts by buffering input and constraining
                  output to coincident boundaries</li>

                  <li>Creates a mosaic dataset of DSM rasters from which Area
                  Solar Radiation input is extracted</li>

                  <li>Runs effectively on Minnesota Super Computing’s “Itasca”
                  High-performance cluster using ArcGIS Server for Linux</li>
                </ul><br>

                <p>Breaking this project into manageable jobs required creating
                a database system that divides the work, and an aggregation
                process that produces a seamless output. <a href=
                "http://www.postgresql.org/">PostgreSQL</a> with <a href=
                "http://postgis.net/">PostGIS</a> extension were used to manage
                the individual analysis jobs and track the progress and
                processing time for each job. The processing size chosen was 1
                square kilometer, which resulted in a total of 220,165
                individual jobs for the state of Minnesota.</p><br>
                <br>
                <img alt="tile_overlay" border="0" height="520" src=
                "/assets/img/tile_overlay_with_tiles_70pct.jpg" width="556"><br>
                <em>Data tiling structure with DSM processing extents (red) and
                Solar Analysis processing extents (black).</em><br>
                <br>

                <p>Solar radiation modeling is computationally demanding and
                complicated to implement. Our database control structure
                comibined with the <a href=
                "http://en.wikipedia.org/wiki/Embarrassingly_parallel">"embarrassingly
                parallel"</a> nature of our model, much of the analysis to be
                quickly computed using <a href=
                "https://www.msi.umn.edu/hpc">Minnesota Supercomputing
                Institute's High Performance Computing</a> resources as well as
                virtual machines and entire labs of desktop computers.<br>
                <br>
                To learn more about processing methods and tool parameters used
                in our analysis, visit the <a href=
                "https://github.com/stuporglue/solar_scripts"><img alt="gitHub"
                border="0" src="/assets/img/Octocat.png" width="20"> Github
                project site <img alt="gitHub" border="0" src=
                "/assets/img/Octocat.png" width="20"></a> where all of the
                scripts utilized can be accessed in full.</p><img alt=
                "lab_processing" border="0" src="/assets/img/lab_processing.jpg"
                width="600"><br>
                <br>

                <p>ABOVE: All machines in a Blegen Hall lab processing Solar
                data during Spring Break.<br>
                <br>
                BELOW: We ran as many processes as possible on each
                machine.<br></p><img alt="parallel_processing" border="0" src=
                "/assets/img/Parallell_DSM_Creation.png" width="600"><br>
                <br>
  				<br>
				<a class="changePage" href="#methods_solar" data-toggle="tab">&lt &lt PREVIOUS</a>
                <a class="top">^^ TOP ^^</a>
              </div>
            </div>
          </div>
        </div>
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