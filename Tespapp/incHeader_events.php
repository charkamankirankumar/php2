<?php
// //Events @1-F81417CB

//incHeader_pnlLogout_BeforeShow @11-BB84E87E
function incHeader_pnlLogout_BeforeShow(& $sender)
{
    $incHeader_pnlLogout_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $incHeader; //Compatibility
//End incHeader_pnlLogout_BeforeShow

//Custom Code @14-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$db = new clsDBmysql_cams_v2();
 $SQL = "SELECT mfi_emp_name FROM mfi_emps WHERE mfi_emp_user_name='".CCGetUserLogin()."'";
 $db->query($SQL);
    $Result = $db->next_record();
    if ($Result) {
     $incHeader->lblUserName->SetValue($db->f("mfi_emp_name"));
	 $incHeader->pnlLogout->Visible=true;
    }
 $db->close();
//Close incHeader_pnlLogout_BeforeShow @11-695B92C1
    return $incHeader_pnlLogout_BeforeShow;
}
//End Close incHeader_pnlLogout_BeforeShow



?>
