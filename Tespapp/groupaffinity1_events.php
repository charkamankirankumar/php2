<?php
//BindEvents Method @1-C0C47F98
function BindEvents()
{
    global $cbodataentry_mfi_gp_mfi_h;
    global $mfi_tc_ga_sanction_detail;
    global $mfi_tc_group_affinity_che;
    global $NewRecord1;
    global $mfi_tc_ga_sanction_detail1;
    $cbodataentry_mfi_gp_mfi_h->CCSEvents["BeforeShow"] = "cbodataentry_mfi_gp_mfi_h_BeforeShow";
    $mfi_tc_ga_sanction_detail->Button_Insert->CCSEvents["BeforeShow"] = "mfi_tc_ga_sanction_detail_Button_Insert_BeforeShow";
    $mfi_tc_ga_sanction_detail->mfi_gp_no->CCSEvents["BeforeShow"] = "mfi_tc_ga_sanction_detail_mfi_gp_no_BeforeShow";
    $mfi_tc_ga_sanction_detail->mfi_group_sanction_by->CCSEvents["BeforeShow"] = "mfi_tc_ga_sanction_detail_mfi_group_sanction_by_BeforeShow";
    $mfi_tc_group_affinity_che->la_no->CCSEvents["BeforeShow"] = "mfi_tc_group_affinity_che_la_no_BeforeShow";
    $mfi_tc_group_affinity_che->mfi_hvf_group_id->CCSEvents["BeforeShow"] = "mfi_tc_group_affinity_che_mfi_hvf_group_id_BeforeShow";
    $mfi_tc_group_affinity_che->called_by->CCSEvents["BeforeShow"] = "mfi_tc_group_affinity_che_called_by_BeforeShow";
    $NewRecord1->TextBox1->CCSEvents["BeforeShow"] = "NewRecord1_TextBox1_BeforeShow";
    $mfi_tc_ga_sanction_detail1->mfi_gp_no->CCSEvents["BeforeShow"] = "mfi_tc_ga_sanction_detail1_mfi_gp_no_BeforeShow";
    $mfi_tc_ga_sanction_detail1->mfi_group_sanction_by->CCSEvents["BeforeShow"] = "mfi_tc_ga_sanction_detail1_mfi_group_sanction_by_BeforeShow";
}
//End BindEvents Method

//cbodataentry_mfi_gp_mfi_h_BeforeShow @16-F525E2FE
function cbodataentry_mfi_gp_mfi_h_BeforeShow(& $sender)
{
    $cbodataentry_mfi_gp_mfi_h_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cbodataentry_mfi_gp_mfi_h; //Compatibility
//End cbodataentry_mfi_gp_mfi_h_BeforeShow

//Custom Code @125-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	
//Close cbodataentry_mfi_gp_mfi_h_BeforeShow @16-5F7CE21F
    return $cbodataentry_mfi_gp_mfi_h_BeforeShow;
}
//End Close cbodataentry_mfi_gp_mfi_h_BeforeShow

//mfi_tc_ga_sanction_detail_Button_Insert_BeforeShow @87-2CB3588C
function mfi_tc_ga_sanction_detail_Button_Insert_BeforeShow(& $sender)
{
    $mfi_tc_ga_sanction_detail_Button_Insert_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_ga_sanction_detail; //Compatibility
//End mfi_tc_ga_sanction_detail_Button_Insert_BeforeShow

//Custom Code @210-2A29BDB7
// -------------------------
	$db = new clsDBmysql_cams_v2();
	$sql="select distinct(mfi_telecaller_status) from mfi_hvf2 where gp_id='".$_GET['gp_id']."'";
	$res=$db->query($sql);
	$row=mysql_fetch_row($res);
	if(in_array('PENDING',$row))
    	$mfi_tc_ga_sanction_detail->group_sanction_buton_status->SetValue('no');
    else
    	$mfi_tc_ga_sanction_detail->group_sanction_buton_status->SetValue('yes');
// -------------------------
//End Custom Code

//Close mfi_tc_ga_sanction_detail_Button_Insert_BeforeShow @87-C4F68219
    return $mfi_tc_ga_sanction_detail_Button_Insert_BeforeShow;
}
//End Close mfi_tc_ga_sanction_detail_Button_Insert_BeforeShow

  
//mfi_tc_ga_sanction_detail_mfi_gp_no_BeforeShow @89-7114FB02
function mfi_tc_ga_sanction_detail_mfi_gp_no_BeforeShow(& $sender)
{
    $mfi_tc_ga_sanction_detail_mfi_gp_no_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_ga_sanction_detail; //Compatibility
//End mfi_tc_ga_sanction_detail_mfi_gp_no_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Container->mfi_gp_no->SetValue(($_GET["gp_id"]));
  // -------------------------


//Close mfi_tc_ga_sanction_detail_mfi_gp_no_BeforeShow @89-72A93AA5
    return $mfi_tc_ga_sanction_detail_mfi_gp_no_BeforeShow;
}
//End Close mfi_tc_ga_sanction_detail_mfi_gp_no_BeforeShow

//mfi_tc_ga_sanction_detail_mfi_group_sanction_by_BeforeShow @93-E914DD90
function mfi_tc_ga_sanction_detail_mfi_group_sanction_by_BeforeShow(& $sender)
{
    $mfi_tc_ga_sanction_detail_mfi_group_sanction_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_ga_sanction_detail; //Compatibility
//End mfi_tc_ga_sanction_detail_mfi_group_sanction_by_BeforeShow

//Custom Code @99-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	
  	//$Container->mfi_group_sanction_by->SetValue(CCGetUserLogin());
  	$Container->mfi_group_sanction_by->SetValue(CCGetUserLogin());
  // -------------------------


//Close mfi_tc_ga_sanction_detail_mfi_group_sanction_by_BeforeShow @93-7888C006
    return $mfi_tc_ga_sanction_detail_mfi_group_sanction_by_BeforeShow;
}
//End Close mfi_tc_ga_sanction_detail_mfi_group_sanction_by_BeforeShow

//mfi_tc_group_affinity_che_la_no_BeforeShow @152-68ADE55A
function mfi_tc_group_affinity_che_la_no_BeforeShow(& $sender)
{
    $mfi_tc_group_affinity_che_la_no_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_group_affinity_che; //Compatibility
//End mfi_tc_group_affinity_che_la_no_BeforeShow

//Custom Code @166-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
 $mfi_tc_group_affinity_che->la_no->SetValue(($_GET["la_id"]));
//Close mfi_tc_group_affinity_che_la_no_BeforeShow @152-6BC503EF
    return $mfi_tc_group_affinity_che_la_no_BeforeShow;
}
//End Close mfi_tc_group_affinity_che_la_no_BeforeShow

//mfi_tc_group_affinity_che_mfi_hvf_group_id_BeforeShow @153-226F3DE8
function mfi_tc_group_affinity_che_mfi_hvf_group_id_BeforeShow(& $sender)
{
    $mfi_tc_group_affinity_che_mfi_hvf_group_id_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_group_affinity_che; //Compatibility
//End mfi_tc_group_affinity_che_mfi_hvf_group_id_BeforeShow

//Custom Code @167-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_tc_group_affinity_che->mfi_hvf_group_id->SetValue(($_GET["gp_id"]));
//Close mfi_tc_group_affinity_che_mfi_hvf_group_id_BeforeShow @153-0FEFB067
    return $mfi_tc_group_affinity_che_mfi_hvf_group_id_BeforeShow;
}
//End Close mfi_tc_group_affinity_che_mfi_hvf_group_id_BeforeShow

//mfi_tc_group_affinity_che_called_by_BeforeShow @164-97D075C5
function mfi_tc_group_affinity_che_called_by_BeforeShow(& $sender)
{
    $mfi_tc_group_affinity_che_called_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_group_affinity_che; //Compatibility
//End mfi_tc_group_affinity_che_called_by_BeforeShow

//Custom Code @168-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_tc_group_affinity_che->called_by->SetValue(CCGetUserLogin());
//Close mfi_tc_group_affinity_che_called_by_BeforeShow @164-64B73A8F
    return $mfi_tc_group_affinity_che_called_by_BeforeShow;
}
//End Close mfi_tc_group_affinity_che_called_by_BeforeShow

//NewRecord1_TextBox1_BeforeShow @170-54CF35C1
function NewRecord1_TextBox1_BeforeShow(& $sender)
{
    $NewRecord1_TextBox1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
//End NewRecord1_TextBox1_BeforeShow

//Custom Code @175-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$ga=$_GET["gp_id"];
	$db = new clsDBmysql_cams_v2();
	$query="select COUNT(*) from mfi_hvf1 where cb_analysys_result='SANCTIONED' AND gp_id='$ga'";
    $result1 =$db->query($query);
	$re11 =mysql_fetch_row($result1);
	$NewRecord1->TextBox1->SetValue($re11[0]);
	$query1="select COUNT(*) from mfi_tc_individualcheck where mfi_tc_call_log='CONNECTED' AND mfi_group_id='$ga'";
    $result2 = $db->query($query1);
	$re12 =mysql_fetch_row($result2);
	$NewRecord1->TextBox2->SetValue($re12[0]);
	$query2="select COUNT(*) from mfi_tc_group_affinity_check where mfi_tc_ga_status='SATISFACTORY' AND mfi_hvf_group_id='$ga'";
	$result3 = $db->query($query2);
	$re13 =mysql_fetch_row($result3);
	$NewRecord1->TextBox3->SetValue($re13[0]);
	$query3="select COUNT(*) from mfi_tc_group_affinity_check where mfi_tc_ga_status='UNSATISFACTORY' AND mfi_hvf_group_id='$ga'";
	$result4 =$db->query($query3);
	$re14 =mysql_fetch_row($result4);
	$NewRecord1->TextBox4->SetValue($re14[0]);
//Close NewRecord1_TextBox1_BeforeShow @170-74544E0D
    return $NewRecord1_TextBox1_BeforeShow;
}
//End Close NewRecord1_TextBox1_BeforeShow

//mfi_tc_ga_sanction_detail1_mfi_gp_no_BeforeShow @180-D9A9F45C
function mfi_tc_ga_sanction_detail1_mfi_gp_no_BeforeShow(& $sender)
{
    $mfi_tc_ga_sanction_detail1_mfi_gp_no_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_ga_sanction_detail1; //Compatibility
//End mfi_tc_ga_sanction_detail1_mfi_gp_no_BeforeShow

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_tc_ga_sanction_detail1->mfi_gp_no->SetValue(($_GET["gp_id"]));
//Close mfi_tc_ga_sanction_detail1_mfi_gp_no_BeforeShow @180-66467D73
    return $mfi_tc_ga_sanction_detail1_mfi_gp_no_BeforeShow;
}
//End Close mfi_tc_ga_sanction_detail1_mfi_gp_no_BeforeShow

//mfi_tc_ga_sanction_detail1_mfi_group_sanction_by_BeforeShow @181-BCD48FC6
function mfi_tc_ga_sanction_detail1_mfi_group_sanction_by_BeforeShow(& $sender)
{
    $mfi_tc_ga_sanction_detail1_mfi_group_sanction_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_ga_sanction_detail1; //Compatibility
//End mfi_tc_ga_sanction_detail1_mfi_group_sanction_by_BeforeShow

//Custom Code @184-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_tc_ga_sanction_detail1->mfi_group_sanction_by->SetValue(CCGetUserLogin());
//Close mfi_tc_ga_sanction_detail1_mfi_group_sanction_by_BeforeShow @181-03BF19E7
    return $mfi_tc_ga_sanction_detail1_mfi_group_sanction_by_BeforeShow;
}
//End Close mfi_tc_ga_sanction_detail1_mfi_group_sanction_by_BeforeShow
	



?>
