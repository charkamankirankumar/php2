<?php
//Include Common Files @1-F2876CA2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "DUP_KYC.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordybl_kyc { //ybl_kyc Class @7-72A34389

//Variables @7-9E315808

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

//Class_Initialize Event @7-6A803BBC
    function clsRecordybl_kyc($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record ybl_kyc/Error";
        $this->DataSource = new clsybl_kycDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "ybl_kyc";
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
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            $this->la_id = new clsControl(ccsTextBox, "la_id", "Hv Id 1", ccsText, "", CCGetRequestParam("la_id", $Method, NULL), $this);
            $this->la_id->Required = true;
            $this->member_name_1 = new clsControl(ccsTextBox, "member_name_1", "Member Name 1", ccsText, "", CCGetRequestParam("member_name_1", $Method, NULL), $this);
            $this->member_name_1->Required = true;
            $this->member_relation_type = new clsControl(ccsListBox, "member_relation_type", "Member Relation Type", ccsText, "", CCGetRequestParam("member_relation_type", $Method, NULL), $this);
            $this->member_relation_type->DSType = dsListOfValues;
            $this->member_relation_type->Values = array(array("FATHER", "FATHER"), array("HUSBAND", "HUSBAND"), array("DAUGHTER", "DAUGHTER"), array("SON", "SON"), array("BROTHER", "BROTHER"), array("MOTHER-IN-LAW", "MOTHER-IN-LAW"), array("FATHER-IN-LAW", "FATHER-IN-LAW"), array("DAUGHTER-IN-LAW", "DAUGHTER-IN-LAW"), array("SON-IN-LAW", "SON-IN-LAW"), array("BROTHER-IN-LAW", "BROTHER-IN-LAW"), array("SISTER-IN-LAW", "SISTER-IN-LAW"), array("MOTHER", "MOTHER"));
            $this->relation_name_1 = new clsControl(ccsTextBox, "relation_name_1", "Relation Name 1", ccsText, "", CCGetRequestParam("relation_name_1", $Method, NULL), $this);
            $this->member_age_1 = new clsControl(ccsTextBox, "member_age_1", "Member Age 1", ccsInteger, "", CCGetRequestParam("member_age_1", $Method, NULL), $this);
            $this->member_age_as_on_1 = new clsControl(ccsTextBox, "member_age_as_on_1", "Member Age As On 1", ccsText, "", CCGetRequestParam("member_age_as_on_1", $Method, NULL), $this);
            $this->date_of_birth_1 = new clsControl(ccsTextBox, "date_of_birth_1", "Date Of Birth 1", ccsText, "", CCGetRequestParam("date_of_birth_1", $Method, NULL), $this);
            $this->date_of_birth_1->Required = true;
            $this->current_age_1 = new clsControl(ccsTextBox, "current_age_1", "Current Age 1", ccsInteger, "", CCGetRequestParam("current_age_1", $Method, NULL), $this);
            $this->current_age_1->Required = true;
            $this->member_address_1 = new clsControl(ccsTextArea, "member_address_1", "Member Address 1", ccsText, "", CCGetRequestParam("member_address_1", $Method, NULL), $this);
            $this->district_1 = new clsControl(ccsTextBox, "district_1", "District 1", ccsText, "", CCGetRequestParam("district_1", $Method, NULL), $this);
            $this->pincode_1 = new clsControl(ccsTextBox, "pincode_1", "Pincode 1", ccsText, "", CCGetRequestParam("pincode_1", $Method, NULL), $this);
            $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsListOfValues;
            $this->ListBox1->Values = array(array("VoterCard", "VoterCard"), array("AadharCard", "AadharCard"));
            $this->ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", $Method, NULL), $this);
            $this->ListBox2->DSType = dsListOfValues;
            $this->ListBox2->Values = array(array("VoterCard", "VoterCard"), array("AadharCard", "AadharCard"));
            $this->gurantor_kyc_secondry_id = new clsControl(ccsTextBox, "gurantor_kyc_secondry_id", "gurantor_kyc_secondry_id", ccsText, "", CCGetRequestParam("gurantor_kyc_secondry_id", $Method, NULL), $this);
            $this->ListBox3 = new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", $Method, NULL), $this);
            $this->ListBox3->DSType = dsListOfValues;
            $this->ListBox3->Values = array(array("VoterCard", "VoterCard"), array("AadharCard", "AadharCard"), array("RationCard", "RationCard"), array("Other", "Other"));
            $this->gurantor_kyc_primary_id = new clsControl(ccsTextBox, "gurantor_kyc_primary_id", "gurantor_kyc_primary_id", ccsText, "", CCGetRequestParam("gurantor_kyc_primary_id", $Method, NULL), $this);
            $this->kyc_id_1 = new clsControl(ccsTextBox, "kyc_id_1", "Kyc Id 1", ccsText, "", CCGetRequestParam("kyc_id_1", $Method, NULL), $this);
            $this->ListBox4 = new clsControl(ccsListBox, "ListBox4", "ListBox4", ccsText, "", CCGetRequestParam("ListBox4", $Method, NULL), $this);
            $this->ListBox4->DSType = dsListOfValues;
            $this->ListBox4->Values = array(array("VoterCard", "VoterCard"), array("AadharCard", "AadharCard"), array("RationCard", "RationCard"), array("Other", "Other"));
            $this->secondary_kyc_id = new clsControl(ccsTextBox, "secondary_kyc_id", "secondary_kyc_id", ccsText, "", CCGetRequestParam("secondary_kyc_id", $Method, NULL), $this);
            $this->gurantor_age = new clsControl(ccsTextBox, "gurantor_age", "Member Age 1", ccsInteger, "", CCGetRequestParam("gurantor_age", $Method, NULL), $this);
            $this->gurantor_age_as_on_1 = new clsControl(ccsTextBox, "gurantor_age_as_on_1", "gurantor_age_as_on_1", ccsText, "", CCGetRequestParam("gurantor_age_as_on_1", $Method, NULL), $this);
            $this->gurantor_dob = new clsControl(ccsTextBox, "gurantor_dob", "Date Of Birth 1", ccsText, "", CCGetRequestParam("gurantor_dob", $Method, NULL), $this);
            $this->gurantor_dob->Required = true;
            $this->gurantor_current_age = new clsControl(ccsTextBox, "gurantor_current_age", "Current Age 1", ccsInteger, "", CCGetRequestParam("gurantor_current_age", $Method, NULL), $this);
            $this->gurantor_current_age->Required = true;
            $this->added_by_1 = new clsControl(ccsHidden, "added_by_1", "Added By 1", ccsText, "", CCGetRequestParam("added_by_1", $Method, NULL), $this);
            $this->added_by_1->Required = true;
            $this->added_at_1 = new clsControl(ccsHidden, "added_at_1", "added_at_1", ccsText, "", CCGetRequestParam("added_at_1", $Method, NULL), $this);
            $this->member_relation_type1 = new clsControl(ccsListBox, "member_relation_type1", "Member Relation Type", ccsText, "", CCGetRequestParam("member_relation_type1", $Method, NULL), $this);
            $this->member_relation_type1->DSType = dsListOfValues;
            $this->member_relation_type1->Values = array(array("FATHER", "FATHER"), array("HUSBAND", "HUSBAND"), array("DAUGHTER", "DAUGHTER"), array("SON", "SON"), array("BROTHER", "BROTHER"), array("MOTHER-IN-LAW", "MOTHER-IN-LAW"), array("FATHER-IN-LAW", "FATHER-IN-LAW"), array("DAUGHTER-IN-LAW", "DAUGHTER-IN-LAW"), array("SON-IN-LAW", "SON-IN-LAW"), array("BROTHER-IN-LAW", "BROTHER-IN-LAW"), array("SISTER-IN-LAW", "SISTER-IN-LAW"), array("MOTHER", "MOTHER"));
            $this->relation_name_2 = new clsControl(ccsTextBox, "relation_name_2", "Relation Name 1", ccsText, "", CCGetRequestParam("relation_name_2", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @7-B4CA389F
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlla_id"] = CCGetFromGet("la_id", NULL);
    }
//End Initialize Method

//Validate Method @7-3F4D75B9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->la_id->GetText()) && !preg_match ("/^[a-zA-Z]{2,2}[0-9]{6,6}$/", $this->la_id->GetText())) {
            $this->la_id->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Hv Id 1"));
        }
        if(strlen($this->member_age_1->GetText()) && !preg_match ("/^\d{2}$/", $this->member_age_1->GetText())) {
            $this->member_age_1->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Member Age 1"));
        }
        if(strlen($this->member_age_as_on_1->GetText()) && !preg_match ("/^[0-9]{2,2}(-)[0-9]{2,2}(-)[0-9]{4,4}$/", $this->member_age_as_on_1->GetText())) {
            $this->member_age_as_on_1->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Member Age As On 1"));
        }
        if(strlen($this->date_of_birth_1->GetText()) && !preg_match ("/^[0-9]{2,2}(-)[0-9]{2,2}(-)[0-9]{4,4}$/", $this->date_of_birth_1->GetText())) {
            $this->date_of_birth_1->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Date Of Birth 1"));
        }
        if(strlen($this->current_age_1->GetText()) && !preg_match ("/^\d{2}$/", $this->current_age_1->GetText())) {
            $this->current_age_1->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Current Age 1"));
        }
        if(strlen($this->pincode_1->GetText()) && !preg_match ("/^\d{6}$/", $this->pincode_1->GetText())) {
            $this->pincode_1->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Pincode 1"));
        }
        if(strlen($this->gurantor_age->GetText()) && !preg_match ("/^\d{2}$/", $this->gurantor_age->GetText())) {
            $this->gurantor_age->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Member Age 1"));
        }
        if(strlen($this->gurantor_age_as_on_1->GetText()) && !preg_match ("/^[0-9]{2,2}(-)[0-9]{2,2}(-)[0-9]{4,4}$/", $this->gurantor_age_as_on_1->GetText())) {
            $this->gurantor_age_as_on_1->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "gurantor_age_as_on_1"));
        }
        if(strlen($this->gurantor_dob->GetText()) && !preg_match ("/^[0-9]{2,2}(-)[0-9]{2,2}(-)[0-9]{4,4}$/", $this->gurantor_dob->GetText())) {
            $this->gurantor_dob->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Date Of Birth 1"));
        }
        if(strlen($this->gurantor_current_age->GetText()) && !preg_match ("/^\d{2}$/", $this->gurantor_current_age->GetText())) {
            $this->gurantor_current_age->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Current Age 1"));
        }
        $Validation = ($this->la_id->Validate() && $Validation);
        $Validation = ($this->member_name_1->Validate() && $Validation);
        $Validation = ($this->member_relation_type->Validate() && $Validation);
        $Validation = ($this->relation_name_1->Validate() && $Validation);
        $Validation = ($this->member_age_1->Validate() && $Validation);
        $Validation = ($this->member_age_as_on_1->Validate() && $Validation);
        $Validation = ($this->date_of_birth_1->Validate() && $Validation);
        $Validation = ($this->current_age_1->Validate() && $Validation);
        $Validation = ($this->member_address_1->Validate() && $Validation);
        $Validation = ($this->district_1->Validate() && $Validation);
        $Validation = ($this->pincode_1->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->ListBox2->Validate() && $Validation);
        $Validation = ($this->gurantor_kyc_secondry_id->Validate() && $Validation);
        $Validation = ($this->ListBox3->Validate() && $Validation);
        $Validation = ($this->gurantor_kyc_primary_id->Validate() && $Validation);
        $Validation = ($this->kyc_id_1->Validate() && $Validation);
        $Validation = ($this->ListBox4->Validate() && $Validation);
        $Validation = ($this->secondary_kyc_id->Validate() && $Validation);
        $Validation = ($this->gurantor_age->Validate() && $Validation);
        $Validation = ($this->gurantor_age_as_on_1->Validate() && $Validation);
        $Validation = ($this->gurantor_dob->Validate() && $Validation);
        $Validation = ($this->gurantor_current_age->Validate() && $Validation);
        $Validation = ($this->added_by_1->Validate() && $Validation);
        $Validation = ($this->added_at_1->Validate() && $Validation);
        $Validation = ($this->member_relation_type1->Validate() && $Validation);
        $Validation = ($this->relation_name_2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->la_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_name_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_relation_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->relation_name_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_age_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_age_as_on_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_of_birth_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->current_age_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_address_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->district_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pincode_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_kyc_secondry_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_kyc_primary_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_id_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->secondary_kyc_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_age->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_age_as_on_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_dob->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_current_age->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_by_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_at_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_relation_type1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->relation_name_2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @7-0A287CDF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->la_id->Errors->Count());
        $errors = ($errors || $this->member_name_1->Errors->Count());
        $errors = ($errors || $this->member_relation_type->Errors->Count());
        $errors = ($errors || $this->relation_name_1->Errors->Count());
        $errors = ($errors || $this->member_age_1->Errors->Count());
        $errors = ($errors || $this->member_age_as_on_1->Errors->Count());
        $errors = ($errors || $this->date_of_birth_1->Errors->Count());
        $errors = ($errors || $this->current_age_1->Errors->Count());
        $errors = ($errors || $this->member_address_1->Errors->Count());
        $errors = ($errors || $this->district_1->Errors->Count());
        $errors = ($errors || $this->pincode_1->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->ListBox2->Errors->Count());
        $errors = ($errors || $this->gurantor_kyc_secondry_id->Errors->Count());
        $errors = ($errors || $this->ListBox3->Errors->Count());
        $errors = ($errors || $this->gurantor_kyc_primary_id->Errors->Count());
        $errors = ($errors || $this->kyc_id_1->Errors->Count());
        $errors = ($errors || $this->ListBox4->Errors->Count());
        $errors = ($errors || $this->secondary_kyc_id->Errors->Count());
        $errors = ($errors || $this->gurantor_age->Errors->Count());
        $errors = ($errors || $this->gurantor_age_as_on_1->Errors->Count());
        $errors = ($errors || $this->gurantor_dob->Errors->Count());
        $errors = ($errors || $this->gurantor_current_age->Errors->Count());
        $errors = ($errors || $this->added_by_1->Errors->Count());
        $errors = ($errors || $this->added_at_1->Errors->Count());
        $errors = ($errors || $this->member_relation_type1->Errors->Count());
        $errors = ($errors || $this->relation_name_2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @7-3B3725B2
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Cancel";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
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

//InsertRow Method @7-0CFE5069
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->la_id->SetValue($this->la_id->GetValue(true));
        $this->DataSource->member_name_1->SetValue($this->member_name_1->GetValue(true));
        $this->DataSource->member_relation_type->SetValue($this->member_relation_type->GetValue(true));
        $this->DataSource->relation_name_1->SetValue($this->relation_name_1->GetValue(true));
        $this->DataSource->member_age_1->SetValue($this->member_age_1->GetValue(true));
        $this->DataSource->member_age_as_on_1->SetValue($this->member_age_as_on_1->GetValue(true));
        $this->DataSource->date_of_birth_1->SetValue($this->date_of_birth_1->GetValue(true));
        $this->DataSource->current_age_1->SetValue($this->current_age_1->GetValue(true));
        $this->DataSource->member_address_1->SetValue($this->member_address_1->GetValue(true));
        $this->DataSource->district_1->SetValue($this->district_1->GetValue(true));
        $this->DataSource->pincode_1->SetValue($this->pincode_1->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->ListBox2->SetValue($this->ListBox2->GetValue(true));
        $this->DataSource->gurantor_kyc_secondry_id->SetValue($this->gurantor_kyc_secondry_id->GetValue(true));
        $this->DataSource->ListBox3->SetValue($this->ListBox3->GetValue(true));
        $this->DataSource->gurantor_kyc_primary_id->SetValue($this->gurantor_kyc_primary_id->GetValue(true));
        $this->DataSource->kyc_id_1->SetValue($this->kyc_id_1->GetValue(true));
        $this->DataSource->ListBox4->SetValue($this->ListBox4->GetValue(true));
        $this->DataSource->secondary_kyc_id->SetValue($this->secondary_kyc_id->GetValue(true));
        $this->DataSource->gurantor_age->SetValue($this->gurantor_age->GetValue(true));
        $this->DataSource->gurantor_age_as_on_1->SetValue($this->gurantor_age_as_on_1->GetValue(true));
        $this->DataSource->gurantor_dob->SetValue($this->gurantor_dob->GetValue(true));
        $this->DataSource->gurantor_current_age->SetValue($this->gurantor_current_age->GetValue(true));
        $this->DataSource->added_by_1->SetValue($this->added_by_1->GetValue(true));
        $this->DataSource->added_at_1->SetValue($this->added_at_1->GetValue(true));
        $this->DataSource->member_relation_type1->SetValue($this->member_relation_type1->GetValue(true));
        $this->DataSource->relation_name_2->SetValue($this->relation_name_2->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @7-8DB5DCD1
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->la_id->SetValue($this->la_id->GetValue(true));
        $this->DataSource->member_name_1->SetValue($this->member_name_1->GetValue(true));
        $this->DataSource->member_relation_type->SetValue($this->member_relation_type->GetValue(true));
        $this->DataSource->relation_name_1->SetValue($this->relation_name_1->GetValue(true));
        $this->DataSource->member_age_1->SetValue($this->member_age_1->GetValue(true));
        $this->DataSource->member_age_as_on_1->SetValue($this->member_age_as_on_1->GetValue(true));
        $this->DataSource->date_of_birth_1->SetValue($this->date_of_birth_1->GetValue(true));
        $this->DataSource->current_age_1->SetValue($this->current_age_1->GetValue(true));
        $this->DataSource->member_address_1->SetValue($this->member_address_1->GetValue(true));
        $this->DataSource->district_1->SetValue($this->district_1->GetValue(true));
        $this->DataSource->pincode_1->SetValue($this->pincode_1->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->ListBox2->SetValue($this->ListBox2->GetValue(true));
        $this->DataSource->gurantor_kyc_secondry_id->SetValue($this->gurantor_kyc_secondry_id->GetValue(true));
        $this->DataSource->ListBox3->SetValue($this->ListBox3->GetValue(true));
        $this->DataSource->gurantor_kyc_primary_id->SetValue($this->gurantor_kyc_primary_id->GetValue(true));
        $this->DataSource->kyc_id_1->SetValue($this->kyc_id_1->GetValue(true));
        $this->DataSource->ListBox4->SetValue($this->ListBox4->GetValue(true));
        $this->DataSource->secondary_kyc_id->SetValue($this->secondary_kyc_id->GetValue(true));
        $this->DataSource->gurantor_age->SetValue($this->gurantor_age->GetValue(true));
        $this->DataSource->gurantor_age_as_on_1->SetValue($this->gurantor_age_as_on_1->GetValue(true));
        $this->DataSource->gurantor_dob->SetValue($this->gurantor_dob->GetValue(true));
        $this->DataSource->gurantor_current_age->SetValue($this->gurantor_current_age->GetValue(true));
        $this->DataSource->added_by_1->SetValue($this->added_by_1->GetValue(true));
        $this->DataSource->added_at_1->SetValue($this->added_at_1->GetValue(true));
        $this->DataSource->member_relation_type1->SetValue($this->member_relation_type1->GetValue(true));
        $this->DataSource->relation_name_2->SetValue($this->relation_name_2->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @7-BABED09F
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

        $this->member_relation_type->Prepare();
        $this->ListBox1->Prepare();
        $this->ListBox2->Prepare();
        $this->ListBox3->Prepare();
        $this->ListBox4->Prepare();
        $this->member_relation_type1->Prepare();

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
                    $this->member_name_1->SetValue($this->DataSource->member_name_1->GetValue());
                    $this->member_relation_type->SetValue($this->DataSource->member_relation_type->GetValue());
                    $this->relation_name_1->SetValue($this->DataSource->relation_name_1->GetValue());
                    $this->member_age_1->SetValue($this->DataSource->member_age_1->GetValue());
                    $this->member_age_as_on_1->SetValue($this->DataSource->member_age_as_on_1->GetValue());
                    $this->date_of_birth_1->SetValue($this->DataSource->date_of_birth_1->GetValue());
                    $this->current_age_1->SetValue($this->DataSource->current_age_1->GetValue());
                    $this->member_address_1->SetValue($this->DataSource->member_address_1->GetValue());
                    $this->district_1->SetValue($this->DataSource->district_1->GetValue());
                    $this->pincode_1->SetValue($this->DataSource->pincode_1->GetValue());
                    $this->ListBox1->SetValue($this->DataSource->ListBox1->GetValue());
                    $this->ListBox2->SetValue($this->DataSource->ListBox2->GetValue());
                    $this->gurantor_kyc_secondry_id->SetValue($this->DataSource->gurantor_kyc_secondry_id->GetValue());
                    $this->ListBox3->SetValue($this->DataSource->ListBox3->GetValue());
                    $this->gurantor_kyc_primary_id->SetValue($this->DataSource->gurantor_kyc_primary_id->GetValue());
                    $this->kyc_id_1->SetValue($this->DataSource->kyc_id_1->GetValue());
                    $this->ListBox4->SetValue($this->DataSource->ListBox4->GetValue());
                    $this->secondary_kyc_id->SetValue($this->DataSource->secondary_kyc_id->GetValue());
                    $this->gurantor_age->SetValue($this->DataSource->gurantor_age->GetValue());
                    $this->gurantor_age_as_on_1->SetValue($this->DataSource->gurantor_age_as_on_1->GetValue());
                    $this->gurantor_dob->SetValue($this->DataSource->gurantor_dob->GetValue());
                    $this->gurantor_current_age->SetValue($this->DataSource->gurantor_current_age->GetValue());
                    $this->added_by_1->SetValue($this->DataSource->added_by_1->GetValue());
                    $this->added_at_1->SetValue($this->DataSource->added_at_1->GetValue());
                    $this->member_relation_type1->SetValue($this->DataSource->member_relation_type1->GetValue());
                    $this->relation_name_2->SetValue($this->DataSource->relation_name_2->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->la_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_name_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_relation_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->relation_name_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_age_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_age_as_on_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_of_birth_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->current_age_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_address_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->district_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pincode_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_kyc_secondry_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_kyc_primary_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_id_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->secondary_kyc_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_age->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_age_as_on_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_dob->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_current_age->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_by_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_at_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_relation_type1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->relation_name_2->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->la_id->Show();
        $this->member_name_1->Show();
        $this->member_relation_type->Show();
        $this->relation_name_1->Show();
        $this->member_age_1->Show();
        $this->member_age_as_on_1->Show();
        $this->date_of_birth_1->Show();
        $this->current_age_1->Show();
        $this->member_address_1->Show();
        $this->district_1->Show();
        $this->pincode_1->Show();
        $this->ListBox1->Show();
        $this->ListBox2->Show();
        $this->gurantor_kyc_secondry_id->Show();
        $this->ListBox3->Show();
        $this->gurantor_kyc_primary_id->Show();
        $this->kyc_id_1->Show();
        $this->ListBox4->Show();
        $this->secondary_kyc_id->Show();
        $this->gurantor_age->Show();
        $this->gurantor_age_as_on_1->Show();
        $this->gurantor_dob->Show();
        $this->gurantor_current_age->Show();
        $this->added_by_1->Show();
        $this->added_at_1->Show();
        $this->member_relation_type1->Show();
        $this->relation_name_2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End ybl_kyc Class @7-FCB6E20C

class clsybl_kycDataSource extends clsDBmysql_cams_v2 {  //ybl_kycDataSource Class @7-2B23FD8E

//DataSource Variables @7-E8930DA2
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $la_id;
    public $member_name_1;
    public $member_relation_type;
    public $relation_name_1;
    public $member_age_1;
    public $member_age_as_on_1;
    public $date_of_birth_1;
    public $current_age_1;
    public $member_address_1;
    public $district_1;
    public $pincode_1;
    public $ListBox1;
    public $ListBox2;
    public $gurantor_kyc_secondry_id;
    public $ListBox3;
    public $gurantor_kyc_primary_id;
    public $kyc_id_1;
    public $ListBox4;
    public $secondary_kyc_id;
    public $gurantor_age;
    public $gurantor_age_as_on_1;
    public $gurantor_dob;
    public $gurantor_current_age;
    public $added_by_1;
    public $added_at_1;
    public $member_relation_type1;
    public $relation_name_2;
//End DataSource Variables

//DataSourceClass_Initialize Event @7-3A9B7CE6
    function clsybl_kycDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record ybl_kyc/Error";
        $this->Initialize();
        $this->la_id = new clsField("la_id", ccsText, "");
        
        $this->member_name_1 = new clsField("member_name_1", ccsText, "");
        
        $this->member_relation_type = new clsField("member_relation_type", ccsText, "");
        
        $this->relation_name_1 = new clsField("relation_name_1", ccsText, "");
        
        $this->member_age_1 = new clsField("member_age_1", ccsInteger, "");
        
        $this->member_age_as_on_1 = new clsField("member_age_as_on_1", ccsText, "");
        
        $this->date_of_birth_1 = new clsField("date_of_birth_1", ccsText, "");
        
        $this->current_age_1 = new clsField("current_age_1", ccsInteger, "");
        
        $this->member_address_1 = new clsField("member_address_1", ccsText, "");
        
        $this->district_1 = new clsField("district_1", ccsText, "");
        
        $this->pincode_1 = new clsField("pincode_1", ccsText, "");
        
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        
        $this->ListBox2 = new clsField("ListBox2", ccsText, "");
        
        $this->gurantor_kyc_secondry_id = new clsField("gurantor_kyc_secondry_id", ccsText, "");
        
        $this->ListBox3 = new clsField("ListBox3", ccsText, "");
        
        $this->gurantor_kyc_primary_id = new clsField("gurantor_kyc_primary_id", ccsText, "");
        
        $this->kyc_id_1 = new clsField("kyc_id_1", ccsText, "");
        
        $this->ListBox4 = new clsField("ListBox4", ccsText, "");
        
        $this->secondary_kyc_id = new clsField("secondary_kyc_id", ccsText, "");
        
        $this->gurantor_age = new clsField("gurantor_age", ccsInteger, "");
        
        $this->gurantor_age_as_on_1 = new clsField("gurantor_age_as_on_1", ccsText, "");
        
        $this->gurantor_dob = new clsField("gurantor_dob", ccsText, "");
        
        $this->gurantor_current_age = new clsField("gurantor_current_age", ccsInteger, "");
        
        $this->added_by_1 = new clsField("added_by_1", ccsText, "");
        
        $this->added_at_1 = new clsField("added_at_1", ccsText, "");
        
        $this->member_relation_type1 = new clsField("member_relation_type1", ccsText, "");
        
        $this->relation_name_2 = new clsField("relation_name_2", ccsText, "");
        

        $this->InsertFields["member_name_2"] = array("Name" => "member_name_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rel_type_in_bor_kyc_2"] = array("Name" => "rel_type_in_bor_kyc_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["rel_name_in_bor_kyc_2"] = array("Name" => "rel_name_in_bor_kyc_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["member_age_2"] = array("Name" => "member_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["member_age_as_on_2"] = array("Name" => "member_age_as_on_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["date_of_birth_2"] = array("Name" => "date_of_birth_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["current_age_2"] = array("Name" => "current_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["member_address_2"] = array("Name" => "member_address_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["district_2"] = array("Name" => "district_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["pincode_2"] = array("Name" => "pincode_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["kyc_type_primary_2"] = array("Name" => "kyc_type_primary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["guarantor_kyc_type_primery_2"] = array("Name" => "guarantor_kyc_type_primery_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["guarantor_kyc_id_secondry_2"] = array("Name" => "guarantor_kyc_id_secondry_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["guarantor_kyc_type_secondry_2"] = array("Name" => "guarantor_kyc_type_secondry_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["guarantor_kyc_id_primery_2"] = array("Name" => "guarantor_kyc_id_primery_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["kyc_id_primary_2"] = array("Name" => "kyc_id_primary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["kyc_type_secondary_2"] = array("Name" => "kyc_type_secondary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["kyc_id_secondary_2"] = array("Name" => "kyc_id_secondary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["gurantor_age_2"] = array("Name" => "gurantor_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["gurantor_age_ason_2"] = array("Name" => "gurantor_age_ason_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["gurantor_dob_2"] = array("Name" => "gurantor_dob_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["gurantor_current_age_2"] = array("Name" => "gurantor_current_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["added_by_2"] = array("Name" => "added_by_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["added_at_2"] = array("Name" => "added_at_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["member_relation_type_2"] = array("Name" => "member_relation_type_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["relation_name_2"] = array("Name" => "relation_name_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_name_2"] = array("Name" => "member_name_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rel_type_in_bor_kyc_2"] = array("Name" => "rel_type_in_bor_kyc_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rel_name_in_bor_kyc_2"] = array("Name" => "rel_name_in_bor_kyc_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_age_2"] = array("Name" => "member_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_age_as_on_2"] = array("Name" => "member_age_as_on_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["date_of_birth_2"] = array("Name" => "date_of_birth_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["current_age_2"] = array("Name" => "current_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_address_2"] = array("Name" => "member_address_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["district_2"] = array("Name" => "district_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["pincode_2"] = array("Name" => "pincode_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_type_primary_2"] = array("Name" => "kyc_type_primary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_type_primery_2"] = array("Name" => "guarantor_kyc_type_primery_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_id_secondry_2"] = array("Name" => "guarantor_kyc_id_secondry_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_type_secondry_2"] = array("Name" => "guarantor_kyc_type_secondry_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_id_primery_2"] = array("Name" => "guarantor_kyc_id_primery_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_id_primary_2"] = array("Name" => "kyc_id_primary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_type_secondary_2"] = array("Name" => "kyc_type_secondary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_id_secondary_2"] = array("Name" => "kyc_id_secondary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_age_2"] = array("Name" => "gurantor_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_age_ason_2"] = array("Name" => "gurantor_age_ason_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_dob_2"] = array("Name" => "gurantor_dob_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_current_age_2"] = array("Name" => "gurantor_current_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["added_by_2"] = array("Name" => "added_by_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["added_at_2"] = array("Name" => "added_at_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_relation_type_2"] = array("Name" => "member_relation_type_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["relation_name_2"] = array("Name" => "relation_name_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @7-89510D2C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlla_id", ccsText, "", "", $this->Parameters["urlla_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "la_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @7-BBABA8FE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT *, la_id \n\n" .
        "FROM mfi_kyc {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @7-286DD9EC
    function SetValues()
    {
        $this->member_name_1->SetDBValue($this->f("member_name_2"));
        $this->member_relation_type->SetDBValue($this->f("rel_type_in_bor_kyc_2"));
        $this->relation_name_1->SetDBValue($this->f("rel_name_in_bor_kyc_2"));
        $this->member_age_1->SetDBValue(trim($this->f("member_age_2")));
        $this->member_age_as_on_1->SetDBValue($this->f("member_age_as_on_2"));
        $this->date_of_birth_1->SetDBValue($this->f("date_of_birth_2"));
        $this->current_age_1->SetDBValue(trim($this->f("current_age_2")));
        $this->member_address_1->SetDBValue($this->f("member_address_2"));
        $this->district_1->SetDBValue($this->f("district_2"));
        $this->pincode_1->SetDBValue($this->f("pincode_2"));
        $this->ListBox1->SetDBValue($this->f("kyc_type_primary_2"));
        $this->ListBox2->SetDBValue($this->f("guarantor_kyc_type_primery_2"));
        $this->gurantor_kyc_secondry_id->SetDBValue($this->f("guarantor_kyc_id_secondry_2"));
        $this->ListBox3->SetDBValue($this->f("guarantor_kyc_type_secondry_2"));
        $this->gurantor_kyc_primary_id->SetDBValue($this->f("guarantor_kyc_id_primery_2"));
        $this->kyc_id_1->SetDBValue($this->f("kyc_id_primary_2"));
        $this->ListBox4->SetDBValue($this->f("kyc_type_secondary_2"));
        $this->secondary_kyc_id->SetDBValue($this->f("kyc_id_secondary_2"));
        $this->gurantor_age->SetDBValue(trim($this->f("gurantor_age_2")));
        $this->gurantor_age_as_on_1->SetDBValue($this->f("gurantor_age_ason_2"));
        $this->gurantor_dob->SetDBValue($this->f("gurantor_dob_2"));
        $this->gurantor_current_age->SetDBValue(trim($this->f("gurantor_current_age_2")));
        $this->added_by_1->SetDBValue($this->f("added_by_2"));
        $this->added_at_1->SetDBValue($this->f("added_at_2"));
        $this->member_relation_type1->SetDBValue($this->f("member_relation_type_2"));
        $this->relation_name_2->SetDBValue($this->f("relation_name_2"));
    }
//End SetValues Method

//Insert Method @7-F6FFB05D
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["member_name_2"]["Value"] = $this->member_name_1->GetDBValue(true);
        $this->InsertFields["rel_type_in_bor_kyc_2"]["Value"] = $this->member_relation_type->GetDBValue(true);
        $this->InsertFields["rel_name_in_bor_kyc_2"]["Value"] = $this->relation_name_1->GetDBValue(true);
        $this->InsertFields["member_age_2"]["Value"] = $this->member_age_1->GetDBValue(true);
        $this->InsertFields["member_age_as_on_2"]["Value"] = $this->member_age_as_on_1->GetDBValue(true);
        $this->InsertFields["date_of_birth_2"]["Value"] = $this->date_of_birth_1->GetDBValue(true);
        $this->InsertFields["current_age_2"]["Value"] = $this->current_age_1->GetDBValue(true);
        $this->InsertFields["member_address_2"]["Value"] = $this->member_address_1->GetDBValue(true);
        $this->InsertFields["district_2"]["Value"] = $this->district_1->GetDBValue(true);
        $this->InsertFields["pincode_2"]["Value"] = $this->pincode_1->GetDBValue(true);
        $this->InsertFields["kyc_type_primary_2"]["Value"] = $this->ListBox1->GetDBValue(true);
        $this->InsertFields["guarantor_kyc_type_primery_2"]["Value"] = $this->ListBox2->GetDBValue(true);
        $this->InsertFields["guarantor_kyc_id_secondry_2"]["Value"] = $this->gurantor_kyc_secondry_id->GetDBValue(true);
        $this->InsertFields["guarantor_kyc_type_secondry_2"]["Value"] = $this->ListBox3->GetDBValue(true);
        $this->InsertFields["guarantor_kyc_id_primery_2"]["Value"] = $this->gurantor_kyc_primary_id->GetDBValue(true);
        $this->InsertFields["kyc_id_primary_2"]["Value"] = $this->kyc_id_1->GetDBValue(true);
        $this->InsertFields["kyc_type_secondary_2"]["Value"] = $this->ListBox4->GetDBValue(true);
        $this->InsertFields["kyc_id_secondary_2"]["Value"] = $this->secondary_kyc_id->GetDBValue(true);
        $this->InsertFields["gurantor_age_2"]["Value"] = $this->gurantor_age->GetDBValue(true);
        $this->InsertFields["gurantor_age_ason_2"]["Value"] = $this->gurantor_age_as_on_1->GetDBValue(true);
        $this->InsertFields["gurantor_dob_2"]["Value"] = $this->gurantor_dob->GetDBValue(true);
        $this->InsertFields["gurantor_current_age_2"]["Value"] = $this->gurantor_current_age->GetDBValue(true);
        $this->InsertFields["added_by_2"]["Value"] = $this->added_by_1->GetDBValue(true);
        $this->InsertFields["added_at_2"]["Value"] = $this->added_at_1->GetDBValue(true);
        $this->InsertFields["member_relation_type_2"]["Value"] = $this->member_relation_type1->GetDBValue(true);
        $this->InsertFields["relation_name_2"]["Value"] = $this->relation_name_2->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_kyc", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @7-C9581CB2
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["member_name_2"]["Value"] = $this->member_name_1->GetDBValue(true);
        $this->UpdateFields["rel_type_in_bor_kyc_2"]["Value"] = $this->member_relation_type->GetDBValue(true);
        $this->UpdateFields["rel_name_in_bor_kyc_2"]["Value"] = $this->relation_name_1->GetDBValue(true);
        $this->UpdateFields["member_age_2"]["Value"] = $this->member_age_1->GetDBValue(true);
        $this->UpdateFields["member_age_as_on_2"]["Value"] = $this->member_age_as_on_1->GetDBValue(true);
        $this->UpdateFields["date_of_birth_2"]["Value"] = $this->date_of_birth_1->GetDBValue(true);
        $this->UpdateFields["current_age_2"]["Value"] = $this->current_age_1->GetDBValue(true);
        $this->UpdateFields["member_address_2"]["Value"] = $this->member_address_1->GetDBValue(true);
        $this->UpdateFields["district_2"]["Value"] = $this->district_1->GetDBValue(true);
        $this->UpdateFields["pincode_2"]["Value"] = $this->pincode_1->GetDBValue(true);
        $this->UpdateFields["kyc_type_primary_2"]["Value"] = $this->ListBox1->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_type_primery_2"]["Value"] = $this->ListBox2->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_id_secondry_2"]["Value"] = $this->gurantor_kyc_secondry_id->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_type_secondry_2"]["Value"] = $this->ListBox3->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_id_primery_2"]["Value"] = $this->gurantor_kyc_primary_id->GetDBValue(true);
        $this->UpdateFields["kyc_id_primary_2"]["Value"] = $this->kyc_id_1->GetDBValue(true);
        $this->UpdateFields["kyc_type_secondary_2"]["Value"] = $this->ListBox4->GetDBValue(true);
        $this->UpdateFields["kyc_id_secondary_2"]["Value"] = $this->secondary_kyc_id->GetDBValue(true);
        $this->UpdateFields["gurantor_age_2"]["Value"] = $this->gurantor_age->GetDBValue(true);
        $this->UpdateFields["gurantor_age_ason_2"]["Value"] = $this->gurantor_age_as_on_1->GetDBValue(true);
        $this->UpdateFields["gurantor_dob_2"]["Value"] = $this->gurantor_dob->GetDBValue(true);
        $this->UpdateFields["gurantor_current_age_2"]["Value"] = $this->gurantor_current_age->GetDBValue(true);
        $this->UpdateFields["added_by_2"]["Value"] = $this->added_by_1->GetDBValue(true);
        $this->UpdateFields["added_at_2"]["Value"] = $this->added_at_1->GetDBValue(true);
        $this->UpdateFields["member_relation_type_2"]["Value"] = $this->member_relation_type1->GetDBValue(true);
        $this->UpdateFields["relation_name_2"]["Value"] = $this->relation_name_2->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_kyc", $this->UpdateFields, $this);
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

} //End ybl_kycDataSource Class @7-FCB6E20C



//Initialize Page @1-918CE3CE
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
$TemplateFileName = "DUP_KYC.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-81CC6CA7
include_once("./DUP_KYC_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C96A5705
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$ybl_kyc = new clsRecordybl_kyc("", $MainPage);
$MainPage->ybl_kyc = & $ybl_kyc;
$ybl_kyc->Initialize();

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

//Execute Components @1-8F47A920
$ybl_kyc->Operation();
//End Execute Components

//Go to destination page @1-8B4386EF
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($ybl_kyc);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9F8D9A71
$ybl_kyc->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BEB86306
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($ybl_kyc);
unset($Tpl);
//End Unload Page


?>
