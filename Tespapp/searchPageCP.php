<?php
//Include Common Files @1-8E82D9C6
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "searchPageCP.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



class clsRecordmfi_gpSearch { //mfi_gpSearch Class @12-1E6F551F

//Variables @12-9E315808

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

//Class_Initialize Event @12-BE6A8FA8
    function clsRecordmfi_gpSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_gpSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_gpSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_mfi_cp_no = new clsControl(ccsListBox, "s_mfi_cp_no", "s_mfi_cp_no", ccsText, "", CCGetRequestParam("s_mfi_cp_no", $Method, NULL), $this);
            $this->s_mfi_cp_no->DSType = dsTable;
            $this->s_mfi_cp_no->DataSource = new clsDBmysql_cams_v2();
            $this->s_mfi_cp_no->ds = & $this->s_mfi_cp_no->DataSource;
            $this->s_mfi_cp_no->DataSource->SQL = "SELECT * \n" .
"FROM mfi_cp {SQL_Where} {SQL_OrderBy}";
            list($this->s_mfi_cp_no->BoundColumn, $this->s_mfi_cp_no->TextColumn, $this->s_mfi_cp_no->DBFormat) = array("cp_id", "cp_id", "");
            $this->s_mfi_cp_no->DataSource->Parameters["cookcpno"] = CCGetCookie("cpno", NULL);
            $this->s_mfi_cp_no->DataSource->wp = new clsSQLParameters();
            $this->s_mfi_cp_no->DataSource->wp->AddParameter("1", "cookcpno", ccsText, "", "", $this->s_mfi_cp_no->DataSource->Parameters["cookcpno"], "", false);
            $this->s_mfi_cp_no->DataSource->wp->Criterion[1] = $this->s_mfi_cp_no->DataSource->wp->Operation(opContains, "cp_route", $this->s_mfi_cp_no->DataSource->wp->GetDBValue("1"), $this->s_mfi_cp_no->DataSource->ToSQL($this->s_mfi_cp_no->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_mfi_cp_no->DataSource->Where = 
                 $this->s_mfi_cp_no->DataSource->wp->Criterion[1];
            $this->s_mfi_gp_centre_name = new clsControl(ccsListBox, "s_mfi_gp_centre_name", "s_mfi_gp_centre_name", ccsText, "", CCGetRequestParam("s_mfi_gp_centre_name", $Method, NULL), $this);
            $this->s_mfi_gp_centre_name->DSType = dsTable;
            $this->s_mfi_gp_centre_name->DataSource = new clsDBmysql_cams_v2();
            $this->s_mfi_gp_centre_name->ds = & $this->s_mfi_gp_centre_name->DataSource;
            $this->s_mfi_gp_centre_name->DataSource->SQL = "SELECT * \n" .
"FROM mfi_cp {SQL_Where}\n" .
"GROUP BY mfi_cp_centre_name {SQL_OrderBy}";
            list($this->s_mfi_gp_centre_name->BoundColumn, $this->s_mfi_gp_centre_name->TextColumn, $this->s_mfi_gp_centre_name->DBFormat) = array("mfi_cp_no", "mfi_cp_centre_name", "");
            $this->s_mfi_gp_centre_name->DataSource->Parameters["cookcpno"] = CCGetCookie("cpno", NULL);
            $this->s_mfi_gp_centre_name->DataSource->wp = new clsSQLParameters();
            $this->s_mfi_gp_centre_name->DataSource->wp->AddParameter("1", "cookcpno", ccsText, "", "", $this->s_mfi_gp_centre_name->DataSource->Parameters["cookcpno"], "", false);
            $this->s_mfi_gp_centre_name->DataSource->wp->Criterion[1] = $this->s_mfi_gp_centre_name->DataSource->wp->Operation(opContains, "mfi_cp_no", $this->s_mfi_gp_centre_name->DataSource->wp->GetDBValue("1"), $this->s_mfi_gp_centre_name->DataSource->ToSQL($this->s_mfi_gp_centre_name->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_mfi_gp_centre_name->DataSource->Where = 
                 $this->s_mfi_gp_centre_name->DataSource->wp->Criterion[1];
            $this->s_mfi_gp_proposal_date = new clsControl(ccsTextBox, "s_mfi_gp_proposal_date", "s_mfi_gp_proposal_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_mfi_gp_proposal_date", $Method, NULL), $this);
            $this->DatePicker_s_mfi_gp_proposal_date = new clsDatePicker("DatePicker_s_mfi_gp_proposal_date", "mfi_gpSearch", "s_mfi_gp_proposal_date", $this);
            $this->fromdate = new clsControl(ccsTextBox, "fromdate", "fromdate", ccsText, "", CCGetRequestParam("fromdate", $Method, NULL), $this);
            $this->DatePicker_TextBox1 = new clsDatePicker("DatePicker_TextBox1", "mfi_gpSearch", "fromdate", $this);
            $this->todate = new clsControl(ccsTextBox, "todate", "todate", ccsText, "", CCGetRequestParam("todate", $Method, NULL), $this);
            $this->DatePicker_TextBox2 = new clsDatePicker("DatePicker_TextBox2", "mfi_gpSearch", "todate", $this);
            $this->TextBox1 = new clsControl(ccsTextBox, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", $Method, NULL), $this);
            $this->Button1 = new clsButton("Button1", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @12-25A147A0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mfi_cp_no->Validate() && $Validation);
        $Validation = ($this->s_mfi_gp_centre_name->Validate() && $Validation);
        $Validation = ($this->s_mfi_gp_proposal_date->Validate() && $Validation);
        $Validation = ($this->fromdate->Validate() && $Validation);
        $Validation = ($this->todate->Validate() && $Validation);
        $Validation = ($this->TextBox1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mfi_cp_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_gp_centre_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_gp_proposal_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fromdate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->todate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @12-4EF8BA77
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mfi_cp_no->Errors->Count());
        $errors = ($errors || $this->s_mfi_gp_centre_name->Errors->Count());
        $errors = ($errors || $this->s_mfi_gp_proposal_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_mfi_gp_proposal_date->Errors->Count());
        $errors = ($errors || $this->fromdate->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox1->Errors->Count());
        $errors = ($errors || $this->todate->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox2->Errors->Count());
        $errors = ($errors || $this->TextBox1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @12-DC170598
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
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "searchPageCP.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "Button1", "Button1_x", "Button1_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button1") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "Button1", "Button1_x", "Button1_y")));
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @12-D1994427
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

        $this->s_mfi_cp_no->Prepare();
        $this->s_mfi_gp_centre_name->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_mfi_cp_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_gp_centre_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_gp_proposal_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_mfi_gp_proposal_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fromdate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->todate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox1->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->s_mfi_cp_no->Show();
        $this->s_mfi_gp_centre_name->Show();
        $this->s_mfi_gp_proposal_date->Show();
        $this->DatePicker_s_mfi_gp_proposal_date->Show();
        $this->fromdate->Show();
        $this->DatePicker_TextBox1->Show();
        $this->todate->Show();
        $this->DatePicker_TextBox2->Show();
        $this->TextBox1->Show();
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_gpSearch Class @12-FCB6E20C





//Initialize Page @1-49F82E99
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
$TemplateFileName = "searchPageCP.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-ED228CA9
include_once("./searchPageCP_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DC9A81FA
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$mfi_gpSearch = new clsRecordmfi_gpSearch("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->mfi_gpSearch = & $mfi_gpSearch;
$Panel1->AddComponent("mfi_gpSearch", $mfi_gpSearch);

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

//Execute Components @1-721E8D4D
$mfi_gpSearch->Operation();
//End Execute Components

//Go to destination page @1-6D140AC8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_gpSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A4826711
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BAA7E712
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_gpSearch);
unset($Tpl);
//End Unload Page


?>
