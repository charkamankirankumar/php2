<?php
//Include Common Files @1-33A40988
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "TESTPAGE.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsGridmfi_docs { //mfi_docs class @2-A9045E36

//Variables @2-32418EC8

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
    public $Sorter_batch_code;
    public $Sorter_mfi_doc_filename;
    public $Sorter_mfi_doc_type;
    public $Sorter_mfi_doc_region;
    public $Sorter_mfi_doc_tagged_at;
    public $Sorter_mfi_doc_status;
//End Variables

//Class_Initialize Event @2-85A26515
    function clsGridmfi_docs($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_docs";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_docs";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_docsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("mfi_docsOrder", "");
        $this->SorterDirection = CCGetParam("mfi_docsDir", "");

        $this->batch_code = new clsControl(ccsLabel, "batch_code", "batch_code", ccsText, "", CCGetRequestParam("batch_code", ccsGet, NULL), $this);
        $this->mfi_doc_filename = new clsControl(ccsLabel, "mfi_doc_filename", "mfi_doc_filename", ccsText, "", CCGetRequestParam("mfi_doc_filename", ccsGet, NULL), $this);
        $this->mfi_doc_type = new clsControl(ccsLabel, "mfi_doc_type", "mfi_doc_type", ccsInteger, "", CCGetRequestParam("mfi_doc_type", ccsGet, NULL), $this);
        $this->mfi_doc_region = new clsControl(ccsLabel, "mfi_doc_region", "mfi_doc_region", ccsText, "", CCGetRequestParam("mfi_doc_region", ccsGet, NULL), $this);
        $this->mfi_doc_tagged_at = new clsControl(ccsLabel, "mfi_doc_tagged_at", "mfi_doc_tagged_at", ccsDate, $DefaultDateFormat, CCGetRequestParam("mfi_doc_tagged_at", ccsGet, NULL), $this);
        $this->mfi_doc_status = new clsControl(ccsLabel, "mfi_doc_status", "mfi_doc_status", ccsInteger, "", CCGetRequestParam("mfi_doc_status", ccsGet, NULL), $this);
        $this->Sorter_batch_code = new clsSorter($this->ComponentName, "Sorter_batch_code", $FileName, $this);
        $this->Sorter_mfi_doc_filename = new clsSorter($this->ComponentName, "Sorter_mfi_doc_filename", $FileName, $this);
        $this->Sorter_mfi_doc_type = new clsSorter($this->ComponentName, "Sorter_mfi_doc_type", $FileName, $this);
        $this->Sorter_mfi_doc_region = new clsSorter($this->ComponentName, "Sorter_mfi_doc_region", $FileName, $this);
        $this->Sorter_mfi_doc_tagged_at = new clsSorter($this->ComponentName, "Sorter_mfi_doc_tagged_at", $FileName, $this);
        $this->Sorter_mfi_doc_status = new clsSorter($this->ComponentName, "Sorter_mfi_doc_status", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-B11A4438
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_batch_code"] = CCGetFromGet("s_batch_code", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_filename"] = CCGetFromGet("s_mfi_doc_filename", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_type"] = CCGetFromGet("s_mfi_doc_type", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_region"] = CCGetFromGet("s_mfi_doc_region", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_tagged_at"] = CCGetFromGet("s_mfi_doc_tagged_at", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_status"] = CCGetFromGet("s_mfi_doc_status", NULL);

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
            $this->ControlsVisible["batch_code"] = $this->batch_code->Visible;
            $this->ControlsVisible["mfi_doc_filename"] = $this->mfi_doc_filename->Visible;
            $this->ControlsVisible["mfi_doc_type"] = $this->mfi_doc_type->Visible;
            $this->ControlsVisible["mfi_doc_region"] = $this->mfi_doc_region->Visible;
            $this->ControlsVisible["mfi_doc_tagged_at"] = $this->mfi_doc_tagged_at->Visible;
            $this->ControlsVisible["mfi_doc_status"] = $this->mfi_doc_status->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
                $this->mfi_doc_filename->SetValue($this->DataSource->mfi_doc_filename->GetValue());
                $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
                $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
                $this->mfi_doc_tagged_at->SetValue($this->DataSource->mfi_doc_tagged_at->GetValue());
                $this->mfi_doc_status->SetValue($this->DataSource->mfi_doc_status->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->batch_code->Show();
                $this->mfi_doc_filename->Show();
                $this->mfi_doc_type->Show();
                $this->mfi_doc_region->Show();
                $this->mfi_doc_tagged_at->Show();
                $this->mfi_doc_status->Show();
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
        $this->Sorter_batch_code->Show();
        $this->Sorter_mfi_doc_filename->Show();
        $this->Sorter_mfi_doc_type->Show();
        $this->Sorter_mfi_doc_region->Show();
        $this->Sorter_mfi_doc_tagged_at->Show();
        $this->Sorter_mfi_doc_status->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-D11D98D7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->batch_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_filename->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_tagged_at->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_docs Class @2-FCB6E20C

class clsmfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_docsDataSource Class @2-BC5AABD7

//DataSource Variables @2-D75FBBD6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $batch_code;
    public $mfi_doc_filename;
    public $mfi_doc_type;
    public $mfi_doc_region;
    public $mfi_doc_tagged_at;
    public $mfi_doc_status;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A03ED94A
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_docs";
        $this->Initialize();
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->mfi_doc_filename = new clsField("mfi_doc_filename", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsInteger, "");
        
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->mfi_doc_tagged_at = new clsField("mfi_doc_tagged_at", ccsDate, $this->DateFormat);
        
        $this->mfi_doc_status = new clsField("mfi_doc_status", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-0E680AEC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_batch_code" => array("batch_code", ""), 
            "Sorter_mfi_doc_filename" => array("mfi_doc_filename", ""), 
            "Sorter_mfi_doc_type" => array("mfi_doc_type", ""), 
            "Sorter_mfi_doc_region" => array("mfi_doc_region", ""), 
            "Sorter_mfi_doc_tagged_at" => array("mfi_doc_tagged_at", ""), 
            "Sorter_mfi_doc_status" => array("mfi_doc_status", "")));
    }
//End SetOrder Method

//Prepare Method @2-201DD23C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_batch_code", ccsText, "", "", $this->Parameters["urls_batch_code"], "", false);
        $this->wp->AddParameter("2", "urls_mfi_doc_filename", ccsText, "", "", $this->Parameters["urls_mfi_doc_filename"], "", false);
        $this->wp->AddParameter("3", "urls_mfi_doc_type", ccsInteger, "", "", $this->Parameters["urls_mfi_doc_type"], "", false);
        $this->wp->AddParameter("4", "urls_mfi_doc_region", ccsText, "", "", $this->Parameters["urls_mfi_doc_region"], "", false);
        $this->wp->AddParameter("5", "urls_mfi_doc_tagged_at", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_mfi_doc_tagged_at"], "", false);
        $this->wp->AddParameter("6", "urls_mfi_doc_status", ccsInteger, "", "", $this->Parameters["urls_mfi_doc_status"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "batch_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "mfi_doc_filename", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "mfi_doc_type", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "mfi_doc_region", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "mfi_doc_tagged_at", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsDate),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "mfi_doc_status", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]);
    }
//End Prepare Method

//Open Method @2-BB1CD1EF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_docs";
        $this->SQL = "SELECT batch_code, mfi_doc_filename, mfi_doc_type, mfi_doc_tagged_at, mfi_doc_region, mfi_doc_status, mfi_doc_id \n\n" .
        "FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-5AC7ACFE
    function SetValues()
    {
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->mfi_doc_filename->SetDBValue($this->f("mfi_doc_filename"));
        $this->mfi_doc_type->SetDBValue(trim($this->f("mfi_doc_type")));
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->mfi_doc_tagged_at->SetDBValue(trim($this->f("mfi_doc_tagged_at")));
        $this->mfi_doc_status->SetDBValue(trim($this->f("mfi_doc_status")));
    }
//End SetValues Method

} //End mfi_docsDataSource Class @2-FCB6E20C

class clsRecordmfi_docsSearch { //mfi_docsSearch Class @30-50AD3A7F

//Variables @30-9E315808

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

//Class_Initialize Event @30-19771487
    function clsRecordmfi_docsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_docsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_docsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_batch_code = new clsControl(ccsTextBox, "s_batch_code", $CCSLocales->GetText("batch_code"), ccsText, "", CCGetRequestParam("s_batch_code", $Method, NULL), $this);
            $this->s_mfi_doc_filename = new clsControl(ccsTextBox, "s_mfi_doc_filename", $CCSLocales->GetText("mfi_doc_filename"), ccsText, "", CCGetRequestParam("s_mfi_doc_filename", $Method, NULL), $this);
            $this->s_mfi_doc_type = new clsControl(ccsTextBox, "s_mfi_doc_type", $CCSLocales->GetText("mfi_doc_type"), ccsInteger, "", CCGetRequestParam("s_mfi_doc_type", $Method, NULL), $this);
            $this->s_mfi_doc_region = new clsControl(ccsTextBox, "s_mfi_doc_region", $CCSLocales->GetText("mfi_doc_region"), ccsText, "", CCGetRequestParam("s_mfi_doc_region", $Method, NULL), $this);
            $this->s_mfi_doc_tagged_at = new clsControl(ccsTextBox, "s_mfi_doc_tagged_at", $CCSLocales->GetText("mfi_doc_tagged_at"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("s_mfi_doc_tagged_at", $Method, NULL), $this);
            $this->s_mfi_doc_status = new clsControl(ccsTextBox, "s_mfi_doc_status", $CCSLocales->GetText("mfi_doc_status"), ccsInteger, "", CCGetRequestParam("s_mfi_doc_status", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @30-780638A4
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_batch_code->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_filename->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_type->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_region->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_tagged_at->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_status->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_batch_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_filename->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_tagged_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_status->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @30-0181F3AD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_batch_code->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_filename->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_tagged_at->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_status->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @30-D6F45CE4
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
        $Redirect = "TESTPAGE.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "TESTPAGE.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @30-8B3592FD
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

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_batch_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_filename->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_tagged_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_status->Errors->ToString());
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
        $this->s_batch_code->Show();
        $this->s_mfi_doc_filename->Show();
        $this->s_mfi_doc_type->Show();
        $this->s_mfi_doc_region->Show();
        $this->s_mfi_doc_tagged_at->Show();
        $this->s_mfi_doc_status->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_docsSearch Class @30-FCB6E20C

//Initialize Page @1-2A0FCD56
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
$TemplateFileName = "TESTPAGE.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-7201C546
include_once("./TESTPAGE_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-BBE0005A
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_docs = new clsGridmfi_docs("", $MainPage);
$mfi_docsSearch = new clsRecordmfi_docsSearch("", $MainPage);
$MainPage->mfi_docs = & $mfi_docs;
$MainPage->mfi_docsSearch = & $mfi_docsSearch;
$mfi_docs->Initialize();

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

//Execute Components @1-99235C90
$mfi_docsSearch->Operation();
//End Execute Components

//Go to destination page @1-70D2A103
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_docs);
    unset($mfi_docsSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7F4F4F61
$mfi_docs->Show();
$mfi_docsSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5F96CCD9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_docs);
unset($mfi_docsSearch);
unset($Tpl);
//End Unload Page


?>
