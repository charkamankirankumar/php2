<?php
//BindEvents Method @1-24BAA02E
function BindEvents()
{
    global $ChangePassword;
    global $CCSEvents;
    $ChangePassword->Button_Update->CCSEvents["OnClick"] = "ChangePassword_Button_Update_OnClick";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//ChangePassword_Button_Update_OnClick @8-4ECA44FC
function ChangePassword_Button_Update_OnClick(& $sender)
{
    $ChangePassword_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ChangePassword; //Compatibility
//End ChangePassword_Button_Update_OnClick

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close ChangePassword_Button_Update_OnClick @8-EB7AD9D4
    return $ChangePassword_Button_Update_OnClick;
}
//End Close ChangePassword_Button_Update_OnClick

//Page_BeforeShow @1-0A45C55D
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ChangePassword; //Compatibility
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
