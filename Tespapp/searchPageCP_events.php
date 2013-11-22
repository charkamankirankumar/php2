<?php
//BindEvents Method @1-4B082801
function BindEvents()
{
    global $mfi_gpSearch;
    global $Panel1;
    global $CCSEvents;
    $mfi_gpSearch->s_mfi_cp_no->ds->CCSEvents["BeforeBuildSelect"] = "mfi_gpSearch_s_mfi_cp_no_ds_BeforeBuildSelect";
    $mfi_gpSearch->s_mfi_gp_centre_name->ds->CCSEvents["BeforeBuildSelect"] = "mfi_gpSearch_s_mfi_gp_centre_name_ds_BeforeBuildSelect";
    $mfi_gpSearch->CCSEvents["BeforeShow"] = "mfi_gpSearch_BeforeShow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//mfi_gpSearch_s_mfi_cp_no_ds_BeforeBuildSelect @15-EDC8850F
function mfi_gpSearch_s_mfi_cp_no_ds_BeforeBuildSelect(& $sender)
{
    $mfi_gpSearch_s_mfi_cp_no_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_gpSearch; //Compatibility
//End mfi_gpSearch_s_mfi_cp_no_ds_BeforeBuildSelect

//Custom Code @91-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if(!isset($_COOKIE['cpno']))
$mfi_gpSearch->s_mfi_cp_no->DataSource->SQL="";
//Close mfi_gpSearch_s_mfi_cp_no_ds_BeforeBuildSelect @15-8DCD8EB7
    return $mfi_gpSearch_s_mfi_cp_no_ds_BeforeBuildSelect;
}
//End Close mfi_gpSearch_s_mfi_cp_no_ds_BeforeBuildSelect

//mfi_gpSearch_s_mfi_gp_centre_name_ds_BeforeBuildSelect @16-74A5D24C
function mfi_gpSearch_s_mfi_gp_centre_name_ds_BeforeBuildSelect(& $sender)
{
    $mfi_gpSearch_s_mfi_gp_centre_name_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_gpSearch; //Compatibility
//End mfi_gpSearch_s_mfi_gp_centre_name_ds_BeforeBuildSelect

//Custom Code @92-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if(!isset($_COOKIE['cpno']))
$mfi_gpSearch->s_mfi_gp_centre_name->DataSource->SQL="";
//Close mfi_gpSearch_s_mfi_gp_centre_name_ds_BeforeBuildSelect @16-F6111CF8
    return $mfi_gpSearch_s_mfi_gp_centre_name_ds_BeforeBuildSelect;
}
//End Close mfi_gpSearch_s_mfi_gp_centre_name_ds_BeforeBuildSelect

//mfi_gpSearch_BeforeShow @12-8EE94105
function mfi_gpSearch_BeforeShow(& $sender)
{
    $mfi_gpSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_gpSearch; //Compatibility
//End mfi_gpSearch_BeforeShow

//Custom Code @72-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_gpSearch_BeforeShow @12-53FF7776
    return $mfi_gpSearch_BeforeShow;
}
//End Close mfi_gpSearch_BeforeShow

//Panel1_BeforeShow @5-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Custom Code @71-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
//Panel1UpdatePanel Page BeforeShow @6-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @5-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-24E4A2EB
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $searchPageCP; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @6-37A82194
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

//Page_AfterInitialize @1-259A563C
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $searchPageCP; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-2ECF16FD
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $searchPageCP; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @6-9F5F0EA1
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

//Page_BeforeOutput @1-D528EE6E
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $searchPageCP; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @6-0DFF2749
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $_SERVER["REQUEST_URI"] . "|" . $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-C05617C0
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $searchPageCP; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @6-483BFCB6
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
