<?php
//BindEvents Method @1-4E364F21
function BindEvents()
{
    global $mfi_fileupload1;
    global $cb_response_upload;
    $mfi_fileupload1->mfi_uploaded_by->CCSEvents["BeforeShow"] = "mfi_fileupload1_mfi_uploaded_by_BeforeShow";
    $cb_response_upload->ds->CCSEvents["BeforeBuildSelect"] = "cb_response_upload_ds_BeforeBuildSelect";
}
//End BindEvents Method

//mfi_fileupload1_mfi_uploaded_by_BeforeShow @48-06018C0A
function mfi_fileupload1_mfi_uploaded_by_BeforeShow(& $sender)
{
    $mfi_fileupload1_mfi_uploaded_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_fileupload1; //Compatibility
//End mfi_fileupload1_mfi_uploaded_by_BeforeShow

//Custom Code @102-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_fileupload1->mfi_uploaded_by->SetValue(CCGetUserLogin());
//Close mfi_fileupload1_mfi_uploaded_by_BeforeShow @48-F4E0C5C6
    return $mfi_fileupload1_mfi_uploaded_by_BeforeShow;
}
//End Close mfi_fileupload1_mfi_uploaded_by_BeforeShow

//cb_response_upload_ds_BeforeBuildSelect @70-D9C6AD76
function cb_response_upload_ds_BeforeBuildSelect(& $sender)
{
    $cb_response_upload_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cb_response_upload; //Compatibility
//End cb_response_upload_ds_BeforeBuildSelect

//Custom Code @107-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if(count($_GET)<1)
$cb_response_upload->DataSource->SQL="";
//Close cb_response_upload_ds_BeforeBuildSelect @70-DE79DAAD
    return $cb_response_upload_ds_BeforeBuildSelect;
}
//End Close cb_response_upload_ds_BeforeBuildSelect
?>
