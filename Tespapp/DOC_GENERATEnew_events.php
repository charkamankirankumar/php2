<?php
//BindEvents Method @1-C51BB738
function BindEvents()
{
    global $nps_master;
    $nps_master->CCSEvents["BeforeShow"] = "nps_master_BeforeShow";
}
//End BindEvents Method

//nps_master_BeforeShow @2-BF395E3B
function nps_master_BeforeShow(& $sender)
{
    $nps_master_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $nps_master; //Compatibility
//End nps_master_BeforeShow

//Custom Code @17-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close nps_master_BeforeShow @2-120C7433
    return $nps_master_BeforeShow;
}
//End Close nps_master_BeforeShow


?>
