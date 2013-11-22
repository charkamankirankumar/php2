<?php
//Include Common Files @1-4D2AA4CB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "TeleCalling.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



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

//Prepare Method @2-72B5FA74
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgp_id", ccsText, "", "", $this->Parameters["urlgp_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_hvf2.gp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
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

class clsRecordmfi_tc_individualcheck { //mfi_tc_individualcheck Class @204-842578AB

//Variables @204-21841590

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
//End Variables

//Class_Initialize Event @204-9F9F40B6
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
        }
    }
//End Class_Initialize Event

//Initialize Method @204-B4CA389F
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlla_id"] = CCGetFromGet("la_id", NULL);
    }
//End Initialize Method

//Validate Method @204-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @204-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @204-17DC9883
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @204-2B6A5BEC
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @204-879EE3A7
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
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_tc_individualcheck Class @204-FCB6E20C

class clsmfi_tc_individualcheckDataSource extends clsDBmysql_cams_v2 {  //mfi_tc_individualcheckDataSource Class @204-03E967B7

//DataSource Variables @204-43244D43
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();

//End DataSource Variables

//DataSourceClass_Initialize Event @204-9A466151
    function clsmfi_tc_individualcheckDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_tc_individualcheck/Error";
        $this->Initialize();

    }
//End DataSourceClass_Initialize Event

//Prepare Method @204-89510D2C
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

//Open Method @204-93A3DE18
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

//SetValues Method @204-BAF0975B
    function SetValues()
    {
    }
//End SetValues Method

//Insert Method @204-CAA9CBAE
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->SQL = CCBuildInsert("mfi_tc_individualcheck", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End mfi_tc_individualcheckDataSource Class @204-FCB6E20C





//Initialize Page @1-70F98667
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
$TemplateFileName = "TeleCalling.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CE106D47
include_once("./TeleCalling_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-26B34FBA
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$udgapnl = new clsPanel("udgapnl", $MainPage);
$gac = new clsRecordgac("", $MainPage);
$gpudpnl = new clsPanel("gpudpnl", $MainPage);
$Gpbtn = new clsRecordGpbtn("", $MainPage);
$mfi_hvf1_mfi_hvf2_mfi_hvf = new clsGridmfi_hvf1_mfi_hvf2_mfi_hvf("", $MainPage);
$mfi_tc_individualcheck = new clsRecordmfi_tc_individualcheck("", $MainPage);
$la_id = new clsControl(ccsHidden, "la_id", "la_id", ccsText, "", CCGetRequestParam("la_id", ccsGet, NULL), $MainPage);
$mfi_borrower_name = new clsControl(ccsHidden, "mfi_borrower_name", $CCSLocales->GetText("mfi_borrower_name"), ccsText, "", CCGetRequestParam("mfi_borrower_name", ccsGet, NULL), $MainPage);
$mfi_tc_call_attempt = new clsControl(ccsHidden, "mfi_tc_call_attempt", $CCSLocales->GetText("mfi_tc_call_attempt"), ccsText, "", CCGetRequestParam("mfi_tc_call_attempt", ccsGet, NULL), $MainPage);
$mfi_tc_call_attempt->Required = true;
$mfi_tc_call_log = new clsControl(ccsHidden, "mfi_tc_call_log", $CCSLocales->GetText("mfi_tc_call_log"), ccsText, "", CCGetRequestParam("mfi_tc_call_log", ccsGet, NULL), $MainPage);
$mfi_tc_b1_ans = new clsControl(ccsHidden, "mfi_tc_b1_ans", $CCSLocales->GetText("mfi_tc_b1_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b1_ans", ccsGet, NULL), $MainPage);
$mfi_tc_b2_ans = new clsControl(ccsHidden, "mfi_tc_b2_ans", $CCSLocales->GetText("mfi_tc_b2_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b2_ans", ccsGet, NULL), $MainPage);
$mfi_tc_b3_ans = new clsControl(ccsHidden, "mfi_tc_b3_ans", $CCSLocales->GetText("mfi_tc_b3_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b3_ans", ccsGet, NULL), $MainPage);
$mfi_tc_b4_ans = new clsControl(ccsHidden, "mfi_tc_b4_ans", $CCSLocales->GetText("mfi_tc_b4_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b4_ans", ccsGet, NULL), $MainPage);
$mfi_tc_b5_ans = new clsControl(ccsHidden, "mfi_tc_b5_ans", $CCSLocales->GetText("mfi_tc_b5_ans"), ccsText, "", CCGetRequestParam("mfi_tc_b5_ans", ccsGet, NULL), $MainPage);
$mfi_tc_1_ans = new clsControl(ccsHidden, "mfi_tc_1_ans", $CCSLocales->GetText("mfi_tc_1_ans"), ccsText, "", CCGetRequestParam("mfi_tc_1_ans", ccsGet, NULL), $MainPage);
$mfi_tc_2_ans = new clsControl(ccsHidden, "mfi_tc_2_ans", $CCSLocales->GetText("mfi_tc_2_ans"), ccsText, "", CCGetRequestParam("mfi_tc_2_ans", ccsGet, NULL), $MainPage);
$mfi_tc_3_ans = new clsControl(ccsHidden, "mfi_tc_3_ans", $CCSLocales->GetText("mfi_tc_3_ans"), ccsText, "", CCGetRequestParam("mfi_tc_3_ans", ccsGet, NULL), $MainPage);
$mfi_tc_4_ans = new clsControl(ccsHidden, "mfi_tc_4_ans", $CCSLocales->GetText("mfi_tc_4_ans"), ccsText, "", CCGetRequestParam("mfi_tc_4_ans", ccsGet, NULL), $MainPage);
$mfi_tc_5_ans = new clsControl(ccsHidden, "mfi_tc_5_ans", $CCSLocales->GetText("mfi_tc_5_ans"), ccsText, "", CCGetRequestParam("mfi_tc_5_ans", ccsGet, NULL), $MainPage);
$mfi_tc_6_ans = new clsControl(ccsHidden, "mfi_tc_6_ans", $CCSLocales->GetText("mfi_tc_6_ans"), ccsText, "", CCGetRequestParam("mfi_tc_6_ans", ccsGet, NULL), $MainPage);
$mfi_region_name = new clsControl(ccsHidden, "mfi_region_name", $CCSLocales->GetText("mfi_region_name"), ccsText, "", CCGetRequestParam("mfi_region_name", ccsGet, NULL), $MainPage);
$mfi_center_name = new clsControl(ccsHidden, "mfi_center_name", $CCSLocales->GetText("mfi_center_name"), ccsText, "", CCGetRequestParam("mfi_center_name", ccsGet, NULL), $MainPage);
$mfi_group_id = new clsControl(ccsHidden, "mfi_group_id", $CCSLocales->GetText("mfi_group_id"), ccsText, "", CCGetRequestParam("mfi_group_id", ccsGet, NULL), $MainPage);
$mfi_group_name = new clsControl(ccsHidden, "mfi_group_name", $CCSLocales->GetText("mfi_group_name"), ccsText, "", CCGetRequestParam("mfi_group_name", ccsGet, NULL), $MainPage);
$called_by = new clsControl(ccsHidden, "called_by", $CCSLocales->GetText("called_by"), ccsText, "", CCGetRequestParam("called_by", ccsGet, NULL), $MainPage);
$called_at = new clsControl(ccsHidden, "called_at", $CCSLocales->GetText("called_at"), ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "H", ":i:", "s"), CCGetRequestParam("called_at", ccsGet, NULL), $MainPage);
$tc_individual_check_status = new clsControl(ccsListBox, "tc_individual_check_status", $CCSLocales->GetText("tc_individual_check_status"), ccsText, "", CCGetRequestParam("tc_individual_check_status", ccsGet, NULL), $MainPage);
$tc_individual_check_status->DSType = dsListOfValues;
$tc_individual_check_status->Values = array(array("IA Check", "IA Check"), array("SANCTIONED", "SANCTIONED"), array("PENDING", "PENDING"), array("REJECTED", "REJECTED"));
$tc_individual_check_status->Required = true;
$mfi_interest_details = new clsControl(ccsHidden, "mfi_interest_details", $CCSLocales->GetText("mfi_interest_details"), ccsText, "", CCGetRequestParam("mfi_interest_details", ccsGet, NULL), $MainPage);
$tc_ic_rejection_details = new clsControl(ccsTextArea, "tc_ic_rejection_details", $CCSLocales->GetText("tc_ic_rejection_details"), ccsText, "", CCGetRequestParam("tc_ic_rejection_details", ccsGet, NULL), $MainPage);
$mfi_customer_mobile_no = new clsControl(ccsHidden, "mfi_customer_mobile_no", $CCSLocales->GetText("mfi_customer_mobile_no"), ccsFloat, "", CCGetRequestParam("mfi_customer_mobile_no", ccsGet, NULL), $MainPage);
$mfi_mobile_status = new clsControl(ccsHidden, "mfi_mobile_status", $CCSLocales->GetText("mfi_mobile_status"), ccsText, "", CCGetRequestParam("mfi_mobile_status", ccsGet, NULL), $MainPage);
$mfi_incoming_mobile_no = new clsControl(ccsHidden, "mfi_incoming_mobile_no", $CCSLocales->GetText("mfi_incoming_mobile_no"), ccsFloat, "", CCGetRequestParam("mfi_incoming_mobile_no", ccsGet, NULL), $MainPage);
$mfi_customer_relationship = new clsControl(ccsHidden, "mfi_customer_relationship", $CCSLocales->GetText("mfi_customer_relationship"), ccsText, "", CCGetRequestParam("mfi_customer_relationship", ccsGet, NULL), $MainPage);
$tc_remarks = new clsControl(ccsHidden, "tc_remarks", $CCSLocales->GetText("tc_remarks"), ccsText, "", CCGetRequestParam("tc_remarks", ccsGet, NULL), $MainPage);
$Button_Insert = new clsButton("Button_Insert", ccsGet, $MainPage);
$MainPage->udgapnl = & $udgapnl;
$MainPage->gac = & $gac;
$MainPage->gpudpnl = & $gpudpnl;
$MainPage->Gpbtn = & $Gpbtn;
$MainPage->mfi_hvf1_mfi_hvf2_mfi_hvf = & $mfi_hvf1_mfi_hvf2_mfi_hvf;
$MainPage->mfi_tc_individualcheck = & $mfi_tc_individualcheck;
$MainPage->la_id = & $la_id;
$MainPage->mfi_borrower_name = & $mfi_borrower_name;
$MainPage->mfi_tc_call_attempt = & $mfi_tc_call_attempt;
$MainPage->mfi_tc_call_log = & $mfi_tc_call_log;
$MainPage->mfi_tc_b1_ans = & $mfi_tc_b1_ans;
$MainPage->mfi_tc_b2_ans = & $mfi_tc_b2_ans;
$MainPage->mfi_tc_b3_ans = & $mfi_tc_b3_ans;
$MainPage->mfi_tc_b4_ans = & $mfi_tc_b4_ans;
$MainPage->mfi_tc_b5_ans = & $mfi_tc_b5_ans;
$MainPage->mfi_tc_1_ans = & $mfi_tc_1_ans;
$MainPage->mfi_tc_2_ans = & $mfi_tc_2_ans;
$MainPage->mfi_tc_3_ans = & $mfi_tc_3_ans;
$MainPage->mfi_tc_4_ans = & $mfi_tc_4_ans;
$MainPage->mfi_tc_5_ans = & $mfi_tc_5_ans;
$MainPage->mfi_tc_6_ans = & $mfi_tc_6_ans;
$MainPage->mfi_region_name = & $mfi_region_name;
$MainPage->mfi_center_name = & $mfi_center_name;
$MainPage->mfi_group_id = & $mfi_group_id;
$MainPage->mfi_group_name = & $mfi_group_name;
$MainPage->called_by = & $called_by;
$MainPage->called_at = & $called_at;
$MainPage->tc_individual_check_status = & $tc_individual_check_status;
$MainPage->mfi_interest_details = & $mfi_interest_details;
$MainPage->tc_ic_rejection_details = & $tc_ic_rejection_details;
$MainPage->mfi_customer_mobile_no = & $mfi_customer_mobile_no;
$MainPage->mfi_mobile_status = & $mfi_mobile_status;
$MainPage->mfi_incoming_mobile_no = & $mfi_incoming_mobile_no;
$MainPage->mfi_customer_relationship = & $mfi_customer_relationship;
$MainPage->tc_remarks = & $tc_remarks;
$MainPage->Button_Insert = & $Button_Insert;
$udgapnl->AddComponent("gac", $gac);
$gpudpnl->AddComponent("Gpbtn", $Gpbtn);
$mfi_hvf1_mfi_hvf2_mfi_hvf->Initialize();
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

//Execute Components @1-2DF75A7D
$mfi_tc_individualcheck->Operation();
$Gpbtn->Operation();
$gac->Operation();
//End Execute Components

//Go to destination page @1-BEBD993F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($gac);
    unset($Gpbtn);
    unset($mfi_hvf1_mfi_hvf2_mfi_hvf);
    unset($mfi_tc_individualcheck);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7021638E
$tc_individual_check_status->Prepare();
$mfi_hvf1_mfi_hvf2_mfi_hvf->Show();
$mfi_tc_individualcheck->Show();
$tc_individual_check_status->Show();
$Button_Insert->Show();
$udgapnl->Show();
$gpudpnl->Show();
$la_id->Show();
$mfi_borrower_name->Show();
$mfi_tc_call_attempt->Show();
$mfi_tc_call_log->Show();
$mfi_tc_b1_ans->Show();
$mfi_tc_b2_ans->Show();
$mfi_tc_b3_ans->Show();
$mfi_tc_b4_ans->Show();
$mfi_tc_b5_ans->Show();
$mfi_tc_1_ans->Show();
$mfi_tc_2_ans->Show();
$mfi_tc_3_ans->Show();
$mfi_tc_4_ans->Show();
$mfi_tc_5_ans->Show();
$mfi_tc_6_ans->Show();
$mfi_region_name->Show();
$mfi_center_name->Show();
$mfi_group_id->Show();
$mfi_group_name->Show();
$called_by->Show();
$called_at->Show();
$mfi_interest_details->Show();
$tc_ic_rejection_details->Show();
$mfi_customer_mobile_no->Show();
$mfi_mobile_status->Show();
$mfi_incoming_mobile_no->Show();
$mfi_customer_relationship->Show();
$tc_remarks->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-0C85F8B8
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($gac);
unset($Gpbtn);
unset($mfi_hvf1_mfi_hvf2_mfi_hvf);
unset($mfi_tc_individualcheck);
unset($Tpl);
//End Unload Page


?>
