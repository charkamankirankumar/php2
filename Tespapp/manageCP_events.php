<?php
//BindEvents Method @1-5211CA17
function BindEvents()
{
    global $mfi_cp1;
    $mfi_cp1->CCSEvents["BeforeShow"] = "mfi_cp1_BeforeShow";
}
//End BindEvents Method

//mfi_cp1_BeforeShow @51-54FED96D
function mfi_cp1_BeforeShow(& $sender)
{
    $mfi_cp1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_cp1; //Compatibility
//End mfi_cp1_BeforeShow

//Custom Code @145-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if (count($_GET)<1)
$mfi_cp1->Visible=false;
//Close mfi_cp1_BeforeShow @51-65A07CE5
    return $mfi_cp1_BeforeShow;
}
//End Close mfi_cp1_BeforeShow


?>
