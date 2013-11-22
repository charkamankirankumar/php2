<?php
//Include Common Files @1-A5E2669A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "TC_DATA_REPORT.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordNewRecord1 { //NewRecord1 Class @2-D7EDAFB1

//Variables @2-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @2-188C6A6C
    function clsRecordNewRecord1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "NewRecord1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsListOfValues;
            $this->ListBox1->Values = array(array("SANCTIONED", "SANCTIONED"), array("REJECTED", "REJECTED"), array("PENDING", "PENDING"), array("ALL", "ALL"));
            $this->Button1 = new clsButton("Button1", $Method, $this);
            $this->to_date = new clsControl(ccsTextBox, "to_date", "to_date", ccsText, "", CCGetRequestParam("to_date", $Method, NULL), $this);
            $this->from_date = new clsControl(ccsTextBox, "from_date", "from_date", ccsText, "", CCGetRequestParam("from_date", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-3FE42154
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->to_date->Validate() && $Validation);
        $Validation = ($this->from_date->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->to_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->from_date->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-74E01568
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->to_date->Errors->Count());
        $errors = ($errors || $this->from_date->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-DE5BDEFB
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button1";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-85794830
    function Show()
    {
        global $CCSUseAmp;
        $Tpl = & CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->ListBox1->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->to_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->from_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->ListBox1->Show();
        $this->Button1->Show();
        $this->to_date->Show();
        $this->from_date->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End NewRecord1 Class @2-FCB6E20C

//Include Page implementation @10-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @14-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Include Page implementation @18-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

//Initialize Page @1-8169070F
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
$TemplateFileName = "TC_DATA_REPORT.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F72B1CCF
include_once("./TC_DATA_REPORT_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6A3DFFE4
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$NewRecord1 = new clsRecordNewRecord1("", $MainPage);
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$PagePanel = new clsPanel("PagePanel", $MainPage);
$pnlMenu = new clsPanel("pnlMenu", $MainPage);
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$MainPage->NewRecord1 = & $NewRecord1;
$MainPage->incHeader = & $incHeader;
$MainPage->PagePanel = & $PagePanel;
$MainPage->pnlMenu = & $pnlMenu;
$MainPage->incMenu = & $incMenu;
$MainPage->incFooter = & $incFooter;
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

//Execute Components @1-D812423D
$incFooter->Operations();
$incMenu->Operations();
$incHeader->Operations();
$NewRecord1->Operation();
//End Execute Components

//Go to destination page @1-158BB4AA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    unset($NewRecord1);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incMenu->Class_Terminate();
    unset($incMenu);
    $incFooter->Class_Terminate();
    unset($incFooter);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3048A1AB
$NewRecord1->Show();
$incHeader->Show();
$incFooter->Show();
$PagePanel->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D98B2D9B
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
unset($NewRecord1);
$incHeader->Class_Terminate();
unset($incHeader);
$incMenu->Class_Terminate();
unset($incMenu);
$incFooter->Class_Terminate();
unset($incFooter);
unset($Tpl);
//End Unload Page


?>
