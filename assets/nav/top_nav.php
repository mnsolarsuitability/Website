<?php // this file contains the top nav bar to be included in each page  ?>

<!--BEGIN WORDMARK AND UNIT IDENTIFICATION FOR PRINT -->
  <!--Use this code along with the print.css to retain the University's wordmark on your printed Web pages and to identify your unit -->

  <div class="leftprint"><img align="left" alt="University of Minnesota"
  height="55" hspace="10" src="/assets/img/smMwdmk.gif" width="216"></div>

  <div class="rightprint">
    <strong>University of Minnesota</strong><br>
    http://www.umn.edu/<br>
    612-625-5000<br>
  </div><!--END WORDMARK AND UNIT IDENTIFICATION FOR PRINT -->
  <!-- * Skip Links * -->

  <p id="skipLinks"><a href="#main_nav">Main navigation</a> | <a href=
  "#maincontent">Main content</a></p>

  <div id="header">
    <!-- BEGNIN CAMPUS LINKS -->

    <div id="campus_links">
      <p>Campuses:</p>

      <ul>
        <li>
          <a href="http://www.umn.edu">Twin Cities</a>
        </li>

        <li>
          <a href="http://www.crk.umn.edu">Crookston</a>
        </li>

        <li>
          <a href="http://www.d.umn.edu">Duluth</a>
        </li>

        <li>
          <a href="http://www.morris.umn.edu">Morris</a>
        </li>

        <li>
          <a href="http://www.r.umn.edu">Rochester</a>
        </li>

        <li>
          <a href="http://www.umn.edu/campuses.php">Other Locations</a>
        </li>
      </ul>
    </div><!-- END CAMPUS LINKS -->
    <!-- * BEGIN TEMPLATE HEADER (MAROON BAR)* -->

    <div id="headerUofM">
      <div id="logo_uofm">
        <a href="http://www.umn.edu/">Go to the U of M home page</a>
      </div><!--BEGIN search div-->

      <div id="search_area">
        <div id="search_nav">
          <a href="http://onestop.umn.edu/" id="btn_onestop">OneStop</a>
          <a href="https://www.myu.umn.edu/" id="btn_myu">myU</a>
        </div>

        <div class="search">
          <form action="http://google.umn.edu/search" id="gsearch" method="get"
          name="gsearch" title="Search U of M Web sites">
            <label for="search_field">Search U of M Web sites</label>
            <input id="search_field" name="q" title="Search text" type="text"
            value="Search U of M Web sites"> <input alt="Submit Search" class=
            "search_btn" src="/assets/img/search_button.gif" type="image" value=
            "Search"> <input name="client" type="hidden" value="searchumn">
            <input name="proxystylesheet" type="hidden" value="searchumn">
            <input name="output" type="hidden" value="xml_no_dtd">
          </form>
        </div>
      </div>
    </div><!-- end "search" area -->
  </div><!-- End search div -->

  <div class="apptitle">
    <div class="container-full">
      Minnesota Solar Suitability Analysis
    </div>
  </div>

<?php 
	/* Look at the current page's url to determine if the button should be turned gold to indicate it is active. Use first three letters of page name only so it gracefully handes /app and /app/index.php */
	$currPage = substr($_SERVER["REQUEST_URI"], 1, 3); 
?>

  <div class="nav visible-lg">
    <div class="navbar-inner">
      <div class="container-full">
        <ul class="nav nav-pills red">
          <li<?php if($currPage == "ind") echo ' class="active"'; ?>>
            <a href="/index.php">Home</a>
          </li>
		  
		  <li<?php if($currPage == "app") echo ' class="active"'; ?>>
            <a href="/app"><img src="/assets/img/solar-map-app-icon-114.png" style="width:30px; margin-top:-15px; margin-bottom:-15px; padding-right:5px">App</a>
          </li>

          <li<?php if($currPage == "met") echo ' class="active"'; ?>>
            <a href="/methods.php">Methods</a>
          </li>

          <li<?php if($currPage == "pro") echo ' class="active"'; ?>>
            <a href=
            "/products.php">
            Products & Data</a>
          </li>
          
          <li<?php if($currPage == "new") echo ' class="active"'; ?>>
            <a href=
            "/news.php">
            News</a>
          </li>

          <li<?php if($currPage == "ref") echo ' class="active"'; ?>>
            <a href=
            "/references.php">
            References</a>
          </li>

          <li<?php if($currPage == "tea") echo ' class="active"'; ?>>
            <a href=
            "/team.php">
            Team</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  
  <div class="nav hidden-lg">
    <div class="navbar-inner">
      <div class="container-full">
        <ul class="nav nav-pills red">
          <li<?php if($currPage == "ind") echo ' class="active"'; ?>>
            <a href="/index.php">Home</a>
          </li>
		  
		  <li<?php if($currPage == "app") echo ' class="active"'; ?>>
            <a href="/app"><img src="/assets/img/solar-map-app-icon-114.png" style="width:30px; margin-top:-15px; margin-bottom:-15px; padding-right:5px">App</a>
          </li>

          <li class="dropdown<?php if($currPage == "met") echo ' active'; ?>">
		    
		    <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Data<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
		      <li><a href="methods.php">Methods/a></li>
              <li><a href="products.php">Products & Data</a></li>
		    </ul>
		  </li>-->
            <a href="/methods.php">Methods</a>
          </li>

          <li<?php if($currPage == "pro") echo ' class="active"'; ?>>
            <a href=
            "/products.php">
            Products & Data</a>
          </li>
          
          <li<?php if($currPage == "new") echo ' class="active"'; ?>>
            <a href=
            "/news.php">
            News</a>
          </li>
		  <!--<li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">About<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
		      <li><a href="news.php">News/a></li>
              <li><a href="referencess.php">References</a></li>
			  <li><a href="team.php">Team</a></li>
		    </ul>
		  </li>-->
		  

          <li<?php if($currPage == "ref") echo ' class="active"'; ?>>
            <a href=
            "/references.php">
            References</a>
          </li>

          <li<?php if($currPage == "tea") echo ' class="active"'; ?>>
            <a href=
            "/team.php">
            Team</a>
          </li>
        </ul>
      </div>
    </div>
  </div>