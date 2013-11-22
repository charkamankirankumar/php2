<?php

//BindEvents Method @1-22CFF02A
function BindEvents()
{
    global $camsdata123_cgt_grtSearch;
    global $mfi_hvf1_mfi_hvf2;
    global $mfi_group_details_mfi_hvf;
    global $camsdata123_grid;
    global $CCSEvents;
    $camsdata123_cgt_grtSearch->s_GP_NO->CCSEvents["BeforeShow"] = "camsdata123_cgt_grtSearch_s_GP_NO_BeforeShow";
    $camsdata123_cgt_grtSearch->ListBox1->ds->CCSEvents["BeforeBuildSelect"] = "camsdata123_cgt_grtSearch_ListBox1_ds_BeforeBuildSelect";
    $camsdata123_cgt_grtSearch->ListBox2->CCSEvents["BeforeShow"] = "camsdata123_cgt_grtSearch_ListBox2_BeforeShow";
    $mfi_hvf1_mfi_hvf2->ds->CCSEvents["BeforeBuildSelect"] = "mfi_hvf1_mfi_hvf2_ds_BeforeBuildSelect";
    $mfi_group_details_mfi_hvf->ds->CCSEvents["BeforeBuildSelect"] = "mfi_group_details_mfi_hvf_ds_BeforeBuildSelect";
    $camsdata123_grid->ds->CCSEvents["BeforeBuildSelect"] = "camsdata123_grid_ds_BeforeBuildSelect";
}
//End BindEvents Method
//camsdata123_cgt_grtSearch_s_GP_NO_BeforeShow @35-1E9E5B90
function camsdata123_cgt_grtSearch_s_GP_NO_BeforeShow(& $sender)
{
    $camsdata123_cgt_grtSearch_s_GP_NO_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $camsdata123_cgt_grtSearch; //Compatibility
//End camsdata123_cgt_grtSearch_s_GP_NO_BeforeShow

//Close camsdata123_cgt_grtSearch_s_GP_NO_BeforeShow @35-33862FE0
    return $camsdata123_cgt_grtSearch_s_GP_NO_BeforeShow;
}
//End Close camsdata123_cgt_grtSearch_s_GP_NO_BeforeShow

//camsdata123_cgt_grtSearch_ListBox1_ds_BeforeBuildSelect @73-9870021C
function camsdata123_cgt_grtSearch_ListBox1_ds_BeforeBuildSelect(& $sender)
{
    $camsdata123_cgt_grtSearch_ListBox1_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $camsdata123_cgt_grtSearch; //Compatibility
//End camsdata123_cgt_grtSearch_ListBox1_ds_BeforeBuildSelect

//Custom Code @84-2A29BDB7
// -------------------------
   $region=substr(CCGetUserLogin(),3);
   $camsdata123_cgt_grtSearch->ListBox1->DataSource->SQL="select BRANCH,ROUTE_CODE from camsdata123_grid where ROUTE_CODE like '%".$region."%' group by BRANCH ORDER BY BRANCH";
// -------------------------
//End Custom Code

//Close camsdata123_cgt_grtSearch_ListBox1_ds_BeforeBuildSelect @73-0787410A
    return $camsdata123_cgt_grtSearch_ListBox1_ds_BeforeBuildSelect;
}
//End Close camsdata123_cgt_grtSearch_ListBox1_ds_BeforeBuildSelect

//camsdata123_cgt_grtSearch_ListBox2_BeforeShow @80-AD87FE55
function camsdata123_cgt_grtSearch_ListBox2_BeforeShow(& $sender)
{
    $camsdata123_cgt_grtSearch_ListBox2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $camsdata123_cgt_grtSearch; //Compatibility
//End camsdata123_cgt_grtSearch_ListBox2_BeforeShow

//Close camsdata123_cgt_grtSearch_ListBox2_BeforeShow @80-64728A07
    return $camsdata123_cgt_grtSearch_ListBox2_BeforeShow;
}
//End Close camsdata123_cgt_grtSearch_ListBox2_BeforeShow

//mfi_hvf1_mfi_hvf2_ds_BeforeBuildSelect @168-1F5FFA0E
function mfi_hvf1_mfi_hvf2_ds_BeforeBuildSelect(& $sender)
{
    $mfi_hvf1_mfi_hvf2_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf1_mfi_hvf2; //Compatibility
//End mfi_hvf1_mfi_hvf2_ds_BeforeBuildSelect

//Custom Code @292-2A29BDB7
// -------------------------
     if(!isset($_GET["s_GP_NO"]))
      {
      $mfi_hvf1_mfi_hvf2->DataSource->SQL="";
       $mfi_hvf1_mfi_hvf2->Visible=false;
     }
// -------------------------
//End Custom Code

//Close mfi_hvf1_mfi_hvf2_ds_BeforeBuildSelect @168-882C234D
    return $mfi_hvf1_mfi_hvf2_ds_BeforeBuildSelect;
}
//End Close mfi_hvf1_mfi_hvf2_ds_BeforeBuildSelect

//mfi_group_details_mfi_hvf_ds_BeforeBuildSelect @198-D6167BA0
function mfi_group_details_mfi_hvf_ds_BeforeBuildSelect(& $sender)
{
    $mfi_group_details_mfi_hvf_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_group_details_mfi_hvf; //Compatibility
//End mfi_group_details_mfi_hvf_ds_BeforeBuildSelect

//Custom Code @291-2A29BDB7
// -------------------------
     if(!isset($_GET["s_GP_NO"]))
      {
      $mfi_group_details_mfi_hvf->DataSource->SQL="";
       $mfi_group_details_mfi_hvf->Visible=false;
     }
// -------------------------
//End Custom Code

//Close mfi_group_details_mfi_hvf_ds_BeforeBuildSelect @198-224DF08B
    return $mfi_group_details_mfi_hvf_ds_BeforeBuildSelect;
}
//End Close mfi_group_details_mfi_hvf_ds_BeforeBuildSelect

//camsdata123_grid_ds_BeforeBuildSelect @254-848FF724
function camsdata123_grid_ds_BeforeBuildSelect(& $sender)
{
    $camsdata123_grid_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $camsdata123_grid; //Compatibility
//End camsdata123_grid_ds_BeforeBuildSelect

//Custom Code @293-2A29BDB7
// -------------------------
     if(!isset($_GET["s_GP_NO"]))
      {
      $camsdata123_grid->DataSource->SQL="";
       $camsdata123_grid->Visible=false;
     }
// -------------------------
//End Custom Code

//Close camsdata123_grid_ds_BeforeBuildSelect @254-4C6D9AFB
    return $camsdata123_grid_ds_BeforeBuildSelect;
}
//End Close camsdata123_grid_ds_BeforeBuildSelect

//Page_BeforeInitialize @1-1975C16D
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cgt_grt; //Compatibility
//End Page_BeforeInitialize

//YahooAutocomplete1 Initialization @36-2EE08C01
    if ('camsdata123_cgt_grtSearchs_GP_NOYahooAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete1 Initialization

//YahooAutocomplete1 DataSource @36-76313C04
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM camsdata123_cgt_grt {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "GP_NO", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete1 DataSource

//YahooAutocomplete1 DataFields @36-1617BA2E
        $Service->AddDataSourceField('GP_NO');
//End YahooAutocomplete1 DataFields

//YahooAutocomplete1 Execution @36-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete1 Execution

//YahooAutocomplete1 Tail @36-27890EF8
        exit;
    }
//End YahooAutocomplete1 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
