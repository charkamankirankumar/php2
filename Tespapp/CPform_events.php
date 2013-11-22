<?php
//BindEvents Method @1-5D7ADE10
function BindEvents()
{
    global $mfi_cp;
    global $CCSEvents;
    $mfi_cp->Button_Insert->CCSEvents["OnClick"] = "mfi_cp_Button_Insert_OnClick";
    $mfi_cp->user_login->CCSEvents["BeforeShow"] = "mfi_cp_user_login_BeforeShow";
    $mfi_cp->mfi_cp_weekly_meeting_time_to->CCSEvents["BeforeShow"] = "mfi_cp_mfi_cp_weekly_meeting_time_to_BeforeShow";
    $mfi_cp->CCSEvents["BeforeShow"] = "mfi_cp_BeforeShow";
    $mfi_cp->ds->CCSEvents["AfterExecuteUpdate"] = "mfi_cp_ds_AfterExecuteUpdate";
}
//End BindEvents Method

//mfi_cp_Button_Insert_OnClick @3-C1E53FA2
function mfi_cp_Button_Insert_OnClick(& $sender)
{
    $mfi_cp_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_cp; //Compatibility
//End mfi_cp_Button_Insert_OnClick

//Custom Code @137-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_cp_Button_Insert_OnClick @3-E788D017
    return $mfi_cp_Button_Insert_OnClick;
}
//End Close mfi_cp_Button_Insert_OnClick

//mfi_cp_user_login_BeforeShow @153-6C34FC1F
function mfi_cp_user_login_BeforeShow(& $sender)
{
    $mfi_cp_user_login_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_cp; //Compatibility
//End mfi_cp_user_login_BeforeShow

//Custom Code @154-2A29BDB7
// -------------------------
   	date_default_timezone_set ( 'Asia/Kolkata');
	if($mfi_cp->EditMode)
	{
		$mfi_cp->updated_by->SetValue(CCGetUserLogin());
		$mfi_cp->updated_at->SetValue(date('Y-m-d H:i:s'));
	}	
	else
	{
		$mfi_cp->added_at->SetValue(date('Y-m-d H:i:s'));
		$mfi_cp->user_login->SetValue(CCGetUserLogin());
	}
// -------------------------
//End Custom Code

//Close mfi_cp_user_login_BeforeShow @153-84E10B5A
    return $mfi_cp_user_login_BeforeShow;
}
//End Close mfi_cp_user_login_BeforeShow

//mfi_cp_mfi_cp_weekly_meeting_time_to_BeforeShow @26-6DD141FC
function mfi_cp_mfi_cp_weekly_meeting_time_to_BeforeShow(& $sender)
{
    $mfi_cp_mfi_cp_weekly_meeting_time_to_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_cp; //Compatibility
//End mfi_cp_mfi_cp_weekly_meeting_time_to_BeforeShow

//Close mfi_cp_mfi_cp_weekly_meeting_time_to_BeforeShow @26-B2F1AF0A
    return $mfi_cp_mfi_cp_weekly_meeting_time_to_BeforeShow;
}
//End Close mfi_cp_mfi_cp_weekly_meeting_time_to_BeforeShow

//$mfi_cp->Hidden1->SetValue(CCGetUserLogin());

//mfi_cp_BeforeShow @2-4B00FC4F
function mfi_cp_BeforeShow(& $sender)
{
    $mfi_cp_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_cp; //Compatibility
//End mfi_cp_BeforeShow

//Custom Code @133-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if($_GET["display"]=="view")
{
$mfi_cp->Button_Update->Visible=false;
$mfi_cp->Button_Cancel->Visible=false;
$mfi_cp->formmode->SetValue("view");
}
//Close mfi_cp_BeforeShow @2-9CDA3BB3
    return $mfi_cp_BeforeShow;
}
//End Close mfi_cp_BeforeShow

//DEL  // -------------------------
//DEL      
//DEL      
//DEL  // -------------------------

/*if($mfi_cp->Errors->Count()<1)
{
setcookie("submitpage",$mfi_cp->Errors->Count(),time()+3);
}*/

//mfi_cp_ds_AfterExecuteUpdate @2-5DA3B607
function mfi_cp_ds_AfterExecuteUpdate(& $sender)
{
    $mfi_cp_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_cp; //Compatibility
//End mfi_cp_ds_AfterExecuteUpdate

//Custom Code @200-2A29BDB7
// -------------------------
    if($mfi_cp->EditMode)
	{
	    $cpid=$mfi_cp->cp_id->GetValue();
	    $db = new clsDBmysql_cams_v2();
	    $metfreq=$mfi_cp->mfi_cp_meeting_frequency->GetValue();
	    $centername=$mfi_cp->mfi_cp_centre_name->GetValue();
	    $centerManager=$mfi_cp->mfi_cp_co_name->GetValue();
	    $coempcod=$mfi_cp->mfi_cp_co_emp_code->GetValue();
	    $sql="update mfi_hvf2 set mfi_hvf2_loan_group_meeting_frequency='".$metfreq."',mfi_cp_centre_name='".$centername."',mfi_hvf2_co_name='".$centerManager."',mfi_hvf2_co_emp_code='".$coempcod."' where cp_id='".$cpid."'";
	    $result=$db->query($sql);
	}
// -------------------------
//End Custom Code

//Close mfi_cp_ds_AfterExecuteUpdate @2-95BD3963
    return $mfi_cp_ds_AfterExecuteUpdate;
}
//End Close mfi_cp_ds_AfterExecuteUpdate

//Page_BeforeInitialize @1-667F12F6
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $CPform; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill1 Initialization @166-BA813896
    if ('PanelCPmfi_cpmfi_cp_relogin_noPTAutoFill1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill1 Initialization

//PTAutoFill1 DataSource @166-89C0CD10
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_cp {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill1 DataSource

//PTAutoFill1 DataFields @166-793911BF
        $Service->AddDataSourceField('mfi_cp_district',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_centre_name',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_location_type',ccsText,"");
        $Service->AddDataSourceField('cp_route',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_1st_meeting_week_and_day_of_the_month',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_census_village',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_latitude1',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_latitude2',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_cansus_village_code',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_village_or_locality',ccsText,"");
        $Service->AddDataSourceField('mfi_cp_pincode',ccsText,"");
//End PTAutoFill1 DataFields

//PTAutoFill1 Execution @166-028A6C4C
        echo $Service->Execute();
//End PTAutoFill1 Execution

//PTAutoFill1 Loading @166-27890EF8
        exit;
    }
//End PTAutoFill1 Loading

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
