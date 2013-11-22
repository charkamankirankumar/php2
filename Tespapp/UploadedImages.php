<?php
//Include Common Files @1-14801EAE
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "UploadedImages.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

//Include Page implementation @3-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

//Include Page implementation @217-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

class clsEditableGridmfi_doc_upload { //mfi_doc_upload Class @218-3BCBBE4D

//Variables @218-F282A2AF

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;

    // Class variables
    public $Sorter_batch_code;
    public $Sorter_cp_name;
    public $Sorter_cp_id;
    public $Sorter_gp_name;
    public $Sorter_gp_size;
    public $Sorter_gp_code;
    public $Sorter_status;
    public $Sorter_rap_reason;
//End Variables

//Class_Initialize Event @218-BDAD03AC
    function clsEditableGridmfi_doc_upload($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid mfi_doc_upload/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "mfi_doc_upload";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["gp_code"][0] = "gp_code";
        $this->DataSource = new clsmfi_doc_uploadDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 0;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->SorterName = CCGetParam("mfi_doc_uploadOrder", "");
        $this->SorterDirection = CCGetParam("mfi_doc_uploadDir", "");

        $this->Sorter_batch_code = new clsSorter($this->ComponentName, "Sorter_batch_code", $FileName, $this);
        $this->Sorter_cp_name = new clsSorter($this->ComponentName, "Sorter_cp_name", $FileName, $this);
        $this->Sorter_cp_id = new clsSorter($this->ComponentName, "Sorter_cp_id", $FileName, $this);
        $this->Sorter_gp_name = new clsSorter($this->ComponentName, "Sorter_gp_name", $FileName, $this);
        $this->Sorter_gp_size = new clsSorter($this->ComponentName, "Sorter_gp_size", $FileName, $this);
        $this->Sorter_gp_code = new clsSorter($this->ComponentName, "Sorter_gp_code", $FileName, $this);
        $this->Sorter_status = new clsSorter($this->ComponentName, "Sorter_status", $FileName, $this);
        $this->Sorter_rap_reason = new clsSorter($this->ComponentName, "Sorter_rap_reason", $FileName, $this);
        $this->batch_code = new clsControl(ccsLabel, "batch_code", "batch_code", ccsText, "", NULL, $this);
        $this->cp_name = new clsControl(ccsLabel, "cp_name", "cp_name", ccsText, "", NULL, $this);
        $this->cp_id = new clsControl(ccsLabel, "cp_id", "cp_id", ccsText, "", NULL, $this);
        $this->gp_name = new clsControl(ccsLabel, "gp_name", "gp_name", ccsText, "", NULL, $this);
        $this->gp_size = new clsControl(ccsLabel, "gp_size", "gp_size", ccsInteger, "", NULL, $this);
        $this->gp_code = new clsControl(ccsLink, "gp_code", "gp_code", ccsText, "", NULL, $this);
        $this->gp_code->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->status = new clsControl(ccsLabel, "status", "status", ccsInteger, "", NULL, $this);
        $this->rap_reason = new clsControl(ccsTextArea, "rap_reason", $CCSLocales->GetText("rap_reason"), ccsText, "", NULL, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @218-31FD3DD2
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_file_uploaded"] = CCGetFromGet("s_file_uploaded", NULL);
        $this->DataSource->Parameters["urls_gp_code"] = CCGetFromGet("s_gp_code", NULL);
        $this->DataSource->Parameters["urls_batch_code"] = CCGetFromGet("s_batch_code", NULL);
    }
//End Initialize Method

//GetFormParameters Method @218-9A3ABC91
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["rap_reason"][$RowNumber] = CCGetFromPost("rap_reason_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @218-F7B2A59D
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["gp_code"] = $this->CachedColumns["gp_code"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->rap_reason->SetText($this->FormParameters["rap_reason"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                $Validation = ($this->ValidateRow($this->RowNumber) && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @218-0EF1979E
    function ValidateRow()
    {
        global $CCSLocales;
        $this->rap_reason->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->rap_reason->Errors->ToString());
        $this->rap_reason->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @218-6A9F74B9
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["rap_reason"][$this->RowNumber]) && count($this->FormParameters["rap_reason"][$this->RowNumber])) || strlen($this->FormParameters["rap_reason"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @218-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @218-6B923CC2
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @218-17340B8C
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["gp_code"] = $this->CachedColumns["gp_code"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->rap_reason->SetText($this->FormParameters["rap_reason"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->UpdateAllowed) { $Validation = ($this->UpdateRow() && $Validation); }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//UpdateRow Method @218-337D9210
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->batch_code->SetValue($this->batch_code->GetValue(true));
        $this->DataSource->cp_name->SetValue($this->cp_name->GetValue(true));
        $this->DataSource->cp_id->SetValue($this->cp_id->GetValue(true));
        $this->DataSource->gp_name->SetValue($this->gp_name->GetValue(true));
        $this->DataSource->gp_size->SetValue($this->gp_size->GetValue(true));
        $this->DataSource->gp_code->SetValue($this->gp_code->GetValue(true));
        $this->DataSource->status->SetValue($this->status->GetValue(true));
        $this->DataSource->rap_reason->SetValue($this->rap_reason->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//FormScript Method @218-644178B5
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var mfi_doc_uploadElements;\n";
        $script .= "var mfi_doc_uploadEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "rap_reasonID = 0;\n";
        $script .= "\nfunction initmfi_doc_uploadElements() {\n";
        $script .= "\tvar ED = document.forms[\"mfi_doc_upload\"];\n";
        $script .= "\tmfi_doc_uploadElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.rap_reason_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @218-DF80FA6F
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["gp_code"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["gp_code"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @218-C750C77B
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["gp_code"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @218-CD32CFB9
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["batch_code"] = $this->batch_code->Visible;
        $this->ControlsVisible["cp_name"] = $this->cp_name->Visible;
        $this->ControlsVisible["cp_id"] = $this->cp_id->Visible;
        $this->ControlsVisible["gp_name"] = $this->gp_name->Visible;
        $this->ControlsVisible["gp_size"] = $this->gp_size->Visible;
        $this->ControlsVisible["gp_code"] = $this->gp_code->Visible;
        $this->ControlsVisible["status"] = $this->status->Visible;
        $this->ControlsVisible["rap_reason"] = $this->rap_reason->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["gp_code"][$this->RowNumber] = $this->DataSource->CachedColumns["gp_code"];
                    $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
                    $this->cp_name->SetValue($this->DataSource->cp_name->GetValue());
                    $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                    $this->gp_name->SetValue($this->DataSource->gp_name->GetValue());
                    $this->gp_size->SetValue($this->DataSource->gp_size->GetValue());
                    $this->gp_code->SetValue($this->DataSource->gp_code->GetValue());
                    $this->gp_code->Page = $this->DataSource->f("gp_code");
                    $this->status->SetValue($this->DataSource->status->GetValue());
                    $this->rap_reason->SetValue($this->DataSource->rap_reason->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->batch_code->SetText("");
                    $this->cp_name->SetText("");
                    $this->cp_id->SetText("");
                    $this->gp_name->SetText("");
                    $this->gp_size->SetText("");
                    $this->gp_code->SetText("");
                    $this->status->SetText("");
                    $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
                    $this->cp_name->SetValue($this->DataSource->cp_name->GetValue());
                    $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                    $this->gp_name->SetValue($this->DataSource->gp_name->GetValue());
                    $this->gp_size->SetValue($this->DataSource->gp_size->GetValue());
                    $this->gp_code->SetValue($this->DataSource->gp_code->GetValue());
                    $this->gp_code->Page = $this->DataSource->f("gp_code");
                    $this->status->SetValue($this->DataSource->status->GetValue());
                    $this->rap_reason->SetText($this->FormParameters["rap_reason"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["gp_code"][$this->RowNumber] = "";
                    $this->batch_code->SetText("");
                    $this->cp_name->SetText("");
                    $this->cp_id->SetText("");
                    $this->gp_name->SetText("");
                    $this->gp_size->SetText("");
                    $this->gp_code->SetText("");
                    $this->status->SetText("");
                    $this->rap_reason->SetText("");
                } else {
                    $this->batch_code->SetText("");
                    $this->cp_name->SetText("");
                    $this->cp_id->SetText("");
                    $this->gp_name->SetText("");
                    $this->gp_size->SetText("");
                    $this->gp_code->SetText("");
                    $this->status->SetText("");
                    $this->rap_reason->SetText($this->FormParameters["rap_reason"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->batch_code->Show($this->RowNumber);
                $this->cp_name->Show($this->RowNumber);
                $this->cp_id->Show($this->RowNumber);
                $this->gp_name->Show($this->RowNumber);
                $this->gp_size->Show($this->RowNumber);
                $this->gp_code->Show($this->RowNumber);
                $this->status->Show($this->RowNumber);
                $this->rap_reason->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["gp_code"] == $this->CachedColumns["gp_code"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->Sorter_batch_code->Show();
        $this->Sorter_cp_name->Show();
        $this->Sorter_cp_id->Show();
        $this->Sorter_gp_name->Show();
        $this->Sorter_gp_size->Show();
        $this->Sorter_gp_code->Show();
        $this->Sorter_status->Show();
        $this->Sorter_rap_reason->Show();
        $this->Navigator->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_doc_upload Class @218-FCB6E20C

class clsmfi_doc_uploadDataSource extends clsDBmysql_cams_v2 {  //mfi_doc_uploadDataSource Class @218-4E2DB1E5

//DataSource Variables @218-2ECF7955
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $UpdateFields = array();

    // Datasource fields
    public $batch_code;
    public $cp_name;
    public $cp_id;
    public $gp_name;
    public $gp_size;
    public $gp_code;
    public $status;
    public $rap_reason;
//End DataSource Variables

//DataSourceClass_Initialize Event @218-1CA5C10B
    function clsmfi_doc_uploadDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid mfi_doc_upload/Error";
        $this->Initialize();
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->cp_name = new clsField("cp_name", ccsText, "");
        
        $this->cp_id = new clsField("cp_id", ccsText, "");
        
        $this->gp_name = new clsField("gp_name", ccsText, "");
        
        $this->gp_size = new clsField("gp_size", ccsInteger, "");
        
        $this->gp_code = new clsField("gp_code", ccsText, "");
        
        $this->status = new clsField("status", ccsInteger, "");
        
        $this->rap_reason = new clsField("rap_reason", ccsText, "");
        

        $this->UpdateFields["rap_reason"] = array("Name" => "rap_reason", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @218-61C7D1F3
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "gp_code";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_batch_code" => array("batch_code", ""), 
            "Sorter_cp_name" => array("cp_name", ""), 
            "Sorter_cp_id" => array("cp_id", ""), 
            "Sorter_gp_name" => array("gp_name", ""), 
            "Sorter_gp_size" => array("gp_size", ""), 
            "Sorter_gp_code" => array("gp_code", ""), 
            "Sorter_status" => array("status", ""), 
            "Sorter_rap_reason" => array("rap_reason", "")));
    }
//End SetOrder Method

//Prepare Method @218-29DCF310
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urls_file_uploaded", ccsText, "", "", $this->Parameters["urls_file_uploaded"], "", false);
        $this->wp->AddParameter("3", "urls_gp_code", ccsText, "", "", $this->Parameters["urls_gp_code"], "", false);
        $this->wp->AddParameter("4", "urls_batch_code", ccsText, "", "", $this->Parameters["urls_batch_code"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = "( status='PENDING' )";
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "file_uploaded", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "gp_code", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "batch_code", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
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

//Open Method @218-D0994925
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_doc_upload";
        $this->SQL = "SELECT cp_name, cp_id, gp_name, gp_size, gp_code, file_uploaded, rap_reason, status, batch_code \n\n" .
        "FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @218-766F2419
    function SetValues()
    {
        $this->CachedColumns["gp_code"] = $this->f("gp_code");
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->cp_name->SetDBValue($this->f("cp_name"));
        $this->cp_id->SetDBValue($this->f("cp_id"));
        $this->gp_name->SetDBValue($this->f("gp_name"));
        $this->gp_size->SetDBValue(trim($this->f("gp_size")));
        $this->gp_code->SetDBValue($this->f("gp_code"));
        $this->status->SetDBValue(trim($this->f("status")));
        $this->rap_reason->SetDBValue($this->f("rap_reason"));
    }
//End SetValues Method

//Update Method @218-65988A5D
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "gp_code=" . $this->ToSQL($this->CachedColumns["gp_code"], ccsText);
        $this->UpdateFields["rap_reason"]["Value"] = $this->rap_reason->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_doc_upload", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

} //End mfi_doc_uploadDataSource Class @218-FCB6E20C

class clsRecordmfi_doc_uploadSearch { //mfi_doc_uploadSearch Class @257-92DB2FC5

//Variables @257-9E315808

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

//Class_Initialize Event @257-B28A0F38
    function clsRecordmfi_doc_uploadSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_doc_uploadSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_doc_uploadSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_file_uploaded = new clsControl(ccsTextBox, "s_file_uploaded", $CCSLocales->GetText("file_uploaded"), ccsText, "", CCGetRequestParam("s_file_uploaded", $Method, NULL), $this);
            $this->s_gp_code = new clsControl(ccsTextBox, "s_gp_code", $CCSLocales->GetText("gp_code"), ccsText, "", CCGetRequestParam("s_gp_code", $Method, NULL), $this);
            $this->s_batch_code = new clsControl(ccsTextBox, "s_batch_code", $CCSLocales->GetText("batch_code"), ccsText, "", CCGetRequestParam("s_batch_code", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @257-1FC0652B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_file_uploaded->Validate() && $Validation);
        $Validation = ($this->s_gp_code->Validate() && $Validation);
        $Validation = ($this->s_batch_code->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_file_uploaded->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_gp_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_batch_code->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @257-CA70D45C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_file_uploaded->Errors->Count());
        $errors = ($errors || $this->s_gp_code->Errors->Count());
        $errors = ($errors || $this->s_batch_code->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @257-9355207B
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
        $Redirect = "UploadedImages.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "UploadedImages.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @257-11DD70DF
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

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_file_uploaded->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_gp_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_batch_code->Errors->ToString());
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
        $this->s_file_uploaded->Show();
        $this->s_gp_code->Show();
        $this->s_batch_code->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_doc_uploadSearch Class @257-FCB6E20C

//Include Page implementation @2-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Initialize Page @1-5A2C2A39
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
$TemplateFileName = "UploadedImages.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C4806D58
include_once("./UploadedImages_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F6505495
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$PagePanel = new clsPanel("PagePanel", $MainPage);
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$mfi_doc_upload = new clsEditableGridmfi_doc_upload("", $MainPage);
$mfi_doc_uploadSearch = new clsRecordmfi_doc_uploadSearch("", $MainPage);
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$MainPage->incFooter = & $incFooter;
$MainPage->PagePanel = & $PagePanel;
$MainPage->incMenu = & $incMenu;
$MainPage->mfi_doc_upload = & $mfi_doc_upload;
$MainPage->mfi_doc_uploadSearch = & $mfi_doc_uploadSearch;
$MainPage->incHeader = & $incHeader;
$PagePanel->AddComponent("incMenu", $incMenu);
$PagePanel->AddComponent("mfi_doc_upload", $mfi_doc_upload);
$PagePanel->AddComponent("mfi_doc_uploadSearch", $mfi_doc_uploadSearch);
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

//Execute Components @1-235A7D4D
$incHeader->Operations();
$mfi_doc_uploadSearch->Operation();
$mfi_doc_upload->Operation();
$incMenu->Operations();
$incFooter->Operations();
//End Execute Components

//Go to destination page @1-B1C677F0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incFooter->Class_Terminate();
    unset($incFooter);
    $incMenu->Class_Terminate();
    unset($incMenu);
    unset($mfi_doc_upload);
    unset($mfi_doc_uploadSearch);
    $incHeader->Class_Terminate();
    unset($incHeader);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-25FCDEFA
$incFooter->Show();
$incHeader->Show();
$PagePanel->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3C99B425
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
unset($mfi_doc_upload);
unset($mfi_doc_uploadSearch);
$incHeader->Class_Terminate();
unset($incHeader);
unset($Tpl);
//End Unload Page


?>
