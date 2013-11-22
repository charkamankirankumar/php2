<?php
//Include Common Files @1-390C36CA
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "KYCUPD.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmfi_kyc { //mfi_kyc Class @2-2ED0C9F8

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

//Class_Initialize Event @2-E2C03CB2
    function clsRecordmfi_kyc($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_kyc/Error";
        $this->DataSource = new clsmfi_kycDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_kyc";
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
            $this->la_id_2 = new clsControl(ccsTextBox, "la_id_2", $CCSLocales->GetText("la_id_2"), ccsText, "", CCGetRequestParam("la_id_2", $Method, NULL), $this);
            $this->kyc_type_primary_1 = new clsControl(ccsTextBox, "kyc_type_primary_1", $CCSLocales->GetText("kyc_type_primary_1"), ccsText, "", CCGetRequestParam("kyc_type_primary_1", $Method, NULL), $this);
            $this->kyc_type_primary_1->Required = true;
            $this->kyc_id_primary_1 = new clsControl(ccsTextBox, "kyc_id_primary_1", $CCSLocales->GetText("kyc_id_primary_1"), ccsText, "", CCGetRequestParam("kyc_id_primary_1", $Method, NULL), $this);
            $this->kyc_id_primary_1->Required = true;
            $this->kyc_type_secondary_1 = new clsControl(ccsTextBox, "kyc_type_secondary_1", $CCSLocales->GetText("kyc_type_secondary_1"), ccsText, "", CCGetRequestParam("kyc_type_secondary_1", $Method, NULL), $this);
            $this->kyc_id_secondary_1 = new clsControl(ccsTextBox, "kyc_id_secondary_1", $CCSLocales->GetText("kyc_id_secondary_1"), ccsText, "", CCGetRequestParam("kyc_id_secondary_1", $Method, NULL), $this);
            $this->member_name_1 = new clsControl(ccsTextBox, "member_name_1", $CCSLocales->GetText("member_name_1"), ccsText, "", CCGetRequestParam("member_name_1", $Method, NULL), $this);
            $this->member_relation_type_1 = new clsControl(ccsTextBox, "member_relation_type_1", $CCSLocales->GetText("member_relation_type_1"), ccsText, "", CCGetRequestParam("member_relation_type_1", $Method, NULL), $this);
            $this->relation_name_1 = new clsControl(ccsTextBox, "relation_name_1", $CCSLocales->GetText("relation_name_1"), ccsText, "", CCGetRequestParam("relation_name_1", $Method, NULL), $this);
            $this->member_age_1 = new clsControl(ccsTextBox, "member_age_1", $CCSLocales->GetText("member_age_1"), ccsInteger, "", CCGetRequestParam("member_age_1", $Method, NULL), $this);
            $this->member_age_as_on_1 = new clsControl(ccsTextBox, "member_age_as_on_1", $CCSLocales->GetText("member_age_as_on_1"), ccsText, "", CCGetRequestParam("member_age_as_on_1", $Method, NULL), $this);
            $this->date_of_birth_1 = new clsControl(ccsTextBox, "date_of_birth_1", $CCSLocales->GetText("date_of_birth_1"), ccsText, "", CCGetRequestParam("date_of_birth_1", $Method, NULL), $this);
            $this->current_age_1 = new clsControl(ccsTextBox, "current_age_1", $CCSLocales->GetText("current_age_1"), ccsInteger, "", CCGetRequestParam("current_age_1", $Method, NULL), $this);
            $this->member_address_1 = new clsControl(ccsTextArea, "member_address_1", $CCSLocales->GetText("member_address_1"), ccsText, "", CCGetRequestParam("member_address_1", $Method, NULL), $this);
            $this->district_1 = new clsControl(ccsTextBox, "district_1", $CCSLocales->GetText("district_1"), ccsText, "", CCGetRequestParam("district_1", $Method, NULL), $this);
            $this->pincode_1 = new clsControl(ccsTextBox, "pincode_1", $CCSLocales->GetText("pincode_1"), ccsInteger, "", CCGetRequestParam("pincode_1", $Method, NULL), $this);
            $this->guarantor_kyc_type_primery_1 = new clsControl(ccsTextBox, "guarantor_kyc_type_primery_1", $CCSLocales->GetText("guarantor_kyc_type_primery_1"), ccsText, "", CCGetRequestParam("guarantor_kyc_type_primery_1", $Method, NULL), $this);
            $this->guarantor_kyc_id_primery_1 = new clsControl(ccsTextBox, "guarantor_kyc_id_primery_1", $CCSLocales->GetText("guarantor_kyc_id_primery_1"), ccsText, "", CCGetRequestParam("guarantor_kyc_id_primery_1", $Method, NULL), $this);
            $this->guarantor_kyc_type_secondry_1 = new clsControl(ccsTextBox, "guarantor_kyc_type_secondry_1", $CCSLocales->GetText("guarantor_kyc_type_secondry_1"), ccsText, "", CCGetRequestParam("guarantor_kyc_type_secondry_1", $Method, NULL), $this);
            $this->guarantor_kyc_id_secondry_1 = new clsControl(ccsTextBox, "guarantor_kyc_id_secondry_1", $CCSLocales->GetText("guarantor_kyc_id_secondry_1"), ccsText, "", CCGetRequestParam("guarantor_kyc_id_secondry_1", $Method, NULL), $this);
            $this->gurantor_age_ason_1 = new clsControl(ccsTextBox, "gurantor_age_ason_1", $CCSLocales->GetText("gurantor_age_ason_1"), ccsText, "", CCGetRequestParam("gurantor_age_ason_1", $Method, NULL), $this);
            $this->gurantor_dob_1 = new clsControl(ccsTextBox, "gurantor_dob_1", $CCSLocales->GetText("gurantor_dob_1"), ccsText, "", CCGetRequestParam("gurantor_dob_1", $Method, NULL), $this);
            $this->gurantor_current_age_1 = new clsControl(ccsTextBox, "gurantor_current_age_1", $CCSLocales->GetText("gurantor_current_age_1"), ccsInteger, "", CCGetRequestParam("gurantor_current_age_1", $Method, NULL), $this);
            $this->added_by_1 = new clsControl(ccsTextBox, "added_by_1", $CCSLocales->GetText("added_by_1"), ccsText, "", CCGetRequestParam("added_by_1", $Method, NULL), $this);
            $this->added_at_1 = new clsControl(ccsTextBox, "added_at_1", $CCSLocales->GetText("added_at_1"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("added_at_1", $Method, NULL), $this);
            $this->test_result = new clsControl(ccsTextBox, "test_result", $CCSLocales->GetText("test_result"), ccsText, "", CCGetRequestParam("test_result", $Method, NULL), $this);
            $this->kyc_type_primary_2 = new clsControl(ccsTextBox, "kyc_type_primary_2", $CCSLocales->GetText("kyc_type_primary_2"), ccsText, "", CCGetRequestParam("kyc_type_primary_2", $Method, NULL), $this);
            $this->kyc_id_primary_2 = new clsControl(ccsTextBox, "kyc_id_primary_2", $CCSLocales->GetText("kyc_id_primary_2"), ccsText, "", CCGetRequestParam("kyc_id_primary_2", $Method, NULL), $this);
            $this->kyc_type_secondary_2 = new clsControl(ccsTextBox, "kyc_type_secondary_2", $CCSLocales->GetText("kyc_type_secondary_2"), ccsText, "", CCGetRequestParam("kyc_type_secondary_2", $Method, NULL), $this);
            $this->kyc_id_secondary_2 = new clsControl(ccsTextBox, "kyc_id_secondary_2", $CCSLocales->GetText("kyc_id_secondary_2"), ccsText, "", CCGetRequestParam("kyc_id_secondary_2", $Method, NULL), $this);
            $this->member_name_2 = new clsControl(ccsTextBox, "member_name_2", $CCSLocales->GetText("member_name_2"), ccsText, "", CCGetRequestParam("member_name_2", $Method, NULL), $this);
            $this->member_relation_type_2 = new clsControl(ccsTextBox, "member_relation_type_2", $CCSLocales->GetText("member_relation_type_2"), ccsText, "", CCGetRequestParam("member_relation_type_2", $Method, NULL), $this);
            $this->relation_name_2 = new clsControl(ccsTextBox, "relation_name_2", $CCSLocales->GetText("relation_name_2"), ccsText, "", CCGetRequestParam("relation_name_2", $Method, NULL), $this);
            $this->member_age_2 = new clsControl(ccsTextBox, "member_age_2", $CCSLocales->GetText("member_age_2"), ccsInteger, "", CCGetRequestParam("member_age_2", $Method, NULL), $this);
            $this->member_age_as_on_2 = new clsControl(ccsTextBox, "member_age_as_on_2", $CCSLocales->GetText("member_age_as_on_2"), ccsText, "", CCGetRequestParam("member_age_as_on_2", $Method, NULL), $this);
            $this->date_of_birth_2 = new clsControl(ccsTextBox, "date_of_birth_2", $CCSLocales->GetText("date_of_birth_2"), ccsText, "", CCGetRequestParam("date_of_birth_2", $Method, NULL), $this);
            $this->current_age_2 = new clsControl(ccsTextBox, "current_age_2", $CCSLocales->GetText("current_age_2"), ccsInteger, "", CCGetRequestParam("current_age_2", $Method, NULL), $this);
            $this->member_address_2 = new clsControl(ccsTextArea, "member_address_2", $CCSLocales->GetText("member_address_2"), ccsText, "", CCGetRequestParam("member_address_2", $Method, NULL), $this);
            $this->district_2 = new clsControl(ccsTextBox, "district_2", $CCSLocales->GetText("district_2"), ccsText, "", CCGetRequestParam("district_2", $Method, NULL), $this);
            $this->pincode_2 = new clsControl(ccsTextBox, "pincode_2", $CCSLocales->GetText("pincode_2"), ccsInteger, "", CCGetRequestParam("pincode_2", $Method, NULL), $this);
            $this->guarantor_kyc_type_primery_2 = new clsControl(ccsTextBox, "guarantor_kyc_type_primery_2", $CCSLocales->GetText("guarantor_kyc_type_primery_2"), ccsText, "", CCGetRequestParam("guarantor_kyc_type_primery_2", $Method, NULL), $this);
            $this->guarantor_kyc_id_primery_2 = new clsControl(ccsTextBox, "guarantor_kyc_id_primery_2", $CCSLocales->GetText("guarantor_kyc_id_primery_2"), ccsText, "", CCGetRequestParam("guarantor_kyc_id_primery_2", $Method, NULL), $this);
            $this->guarantor_kyc_type_secondry_2 = new clsControl(ccsTextBox, "guarantor_kyc_type_secondry_2", $CCSLocales->GetText("guarantor_kyc_type_secondry_2"), ccsText, "", CCGetRequestParam("guarantor_kyc_type_secondry_2", $Method, NULL), $this);
            $this->guarantor_kyc_id_secondry_2 = new clsControl(ccsTextBox, "guarantor_kyc_id_secondry_2", $CCSLocales->GetText("guarantor_kyc_id_secondry_2"), ccsText, "", CCGetRequestParam("guarantor_kyc_id_secondry_2", $Method, NULL), $this);
            $this->gurantor_age_1 = new clsControl(ccsTextBox, "gurantor_age_1", $CCSLocales->GetText("gurantor_age_1"), ccsInteger, "", CCGetRequestParam("gurantor_age_1", $Method, NULL), $this);
            $this->gurantor_age_2 = new clsControl(ccsTextBox, "gurantor_age_2", $CCSLocales->GetText("gurantor_age_2"), ccsInteger, "", CCGetRequestParam("gurantor_age_2", $Method, NULL), $this);
            $this->gurantor_age_ason_2 = new clsControl(ccsTextBox, "gurantor_age_ason_2", $CCSLocales->GetText("gurantor_age_ason_2"), ccsText, "", CCGetRequestParam("gurantor_age_ason_2", $Method, NULL), $this);
            $this->gurantor_dob_2 = new clsControl(ccsTextBox, "gurantor_dob_2", $CCSLocales->GetText("gurantor_dob_2"), ccsText, "", CCGetRequestParam("gurantor_dob_2", $Method, NULL), $this);
            $this->gurantor_current_age_2 = new clsControl(ccsTextBox, "gurantor_current_age_2", $CCSLocales->GetText("gurantor_current_age_2"), ccsInteger, "", CCGetRequestParam("gurantor_current_age_2", $Method, NULL), $this);
            $this->added_by_2 = new clsControl(ccsTextBox, "added_by_2", $CCSLocales->GetText("added_by_2"), ccsText, "", CCGetRequestParam("added_by_2", $Method, NULL), $this);
            $this->added_at_2 = new clsControl(ccsTextBox, "added_at_2", $CCSLocales->GetText("added_at_2"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("added_at_2", $Method, NULL), $this);
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

//Validate Method @2-44900635
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->la_id_2->Validate() && $Validation);
        $Validation = ($this->kyc_type_primary_1->Validate() && $Validation);
        $Validation = ($this->kyc_id_primary_1->Validate() && $Validation);
        $Validation = ($this->kyc_type_secondary_1->Validate() && $Validation);
        $Validation = ($this->kyc_id_secondary_1->Validate() && $Validation);
        $Validation = ($this->member_name_1->Validate() && $Validation);
        $Validation = ($this->member_relation_type_1->Validate() && $Validation);
        $Validation = ($this->relation_name_1->Validate() && $Validation);
        $Validation = ($this->member_age_1->Validate() && $Validation);
        $Validation = ($this->member_age_as_on_1->Validate() && $Validation);
        $Validation = ($this->date_of_birth_1->Validate() && $Validation);
        $Validation = ($this->current_age_1->Validate() && $Validation);
        $Validation = ($this->member_address_1->Validate() && $Validation);
        $Validation = ($this->district_1->Validate() && $Validation);
        $Validation = ($this->pincode_1->Validate() && $Validation);
        $Validation = ($this->guarantor_kyc_type_primery_1->Validate() && $Validation);
        $Validation = ($this->guarantor_kyc_id_primery_1->Validate() && $Validation);
        $Validation = ($this->guarantor_kyc_type_secondry_1->Validate() && $Validation);
        $Validation = ($this->guarantor_kyc_id_secondry_1->Validate() && $Validation);
        $Validation = ($this->gurantor_age_ason_1->Validate() && $Validation);
        $Validation = ($this->gurantor_dob_1->Validate() && $Validation);
        $Validation = ($this->gurantor_current_age_1->Validate() && $Validation);
        $Validation = ($this->added_by_1->Validate() && $Validation);
        $Validation = ($this->added_at_1->Validate() && $Validation);
        $Validation = ($this->test_result->Validate() && $Validation);
        $Validation = ($this->kyc_type_primary_2->Validate() && $Validation);
        $Validation = ($this->kyc_id_primary_2->Validate() && $Validation);
        $Validation = ($this->kyc_type_secondary_2->Validate() && $Validation);
        $Validation = ($this->kyc_id_secondary_2->Validate() && $Validation);
        $Validation = ($this->member_name_2->Validate() && $Validation);
        $Validation = ($this->member_relation_type_2->Validate() && $Validation);
        $Validation = ($this->relation_name_2->Validate() && $Validation);
        $Validation = ($this->member_age_2->Validate() && $Validation);
        $Validation = ($this->member_age_as_on_2->Validate() && $Validation);
        $Validation = ($this->date_of_birth_2->Validate() && $Validation);
        $Validation = ($this->current_age_2->Validate() && $Validation);
        $Validation = ($this->member_address_2->Validate() && $Validation);
        $Validation = ($this->district_2->Validate() && $Validation);
        $Validation = ($this->pincode_2->Validate() && $Validation);
        $Validation = ($this->guarantor_kyc_type_primery_2->Validate() && $Validation);
        $Validation = ($this->guarantor_kyc_id_primery_2->Validate() && $Validation);
        $Validation = ($this->guarantor_kyc_type_secondry_2->Validate() && $Validation);
        $Validation = ($this->guarantor_kyc_id_secondry_2->Validate() && $Validation);
        $Validation = ($this->gurantor_age_1->Validate() && $Validation);
        $Validation = ($this->gurantor_age_2->Validate() && $Validation);
        $Validation = ($this->gurantor_age_ason_2->Validate() && $Validation);
        $Validation = ($this->gurantor_dob_2->Validate() && $Validation);
        $Validation = ($this->gurantor_current_age_2->Validate() && $Validation);
        $Validation = ($this->added_by_2->Validate() && $Validation);
        $Validation = ($this->added_at_2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->la_id_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_type_primary_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_id_primary_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_type_secondary_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_id_secondary_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_name_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_relation_type_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->relation_name_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_age_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_age_as_on_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_of_birth_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->current_age_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_address_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->district_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pincode_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->guarantor_kyc_type_primery_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->guarantor_kyc_id_primery_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->guarantor_kyc_type_secondry_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->guarantor_kyc_id_secondry_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_age_ason_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_dob_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_current_age_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_by_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_at_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->test_result->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_type_primary_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_id_primary_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_type_secondary_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kyc_id_secondary_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_name_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_relation_type_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->relation_name_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_age_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_age_as_on_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_of_birth_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->current_age_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_address_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->district_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pincode_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->guarantor_kyc_type_primery_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->guarantor_kyc_id_primery_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->guarantor_kyc_type_secondry_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->guarantor_kyc_id_secondry_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_age_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_age_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_age_ason_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_dob_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_current_age_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_by_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_at_2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-271B503F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->la_id_2->Errors->Count());
        $errors = ($errors || $this->kyc_type_primary_1->Errors->Count());
        $errors = ($errors || $this->kyc_id_primary_1->Errors->Count());
        $errors = ($errors || $this->kyc_type_secondary_1->Errors->Count());
        $errors = ($errors || $this->kyc_id_secondary_1->Errors->Count());
        $errors = ($errors || $this->member_name_1->Errors->Count());
        $errors = ($errors || $this->member_relation_type_1->Errors->Count());
        $errors = ($errors || $this->relation_name_1->Errors->Count());
        $errors = ($errors || $this->member_age_1->Errors->Count());
        $errors = ($errors || $this->member_age_as_on_1->Errors->Count());
        $errors = ($errors || $this->date_of_birth_1->Errors->Count());
        $errors = ($errors || $this->current_age_1->Errors->Count());
        $errors = ($errors || $this->member_address_1->Errors->Count());
        $errors = ($errors || $this->district_1->Errors->Count());
        $errors = ($errors || $this->pincode_1->Errors->Count());
        $errors = ($errors || $this->guarantor_kyc_type_primery_1->Errors->Count());
        $errors = ($errors || $this->guarantor_kyc_id_primery_1->Errors->Count());
        $errors = ($errors || $this->guarantor_kyc_type_secondry_1->Errors->Count());
        $errors = ($errors || $this->guarantor_kyc_id_secondry_1->Errors->Count());
        $errors = ($errors || $this->gurantor_age_ason_1->Errors->Count());
        $errors = ($errors || $this->gurantor_dob_1->Errors->Count());
        $errors = ($errors || $this->gurantor_current_age_1->Errors->Count());
        $errors = ($errors || $this->added_by_1->Errors->Count());
        $errors = ($errors || $this->added_at_1->Errors->Count());
        $errors = ($errors || $this->test_result->Errors->Count());
        $errors = ($errors || $this->kyc_type_primary_2->Errors->Count());
        $errors = ($errors || $this->kyc_id_primary_2->Errors->Count());
        $errors = ($errors || $this->kyc_type_secondary_2->Errors->Count());
        $errors = ($errors || $this->kyc_id_secondary_2->Errors->Count());
        $errors = ($errors || $this->member_name_2->Errors->Count());
        $errors = ($errors || $this->member_relation_type_2->Errors->Count());
        $errors = ($errors || $this->relation_name_2->Errors->Count());
        $errors = ($errors || $this->member_age_2->Errors->Count());
        $errors = ($errors || $this->member_age_as_on_2->Errors->Count());
        $errors = ($errors || $this->date_of_birth_2->Errors->Count());
        $errors = ($errors || $this->current_age_2->Errors->Count());
        $errors = ($errors || $this->member_address_2->Errors->Count());
        $errors = ($errors || $this->district_2->Errors->Count());
        $errors = ($errors || $this->pincode_2->Errors->Count());
        $errors = ($errors || $this->guarantor_kyc_type_primery_2->Errors->Count());
        $errors = ($errors || $this->guarantor_kyc_id_primery_2->Errors->Count());
        $errors = ($errors || $this->guarantor_kyc_type_secondry_2->Errors->Count());
        $errors = ($errors || $this->guarantor_kyc_id_secondry_2->Errors->Count());
        $errors = ($errors || $this->gurantor_age_1->Errors->Count());
        $errors = ($errors || $this->gurantor_age_2->Errors->Count());
        $errors = ($errors || $this->gurantor_age_ason_2->Errors->Count());
        $errors = ($errors || $this->gurantor_dob_2->Errors->Count());
        $errors = ($errors || $this->gurantor_current_age_2->Errors->Count());
        $errors = ($errors || $this->added_by_2->Errors->Count());
        $errors = ($errors || $this->added_at_2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-517B5C36
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
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

//UpdateRow Method @2-576F3A5F
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->la_id_2->SetValue($this->la_id_2->GetValue(true));
        $this->DataSource->kyc_type_primary_1->SetValue($this->kyc_type_primary_1->GetValue(true));
        $this->DataSource->kyc_id_primary_1->SetValue($this->kyc_id_primary_1->GetValue(true));
        $this->DataSource->kyc_type_secondary_1->SetValue($this->kyc_type_secondary_1->GetValue(true));
        $this->DataSource->kyc_id_secondary_1->SetValue($this->kyc_id_secondary_1->GetValue(true));
        $this->DataSource->member_name_1->SetValue($this->member_name_1->GetValue(true));
        $this->DataSource->member_relation_type_1->SetValue($this->member_relation_type_1->GetValue(true));
        $this->DataSource->relation_name_1->SetValue($this->relation_name_1->GetValue(true));
        $this->DataSource->member_age_1->SetValue($this->member_age_1->GetValue(true));
        $this->DataSource->member_age_as_on_1->SetValue($this->member_age_as_on_1->GetValue(true));
        $this->DataSource->date_of_birth_1->SetValue($this->date_of_birth_1->GetValue(true));
        $this->DataSource->current_age_1->SetValue($this->current_age_1->GetValue(true));
        $this->DataSource->member_address_1->SetValue($this->member_address_1->GetValue(true));
        $this->DataSource->district_1->SetValue($this->district_1->GetValue(true));
        $this->DataSource->pincode_1->SetValue($this->pincode_1->GetValue(true));
        $this->DataSource->guarantor_kyc_type_primery_1->SetValue($this->guarantor_kyc_type_primery_1->GetValue(true));
        $this->DataSource->guarantor_kyc_id_primery_1->SetValue($this->guarantor_kyc_id_primery_1->GetValue(true));
        $this->DataSource->guarantor_kyc_type_secondry_1->SetValue($this->guarantor_kyc_type_secondry_1->GetValue(true));
        $this->DataSource->guarantor_kyc_id_secondry_1->SetValue($this->guarantor_kyc_id_secondry_1->GetValue(true));
        $this->DataSource->gurantor_age_ason_1->SetValue($this->gurantor_age_ason_1->GetValue(true));
        $this->DataSource->gurantor_dob_1->SetValue($this->gurantor_dob_1->GetValue(true));
        $this->DataSource->gurantor_current_age_1->SetValue($this->gurantor_current_age_1->GetValue(true));
        $this->DataSource->added_by_1->SetValue($this->added_by_1->GetValue(true));
        $this->DataSource->added_at_1->SetValue($this->added_at_1->GetValue(true));
        $this->DataSource->test_result->SetValue($this->test_result->GetValue(true));
        $this->DataSource->kyc_type_primary_2->SetValue($this->kyc_type_primary_2->GetValue(true));
        $this->DataSource->kyc_id_primary_2->SetValue($this->kyc_id_primary_2->GetValue(true));
        $this->DataSource->kyc_type_secondary_2->SetValue($this->kyc_type_secondary_2->GetValue(true));
        $this->DataSource->kyc_id_secondary_2->SetValue($this->kyc_id_secondary_2->GetValue(true));
        $this->DataSource->member_name_2->SetValue($this->member_name_2->GetValue(true));
        $this->DataSource->member_relation_type_2->SetValue($this->member_relation_type_2->GetValue(true));
        $this->DataSource->relation_name_2->SetValue($this->relation_name_2->GetValue(true));
        $this->DataSource->member_age_2->SetValue($this->member_age_2->GetValue(true));
        $this->DataSource->member_age_as_on_2->SetValue($this->member_age_as_on_2->GetValue(true));
        $this->DataSource->date_of_birth_2->SetValue($this->date_of_birth_2->GetValue(true));
        $this->DataSource->current_age_2->SetValue($this->current_age_2->GetValue(true));
        $this->DataSource->member_address_2->SetValue($this->member_address_2->GetValue(true));
        $this->DataSource->district_2->SetValue($this->district_2->GetValue(true));
        $this->DataSource->pincode_2->SetValue($this->pincode_2->GetValue(true));
        $this->DataSource->guarantor_kyc_type_primery_2->SetValue($this->guarantor_kyc_type_primery_2->GetValue(true));
        $this->DataSource->guarantor_kyc_id_primery_2->SetValue($this->guarantor_kyc_id_primery_2->GetValue(true));
        $this->DataSource->guarantor_kyc_type_secondry_2->SetValue($this->guarantor_kyc_type_secondry_2->GetValue(true));
        $this->DataSource->guarantor_kyc_id_secondry_2->SetValue($this->guarantor_kyc_id_secondry_2->GetValue(true));
        $this->DataSource->gurantor_age_1->SetValue($this->gurantor_age_1->GetValue(true));
        $this->DataSource->gurantor_age_2->SetValue($this->gurantor_age_2->GetValue(true));
        $this->DataSource->gurantor_age_ason_2->SetValue($this->gurantor_age_ason_2->GetValue(true));
        $this->DataSource->gurantor_dob_2->SetValue($this->gurantor_dob_2->GetValue(true));
        $this->DataSource->gurantor_current_age_2->SetValue($this->gurantor_current_age_2->GetValue(true));
        $this->DataSource->added_by_2->SetValue($this->added_by_2->GetValue(true));
        $this->DataSource->added_at_2->SetValue($this->added_at_2->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-E5043B1B
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->la_id_2->SetValue($this->DataSource->la_id_2->GetValue());
                    $this->kyc_type_primary_1->SetValue($this->DataSource->kyc_type_primary_1->GetValue());
                    $this->kyc_id_primary_1->SetValue($this->DataSource->kyc_id_primary_1->GetValue());
                    $this->kyc_type_secondary_1->SetValue($this->DataSource->kyc_type_secondary_1->GetValue());
                    $this->kyc_id_secondary_1->SetValue($this->DataSource->kyc_id_secondary_1->GetValue());
                    $this->member_name_1->SetValue($this->DataSource->member_name_1->GetValue());
                    $this->member_relation_type_1->SetValue($this->DataSource->member_relation_type_1->GetValue());
                    $this->relation_name_1->SetValue($this->DataSource->relation_name_1->GetValue());
                    $this->member_age_1->SetValue($this->DataSource->member_age_1->GetValue());
                    $this->member_age_as_on_1->SetValue($this->DataSource->member_age_as_on_1->GetValue());
                    $this->date_of_birth_1->SetValue($this->DataSource->date_of_birth_1->GetValue());
                    $this->current_age_1->SetValue($this->DataSource->current_age_1->GetValue());
                    $this->member_address_1->SetValue($this->DataSource->member_address_1->GetValue());
                    $this->district_1->SetValue($this->DataSource->district_1->GetValue());
                    $this->pincode_1->SetValue($this->DataSource->pincode_1->GetValue());
                    $this->guarantor_kyc_type_primery_1->SetValue($this->DataSource->guarantor_kyc_type_primery_1->GetValue());
                    $this->guarantor_kyc_id_primery_1->SetValue($this->DataSource->guarantor_kyc_id_primery_1->GetValue());
                    $this->guarantor_kyc_type_secondry_1->SetValue($this->DataSource->guarantor_kyc_type_secondry_1->GetValue());
                    $this->guarantor_kyc_id_secondry_1->SetValue($this->DataSource->guarantor_kyc_id_secondry_1->GetValue());
                    $this->gurantor_age_ason_1->SetValue($this->DataSource->gurantor_age_ason_1->GetValue());
                    $this->gurantor_dob_1->SetValue($this->DataSource->gurantor_dob_1->GetValue());
                    $this->gurantor_current_age_1->SetValue($this->DataSource->gurantor_current_age_1->GetValue());
                    $this->added_by_1->SetValue($this->DataSource->added_by_1->GetValue());
                    $this->added_at_1->SetValue($this->DataSource->added_at_1->GetValue());
                    $this->test_result->SetValue($this->DataSource->test_result->GetValue());
                    $this->kyc_type_primary_2->SetValue($this->DataSource->kyc_type_primary_2->GetValue());
                    $this->kyc_id_primary_2->SetValue($this->DataSource->kyc_id_primary_2->GetValue());
                    $this->kyc_type_secondary_2->SetValue($this->DataSource->kyc_type_secondary_2->GetValue());
                    $this->kyc_id_secondary_2->SetValue($this->DataSource->kyc_id_secondary_2->GetValue());
                    $this->member_name_2->SetValue($this->DataSource->member_name_2->GetValue());
                    $this->member_relation_type_2->SetValue($this->DataSource->member_relation_type_2->GetValue());
                    $this->relation_name_2->SetValue($this->DataSource->relation_name_2->GetValue());
                    $this->member_age_2->SetValue($this->DataSource->member_age_2->GetValue());
                    $this->member_age_as_on_2->SetValue($this->DataSource->member_age_as_on_2->GetValue());
                    $this->date_of_birth_2->SetValue($this->DataSource->date_of_birth_2->GetValue());
                    $this->current_age_2->SetValue($this->DataSource->current_age_2->GetValue());
                    $this->member_address_2->SetValue($this->DataSource->member_address_2->GetValue());
                    $this->district_2->SetValue($this->DataSource->district_2->GetValue());
                    $this->pincode_2->SetValue($this->DataSource->pincode_2->GetValue());
                    $this->guarantor_kyc_type_primery_2->SetValue($this->DataSource->guarantor_kyc_type_primery_2->GetValue());
                    $this->guarantor_kyc_id_primery_2->SetValue($this->DataSource->guarantor_kyc_id_primery_2->GetValue());
                    $this->guarantor_kyc_type_secondry_2->SetValue($this->DataSource->guarantor_kyc_type_secondry_2->GetValue());
                    $this->guarantor_kyc_id_secondry_2->SetValue($this->DataSource->guarantor_kyc_id_secondry_2->GetValue());
                    $this->gurantor_age_1->SetValue($this->DataSource->gurantor_age_1->GetValue());
                    $this->gurantor_age_2->SetValue($this->DataSource->gurantor_age_2->GetValue());
                    $this->gurantor_age_ason_2->SetValue($this->DataSource->gurantor_age_ason_2->GetValue());
                    $this->gurantor_dob_2->SetValue($this->DataSource->gurantor_dob_2->GetValue());
                    $this->gurantor_current_age_2->SetValue($this->DataSource->gurantor_current_age_2->GetValue());
                    $this->added_by_2->SetValue($this->DataSource->added_by_2->GetValue());
                    $this->added_at_2->SetValue($this->DataSource->added_at_2->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->la_id_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_type_primary_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_id_primary_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_type_secondary_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_id_secondary_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_name_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_relation_type_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->relation_name_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_age_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_age_as_on_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_of_birth_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->current_age_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_address_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->district_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pincode_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->guarantor_kyc_type_primery_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->guarantor_kyc_id_primery_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->guarantor_kyc_type_secondry_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->guarantor_kyc_id_secondry_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_age_ason_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_dob_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_current_age_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_by_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_at_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->test_result->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_type_primary_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_id_primary_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_type_secondary_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kyc_id_secondary_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_name_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_relation_type_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->relation_name_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_age_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_age_as_on_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_of_birth_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->current_age_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_address_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->district_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pincode_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->guarantor_kyc_type_primery_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->guarantor_kyc_id_primery_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->guarantor_kyc_type_secondry_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->guarantor_kyc_id_secondry_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_age_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_age_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_age_ason_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_dob_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_current_age_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_by_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_at_2->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->la_id_2->Show();
        $this->kyc_type_primary_1->Show();
        $this->kyc_id_primary_1->Show();
        $this->kyc_type_secondary_1->Show();
        $this->kyc_id_secondary_1->Show();
        $this->member_name_1->Show();
        $this->member_relation_type_1->Show();
        $this->relation_name_1->Show();
        $this->member_age_1->Show();
        $this->member_age_as_on_1->Show();
        $this->date_of_birth_1->Show();
        $this->current_age_1->Show();
        $this->member_address_1->Show();
        $this->district_1->Show();
        $this->pincode_1->Show();
        $this->guarantor_kyc_type_primery_1->Show();
        $this->guarantor_kyc_id_primery_1->Show();
        $this->guarantor_kyc_type_secondry_1->Show();
        $this->guarantor_kyc_id_secondry_1->Show();
        $this->gurantor_age_ason_1->Show();
        $this->gurantor_dob_1->Show();
        $this->gurantor_current_age_1->Show();
        $this->added_by_1->Show();
        $this->added_at_1->Show();
        $this->test_result->Show();
        $this->kyc_type_primary_2->Show();
        $this->kyc_id_primary_2->Show();
        $this->kyc_type_secondary_2->Show();
        $this->kyc_id_secondary_2->Show();
        $this->member_name_2->Show();
        $this->member_relation_type_2->Show();
        $this->relation_name_2->Show();
        $this->member_age_2->Show();
        $this->member_age_as_on_2->Show();
        $this->date_of_birth_2->Show();
        $this->current_age_2->Show();
        $this->member_address_2->Show();
        $this->district_2->Show();
        $this->pincode_2->Show();
        $this->guarantor_kyc_type_primery_2->Show();
        $this->guarantor_kyc_id_primery_2->Show();
        $this->guarantor_kyc_type_secondry_2->Show();
        $this->guarantor_kyc_id_secondry_2->Show();
        $this->gurantor_age_1->Show();
        $this->gurantor_age_2->Show();
        $this->gurantor_age_ason_2->Show();
        $this->gurantor_dob_2->Show();
        $this->gurantor_current_age_2->Show();
        $this->added_by_2->Show();
        $this->added_at_2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_kyc Class @2-FCB6E20C

class clsmfi_kycDataSource extends clsDBmysql_cams_v2 {  //mfi_kycDataSource Class @2-51DA9DC9

//DataSource Variables @2-BCF8FE79
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
    public $la_id_2;
    public $kyc_type_primary_1;
    public $kyc_id_primary_1;
    public $kyc_type_secondary_1;
    public $kyc_id_secondary_1;
    public $member_name_1;
    public $member_relation_type_1;
    public $relation_name_1;
    public $member_age_1;
    public $member_age_as_on_1;
    public $date_of_birth_1;
    public $current_age_1;
    public $member_address_1;
    public $district_1;
    public $pincode_1;
    public $guarantor_kyc_type_primery_1;
    public $guarantor_kyc_id_primery_1;
    public $guarantor_kyc_type_secondry_1;
    public $guarantor_kyc_id_secondry_1;
    public $gurantor_age_ason_1;
    public $gurantor_dob_1;
    public $gurantor_current_age_1;
    public $added_by_1;
    public $added_at_1;
    public $test_result;
    public $kyc_type_primary_2;
    public $kyc_id_primary_2;
    public $kyc_type_secondary_2;
    public $kyc_id_secondary_2;
    public $member_name_2;
    public $member_relation_type_2;
    public $relation_name_2;
    public $member_age_2;
    public $member_age_as_on_2;
    public $date_of_birth_2;
    public $current_age_2;
    public $member_address_2;
    public $district_2;
    public $pincode_2;
    public $guarantor_kyc_type_primery_2;
    public $guarantor_kyc_id_primery_2;
    public $guarantor_kyc_type_secondry_2;
    public $guarantor_kyc_id_secondry_2;
    public $gurantor_age_1;
    public $gurantor_age_2;
    public $gurantor_age_ason_2;
    public $gurantor_dob_2;
    public $gurantor_current_age_2;
    public $added_by_2;
    public $added_at_2;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3C913D21
    function clsmfi_kycDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_kyc/Error";
        $this->Initialize();
        $this->la_id_2 = new clsField("la_id_2", ccsText, "");
        
        $this->kyc_type_primary_1 = new clsField("kyc_type_primary_1", ccsText, "");
        
        $this->kyc_id_primary_1 = new clsField("kyc_id_primary_1", ccsText, "");
        
        $this->kyc_type_secondary_1 = new clsField("kyc_type_secondary_1", ccsText, "");
        
        $this->kyc_id_secondary_1 = new clsField("kyc_id_secondary_1", ccsText, "");
        
        $this->member_name_1 = new clsField("member_name_1", ccsText, "");
        
        $this->member_relation_type_1 = new clsField("member_relation_type_1", ccsText, "");
        
        $this->relation_name_1 = new clsField("relation_name_1", ccsText, "");
        
        $this->member_age_1 = new clsField("member_age_1", ccsInteger, "");
        
        $this->member_age_as_on_1 = new clsField("member_age_as_on_1", ccsText, "");
        
        $this->date_of_birth_1 = new clsField("date_of_birth_1", ccsText, "");
        
        $this->current_age_1 = new clsField("current_age_1", ccsInteger, "");
        
        $this->member_address_1 = new clsField("member_address_1", ccsText, "");
        
        $this->district_1 = new clsField("district_1", ccsText, "");
        
        $this->pincode_1 = new clsField("pincode_1", ccsInteger, "");
        
        $this->guarantor_kyc_type_primery_1 = new clsField("guarantor_kyc_type_primery_1", ccsText, "");
        
        $this->guarantor_kyc_id_primery_1 = new clsField("guarantor_kyc_id_primery_1", ccsText, "");
        
        $this->guarantor_kyc_type_secondry_1 = new clsField("guarantor_kyc_type_secondry_1", ccsText, "");
        
        $this->guarantor_kyc_id_secondry_1 = new clsField("guarantor_kyc_id_secondry_1", ccsText, "");
        
        $this->gurantor_age_ason_1 = new clsField("gurantor_age_ason_1", ccsText, "");
        
        $this->gurantor_dob_1 = new clsField("gurantor_dob_1", ccsText, "");
        
        $this->gurantor_current_age_1 = new clsField("gurantor_current_age_1", ccsInteger, "");
        
        $this->added_by_1 = new clsField("added_by_1", ccsText, "");
        
        $this->added_at_1 = new clsField("added_at_1", ccsDate, $this->DateFormat);
        
        $this->test_result = new clsField("test_result", ccsText, "");
        
        $this->kyc_type_primary_2 = new clsField("kyc_type_primary_2", ccsText, "");
        
        $this->kyc_id_primary_2 = new clsField("kyc_id_primary_2", ccsText, "");
        
        $this->kyc_type_secondary_2 = new clsField("kyc_type_secondary_2", ccsText, "");
        
        $this->kyc_id_secondary_2 = new clsField("kyc_id_secondary_2", ccsText, "");
        
        $this->member_name_2 = new clsField("member_name_2", ccsText, "");
        
        $this->member_relation_type_2 = new clsField("member_relation_type_2", ccsText, "");
        
        $this->relation_name_2 = new clsField("relation_name_2", ccsText, "");
        
        $this->member_age_2 = new clsField("member_age_2", ccsInteger, "");
        
        $this->member_age_as_on_2 = new clsField("member_age_as_on_2", ccsText, "");
        
        $this->date_of_birth_2 = new clsField("date_of_birth_2", ccsText, "");
        
        $this->current_age_2 = new clsField("current_age_2", ccsInteger, "");
        
        $this->member_address_2 = new clsField("member_address_2", ccsText, "");
        
        $this->district_2 = new clsField("district_2", ccsText, "");
        
        $this->pincode_2 = new clsField("pincode_2", ccsInteger, "");
        
        $this->guarantor_kyc_type_primery_2 = new clsField("guarantor_kyc_type_primery_2", ccsText, "");
        
        $this->guarantor_kyc_id_primery_2 = new clsField("guarantor_kyc_id_primery_2", ccsText, "");
        
        $this->guarantor_kyc_type_secondry_2 = new clsField("guarantor_kyc_type_secondry_2", ccsText, "");
        
        $this->guarantor_kyc_id_secondry_2 = new clsField("guarantor_kyc_id_secondry_2", ccsText, "");
        
        $this->gurantor_age_1 = new clsField("gurantor_age_1", ccsInteger, "");
        
        $this->gurantor_age_2 = new clsField("gurantor_age_2", ccsInteger, "");
        
        $this->gurantor_age_ason_2 = new clsField("gurantor_age_ason_2", ccsText, "");
        
        $this->gurantor_dob_2 = new clsField("gurantor_dob_2", ccsText, "");
        
        $this->gurantor_current_age_2 = new clsField("gurantor_current_age_2", ccsInteger, "");
        
        $this->added_by_2 = new clsField("added_by_2", ccsText, "");
        
        $this->added_at_2 = new clsField("added_at_2", ccsDate, $this->DateFormat);
        

        $this->UpdateFields["la_id"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_type_primary_1"] = array("Name" => "kyc_type_primary_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_id_primary_1"] = array("Name" => "kyc_id_primary_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_type_secondary_1"] = array("Name" => "kyc_type_secondary_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_id_secondary_1"] = array("Name" => "kyc_id_secondary_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_name_1"] = array("Name" => "member_name_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_relation_type_1"] = array("Name" => "member_relation_type_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["relation_name_1"] = array("Name" => "relation_name_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_age_1"] = array("Name" => "member_age_1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_age_as_on_1"] = array("Name" => "member_age_as_on_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["date_of_birth_1"] = array("Name" => "date_of_birth_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["current_age_1"] = array("Name" => "current_age_1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_address_1"] = array("Name" => "member_address_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["district_1"] = array("Name" => "district_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["pincode_1"] = array("Name" => "pincode_1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_type_primery_1"] = array("Name" => "guarantor_kyc_type_primery_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_id_primery_1"] = array("Name" => "guarantor_kyc_id_primery_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_type_secondry_1"] = array("Name" => "guarantor_kyc_type_secondry_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_id_secondry_1"] = array("Name" => "guarantor_kyc_id_secondry_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_age_ason_1"] = array("Name" => "gurantor_age_ason_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_dob_1"] = array("Name" => "gurantor_dob_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_current_age_1"] = array("Name" => "gurantor_current_age_1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["added_by_1"] = array("Name" => "added_by_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["added_at_1"] = array("Name" => "added_at_1", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["test_result"] = array("Name" => "test_result", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_type_primary_2"] = array("Name" => "kyc_type_primary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_id_primary_2"] = array("Name" => "kyc_id_primary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_type_secondary_2"] = array("Name" => "kyc_type_secondary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["kyc_id_secondary_2"] = array("Name" => "kyc_id_secondary_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_name_2"] = array("Name" => "member_name_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_relation_type_2"] = array("Name" => "member_relation_type_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["relation_name_2"] = array("Name" => "relation_name_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_age_2"] = array("Name" => "member_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_age_as_on_2"] = array("Name" => "member_age_as_on_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["date_of_birth_2"] = array("Name" => "date_of_birth_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["current_age_2"] = array("Name" => "current_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["member_address_2"] = array("Name" => "member_address_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["district_2"] = array("Name" => "district_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["pincode_2"] = array("Name" => "pincode_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_type_primery_2"] = array("Name" => "guarantor_kyc_type_primery_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_id_primery_2"] = array("Name" => "guarantor_kyc_id_primery_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_type_secondry_2"] = array("Name" => "guarantor_kyc_type_secondry_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["guarantor_kyc_id_secondry_2"] = array("Name" => "guarantor_kyc_id_secondry_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_age_1"] = array("Name" => "gurantor_age_1", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_age_2"] = array("Name" => "gurantor_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_age_ason_2"] = array("Name" => "gurantor_age_ason_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_dob_2"] = array("Name" => "gurantor_dob_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gurantor_current_age_2"] = array("Name" => "gurantor_current_age_2", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["added_by_2"] = array("Name" => "added_by_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["added_at_2"] = array("Name" => "added_at_2", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
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

//Open Method @2-BBABA8FE
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

//SetValues Method @2-C8221E5D
    function SetValues()
    {
        $this->la_id_2->SetDBValue($this->f("la_id"));
        $this->kyc_type_primary_1->SetDBValue($this->f("kyc_type_primary_1"));
        $this->kyc_id_primary_1->SetDBValue($this->f("kyc_id_primary_1"));
        $this->kyc_type_secondary_1->SetDBValue($this->f("kyc_type_secondary_1"));
        $this->kyc_id_secondary_1->SetDBValue($this->f("kyc_id_secondary_1"));
        $this->member_name_1->SetDBValue($this->f("member_name_1"));
        $this->member_relation_type_1->SetDBValue($this->f("member_relation_type_1"));
        $this->relation_name_1->SetDBValue($this->f("relation_name_1"));
        $this->member_age_1->SetDBValue(trim($this->f("member_age_1")));
        $this->member_age_as_on_1->SetDBValue($this->f("member_age_as_on_1"));
        $this->date_of_birth_1->SetDBValue($this->f("date_of_birth_1"));
        $this->current_age_1->SetDBValue(trim($this->f("current_age_1")));
        $this->member_address_1->SetDBValue($this->f("member_address_1"));
        $this->district_1->SetDBValue($this->f("district_1"));
        $this->pincode_1->SetDBValue(trim($this->f("pincode_1")));
        $this->guarantor_kyc_type_primery_1->SetDBValue($this->f("guarantor_kyc_type_primery_1"));
        $this->guarantor_kyc_id_primery_1->SetDBValue($this->f("guarantor_kyc_id_primery_1"));
        $this->guarantor_kyc_type_secondry_1->SetDBValue($this->f("guarantor_kyc_type_secondry_1"));
        $this->guarantor_kyc_id_secondry_1->SetDBValue($this->f("guarantor_kyc_id_secondry_1"));
        $this->gurantor_age_ason_1->SetDBValue($this->f("gurantor_age_ason_1"));
        $this->gurantor_dob_1->SetDBValue($this->f("gurantor_dob_1"));
        $this->gurantor_current_age_1->SetDBValue(trim($this->f("gurantor_current_age_1")));
        $this->added_by_1->SetDBValue($this->f("added_by_1"));
        $this->added_at_1->SetDBValue(trim($this->f("added_at_1")));
        $this->test_result->SetDBValue($this->f("test_result"));
        $this->kyc_type_primary_2->SetDBValue($this->f("kyc_type_primary_2"));
        $this->kyc_id_primary_2->SetDBValue($this->f("kyc_id_primary_2"));
        $this->kyc_type_secondary_2->SetDBValue($this->f("kyc_type_secondary_2"));
        $this->kyc_id_secondary_2->SetDBValue($this->f("kyc_id_secondary_2"));
        $this->member_name_2->SetDBValue($this->f("member_name_2"));
        $this->member_relation_type_2->SetDBValue($this->f("member_relation_type_2"));
        $this->relation_name_2->SetDBValue($this->f("relation_name_2"));
        $this->member_age_2->SetDBValue(trim($this->f("member_age_2")));
        $this->member_age_as_on_2->SetDBValue($this->f("member_age_as_on_2"));
        $this->date_of_birth_2->SetDBValue($this->f("date_of_birth_2"));
        $this->current_age_2->SetDBValue(trim($this->f("current_age_2")));
        $this->member_address_2->SetDBValue($this->f("member_address_2"));
        $this->district_2->SetDBValue($this->f("district_2"));
        $this->pincode_2->SetDBValue(trim($this->f("pincode_2")));
        $this->guarantor_kyc_type_primery_2->SetDBValue($this->f("guarantor_kyc_type_primery_2"));
        $this->guarantor_kyc_id_primery_2->SetDBValue($this->f("guarantor_kyc_id_primery_2"));
        $this->guarantor_kyc_type_secondry_2->SetDBValue($this->f("guarantor_kyc_type_secondry_2"));
        $this->guarantor_kyc_id_secondry_2->SetDBValue($this->f("guarantor_kyc_id_secondry_2"));
        $this->gurantor_age_1->SetDBValue(trim($this->f("gurantor_age_1")));
        $this->gurantor_age_2->SetDBValue(trim($this->f("gurantor_age_2")));
        $this->gurantor_age_ason_2->SetDBValue($this->f("gurantor_age_ason_2"));
        $this->gurantor_dob_2->SetDBValue($this->f("gurantor_dob_2"));
        $this->gurantor_current_age_2->SetDBValue(trim($this->f("gurantor_current_age_2")));
        $this->added_by_2->SetDBValue($this->f("added_by_2"));
        $this->added_at_2->SetDBValue(trim($this->f("added_at_2")));
    }
//End SetValues Method

//Update Method @2-6E27619F
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["la_id"]["Value"] = $this->la_id_2->GetDBValue(true);
        $this->UpdateFields["kyc_type_primary_1"]["Value"] = $this->kyc_type_primary_1->GetDBValue(true);
        $this->UpdateFields["kyc_id_primary_1"]["Value"] = $this->kyc_id_primary_1->GetDBValue(true);
        $this->UpdateFields["kyc_type_secondary_1"]["Value"] = $this->kyc_type_secondary_1->GetDBValue(true);
        $this->UpdateFields["kyc_id_secondary_1"]["Value"] = $this->kyc_id_secondary_1->GetDBValue(true);
        $this->UpdateFields["member_name_1"]["Value"] = $this->member_name_1->GetDBValue(true);
        $this->UpdateFields["member_relation_type_1"]["Value"] = $this->member_relation_type_1->GetDBValue(true);
        $this->UpdateFields["relation_name_1"]["Value"] = $this->relation_name_1->GetDBValue(true);
        $this->UpdateFields["member_age_1"]["Value"] = $this->member_age_1->GetDBValue(true);
        $this->UpdateFields["member_age_as_on_1"]["Value"] = $this->member_age_as_on_1->GetDBValue(true);
        $this->UpdateFields["date_of_birth_1"]["Value"] = $this->date_of_birth_1->GetDBValue(true);
        $this->UpdateFields["current_age_1"]["Value"] = $this->current_age_1->GetDBValue(true);
        $this->UpdateFields["member_address_1"]["Value"] = $this->member_address_1->GetDBValue(true);
        $this->UpdateFields["district_1"]["Value"] = $this->district_1->GetDBValue(true);
        $this->UpdateFields["pincode_1"]["Value"] = $this->pincode_1->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_type_primery_1"]["Value"] = $this->guarantor_kyc_type_primery_1->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_id_primery_1"]["Value"] = $this->guarantor_kyc_id_primery_1->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_type_secondry_1"]["Value"] = $this->guarantor_kyc_type_secondry_1->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_id_secondry_1"]["Value"] = $this->guarantor_kyc_id_secondry_1->GetDBValue(true);
        $this->UpdateFields["gurantor_age_ason_1"]["Value"] = $this->gurantor_age_ason_1->GetDBValue(true);
        $this->UpdateFields["gurantor_dob_1"]["Value"] = $this->gurantor_dob_1->GetDBValue(true);
        $this->UpdateFields["gurantor_current_age_1"]["Value"] = $this->gurantor_current_age_1->GetDBValue(true);
        $this->UpdateFields["added_by_1"]["Value"] = $this->added_by_1->GetDBValue(true);
        $this->UpdateFields["added_at_1"]["Value"] = $this->added_at_1->GetDBValue(true);
        $this->UpdateFields["test_result"]["Value"] = $this->test_result->GetDBValue(true);
        $this->UpdateFields["kyc_type_primary_2"]["Value"] = $this->kyc_type_primary_2->GetDBValue(true);
        $this->UpdateFields["kyc_id_primary_2"]["Value"] = $this->kyc_id_primary_2->GetDBValue(true);
        $this->UpdateFields["kyc_type_secondary_2"]["Value"] = $this->kyc_type_secondary_2->GetDBValue(true);
        $this->UpdateFields["kyc_id_secondary_2"]["Value"] = $this->kyc_id_secondary_2->GetDBValue(true);
        $this->UpdateFields["member_name_2"]["Value"] = $this->member_name_2->GetDBValue(true);
        $this->UpdateFields["member_relation_type_2"]["Value"] = $this->member_relation_type_2->GetDBValue(true);
        $this->UpdateFields["relation_name_2"]["Value"] = $this->relation_name_2->GetDBValue(true);
        $this->UpdateFields["member_age_2"]["Value"] = $this->member_age_2->GetDBValue(true);
        $this->UpdateFields["member_age_as_on_2"]["Value"] = $this->member_age_as_on_2->GetDBValue(true);
        $this->UpdateFields["date_of_birth_2"]["Value"] = $this->date_of_birth_2->GetDBValue(true);
        $this->UpdateFields["current_age_2"]["Value"] = $this->current_age_2->GetDBValue(true);
        $this->UpdateFields["member_address_2"]["Value"] = $this->member_address_2->GetDBValue(true);
        $this->UpdateFields["district_2"]["Value"] = $this->district_2->GetDBValue(true);
        $this->UpdateFields["pincode_2"]["Value"] = $this->pincode_2->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_type_primery_2"]["Value"] = $this->guarantor_kyc_type_primery_2->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_id_primery_2"]["Value"] = $this->guarantor_kyc_id_primery_2->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_type_secondry_2"]["Value"] = $this->guarantor_kyc_type_secondry_2->GetDBValue(true);
        $this->UpdateFields["guarantor_kyc_id_secondry_2"]["Value"] = $this->guarantor_kyc_id_secondry_2->GetDBValue(true);
        $this->UpdateFields["gurantor_age_1"]["Value"] = $this->gurantor_age_1->GetDBValue(true);
        $this->UpdateFields["gurantor_age_2"]["Value"] = $this->gurantor_age_2->GetDBValue(true);
        $this->UpdateFields["gurantor_age_ason_2"]["Value"] = $this->gurantor_age_ason_2->GetDBValue(true);
        $this->UpdateFields["gurantor_dob_2"]["Value"] = $this->gurantor_dob_2->GetDBValue(true);
        $this->UpdateFields["gurantor_current_age_2"]["Value"] = $this->gurantor_current_age_2->GetDBValue(true);
        $this->UpdateFields["added_by_2"]["Value"] = $this->added_by_2->GetDBValue(true);
        $this->UpdateFields["added_at_2"]["Value"] = $this->added_at_2->GetDBValue(true);
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

} //End mfi_kycDataSource Class @2-FCB6E20C



//Initialize Page @1-5825A5A8
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
$TemplateFileName = "KYCUPD.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B498D536
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_kyc = new clsRecordmfi_kyc("", $MainPage);
$MainPage->mfi_kyc = & $mfi_kyc;
$mfi_kyc->Initialize();

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

//Execute Components @1-A63DD994
$mfi_kyc->Operation();
//End Execute Components

//Go to destination page @1-C0D40AD4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_kyc);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-51631257
$mfi_kyc->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-97C213B2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_kyc);
unset($Tpl);
//End Unload Page


?>
