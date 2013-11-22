<?php
//Include Common Files @1-5902D8D7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "forms_check.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmfi_doc_upload { //mfi_doc_upload Class @2-F4D00279

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

//Class_Initialize Event @2-A843FD2F
    function clsRecordmfi_doc_upload($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_doc_upload/Error";
        $this->DataSource = new clsmfi_doc_uploadDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_doc_upload";
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
            $this->batch_code = new clsControl(ccsLabel, "batch_code", $CCSLocales->GetText("batch_code"), ccsText, "", CCGetRequestParam("batch_code", $Method, NULL), $this);
            $this->gp_name = new clsControl(ccsLabel, "gp_name", $CCSLocales->GetText("gp_name"), ccsText, "", CCGetRequestParam("gp_name", $Method, NULL), $this);
            $this->gp_size = new clsControl(ccsLabel, "gp_size", $CCSLocales->GetText("gp_size"), ccsInteger, "", CCGetRequestParam("gp_size", $Method, NULL), $this);
            $this->file_type = new clsControl(ccsLabel, "file_type", $CCSLocales->GetText("file_type"), ccsText, "", CCGetRequestParam("file_type", $Method, NULL), $this);
            $this->file_uploaded = new clsControl(ccsLabel, "file_uploaded", $CCSLocales->GetText("file_uploaded"), ccsText, "", CCGetRequestParam("file_uploaded", $Method, NULL), $this);
            $this->file_upload_region = new clsControl(ccsLabel, "file_upload_region", $CCSLocales->GetText("file_upload_region"), ccsText, "", CCGetRequestParam("file_upload_region", $Method, NULL), $this);
            $this->file_upload_branch = new clsControl(ccsLabel, "file_upload_branch", $CCSLocales->GetText("file_upload_branch"), ccsText, "", CCGetRequestParam("file_upload_branch", $Method, NULL), $this);
            $this->qc_check = new clsControl(ccsTextBox, "qc_check", $CCSLocales->GetText("qc_check"), ccsText, "", CCGetRequestParam("qc_check", $Method, NULL), $this);
            $this->qc_check->Required = true;
            $this->qc_check_result = new clsControl(ccsListBox, "qc_check_result", $CCSLocales->GetText("qc_check_result"), ccsText, "", CCGetRequestParam("qc_check_result", $Method, NULL), $this);
            $this->qc_check_result->DSType = dsListOfValues;
            $this->qc_check_result->Values = array(array("SUCCESS", "SUCCESS"), array("ERROR", "ERROR"));
            $this->qc_done_by = new clsControl(ccsHidden, "qc_done_by", "qc_done_by", ccsText, "", CCGetRequestParam("qc_done_by", $Method, NULL), $this);
            $this->qc_done_at = new clsControl(ccsHidden, "qc_done_at", "qc_done_at", ccsText, "", CCGetRequestParam("qc_done_at", $Method, NULL), $this);
            $this->gp_code = new clsControl(ccsTextBox, "gp_code", "gp_code", ccsText, "", CCGetRequestParam("gp_code", $Method, NULL), $this);
            $this->region = new clsControl(ccsHidden, "region", "region", ccsText, "", CCGetRequestParam("region", $Method, NULL), $this);
            $this->file_name = new clsControl(ccsHidden, "file_name", "file_name", ccsText, "", CCGetRequestParam("file_name", $Method, NULL), $this);
            $this->qc_comments = new clsControl(ccsTextArea, "qc_comments", "qc_comments", ccsText, "", CCGetRequestParam("qc_comments", $Method, NULL), $this);
            $this->cp_id = new clsControl(ccsLabel, "cp_id", "cp_id", ccsText, "", CCGetRequestParam("cp_id", $Method, NULL), $this);
            $this->center_name = new clsControl(ccsLabel, "center_name", "center_name", ccsText, "", CCGetRequestParam("center_name", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-B13BA346
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Order = "gp_code";

    }
//End Initialize Method

//Validate Method @2-35B891D7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->qc_check->Validate() && $Validation);
        $Validation = ($this->qc_check_result->Validate() && $Validation);
        $Validation = ($this->qc_done_by->Validate() && $Validation);
        $Validation = ($this->qc_done_at->Validate() && $Validation);
        $Validation = ($this->gp_code->Validate() && $Validation);
        $Validation = ($this->region->Validate() && $Validation);
        $Validation = ($this->file_name->Validate() && $Validation);
        $Validation = ($this->qc_comments->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->qc_check->Errors->Count() == 0);
        $Validation =  $Validation && ($this->qc_check_result->Errors->Count() == 0);
        $Validation =  $Validation && ($this->qc_done_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->qc_done_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gp_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->file_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->qc_comments->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-5CF24C5C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->batch_code->Errors->Count());
        $errors = ($errors || $this->gp_name->Errors->Count());
        $errors = ($errors || $this->gp_size->Errors->Count());
        $errors = ($errors || $this->file_type->Errors->Count());
        $errors = ($errors || $this->file_uploaded->Errors->Count());
        $errors = ($errors || $this->file_upload_region->Errors->Count());
        $errors = ($errors || $this->file_upload_branch->Errors->Count());
        $errors = ($errors || $this->qc_check->Errors->Count());
        $errors = ($errors || $this->qc_check_result->Errors->Count());
        $errors = ($errors || $this->qc_done_by->Errors->Count());
        $errors = ($errors || $this->qc_done_at->Errors->Count());
        $errors = ($errors || $this->gp_code->Errors->Count());
        $errors = ($errors || $this->region->Errors->Count());
        $errors = ($errors || $this->file_name->Errors->Count());
        $errors = ($errors || $this->qc_comments->Errors->Count());
        $errors = ($errors || $this->cp_id->Errors->Count());
        $errors = ($errors || $this->center_name->Errors->Count());
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

//UpdateRow Method @2-A6DCB73B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->gp_code->SetValue($this->gp_code->GetValue(true));
        $this->DataSource->qc_check->SetValue($this->qc_check->GetValue(true));
        $this->DataSource->qc_check_result->SetValue($this->qc_check_result->GetValue(true));
        $this->DataSource->qc_done_at->SetValue($this->qc_done_at->GetValue(true));
        $this->DataSource->qc_done_by->SetValue($this->qc_done_by->GetValue(true));
        $this->DataSource->qc_comments->SetValue($this->qc_comments->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-FE0C8F13
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

        $this->qc_check_result->Prepare();

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
                $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
                $this->gp_name->SetValue($this->DataSource->gp_name->GetValue());
                $this->gp_size->SetValue($this->DataSource->gp_size->GetValue());
                $this->file_type->SetValue($this->DataSource->file_type->GetValue());
                $this->file_uploaded->SetValue($this->DataSource->file_uploaded->GetValue());
                $this->file_upload_region->SetValue($this->DataSource->file_upload_region->GetValue());
                $this->file_upload_branch->SetValue($this->DataSource->file_upload_branch->GetValue());
                $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                $this->center_name->SetValue($this->DataSource->center_name->GetValue());
                if(!$this->FormSubmitted){
                    $this->qc_check->SetValue($this->DataSource->qc_check->GetValue());
                    $this->qc_check_result->SetValue($this->DataSource->qc_check_result->GetValue());
                    $this->gp_code->SetValue($this->DataSource->gp_code->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->batch_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gp_size->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_uploaded->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_upload_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_upload_branch->Errors->ToString());
            $Error = ComposeStrings($Error, $this->qc_check->Errors->ToString());
            $Error = ComposeStrings($Error, $this->qc_check_result->Errors->ToString());
            $Error = ComposeStrings($Error, $this->qc_done_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->qc_done_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gp_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->qc_comments->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->batch_code->Show();
        $this->gp_name->Show();
        $this->gp_size->Show();
        $this->file_type->Show();
        $this->file_uploaded->Show();
        $this->file_upload_region->Show();
        $this->file_upload_branch->Show();
        $this->qc_check->Show();
        $this->qc_check_result->Show();
        $this->qc_done_by->Show();
        $this->qc_done_at->Show();
        $this->gp_code->Show();
        $this->region->Show();
        $this->file_name->Show();
        $this->qc_comments->Show();
        $this->cp_id->Show();
        $this->center_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_doc_upload Class @2-FCB6E20C

class clsmfi_doc_uploadDataSource extends clsDBmysql_cams_v2 {  //mfi_doc_uploadDataSource Class @2-4E2DB1E5

//DataSource Variables @2-96F19DE6
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
    public $batch_code;
    public $gp_name;
    public $gp_size;
    public $file_type;
    public $file_uploaded;
    public $file_upload_region;
    public $file_upload_branch;
    public $qc_check;
    public $qc_check_result;
    public $qc_done_by;
    public $qc_done_at;
    public $gp_code;
    public $region;
    public $file_name;
    public $qc_comments;
    public $cp_id;
    public $center_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6EF9F73D
    function clsmfi_doc_uploadDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_doc_upload/Error";
        $this->Initialize();
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->gp_name = new clsField("gp_name", ccsText, "");
        
        $this->gp_size = new clsField("gp_size", ccsInteger, "");
        
        $this->file_type = new clsField("file_type", ccsText, "");
        
        $this->file_uploaded = new clsField("file_uploaded", ccsText, "");
        
        $this->file_upload_region = new clsField("file_upload_region", ccsText, "");
        
        $this->file_upload_branch = new clsField("file_upload_branch", ccsText, "");
        
        $this->qc_check = new clsField("qc_check", ccsText, "");
        
        $this->qc_check_result = new clsField("qc_check_result", ccsText, "");
        
        $this->qc_done_by = new clsField("qc_done_by", ccsText, "");
        
        $this->qc_done_at = new clsField("qc_done_at", ccsText, "");
        
        $this->gp_code = new clsField("gp_code", ccsText, "");
        
        $this->region = new clsField("region", ccsText, "");
        
        $this->file_name = new clsField("file_name", ccsText, "");
        
        $this->qc_comments = new clsField("qc_comments", ccsText, "");
        
        $this->cp_id = new clsField("cp_id", ccsText, "");
        
        $this->center_name = new clsField("center_name", ccsText, "");
        

        $this->UpdateFields["qc_check"] = array("Name" => "qc_check", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["qc_check_result"] = array("Name" => "qc_check_result", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["qc_done_at"] = array("Name" => "qc_done_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["qc_done_by"] = array("Name" => "qc_done_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["qc_comment"] = array("Name" => "qc_comment", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-07578EF8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = "( qc_check like 'PENDING' )";
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-6AFE61EB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT *, gp_code \n\n" .
        "FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B1F89A16
    function SetValues()
    {
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->gp_name->SetDBValue($this->f("gp_name"));
        $this->gp_size->SetDBValue(trim($this->f("gp_size")));
        $this->file_type->SetDBValue($this->f("file_type"));
        $this->file_uploaded->SetDBValue($this->f("file_uploaded"));
        $this->file_upload_region->SetDBValue($this->f("file_upload_region"));
        $this->file_upload_branch->SetDBValue($this->f("file_upload_branch"));
        $this->qc_check->SetDBValue($this->f("qc_check"));
        $this->qc_check_result->SetDBValue($this->f("qc_check_result"));
        $this->gp_code->SetDBValue($this->f("gp_code"));
        $this->cp_id->SetDBValue($this->f("cp_id"));
        $this->center_name->SetDBValue($this->f("cp_name"));
    }
//End SetValues Method

//Update Method @2-68329B7B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["qc_check"] = new clsSQLParameter("ctrlqc_check", ccsText, "", "", $this->qc_check->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["qc_check_result"] = new clsSQLParameter("ctrlqc_check_result", ccsText, "", "", $this->qc_check_result->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["qc_done_at"] = new clsSQLParameter("ctrlqc_done_at", ccsText, "", "", $this->qc_done_at->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["qc_done_by"] = new clsSQLParameter("ctrlqc_done_by", ccsText, "", "", $this->qc_done_by->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["qc_comment"] = new clsSQLParameter("ctrlqc_comments", ccsText, "", "", $this->qc_comments->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "ctrlgp_code", ccsText, "", "", $this->gp_code->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["qc_check"]->GetValue()) and !strlen($this->cp["qc_check"]->GetText()) and !is_bool($this->cp["qc_check"]->GetValue())) 
            $this->cp["qc_check"]->SetValue($this->qc_check->GetValue(true));
        if (!is_null($this->cp["qc_check_result"]->GetValue()) and !strlen($this->cp["qc_check_result"]->GetText()) and !is_bool($this->cp["qc_check_result"]->GetValue())) 
            $this->cp["qc_check_result"]->SetValue($this->qc_check_result->GetValue(true));
        if (!is_null($this->cp["qc_done_at"]->GetValue()) and !strlen($this->cp["qc_done_at"]->GetText()) and !is_bool($this->cp["qc_done_at"]->GetValue())) 
            $this->cp["qc_done_at"]->SetValue($this->qc_done_at->GetValue(true));
        if (!is_null($this->cp["qc_done_by"]->GetValue()) and !strlen($this->cp["qc_done_by"]->GetText()) and !is_bool($this->cp["qc_done_by"]->GetValue())) 
            $this->cp["qc_done_by"]->SetValue($this->qc_done_by->GetValue(true));
        if (!is_null($this->cp["qc_comment"]->GetValue()) and !strlen($this->cp["qc_comment"]->GetText()) and !is_bool($this->cp["qc_comment"]->GetValue())) 
            $this->cp["qc_comment"]->SetValue($this->qc_comments->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "gp_code", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsText),false);
        $wp->Criterion[2] = "( qc_check like 'PENDING' )";
        $Where = $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]);
        $this->UpdateFields["qc_check"]["Value"] = $this->cp["qc_check"]->GetDBValue(true);
        $this->UpdateFields["qc_check_result"]["Value"] = $this->cp["qc_check_result"]->GetDBValue(true);
        $this->UpdateFields["qc_done_at"]["Value"] = $this->cp["qc_done_at"]->GetDBValue(true);
        $this->UpdateFields["qc_done_by"]["Value"] = $this->cp["qc_done_by"]->GetDBValue(true);
        $this->UpdateFields["qc_comment"]["Value"] = $this->cp["qc_comment"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_doc_upload", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End mfi_doc_uploadDataSource Class @2-FCB6E20C

//Include Page implementation @53-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Initialize Page @1-2D0BC2DC
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
$TemplateFileName = "forms_check.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-46450650
include_once("./forms_check_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-AE384473
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_doc_upload = new clsRecordmfi_doc_upload("", $MainPage);
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$MainPage->mfi_doc_upload = & $mfi_doc_upload;
$MainPage->incHeader = & $incHeader;
$mfi_doc_upload->Initialize();

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

//Execute Components @1-E1C81E9E
$incHeader->Operations();
$mfi_doc_upload->Operation();
//End Execute Components

//Go to destination page @1-DC371A36
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_doc_upload);
    $incHeader->Class_Terminate();
    unset($incHeader);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3EC904C2
$mfi_doc_upload->Show();
$incHeader->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-DDB1BF3F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_doc_upload);
$incHeader->Class_Terminate();
unset($incHeader);
unset($Tpl);
//End Unload Page


?>
