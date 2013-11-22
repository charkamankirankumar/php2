<?php
//BindEvents Method @1-B98D0FB3
function BindEvents()
{
    global $welcomecalls;
    global $wc_reports;
    $welcomecalls->Label6->CCSEvents["BeforeShow"] = "welcomecalls_Label6_BeforeShow";
    $welcomecalls->Hidden1->CCSEvents["BeforeShow"] = "welcomecalls_Hidden1_BeforeShow";
    $wc_reports->ans_3->CCSEvents["BeforeShow"] = "wc_reports_ans_3_BeforeShow";
    $wc_reports->called_by->CCSEvents["BeforeShow"] = "wc_reports_called_by_BeforeShow";
}
//End BindEvents Method

//welcomecalls_Label6_BeforeShow @67-B2DFE68B
function welcomecalls_Label6_BeforeShow(& $sender)
{
    $welcomecalls_Label6_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $welcomecalls; //Compatibility
//End welcomecalls_Label6_BeforeShow

//Custom Code @68-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
 	$Container->Label6->SetText("7760976811");
  // -------------------------


//Close welcomecalls_Label6_BeforeShow @67-E8AC8F9B
    return $welcomecalls_Label6_BeforeShow;
}
//End Close welcomecalls_Label6_BeforeShow

//welcomecalls_Hidden1_BeforeShow @71-F5ED23BB
function welcomecalls_Hidden1_BeforeShow(& $sender)
{
    $welcomecalls_Hidden1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $welcomecalls; //Compatibility
//End welcomecalls_Hidden1_BeforeShow

//Custom Code @72-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
	
  	$ts=$Container->MEMBER_ID->GetValue();	
  	$db = new clsDBmysql_cams_v2();
  	$result1 = $db->query("select TeleCall_Status from welcomecalls where Member_Code='$ts'");
  	$re11 =mysql_fetch_row($result1);
  	if($re11[0]!="")
  	{
  	echo "<script language='javascript'> alert('$re11[0]');</script>";	
  	//echo $re11[0];
  	}
  	
  // -------------------------


//Close welcomecalls_Hidden1_BeforeShow @71-029C05DA
    return $welcomecalls_Hidden1_BeforeShow;
}
//End Close welcomecalls_Hidden1_BeforeShow

//wc_reports_ans_3_BeforeShow @88-BEE8E906
function wc_reports_ans_3_BeforeShow(& $sender)
{
    $wc_reports_ans_3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $wc_reports; //Compatibility
//End wc_reports_ans_3_BeforeShow

//Custom Code @105-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close wc_reports_ans_3_BeforeShow @88-45DCF997
    return $wc_reports_ans_3_BeforeShow;
}
//End Close wc_reports_ans_3_BeforeShow

//wc_reports_called_by_BeforeShow @99-9418A966
function wc_reports_called_by_BeforeShow(& $sender)
{
    $wc_reports_called_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $wc_reports; //Compatibility
//End wc_reports_called_by_BeforeShow

//Custom Code @106-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$Container->called_by->SetValue(CCGetUserLogin());
//Close wc_reports_called_by_BeforeShow @99-285F4B17
    return $wc_reports_called_by_BeforeShow;
}
//End Close wc_reports_called_by_BeforeShow

  // -------------------------
      // Write your own code here.
  	
  	//$Container->call_attempt->SetValue($_GET["cent"]);

// -------------------------

  // -------------------------
      // Write your own code here.
  	//$Container->called_by->SetValue(CCGetUserLogin());
  // -------------------------


  // -------------------------
      // Write your own code here.
  	//$Container->region->SetValue($_GET["reg"]);
  // -------------------------


  // -------------------------
      // Write your own code here.
  	//$Container->Hidden2->SetValue($_GET["gp_id"]);
  // -------------------------


  // -------------------------
      // Write your own code here.
  	//$Container->Hidden3->SetValue($_GET["gp_name"]);
  // -------------------------





?>
