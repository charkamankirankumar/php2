<?php
//Include Common Files @1-A7BEBF9B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "DOC_GENERATEnew.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordnps_master { //nps_master Class @2-72D592D5

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

//Class_Initialize Event @2-985FE758
    function clsRecordnps_master($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record nps_master/Error";
        $this->DataSource = new clsnps_masterDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "nps_master";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->generated = new clsControl(ccsHidden, "generated", "Generated", ccsText, "", CCGetRequestParam("generated", $Method, NULL), $this);
            $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsTable;
            $this->ListBox1->DataSource = new clsDBmysql_cams_v2();
            $this->ListBox1->ds = & $this->ListBox1->DataSource;
            $this->ListBox1->DataSource->SQL = "SELECT concat(lano,\" \",first_name,\" \",last_name) AS member_name, lano, branch \n" .
"FROM nps_master {SQL_Where}\n" .
"GROUP BY branch {SQL_OrderBy}";
            list($this->ListBox1->BoundColumn, $this->ListBox1->TextColumn, $this->ListBox1->DBFormat) = array("branch", "branch", "");
            $this->ListBox1->DataSource->wp = new clsSQLParameters();
            $this->ListBox1->DataSource->wp->Criterion[1] = "( generated is null )";
            $this->ListBox1->DataSource->Where = 
                 $this->ListBox1->DataSource->wp->Criterion[1];
            $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", $Method, NULL), $this);
            $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->Link1->Page = "";
            $this->ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", $Method, NULL), $this);
            $this->ListBox2->DSType = dsTable;
            $this->ListBox2->DataSource = new clsDBmysql_cams_v2();
            $this->ListBox2->ds = & $this->ListBox2->DataSource;
            $this->ListBox2->DataSource->SQL = "SELECT lano, concat(lano,\" \",first_name,\" \",last_name) AS member_name, branch \n" .
"FROM nps_master {SQL_Where}\n" .
"GROUP BY branch {SQL_OrderBy}";
            list($this->ListBox2->BoundColumn, $this->ListBox2->TextColumn, $this->ListBox2->DBFormat) = array("branch", "branch", "");
            $this->ListBox2->DataSource->wp = new clsSQLParameters();
            $this->ListBox2->DataSource->wp->Criterion[1] = "( generated is not null )";
            $this->ListBox2->DataSource->Where = 
                 $this->ListBox2->DataSource->wp->Criterion[1];
            $this->TextBox1 = new clsControl(ccsTextBox, "TextBox1", "TextBox1", ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("TextBox1", $Method, NULL), $this);
            $this->DatePicker_TextBox1 = new clsDatePicker("DatePicker_TextBox1", "nps_master", "TextBox1", $this);
            $this->TextBox2 = new clsControl(ccsTextBox, "TextBox2", "TextBox2", ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("TextBox2", $Method, NULL), $this);
            $this->DatePicker_TextBox2 = new clsDatePicker("DatePicker_TextBox2", "nps_master", "TextBox2", $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @2-477959DD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->generated->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->ListBox2->Validate() && $Validation);
        $Validation = ($this->TextBox1->Validate() && $Validation);
        $Validation = ($this->TextBox2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->generated->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-AB4DA470
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->generated->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->Link1->Errors->Count());
        $errors = ($errors || $this->ListBox2->Errors->Count());
        $errors = ($errors || $this->TextBox1->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox1->Errors->Count());
        $errors = ($errors || $this->TextBox2->Errors->Count());
        $errors = ($errors || $this->DatePicker_TextBox2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-EF3AB844
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Update";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @2-16A4AA1D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->generated->SetValue($this->generated->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-30891401
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
        $this->ListBox2->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->generated->SetValue($this->DataSource->generated->GetValue());
                    $this->ListBox1->SetValue($this->DataSource->ListBox1->GetValue());
                    $this->ListBox2->SetValue($this->DataSource->ListBox2->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->generated->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Link1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_TextBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
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

        $this->Button_Update->Show();
        $this->generated->Show();
        $this->ListBox1->Show();
        $this->Link1->Show();
        $this->ListBox2->Show();
        $this->TextBox1->Show();
        $this->DatePicker_TextBox1->Show();
        $this->TextBox2->Show();
        $this->DatePicker_TextBox2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End nps_master Class @2-FCB6E20C

class clsnps_masterDataSource extends clsDBmysql_cams_v2 {  //nps_masterDataSource Class @2-CC1CE9A0

//DataSource Variables @2-0561BB37
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $generated;
    public $ListBox1;
    public $Link1;
    public $ListBox2;
    public $TextBox1;
    public $TextBox2;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-1AFCBA0C
    function clsnps_masterDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record nps_master/Error";
        $this->Initialize();
        $this->generated = new clsField("generated", ccsText, "");
        
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        
        $this->Link1 = new clsField("Link1", ccsText, "");
        
        $this->ListBox2 = new clsField("ListBox2", ccsText, "");
        
        $this->TextBox1 = new clsField("TextBox1", ccsDate, $this->DateFormat);
        
        $this->TextBox2 = new clsField("TextBox2", ccsDate, $this->DateFormat);
        

        $this->UpdateFields["generated"] = array("Name" => "generated", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["branch"] = array("Name" => "branch", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-CD13B101
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = "( generated is null )";
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-B38F3A6E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM nps_master {SQL_Where}\n\n" .
        "GROUP BY branch {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-CE031421
    function SetValues()
    {
        $this->generated->SetDBValue($this->f("generated"));
        $this->ListBox1->SetDBValue($this->f("branch"));
        $this->ListBox2->SetDBValue($this->f("branch"));
    }
//End SetValues Method

//Update Method @2-302D4785
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["generated"] = new clsSQLParameter("ctrlgenerated", ccsText, "", "", $this->generated->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["branch"] = new clsSQLParameter("ctrlListBox1", ccsText, "", "", $this->ListBox1->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "ctrlListBox1", ccsText, "", "", $this->ListBox1->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "ctrlListBox1", ccsText, "", "", $this->ListBox1->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("3", "ctrlListBox1", ccsText, "", "", $this->ListBox1->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["generated"]->GetValue()) and !strlen($this->cp["generated"]->GetText()) and !is_bool($this->cp["generated"]->GetValue())) 
            $this->cp["generated"]->SetValue($this->generated->GetValue(true));
        if (!is_null($this->cp["branch"]->GetValue()) and !strlen($this->cp["branch"]->GetText()) and !is_bool($this->cp["branch"]->GetValue())) 
            $this->cp["branch"]->SetValue($this->ListBox1->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "branch", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsText),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "branch", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsText),false);
        $wp->Criterion[3] = $wp->Operation(opEqual, "branch", $wp->GetDBValue("3"), $this->ToSQL($wp->GetDBValue("3"), ccsText),false);
        $Where = $wp->opAND(
             false, $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]), 
             $wp->Criterion[3]);
        $this->UpdateFields["generated"]["Value"] = $this->cp["generated"]->GetDBValue(true);
        $this->UpdateFields["branch"]["Value"] = $this->cp["branch"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("nps_master", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End nps_masterDataSource Class @2-FCB6E20C

//Include Page implementation @13-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @15-956D9A72
include_once(RelativePath . "/incMenuRegion.php");
//End Include Page implementation

//Include Page implementation @16-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

//Initialize Page @1-F7C64D32
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
$TemplateFileName = "DOC_GENERATEnew.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A2B6C01F
include_once("./DOC_GENERATEnew_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-37A81D1E
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$nps_master = new clsRecordnps_master("", $MainPage);
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$incMenu = new clsincMenuRegion("", "incMenu", $MainPage);
$incMenu->Initialize();
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$MainPage->nps_master = & $nps_master;
$MainPage->incHeader = & $incHeader;
$MainPage->incMenu = & $incMenu;
$MainPage->incFooter = & $incFooter;
$nps_master->Initialize();

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

//Execute Components @1-4106AED3
$incFooter->Operations();
$incMenu->Operations();
$incHeader->Operations();
$nps_master->Operation();
//End Execute Components

//Go to destination page @1-DD5A7D30
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($nps_master);
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

//Show Page @1-0FC4AA5D
$nps_master->Show();
$incHeader->Show();
$incMenu->Show();
$incFooter->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-589306EB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($nps_master);
$incHeader->Class_Terminate();
unset($incHeader);
$incMenu->Class_Terminate();
unset($incMenu);
$incFooter->Class_Terminate();
unset($incFooter);
unset($Tpl);
//End Unload Page


?>
