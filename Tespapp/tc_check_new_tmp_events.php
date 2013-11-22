<?php
//BindEvents Method @1-6AD08220
function BindEvents()
{
    global $mfi_hvf2_mfi_hvf1;
    global $mfi_tc_individualcheck;
    $mfi_hvf2_mfi_hvf1->call_attempt->CCSEvents["BeforeShow"] = "mfi_hvf2_mfi_hvf1_call_attempt_BeforeShow";
    $mfi_hvf2_mfi_hvf1->village_name->CCSEvents["BeforeShow"] = "mfi_hvf2_mfi_hvf1_village_name_BeforeShow";
    $mfi_tc_individualcheck->called_by->CCSEvents["BeforeShow"] = "mfi_tc_individualcheck_called_by_BeforeShow";
}
//End BindEvents Method

//mfi_hvf2_mfi_hvf1_call_attempt_BeforeShow @560-5406A2CF
function mfi_hvf2_mfi_hvf1_call_attempt_BeforeShow(& $sender)
{
    $mfi_hvf2_mfi_hvf1_call_attempt_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf2_mfi_hvf1; //Compatibility
//End mfi_hvf2_mfi_hvf1_call_attempt_BeforeShow

//Custom Code @565-2A29BDB7
// -------------------------
	$laid=$mfi_hvf2_mfi_hvf1->mfi_hvf1_la_id->GetValue();
    $sql="select count(*) from mfi_tc_individualcheck where la_id='".$laid."'";
    $db=new clsDBmysql_cams_v2();
    $res=$db->query($sql);
    $row=mysql_fetch_row($res);
    $mfi_hvf2_mfi_hvf1->call_attempt->SetValue($row[0]+1);
// -------------------------
//End Custom Code

//Close mfi_hvf2_mfi_hvf1_call_attempt_BeforeShow @560-241284F7
    return $mfi_hvf2_mfi_hvf1_call_attempt_BeforeShow;
}
//End Close mfi_hvf2_mfi_hvf1_call_attempt_BeforeShow

//mfi_hvf2_mfi_hvf1_village_name_BeforeShow @1193-BD1BE60E
function mfi_hvf2_mfi_hvf1_village_name_BeforeShow(& $sender)
{
    $mfi_hvf2_mfi_hvf1_village_name_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf2_mfi_hvf1; //Compatibility
//End mfi_hvf2_mfi_hvf1_village_name_BeforeShow

//Custom Code @1205-2A29BDB7
// -------------------------
	$cpno=$mfi_hvf2_mfi_hvf1->cp_id->GetValue();
	$sql="select mfi_cp_census_village from mfi_cp where cp_id='".$cpno."'";
	$db=new clsDBmysql_cams_v2();
	$res=$db->query($sql);
	$row=mysql_fetch_row($res);
    $mfi_hvf2_mfi_hvf1->village_name->SetValue($row[0]);
    $gpno=$mfi_hvf2_mfi_hvf1->mfi_gp_id->GetValue();
    $sql="select count(*) from camsdata123 where `GP NO`='".$gpno."'";
    $res=$db->query($sql);
	$row=mysql_fetch_row($res);
	$mfi_hvf2_mfi_hvf1->group_size->SetValue($row[0]);
// -------------------------
//End Custom Code

//Close mfi_hvf2_mfi_hvf1_village_name_BeforeShow @1193-4EB66404
    return $mfi_hvf2_mfi_hvf1_village_name_BeforeShow;
}
//End Close mfi_hvf2_mfi_hvf1_village_name_BeforeShow

//mfi_tc_individualcheck_called_by_BeforeShow @590-6C67ACAF
function mfi_tc_individualcheck_called_by_BeforeShow(& $sender)
{
    $mfi_tc_individualcheck_called_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_individualcheck; //Compatibility
//End mfi_tc_individualcheck_called_by_BeforeShow

//Custom Code @767-2A29BDB7
// -------------------------
   $mfi_tc_individualcheck->called_by->SetValue(CCGetUserLogin());
   date_default_timezone_set ( 'Asia/Kolkata');
   $dat=date("Y-m-d-H:i:s");
   $mfi_tc_individualcheck->called_at->SetValue($dat);
// -------------------------
//End Custom Code

//Close mfi_tc_individualcheck_called_by_BeforeShow @590-75769CD2
    return $mfi_tc_individualcheck_called_by_BeforeShow;
}
//End Close mfi_tc_individualcheck_called_by_BeforeShow


?>
