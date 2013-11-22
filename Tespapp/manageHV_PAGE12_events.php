<?php
//BindEvents Method @1-F87CDC09
function BindEvents()
{
    global $mfi_hvf1;
    global $mfi_hvf3_mfi_hvf1;
    global $mfi_hvf2;
    global $ybl_kyc_mfi_hvf1;
    global $CCSEvents;
    $mfi_hvf1->Label1->CCSEvents["BeforeShow"] = "mfi_hvf1_Label1_BeforeShow";
    $mfi_hvf1->ds->CCSEvents["BeforeBuildSelect"] = "mfi_hvf1_ds_BeforeBuildSelect";
    $mfi_hvf3_mfi_hvf1->Label1->CCSEvents["BeforeShow"] = "mfi_hvf3_mfi_hvf1_Label1_BeforeShow";
    $mfi_hvf3_mfi_hvf1->ds->CCSEvents["BeforeBuildSelect"] = "mfi_hvf3_mfi_hvf1_ds_BeforeBuildSelect";
    $mfi_hvf2->Label3->CCSEvents["BeforeShow"] = "mfi_hvf2_Label3_BeforeShow";
    $mfi_hvf2->ds->CCSEvents["BeforeBuildSelect"] = "mfi_hvf2_ds_BeforeBuildSelect";
    $ybl_kyc_mfi_hvf1->Label1->CCSEvents["BeforeShow"] = "ybl_kyc_mfi_hvf1_Label1_BeforeShow";
    $ybl_kyc_mfi_hvf1->ds->CCSEvents["BeforeBuildSelect"] = "ybl_kyc_mfi_hvf1_ds_BeforeBuildSelect";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//mfi_hvf1_Label1_BeforeShow @186-5B46F0E5
function mfi_hvf1_Label1_BeforeShow(& $sender)
{
    $mfi_hvf1_Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf1; //Compatibility
//End mfi_hvf1_Label1_BeforeShow
$mfi_hvf1->Label1->SetValue($mfi_hvf1->DataSource->RecordsCount);
//Custom Code @187-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_hvf1_Label1_BeforeShow @186-B118E543
    return $mfi_hvf1_Label1_BeforeShow;
}
//End Close mfi_hvf1_Label1_BeforeShow

//mfi_hvf1_ds_BeforeBuildSelect @14-278AAF47
function mfi_hvf1_ds_BeforeBuildSelect(& $sender)
{
    $mfi_hvf1_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf1; //Compatibility
//End mfi_hvf1_ds_BeforeBuildSelect
if (count($_GET)<=0)
{
  $mfi_hvf1->Visible=false;
  $mfi_hvf1->DataSource->SQL="";
}
else
{
$mfi_hvf1->Visible=true;
}
//Custom Code @57-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_hvf1_ds_BeforeBuildSelect @14-614BDEF8
    return $mfi_hvf1_ds_BeforeBuildSelect;
}
//End Close mfi_hvf1_ds_BeforeBuildSelect

//mfi_hvf3_mfi_hvf1_Label1_BeforeShow @184-C9096902
function mfi_hvf3_mfi_hvf1_Label1_BeforeShow(& $sender)
{
    $mfi_hvf3_mfi_hvf1_Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf3_mfi_hvf1; //Compatibility
//End mfi_hvf3_mfi_hvf1_Label1_BeforeShow
$mfi_hvf3_mfi_hvf1->Label1->SetValue($mfi_hvf3_mfi_hvf1->DataSource->RecordsCount);
//Custom Code @185-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_hvf3_mfi_hvf1_Label1_BeforeShow @184-C751E0A7
    return $mfi_hvf3_mfi_hvf1_Label1_BeforeShow;
}
//End Close mfi_hvf3_mfi_hvf1_Label1_BeforeShow

//mfi_hvf3_mfi_hvf1_ds_BeforeBuildSelect @62-937B2181
function mfi_hvf3_mfi_hvf1_ds_BeforeBuildSelect(& $sender)
{
    $mfi_hvf3_mfi_hvf1_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf3_mfi_hvf1; //Compatibility
//End mfi_hvf3_mfi_hvf1_ds_BeforeBuildSelect
if (count($_GET)<=0)
{
  $mfi_hvf3_mfi_hvf1->Visible=false;
  $mfi_hvf3_mfi_hvf1->DataSource->SQL="";
}
else
{
$mfi_hvf3_mfi_hvf1->Visible=true;
}
//Custom Code @125-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_hvf3_mfi_hvf1_ds_BeforeBuildSelect @62-BDD7AB83
    return $mfi_hvf3_mfi_hvf1_ds_BeforeBuildSelect;
}
//End Close mfi_hvf3_mfi_hvf1_ds_BeforeBuildSelect

//mfi_hvf2_Label3_BeforeShow @179-AEFCCAFF
function mfi_hvf2_Label3_BeforeShow(& $sender)
{
    $mfi_hvf2_Label3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf2; //Compatibility
//End mfi_hvf2_Label3_BeforeShow
$mfi_hvf2->Label3->SetValue($mfi_hvf2->DataSource->RecordsCount);
//Custom Code @180-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_hvf2_Label3_BeforeShow @179-2B68A30D
    return $mfi_hvf2_Label3_BeforeShow;
}
//End Close mfi_hvf2_Label3_BeforeShow

//mfi_hvf2_ds_BeforeBuildSelect @144-7099FB3F
function mfi_hvf2_ds_BeforeBuildSelect(& $sender)
{
    $mfi_hvf2_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf2; //Compatibility
//End mfi_hvf2_ds_BeforeBuildSelect
if (count($_GET)<=0)
{
  $mfi_hvf2->Visible=false;
  $mfi_hvf2->DataSource->SQL="";
}
else
{
$mfi_hvf2->Visible=true;
}
//Custom Code @181-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_hvf2_ds_BeforeBuildSelect @144-395577D0
    return $mfi_hvf2_ds_BeforeBuildSelect;
}
//End Close mfi_hvf2_ds_BeforeBuildSelect

//ybl_kyc_mfi_hvf1_Label1_BeforeShow @282-DEE5384E
function ybl_kyc_mfi_hvf1_Label1_BeforeShow(& $sender)
{
    $ybl_kyc_mfi_hvf1_Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ybl_kyc_mfi_hvf1; //Compatibility
//End ybl_kyc_mfi_hvf1_Label1_BeforeShow
$ybl_kyc_mfi_hvf1->Label1->SetValue($ybl_kyc_mfi_hvf1->DataSource->RecordsCount);
//Custom Code @283-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close ybl_kyc_mfi_hvf1_Label1_BeforeShow @282-FD618523
    return $ybl_kyc_mfi_hvf1_Label1_BeforeShow;
}
//End Close ybl_kyc_mfi_hvf1_Label1_BeforeShow

//ybl_kyc_mfi_hvf1_ds_BeforeBuildSelect @188-F8E58453
function ybl_kyc_mfi_hvf1_ds_BeforeBuildSelect(& $sender)
{
    $ybl_kyc_mfi_hvf1_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ybl_kyc_mfi_hvf1; //Compatibility
//End ybl_kyc_mfi_hvf1_ds_BeforeBuildSelect
if (count($_GET)<=0)
{
  $ybl_kyc_mfi_hvf1->Visible=false;
  $ybl_kyc_mfi_hvf1->DataSource->SQL="";
}
else
{
$ybl_kyc_mfi_hvf1->Visible=true;
}
//Custom Code @281-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close ybl_kyc_mfi_hvf1_ds_BeforeBuildSelect @188-65B8B7AB
    return $ybl_kyc_mfi_hvf1_ds_BeforeBuildSelect;
}
//End Close ybl_kyc_mfi_hvf1_ds_BeforeBuildSelect

//Page_BeforeShow @1-9698F167
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $manageHV_PAGE12; //Compatibility
//End Page_BeforeShow

//Custom Code @13-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
