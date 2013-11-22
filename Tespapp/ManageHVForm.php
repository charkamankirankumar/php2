<?php
//Include Common Files @1-8489F332
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ManageHVForm.php");
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

//Class_Initialize Event @83-B61DB662
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
        }
    }
//End Class_Initialize Event

//Validate Method @83-F7E64BF7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_added_by->Validate() && $Validation);
        $Validation = ($this->s_added_at->Validate() && $Validation);
        $Validation = ($this->s_mfi_hvf1_no->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_added_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_added_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_hvf1_no->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @83-A06C6EBB
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_added_by->Errors->Count());
        $errors = ($errors || $this->s_added_at->Errors->Count());
        $errors = ($errors || $this->s_mfi_hvf1_no->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @83-498BDCE5
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
        $Redirect = "ManageHVForm.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ManageHVForm.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @83-E715B919
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End cbodataentry_mfi_hvf1 Class @83-FCB6E20C

class clsGridmfi_hvf1_mfi_hvf2 { //mfi_hvf1_mfi_hvf2 class @88-A13195FC

//Variables @88-8977FA14

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
    public $Sorter_mfi_hvf1_no;
    public $Sorter_mfi_hvf1_customer_name;
    public $Sorter_mfi_hvf1_customer_father_name;
    public $Sorter_mfi_hvf1_customer_occupation;
    public $Sorter_mfi_hvf1_customer_mobile_no;
    public $Sorter_mfi_hvf1_customer_voter_id;
    public $Sorter_mfi_hvf1_customer_ration_card_id;
    public $Sorter_mfi_hvf1_customer_guarantor_relationship;
    public $Sorter_mfi_hvf1_customer_guarantor_name;
    public $Sorter_mfi_hvf2_customer_business_cashflow_monthly_receipts_total;
    public $Sorter_mfi_hvf2_customer_business_cashflow_monthly_payments_total;
    public $Sorter_mfi_hvf2_customer_expenses_monthly_total;
    public $Sorter_mfi_hvf2_customer_expenses_annual_seasonal_total;
    public $Sorter_added_at;
//End Variables

//Class_Initialize Event @88-C4E979BC
    function clsGridmfi_hvf1_mfi_hvf2($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_hvf1_mfi_hvf2";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_hvf1_mfi_hvf2";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_hvf1_mfi_hvf2DataSource($this);
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
        $this->SorterName = CCGetParam("mfi_hvf1_mfi_hvf2Order", "");
        $this->SorterDirection = CCGetParam("mfi_hvf1_mfi_hvf2Dir", "");

        $this->mfi_hvf1_no = new clsControl(ccsLabel, "mfi_hvf1_no", "mfi_hvf1_no", ccsText, "", CCGetRequestParam("mfi_hvf1_no", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_name = new clsControl(ccsLabel, "mfi_hvf1_customer_name", "mfi_hvf1_customer_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_father_name = new clsControl(ccsLabel, "mfi_hvf1_customer_father_name", "mfi_hvf1_customer_father_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_father_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_occupation = new clsControl(ccsLabel, "mfi_hvf1_customer_occupation", "mfi_hvf1_customer_occupation", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_occupation", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_mobile_no = new clsControl(ccsLabel, "mfi_hvf1_customer_mobile_no", "mfi_hvf1_customer_mobile_no", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_mobile_no", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_voter_id = new clsControl(ccsLabel, "mfi_hvf1_customer_voter_id", "mfi_hvf1_customer_voter_id", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_voter_id", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_guarantor_relationship = new clsControl(ccsLabel, "mfi_hvf1_customer_guarantor_relationship", "mfi_hvf1_customer_guarantor_relationship", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_guarantor_relationship", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_guarantor_name = new clsControl(ccsLabel, "mfi_hvf1_customer_guarantor_name", "mfi_hvf1_customer_guarantor_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_guarantor_name", ccsGet, NULL), $this);
        $this->added_at = new clsControl(ccsLabel, "added_at", "added_at", ccsText, "", CCGetRequestParam("added_at", ccsGet, NULL), $this);
        $this->mfi_hvf1_mfi_hvf2_TotalRecords = new clsControl(ccsLabel, "mfi_hvf1_mfi_hvf2_TotalRecords", "mfi_hvf1_mfi_hvf2_TotalRecords", ccsText, "", CCGetRequestParam("mfi_hvf1_mfi_hvf2_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_mfi_hvf1_no = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_no", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_name = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_name", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_father_name = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_father_name", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_occupation = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_occupation", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_mobile_no = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_mobile_no", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_voter_id = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_voter_id", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_ration_card_id = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_ration_card_id", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_guarantor_relationship = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_guarantor_relationship", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_guarantor_name = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_guarantor_name", $FileName, $this);
        $this->Sorter_mfi_hvf2_customer_business_cashflow_monthly_receipts_total = new clsSorter($this->ComponentName, "Sorter_mfi_hvf2_customer_business_cashflow_monthly_receipts_total", $FileName, $this);
        $this->Sorter_mfi_hvf2_customer_business_cashflow_monthly_payments_total = new clsSorter($this->ComponentName, "Sorter_mfi_hvf2_customer_business_cashflow_monthly_payments_total", $FileName, $this);
        $this->Sorter_mfi_hvf2_customer_expenses_monthly_total = new clsSorter($this->ComponentName, "Sorter_mfi_hvf2_customer_expenses_monthly_total", $FileName, $this);
        $this->Sorter_mfi_hvf2_customer_expenses_annual_seasonal_total = new clsSorter($this->ComponentName, "Sorter_mfi_hvf2_customer_expenses_annual_seasonal_total", $FileName, $this);
        $this->Sorter_added_at = new clsSorter($this->ComponentName, "Sorter_added_at", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @88-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @88-82484F8B
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

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
            $this->ControlsVisible["mfi_hvf1_no"] = $this->mfi_hvf1_no->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_name"] = $this->mfi_hvf1_customer_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_father_name"] = $this->mfi_hvf1_customer_father_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_occupation"] = $this->mfi_hvf1_customer_occupation->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_mobile_no"] = $this->mfi_hvf1_customer_mobile_no->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_voter_id"] = $this->mfi_hvf1_customer_voter_id->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_guarantor_relationship"] = $this->mfi_hvf1_customer_guarantor_relationship->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_guarantor_name"] = $this->mfi_hvf1_customer_guarantor_name->Visible;
            $this->ControlsVisible["added_at"] = $this->added_at->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mfi_hvf1_no->SetValue($this->DataSource->mfi_hvf1_no->GetValue());
                $this->mfi_hvf1_customer_name->SetValue($this->DataSource->mfi_hvf1_customer_name->GetValue());
                $this->mfi_hvf1_customer_father_name->SetValue($this->DataSource->mfi_hvf1_customer_father_name->GetValue());
                $this->mfi_hvf1_customer_occupation->SetValue($this->DataSource->mfi_hvf1_customer_occupation->GetValue());
                $this->mfi_hvf1_customer_mobile_no->SetValue($this->DataSource->mfi_hvf1_customer_mobile_no->GetValue());
                $this->mfi_hvf1_customer_voter_id->SetValue($this->DataSource->mfi_hvf1_customer_voter_id->GetValue());
                $this->mfi_hvf1_customer_guarantor_relationship->SetValue($this->DataSource->mfi_hvf1_customer_guarantor_relationship->GetValue());
                $this->mfi_hvf1_customer_guarantor_name->SetValue($this->DataSource->mfi_hvf1_customer_guarantor_name->GetValue());
                $this->added_at->SetValue($this->DataSource->added_at->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_hvf1_no->Show();
                $this->mfi_hvf1_customer_name->Show();
                $this->mfi_hvf1_customer_father_name->Show();
                $this->mfi_hvf1_customer_occupation->Show();
                $this->mfi_hvf1_customer_mobile_no->Show();
                $this->mfi_hvf1_customer_voter_id->Show();
                $this->mfi_hvf1_customer_guarantor_relationship->Show();
                $this->mfi_hvf1_customer_guarantor_name->Show();
                $this->added_at->Show();
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
        $this->mfi_hvf1_mfi_hvf2_TotalRecords->Show();
        $this->Sorter_mfi_hvf1_no->Show();
        $this->Sorter_mfi_hvf1_customer_name->Show();
        $this->Sorter_mfi_hvf1_customer_father_name->Show();
        $this->Sorter_mfi_hvf1_customer_occupation->Show();
        $this->Sorter_mfi_hvf1_customer_mobile_no->Show();
        $this->Sorter_mfi_hvf1_customer_voter_id->Show();
        $this->Sorter_mfi_hvf1_customer_ration_card_id->Show();
        $this->Sorter_mfi_hvf1_customer_guarantor_relationship->Show();
        $this->Sorter_mfi_hvf1_customer_guarantor_name->Show();
        $this->Sorter_mfi_hvf2_customer_business_cashflow_monthly_receipts_total->Show();
        $this->Sorter_mfi_hvf2_customer_business_cashflow_monthly_payments_total->Show();
        $this->Sorter_mfi_hvf2_customer_expenses_monthly_total->Show();
        $this->Sorter_mfi_hvf2_customer_expenses_annual_seasonal_total->Show();
        $this->Sorter_added_at->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @88-84DC0713
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_hvf1_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_father_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_occupation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_mobile_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_voter_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_guarantor_relationship->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_guarantor_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->added_at->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_hvf1_mfi_hvf2 Class @88-FCB6E20C

class clsmfi_hvf1_mfi_hvf2DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf1_mfi_hvf2DataSource Class @88-68135EA4

//DataSource Variables @88-F006B29A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_hvf1_no;
    public $mfi_hvf1_customer_name;
    public $mfi_hvf1_customer_father_name;
    public $mfi_hvf1_customer_occupation;
    public $mfi_hvf1_customer_mobile_no;
    public $mfi_hvf1_customer_voter_id;
    public $mfi_hvf1_customer_guarantor_relationship;
    public $mfi_hvf1_customer_guarantor_name;
    public $added_at;
//End DataSource Variables

//DataSourceClass_Initialize Event @88-DB4AB0BD
    function clsmfi_hvf1_mfi_hvf2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_hvf1_mfi_hvf2";
        $this->Initialize();
        $this->mfi_hvf1_no = new clsField("mfi_hvf1_no", ccsText, "");
        
        $this->mfi_hvf1_customer_name = new clsField("mfi_hvf1_customer_name", ccsText, "");
        
        $this->mfi_hvf1_customer_father_name = new clsField("mfi_hvf1_customer_father_name", ccsText, "");
        
        $this->mfi_hvf1_customer_occupation = new clsField("mfi_hvf1_customer_occupation", ccsText, "");
        
        $this->mfi_hvf1_customer_mobile_no = new clsField("mfi_hvf1_customer_mobile_no", ccsInteger, "");
        
        $this->mfi_hvf1_customer_voter_id = new clsField("mfi_hvf1_customer_voter_id", ccsText, "");
        
        $this->mfi_hvf1_customer_guarantor_relationship = new clsField("mfi_hvf1_customer_guarantor_relationship", ccsText, "");
        
        $this->mfi_hvf1_customer_guarantor_name = new clsField("mfi_hvf1_customer_guarantor_name", ccsText, "");
        
        $this->added_at = new clsField("added_at", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @88-7E3E1ECA
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "mfi_hvf1.la_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mfi_hvf1_no" => array("mfi_hvf1_no", ""), 
            "Sorter_mfi_hvf1_customer_name" => array("mfi_hvf1_customer_name", ""), 
            "Sorter_mfi_hvf1_customer_father_name" => array("mfi_hvf1_customer_father_name", ""), 
            "Sorter_mfi_hvf1_customer_occupation" => array("mfi_hvf1_customer_occupation", ""), 
            "Sorter_mfi_hvf1_customer_mobile_no" => array("mfi_hvf1_customer_mobile_no", ""), 
            "Sorter_mfi_hvf1_customer_voter_id" => array("mfi_hvf1_customer_voter_id", ""), 
            "Sorter_mfi_hvf1_customer_ration_card_id" => array("mfi_hvf1_customer_ration_card_id", ""), 
            "Sorter_mfi_hvf1_customer_guarantor_relationship" => array("mfi_hvf1_customer_guarantor_relationship", ""), 
            "Sorter_mfi_hvf1_customer_guarantor_name" => array("mfi_hvf1_customer_guarantor_name", ""), 
            "Sorter_mfi_hvf2_customer_business_cashflow_monthly_receipts_total" => array("mfi_hvf2_customer_business_cashflow_monthly_receipts_total", ""), 
            "Sorter_mfi_hvf2_customer_business_cashflow_monthly_payments_total" => array("mfi_hvf2_customer_business_cashflow_monthly_payments_total", ""), 
            "Sorter_mfi_hvf2_customer_expenses_monthly_total" => array("mfi_hvf2_customer_expenses_monthly_total", ""), 
            "Sorter_mfi_hvf2_customer_expenses_annual_seasonal_total" => array("mfi_hvf2_customer_expenses_annual_seasonal_total", ""), 
            "Sorter_added_at" => array("added_at", "")));
    }
//End SetOrder Method

//Prepare Method @88-1AC26D95
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urls_mfi_hvf1_no", ccsText, "", "", $this->Parameters["urls_mfi_hvf1_no"], "", false);
        $this->wp->Criterion[1] = "( mfi_hvf1.la_id=mfi_hvf2.la_id )";
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "mfi_hvf1.la_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @88-DB7B6C8D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id";
        $this->SQL = "SELECT mfi_hvf1_customer_name, mfi_hvf1_customer_father_name, mfi_hvf1_customer_occupation, mfi_hvf1_customer_mobile_no, mfi_hvf1.la_id AS mfi_hvf1_la_id,\n\n" .
        "mfi_hvf2_customer_guarantor_type, mfi_hvf2_customer_guarantor_name, mfi_hvf1_customer_kyc_id_no \n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @88-A369073B
    function SetValues()
    {
        $this->mfi_hvf1_no->SetDBValue($this->f("mfi_hvf1_la_id"));
        $this->mfi_hvf1_customer_name->SetDBValue($this->f("mfi_hvf1_customer_name"));
        $this->mfi_hvf1_customer_father_name->SetDBValue($this->f("mfi_hvf1_customer_father_name"));
        $this->mfi_hvf1_customer_occupation->SetDBValue($this->f("mfi_hvf1_customer_occupation"));
        $this->mfi_hvf1_customer_mobile_no->SetDBValue(trim($this->f("mfi_hvf1_customer_mobile_no")));
        $this->mfi_hvf1_customer_voter_id->SetDBValue($this->f("mfi_hvf1_customer_kyc_id_no"));
        $this->mfi_hvf1_customer_guarantor_relationship->SetDBValue($this->f("mfi_hvf2_customer_guarantor_type"));
        $this->mfi_hvf1_customer_guarantor_name->SetDBValue($this->f("mfi_hvf2_customer_guarantor_name"));
        $this->added_at->SetDBValue($this->f("added_at"));
    }
//End SetValues Method

} //End mfi_hvf1_mfi_hvf2DataSource Class @88-FCB6E20C

//Initialize Page @1-18F1A75C
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
$TemplateFileName = "ManageHVForm.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D4191998
include_once("./ManageHVForm_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C1F8AFA8
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
$Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link1->Page = "modalHV1.php";
$cbodataentry_mfi_hvf1 = new clsRecordcbodataentry_mfi_hvf1("", $MainPage);
$mfi_hvf1_mfi_hvf2 = new clsGridmfi_hvf1_mfi_hvf2("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$MainPage->incMenu = & $incMenu;
$MainPage->Link1 = & $Link1;
$MainPage->cbodataentry_mfi_hvf1 = & $cbodataentry_mfi_hvf1;
$MainPage->mfi_hvf1_mfi_hvf2 = & $mfi_hvf1_mfi_hvf2;
$mfi_hvf1_mfi_hvf2->Initialize();

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

//Go to destination page @1-60959BCF
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
    unset($cbodataentry_mfi_hvf1);
    unset($mfi_hvf1_mfi_hvf2);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-711E9F51
$incHeader->Show();
$incFooter->Show();
$incMenu->Show();
$cbodataentry_mfi_hvf1->Show();
$mfi_hvf1_mfi_hvf2->Show();
$Link1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-077CEF56
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
unset($cbodataentry_mfi_hvf1);
unset($mfi_hvf1_mfi_hvf2);
unset($Tpl);
//End Unload Page


?>
