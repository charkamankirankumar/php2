<?php
//Include Common Files @1-5F6FC46D
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ManageKYC.php");
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

class clsGridcbodataentry_mfi_hvf2 { //cbodataentry_mfi_hvf2 class @75-B99E00F2

//Variables @75-AB717FB6

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
    public $Sorter_BORROWER_NAME;
//End Variables

//Class_Initialize Event @75-255D1528
    function clsGridcbodataentry_mfi_hvf2($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "cbodataentry_mfi_hvf2";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid cbodataentry_mfi_hvf2";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscbodataentry_mfi_hvf2DataSource($this);
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
        $this->SorterName = CCGetParam("cbodataentry_mfi_hvf2Order", "");
        $this->SorterDirection = CCGetParam("cbodataentry_mfi_hvf2Dir", "");

        $this->MEMBER_ID = new clsControl(ccsLabel, "MEMBER_ID", "MEMBER_ID", ccsText, "", CCGetRequestParam("MEMBER_ID", ccsGet, NULL), $this);
        $this->BORROWER_NAME = new clsControl(ccsLabel, "BORROWER_NAME", "BORROWER_NAME", ccsText, "", CCGetRequestParam("BORROWER_NAME", ccsGet, NULL), $this);
        $this->Link3 = new clsControl(ccsLink, "Link3", "Link3", ccsText, "", CCGetRequestParam("Link3", ccsGet, NULL), $this);
        $this->Link3->Page = "DataUpdatePage.php";
        $this->cbodataentry_mfi_hvf2_TotalRecords = new clsControl(ccsLabel, "cbodataentry_mfi_hvf2_TotalRecords", "cbodataentry_mfi_hvf2_TotalRecords", ccsText, "", CCGetRequestParam("cbodataentry_mfi_hvf2_TotalRecords", ccsGet, NULL), $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button1 = new clsButton("Button1", ccsGet, $this);
        $this->Sorter_BORROWER_NAME = new clsSorter($this->ComponentName, "Sorter_BORROWER_NAME", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @75-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @75-7312B849
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urldatefrom"] = CCGetFromGet("datefrom", NULL);
        $this->DataSource->Parameters["urldateto"] = CCGetFromGet("dateto", NULL);
        $this->DataSource->Parameters["urls_added_at"] = CCGetFromGet("s_added_at", NULL);
        $this->DataSource->Parameters["urls_added_by"] = CCGetFromGet("s_added_by", NULL);
        $this->DataSource->Parameters["urls_mfi_hvf1_no"] = CCGetFromGet("s_mfi_hvf1_no", NULL);

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
            $this->ControlsVisible["MEMBER_ID"] = $this->MEMBER_ID->Visible;
            $this->ControlsVisible["BORROWER_NAME"] = $this->BORROWER_NAME->Visible;
            $this->ControlsVisible["Link3"] = $this->Link3->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->MEMBER_ID->SetValue($this->DataSource->MEMBER_ID->GetValue());
                $this->BORROWER_NAME->SetValue($this->DataSource->BORROWER_NAME->GetValue());
                $this->Link3->SetValue($this->DataSource->Link3->GetValue());
                $this->Link3->Parameters = "";
                $this->Link3->Parameters = CCAddParam($this->Link3->Parameters, "doc_code", $this->DataSource->f("la_id"));
                $this->Link3->Parameters = CCAddParam($this->Link3->Parameters, "doc_type", KYC);
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->MEMBER_ID->Show();
                $this->BORROWER_NAME->Show();
                $this->Link3->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->cbodataentry_mfi_hvf2_TotalRecords->Show();
        $this->Navigator->Show();
        $this->Button1->Show();
        $this->Sorter_BORROWER_NAME->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @75-D025E533
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->MEMBER_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End cbodataentry_mfi_hvf2 Class @75-FCB6E20C

class clscbodataentry_mfi_hvf2DataSource extends clsDBmysql_cams_v2 {  //cbodataentry_mfi_hvf2DataSource Class @75-F9CECBB7

//DataSource Variables @75-1EFF7DA1
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $MEMBER_ID;
    public $BORROWER_NAME;
    public $Link3;
//End DataSource Variables

//DataSourceClass_Initialize Event @75-CD977A65
    function clscbodataentry_mfi_hvf2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid cbodataentry_mfi_hvf2";
        $this->Initialize();
        $this->MEMBER_ID = new clsField("MEMBER_ID", ccsText, "");
        
        $this->BORROWER_NAME = new clsField("BORROWER_NAME", ccsText, "");
        
        $this->Link3 = new clsField("Link3", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @75-17433D0D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_BORROWER_NAME" => array("BORROWER_NAME", "")));
    }
//End SetOrder Method

//Prepare Method @75-4066A5DE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urldatefrom", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urldatefrom"], "", false);
        $this->wp->AddParameter("2", "urldateto", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urldateto"], "", false);
        $this->wp->AddParameter("3", "urls_added_at", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_added_at"], "", false);
        $this->wp->AddParameter("4", "urls_added_by", ccsText, "", "", $this->Parameters["urls_added_by"], "", false);
        $this->wp->AddParameter("5", "urls_mfi_hvf1_no", ccsText, "", "", $this->Parameters["urls_mfi_hvf1_no"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opGreaterThanOrEqual, "added_at_1", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsDate),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opLessThanOrEqual, "added_at_1", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "added_at_1", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "added_by_1", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "la_id", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]);
    }
//End Prepare Method

//Open Method @75-77858FF4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_kyc";
        $this->SQL = "SELECT *, la_id \n\n" .
        "FROM mfi_kyc {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @75-65AF7184
    function SetValues()
    {
        $this->MEMBER_ID->SetDBValue($this->f("la_id"));
        $this->BORROWER_NAME->SetDBValue($this->f("member_name_1"));
        $this->Link3->SetDBValue($this->f("hv_id_1"));
    }
//End SetValues Method

} //End cbodataentry_mfi_hvf2DataSource Class @75-FCB6E20C

class clsRecordcbodataentry_mfi_hvf1 { //cbodataentry_mfi_hvf1 Class @83-BF9B26C7

//Variables @83-9E315808

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

//Class_Initialize Event @83-8C921200
    function clsRecordcbodataentry_mfi_hvf1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record cbodataentry_mfi_hvf1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "cbodataentry_mfi_hvf1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_added_by = new clsControl(ccsTextBox, "s_added_by", "s_added_by", ccsText, "", CCGetRequestParam("s_added_by", $Method, NULL), $this);
            $this->s_added_at = new clsControl(ccsTextBox, "s_added_at", "s_added_at", ccsText, "", CCGetRequestParam("s_added_at", $Method, NULL), $this);
            $this->s_mfi_hvf1_no = new clsControl(ccsTextBox, "s_mfi_hvf1_no", "s_mfi_hvf1_no", ccsText, "", CCGetRequestParam("s_mfi_hvf1_no", $Method, NULL), $this);
            $this->datefrom = new clsControl(ccsTextBox, "datefrom", "datefrom", ccsText, "", CCGetRequestParam("datefrom", $Method, NULL), $this);
            $this->dateto = new clsControl(ccsTextBox, "dateto", "dateto", ccsText, "", CCGetRequestParam("dateto", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @83-9E9B2266
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_added_by->Validate() && $Validation);
        $Validation = ($this->s_added_at->Validate() && $Validation);
        $Validation = ($this->s_mfi_hvf1_no->Validate() && $Validation);
        $Validation = ($this->datefrom->Validate() && $Validation);
        $Validation = ($this->dateto->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_added_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_added_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_hvf1_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->datefrom->Errors->Count() == 0);
        $Validation =  $Validation && ($this->dateto->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @83-8A020ED4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_added_by->Errors->Count());
        $errors = ($errors || $this->s_added_at->Errors->Count());
        $errors = ($errors || $this->s_mfi_hvf1_no->Errors->Count());
        $errors = ($errors || $this->datefrom->Errors->Count());
        $errors = ($errors || $this->dateto->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @83-32F9C6D7
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
        $Redirect = "ManageKYC.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ManageKYC.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @83-C18BC9A7
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
            $Error = ComposeStrings($Error, $this->s_added_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_added_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_hvf1_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->datefrom->Errors->ToString());
            $Error = ComposeStrings($Error, $this->dateto->Errors->ToString());
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
        $this->s_added_by->Show();
        $this->s_added_at->Show();
        $this->s_mfi_hvf1_no->Show();
        $this->datefrom->Show();
        $this->dateto->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End cbodataentry_mfi_hvf1 Class @83-FCB6E20C

//Initialize Page @1-C60497A7
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
$TemplateFileName = "ManageKYC.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-808CA5E5
include_once("./ManageKYC_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E42C62F3
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
$Link1 = new clsControl(ccsImageLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link1->Page = "modalHV1.php";
$cbodataentry_mfi_hvf2 = new clsGridcbodataentry_mfi_hvf2("", $MainPage);
$cbodataentry_mfi_hvf1 = new clsRecordcbodataentry_mfi_hvf1("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$MainPage->incMenu = & $incMenu;
$MainPage->Link1 = & $Link1;
$MainPage->cbodataentry_mfi_hvf2 = & $cbodataentry_mfi_hvf2;
$MainPage->cbodataentry_mfi_hvf1 = & $cbodataentry_mfi_hvf1;
$cbodataentry_mfi_hvf2->Initialize();

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

//Execute Components @1-A490AF64
$cbodataentry_mfi_hvf1->Operation();
$incMenu->Operations();
$incFooter->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-7AA7E7C6
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
    unset($cbodataentry_mfi_hvf2);
    unset($cbodataentry_mfi_hvf1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7B16473E
$incHeader->Show();
$incFooter->Show();
$incMenu->Show();
$cbodataentry_mfi_hvf2->Show();
$cbodataentry_mfi_hvf1->Show();
$Link1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-099816F9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
unset($cbodataentry_mfi_hvf2);
unset($cbodataentry_mfi_hvf1);
unset($Tpl);
//End Unload Page


?>
