<?php
//BindEvents Method @1-2443E3B5
function BindEvents()
{
    global $ybl_kyc;
    $ybl_kyc->added_by_1->CCSEvents["BeforeShow"] = "ybl_kyc_added_by_1_BeforeShow";
}
//End BindEvents Method

//ybl_kyc_added_by_1_BeforeShow @29-B56BD91B
function ybl_kyc_added_by_1_BeforeShow(& $sender)
{
    $ybl_kyc_added_by_1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ybl_kyc; //Compatibility
//End ybl_kyc_added_by_1_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
	
	
		date_default_timezone_set ( 'Asia/Kolkata');
	    $ybl_kyc->added_by_1->SetValue(CCGetUserLogin());
	    $dat=date("Y-m-d H:i:s");
	    $ybl_kyc->added_at_1->SetValue($dat);
	
// -------------------------
//End Custom Code

//Close ybl_kyc_added_by_1_BeforeShow @29-E017CBC5
    return $ybl_kyc_added_by_1_BeforeShow;
}
//End Close ybl_kyc_added_by_1_BeforeShow


?>
