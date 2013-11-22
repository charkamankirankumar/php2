<?php
//Page_BeforeInitialize @1-C3D8BD42
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sat_doc_mis_page; //Compatibility
//End Page_BeforeInitialize

//YahooAutocomplete1 Initialization @45-C014FF2F
    if ('mfi_docs_mfi_doc_uploads_gp_codeYahooAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete1 Initialization

//YahooAutocomplete1 DataSource @45-2E4C6FE4
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
//End YahooAutocomplete1 DataSource

//YahooAutocomplete1 DataFields @45-2BE06288
        $Service->AddDataSourceField('gp_code');
//End YahooAutocomplete1 DataFields

//YahooAutocomplete1 Execution @45-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete1 Execution

//YahooAutocomplete1 Tail @45-27890EF8
        exit;
    }
//End YahooAutocomplete1 Tail

//YahooAutocomplete2 Initialization @46-6921B9EF
    if ('mfi_docs_mfi_doc_uploads_mfi_doc_regionYahooAutocomplete2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete2 Initialization

//YahooAutocomplete2 DataSource @46-5735B2CA
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "mfi_doc_region", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete2 DataSource

//YahooAutocomplete2 DataFields @46-964F52E1
        $Service->AddDataSourceField('mfi_doc_region');
//End YahooAutocomplete2 DataFields

//YahooAutocomplete2 Execution @46-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete2 Execution

//YahooAutocomplete2 Tail @46-27890EF8
        exit;
    }
//End YahooAutocomplete2 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
