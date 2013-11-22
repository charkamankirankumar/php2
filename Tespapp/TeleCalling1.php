<?php
//Include Common Files @1-FAA529EF
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "TeleCalling1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmfi_tc_individualcheck { //mfi_tc_individualcheck Class @91-842578AB

//Variables @91-9E315808

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

//Class_Initialize Event @91-7E097004
    function clsRecordmfi_tc_individualcheck($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_tc_individualcheck/Error";
        $this->DataSource = new clsmfi_tc_individualcheckDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_tc_individualcheck";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->mfi_tc_hvf_no = new clsControl(ccsHidden, "mfi_tc_hvf_no", "Mfi Tc Hvf No", ccsText, "", CCGetRequestParam("mfi_tc_hvf_no", $Method, NULL), $this);
            $this->mfi_tc_hvf_no->Required = true;
            $this->mfi_tc_call_attempt = new clsControl(ccsHidden, "mfi_tc_call_attempt", "Mfi Tc Call Attempt", ccsText, "", CCGetRequestParam("mfi_tc_call_attempt", $Method, NULL), $this);
            $this->mfi_tc_call_attempt->Required = true;
            $this->mfi_tc_call_log = new clsControl(ccsHidden, "mfi_tc_call_log", "Mfi Tc Call Log", ccsText, "", CCGetRequestParam("mfi_tc_call_log", $Method, NULL), $this);
            $this->mfi_tc_b1_ans = new clsControl(ccsHidden, "mfi_tc_b1_ans", "Mfi Tc B1 Ans", ccsText, "", CCGetRequestParam("mfi_tc_b1_ans", $Method, NULL), $this);
            $this->mfi_tc_b2_ans = new clsControl(ccsHidden, "mfi_tc_b2_ans", "Mfi Tc_ B2 Ans", ccsText, "", CCGetRequestParam("mfi_tc_b2_ans", $Method, NULL), $this);
            $this->mfi_tc_b3_ans = new clsControl(ccsHidden, "mfi_tc_b3_ans", "Mfi Tc B3 Ans", ccsText, "", CCGetRequestParam("mfi_tc_b3_ans", $Method, NULL), $this);
            $this->mfi_tc_b4_ans = new clsControl(ccsHidden, "mfi_tc_b4_ans", "Mfi Tc B4 Ans", ccsText, "", CCGetRequestParam("mfi_tc_b4_ans", $Method, NULL), $this);
            $this->mfi_tc_b5_ans = new clsControl(ccsHidden, "mfi_tc_b5_ans", "Mfi Tc B5 Ans", ccsText, "", CCGetRequestParam("mfi_tc_b5_ans", $Method, NULL), $this);
            $this->mfi_tc_1_ans = new clsControl(ccsHidden, "mfi_tc_1_ans", "Mfi Tc 1 Ans", ccsText, "", CCGetRequestParam("mfi_tc_1_ans", $Method, NULL), $this);
            $this->mfi_tc_2_ans = new clsControl(ccsHidden, "mfi_tc_2_ans", "Mfi Tc 2 Ans", ccsText, "", CCGetRequestParam("mfi_tc_2_ans", $Method, NULL), $this);
            $this->mfi_tc_3_ans = new clsControl(ccsHidden, "mfi_tc_3_ans", "Mfi Tc 3 Ans", ccsText, "", CCGetRequestParam("mfi_tc_3_ans", $Method, NULL), $this);
            $this->mfi_tc_4_ans = new clsControl(ccsHidden, "mfi_tc_4_ans", "Mfi Tc 4 Ans", ccsText, "", CCGetRequestParam("mfi_tc_4_ans", $Method, NULL), $this);
            $this->mfi_tc_5_ans = new clsControl(ccsHidden, "mfi_tc_5_ans", "Mfi Tc 5 Ans", ccsText, "", CCGetRequestParam("mfi_tc_5_ans", $Method, NULL), $this);
            $this->mfi_tc_6_ans = new clsControl(ccsHidden, "mfi_tc_6_ans", "Mfi Tc 6 Ans", ccsText, "", CCGetRequestParam("mfi_tc_6_ans", $Method, NULL), $this);
            $this->mfi_tc_7_ans = new clsControl(ccsHidden, "mfi_tc_7_ans", "Mfi Tc 7 Ans", ccsText, "", CCGetRequestParam("mfi_tc_7_ans", $Method, NULL), $this);
            $this->mfi_tc_8_ans = new clsControl(ccsHidden, "mfi_tc_8_ans", "Mfi Tc 8 Ans", ccsText, "", CCGetRequestParam("mfi_tc_8_ans", $Method, NULL), $this);
            $this->mfi_tc_9_ans = new clsControl(ccsHidden, "mfi_tc_9_ans", "Mfi Tc 9 Ans", ccsText, "", CCGetRequestParam("mfi_tc_9_ans", $Method, NULL), $this);
            $this->mfi_tc_10_ans = new clsControl(ccsHidden, "mfi_tc_10_ans", "Mfi Tc 10 Ans", ccsText, "", CCGetRequestParam("mfi_tc_10_ans", $Method, NULL), $this);
            $this->mfi_tc_11_ans = new clsControl(ccsHidden, "mfi_tc_11_ans", "Mfi Tc 11 Ans", ccsText, "", CCGetRequestParam("mfi_tc_11_ans", $Method, NULL), $this);
            $this->mfi_region_name = new clsControl(ccsHidden, "mfi_region_name", "Mfi Region Name", ccsText, "", CCGetRequestParam("mfi_region_name", $Method, NULL), $this);
            $this->mfi_center_name = new clsControl(ccsHidden, "mfi_center_name", "Mfi Center Name", ccsText, "", CCGetRequestParam("mfi_center_name", $Method, NULL), $this);
            $this->mfi_group_name = new clsControl(ccsHidden, "mfi_group_name", "Mfi Group Name", ccsText, "", CCGetRequestParam("mfi_group_name", $Method, NULL), $this);
            $this->called_by = new clsControl(ccsHidden, "called_by", "Called By", ccsText, "", CCGetRequestParam("called_by", $Method, NULL), $this);
            $this->called_by->Required = true;
            $this->called_at = new clsControl(ccsHidden, "called_at", "Called At", ccsDate, $DefaultDateFormat, CCGetRequestParam("called_at", $Method, NULL), $this);
            $this->mfi_interest_details = new clsControl(ccsHidden, "mfi_interest_details", "Mfi Interest Details", ccsText, "", CCGetRequestParam("mfi_interest_details", $Method, NULL), $this);
            $this->tc_individual_check_status = new clsControl(ccsListBox, "tc_individual_check_status", "Tc Individual Check Status", ccsText, "", CCGetRequestParam("tc_individual_check_status", $Method, NULL), $this);
            $this->tc_individual_check_status->DSType = dsListOfValues;
            $this->tc_individual_check_status->Values = array(array("SANCTIONED", "SANCTION"), array("IA Check", "IA Check"), array("PENDING", "PENDING"), array("REJECTED", "REJECTION"));
            $this->tc_ic_rejection_details = new clsControl(ccsTextArea, "tc_ic_rejection_details", "Tc Ic Rejection Details", ccsText, "", CCGetRequestParam("tc_ic_rejection_details", $Method, NULL), $this);
            $this->Hidden1 = new clsControl(ccsHidden, "Hidden1", "Hidden1", ccsText, "", CCGetRequestParam("Hidden1", $Method, NULL), $this);
            $this->Hidden2 = new clsControl(ccsHidden, "Hidden2", "Hidden2", ccsText, "", CCGetRequestParam("Hidden2", $Method, NULL), $this);
            $this->Hidden3 = new clsControl(ccsHidden, "Hidden3", "Hidden3", ccsText, "", CCGetRequestParam("Hidden3", $Method, NULL), $this);
            $this->Hidden4 = new clsControl(ccsHidden, "Hidden4", "Hidden4", ccsText, "", CCGetRequestParam("Hidden4", $Method, NULL), $this);
            $this->Hidden5 = new clsControl(ccsHidden, "Hidden5", "Hidden5", ccsText, "", CCGetRequestParam("Hidden5", $Method, NULL), $this);
            $this->Hidden6 = new clsControl(ccsHidden, "Hidden6", "Hidden6", ccsText, "", CCGetRequestParam("Hidden6", $Method, NULL), $this);
            $this->Hidden7 = new clsControl(ccsHidden, "Hidden7", "Hidden7", ccsText, "", CCGetRequestParam("Hidden7", $Method, NULL), $this);
            $this->Hidden8 = new clsControl(ccsHidden, "Hidden8", "Hidden8", ccsText, "", CCGetRequestParam("Hidden8", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @91-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @91-8D78DF69
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->Hidden6->GetText()) && !preg_match ("/^\d{10}$/", $this->Hidden6->GetText())) {
            $this->Hidden6->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Hidden6"));
        }
        $Validation = ($this->mfi_tc_hvf_no->Validate() && $Validation);
        $Validation = ($this->mfi_tc_call_attempt->Validate() && $Validation);
        $Validation = ($this->mfi_tc_call_log->Validate() && $Validation);
        $Validation = ($this->mfi_tc_b1_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_b2_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_b3_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_b4_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_b5_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_1_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_2_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_3_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_4_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_5_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_6_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_7_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_8_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_9_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_10_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_11_ans->Validate() && $Validation);
        $Validation = ($this->mfi_region_name->Validate() && $Validation);
        $Validation = ($this->mfi_center_name->Validate() && $Validation);
        $Validation = ($this->mfi_group_name->Validate() && $Validation);
        $Validation = ($this->called_by->Validate() && $Validation);
        $Validation = ($this->called_at->Validate() && $Validation);
        $Validation = ($this->mfi_interest_details->Validate() && $Validation);
        $Validation = ($this->tc_individual_check_status->Validate() && $Validation);
        $Validation = ($this->tc_ic_rejection_details->Validate() && $Validation);
        $Validation = ($this->Hidden1->Validate() && $Validation);
        $Validation = ($this->Hidden2->Validate() && $Validation);
        $Validation = ($this->Hidden3->Validate() && $Validation);
        $Validation = ($this->Hidden4->Validate() && $Validation);
        $Validation = ($this->Hidden5->Validate() && $Validation);
        $Validation = ($this->Hidden6->Validate() && $Validation);
        $Validation = ($this->Hidden7->Validate() && $Validation);
        $Validation = ($this->Hidden8->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_tc_hvf_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_call_attempt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_call_log->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_b1_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_b2_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_b3_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_b4_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_b5_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_1_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_2_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_3_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_4_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_5_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_6_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_7_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_8_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_9_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_10_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_11_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_region_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_center_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_group_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->called_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->called_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_interest_details->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tc_individual_check_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tc_ic_rejection_details->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden6->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden7->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden8->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @91-BC6A2789
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_tc_hvf_no->Errors->Count());
        $errors = ($errors || $this->mfi_tc_call_attempt->Errors->Count());
        $errors = ($errors || $this->mfi_tc_call_log->Errors->Count());
        $errors = ($errors || $this->mfi_tc_b1_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_b2_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_b3_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_b4_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_b5_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_1_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_2_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_3_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_4_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_5_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_6_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_7_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_8_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_9_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_10_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_11_ans->Errors->Count());
        $errors = ($errors || $this->mfi_region_name->Errors->Count());
        $errors = ($errors || $this->mfi_center_name->Errors->Count());
        $errors = ($errors || $this->mfi_group_name->Errors->Count());
        $errors = ($errors || $this->called_by->Errors->Count());
        $errors = ($errors || $this->called_at->Errors->Count());
        $errors = ($errors || $this->mfi_interest_details->Errors->Count());
        $errors = ($errors || $this->tc_individual_check_status->Errors->Count());
        $errors = ($errors || $this->tc_ic_rejection_details->Errors->Count());
        $errors = ($errors || $this->Hidden1->Errors->Count());
        $errors = ($errors || $this->Hidden2->Errors->Count());
        $errors = ($errors || $this->Hidden3->Errors->Count());
        $errors = ($errors || $this->Hidden4->Errors->Count());
        $errors = ($errors || $this->Hidden5->Errors->Count());
        $errors = ($errors || $this->Hidden6->Errors->Count());
        $errors = ($errors || $this->Hidden7->Errors->Count());
        $errors = ($errors || $this->Hidden8->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @91-F62CEE75
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @91-FE839A20
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->mfi_tc_hvf_no->SetValue($this->mfi_tc_hvf_no->GetValue(true));
        $this->DataSource->mfi_tc_call_attempt->SetValue($this->mfi_tc_call_attempt->GetValue(true));
        $this->DataSource->mfi_tc_call_log->SetValue($this->mfi_tc_call_log->GetValue(true));
        $this->DataSource->mfi_tc_b1_ans->SetValue($this->mfi_tc_b1_ans->GetValue(true));
        $this->DataSource->mfi_tc_b2_ans->SetValue($this->mfi_tc_b2_ans->GetValue(true));
        $this->DataSource->mfi_tc_b3_ans->SetValue($this->mfi_tc_b3_ans->GetValue(true));
        $this->DataSource->mfi_tc_b4_ans->SetValue($this->mfi_tc_b4_ans->GetValue(true));
        $this->DataSource->mfi_tc_b5_ans->SetValue($this->mfi_tc_b5_ans->GetValue(true));
        $this->DataSource->mfi_tc_1_ans->SetValue($this->mfi_tc_1_ans->GetValue(true));
        $this->DataSource->mfi_tc_2_ans->SetValue($this->mfi_tc_2_ans->GetValue(true));
        $this->DataSource->mfi_tc_3_ans->SetValue($this->mfi_tc_3_ans->GetValue(true));
        $this->DataSource->mfi_tc_4_ans->SetValue($this->mfi_tc_4_ans->GetValue(true));
        $this->DataSource->mfi_tc_5_ans->SetValue($this->mfi_tc_5_ans->GetValue(true));
        $this->DataSource->mfi_tc_6_ans->SetValue($this->mfi_tc_6_ans->GetValue(true));
        $this->DataSource->mfi_tc_7_ans->SetValue($this->mfi_tc_7_ans->GetValue(true));
        $this->DataSource->mfi_tc_8_ans->SetValue($this->mfi_tc_8_ans->GetValue(true));
        $this->DataSource->mfi_tc_9_ans->SetValue($this->mfi_tc_9_ans->GetValue(true));
        $this->DataSource->mfi_tc_10_ans->SetValue($this->mfi_tc_10_ans->GetValue(true));
        $this->DataSource->mfi_tc_11_ans->SetValue($this->mfi_tc_11_ans->GetValue(true));
        $this->DataSource->mfi_region_name->SetValue($this->mfi_region_name->GetValue(true));
        $this->DataSource->mfi_center_name->SetValue($this->mfi_center_name->GetValue(true));
        $this->DataSource->mfi_group_name->SetValue($this->mfi_group_name->GetValue(true));
        $this->DataSource->called_by->SetValue($this->called_by->GetValue(true));
        $this->DataSource->called_at->SetValue($this->called_at->GetValue(true));
        $this->DataSource->mfi_interest_details->SetValue($this->mfi_interest_details->GetValue(true));
        $this->DataSource->tc_individual_check_status->SetValue($this->tc_individual_check_status->GetValue(true));
        $this->DataSource->tc_ic_rejection_details->SetValue($this->tc_ic_rejection_details->GetValue(true));
        $this->DataSource->Hidden1->SetValue($this->Hidden1->GetValue(true));
        $this->DataSource->Hidden2->SetValue($this->Hidden2->GetValue(true));
        $this->DataSource->Hidden3->SetValue($this->Hidden3->GetValue(true));
        $this->DataSource->Hidden4->SetValue($this->Hidden4->GetValue(true));
        $this->DataSource->Hidden5->SetValue($this->Hidden5->GetValue(true));
        $this->DataSource->Hidden6->SetValue($this->Hidden6->GetValue(true));
        $this->DataSource->Hidden7->SetValue($this->Hidden7->GetValue(true));
        $this->DataSource->Hidden8->SetValue($this->Hidden8->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @91-2CCDE6EE
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

        $this->tc_individual_check_status->Prepare();

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
                    $this->mfi_tc_hvf_no->SetValue($this->DataSource->mfi_tc_hvf_no->GetValue());
                    $this->mfi_tc_call_attempt->SetValue($this->DataSource->mfi_tc_call_attempt->GetValue());
                    $this->mfi_tc_call_log->SetValue($this->DataSource->mfi_tc_call_log->GetValue());
                    $this->mfi_tc_b1_ans->SetValue($this->DataSource->mfi_tc_b1_ans->GetValue());
                    $this->mfi_tc_b2_ans->SetValue($this->DataSource->mfi_tc_b2_ans->GetValue());
                    $this->mfi_tc_b3_ans->SetValue($this->DataSource->mfi_tc_b3_ans->GetValue());
                    $this->mfi_tc_b4_ans->SetValue($this->DataSource->mfi_tc_b4_ans->GetValue());
                    $this->mfi_tc_b5_ans->SetValue($this->DataSource->mfi_tc_b5_ans->GetValue());
                    $this->mfi_tc_1_ans->SetValue($this->DataSource->mfi_tc_1_ans->GetValue());
                    $this->mfi_tc_2_ans->SetValue($this->DataSource->mfi_tc_2_ans->GetValue());
                    $this->mfi_tc_3_ans->SetValue($this->DataSource->mfi_tc_3_ans->GetValue());
                    $this->mfi_tc_4_ans->SetValue($this->DataSource->mfi_tc_4_ans->GetValue());
                    $this->mfi_tc_5_ans->SetValue($this->DataSource->mfi_tc_5_ans->GetValue());
                    $this->mfi_tc_6_ans->SetValue($this->DataSource->mfi_tc_6_ans->GetValue());
                    $this->mfi_tc_7_ans->SetValue($this->DataSource->mfi_tc_7_ans->GetValue());
                    $this->mfi_tc_8_ans->SetValue($this->DataSource->mfi_tc_8_ans->GetValue());
                    $this->mfi_tc_9_ans->SetValue($this->DataSource->mfi_tc_9_ans->GetValue());
                    $this->mfi_tc_10_ans->SetValue($this->DataSource->mfi_tc_10_ans->GetValue());
                    $this->mfi_tc_11_ans->SetValue($this->DataSource->mfi_tc_11_ans->GetValue());
                    $this->mfi_region_name->SetValue($this->DataSource->mfi_region_name->GetValue());
                    $this->mfi_center_name->SetValue($this->DataSource->mfi_center_name->GetValue());
                    $this->mfi_group_name->SetValue($this->DataSource->mfi_group_name->GetValue());
                    $this->called_by->SetValue($this->DataSource->called_by->GetValue());
                    $this->mfi_interest_details->SetValue($this->DataSource->mfi_interest_details->GetValue());
                    $this->tc_individual_check_status->SetValue($this->DataSource->tc_individual_check_status->GetValue());
                    $this->tc_ic_rejection_details->SetValue($this->DataSource->tc_ic_rejection_details->GetValue());
                    $this->Hidden2->SetValue($this->DataSource->Hidden2->GetValue());
                    $this->Hidden3->SetValue($this->DataSource->Hidden3->GetValue());
                    $this->Hidden4->SetValue($this->DataSource->Hidden4->GetValue());
                    $this->Hidden5->SetValue($this->DataSource->Hidden5->GetValue());
                    $this->Hidden6->SetValue($this->DataSource->Hidden6->GetValue());
                    $this->Hidden7->SetValue($this->DataSource->Hidden7->GetValue());
                    $this->Hidden8->SetValue($this->DataSource->Hidden8->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_tc_hvf_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_call_attempt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_call_log->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_b1_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_b2_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_b3_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_b4_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_b5_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_1_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_2_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_3_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_4_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_5_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_6_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_7_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_8_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_9_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_10_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_11_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_region_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_center_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_group_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->called_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->called_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_interest_details->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tc_individual_check_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tc_ic_rejection_details->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden7->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden8->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->mfi_tc_hvf_no->Show();
        $this->mfi_tc_call_attempt->Show();
        $this->mfi_tc_call_log->Show();
        $this->mfi_tc_b1_ans->Show();
        $this->mfi_tc_b2_ans->Show();
        $this->mfi_tc_b3_ans->Show();
        $this->mfi_tc_b4_ans->Show();
        $this->mfi_tc_b5_ans->Show();
        $this->mfi_tc_1_ans->Show();
        $this->mfi_tc_2_ans->Show();
        $this->mfi_tc_3_ans->Show();
        $this->mfi_tc_4_ans->Show();
        $this->mfi_tc_5_ans->Show();
        $this->mfi_tc_6_ans->Show();
        $this->mfi_tc_7_ans->Show();
        $this->mfi_tc_8_ans->Show();
        $this->mfi_tc_9_ans->Show();
        $this->mfi_tc_10_ans->Show();
        $this->mfi_tc_11_ans->Show();
        $this->mfi_region_name->Show();
        $this->mfi_center_name->Show();
        $this->mfi_group_name->Show();
        $this->called_by->Show();
        $this->called_at->Show();
        $this->mfi_interest_details->Show();
        $this->tc_individual_check_status->Show();
        $this->tc_ic_rejection_details->Show();
        $this->Hidden1->Show();
        $this->Hidden2->Show();
        $this->Hidden3->Show();
        $this->Hidden4->Show();
        $this->Hidden5->Show();
        $this->Hidden6->Show();
        $this->Hidden7->Show();
        $this->Hidden8->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_tc_individualcheck Class @91-FCB6E20C

class clsmfi_tc_individualcheckDataSource extends clsDBmysql_cams_v2 {  //mfi_tc_individualcheckDataSource Class @91-03E967B7

//DataSource Variables @91-C6FBC499
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();

    // Datasource fields
    public $mfi_tc_hvf_no;
    public $mfi_tc_call_attempt;
    public $mfi_tc_call_log;
    public $mfi_tc_b1_ans;
    public $mfi_tc_b2_ans;
    public $mfi_tc_b3_ans;
    public $mfi_tc_b4_ans;
    public $mfi_tc_b5_ans;
    public $mfi_tc_1_ans;
    public $mfi_tc_2_ans;
    public $mfi_tc_3_ans;
    public $mfi_tc_4_ans;
    public $mfi_tc_5_ans;
    public $mfi_tc_6_ans;
    public $mfi_tc_7_ans;
    public $mfi_tc_8_ans;
    public $mfi_tc_9_ans;
    public $mfi_tc_10_ans;
    public $mfi_tc_11_ans;
    public $mfi_region_name;
    public $mfi_center_name;
    public $mfi_group_name;
    public $called_by;
    public $called_at;
    public $mfi_interest_details;
    public $tc_individual_check_status;
    public $tc_ic_rejection_details;
    public $Hidden1;
    public $Hidden2;
    public $Hidden3;
    public $Hidden4;
    public $Hidden5;
    public $Hidden6;
    public $Hidden7;
    public $Hidden8;
//End DataSource Variables

//DataSourceClass_Initialize Event @91-5BC2C420
    function clsmfi_tc_individualcheckDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_tc_individualcheck/Error";
        $this->Initialize();
        $this->mfi_tc_hvf_no = new clsField("mfi_tc_hvf_no", ccsText, "");
        
        $this->mfi_tc_call_attempt = new clsField("mfi_tc_call_attempt", ccsText, "");
        
        $this->mfi_tc_call_log = new clsField("mfi_tc_call_log", ccsText, "");
        
        $this->mfi_tc_b1_ans = new clsField("mfi_tc_b1_ans", ccsText, "");
        
        $this->mfi_tc_b2_ans = new clsField("mfi_tc_b2_ans", ccsText, "");
        
        $this->mfi_tc_b3_ans = new clsField("mfi_tc_b3_ans", ccsText, "");
        
        $this->mfi_tc_b4_ans = new clsField("mfi_tc_b4_ans", ccsText, "");
        
        $this->mfi_tc_b5_ans = new clsField("mfi_tc_b5_ans", ccsText, "");
        
        $this->mfi_tc_1_ans = new clsField("mfi_tc_1_ans", ccsText, "");
        
        $this->mfi_tc_2_ans = new clsField("mfi_tc_2_ans", ccsText, "");
        
        $this->mfi_tc_3_ans = new clsField("mfi_tc_3_ans", ccsText, "");
        
        $this->mfi_tc_4_ans = new clsField("mfi_tc_4_ans", ccsText, "");
        
        $this->mfi_tc_5_ans = new clsField("mfi_tc_5_ans", ccsText, "");
        
        $this->mfi_tc_6_ans = new clsField("mfi_tc_6_ans", ccsText, "");
        
        $this->mfi_tc_7_ans = new clsField("mfi_tc_7_ans", ccsText, "");
        
        $this->mfi_tc_8_ans = new clsField("mfi_tc_8_ans", ccsText, "");
        
        $this->mfi_tc_9_ans = new clsField("mfi_tc_9_ans", ccsText, "");
        
        $this->mfi_tc_10_ans = new clsField("mfi_tc_10_ans", ccsText, "");
        
        $this->mfi_tc_11_ans = new clsField("mfi_tc_11_ans", ccsText, "");
        
        $this->mfi_region_name = new clsField("mfi_region_name", ccsText, "");
        
        $this->mfi_center_name = new clsField("mfi_center_name", ccsText, "");
        
        $this->mfi_group_name = new clsField("mfi_group_name", ccsText, "");
        
        $this->called_by = new clsField("called_by", ccsText, "");
        
        $this->called_at = new clsField("called_at", ccsDate, $this->DateFormat);
        
        $this->mfi_interest_details = new clsField("mfi_interest_details", ccsText, "");
        
        $this->tc_individual_check_status = new clsField("tc_individual_check_status", ccsText, "");
        
        $this->tc_ic_rejection_details = new clsField("tc_ic_rejection_details", ccsText, "");
        
        $this->Hidden1 = new clsField("Hidden1", ccsText, "");
        
        $this->Hidden2 = new clsField("Hidden2", ccsText, "");
        
        $this->Hidden3 = new clsField("Hidden3", ccsText, "");
        
        $this->Hidden4 = new clsField("Hidden4", ccsText, "");
        
        $this->Hidden5 = new clsField("Hidden5", ccsText, "");
        
        $this->Hidden6 = new clsField("Hidden6", ccsText, "");
        
        $this->Hidden7 = new clsField("Hidden7", ccsText, "");
        
        $this->Hidden8 = new clsField("Hidden8", ccsText, "");
        

        $this->InsertFields["la_id"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_call_attempt"] = array("Name" => "mfi_tc_call_attempt", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_call_log"] = array("Name" => "mfi_tc_call_log", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b1_ans"] = array("Name" => "mfi_tc_b1_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_ b2_ans"] = array("Name" => "mfi_tc_ b2_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b3_ans"] = array("Name" => "mfi_tc_b3_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b4_ans"] = array("Name" => "mfi_tc_b4_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b5_ans"] = array("Name" => "mfi_tc_b5_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_1_ans"] = array("Name" => "mfi_tc_1_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_2_ans"] = array("Name" => "mfi_tc_2_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_3_ans"] = array("Name" => "mfi_tc_3_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_4_ans"] = array("Name" => "mfi_tc_4_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_5_ans"] = array("Name" => "mfi_tc_5_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_6_ans"] = array("Name" => "mfi_tc_6_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_7_ans"] = array("Name" => "mfi_tc_7_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_8_ans"] = array("Name" => "mfi_tc_8_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_9_ans"] = array("Name" => "mfi_tc_9_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_10_ans"] = array("Name" => "mfi_tc_10_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_11_ans"] = array("Name" => "mfi_tc_11_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_region_name"] = array("Name" => "mfi_region_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_center_name"] = array("Name" => "mfi_center_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_group_id"] = array("Name" => "mfi_group_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["called_by"] = array("Name" => "called_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_interest_details"] = array("Name" => "mfi_interest_details", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tc_individual_check_status"] = array("Name" => "tc_individual_check_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tc_ic_rejection_details"] = array("Name" => "tc_ic_rejection_details", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_borrower_name"] = array("Name" => "mfi_borrower_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_group_name"] = array("Name" => "mfi_group_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_customer_mobile_no"] = array("Name" => "mfi_customer_mobile_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_mobile_status"] = array("Name" => "mfi_mobile_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_incoming_mobile_no"] = array("Name" => "mfi_incoming_mobile_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_customer_relationship"] = array("Name" => "mfi_customer_relationship", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tc_remarks"] = array("Name" => "tc_remarks", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @91-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @91-93A3DE18
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_tc_individualcheck {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @91-945B22B1
    function SetValues()
    {
        $this->mfi_tc_hvf_no->SetDBValue($this->f("la_id"));
        $this->mfi_tc_call_attempt->SetDBValue($this->f("mfi_tc_call_attempt"));
        $this->mfi_tc_call_log->SetDBValue($this->f("mfi_tc_call_log"));
        $this->mfi_tc_b1_ans->SetDBValue($this->f("mfi_tc_b1_ans"));
        $this->mfi_tc_b2_ans->SetDBValue($this->f("mfi_tc_ b2_ans"));
        $this->mfi_tc_b3_ans->SetDBValue($this->f("mfi_tc_b3_ans"));
        $this->mfi_tc_b4_ans->SetDBValue($this->f("mfi_tc_b4_ans"));
        $this->mfi_tc_b5_ans->SetDBValue($this->f("mfi_tc_b5_ans"));
        $this->mfi_tc_1_ans->SetDBValue($this->f("mfi_tc_1_ans"));
        $this->mfi_tc_2_ans->SetDBValue($this->f("mfi_tc_2_ans"));
        $this->mfi_tc_3_ans->SetDBValue($this->f("mfi_tc_3_ans"));
        $this->mfi_tc_4_ans->SetDBValue($this->f("mfi_tc_4_ans"));
        $this->mfi_tc_5_ans->SetDBValue($this->f("mfi_tc_5_ans"));
        $this->mfi_tc_6_ans->SetDBValue($this->f("mfi_tc_6_ans"));
        $this->mfi_tc_7_ans->SetDBValue($this->f("mfi_tc_7_ans"));
        $this->mfi_tc_8_ans->SetDBValue($this->f("mfi_tc_8_ans"));
        $this->mfi_tc_9_ans->SetDBValue($this->f("mfi_tc_9_ans"));
        $this->mfi_tc_10_ans->SetDBValue($this->f("mfi_tc_10_ans"));
        $this->mfi_tc_11_ans->SetDBValue($this->f("mfi_tc_11_ans"));
        $this->mfi_region_name->SetDBValue($this->f("mfi_region_name"));
        $this->mfi_center_name->SetDBValue($this->f("mfi_center_name"));
        $this->mfi_group_name->SetDBValue($this->f("mfi_group_id"));
        $this->called_by->SetDBValue($this->f("called_by"));
        $this->mfi_interest_details->SetDBValue($this->f("mfi_interest_details"));
        $this->tc_individual_check_status->SetDBValue($this->f("tc_individual_check_status"));
        $this->tc_ic_rejection_details->SetDBValue($this->f("tc_ic_rejection_details"));
        $this->Hidden2->SetDBValue($this->f("mfi_borrower_name"));
        $this->Hidden3->SetDBValue($this->f("mfi_group_name"));
        $this->Hidden4->SetDBValue($this->f("mfi_customer_mobile_no"));
        $this->Hidden5->SetDBValue($this->f("mfi_mobile_status"));
        $this->Hidden6->SetDBValue($this->f("mfi_incoming_mobile_no"));
        $this->Hidden7->SetDBValue($this->f("mfi_customer_relationship"));
        $this->Hidden8->SetDBValue($this->f("tc_remarks"));
    }
//End SetValues Method

//Insert Method @91-52BFED00
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["la_id"]["Value"] = $this->mfi_tc_hvf_no->GetDBValue(true);
        $this->InsertFields["mfi_tc_call_attempt"]["Value"] = $this->mfi_tc_call_attempt->GetDBValue(true);
        $this->InsertFields["mfi_tc_call_log"]["Value"] = $this->mfi_tc_call_log->GetDBValue(true);
        $this->InsertFields["mfi_tc_b1_ans"]["Value"] = $this->mfi_tc_b1_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_ b2_ans"]["Value"] = $this->mfi_tc_b2_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_b3_ans"]["Value"] = $this->mfi_tc_b3_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_b4_ans"]["Value"] = $this->mfi_tc_b4_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_b5_ans"]["Value"] = $this->mfi_tc_b5_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_1_ans"]["Value"] = $this->mfi_tc_1_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_2_ans"]["Value"] = $this->mfi_tc_2_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_3_ans"]["Value"] = $this->mfi_tc_3_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_4_ans"]["Value"] = $this->mfi_tc_4_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_5_ans"]["Value"] = $this->mfi_tc_5_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_6_ans"]["Value"] = $this->mfi_tc_6_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_7_ans"]["Value"] = $this->mfi_tc_7_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_8_ans"]["Value"] = $this->mfi_tc_8_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_9_ans"]["Value"] = $this->mfi_tc_9_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_10_ans"]["Value"] = $this->mfi_tc_10_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_11_ans"]["Value"] = $this->mfi_tc_11_ans->GetDBValue(true);
        $this->InsertFields["mfi_region_name"]["Value"] = $this->mfi_region_name->GetDBValue(true);
        $this->InsertFields["mfi_center_name"]["Value"] = $this->mfi_center_name->GetDBValue(true);
        $this->InsertFields["mfi_group_id"]["Value"] = $this->mfi_group_name->GetDBValue(true);
        $this->InsertFields["called_by"]["Value"] = $this->called_by->GetDBValue(true);
        $this->InsertFields["mfi_interest_details"]["Value"] = $this->mfi_interest_details->GetDBValue(true);
        $this->InsertFields["tc_individual_check_status"]["Value"] = $this->tc_individual_check_status->GetDBValue(true);
        $this->InsertFields["tc_ic_rejection_details"]["Value"] = $this->tc_ic_rejection_details->GetDBValue(true);
        $this->InsertFields["mfi_borrower_name"]["Value"] = $this->Hidden2->GetDBValue(true);
        $this->InsertFields["mfi_group_name"]["Value"] = $this->Hidden3->GetDBValue(true);
        $this->InsertFields["mfi_customer_mobile_no"]["Value"] = $this->Hidden4->GetDBValue(true);
        $this->InsertFields["mfi_mobile_status"]["Value"] = $this->Hidden5->GetDBValue(true);
        $this->InsertFields["mfi_incoming_mobile_no"]["Value"] = $this->Hidden6->GetDBValue(true);
        $this->InsertFields["mfi_customer_relationship"]["Value"] = $this->Hidden7->GetDBValue(true);
        $this->InsertFields["tc_remarks"]["Value"] = $this->Hidden8->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_tc_individualcheck", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End mfi_tc_individualcheckDataSource Class @91-FCB6E20C

class clsRecordgac { //gac Class @152-A738F666

//Variables @152-9E315808

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

//Class_Initialize Event @152-76FFA294
    function clsRecordgac($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record gac/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "gac";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button1 = new clsButton("Button1", $Method, $this);
            $this->Hidden1 = new clsControl(ccsHidden, "Hidden1", "Hidden1", ccsText, "", CCGetRequestParam("Hidden1", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @152-C6C7E76C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Hidden1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Hidden1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @152-FC5AA71B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Hidden1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @152-22F60C1B
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
        $Redirect = $FileName;
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

//Show Method @152-1CB129FC
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
            $Error = ComposeStrings($Error, $this->Hidden1->Errors->ToString());
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

        $this->Button1->Show();
        $this->Hidden1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End gac Class @152-FCB6E20C

class clsRecordGpbtn { //Gpbtn Class @156-F3C55B0E

//Variables @156-9E315808

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

//Class_Initialize Event @156-C35F2911
    function clsRecordGpbtn($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Gpbtn/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Gpbtn";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button1 = new clsButton("Button1", $Method, $this);
            $this->TextBox1 = new clsControl(ccsHidden, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @156-9E64F189
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->TextBox1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->TextBox1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @156-3FD86859
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->TextBox1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @156-DE5BDEFB
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

//Show Method @156-92E0C612
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

        $this->Button1->Show();
        $this->TextBox1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Gpbtn Class @156-FCB6E20C

class clsGridmfi_hvf1_mfi_hvf2_mfi_hvf { //mfi_hvf1_mfi_hvf2_mfi_hvf class @2-41C453D0

//Variables @2-6E51DF5A

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

//Class_Initialize Event @2-6AA61A0D
    function clsGridmfi_hvf1_mfi_hvf2_mfi_hvf($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_hvf1_mfi_hvf2_mfi_hvf";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_hvf1_mfi_hvf2_mfi_hvf";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_hvf1_mfi_hvf2_mfi_hvfDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 1;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->TextBox1 = new clsControl(ccsTextBox, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", ccsGet, NULL), $this);
        $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", ccsGet, NULL), $this);
        $this->ListBox1->DSType = dsListOfValues;
        $this->ListBox1->Values = array(array("CONNECTED", "CONNECTED"), array("SWITCHED OFF", "SWITCHED OFF"), array("NOT REACHABLE", "NOT REACHABLE"), array("MEMBER NOT PRESENT", "MEMBER NOT PRESENT"), array("INVALID NO", "INVALID NO"), array("NUMBER NOT MENTIONED", "NUMBER NOT MENTIONED"), array("WRONG NUMBER", "WRONG NUMBER"), array("NOT ANSWERED", "NOT ANSWERED"));
        $this->mfi_hvf1_customer_name = new clsControl(ccsTextBox, "mfi_hvf1_customer_name", "mfi_hvf1_customer_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_name", ccsGet, NULL), $this);
        $this->Label1 = new clsControl(ccsTextBox, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_name1 = new clsControl(ccsLabel, "mfi_hvf1_customer_name1", "mfi_hvf1_customer_name1", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_name1", ccsGet, NULL), $this);
        $this->ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", ccsGet, NULL), $this);
        $this->ListBox2->DSType = dsListOfValues;
        $this->ListBox2->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_customer_age_years = new clsControl(ccsLabel, "mfi_hvf1_customer_age_years", "mfi_hvf1_customer_age_years", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_age_years", ccsGet, NULL), $this);
        $this->ListBox3 = new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", ccsGet, NULL), $this);
        $this->ListBox3->DSType = dsListOfValues;
        $this->ListBox3->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_customer_father_name = new clsControl(ccsLabel, "mfi_hvf1_customer_father_name", "mfi_hvf1_customer_father_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_father_name", ccsGet, NULL), $this);
        $this->ListBox4 = new clsControl(ccsListBox, "ListBox4", "ListBox4", ccsText, "", CCGetRequestParam("ListBox4", ccsGet, NULL), $this);
        $this->ListBox4->DSType = dsListOfValues;
        $this->ListBox4->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_customer_guarantor_name = new clsControl(ccsLabel, "mfi_hvf1_customer_guarantor_name", "mfi_hvf1_customer_guarantor_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_guarantor_name", ccsGet, NULL), $this);
        $this->ListBox5 = new clsControl(ccsListBox, "ListBox5", "ListBox5", ccsText, "", CCGetRequestParam("ListBox5", ccsGet, NULL), $this);
        $this->ListBox5->DSType = dsListOfValues;
        $this->ListBox5->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_mfi_gp_proposed_group_name = new clsControl(ccsLabel, "mfi_hvf1_mfi_gp_proposed_group_name", "mfi_hvf1_mfi_gp_proposed_group_name", ccsText, "", CCGetRequestParam("mfi_hvf1_mfi_gp_proposed_group_name", ccsGet, NULL), $this);
        $this->ListBox6 = new clsControl(ccsListBox, "ListBox6", "ListBox6", ccsText, "", CCGetRequestParam("ListBox6", ccsGet, NULL), $this);
        $this->ListBox6->DSType = dsListOfValues;
        $this->ListBox6->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_customer_current_address1 = new clsControl(ccsLabel, "mfi_hvf1_customer_current_address1", "mfi_hvf1_customer_current_address1", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_current_address1", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_residence_years = new clsControl(ccsLabel, "mfi_hvf1_customer_residence_years", "mfi_hvf1_customer_residence_years", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_residence_years", ccsGet, NULL), $this);
        $this->ListBox7 = new clsControl(ccsListBox, "ListBox7", "ListBox7", ccsText, "", CCGetRequestParam("ListBox7", ccsGet, NULL), $this);
        $this->ListBox7->DSType = dsListOfValues;
        $this->ListBox7->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_customer_occupation = new clsControl(ccsLabel, "mfi_hvf1_customer_occupation", "mfi_hvf1_customer_occupation", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_occupation", ccsGet, NULL), $this);
        $this->ListBox8 = new clsControl(ccsListBox, "ListBox8", "ListBox8", ccsText, "", CCGetRequestParam("ListBox8", ccsGet, NULL), $this);
        $this->ListBox8->DSType = dsListOfValues;
        $this->ListBox8->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_loan_amount = new clsControl(ccsLabel, "mfi_hvf1_loan_amount", "mfi_hvf1_loan_amount", ccsInteger, "", CCGetRequestParam("mfi_hvf1_loan_amount", ccsGet, NULL), $this);
        $this->ListBox12 = new clsControl(ccsListBox, "ListBox12", "ListBox12", ccsText, "", CCGetRequestParam("ListBox12", ccsGet, NULL), $this);
        $this->ListBox12->DSType = dsListOfValues;
        $this->ListBox12->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_loan_purpose = new clsControl(ccsLabel, "mfi_hvf1_loan_purpose", "mfi_hvf1_loan_purpose", ccsText, "", CCGetRequestParam("mfi_hvf1_loan_purpose", ccsGet, NULL), $this);
        $this->ListBox13 = new clsControl(ccsListBox, "ListBox13", "ListBox13", ccsText, "", CCGetRequestParam("ListBox13", ccsGet, NULL), $this);
        $this->ListBox13->DSType = dsListOfValues;
        $this->ListBox13->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_co_name = new clsControl(ccsLabel, "mfi_hvf1_co_name", "mfi_hvf1_co_name", ccsText, "", CCGetRequestParam("mfi_hvf1_co_name", ccsGet, NULL), $this);
        $this->ListBox15 = new clsControl(ccsListBox, "ListBox15", "ListBox15", ccsText, "", CCGetRequestParam("ListBox15", ccsGet, NULL), $this);
        $this->ListBox15->DSType = dsListOfValues;
        $this->ListBox15->Values = array(array("CREDIT OFFICER", "CREDIT OFFICER"), array("CANNOT SAY", "CANNOT SAY"), array("NONE", "NONE"), array("SOMEONE I DONOT KNOW", "SOMEONE I DONOT KNOW"));
        $this->ListBox17 = new clsControl(ccsListBox, "ListBox17", "ListBox17", ccsText, "", CCGetRequestParam("ListBox17", ccsGet, NULL), $this);
        $this->ListBox17->DSType = dsListOfValues;
        $this->ListBox17->Values = array(array("NOTHING", "NOTHING"), array("ONLY KYC DOCUMENTS", "ONLY KYC DOCUMENTS"), array("KYC AND PROPERTY PAPERS", "KYC AND PROPERTY PAPERS"), array("MONEY TO PROCESS LOAN", "MONEY TO PROCESS LOAN"), array("PAPERS AND MONEY", "PAPERS AND MONEY"), array("CANNOT SAY", "CANNOT SAY"));
        $this->TextBox2 = new clsControl(ccsTextBox, "TextBox2", "TextBox2", ccsText, "", CCGetRequestParam("TextBox2", ccsGet, NULL), $this);
        $this->ListBox18 = new clsControl(ccsListBox, "ListBox18", "ListBox18", ccsText, "", CCGetRequestParam("ListBox18", ccsGet, NULL), $this);
        $this->ListBox18->DSType = dsListOfValues;
        $this->ListBox18->Values = array(array("Husband", "Husband"), array("Son", "Son"), array("Daughter", "Daughter"), array("Mother", "Mother"), array("Father", "Father"), array("Neighbours", "Neighbours"), array("Region Manager", "Region Manager"), array("Branch Manager", "Branch Manager"), array("DDM", "DDM"));
        $this->TextBox3 = new clsControl(ccsTextBox, "TextBox3", "TextBox3", ccsInteger, "", CCGetRequestParam("TextBox3", ccsGet, NULL), $this);
        $this->CheckBox1 = new clsControl(ccsCheckBox, "CheckBox1", "CheckBox1", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("CheckBox1", ccsGet, NULL), $this);
        $this->CheckBox1->CheckedValue = true;
        $this->CheckBox1->UncheckedValue = false;
        $this->TextBox4 = new clsControl(ccsTextBox, "TextBox4", "TextBox4", ccsText, "", CCGetRequestParam("TextBox4", ccsGet, NULL), $this);
        $this->TextBox5 = new clsControl(ccsTextBox, "TextBox5", "TextBox5", ccsText, "", CCGetRequestParam("TextBox5", ccsGet, NULL), $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
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

//Show Method @2-E291CED7
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlgp_id"] = CCGetFromGet("gp_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->ListBox1->Prepare();
        $this->ListBox2->Prepare();
        $this->ListBox3->Prepare();
        $this->ListBox4->Prepare();
        $this->ListBox5->Prepare();
        $this->ListBox6->Prepare();
        $this->ListBox7->Prepare();
        $this->ListBox8->Prepare();
        $this->ListBox12->Prepare();
        $this->ListBox13->Prepare();
        $this->ListBox15->Prepare();
        $this->ListBox17->Prepare();
        $this->ListBox18->Prepare();

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
            $this->ControlsVisible["TextBox1"] = $this->TextBox1->Visible;
            $this->ControlsVisible["ListBox1"] = $this->ListBox1->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_name"] = $this->mfi_hvf1_customer_name->Visible;
            $this->ControlsVisible["Label1"] = $this->Label1->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_name1"] = $this->mfi_hvf1_customer_name1->Visible;
            $this->ControlsVisible["ListBox2"] = $this->ListBox2->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_age_years"] = $this->mfi_hvf1_customer_age_years->Visible;
            $this->ControlsVisible["ListBox3"] = $this->ListBox3->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_father_name"] = $this->mfi_hvf1_customer_father_name->Visible;
            $this->ControlsVisible["ListBox4"] = $this->ListBox4->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_guarantor_name"] = $this->mfi_hvf1_customer_guarantor_name->Visible;
            $this->ControlsVisible["ListBox5"] = $this->ListBox5->Visible;
            $this->ControlsVisible["mfi_hvf1_mfi_gp_proposed_group_name"] = $this->mfi_hvf1_mfi_gp_proposed_group_name->Visible;
            $this->ControlsVisible["ListBox6"] = $this->ListBox6->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_current_address1"] = $this->mfi_hvf1_customer_current_address1->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_residence_years"] = $this->mfi_hvf1_customer_residence_years->Visible;
            $this->ControlsVisible["ListBox7"] = $this->ListBox7->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_occupation"] = $this->mfi_hvf1_customer_occupation->Visible;
            $this->ControlsVisible["ListBox8"] = $this->ListBox8->Visible;
            $this->ControlsVisible["mfi_hvf1_loan_amount"] = $this->mfi_hvf1_loan_amount->Visible;
            $this->ControlsVisible["ListBox12"] = $this->ListBox12->Visible;
            $this->ControlsVisible["mfi_hvf1_loan_purpose"] = $this->mfi_hvf1_loan_purpose->Visible;
            $this->ControlsVisible["ListBox13"] = $this->ListBox13->Visible;
            $this->ControlsVisible["mfi_hvf1_co_name"] = $this->mfi_hvf1_co_name->Visible;
            $this->ControlsVisible["ListBox15"] = $this->ListBox15->Visible;
            $this->ControlsVisible["ListBox17"] = $this->ListBox17->Visible;
            $this->ControlsVisible["TextBox2"] = $this->TextBox2->Visible;
            $this->ControlsVisible["ListBox18"] = $this->ListBox18->Visible;
            $this->ControlsVisible["TextBox3"] = $this->TextBox3->Visible;
            $this->ControlsVisible["CheckBox1"] = $this->CheckBox1->Visible;
            $this->ControlsVisible["TextBox4"] = $this->TextBox4->Visible;
            $this->ControlsVisible["TextBox5"] = $this->TextBox5->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                if(!is_array($this->CheckBox1->Value) && !strlen($this->CheckBox1->Value) && $this->CheckBox1->Value !== false)
                    $this->CheckBox1->SetValue(false);
                $this->mfi_hvf1_customer_name->SetValue($this->DataSource->mfi_hvf1_customer_name->GetValue());
                $this->Label1->SetValue($this->DataSource->Label1->GetValue());
                $this->mfi_hvf1_customer_name1->SetValue($this->DataSource->mfi_hvf1_customer_name1->GetValue());
                $this->mfi_hvf1_customer_age_years->SetValue($this->DataSource->mfi_hvf1_customer_age_years->GetValue());
                $this->mfi_hvf1_customer_father_name->SetValue($this->DataSource->mfi_hvf1_customer_father_name->GetValue());
                $this->mfi_hvf1_customer_guarantor_name->SetValue($this->DataSource->mfi_hvf1_customer_guarantor_name->GetValue());
                $this->mfi_hvf1_mfi_gp_proposed_group_name->SetValue($this->DataSource->mfi_hvf1_mfi_gp_proposed_group_name->GetValue());
                $this->mfi_hvf1_customer_current_address1->SetValue($this->DataSource->mfi_hvf1_customer_current_address1->GetValue());
                $this->mfi_hvf1_customer_residence_years->SetValue($this->DataSource->mfi_hvf1_customer_residence_years->GetValue());
                $this->mfi_hvf1_customer_occupation->SetValue($this->DataSource->mfi_hvf1_customer_occupation->GetValue());
                $this->mfi_hvf1_loan_amount->SetValue($this->DataSource->mfi_hvf1_loan_amount->GetValue());
                $this->mfi_hvf1_loan_purpose->SetValue($this->DataSource->mfi_hvf1_loan_purpose->GetValue());
                $this->mfi_hvf1_co_name->SetValue($this->DataSource->mfi_hvf1_co_name->GetValue());
                $this->TextBox2->SetValue($this->DataSource->TextBox2->GetValue());
                $this->TextBox4->SetValue($this->DataSource->TextBox4->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->TextBox1->Show();
                $this->ListBox1->Show();
                $this->mfi_hvf1_customer_name->Show();
                $this->Label1->Show();
                $this->mfi_hvf1_customer_name1->Show();
                $this->ListBox2->Show();
                $this->mfi_hvf1_customer_age_years->Show();
                $this->ListBox3->Show();
                $this->mfi_hvf1_customer_father_name->Show();
                $this->ListBox4->Show();
                $this->mfi_hvf1_customer_guarantor_name->Show();
                $this->ListBox5->Show();
                $this->mfi_hvf1_mfi_gp_proposed_group_name->Show();
                $this->ListBox6->Show();
                $this->mfi_hvf1_customer_current_address1->Show();
                $this->mfi_hvf1_customer_residence_years->Show();
                $this->ListBox7->Show();
                $this->mfi_hvf1_customer_occupation->Show();
                $this->ListBox8->Show();
                $this->mfi_hvf1_loan_amount->Show();
                $this->ListBox12->Show();
                $this->mfi_hvf1_loan_purpose->Show();
                $this->ListBox13->Show();
                $this->mfi_hvf1_co_name->Show();
                $this->ListBox15->Show();
                $this->ListBox17->Show();
                $this->TextBox2->Show();
                $this->ListBox18->Show();
                $this->TextBox3->Show();
                $this->CheckBox1->Show();
                $this->TextBox4->Show();
                $this->TextBox5->Show();
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
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-74DB96F4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->TextBox1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_name1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_age_years->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_father_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_guarantor_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_mfi_gp_proposed_group_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox6->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_current_address1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_residence_years->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox7->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_occupation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox8->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_loan_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox12->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_loan_purpose->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox13->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_co_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox15->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox17->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextBox2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox18->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextBox3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextBox4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextBox5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_hvf1_mfi_hvf2_mfi_hvf Class @2-FCB6E20C

class clsmfi_hvf1_mfi_hvf2_mfi_hvfDataSource extends clsDBmysql_cams_v2 {  //mfi_hvf1_mfi_hvf2_mfi_hvfDataSource Class @2-15FAC2BF

//DataSource Variables @2-9399AD04
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_hvf1_customer_name;
    public $Label1;
    public $mfi_hvf1_customer_name1;
    public $mfi_hvf1_customer_age_years;
    public $mfi_hvf1_customer_father_name;
    public $mfi_hvf1_customer_guarantor_name;
    public $mfi_hvf1_mfi_gp_proposed_group_name;
    public $mfi_hvf1_customer_current_address1;
    public $mfi_hvf1_customer_residence_years;
    public $mfi_hvf1_customer_occupation;
    public $mfi_hvf1_loan_amount;
    public $mfi_hvf1_loan_purpose;
    public $mfi_hvf1_co_name;
    public $TextBox2;
    public $TextBox4;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C03F6335
    function clsmfi_hvf1_mfi_hvf2_mfi_hvfDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_hvf1_mfi_hvf2_mfi_hvf";
        $this->Initialize();
        $this->mfi_hvf1_customer_name = new clsField("mfi_hvf1_customer_name", ccsText, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        
        $this->mfi_hvf1_customer_name1 = new clsField("mfi_hvf1_customer_name1", ccsText, "");
        
        $this->mfi_hvf1_customer_age_years = new clsField("mfi_hvf1_customer_age_years", ccsInteger, "");
        
        $this->mfi_hvf1_customer_father_name = new clsField("mfi_hvf1_customer_father_name", ccsText, "");
        
        $this->mfi_hvf1_customer_guarantor_name = new clsField("mfi_hvf1_customer_guarantor_name", ccsText, "");
        
        $this->mfi_hvf1_mfi_gp_proposed_group_name = new clsField("mfi_hvf1_mfi_gp_proposed_group_name", ccsText, "");
        
        $this->mfi_hvf1_customer_current_address1 = new clsField("mfi_hvf1_customer_current_address1", ccsText, "");
        
        $this->mfi_hvf1_customer_residence_years = new clsField("mfi_hvf1_customer_residence_years", ccsInteger, "");
        
        $this->mfi_hvf1_customer_occupation = new clsField("mfi_hvf1_customer_occupation", ccsText, "");
        
        $this->mfi_hvf1_loan_amount = new clsField("mfi_hvf1_loan_amount", ccsInteger, "");
        
        $this->mfi_hvf1_loan_purpose = new clsField("mfi_hvf1_loan_purpose", ccsText, "");
        
        $this->mfi_hvf1_co_name = new clsField("mfi_hvf1_co_name", ccsText, "");
        
        $this->TextBox2 = new clsField("TextBox2", ccsText, "");
        
        $this->TextBox4 = new clsField("TextBox4", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-72EF91FE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgp_id", ccsText, "", "", $this->Parameters["urlgp_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_gp_proposed_group_name", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-C2B79ABE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id";
        $this->SQL = "SELECT * \n\n" .
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

//SetValues Method @2-C3B234B8
    function SetValues()
    {
        $this->mfi_hvf1_customer_name->SetDBValue($this->f("mfi_hvf1_customer_name"));
        $this->Label1->SetDBValue($this->f("mfi_hvf1_customer_mobile_no"));
        $this->mfi_hvf1_customer_name1->SetDBValue($this->f("mfi_hvf1_customer_name"));
        $this->mfi_hvf1_customer_age_years->SetDBValue(trim($this->f("mfi_hvf1_customer_age_years")));
        $this->mfi_hvf1_customer_father_name->SetDBValue($this->f("mfi_hvf1_customer_father_name"));
        $this->mfi_hvf1_customer_guarantor_name->SetDBValue($this->f("mfi_hvf2_customer_guarantor_name"));
        $this->mfi_hvf1_mfi_gp_proposed_group_name->SetDBValue($this->f("mfi_gp_proposed_group_name"));
        $this->mfi_hvf1_customer_current_address1->SetDBValue($this->f("mfi_hvf1_customer_current_address1"));
        $this->mfi_hvf1_customer_residence_years->SetDBValue(trim($this->f("mfi_hvf1_customer_residence_years")));
        $this->mfi_hvf1_customer_occupation->SetDBValue($this->f("mfi_hvf1_customer_occupation"));
        $this->mfi_hvf1_loan_amount->SetDBValue(trim($this->f("mfi_hvf2_loan_amount")));
        $this->mfi_hvf1_loan_purpose->SetDBValue($this->f("mfi_hvf2_loan_purpose"));
        $this->mfi_hvf1_co_name->SetDBValue($this->f("mfi_hvf2_co_name"));
        $this->TextBox2->SetDBValue($this->f("la_id"));
        $this->TextBox4->SetDBValue($this->f("mfi_hvf2_loan_cycle"));
    }
//End SetValues Method

} //End mfi_hvf1_mfi_hvf2_mfi_hvfDataSource Class @2-FCB6E20C





//Initialize Page @1-3391AEFF
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
$TemplateFileName = "TeleCalling1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-4F2D7FA9
include_once("./TeleCalling1_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-70EC76A1
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_tc_individualcheck = new clsRecordmfi_tc_individualcheck("", $MainPage);
$udgapnl = new clsPanel("udgapnl", $MainPage);
$gac = new clsRecordgac("", $MainPage);
$gpudpnl = new clsPanel("gpudpnl", $MainPage);
$Gpbtn = new clsRecordGpbtn("", $MainPage);
$mfi_hvf1_mfi_hvf2_mfi_hvf = new clsGridmfi_hvf1_mfi_hvf2_mfi_hvf("", $MainPage);
$MainPage->mfi_tc_individualcheck = & $mfi_tc_individualcheck;
$MainPage->udgapnl = & $udgapnl;
$MainPage->gac = & $gac;
$MainPage->gpudpnl = & $gpudpnl;
$MainPage->Gpbtn = & $Gpbtn;
$MainPage->mfi_hvf1_mfi_hvf2_mfi_hvf = & $mfi_hvf1_mfi_hvf2_mfi_hvf;
$udgapnl->AddComponent("gac", $gac);
$gpudpnl->AddComponent("Gpbtn", $Gpbtn);
$mfi_tc_individualcheck->Initialize();
$mfi_hvf1_mfi_hvf2_mfi_hvf->Initialize();

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

//Execute Components @1-235D326A
$Gpbtn->Operation();
$gac->Operation();
$mfi_tc_individualcheck->Operation();
//End Execute Components

//Go to destination page @1-96ABDAEB
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_tc_individualcheck);
    unset($gac);
    unset($Gpbtn);
    unset($mfi_hvf1_mfi_hvf2_mfi_hvf);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-07D6350E
$mfi_tc_individualcheck->Show();
$mfi_hvf1_mfi_hvf2_mfi_hvf->Show();
$udgapnl->Show();
$gpudpnl->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-ECA259B7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_tc_individualcheck);
unset($gac);
unset($Gpbtn);
unset($mfi_hvf1_mfi_hvf2_mfi_hvf);
unset($Tpl);
//End Unload Page


?>
