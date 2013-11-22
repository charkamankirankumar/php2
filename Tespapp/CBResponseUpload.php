<?php
//Include Common Files @1-AD2764A7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "CBResponseUpload.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
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

//Class_Initialize Event @41-6424688C
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
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->mfi_uploaded_by = new clsControl(ccsHidden, "mfi_uploaded_by", "mfi_uploaded_by", ccsText, "", CCGetRequestParam("mfi_uploaded_by", $Method, NULL), $this);
            $this->file_name = new clsControl(ccsHidden, "file_name", "file_name", ccsText, "", CCGetRequestParam("file_name", $Method, NULL), $this);
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

//Validate Method @41-83094657
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->mfi_uploaded_by->Validate() && $Validation);
        $Validation = ($this->file_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_uploaded_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->file_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @41-D00F9BC2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_uploaded_by->Errors->Count());
        $errors = ($errors || $this->file_name->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @41-EFC50250
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
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @41-5BD971EB
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->mfi_uploaded_by->SetValue($this->mfi_uploaded_by->GetValue(true));
        $this->DataSource->file_name->SetValue($this->file_name->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @41-AAC8A951
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
                    $this->mfi_uploaded_by->SetValue($this->DataSource->mfi_uploaded_by->GetValue());
                    $this->file_name->SetValue($this->DataSource->file_name->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_uploaded_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_name->Errors->ToString());
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
        $this->mfi_uploaded_by->Show();
        $this->file_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_fileupload1 Class @41-FCB6E20C

class clsmfi_fileupload1DataSource extends clsDBmysql_cams_v2 {  //mfi_fileupload1DataSource Class @41-55C3650A

//DataSource Variables @41-6D0C78D2
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
    public $mfi_uploaded_by;
    public $file_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @41-FCEACF87
    function clsmfi_fileupload1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_fileupload1/Error";
        $this->Initialize();
        $this->mfi_uploaded_by = new clsField("mfi_uploaded_by", ccsText, "");
        
        $this->file_name = new clsField("file_name", ccsText, "");
        

        $this->InsertFields["mfi_uploaded_by"] = array("Name" => "mfi_uploaded_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_file_name"] = array("Name" => "mfi_file_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @41-8D63A7C0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM cb_response_upload {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @41-A3EE378E
    function SetValues()
    {
        $this->mfi_uploaded_by->SetDBValue($this->f("mfi_uploaded_by"));
        $this->file_name->SetDBValue($this->f("mfi_file_name"));
    }
//End SetValues Method

//Insert Method @41-EAEB2E53
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["mfi_uploaded_by"]["Value"] = $this->mfi_uploaded_by->GetDBValue(true);
        $this->InsertFields["mfi_file_name"]["Value"] = $this->file_name->GetDBValue(true);
        $this->SQL = CCBuildInsert("cb_response_upload", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End mfi_fileupload1DataSource Class @41-FCB6E20C



//Include Page implementation @60-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

class clsRecordcb_response_uploadSearch { //cb_response_uploadSearch Class @71-1E84B295

//Variables @71-9E315808

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

//Class_Initialize Event @71-46773146
    function clsRecordcb_response_uploadSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record cb_response_uploadSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "cb_response_uploadSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_mfi_file_name = new clsControl(ccsTextBox, "s_mfi_file_name", "s_mfi_file_name", ccsText, "", CCGetRequestParam("s_mfi_file_name", $Method, NULL), $this);
            $this->s_mfi_uploaded_by = new clsControl(ccsTextBox, "s_mfi_uploaded_by", "s_mfi_uploaded_by", ccsText, "", CCGetRequestParam("s_mfi_uploaded_by", $Method, NULL), $this);
            $this->s_mfi_uploaded_on = new clsControl(ccsTextBox, "s_mfi_uploaded_on", "s_mfi_uploaded_on", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_mfi_uploaded_on", $Method, NULL), $this);
            $this->DatePicker_s_mfi_uploaded_on = new clsDatePicker("DatePicker_s_mfi_uploaded_on", "cb_response_uploadSearch", "s_mfi_uploaded_on", $this);
            $this->s_cb_analysis_status = new clsControl(ccsTextBox, "s_cb_analysis_status", "s_cb_analysis_status", ccsText, "", CCGetRequestParam("s_cb_analysis_status", $Method, NULL), $this);
            $this->cb_response_uploadOrder = new clsControl(ccsListBox, "cb_response_uploadOrder", "cb_response_uploadOrder", ccsText, "", CCGetRequestParam("cb_response_uploadOrder", $Method, NULL), $this);
            $this->cb_response_uploadOrder->DSType = dsListOfValues;
            $this->cb_response_uploadOrder->Values = array(array("", $CCSLocales->GetText("CCS_SelectField")), array("Sorter_mfi_file_name", $CCSLocales->GetText("mfi_file_name")), array("Sorter_mfi_territorycode", $CCSLocales->GetText("mfi_territorycode")), array("Sorter_mfi_uploaded_by", $CCSLocales->GetText("mfi_uploaded_by")), array("Sorter_mfi_uploaded_on", $CCSLocales->GetText("mfi_uploaded_on")), array("Sorter_cb_analysis_status", $CCSLocales->GetText("cb_analysis_status")));
            $this->cb_response_uploadDir = new clsControl(ccsListBox, "cb_response_uploadDir", "cb_response_uploadDir", ccsText, "", CCGetRequestParam("cb_response_uploadDir", $Method, NULL), $this);
            $this->cb_response_uploadDir->DSType = dsListOfValues;
            $this->cb_response_uploadDir->Values = array(array("", $CCSLocales->GetText("CCS_SelectOrder")), array("ASC", $CCSLocales->GetText("CCS_ASC")), array("DESC", $CCSLocales->GetText("CCS_DESC")));
            $this->cb_response_uploadPageSize = new clsControl(ccsListBox, "cb_response_uploadPageSize", "cb_response_uploadPageSize", ccsText, "", CCGetRequestParam("cb_response_uploadPageSize", $Method, NULL), $this);
            $this->cb_response_uploadPageSize->DSType = dsListOfValues;
            $this->cb_response_uploadPageSize->Values = array(array("", $CCSLocales->GetText("CCS_SelectValue")), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
        }
    }
//End Class_Initialize Event

//Validate Method @71-5121999D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mfi_file_name->Validate() && $Validation);
        $Validation = ($this->s_mfi_uploaded_by->Validate() && $Validation);
        $Validation = ($this->s_mfi_uploaded_on->Validate() && $Validation);
        $Validation = ($this->s_cb_analysis_status->Validate() && $Validation);
        $Validation = ($this->cb_response_uploadOrder->Validate() && $Validation);
        $Validation = ($this->cb_response_uploadDir->Validate() && $Validation);
        $Validation = ($this->cb_response_uploadPageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mfi_file_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_uploaded_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_uploaded_on->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_cb_analysis_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cb_response_uploadOrder->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cb_response_uploadDir->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cb_response_uploadPageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @71-4BC61B88
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mfi_file_name->Errors->Count());
        $errors = ($errors || $this->s_mfi_uploaded_by->Errors->Count());
        $errors = ($errors || $this->s_mfi_uploaded_on->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_mfi_uploaded_on->Errors->Count());
        $errors = ($errors || $this->s_cb_analysis_status->Errors->Count());
        $errors = ($errors || $this->cb_response_uploadOrder->Errors->Count());
        $errors = ($errors || $this->cb_response_uploadDir->Errors->Count());
        $errors = ($errors || $this->cb_response_uploadPageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @71-8ED36F56
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
        $Redirect = "CBResponseUpload.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "CBResponseUpload.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @71-4E34DEAE
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

        $this->cb_response_uploadOrder->Prepare();
        $this->cb_response_uploadDir->Prepare();
        $this->cb_response_uploadPageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_mfi_file_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_uploaded_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_uploaded_on->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_mfi_uploaded_on->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_cb_analysis_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cb_response_uploadOrder->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cb_response_uploadDir->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cb_response_uploadPageSize->Errors->ToString());
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
        $this->s_mfi_file_name->Show();
        $this->s_mfi_uploaded_by->Show();
        $this->s_mfi_uploaded_on->Show();
        $this->DatePicker_s_mfi_uploaded_on->Show();
        $this->s_cb_analysis_status->Show();
        $this->cb_response_uploadOrder->Show();
        $this->cb_response_uploadDir->Show();
        $this->cb_response_uploadPageSize->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End cb_response_uploadSearch Class @71-FCB6E20C

class clsGridcb_response_upload { //cb_response_upload class @70-DD003B96

//Variables @70-053E481A

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
    public $Sorter_mfi_file_name;
    public $Sorter_mfi_territorycode;
    public $Sorter_mfi_uploaded_by;
    public $Sorter_mfi_uploaded_on;
    public $Sorter_cb_analysis_status;
//End Variables

//Class_Initialize Event @70-A7ABECAE
    function clsGridcb_response_upload($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "cb_response_upload";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid cb_response_upload";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscb_response_uploadDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("cb_response_uploadOrder", "");
        $this->SorterDirection = CCGetParam("cb_response_uploadDir", "");

        $this->mfi_file_name = new clsControl(ccsLabel, "mfi_file_name", "mfi_file_name", ccsText, "", CCGetRequestParam("mfi_file_name", ccsGet, NULL), $this);
        $this->response_count = new clsControl(ccsLabel, "response_count", "response_count", ccsText, "", CCGetRequestParam("response_count", ccsGet, NULL), $this);
        $this->mfi_uploaded_by = new clsControl(ccsLabel, "mfi_uploaded_by", "mfi_uploaded_by", ccsText, "", CCGetRequestParam("mfi_uploaded_by", ccsGet, NULL), $this);
        $this->mfi_uploaded_on = new clsControl(ccsLabel, "mfi_uploaded_on", "mfi_uploaded_on", ccsText, "", CCGetRequestParam("mfi_uploaded_on", ccsGet, NULL), $this);
        $this->cb_analysis_status = new clsControl(ccsLabel, "cb_analysis_status", "cb_analysis_status", ccsText, "", CCGetRequestParam("cb_analysis_status", ccsGet, NULL), $this);
        $this->cb_analysis = new clsButton("cb_analysis", ccsGet, $this);
        $this->report_cnt = new clsControl(ccsLabel, "report_cnt", "report_cnt", ccsText, "", CCGetRequestParam("report_cnt", ccsGet, NULL), $this);
        $this->cb_response_upload_TotalRecords = new clsControl(ccsLabel, "cb_response_upload_TotalRecords", "cb_response_upload_TotalRecords", ccsText, "", CCGetRequestParam("cb_response_upload_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_mfi_file_name = new clsSorter($this->ComponentName, "Sorter_mfi_file_name", $FileName, $this);
        $this->Sorter_mfi_territorycode = new clsSorter($this->ComponentName, "Sorter_mfi_territorycode", $FileName, $this);
        $this->Sorter_mfi_uploaded_by = new clsSorter($this->ComponentName, "Sorter_mfi_uploaded_by", $FileName, $this);
        $this->Sorter_mfi_uploaded_on = new clsSorter($this->ComponentName, "Sorter_mfi_uploaded_on", $FileName, $this);
        $this->Sorter_cb_analysis_status = new clsSorter($this->ComponentName, "Sorter_cb_analysis_status", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @70-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @70-F5767763
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_mfi_file_name"] = CCGetFromGet("s_mfi_file_name", NULL);
        $this->DataSource->Parameters["urls_mfi_uploaded_by"] = CCGetFromGet("s_mfi_uploaded_by", NULL);
        $this->DataSource->Parameters["urls_mfi_uploaded_on"] = CCGetFromGet("s_mfi_uploaded_on", NULL);
        $this->DataSource->Parameters["urls_cb_analysis_status"] = CCGetFromGet("s_cb_analysis_status", NULL);

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
            $this->ControlsVisible["mfi_file_name"] = $this->mfi_file_name->Visible;
            $this->ControlsVisible["response_count"] = $this->response_count->Visible;
            $this->ControlsVisible["mfi_uploaded_by"] = $this->mfi_uploaded_by->Visible;
            $this->ControlsVisible["mfi_uploaded_on"] = $this->mfi_uploaded_on->Visible;
            $this->ControlsVisible["cb_analysis_status"] = $this->cb_analysis_status->Visible;
            $this->ControlsVisible["cb_analysis"] = $this->cb_analysis->Visible;
            $this->ControlsVisible["report_cnt"] = $this->report_cnt->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mfi_file_name->SetValue($this->DataSource->mfi_file_name->GetValue());
                $this->response_count->SetValue($this->DataSource->response_count->GetValue());
                $this->mfi_uploaded_by->SetValue($this->DataSource->mfi_uploaded_by->GetValue());
                $this->mfi_uploaded_on->SetValue($this->DataSource->mfi_uploaded_on->GetValue());
                $this->cb_analysis_status->SetValue($this->DataSource->cb_analysis_status->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_file_name->Show();
                $this->response_count->Show();
                $this->mfi_uploaded_by->Show();
                $this->mfi_uploaded_on->Show();
                $this->cb_analysis_status->Show();
                $this->cb_analysis->Show();
                $this->report_cnt->Show();
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
        $this->cb_response_upload_TotalRecords->Show();
        $this->Sorter_mfi_file_name->Show();
        $this->Sorter_mfi_territorycode->Show();
        $this->Sorter_mfi_uploaded_by->Show();
        $this->Sorter_mfi_uploaded_on->Show();
        $this->Sorter_cb_analysis_status->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @70-A2DD6B57
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_file_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->response_count->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_uploaded_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_uploaded_on->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cb_analysis_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->report_cnt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End cb_response_upload Class @70-FCB6E20C

class clscb_response_uploadDataSource extends clsDBmysql_cams_v2 {  //cb_response_uploadDataSource Class @70-3EB7F4BF

//DataSource Variables @70-EFA7E08C
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_file_name;
    public $response_count;
    public $mfi_uploaded_by;
    public $mfi_uploaded_on;
    public $cb_analysis_status;
//End DataSource Variables

//DataSourceClass_Initialize Event @70-080F5102
    function clscb_response_uploadDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid cb_response_upload";
        $this->Initialize();
        $this->mfi_file_name = new clsField("mfi_file_name", ccsText, "");
        
        $this->response_count = new clsField("response_count", ccsText, "");
        
        $this->mfi_uploaded_by = new clsField("mfi_uploaded_by", ccsText, "");
        
        $this->mfi_uploaded_on = new clsField("mfi_uploaded_on", ccsText, "");
        
        $this->cb_analysis_status = new clsField("cb_analysis_status", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @70-105C5F2D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "uploaded_at desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mfi_file_name" => array("mfi_file_name", ""), 
            "Sorter_mfi_territorycode" => array("`REPORT-DATE`", ""), 
            "Sorter_mfi_uploaded_by" => array("mfi_uploaded_by", ""), 
            "Sorter_mfi_uploaded_on" => array("mfi_uploaded_on", ""), 
            "Sorter_cb_analysis_status" => array("cb_analysis_status", "")));
    }
//End SetOrder Method

//Prepare Method @70-19C3F983
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_mfi_file_name", ccsText, "", "", $this->Parameters["urls_mfi_file_name"], "", false);
        $this->wp->AddParameter("2", "urls_mfi_uploaded_by", ccsText, "", "", $this->Parameters["urls_mfi_uploaded_by"], "", false);
        $this->wp->AddParameter("3", "urls_mfi_uploaded_on", ccsText, "", "", $this->Parameters["urls_mfi_uploaded_on"], "", false);
        $this->wp->AddParameter("4", "urls_cb_analysis_status", ccsText, "", "", $this->Parameters["urls_cb_analysis_status"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "`FILE-NAME`", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "uploaded_by", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "uploaded_at", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "status", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @70-E25601F2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM overlap_header";
        $this->SQL = "SELECT * \n\n" .
        "FROM overlap_header {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @70-A0AD0C41
    function SetValues()
    {
        $this->mfi_file_name->SetDBValue($this->f("FILE-NAME"));
        $this->response_count->SetDBValue($this->f("RESPONSE-CNT-FILE"));
        $this->mfi_uploaded_by->SetDBValue($this->f("uploaded_by"));
        $this->mfi_uploaded_on->SetDBValue($this->f("uploaded_at"));
        $this->cb_analysis_status->SetDBValue($this->f("status"));
    }
//End SetValues Method

} //End cb_response_uploadDataSource Class @70-FCB6E20C





//Initialize Page @1-2F479609
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
$TemplateFileName = "CBResponseUpload.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-1B205082
include_once("./CBResponseUpload_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E59D824A
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
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$cb_response_uploadSearch = new clsRecordcb_response_uploadSearch("", $MainPage);
$cb_response_upload = new clsGridcb_response_upload("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$MainPage->mfi_fileupload1 = & $mfi_fileupload1;
$MainPage->incMenu = & $incMenu;
$MainPage->cb_response_uploadSearch = & $cb_response_uploadSearch;
$MainPage->cb_response_upload = & $cb_response_upload;
$mfi_fileupload1->Initialize();
$cb_response_upload->Initialize();

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

//Execute Components @1-5462852B
$cb_response_uploadSearch->Operation();
$incMenu->Operations();
$mfi_fileupload1->Operation();
$incFooter->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-4AD821C1
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
    $incMenu->Class_Terminate();
    unset($incMenu);
    unset($cb_response_uploadSearch);
    unset($cb_response_upload);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3EF0B024
$incHeader->Show();
$incFooter->Show();
$mfi_fileupload1->Show();
$incMenu->Show();
$cb_response_uploadSearch->Show();
$cb_response_upload->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-40500411
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
unset($mfi_fileupload1);
$incMenu->Class_Terminate();
unset($incMenu);
unset($cb_response_uploadSearch);
unset($cb_response_upload);
unset($Tpl);
//End Unload Page


?>
