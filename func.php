<?php
//**************************************
//     Page load dropdown results     //
//**************************************
function getTierOne()
{
	$result = mysql_query("SELECT FROM stmTrps ASC") 
	or die(mysql_error());

	  while($tier = mysql_fetch_array( $result )) 
  
		{
		   echo '<option value="'.$tier['Trap_Manufacturer'].'">'.$tier['Trap_Manufacturer'].'</option>';
		}

}

//**************************************
//     First selection results     //
//**************************************
if (isset($_GET['func'])&& $_GET['func'] == "drop_1" ) {
drop_1($_GET['drop_var']);
}

function drop_1($drop_var)
{  
    include_once('db.php');
	$result = mysql_query("SELECT DISTINCT Trap_Manufacturer FROM stmTrps WHERE Trap_Manufacturer='$drop_var' ORDER BY Trap_Manufacturer") 
	or die(mysql_error());
	
	echo '<select name="drop_2" id="drop_2">
	      <option value=" " disabled="disabled" selected="selected">Select Model</option>';

		   while($drop_2 = mysql_fetch_array( $result )) 
			{
			  echo '<option value="'.$drop_2['Trap_Model'].'">'.$drop_2['Trap_Model'].'</option>';
			}
	
	echo '</select>';
	echo "<script type=\"text/javascript\">
$('#wait_2').hide();
	$('#drop_2').change(function(){
	  $('#wait_2').show();
	  $('#result_2').hide();
      $.get(\"func.php\", {
		func: \"drop_2\",
		drop_var: $('#drop_1').val(),
		drop_var2: $('#drop_2').val()
      }, function(response){
        $('#result_2').fadeOut();
        setTimeout(\"finishAjax_tier_three('result_2', '\"+escape(response)+\"')\", 400);
      });
    	return false;
	});
</script>";
}

//**************************************
//     Second selection results     //
//**************************************
if (isset($_GET['func'])&& $_GET['func'] == "drop_2" ) {
drop_2($_GET['drop_var'], $_GET['drop_var2']);
}

function drop_2($drop_var, $drop_var2)
{  
    include_once('db.php');
	$result = mysql_query("SELECT DISTINCT size FROM stmTrps WHERE Trap_Manufacturer='$drop_var' AND Trap_Model='$drop_var2'") 
	or die(mysql_error());
	
	echo '<select name="drop_3" id="drop_3">
	      <option value=" " disabled="disabled" selected="selected">Select Size</option>';

		   while($drop_3 = mysql_fetch_array( $result )) 
			{
			  echo '<option value="'.$drop_3['size'].'">'.$drop_3['size'].'</option>';
			}
	
	echo '</select>';
	echo "<script type=\"text/javascript\">
$('#wait_3').hide();
	$('#drop_3').change(function(){
	  $('#wait_3').show();
	  $('#result_3').hide();
      $.get(\"func.php\", {
		func: \"drop_3\",
		drop_var: $('#drop_1').val(),
		drop_var2: $('#drop_2').val(),
		drop_var3: $('#drop_3').val()
      }, function(response){
        $('#result_3').fadeOut();
        setTimeout(\"finishAjax_tier_four('result_3', '\"+escape(response)+\"')\", 400);
      });
    	return false;
	});
</script>";
}

//**************************************
//     Second selection results     //
//**************************************
if(isset($_GET['func'])&& $_GET['func'] == "drop_3" ) {
drop_3($_GET['drop_var'], $_GET['drop_var2'], $_GET['drop_var3']);
}
function drop_3($drop_var, $drop_var2, $drop_var3)
{  
    include_once('db.php');
        $result = mysql_query("SELECT * FROM stmTrps WHERE Trap_Manufacturer='$drop_var' AND Trap_Model='$drop_var2' AND size='$drop_var3'") 
    or die(mysql_error());  
	
	echo '<select name="drop_4" id="drop_4">
	      <option value="" disabled="disabled" selected="selected">Select Pressure</option>';


		   while($drop_4 = mysql_fetch_array( $result )) 
				{
				if ($drop_4['accu'] != "") {
			  echo '<option value="'.$drop_4['accu'].'">'.$drop_4['accu'].'</option>';
				}
  }
	echo '</select> ';
    echo '<input type="submit" name="submit" value="Submit" />';
}

?>

