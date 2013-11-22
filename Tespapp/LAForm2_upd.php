<?php
//Include Common Files @1-1CD019F9
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "LAForm2_upd.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsRecordmfi_la2 { //mfi_la2 Class @2-02926F9C

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

//Class_Initialize Event @2-C2706C77
    function clsRecordmfi_la2($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_la2/Error";
        $this->DataSource = new clsmfi_la2DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_la2";
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
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->cbo_verification_result = new clsControl(ccsRadioButton, "cbo_verification_result", "Cbo Verification Result", ccsText, "", CCGetRequestParam("cbo_verification_result", $Method, NULL), $this);
            $this->cbo_verification_result->DSType = dsListOfValues;
            $this->cbo_verification_result->Values = array(array("Sanctioned", "Sanctioned"), array("Rejected", "Rejected"));
            $this->cbo_verification_result->HTML = true;
            $this->bm_sign_date = new clsControl(ccsTextBox, "bm_sign_date", "Date Of Grt", ccsText, "", CCGetRequestParam("bm_sign_date", $Method, NULL), $this);
            $this->bm_emp_code = new clsControl(ccsTextBox, "bm_emp_code", "Bm Emp Code", ccsText, "", CCGetRequestParam("bm_emp_code", $Method, NULL), $this);
            $this->bm_name = new clsControl(ccsTextBox, "bm_name", "bm_name", ccsText, "", CCGetRequestParam("bm_name", $Method, NULL), $this);
            $this->RadioButton1 = new clsControl(ccsRadioButton, "RadioButton1", "RadioButton1", ccsText, "", CCGetRequestParam("RadioButton1", $Method, NULL), $this);
            $this->RadioButton1->DSType = dsListOfValues;
            $this->RadioButton1->Values = array(array("RURAL", "RURAL"), array("URBAN", "URBAN"));
            $this->RadioButton1->HTML = true;
            $this->la_id = new clsControl(ccsTextBox, "la_id", "La Id", ccsText, "", CCGetRequestParam("la_id", $Method, NULL), $this);
            $this->center_name = new clsControl(ccsTextBox, "center_name", "center_name", ccsText, "", CCGetRequestParam("center_name", $Method, NULL), $this);
            $this->cp_id = new clsControl(ccsTextBox, "cp_id", "cp_id", ccsText, "", CCGetRequestParam("cp_id", $Method, NULL), $this);
            $this->group_name = new clsControl(ccsTextBox, "group_name", "group_name", ccsText, "", CCGetRequestParam("group_name", $Method, NULL), $this);
            $this->group_size = new clsControl(ccsTextBox, "group_size", "group_size", ccsText, "", CCGetRequestParam("group_size", $Method, NULL), $this);
            $this->loan_cycle = new clsControl(ccsTextBox, "loan_cycle", "loan_cycle", ccsText, "", CCGetRequestParam("loan_cycle", $Method, NULL), $this);
            $this->loan_amt = new clsControl(ccsListBox, "loan_amt", "loan_amt", ccsText, "", CCGetRequestParam("loan_amt", $Method, NULL), $this);
            $this->loan_amt->DSType = dsListOfValues;
            $this->loan_amt->Values = array(array("15000", "15000"), array("20000", "20000"), array("25000", "25000"), array("30000", "30000"));
            $this->previous_efimo_loan_acc_no = new clsControl(ccsTextBox, "previous_efimo_loan_acc_no", "previous_efimo_loan_acc_no", ccsText, "", CCGetRequestParam("previous_efimo_loan_acc_no", $Method, NULL), $this);
            $this->other_lon_purps = new clsControl(ccsTextBox, "other_lon_purps", "other_lon_purps", ccsText, "", CCGetRequestParam("other_lon_purps", $Method, NULL), $this);
            $this->gurantor_name = new clsControl(ccsTextBox, "gurantor_name", "gurantor_name", ccsText, "", CCGetRequestParam("gurantor_name", $Method, NULL), $this);
            $this->gurantor_kyc_type = new clsControl(ccsTextBox, "gurantor_kyc_type", "gurantor_kyc_type", ccsText, "", CCGetRequestParam("gurantor_kyc_type", $Method, NULL), $this);
            $this->other_gurantor_type = new clsControl(ccsTextBox, "other_gurantor_type", "other_gurantor_type", ccsText, "", CCGetRequestParam("other_gurantor_type", $Method, NULL), $this);
            $this->kyc_number = new clsControl(ccsTextBox, "kyc_number", "kyc_number", ccsText, "", CCGetRequestParam("kyc_number", $Method, NULL), $this);
            $this->gurantor_age = new clsControl(ccsTextBox, "gurantor_age", "gurantor_age", ccsInteger, "", CCGetRequestParam("gurantor_age", $Method, NULL), $this);
            $this->gurantor_mobile = new clsControl(ccsTextBox, "gurantor_mobile", "gurantor_mobile", ccsText, "", CCGetRequestParam("gurantor_mobile", $Method, NULL), $this);
            $this->borrower_ins = new clsControl(ccsTextBox, "borrower_ins", "borrower_ins", ccsText, "", CCGetRequestParam("borrower_ins", $Method, NULL), $this);
            $this->borrower_ins_dob_year = new clsControl(ccsTextBox, "borrower_ins_dob_year", "borrower_ins_dob_year", ccsText, "", CCGetRequestParam("borrower_ins_dob_year", $Method, NULL), $this);
            $this->borrower_nominee_mobile = new clsControl(ccsTextBox, "borrower_nominee_mobile", "borrower_nominee_mobile", ccsText, "", CCGetRequestParam("borrower_nominee_mobile", $Method, NULL), $this);
            $this->gurantor_ins = new clsControl(ccsTextBox, "gurantor_ins", "gurantor_ins", ccsText, "", CCGetRequestParam("gurantor_ins", $Method, NULL), $this);
            $this->gurantor_ins_dob_year = new clsControl(ccsTextBox, "gurantor_ins_dob_year", "gurantor_ins_dob_year", ccsText, "", CCGetRequestParam("gurantor_ins_dob_year", $Method, NULL), $this);
            $this->gurantor_nominee_mobile = new clsControl(ccsTextBox, "gurantor_nominee_mobile", "gurantor_nominee_mobile", ccsText, "", CCGetRequestParam("gurantor_nominee_mobile", $Method, NULL), $this);
            $this->gurantor_signature = new clsControl(ccsTextBox, "gurantor_signature", "gurantor_signature", ccsText, "", CCGetRequestParam("gurantor_signature", $Method, NULL), $this);
            $this->member_signature = new clsControl(ccsTextBox, "member_signature", "member_signature", ccsText, "", CCGetRequestParam("member_signature", $Method, NULL), $this);
            $this->cm_name = new clsControl(ccsTextBox, "cm_name", "cm_name", ccsText, "", CCGetRequestParam("cm_name", $Method, NULL), $this);
            $this->co_emp_cod = new clsControl(ccsTextBox, "co_emp_cod", "co_emp_cod", ccsText, "", CCGetRequestParam("co_emp_cod", $Method, NULL), $this);
            $this->co_sign_date = new clsControl(ccsTextBox, "co_sign_date", "co_sign_date", ccsText, "", CCGetRequestParam("co_sign_date", $Method, NULL), $this);
            $this->cm_sign = new clsControl(ccsTextBox, "cm_sign", "cm_sign", ccsText, "", CCGetRequestParam("cm_sign", $Method, NULL), $this);
            $this->enrollment_no = new clsControl(ccsTextBox, "enrollment_no", "enrollment_no", ccsText, "", CCGetRequestParam("enrollment_no", $Method, NULL), $this);
            $this->efimo_lon_acc_no = new clsControl(ccsTextBox, "efimo_lon_acc_no", "efimo_lon_acc_no", ccsText, "", CCGetRequestParam("efimo_lon_acc_no", $Method, NULL), $this);
            $this->bm_sign = new clsControl(ccsTextBox, "bm_sign", "bm_sign", ccsText, "", CCGetRequestParam("bm_sign", $Method, NULL), $this);
            $this->loan_purps = new clsControl(ccsHidden, "loan_purps", "loan_purps", ccsText, "", CCGetRequestParam("loan_purps", $Method, NULL), $this);
            $this->meeting_freq = new clsControl(ccsHidden, "meeting_freq", "meeting_freq", ccsText, "", CCGetRequestParam("meeting_freq", $Method, NULL), $this);
            $this->gurantor_type = new clsControl(ccsHidden, "gurantor_type", "gurantor_type", ccsText, "", CCGetRequestParam("gurantor_type", $Method, NULL), $this);
            $this->added_by = new clsControl(ccsHidden, "added_by", "added_by", ccsText, "", CCGetRequestParam("added_by", $Method, NULL), $this);
            $this->added_at = new clsControl(ccsHidden, "added_at", "added_at", ccsText, "", CCGetRequestParam("added_at", $Method, NULL), $this);
            $this->updated_by = new clsControl(ccsHidden, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->updated_at = new clsControl(ccsHidden, "updated_at", "updated_at", ccsText, "", CCGetRequestParam("updated_at", $Method, NULL), $this);
            $this->gp_no = new clsControl(ccsHidden, "gp_no", "gp_no", ccsText, "", CCGetRequestParam("gp_no", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-EC40A7BB
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urldoc_code"] = CCGetFromGet("doc_code", NULL);
    }
//End Initialize Method

//Validate Method @2-97B370D4
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->cbo_verification_result->Validate() && $Validation);
        $Validation = ($this->bm_sign_date->Validate() && $Validation);
        $Validation = ($this->bm_emp_code->Validate() && $Validation);
        $Validation = ($this->bm_name->Validate() && $Validation);
        $Validation = ($this->RadioButton1->Validate() && $Validation);
        $Validation = ($this->la_id->Validate() && $Validation);
        $Validation = ($this->center_name->Validate() && $Validation);
        $Validation = ($this->cp_id->Validate() && $Validation);
        $Validation = ($this->group_name->Validate() && $Validation);
        $Validation = ($this->group_size->Validate() && $Validation);
        $Validation = ($this->loan_cycle->Validate() && $Validation);
        $Validation = ($this->loan_amt->Validate() && $Validation);
        $Validation = ($this->previous_efimo_loan_acc_no->Validate() && $Validation);
        $Validation = ($this->other_lon_purps->Validate() && $Validation);
        $Validation = ($this->gurantor_name->Validate() && $Validation);
        $Validation = ($this->gurantor_kyc_type->Validate() && $Validation);
        $Validation = ($this->other_gurantor_type->Validate() && $Validation);
        $Validation = ($this->kyc_number->Validate() && $Validation);
        $Validation = ($this->gurantor_age->Validate() && $Validation);
        $Validation = ($this->gurantor_mobile->Validate() && $Validation);
        $Validation = ($this->borrower_ins->Validate() && $Validation);
        $Validation = ($this->borrower_ins_dob_year->Validate() && $Validation);
        $Validation = ($this->borrower_nominee_mobile->Validate() && $Validation);
        $Validation = ($this->gurantor_ins->Validate() && $Validation);
        $Validation = ($this->gurantor_ins_dob_year->Validate() && $Validation);
        $Validation = ($this->gurantor_nominee_mobile->Validate() && $Validation);
        $Validation = ($this->gurantor_signature->Validate() && $Validation);
        $Validation = ($this->member_signature->Validate() && $Validation);
        $Validation = ($this->cm_name->Validate() && $Validation);
        $Validation = ($this->co_emp_cod->Validate() && $Validation);
        $Validation = ($this->co_sign_date->Validate() && $Validation);
        $Validation = ($this->cm_sign->Validate() && $Validation);
        $Validation = ($this->enrollment_no->Validate() && $Validation);
        $Validation = ($this->efimo_lon_acc_no->Validate() && $Validation);
        $Validation = ($this->bm_sign->Validate() && $Validation);
        $Validation = ($this->loan_purps->Validate() && $Validation);
        $Validation = ($this->meeting_freq->Validate() && $Validation);
        $Validation = ($this->gurantor_type->Validate() && $Validation);
        $Validation = ($this->added_by->Validate() && $Validation);
        $Validation = ($this->added_at->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->updated_at->Validate() && $Validation);
        $Validation = ($this->gp_no->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->cbo_verification_result->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bm_sign_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bm_emp_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bm_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RadioButton1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->la_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->center_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cp_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->group_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->group_size->Errors->Count() == 0);
        $Validation =  $Validation && ($this->loan_cycle->Errors->Count() == 0);
        $Validation =  $Validation && ($this->loan_amt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->previous_efimo_loan_acc_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->other_lon_purps->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_kyc_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->other_gurantor_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_number->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_age->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_mobile->Errors->Count() == 0);
        $Validation =  $Validation && ($this->borrower_ins->Errors->Count() == 0);
        $Validation =  $Validation && ($this->borrower_ins_dob_year->Errors->Count() == 0);
        $Validation =  $Validation && ($this->borrower_nominee_mobile->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_ins->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_ins_dob_year->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_nominee_mobile->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_signature->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_signature->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cm_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->co_emp_cod->Errors->Count() == 0);
        $Validation =  $Validation && ($this->co_sign_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cm_sign->Errors->Count() == 0);
        $Validation =  $Validation && ($this->enrollment_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->efimo_lon_acc_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bm_sign->Errors->Count() == 0);
        $Validation =  $Validation && ($this->loan_purps->Errors->Count() == 0);
        $Validation =  $Validation && ($this->meeting_freq->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gp_no->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-FEE1A5E4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->cbo_verification_result->Errors->Count());
        $errors = ($errors || $this->bm_sign_date->Errors->Count());
        $errors = ($errors || $this->bm_emp_code->Errors->Count());
        $errors = ($errors || $this->bm_name->Errors->Count());
        $errors = ($errors || $this->RadioButton1->Errors->Count());
        $errors = ($errors || $this->la_id->Errors->Count());
        $errors = ($errors || $this->center_name->Errors->Count());
        $errors = ($errors || $this->cp_id->Errors->Count());
        $errors = ($errors || $this->group_name->Errors->Count());
        $errors = ($errors || $this->group_size->Errors->Count());
        $errors = ($errors || $this->loan_cycle->Errors->Count());
        $errors = ($errors || $this->loan_amt->Errors->Count());
        $errors = ($errors || $this->previous_efimo_loan_acc_no->Errors->Count());
        $errors = ($errors || $this->other_lon_purps->Errors->Count());
        $errors = ($errors || $this->gurantor_name->Errors->Count());
        $errors = ($errors || $this->gurantor_kyc_type->Errors->Count());
        $errors = ($errors || $this->other_gurantor_type->Errors->Count());
        $errors = ($errors || $this->kyc_number->Errors->Count());
        $errors = ($errors || $this->gurantor_age->Errors->Count());
        $errors = ($errors || $this->gurantor_mobile->Errors->Count());
        $errors = ($errors || $this->borrower_ins->Errors->Count());
        $errors = ($errors || $this->borrower_ins_dob_year->Errors->Count());
        $errors = ($errors || $this->borrower_nominee_mobile->Errors->Count());
        $errors = ($errors || $this->gurantor_ins->Errors->Count());
        $errors = ($errors || $this->gurantor_ins_dob_year->Errors->Count());
        $errors = ($errors || $this->gurantor_nominee_mobile->Errors->Count());
        $errors = ($errors || $this->gurantor_signature->Errors->Count());
        $errors = ($errors || $this->member_signature->Errors->Count());
        $errors = ($errors || $this->cm_name->Errors->Count());
        $errors = ($errors || $this->co_emp_cod->Errors->Count());
        $errors = ($errors || $this->co_sign_date->Errors->Count());
        $errors = ($errors || $this->cm_sign->Errors->Count());
        $errors = ($errors || $this->enrollment_no->Errors->Count());
        $errors = ($errors || $this->efimo_lon_acc_no->Errors->Count());
        $errors = ($errors || $this->bm_sign->Errors->Count());
        $errors = ($errors || $this->loan_purps->Errors->Count());
        $errors = ($errors || $this->meeting_freq->Errors->Count());
        $errors = ($errors || $this->gurantor_type->Errors->Count());
        $errors = ($errors || $this->added_by->Errors->Count());
        $errors = ($errors || $this->added_at->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->updated_at->Errors->Count());
        $errors = ($errors || $this->gp_no->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-B908BA44
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//InsertRow Method @2-15F6EDBF
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->cbo_verification_result->SetValue($this->cbo_verification_result->GetValue(true));
        $this->DataSource->bm_sign_date->SetValue($this->bm_sign_date->GetValue(true));
        $this->DataSource->bm_emp_code->SetValue($this->bm_emp_code->GetValue(true));
        $this->DataSource->bm_name->SetValue($this->bm_name->GetValue(true));
        $this->DataSource->RadioButton1->SetValue($this->RadioButton1->GetValue(true));
        $this->DataSource->la_id->SetValue($this->la_id->GetValue(true));
        $this->DataSource->center_name->SetValue($this->center_name->GetValue(true));
        $this->DataSource->cp_id->SetValue($this->cp_id->GetValue(true));
        $this->DataSource->group_name->SetValue($this->group_name->GetValue(true));
        $this->DataSource->group_size->SetValue($this->group_size->GetValue(true));
        $this->DataSource->loan_cycle->SetValue($this->loan_cycle->GetValue(true));
        $this->DataSource->loan_amt->SetValue($this->loan_amt->GetValue(true));
        $this->DataSource->previous_efimo_loan_acc_no->SetValue($this->previous_efimo_loan_acc_no->GetValue(true));
        $this->DataSource->other_lon_purps->SetValue($this->other_lon_purps->GetValue(true));
        $this->DataSource->gurantor_name->SetValue($this->gurantor_name->GetValue(true));
        $this->DataSource->gurantor_kyc_type->SetValue($this->gurantor_kyc_type->GetValue(true));
        $this->DataSource->other_gurantor_type->SetValue($this->other_gurantor_type->GetValue(true));
        $this->DataSource->kyc_number->SetValue($this->kyc_number->GetValue(true));
        $this->DataSource->gurantor_age->SetValue($this->gurantor_age->GetValue(true));
        $this->DataSource->gurantor_mobile->SetValue($this->gurantor_mobile->GetValue(true));
        $this->DataSource->borrower_ins->SetValue($this->borrower_ins->GetValue(true));
        $this->DataSource->borrower_ins_dob_year->SetValue($this->borrower_ins_dob_year->GetValue(true));
        $this->DataSource->borrower_nominee_mobile->SetValue($this->borrower_nominee_mobile->GetValue(true));
        $this->DataSource->gurantor_ins->SetValue($this->gurantor_ins->GetValue(true));
        $this->DataSource->gurantor_ins_dob_year->SetValue($this->gurantor_ins_dob_year->GetValue(true));
        $this->DataSource->gurantor_nominee_mobile->SetValue($this->gurantor_nominee_mobile->GetValue(true));
        $this->DataSource->gurantor_signature->SetValue($this->gurantor_signature->GetValue(true));
        $this->DataSource->member_signature->SetValue($this->member_signature->GetValue(true));
        $this->DataSource->cm_name->SetValue($this->cm_name->GetValue(true));
        $this->DataSource->co_emp_cod->SetValue($this->co_emp_cod->GetValue(true));
        $this->DataSource->co_sign_date->SetValue($this->co_sign_date->GetValue(true));
        $this->DataSource->cm_sign->SetValue($this->cm_sign->GetValue(true));
        $this->DataSource->enrollment_no->SetValue($this->enrollment_no->GetValue(true));
        $this->DataSource->efimo_lon_acc_no->SetValue($this->efimo_lon_acc_no->GetValue(true));
        $this->DataSource->bm_sign->SetValue($this->bm_sign->GetValue(true));
        $this->DataSource->loan_purps->SetValue($this->loan_purps->GetValue(true));
        $this->DataSource->meeting_freq->SetValue($this->meeting_freq->GetValue(true));
        $this->DataSource->gurantor_type->SetValue($this->gurantor_type->GetValue(true));
        $this->DataSource->added_by->SetValue($this->added_by->GetValue(true));
        $this->DataSource->added_at->SetValue($this->added_at->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->updated_at->SetValue($this->updated_at->GetValue(true));
        $this->DataSource->gp_no->SetValue($this->gp_no->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-3F5971B9
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->cbo_verification_result->SetValue($this->cbo_verification_result->GetValue(true));
        $this->DataSource->bm_sign_date->SetValue($this->bm_sign_date->GetValue(true));
        $this->DataSource->bm_emp_code->SetValue($this->bm_emp_code->GetValue(true));
        $this->DataSource->bm_name->SetValue($this->bm_name->GetValue(true));
        $this->DataSource->RadioButton1->SetValue($this->RadioButton1->GetValue(true));
        $this->DataSource->la_id->SetValue($this->la_id->GetValue(true));
        $this->DataSource->center_name->SetValue($this->center_name->GetValue(true));
        $this->DataSource->cp_id->SetValue($this->cp_id->GetValue(true));
        $this->DataSource->group_name->SetValue($this->group_name->GetValue(true));
        $this->DataSource->group_size->SetValue($this->group_size->GetValue(true));
        $this->DataSource->loan_cycle->SetValue($this->loan_cycle->GetValue(true));
        $this->DataSource->loan_amt->SetValue($this->loan_amt->GetValue(true));
        $this->DataSource->previous_efimo_loan_acc_no->SetValue($this->previous_efimo_loan_acc_no->GetValue(true));
        $this->DataSource->other_lon_purps->SetValue($this->other_lon_purps->GetValue(true));
        $this->DataSource->gurantor_name->SetValue($this->gurantor_name->GetValue(true));
        $this->DataSource->gurantor_kyc_type->SetValue($this->gurantor_kyc_type->GetValue(true));
        $this->DataSource->other_gurantor_type->SetValue($this->other_gurantor_type->GetValue(true));
        $this->DataSource->kyc_number->SetValue($this->kyc_number->GetValue(true));
        $this->DataSource->gurantor_age->SetValue($this->gurantor_age->GetValue(true));
        $this->DataSource->gurantor_mobile->SetValue($this->gurantor_mobile->GetValue(true));
        $this->DataSource->borrower_ins->SetValue($this->borrower_ins->GetValue(true));
        $this->DataSource->borrower_ins_dob_year->SetValue($this->borrower_ins_dob_year->GetValue(true));
        $this->DataSource->borrower_nominee_mobile->SetValue($this->borrower_nominee_mobile->GetValue(true));
        $this->DataSource->gurantor_ins->SetValue($this->gurantor_ins->GetValue(true));
        $this->DataSource->gurantor_ins_dob_year->SetValue($this->gurantor_ins_dob_year->GetValue(true));
        $this->DataSource->gurantor_nominee_mobile->SetValue($this->gurantor_nominee_mobile->GetValue(true));
        $this->DataSource->gurantor_signature->SetValue($this->gurantor_signature->GetValue(true));
        $this->DataSource->member_signature->SetValue($this->member_signature->GetValue(true));
        $this->DataSource->cm_name->SetValue($this->cm_name->GetValue(true));
        $this->DataSource->co_emp_cod->SetValue($this->co_emp_cod->GetValue(true));
        $this->DataSource->co_sign_date->SetValue($this->co_sign_date->GetValue(true));
        $this->DataSource->cm_sign->SetValue($this->cm_sign->GetValue(true));
        $this->DataSource->enrollment_no->SetValue($this->enrollment_no->GetValue(true));
        $this->DataSource->efimo_lon_acc_no->SetValue($this->efimo_lon_acc_no->GetValue(true));
        $this->DataSource->bm_sign->SetValue($this->bm_sign->GetValue(true));
        $this->DataSource->loan_purps->SetValue($this->loan_purps->GetValue(true));
        $this->DataSource->meeting_freq->SetValue($this->meeting_freq->GetValue(true));
        $this->DataSource->gurantor_type->SetValue($this->gurantor_type->GetValue(true));
        $this->DataSource->added_by->SetValue($this->added_by->GetValue(true));
        $this->DataSource->added_at->SetValue($this->added_at->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->updated_at->SetValue($this->updated_at->GetValue(true));
        $this->DataSource->gp_no->SetValue($this->gp_no->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-82FB0830
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

        $this->cbo_verification_result->Prepare();
        $this->RadioButton1->Prepare();
        $this->loan_amt->Prepare();

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
                    $this->cbo_verification_result->SetValue($this->DataSource->cbo_verification_result->GetValue());
                    $this->bm_sign_date->SetValue($this->DataSource->bm_sign_date->GetValue());
                    $this->bm_emp_code->SetValue($this->DataSource->bm_emp_code->GetValue());
                    $this->bm_name->SetValue($this->DataSource->bm_name->GetValue());
                    $this->RadioButton1->SetValue($this->DataSource->RadioButton1->GetValue());
                    $this->la_id->SetValue($this->DataSource->la_id->GetValue());
                    $this->center_name->SetValue($this->DataSource->center_name->GetValue());
                    $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                    $this->group_name->SetValue($this->DataSource->group_name->GetValue());
                    $this->group_size->SetValue($this->DataSource->group_size->GetValue());
                    $this->loan_cycle->SetValue($this->DataSource->loan_cycle->GetValue());
                    $this->loan_amt->SetValue($this->DataSource->loan_amt->GetValue());
                    $this->previous_efimo_loan_acc_no->SetValue($this->DataSource->previous_efimo_loan_acc_no->GetValue());
                    $this->gurantor_name->SetValue($this->DataSource->gurantor_name->GetValue());
                    $this->gurantor_kyc_type->SetValue($this->DataSource->gurantor_kyc_type->GetValue());
                    $this->kyc_number->SetValue($this->DataSource->kyc_number->GetValue());
                    $this->gurantor_age->SetValue($this->DataSource->gurantor_age->GetValue());
                    $this->gurantor_mobile->SetValue($this->DataSource->gurantor_mobile->GetValue());
                    $this->borrower_ins->SetValue($this->DataSource->borrower_ins->GetValue());
                    $this->borrower_ins_dob_year->SetValue($this->DataSource->borrower_ins_dob_year->GetValue());
                    $this->borrower_nominee_mobile->SetValue($this->DataSource->borrower_nominee_mobile->GetValue());
                    $this->gurantor_ins->SetValue($this->DataSource->gurantor_ins->GetValue());
                    $this->gurantor_ins_dob_year->SetValue($this->DataSource->gurantor_ins_dob_year->GetValue());
                    $this->gurantor_nominee_mobile->SetValue($this->DataSource->gurantor_nominee_mobile->GetValue());
                    $this->gurantor_signature->SetValue($this->DataSource->gurantor_signature->GetValue());
                    $this->member_signature->SetValue($this->DataSource->member_signature->GetValue());
                    $this->cm_name->SetValue($this->DataSource->cm_name->GetValue());
                    $this->co_emp_cod->SetValue($this->DataSource->co_emp_cod->GetValue());
                    $this->co_sign_date->SetValue($this->DataSource->co_sign_date->GetValue());
                    $this->cm_sign->SetValue($this->DataSource->cm_sign->GetValue());
                    $this->enrollment_no->SetValue($this->DataSource->enrollment_no->GetValue());
                    $this->efimo_lon_acc_no->SetValue($this->DataSource->efimo_lon_acc_no->GetValue());
                    $this->bm_sign->SetValue($this->DataSource->bm_sign->GetValue());
                    $this->loan_purps->SetValue($this->DataSource->loan_purps->GetValue());
                    $this->meeting_freq->SetValue($this->DataSource->meeting_freq->GetValue());
                    $this->gurantor_type->SetValue($this->DataSource->gurantor_type->GetValue());
                    $this->added_by->SetValue($this->DataSource->added_by->GetValue());
                    $this->added_at->SetValue($this->DataSource->added_at->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->updated_at->SetValue($this->DataSource->updated_at->GetValue());
                    $this->gp_no->SetValue($this->DataSource->gp_no->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->cbo_verification_result->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bm_sign_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bm_emp_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bm_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RadioButton1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->la_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->center_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cp_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->group_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->group_size->Errors->ToString());
            $Error = ComposeStrings($Error, $this->loan_cycle->Errors->ToString());
            $Error = ComposeStrings($Error, $this->loan_amt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->previous_efimo_loan_acc_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->other_lon_purps->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_kyc_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->other_gurantor_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_number->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_age->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_mobile->Errors->ToString());
            $Error = ComposeStrings($Error, $this->borrower_ins->Errors->ToString());
            $Error = ComposeStrings($Error, $this->borrower_ins_dob_year->Errors->ToString());
            $Error = ComposeStrings($Error, $this->borrower_nominee_mobile->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_ins->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_ins_dob_year->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_nominee_mobile->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_signature->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_signature->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cm_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->co_emp_cod->Errors->ToString());
            $Error = ComposeStrings($Error, $this->co_sign_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cm_sign->Errors->ToString());
            $Error = ComposeStrings($Error, $this->enrollment_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->efimo_lon_acc_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bm_sign->Errors->ToString());
            $Error = ComposeStrings($Error, $this->loan_purps->Errors->ToString());
            $Error = ComposeStrings($Error, $this->meeting_freq->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gp_no->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->cbo_verification_result->Show();
        $this->bm_sign_date->Show();
        $this->bm_emp_code->Show();
        $this->bm_name->Show();
        $this->RadioButton1->Show();
        $this->la_id->Show();
        $this->center_name->Show();
        $this->cp_id->Show();
        $this->group_name->Show();
        $this->group_size->Show();
        $this->loan_cycle->Show();
        $this->loan_amt->Show();
        $this->previous_efimo_loan_acc_no->Show();
        $this->other_lon_purps->Show();
        $this->gurantor_name->Show();
        $this->gurantor_kyc_type->Show();
        $this->other_gurantor_type->Show();
        $this->kyc_number->Show();
        $this->gurantor_age->Show();
        $this->gurantor_mobile->Show();
        $this->borrower_ins->Show();
        $this->borrower_ins_dob_year->Show();
        $this->borrower_nominee_mobile->Show();
        $this->gurantor_ins->Show();
        $this->gurantor_ins_dob_year->Show();
        $this->gurantor_nominee_mobile->Show();
        $this->gurantor_signature->Show();
        $this->member_signature->Show();
        $this->cm_name->Show();
        $this->co_emp_cod->Show();
        $this->co_sign_date->Show();
        $this->cm_sign->Show();
        $this->enrollment_no->Show();
        $this->efimo_lon_acc_no->Show();
        $this->bm_sign->Show();
        $this->loan_purps->Show();
        $this->meeting_freq->Show();
        $this->gurantor_type->Show();
        $this->added_by->Show();
        $this->added_at->Show();
        $this->updated_by->Show();
        $this->updated_at->Show();
        $this->gp_no->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_la2 Class @2-FCB6E20C

class clsmfi_la2DataSource extends clsDBmysql_cams_v2 {  //mfi_la2DataSource Class @2-D08B9F3B

//DataSource Variables @2-EB4CAAF6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $cbo_verification_result;
    public $bm_sign_date;
    public $bm_emp_code;
    public $bm_name;
    public $RadioButton1;
    public $la_id;
    public $center_name;
    public $cp_id;
    public $group_name;
    public $group_size;
    public $loan_cycle;
    public $loan_amt;
    public $previous_efimo_loan_acc_no;
    public $other_lon_purps;
    public $gurantor_name;
    public $gurantor_kyc_type;
    public $other_gurantor_type;
    public $kyc_number;
    public $gurantor_age;
    public $gurantor_mobile;
    public $borrower_ins;
    public $borrower_ins_dob_year;
    public $borrower_nominee_mobile;
    public $gurantor_ins;
    public $gurantor_ins_dob_year;
    public $gurantor_nominee_mobile;
    public $gurantor_signature;
    public $member_signature;
    public $cm_name;
    public $co_emp_cod;
    public $co_sign_date;
    public $cm_sign;
    public $enrollment_no;
    public $efimo_lon_acc_no;
    public $bm_sign;
    public $loan_purps;
    public $meeting_freq;
    public $gurantor_type;
    public $added_by;
    public $added_at;
    public $updated_by;
    public $updated_at;
    public $gp_no;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-CD8D1292
    function clsmfi_la2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_la2/Error";
        $this->Initialize();
        $this->cbo_verification_result = new clsField("cbo_verification_result", ccsText, "");
        
        $this->bm_sign_date = new clsField("bm_sign_date", ccsText, "");
        
        $this->bm_emp_code = new clsField("bm_emp_code", ccsText, "");
        
        $this->bm_name = new clsField("bm_name", ccsText, "");
        
        $this->RadioButton1 = new clsField("RadioButton1", ccsText, "");
        
        $this->la_id = new clsField("la_id", ccsText, "");
        
        $this->center_name = new clsField("center_name", ccsText, "");
        
        $this->cp_id = new clsField("cp_id", ccsText, "");
        
        $this->group_name = new clsField("group_name", ccsText, "");
        
        $this->group_size = new clsField("group_size", ccsText, "");
        
        $this->loan_cycle = new clsField("loan_cycle", ccsText, "");
        
        $this->loan_amt = new clsField("loan_amt", ccsText, "");
        
        $this->previous_efimo_loan_acc_no = new clsField("previous_efimo_loan_acc_no", ccsText, "");
        
        $this->other_lon_purps = new clsField("other_lon_purps", ccsText, "");
        
        $this->gurantor_name = new clsField("gurantor_name", ccsText, "");
        
        $this->gurantor_kyc_type = new clsField("gurantor_kyc_type", ccsText, "");
        
        $this->other_gurantor_type = new clsField("other_gurantor_type", ccsText, "");
        
        $this->kyc_number = new clsField("kyc_number", ccsText, "");
        
        $this->gurantor_age = new clsField("gurantor_age", ccsInteger, "");
        
        $this->gurantor_mobile = new clsField("gurantor_mobile", ccsText, "");
        
        $this->borrower_ins = new clsField("borrower_ins", ccsText, "");
        
        $this->borrower_ins_dob_year = new clsField("borrower_ins_dob_year", ccsText, "");
        
        $this->borrower_nominee_mobile = new clsField("borrower_nominee_mobile", ccsText, "");
        
        $this->gurantor_ins = new clsField("gurantor_ins", ccsText, "");
        
        $this->gurantor_ins_dob_year = new clsField("gurantor_ins_dob_year", ccsText, "");
        
        $this->gurantor_nominee_mobile = new clsField("gurantor_nominee_mobile", ccsText, "");
        
        $this->gurantor_signature = new clsField("gurantor_signature", ccsText, "");
        
        $this->member_signature = new clsField("member_signature", ccsText, "");
        
        $this->cm_name = new clsField("cm_name", ccsText, "");
        
        $this->co_emp_cod = new clsField("co_emp_cod", ccsText, "");
        
        $this->co_sign_date = new clsField("co_sign_date", ccsText, "");
        
        $this->cm_sign = new clsField("cm_sign", ccsText, "");
        
        $this->enrollment_no = new clsField("enrollment_no", ccsText, "");
        
        $this->efimo_lon_acc_no = new clsField("efimo_lon_acc_no", ccsText, "");
        
        $this->bm_sign = new clsField("bm_sign", ccsText, "");
        
        $this->loan_purps = new clsField("loan_purps", ccsText, "");
        
        $this->meeting_freq = new clsField("meeting_freq", ccsText, "");
        
        $this->gurantor_type = new clsField("gurantor_type", ccsText, "");
        
        $this->added_by = new clsField("added_by", ccsText, "");
        
        $this->added_at = new clsField("added_at", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->updated_at = new clsField("updated_at", ccsText, "");
        
        $this->gp_no = new clsField("gp_no", ccsText, "");
        

        $this->InsertFields["mfi_hvf2_verification_result"] = array("Name" => "mfi_hvf2_verification_result", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_bm_date"] = array("Name" => "mfi_hvf2_bm_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_bm_emp_code"] = array("Name" => "mfi_hvf2_bm_emp_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_bm_name"] = array("Name" => "mfi_hvf2_bm_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_rural_urban"] = array("Name" => "mfi_hvf2_rural_urban", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["la_id"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_centre_name"] = array("Name" => "mfi_cp_centre_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cp_id"] = array("Name" => "cp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_gp_proposed_group_name"] = array("Name" => "mfi_gp_proposed_group_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_group_size"] = array("Name" => "mfi_hvf2_group_size", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_loan_cycle"] = array("Name" => "mfi_hvf2_loan_cycle", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_loan_amount"] = array("Name" => "mfi_hvf2_loan_amount", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_last_cycle_efimo_loan_acc_no"] = array("Name" => "mfi_hvf2_last_cycle_efimo_loan_acc_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_customer_guarantor_name"] = array("Name" => "mfi_hvf2_customer_guarantor_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_GUARANTOR_kyc_id_type"] = array("Name" => "mfi_hvf2_GUARANTOR_kyc_id_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_gurantor_kyc_id_no"] = array("Name" => "mfi_hvf2_gurantor_kyc_id_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_customer_guarantor_age"] = array("Name" => "mfi_hvf2_customer_guarantor_age", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_customer_guarantor_mobile"] = array("Name" => "mfi_hvf2_customer_guarantor_mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["borrower_nominee_name"] = array("Name" => "borrower_nominee_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["borrower_nominee_year_birth"] = array("Name" => "borrower_nominee_year_birth", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["borrower_nominee_mobile"] = array("Name" => "borrower_nominee_mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["guarantor_nominee_name"] = array("Name" => "guarantor_nominee_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["guarantor_nominee_year_birth"] = array("Name" => "guarantor_nominee_year_birth", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["guarantor_nominee_mobile"] = array("Name" => "guarantor_nominee_mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_gurantor_signature"] = array("Name" => "mfi_hvf2_gurantor_signature", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_member_signature"] = array("Name" => "mfi_hvf2_member_signature", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_co_name"] = array("Name" => "mfi_hvf2_co_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_co_emp_code"] = array("Name" => "mfi_hvf2_co_emp_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_date"] = array("Name" => "mfi_hvf2_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_co_signature"] = array("Name" => "mfi_hvf2_co_signature", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_alloted_enrollment_no"] = array("Name" => "mfi_hvf2_alloted_enrollment_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_efimo_loan_acc_no"] = array("Name" => "mfi_hvf2_efimo_loan_acc_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_bm_sign"] = array("Name" => "mfi_hvf2_bm_sign", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_loan_purpose"] = array("Name" => "mfi_hvf2_loan_purpose", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_loan_group_meeting_frequency"] = array("Name" => "mfi_hvf2_loan_group_meeting_frequency", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_customer_guarantor_type"] = array("Name" => "mfi_hvf2_customer_guarantor_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_added_by"] = array("Name" => "mfi_hvf2_added_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_added_at"] = array("Name" => "mfi_hvf2_added_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_updated_by"] = array("Name" => "mfi_hvf2_updated_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf2_updated_at"] = array("Name" => "mfi_hvf2_updated_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["gp_id"] = array("Name" => "gp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_verification_result"] = array("Name" => "mfi_hvf2_verification_result", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_bm_date"] = array("Name" => "mfi_hvf2_bm_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_bm_emp_code"] = array("Name" => "mfi_hvf2_bm_emp_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_bm_name"] = array("Name" => "mfi_hvf2_bm_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_rural_urban"] = array("Name" => "mfi_hvf2_rural_urban", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["la_id"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_centre_name"] = array("Name" => "mfi_cp_centre_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cp_id"] = array("Name" => "cp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_gp_proposed_group_name"] = array("Name" => "mfi_gp_proposed_group_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_group_size"] = array("Name" => "mfi_hvf2_group_size", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_loan_cycle"] = array("Name" => "mfi_hvf2_loan_cycle", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_loan_amount"] = array("Name" => "mfi_hvf2_loan_amount", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_last_cycle_efimo_loan_acc_no"] = array("Name" => "mfi_hvf2_last_cycle_efimo_loan_acc_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_customer_guarantor_name"] = array("Name" => "mfi_hvf2_customer_guarantor_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_GUARANTOR_kyc_id_type"] = array("Name" => "mfi_hvf2_GUARANTOR_kyc_id_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_gurantor_kyc_id_no"] = array("Name" => "mfi_hvf2_gurantor_kyc_id_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_customer_guarantor_age"] = array("Name" => "mfi_hvf2_customer_guarantor_age", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_customer_guarantor_mobile"] = array("Name" => "mfi_hvf2_customer_guarantor_mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["borrower_nominee_name"] = array("Name" => "borrower_nominee_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["borrower_nominee_year_birth"] = array("Name" => "borrower_nominee_year_birth", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["borrower_nominee_mobile"] = array("Name" => "borrower_nominee_mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_nominee_name"] = array("Name" => "guarantor_nominee_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_nominee_year_birth"] = array("Name" => "guarantor_nominee_year_birth", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_nominee_mobile"] = array("Name" => "guarantor_nominee_mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_gurantor_signature"] = array("Name" => "mfi_hvf2_gurantor_signature", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_member_signature"] = array("Name" => "mfi_hvf2_member_signature", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_co_name"] = array("Name" => "mfi_hvf2_co_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_co_emp_code"] = array("Name" => "mfi_hvf2_co_emp_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_date"] = array("Name" => "mfi_hvf2_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_co_signature"] = array("Name" => "mfi_hvf2_co_signature", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_alloted_enrollment_no"] = array("Name" => "mfi_hvf2_alloted_enrollment_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_efimo_loan_acc_no"] = array("Name" => "mfi_hvf2_efimo_loan_acc_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_bm_sign"] = array("Name" => "mfi_hvf2_bm_sign", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_loan_purpose"] = array("Name" => "mfi_hvf2_loan_purpose", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_loan_group_meeting_frequency"] = array("Name" => "mfi_hvf2_loan_group_meeting_frequency", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_customer_guarantor_type"] = array("Name" => "mfi_hvf2_customer_guarantor_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_added_by"] = array("Name" => "mfi_hvf2_added_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_added_at"] = array("Name" => "mfi_hvf2_added_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_updated_by"] = array("Name" => "mfi_hvf2_updated_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_updated_at"] = array("Name" => "mfi_hvf2_updated_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gp_id"] = array("Name" => "gp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-2E1DB4A7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urldoc_code", ccsText, "", "", $this->Parameters["urldoc_code"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "la_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-7A53FEE9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_hvf2 {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-1E1CC7C6
    function SetValues()
    {
        $this->cbo_verification_result->SetDBValue($this->f("mfi_hvf2_verification_result"));
        $this->bm_sign_date->SetDBValue($this->f("mfi_hvf2_bm_date"));
        $this->bm_emp_code->SetDBValue($this->f("mfi_hvf2_bm_emp_code"));
        $this->bm_name->SetDBValue($this->f("mfi_hvf2_bm_name"));
        $this->RadioButton1->SetDBValue($this->f("mfi_hvf2_rural_urban"));
        $this->la_id->SetDBValue($this->f("la_id"));
        $this->center_name->SetDBValue($this->f("mfi_cp_centre_name"));
        $this->cp_id->SetDBValue($this->f("cp_id"));
        $this->group_name->SetDBValue($this->f("mfi_gp_proposed_group_name"));
        $this->group_size->SetDBValue($this->f("mfi_hvf2_group_size"));
        $this->loan_cycle->SetDBValue($this->f("mfi_hvf2_loan_cycle"));
        $this->loan_amt->SetDBValue($this->f("mfi_hvf2_loan_amount"));
        $this->previous_efimo_loan_acc_no->SetDBValue($this->f("mfi_hvf2_last_cycle_efimo_loan_acc_no"));
        $this->gurantor_name->SetDBValue($this->f("mfi_hvf2_customer_guarantor_name"));
        $this->gurantor_kyc_type->SetDBValue($this->f("mfi_hvf2_GUARANTOR_kyc_id_type"));
        $this->kyc_number->SetDBValue($this->f("mfi_hvf2_gurantor_kyc_id_no"));
        $this->gurantor_age->SetDBValue(trim($this->f("mfi_hvf2_customer_guarantor_age")));
        $this->gurantor_mobile->SetDBValue($this->f("mfi_hvf2_customer_guarantor_mobile"));
        $this->borrower_ins->SetDBValue($this->f("borrower_nominee_name"));
        $this->borrower_ins_dob_year->SetDBValue($this->f("borrower_nominee_year_birth"));
        $this->borrower_nominee_mobile->SetDBValue($this->f("borrower_nominee_mobile"));
        $this->gurantor_ins->SetDBValue($this->f("guarantor_nominee_name"));
        $this->gurantor_ins_dob_year->SetDBValue($this->f("guarantor_nominee_year_birth"));
        $this->gurantor_nominee_mobile->SetDBValue($this->f("guarantor_nominee_mobile"));
        $this->gurantor_signature->SetDBValue($this->f("mfi_hvf2_gurantor_signature"));
        $this->member_signature->SetDBValue($this->f("mfi_hvf2_member_signature"));
        $this->cm_name->SetDBValue($this->f("mfi_hvf2_co_name"));
        $this->co_emp_cod->SetDBValue($this->f("mfi_hvf2_co_emp_code"));
        $this->co_sign_date->SetDBValue($this->f("mfi_hvf2_date"));
        $this->cm_sign->SetDBValue($this->f("mfi_hvf2_co_signature"));
        $this->enrollment_no->SetDBValue($this->f("mfi_hvf2_alloted_enrollment_no"));
        $this->efimo_lon_acc_no->SetDBValue($this->f("mfi_hvf2_efimo_loan_acc_no"));
        $this->bm_sign->SetDBValue($this->f("mfi_hvf2_bm_sign"));
        $this->loan_purps->SetDBValue($this->f("mfi_hvf2_loan_purpose"));
        $this->meeting_freq->SetDBValue($this->f("mfi_hvf2_loan_group_meeting_frequency"));
        $this->gurantor_type->SetDBValue($this->f("mfi_hvf2_customer_guarantor_type"));
        $this->added_by->SetDBValue($this->f("mfi_hvf2_added_by"));
        $this->added_at->SetDBValue($this->f("mfi_hvf2_added_at"));
        $this->updated_by->SetDBValue($this->f("mfi_hvf2_updated_by"));
        $this->updated_at->SetDBValue($this->f("mfi_hvf2_updated_at"));
        $this->gp_no->SetDBValue($this->f("gp_id"));
    }
//End SetValues Method

//Insert Method @2-1BD2D760
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["mfi_hvf2_verification_result"]["Value"] = $this->cbo_verification_result->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_bm_date"]["Value"] = $this->bm_sign_date->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_bm_emp_code"]["Value"] = $this->bm_emp_code->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_bm_name"]["Value"] = $this->bm_name->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_rural_urban"]["Value"] = $this->RadioButton1->GetDBValue(true);
        $this->InsertFields["la_id"]["Value"] = $this->la_id->GetDBValue(true);
        $this->InsertFields["mfi_cp_centre_name"]["Value"] = $this->center_name->GetDBValue(true);
        $this->InsertFields["cp_id"]["Value"] = $this->cp_id->GetDBValue(true);
        $this->InsertFields["mfi_gp_proposed_group_name"]["Value"] = $this->group_name->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_group_size"]["Value"] = $this->group_size->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_loan_cycle"]["Value"] = $this->loan_cycle->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_loan_amount"]["Value"] = $this->loan_amt->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_last_cycle_efimo_loan_acc_no"]["Value"] = $this->previous_efimo_loan_acc_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_customer_guarantor_name"]["Value"] = $this->gurantor_name->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_GUARANTOR_kyc_id_type"]["Value"] = $this->gurantor_kyc_type->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_gurantor_kyc_id_no"]["Value"] = $this->kyc_number->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_customer_guarantor_age"]["Value"] = $this->gurantor_age->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_customer_guarantor_mobile"]["Value"] = $this->gurantor_mobile->GetDBValue(true);
        $this->InsertFields["borrower_nominee_name"]["Value"] = $this->borrower_ins->GetDBValue(true);
        $this->InsertFields["borrower_nominee_year_birth"]["Value"] = $this->borrower_ins_dob_year->GetDBValue(true);
        $this->InsertFields["borrower_nominee_mobile"]["Value"] = $this->borrower_nominee_mobile->GetDBValue(true);
        $this->InsertFields["guarantor_nominee_name"]["Value"] = $this->gurantor_ins->GetDBValue(true);
        $this->InsertFields["guarantor_nominee_year_birth"]["Value"] = $this->gurantor_ins_dob_year->GetDBValue(true);
        $this->InsertFields["guarantor_nominee_mobile"]["Value"] = $this->gurantor_nominee_mobile->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_gurantor_signature"]["Value"] = $this->gurantor_signature->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_member_signature"]["Value"] = $this->member_signature->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_co_name"]["Value"] = $this->cm_name->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_co_emp_code"]["Value"] = $this->co_emp_cod->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_date"]["Value"] = $this->co_sign_date->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_co_signature"]["Value"] = $this->cm_sign->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_alloted_enrollment_no"]["Value"] = $this->enrollment_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_efimo_loan_acc_no"]["Value"] = $this->efimo_lon_acc_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_bm_sign"]["Value"] = $this->bm_sign->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_loan_purpose"]["Value"] = $this->loan_purps->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_loan_group_meeting_frequency"]["Value"] = $this->meeting_freq->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_customer_guarantor_type"]["Value"] = $this->gurantor_type->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_added_by"]["Value"] = $this->added_by->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_added_at"]["Value"] = $this->added_at->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_updated_by"]["Value"] = $this->updated_by->GetDBValue(true);
        $this->InsertFields["mfi_hvf2_updated_at"]["Value"] = $this->updated_at->GetDBValue(true);
        $this->InsertFields["gp_id"]["Value"] = $this->gp_no->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_hvf2", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-CE694896
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["mfi_hvf2_verification_result"]["Value"] = $this->cbo_verification_result->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_bm_date"]["Value"] = $this->bm_sign_date->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_bm_emp_code"]["Value"] = $this->bm_emp_code->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_bm_name"]["Value"] = $this->bm_name->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_rural_urban"]["Value"] = $this->RadioButton1->GetDBValue(true);
        $this->UpdateFields["la_id"]["Value"] = $this->la_id->GetDBValue(true);
        $this->UpdateFields["mfi_cp_centre_name"]["Value"] = $this->center_name->GetDBValue(true);
        $this->UpdateFields["cp_id"]["Value"] = $this->cp_id->GetDBValue(true);
        $this->UpdateFields["mfi_gp_proposed_group_name"]["Value"] = $this->group_name->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_group_size"]["Value"] = $this->group_size->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_loan_cycle"]["Value"] = $this->loan_cycle->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_loan_amount"]["Value"] = $this->loan_amt->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_last_cycle_efimo_loan_acc_no"]["Value"] = $this->previous_efimo_loan_acc_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_customer_guarantor_name"]["Value"] = $this->gurantor_name->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_GUARANTOR_kyc_id_type"]["Value"] = $this->gurantor_kyc_type->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_gurantor_kyc_id_no"]["Value"] = $this->kyc_number->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_customer_guarantor_age"]["Value"] = $this->gurantor_age->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_customer_guarantor_mobile"]["Value"] = $this->gurantor_mobile->GetDBValue(true);
        $this->UpdateFields["borrower_nominee_name"]["Value"] = $this->borrower_ins->GetDBValue(true);
        $this->UpdateFields["borrower_nominee_year_birth"]["Value"] = $this->borrower_ins_dob_year->GetDBValue(true);
        $this->UpdateFields["borrower_nominee_mobile"]["Value"] = $this->borrower_nominee_mobile->GetDBValue(true);
        $this->UpdateFields["guarantor_nominee_name"]["Value"] = $this->gurantor_ins->GetDBValue(true);
        $this->UpdateFields["guarantor_nominee_year_birth"]["Value"] = $this->gurantor_ins_dob_year->GetDBValue(true);
        $this->UpdateFields["guarantor_nominee_mobile"]["Value"] = $this->gurantor_nominee_mobile->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_gurantor_signature"]["Value"] = $this->gurantor_signature->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_member_signature"]["Value"] = $this->member_signature->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_co_name"]["Value"] = $this->cm_name->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_co_emp_code"]["Value"] = $this->co_emp_cod->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_date"]["Value"] = $this->co_sign_date->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_co_signature"]["Value"] = $this->cm_sign->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_alloted_enrollment_no"]["Value"] = $this->enrollment_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_efimo_loan_acc_no"]["Value"] = $this->efimo_lon_acc_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_bm_sign"]["Value"] = $this->bm_sign->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_loan_purpose"]["Value"] = $this->loan_purps->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_loan_group_meeting_frequency"]["Value"] = $this->meeting_freq->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_customer_guarantor_type"]["Value"] = $this->gurantor_type->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_added_by"]["Value"] = $this->added_by->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_added_at"]["Value"] = $this->added_at->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_updated_by"]["Value"] = $this->updated_by->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_updated_at"]["Value"] = $this->updated_at->GetDBValue(true);
        $this->UpdateFields["gp_id"]["Value"] = $this->gp_no->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_hvf2", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-0BBABF30
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM mfi_hvf2";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End mfi_la2DataSource Class @2-FCB6E20C

//Initialize Page @1-A91E8575
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
$TemplateFileName = "LAForm2_upd.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C300E8B3
include_once("./LAForm2_upd_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C470D75E
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_la2 = new clsRecordmfi_la2("", $MainPage);
$MainPage->mfi_la2 = & $mfi_la2;
$mfi_la2->Initialize();

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

//Execute Components @1-24F93BD4
$mfi_la2->Operation();
//End Execute Components

//Go to destination page @1-860622B8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_la2);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-AFD55008
$mfi_la2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1506F1F2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_la2);
unset($Tpl);
//End Unload Page


?>
