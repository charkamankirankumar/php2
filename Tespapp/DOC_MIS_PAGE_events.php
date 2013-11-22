<?php
//Page_BeforeInitialize @1-F9DC0D8A
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DOC_MIS_PAGE; //Compatibility
//End Page_BeforeInitialize

//YahooAutocomplete1 Initialization @49-B5BBEF2A
    if ('mfi_docsSearchs_mfi_doc_regionYahooAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete1 Initialization

//YahooAutocomplete1 DataSource @49-5735B2CA
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
//End YahooAutocomplete1 DataSource

//YahooAutocomplete1 DataFields @49-964F52E1
        $Service->AddDataSourceField('mfi_doc_region');
//End YahooAutocomplete1 DataFields

//YahooAutocomplete1 Execution @49-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete1 Execution

//YahooAutocomplete1 Tail @49-27890EF8
        exit;
    }
//End YahooAutocomplete1 Tail

//YahooAutocomplete2 Initialization @50-F87E097A
    if ('mfi_docsSearchs_mfi_doc_territory_codeYahooAutocomplete2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete2 Initialization

//YahooAutocomplete2 DataSource @50-BBFD6530
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "mfi_doc_territory_code", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete2 DataSource

//YahooAutocomplete2 DataFields @50-3B2F7713
        $Service->AddDataSourceField('mfi_doc_territory_code');
//End YahooAutocomplete2 DataFields

//YahooAutocomplete2 Execution @50-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete2 Execution

//YahooAutocomplete2 Tail @50-27890EF8
        exit;
    }
//End YahooAutocomplete2 Tail

//YahooAutocomplete3 Initialization @51-AD76A8FB
    if ('mfi_docsSearchs_doc_rejection_reasonYahooAutocomplete3' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete3 Initialization

//YahooAutocomplete3 DataSource @51-9557CF52
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "doc_rejection_reason", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete3 DataSource

//YahooAutocomplete3 DataFields @51-09014E9B
        $Service->AddDataSourceField('doc_rejection_reason');
//End YahooAutocomplete3 DataFields

//YahooAutocomplete3 Execution @51-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete3 Execution

//YahooAutocomplete3 Tail @51-27890EF8
        exit;
    }
//End YahooAutocomplete3 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
