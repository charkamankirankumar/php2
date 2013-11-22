<?php
//Include Common Files @1-C7AD9811
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "manageFileUpload_old.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

//Include Page implementation @2-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @3-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

class clsRecordmfi_fileupload1 { //mfi_fileupload1 Class @41-78F4BC31

//Variables @41-9E315808

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

//Class_Initialize Event @41-4C2F3D5F
    function clsRecordmfi_fileupload1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_fileupload1/Error";
        $this->DataSource = new clsmfi_fileupload1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_fileupload1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->mfi_territorycode = new clsControl(ccsHidden, "mfi_territorycode", $CCSLocales->GetText("mfi_territorycode"), ccsText, "", CCGetRequestParam("mfi_territorycode", $Method, NULL), $this);
            $this->mfi_territorycode->Required = true;
            $this->mfi_no_files = new clsControl(ccsTextBox, "mfi_no_files", $CCSLocales->GetText("mfi_no_files"), ccsInteger, "", CCGetRequestParam("mfi_no_files", $Method, NULL), $this);
            $this->mfi_no_files->Required = true;
            $this->State_Division = new clsControl(ccsListBox, "State_Division", "State_Division", ccsText, "", CCGetRequestParam("State_Division", $Method, NULL), $this);
            $this->State_Division->DSType = dsTable;
            $this->State_Division->DataSource = new clsDBmysql_cams_v2();
            $this->State_Division->ds = & $this->State_Division->DataSource;
            $this->State_Division->DataSource->SQL = "SELECT * \n" .
"FROM mfi_unit_divisions {SQL_Where} {SQL_OrderBy}";
            list($this->State_Division->BoundColumn, $this->State_Division->TextColumn, $this->State_Division->DBFormat) = array("mfi_unit_code", "mfi_unit_code", "");
            $this->Region = new clsControl(ccsListBox, "Region", "Region", ccsText, "", CCGetRequestParam("Region", $Method, NULL), $this);
            $this->Region->DSType = dsTable;
            $this->Region->DataSource = new clsDBmysql_cams_v2();
            $this->Region->ds = & $this->Region->DataSource;
            $this->Region->DataSource->SQL = "SELECT * \n" .
"FROM mfi_unit_regions {SQL_Where} {SQL_OrderBy}";
            $this->Region->DataSource->Order = "mfi_unit_code";
            list($this->Region->BoundColumn, $this->Region->TextColumn, $this->Region->DBFormat) = array("", "", "");
            $this->Region->DataSource->Order = "mfi_unit_code";
            $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsListOfValues;
            $this->ListBox1->Values = array(array("new cp", "new cp"), array("New Form With Kyc", "New Form With Kyc"), array("New Form Without Kyc", "New Form Without Kyc"), array("RELOGIN", "RELOGIN"), array("DISB PHOTO", "DISB PHOTO"), array("EOD", "EOD"), array("OTHER", "OTHER"));
            $this->ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", $Method, NULL), $this);
            $this->ListBox2->DSType = dsListOfValues;
            $this->ListBox2->Values = array(array("20130507101140", "20130507101140"), array("20130507101320", "20130507101320"), array("20130506101140", "20130506101140"));
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->mfi_uploaded_by = new clsControl(ccsHidden, "mfi_uploaded_by", "mfi_uploaded_by", ccsText, "", CCGetRequestParam("mfi_uploaded_by", $Method, NULL), $this);
            $this->ListBox3 = new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", $Method, NULL), $this);
            $this->ListBox3->DSType = dsListOfValues;
            $this->ListBox3->Values = array(array("20130507101140", "20130507101140"), array("20130507101320", "20130507101320"), array("20130506101140", "20130506101140"));
            $this->ListBox4 = new clsControl(ccsListBox, "ListBox4", "ListBox4", ccsText, "", CCGetRequestParam("ListBox4", $Method, NULL), $this);
            $this->ListBox4->DSType = dsListOfValues;
            $this->ListBox4->Values = array(array("KA12345", "KA12345"), array("KA12348", "KA12348"), array("TN12345", "TN12345"), array("TN12349", "TN12349"));
            $this->ListBox5 = new clsControl(ccsListBox, "ListBox5", "ListBox5", ccsText, "", CCGetRequestParam("ListBox5", $Method, NULL), $this);
            $this->ListBox5->DSType = dsListOfValues;
            $this->ListBox5->Values = array(array("KA12345", "KA12345"), array("KA12348", "KA12348"), array("TN12345", "TN12345"), array("TN12349", "TN12349"));
            $this->ListBox6 = new clsControl(ccsTextBox, "ListBox6", "ListBox6", ccsText, "", CCGetRequestParam("ListBox6", $Method, NULL), $this);
            $this->ListBox7 = new clsControl(ccsTextBox, "ListBox7", "ListBox7", ccsText, "", CCGetRequestParam("ListBox7", $Method, NULL), $this);
            $this->DatePicker_ListBox6 = new clsDatePicker("DatePicker_ListBox6", "mfi_fileupload1", "ListBox6", $this);
            $this->branch = new clsControl(ccsListBox, "branch", "branch", ccsText, "", CCGetRequestParam("branch", $Method, NULL), $this);
            $this->branch->DSType = dsTable;
            $this->branch->DataSource = new clsDBmysql_cams_v2();
            $this->branch->ds = & $this->branch->DataSource;
            $this->branch->DataSource->SQL = "SELECT mfi_unit_code \n" .
"FROM mfi_unit_branches {SQL_Where} {SQL_OrderBy}";
            list($this->branch->BoundColumn, $this->branch->TextColumn, $this->branch->DBFormat) = array("mfi_unit_code", "mfi_unit_code", "");
            $this->branch->DataSource->Parameters["cookbranch"] = CCGetCookie("branch", NULL);
            $this->branch->DataSource->wp = new clsSQLParameters();
            $this->branch->DataSource->wp->AddParameter("1", "cookbranch", ccsText, "", "", $this->branch->DataSource->Parameters["cookbranch"], "", false);
            $this->branch->DataSource->wp->Criterion[1] = $this->branch->DataSource->wp->Operation(opEqual, "mfi_unit_region_code", $this->branch->DataSource->wp->GetDBValue("1"), $this->branch->DataSource->ToSQL($this->branch->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->branch->DataSource->Where = 
                 $this->branch->DataSource->wp->Criterion[1];
            $this->Label6 = new clsControl(ccsLabel, "Label6", "Label6", ccsText, "", CCGetRequestParam("Label6", $Method, NULL), $this);
            $this->form_extn = new clsControl(ccsHidden, "form_extn", "form_extn", ccsText, "", CCGetRequestParam("form_extn", $Method, NULL), $this);
            $this->new_cp_name = new clsControl(ccsTextBox, "new_cp_name", "new_cp_name", ccsText, "", CCGetRequestParam("new_cp_name", $Method, NULL), $this);
            $this->Button1 = new clsButton("Button1", $Method, $this);
            $this->new_cp_id = new clsControl(ccsTextBox, "new_cp_id", "new_cp_id", ccsText, "", CCGetRequestParam("new_cp_id", $Method, NULL), $this);
            $this->cp_id = new clsControl(ccsTextBox, "cp_id", "cp_id", ccsText, "", CCGetRequestParam("cp_id", $Method, NULL), $this);
            $this->center_name = new clsControl(ccsTextBox, "center_name", "center_name", ccsText, "", CCGetRequestParam("center_name", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @41-26E54296
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlsno"] = CCGetFromGet("sno", NULL);
    }
//End Initialize Method

//Validate Method @41-9D14F119
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->mfi_territorycode->Validate() && $Validation);
        $Validation = ($this->mfi_no_files->Validate() && $Validation);
        $Validation = ($this->State_Division->Validate() && $Validation);
        $Validation = ($this->Region->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->ListBox2->Validate() && $Validation);
        $Validation = ($this->mfi_uploaded_by->Validate() && $Validation);
        $Validation = ($this->ListBox3->Validate() && $Validation);
        $Validation = ($this->ListBox4->Validate() && $Validation);
        $Validation = ($this->ListBox5->Validate() && $Validation);
        $Validation = ($this->ListBox6->Validate() && $Validation);
        $Validation = ($this->ListBox7->Validate() && $Validation);
        $Validation = ($this->branch->Validate() && $Validation);
        $Validation = ($this->form_extn->Validate() && $Validation);
        $Validation = ($this->new_cp_name->Validate() && $Validation);
        $Validation = ($this->new_cp_id->Validate() && $Validation);
        $Validation = ($this->cp_id->Validate() && $Validation);
        $Validation = ($this->center_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_territorycode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_no_files->Errors->Count() == 0);
        $Validation =  $Validation && ($this->State_Division->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_uploaded_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox6->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox7->Errors->Count() == 0);
        $Validation =  $Validation && ($this->branch->Errors->Count() == 0);
        $Validation =  $Validation && ($this->form_extn->Errors->Count() == 0);
        $Validation =  $Validation && ($this->new_cp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->new_cp_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cp_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->center_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @41-85D0916D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_territorycode->Errors->Count());
        $errors = ($errors || $this->mfi_no_files->Errors->Count());
        $errors = ($errors || $this->State_Division->Errors->Count());
        $errors = ($errors || $this->Region->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->ListBox2->Errors->Count());
        $errors = ($errors || $this->mfi_uploaded_by->Errors->Count());
        $errors = ($errors || $this->ListBox3->Errors->Count());
        $errors = ($errors || $this->ListBox4->Errors->Count());
        $errors = ($errors || $this->ListBox5->Errors->Count());
        $errors = ($errors || $this->ListBox6->Errors->Count());
        $errors = ($errors || $this->ListBox7->Errors->Count());
        $errors = ($errors || $this->DatePicker_ListBox6->Errors->Count());
        $errors = ($errors || $this->branch->Errors->Count());
        $errors = ($errors || $this->Label6->Errors->Count());
        $errors = ($errors || $this->form_extn->Errors->Count());
        $errors = ($errors || $this->new_cp_name->Errors->Count());
        $errors = ($errors || $this->new_cp_id->Errors->Count());
        $errors = ($errors || $this->cp_id->Errors->Count());
        $errors = ($errors || $this->center_name->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @41-C34EF8A8
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
            } else if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
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

//InsertRow Method @41-74CE6344
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->mfi_territorycode->SetValue($this->mfi_territorycode->GetValue(true));
        $this->DataSource->mfi_no_files->SetValue($this->mfi_no_files->GetValue(true));
        $this->DataSource->State_Division->SetValue($this->State_Division->GetValue(true));
        $this->DataSource->Region->SetValue($this->Region->GetValue(true));
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->ListBox2->SetValue($this->ListBox2->GetValue(true));
        $this->DataSource->mfi_uploaded_by->SetValue($this->mfi_uploaded_by->GetValue(true));
        $this->DataSource->ListBox3->SetValue($this->ListBox3->GetValue(true));
        $this->DataSource->ListBox4->SetValue($this->ListBox4->GetValue(true));
        $this->DataSource->ListBox5->SetValue($this->ListBox5->GetValue(true));
        $this->DataSource->ListBox6->SetValue($this->ListBox6->GetValue(true));
        $this->DataSource->ListBox7->SetValue($this->ListBox7->GetValue(true));
        $this->DataSource->branch->SetValue($this->branch->GetValue(true));
        $this->DataSource->Label6->SetValue($this->Label6->GetValue(true));
        $this->DataSource->form_extn->SetValue($this->form_extn->GetValue(true));
        $this->DataSource->new_cp_name->SetValue($this->new_cp_name->GetValue(true));
        $this->DataSource->new_cp_id->SetValue($this->new_cp_id->GetValue(true));
        $this->DataSource->cp_id->SetValue($this->cp_id->GetValue(true));
        $this->DataSource->center_name->SetValue($this->center_name->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @41-AAA434DA
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

        $this->State_Division->Prepare();
        $this->Region->Prepare();
        $this->ListBox1->Prepare();
        $this->ListBox2->Prepare();
        $this->ListBox3->Prepare();
        $this->ListBox4->Prepare();
        $this->ListBox5->Prepare();
        $this->branch->Prepare();

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
                    $this->mfi_territorycode->SetValue($this->DataSource->mfi_territorycode->GetValue());
                    $this->mfi_no_files->SetValue($this->DataSource->mfi_no_files->GetValue());
                    $this->mfi_uploaded_by->SetValue($this->DataSource->mfi_uploaded_by->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_territorycode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_no_files->Errors->ToString());
            $Error = ComposeStrings($Error, $this->State_Division->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_uploaded_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox7->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_ListBox6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->branch->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->form_extn->Errors->ToString());
            $Error = ComposeStrings($Error, $this->new_cp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->new_cp_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cp_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->center_name->Errors->ToString());
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

        $this->mfi_territorycode->Show();
        $this->mfi_no_files->Show();
        $this->State_Division->Show();
        $this->Region->Show();
        $this->ListBox1->Show();
        $this->ListBox2->Show();
        $this->Button_Insert->Show();
        $this->mfi_uploaded_by->Show();
        $this->ListBox3->Show();
        $this->ListBox4->Show();
        $this->ListBox5->Show();
        $this->ListBox6->Show();
        $this->ListBox7->Show();
        $this->DatePicker_ListBox6->Show();
        $this->branch->Show();
        $this->Label6->Show();
        $this->form_extn->Show();
        $this->new_cp_name->Show();
        $this->Button1->Show();
        $this->new_cp_id->Show();
        $this->cp_id->Show();
        $this->center_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_fileupload1 Class @41-FCB6E20C

class clsmfi_fileupload1DataSource extends clsDBmysql_cams_v2 {  //mfi_fileupload1DataSource Class @41-55C3650A

//DataSource Variables @41-94E19002
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
    public $mfi_territorycode;
    public $mfi_no_files;
    public $State_Division;
    public $Region;
    public $ListBox1;
    public $ListBox2;
    public $mfi_uploaded_by;
    public $ListBox3;
    public $ListBox4;
    public $ListBox5;
    public $ListBox6;
    public $ListBox7;
    public $branch;
    public $Label6;
    public $form_extn;
    public $new_cp_name;
    public $new_cp_id;
    public $cp_id;
    public $center_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @41-0EB1F25A
    function clsmfi_fileupload1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_fileupload1/Error";
        $this->Initialize();
        $this->mfi_territorycode = new clsField("mfi_territorycode", ccsText, "");
        
        $this->mfi_no_files = new clsField("mfi_no_files", ccsInteger, "");
        
        $this->State_Division = new clsField("State_Division", ccsText, "");
        
        $this->Region = new clsField("Region", ccsText, "");
        
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        
        $this->ListBox2 = new clsField("ListBox2", ccsText, "");
        
        $this->mfi_uploaded_by = new clsField("mfi_uploaded_by", ccsText, "");
        
        $this->ListBox3 = new clsField("ListBox3", ccsText, "");
        
        $this->ListBox4 = new clsField("ListBox4", ccsText, "");
        
        $this->ListBox5 = new clsField("ListBox5", ccsText, "");
        
        $this->ListBox6 = new clsField("ListBox6", ccsText, "");
        
        $this->ListBox7 = new clsField("ListBox7", ccsText, "");
        
        $this->branch = new clsField("branch", ccsText, "");
        
        $this->Label6 = new clsField("Label6", ccsText, "");
        
        $this->form_extn = new clsField("form_extn", ccsText, "");
        
        $this->new_cp_name = new clsField("new_cp_name", ccsText, "");
        
        $this->new_cp_id = new clsField("new_cp_id", ccsText, "");
        
        $this->cp_id = new clsField("cp_id", ccsText, "");
        
        $this->center_name = new clsField("center_name", ccsText, "");
        

        $this->InsertFields["mfi_territorycode"] = array("Name" => "mfi_territorycode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_no_files"] = array("Name" => "mfi_no_files", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_uploaded_by"] = array("Name" => "mfi_uploaded_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @41-71FC44E8
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

//Open Method @41-FFD840FF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_fileupload {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @41-2B3B54BF
    function SetValues()
    {
        $this->mfi_territorycode->SetDBValue($this->f("mfi_territorycode"));
        $this->mfi_no_files->SetDBValue(trim($this->f("mfi_no_files")));
        $this->mfi_uploaded_by->SetDBValue($this->f("mfi_uploaded_by"));
    }
//End SetValues Method

//Insert Method @41-A7C9D66E
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["mfi_territorycode"]["Value"] = $this->mfi_territorycode->GetDBValue(true);
        $this->InsertFields["mfi_no_files"]["Value"] = $this->mfi_no_files->GetDBValue(true);
        $this->InsertFields["mfi_uploaded_by"]["Value"] = $this->mfi_uploaded_by->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_fileupload", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End mfi_fileupload1DataSource Class @41-FCB6E20C

class clsGridmfi_fileupload { //mfi_fileupload class @15-66DF577F

//Variables @15-6E51DF5A

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

//Class_Initialize Event @15-DDDA096B
    function clsGridmfi_fileupload($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_fileupload";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_fileupload";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_fileuploadDataSource($this);
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

        $this->mfi_territorycode = new clsControl(ccsLink, "mfi_territorycode", "mfi_territorycode", ccsText, "", CCGetRequestParam("mfi_territorycode", ccsGet, NULL), $this);
        $this->mfi_territorycode->Page = "manageFileUpload_old.php";
        $this->mfi_no_files = new clsControl(ccsLabel, "mfi_no_files", "mfi_no_files", ccsInteger, "", CCGetRequestParam("mfi_no_files", ccsGet, NULL), $this);
        $this->mfi_uploaded_on = new clsControl(ccsLabel, "mfi_uploaded_on", "mfi_uploaded_on", ccsDate, $DefaultDateFormat, CCGetRequestParam("mfi_uploaded_on", ccsGet, NULL), $this);
        $this->mfi_no_files1 = new clsControl(ccsLabel, "mfi_no_files1", "mfi_no_files1", ccsInteger, "", CCGetRequestParam("mfi_no_files1", ccsGet, NULL), $this);
        $this->mfi_fileupload_Insert = new clsControl(ccsLink, "mfi_fileupload_Insert", "mfi_fileupload_Insert", ccsText, "", CCGetRequestParam("mfi_fileupload_Insert", ccsGet, NULL), $this);
        $this->mfi_fileupload_Insert->Parameters = CCGetQueryString("QueryString", array("sno", "ccsForm"));
        $this->mfi_fileupload_Insert->Page = "manageFileUpload_old.php";
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @15-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @15-2F52D929
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_mfi_territorycode"] = CCGetFromGet("s_mfi_territorycode", NULL);

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
            $this->ControlsVisible["mfi_territorycode"] = $this->mfi_territorycode->Visible;
            $this->ControlsVisible["mfi_no_files"] = $this->mfi_no_files->Visible;
            $this->ControlsVisible["mfi_uploaded_on"] = $this->mfi_uploaded_on->Visible;
            $this->ControlsVisible["mfi_no_files1"] = $this->mfi_no_files1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mfi_territorycode->SetValue($this->DataSource->mfi_territorycode->GetValue());
                $this->mfi_territorycode->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->mfi_territorycode->Parameters = CCAddParam($this->mfi_territorycode->Parameters, "sno", $this->DataSource->f("sno"));
                $this->mfi_no_files->SetValue($this->DataSource->mfi_no_files->GetValue());
                $this->mfi_uploaded_on->SetValue($this->DataSource->mfi_uploaded_on->GetValue());
                $this->mfi_no_files1->SetValue($this->DataSource->mfi_no_files1->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_territorycode->Show();
                $this->mfi_no_files->Show();
                $this->mfi_uploaded_on->Show();
                $this->mfi_no_files1->Show();
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
        $this->mfi_fileupload_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @15-2CD308BC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_territorycode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_no_files->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_uploaded_on->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_no_files1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_fileupload Class @15-FCB6E20C

class clsmfi_fileuploadDataSource extends clsDBmysql_cams_v2 {  //mfi_fileuploadDataSource Class @15-6CB1CF60

//DataSource Variables @15-FAC27B46
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_territorycode;
    public $mfi_no_files;
    public $mfi_uploaded_on;
    public $mfi_no_files1;
//End DataSource Variables

//DataSourceClass_Initialize Event @15-F478842E
    function clsmfi_fileuploadDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_fileupload";
        $this->Initialize();
        $this->mfi_territorycode = new clsField("mfi_territorycode", ccsText, "");
        
        $this->mfi_no_files = new clsField("mfi_no_files", ccsInteger, "");
        
        $this->mfi_uploaded_on = new clsField("mfi_uploaded_on", ccsDate, $this->DateFormat);
        
        $this->mfi_no_files1 = new clsField("mfi_no_files1", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @15-3577A5E2
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "uploaded_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @15-5ADF53B2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_mfi_territorycode", ccsText, "", "", $this->Parameters["urls_mfi_territorycode"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "batch_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),true);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @15-D5D520CD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_fileupload";
        $this->SQL = "SELECT sno, batch_code AS BatchCode, total_subfiles AS TotalSubFiles, uploaded_date AS UploadedAt, proper_images, blank_images \n\n" .
        "FROM mfi_fileupload {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @15-82101D34
    function SetValues()
    {
        $this->mfi_territorycode->SetDBValue($this->f("BatchCode"));
        $this->mfi_no_files->SetDBValue(trim($this->f("TotalSubFiles")));
        $this->mfi_uploaded_on->SetDBValue(trim($this->f("UploadedAt")));
        $this->mfi_no_files1->SetDBValue(trim($this->f("Valid Images")));
    }
//End SetValues Method

} //End mfi_fileuploadDataSource Class @15-FCB6E20C

class clsRecordmfi_fileuploadSearch { //mfi_fileuploadSearch Class @16-381F8B54

//Variables @16-9E315808

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

//Class_Initialize Event @16-CDBEDF11
    function clsRecordmfi_fileuploadSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_fileuploadSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_fileuploadSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_mfi_territorycode = new clsControl(ccsTextBox, "s_mfi_territorycode", "s_mfi_territorycode", ccsText, "", CCGetRequestParam("s_mfi_territorycode", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @16-CDAB23A9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mfi_territorycode->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mfi_territorycode->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @16-511657F6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mfi_territorycode->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @16-2499A22A
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
        $Redirect = "manageFileUpload_old.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "manageFileUpload_old.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @16-40BC5AA3
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
            $Error = ComposeStrings($Error, $this->s_mfi_territorycode->Errors->ToString());
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
        $this->s_mfi_territorycode->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_fileuploadSearch Class @16-FCB6E20C

//Initialize Page @1-2215978D
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
$TemplateFileName = "manageFileUpload_old.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-5BA3BBF6
include_once("./manageFileUpload_old_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C7A31A62
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$mfi_fileupload1 = new clsRecordmfi_fileupload1("", $MainPage);
$mfi_fileupload = new clsGridmfi_fileupload("", $MainPage);
$mfi_fileuploadSearch = new clsRecordmfi_fileuploadSearch("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$MainPage->mfi_fileupload1 = & $mfi_fileupload1;
$MainPage->mfi_fileupload = & $mfi_fileupload;
$MainPage->mfi_fileuploadSearch = & $mfi_fileuploadSearch;
$mfi_fileupload1->Initialize();
$mfi_fileupload->Initialize();

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

//Execute Components @1-05E8FF8A
$mfi_fileuploadSearch->Operation();
$mfi_fileupload1->Operation();
$incFooter->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-F5A08A33
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incFooter->Class_Terminate();
    unset($incFooter);
    unset($mfi_fileupload1);
    unset($mfi_fileupload);
    unset($mfi_fileuploadSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9782CD05
$incHeader->Show();
$incFooter->Show();
$mfi_fileupload1->Show();
$mfi_fileupload->Show();
$mfi_fileuploadSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-78D9531E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
unset($mfi_fileupload1);
unset($mfi_fileupload);
unset($mfi_fileuploadSearch);
unset($Tpl);
//End Unload Page


?>
