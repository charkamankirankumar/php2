<?php
//Page_BeforeInitialize @1-5EF4F5F7
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $flash_charts; //Compatibility
//End Page_BeforeInitialize

//FlashChart1 Initialization @2-6F770E95
    if ('flash_chartsFlashChart1' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/" . "flash_chartsFlashChart1.xml"));
        $Service->SetFormatter($formatter);
//End FlashChart1 Initialization

//FlashChart1 DataSource @2-6A59A726
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT mfi_doc_entered_by, mfi_doc_entered_at, mfi_doc_id \n" .
"FROM mfi_docs {SQL_Where}\n" .
"GROUP BY mfi_doc_entered_by {SQL_OrderBy}";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End FlashChart1 DataSource

//FlashChart1 Execution @2-E0D9CEC3
        $Service->AddDataSetValue("Title", $CCSLocales->GetText("Chart Title"));
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End FlashChart1 Execution

//FlashChart1 Tail @2-27890EF8
        exit;
    }
//End FlashChart1 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
