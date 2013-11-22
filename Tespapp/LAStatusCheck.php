<?php
//Include Common Files @1-76827A3C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "LAStatusCheck.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-05EE5DFD
include_once(RelativePath . "/incHeader.php");
//End Include Page implementation

//Include Page implementation @4-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Include Page implementation @3-60E713C2
include_once(RelativePath . "/incFooter.php");
//End Include Page implementation

class clsGridmfi_hvf1 { //mfi_hvf1 class @5-8561444E

//Variables @5-6E51DF5A

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
//End Variables

//Class_Initialize Event @5-05587CDD
    function clsGridmfi_hvf1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_hvf1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_hvf1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_hvf1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->la_id = new clsControl(ccsLabel, "la_id", "la_id", ccsText, "", CCGetRequestParam("la_id", ccsGet, NULL), $this);
        $this->SANCTIONED_AMOUNT = new clsControl(ccsLabel, "SANCTIONED_AMOUNT", "SANCTIONED_AMOUNT", ccsInteger, "", CCGetRequestParam("SANCTIONED_AMOUNT", ccsGet, NULL), $this);
        $this->CB_ANALYSYS_RESULT = new clsControl(ccsLabel, "CB_ANALYSYS_RESULT", "CB_ANALYSYS_RESULT", ccsText, "", CCGetRequestParam("CB_ANALYSYS_RESULT", ccsGet, NULL), $this);
        $this->BUDGET_ANALYSYS_RESULT = new clsControl(ccsLabel, "BUDGET_ANALYSYS_RESULT", "BUDGET_ANALYSYS_RESULT", ccsText, "", CCGetRequestParam("BUDGET_ANALYSYS_RESULT", ccsGet, NULL), $this);
        $this->TELECALLING_RESULT = new clsControl(ccsLabel, "TELECALLING_RESULT", "TELECALLING_RESULT", ccsText, "", CCGetRequestParam("TELECALLING_RESULT", ccsGet, NULL), $this);
        $this->FINAL_RESULT = new clsControl(ccsLabel, "FINAL_RESULT", "FINAL_RESULT", ccsText, "", CCGetRequestParam("FINAL_RESULT", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @5-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @5-F9D3D28F
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_la_id"] = CCGetFromGet("s_la_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["la_id"] = $this->la_id->Visible;
            $this->ControlsVisible["SANCTIONED_AMOUNT"] = $this->SANCTIONED_AMOUNT->Visible;
            $this->ControlsVisible["CB_ANALYSYS_RESULT"] = $this->CB_ANALYSYS_RESULT->Visible;
            $this->ControlsVisible["BUDGET_ANALYSYS_RESULT"] = $this->BUDGET_ANALYSYS_RESULT->Visible;
            $this->ControlsVisible["TELECALLING_RESULT"] = $this->TELECALLING_RESULT->Visible;
            $this->ControlsVisible["FINAL_RESULT"] = $this->FINAL_RESULT->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->la_id->SetValue($this->DataSource->la_id->GetValue());
                $this->SANCTIONED_AMOUNT->SetValue($this->DataSource->SANCTIONED_AMOUNT->GetValue());
                $this->CB_ANALYSYS_RESULT->SetValue($this->DataSource->CB_ANALYSYS_RESULT->GetValue());
                $this->BUDGET_ANALYSYS_RESULT->SetValue($this->DataSource->BUDGET_ANALYSYS_RESULT->GetValue());
                $this->TELECALLING_RESULT->SetValue($this->DataSource->TELECALLING_RESULT->GetValue());
                $this->FINAL_RESULT->SetValue($this->DataSource->FINAL_RESULT->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->la_id->Show();
                $this->SANCTIONED_AMOUNT->Show();
                $this->CB_ANALYSYS_RESULT->Show();
                $this->BUDGET_ANALYSYS_RESULT->Show();
                $this->TELECALLING_RESULT->Show();
                $this->FINAL_RESULT->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-AF60A75E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->la_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SANCTIONED_AMOUNT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CB_ANALYSYS_RESULT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BUDGET_ANALYSYS_RESULT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TELECALLING_RESULT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FINAL_RESULT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_hvf1 Class @5-FCB6E20C

class clsmfi_hvf1DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf1DataSource Class @5-2D65C6A0

//DataSource Variables @5-E34FAE12
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $la_id;
    public $SANCTIONED_AMOUNT;
    public $CB_ANALYSYS_RESULT;
    public $BUDGET_ANALYSYS_RESULT;
    public $TELECALLING_RESULT;
    public $FINAL_RESULT;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-D571B203
    function clsmfi_hvf1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_hvf1";
        $this->Initialize();
        $this->la_id = new clsField("la_id", ccsText, "");
        
        $this->SANCTIONED_AMOUNT = new clsField("SANCTIONED_AMOUNT", ccsInteger, "");
        
        $this->CB_ANALYSYS_RESULT = new clsField("CB_ANALYSYS_RESULT", ccsText, "");
        
        $this->BUDGET_ANALYSYS_RESULT = new clsField("BUDGET_ANALYSYS_RESULT", ccsText, "");
        
        $this->TELECALLING_RESULT = new clsField("TELECALLING_RESULT", ccsText, "");
        
        $this->FINAL_RESULT = new clsField("FINAL_RESULT", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @5-D5B03089
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_la_id", ccsText, "", "", $this->Parameters["urls_la_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "la_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @5-CBA05EAA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf2";
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_hvf2 {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @5-A4343794
    function SetValues()
    {
        $this->la_id->SetDBValue($this->f("la_id"));
        $this->SANCTIONED_AMOUNT->SetDBValue(trim($this->f("cb_approved_loan_amount")));
        $this->CB_ANALYSYS_RESULT->SetDBValue($this->f("cb_analysys_result"));
        $this->BUDGET_ANALYSYS_RESULT->SetDBValue($this->f("cd_analysys_result"));
        $this->TELECALLING_RESULT->SetDBValue($this->f("mfi_telecaller_status"));
        $this->FINAL_RESULT->SetDBValue($this->f("final_result"));
    }
//End SetValues Method

} //End mfi_hvf1DataSource Class @5-FCB6E20C

class clsRecordmfi_hvf1Search { //mfi_hvf1Search Class @13-A0238245

//Variables @13-9E315808

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

//Class_Initialize Event @13-D5D81F85
    function clsRecordmfi_hvf1Search($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_hvf1Search/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_hvf1Search";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_la_id = new clsControl(ccsTextBox, "s_la_id", "s_la_id", ccsText, "", CCGetRequestParam("s_la_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @13-9C70E70F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_la_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_la_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @13-E05B24FD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_la_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @13-653EA624
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
            }
        }
        $Redirect = "LAStatusCheck.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "LAStatusCheck.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @13-E2A05524
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
            $Error = ComposeStrings($Error, $this->s_la_id->Errors->ToString());
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
        $this->s_la_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_hvf1Search Class @13-FCB6E20C

//Initialize Page @1-57B690C5
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
$TemplateFileName = "LAStatusCheck.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FF8D16D5
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incHeader = new clsincHeader("", "incHeader", $MainPage);
$incHeader->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$incFooter = new clsincFooter("", "incFooter", $MainPage);
$incFooter->Initialize();
$mfi_hvf1 = new clsGridmfi_hvf1("", $MainPage);
$mfi_hvf1Search = new clsRecordmfi_hvf1Search("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incMenu = & $incMenu;
$MainPage->incFooter = & $incFooter;
$MainPage->mfi_hvf1 = & $mfi_hvf1;
$MainPage->mfi_hvf1Search = & $mfi_hvf1Search;
$mfi_hvf1->Initialize();

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

//Execute Components @1-75EBC5B1
$mfi_hvf1Search->Operation();
$incFooter->Operations();
$incMenu->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-30D4DF66
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incMenu->Class_Terminate();
    unset($incMenu);
    $incFooter->Class_Terminate();
    unset($incFooter);
    unset($mfi_hvf1);
    unset($mfi_hvf1Search);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A11FEFB8
$incHeader->Show();
$incMenu->Show();
$incFooter->Show();
$mfi_hvf1->Show();
$mfi_hvf1Search->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1CF1FC3A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incMenu->Class_Terminate();
unset($incMenu);
$incFooter->Class_Terminate();
unset($incFooter);
unset($mfi_hvf1);
unset($mfi_hvf1Search);
unset($Tpl);
//End Unload Page


?>
