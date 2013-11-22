<?php
define("RelativePath", ".");
	define("PathToCurrentPage", "/");
	include_once(RelativePath . "/Common.php");
	require_once('Worksheet.php');
require_once('Workbook.php');
$db = new clsDBmysql_cams_v2();
if($_GET['t_date']==null || trim($_GET['t_date'])=='')
{
	$wardatcp=" added_at like '".$_GET['f_date']."%'";
	$wardatla1=" mfi_hvf1_added_at like '".$_GET['f_date']."%'";
	$wardatla2=" mfi_hvf2_added_at like '".$_GET['f_date']."%'";
	$wardatkyc1=" added_at_1 like '".$_GET['f_date']."%'";
	$wardatkyc2=" added_at_2 like '".$_GET['f_date']."%'";
	$wardatnum=" numbered_at like '".$_GET['f_date']."%'";
	$wardatprenum=" pre_numbered_at like '".$_GET['f_date']."%'";
	$wardattag=" mfi_doc_tagged_at like '".$_GET['f_date']."%'";
	$wardattc=" called_at like '".$_GET['f_date']."%'";
}
else
{
	$wardatcp=" added_at > '".$_GET['f_date']."' and added_at < '".$_GET['t_date']."'";
	$wardatla1=" mfi_hvf1_added_at > '".$_GET['f_date']."' and mfi_hvf1_added_at < '".$_GET['t_date']."'";
	$wardatla2=" mfi_hvf2_added_at > '".$_GET['f_date']."' and mfi_hvf2_added_at < '".$_GET['t_date']."'";
	$wardatkyc1=" added_at_1 > '".$_GET['f_date']."' and added_at_1 < '".$_GET['t_date']."'";
	$wardatkyc2=" added_at_2 > '".$_GET['f_date']."' and added_at_2 < '".$_GET['t_date']."'";
	$wardatnum=" numbered_at > '".$_GET['f_date']."' and numbered_at < '".$_GET['t_date']."'";
	$wardatprenum=" pre_numbered_at > '".$_GET['f_date']."' and pre_numbered_at < '".$_GET['t_date']."'";
	$wardattag=" mfi_doc_tagged_at > '".$_GET['f_date']."' and mfi_doc_tagged_at < '".$_GET['t_date']."'";
	$wardattc=" called_at > '".$_GET['f_date']."' and called_at < '".$_GET['t_date']."'";
}

function HeaderingExcel($filename)
{
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
}
$name="COUNT_".date('YmdHis').".xls";
HeaderingExcel($name);
$workbook = new Workbook("-");
$worksheet1 =& $workbook->add_worksheet("DE COUNT");
function fetch_count($user)
{
global $wardatcp,$wardatla1,$wardatla2,$wardatkyc1,$wardatkyc2,$wardatnum,$wardatprenum;
	$db1 = new clsDBmysql_cams_v2();
	$arr=array();
	$j=0;
	for($i=0;$i<8;$i++)
		$arr[$i]=0;
	$sql1="select count(*) from mfi_cp where added_by='".$user."' and ".$wardatcp;
	$res=$db1->query($sql1);
	$row=mysql_fetch_array($res);
	$arr[0]=$row[0];
	$sql2="select count(*) from mfi_hvf1 where mfi_hvf1_added_by='".$user."' and ".$wardatla1;
	$res=$db1->query($sql2);
	$row=mysql_fetch_array($res);
	$arr[1]=$row[0];
	$sql3="select count(*) from mfi_hvf2 where mfi_hvf2_added_by='".$user."' and ".$wardatla2;
		$res=$db1->query($sql3);
		$row=mysql_fetch_array($res);
	$arr[2]=$row[0];

	$sql123="select count(*) from mfi_kyc where added_by_1 like '".$user."' and ".$wardatkyc1;

	$res123=$db1->query($sql123);
	while($row=mysql_fetch_array($res123))
	{
		$arr[3]=$row['count(*)'];

	}
	$sql124="select count(*) from mfi_kyc where added_by_2 like '".$user."' and ".$wardatkyc2;
	$res124=$db1->query($sql124);
	while($row=mysql_fetch_array($res124))
	{
		$arr[4]=$row['count(*)'];

	}
	$sql125="select count(*) from mfi_docs where numbered_by like '".$user."' and ".$wardatnum;

	$res125=$db1->query($sql125);
	while($row=mysql_fetch_array($res125))
	{
		$arr[5]=$row['count(*)'];

	}
	$sql126="select count(*) from mfi_docs where pre_numbered_by like '".$user."' and ".$wardatprenum;
	$res126=$db1->query($sql126);
	while($row=mysql_fetch_array($res126))
	{
		$arr[6]=$row['count(*)'];

	}

	//$worksheet1->write_string(0,0,$sql1);
	$tot=0;
	for($i=0;$i<7;$i++)
		$tot+=$arr[$i];
	$arr[7]=$tot;

	return $arr;
}
$sql="select distinct(mfi_doc_entered_by) from mfi_docs where mfi_doc_entered_by is not null and trim(mfi_doc_entered_by!='') ";

$result=$db->query($sql);
$k=1;
$l=0;
$worksheet1->write_string($k,$l++);
	$worksheet1->write_string(0,1,'CANAME');
	$worksheet1->write_string(0,2,'CP');
	$worksheet1->write_string(0,3,'LA1');
	$worksheet1->write_string(0,4,'LA2');
	$worksheet1->write_string(0,5,'KYC');
	$worksheet1->write_string(0,6,'KYC-DEDUP');
	$worksheet1->write_string(0,7,'NUMBERING');
	$worksheet1->write_string(0,8,'PER-NUMBERING');
	$worksheet1->write_string(0,9,'TOTAL');
//echo "<table border='1'><tr><td>CA NAME</td><td>CP</td><td>GP</td><td>LA1</td><td>LA2</td><td>HV1</td><td>HV2</td><td>ERROR REJECTION</td><td>INVALID IMAGE</td><td>TOTAL</td></tr>";
while($row=mysql_fetch_array($result))
{
$l=1;
	$arr1=fetch_count($row["mfi_doc_entered_by"]);
	$worksheet1->write_string($k,$l++,$row["mfi_doc_entered_by"]);
	$worksheet1->write_number($k,$l++,$arr1[0]);
	$worksheet1->write_number($k,$l++,$arr1[1]);
	$worksheet1->write_number($k,$l++,$arr1[2]);
	$worksheet1->write_number($k,$l++,$arr1[3]);
	$worksheet1->write_number($k,$l++,$arr1[4]);
	$worksheet1->write_number($k,$l++,$arr1[5]);
	$worksheet1->write_number($k,$l++,$arr1[6]);
	$worksheet1->write_number($k,$l++,$arr1[7]);



$k++;
	//echo "<tr><td>".$row["mfi_doc_entered_by"]."</td><td>".$arr1[0]."</td><td>".$arr1[1]."</td><td>".$arr1[2]."</td><td>".$arr1[3]."</td><td>".$arr1[4]."</td><td>".$arr1[5]."</td><td>".$arr1[6]."</td><td>".$arr1[7]."</td><td>".$arr1[8]."</td></tr>";
}

//for tagging

$worksheet2 =& $workbook->add_worksheet("TAGGING COUNT");

$sql2="select mfi_doc_tagged_by,count(*) from mfi_docs where mfi_doc_tagged_by is not null and trim(mfi_doc_tagged_by!='') and".$wardattag." group by mfi_doc_tagged_by";

$result2=$db->query($sql2);
$k1=1;
$worksheet2->write_string(0,1,"TAGGED BY");
$worksheet2->write_string(0,2,"COUNT");
while($row=mysql_fetch_array($result2))
{
	$l1=1;
	$worksheet2->write_string($k1,$l1++,$row["mfi_doc_tagged_by"]);
	$worksheet2->write_number($k1++,$l1++,$row["count(*)"]);
}

// for tele calling

$worksheet3 =& $workbook->add_worksheet("TC INDIVIDUAL COUNT");

$sql3="select called_by,count(*) from mfi_telecalling_check where called_by is not null and ".$wardattc." group by called_by";
$sql31="select called_by,count(*) from mfi_telecalling_check where called_by is not null and mfi_tc_call_log = 'CONNECTED' and ".$wardattc." group by called_by";
$sql32="select called_by,count(*) from mfi_telecalling_check where called_by is not null and tc_individual_check_status = 'SANCTIONED' and ".$wardattc." group by called_by";
$sql33="select called_by,count(*) from mfi_telecalling_check where called_by is not null and tc_individual_check_status = 'REJECTED' and ".$wardattc." group by called_by";

//total calls
$result3=$db->query($sql3);
$k1=2;
$worksheet3->write_string(0,1,"TOTAL CALLS");
$worksheet3->write_string(1,1,"CALLED BY");
$worksheet3->write_string(1,2,"COUNT");
while($row=mysql_fetch_array($result3))
{
	$l1=1;
	$worksheet3->write_string($k1,$l1++,$row["called_by"]);
	$worksheet3->write_number($k1++,$l1++,$row["count(*)"]);
}
// connected calls
$result31=$db->query($sql31,$db3);
$k11=2;
$worksheet3->write_string(0,4,"CONNECTED CALLS");
$worksheet3->write_string(1,4,"CALLED BY");
$worksheet3->write_string(1,5,"COUNT");
while($row=mysql_fetch_array($result31))
{
	$l11=4;
	$worksheet3->write_string($k11,$l11++,$row["called_by"]);
	$worksheet3->write_number($k11++,$l11++,$row["count(*)"]);
}

// sanctioned calls
$result32=$db->query($sql32);
$k12=2;
$worksheet3->write_string(0,7,"SANCTIONED CALLS");
$worksheet3->write_string(1,7,"CALLED BY");
$worksheet3->write_string(1,8,"COUNT");
while($row=mysql_fetch_array($result32))
{
	$l12=7;
	$worksheet3->write_string($k12,$l12++,$row["called_by"]);
	$worksheet3->write_number($k12++,$l12++,$row["count(*)"]);
}

// rejected calls
$result33=$db->query($sql33);
$k13=2;
$worksheet3->write_string(0,10,"REJECTED CALLS");
$worksheet3->write_string(1,10,"CALLED BY");
$worksheet3->write_string(1,11,"COUNT");
while($row=mysql_fetch_array($result33))
{
	$l13=10;
	$worksheet3->write_string($k13,$l13++,$row["called_by"]);
	$worksheet3->write_number($k13++,$l13++,$row["count(*)"]);
}




$workbook->close();
?>