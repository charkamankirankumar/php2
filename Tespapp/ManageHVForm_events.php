<?php
//BindEvents Method @1-E83D57B8
function BindEvents()
{
    global $mfi_hvf1_mfi_hvf2;
    $mfi_hvf1_mfi_hvf2->mfi_hvf1_mfi_hvf2_TotalRecords->CCSEvents["BeforeShow"] = "mfi_hvf1_mfi_hvf2_mfi_hvf1_mfi_hvf2_TotalRecords_BeforeShow";
}
//End BindEvents Method

//mfi_hvf1_mfi_hvf2_mfi_hvf1_mfi_hvf2_TotalRecords_BeforeShow @108-1880472C
function mfi_hvf1_mfi_hvf2_mfi_hvf1_mfi_hvf2_TotalRecords_BeforeShow(& $sender)
{
    $mfi_hvf1_mfi_hvf2_mfi_hvf1_mfi_hvf2_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf1_mfi_hvf2; //Compatibility
//End mfi_hvf1_mfi_hvf2_mfi_hvf1_mfi_hvf2_TotalRecords_BeforeShow

//Retrieve number of records @109-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close mfi_hvf1_mfi_hvf2_mfi_hvf1_mfi_hvf2_TotalRecords_BeforeShow @108-C21B4500
    return $mfi_hvf1_mfi_hvf2_mfi_hvf1_mfi_hvf2_TotalRecords_BeforeShow;
}
//End Close mfi_hvf1_mfi_hvf2_mfi_hvf1_mfi_hvf2_TotalRecords_BeforeShow


?>
