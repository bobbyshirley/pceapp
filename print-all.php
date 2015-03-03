
<!DOCTYPE html><html lang="">
<head>  
<meta charset="utf-8">
<title>Steam Trap Report</title>
<meta name="description" content="" />  
<meta name="keywords" content="" />
<meta name="robots" content="" />
<script type="text/javascript" src="tablesaw/src/tables.js"></script>
<script type="text/javascript" src="tablesaw/src/tables.stack.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="tablesaw/src/tables.stack.css">
<link rel="stylesheet" type="text/css" href="tablesaw/src/tables.css">

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
      <a class="navbar-brand" href="#"><img src="http://nebula.wsimg.com/0f8d671f8fdd1c8dc1aa903976b5a35c?AccessKeyId=7B42362A03B0A68DB6B4&disposition=0&alloworigin=1" height="25" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="form.php">Form</a></li>
        <li class="active"><a href="print-all.php" target="_blank">All Report</a></li>
        <li><a href="print-single.php" target="_blank">Single Report</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="table-responsive">
<?php
$dbhost = 'localhost';
$dbuser = 'pce_bobby';
$dbpass = 'Petrochem3';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'pce_app';
mysql_select_db($dbname);

$query = "SELECT * FROM survey_details";
$result = mysql_query($query) 
or die(mysql_error()); 
print " 
<table class=\"table table-striped\" data-mode=\"swipe\"><tr> 
<td width=100>Survey ID:</td>
<td width=100>Tested Date:</td> 
<td width=100>Direction:</td>
<td width=100>Location:</td> 
<td width=100>Floor Level:</td> 
<td width=100>Elevation:</td> 
<td width=100>Manufacturer:</td> 
<td width=100>Model:</td> 
<td width=100>Size:</td> 
<td width=100>Pressure:</td>
<td width=100>Service:</td> 
<td width=100>Trap Condition:</td>
</tr>"; 

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{ 
print "<tr>"; 
print "<td>" . $row['survey_id'] . "</td>";
print "<td>" . $row['tested_date'] . "</td>"; 
print "<td>" . $row['direction'] . "</td>"; 
print "<td>" . $row['location'] . "</td>"; 
print "<td>" . $row['floor_level'] . "</td>";
print "<td>" . $row['tag_number'] . "</td>";
print "<td>" . $row['manufacturer'] . "</td>";
print "<td>" . $row['model_number'] . "</td>";
print "<td>" . $row['size'] . "</td>"; 
print "<td>" . $row['pressure'] . "</td>"; 
print "<td>" . $row['service'] . "</td>"; 
print "<td>" . $row['trap_conditions'] . "</td>"; 
print "</tr>"; 
} 
print "</table>"; 

?>
</div>
</body>
</html>