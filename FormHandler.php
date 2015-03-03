<?php require("base.php");

if(isset($_POST['submit']))
{
	$url = 'form.php'; // path to form.php

	if(!isset($_POST['manufacturer'])) { $_POST['manufacturer'] = NULL; }
	if(!isset($_POST['model_number'])) { $_POST['model_number'] = NULL; }
	if(!isset($_POST['size'])) { $_POST['size'] = NULL; }
	if(!isset($_POST['pressure'])) { $_POST['pressure'] = NULL; }
	if(!isset($_POST['cond_cap'])) { $_POST['cond_cap'] = 0; }
	if(!isset($_POST['dollar'])) { $_POST['dollar'] = 0; }

	$data = prep($_POST);

	$steam_loss = number_format((float)($data['cond_cap']*0.00049), 2, '.', '');
	$steam_loss = number_format((($steam_loss * $data['pressure']) * 8760/1000), 2, '.', '');
	$steam_loss = round($steam_loss * 0.65);
	$data['steam_loss'] = $steam_loss;
	$data['dollar_loss'] = $steam_loss * $data['dollar'];

	if($data['submit'] == 'add')
	{
		if(!isset($data['surveyID'])) {
			$surveyID = save_survey($data);
		}
		else { $surveyID = $data['surveyID']; }

		save_survey_details($surveyID, $data);
		if($surveyID) { header('Location: '.$url.'?survey='.$surveyID); }

	}

	if($data['submit'] == 'add_area')
	{
		if(!isset($data['surveyID'])) {
			$surveyID = save_survey($data);
		}
		else { $surveyID = $data['surveyID']; }

		save_area_details($surveyID, $data);
		if($surveyID) { header('Location: '.$url.'?survey='.$surveyID); }

	}

	elseif($data['submit'] == 'submit')
	{
		if(isset($data['surveyID'])) {
			save_survey_details($data['surveyID'], $data);
		}
		else {
			$surveyID = save_survey($data);
			save_survey_details($surveyID, $data);
		}
		header('Location: '.$url);
	}
}

function prep($input) {
	$data = array();
	if(is_array($input)) {
		foreach ($input as $key => $val) {
			$data[$key] = mysql_real_escape_string($val);
		}
	}
	return $data;
}

function format_date($date = '') {
	if(isset($date) && $date) {
		$tmp = explode('-', $date);
		$d = $tmp[2].'-'.$tmp[0].'-'.$tmp[1];
	}
	else { $d = NULL; }
	return $d;
}

function save_survey($data) {
	$result = mysql_query("INSERT INTO surveys (date, plant_name, plant_location, plant_contact_name, dollar)
	VALUES('".format_date($data['dateSurvey'])."','".$data['plantName']."','".$data['plantLoc']."','".$data['plantContact']."','".$data['dollar']."')") or die('Error: ' . mysql_error());
	return mysql_insert_id();
}

function update_survey($surveyID, $data) {
	$result = mysql_query("UPDATE surveys SET date='".format_date($data['dateSurvey'])."', plant_name='".$data['plantName']."',
	plant_location='".$data['plantLoc']."', plant_contact_name='".$data['plantContact']."', dollar='".$data['dollar']."' WHERE id=".$surveyID)
	or die('Error: ' . mysql_error());
}

function save_survey_details($surveyID, $data) {
	$result = mysql_query("INSERT INTO survey_details (survey_id, tested_date, pipeBridge, location, floor_level, elevation, tag_number, manufacturer, model_number, size, pressure, service, trap_conditions, comments, steam_loss, dollar_loss)
	VALUES($surveyID, '".format_date($data['testDate'])."','".$data['pipeBridge']."','".$data['location']."','".$data['flrLevel']."','".$data['elevation']."','".$data['tagNum']."','".$data['manufacturer']."','".$data['model']."','".$data['size']."','".$data['pressure']."','".$data['service']."','".$data['trapCond']."','".$data['comments']."','".$data['steam_loss']."','".$data['dollar_loss']."')") or die('Error: ' . mysql_error());
	update_survey($surveyID, $data);
}

function save_area_details($surveyID, $data) {
	$result = mysql_query("INSERT INTO survey_areas (survey_id, area) VALUES($surveyID, '".$data['area']."')") or die('Error: ' . mysql_error());
	update_survey($surveyID, $data);
}

?>