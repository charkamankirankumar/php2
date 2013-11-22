<?php
//BindEvents Method @1-F13EFCE3
function BindEvents()
{
    global $cbodataentry_mfi_hvf2;
    $cbodataentry_mfi_hvf2->cbodataentry_mfi_hvf2_TotalRecords->CCSEvents["BeforeShow"] = "cbodataentry_mfi_hvf2_cbodataentry_mfi_hvf2_TotalRecords_BeforeShow";
    $cbodataentry_mfi_hvf2->CCSEvents["BeforeShow"] = "cbodataentry_mfi_hvf2_BeforeShow";
    $cbodataentry_mfi_hvf2->ds->CCSEvents["BeforeExecuteSelect"] = "cbodataentry_mfi_hvf2_ds_BeforeExecuteSelect";
}
//End BindEvents Method

//cbodataentry_mfi_hvf2_cbodataentry_mfi_hvf2_TotalRecords_BeforeShow @88-41DE3E5D
function cbodataentry_mfi_hvf2_cbodataentry_mfi_hvf2_TotalRecords_BeforeShow(& $sender)
{
    $cbodataentry_mfi_hvf2_cbodataentry_mfi_hvf2_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cbodataentry_mfi_hvf2; //Compatibility
//End cbodataentry_mfi_hvf2_cbodataentry_mfi_hvf2_TotalRecords_BeforeShow

//Retrieve number of records @89-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records
$cbodataentry_mfi_hvf2->cbodataentry_mfi_hvf2_TotalRecords->SetValue($cbodataentry_mfi_hvf2->ds->RecordsCount);
//Close cbodataentry_mfi_hvf2_cbodataentry_mfi_hvf2_TotalRecords_BeforeShow @88-F5C4B68B
    return $cbodataentry_mfi_hvf2_cbodataentry_mfi_hvf2_TotalRecords_BeforeShow;
}
//End Close cbodataentry_mfi_hvf2_cbodataentry_mfi_hvf2_TotalRecords_BeforeShow

//cbodataentry_mfi_hvf2_BeforeShow @75-881295A9
function cbodataentry_mfi_hvf2_BeforeShow(& $sender)
{
    $cbodataentry_mfi_hvf2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cbodataentry_mfi_hvf2; //Compatibility
//End cbodataentry_mfi_hvf2_BeforeShow

//Custom Code @277-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if(!isset($_GET["s_added_by"])&&!isset($_GET["s_added_at"])&&!isset($_GET["s_mfi_hvf1_no"]))
$cbodataentry_mfi_hvf2->Visible=false;
//Close cbodataentry_mfi_hvf2_BeforeShow @75-FFAFC8C6
    return $cbodataentry_mfi_hvf2_BeforeShow;
}
//End Close cbodataentry_mfi_hvf2_BeforeShow

//cbodataentry_mfi_hvf2_ds_BeforeExecuteSelect @75-EF840787
function cbodataentry_mfi_hvf2_ds_BeforeExecuteSelect(& $sender)
{
    $cbodataentry_mfi_hvf2_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cbodataentry_mfi_hvf2; //Compatibility
//End cbodataentry_mfi_hvf2_ds_BeforeExecuteSelect

//Custom Code @306-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close cbodataentry_mfi_hvf2_ds_BeforeExecuteSelect @75-0AC96463
    return $cbodataentry_mfi_hvf2_ds_BeforeExecuteSelect;
}
//End Close cbodataentry_mfi_hvf2_ds_BeforeExecuteSelect
?>
