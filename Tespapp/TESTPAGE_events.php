<?php
//Page_BeforeInitialize @1-DE284C84
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $TESTPAGE; //Compatibility
//End Page_BeforeInitialize

//YahooAutocomplete1 Initialization @39-729D82A2
    if ('mfi_docsSearchs_batch_codeYahooAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete1 Initialization

//YahooAutocomplete1 DataSource @39-D5573674
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "batch_code", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete1 DataSource

//YahooAutocomplete1 DataFields @39-B76A3F55
        $Service->AddDataSourceField('batch_code');
//End YahooAutocomplete1 DataFields

//YahooAutocomplete1 Execution @39-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete1 Execution

//YahooAutocomplete1 Tail @39-27890EF8
        exit;
    }
//End YahooAutocomplete1 Tail

//YahooAutocomplete2 Initialization @40-ECDE9AE8
    if ('mfi_docsSearchs_mfi_doc_filenameYahooAutocomplete2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete2 Initialization

//YahooAutocomplete2 DataSource @40-9FFDEE54
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "mfi_doc_filename", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete2 DataSource

//YahooAutocomplete2 DataFields @40-26E19847
        $Service->AddDataSourceField('mfi_doc_filename');
//End YahooAutocomplete2 DataFields

//YahooAutocomplete2 Execution @40-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete2 Execution

//YahooAutocomplete2 Tail @40-27890EF8
        exit;
    }
//End YahooAutocomplete2 Tail

//YahooAutocomplete3 Initialization @41-0F509014
    if ('mfi_docsSearchs_mfi_doc_typeYahooAutocomplete3' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete3 Initialization

//YahooAutocomplete3 DataSource @41-B730539A
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "mfi_doc_type", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete3 DataSource

//YahooAutocomplete3 DataFields @41-AC5030EC
        $Service->AddDataSourceField('mfi_doc_type');
//End YahooAutocomplete3 DataFields

//YahooAutocomplete3 Execution @41-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete3 Execution

//YahooAutocomplete3 Tail @41-27890EF8
        exit;
    }
//End YahooAutocomplete3 Tail

//YahooAutocomplete4 Initialization @42-CD2A3582
    if ('mfi_docsSearchs_mfi_doc_regionYahooAutocomplete4' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete4 Initialization

//YahooAutocomplete4 DataSource @42-5735B2CA
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
//End YahooAutocomplete4 DataSource

//YahooAutocomplete4 DataFields @42-964F52E1
        $Service->AddDataSourceField('mfi_doc_region');
//End YahooAutocomplete4 DataFields

//YahooAutocomplete4 Execution @42-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete4 Execution

//YahooAutocomplete4 Tail @42-27890EF8
        exit;
    }
//End YahooAutocomplete4 Tail

//YahooAutocomplete5 Initialization @43-38D41D2C
    if ('mfi_docsSearchs_mfi_doc_statusYahooAutocomplete5' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End YahooAutocomplete5 Initialization

//YahooAutocomplete5 DataSource @43-A113ED91
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["urlquery"] = CCGetFromGet("query", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlquery", ccsText, "", "", $Service->DataSource->Parameters["urlquery"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "mfi_doc_status", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End YahooAutocomplete5 DataSource

//YahooAutocomplete5 DataFields @43-659E5309
        $Service->AddDataSourceField('mfi_doc_status');
//End YahooAutocomplete5 DataFields

//YahooAutocomplete5 Execution @43-73F24F96
        echo '{"Result":' . $Service->Execute() . '}';
//End YahooAutocomplete5 Execution

//YahooAutocomplete5 Tail @43-27890EF8
        exit;
    }
//End YahooAutocomplete5 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
