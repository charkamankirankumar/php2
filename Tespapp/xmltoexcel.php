<?php
$str="";
	if($_GET['fname']=="")
	{
	$sql ="";// "SELECT * FROM ".$_GET['tname'];
	}
	else
	{
	
	  $str.="header_id='".$_GET['fname']."'";
	}
	  $sql = "SELECT `MEMBER ID`,`MEMBER NAME`,`SPOUSE NAME`,`STATUS`,`OWN`,`OTHER`,`PRI`,`SEC`,`CLOSED A/c`,`ACTIVE A/c`,
`DEFAULT A/c`,`OWN_LOAN`,`OTHER_LOAN`,`OWN_OUTSTANDING`,`OTHER_OUTSTANDING`,`OWN_INSTALLMENT`,
`OTHER_INSTALLMENT`,`Value`,`Remark`,`Error Description`,`ADDRESS`,`DoB / Age`,`AGE AS ON DT`,
`FATHER NAME`,`RATION CARD`,`VOTER ID`,`PHONE`,`REL TYPE 1`,`MBR REL NAME 1`,`REL TYPE 2`,
`MBR REL NAME 2`,`DRIVING LIC`,`OTHER ID TYP 1`,`OTHER ID VAL 1`,`BRANCH`,`KENDRA`,`REPORT ID`,
`RESPONSE`,`FINAL RESULT`,`REJECTION REASON`,`DATE1`,`DATE2`,`DATE3`,`NO. OF MFIs - 1`,
`NO. OF MFIs - 2`,`DEFAULT CASE`,`TOTAL OS CASE`,`TOTAL OS`,`CB AMOUNT`
	   FROM cbo_response_view WHERE ".$str;
     // $db_conn should be a valid db handle
	$fname=date("d-m-Y")." ".$_SERVER['REQUEST_TIME'];
	$db = mysql_connect("localhost", "root", "");
	mysql_select_db("cams_ybl",$db);
 	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=".$fname.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	$export = mysql_query($sql,$db);
	$count = mysql_num_fields($export);
	for ($i = 0; $i < $count; $i++) {
	$header .= mysql_field_name($export, $i)."\t";
	}
	while($row = mysql_fetch_row($export)) {
	$line = '';
	foreach($row as $value) {
	if ((!isset($value)) OR ($value == "")) {
	$value = "\t";
	} else {
	$value = str_replace('"', '""', $value);
	$value = '"' . $value . '"' . "\t";
	}
	$line .= $value;
	}
	$data .= trim($line)."\n";
	}
	$data = str_replace("\r", "", $data);
	if ($data == "") {
	$data = "\n(0) Records Found!\n";
	}
	print "$header\n$data";
?>