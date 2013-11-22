<?php

//BindEvents Method @1-2D5FA17A
function BindEvents()
{
    global $mfi_hvf2_mfi_hvf1;
    global $CCSEvents;
    $mfi_hvf2_mfi_hvf1->ds->CCSEvents["BeforeBuildSelect"] = "mfi_hvf2_mfi_hvf1_ds_BeforeBuildSelect";
}
//End BindEvents Method

//mfi_hvf2_mfi_hvf1_ds_BeforeBuildSelect @2-682FEEE6
function mfi_hvf2_mfi_hvf1_ds_BeforeBuildSelect(& $sender)
{
    $mfi_hvf2_mfi_hvf1_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf2_mfi_hvf1; //Compatibility
//End mfi_hvf2_mfi_hvf1_ds_BeforeBuildSelect

//Custom Code @42-2A29BDB7
// -------------------------
    if(count($_GET)==0)
    {	
    	$mfi_hvf2_mfi_hvf1->DataSource->SQL='';
    	$mfi_hvf2_mfi_hvf1->Visible=false;
    }
// -------------------------
//End Custom Code

//Close mfi_hvf2_mfi_hvf1_ds_BeforeBuildSelect @2-8B253B70
    return $mfi_hvf2_mfi_hvf1_ds_BeforeBuildSelect;
}
//End Close mfi_hvf2_mfi_hvf1_ds_BeforeBuildSelect

//Page_BeforeInitialize @1-1C7EFC1D
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ManageLAForm; //Compatibility
//End Page_BeforeInitialize

//YahooAutocomplete1 Initialization @37-8627C1A2
    if ('mfi_hvf2_mfi_hvf2s_mfi_hvf1_la_idYahooAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete1 Initialization

//YahooAutocomplete1 DataSource @37-BC3F8135
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_hvf1 {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "mfi_hvf1_la_id", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete1 DataSource

//YahooAutocomplete1 DataFields @37-1EC21E67
        $Service->AddDataSourceField('mfi_hvf1_la_id');
//End YahooAutocomplete1 DataFields

//YahooAutocomplete1 Execution @37-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete1 Execution

//YahooAutocomplete1 Tail @37-27890EF8
        exit;
    }
//End YahooAutocomplete1 Tail

//YahooAutocomplete2 Initialization @38-F5EC90F0
    if ('mfi_hvf2_mfi_hvf2s_mfi_hvf1_gp_idYahooAutocomplete2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete2 Initialization

//YahooAutocomplete2 DataSource @38-5ED145AC
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_hvf1 {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "mfi_hvf1_gp_id", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete2 DataSource

//YahooAutocomplete2 DataFields @38-8201954B
        $Service->AddDataSourceField('mfi_hvf1_gp_id');
//End YahooAutocomplete2 DataFields

//YahooAutocomplete2 Execution @38-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete2 Execution

//YahooAutocomplete2 Tail @38-27890EF8
        exit;
    }
//End YahooAutocomplete2 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
