<?php
//BindEvents Method @1-802CA488
function BindEvents()
{
    global $mfi_hvf1;
    $mfi_hvf1->CCSEvents["BeforeShow"] = "mfi_hvf1_BeforeShow";
}
//End BindEvents Method

//mfi_hvf1_BeforeShow @2-F86CC393
function mfi_hvf1_BeforeShow(& $sender)
{
    $mfi_hvf1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf1; //Compatibility
//End mfi_hvf1_BeforeShow

//Custom Code @142-2A29BDB7
// -------------------------
   date_default_timezone_set ( 'Asia/Kolkata');
	if($mfi_hvf1->EditMode)
	{
		$mfi_hvf1->updated_by->SetValue(CCGetUserLogin());
		$mfi_hvf1->updated_at->SetValue(date('Y-m-d H:i:s'));
	}	
	else
	{
		$mfi_hvf1->added_at->SetValue(date('Y-m-d H:i:s'));
		$mfi_hvf1->added_by->SetValue(CCGetUserLogin());
	}
// -------------------------
//End Custom Code

//Close mfi_hvf1_BeforeShow @2-14D264B5
    return $mfi_hvf1_BeforeShow;
}
//End Close mfi_hvf1_BeforeShow


?>
