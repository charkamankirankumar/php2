<?php
// //Events @1-F81417CB

//incHeaderRegion_lblUserName_BeforeShow @2-25E986FB
function incHeaderRegion_lblUserName_BeforeShow(& $sender)
{
    $incHeaderRegion_lblUserName_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $incHeaderRegion; //Compatibility
//End incHeaderRegion_lblUserName_BeforeShow
$db = new clsDBmysql_cams_v2();
 $SQL = "SELECT mfi_emp_name FROM mfi_emps WHERE mfi_emp_user_name='".CCGetUserLogin()."'";
 $db->query($SQL);
    $Result = $db->next_record();
    if ($Result) {
     $lblUserName->SetValue('CAADMIN');
	 $incHeaderRegion->pnlLogout->Visible=true;
    }
 $db->close();
//Custom Code @16-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close incHeaderRegion_lblUserName_BeforeShow @2-0E4BB57F
    return $incHeaderRegion_lblUserName_BeforeShow;
}
//End Close incHeaderRegion_lblUserName_BeforeShow

//incHeaderRegion_pnlLogout_BeforeShow @11-50CF2C4C
function incHeaderRegion_pnlLogout_BeforeShow(& $sender)
{
    $incHeaderRegion_pnlLogout_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $incHeaderRegion; //Compatibility
//End incHeaderRegion_pnlLogout_BeforeShow

//Custom Code @14-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close incHeaderRegion_pnlLogout_BeforeShow @11-4150BE24
    return $incHeaderRegion_pnlLogout_BeforeShow;
}
//End Close incHeaderRegion_pnlLogout_BeforeShow
?>
