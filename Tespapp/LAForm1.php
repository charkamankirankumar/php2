<?php
//Include Common Files @1-B8292A4B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "LAForm1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsRecordmfi_hvf1 { //mfi_hvf1 Class @2-B503E23C

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

//Class_Initialize Event @2-BBCE7990
    function clsRecordmfi_hvf1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_hvf1/Error";
        $this->DataSource = new clsmfi_hvf1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_hvf1";
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
            $this->la_id = new clsControl(ccsTextBox, "la_id", "La Id", ccsText, "", CCGetRequestParam("la_id", $Method, NULL), $this);
            $this->la_id->Required = true;
            $this->hv_route = new clsControl(ccsTextBox, "hv_route", "Hv Route", ccsText, "", CCGetRequestParam("hv_route", $Method, NULL), $this);
            $this->mfi_hvf1_relogin_hv_no = new clsControl(ccsTextBox, "mfi_hvf1_relogin_hv_no", "Mfi Hvf1 Relogin Hv No", ccsText, "", CCGetRequestParam("mfi_hvf1_relogin_hv_no", $Method, NULL), $this);
            $this->mfi_hvf1_existing_enrollment_no = new clsControl(ccsTextBox, "mfi_hvf1_existing_enrollment_no", "Mfi Hvf1 Existing Enrollment No", ccsText, "", CCGetRequestParam("mfi_hvf1_existing_enrollment_no", $Method, NULL), $this);
            $this->mfi_hvf1_customer_name = new clsControl(ccsTextBox, "mfi_hvf1_customer_name", "Mfi Hvf1 Customer Name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_name", $Method, NULL), $this);
            $this->mfi_hvf1_customer_name->Required = true;
            $this->mfi_hvf1_customer_father_name = new clsControl(ccsTextBox, "mfi_hvf1_customer_father_name", "Mfi Hvf1 Customer Father Name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_father_name", $Method, NULL), $this);
            $this->mfi_hvf1_customer_husband_name = new clsControl(ccsTextBox, "mfi_hvf1_customer_husband_name", "Mfi Hvf1 Customer Husband Name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_husband_name", $Method, NULL), $this);
            $this->mfi_hvf1_customer_age_years = new clsControl(ccsTextBox, "mfi_hvf1_customer_age_years", "Mfi Hvf1 Customer Age Years", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_age_years", $Method, NULL), $this);
            $this->mfi_hvf1_customer_age_years->Required = true;
            $this->mfi_hvf1_husband_age_years = new clsControl(ccsTextBox, "mfi_hvf1_husband_age_years", "Mfi Hvf1 Husband Age Years", ccsInteger, "", CCGetRequestParam("mfi_hvf1_husband_age_years", $Method, NULL), $this);
            $this->mfi_hvf1_customer_kyc_id_no = new clsControl(ccsTextBox, "mfi_hvf1_customer_kyc_id_no", "Mfi Hvf1 Customer Kyc Id No", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_kyc_id_no", $Method, NULL), $this);
            $this->mfi_hvf1_customer_kyc_id_no->Required = true;
            $this->mfi_hvf1_husband_kyc_id_no = new clsControl(ccsTextBox, "mfi_hvf1_husband_kyc_id_no", "Mfi Hvf1 Husband Kyc Id No", ccsText, "", CCGetRequestParam("mfi_hvf1_husband_kyc_id_no", $Method, NULL), $this);
            $this->mfi_hvf1_customer_current_address1 = new clsControl(ccsTextArea, "mfi_hvf1_customer_current_address1", "Mfi Hvf1 Customer Current Address1", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_current_address1", $Method, NULL), $this);
            $this->mfi_hvf1_customer_current_address1->Required = true;
            $this->mfi_hvf1_customer_pin_code = new clsControl(ccsTextBox, "mfi_hvf1_customer_pin_code", "Mfi Hvf1 Customer Pin Code", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_pin_code", $Method, NULL), $this);
            $this->mfi_hvf1_customer_mobile_no = new clsControl(ccsTextBox, "mfi_hvf1_customer_mobile_no", "Mfi Hvf1 Customer Mobile No", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_mobile_no", $Method, NULL), $this);
            $this->mfi_hvf1_husband_mobile_no = new clsControl(ccsTextBox, "mfi_hvf1_husband_mobile_no", "Mfi Hvf1 Husband Mobile No", ccsText, "", CCGetRequestParam("mfi_hvf1_husband_mobile_no", $Method, NULL), $this);
            $this->mfi_hvf1_customer_residence_years = new clsControl(ccsTextBox, "mfi_hvf1_customer_residence_years", "Mfi Hvf1 Customer Residence Years", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_residence_years", $Method, NULL), $this);
            $this->mfi_hvf1_agricultureland = new clsControl(ccsTextBox, "mfi_hvf1_agricultureland", "Mfi Hvf1 Agricultureland", ccsInteger, "", CCGetRequestParam("mfi_hvf1_agricultureland", $Method, NULL), $this);
            $this->mfi_hvf1_no_of_crops = new clsControl(ccsTextBox, "mfi_hvf1_no_of_crops", "Mfi Hvf1 No Of Crops", ccsInteger, "", CCGetRequestParam("mfi_hvf1_no_of_crops", $Method, NULL), $this);
            $this->mfi_hvf1_total_milk_selling = new clsControl(ccsTextBox, "mfi_hvf1_total_milk_selling", "Mfi Hvf1 Total Milk Selling", ccsInteger, "", CCGetRequestParam("mfi_hvf1_total_milk_selling", $Method, NULL), $this);
            $this->mfi_hvf1_provision_grocery = new clsControl(ccsCheckBox, "mfi_hvf1_provision_grocery", "mfi_hvf1_provision_grocery", ccsText, "", CCGetRequestParam("mfi_hvf1_provision_grocery", $Method, NULL), $this);
            $this->mfi_hvf1_provision_grocery->CheckedValue = $this->mfi_hvf1_provision_grocery->GetParsedValue("YES");
            $this->mfi_hvf1_provision_grocery->UncheckedValue = $this->mfi_hvf1_provision_grocery->GetParsedValue("NO");
            $this->mfi_hvf1_customer_livestock_details_cows = new clsControl(ccsTextBox, "mfi_hvf1_customer_livestock_details_cows", "Mfi Hvf1 Customer Livestock Details Cows", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_livestock_details_cows", $Method, NULL), $this);
            $this->mfi_hvf1_customer_livestock_details_goats_sheep = new clsControl(ccsTextBox, "mfi_hvf1_customer_livestock_details_goats_sheep", "Mfi Hvf1 Customer Livestock Details Goats Sheep", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_livestock_details_goats_sheep", $Method, NULL), $this);
            $this->mfi_hvf1_barber_shop = new clsControl(ccsCheckBox, "mfi_hvf1_barber_shop", "mfi_hvf1_barber_shop", ccsText, "", CCGetRequestParam("mfi_hvf1_barber_shop", $Method, NULL), $this);
            $this->mfi_hvf1_barber_shop->CheckedValue = $this->mfi_hvf1_barber_shop->GetParsedValue("YES");
            $this->mfi_hvf1_barber_shop->UncheckedValue = $this->mfi_hvf1_barber_shop->GetParsedValue("NO");
            $this->mfi_hvf1_skilled_labour = new clsControl(ccsCheckBox, "mfi_hvf1_skilled_labour", "mfi_hvf1_skilled_labour", ccsText, "", CCGetRequestParam("mfi_hvf1_skilled_labour", $Method, NULL), $this);
            $this->mfi_hvf1_skilled_labour->CheckedValue = $this->mfi_hvf1_skilled_labour->GetParsedValue("YES");
            $this->mfi_hvf1_skilled_labour->UncheckedValue = $this->mfi_hvf1_skilled_labour->GetParsedValue("NO");
            $this->mfi_hvf1_customer_livestock_details_buffalos = new clsControl(ccsTextBox, "mfi_hvf1_customer_livestock_details_buffalos", "Mfi Hvf1 Customer Livestock Details Buffalos", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_livestock_details_buffalos", $Method, NULL), $this);
            $this->mfi_hvf1_customer_livestock_details_pigs = new clsControl(ccsTextBox, "mfi_hvf1_customer_livestock_details_pigs", "Mfi Hvf1 Customer Livestock Details Pigs", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_livestock_details_pigs", $Method, NULL), $this);
            $this->mfi_hvf1_cuttleri_cloth = new clsControl(ccsCheckBox, "mfi_hvf1_cuttleri_cloth", "mfi_hvf1_cuttleri_cloth", ccsText, "", CCGetRequestParam("mfi_hvf1_cuttleri_cloth", $Method, NULL), $this);
            $this->mfi_hvf1_cuttleri_cloth->CheckedValue = $this->mfi_hvf1_cuttleri_cloth->GetParsedValue("YES");
            $this->mfi_hvf1_cuttleri_cloth->UncheckedValue = $this->mfi_hvf1_cuttleri_cloth->GetParsedValue("NO");
            $this->mfi_hvf1_tailoring_shop = new clsControl(ccsCheckBox, "mfi_hvf1_tailoring_shop", "mfi_hvf1_tailoring_shop", ccsText, "", CCGetRequestParam("mfi_hvf1_tailoring_shop", $Method, NULL), $this);
            $this->mfi_hvf1_tailoring_shop->CheckedValue = $this->mfi_hvf1_tailoring_shop->GetParsedValue("YES");
            $this->mfi_hvf1_tailoring_shop->UncheckedValue = $this->mfi_hvf1_tailoring_shop->GetParsedValue("NO");
            $this->mfi_hvf1_customer_livestock_details_bullocks_ox = new clsControl(ccsTextBox, "mfi_hvf1_customer_livestock_details_bullocks_ox", "Mfi Hvf1 Customer Livestock Details Bullocks Ox", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_livestock_details_bullocks_ox", $Method, NULL), $this);
            $this->mfi_hvf1_customer_livestock_details_chicken = new clsControl(ccsTextBox, "mfi_hvf1_customer_livestock_details_chicken", "Mfi Hvf1 Customer Livestock Details Chicken", ccsInteger, "", CCGetRequestParam("mfi_hvf1_customer_livestock_details_chicken", $Method, NULL), $this);
            $this->mfi_hvf1_cycle_repair = new clsControl(ccsCheckBox, "mfi_hvf1_cycle_repair", "mfi_hvf1_cycle_repair", ccsText, "", CCGetRequestParam("mfi_hvf1_cycle_repair", $Method, NULL), $this);
            $this->mfi_hvf1_cycle_repair->CheckedValue = $this->mfi_hvf1_cycle_repair->GetParsedValue("YES");
            $this->mfi_hvf1_cycle_repair->UncheckedValue = $this->mfi_hvf1_cycle_repair->GetParsedValue("NO");
            $this->mfi_hvf1_tea_fastfood = new clsControl(ccsCheckBox, "mfi_hvf1_tea_fastfood", "mfi_hvf1_tea_fastfood", ccsText, "", CCGetRequestParam("mfi_hvf1_tea_fastfood", $Method, NULL), $this);
            $this->mfi_hvf1_tea_fastfood->CheckedValue = $this->mfi_hvf1_tea_fastfood->GetParsedValue("YES");
            $this->mfi_hvf1_tea_fastfood->UncheckedValue = $this->mfi_hvf1_tea_fastfood->GetParsedValue("NO");
            $this->mfi_hvf1_daily_labour = new clsControl(ccsCheckBox, "mfi_hvf1_daily_labour", "mfi_hvf1_daily_labour", ccsText, "", CCGetRequestParam("mfi_hvf1_daily_labour", $Method, NULL), $this);
            $this->mfi_hvf1_daily_labour->CheckedValue = $this->mfi_hvf1_daily_labour->GetParsedValue("YES");
            $this->mfi_hvf1_daily_labour->UncheckedValue = $this->mfi_hvf1_daily_labour->GetParsedValue("NO");
            $this->mfi_hvf1_others = new clsControl(ccsCheckBox, "mfi_hvf1_others", "mfi_hvf1_others", ccsText, "", CCGetRequestParam("mfi_hvf1_others", $Method, NULL), $this);
            $this->mfi_hvf1_others->CheckedValue = $this->mfi_hvf1_others->GetParsedValue("YES");
            $this->mfi_hvf1_others->UncheckedValue = $this->mfi_hvf1_others->GetParsedValue("NO");
            $this->mfi_hvf1_fruit_vegetables = new clsControl(ccsCheckBox, "mfi_hvf1_fruit_vegetables", "mfi_hvf1_fruit_vegetables", ccsText, "", CCGetRequestParam("mfi_hvf1_fruit_vegetables", $Method, NULL), $this);
            $this->mfi_hvf1_fruit_vegetables->CheckedValue = $this->mfi_hvf1_fruit_vegetables->GetParsedValue("YES");
            $this->mfi_hvf1_fruit_vegetables->UncheckedValue = $this->mfi_hvf1_fruit_vegetables->GetParsedValue("NO");
            $this->mfi_hvf1_other_income_details = new clsControl(ccsTextBox, "mfi_hvf1_other_income_details", "Mfi Hvf1 Other Income Details", ccsText, "", CCGetRequestParam("mfi_hvf1_other_income_details", $Method, NULL), $this);
            $this->mfi_hvf1_customer_vehicles_cycle_cart = new clsControl(ccsCheckBox, "mfi_hvf1_customer_vehicles_cycle_cart", "mfi_hvf1_customer_vehicles_cycle_cart", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_vehicles_cycle_cart", $Method, NULL), $this);
            $this->mfi_hvf1_customer_vehicles_cycle_cart->CheckedValue = $this->mfi_hvf1_customer_vehicles_cycle_cart->GetParsedValue("YES");
            $this->mfi_hvf1_customer_vehicles_cycle_cart->UncheckedValue = $this->mfi_hvf1_customer_vehicles_cycle_cart->GetParsedValue("NO");
            $this->mfi_hvf1_customer_vehicles_tractor = new clsControl(ccsCheckBox, "mfi_hvf1_customer_vehicles_tractor", "mfi_hvf1_customer_vehicles_tractor", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_vehicles_tractor", $Method, NULL), $this);
            $this->mfi_hvf1_customer_vehicles_tractor->CheckedValue = $this->mfi_hvf1_customer_vehicles_tractor->GetParsedValue("YES");
            $this->mfi_hvf1_customer_vehicles_tractor->UncheckedValue = $this->mfi_hvf1_customer_vehicles_tractor->GetParsedValue("NO");
            $this->mfi_hvf1_customer_vehicles_two_wheeler = new clsControl(ccsCheckBox, "mfi_hvf1_customer_vehicles_two_wheeler", "mfi_hvf1_customer_vehicles_two_wheeler", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_vehicles_two_wheeler", $Method, NULL), $this);
            $this->mfi_hvf1_customer_vehicles_two_wheeler->CheckedValue = $this->mfi_hvf1_customer_vehicles_two_wheeler->GetParsedValue("YES");
            $this->mfi_hvf1_customer_vehicles_two_wheeler->UncheckedValue = $this->mfi_hvf1_customer_vehicles_two_wheeler->GetParsedValue("NO");
            $this->mfi_hvf1_customer_vehicles_bullock_cart = new clsControl(ccsCheckBox, "mfi_hvf1_customer_vehicles_bullock_cart", "mfi_hvf1_customer_vehicles_bullock_cart", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_vehicles_bullock_cart", $Method, NULL), $this);
            $this->mfi_hvf1_customer_vehicles_bullock_cart->CheckedValue = $this->mfi_hvf1_customer_vehicles_bullock_cart->GetParsedValue("YES");
            $this->mfi_hvf1_customer_vehicles_bullock_cart->UncheckedValue = $this->mfi_hvf1_customer_vehicles_bullock_cart->GetParsedValue("NO");
            $this->mfi_hvf1_customer_vehicles_auto_or_tempo = new clsControl(ccsCheckBox, "mfi_hvf1_customer_vehicles_auto_or_tempo", "mfi_hvf1_customer_vehicles_auto_or_tempo", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_vehicles_auto_or_tempo", $Method, NULL), $this);
            $this->mfi_hvf1_customer_vehicles_auto_or_tempo->CheckedValue = $this->mfi_hvf1_customer_vehicles_auto_or_tempo->GetParsedValue("YES");
            $this->mfi_hvf1_customer_vehicles_auto_or_tempo->UncheckedValue = $this->mfi_hvf1_customer_vehicles_auto_or_tempo->GetParsedValue("NO");
            $this->mfi_hvf1_financial_inclusion_loans = new clsControl(ccsCheckBox, "mfi_hvf1_financial_inclusion_loans", "Mfi Hvf1 Financial Inclusion Loans", ccsText, "", CCGetRequestParam("mfi_hvf1_financial_inclusion_loans", $Method, NULL), $this);
            $this->mfi_hvf1_financial_inclusion_loans->CheckedValue = $this->mfi_hvf1_financial_inclusion_loans->GetParsedValue("YES");
            $this->mfi_hvf1_financial_inclusion_loans->UncheckedValue = $this->mfi_hvf1_financial_inclusion_loans->GetParsedValue("NO");
            $this->mfi_hvf1_financial_inclusion_bank_account = new clsControl(ccsCheckBox, "mfi_hvf1_financial_inclusion_bank_account", "mfi_hvf1_financial_inclusion_bank_account", ccsInteger, "", CCGetRequestParam("mfi_hvf1_financial_inclusion_bank_account", $Method, NULL), $this);
            $this->mfi_hvf1_financial_inclusion_bank_account->CheckedValue = $this->mfi_hvf1_financial_inclusion_bank_account->GetParsedValue(1);
            $this->mfi_hvf1_financial_inclusion_bank_account->UncheckedValue = $this->mfi_hvf1_financial_inclusion_bank_account->GetParsedValue(0);
            $this->mfi_hvf1_financial_inclusion_insurance = new clsControl(ccsCheckBox, "mfi_hvf1_financial_inclusion_insurance", "mfi_hvf1_financial_inclusion_insurance", ccsInteger, "", CCGetRequestParam("mfi_hvf1_financial_inclusion_insurance", $Method, NULL), $this);
            $this->mfi_hvf1_financial_inclusion_insurance->CheckedValue = $this->mfi_hvf1_financial_inclusion_insurance->GetParsedValue(1);
            $this->mfi_hvf1_financial_inclusion_insurance->UncheckedValue = $this->mfi_hvf1_financial_inclusion_insurance->GetParsedValue(0);
            $this->mfi_hvf1_financial_inclusion_chits = new clsControl(ccsCheckBox, "mfi_hvf1_financial_inclusion_chits", "mfi_hvf1_financial_inclusion_chits", ccsInteger, "", CCGetRequestParam("mfi_hvf1_financial_inclusion_chits", $Method, NULL), $this);
            $this->mfi_hvf1_financial_inclusion_chits->CheckedValue = $this->mfi_hvf1_financial_inclusion_chits->GetParsedValue(1);
            $this->mfi_hvf1_financial_inclusion_chits->UncheckedValue = $this->mfi_hvf1_financial_inclusion_chits->GetParsedValue(0);
            $this->mfi_hvf1_financial_inclusion_micro_rimittances = new clsControl(ccsCheckBox, "mfi_hvf1_financial_inclusion_micro_rimittances", "mfi_hvf1_financial_inclusion_micro_rimittances", ccsInteger, "", CCGetRequestParam("mfi_hvf1_financial_inclusion_micro_rimittances", $Method, NULL), $this);
            $this->mfi_hvf1_financial_inclusion_micro_rimittances->CheckedValue = $this->mfi_hvf1_financial_inclusion_micro_rimittances->GetParsedValue(1);
            $this->mfi_hvf1_financial_inclusion_micro_rimittances->UncheckedValue = $this->mfi_hvf1_financial_inclusion_micro_rimittances->GetParsedValue(0);
            $this->mfi_hvf1_financial_inclusion_others = new clsControl(ccsCheckBox, "mfi_hvf1_financial_inclusion_others", "mfi_hvf1_financial_inclusion_others", ccsInteger, "", CCGetRequestParam("mfi_hvf1_financial_inclusion_others", $Method, NULL), $this);
            $this->mfi_hvf1_financial_inclusion_others->CheckedValue = $this->mfi_hvf1_financial_inclusion_others->GetParsedValue(1);
            $this->mfi_hvf1_financial_inclusion_others->UncheckedValue = $this->mfi_hvf1_financial_inclusion_others->GetParsedValue(0);
            $this->mfi_hvf1_financial_inclusion_others_specify = new clsControl(ccsTextBox, "mfi_hvf1_financial_inclusion_others_specify", "Mfi Hvf1 Financial Inclusion Others Specify", ccsText, "", CCGetRequestParam("mfi_hvf1_financial_inclusion_others_specify", $Method, NULL), $this);
            $this->household_children = new clsControl(ccsTextBox, "household_children", "Household Children", ccsInteger, "", CCGetRequestParam("household_children", $Method, NULL), $this);
            $this->household_adults = new clsControl(ccsTextBox, "household_adults", "Household Adults", ccsInteger, "", CCGetRequestParam("household_adults", $Method, NULL), $this);
            $this->husband_kyc_type = new clsControl(ccsTextBox, "husband_kyc_type", "husband_kyc_type", ccsText, "", CCGetRequestParam("husband_kyc_type", $Method, NULL), $this);
            $this->borrower_other_occupation = new clsControl(ccsTextBox, "borrower_other_occupation", "borrower_other_occupation", ccsText, "", CCGetRequestParam("borrower_other_occupation", $Method, NULL), $this);
            $this->gurantor_other_occupation = new clsControl(ccsTextBox, "gurantor_other_occupation", "gurantor_other_occupation", ccsText, "", CCGetRequestParam("gurantor_other_occupation", $Method, NULL), $this);
            $this->Auto_Rickshaw_Driver = new clsControl(ccsCheckBox, "Auto_Rickshaw_Driver", "Auto_Rickshaw_Driver", ccsText, "", CCGetRequestParam("Auto_Rickshaw_Driver", $Method, NULL), $this);
            $this->Auto_Rickshaw_Driver->CheckedValue = $this->Auto_Rickshaw_Driver->GetParsedValue("YES");
            $this->Auto_Rickshaw_Driver->UncheckedValue = $this->Auto_Rickshaw_Driver->GetParsedValue("NO");
            $this->other_monthly_hh_income = new clsControl(ccsTextBox, "other_monthly_hh_income", "other_monthly_hh_income", ccsText, "", CCGetRequestParam("other_monthly_hh_income", $Method, NULL), $this);
            $this->marital_status = new clsControl(ccsHidden, "marital_status", "marital_status", ccsText, "", CCGetRequestParam("marital_status", $Method, NULL), $this);
            $this->borrower_religion = new clsControl(ccsHidden, "borrower_religion", "borrower_religion", ccsText, "", CCGetRequestParam("borrower_religion", $Method, NULL), $this);
            $this->customer_caste = new clsControl(ccsHidden, "customer_caste", "customer_caste", ccsText, "", CCGetRequestParam("customer_caste", $Method, NULL), $this);
            $this->customer_education = new clsControl(ccsHidden, "customer_education", "customer_education", ccsText, "", CCGetRequestParam("customer_education", $Method, NULL), $this);
            $this->borrower_occupation = new clsControl(ccsHidden, "borrower_occupation", "borrower_occupation", ccsText, "", CCGetRequestParam("borrower_occupation", $Method, NULL), $this);
            $this->gurantor_occupation = new clsControl(ccsHidden, "gurantor_occupation", "gurantor_occupation", ccsText, "", CCGetRequestParam("gurantor_occupation", $Method, NULL), $this);
            $this->house_type = new clsControl(ccsHidden, "house_type", "house_type", ccsText, "", CCGetRequestParam("house_type", $Method, NULL), $this);
            $this->monthly_hh_income = new clsControl(ccsHidden, "monthly_hh_income", "monthly_hh_income", ccsText, "", CCGetRequestParam("monthly_hh_income", $Method, NULL), $this);
            $this->added_by = new clsControl(ccsHidden, "added_by", "added_by", ccsText, "", CCGetRequestParam("added_by", $Method, NULL), $this);
            $this->added_at = new clsControl(ccsHidden, "added_at", "added_at", ccsText, "", CCGetRequestParam("added_at", $Method, NULL), $this);
            $this->updated_by = new clsControl(ccsHidden, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->updated_at = new clsControl(ccsHidden, "updated_at", "updated_at", ccsText, "", CCGetRequestParam("updated_at", $Method, NULL), $this);
            $this->gp_no = new clsControl(ccsHidden, "gp_no", "gp_no", ccsText, "", CCGetRequestParam("gp_no", $Method, NULL), $this);
            $this->natureofresidence = new clsControl(ccsHidden, "natureofresidence", "natureofresidence", ccsText, "", CCGetRequestParam("natureofresidence", $Method, NULL), $this);
            $this->daily_labour_count = new clsControl(ccsTextBox, "daily_labour_count", "daily_labour_count", ccsText, "", CCGetRequestParam("daily_labour_count", $Method, NULL), $this);
            $this->household_total_members = new clsControl(ccsTextBox, "household_total_members", "household_total_members", ccsText, "", CCGetRequestParam("household_total_members", $Method, NULL), $this);
            $this->RadioButton1 = new clsControl(ccsRadioButton, "RadioButton1", "RadioButton1", ccsText, "", CCGetRequestParam("RadioButton1", $Method, NULL), $this);
            $this->RadioButton1->DSType = dsListOfValues;
            $this->RadioButton1->Values = array(array("Voter ID", "Voter ID"), array("Ration Card", "Ration Card"), array("AadhaarID", "AadhaarID"), array("Other", "Other"));
            $this->RadioButton1->HTML = true;
            $this->member_kyc_type = new clsControl(ccsTextBox, "member_kyc_type", "member_kyc_type", ccsText, "", CCGetRequestParam("member_kyc_type", $Method, NULL), $this);
            $this->RadioButton2 = new clsControl(ccsRadioButton, "RadioButton2", "RadioButton2", ccsText, "", CCGetRequestParam("RadioButton2", $Method, NULL), $this);
            $this->RadioButton2->DSType = dsListOfValues;
            $this->RadioButton2->Values = array(array("Voter ID", "Voter ID"), array("Ration Card", "Ration Card"), array("AadhaarID", "AadhaarID"), array("Other", "Other"));
            $this->RadioButton2->HTML = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->mfi_hvf1_provision_grocery->Value) && !strlen($this->mfi_hvf1_provision_grocery->Value) && $this->mfi_hvf1_provision_grocery->Value !== false)
                    $this->mfi_hvf1_provision_grocery->SetValue(false);
                if(!is_array($this->mfi_hvf1_barber_shop->Value) && !strlen($this->mfi_hvf1_barber_shop->Value) && $this->mfi_hvf1_barber_shop->Value !== false)
                    $this->mfi_hvf1_barber_shop->SetValue(false);
                if(!is_array($this->mfi_hvf1_skilled_labour->Value) && !strlen($this->mfi_hvf1_skilled_labour->Value) && $this->mfi_hvf1_skilled_labour->Value !== false)
                    $this->mfi_hvf1_skilled_labour->SetValue(false);
                if(!is_array($this->mfi_hvf1_cuttleri_cloth->Value) && !strlen($this->mfi_hvf1_cuttleri_cloth->Value) && $this->mfi_hvf1_cuttleri_cloth->Value !== false)
                    $this->mfi_hvf1_cuttleri_cloth->SetValue(false);
                if(!is_array($this->mfi_hvf1_tailoring_shop->Value) && !strlen($this->mfi_hvf1_tailoring_shop->Value) && $this->mfi_hvf1_tailoring_shop->Value !== false)
                    $this->mfi_hvf1_tailoring_shop->SetValue(false);
                if(!is_array($this->mfi_hvf1_cycle_repair->Value) && !strlen($this->mfi_hvf1_cycle_repair->Value) && $this->mfi_hvf1_cycle_repair->Value !== false)
                    $this->mfi_hvf1_cycle_repair->SetValue(false);
                if(!is_array($this->mfi_hvf1_tea_fastfood->Value) && !strlen($this->mfi_hvf1_tea_fastfood->Value) && $this->mfi_hvf1_tea_fastfood->Value !== false)
                    $this->mfi_hvf1_tea_fastfood->SetValue(false);
                if(!is_array($this->mfi_hvf1_daily_labour->Value) && !strlen($this->mfi_hvf1_daily_labour->Value) && $this->mfi_hvf1_daily_labour->Value !== false)
                    $this->mfi_hvf1_daily_labour->SetValue(false);
                if(!is_array($this->mfi_hvf1_others->Value) && !strlen($this->mfi_hvf1_others->Value) && $this->mfi_hvf1_others->Value !== false)
                    $this->mfi_hvf1_others->SetValue(false);
                if(!is_array($this->mfi_hvf1_fruit_vegetables->Value) && !strlen($this->mfi_hvf1_fruit_vegetables->Value) && $this->mfi_hvf1_fruit_vegetables->Value !== false)
                    $this->mfi_hvf1_fruit_vegetables->SetValue(false);
                if(!is_array($this->mfi_hvf1_customer_vehicles_cycle_cart->Value) && !strlen($this->mfi_hvf1_customer_vehicles_cycle_cart->Value) && $this->mfi_hvf1_customer_vehicles_cycle_cart->Value !== false)
                    $this->mfi_hvf1_customer_vehicles_cycle_cart->SetValue(false);
                if(!is_array($this->mfi_hvf1_customer_vehicles_tractor->Value) && !strlen($this->mfi_hvf1_customer_vehicles_tractor->Value) && $this->mfi_hvf1_customer_vehicles_tractor->Value !== false)
                    $this->mfi_hvf1_customer_vehicles_tractor->SetValue(false);
                if(!is_array($this->mfi_hvf1_customer_vehicles_two_wheeler->Value) && !strlen($this->mfi_hvf1_customer_vehicles_two_wheeler->Value) && $this->mfi_hvf1_customer_vehicles_two_wheeler->Value !== false)
                    $this->mfi_hvf1_customer_vehicles_two_wheeler->SetValue(false);
                if(!is_array($this->mfi_hvf1_customer_vehicles_bullock_cart->Value) && !strlen($this->mfi_hvf1_customer_vehicles_bullock_cart->Value) && $this->mfi_hvf1_customer_vehicles_bullock_cart->Value !== false)
                    $this->mfi_hvf1_customer_vehicles_bullock_cart->SetValue(false);
                if(!is_array($this->mfi_hvf1_customer_vehicles_auto_or_tempo->Value) && !strlen($this->mfi_hvf1_customer_vehicles_auto_or_tempo->Value) && $this->mfi_hvf1_customer_vehicles_auto_or_tempo->Value !== false)
                    $this->mfi_hvf1_customer_vehicles_auto_or_tempo->SetValue(false);
                if(!is_array($this->mfi_hvf1_financial_inclusion_loans->Value) && !strlen($this->mfi_hvf1_financial_inclusion_loans->Value) && $this->mfi_hvf1_financial_inclusion_loans->Value !== false)
                    $this->mfi_hvf1_financial_inclusion_loans->SetValue(false);
                if(!is_array($this->mfi_hvf1_financial_inclusion_bank_account->Value) && !strlen($this->mfi_hvf1_financial_inclusion_bank_account->Value) && $this->mfi_hvf1_financial_inclusion_bank_account->Value !== false)
                    $this->mfi_hvf1_financial_inclusion_bank_account->SetValue(false);
                if(!is_array($this->mfi_hvf1_financial_inclusion_insurance->Value) && !strlen($this->mfi_hvf1_financial_inclusion_insurance->Value) && $this->mfi_hvf1_financial_inclusion_insurance->Value !== false)
                    $this->mfi_hvf1_financial_inclusion_insurance->SetValue(false);
                if(!is_array($this->mfi_hvf1_financial_inclusion_chits->Value) && !strlen($this->mfi_hvf1_financial_inclusion_chits->Value) && $this->mfi_hvf1_financial_inclusion_chits->Value !== false)
                    $this->mfi_hvf1_financial_inclusion_chits->SetValue(false);
                if(!is_array($this->mfi_hvf1_financial_inclusion_micro_rimittances->Value) && !strlen($this->mfi_hvf1_financial_inclusion_micro_rimittances->Value) && $this->mfi_hvf1_financial_inclusion_micro_rimittances->Value !== false)
                    $this->mfi_hvf1_financial_inclusion_micro_rimittances->SetValue(false);
                if(!is_array($this->mfi_hvf1_financial_inclusion_others->Value) && !strlen($this->mfi_hvf1_financial_inclusion_others->Value) && $this->mfi_hvf1_financial_inclusion_others->Value !== false)
                    $this->mfi_hvf1_financial_inclusion_others->SetValue(false);
                if(!is_array($this->Auto_Rickshaw_Driver->Value) && !strlen($this->Auto_Rickshaw_Driver->Value) && $this->Auto_Rickshaw_Driver->Value !== false)
                    $this->Auto_Rickshaw_Driver->SetValue(false);
            }
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

//Validate Method @2-D140F678
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->la_id->Validate() && $Validation);
        $Validation = ($this->hv_route->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_relogin_hv_no->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_existing_enrollment_no->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_name->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_father_name->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_husband_name->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_age_years->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_husband_age_years->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_kyc_id_no->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_husband_kyc_id_no->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_current_address1->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_pin_code->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_mobile_no->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_husband_mobile_no->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_residence_years->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_agricultureland->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_no_of_crops->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_total_milk_selling->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_provision_grocery->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_livestock_details_cows->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_livestock_details_goats_sheep->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_barber_shop->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_skilled_labour->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_livestock_details_buffalos->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_livestock_details_pigs->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_cuttleri_cloth->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_tailoring_shop->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_livestock_details_bullocks_ox->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_livestock_details_chicken->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_cycle_repair->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_tea_fastfood->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_daily_labour->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_others->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_fruit_vegetables->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_other_income_details->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_vehicles_cycle_cart->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_vehicles_tractor->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_vehicles_two_wheeler->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_vehicles_bullock_cart->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_customer_vehicles_auto_or_tempo->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_financial_inclusion_loans->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_financial_inclusion_bank_account->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_financial_inclusion_insurance->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_financial_inclusion_chits->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_financial_inclusion_micro_rimittances->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_financial_inclusion_others->Validate() && $Validation);
        $Validation = ($this->mfi_hvf1_financial_inclusion_others_specify->Validate() && $Validation);
        $Validation = ($this->household_children->Validate() && $Validation);
        $Validation = ($this->household_adults->Validate() && $Validation);
        $Validation = ($this->husband_kyc_type->Validate() && $Validation);
        $Validation = ($this->borrower_other_occupation->Validate() && $Validation);
        $Validation = ($this->gurantor_other_occupation->Validate() && $Validation);
        $Validation = ($this->Auto_Rickshaw_Driver->Validate() && $Validation);
        $Validation = ($this->other_monthly_hh_income->Validate() && $Validation);
        $Validation = ($this->marital_status->Validate() && $Validation);
        $Validation = ($this->borrower_religion->Validate() && $Validation);
        $Validation = ($this->customer_caste->Validate() && $Validation);
        $Validation = ($this->customer_education->Validate() && $Validation);
        $Validation = ($this->borrower_occupation->Validate() && $Validation);
        $Validation = ($this->gurantor_occupation->Validate() && $Validation);
        $Validation = ($this->house_type->Validate() && $Validation);
        $Validation = ($this->monthly_hh_income->Validate() && $Validation);
        $Validation = ($this->added_by->Validate() && $Validation);
        $Validation = ($this->added_at->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->updated_at->Validate() && $Validation);
        $Validation = ($this->gp_no->Validate() && $Validation);
        $Validation = ($this->natureofresidence->Validate() && $Validation);
        $Validation = ($this->daily_labour_count->Validate() && $Validation);
        $Validation = ($this->household_total_members->Validate() && $Validation);
        $Validation = ($this->RadioButton1->Validate() && $Validation);
        $Validation = ($this->member_kyc_type->Validate() && $Validation);
        $Validation = ($this->RadioButton2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->la_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->hv_route->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_relogin_hv_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_existing_enrollment_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_father_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_husband_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_age_years->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_husband_age_years->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_kyc_id_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_husband_kyc_id_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_current_address1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_pin_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_husband_mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_residence_years->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_agricultureland->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_no_of_crops->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_total_milk_selling->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_provision_grocery->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_livestock_details_cows->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_livestock_details_goats_sheep->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_barber_shop->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_skilled_labour->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_livestock_details_buffalos->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_livestock_details_pigs->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_cuttleri_cloth->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_tailoring_shop->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_livestock_details_bullocks_ox->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_livestock_details_chicken->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_cycle_repair->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_tea_fastfood->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_daily_labour->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_others->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_fruit_vegetables->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_other_income_details->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_vehicles_cycle_cart->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_vehicles_tractor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_vehicles_two_wheeler->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_vehicles_bullock_cart->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_customer_vehicles_auto_or_tempo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_financial_inclusion_loans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_financial_inclusion_bank_account->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_financial_inclusion_insurance->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_financial_inclusion_chits->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_financial_inclusion_micro_rimittances->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_financial_inclusion_others->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf1_financial_inclusion_others_specify->Errors->Count() == 0);
        $Validation =  $Validation && ($this->household_children->Errors->Count() == 0);
        $Validation =  $Validation && ($this->household_adults->Errors->Count() == 0);
        $Validation =  $Validation && ($this->husband_kyc_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->borrower_other_occupation->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_other_occupation->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Auto_Rickshaw_Driver->Errors->Count() == 0);
        $Validation =  $Validation && ($this->other_monthly_hh_income->Errors->Count() == 0);
        $Validation =  $Validation && ($this->marital_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->borrower_religion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->customer_caste->Errors->Count() == 0);
        $Validation =  $Validation && ($this->customer_education->Errors->Count() == 0);
        $Validation =  $Validation && ($this->borrower_occupation->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gurantor_occupation->Errors->Count() == 0);
        $Validation =  $Validation && ($this->house_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->monthly_hh_income->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->added_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gp_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->natureofresidence->Errors->Count() == 0);
        $Validation =  $Validation && ($this->daily_labour_count->Errors->Count() == 0);
        $Validation =  $Validation && ($this->household_total_members->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RadioButton1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_kyc_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RadioButton2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-AD938DE6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->la_id->Errors->Count());
        $errors = ($errors || $this->hv_route->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_relogin_hv_no->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_existing_enrollment_no->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_name->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_father_name->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_husband_name->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_age_years->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_husband_age_years->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_kyc_id_no->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_husband_kyc_id_no->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_current_address1->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_pin_code->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_mobile_no->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_husband_mobile_no->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_residence_years->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_agricultureland->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_no_of_crops->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_total_milk_selling->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_provision_grocery->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_livestock_details_cows->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_livestock_details_goats_sheep->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_barber_shop->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_skilled_labour->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_livestock_details_buffalos->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_livestock_details_pigs->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_cuttleri_cloth->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_tailoring_shop->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_livestock_details_bullocks_ox->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_livestock_details_chicken->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_cycle_repair->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_tea_fastfood->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_daily_labour->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_others->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_fruit_vegetables->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_other_income_details->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_vehicles_cycle_cart->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_vehicles_tractor->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_vehicles_two_wheeler->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_vehicles_bullock_cart->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_vehicles_auto_or_tempo->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_financial_inclusion_loans->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_financial_inclusion_bank_account->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_financial_inclusion_insurance->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_financial_inclusion_chits->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_financial_inclusion_micro_rimittances->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_financial_inclusion_others->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_financial_inclusion_others_specify->Errors->Count());
        $errors = ($errors || $this->household_children->Errors->Count());
        $errors = ($errors || $this->household_adults->Errors->Count());
        $errors = ($errors || $this->husband_kyc_type->Errors->Count());
        $errors = ($errors || $this->borrower_other_occupation->Errors->Count());
        $errors = ($errors || $this->gurantor_other_occupation->Errors->Count());
        $errors = ($errors || $this->Auto_Rickshaw_Driver->Errors->Count());
        $errors = ($errors || $this->other_monthly_hh_income->Errors->Count());
        $errors = ($errors || $this->marital_status->Errors->Count());
        $errors = ($errors || $this->borrower_religion->Errors->Count());
        $errors = ($errors || $this->customer_caste->Errors->Count());
        $errors = ($errors || $this->customer_education->Errors->Count());
        $errors = ($errors || $this->borrower_occupation->Errors->Count());
        $errors = ($errors || $this->gurantor_occupation->Errors->Count());
        $errors = ($errors || $this->house_type->Errors->Count());
        $errors = ($errors || $this->monthly_hh_income->Errors->Count());
        $errors = ($errors || $this->added_by->Errors->Count());
        $errors = ($errors || $this->added_at->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->updated_at->Errors->Count());
        $errors = ($errors || $this->gp_no->Errors->Count());
        $errors = ($errors || $this->natureofresidence->Errors->Count());
        $errors = ($errors || $this->daily_labour_count->Errors->Count());
        $errors = ($errors || $this->household_total_members->Errors->Count());
        $errors = ($errors || $this->RadioButton1->Errors->Count());
        $errors = ($errors || $this->member_kyc_type->Errors->Count());
        $errors = ($errors || $this->RadioButton2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-E955BD63
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
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
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

//InsertRow Method @2-85F379D4
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->la_id->SetValue($this->la_id->GetValue(true));
        $this->DataSource->hv_route->SetValue($this->hv_route->GetValue(true));
        $this->DataSource->mfi_hvf1_relogin_hv_no->SetValue($this->mfi_hvf1_relogin_hv_no->GetValue(true));
        $this->DataSource->mfi_hvf1_existing_enrollment_no->SetValue($this->mfi_hvf1_existing_enrollment_no->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_name->SetValue($this->mfi_hvf1_customer_name->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_father_name->SetValue($this->mfi_hvf1_customer_father_name->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_husband_name->SetValue($this->mfi_hvf1_customer_husband_name->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_age_years->SetValue($this->mfi_hvf1_customer_age_years->GetValue(true));
        $this->DataSource->mfi_hvf1_husband_age_years->SetValue($this->mfi_hvf1_husband_age_years->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_kyc_id_no->SetValue($this->mfi_hvf1_customer_kyc_id_no->GetValue(true));
        $this->DataSource->mfi_hvf1_husband_kyc_id_no->SetValue($this->mfi_hvf1_husband_kyc_id_no->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_current_address1->SetValue($this->mfi_hvf1_customer_current_address1->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_pin_code->SetValue($this->mfi_hvf1_customer_pin_code->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_mobile_no->SetValue($this->mfi_hvf1_customer_mobile_no->GetValue(true));
        $this->DataSource->mfi_hvf1_husband_mobile_no->SetValue($this->mfi_hvf1_husband_mobile_no->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_residence_years->SetValue($this->mfi_hvf1_customer_residence_years->GetValue(true));
        $this->DataSource->mfi_hvf1_agricultureland->SetValue($this->mfi_hvf1_agricultureland->GetValue(true));
        $this->DataSource->mfi_hvf1_no_of_crops->SetValue($this->mfi_hvf1_no_of_crops->GetValue(true));
        $this->DataSource->mfi_hvf1_total_milk_selling->SetValue($this->mfi_hvf1_total_milk_selling->GetValue(true));
        $this->DataSource->mfi_hvf1_provision_grocery->SetValue($this->mfi_hvf1_provision_grocery->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_cows->SetValue($this->mfi_hvf1_customer_livestock_details_cows->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_goats_sheep->SetValue($this->mfi_hvf1_customer_livestock_details_goats_sheep->GetValue(true));
        $this->DataSource->mfi_hvf1_barber_shop->SetValue($this->mfi_hvf1_barber_shop->GetValue(true));
        $this->DataSource->mfi_hvf1_skilled_labour->SetValue($this->mfi_hvf1_skilled_labour->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_buffalos->SetValue($this->mfi_hvf1_customer_livestock_details_buffalos->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_pigs->SetValue($this->mfi_hvf1_customer_livestock_details_pigs->GetValue(true));
        $this->DataSource->mfi_hvf1_cuttleri_cloth->SetValue($this->mfi_hvf1_cuttleri_cloth->GetValue(true));
        $this->DataSource->mfi_hvf1_tailoring_shop->SetValue($this->mfi_hvf1_tailoring_shop->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_bullocks_ox->SetValue($this->mfi_hvf1_customer_livestock_details_bullocks_ox->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_chicken->SetValue($this->mfi_hvf1_customer_livestock_details_chicken->GetValue(true));
        $this->DataSource->mfi_hvf1_cycle_repair->SetValue($this->mfi_hvf1_cycle_repair->GetValue(true));
        $this->DataSource->mfi_hvf1_tea_fastfood->SetValue($this->mfi_hvf1_tea_fastfood->GetValue(true));
        $this->DataSource->mfi_hvf1_daily_labour->SetValue($this->mfi_hvf1_daily_labour->GetValue(true));
        $this->DataSource->mfi_hvf1_others->SetValue($this->mfi_hvf1_others->GetValue(true));
        $this->DataSource->mfi_hvf1_fruit_vegetables->SetValue($this->mfi_hvf1_fruit_vegetables->GetValue(true));
        $this->DataSource->mfi_hvf1_other_income_details->SetValue($this->mfi_hvf1_other_income_details->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_cycle_cart->SetValue($this->mfi_hvf1_customer_vehicles_cycle_cart->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_tractor->SetValue($this->mfi_hvf1_customer_vehicles_tractor->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_two_wheeler->SetValue($this->mfi_hvf1_customer_vehicles_two_wheeler->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_bullock_cart->SetValue($this->mfi_hvf1_customer_vehicles_bullock_cart->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_auto_or_tempo->SetValue($this->mfi_hvf1_customer_vehicles_auto_or_tempo->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_loans->SetValue($this->mfi_hvf1_financial_inclusion_loans->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_bank_account->SetValue($this->mfi_hvf1_financial_inclusion_bank_account->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_insurance->SetValue($this->mfi_hvf1_financial_inclusion_insurance->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_chits->SetValue($this->mfi_hvf1_financial_inclusion_chits->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_micro_rimittances->SetValue($this->mfi_hvf1_financial_inclusion_micro_rimittances->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_others->SetValue($this->mfi_hvf1_financial_inclusion_others->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_others_specify->SetValue($this->mfi_hvf1_financial_inclusion_others_specify->GetValue(true));
        $this->DataSource->household_children->SetValue($this->household_children->GetValue(true));
        $this->DataSource->household_adults->SetValue($this->household_adults->GetValue(true));
        $this->DataSource->husband_kyc_type->SetValue($this->husband_kyc_type->GetValue(true));
        $this->DataSource->borrower_other_occupation->SetValue($this->borrower_other_occupation->GetValue(true));
        $this->DataSource->gurantor_other_occupation->SetValue($this->gurantor_other_occupation->GetValue(true));
        $this->DataSource->Auto_Rickshaw_Driver->SetValue($this->Auto_Rickshaw_Driver->GetValue(true));
        $this->DataSource->other_monthly_hh_income->SetValue($this->other_monthly_hh_income->GetValue(true));
        $this->DataSource->marital_status->SetValue($this->marital_status->GetValue(true));
        $this->DataSource->borrower_religion->SetValue($this->borrower_religion->GetValue(true));
        $this->DataSource->customer_caste->SetValue($this->customer_caste->GetValue(true));
        $this->DataSource->customer_education->SetValue($this->customer_education->GetValue(true));
        $this->DataSource->borrower_occupation->SetValue($this->borrower_occupation->GetValue(true));
        $this->DataSource->gurantor_occupation->SetValue($this->gurantor_occupation->GetValue(true));
        $this->DataSource->house_type->SetValue($this->house_type->GetValue(true));
        $this->DataSource->monthly_hh_income->SetValue($this->monthly_hh_income->GetValue(true));
        $this->DataSource->added_by->SetValue($this->added_by->GetValue(true));
        $this->DataSource->added_at->SetValue($this->added_at->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->updated_at->SetValue($this->updated_at->GetValue(true));
        $this->DataSource->gp_no->SetValue($this->gp_no->GetValue(true));
        $this->DataSource->natureofresidence->SetValue($this->natureofresidence->GetValue(true));
        $this->DataSource->daily_labour_count->SetValue($this->daily_labour_count->GetValue(true));
        $this->DataSource->household_total_members->SetValue($this->household_total_members->GetValue(true));
        $this->DataSource->RadioButton1->SetValue($this->RadioButton1->GetValue(true));
        $this->DataSource->member_kyc_type->SetValue($this->member_kyc_type->GetValue(true));
        $this->DataSource->RadioButton2->SetValue($this->RadioButton2->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-0914EA96
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->la_id->SetValue($this->la_id->GetValue(true));
        $this->DataSource->hv_route->SetValue($this->hv_route->GetValue(true));
        $this->DataSource->mfi_hvf1_relogin_hv_no->SetValue($this->mfi_hvf1_relogin_hv_no->GetValue(true));
        $this->DataSource->mfi_hvf1_existing_enrollment_no->SetValue($this->mfi_hvf1_existing_enrollment_no->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_name->SetValue($this->mfi_hvf1_customer_name->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_father_name->SetValue($this->mfi_hvf1_customer_father_name->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_husband_name->SetValue($this->mfi_hvf1_customer_husband_name->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_age_years->SetValue($this->mfi_hvf1_customer_age_years->GetValue(true));
        $this->DataSource->mfi_hvf1_husband_age_years->SetValue($this->mfi_hvf1_husband_age_years->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_kyc_id_no->SetValue($this->mfi_hvf1_customer_kyc_id_no->GetValue(true));
        $this->DataSource->mfi_hvf1_husband_kyc_id_no->SetValue($this->mfi_hvf1_husband_kyc_id_no->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_current_address1->SetValue($this->mfi_hvf1_customer_current_address1->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_pin_code->SetValue($this->mfi_hvf1_customer_pin_code->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_mobile_no->SetValue($this->mfi_hvf1_customer_mobile_no->GetValue(true));
        $this->DataSource->mfi_hvf1_husband_mobile_no->SetValue($this->mfi_hvf1_husband_mobile_no->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_residence_years->SetValue($this->mfi_hvf1_customer_residence_years->GetValue(true));
        $this->DataSource->mfi_hvf1_agricultureland->SetValue($this->mfi_hvf1_agricultureland->GetValue(true));
        $this->DataSource->mfi_hvf1_no_of_crops->SetValue($this->mfi_hvf1_no_of_crops->GetValue(true));
        $this->DataSource->mfi_hvf1_total_milk_selling->SetValue($this->mfi_hvf1_total_milk_selling->GetValue(true));
        $this->DataSource->mfi_hvf1_provision_grocery->SetValue($this->mfi_hvf1_provision_grocery->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_cows->SetValue($this->mfi_hvf1_customer_livestock_details_cows->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_goats_sheep->SetValue($this->mfi_hvf1_customer_livestock_details_goats_sheep->GetValue(true));
        $this->DataSource->mfi_hvf1_barber_shop->SetValue($this->mfi_hvf1_barber_shop->GetValue(true));
        $this->DataSource->mfi_hvf1_skilled_labour->SetValue($this->mfi_hvf1_skilled_labour->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_buffalos->SetValue($this->mfi_hvf1_customer_livestock_details_buffalos->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_pigs->SetValue($this->mfi_hvf1_customer_livestock_details_pigs->GetValue(true));
        $this->DataSource->mfi_hvf1_cuttleri_cloth->SetValue($this->mfi_hvf1_cuttleri_cloth->GetValue(true));
        $this->DataSource->mfi_hvf1_tailoring_shop->SetValue($this->mfi_hvf1_tailoring_shop->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_bullocks_ox->SetValue($this->mfi_hvf1_customer_livestock_details_bullocks_ox->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_livestock_details_chicken->SetValue($this->mfi_hvf1_customer_livestock_details_chicken->GetValue(true));
        $this->DataSource->mfi_hvf1_cycle_repair->SetValue($this->mfi_hvf1_cycle_repair->GetValue(true));
        $this->DataSource->mfi_hvf1_tea_fastfood->SetValue($this->mfi_hvf1_tea_fastfood->GetValue(true));
        $this->DataSource->mfi_hvf1_daily_labour->SetValue($this->mfi_hvf1_daily_labour->GetValue(true));
        $this->DataSource->mfi_hvf1_others->SetValue($this->mfi_hvf1_others->GetValue(true));
        $this->DataSource->mfi_hvf1_fruit_vegetables->SetValue($this->mfi_hvf1_fruit_vegetables->GetValue(true));
        $this->DataSource->mfi_hvf1_other_income_details->SetValue($this->mfi_hvf1_other_income_details->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_cycle_cart->SetValue($this->mfi_hvf1_customer_vehicles_cycle_cart->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_tractor->SetValue($this->mfi_hvf1_customer_vehicles_tractor->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_two_wheeler->SetValue($this->mfi_hvf1_customer_vehicles_two_wheeler->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_bullock_cart->SetValue($this->mfi_hvf1_customer_vehicles_bullock_cart->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_vehicles_auto_or_tempo->SetValue($this->mfi_hvf1_customer_vehicles_auto_or_tempo->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_loans->SetValue($this->mfi_hvf1_financial_inclusion_loans->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_bank_account->SetValue($this->mfi_hvf1_financial_inclusion_bank_account->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_insurance->SetValue($this->mfi_hvf1_financial_inclusion_insurance->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_chits->SetValue($this->mfi_hvf1_financial_inclusion_chits->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_micro_rimittances->SetValue($this->mfi_hvf1_financial_inclusion_micro_rimittances->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_others->SetValue($this->mfi_hvf1_financial_inclusion_others->GetValue(true));
        $this->DataSource->mfi_hvf1_financial_inclusion_others_specify->SetValue($this->mfi_hvf1_financial_inclusion_others_specify->GetValue(true));
        $this->DataSource->household_children->SetValue($this->household_children->GetValue(true));
        $this->DataSource->household_adults->SetValue($this->household_adults->GetValue(true));
        $this->DataSource->husband_kyc_type->SetValue($this->husband_kyc_type->GetValue(true));
        $this->DataSource->borrower_other_occupation->SetValue($this->borrower_other_occupation->GetValue(true));
        $this->DataSource->gurantor_other_occupation->SetValue($this->gurantor_other_occupation->GetValue(true));
        $this->DataSource->Auto_Rickshaw_Driver->SetValue($this->Auto_Rickshaw_Driver->GetValue(true));
        $this->DataSource->other_monthly_hh_income->SetValue($this->other_monthly_hh_income->GetValue(true));
        $this->DataSource->marital_status->SetValue($this->marital_status->GetValue(true));
        $this->DataSource->borrower_religion->SetValue($this->borrower_religion->GetValue(true));
        $this->DataSource->customer_caste->SetValue($this->customer_caste->GetValue(true));
        $this->DataSource->customer_education->SetValue($this->customer_education->GetValue(true));
        $this->DataSource->borrower_occupation->SetValue($this->borrower_occupation->GetValue(true));
        $this->DataSource->gurantor_occupation->SetValue($this->gurantor_occupation->GetValue(true));
        $this->DataSource->house_type->SetValue($this->house_type->GetValue(true));
        $this->DataSource->monthly_hh_income->SetValue($this->monthly_hh_income->GetValue(true));
        $this->DataSource->added_by->SetValue($this->added_by->GetValue(true));
        $this->DataSource->added_at->SetValue($this->added_at->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->updated_at->SetValue($this->updated_at->GetValue(true));
        $this->DataSource->gp_no->SetValue($this->gp_no->GetValue(true));
        $this->DataSource->natureofresidence->SetValue($this->natureofresidence->GetValue(true));
        $this->DataSource->daily_labour_count->SetValue($this->daily_labour_count->GetValue(true));
        $this->DataSource->household_total_members->SetValue($this->household_total_members->GetValue(true));
        $this->DataSource->RadioButton1->SetValue($this->RadioButton1->GetValue(true));
        $this->DataSource->member_kyc_type->SetValue($this->member_kyc_type->GetValue(true));
        $this->DataSource->RadioButton2->SetValue($this->RadioButton2->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-968BC30C
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

        $this->RadioButton1->Prepare();
        $this->RadioButton2->Prepare();

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
                    $this->hv_route->SetValue($this->DataSource->hv_route->GetValue());
                    $this->mfi_hvf1_relogin_hv_no->SetValue($this->DataSource->mfi_hvf1_relogin_hv_no->GetValue());
                    $this->mfi_hvf1_existing_enrollment_no->SetValue($this->DataSource->mfi_hvf1_existing_enrollment_no->GetValue());
                    $this->mfi_hvf1_customer_name->SetValue($this->DataSource->mfi_hvf1_customer_name->GetValue());
                    $this->mfi_hvf1_customer_father_name->SetValue($this->DataSource->mfi_hvf1_customer_father_name->GetValue());
                    $this->mfi_hvf1_customer_husband_name->SetValue($this->DataSource->mfi_hvf1_customer_husband_name->GetValue());
                    $this->mfi_hvf1_customer_age_years->SetValue($this->DataSource->mfi_hvf1_customer_age_years->GetValue());
                    $this->mfi_hvf1_husband_age_years->SetValue($this->DataSource->mfi_hvf1_husband_age_years->GetValue());
                    $this->mfi_hvf1_customer_kyc_id_no->SetValue($this->DataSource->mfi_hvf1_customer_kyc_id_no->GetValue());
                    $this->mfi_hvf1_husband_kyc_id_no->SetValue($this->DataSource->mfi_hvf1_husband_kyc_id_no->GetValue());
                    $this->mfi_hvf1_customer_current_address1->SetValue($this->DataSource->mfi_hvf1_customer_current_address1->GetValue());
                    $this->mfi_hvf1_customer_pin_code->SetValue($this->DataSource->mfi_hvf1_customer_pin_code->GetValue());
                    $this->mfi_hvf1_customer_mobile_no->SetValue($this->DataSource->mfi_hvf1_customer_mobile_no->GetValue());
                    $this->mfi_hvf1_husband_mobile_no->SetValue($this->DataSource->mfi_hvf1_husband_mobile_no->GetValue());
                    $this->mfi_hvf1_customer_residence_years->SetValue($this->DataSource->mfi_hvf1_customer_residence_years->GetValue());
                    $this->mfi_hvf1_agricultureland->SetValue($this->DataSource->mfi_hvf1_agricultureland->GetValue());
                    $this->mfi_hvf1_no_of_crops->SetValue($this->DataSource->mfi_hvf1_no_of_crops->GetValue());
                    $this->mfi_hvf1_total_milk_selling->SetValue($this->DataSource->mfi_hvf1_total_milk_selling->GetValue());
                    $this->mfi_hvf1_provision_grocery->SetValue($this->DataSource->mfi_hvf1_provision_grocery->GetValue());
                    $this->mfi_hvf1_customer_livestock_details_cows->SetValue($this->DataSource->mfi_hvf1_customer_livestock_details_cows->GetValue());
                    $this->mfi_hvf1_customer_livestock_details_goats_sheep->SetValue($this->DataSource->mfi_hvf1_customer_livestock_details_goats_sheep->GetValue());
                    $this->mfi_hvf1_barber_shop->SetValue($this->DataSource->mfi_hvf1_barber_shop->GetValue());
                    $this->mfi_hvf1_skilled_labour->SetValue($this->DataSource->mfi_hvf1_skilled_labour->GetValue());
                    $this->mfi_hvf1_customer_livestock_details_buffalos->SetValue($this->DataSource->mfi_hvf1_customer_livestock_details_buffalos->GetValue());
                    $this->mfi_hvf1_customer_livestock_details_pigs->SetValue($this->DataSource->mfi_hvf1_customer_livestock_details_pigs->GetValue());
                    $this->mfi_hvf1_cuttleri_cloth->SetValue($this->DataSource->mfi_hvf1_cuttleri_cloth->GetValue());
                    $this->mfi_hvf1_tailoring_shop->SetValue($this->DataSource->mfi_hvf1_tailoring_shop->GetValue());
                    $this->mfi_hvf1_customer_livestock_details_bullocks_ox->SetValue($this->DataSource->mfi_hvf1_customer_livestock_details_bullocks_ox->GetValue());
                    $this->mfi_hvf1_customer_livestock_details_chicken->SetValue($this->DataSource->mfi_hvf1_customer_livestock_details_chicken->GetValue());
                    $this->mfi_hvf1_cycle_repair->SetValue($this->DataSource->mfi_hvf1_cycle_repair->GetValue());
                    $this->mfi_hvf1_tea_fastfood->SetValue($this->DataSource->mfi_hvf1_tea_fastfood->GetValue());
                    $this->mfi_hvf1_daily_labour->SetValue($this->DataSource->mfi_hvf1_daily_labour->GetValue());
                    $this->mfi_hvf1_others->SetValue($this->DataSource->mfi_hvf1_others->GetValue());
                    $this->mfi_hvf1_fruit_vegetables->SetValue($this->DataSource->mfi_hvf1_fruit_vegetables->GetValue());
                    $this->mfi_hvf1_other_income_details->SetValue($this->DataSource->mfi_hvf1_other_income_details->GetValue());
                    $this->mfi_hvf1_customer_vehicles_cycle_cart->SetValue($this->DataSource->mfi_hvf1_customer_vehicles_cycle_cart->GetValue());
                    $this->mfi_hvf1_customer_vehicles_tractor->SetValue($this->DataSource->mfi_hvf1_customer_vehicles_tractor->GetValue());
                    $this->mfi_hvf1_customer_vehicles_two_wheeler->SetValue($this->DataSource->mfi_hvf1_customer_vehicles_two_wheeler->GetValue());
                    $this->mfi_hvf1_customer_vehicles_bullock_cart->SetValue($this->DataSource->mfi_hvf1_customer_vehicles_bullock_cart->GetValue());
                    $this->mfi_hvf1_customer_vehicles_auto_or_tempo->SetValue($this->DataSource->mfi_hvf1_customer_vehicles_auto_or_tempo->GetValue());
                    $this->mfi_hvf1_financial_inclusion_loans->SetValue($this->DataSource->mfi_hvf1_financial_inclusion_loans->GetValue());
                    $this->mfi_hvf1_financial_inclusion_bank_account->SetValue($this->DataSource->mfi_hvf1_financial_inclusion_bank_account->GetValue());
                    $this->mfi_hvf1_financial_inclusion_insurance->SetValue($this->DataSource->mfi_hvf1_financial_inclusion_insurance->GetValue());
                    $this->mfi_hvf1_financial_inclusion_chits->SetValue($this->DataSource->mfi_hvf1_financial_inclusion_chits->GetValue());
                    $this->mfi_hvf1_financial_inclusion_micro_rimittances->SetValue($this->DataSource->mfi_hvf1_financial_inclusion_micro_rimittances->GetValue());
                    $this->mfi_hvf1_financial_inclusion_others->SetValue($this->DataSource->mfi_hvf1_financial_inclusion_others->GetValue());
                    $this->mfi_hvf1_financial_inclusion_others_specify->SetValue($this->DataSource->mfi_hvf1_financial_inclusion_others_specify->GetValue());
                    $this->household_children->SetValue($this->DataSource->household_children->GetValue());
                    $this->household_adults->SetValue($this->DataSource->household_adults->GetValue());
                    $this->husband_kyc_type->SetValue($this->DataSource->husband_kyc_type->GetValue());
                    $this->Auto_Rickshaw_Driver->SetValue($this->DataSource->Auto_Rickshaw_Driver->GetValue());
                    $this->marital_status->SetValue($this->DataSource->marital_status->GetValue());
                    $this->borrower_religion->SetValue($this->DataSource->borrower_religion->GetValue());
                    $this->customer_caste->SetValue($this->DataSource->customer_caste->GetValue());
                    $this->customer_education->SetValue($this->DataSource->customer_education->GetValue());
                    $this->borrower_occupation->SetValue($this->DataSource->borrower_occupation->GetValue());
                    $this->gurantor_occupation->SetValue($this->DataSource->gurantor_occupation->GetValue());
                    $this->house_type->SetValue($this->DataSource->house_type->GetValue());
                    $this->monthly_hh_income->SetValue($this->DataSource->monthly_hh_income->GetValue());
                    $this->added_by->SetValue($this->DataSource->added_by->GetValue());
                    $this->added_at->SetValue($this->DataSource->added_at->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->updated_at->SetValue($this->DataSource->updated_at->GetValue());
                    $this->gp_no->SetValue($this->DataSource->gp_no->GetValue());
                    $this->natureofresidence->SetValue($this->DataSource->natureofresidence->GetValue());
                    $this->daily_labour_count->SetValue($this->DataSource->daily_labour_count->GetValue());
                    $this->household_total_members->SetValue($this->DataSource->household_total_members->GetValue());
                    $this->member_kyc_type->SetValue($this->DataSource->member_kyc_type->GetValue());
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
            $Error = ComposeStrings($Error, $this->hv_route->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_relogin_hv_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_existing_enrollment_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_father_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_husband_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_age_years->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_husband_age_years->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_kyc_id_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_husband_kyc_id_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_current_address1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_pin_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_husband_mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_residence_years->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_agricultureland->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_no_of_crops->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_total_milk_selling->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_provision_grocery->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_livestock_details_cows->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_livestock_details_goats_sheep->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_barber_shop->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_skilled_labour->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_livestock_details_buffalos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_livestock_details_pigs->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_cuttleri_cloth->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_tailoring_shop->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_livestock_details_bullocks_ox->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_livestock_details_chicken->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_cycle_repair->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_tea_fastfood->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_daily_labour->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_others->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_fruit_vegetables->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_other_income_details->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_vehicles_cycle_cart->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_vehicles_tractor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_vehicles_two_wheeler->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_vehicles_bullock_cart->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_customer_vehicles_auto_or_tempo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_financial_inclusion_loans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_financial_inclusion_bank_account->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_financial_inclusion_insurance->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_financial_inclusion_chits->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_financial_inclusion_micro_rimittances->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_financial_inclusion_others->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf1_financial_inclusion_others_specify->Errors->ToString());
            $Error = ComposeStrings($Error, $this->household_children->Errors->ToString());
            $Error = ComposeStrings($Error, $this->household_adults->Errors->ToString());
            $Error = ComposeStrings($Error, $this->husband_kyc_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->borrower_other_occupation->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_other_occupation->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Auto_Rickshaw_Driver->Errors->ToString());
            $Error = ComposeStrings($Error, $this->other_monthly_hh_income->Errors->ToString());
            $Error = ComposeStrings($Error, $this->marital_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->borrower_religion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer_caste->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer_education->Errors->ToString());
            $Error = ComposeStrings($Error, $this->borrower_occupation->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gurantor_occupation->Errors->ToString());
            $Error = ComposeStrings($Error, $this->house_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->monthly_hh_income->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->added_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gp_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->natureofresidence->Errors->ToString());
            $Error = ComposeStrings($Error, $this->daily_labour_count->Errors->ToString());
            $Error = ComposeStrings($Error, $this->household_total_members->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RadioButton1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_kyc_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RadioButton2->Errors->ToString());
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
        $this->Button_Update->Show();
        $this->la_id->Show();
        $this->hv_route->Show();
        $this->mfi_hvf1_relogin_hv_no->Show();
        $this->mfi_hvf1_existing_enrollment_no->Show();
        $this->mfi_hvf1_customer_name->Show();
        $this->mfi_hvf1_customer_father_name->Show();
        $this->mfi_hvf1_customer_husband_name->Show();
        $this->mfi_hvf1_customer_age_years->Show();
        $this->mfi_hvf1_husband_age_years->Show();
        $this->mfi_hvf1_customer_kyc_id_no->Show();
        $this->mfi_hvf1_husband_kyc_id_no->Show();
        $this->mfi_hvf1_customer_current_address1->Show();
        $this->mfi_hvf1_customer_pin_code->Show();
        $this->mfi_hvf1_customer_mobile_no->Show();
        $this->mfi_hvf1_husband_mobile_no->Show();
        $this->mfi_hvf1_customer_residence_years->Show();
        $this->mfi_hvf1_agricultureland->Show();
        $this->mfi_hvf1_no_of_crops->Show();
        $this->mfi_hvf1_total_milk_selling->Show();
        $this->mfi_hvf1_provision_grocery->Show();
        $this->mfi_hvf1_customer_livestock_details_cows->Show();
        $this->mfi_hvf1_customer_livestock_details_goats_sheep->Show();
        $this->mfi_hvf1_barber_shop->Show();
        $this->mfi_hvf1_skilled_labour->Show();
        $this->mfi_hvf1_customer_livestock_details_buffalos->Show();
        $this->mfi_hvf1_customer_livestock_details_pigs->Show();
        $this->mfi_hvf1_cuttleri_cloth->Show();
        $this->mfi_hvf1_tailoring_shop->Show();
        $this->mfi_hvf1_customer_livestock_details_bullocks_ox->Show();
        $this->mfi_hvf1_customer_livestock_details_chicken->Show();
        $this->mfi_hvf1_cycle_repair->Show();
        $this->mfi_hvf1_tea_fastfood->Show();
        $this->mfi_hvf1_daily_labour->Show();
        $this->mfi_hvf1_others->Show();
        $this->mfi_hvf1_fruit_vegetables->Show();
        $this->mfi_hvf1_other_income_details->Show();
        $this->mfi_hvf1_customer_vehicles_cycle_cart->Show();
        $this->mfi_hvf1_customer_vehicles_tractor->Show();
        $this->mfi_hvf1_customer_vehicles_two_wheeler->Show();
        $this->mfi_hvf1_customer_vehicles_bullock_cart->Show();
        $this->mfi_hvf1_customer_vehicles_auto_or_tempo->Show();
        $this->mfi_hvf1_financial_inclusion_loans->Show();
        $this->mfi_hvf1_financial_inclusion_bank_account->Show();
        $this->mfi_hvf1_financial_inclusion_insurance->Show();
        $this->mfi_hvf1_financial_inclusion_chits->Show();
        $this->mfi_hvf1_financial_inclusion_micro_rimittances->Show();
        $this->mfi_hvf1_financial_inclusion_others->Show();
        $this->mfi_hvf1_financial_inclusion_others_specify->Show();
        $this->household_children->Show();
        $this->household_adults->Show();
        $this->husband_kyc_type->Show();
        $this->borrower_other_occupation->Show();
        $this->gurantor_other_occupation->Show();
        $this->Auto_Rickshaw_Driver->Show();
        $this->other_monthly_hh_income->Show();
        $this->marital_status->Show();
        $this->borrower_religion->Show();
        $this->customer_caste->Show();
        $this->customer_education->Show();
        $this->borrower_occupation->Show();
        $this->gurantor_occupation->Show();
        $this->house_type->Show();
        $this->monthly_hh_income->Show();
        $this->added_by->Show();
        $this->added_at->Show();
        $this->updated_by->Show();
        $this->updated_at->Show();
        $this->gp_no->Show();
        $this->natureofresidence->Show();
        $this->daily_labour_count->Show();
        $this->household_total_members->Show();
        $this->RadioButton1->Show();
        $this->member_kyc_type->Show();
        $this->RadioButton2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_hvf1 Class @2-FCB6E20C

class clsmfi_hvf1DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf1DataSource Class @2-2D65C6A0

//DataSource Variables @2-1F9F9452
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
    public $hv_route;
    public $mfi_hvf1_relogin_hv_no;
    public $mfi_hvf1_existing_enrollment_no;
    public $mfi_hvf1_customer_name;
    public $mfi_hvf1_customer_father_name;
    public $mfi_hvf1_customer_husband_name;
    public $mfi_hvf1_customer_age_years;
    public $mfi_hvf1_husband_age_years;
    public $mfi_hvf1_customer_kyc_id_no;
    public $mfi_hvf1_husband_kyc_id_no;
    public $mfi_hvf1_customer_current_address1;
    public $mfi_hvf1_customer_pin_code;
    public $mfi_hvf1_customer_mobile_no;
    public $mfi_hvf1_husband_mobile_no;
    public $mfi_hvf1_customer_residence_years;
    public $mfi_hvf1_agricultureland;
    public $mfi_hvf1_no_of_crops;
    public $mfi_hvf1_total_milk_selling;
    public $mfi_hvf1_provision_grocery;
    public $mfi_hvf1_customer_livestock_details_cows;
    public $mfi_hvf1_customer_livestock_details_goats_sheep;
    public $mfi_hvf1_barber_shop;
    public $mfi_hvf1_skilled_labour;
    public $mfi_hvf1_customer_livestock_details_buffalos;
    public $mfi_hvf1_customer_livestock_details_pigs;
    public $mfi_hvf1_cuttleri_cloth;
    public $mfi_hvf1_tailoring_shop;
    public $mfi_hvf1_customer_livestock_details_bullocks_ox;
    public $mfi_hvf1_customer_livestock_details_chicken;
    public $mfi_hvf1_cycle_repair;
    public $mfi_hvf1_tea_fastfood;
    public $mfi_hvf1_daily_labour;
    public $mfi_hvf1_others;
    public $mfi_hvf1_fruit_vegetables;
    public $mfi_hvf1_other_income_details;
    public $mfi_hvf1_customer_vehicles_cycle_cart;
    public $mfi_hvf1_customer_vehicles_tractor;
    public $mfi_hvf1_customer_vehicles_two_wheeler;
    public $mfi_hvf1_customer_vehicles_bullock_cart;
    public $mfi_hvf1_customer_vehicles_auto_or_tempo;
    public $mfi_hvf1_financial_inclusion_loans;
    public $mfi_hvf1_financial_inclusion_bank_account;
    public $mfi_hvf1_financial_inclusion_insurance;
    public $mfi_hvf1_financial_inclusion_chits;
    public $mfi_hvf1_financial_inclusion_micro_rimittances;
    public $mfi_hvf1_financial_inclusion_others;
    public $mfi_hvf1_financial_inclusion_others_specify;
    public $household_children;
    public $household_adults;
    public $husband_kyc_type;
    public $borrower_other_occupation;
    public $gurantor_other_occupation;
    public $Auto_Rickshaw_Driver;
    public $other_monthly_hh_income;
    public $marital_status;
    public $borrower_religion;
    public $customer_caste;
    public $customer_education;
    public $borrower_occupation;
    public $gurantor_occupation;
    public $house_type;
    public $monthly_hh_income;
    public $added_by;
    public $added_at;
    public $updated_by;
    public $updated_at;
    public $gp_no;
    public $natureofresidence;
    public $daily_labour_count;
    public $household_total_members;
    public $RadioButton1;
    public $member_kyc_type;
    public $RadioButton2;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FC4E9238
    function clsmfi_hvf1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_hvf1/Error";
        $this->Initialize();
        $this->la_id = new clsField("la_id", ccsText, "");
        
        $this->hv_route = new clsField("hv_route", ccsText, "");
        
        $this->mfi_hvf1_relogin_hv_no = new clsField("mfi_hvf1_relogin_hv_no", ccsText, "");
        
        $this->mfi_hvf1_existing_enrollment_no = new clsField("mfi_hvf1_existing_enrollment_no", ccsText, "");
        
        $this->mfi_hvf1_customer_name = new clsField("mfi_hvf1_customer_name", ccsText, "");
        
        $this->mfi_hvf1_customer_father_name = new clsField("mfi_hvf1_customer_father_name", ccsText, "");
        
        $this->mfi_hvf1_customer_husband_name = new clsField("mfi_hvf1_customer_husband_name", ccsText, "");
        
        $this->mfi_hvf1_customer_age_years = new clsField("mfi_hvf1_customer_age_years", ccsInteger, "");
        
        $this->mfi_hvf1_husband_age_years = new clsField("mfi_hvf1_husband_age_years", ccsInteger, "");
        
        $this->mfi_hvf1_customer_kyc_id_no = new clsField("mfi_hvf1_customer_kyc_id_no", ccsText, "");
        
        $this->mfi_hvf1_husband_kyc_id_no = new clsField("mfi_hvf1_husband_kyc_id_no", ccsText, "");
        
        $this->mfi_hvf1_customer_current_address1 = new clsField("mfi_hvf1_customer_current_address1", ccsText, "");
        
        $this->mfi_hvf1_customer_pin_code = new clsField("mfi_hvf1_customer_pin_code", ccsText, "");
        
        $this->mfi_hvf1_customer_mobile_no = new clsField("mfi_hvf1_customer_mobile_no", ccsText, "");
        
        $this->mfi_hvf1_husband_mobile_no = new clsField("mfi_hvf1_husband_mobile_no", ccsText, "");
        
        $this->mfi_hvf1_customer_residence_years = new clsField("mfi_hvf1_customer_residence_years", ccsText, "");
        
        $this->mfi_hvf1_agricultureland = new clsField("mfi_hvf1_agricultureland", ccsInteger, "");
        
        $this->mfi_hvf1_no_of_crops = new clsField("mfi_hvf1_no_of_crops", ccsInteger, "");
        
        $this->mfi_hvf1_total_milk_selling = new clsField("mfi_hvf1_total_milk_selling", ccsInteger, "");
        
        $this->mfi_hvf1_provision_grocery = new clsField("mfi_hvf1_provision_grocery", ccsText, "");
        
        $this->mfi_hvf1_customer_livestock_details_cows = new clsField("mfi_hvf1_customer_livestock_details_cows", ccsInteger, "");
        
        $this->mfi_hvf1_customer_livestock_details_goats_sheep = new clsField("mfi_hvf1_customer_livestock_details_goats_sheep", ccsInteger, "");
        
        $this->mfi_hvf1_barber_shop = new clsField("mfi_hvf1_barber_shop", ccsText, "");
        
        $this->mfi_hvf1_skilled_labour = new clsField("mfi_hvf1_skilled_labour", ccsText, "");
        
        $this->mfi_hvf1_customer_livestock_details_buffalos = new clsField("mfi_hvf1_customer_livestock_details_buffalos", ccsInteger, "");
        
        $this->mfi_hvf1_customer_livestock_details_pigs = new clsField("mfi_hvf1_customer_livestock_details_pigs", ccsInteger, "");
        
        $this->mfi_hvf1_cuttleri_cloth = new clsField("mfi_hvf1_cuttleri_cloth", ccsText, "");
        
        $this->mfi_hvf1_tailoring_shop = new clsField("mfi_hvf1_tailoring_shop", ccsText, "");
        
        $this->mfi_hvf1_customer_livestock_details_bullocks_ox = new clsField("mfi_hvf1_customer_livestock_details_bullocks_ox", ccsInteger, "");
        
        $this->mfi_hvf1_customer_livestock_details_chicken = new clsField("mfi_hvf1_customer_livestock_details_chicken", ccsInteger, "");
        
        $this->mfi_hvf1_cycle_repair = new clsField("mfi_hvf1_cycle_repair", ccsText, "");
        
        $this->mfi_hvf1_tea_fastfood = new clsField("mfi_hvf1_tea_fastfood", ccsText, "");
        
        $this->mfi_hvf1_daily_labour = new clsField("mfi_hvf1_daily_labour", ccsText, "");
        
        $this->mfi_hvf1_others = new clsField("mfi_hvf1_others", ccsText, "");
        
        $this->mfi_hvf1_fruit_vegetables = new clsField("mfi_hvf1_fruit_vegetables", ccsText, "");
        
        $this->mfi_hvf1_other_income_details = new clsField("mfi_hvf1_other_income_details", ccsText, "");
        
        $this->mfi_hvf1_customer_vehicles_cycle_cart = new clsField("mfi_hvf1_customer_vehicles_cycle_cart", ccsText, "");
        
        $this->mfi_hvf1_customer_vehicles_tractor = new clsField("mfi_hvf1_customer_vehicles_tractor", ccsText, "");
        
        $this->mfi_hvf1_customer_vehicles_two_wheeler = new clsField("mfi_hvf1_customer_vehicles_two_wheeler", ccsText, "");
        
        $this->mfi_hvf1_customer_vehicles_bullock_cart = new clsField("mfi_hvf1_customer_vehicles_bullock_cart", ccsText, "");
        
        $this->mfi_hvf1_customer_vehicles_auto_or_tempo = new clsField("mfi_hvf1_customer_vehicles_auto_or_tempo", ccsText, "");
        
        $this->mfi_hvf1_financial_inclusion_loans = new clsField("mfi_hvf1_financial_inclusion_loans", ccsText, "");
        
        $this->mfi_hvf1_financial_inclusion_bank_account = new clsField("mfi_hvf1_financial_inclusion_bank_account", ccsInteger, "");
        
        $this->mfi_hvf1_financial_inclusion_insurance = new clsField("mfi_hvf1_financial_inclusion_insurance", ccsInteger, "");
        
        $this->mfi_hvf1_financial_inclusion_chits = new clsField("mfi_hvf1_financial_inclusion_chits", ccsInteger, "");
        
        $this->mfi_hvf1_financial_inclusion_micro_rimittances = new clsField("mfi_hvf1_financial_inclusion_micro_rimittances", ccsInteger, "");
        
        $this->mfi_hvf1_financial_inclusion_others = new clsField("mfi_hvf1_financial_inclusion_others", ccsInteger, "");
        
        $this->mfi_hvf1_financial_inclusion_others_specify = new clsField("mfi_hvf1_financial_inclusion_others_specify", ccsText, "");
        
        $this->household_children = new clsField("household_children", ccsInteger, "");
        
        $this->household_adults = new clsField("household_adults", ccsInteger, "");
        
        $this->husband_kyc_type = new clsField("husband_kyc_type", ccsText, "");
        
        $this->borrower_other_occupation = new clsField("borrower_other_occupation", ccsText, "");
        
        $this->gurantor_other_occupation = new clsField("gurantor_other_occupation", ccsText, "");
        
        $this->Auto_Rickshaw_Driver = new clsField("Auto_Rickshaw_Driver", ccsText, "");
        
        $this->other_monthly_hh_income = new clsField("other_monthly_hh_income", ccsText, "");
        
        $this->marital_status = new clsField("marital_status", ccsText, "");
        
        $this->borrower_religion = new clsField("borrower_religion", ccsText, "");
        
        $this->customer_caste = new clsField("customer_caste", ccsText, "");
        
        $this->customer_education = new clsField("customer_education", ccsText, "");
        
        $this->borrower_occupation = new clsField("borrower_occupation", ccsText, "");
        
        $this->gurantor_occupation = new clsField("gurantor_occupation", ccsText, "");
        
        $this->house_type = new clsField("house_type", ccsText, "");
        
        $this->monthly_hh_income = new clsField("monthly_hh_income", ccsText, "");
        
        $this->added_by = new clsField("added_by", ccsText, "");
        
        $this->added_at = new clsField("added_at", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->updated_at = new clsField("updated_at", ccsText, "");
        
        $this->gp_no = new clsField("gp_no", ccsText, "");
        
        $this->natureofresidence = new clsField("natureofresidence", ccsText, "");
        
        $this->daily_labour_count = new clsField("daily_labour_count", ccsText, "");
        
        $this->household_total_members = new clsField("household_total_members", ccsText, "");
        
        $this->RadioButton1 = new clsField("RadioButton1", ccsText, "");
        
        $this->member_kyc_type = new clsField("member_kyc_type", ccsText, "");
        
        $this->RadioButton2 = new clsField("RadioButton2", ccsText, "");
        

        $this->InsertFields["la_id"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["hv_route"] = array("Name" => "hv_route", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_relogin_hv_no"] = array("Name" => "mfi_hvf1_relogin_hv_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_existing_enrollment_no"] = array("Name" => "mfi_hvf1_existing_enrollment_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_name"] = array("Name" => "mfi_hvf1_customer_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_father_name"] = array("Name" => "mfi_hvf1_customer_father_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_husband_name"] = array("Name" => "mfi_hvf1_customer_husband_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_age_years"] = array("Name" => "mfi_hvf1_customer_age_years", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_husband_age_years"] = array("Name" => "mfi_hvf1_husband_age_years", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_kyc_id_no"] = array("Name" => "mfi_hvf1_customer_kyc_id_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_husband_kyc_id_no"] = array("Name" => "mfi_hvf1_husband_kyc_id_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_current_address1"] = array("Name" => "mfi_hvf1_customer_current_address1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_pin_code"] = array("Name" => "mfi_hvf1_customer_pin_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_mobile_no"] = array("Name" => "mfi_hvf1_customer_mobile_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_husband_mobile_no"] = array("Name" => "mfi_hvf1_husband_mobile_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_residence_years"] = array("Name" => "mfi_hvf1_customer_residence_years", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_agricultureland"] = array("Name" => "mfi_hvf1_agricultureland", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_no_of_crops"] = array("Name" => "mfi_hvf1_no_of_crops", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_total_milk_selling"] = array("Name" => "mfi_hvf1_total_milk_selling", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_provision_grocery"] = array("Name" => "mfi_hvf1_provision_grocery", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_cows"] = array("Name" => "mfi_hvf1_customer_livestock_details_cows", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_goats_sheep"] = array("Name" => "mfi_hvf1_customer_livestock_details_goats_sheep", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_barber_shop"] = array("Name" => "mfi_hvf1_barber_shop", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_skilled_labour"] = array("Name" => "mfi_hvf1_skilled_labour", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_buffalos"] = array("Name" => "mfi_hvf1_customer_livestock_details_buffalos", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_pigs"] = array("Name" => "mfi_hvf1_customer_livestock_details_pigs", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_cuttleri_cloth"] = array("Name" => "mfi_hvf1_cuttleri_cloth", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_tailoring_shop"] = array("Name" => "mfi_hvf1_tailoring_shop", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_bullocks_ox"] = array("Name" => "mfi_hvf1_customer_livestock_details_bullocks_ox", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_chicken"] = array("Name" => "mfi_hvf1_customer_livestock_details_chicken", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_cycle_repair"] = array("Name" => "mfi_hvf1_cycle_repair", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_tea_fastfood"] = array("Name" => "mfi_hvf1_tea_fastfood", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_daily_labour"] = array("Name" => "mfi_hvf1_daily_labour", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_other_income_activity"] = array("Name" => "mfi_hvf1_other_income_activity", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_fruit_vegetables"] = array("Name" => "mfi_hvf1_fruit_vegetables", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_other_income_details"] = array("Name" => "mfi_hvf1_other_income_details", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_vehicles_cycle_cart"] = array("Name" => "mfi_hvf1_customer_vehicles_cycle_cart", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_customer_vehicles_tractor"] = array("Name" => "mfi_hvf1_customer_vehicles_tractor", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_customer_vehicles_two_wheeler"] = array("Name" => "mfi_hvf1_customer_vehicles_two_wheeler", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_customer_vehicles_bullock_cart"] = array("Name" => "mfi_hvf1_customer_vehicles_bullock_cart", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_customer_vehicles_auto_or_tempo"] = array("Name" => "mfi_hvf1_customer_vehicles_auto_or_tempo", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_financial_inclusion_loans"] = array("Name" => "mfi_hvf1_financial_inclusion_loans", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_financial_inclusion_bank_account"] = array("Name" => "mfi_hvf1_financial_inclusion_bank_account", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["mfi_hvf1_financial_inclusion_insurance"] = array("Name" => "mfi_hvf1_financial_inclusion_insurance", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["mfi_hvf1_financial_inclusion_chits"] = array("Name" => "mfi_hvf1_financial_inclusion_chits", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["mfi_hvf1_financial_inclusion_micro_rimittances"] = array("Name" => "mfi_hvf1_financial_inclusion_micro_rimittances", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["mfi_hvf1_financial_inclusion_others"] = array("Name" => "mfi_hvf1_financial_inclusion_others", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["mfi_hvf1_financial_inclusion_others_specify"] = array("Name" => "mfi_hvf1_financial_inclusion_others_specify", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["household_children"] = array("Name" => "household_children", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["household_adults"] = array("Name" => "household_adults", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_husband_kyc_id_type"] = array("Name" => "mfi_hvf1_husband_kyc_id_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_auto_rickshaw"] = array("Name" => "mfi_hvf1_auto_rickshaw", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["mfi_hvf1_customer_marital_status"] = array("Name" => "mfi_hvf1_customer_marital_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_religion"] = array("Name" => "mfi_hvf1_customer_religion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_caste"] = array("Name" => "mfi_hvf1_caste", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_education"] = array("Name" => "mfi_hvf1_customer_education", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_occupation"] = array("Name" => "mfi_hvf1_customer_occupation", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_guarantor_occupation"] = array("Name" => "mfi_hvf1_customer_guarantor_occupation", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_house_type"] = array("Name" => "mfi_hvf1_customer_house_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["monthly_household_income"] = array("Name" => "monthly_household_income", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_added_by"] = array("Name" => "mfi_hvf1_added_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_added_at"] = array("Name" => "mfi_hvf1_added_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_updated_by"] = array("Name" => "mfi_hvf1_updated_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_updated_at"] = array("Name" => "mfi_hvf1_updated_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["gp_id"] = array("Name" => "gp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_nature_of_residence"] = array("Name" => "mfi_hvf1_customer_nature_of_residence", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_daily_labour_nos"] = array("Name" => "mfi_hvf1_daily_labour_nos", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["household_total_members"] = array("Name" => "household_total_members", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf1_customer_kyc_id_type"] = array("Name" => "mfi_hvf1_customer_kyc_id_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["la_id"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["hv_route"] = array("Name" => "hv_route", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_relogin_hv_no"] = array("Name" => "mfi_hvf1_relogin_hv_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_existing_enrollment_no"] = array("Name" => "mfi_hvf1_existing_enrollment_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_name"] = array("Name" => "mfi_hvf1_customer_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_father_name"] = array("Name" => "mfi_hvf1_customer_father_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_husband_name"] = array("Name" => "mfi_hvf1_customer_husband_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_age_years"] = array("Name" => "mfi_hvf1_customer_age_years", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_husband_age_years"] = array("Name" => "mfi_hvf1_husband_age_years", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_kyc_id_no"] = array("Name" => "mfi_hvf1_customer_kyc_id_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_husband_kyc_id_no"] = array("Name" => "mfi_hvf1_husband_kyc_id_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_current_address1"] = array("Name" => "mfi_hvf1_customer_current_address1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_pin_code"] = array("Name" => "mfi_hvf1_customer_pin_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_mobile_no"] = array("Name" => "mfi_hvf1_customer_mobile_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_husband_mobile_no"] = array("Name" => "mfi_hvf1_husband_mobile_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_residence_years"] = array("Name" => "mfi_hvf1_customer_residence_years", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_agricultureland"] = array("Name" => "mfi_hvf1_agricultureland", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_no_of_crops"] = array("Name" => "mfi_hvf1_no_of_crops", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_total_milk_selling"] = array("Name" => "mfi_hvf1_total_milk_selling", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_provision_grocery"] = array("Name" => "mfi_hvf1_provision_grocery", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_cows"] = array("Name" => "mfi_hvf1_customer_livestock_details_cows", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_goats_sheep"] = array("Name" => "mfi_hvf1_customer_livestock_details_goats_sheep", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_barber_shop"] = array("Name" => "mfi_hvf1_barber_shop", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_skilled_labour"] = array("Name" => "mfi_hvf1_skilled_labour", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_buffalos"] = array("Name" => "mfi_hvf1_customer_livestock_details_buffalos", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_pigs"] = array("Name" => "mfi_hvf1_customer_livestock_details_pigs", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_cuttleri_cloth"] = array("Name" => "mfi_hvf1_cuttleri_cloth", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_tailoring_shop"] = array("Name" => "mfi_hvf1_tailoring_shop", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_bullocks_ox"] = array("Name" => "mfi_hvf1_customer_livestock_details_bullocks_ox", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_chicken"] = array("Name" => "mfi_hvf1_customer_livestock_details_chicken", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_cycle_repair"] = array("Name" => "mfi_hvf1_cycle_repair", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_tea_fastfood"] = array("Name" => "mfi_hvf1_tea_fastfood", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_daily_labour"] = array("Name" => "mfi_hvf1_daily_labour", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_other_income_activity"] = array("Name" => "mfi_hvf1_other_income_activity", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_fruit_vegetables"] = array("Name" => "mfi_hvf1_fruit_vegetables", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_other_income_details"] = array("Name" => "mfi_hvf1_other_income_details", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_cycle_cart"] = array("Name" => "mfi_hvf1_customer_vehicles_cycle_cart", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_tractor"] = array("Name" => "mfi_hvf1_customer_vehicles_tractor", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_two_wheeler"] = array("Name" => "mfi_hvf1_customer_vehicles_two_wheeler", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_bullock_cart"] = array("Name" => "mfi_hvf1_customer_vehicles_bullock_cart", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_auto_or_tempo"] = array("Name" => "mfi_hvf1_customer_vehicles_auto_or_tempo", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_loans"] = array("Name" => "mfi_hvf1_financial_inclusion_loans", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_bank_account"] = array("Name" => "mfi_hvf1_financial_inclusion_bank_account", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_insurance"] = array("Name" => "mfi_hvf1_financial_inclusion_insurance", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_chits"] = array("Name" => "mfi_hvf1_financial_inclusion_chits", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_micro_rimittances"] = array("Name" => "mfi_hvf1_financial_inclusion_micro_rimittances", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_others"] = array("Name" => "mfi_hvf1_financial_inclusion_others", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_others_specify"] = array("Name" => "mfi_hvf1_financial_inclusion_others_specify", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["household_children"] = array("Name" => "household_children", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["household_adults"] = array("Name" => "household_adults", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_husband_kyc_id_type"] = array("Name" => "mfi_hvf1_husband_kyc_id_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_auto_rickshaw"] = array("Name" => "mfi_hvf1_auto_rickshaw", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf1_customer_marital_status"] = array("Name" => "mfi_hvf1_customer_marital_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_religion"] = array("Name" => "mfi_hvf1_customer_religion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_caste"] = array("Name" => "mfi_hvf1_caste", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_education"] = array("Name" => "mfi_hvf1_customer_education", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_occupation"] = array("Name" => "mfi_hvf1_customer_occupation", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_guarantor_occupation"] = array("Name" => "mfi_hvf1_customer_guarantor_occupation", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_house_type"] = array("Name" => "mfi_hvf1_customer_house_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["monthly_household_income"] = array("Name" => "monthly_household_income", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_added_by"] = array("Name" => "mfi_hvf1_added_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_added_at"] = array("Name" => "mfi_hvf1_added_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_updated_by"] = array("Name" => "mfi_hvf1_updated_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_updated_at"] = array("Name" => "mfi_hvf1_updated_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["gp_id"] = array("Name" => "gp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_nature_of_residence"] = array("Name" => "mfi_hvf1_customer_nature_of_residence", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_daily_labour_nos"] = array("Name" => "mfi_hvf1_daily_labour_nos", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["household_total_members"] = array("Name" => "household_total_members", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf1_customer_kyc_id_type"] = array("Name" => "mfi_hvf1_customer_kyc_id_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-6A0B1D61
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_hvf1 {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C5298699
    function SetValues()
    {
        $this->la_id->SetDBValue($this->f("la_id"));
        $this->hv_route->SetDBValue($this->f("hv_route"));
        $this->mfi_hvf1_relogin_hv_no->SetDBValue($this->f("mfi_hvf1_relogin_hv_no"));
        $this->mfi_hvf1_existing_enrollment_no->SetDBValue($this->f("mfi_hvf1_existing_enrollment_no"));
        $this->mfi_hvf1_customer_name->SetDBValue($this->f("mfi_hvf1_customer_name"));
        $this->mfi_hvf1_customer_father_name->SetDBValue($this->f("mfi_hvf1_customer_father_name"));
        $this->mfi_hvf1_customer_husband_name->SetDBValue($this->f("mfi_hvf1_customer_husband_name"));
        $this->mfi_hvf1_customer_age_years->SetDBValue(trim($this->f("mfi_hvf1_customer_age_years")));
        $this->mfi_hvf1_husband_age_years->SetDBValue(trim($this->f("mfi_hvf1_husband_age_years")));
        $this->mfi_hvf1_customer_kyc_id_no->SetDBValue($this->f("mfi_hvf1_customer_kyc_id_no"));
        $this->mfi_hvf1_husband_kyc_id_no->SetDBValue($this->f("mfi_hvf1_husband_kyc_id_no"));
        $this->mfi_hvf1_customer_current_address1->SetDBValue($this->f("mfi_hvf1_customer_current_address1"));
        $this->mfi_hvf1_customer_pin_code->SetDBValue($this->f("mfi_hvf1_customer_pin_code"));
        $this->mfi_hvf1_customer_mobile_no->SetDBValue($this->f("mfi_hvf1_customer_mobile_no"));
        $this->mfi_hvf1_husband_mobile_no->SetDBValue($this->f("mfi_hvf1_husband_mobile_no"));
        $this->mfi_hvf1_customer_residence_years->SetDBValue($this->f("mfi_hvf1_customer_residence_years"));
        $this->mfi_hvf1_agricultureland->SetDBValue(trim($this->f("mfi_hvf1_agricultureland")));
        $this->mfi_hvf1_no_of_crops->SetDBValue(trim($this->f("mfi_hvf1_no_of_crops")));
        $this->mfi_hvf1_total_milk_selling->SetDBValue(trim($this->f("mfi_hvf1_total_milk_selling")));
        $this->mfi_hvf1_provision_grocery->SetDBValue($this->f("mfi_hvf1_provision_grocery"));
        $this->mfi_hvf1_customer_livestock_details_cows->SetDBValue(trim($this->f("mfi_hvf1_customer_livestock_details_cows")));
        $this->mfi_hvf1_customer_livestock_details_goats_sheep->SetDBValue(trim($this->f("mfi_hvf1_customer_livestock_details_goats_sheep")));
        $this->mfi_hvf1_barber_shop->SetDBValue($this->f("mfi_hvf1_barber_shop"));
        $this->mfi_hvf1_skilled_labour->SetDBValue($this->f("mfi_hvf1_skilled_labour"));
        $this->mfi_hvf1_customer_livestock_details_buffalos->SetDBValue(trim($this->f("mfi_hvf1_customer_livestock_details_buffalos")));
        $this->mfi_hvf1_customer_livestock_details_pigs->SetDBValue(trim($this->f("mfi_hvf1_customer_livestock_details_pigs")));
        $this->mfi_hvf1_cuttleri_cloth->SetDBValue($this->f("mfi_hvf1_cuttleri_cloth"));
        $this->mfi_hvf1_tailoring_shop->SetDBValue($this->f("mfi_hvf1_tailoring_shop"));
        $this->mfi_hvf1_customer_livestock_details_bullocks_ox->SetDBValue(trim($this->f("mfi_hvf1_customer_livestock_details_bullocks_ox")));
        $this->mfi_hvf1_customer_livestock_details_chicken->SetDBValue(trim($this->f("mfi_hvf1_customer_livestock_details_chicken")));
        $this->mfi_hvf1_cycle_repair->SetDBValue($this->f("mfi_hvf1_cycle_repair"));
        $this->mfi_hvf1_tea_fastfood->SetDBValue($this->f("mfi_hvf1_tea_fastfood"));
        $this->mfi_hvf1_daily_labour->SetDBValue($this->f("mfi_hvf1_daily_labour"));
        $this->mfi_hvf1_others->SetDBValue($this->f("mfi_hvf1_other_income_activity"));
        $this->mfi_hvf1_fruit_vegetables->SetDBValue($this->f("mfi_hvf1_fruit_vegetables"));
        $this->mfi_hvf1_other_income_details->SetDBValue($this->f("mfi_hvf1_other_income_details"));
        $this->mfi_hvf1_customer_vehicles_cycle_cart->SetDBValue($this->f("mfi_hvf1_customer_vehicles_cycle_cart"));
        $this->mfi_hvf1_customer_vehicles_tractor->SetDBValue($this->f("mfi_hvf1_customer_vehicles_tractor"));
        $this->mfi_hvf1_customer_vehicles_two_wheeler->SetDBValue($this->f("mfi_hvf1_customer_vehicles_two_wheeler"));
        $this->mfi_hvf1_customer_vehicles_bullock_cart->SetDBValue($this->f("mfi_hvf1_customer_vehicles_bullock_cart"));
        $this->mfi_hvf1_customer_vehicles_auto_or_tempo->SetDBValue($this->f("mfi_hvf1_customer_vehicles_auto_or_tempo"));
        $this->mfi_hvf1_financial_inclusion_loans->SetDBValue($this->f("mfi_hvf1_financial_inclusion_loans"));
        $this->mfi_hvf1_financial_inclusion_bank_account->SetDBValue(trim($this->f("mfi_hvf1_financial_inclusion_bank_account")));
        $this->mfi_hvf1_financial_inclusion_insurance->SetDBValue(trim($this->f("mfi_hvf1_financial_inclusion_insurance")));
        $this->mfi_hvf1_financial_inclusion_chits->SetDBValue(trim($this->f("mfi_hvf1_financial_inclusion_chits")));
        $this->mfi_hvf1_financial_inclusion_micro_rimittances->SetDBValue(trim($this->f("mfi_hvf1_financial_inclusion_micro_rimittances")));
        $this->mfi_hvf1_financial_inclusion_others->SetDBValue(trim($this->f("mfi_hvf1_financial_inclusion_others")));
        $this->mfi_hvf1_financial_inclusion_others_specify->SetDBValue($this->f("mfi_hvf1_financial_inclusion_others_specify"));
        $this->household_children->SetDBValue(trim($this->f("household_children")));
        $this->household_adults->SetDBValue(trim($this->f("household_adults")));
        $this->husband_kyc_type->SetDBValue($this->f("mfi_hvf1_husband_kyc_id_type"));
        $this->Auto_Rickshaw_Driver->SetDBValue($this->f("mfi_hvf1_auto_rickshaw"));
        $this->marital_status->SetDBValue($this->f("mfi_hvf1_customer_marital_status"));
        $this->borrower_religion->SetDBValue($this->f("mfi_hvf1_customer_religion"));
        $this->customer_caste->SetDBValue($this->f("mfi_hvf1_caste"));
        $this->customer_education->SetDBValue($this->f("mfi_hvf1_customer_education"));
        $this->borrower_occupation->SetDBValue($this->f("mfi_hvf1_customer_occupation"));
        $this->gurantor_occupation->SetDBValue($this->f("mfi_hvf1_customer_guarantor_occupation"));
        $this->house_type->SetDBValue($this->f("mfi_hvf1_customer_house_type"));
        $this->monthly_hh_income->SetDBValue($this->f("monthly_household_income"));
        $this->added_by->SetDBValue($this->f("mfi_hvf1_added_by"));
        $this->added_at->SetDBValue($this->f("mfi_hvf1_added_at"));
        $this->updated_by->SetDBValue($this->f("mfi_hvf1_updated_by"));
        $this->updated_at->SetDBValue($this->f("mfi_hvf1_updated_at"));
        $this->gp_no->SetDBValue($this->f("gp_id"));
        $this->natureofresidence->SetDBValue($this->f("mfi_hvf1_customer_nature_of_residence"));
        $this->daily_labour_count->SetDBValue($this->f("mfi_hvf1_daily_labour_nos"));
        $this->household_total_members->SetDBValue($this->f("household_total_members"));
        $this->member_kyc_type->SetDBValue($this->f("mfi_hvf1_customer_kyc_id_type"));
    }
//End SetValues Method

//Insert Method @2-480CB957
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["la_id"]["Value"] = $this->la_id->GetDBValue(true);
        $this->InsertFields["hv_route"]["Value"] = $this->hv_route->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_relogin_hv_no"]["Value"] = $this->mfi_hvf1_relogin_hv_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_existing_enrollment_no"]["Value"] = $this->mfi_hvf1_existing_enrollment_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_name"]["Value"] = $this->mfi_hvf1_customer_name->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_father_name"]["Value"] = $this->mfi_hvf1_customer_father_name->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_husband_name"]["Value"] = $this->mfi_hvf1_customer_husband_name->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_age_years"]["Value"] = $this->mfi_hvf1_customer_age_years->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_husband_age_years"]["Value"] = $this->mfi_hvf1_husband_age_years->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_kyc_id_no"]["Value"] = $this->mfi_hvf1_customer_kyc_id_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_husband_kyc_id_no"]["Value"] = $this->mfi_hvf1_husband_kyc_id_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_current_address1"]["Value"] = $this->mfi_hvf1_customer_current_address1->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_pin_code"]["Value"] = $this->mfi_hvf1_customer_pin_code->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_mobile_no"]["Value"] = $this->mfi_hvf1_customer_mobile_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_husband_mobile_no"]["Value"] = $this->mfi_hvf1_husband_mobile_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_residence_years"]["Value"] = $this->mfi_hvf1_customer_residence_years->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_agricultureland"]["Value"] = $this->mfi_hvf1_agricultureland->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_no_of_crops"]["Value"] = $this->mfi_hvf1_no_of_crops->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_total_milk_selling"]["Value"] = $this->mfi_hvf1_total_milk_selling->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_provision_grocery"]["Value"] = $this->mfi_hvf1_provision_grocery->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_cows"]["Value"] = $this->mfi_hvf1_customer_livestock_details_cows->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_goats_sheep"]["Value"] = $this->mfi_hvf1_customer_livestock_details_goats_sheep->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_barber_shop"]["Value"] = $this->mfi_hvf1_barber_shop->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_skilled_labour"]["Value"] = $this->mfi_hvf1_skilled_labour->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_buffalos"]["Value"] = $this->mfi_hvf1_customer_livestock_details_buffalos->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_pigs"]["Value"] = $this->mfi_hvf1_customer_livestock_details_pigs->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_cuttleri_cloth"]["Value"] = $this->mfi_hvf1_cuttleri_cloth->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_tailoring_shop"]["Value"] = $this->mfi_hvf1_tailoring_shop->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_bullocks_ox"]["Value"] = $this->mfi_hvf1_customer_livestock_details_bullocks_ox->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_livestock_details_chicken"]["Value"] = $this->mfi_hvf1_customer_livestock_details_chicken->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_cycle_repair"]["Value"] = $this->mfi_hvf1_cycle_repair->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_tea_fastfood"]["Value"] = $this->mfi_hvf1_tea_fastfood->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_daily_labour"]["Value"] = $this->mfi_hvf1_daily_labour->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_other_income_activity"]["Value"] = $this->mfi_hvf1_others->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_fruit_vegetables"]["Value"] = $this->mfi_hvf1_fruit_vegetables->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_other_income_details"]["Value"] = $this->mfi_hvf1_other_income_details->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_vehicles_cycle_cart"]["Value"] = $this->mfi_hvf1_customer_vehicles_cycle_cart->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_vehicles_tractor"]["Value"] = $this->mfi_hvf1_customer_vehicles_tractor->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_vehicles_two_wheeler"]["Value"] = $this->mfi_hvf1_customer_vehicles_two_wheeler->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_vehicles_bullock_cart"]["Value"] = $this->mfi_hvf1_customer_vehicles_bullock_cart->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_vehicles_auto_or_tempo"]["Value"] = $this->mfi_hvf1_customer_vehicles_auto_or_tempo->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_financial_inclusion_loans"]["Value"] = $this->mfi_hvf1_financial_inclusion_loans->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_financial_inclusion_bank_account"]["Value"] = $this->mfi_hvf1_financial_inclusion_bank_account->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_financial_inclusion_insurance"]["Value"] = $this->mfi_hvf1_financial_inclusion_insurance->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_financial_inclusion_chits"]["Value"] = $this->mfi_hvf1_financial_inclusion_chits->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_financial_inclusion_micro_rimittances"]["Value"] = $this->mfi_hvf1_financial_inclusion_micro_rimittances->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_financial_inclusion_others"]["Value"] = $this->mfi_hvf1_financial_inclusion_others->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_financial_inclusion_others_specify"]["Value"] = $this->mfi_hvf1_financial_inclusion_others_specify->GetDBValue(true);
        $this->InsertFields["household_children"]["Value"] = $this->household_children->GetDBValue(true);
        $this->InsertFields["household_adults"]["Value"] = $this->household_adults->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_husband_kyc_id_type"]["Value"] = $this->husband_kyc_type->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_auto_rickshaw"]["Value"] = $this->Auto_Rickshaw_Driver->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_marital_status"]["Value"] = $this->marital_status->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_religion"]["Value"] = $this->borrower_religion->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_caste"]["Value"] = $this->customer_caste->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_education"]["Value"] = $this->customer_education->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_occupation"]["Value"] = $this->borrower_occupation->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_guarantor_occupation"]["Value"] = $this->gurantor_occupation->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_house_type"]["Value"] = $this->house_type->GetDBValue(true);
        $this->InsertFields["monthly_household_income"]["Value"] = $this->monthly_hh_income->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_added_by"]["Value"] = $this->added_by->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_added_at"]["Value"] = $this->added_at->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_updated_by"]["Value"] = $this->updated_by->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_updated_at"]["Value"] = $this->updated_at->GetDBValue(true);
        $this->InsertFields["gp_id"]["Value"] = $this->gp_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_nature_of_residence"]["Value"] = $this->natureofresidence->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_daily_labour_nos"]["Value"] = $this->daily_labour_count->GetDBValue(true);
        $this->InsertFields["household_total_members"]["Value"] = $this->household_total_members->GetDBValue(true);
        $this->InsertFields["mfi_hvf1_customer_kyc_id_type"]["Value"] = $this->member_kyc_type->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_hvf1", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-D23E298D
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["la_id"]["Value"] = $this->la_id->GetDBValue(true);
        $this->UpdateFields["hv_route"]["Value"] = $this->hv_route->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_relogin_hv_no"]["Value"] = $this->mfi_hvf1_relogin_hv_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_existing_enrollment_no"]["Value"] = $this->mfi_hvf1_existing_enrollment_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_name"]["Value"] = $this->mfi_hvf1_customer_name->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_father_name"]["Value"] = $this->mfi_hvf1_customer_father_name->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_husband_name"]["Value"] = $this->mfi_hvf1_customer_husband_name->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_age_years"]["Value"] = $this->mfi_hvf1_customer_age_years->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_husband_age_years"]["Value"] = $this->mfi_hvf1_husband_age_years->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_kyc_id_no"]["Value"] = $this->mfi_hvf1_customer_kyc_id_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_husband_kyc_id_no"]["Value"] = $this->mfi_hvf1_husband_kyc_id_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_current_address1"]["Value"] = $this->mfi_hvf1_customer_current_address1->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_pin_code"]["Value"] = $this->mfi_hvf1_customer_pin_code->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_mobile_no"]["Value"] = $this->mfi_hvf1_customer_mobile_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_husband_mobile_no"]["Value"] = $this->mfi_hvf1_husband_mobile_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_residence_years"]["Value"] = $this->mfi_hvf1_customer_residence_years->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_agricultureland"]["Value"] = $this->mfi_hvf1_agricultureland->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_no_of_crops"]["Value"] = $this->mfi_hvf1_no_of_crops->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_total_milk_selling"]["Value"] = $this->mfi_hvf1_total_milk_selling->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_provision_grocery"]["Value"] = $this->mfi_hvf1_provision_grocery->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_cows"]["Value"] = $this->mfi_hvf1_customer_livestock_details_cows->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_goats_sheep"]["Value"] = $this->mfi_hvf1_customer_livestock_details_goats_sheep->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_barber_shop"]["Value"] = $this->mfi_hvf1_barber_shop->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_skilled_labour"]["Value"] = $this->mfi_hvf1_skilled_labour->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_buffalos"]["Value"] = $this->mfi_hvf1_customer_livestock_details_buffalos->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_pigs"]["Value"] = $this->mfi_hvf1_customer_livestock_details_pigs->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_cuttleri_cloth"]["Value"] = $this->mfi_hvf1_cuttleri_cloth->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_tailoring_shop"]["Value"] = $this->mfi_hvf1_tailoring_shop->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_bullocks_ox"]["Value"] = $this->mfi_hvf1_customer_livestock_details_bullocks_ox->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_livestock_details_chicken"]["Value"] = $this->mfi_hvf1_customer_livestock_details_chicken->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_cycle_repair"]["Value"] = $this->mfi_hvf1_cycle_repair->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_tea_fastfood"]["Value"] = $this->mfi_hvf1_tea_fastfood->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_daily_labour"]["Value"] = $this->mfi_hvf1_daily_labour->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_other_income_activity"]["Value"] = $this->mfi_hvf1_others->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_fruit_vegetables"]["Value"] = $this->mfi_hvf1_fruit_vegetables->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_other_income_details"]["Value"] = $this->mfi_hvf1_other_income_details->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_cycle_cart"]["Value"] = $this->mfi_hvf1_customer_vehicles_cycle_cart->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_tractor"]["Value"] = $this->mfi_hvf1_customer_vehicles_tractor->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_two_wheeler"]["Value"] = $this->mfi_hvf1_customer_vehicles_two_wheeler->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_bullock_cart"]["Value"] = $this->mfi_hvf1_customer_vehicles_bullock_cart->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_vehicles_auto_or_tempo"]["Value"] = $this->mfi_hvf1_customer_vehicles_auto_or_tempo->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_loans"]["Value"] = $this->mfi_hvf1_financial_inclusion_loans->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_bank_account"]["Value"] = $this->mfi_hvf1_financial_inclusion_bank_account->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_insurance"]["Value"] = $this->mfi_hvf1_financial_inclusion_insurance->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_chits"]["Value"] = $this->mfi_hvf1_financial_inclusion_chits->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_micro_rimittances"]["Value"] = $this->mfi_hvf1_financial_inclusion_micro_rimittances->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_others"]["Value"] = $this->mfi_hvf1_financial_inclusion_others->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_financial_inclusion_others_specify"]["Value"] = $this->mfi_hvf1_financial_inclusion_others_specify->GetDBValue(true);
        $this->UpdateFields["household_children"]["Value"] = $this->household_children->GetDBValue(true);
        $this->UpdateFields["household_adults"]["Value"] = $this->household_adults->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_husband_kyc_id_type"]["Value"] = $this->husband_kyc_type->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_auto_rickshaw"]["Value"] = $this->Auto_Rickshaw_Driver->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_marital_status"]["Value"] = $this->marital_status->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_religion"]["Value"] = $this->borrower_religion->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_caste"]["Value"] = $this->customer_caste->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_education"]["Value"] = $this->customer_education->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_occupation"]["Value"] = $this->borrower_occupation->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_guarantor_occupation"]["Value"] = $this->gurantor_occupation->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_house_type"]["Value"] = $this->house_type->GetDBValue(true);
        $this->UpdateFields["monthly_household_income"]["Value"] = $this->monthly_hh_income->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_added_by"]["Value"] = $this->added_by->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_added_at"]["Value"] = $this->added_at->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_updated_by"]["Value"] = $this->updated_by->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_updated_at"]["Value"] = $this->updated_at->GetDBValue(true);
        $this->UpdateFields["gp_id"]["Value"] = $this->gp_no->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_nature_of_residence"]["Value"] = $this->natureofresidence->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_daily_labour_nos"]["Value"] = $this->daily_labour_count->GetDBValue(true);
        $this->UpdateFields["household_total_members"]["Value"] = $this->household_total_members->GetDBValue(true);
        $this->UpdateFields["mfi_hvf1_customer_kyc_id_type"]["Value"] = $this->member_kyc_type->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_hvf1", $this->UpdateFields, $this);
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

} //End mfi_hvf1DataSource Class @2-FCB6E20C

//Initialize Page @1-BA58D8C9
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
$TemplateFileName = "LAForm1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-24D9BC9F
include_once("./LAForm1_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CED12A24
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_hvf1 = new clsRecordmfi_hvf1("", $MainPage);
$MainPage->mfi_hvf1 = & $mfi_hvf1;
$mfi_hvf1->Initialize();

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

//Execute Components @1-49B7E5A1
$mfi_hvf1->Operation();
//End Execute Components

//Go to destination page @1-E77680D1
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_hvf1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-66EA1E32
$mfi_hvf1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3C33AB2D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_hvf1);
unset($Tpl);
//End Unload Page


?>
