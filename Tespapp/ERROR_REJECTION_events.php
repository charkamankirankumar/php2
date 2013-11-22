<?php
//BindEvents Method @1-84B5F483
function BindEvents()
{
    global $mfi_docs;
    $mfi_docs->Report_TotalRecords->CCSEvents["BeforeShow"] = "mfi_docs_Report_TotalRecords_BeforeShow";
}
//End BindEvents Method

//mfi_docs_Report_TotalRecords_BeforeShow @74-E3C94C40
function mfi_docs_Report_TotalRecords_BeforeShow(& $sender)
{
    $mfi_docs_Report_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_Report_TotalRecords_BeforeShow
$mfi_docs->Report_TotalRecords->SetValue($mfi_docs->DataSource->RecordsCount);
//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_Report_TotalRecords_BeforeShow @74-CC42B1D4
    return $mfi_docs_Report_TotalRecords_BeforeShow;
}
//End Close mfi_docs_Report_TotalRecords_BeforeShow


?>
