<?php
//Include Common Files @1-F695E2AB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "userHomeRegion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @3-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

//Include Page implementation @182-956D9A72
include_once(RelativePath . "/incMenuRegion.php");
//End Include Page implementation

//Include Page implementation @183-05EE5DFD
include_once(RelativePath . "/incHeader.php");
//End Include Page implementation

//Initialize Page @1-B52A371C
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";
$TemplateSource = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "userHomeRegion.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-FC1C40FE
include_once("./userHomeRegion_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6F4B32F3
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$PagePanel = new clsPanel("PagePanel", $MainPage);
$pnlMenu = new clsPanel("pnlMenu", $MainPage);
$incMenu = new clsincMenuRegion("", "incMenu", $MainPage);
$incMenu->Initialize();
$incHeader = new clsincHeader("", "incHeader", $MainPage);
$incHeader->Initialize();
$MainPage->incFooter = & $incFooter;
$MainPage->PagePanel = & $PagePanel;
$MainPage->pnlMenu = & $pnlMenu;
$MainPage->incMenu = & $incMenu;
$MainPage->incHeader = & $incHeader;
$PagePanel->AddComponent("pnlMenu", $pnlMenu);
$pnlMenu->AddComponent("incMenu", $incMenu);

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-FFE96B5E
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
if (strlen($TemplateSource)) {
    $Tpl->LoadTemplateFromStr($TemplateSource, $BlockToParse, "CP1252", "replace");
} else {
    $Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252", "replace");
}
$Tpl->SetVar("CCS_PathToRoot", $PathToRoot);
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-C29EC2D0
$incHeader->Operations();
$incMenu->Operations();
$incFooter->Operations();
//End Execute Components

//Go to destination page @1-F75C6DFB
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    $incFooter->Class_Terminate();
    unset($incFooter);
    $incMenu->Class_Terminate();
    unset($incMenu);
    $incHeader->Class_Terminate();
    unset($incHeader);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-25FCDEFA
$incFooter->Show();
$incHeader->Show();
$PagePanel->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BE093E68
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
$incHeader->Class_Terminate();
unset($incHeader);
unset($Tpl);
//End Unload Page


?>
