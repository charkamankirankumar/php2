<?php
//BindEvents Method @1-75631C2B
function BindEvents()
{
    global $mfi_docs;
    global $batch_details;
    $mfi_docs->Navigator->CCSEvents["BeforeShow"] = "mfi_docs_Navigator_BeforeShow";
    $batch_details->Navigator->CCSEvents["BeforeShow"] = "batch_details_Navigator_BeforeShow";
}
//End BindEvents Method

//mfi_docs_Navigator_BeforeShow @73-9DBB23A9
function mfi_docs_Navigator_BeforeShow(& $sender)
{
    $mfi_docs_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_Navigator_BeforeShow

//Hide-Show Component @74-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close mfi_docs_Navigator_BeforeShow @73-FB0E8F26
    return $mfi_docs_Navigator_BeforeShow;
}
//End Close mfi_docs_Navigator_BeforeShow

//batch_details_Navigator_BeforeShow @101-890EE457
function batch_details_Navigator_BeforeShow(& $sender)
{
    $batch_details_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $batch_details; //Compatibility
//End batch_details_Navigator_BeforeShow

//Hide-Show Component @102-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close batch_details_Navigator_BeforeShow @101-03F72393
    return $batch_details_Navigator_BeforeShow;
}
//End Close batch_details_Navigator_BeforeShow
if(!$_GET["doc_entered_at"])
{
$mfi_docs1->DataSource->SQL="";
$mfi_docs1->Visible=false;
}

?>
