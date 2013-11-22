<?php
//Include Common Files @1-E5C15AAB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "DE_FOR_RELOGIN.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmfi_docs { //mfi_docs Class @29-9966F844

//Variables @29-9E315808

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

//Class_Initialize Event @29-E2EF1C9A
    function clsRecordmfi_docs($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_docs/Error";
        $this->DataSource = new clsmfi_docsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_docs";
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
            $this->mfi_doc_id = new clsControl(ccsHidden, "mfi_doc_id", $CCSLocales->GetText("mfi_doc_id"), ccsInteger, "", CCGetRequestParam("mfi_doc_id", $Method, NULL), $this);
            $this->mfi_doc_id->Required = true;
            $this->mfi_doc_filename = new clsControl(ccsHidden, "mfi_doc_filename", $CCSLocales->GetText("mfi_doc_filename"), ccsText, "", CCGetRequestParam("mfi_doc_filename", $Method, NULL), $this);
            $this->mfi_doc_filename->Required = true;
            $this->mfi_doc_path = new clsControl(ccsHidden, "mfi_doc_path", $CCSLocales->GetText("mfi_doc_path"), ccsText, "", CCGetRequestParam("mfi_doc_path", $Method, NULL), $this);
            $this->mfi_doc_type = new clsControl(ccsHidden, "mfi_doc_type", $CCSLocales->GetText("mfi_doc_type"), ccsText, "", CCGetRequestParam("mfi_doc_type", $Method, NULL), $this);
            $this->mfi_doc_region = new clsControl(ccsHidden, "mfi_doc_region", $CCSLocales->GetText("mfi_doc_region"), ccsText, "", CCGetRequestParam("mfi_doc_region", $Method, NULL), $this);
            $this->mfi_doc_region->Required = true;
            $this->mfi_doc_territory_code = new clsControl(ccsHidden, "mfi_doc_territory_code", $CCSLocales->GetText("mfi_doc_territory_code"), ccsText, "", CCGetRequestParam("mfi_doc_territory_code", $Method, NULL), $this);
            $this->mfi_doc_entered_by = new clsControl(ccsHidden, "mfi_doc_entered_by", $CCSLocales->GetText("mfi_doc_entered_by"), ccsText, "", CCGetRequestParam("mfi_doc_entered_by", $Method, NULL), $this);
            $this->mfi_doc_status = new clsControl(ccsHidden, "mfi_doc_status", $CCSLocales->GetText("mfi_doc_status"), ccsText, "", CCGetRequestParam("mfi_doc_status", $Method, NULL), $this);
            $this->mfi_doc_status->Required = true;
            $this->mfi_doc_updatedon = new clsControl(ccsHidden, "mfi_doc_updatedon", $CCSLocales->GetText("mfi_doc_updatedon"), ccsText, "", CCGetRequestParam("mfi_doc_updatedon", $Method, NULL), $this);
            $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", $Method, NULL), $this);
            $this->Label2 = new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", CCGetRequestParam("Label2", $Method, NULL), $this);
            $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", $Method, NULL), $this);
            $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->ImageLink1->Page = "ChangeRegion.php";
        }
    }
//End Class_Initialize Event

//Initialize Method @29-1AD3171D
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Order = "batch_code, mfi_doc_type, mfi_doc_code";

        $this->DataSource->Parameters["expr18"] = TAGGED;
        $this->DataSource->Parameters["cookdocregion"] = CCGetCookie("docregion", NULL);
    }
//End Initialize Method

//Validate Method @29-711913D4
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->mfi_doc_id->Validate() && $Validation);
        $Validation = ($this->mfi_doc_filename->Validate() && $Validation);
        $Validation = ($this->mfi_doc_path->Validate() && $Validation);
        $Validation = ($this->mfi_doc_type->Validate() && $Validation);
        $Validation = ($this->mfi_doc_region->Validate() && $Validation);
        $Validation = ($this->mfi_doc_territory_code->Validate() && $Validation);
        $Validation = ($this->mfi_doc_entered_by->Validate() && $Validation);
        $Validation = ($this->mfi_doc_status->Validate() && $Validation);
        $Validation = ($this->mfi_doc_updatedon->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_doc_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_filename->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_path->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_territory_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_entered_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_updatedon->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @29-B0A23297
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_id->Errors->Count());
        $errors = ($errors || $this->mfi_doc_filename->Errors->Count());
        $errors = ($errors || $this->mfi_doc_path->Errors->Count());
        $errors = ($errors || $this->mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_entered_by->Errors->Count());
        $errors = ($errors || $this->mfi_doc_status->Errors->Count());
        $errors = ($errors || $this->mfi_doc_updatedon->Errors->Count());
        $errors = ($errors || $this->Label1->Errors->Count());
        $errors = ($errors || $this->Label2->Errors->Count());
        $errors = ($errors || $this->ImageLink1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @29-517B5C36
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

//UpdateRow Method @29-B347A2CD
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->mfi_doc_id->SetValue($this->mfi_doc_id->GetValue(true));
        $this->DataSource->mfi_doc_filename->SetValue($this->mfi_doc_filename->GetValue(true));
        $this->DataSource->mfi_doc_path->SetValue($this->mfi_doc_path->GetValue(true));
        $this->DataSource->mfi_doc_type->SetValue($this->mfi_doc_type->GetValue(true));
        $this->DataSource->mfi_doc_region->SetValue($this->mfi_doc_region->GetValue(true));
        $this->DataSource->mfi_doc_territory_code->SetValue($this->mfi_doc_territory_code->GetValue(true));
        $this->DataSource->mfi_doc_entered_by->SetValue($this->mfi_doc_entered_by->GetValue(true));
        $this->DataSource->mfi_doc_status->SetValue($this->mfi_doc_status->GetValue(true));
        $this->DataSource->mfi_doc_updatedon->SetValue($this->mfi_doc_updatedon->GetValue(true));
        $this->DataSource->mfi_doc_id->SetValue($this->mfi_doc_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @29-0BB339C1
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
                    $this->mfi_doc_id->SetValue($this->DataSource->mfi_doc_id->GetValue());
                    $this->mfi_doc_filename->SetValue($this->DataSource->mfi_doc_filename->GetValue());
                    $this->mfi_doc_path->SetValue($this->DataSource->mfi_doc_path->GetValue());
                    $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
                    $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
                    $this->mfi_doc_territory_code->SetValue($this->DataSource->mfi_doc_territory_code->GetValue());
                    $this->mfi_doc_entered_by->SetValue($this->DataSource->mfi_doc_entered_by->GetValue());
                    $this->mfi_doc_status->SetValue($this->DataSource->mfi_doc_status->GetValue());
                    $this->mfi_doc_updatedon->SetValue($this->DataSource->mfi_doc_updatedon->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_doc_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_filename->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_path->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_territory_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_entered_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_updatedon->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ImageLink1->Errors->ToString());
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
        $this->mfi_doc_id->Show();
        $this->mfi_doc_filename->Show();
        $this->mfi_doc_path->Show();
        $this->mfi_doc_type->Show();
        $this->mfi_doc_region->Show();
        $this->mfi_doc_territory_code->Show();
        $this->mfi_doc_entered_by->Show();
        $this->mfi_doc_status->Show();
        $this->mfi_doc_updatedon->Show();
        $this->Label1->Show();
        $this->Label2->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_docs Class @29-FCB6E20C

class clsmfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_docsDataSource Class @29-BC5AABD7

//DataSource Variables @29-5288AAAD
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
    public $mfi_doc_id;
    public $mfi_doc_filename;
    public $mfi_doc_path;
    public $mfi_doc_type;
    public $mfi_doc_region;
    public $mfi_doc_territory_code;
    public $mfi_doc_entered_by;
    public $mfi_doc_status;
    public $mfi_doc_updatedon;
    public $Label1;
    public $Label2;
    public $ImageLink1;
//End DataSource Variables

//DataSourceClass_Initialize Event @29-F62559F5
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_docs/Error";
        $this->Initialize();
        $this->mfi_doc_id = new clsField("mfi_doc_id", ccsInteger, "");
        
        $this->mfi_doc_filename = new clsField("mfi_doc_filename", ccsText, "");
        
        $this->mfi_doc_path = new clsField("mfi_doc_path", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsText, "");
        
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->mfi_doc_territory_code = new clsField("mfi_doc_territory_code", ccsText, "");
        
        $this->mfi_doc_entered_by = new clsField("mfi_doc_entered_by", ccsText, "");
        
        $this->mfi_doc_status = new clsField("mfi_doc_status", ccsText, "");
        
        $this->mfi_doc_updatedon = new clsField("mfi_doc_updatedon", ccsText, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        
        $this->Label2 = new clsField("Label2", ccsText, "");
        
        $this->ImageLink1 = new clsField("ImageLink1", ccsText, "");
        

        $this->UpdateFields["mfi_doc_filename"] = array("Name" => "mfi_doc_filename", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_path"] = array("Name" => "mfi_doc_path", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_type"] = array("Name" => "mfi_doc_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_region"] = array("Name" => "mfi_doc_region", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_territory_code"] = array("Name" => "mfi_doc_territory_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_entered_by"] = array("Name" => "mfi_doc_entered_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_status"] = array("Name" => "mfi_doc_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_updatedon"] = array("Name" => "mfi_doc_updatedon", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_id"] = array("Name" => "mfi_doc_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @29-C5F8A135
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr18", ccsText, "", "", $this->Parameters["expr18"], "", false);
        $this->wp->AddParameter("2", "cookdocregion", ccsText, "", "", $this->Parameters["cookdocregion"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_doc_status", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "mfi_doc_region", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = "( mfi_doc_type not like 'DOC%' )";
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @29-92E33FC2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @29-1C537A83
    function SetValues()
    {
        $this->mfi_doc_id->SetDBValue(trim($this->f("mfi_doc_id")));
        $this->mfi_doc_filename->SetDBValue($this->f("mfi_doc_filename"));
        $this->mfi_doc_path->SetDBValue($this->f("mfi_doc_path"));
        $this->mfi_doc_type->SetDBValue($this->f("mfi_doc_type"));
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->mfi_doc_territory_code->SetDBValue($this->f("mfi_doc_territory_code"));
        $this->mfi_doc_entered_by->SetDBValue($this->f("mfi_doc_entered_by"));
        $this->mfi_doc_status->SetDBValue($this->f("mfi_doc_status"));
        $this->mfi_doc_updatedon->SetDBValue($this->f("mfi_doc_updatedon"));
    }
//End SetValues Method

//Update Method @29-91EEE67F
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["mfi_doc_filename"] = new clsSQLParameter("ctrlmfi_doc_filename", ccsText, "", "", $this->mfi_doc_filename->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_path"] = new clsSQLParameter("ctrlmfi_doc_path", ccsText, "", "", $this->mfi_doc_path->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_type"] = new clsSQLParameter("ctrlmfi_doc_type", ccsText, "", "", $this->mfi_doc_type->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_region"] = new clsSQLParameter("ctrlmfi_doc_region", ccsText, "", "", $this->mfi_doc_region->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_territory_code"] = new clsSQLParameter("ctrlmfi_doc_territory_code", ccsText, "", "", $this->mfi_doc_territory_code->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_entered_by"] = new clsSQLParameter("ctrlmfi_doc_entered_by", ccsText, "", "", $this->mfi_doc_entered_by->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_status"] = new clsSQLParameter("ctrlmfi_doc_status", ccsText, "", "", $this->mfi_doc_status->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_updatedon"] = new clsSQLParameter("ctrlmfi_doc_updatedon", ccsText, "", "", $this->mfi_doc_updatedon->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_id"] = new clsSQLParameter("ctrlmfi_doc_id", ccsInteger, "", "", $this->mfi_doc_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "ctrlmfi_doc_id", ccsInteger, "", "", $this->mfi_doc_id->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["mfi_doc_filename"]->GetValue()) and !strlen($this->cp["mfi_doc_filename"]->GetText()) and !is_bool($this->cp["mfi_doc_filename"]->GetValue())) 
            $this->cp["mfi_doc_filename"]->SetValue($this->mfi_doc_filename->GetValue(true));
        if (!is_null($this->cp["mfi_doc_path"]->GetValue()) and !strlen($this->cp["mfi_doc_path"]->GetText()) and !is_bool($this->cp["mfi_doc_path"]->GetValue())) 
            $this->cp["mfi_doc_path"]->SetValue($this->mfi_doc_path->GetValue(true));
        if (!is_null($this->cp["mfi_doc_type"]->GetValue()) and !strlen($this->cp["mfi_doc_type"]->GetText()) and !is_bool($this->cp["mfi_doc_type"]->GetValue())) 
            $this->cp["mfi_doc_type"]->SetValue($this->mfi_doc_type->GetValue(true));
        if (!is_null($this->cp["mfi_doc_region"]->GetValue()) and !strlen($this->cp["mfi_doc_region"]->GetText()) and !is_bool($this->cp["mfi_doc_region"]->GetValue())) 
            $this->cp["mfi_doc_region"]->SetValue($this->mfi_doc_region->GetValue(true));
        if (!is_null($this->cp["mfi_doc_territory_code"]->GetValue()) and !strlen($this->cp["mfi_doc_territory_code"]->GetText()) and !is_bool($this->cp["mfi_doc_territory_code"]->GetValue())) 
            $this->cp["mfi_doc_territory_code"]->SetValue($this->mfi_doc_territory_code->GetValue(true));
        if (!is_null($this->cp["mfi_doc_entered_by"]->GetValue()) and !strlen($this->cp["mfi_doc_entered_by"]->GetText()) and !is_bool($this->cp["mfi_doc_entered_by"]->GetValue())) 
            $this->cp["mfi_doc_entered_by"]->SetValue($this->mfi_doc_entered_by->GetValue(true));
        if (!is_null($this->cp["mfi_doc_status"]->GetValue()) and !strlen($this->cp["mfi_doc_status"]->GetText()) and !is_bool($this->cp["mfi_doc_status"]->GetValue())) 
            $this->cp["mfi_doc_status"]->SetValue($this->mfi_doc_status->GetValue(true));
        if (!is_null($this->cp["mfi_doc_updatedon"]->GetValue()) and !strlen($this->cp["mfi_doc_updatedon"]->GetText()) and !is_bool($this->cp["mfi_doc_updatedon"]->GetValue())) 
            $this->cp["mfi_doc_updatedon"]->SetValue($this->mfi_doc_updatedon->GetValue(true));
        if (!is_null($this->cp["mfi_doc_id"]->GetValue()) and !strlen($this->cp["mfi_doc_id"]->GetText()) and !is_bool($this->cp["mfi_doc_id"]->GetValue())) 
            $this->cp["mfi_doc_id"]->SetValue($this->mfi_doc_id->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "mfi_doc_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["mfi_doc_filename"]["Value"] = $this->cp["mfi_doc_filename"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_path"]["Value"] = $this->cp["mfi_doc_path"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_type"]["Value"] = $this->cp["mfi_doc_type"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_region"]["Value"] = $this->cp["mfi_doc_region"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_territory_code"]["Value"] = $this->cp["mfi_doc_territory_code"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_entered_by"]["Value"] = $this->cp["mfi_doc_entered_by"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_status"]["Value"] = $this->cp["mfi_doc_status"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_updatedon"]["Value"] = $this->cp["mfi_doc_updatedon"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_id"]["Value"] = $this->cp["mfi_doc_id"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_docs", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End mfi_docsDataSource Class @29-FCB6E20C

//Initialize Page @1-7EC70BAA
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
$TemplateFileName = "DE_FOR_RELOGIN.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Authenticate User @1-BA821CEB
CCSecurityRedirect("SUPER ADMIN;ADMIN;Credit Analyst", "AccessDeniedPage.php");
//End Authenticate User

//Include events file @1-FBB9C27C
include_once("./DE_FOR_RELOGIN_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FE8D5B48
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", ccsGet, NULL), $MainPage);
$ListBox1->DSType = dsTable;
$ListBox1->DataSource = new clsDBmysql_cams_v2();
$ListBox1->ds = & $ListBox1->DataSource;
$ListBox1->DataSource->SQL = "SELECT * \n" .
"FROM mfi_unit_branches {SQL_Where} {SQL_OrderBy}";
list($ListBox1->BoundColumn, $ListBox1->TextColumn, $ListBox1->DBFormat) = array("mfi_unit_code", "mfi_unit_name", "");
$ListBox1->DataSource->Parameters["cookdocregion"] = CCGetCookie("docregion", NULL);
$ListBox1->DataSource->wp = new clsSQLParameters();
$ListBox1->DataSource->wp->AddParameter("1", "cookdocregion", ccsText, "", "", $ListBox1->DataSource->Parameters["cookdocregion"], "", false);
$ListBox1->DataSource->wp->Criterion[1] = $ListBox1->DataSource->wp->Operation(opEqual, "mfi_unit_region_code", $ListBox1->DataSource->wp->GetDBValue("1"), $ListBox1->DataSource->ToSQL($ListBox1->DataSource->wp->GetDBValue("1"), ccsText),false);
$ListBox1->DataSource->Where = 
     $ListBox1->DataSource->wp->Criterion[1];
$ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", ccsGet, NULL), $MainPage);
$ListBox2->DSType = dsListOfValues;
$ListBox2->Values = array(array("RT01", "ROUTE 01"), array("RT02", "ROUTE 02"), array("RT03", "ROUTE 03"), array("RT04", "ROUTE 04"), array("RT05", "ROUTE 05"), array("RT06", "ROUTE 06"));
$mfi_docs = new clsRecordmfi_docs("", $MainPage);
$ListBox3 = new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", ccsGet, NULL), $MainPage);
$ListBox3->DSType = dsListOfValues;
$ListBox3->Values = array(array("CP", "Centre Proposal"), array("GP", "Group Proposal"), array("GLE", "GLE"), array("LA1", "LA FORM1"), array("LA2", "LA FORM 2"), array("HV1", "HV Page 1"), array("HV2", "HV PAGE 2 "), array("INVALID IMAGE", "INVALID IMAGE"), array("ERROR-REJECTION", "ERROR-REJECTION"));
$ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$ImageLink1->Page = "userHome.php";
$MainPage->ListBox1 = & $ListBox1;
$MainPage->ListBox2 = & $ListBox2;
$MainPage->mfi_docs = & $mfi_docs;
$MainPage->ListBox3 = & $ListBox3;
$MainPage->ImageLink1 = & $ImageLink1;
$mfi_docs->Initialize();

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

//Execute Components @1-3B8D96F1
$mfi_docs->Operation();
//End Execute Components

//Go to destination page @1-9D69B6C2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_docs);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E766CFD1
$ListBox1->Prepare();
$ListBox2->Prepare();
$ListBox3->Prepare();
$ListBox1->Show();
$ListBox2->Show();
$mfi_docs->Show();
$ListBox3->Show();
$ImageLink1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4E09D87D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_docs);
unset($Tpl);
//End Unload Page


?>
