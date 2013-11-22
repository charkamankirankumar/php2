<?php
//BindEvents Method @1-6FF6245D
function BindEvents()
{
    global $PagePanel;
    global $CCSEvents;
    $PagePanel->CCSEvents["BeforeShow"] = "PagePanel_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
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

//Custom Code @181-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//PagePanelPagePanelUpdate Page BeforeShow @126-016409F3
    global $CCSFormFilter;
    if ($CCSFormFilter == "PagePanel") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"PagePanel\">";
        $Component->BlockSuffix = "</div>";
    }
//End PagePanelPagePanelUpdate Page BeforeShow

//Close PagePanel_BeforeShow @6-D3554952
    return $PagePanel_BeforeShow;
}
//End Close PagePanel_BeforeShow

//Page_BeforeInitialize @1-D36EDF3B
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $userHome; //Compatibility
//End Page_BeforeInitialize

//PagePanelPagePanelUpdate PageBeforeInitialize @126-C15701C8
    if (CCGetFromGet("FormFilter") == "PagePanel" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $CCSLocales, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $CCSLocales->GetFormatInfo("PHPEncoding"));
        $CCSIsParamsEncoded = true;
    }
//End PagePanelPagePanelUpdate PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-BCC7057A
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $userHome; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-75A832CF
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $userHome; //Compatibility
//End Page_BeforeShow

//PagePanelPagePanelUpdate Page BeforeShow @126-25298DF8
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "PagePanel") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End PagePanelPagePanelUpdate Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-203A6FFA
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $userHome; //Compatibility
//End Page_BeforeOutput

//PagePanelPagePanelUpdate PageBeforeOutput @126-ADCCD83C
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "PagePanel") {
        $main_block = $_SERVER["REQUEST_URI"] . "|" . $Tpl->getvar("/Panel PagePanel");
    }
//End PagePanelPagePanelUpdate PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-9E28170D
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $userHome; //Compatibility
//End Page_BeforeUnload

//PagePanelPagePanelUpdate PageBeforeUnload @126-C43B8402
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "PagePanel") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End PagePanelPagePanelUpdate PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload


?>
