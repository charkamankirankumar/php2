<?php
//BindEvents Method @1-D4771FFE
function BindEvents()
{
    global $cams_himark_view;
    global $Button3;
    $cams_himark_view->cams_himark_view_TotalRecords->CCSEvents["BeforeShow"] = "cams_himark_view_cams_himark_view_TotalRecords_BeforeShow";
    $cams_himark_view->ds->CCSEvents["BeforeBuildSelect"] = "cams_himark_view_ds_BeforeBuildSelect";
    $Button3->CCSEvents["BeforeShow"] = "Button3_BeforeShow";
}
//End BindEvents Method

//cams_himark_view_cams_himark_view_TotalRecords_BeforeShow @15-533A0AA2
function cams_himark_view_cams_himark_view_TotalRecords_BeforeShow(& $sender)
{
    $cams_himark_view_cams_himark_view_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cams_himark_view; //Compatibility
//End cams_himark_view_cams_himark_view_TotalRecords_BeforeShow

//Retrieve number of records @16-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records
$cams_himark_view->cams_himark_view_TotalRecords->SetValue($cams_himark_view->DataSource->RecordsCount);
//Close cams_himark_view_cams_himark_view_TotalRecords_BeforeShow @15-D4C8BFFE
    return $cams_himark_view_cams_himark_view_TotalRecords_BeforeShow;
}
//End Close cams_himark_view_cams_himark_view_TotalRecords_BeforeShow

//cams_himark_view_ds_BeforeBuildSelect @5-DD7BBE39
function cams_himark_view_ds_BeforeBuildSelect(& $sender)
{
    $cams_himark_view_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cams_himark_view; //Compatibility
//End cams_himark_view_ds_BeforeBuildSelect

//Custom Code @91-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if ($_GET['s_Branch_ID']=="" && $_GET['s_Kendra_ID']=="" && $_GET['s_Member_ID']=="" && $_GET['s_Enquiry_Add_at']=="" && $_GET['s_enquiry_status']=="" && $_GET['genfrm']=="" && $_GET['gento']=="")
{
  $cams_himark_view->Visible=false;
  $cams_himark_view->DataSource->SQL="";
  
}
else
{
$cams_himark_view->Visible=true;
}
//Close cams_himark_view_ds_BeforeBuildSelect @5-A689794D
    return $cams_himark_view_ds_BeforeBuildSelect;
}
//End Close cams_himark_view_ds_BeforeBuildSelect

//Button3_BeforeShow @94-5F7E2B06
function Button3_BeforeShow(& $sender)
{
    $Button3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Button3; //Compatibility
//End Button3_BeforeShow

//Custom Code @106-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Button3_BeforeShow @94-1AABC420
    return $Button3_BeforeShow;
}
//End Close Button3_BeforeShow
?>
