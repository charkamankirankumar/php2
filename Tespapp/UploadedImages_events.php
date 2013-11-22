<?php
//BindEvents Method @1-69CCDD5F
function BindEvents()
{
    global $PagePanel;
    global $CCSEvents;
    $PagePanel->CCSEvents["BeforeShow"] = "PagePanel_BeforeShow";
}
//End BindEvents Method

//PagePanel_BeforeShow @6-A8A39FD9
function PagePanel_BeforeShow(& $sender)
{
    $PagePanel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $PagePanel; //Compatibility
//End PagePanel_BeforeShow

//Hide-Show Component @125-499CD87D
    $Parameter1 = CCGetUserLogin();
    $Parameter2 = NULL;
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close PagePanel_BeforeShow @6-D3554952
    return $PagePanel_BeforeShow;
}
//End Close PagePanel_BeforeShow

//Page_BeforeInitialize @1-BC9404C7
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $UploadedImages; //Compatibility
//End Page_BeforeInitialize

//YahooAutocomplete1 Initialization @262-F8D347F5
    if ('PagePanelmfi_doc_uploadSearchs_file_uploadedYahooAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete1 Initialization

//YahooAutocomplete1 DataSource @262-98310B78
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "file_uploaded", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete1 DataSource

//YahooAutocomplete1 DataFields @262-99642864
        $Service->AddDataSourceField('file_uploaded');
//End YahooAutocomplete1 DataFields

//YahooAutocomplete1 Execution @262-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete1 Execution

//YahooAutocomplete1 Tail @262-27890EF8
        exit;
    }
//End YahooAutocomplete1 Tail

//YahooAutocomplete2 Initialization @263-7D48B781
    if ('PagePanelmfi_doc_uploadSearchs_gp_codeYahooAutocomplete2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete2 Initialization

//YahooAutocomplete2 DataSource @263-2E4C6FE4
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "gp_code", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete2 DataSource

//YahooAutocomplete2 DataFields @263-2BE06288
        $Service->AddDataSourceField('gp_code');
//End YahooAutocomplete2 DataFields

//YahooAutocomplete2 Execution @263-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete2 Execution

//YahooAutocomplete2 Tail @263-27890EF8
        exit;
    }
//End YahooAutocomplete2 Tail

//YahooAutocomplete3 Initialization @264-7812C27B
    if ('PagePanelmfi_doc_uploadSearchs_batch_codeYahooAutocomplete3' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete3 Initialization

//YahooAutocomplete3 DataSource @264-204D9FE3
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "batch_code", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete3 DataSource

//YahooAutocomplete3 DataFields @264-B76A3F55
        $Service->AddDataSourceField('batch_code');
//End YahooAutocomplete3 DataFields

//YahooAutocomplete3 Execution @264-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete3 Execution

//YahooAutocomplete3 Tail @264-27890EF8
        exit;
    }
//End YahooAutocomplete3 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
