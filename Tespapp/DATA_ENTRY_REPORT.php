<?php
//Include Common Files @1-C2240C80
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "DATA_ENTRY_REPORT.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-05EE5DFD
include_once(RelativePath . "/incHeader.php");
//End Include Page implementation

//Include Page implementation @3-60E713C2
include_once(RelativePath . "/incFooter.php");
//End Include Page implementation

//Include Page implementation @4-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

class clsRecordDATA_ENTRY_REPORT { //DATA_ENTRY_REPORT Class @5-A20B1BAC

//Variables @5-9E315808

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

//Class_Initialize Event @5-0D920744
    function clsRecordDATA_ENTRY_REPORT($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record DATA_ENTRY_REPORT/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "DATA_ENTRY_REPORT";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->TextBox1 = new clsControl(ccsTextBox, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", $Method, NULL), $this);
            $this->TextBox2 = new clsControl(ccsTextBox, "TextBox2", "TextBox2", ccsText, "", CCGetRequestParam("TextBox2", $Method, NULL), $this);
            $this->TextBox3 = new clsControl(ccsTextBox, "TextBox3", "TextBox3", ccsText, "", CCGetRequestParam("TextBox3", $Method, NULL), $this);
            $this->TextBox4 = new clsControl(ccsTextBox, "TextBox4", "TextBox4", ccsText, "", CCGetRequestParam("TextBox4", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->DatePicker_TextBox1 = new clsDatePicker("DatePicker_TextBox1", "DATA_ENTRY_REPORT", "TextBox1", $this);
            $this->DatePicker_TextBox2 = new clsDatePicker("DatePicker_TextBox2", "DATA_ENTRY_REPORT", "TextBox2", $this);
            $this->DatePicker_TextBox3 = new clsDatePicker("DatePicker_TextBox3", "DATA_ENTRY_REPORT", "TextBox3", $this);
            $this->DatePicker_TextBox4 = new clsDatePicker("DatePicker_TextBox4", "DATA_ENTRY_REPORT", "TextBox4", $this);
            $this->TextBox5 = new clsControl(ccsTextBox, "TextBox5", "TextBox5", ccsText, "", CCGetRequestParam("TextBox5", $Method, NULL), $this);
            $this->Button1 = new clsButton("Button1", $Method, $this);
            $this->r_dateentered = new clsControl(ccsRadioButton, "r_dateentered", "r_dateentered", ccsText, "", CCGetRequestParam("r_dateentered", $Method, NULL), $this);
            $this->r_dateentered->DSType = dsListOfValues;
            $this->r_dateentered->Values = array(array("Himark Generated Date", "Himark Generated Date"), array("BaseLine Data", "BaseLine Data"), array("Report By DateEntered", "Report By DateEntered"), array("Report By ResultUpload Date", "Report By ResultUpload Date"), array("Report By DateBetween", "Report By DateBetween"), array("REJECTED RELOGIN", "REJECTED RELOGIN"));
            $this->r_dateentered->HTML = true;
            $this->DatePicker_TextBox5 = new clsDatePicker("DatePicker_TextBox5", "DATA_ENTRY_REPORT", "TextBox5", $this);
            $this->Hidden1 = new clsControl(ccsHidden, "Hidden1", "Hidden1", ccsText, "", CCGetRequestParam("Hidden1", $Method, NULL), $this);
            $this->TextBox6 = new clsControl(ccsTextBox, "TextBox6", "TextBox6", ccsText, "", CCGetRequestParam("TextBox6", $Method, NULL), $this);
            $this->DatePicker_TextBox6 = new clsDatePicker("DatePicker_TextBox6", "DATA_ENTRY_REPORT", "TextBox6", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @5-11099375
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->TextBox1->Validate() && $Validation);
        $Validation = ($this->TextBox2->Validate() && $Validation);
        $Validation = ($this->TextBox3->Validate() && $Validation);
        $Validation = ($this->TextBox4->Validate() && $Validation);
        $Validation = ($this->TextBox5->Validate() && $Validation);
        $Validation = ($this->r_dateentered->Validate() && $Validation);
        $Validation = ($this->Hidden1->Validate() && $Validation);
        $Validation = ($this->TextBox6->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->TextBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->r_dateentered->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox6->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-5BA45B17
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->TextBox1->Errors->Count());
        $errors = ($errors || $this->TextBox2->Errors->Count());
        $errors = ($errors || $this->TextBox3->Errors->Count());
        $errors = ($errors || $this->TextBox4->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox1->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox2->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox3->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox4->Errors->Count());
        $errors = ($errors || $this->TextBox5->Errors->Count());
        $errors = ($errors || $this->r_dateentered->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox5->Errors->Count());
        $errors = ($errors || $this->Hidden1->Errors->Count());
        $errors = ($errors || $this->TextBox6->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox6->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @5-17A3E265
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
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            } else if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = $FileName;
        if($this->PressedButton == "Button_DoSearch") {
            if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
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

//Show Method @5-C86EA69B
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

        $this->r_dateentered->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->r_dateentered->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox6->Errors->ToString());
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

        $this->TextBox1->Show();
        $this->TextBox2->Show();
        $this->TextBox3->Show();
        $this->TextBox4->Show();
        $this->Button_DoSearch->Show();
        $this->DatePicker_TextBox1->Show();
        $this->DatePicker_TextBox2->Show();
        $this->DatePicker_TextBox3->Show();
        $this->DatePicker_TextBox4->Show();
        $this->TextBox5->Show();
        $this->Button1->Show();
        $this->r_dateentered->Show();
        $this->DatePicker_TextBox5->Show();
        $this->Hidden1->Show();
        $this->TextBox6->Show();
        $this->DatePicker_TextBox6->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End DATA_ENTRY_REPORT Class @5-FCB6E20C

class clsRecordNewRecord1 { //NewRecord1 Class @26-D7EDAFB1

//Variables @26-9E315808

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

//Class_Initialize Event @26-AAE45A1A
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
            $this->TextBox1 = new clsControl(ccsTextBox, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", $Method, NULL), $this);
            $this->TextBox2 = new clsControl(ccsTextBox, "TextBox2", "TextBox2", ccsText, "", CCGetRequestParam("TextBox2", $Method, NULL), $this);
            $this->Button1 = new clsButton("Button1", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @26-0DB79AEF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->TextBox1->Validate() && $Validation);
        $Validation = ($this->TextBox2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->TextBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @26-08A8FF7B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->TextBox1->Errors->Count());
        $errors = ($errors || $this->TextBox2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @26-DE5BDEFB
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

//Show Method @26-3360BF27
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox2->Errors->ToString());
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

        $this->TextBox1->Show();
        $this->TextBox2->Show();
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End NewRecord1 Class @26-FCB6E20C

//Initialize Page @1-B58E7170
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
$TemplateFileName = "DATA_ENTRY_REPORT.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-84D31CD1
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incHeader = new clsincHeader("", "incHeader", $MainPage);
$incHeader->Initialize();
$incFooter = new clsincFooter("", "incFooter", $MainPage);
$incFooter->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$DATA_ENTRY_REPORT = new clsRecordDATA_ENTRY_REPORT("", $MainPage);
$NewRecord1 = new clsRecordNewRecord1("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$MainPage->incMenu = & $incMenu;
$MainPage->DATA_ENTRY_REPORT = & $DATA_ENTRY_REPORT;
$MainPage->NewRecord1 = & $NewRecord1;

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

//Execute Components @1-6B4B5337
$NewRecord1->Operation();
$DATA_ENTRY_REPORT->Operation();
$incMenu->Operations();
$incFooter->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-8CA4E360
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incFooter->Class_Terminate();
    unset($incFooter);
    $incMenu->Class_Terminate();
    unset($incMenu);
    unset($DATA_ENTRY_REPORT);
    unset($NewRecord1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9C81CFC4
$incHeader->Show();
$incFooter->Show();
$incMenu->Show();
$DATA_ENTRY_REPORT->Show();
$NewRecord1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6E5B42EE
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
unset($DATA_ENTRY_REPORT);
unset($NewRecord1);
unset($Tpl);
//End Unload Page


?>
