<?php
define("RelativePath", ".");
	define("PathToCurrentPage", "/");
	include_once(RelativePath . "/Common.php");
$str="";
	 $sql = "SELECT * FROM efimo_cp";


    // $db_conn should be a valid db handle
	$fname=date("d-m-Y")." ".$_SERVER['REQUEST_TIME'];
	if(substr($sql,-3)=="and")
	$sql=substr($sql,0,-3);
	$db = new clsDBmysql_cams_v2();
 	header('Content-type: text/csv');
	header("Content-Disposition: attachment; filename=".$fname.".txt");
	header("Pragma: no-cache");
	header("Expires: 0");
	$export = $db->query($sql);
	while($row = mysql_fetch_row($export)) {
	$line = '';
	foreach($row as $value) {
	if ((!isset($value)) OR ($value == "")) {
	$value = "|";
	} else {
	$value = str_replace('"', '""', $value);
	$value = $value . "|";
	}
	$line .= $value;
	}
	$data .= trim($line)."||||\r\n";
	}
	if ($data == "") {
	$data = "\n(0) Records Found!\n";
	}
	print "$header\n$data";
?>