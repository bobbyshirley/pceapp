<?php require("base.php");
//include("core/integrate.php"); // Including the integration system
//lock("core/config.php"); // locking the current page, core/config.php is the path to the configuration file.
//set_logout('logout'); // setting the logout parameter

if(isset($_GET['survey']) && is_numeric($_GET['survey'])) {
  $surveyID = intval($_GET['survey']);
  $result = mysql_query("SELECT * FROM surveys WHERE id=".$surveyID) or die('Error: ' . mysql_error());
  if(mysql_num_rows($result) == 1) {
    $sd = mysql_fetch_assoc($result);
  }
}
function format_date($date = '') {
  if(isset($date) && $date) {
    $tmp = explode('-', $date);
    $d = $tmp[1].'-'.$tmp[2].'-'.$tmp[0];
  }
  else { $d = NULL; }
  return $d;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <style type="text/css">
    .formtable { border:0; }
    table td { padding: 4px;}
    table tr > td { text-align: right; }
    table tr > td + td { text-align: left; }
    #status { background: url(../images/ajax-loader.gif); width:16px; height:16px; margin-left: 6px; margin-top: 6px; display: none;}
	/*#headertitle { margin-left: 320px;}*/
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam Trap Survey</title>
    <!-- Bootstrap -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/datepicker.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="images/NEW_PCE_LOGO_tiny.png" height="25" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="form.php">Form</a></li>
        <li><a href="print-all.php" target="_blank">All Report</a></li>
        <li><a href="print-single.php" target="_blank">Single Report</a></li>
        <li><a href="?logout"> Logout </a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  <!-- <a href="login.php" target="_blank">Login</a> | <a href="logout.php" target="_blank">Logout</a><p></p> -->

  <div id="headertitle">
    <h1>Steam Trap Form Input</h1>
  </div>
  <div id="formtable">
    <form class="form-horizontal" role="form" action="FormHandler.php" method="post">
    <fieldset>
      <div class="form-group">
          <label for="dateSurvey" class="col-sm-2 control-label">Survey Date</label>
          <div class="col-sm-6">
          	<input type="text"<? echo (isset($sd['date']) ? ' value="'.format_date($sd['date']).'"' : '') ?> class="form-control col-sm-6 input-append date" id="dp1" name="dateSurvey" data-date="02-12-2014" data-date-format="mm-dd-yyyy">
          </div>
      </div>

	  <div class="form-group">
          <label for="plantName" class="col-sm-2 control-label">Plant Name</label>
          <div class="col-sm-6">
          	<input type="text" class="form-control col-sm-6" name="plantName"<? echo (isset($sd['plant_name']) ? ' value="'.$sd['plant_name'].'"' : '') ?>>
		  </div>
	  </div>

        <div class="form-group">
          <label for="plantLoc" class="col-sm-2 control-label">Plant Location</label>
          <div class="col-sm-6">
          	<input type="text" class="form-control col-sm-6" name="plantLoc"<? echo (isset($sd['plant_location']) ? ' value="'.$sd['plant_location'].'"' : '') ?>>
		  </div>
        </div>

        <div class="form-group">
          <label for="plantContact" class="col-sm-2 control-label">Plant Contact Name</label>
          <div class="col-sm-6">
          	<input type="text" class="form-control col-sm-6" name="plantContact"<? echo (isset($sd['plant_contact_name']) ? ' value="'.$sd['plant_contact_name'].'"' : '') ?>>
		  </div>
        </div>
        <div class="form-group">
        	<label for="dollar" class="col-sm-2 control-label">Dollar Amount</label>
        	<div class="col-sm-6">
        		<input type="text" class="form-control col-sm-6" name="dollar" id="dollar" placeholder="XX.XX"<? echo (isset($sd['dollar']) ? ' value="'.$sd['dollar'].'"' : '') ?>>
        	</div>
        </div>
        <div class="form-group">
          <label for="area" class="col-sm-2 control-label">Area</label>
          <div class="col-sm-6">
            <input type="text" class="form-control col-sm-6" name="area" placeholder="Boiler Room"<? echo (isset($sd['area']) ? ' value="'.$sd['area'].'"' : '') ?>>
          </div>
        </div>
        <hr>
		<div class="form-group">
          <label for="tagNum" class="col-sm-2 control-label">Tag Number</label>
          <div class="col-sm-6">
          	<input type="text" class="form-control col-sm-6" name="tagNum">
		  </div>
        </div>

         <div class="form-group">
          <label for="testDate" class="col-sm-2 control-label">Tested Date</label>
          <div class="col-sm-6">
          <input type="text" class="form-control col-sm-6 input-append date" id="dp2" name="testDate" data-date="02-12-2014" data-date-format="mm-dd-yyyy">
        </div>
         </div>

		<!-- <div class="form-group">
		<label for="direction" class="col-sm-2 control-label">Direction</label>
          <div class="col-sm-6">
          <select class="form-control col-sm-6" name="direction">
            <option value="N">N</option>
            <option value="NE">NE</option>
            <option value="NW">NW</option>
            <option value="S">S</option>
            <option value="SE">SE</option>
            <option value="SW">SW</option>
            <option value="E">E</option>
            <option value="W">W</option>
          </select>
		  </div>
		</div> -->

        <div class="form-group">
          <label for="location" class="col-sm-2 control-label">Location</label>
          <div class="col-sm-6">
          	<input type="text" class="form-control col-sm-6" name="location" placeholder="Detailed as possible">
		  </div>
        </div>

		<div class="form-group">
			<label for="pipeBridge" class="col-sm-2 control-label">Pipebridge</label>
		<div class="col-sm-6">
		<label class="radio-inline">
			<input type="radio" name="pipeBridge" value="Yes"> Yes
		</label>
		<label class="radio-inline">
			<input type="radio" name="pipeBridge" value="No" checked> No
		</label>
		</div>
		</div>

        <div class="form-group">
          <label for="flrLevel" class="col-sm-2 control-label">Floor Level</label>
          <div class="col-sm-6">
          	<select class="form-control col-sm-6" name="flrLevel">
           	 <option value="GROUND">GROUND</option>
			 <option value="ROOF">ROOF</option>
		   	 <option value="1stFloor">1st Floor</option>
		   	 <option value="2ndFloor">2nd Floor</option>
		   	 <option value="3rdFloor">3rd Floor</option>
		   	 <option value="4thFloor">4th Floor</option>
		   	 <option value="5thFloor">5th Floor</option>
		   	 <option value="6thFloor">6th Floor</option>
		   	 <option value="7thFloor">7th Floor</option>
		   	 <option value="8thFloor">8th Floor</option>
		   	 <option value="9thFloor">9th Floor</option>
		   	 <option value="10thFloor">10th Floor</option>
		   	 <option value="11thFloor">11th Floor</option>
		   	 <option value="12thFloor">12th Floor</option>
		   	 <option value="13thFloor">13th Floor</option>
		   	 <option value="14thFloor">14th Floor</option>
		   	 <option value="15thFloor">15th Floor</option>
			 <option value="1stPlatform">1st Platform</option>
		   	 <option value="2ndPlatform">2nd Platform</option>
		   	 <option value="3rdPlatform">3rd Platform</option>
		   	 <option value="4thPlatform">4th Platform</option>
		   	 <option value="5thPlatform">5th Platform</option>
		   	 <option value="6thPlatform">6th Platform</option>
		   	 <option value="7thPlatform">7th Platform</option>
		   	 <option value="8thPlatform">8th Platform</option>
		   	 <option value="9thPlatform">9th Platform</option>
		   	 <option value="10thPlatform">10th Platform</option>
		   	 <option value="11thPlatform">11th Platform</option>
		   	 <option value="12thPlatform">12th Platform</option>
		   	 <option value="13thPlatform">13th Platform</option>
		   	 <option value="14thPlatform">14th Platform</option>
		   	 <option value="15thPlatform">15th Platform</option>
		   	</select>
          </div>
        </div>

        <div class="form-group">
          <label for="elevation" class="col-sm-2 control-label">Elevation</label>
          <div class="col-sm-6">
          	<input type="number" class="form-control col-sm-6" name="elevation" placeholder="in feet">
		  </div>
        </div>
<!--
        <div class="form-group">
          <label for="tagNum" class="col-sm-2 control-label">Tag Number</label>
          <div class="col-sm-6">
          	<input type="text" class="form-control col-sm-6" name="tagNum">
		  </div>
        </div>
-->
		<div class="form-group">
		<label for="manufacturer" class="col-sm-2 control-label">Manufacturer</label>
          <? /* <input type="text" name="mmn" size="30"> */ ?>
          <div class="col-sm-6">
          <select name="manufacturer" class="depend col-sm-6 form-control" id="manufacturer">
            <option value="" selected="selected" disabled="disabled">Select Manufacturer</option>
          </select>
          </div>
          <div id="status"></div>
		</div>

        <div class="form-group">
          <label for="model" class="col-sm-2 control-label">Model Number</label>
          <div class="col-sm-6">
          <select name="model" class="depend col-sm-6 form-control" id="model">
            <option value="" selected="selected">Select value</option>
          </select>
        </div>
        </div>

        <div class="form-group">
          <label for="size" class="col-sm-2 control-label">Size</label>
          <div class="col-sm-6">
          <select name="size" class="depend col-sm-6 form-control" id="size">
            <option value="" selected="selected">Select value</option>
          </select>
        </div>
        </div>

        <div class="form-group">
          <label for="pressure" class="col-sm-2 control-label">Pressure</label>
          <div class="col-sm-6">
          <select name="pressure" id="pressure" class="col-sm-6 form-control">
            <option value="" selected="selected">Select value</option>
          </select>
        </div>
        </div>

        <div class="form-group">
          <label for="service" class="col-sm-2 control-label">Service</label>
          <div class="col-sm-6">
          <select class="form-control col-sm-6" name="service" name="service">
          	<option value="TRACER">TRACER</option>
          	<option value="HEATER">HEATER</option>
          	<option value="PROCESS">PROCESS</option>
          	<option value="DRIP">DRIP</option>
          </select>
        </div>
        </div>

        <div class="form-group">
          <label for="trapCond" class="col-sm-2 control-label">Trap Conditions</label>
          <div class="col-sm-6">
          <select class="form-control col-sm-6" name="trapCond" id="trapCond">
          <option value="OK">OK</option>
          <option value="BT">BT</option>
          <option value="CP">CP</option>
          <option value="VO">VO</option>
          <option value="RCL">RCL</option>
		      <option value="NTBT">NTBT</option>
          <option value="NTVO">NTVO</option>
         </select>
        </div>
        </div>
		<div class="form-group">
			<label for="comments" class="col-sm-2 control-label">Comments</label>
			<div class="col-sm-6">
			<textarea class="form-control col-sm-6" rows="5" name="comments" id="comments" placeholder="Anything else we need to know."></textarea>
			<!--<input type="textarea" class="form-control col-sm-6" name="comments" placeholder="Anything else we need to know."> -->
			</div>
		</div>


          <p></p>
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
          <? if(isset($surveyID)) { echo '<input type="hidden" name="surveyID" value="'.intval($_GET['survey']).'">'; } ?>
          <!-- <? if(isset($areaID)) { echo '<input type="hidden" name="areaID" value="'.intval($_GET['area']).'">'; } ?>
          -->

          <input type="hidden" name="cond_cap" id="cond_cap" value="">

          <button class="btn btn-default btn-lg" type="submit" name="submit" value="add">Add Trap</button>

          <button class="btn btn-primary btn-lg" type="submit" name="submit" value="add_area">Submit Area</button>

          <button class="btn btn-danger btn-lg" type="submit" name="submit" value="submit">Submit Survey</button>
        </div>
        </div>
      </fieldset>
    </form>
    </div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/live.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script>
    $('#dp1').datepicker({
				format: 'mm-dd-yyyy'
			});
	$('#dp2').datepicker({
				format: 'mm-dd-yyyy'
			});
  	</script>
  </body>
</html>