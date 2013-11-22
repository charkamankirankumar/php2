<?php
//Include Common Files @1-F68E563F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Telecalling_IC.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridmfi_hvf2_mfi_hvf1 { //mfi_hvf2_mfi_hvf1 class @2-13FEA03E

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

//Class_Initialize Event @2-DC22C2C9
    function clsGridmfi_hvf2_mfi_hvf1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_hvf2_mfi_hvf1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_hvf2_mfi_hvf1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_hvf2_mfi_hvf1DataSource($this);
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

        $this->mfi_hvf1_la_id = new clsControl(ccsTextBox, "mfi_hvf1_la_id", "mfi_hvf1_la_id", ccsText, "", CCGetRequestParam("mfi_hvf1_la_id", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_name = new clsControl(ccsLabel, "mfi_hvf1_customer_name", "mfi_hvf1_customer_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_father_name = new clsControl(ccsLabel, "mfi_hvf1_customer_father_name", "mfi_hvf1_customer_father_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_father_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_husband_name = new clsControl(ccsLabel, "mfi_hvf1_customer_husband_name", "mfi_hvf1_customer_husband_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_husband_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_current_address1 = new clsControl(ccsLabel, "mfi_hvf1_customer_current_address1", "mfi_hvf1_customer_current_address1", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_current_address1", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_occupation = new clsControl(ccsLabel, "mfi_hvf1_customer_occupation", "mfi_hvf1_customer_occupation", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_occupation", ccsGet, NULL), $this);
        $this->mfi_cp_centre_name = new clsControl(ccsHidden, "mfi_cp_centre_name", "mfi_cp_centre_name", ccsText, "", CCGetRequestParam("mfi_cp_centre_name", ccsGet, NULL), $this);
        $this->cp_id = new clsControl(ccsHidden, "cp_id", "cp_id", ccsText, "", CCGetRequestParam("cp_id", ccsGet, NULL), $this);
        $this->mfi_hvf2_loan_cycle = new clsControl(ccsLabel, "mfi_hvf2_loan_cycle", "mfi_hvf2_loan_cycle", ccsInteger, "", CCGetRequestParam("mfi_hvf2_loan_cycle", ccsGet, NULL), $this);
        $this->call_attempt = new clsControl(ccsTextBox, "call_attempt", "call_attempt", ccsText, "", CCGetRequestParam("call_attempt", ccsGet, NULL), $this);
        $this->member_name = new clsControl(ccsTextBox, "member_name", "member_name", ccsText, "", CCGetRequestParam("member_name", ccsGet, NULL), $this);
        $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", ccsGet, NULL), $this);
        $this->ListBox1->DSType = dsListOfValues;
        $this->ListBox1->Values = array(array("CONNECTED", "CONNECTED"), array("SWITCH OFF", "SWITCH OFF"), array("NOT REACHBLE", "NOT REACHBLE"), array("MEMBER NOT PRESENT", "MEMBER NOT PRESENT"), array("INVALID NO", "INVALID NO"), array("NUMBER NOT MECCTNED", "NUMBER NOT MENCTIONED"), array("WRONG NUMBER", "WRONG NUMBER"), array("NOT ANSWERED", "NOT ANSWERED"));
        $this->mfi_hvf1_customer_pin_code = new clsControl(ccsLabel, "mfi_hvf1_customer_pin_code", "mfi_hvf1_customer_pin_code", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_pin_code", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_residence_years = new clsControl(ccsLabel, "mfi_hvf1_customer_residence_years", "mfi_hvf1_customer_residence_years", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_residence_years", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_mobile_no = new clsControl(ccsLabel, "mfi_hvf1_customer_mobile_no", "mfi_hvf1_customer_mobile_no", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_mobile_no", ccsGet, NULL), $this);
        $this->mem_name_list_box = new clsControl(ccsListBox, "mem_name_list_box", "mem_name_list_box", ccsText, "", CCGetRequestParam("mem_name_list_box", ccsGet, NULL), $this);
        $this->mem_name_list_box->DSType = dsListOfValues;
        $this->mem_name_list_box->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf1_customer_age_years = new clsControl(ccsLabel, "mfi_hvf1_customer_age_years", "mfi_hvf1_customer_age_years", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_age_years", ccsGet, NULL), $this);
        $this->mem_age_list_box = new clsControl(ccsListBox, "mem_age_list_box", "mem_age_list_box", ccsText, "", CCGetRequestParam("mem_age_list_box", ccsGet, NULL), $this);
        $this->mem_age_list_box->DSType = dsListOfValues;
        $this->mem_age_list_box->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mem_father_list_box = new clsControl(ccsListBox, "mem_father_list_box", "mem_father_list_box", ccsText, "", CCGetRequestParam("mem_father_list_box", ccsGet, NULL), $this);
        $this->mem_father_list_box->DSType = dsListOfValues;
        $this->mem_father_list_box->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mem_gruntor_list_box = new clsControl(ccsListBox, "mem_gruntor_list_box", "mem_gruntor_list_box", ccsText, "", CCGetRequestParam("mem_gruntor_list_box", ccsGet, NULL), $this);
        $this->mem_gruntor_list_box->DSType = dsListOfValues;
        $this->mem_gruntor_list_box->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_gp_proposed_group_name = new clsControl(ccsLabel, "mfi_gp_proposed_group_name", "mfi_gp_proposed_group_name", ccsText, "", CCGetRequestParam("mfi_gp_proposed_group_name", ccsGet, NULL), $this);
        $this->group_list_box = new clsControl(ccsListBox, "group_list_box", "group_list_box", ccsText, "", CCGetRequestParam("group_list_box", ccsGet, NULL), $this);
        $this->group_list_box->DSType = dsListOfValues;
        $this->group_list_box->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->address_list_box = new clsControl(ccsListBox, "address_list_box", "address_list_box", ccsText, "", CCGetRequestParam("address_list_box", ccsGet, NULL), $this);
        $this->address_list_box->DSType = dsListOfValues;
        $this->address_list_box->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mem_occupation = new clsControl(ccsListBox, "mem_occupation", "mem_occupation", ccsText, "", CCGetRequestParam("mem_occupation", ccsGet, NULL), $this);
        $this->mem_occupation->DSType = dsListOfValues;
        $this->mem_occupation->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf2_loan_amount = new clsControl(ccsLabel, "mfi_hvf2_loan_amount", "mfi_hvf2_loan_amount", ccsInteger, "", CCGetRequestParam("mfi_hvf2_loan_amount", ccsGet, NULL), $this);
        $this->lon_amt_list_box = new clsControl(ccsListBox, "lon_amt_list_box", "lon_amt_list_box", ccsText, "", CCGetRequestParam("lon_amt_list_box", ccsGet, NULL), $this);
        $this->lon_amt_list_box->DSType = dsListOfValues;
        $this->lon_amt_list_box->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->mfi_hvf2_loan_purpose = new clsControl(ccsLabel, "mfi_hvf2_loan_purpose", "mfi_hvf2_loan_purpose", ccsText, "", CCGetRequestParam("mfi_hvf2_loan_purpose", ccsGet, NULL), $this);
        $this->lon_purpose_list_box = new clsControl(ccsListBox, "lon_purpose_list_box", "lon_purpose_list_box", ccsText, "", CCGetRequestParam("lon_purpose_list_box", ccsGet, NULL), $this);
        $this->lon_purpose_list_box->DSType = dsListOfValues;
        $this->lon_purpose_list_box->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->visit_list_box = new clsControl(ccsListBox, "visit_list_box", "visit_list_box", ccsText, "", CCGetRequestParam("visit_list_box", ccsGet, NULL), $this);
        $this->visit_list_box->DSType = dsListOfValues;
        $this->visit_list_box->Values = array(array("CREDIT OFFICER", "CREDIT OFFICER"), array("CANNOT SAY", "CANNOT SAY"), array("NONE", "NONE"), array("SOMEONE I DONOT KNOW", "SOMEONE I DONOT KNOW"));
        $this->visit_report_list_box = new clsControl(ccsListBox, "visit_report_list_box", "visit_report_list_box", ccsText, "", CCGetRequestParam("visit_report_list_box", ccsGet, NULL), $this);
        $this->visit_report_list_box->DSType = dsListOfValues;
        $this->visit_report_list_box->Values = array(array("NOTHING", "NOTHING"), array("ONLY KYC DOCUMENTS", "ONLY KYC DOCUMENTS"), array("KYC AND PROPERTY PAPERS", "KYC AND PROPERTY PAPERS"), array("MONEY TO PROCESS LOAN", "MONEY TO PROCESS LOAN"), array("PAPERS AND MONEY", "PAPERS AND MONEY"), array("CANNOT SAY", "CANNOT SAY"));
        $this->mfi_gp_group_name = new clsControl(ccsHidden, "mfi_gp_group_name", "mfi_gp_group_name", ccsText, "", CCGetRequestParam("mfi_gp_group_name", ccsGet, NULL), $this);
        $this->mfi_gp_id = new clsControl(ccsHidden, "mfi_gp_id", "mfi_gp_id", ccsText, "", CCGetRequestParam("mfi_gp_id", ccsGet, NULL), $this);
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

//Show Method @2-0997B757
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlgp_id"] = CCGetFromGet("gp_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->ListBox1->Prepare();
        $this->mem_name_list_box->Prepare();
        $this->mem_age_list_box->Prepare();
        $this->mem_father_list_box->Prepare();
        $this->mem_gruntor_list_box->Prepare();
        $this->group_list_box->Prepare();
        $this->address_list_box->Prepare();
        $this->mem_occupation->Prepare();
        $this->lon_amt_list_box->Prepare();
        $this->lon_purpose_list_box->Prepare();
        $this->visit_list_box->Prepare();
        $this->visit_report_list_box->Prepare();

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
            $this->ControlsVisible["mfi_hvf1_la_id"] = $this->mfi_hvf1_la_id->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_name"] = $this->mfi_hvf1_customer_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_father_name"] = $this->mfi_hvf1_customer_father_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_husband_name"] = $this->mfi_hvf1_customer_husband_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_current_address1"] = $this->mfi_hvf1_customer_current_address1->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_occupation"] = $this->mfi_hvf1_customer_occupation->Visible;
            $this->ControlsVisible["mfi_cp_centre_name"] = $this->mfi_cp_centre_name->Visible;
            $this->ControlsVisible["cp_id"] = $this->cp_id->Visible;
            $this->ControlsVisible["mfi_hvf2_loan_cycle"] = $this->mfi_hvf2_loan_cycle->Visible;
            $this->ControlsVisible["call_attempt"] = $this->call_attempt->Visible;
            $this->ControlsVisible["member_name"] = $this->member_name->Visible;
            $this->ControlsVisible["ListBox1"] = $this->ListBox1->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_pin_code"] = $this->mfi_hvf1_customer_pin_code->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_residence_years"] = $this->mfi_hvf1_customer_residence_years->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_mobile_no"] = $this->mfi_hvf1_customer_mobile_no->Visible;
            $this->ControlsVisible["mem_name_list_box"] = $this->mem_name_list_box->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_age_years"] = $this->mfi_hvf1_customer_age_years->Visible;
            $this->ControlsVisible["mem_age_list_box"] = $this->mem_age_list_box->Visible;
            $this->ControlsVisible["mem_father_list_box"] = $this->mem_father_list_box->Visible;
            $this->ControlsVisible["mem_gruntor_list_box"] = $this->mem_gruntor_list_box->Visible;
            $this->ControlsVisible["mfi_gp_proposed_group_name"] = $this->mfi_gp_proposed_group_name->Visible;
            $this->ControlsVisible["group_list_box"] = $this->group_list_box->Visible;
            $this->ControlsVisible["address_list_box"] = $this->address_list_box->Visible;
            $this->ControlsVisible["mem_occupation"] = $this->mem_occupation->Visible;
            $this->ControlsVisible["mfi_hvf2_loan_amount"] = $this->mfi_hvf2_loan_amount->Visible;
            $this->ControlsVisible["lon_amt_list_box"] = $this->lon_amt_list_box->Visible;
            $this->ControlsVisible["mfi_hvf2_loan_purpose"] = $this->mfi_hvf2_loan_purpose->Visible;
            $this->ControlsVisible["lon_purpose_list_box"] = $this->lon_purpose_list_box->Visible;
            $this->ControlsVisible["visit_list_box"] = $this->visit_list_box->Visible;
            $this->ControlsVisible["visit_report_list_box"] = $this->visit_report_list_box->Visible;
            $this->ControlsVisible["mfi_gp_group_name"] = $this->mfi_gp_group_name->Visible;
            $this->ControlsVisible["mfi_gp_id"] = $this->mfi_gp_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mfi_hvf1_la_id->SetValue($this->DataSource->mfi_hvf1_la_id->GetValue());
                $this->mfi_hvf1_customer_name->SetValue($this->DataSource->mfi_hvf1_customer_name->GetValue());
                $this->mfi_hvf1_customer_father_name->SetValue($this->DataSource->mfi_hvf1_customer_father_name->GetValue());
                $this->mfi_hvf1_customer_husband_name->SetValue($this->DataSource->mfi_hvf1_customer_husband_name->GetValue());
                $this->mfi_hvf1_customer_current_address1->SetValue($this->DataSource->mfi_hvf1_customer_current_address1->GetValue());
                $this->mfi_hvf1_customer_occupation->SetValue($this->DataSource->mfi_hvf1_customer_occupation->GetValue());
                $this->mfi_cp_centre_name->SetValue($this->DataSource->mfi_cp_centre_name->GetValue());
                $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                $this->mfi_hvf2_loan_cycle->SetValue($this->DataSource->mfi_hvf2_loan_cycle->GetValue());
                $this->mfi_hvf1_customer_pin_code->SetValue($this->DataSource->mfi_hvf1_customer_pin_code->GetValue());
                $this->mfi_hvf1_customer_residence_years->SetValue($this->DataSource->mfi_hvf1_customer_residence_years->GetValue());
                $this->mfi_hvf1_customer_mobile_no->SetValue($this->DataSource->mfi_hvf1_customer_mobile_no->GetValue());
                $this->mfi_hvf1_customer_age_years->SetValue($this->DataSource->mfi_hvf1_customer_age_years->GetValue());
                $this->mfi_gp_proposed_group_name->SetValue($this->DataSource->mfi_gp_proposed_group_name->GetValue());
                $this->mfi_hvf2_loan_amount->SetValue($this->DataSource->mfi_hvf2_loan_amount->GetValue());
                $this->mfi_hvf2_loan_purpose->SetValue($this->DataSource->mfi_hvf2_loan_purpose->GetValue());
                $this->mfi_gp_group_name->SetValue($this->DataSource->mfi_gp_group_name->GetValue());
                $this->mfi_gp_id->SetValue($this->DataSource->mfi_gp_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_hvf1_la_id->Show();
                $this->mfi_hvf1_customer_name->Show();
                $this->mfi_hvf1_customer_father_name->Show();
                $this->mfi_hvf1_customer_husband_name->Show();
                $this->mfi_hvf1_customer_current_address1->Show();
                $this->mfi_hvf1_customer_occupation->Show();
                $this->mfi_cp_centre_name->Show();
                $this->cp_id->Show();
                $this->mfi_hvf2_loan_cycle->Show();
                $this->call_attempt->Show();
                $this->member_name->Show();
                $this->ListBox1->Show();
                $this->mfi_hvf1_customer_pin_code->Show();
                $this->mfi_hvf1_customer_residence_years->Show();
                $this->mfi_hvf1_customer_mobile_no->Show();
                $this->mem_name_list_box->Show();
                $this->mfi_hvf1_customer_age_years->Show();
                $this->mem_age_list_box->Show();
                $this->mem_father_list_box->Show();
                $this->mem_gruntor_list_box->Show();
                $this->mfi_gp_proposed_group_name->Show();
                $this->group_list_box->Show();
                $this->address_list_box->Show();
                $this->mem_occupation->Show();
                $this->mfi_hvf2_loan_amount->Show();
                $this->lon_amt_list_box->Show();
                $this->mfi_hvf2_loan_purpose->Show();
                $this->lon_purpose_list_box->Show();
                $this->visit_list_box->Show();
                $this->visit_report_list_box->Show();
                $this->mfi_gp_group_name->Show();
                $this->mfi_gp_id->Show();
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

//GetErrors Method @2-75940FF9
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_hvf1_la_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_father_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_husband_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_current_address1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_occupation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_centre_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cp_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_loan_cycle->Errors->ToString());
        $errors = ComposeStrings($errors, $this->call_attempt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->member_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_pin_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_residence_years->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_mobile_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mem_name_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_age_years->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mem_age_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mem_father_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mem_gruntor_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_gp_proposed_group_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->group_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->address_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mem_occupation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_loan_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lon_amt_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_loan_purpose->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lon_purpose_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->visit_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->visit_report_list_box->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_gp_group_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_gp_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_hvf2_mfi_hvf1 Class @2-FCB6E20C

class clsmfi_hvf2_mfi_hvf1DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf2_mfi_hvf1DataSource Class @2-B228CD71

//DataSource Variables @2-0C0D902C
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_hvf1_la_id;
    public $mfi_hvf1_customer_name;
    public $mfi_hvf1_customer_father_name;
    public $mfi_hvf1_customer_husband_name;
    public $mfi_hvf1_customer_current_address1;
    public $mfi_hvf1_customer_occupation;
    public $mfi_cp_centre_name;
    public $cp_id;
    public $mfi_hvf2_loan_cycle;
    public $mfi_hvf1_customer_pin_code;
    public $mfi_hvf1_customer_residence_years;
    public $mfi_hvf1_customer_mobile_no;
    public $mfi_hvf1_customer_age_years;
    public $mfi_gp_proposed_group_name;
    public $mfi_hvf2_loan_amount;
    public $mfi_hvf2_loan_purpose;
    public $mfi_gp_group_name;
    public $mfi_gp_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D7E70907
    function clsmfi_hvf2_mfi_hvf1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_hvf2_mfi_hvf1";
        $this->Initialize();
        $this->mfi_hvf1_la_id = new clsField("mfi_hvf1_la_id", ccsText, "");
        
        $this->mfi_hvf1_customer_name = new clsField("mfi_hvf1_customer_name", ccsText, "");
        
        $this->mfi_hvf1_customer_father_name = new clsField("mfi_hvf1_customer_father_name", ccsText, "");
        
        $this->mfi_hvf1_customer_husband_name = new clsField("mfi_hvf1_customer_husband_name", ccsText, "");
        
        $this->mfi_hvf1_customer_current_address1 = new clsField("mfi_hvf1_customer_current_address1", ccsText, "");
        
        $this->mfi_hvf1_customer_occupation = new clsField("mfi_hvf1_customer_occupation", ccsText, "");
        
        $this->mfi_cp_centre_name = new clsField("mfi_cp_centre_name", ccsText, "");
        
        $this->cp_id = new clsField("cp_id", ccsText, "");
        
        $this->mfi_hvf2_loan_cycle = new clsField("mfi_hvf2_loan_cycle", ccsInteger, "");
        
        $this->mfi_hvf1_customer_pin_code = new clsField("mfi_hvf1_customer_pin_code", ccsInteger, "");
        
        $this->mfi_hvf1_customer_residence_years = new clsField("mfi_hvf1_customer_residence_years", ccsInteger, "");
        
        $this->mfi_hvf1_customer_mobile_no = new clsField("mfi_hvf1_customer_mobile_no", ccsText, "");
        
        $this->mfi_hvf1_customer_age_years = new clsField("mfi_hvf1_customer_age_years", ccsInteger, "");
        
        $this->mfi_gp_proposed_group_name = new clsField("mfi_gp_proposed_group_name", ccsText, "");
        
        $this->mfi_hvf2_loan_amount = new clsField("mfi_hvf2_loan_amount", ccsInteger, "");
        
        $this->mfi_hvf2_loan_purpose = new clsField("mfi_hvf2_loan_purpose", ccsText, "");
        
        $this->mfi_gp_group_name = new clsField("mfi_gp_group_name", ccsText, "");
        
        $this->mfi_gp_id = new clsField("mfi_gp_id", ccsText, "");
        

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

//Prepare Method @2-75F98332
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgp_id", ccsText, "", "", $this->Parameters["urlgp_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opBeginsWith, "mfi_hvf2.gp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = "( mfi_hvf2.cd_analysys_result like 'SAN%' )";
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-1168EE1D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id";
        $this->SQL = "SELECT mfi_hvf1.la_id AS mfi_hvf1_la_id, hv_route, mfi_hvf1_relogin_hv_no, mfi_hvf1_existing_enrollment_no, mfi_hvf1_customer_name,\n\n" .
        "mfi_hvf1_customer_father_name, mfi_hvf1_customer_husband_name, mfi_hvf1_customer_age_years, mfi_hvf1_husband_age_years,\n\n" .
        "mfi_hvf1_customer_kyc_id_type, mfi_hvf1_customer_kyc_id_no, mfi_hvf1_husband_kyc_id_type, mfi_hvf1_husband_kyc_id_no, mfi_hvf1_customer_current_address1,\n\n" .
        "mfi_hvf1_customer_pin_code, mfi_hvf1_customer_mobile_no, mfi_hvf1_husband_mobile_no, mfi_hvf1_customer_nature_of_residence,\n\n" .
        "mfi_hvf1_customer_residence_years, mfi_hvf1_customer_marital_status, mfi_hvf1_customer_religion, mfi_hvf1_caste, mfi_hvf1_customer_education,\n\n" .
        "household_children, household_adults, household_total_members, mfi_hvf1_customer_occupation, mfi_hvf1_customer_guarantor_occupation,\n\n" .
        "mfi_hvf1_agricultureland, mfi_hvf1_no_of_crops, mfi_hvf1_total_milk_selling, mfi_hvf1_auto_rickshaw, mfi_hvf1_barber_shop,\n\n" .
        "mfi_hvf1_cuttleri_cloth, mfi_hvf1_cycle_repair, mfi_hvf1_daily_labour, mfi_hvf1_daily_labour_nos, mfi_hvf1_fruit_vegetables,\n\n" .
        "mfi_hvf1_provision_grocery, mfi_hvf1_skilled_labour, mfi_hvf1_tailoring_shop, mfi_hvf1_tea_fastfood, mfi_hvf1_other_income_activity,\n\n" .
        "mfi_hvf1_other_income_details, mfi_hvf1_customer_livestock_details_cows, mfi_hvf1_customer_livestock_details_buffalos, mfi_hvf1_customer_livestock_details_goats_sheep,\n\n" .
        "mfi_hvf1_customer_livestock_details_pigs, mfi_hvf1_customer_livestock_details_bullocks_ox, mfi_hvf1_customer_livestock_details_chicken,\n\n" .
        "mfi_hvf1_customer_house_type, mfi_hvf1_customer_vehicles_cycle_cart, mfi_hvf1_customer_vehicles_two_wheeler, mfi_hvf1_customer_vehicles_auto_or_tempo,\n\n" .
        "mfi_hvf1_customer_vehicles_tractor, mfi_hvf1_customer_vehicles_bullock_cart, monthly_household_income, mfi_hvf1_financial_inclusion_loans,\n\n" .
        "mfi_hvf1_financial_inclusion_bank_account, mfi_hvf1_financial_inclusion_insurance, mfi_hvf1_financial_inclusion_chits, mfi_hvf1_financial_inclusion_micro_rimittances,\n\n" .
        "mfi_hvf1_financial_inclusion_others, mfi_hvf1_financial_inclusion_others_specify, mfi_hvf1_added_by, mfi_hvf1_added_at,\n\n" .
        "mfi_hvf1_updated_by, mfi_hvf1_updated_at, mfi_hvf1.error_cols AS mfi_hvf1_error_cols, mfi_hvf1.gp_id AS mfi_hvf1_gp_id,\n\n" .
        "mfi_hvf2.la_id AS mfi_hvf2_la_id, mfi_hvf2_rural_urban, mfi_cp_centre_name, cp_id, mfi_gp_proposed_group_name, mfi_hvf2_group_size,\n\n" .
        "mfi_hvf2_loan_cycle, mfi_hvf2_loan_amount, mfi_hvf2_last_cycle_efimo_loan_acc_no, mfi_hvf2_loan_purpose, mfi_hvf2_loan_group_meeting_frequency,\n\n" .
        "mfi_hvf2_customer_guarantor_type, mfi_hvf2_customer_guarantor_name, mfi_hvf2_GUARANTOR_kyc_id_type, mfi_hvf2_gurantor_kyc_id_no,\n\n" .
        "mfi_hvf2_customer_guarantor_age, mfi_hvf2_customer_guarantor_mobile, borrower_nominee_name, borrower_nominee_year_birth,\n\n" .
        "borrower_nominee_mobile, guarantor_nominee_name, guarantor_nominee_year_birth, guarantor_nominee_mobile, mfi_hvf2_gurantor_signature,\n\n" .
        "mfi_hvf2_member_signature, mfi_hvf2_co_name, mfi_hvf2_co_emp_code, mfi_hvf2_date, mfi_hvf2_co_signature, mfi_hvf2_alloted_enrollment_no,\n\n" .
        "mfi_hvf2_efimo_loan_acc_no, mfi_hvf2_bm_name, mfi_hvf2_bm_emp_code, mfi_hvf2_bm_date, mfi_hvf2_bm_sign, mfi_hvf2_verification_result,\n\n" .
        "mfi_hvf2_added_by, mfi_hvf2_added_at, mfi_hvf2_updated_by, mfi_hvf2_updated_at, mfi_hvf2_cbo_verification_result, cb_approved_loan_amount,\n\n" .
        "mfi_hvf2_date_of_grt, grt_result, grt_sanctioned_date, cd_analysys_date, cb_analysys_result, cd_analysys_result, tc_no_attempt,\n\n" .
        "mfi_telecaller_status, final_result, sanctioned_date, product, tdb_date, disbursed_date, reason_rejection, cb_added, update_reason,\n\n" .
        "tracker_download_date, himark_raised_at, responce_received_at, last_called_at, mfi_hvf2.error_cols AS mfi_hvf2_error_cols,\n\n" .
        "cb_added_at, mfi_hvf2.gp_id AS mfi_hvf2_gp_id \n\n" .
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

//SetValues Method @2-6D49E26B
    function SetValues()
    {
        $this->mfi_hvf1_la_id->SetDBValue($this->f("mfi_hvf1_la_id"));
        $this->mfi_hvf1_customer_name->SetDBValue($this->f("mfi_hvf1_customer_name"));
        $this->mfi_hvf1_customer_father_name->SetDBValue($this->f("mfi_hvf1_customer_father_name"));
        $this->mfi_hvf1_customer_husband_name->SetDBValue($this->f("mfi_hvf1_customer_husband_name"));
        $this->mfi_hvf1_customer_current_address1->SetDBValue($this->f("mfi_hvf1_customer_current_address1"));
        $this->mfi_hvf1_customer_occupation->SetDBValue($this->f("mfi_hvf1_customer_occupation"));
        $this->mfi_cp_centre_name->SetDBValue($this->f("mfi_cp_centre_name"));
        $this->cp_id->SetDBValue($this->f("cp_id"));
        $this->mfi_hvf2_loan_cycle->SetDBValue(trim($this->f("mfi_hvf2_loan_cycle")));
        $this->mfi_hvf1_customer_pin_code->SetDBValue(trim($this->f("mfi_hvf1_customer_pin_code")));
        $this->mfi_hvf1_customer_residence_years->SetDBValue(trim($this->f("mfi_hvf1_customer_residence_years")));
        $this->mfi_hvf1_customer_mobile_no->SetDBValue($this->f("mfi_hvf1_customer_mobile_no"));
        $this->mfi_hvf1_customer_age_years->SetDBValue(trim($this->f("mfi_hvf1_customer_age_years")));
        $this->mfi_gp_proposed_group_name->SetDBValue($this->f("mfi_gp_proposed_group_name"));
        $this->mfi_hvf2_loan_amount->SetDBValue(trim($this->f("mfi_hvf2_loan_amount")));
        $this->mfi_hvf2_loan_purpose->SetDBValue($this->f("mfi_hvf2_loan_purpose"));
        $this->mfi_gp_group_name->SetDBValue($this->f("mfi_gp_proposed_group_name"));
        $this->mfi_gp_id->SetDBValue($this->f("mfi_hvf2_gp_id"));
    }
//End SetValues Method

} //End mfi_hvf2_mfi_hvf1DataSource Class @2-FCB6E20C

class clsRecordmfi_tc_individualcheck { //mfi_tc_individualcheck Class @567-842578AB

//Variables @567-9E315808

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

//Class_Initialize Event @567-562B62FA
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
            $this->la_id = new clsControl(ccsHidden, "la_id", $CCSLocales->GetText("la_id"), ccsText, "", CCGetRequestParam("la_id", $Method, NULL), $this);
            $this->mfi_borrower_name = new clsControl(ccsTextBox, "mfi_borrower_name", $CCSLocales->GetText("mfi_borrower_name"), ccsText, "", CCGetRequestParam("mfi_borrower_name", $Method, NULL), $this);
            $this->mfi_tc_call_attempt = new clsControl(ccsTextBox, "mfi_tc_call_attempt", $CCSLocales->GetText("mfi_tc_call_attempt"), ccsInteger, "", CCGetRequestParam("mfi_tc_call_attempt", $Method, NULL), $this);
            $this->mfi_tc_call_attempt->Required = true;
            $this->mfi_tc_call_log = new clsControl(ccsTextBox, "mfi_tc_call_log", $CCSLocales->GetText("mfi_tc_call_log"), ccsText, "", CCGetRequestParam("mfi_tc_call_log", $Method, NULL), $this);
            $this->mfi_tc_b1_ans = new clsControl(ccsTextBox, "mfi_tc_b1_ans", $CCSLocales->GetText("mfi_tc_b1_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b1_ans", $Method, NULL), $this);
            $this->mfi_tc_b2_ans = new clsControl(ccsTextBox, "mfi_tc_b2_ans", $CCSLocales->GetText("mfi_tc_b2_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b2_ans", $Method, NULL), $this);
            $this->mfi_tc_b3_ans = new clsControl(ccsTextBox, "mfi_tc_b3_ans", $CCSLocales->GetText("mfi_tc_b3_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b3_ans", $Method, NULL), $this);
            $this->mfi_tc_b4_ans = new clsControl(ccsTextBox, "mfi_tc_b4_ans", $CCSLocales->GetText("mfi_tc_b4_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b4_ans", $Method, NULL), $this);
            $this->mfi_tc_b5_ans = new clsControl(ccsTextBox, "mfi_tc_b5_ans", $CCSLocales->GetText("mfi_tc_b5_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b5_ans", $Method, NULL), $this);
            $this->mfi_tc_1_ans = new clsControl(ccsTextBox, "mfi_tc_1_ans", $CCSLocales->GetText("mfi_tc_1_ans"), ccsText, "", CCGetRequestParam("mfi_tc_1_ans", $Method, NULL), $this);
            $this->mfi_tc_2_ans = new clsControl(ccsTextBox, "mfi_tc_2_ans", $CCSLocales->GetText("mfi_tc_2_ans"), ccsText, "", CCGetRequestParam("mfi_tc_2_ans", $Method, NULL), $this);
            $this->mfi_tc_3_ans = new clsControl(ccsTextBox, "mfi_tc_3_ans", $CCSLocales->GetText("mfi_tc_3_ans"), ccsText, "", CCGetRequestParam("mfi_tc_3_ans", $Method, NULL), $this);
            $this->mfi_tc_4_ans = new clsControl(ccsTextBox, "mfi_tc_4_ans", $CCSLocales->GetText("mfi_tc_4_ans"), ccsText, "", CCGetRequestParam("mfi_tc_4_ans", $Method, NULL), $this);
            $this->mfi_tc_5_ans = new clsControl(ccsTextBox, "mfi_tc_5_ans", $CCSLocales->GetText("mfi_tc_5_ans"), ccsText, "", CCGetRequestParam("mfi_tc_5_ans", $Method, NULL), $this);
            $this->mfi_tc_6_ans = new clsControl(ccsTextBox, "mfi_tc_6_ans", $CCSLocales->GetText("mfi_tc_6_ans"), ccsText, "", CCGetRequestParam("mfi_tc_6_ans", $Method, NULL), $this);
            $this->mfi_region_name = new clsControl(ccsTextBox, "mfi_region_name", $CCSLocales->GetText("mfi_region_name"), ccsText, "", CCGetRequestParam("mfi_region_name", $Method, NULL), $this);
            $this->mfi_center_name = new clsControl(ccsTextBox, "mfi_center_name", $CCSLocales->GetText("mfi_center_name"), ccsText, "", CCGetRequestParam("mfi_center_name", $Method, NULL), $this);
            $this->mfi_group_id = new clsControl(ccsTextBox, "mfi_group_id", $CCSLocales->GetText("mfi_group_id"), ccsText, "", CCGetRequestParam("mfi_group_id", $Method, NULL), $this);
            $this->mfi_group_name = new clsControl(ccsTextBox, "mfi_group_name", $CCSLocales->GetText("mfi_group_name"), ccsText, "", CCGetRequestParam("mfi_group_name", $Method, NULL), $this);
            $this->called_by = new clsControl(ccsTextBox, "called_by", $CCSLocales->GetText("called_by"), ccsText, "", CCGetRequestParam("called_by", $Method, NULL), $this);
            $this->called_at = new clsControl(ccsTextBox, "called_at", $CCSLocales->GetText("called_at"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("called_at", $Method, NULL), $this);
            $this->tc_individual_check_status = new clsControl(ccsListBox, "tc_individual_check_status", $CCSLocales->GetText("tc_individual_check_status"), ccsText, "", CCGetRequestParam("tc_individual_check_status", $Method, NULL), $this);
            $this->tc_individual_check_status->DSType = dsListOfValues;
            $this->tc_individual_check_status->Values = array(array("IA Check", "IA Check"), array("SANCTIONED", "SANCTIONED"), array("PENDING", "PENDING"), array("REJECTED", "REJECTED"));
            $this->tc_individual_check_status->Required = true;
            $this->mfi_interest_details = new clsControl(ccsTextBox, "mfi_interest_details", $CCSLocales->GetText("mfi_interest_details"), ccsText, "", CCGetRequestParam("mfi_interest_details", $Method, NULL), $this);
            $this->tc_ic_rejection_details = new clsControl(ccsTextBox, "tc_ic_rejection_details", $CCSLocales->GetText("tc_ic_rejection_details"), ccsText, "", CCGetRequestParam("tc_ic_rejection_details", $Method, NULL), $this);
            $this->mfi_customer_mobile_no = new clsControl(ccsTextBox, "mfi_customer_mobile_no", $CCSLocales->GetText("mfi_customer_mobile_no"), ccsFloat, "", CCGetRequestParam("mfi_customer_mobile_no", $Method, NULL), $this);
            $this->mfi_mobile_status = new clsControl(ccsTextBox, "mfi_mobile_status", $CCSLocales->GetText("mfi_mobile_status"), ccsInteger, "", CCGetRequestParam("mfi_mobile_status", $Method, NULL), $this);
            $this->mfi_incoming_mobile_no = new clsControl(ccsTextBox, "mfi_incoming_mobile_no", $CCSLocales->GetText("mfi_incoming_mobile_no"), ccsFloat, "", CCGetRequestParam("mfi_incoming_mobile_no", $Method, NULL), $this);
            $this->mfi_customer_relationship = new clsControl(ccsTextBox, "mfi_customer_relationship", $CCSLocales->GetText("mfi_customer_relationship"), ccsText, "", CCGetRequestParam("mfi_customer_relationship", $Method, NULL), $this);
            $this->tc_remarks = new clsControl(ccsTextArea, "tc_remarks", $CCSLocales->GetText("tc_remarks"), ccsText, "", CCGetRequestParam("tc_remarks", $Method, NULL), $this);
            $this->mfi_tc_cp_id = new clsControl(ccsTextBox, "mfi_tc_cp_id", "mfi_tc_cp_id", ccsText, "", CCGetRequestParam("mfi_tc_cp_id", $Method, NULL), $this);
            $this->group_affinity = new clsButton("group_affinity", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @567-26E54296
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlsno"] = CCGetFromGet("sno", NULL);
    }
//End Initialize Method

//Validate Method @567-893CA75F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->la_id->Validate() && $Validation);
        $Validation = ($this->mfi_borrower_name->Validate() && $Validation);
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
        $Validation = ($this->mfi_region_name->Validate() && $Validation);
        $Validation = ($this->mfi_center_name->Validate() && $Validation);
        $Validation = ($this->mfi_group_id->Validate() && $Validation);
        $Validation = ($this->mfi_group_name->Validate() && $Validation);
        $Validation = ($this->called_by->Validate() && $Validation);
        $Validation = ($this->called_at->Validate() && $Validation);
        $Validation = ($this->tc_individual_check_status->Validate() && $Validation);
        $Validation = ($this->mfi_interest_details->Validate() && $Validation);
        $Validation = ($this->tc_ic_rejection_details->Validate() && $Validation);
        $Validation = ($this->mfi_customer_mobile_no->Validate() && $Validation);
        $Validation = ($this->mfi_mobile_status->Validate() && $Validation);
        $Validation = ($this->mfi_incoming_mobile_no->Validate() && $Validation);
        $Validation = ($this->mfi_customer_relationship->Validate() && $Validation);
        $Validation = ($this->tc_remarks->Validate() && $Validation);
        $Validation = ($this->mfi_tc_cp_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->la_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_borrower_name->Errors->Count() == 0);
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
        $Validation =  $Validation && ($this->mfi_region_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_center_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_group_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_group_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->called_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->called_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tc_individual_check_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_interest_details->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tc_ic_rejection_details->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_customer_mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_mobile_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_incoming_mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_customer_relationship->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tc_remarks->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_cp_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @567-32A66D82
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->la_id->Errors->Count());
        $errors = ($errors || $this->mfi_borrower_name->Errors->Count());
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
        $errors = ($errors || $this->mfi_region_name->Errors->Count());
        $errors = ($errors || $this->mfi_center_name->Errors->Count());
        $errors = ($errors || $this->mfi_group_id->Errors->Count());
        $errors = ($errors || $this->mfi_group_name->Errors->Count());
        $errors = ($errors || $this->called_by->Errors->Count());
        $errors = ($errors || $this->called_at->Errors->Count());
        $errors = ($errors || $this->tc_individual_check_status->Errors->Count());
        $errors = ($errors || $this->mfi_interest_details->Errors->Count());
        $errors = ($errors || $this->tc_ic_rejection_details->Errors->Count());
        $errors = ($errors || $this->mfi_customer_mobile_no->Errors->Count());
        $errors = ($errors || $this->mfi_mobile_status->Errors->Count());
        $errors = ($errors || $this->mfi_incoming_mobile_no->Errors->Count());
        $errors = ($errors || $this->mfi_customer_relationship->Errors->Count());
        $errors = ($errors || $this->tc_remarks->Errors->Count());
        $errors = ($errors || $this->mfi_tc_cp_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @567-A22E7C14
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
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->group_affinity->Pressed) {
                $this->PressedButton = "group_affinity";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "group_affinity") {
                if(!CCGetEvent($this->group_affinity->CCSEvents, "OnClick", $this->group_affinity)) {
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

//InsertRow Method @567-F1266A25
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->la_id->SetValue($this->la_id->GetValue(true));
        $this->DataSource->mfi_borrower_name->SetValue($this->mfi_borrower_name->GetValue(true));
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
        $this->DataSource->mfi_region_name->SetValue($this->mfi_region_name->GetValue(true));
        $this->DataSource->mfi_center_name->SetValue($this->mfi_center_name->GetValue(true));
        $this->DataSource->mfi_group_id->SetValue($this->mfi_group_id->GetValue(true));
        $this->DataSource->mfi_group_name->SetValue($this->mfi_group_name->GetValue(true));
        $this->DataSource->called_by->SetValue($this->called_by->GetValue(true));
        $this->DataSource->called_at->SetValue($this->called_at->GetValue(true));
        $this->DataSource->tc_individual_check_status->SetValue($this->tc_individual_check_status->GetValue(true));
        $this->DataSource->mfi_interest_details->SetValue($this->mfi_interest_details->GetValue(true));
        $this->DataSource->tc_ic_rejection_details->SetValue($this->tc_ic_rejection_details->GetValue(true));
        $this->DataSource->mfi_customer_mobile_no->SetValue($this->mfi_customer_mobile_no->GetValue(true));
        $this->DataSource->mfi_mobile_status->SetValue($this->mfi_mobile_status->GetValue(true));
        $this->DataSource->mfi_incoming_mobile_no->SetValue($this->mfi_incoming_mobile_no->GetValue(true));
        $this->DataSource->mfi_customer_relationship->SetValue($this->mfi_customer_relationship->GetValue(true));
        $this->DataSource->tc_remarks->SetValue($this->tc_remarks->GetValue(true));
        $this->DataSource->mfi_tc_cp_id->SetValue($this->mfi_tc_cp_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @567-7F1DF158
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
                    $this->la_id->SetValue($this->DataSource->la_id->GetValue());
                    $this->mfi_borrower_name->SetValue($this->DataSource->mfi_borrower_name->GetValue());
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
                    $this->mfi_region_name->SetValue($this->DataSource->mfi_region_name->GetValue());
                    $this->mfi_center_name->SetValue($this->DataSource->mfi_center_name->GetValue());
                    $this->mfi_group_id->SetValue($this->DataSource->mfi_group_id->GetValue());
                    $this->mfi_group_name->SetValue($this->DataSource->mfi_group_name->GetValue());
                    $this->called_by->SetValue($this->DataSource->called_by->GetValue());
                    $this->called_at->SetValue($this->DataSource->called_at->GetValue());
                    $this->tc_individual_check_status->SetValue($this->DataSource->tc_individual_check_status->GetValue());
                    $this->mfi_interest_details->SetValue($this->DataSource->mfi_interest_details->GetValue());
                    $this->tc_ic_rejection_details->SetValue($this->DataSource->tc_ic_rejection_details->GetValue());
                    $this->mfi_customer_mobile_no->SetValue($this->DataSource->mfi_customer_mobile_no->GetValue());
                    $this->mfi_mobile_status->SetValue($this->DataSource->mfi_mobile_status->GetValue());
                    $this->mfi_incoming_mobile_no->SetValue($this->DataSource->mfi_incoming_mobile_no->GetValue());
                    $this->mfi_customer_relationship->SetValue($this->DataSource->mfi_customer_relationship->GetValue());
                    $this->tc_remarks->SetValue($this->DataSource->tc_remarks->GetValue());
                    $this->mfi_tc_cp_id->SetValue($this->DataSource->mfi_tc_cp_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->la_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_borrower_name->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->mfi_region_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_center_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_group_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_group_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->called_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->called_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tc_individual_check_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_interest_details->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tc_ic_rejection_details->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_customer_mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_mobile_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_incoming_mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_customer_relationship->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tc_remarks->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_cp_id->Errors->ToString());
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
        $this->la_id->Show();
        $this->mfi_borrower_name->Show();
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
        $this->mfi_region_name->Show();
        $this->mfi_center_name->Show();
        $this->mfi_group_id->Show();
        $this->mfi_group_name->Show();
        $this->called_by->Show();
        $this->called_at->Show();
        $this->tc_individual_check_status->Show();
        $this->mfi_interest_details->Show();
        $this->tc_ic_rejection_details->Show();
        $this->mfi_customer_mobile_no->Show();
        $this->mfi_mobile_status->Show();
        $this->mfi_incoming_mobile_no->Show();
        $this->mfi_customer_relationship->Show();
        $this->tc_remarks->Show();
        $this->mfi_tc_cp_id->Show();
        $this->group_affinity->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_tc_individualcheck Class @567-FCB6E20C

class clsmfi_tc_individualcheckDataSource extends clsDBmysql_cams_v2 {  //mfi_tc_individualcheckDataSource Class @567-03E967B7

//DataSource Variables @567-7FAF5421
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
    public $la_id;
    public $mfi_borrower_name;
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
    public $mfi_region_name;
    public $mfi_center_name;
    public $mfi_group_id;
    public $mfi_group_name;
    public $called_by;
    public $called_at;
    public $tc_individual_check_status;
    public $mfi_interest_details;
    public $tc_ic_rejection_details;
    public $mfi_customer_mobile_no;
    public $mfi_mobile_status;
    public $mfi_incoming_mobile_no;
    public $mfi_customer_relationship;
    public $tc_remarks;
    public $mfi_tc_cp_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @567-4A0E1AB7
    function clsmfi_tc_individualcheckDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_tc_individualcheck/Error";
        $this->Initialize();
        $this->la_id = new clsField("la_id", ccsText, "");
        
        $this->mfi_borrower_name = new clsField("mfi_borrower_name", ccsText, "");
        
        $this->mfi_tc_call_attempt = new clsField("mfi_tc_call_attempt", ccsInteger, "");
        
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
        
        $this->mfi_region_name = new clsField("mfi_region_name", ccsText, "");
        
        $this->mfi_center_name = new clsField("mfi_center_name", ccsText, "");
        
        $this->mfi_group_id = new clsField("mfi_group_id", ccsText, "");
        
        $this->mfi_group_name = new clsField("mfi_group_name", ccsText, "");
        
        $this->called_by = new clsField("called_by", ccsText, "");
        
        $this->called_at = new clsField("called_at", ccsDate, $this->DateFormat);
        
        $this->tc_individual_check_status = new clsField("tc_individual_check_status", ccsText, "");
        
        $this->mfi_interest_details = new clsField("mfi_interest_details", ccsText, "");
        
        $this->tc_ic_rejection_details = new clsField("tc_ic_rejection_details", ccsText, "");
        
        $this->mfi_customer_mobile_no = new clsField("mfi_customer_mobile_no", ccsFloat, "");
        
        $this->mfi_mobile_status = new clsField("mfi_mobile_status", ccsInteger, "");
        
        $this->mfi_incoming_mobile_no = new clsField("mfi_incoming_mobile_no", ccsFloat, "");
        
        $this->mfi_customer_relationship = new clsField("mfi_customer_relationship", ccsText, "");
        
        $this->tc_remarks = new clsField("tc_remarks", ccsText, "");
        
        $this->mfi_tc_cp_id = new clsField("mfi_tc_cp_id", ccsText, "");
        

        $this->InsertFields["la_id"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_borrower_name"] = array("Name" => "mfi_borrower_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_call_attempt"] = array("Name" => "mfi_tc_call_attempt", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_call_log"] = array("Name" => "mfi_tc_call_log", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b1_ans"] = array("Name" => "mfi_tc_b1_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b2_ans"] = array("Name" => "mfi_tc_b2_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b3_ans"] = array("Name" => "mfi_tc_b3_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b4_ans"] = array("Name" => "mfi_tc_b4_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_b5_ans"] = array("Name" => "mfi_tc_b5_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_1_ans"] = array("Name" => "mfi_tc_1_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_2_ans"] = array("Name" => "mfi_tc_2_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_3_ans"] = array("Name" => "mfi_tc_3_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_4_ans"] = array("Name" => "mfi_tc_4_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_5_ans"] = array("Name" => "mfi_tc_5_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_6_ans"] = array("Name" => "mfi_tc_6_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_region_name"] = array("Name" => "mfi_region_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_center_name"] = array("Name" => "mfi_center_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_group_id"] = array("Name" => "mfi_group_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_group_name"] = array("Name" => "mfi_group_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["called_by"] = array("Name" => "called_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["called_at"] = array("Name" => "called_at", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["tc_individual_check_status"] = array("Name" => "tc_individual_check_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_interest_details"] = array("Name" => "mfi_interest_details", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tc_ic_rejection_details"] = array("Name" => "tc_ic_rejection_details", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_customer_mobile_no"] = array("Name" => "mfi_customer_mobile_no", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_mobile_status"] = array("Name" => "mfi_mobile_status", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_incoming_mobile_no"] = array("Name" => "mfi_incoming_mobile_no", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_customer_relationship"] = array("Name" => "mfi_customer_relationship", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tc_remarks"] = array("Name" => "tc_remarks", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_cp_id"] = array("Name" => "mfi_tc_cp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @567-71FC44E8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlsno", ccsInteger, "", "", $this->Parameters["urlsno"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "sno", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @567-93A3DE18
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

//SetValues Method @567-55D76D4D
    function SetValues()
    {
        $this->la_id->SetDBValue($this->f("la_id"));
        $this->mfi_borrower_name->SetDBValue($this->f("mfi_borrower_name"));
        $this->mfi_tc_call_attempt->SetDBValue(trim($this->f("mfi_tc_call_attempt")));
        $this->mfi_tc_call_log->SetDBValue($this->f("mfi_tc_call_log"));
        $this->mfi_tc_b1_ans->SetDBValue($this->f("mfi_tc_b1_ans"));
        $this->mfi_tc_b2_ans->SetDBValue($this->f("mfi_tc_b2_ans"));
        $this->mfi_tc_b3_ans->SetDBValue($this->f("mfi_tc_b3_ans"));
        $this->mfi_tc_b4_ans->SetDBValue($this->f("mfi_tc_b4_ans"));
        $this->mfi_tc_b5_ans->SetDBValue($this->f("mfi_tc_b5_ans"));
        $this->mfi_tc_1_ans->SetDBValue($this->f("mfi_tc_1_ans"));
        $this->mfi_tc_2_ans->SetDBValue($this->f("mfi_tc_2_ans"));
        $this->mfi_tc_3_ans->SetDBValue($this->f("mfi_tc_3_ans"));
        $this->mfi_tc_4_ans->SetDBValue($this->f("mfi_tc_4_ans"));
        $this->mfi_tc_5_ans->SetDBValue($this->f("mfi_tc_5_ans"));
        $this->mfi_tc_6_ans->SetDBValue($this->f("mfi_tc_6_ans"));
        $this->mfi_region_name->SetDBValue($this->f("mfi_region_name"));
        $this->mfi_center_name->SetDBValue($this->f("mfi_center_name"));
        $this->mfi_group_id->SetDBValue($this->f("mfi_group_id"));
        $this->mfi_group_name->SetDBValue($this->f("mfi_group_name"));
        $this->called_by->SetDBValue($this->f("called_by"));
        $this->called_at->SetDBValue(trim($this->f("called_at")));
        $this->tc_individual_check_status->SetDBValue($this->f("tc_individual_check_status"));
        $this->mfi_interest_details->SetDBValue($this->f("mfi_interest_details"));
        $this->tc_ic_rejection_details->SetDBValue($this->f("tc_ic_rejection_details"));
        $this->mfi_customer_mobile_no->SetDBValue(trim($this->f("mfi_customer_mobile_no")));
        $this->mfi_mobile_status->SetDBValue(trim($this->f("mfi_mobile_status")));
        $this->mfi_incoming_mobile_no->SetDBValue(trim($this->f("mfi_incoming_mobile_no")));
        $this->mfi_customer_relationship->SetDBValue($this->f("mfi_customer_relationship"));
        $this->tc_remarks->SetDBValue($this->f("tc_remarks"));
        $this->mfi_tc_cp_id->SetDBValue($this->f("mfi_tc_cp_id"));
    }
//End SetValues Method

//Insert Method @567-84D82FFD
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["la_id"]["Value"] = $this->la_id->GetDBValue(true);
        $this->InsertFields["mfi_borrower_name"]["Value"] = $this->mfi_borrower_name->GetDBValue(true);
        $this->InsertFields["mfi_tc_call_attempt"]["Value"] = $this->mfi_tc_call_attempt->GetDBValue(true);
        $this->InsertFields["mfi_tc_call_log"]["Value"] = $this->mfi_tc_call_log->GetDBValue(true);
        $this->InsertFields["mfi_tc_b1_ans"]["Value"] = $this->mfi_tc_b1_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_b2_ans"]["Value"] = $this->mfi_tc_b2_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_b3_ans"]["Value"] = $this->mfi_tc_b3_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_b4_ans"]["Value"] = $this->mfi_tc_b4_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_b5_ans"]["Value"] = $this->mfi_tc_b5_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_1_ans"]["Value"] = $this->mfi_tc_1_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_2_ans"]["Value"] = $this->mfi_tc_2_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_3_ans"]["Value"] = $this->mfi_tc_3_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_4_ans"]["Value"] = $this->mfi_tc_4_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_5_ans"]["Value"] = $this->mfi_tc_5_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_6_ans"]["Value"] = $this->mfi_tc_6_ans->GetDBValue(true);
        $this->InsertFields["mfi_region_name"]["Value"] = $this->mfi_region_name->GetDBValue(true);
        $this->InsertFields["mfi_center_name"]["Value"] = $this->mfi_center_name->GetDBValue(true);
        $this->InsertFields["mfi_group_id"]["Value"] = $this->mfi_group_id->GetDBValue(true);
        $this->InsertFields["mfi_group_name"]["Value"] = $this->mfi_group_name->GetDBValue(true);
        $this->InsertFields["called_by"]["Value"] = $this->called_by->GetDBValue(true);
        $this->InsertFields["called_at"]["Value"] = $this->called_at->GetDBValue(true);
        $this->InsertFields["tc_individual_check_status"]["Value"] = $this->tc_individual_check_status->GetDBValue(true);
        $this->InsertFields["mfi_interest_details"]["Value"] = $this->mfi_interest_details->GetDBValue(true);
        $this->InsertFields["tc_ic_rejection_details"]["Value"] = $this->tc_ic_rejection_details->GetDBValue(true);
        $this->InsertFields["mfi_customer_mobile_no"]["Value"] = $this->mfi_customer_mobile_no->GetDBValue(true);
        $this->InsertFields["mfi_mobile_status"]["Value"] = $this->mfi_mobile_status->GetDBValue(true);
        $this->InsertFields["mfi_incoming_mobile_no"]["Value"] = $this->mfi_incoming_mobile_no->GetDBValue(true);
        $this->InsertFields["mfi_customer_relationship"]["Value"] = $this->mfi_customer_relationship->GetDBValue(true);
        $this->InsertFields["tc_remarks"]["Value"] = $this->tc_remarks->GetDBValue(true);
        $this->InsertFields["mfi_tc_cp_id"]["Value"] = $this->mfi_tc_cp_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_tc_individualcheck", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End mfi_tc_individualcheckDataSource Class @567-FCB6E20C

//Initialize Page @1-253A4919
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
$TemplateFileName = "Telecalling_IC.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F5E2B55A
include_once("./Telecalling_IC_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-59078B53
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_hvf2_mfi_hvf1 = new clsGridmfi_hvf2_mfi_hvf1("", $MainPage);
$mfi_tc_individualcheck = new clsRecordmfi_tc_individualcheck("", $MainPage);
$MainPage->mfi_hvf2_mfi_hvf1 = & $mfi_hvf2_mfi_hvf1;
$MainPage->mfi_tc_individualcheck = & $mfi_tc_individualcheck;
$mfi_hvf2_mfi_hvf1->Initialize();
$mfi_tc_individualcheck->Initialize();

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

//Execute Components @1-94F78829
$mfi_tc_individualcheck->Operation();
//End Execute Components

//Go to destination page @1-48D3D9C2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_hvf2_mfi_hvf1);
    unset($mfi_tc_individualcheck);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9752FA99
$mfi_hvf2_mfi_hvf1->Show();
$mfi_tc_individualcheck->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-735593B9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_hvf2_mfi_hvf1);
unset($mfi_tc_individualcheck);
unset($Tpl);
//End Unload Page


?>
