<?php
//Include Common Files @1-4062BA1C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "CPform.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsRecordmfi_cp { //mfi_cp Class @2-A7137B87

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

//Class_Initialize Event @2-DFAF09A4
    function clsRecordmfi_cp($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_cp/Error";
        $this->DataSource = new clsmfi_cpDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_cp";
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
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            $this->mfi_cp_district = new clsControl(ccsTextBox, "mfi_cp_district", "District", ccsText, "", CCGetRequestParam("mfi_cp_district", $Method, NULL), $this);
            $this->mfi_cp_district->Required = true;
            $this->mfi_cp_centre_name = new clsControl(ccsTextBox, "mfi_cp_centre_name", "Centre Name", ccsText, "", CCGetRequestParam("mfi_cp_centre_name", $Method, NULL), $this);
            $this->mfi_cp_centre_name->Required = true;
            $this->mfi_cp_co_name = new clsControl(ccsTextBox, "mfi_cp_co_name", "Co Name", ccsText, "", CCGetRequestParam("mfi_cp_co_name", $Method, NULL), $this);
            $this->mfi_cp_co_emp_code = new clsControl(ccsTextBox, "mfi_cp_co_emp_code", "Co Emp Code", ccsText, "", CCGetRequestParam("mfi_cp_co_emp_code", $Method, NULL), $this);
            $this->mfi_cp_location_type = new clsControl(ccsTextBox, "mfi_cp_location_type", "Location Type", ccsText, "", CCGetRequestParam("mfi_cp_location_type", $Method, NULL), $this);
            $this->mfi_cp_licensor = new clsControl(ccsTextBox, "mfi_cp_licensor", "Licensor", ccsText, "", CCGetRequestParam("mfi_cp_licensor", $Method, NULL), $this);
            $this->mfi_cp_licensee = new clsControl(ccsTextBox, "mfi_cp_licensee", "Licensee", ccsText, "", CCGetRequestParam("mfi_cp_licensee", $Method, NULL), $this);
            $this->mfi_cp_date = new clsControl(ccsTextBox, "mfi_cp_date", "Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("mfi_cp_date", $Method, NULL), $this);
            $this->mfi_cp_witness1_name = new clsControl(ccsTextBox, "mfi_cp_witness1_name", "Witness1 Name", ccsText, "", CCGetRequestParam("mfi_cp_witness1_name", $Method, NULL), $this);
            $this->mfi_cp_witness1_address = new clsControl(ccsTextBox, "mfi_cp_witness1_address", "Witness1 Address", ccsText, "", CCGetRequestParam("mfi_cp_witness1_address", $Method, NULL), $this);
            $this->mfi_cp_witness2_name = new clsControl(ccsTextBox, "mfi_cp_witness2_name", "Witness2 Name", ccsText, "", CCGetRequestParam("mfi_cp_witness2_name", $Method, NULL), $this);
            $this->mfi_cp_witness2_address = new clsControl(ccsTextBox, "mfi_cp_witness2_address", "Witness2 Address", ccsText, "", CCGetRequestParam("mfi_cp_witness2_address", $Method, NULL), $this);
            $this->cp_route = new clsControl(ccsTextBox, "cp_route", "No", ccsText, "", CCGetRequestParam("cp_route", $Method, NULL), $this);
            $this->cp_route->Required = true;
            $this->mfi_cp_proposal_date = new clsControl(ccsTextBox, "mfi_cp_proposal_date", "Proposal Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("mfi_cp_proposal_date", $Method, NULL), $this);
            $this->mfi_cp_proposal_date->Required = true;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->formmode = new clsControl(ccsHidden, "formmode", "formmode", ccsText, "", CCGetRequestParam("formmode", $Method, NULL), $this);
            $this->mfi_cp_relogin_no = new clsControl(ccsTextBox, "mfi_cp_relogin_no", "mfi_cp_relogin_no", ccsText, "", CCGetRequestParam("mfi_cp_relogin_no", $Method, NULL), $this);
            $this->mfi_cp_licensor_contact_no = new clsControl(ccsTextBox, "mfi_cp_licensor_contact_no", "mfi_cp_licensor_contact_no", ccsText, "", CCGetRequestParam("mfi_cp_licensor_contact_no", $Method, NULL), $this);
            $this->mfi_cp_place = new clsControl(ccsTextBox, "mfi_cp_place", "Place", ccsText, "", CCGetRequestParam("mfi_cp_place", $Method, NULL), $this);
            $this->cp_id = new clsControl(ccsTextBox, "cp_id", "cp_id", ccsText, "", CCGetRequestParam("cp_id", $Method, NULL), $this);
            $this->cp_id->Required = true;
            $this->mfi_cp_1st_meeting_week_and_day_of_the_month = new clsControl(ccsTextBox, "mfi_cp_1st_meeting_week_and_day_of_the_month", "1st Meeting Week And Day Of The Month", ccsText, "", CCGetRequestParam("mfi_cp_1st_meeting_week_and_day_of_the_month", $Method, NULL), $this);
            $this->mfi_cp_meeting_frequency = new clsControl(ccsTextBox, "mfi_cp_meeting_frequency", "Meeting Frequency", ccsText, "", CCGetRequestParam("mfi_cp_meeting_frequency", $Method, NULL), $this);
            $this->mfi_cp_distance_from_region_or_branch = new clsControl(ccsTextBox, "mfi_cp_distance_from_region_or_branch", "Distance From Region Or Branch", ccsText, "", CCGetRequestParam("mfi_cp_distance_from_region_or_branch", $Method, NULL), $this);
            $this->user_login = new clsControl(ccsHidden, "user_login", "user_login", ccsText, "", CCGetRequestParam("user_login", $Method, NULL), $this);
            $this->user_login->Required = true;
            $this->RadioButton2 = new clsControl(ccsRadioButton, "RadioButton2", "RadioButton2", ccsText, "", CCGetRequestParam("RadioButton2", $Method, NULL), $this);
            $this->RadioButton2->DSType = dsListOfValues;
            $this->RadioButton2->Values = array(array("RURAL", "RURAL"), array("URBAN", "URBAN"));
            $this->RadioButton2->HTML = true;
            $this->census_village = new clsControl(ccsTextBox, "census_village", "census_village", ccsText, "", CCGetRequestParam("census_village", $Method, NULL), $this);
            $this->village_code = new clsControl(ccsTextBox, "village_code", "village_code", ccsText, "", CCGetRequestParam("village_code", $Method, NULL), $this);
            $this->mfi_cp_address = new clsControl(ccsTextBox, "mfi_cp_address", "mfi_cp_address", ccsText, "", CCGetRequestParam("mfi_cp_address", $Method, NULL), $this);
            $this->mfi_cp_village_or_locality = new clsControl(ccsTextBox, "mfi_cp_village_or_locality", "Village Or Locality", ccsText, "", CCGetRequestParam("mfi_cp_village_or_locality", $Method, NULL), $this);
            $this->mfi_cp_pincode = new clsControl(ccsTextBox, "mfi_cp_pincode", "Pincode", ccsText, "", CCGetRequestParam("mfi_cp_pincode", $Method, NULL), $this);
            $this->mfi_cp_pincode->Required = true;
            $this->mfi_cp_taluk_or_town1 = new clsControl(ccsTextBox, "mfi_cp_taluk_or_town1", "Taluk Or Town", ccsText, "", CCGetRequestParam("mfi_cp_taluk_or_town1", $Method, NULL), $this);
            $this->mfi_cp_taluk_or_town1->Required = true;
            $this->other_location_type = new clsControl(ccsTextBox, "other_location_type", "other_location_type", ccsText, "", CCGetRequestParam("other_location_type", $Method, NULL), $this);
            $this->mfi_cp_weekly_meeting_time_from = new clsControl(ccsListBox, "mfi_cp_weekly_meeting_time_from", "mfi_cp_weekly_meeting_time_from", ccsText, "", CCGetRequestParam("mfi_cp_weekly_meeting_time_from", $Method, NULL), $this);
            $this->mfi_cp_weekly_meeting_time_from->DSType = dsListOfValues;
            $this->mfi_cp_weekly_meeting_time_from->Values = array(array("07:00", "07:00"), array("07:15", "07:15"), array("07:30", "07:30"), array("07:45", "07:45"), array("08:00", "08:00"), array("08:15", "08:15"), array("08:30", "08:30"), array("08:45", "08:45"), array("09:00", "09:00"), array("09:15", "09:15"), array("09:30", "09:30"), array("09:45", "09:45"), array("10:00", "10:00"), array("10:15", "10:15"), array("10:30", "10:30"), array("10:45", "10:45"), array("11:00", "11:00"), array("11:15", "11:15"), array("11:30", "11:30"), array("11:45", "11:45"), array("12:00", "12:00"), array("12:15", "12:15"), array("12:30", "12:30"), array("12:45", "12:45"), array("13:00", "13:00"));
            $this->mfi_cp_weekly_meeting_time_to = new clsControl(ccsListBox, "mfi_cp_weekly_meeting_time_to", "mfi_cp_weekly_meeting_time_to", ccsText, "", CCGetRequestParam("mfi_cp_weekly_meeting_time_to", $Method, NULL), $this);
            $this->mfi_cp_weekly_meeting_time_to->DSType = dsTable;
            $this->mfi_cp_weekly_meeting_time_to->DataSource = new clsDBmysql_cams_v2();
            $this->mfi_cp_weekly_meeting_time_to->ds = & $this->mfi_cp_weekly_meeting_time_to->DataSource;
            $this->mfi_cp_weekly_meeting_time_to->DataSource->SQL = "SELECT * \n" .
"FROM mfi_cp {SQL_Where} {SQL_OrderBy}";
            list($this->mfi_cp_weekly_meeting_time_to->BoundColumn, $this->mfi_cp_weekly_meeting_time_to->TextColumn, $this->mfi_cp_weekly_meeting_time_to->DBFormat) = array("mfi_cp_monthly_meeting_time_to", "mfi_cp_monthly_meeting_time_to", "");
            $this->mfi_cp_latitude1 = new clsControl(ccsTextBox, "mfi_cp_latitude1", "Latitude1", ccsText, "", CCGetRequestParam("mfi_cp_latitude1", $Method, NULL), $this);
            $this->mfi_cp_latitude2 = new clsControl(ccsTextBox, "mfi_cp_latitude2", "Latitude2", ccsText, "", CCGetRequestParam("mfi_cp_latitude2", $Method, NULL), $this);
            $this->mfi_cp_longitude1 = new clsControl(ccsTextBox, "mfi_cp_longitude1", "Longitude1", ccsText, "", CCGetRequestParam("mfi_cp_longitude1", $Method, NULL), $this);
            $this->mfi_cp_longitude2 = new clsControl(ccsTextBox, "mfi_cp_longitude2", "Longitude2", ccsText, "", CCGetRequestParam("mfi_cp_longitude2", $Method, NULL), $this);
            $this->efimo_group_code = new clsControl(ccsTextBox, "efimo_group_code", "efimo_group_code", ccsText, "", CCGetRequestParam("efimo_group_code", $Method, NULL), $this);
            $this->added_at = new clsControl(ccsHidden, "added_at", "added_at", ccsText, "", CCGetRequestParam("added_at", $Method, NULL), $this);
            $this->updated_by = new clsControl(ccsHidden, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->updated_at = new clsControl(ccsHidden, "updated_at", "updated_at", ccsText, "", CCGetRequestParam("updated_at", $Method, NULL), $this);
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

//Validate Method @2-83975535
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->cp_route->GetText()) && !preg_match ("/^(1)[0-9]{1,1}(-RT)[0-9]{2,2}(-)[a-zA-Z]{2,2}[0-9]{2,2}(-)[a-zA-Z]{5,5}(-)[a-zA-Z]{3,3}[a-zA-Z0-9]{2,2}$/", $this->cp_route->GetText())) {
            $this->cp_route->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "No"));
        }
        if(strlen($this->mfi_cp_relogin_no->GetText()) && !preg_match ("/^\d{5}$/", $this->mfi_cp_relogin_no->GetText())) {
            $this->mfi_cp_relogin_no->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "mfi_cp_relogin_no"));
        }
        if(strlen($this->cp_id->GetText()) && !preg_match ("/^[a-zA-Z]{2,2}[0-9]{5,5}$/", $this->cp_id->GetText())) {
            $this->cp_id->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "cp_id"));
        }
        if(strlen($this->mfi_cp_pincode->GetText()) && !preg_match ("/^\d{6}$/", $this->mfi_cp_pincode->GetText())) {
            $this->mfi_cp_pincode->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Pincode"));
        }
        $Validation = ($this->mfi_cp_district->Validate() && $Validation);
        $Validation = ($this->mfi_cp_centre_name->Validate() && $Validation);
        $Validation = ($this->mfi_cp_co_name->Validate() && $Validation);
        $Validation = ($this->mfi_cp_co_emp_code->Validate() && $Validation);
        $Validation = ($this->mfi_cp_location_type->Validate() && $Validation);
        $Validation = ($this->mfi_cp_licensor->Validate() && $Validation);
        $Validation = ($this->mfi_cp_licensee->Validate() && $Validation);
        $Validation = ($this->mfi_cp_date->Validate() && $Validation);
        $Validation = ($this->mfi_cp_witness1_name->Validate() && $Validation);
        $Validation = ($this->mfi_cp_witness1_address->Validate() && $Validation);
        $Validation = ($this->mfi_cp_witness2_name->Validate() && $Validation);
        $Validation = ($this->mfi_cp_witness2_address->Validate() && $Validation);
        $Validation = ($this->cp_route->Validate() && $Validation);
        $Validation = ($this->mfi_cp_proposal_date->Validate() && $Validation);
        $Validation = ($this->formmode->Validate() && $Validation);
        $Validation = ($this->mfi_cp_relogin_no->Validate() && $Validation);
        $Validation = ($this->mfi_cp_licensor_contact_no->Validate() && $Validation);
        $Validation = ($this->mfi_cp_place->Validate() && $Validation);
        $Validation = ($this->cp_id->Validate() && $Validation);
        $Validation = ($this->mfi_cp_1st_meeting_week_and_day_of_the_month->Validate() && $Validation);
        $Validation = ($this->mfi_cp_meeting_frequency->Validate() && $Validation);
        $Validation = ($this->mfi_cp_distance_from_region_or_branch->Validate() && $Validation);
        $Validation = ($this->user_login->Validate() && $Validation);
        $Validation = ($this->RadioButton2->Validate() && $Validation);
        $Validation = ($this->census_village->Validate() && $Validation);
        $Validation = ($this->village_code->Validate() && $Validation);
        $Validation = ($this->mfi_cp_address->Validate() && $Validation);
        $Validation = ($this->mfi_cp_village_or_locality->Validate() && $Validation);
        $Validation = ($this->mfi_cp_pincode->Validate() && $Validation);
        $Validation = ($this->mfi_cp_taluk_or_town1->Validate() && $Validation);
        $Validation = ($this->other_location_type->Validate() && $Validation);
        $Validation = ($this->mfi_cp_weekly_meeting_time_from->Validate() && $Validation);
        $Validation = ($this->mfi_cp_weekly_meeting_time_to->Validate() && $Validation);
        $Validation = ($this->mfi_cp_latitude1->Validate() && $Validation);
        $Validation = ($this->mfi_cp_latitude2->Validate() && $Validation);
        $Validation = ($this->mfi_cp_longitude1->Validate() && $Validation);
        $Validation = ($this->mfi_cp_longitude2->Validate() && $Validation);
        $Validation = ($this->efimo_group_code->Validate() && $Validation);
        $Validation = ($this->added_at->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->updated_at->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_cp_district->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_centre_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_co_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_co_emp_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_location_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_licensor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_licensee->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_witness1_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_witness1_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_witness2_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_witness2_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cp_route->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_proposal_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->formmode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_relogin_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_licensor_contact_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_place->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cp_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_1st_meeting_week_and_day_of_the_month->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_meeting_frequency->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_distance_from_region_or_branch->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user_login->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RadioButton2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->census_village->Errors->Count() == 0);
        $Validation =  $Validation && ($this->village_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_village_or_locality->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_pincode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_taluk_or_town1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->other_location_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_weekly_meeting_time_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_weekly_meeting_time_to->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_latitude1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_latitude2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_longitude1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_cp_longitude2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->efimo_group_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_at->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-4AFE73D4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_cp_district->Errors->Count());
        $errors = ($errors || $this->mfi_cp_centre_name->Errors->Count());
        $errors = ($errors || $this->mfi_cp_co_name->Errors->Count());
        $errors = ($errors || $this->mfi_cp_co_emp_code->Errors->Count());
        $errors = ($errors || $this->mfi_cp_location_type->Errors->Count());
        $errors = ($errors || $this->mfi_cp_licensor->Errors->Count());
        $errors = ($errors || $this->mfi_cp_licensee->Errors->Count());
        $errors = ($errors || $this->mfi_cp_date->Errors->Count());
        $errors = ($errors || $this->mfi_cp_witness1_name->Errors->Count());
        $errors = ($errors || $this->mfi_cp_witness1_address->Errors->Count());
        $errors = ($errors || $this->mfi_cp_witness2_name->Errors->Count());
        $errors = ($errors || $this->mfi_cp_witness2_address->Errors->Count());
        $errors = ($errors || $this->cp_route->Errors->Count());
        $errors = ($errors || $this->mfi_cp_proposal_date->Errors->Count());
        $errors = ($errors || $this->formmode->Errors->Count());
        $errors = ($errors || $this->mfi_cp_relogin_no->Errors->Count());
        $errors = ($errors || $this->mfi_cp_licensor_contact_no->Errors->Count());
        $errors = ($errors || $this->mfi_cp_place->Errors->Count());
        $errors = ($errors || $this->cp_id->Errors->Count());
        $errors = ($errors || $this->mfi_cp_1st_meeting_week_and_day_of_the_month->Errors->Count());
        $errors = ($errors || $this->mfi_cp_meeting_frequency->Errors->Count());
        $errors = ($errors || $this->mfi_cp_distance_from_region_or_branch->Errors->Count());
        $errors = ($errors || $this->user_login->Errors->Count());
        $errors = ($errors || $this->RadioButton2->Errors->Count());
        $errors = ($errors || $this->census_village->Errors->Count());
        $errors = ($errors || $this->village_code->Errors->Count());
        $errors = ($errors || $this->mfi_cp_address->Errors->Count());
        $errors = ($errors || $this->mfi_cp_village_or_locality->Errors->Count());
        $errors = ($errors || $this->mfi_cp_pincode->Errors->Count());
        $errors = ($errors || $this->mfi_cp_taluk_or_town1->Errors->Count());
        $errors = ($errors || $this->other_location_type->Errors->Count());
        $errors = ($errors || $this->mfi_cp_weekly_meeting_time_from->Errors->Count());
        $errors = ($errors || $this->mfi_cp_weekly_meeting_time_to->Errors->Count());
        $errors = ($errors || $this->mfi_cp_latitude1->Errors->Count());
        $errors = ($errors || $this->mfi_cp_latitude2->Errors->Count());
        $errors = ($errors || $this->mfi_cp_longitude1->Errors->Count());
        $errors = ($errors || $this->mfi_cp_longitude2->Errors->Count());
        $errors = ($errors || $this->efimo_group_code->Errors->Count());
        $errors = ($errors || $this->added_at->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->updated_at->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-B4EF80C2
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
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
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

//InsertRow Method @2-6B3384F2
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->mfi_cp_district->SetValue($this->mfi_cp_district->GetValue(true));
        $this->DataSource->mfi_cp_centre_name->SetValue($this->mfi_cp_centre_name->GetValue(true));
        $this->DataSource->mfi_cp_co_name->SetValue($this->mfi_cp_co_name->GetValue(true));
        $this->DataSource->mfi_cp_co_emp_code->SetValue($this->mfi_cp_co_emp_code->GetValue(true));
        $this->DataSource->mfi_cp_location_type->SetValue($this->mfi_cp_location_type->GetValue(true));
        $this->DataSource->mfi_cp_licensor->SetValue($this->mfi_cp_licensor->GetValue(true));
        $this->DataSource->mfi_cp_licensee->SetValue($this->mfi_cp_licensee->GetValue(true));
        $this->DataSource->mfi_cp_date->SetValue($this->mfi_cp_date->GetValue(true));
        $this->DataSource->mfi_cp_witness1_name->SetValue($this->mfi_cp_witness1_name->GetValue(true));
        $this->DataSource->mfi_cp_witness1_address->SetValue($this->mfi_cp_witness1_address->GetValue(true));
        $this->DataSource->mfi_cp_witness2_name->SetValue($this->mfi_cp_witness2_name->GetValue(true));
        $this->DataSource->mfi_cp_witness2_address->SetValue($this->mfi_cp_witness2_address->GetValue(true));
        $this->DataSource->cp_route->SetValue($this->cp_route->GetValue(true));
        $this->DataSource->mfi_cp_proposal_date->SetValue($this->mfi_cp_proposal_date->GetValue(true));
        $this->DataSource->formmode->SetValue($this->formmode->GetValue(true));
        $this->DataSource->mfi_cp_relogin_no->SetValue($this->mfi_cp_relogin_no->GetValue(true));
        $this->DataSource->mfi_cp_licensor_contact_no->SetValue($this->mfi_cp_licensor_contact_no->GetValue(true));
        $this->DataSource->mfi_cp_place->SetValue($this->mfi_cp_place->GetValue(true));
        $this->DataSource->cp_id->SetValue($this->cp_id->GetValue(true));
        $this->DataSource->mfi_cp_1st_meeting_week_and_day_of_the_month->SetValue($this->mfi_cp_1st_meeting_week_and_day_of_the_month->GetValue(true));
        $this->DataSource->mfi_cp_meeting_frequency->SetValue($this->mfi_cp_meeting_frequency->GetValue(true));
        $this->DataSource->mfi_cp_distance_from_region_or_branch->SetValue($this->mfi_cp_distance_from_region_or_branch->GetValue(true));
        $this->DataSource->user_login->SetValue($this->user_login->GetValue(true));
        $this->DataSource->RadioButton2->SetValue($this->RadioButton2->GetValue(true));
        $this->DataSource->census_village->SetValue($this->census_village->GetValue(true));
        $this->DataSource->village_code->SetValue($this->village_code->GetValue(true));
        $this->DataSource->mfi_cp_address->SetValue($this->mfi_cp_address->GetValue(true));
        $this->DataSource->mfi_cp_village_or_locality->SetValue($this->mfi_cp_village_or_locality->GetValue(true));
        $this->DataSource->mfi_cp_pincode->SetValue($this->mfi_cp_pincode->GetValue(true));
        $this->DataSource->mfi_cp_taluk_or_town1->SetValue($this->mfi_cp_taluk_or_town1->GetValue(true));
        $this->DataSource->other_location_type->SetValue($this->other_location_type->GetValue(true));
        $this->DataSource->mfi_cp_weekly_meeting_time_from->SetValue($this->mfi_cp_weekly_meeting_time_from->GetValue(true));
        $this->DataSource->mfi_cp_weekly_meeting_time_to->SetValue($this->mfi_cp_weekly_meeting_time_to->GetValue(true));
        $this->DataSource->mfi_cp_latitude1->SetValue($this->mfi_cp_latitude1->GetValue(true));
        $this->DataSource->mfi_cp_latitude2->SetValue($this->mfi_cp_latitude2->GetValue(true));
        $this->DataSource->mfi_cp_longitude1->SetValue($this->mfi_cp_longitude1->GetValue(true));
        $this->DataSource->mfi_cp_longitude2->SetValue($this->mfi_cp_longitude2->GetValue(true));
        $this->DataSource->efimo_group_code->SetValue($this->efimo_group_code->GetValue(true));
        $this->DataSource->added_at->SetValue($this->added_at->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->updated_at->SetValue($this->updated_at->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-CF91850C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->mfi_cp_district->SetValue($this->mfi_cp_district->GetValue(true));
        $this->DataSource->mfi_cp_centre_name->SetValue($this->mfi_cp_centre_name->GetValue(true));
        $this->DataSource->mfi_cp_co_name->SetValue($this->mfi_cp_co_name->GetValue(true));
        $this->DataSource->mfi_cp_co_emp_code->SetValue($this->mfi_cp_co_emp_code->GetValue(true));
        $this->DataSource->mfi_cp_location_type->SetValue($this->mfi_cp_location_type->GetValue(true));
        $this->DataSource->mfi_cp_licensor->SetValue($this->mfi_cp_licensor->GetValue(true));
        $this->DataSource->mfi_cp_licensee->SetValue($this->mfi_cp_licensee->GetValue(true));
        $this->DataSource->mfi_cp_date->SetValue($this->mfi_cp_date->GetValue(true));
        $this->DataSource->mfi_cp_witness1_name->SetValue($this->mfi_cp_witness1_name->GetValue(true));
        $this->DataSource->mfi_cp_witness1_address->SetValue($this->mfi_cp_witness1_address->GetValue(true));
        $this->DataSource->mfi_cp_witness2_name->SetValue($this->mfi_cp_witness2_name->GetValue(true));
        $this->DataSource->mfi_cp_witness2_address->SetValue($this->mfi_cp_witness2_address->GetValue(true));
        $this->DataSource->cp_route->SetValue($this->cp_route->GetValue(true));
        $this->DataSource->mfi_cp_proposal_date->SetValue($this->mfi_cp_proposal_date->GetValue(true));
        $this->DataSource->formmode->SetValue($this->formmode->GetValue(true));
        $this->DataSource->mfi_cp_relogin_no->SetValue($this->mfi_cp_relogin_no->GetValue(true));
        $this->DataSource->mfi_cp_licensor_contact_no->SetValue($this->mfi_cp_licensor_contact_no->GetValue(true));
        $this->DataSource->mfi_cp_place->SetValue($this->mfi_cp_place->GetValue(true));
        $this->DataSource->cp_id->SetValue($this->cp_id->GetValue(true));
        $this->DataSource->mfi_cp_1st_meeting_week_and_day_of_the_month->SetValue($this->mfi_cp_1st_meeting_week_and_day_of_the_month->GetValue(true));
        $this->DataSource->mfi_cp_meeting_frequency->SetValue($this->mfi_cp_meeting_frequency->GetValue(true));
        $this->DataSource->mfi_cp_distance_from_region_or_branch->SetValue($this->mfi_cp_distance_from_region_or_branch->GetValue(true));
        $this->DataSource->user_login->SetValue($this->user_login->GetValue(true));
        $this->DataSource->RadioButton2->SetValue($this->RadioButton2->GetValue(true));
        $this->DataSource->census_village->SetValue($this->census_village->GetValue(true));
        $this->DataSource->village_code->SetValue($this->village_code->GetValue(true));
        $this->DataSource->mfi_cp_address->SetValue($this->mfi_cp_address->GetValue(true));
        $this->DataSource->mfi_cp_village_or_locality->SetValue($this->mfi_cp_village_or_locality->GetValue(true));
        $this->DataSource->mfi_cp_pincode->SetValue($this->mfi_cp_pincode->GetValue(true));
        $this->DataSource->mfi_cp_taluk_or_town1->SetValue($this->mfi_cp_taluk_or_town1->GetValue(true));
        $this->DataSource->other_location_type->SetValue($this->other_location_type->GetValue(true));
        $this->DataSource->mfi_cp_weekly_meeting_time_from->SetValue($this->mfi_cp_weekly_meeting_time_from->GetValue(true));
        $this->DataSource->mfi_cp_weekly_meeting_time_to->SetValue($this->mfi_cp_weekly_meeting_time_to->GetValue(true));
        $this->DataSource->mfi_cp_latitude1->SetValue($this->mfi_cp_latitude1->GetValue(true));
        $this->DataSource->mfi_cp_latitude2->SetValue($this->mfi_cp_latitude2->GetValue(true));
        $this->DataSource->mfi_cp_longitude1->SetValue($this->mfi_cp_longitude1->GetValue(true));
        $this->DataSource->mfi_cp_longitude2->SetValue($this->mfi_cp_longitude2->GetValue(true));
        $this->DataSource->efimo_group_code->SetValue($this->efimo_group_code->GetValue(true));
        $this->DataSource->added_at->SetValue($this->added_at->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->updated_at->SetValue($this->updated_at->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-0074A06C
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

        $this->RadioButton2->Prepare();
        $this->mfi_cp_weekly_meeting_time_from->Prepare();
        $this->mfi_cp_weekly_meeting_time_to->Prepare();

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
                    $this->mfi_cp_district->SetValue($this->DataSource->mfi_cp_district->GetValue());
                    $this->mfi_cp_centre_name->SetValue($this->DataSource->mfi_cp_centre_name->GetValue());
                    $this->mfi_cp_co_name->SetValue($this->DataSource->mfi_cp_co_name->GetValue());
                    $this->mfi_cp_co_emp_code->SetValue($this->DataSource->mfi_cp_co_emp_code->GetValue());
                    $this->mfi_cp_location_type->SetValue($this->DataSource->mfi_cp_location_type->GetValue());
                    $this->mfi_cp_licensor->SetValue($this->DataSource->mfi_cp_licensor->GetValue());
                    $this->mfi_cp_licensee->SetValue($this->DataSource->mfi_cp_licensee->GetValue());
                    $this->mfi_cp_date->SetValue($this->DataSource->mfi_cp_date->GetValue());
                    $this->mfi_cp_witness1_name->SetValue($this->DataSource->mfi_cp_witness1_name->GetValue());
                    $this->mfi_cp_witness1_address->SetValue($this->DataSource->mfi_cp_witness1_address->GetValue());
                    $this->mfi_cp_witness2_name->SetValue($this->DataSource->mfi_cp_witness2_name->GetValue());
                    $this->mfi_cp_witness2_address->SetValue($this->DataSource->mfi_cp_witness2_address->GetValue());
                    $this->cp_route->SetValue($this->DataSource->cp_route->GetValue());
                    $this->mfi_cp_proposal_date->SetValue($this->DataSource->mfi_cp_proposal_date->GetValue());
                    $this->mfi_cp_relogin_no->SetValue($this->DataSource->mfi_cp_relogin_no->GetValue());
                    $this->mfi_cp_licensor_contact_no->SetValue($this->DataSource->mfi_cp_licensor_contact_no->GetValue());
                    $this->mfi_cp_place->SetValue($this->DataSource->mfi_cp_place->GetValue());
                    $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                    $this->mfi_cp_1st_meeting_week_and_day_of_the_month->SetValue($this->DataSource->mfi_cp_1st_meeting_week_and_day_of_the_month->GetValue());
                    $this->mfi_cp_meeting_frequency->SetValue($this->DataSource->mfi_cp_meeting_frequency->GetValue());
                    $this->mfi_cp_distance_from_region_or_branch->SetValue($this->DataSource->mfi_cp_distance_from_region_or_branch->GetValue());
                    $this->user_login->SetValue($this->DataSource->user_login->GetValue());
                    $this->RadioButton2->SetValue($this->DataSource->RadioButton2->GetValue());
                    $this->census_village->SetValue($this->DataSource->census_village->GetValue());
                    $this->village_code->SetValue($this->DataSource->village_code->GetValue());
                    $this->mfi_cp_address->SetValue($this->DataSource->mfi_cp_address->GetValue());
                    $this->mfi_cp_village_or_locality->SetValue($this->DataSource->mfi_cp_village_or_locality->GetValue());
                    $this->mfi_cp_pincode->SetValue($this->DataSource->mfi_cp_pincode->GetValue());
                    $this->mfi_cp_taluk_or_town1->SetValue($this->DataSource->mfi_cp_taluk_or_town1->GetValue());
                    $this->mfi_cp_weekly_meeting_time_from->SetValue($this->DataSource->mfi_cp_weekly_meeting_time_from->GetValue());
                    $this->mfi_cp_weekly_meeting_time_to->SetValue($this->DataSource->mfi_cp_weekly_meeting_time_to->GetValue());
                    $this->mfi_cp_latitude1->SetValue($this->DataSource->mfi_cp_latitude1->GetValue());
                    $this->mfi_cp_latitude2->SetValue($this->DataSource->mfi_cp_latitude2->GetValue());
                    $this->mfi_cp_longitude1->SetValue($this->DataSource->mfi_cp_longitude1->GetValue());
                    $this->mfi_cp_longitude2->SetValue($this->DataSource->mfi_cp_longitude2->GetValue());
                    $this->efimo_group_code->SetValue($this->DataSource->efimo_group_code->GetValue());
                    $this->added_at->SetValue($this->DataSource->added_at->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->updated_at->SetValue($this->DataSource->updated_at->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_cp_district->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_centre_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_co_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_co_emp_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_location_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_licensor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_licensee->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_witness1_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_witness1_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_witness2_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_witness2_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cp_route->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_proposal_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->formmode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_relogin_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_licensor_contact_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_place->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cp_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_1st_meeting_week_and_day_of_the_month->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_meeting_frequency->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_distance_from_region_or_branch->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user_login->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RadioButton2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->census_village->Errors->ToString());
            $Error = ComposeStrings($Error, $this->village_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_village_or_locality->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_pincode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_taluk_or_town1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->other_location_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_weekly_meeting_time_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_weekly_meeting_time_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_latitude1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_latitude2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_longitude1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_cp_longitude2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->efimo_group_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_at->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Cancel->Show();
        $this->mfi_cp_district->Show();
        $this->mfi_cp_centre_name->Show();
        $this->mfi_cp_co_name->Show();
        $this->mfi_cp_co_emp_code->Show();
        $this->mfi_cp_location_type->Show();
        $this->mfi_cp_licensor->Show();
        $this->mfi_cp_licensee->Show();
        $this->mfi_cp_date->Show();
        $this->mfi_cp_witness1_name->Show();
        $this->mfi_cp_witness1_address->Show();
        $this->mfi_cp_witness2_name->Show();
        $this->mfi_cp_witness2_address->Show();
        $this->cp_route->Show();
        $this->mfi_cp_proposal_date->Show();
        $this->Button_Update->Show();
        $this->formmode->Show();
        $this->mfi_cp_relogin_no->Show();
        $this->mfi_cp_licensor_contact_no->Show();
        $this->mfi_cp_place->Show();
        $this->cp_id->Show();
        $this->mfi_cp_1st_meeting_week_and_day_of_the_month->Show();
        $this->mfi_cp_meeting_frequency->Show();
        $this->mfi_cp_distance_from_region_or_branch->Show();
        $this->user_login->Show();
        $this->RadioButton2->Show();
        $this->census_village->Show();
        $this->village_code->Show();
        $this->mfi_cp_address->Show();
        $this->mfi_cp_village_or_locality->Show();
        $this->mfi_cp_pincode->Show();
        $this->mfi_cp_taluk_or_town1->Show();
        $this->other_location_type->Show();
        $this->mfi_cp_weekly_meeting_time_from->Show();
        $this->mfi_cp_weekly_meeting_time_to->Show();
        $this->mfi_cp_latitude1->Show();
        $this->mfi_cp_latitude2->Show();
        $this->mfi_cp_longitude1->Show();
        $this->mfi_cp_longitude2->Show();
        $this->efimo_group_code->Show();
        $this->added_at->Show();
        $this->updated_by->Show();
        $this->updated_at->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_cp Class @2-FCB6E20C

class clsmfi_cpDataSource extends clsDBmysql_cams_v2 {  //mfi_cpDataSource Class @2-666E11D4

//DataSource Variables @2-20B94010
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
    public $mfi_cp_district;
    public $mfi_cp_centre_name;
    public $mfi_cp_co_name;
    public $mfi_cp_co_emp_code;
    public $mfi_cp_location_type;
    public $mfi_cp_licensor;
    public $mfi_cp_licensee;
    public $mfi_cp_date;
    public $mfi_cp_witness1_name;
    public $mfi_cp_witness1_address;
    public $mfi_cp_witness2_name;
    public $mfi_cp_witness2_address;
    public $cp_route;
    public $mfi_cp_proposal_date;
    public $formmode;
    public $mfi_cp_relogin_no;
    public $mfi_cp_licensor_contact_no;
    public $mfi_cp_place;
    public $cp_id;
    public $mfi_cp_1st_meeting_week_and_day_of_the_month;
    public $mfi_cp_meeting_frequency;
    public $mfi_cp_distance_from_region_or_branch;
    public $user_login;
    public $RadioButton2;
    public $census_village;
    public $village_code;
    public $mfi_cp_address;
    public $mfi_cp_village_or_locality;
    public $mfi_cp_pincode;
    public $mfi_cp_taluk_or_town1;
    public $other_location_type;
    public $mfi_cp_weekly_meeting_time_from;
    public $mfi_cp_weekly_meeting_time_to;
    public $mfi_cp_latitude1;
    public $mfi_cp_latitude2;
    public $mfi_cp_longitude1;
    public $mfi_cp_longitude2;
    public $efimo_group_code;
    public $added_at;
    public $updated_by;
    public $updated_at;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-CA6BA0E5
    function clsmfi_cpDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_cp/Error";
        $this->Initialize();
        $this->mfi_cp_district = new clsField("mfi_cp_district", ccsText, "");
        
        $this->mfi_cp_centre_name = new clsField("mfi_cp_centre_name", ccsText, "");
        
        $this->mfi_cp_co_name = new clsField("mfi_cp_co_name", ccsText, "");
        
        $this->mfi_cp_co_emp_code = new clsField("mfi_cp_co_emp_code", ccsText, "");
        
        $this->mfi_cp_location_type = new clsField("mfi_cp_location_type", ccsText, "");
        
        $this->mfi_cp_licensor = new clsField("mfi_cp_licensor", ccsText, "");
        
        $this->mfi_cp_licensee = new clsField("mfi_cp_licensee", ccsText, "");
        
        $this->mfi_cp_date = new clsField("mfi_cp_date", ccsDate, $this->DateFormat);
        
        $this->mfi_cp_witness1_name = new clsField("mfi_cp_witness1_name", ccsText, "");
        
        $this->mfi_cp_witness1_address = new clsField("mfi_cp_witness1_address", ccsText, "");
        
        $this->mfi_cp_witness2_name = new clsField("mfi_cp_witness2_name", ccsText, "");
        
        $this->mfi_cp_witness2_address = new clsField("mfi_cp_witness2_address", ccsText, "");
        
        $this->cp_route = new clsField("cp_route", ccsText, "");
        
        $this->mfi_cp_proposal_date = new clsField("mfi_cp_proposal_date", ccsDate, $this->DateFormat);
        
        $this->formmode = new clsField("formmode", ccsText, "");
        
        $this->mfi_cp_relogin_no = new clsField("mfi_cp_relogin_no", ccsText, "");
        
        $this->mfi_cp_licensor_contact_no = new clsField("mfi_cp_licensor_contact_no", ccsText, "");
        
        $this->mfi_cp_place = new clsField("mfi_cp_place", ccsText, "");
        
        $this->cp_id = new clsField("cp_id", ccsText, "");
        
        $this->mfi_cp_1st_meeting_week_and_day_of_the_month = new clsField("mfi_cp_1st_meeting_week_and_day_of_the_month", ccsText, "");
        
        $this->mfi_cp_meeting_frequency = new clsField("mfi_cp_meeting_frequency", ccsText, "");
        
        $this->mfi_cp_distance_from_region_or_branch = new clsField("mfi_cp_distance_from_region_or_branch", ccsText, "");
        
        $this->user_login = new clsField("user_login", ccsText, "");
        
        $this->RadioButton2 = new clsField("RadioButton2", ccsText, "");
        
        $this->census_village = new clsField("census_village", ccsText, "");
        
        $this->village_code = new clsField("village_code", ccsText, "");
        
        $this->mfi_cp_address = new clsField("mfi_cp_address", ccsText, "");
        
        $this->mfi_cp_village_or_locality = new clsField("mfi_cp_village_or_locality", ccsText, "");
        
        $this->mfi_cp_pincode = new clsField("mfi_cp_pincode", ccsText, "");
        
        $this->mfi_cp_taluk_or_town1 = new clsField("mfi_cp_taluk_or_town1", ccsText, "");
        
        $this->other_location_type = new clsField("other_location_type", ccsText, "");
        
        $this->mfi_cp_weekly_meeting_time_from = new clsField("mfi_cp_weekly_meeting_time_from", ccsText, "");
        
        $this->mfi_cp_weekly_meeting_time_to = new clsField("mfi_cp_weekly_meeting_time_to", ccsText, "");
        
        $this->mfi_cp_latitude1 = new clsField("mfi_cp_latitude1", ccsText, "");
        
        $this->mfi_cp_latitude2 = new clsField("mfi_cp_latitude2", ccsText, "");
        
        $this->mfi_cp_longitude1 = new clsField("mfi_cp_longitude1", ccsText, "");
        
        $this->mfi_cp_longitude2 = new clsField("mfi_cp_longitude2", ccsText, "");
        
        $this->efimo_group_code = new clsField("efimo_group_code", ccsText, "");
        
        $this->added_at = new clsField("added_at", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->updated_at = new clsField("updated_at", ccsText, "");
        

        $this->InsertFields["mfi_cp_district"] = array("Name" => "mfi_cp_district", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_centre_name"] = array("Name" => "mfi_cp_centre_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_co_name"] = array("Name" => "mfi_cp_co_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_co_emp_code"] = array("Name" => "mfi_cp_co_emp_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_location_type"] = array("Name" => "mfi_cp_location_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_licensor"] = array("Name" => "mfi_cp_licensor", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_licensee"] = array("Name" => "mfi_cp_licensee", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_date"] = array("Name" => "mfi_cp_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_witness1_name"] = array("Name" => "mfi_cp_witness1_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_witness1_address"] = array("Name" => "mfi_cp_witness1_address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_witness2_name"] = array("Name" => "mfi_cp_witness2_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_witness2_address"] = array("Name" => "mfi_cp_witness2_address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cp_route"] = array("Name" => "cp_route", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_proposal_date"] = array("Name" => "mfi_cp_proposal_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_relogin_cp_id"] = array("Name" => "mfi_cp_relogin_cp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_licensor_contact_no"] = array("Name" => "mfi_cp_licensor_contact_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_place"] = array("Name" => "mfi_cp_place", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cp_id"] = array("Name" => "cp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_1st_meeting_week_and_day_of_the_month"] = array("Name" => "mfi_cp_1st_meeting_week_and_day_of_the_month", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_meeting_frequency"] = array("Name" => "mfi_cp_meeting_frequency", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_distance_from_region_or_branch"] = array("Name" => "mfi_cp_distance_from_region_or_branch", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["added_by"] = array("Name" => "added_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_rural_urban"] = array("Name" => "mfi_cp_rural_urban", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_census_village"] = array("Name" => "mfi_cp_census_village", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_cansus_village_code"] = array("Name" => "mfi_cp_cansus_village_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_address1"] = array("Name" => "mfi_cp_address1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_village_or_locality"] = array("Name" => "mfi_cp_village_or_locality", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_pincode"] = array("Name" => "mfi_cp_pincode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_taluk_or_town"] = array("Name" => "mfi_cp_taluk_or_town", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_monthly_meeting_time_from"] = array("Name" => "mfi_cp_monthly_meeting_time_from", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_monthly_meeting_time_to"] = array("Name" => "mfi_cp_monthly_meeting_time_to", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_latitude1"] = array("Name" => "mfi_cp_latitude1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_latitude2"] = array("Name" => "mfi_cp_latitude2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_longitude1"] = array("Name" => "mfi_cp_longitude1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_longitude2"] = array("Name" => "mfi_cp_longitude2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_cp_efimo_group_code"] = array("Name" => "mfi_cp_efimo_group_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["added_at"] = array("Name" => "added_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["updated_by"] = array("Name" => "updated_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["updated_at"] = array("Name" => "updated_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_district"] = array("Name" => "mfi_cp_district", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_centre_name"] = array("Name" => "mfi_cp_centre_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_co_name"] = array("Name" => "mfi_cp_co_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_co_emp_code"] = array("Name" => "mfi_cp_co_emp_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_location_type"] = array("Name" => "mfi_cp_location_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_licensor"] = array("Name" => "mfi_cp_licensor", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_licensee"] = array("Name" => "mfi_cp_licensee", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_date"] = array("Name" => "mfi_cp_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_witness1_name"] = array("Name" => "mfi_cp_witness1_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_witness1_address"] = array("Name" => "mfi_cp_witness1_address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_witness2_name"] = array("Name" => "mfi_cp_witness2_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_witness2_address"] = array("Name" => "mfi_cp_witness2_address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cp_route"] = array("Name" => "cp_route", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_proposal_date"] = array("Name" => "mfi_cp_proposal_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_relogin_cp_id"] = array("Name" => "mfi_cp_relogin_cp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_licensor_contact_no"] = array("Name" => "mfi_cp_licensor_contact_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_place"] = array("Name" => "mfi_cp_place", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cp_id"] = array("Name" => "cp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_1st_meeting_week_and_day_of_the_month"] = array("Name" => "mfi_cp_1st_meeting_week_and_day_of_the_month", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_meeting_frequency"] = array("Name" => "mfi_cp_meeting_frequency", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_distance_from_region_or_branch"] = array("Name" => "mfi_cp_distance_from_region_or_branch", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["added_by"] = array("Name" => "added_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_rural_urban"] = array("Name" => "mfi_cp_rural_urban", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_census_village"] = array("Name" => "mfi_cp_census_village", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_cansus_village_code"] = array("Name" => "mfi_cp_cansus_village_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_address1"] = array("Name" => "mfi_cp_address1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_village_or_locality"] = array("Name" => "mfi_cp_village_or_locality", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_pincode"] = array("Name" => "mfi_cp_pincode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_taluk_or_town"] = array("Name" => "mfi_cp_taluk_or_town", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_monthly_meeting_time_from"] = array("Name" => "mfi_cp_monthly_meeting_time_from", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_monthly_meeting_time_to"] = array("Name" => "mfi_cp_monthly_meeting_time_to", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_latitude1"] = array("Name" => "mfi_cp_latitude1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_latitude2"] = array("Name" => "mfi_cp_latitude2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_longitude1"] = array("Name" => "mfi_cp_longitude1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_longitude2"] = array("Name" => "mfi_cp_longitude2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_cp_efimo_group_code"] = array("Name" => "mfi_cp_efimo_group_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["added_at"] = array("Name" => "added_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["updated_by"] = array("Name" => "updated_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["updated_at"] = array("Name" => "updated_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-C3F05413
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urldoc_code", ccsText, "", "", $this->Parameters["urldoc_code"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "cp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-955BC8DF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_cp {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-A8458FB5
    function SetValues()
    {
        $this->mfi_cp_district->SetDBValue($this->f("mfi_cp_district"));
        $this->mfi_cp_centre_name->SetDBValue($this->f("mfi_cp_centre_name"));
        $this->mfi_cp_co_name->SetDBValue($this->f("mfi_cp_co_name"));
        $this->mfi_cp_co_emp_code->SetDBValue($this->f("mfi_cp_co_emp_code"));
        $this->mfi_cp_location_type->SetDBValue($this->f("mfi_cp_location_type"));
        $this->mfi_cp_licensor->SetDBValue($this->f("mfi_cp_licensor"));
        $this->mfi_cp_licensee->SetDBValue($this->f("mfi_cp_licensee"));
        $this->mfi_cp_date->SetDBValue(trim($this->f("mfi_cp_date")));
        $this->mfi_cp_witness1_name->SetDBValue($this->f("mfi_cp_witness1_name"));
        $this->mfi_cp_witness1_address->SetDBValue($this->f("mfi_cp_witness1_address"));
        $this->mfi_cp_witness2_name->SetDBValue($this->f("mfi_cp_witness2_name"));
        $this->mfi_cp_witness2_address->SetDBValue($this->f("mfi_cp_witness2_address"));
        $this->cp_route->SetDBValue($this->f("cp_route"));
        $this->mfi_cp_proposal_date->SetDBValue(trim($this->f("mfi_cp_proposal_date")));
        $this->mfi_cp_relogin_no->SetDBValue($this->f("mfi_cp_relogin_cp_id"));
        $this->mfi_cp_licensor_contact_no->SetDBValue($this->f("mfi_cp_licensor_contact_no"));
        $this->mfi_cp_place->SetDBValue($this->f("mfi_cp_place"));
        $this->cp_id->SetDBValue($this->f("cp_id"));
        $this->mfi_cp_1st_meeting_week_and_day_of_the_month->SetDBValue($this->f("mfi_cp_1st_meeting_week_and_day_of_the_month"));
        $this->mfi_cp_meeting_frequency->SetDBValue($this->f("mfi_cp_meeting_frequency"));
        $this->mfi_cp_distance_from_region_or_branch->SetDBValue($this->f("mfi_cp_distance_from_region_or_branch"));
        $this->user_login->SetDBValue($this->f("added_by"));
        $this->RadioButton2->SetDBValue($this->f("mfi_cp_rural_urban"));
        $this->census_village->SetDBValue($this->f("mfi_cp_census_village"));
        $this->village_code->SetDBValue($this->f("mfi_cp_cansus_village_code"));
        $this->mfi_cp_address->SetDBValue($this->f("mfi_cp_address1"));
        $this->mfi_cp_village_or_locality->SetDBValue($this->f("mfi_cp_village_or_locality"));
        $this->mfi_cp_pincode->SetDBValue($this->f("mfi_cp_pincode"));
        $this->mfi_cp_taluk_or_town1->SetDBValue($this->f("mfi_cp_taluk_or_town"));
        $this->mfi_cp_weekly_meeting_time_from->SetDBValue($this->f("mfi_cp_monthly_meeting_time_from"));
        $this->mfi_cp_weekly_meeting_time_to->SetDBValue($this->f("mfi_cp_monthly_meeting_time_to"));
        $this->mfi_cp_latitude1->SetDBValue($this->f("mfi_cp_latitude1"));
        $this->mfi_cp_latitude2->SetDBValue($this->f("mfi_cp_latitude2"));
        $this->mfi_cp_longitude1->SetDBValue($this->f("mfi_cp_longitude1"));
        $this->mfi_cp_longitude2->SetDBValue($this->f("mfi_cp_longitude2"));
        $this->efimo_group_code->SetDBValue($this->f("mfi_cp_efimo_group_code"));
        $this->added_at->SetDBValue($this->f("added_at"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->updated_at->SetDBValue($this->f("updated_at"));
    }
//End SetValues Method

//Insert Method @2-D6191227
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["mfi_cp_district"]["Value"] = $this->mfi_cp_district->GetDBValue(true);
        $this->InsertFields["mfi_cp_centre_name"]["Value"] = $this->mfi_cp_centre_name->GetDBValue(true);
        $this->InsertFields["mfi_cp_co_name"]["Value"] = $this->mfi_cp_co_name->GetDBValue(true);
        $this->InsertFields["mfi_cp_co_emp_code"]["Value"] = $this->mfi_cp_co_emp_code->GetDBValue(true);
        $this->InsertFields["mfi_cp_location_type"]["Value"] = $this->mfi_cp_location_type->GetDBValue(true);
        $this->InsertFields["mfi_cp_licensor"]["Value"] = $this->mfi_cp_licensor->GetDBValue(true);
        $this->InsertFields["mfi_cp_licensee"]["Value"] = $this->mfi_cp_licensee->GetDBValue(true);
        $this->InsertFields["mfi_cp_date"]["Value"] = $this->mfi_cp_date->GetDBValue(true);
        $this->InsertFields["mfi_cp_witness1_name"]["Value"] = $this->mfi_cp_witness1_name->GetDBValue(true);
        $this->InsertFields["mfi_cp_witness1_address"]["Value"] = $this->mfi_cp_witness1_address->GetDBValue(true);
        $this->InsertFields["mfi_cp_witness2_name"]["Value"] = $this->mfi_cp_witness2_name->GetDBValue(true);
        $this->InsertFields["mfi_cp_witness2_address"]["Value"] = $this->mfi_cp_witness2_address->GetDBValue(true);
        $this->InsertFields["cp_route"]["Value"] = $this->cp_route->GetDBValue(true);
        $this->InsertFields["mfi_cp_proposal_date"]["Value"] = $this->mfi_cp_proposal_date->GetDBValue(true);
        $this->InsertFields["mfi_cp_relogin_cp_id"]["Value"] = $this->mfi_cp_relogin_no->GetDBValue(true);
        $this->InsertFields["mfi_cp_licensor_contact_no"]["Value"] = $this->mfi_cp_licensor_contact_no->GetDBValue(true);
        $this->InsertFields["mfi_cp_place"]["Value"] = $this->mfi_cp_place->GetDBValue(true);
        $this->InsertFields["cp_id"]["Value"] = $this->cp_id->GetDBValue(true);
        $this->InsertFields["mfi_cp_1st_meeting_week_and_day_of_the_month"]["Value"] = $this->mfi_cp_1st_meeting_week_and_day_of_the_month->GetDBValue(true);
        $this->InsertFields["mfi_cp_meeting_frequency"]["Value"] = $this->mfi_cp_meeting_frequency->GetDBValue(true);
        $this->InsertFields["mfi_cp_distance_from_region_or_branch"]["Value"] = $this->mfi_cp_distance_from_region_or_branch->GetDBValue(true);
        $this->InsertFields["added_by"]["Value"] = $this->user_login->GetDBValue(true);
        $this->InsertFields["mfi_cp_rural_urban"]["Value"] = $this->RadioButton2->GetDBValue(true);
        $this->InsertFields["mfi_cp_census_village"]["Value"] = $this->census_village->GetDBValue(true);
        $this->InsertFields["mfi_cp_cansus_village_code"]["Value"] = $this->village_code->GetDBValue(true);
        $this->InsertFields["mfi_cp_address1"]["Value"] = $this->mfi_cp_address->GetDBValue(true);
        $this->InsertFields["mfi_cp_village_or_locality"]["Value"] = $this->mfi_cp_village_or_locality->GetDBValue(true);
        $this->InsertFields["mfi_cp_pincode"]["Value"] = $this->mfi_cp_pincode->GetDBValue(true);
        $this->InsertFields["mfi_cp_taluk_or_town"]["Value"] = $this->mfi_cp_taluk_or_town1->GetDBValue(true);
        $this->InsertFields["mfi_cp_monthly_meeting_time_from"]["Value"] = $this->mfi_cp_weekly_meeting_time_from->GetDBValue(true);
        $this->InsertFields["mfi_cp_monthly_meeting_time_to"]["Value"] = $this->mfi_cp_weekly_meeting_time_to->GetDBValue(true);
        $this->InsertFields["mfi_cp_latitude1"]["Value"] = $this->mfi_cp_latitude1->GetDBValue(true);
        $this->InsertFields["mfi_cp_latitude2"]["Value"] = $this->mfi_cp_latitude2->GetDBValue(true);
        $this->InsertFields["mfi_cp_longitude1"]["Value"] = $this->mfi_cp_longitude1->GetDBValue(true);
        $this->InsertFields["mfi_cp_longitude2"]["Value"] = $this->mfi_cp_longitude2->GetDBValue(true);
        $this->InsertFields["mfi_cp_efimo_group_code"]["Value"] = $this->efimo_group_code->GetDBValue(true);
        $this->InsertFields["added_at"]["Value"] = $this->added_at->GetDBValue(true);
        $this->InsertFields["updated_by"]["Value"] = $this->updated_by->GetDBValue(true);
        $this->InsertFields["updated_at"]["Value"] = $this->updated_at->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_cp", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-E594E550
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["mfi_cp_district"]["Value"] = $this->mfi_cp_district->GetDBValue(true);
        $this->UpdateFields["mfi_cp_centre_name"]["Value"] = $this->mfi_cp_centre_name->GetDBValue(true);
        $this->UpdateFields["mfi_cp_co_name"]["Value"] = $this->mfi_cp_co_name->GetDBValue(true);
        $this->UpdateFields["mfi_cp_co_emp_code"]["Value"] = $this->mfi_cp_co_emp_code->GetDBValue(true);
        $this->UpdateFields["mfi_cp_location_type"]["Value"] = $this->mfi_cp_location_type->GetDBValue(true);
        $this->UpdateFields["mfi_cp_licensor"]["Value"] = $this->mfi_cp_licensor->GetDBValue(true);
        $this->UpdateFields["mfi_cp_licensee"]["Value"] = $this->mfi_cp_licensee->GetDBValue(true);
        $this->UpdateFields["mfi_cp_date"]["Value"] = $this->mfi_cp_date->GetDBValue(true);
        $this->UpdateFields["mfi_cp_witness1_name"]["Value"] = $this->mfi_cp_witness1_name->GetDBValue(true);
        $this->UpdateFields["mfi_cp_witness1_address"]["Value"] = $this->mfi_cp_witness1_address->GetDBValue(true);
        $this->UpdateFields["mfi_cp_witness2_name"]["Value"] = $this->mfi_cp_witness2_name->GetDBValue(true);
        $this->UpdateFields["mfi_cp_witness2_address"]["Value"] = $this->mfi_cp_witness2_address->GetDBValue(true);
        $this->UpdateFields["cp_route"]["Value"] = $this->cp_route->GetDBValue(true);
        $this->UpdateFields["mfi_cp_proposal_date"]["Value"] = $this->mfi_cp_proposal_date->GetDBValue(true);
        $this->UpdateFields["mfi_cp_relogin_cp_id"]["Value"] = $this->mfi_cp_relogin_no->GetDBValue(true);
        $this->UpdateFields["mfi_cp_licensor_contact_no"]["Value"] = $this->mfi_cp_licensor_contact_no->GetDBValue(true);
        $this->UpdateFields["mfi_cp_place"]["Value"] = $this->mfi_cp_place->GetDBValue(true);
        $this->UpdateFields["cp_id"]["Value"] = $this->cp_id->GetDBValue(true);
        $this->UpdateFields["mfi_cp_1st_meeting_week_and_day_of_the_month"]["Value"] = $this->mfi_cp_1st_meeting_week_and_day_of_the_month->GetDBValue(true);
        $this->UpdateFields["mfi_cp_meeting_frequency"]["Value"] = $this->mfi_cp_meeting_frequency->GetDBValue(true);
        $this->UpdateFields["mfi_cp_distance_from_region_or_branch"]["Value"] = $this->mfi_cp_distance_from_region_or_branch->GetDBValue(true);
        $this->UpdateFields["added_by"]["Value"] = $this->user_login->GetDBValue(true);
        $this->UpdateFields["mfi_cp_rural_urban"]["Value"] = $this->RadioButton2->GetDBValue(true);
        $this->UpdateFields["mfi_cp_census_village"]["Value"] = $this->census_village->GetDBValue(true);
        $this->UpdateFields["mfi_cp_cansus_village_code"]["Value"] = $this->village_code->GetDBValue(true);
        $this->UpdateFields["mfi_cp_address1"]["Value"] = $this->mfi_cp_address->GetDBValue(true);
        $this->UpdateFields["mfi_cp_village_or_locality"]["Value"] = $this->mfi_cp_village_or_locality->GetDBValue(true);
        $this->UpdateFields["mfi_cp_pincode"]["Value"] = $this->mfi_cp_pincode->GetDBValue(true);
        $this->UpdateFields["mfi_cp_taluk_or_town"]["Value"] = $this->mfi_cp_taluk_or_town1->GetDBValue(true);
        $this->UpdateFields["mfi_cp_monthly_meeting_time_from"]["Value"] = $this->mfi_cp_weekly_meeting_time_from->GetDBValue(true);
        $this->UpdateFields["mfi_cp_monthly_meeting_time_to"]["Value"] = $this->mfi_cp_weekly_meeting_time_to->GetDBValue(true);
        $this->UpdateFields["mfi_cp_latitude1"]["Value"] = $this->mfi_cp_latitude1->GetDBValue(true);
        $this->UpdateFields["mfi_cp_latitude2"]["Value"] = $this->mfi_cp_latitude2->GetDBValue(true);
        $this->UpdateFields["mfi_cp_longitude1"]["Value"] = $this->mfi_cp_longitude1->GetDBValue(true);
        $this->UpdateFields["mfi_cp_longitude2"]["Value"] = $this->mfi_cp_longitude2->GetDBValue(true);
        $this->UpdateFields["mfi_cp_efimo_group_code"]["Value"] = $this->efimo_group_code->GetDBValue(true);
        $this->UpdateFields["added_at"]["Value"] = $this->added_at->GetDBValue(true);
        $this->UpdateFields["updated_by"]["Value"] = $this->updated_by->GetDBValue(true);
        $this->UpdateFields["updated_at"]["Value"] = $this->updated_at->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_cp", $this->UpdateFields, $this);
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

} //End mfi_cpDataSource Class @2-FCB6E20C



//Initialize Page @1-1D75B863
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
$TemplateFileName = "CPform.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B4FBDC54
include_once("./CPform_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-BC887057
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$PanelCP = new clsPanel("PanelCP", $MainPage);
$mfi_cp = new clsRecordmfi_cp("", $MainPage);
$MainPage->PanelCP = & $PanelCP;
$MainPage->mfi_cp = & $mfi_cp;
$PanelCP->AddComponent("mfi_cp", $mfi_cp);
$mfi_cp->Initialize();

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

//Execute Components @1-D4E2C3F2
$mfi_cp->Operation();
//End Execute Components

//Go to destination page @1-5BD8D2AA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_cp);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A2445D4C
$PanelCP->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9AB4D0B8
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_cp);
unset($Tpl);
//End Unload Page


?>
