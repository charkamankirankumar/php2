<?php
//BindEvents Method @1-7FB6253D
function BindEvents()
{
    global $mfi_docs;
    $mfi_docs->Navigator->CCSEvents["BeforeShow"] = "mfi_docs_Navigator_BeforeShow";
}
//End BindEvents Method

//mfi_docs_Navigator_BeforeShow @31-9DBB23A9
function mfi_docs_Navigator_BeforeShow(& $sender)
{
    $mfi_docs_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_Navigator_BeforeShow

//Hide-Show Component @32-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close mfi_docs_Navigator_BeforeShow @31-FB0E8F26
    return $mfi_docs_Navigator_BeforeShow;
}
//End Close mfi_docs_Navigator_BeforeShow
?>
