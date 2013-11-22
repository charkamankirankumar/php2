<?php
//BindEvents Method @1-788B314F
function BindEvents()
{
    global $Login;
    global $CCSEvents;
    $Login->Button_DoLogin->CCSEvents["OnClick"] = "Login_Button_DoLogin_OnClick";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Login_Button_DoLogin_OnClick @20-1454CF55
function Login_Button_DoLogin_OnClick(& $sender)
{
    $Login_Button_DoLogin_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Login; //Compatibility
//End Login_Button_DoLogin_OnClick

//Login @21-6F4FE3DE
    global $CCSLocales;
    global $Redirect;
    if ($Container->autoLogin->Value != $Container->autoLogin->CheckedValue) {
        CCSetCookie("cams_ffsl_v2Login", "");
    }
    if ( !CCLoginUser( $Container->login->Value, $Container->password->Value)) {
        $Container->Errors->addError($CCSLocales->GetText("CCS_LoginError"));
        $Container->password->SetValue("");
        $Login_Button_DoLogin_OnClick = 0;
        CCSetCookie("cams_ffsl_v2Login", "");
    } else {
        global $Redirect;
        if ($Container->autoLogin->Value == $Container->autoLogin->CheckedValue) {
            $ALLogin    = $Container->login->Value;
            $ALPassword = $Container->password->Value;
            CCSetALCookie($ALLogin, $ALPassword);
        }
        $Redirect = CCGetParam("ret_link", $Redirect);
        $Login_Button_DoLogin_OnClick = 1;
    }
//End Login
$utyp=strtoupper(substr(CCGetUserLogin(),0,3));
if($utyp!='DEO')
$retpage="cams_ffsl_v2/userhome.php";
else
$retpage="cams_ffsl_v2/userhomeRegion.php";
$Redirect=strstr($Redirect,'/')."/".$retpage;
/*
$db = new clsDBmysql_cams_v2();
 $SQL = "SELECT mfi_emp_company FROM mfi_emps WHERE mfi_emp_user_name='".CCGetUserLogin()."'";
 $db->query($SQL);
    $Result = $db->next_record();
    if ($Result) {
     $sat=$Result;
    }
 $db->close();
$retpage="cams_ffsl_v2";
$retpage="cams_ffsl_v2/userhome.php";

  global $Redirect;
  $Redirect=strstr($Redirect,'/')."/".$retpage;
}*/
//Close Login_Button_DoLogin_OnClick @20-0EB5DCFE
    return $Login_Button_DoLogin_OnClick;
}
//End Close Login_Button_DoLogin_OnClick
//Page_BeforeShow @1-4CD7DBED
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $index; //Compatibility
//End Page_BeforeShow

//Logout @18-2CBABAB4
    if(strlen(CCGetParam("Logout", ""))) 
    {
        CCLogoutUser();
        CCSetCookie("cams_ffsl_v2Login", "");
        global $Redirect;
        $Redirect = "index.php";
    }
//End Logout
if(strlen(CCGetParam("Logout", "")))
{
CCLogoutUser();
CCSetCookie("camsLogin", "");
global $Redirect;
$Redirect = "index.php";
}
//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>
