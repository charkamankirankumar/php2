<?php
	define("RelativePath", ".");
	define("PathToCurrentPage", "/");
	include_once(RelativePath . "/Common.php");
	$db = new clsDBmysql_cams_v2();
	$fname=$_GET['fname'];
	$sql="update overlap_reports set analysys_status='COMPLETED',cb_updated_by='".$_GET['user']."',cb_updated_at=now() where header_id='".$fname."'";
	$res=$db->query($sql);
	$aftdrows=mysql_affected_rows();
	//echo $aftdrows;
	$sql="select `INQ-CNT-FILE` from overlap_header where `FILE-NAME`='".$fname."'";
	$res=$db->query($sql);
	$row=mysql_fetch_row($res);
	
	if($aftdrows==$row[0])
	{
		$sql="update overlap_header set status='COMPLETED' where `FILE-NAME`='".$fname."'";
		$res=$db->query($sql);
		if($res)
			echo "successfull";
	}
	else
		echo "db prob pls run again";
?>