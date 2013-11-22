<?php
//BindEvents Method @1-53060221
function BindEvents()
{
    global $mfi_docsSearch;
    global $Report_Print;
    global $mfi_docs1;
    global $Label1;
    global $Panel1;
    global $CCSEvents;
    $mfi_docsSearch->CCSEvents["BeforeShow"] = "mfi_docsSearch_BeforeShow";
    $Report_Print->CCSEvents["BeforeShow"] = "Report_Print_BeforeShow";
    $mfi_docs1->ds->CCSEvents["BeforeBuildSelect"] = "mfi_docs1_ds_BeforeBuildSelect";
    $Label1->CCSEvents["BeforeShow"] = "Label1_BeforeShow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//mfi_docsSearch_BeforeShow @25-E1A95982
function mfi_docsSearch_BeforeShow(& $sender)
{
    $mfi_docsSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docsSearch; //Compatibility
//End mfi_docsSearch_BeforeShow

//Hide-Show Component @31-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close mfi_docsSearch_BeforeShow @25-72E21196
    return $mfi_docsSearch_BeforeShow;
}
//End Close mfi_docsSearch_BeforeShow

//Report_Print_BeforeShow @28-6CD7E3F9
function Report_Print_BeforeShow(& $sender)
{
    $Report_Print_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report_Print; //Compatibility
//End Report_Print_BeforeShow

//Hide-Show Component @30-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report_Print_BeforeShow @28-0DD1CC60
    return $Report_Print_BeforeShow;
}
//End Close Report_Print_BeforeShow

//Close Report_Print_BeforeShow @28-0DD1CC60
    return $Report_Print_BeforeShow;
}
//mfi_docs1_ds_BeforeBuildSelect @17-854E9745
function mfi_docs1_ds_BeforeBuildSelect(& $sender)
{
    $mfi_docs1_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs1; //Compatibility
//End mfi_docs1_ds_BeforeBuildSelect

//Custom Code @53-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if (count($_GET)<1)
{
$mfi_docs1->DataSource->SQL="";
$mfi_docs1->Visible=false;
}
//Close mfi_docs1_ds_BeforeBuildSelect @17-EF4129B5
    return $mfi_docs1_ds_BeforeBuildSelect;
}
//End Close mfi_docs1_ds_BeforeBuildSelect

//DEL  // -------------------------
//DEL    
//DEL  // -------------------------

//DEL  // -------------------------
//DEL     if (count($_GET)<1)
//DEL  {
//DEL  $mfi_docs_camsdata123_grid->DataSource->SQL="";
//DEL  $mfi_docs_camsdata123_grid->Visible=false;
//DEL  }
//DEL  // -------------------------

//Label1_BeforeShow @99-62EBFD0A
function Label1_BeforeShow(& $sender)
{
    $Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Label1; //Compatibility
//End Label1_BeforeShow

//Custom Code @100-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Label1_BeforeShow @99-B48DF954
    return $Label1_BeforeShow;
}
//End Close Label1_BeforeShow

//Panel1_BeforeShow @96-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @97-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @96-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-7E38DE40
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Doc_Tagging_Report_Summary2; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @97-37A82194
    if (CCGetFromGet("FormFilter") == "Panel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $CCSLocales, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $CCSLocales->GetFormatInfo("PHPEncoding"));
        $CCSIsParamsEncoded = true;
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-8E202A34
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Doc_Tagging_Report_Summary2; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-9729AD87
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Doc_Tagging_Report_Summary2; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @97-9F5F0EA1
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-30015990
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Doc_Tagging_Report_Summary2; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @97-0DFF2749
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $_SERVER["REQUEST_URI"] . "|" . $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-08D3C6FF
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Doc_Tagging_Report_Summary2; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @97-483BFCB6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload
?>
