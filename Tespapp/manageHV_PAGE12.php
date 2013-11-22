<?php
//Include Common Files @1-E7A74090
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "manageHV_PAGE12.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-05EE5DFD
include_once(RelativePath . "/incHeader.php");
//End Include Page implementation

//Include Page implementation @3-60E713C2
include_once(RelativePath . "/incFooter.php");
//End Include Page implementation

//Include Page implementation @4-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

class clsEditableGridmfi_hvf1 { //mfi_hvf1 Class @14-2DB134D8

//Variables @14-44663CC7

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
    public $Sorter_HV_No;
    public $Sorter_CP_No_1;
    public $Sorter_CENTRE_NAME;
    public $Sorter_GP_No_1;
    public $Sorter_GROUP_NAME;
    public $Sorter_SHG_NAME;
    public $Sorter_SHG_COUNT;
    public $Sorter_BORROWER_NAME;
    public $Sorter_BORROWER_FATHER;
//End Variables

//Class_Initialize Event @14-5F1B456F
    function clsEditableGridmfi_hvf1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid mfi_hvf1/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "mfi_hvf1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["la_id"][0] = "la_id";
        $this->DataSource = new clsmfi_hvf1DataSource($this);
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

        $this->SorterName = CCGetParam("mfi_hvf1Order", "");
        $this->SorterDirection = CCGetParam("mfi_hvf1Dir", "");

        $this->Sorter_HV_No = new clsSorter($this->ComponentName, "Sorter_HV_No", $FileName, $this);
        $this->Sorter_CP_No_1 = new clsSorter($this->ComponentName, "Sorter_CP_No_1", $FileName, $this);
        $this->Sorter_CENTRE_NAME = new clsSorter($this->ComponentName, "Sorter_CENTRE_NAME", $FileName, $this);
        $this->Sorter_GP_No_1 = new clsSorter($this->ComponentName, "Sorter_GP_No_1", $FileName, $this);
        $this->Sorter_GROUP_NAME = new clsSorter($this->ComponentName, "Sorter_GROUP_NAME", $FileName, $this);
        $this->Sorter_SHG_NAME = new clsSorter($this->ComponentName, "Sorter_SHG_NAME", $FileName, $this);
        $this->Sorter_SHG_COUNT = new clsSorter($this->ComponentName, "Sorter_SHG_COUNT", $FileName, $this);
        $this->Sorter_BORROWER_NAME = new clsSorter($this->ComponentName, "Sorter_BORROWER_NAME", $FileName, $this);
        $this->Sorter_BORROWER_FATHER = new clsSorter($this->ComponentName, "Sorter_BORROWER_FATHER", $FileName, $this);
        $this->HV_No = new clsControl(ccsTextBox, "HV_No", "HV No", ccsText, "", NULL, $this);
        $this->HV_No->Required = true;
        $this->GP_No = new clsControl(ccsTextBox, "GP_No", "GP No ", ccsText, "", NULL, $this);
        $this->GP_No->Required = true;
        $this->BORROWER_NAME = new clsControl(ccsTextBox, "BORROWER_NAME", "BORROWER NAME", ccsText, "", NULL, $this);
        $this->BORROWER_NAME->Required = true;
        $this->BORROWER_FATHER = new clsControl(ccsTextBox, "BORROWER_FATHER", "BORROWER FATHER", ccsText, "", NULL, $this);
        $this->BORROWER_FATHER->Required = true;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @14-2B6ABE1B
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_GP_No"] = CCGetFromGet("s_GP_No", NULL);
        $this->DataSource->Parameters["urls_HV_No"] = CCGetFromGet("s_HV_No", NULL);
        $this->DataSource->Parameters["urlentered_by"] = CCGetFromGet("entered_by", NULL);
        $this->DataSource->Parameters["urlentered_at"] = CCGetFromGet("entered_at", NULL);
    }
//End Initialize Method

//GetFormParameters Method @14-DEBD4BAB
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["HV_No"][$RowNumber] = CCGetFromPost("HV_No_" . $RowNumber, NULL);
            $this->FormParameters["GP_No"][$RowNumber] = CCGetFromPost("GP_No_" . $RowNumber, NULL);
            $this->FormParameters["BORROWER_NAME"][$RowNumber] = CCGetFromPost("BORROWER_NAME_" . $RowNumber, NULL);
            $this->FormParameters["BORROWER_FATHER"][$RowNumber] = CCGetFromPost("BORROWER_FATHER_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @14-E8DF91A1
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["la_id"] = $this->CachedColumns["la_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->HV_No->SetText($this->FormParameters["HV_No"][$this->RowNumber], $this->RowNumber);
            $this->GP_No->SetText($this->FormParameters["GP_No"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_NAME->SetText($this->FormParameters["BORROWER_NAME"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_FATHER->SetText($this->FormParameters["BORROWER_FATHER"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @14-5DA98F0F
    function ValidateRow()
    {
        global $CCSLocales;
        $this->HV_No->Validate();
        $this->GP_No->Validate();
        $this->BORROWER_NAME->Validate();
        $this->BORROWER_FATHER->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->HV_No->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GP_No->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_FATHER->Errors->ToString());
        $this->HV_No->Errors->Clear();
        $this->GP_No->Errors->Clear();
        $this->BORROWER_NAME->Errors->Clear();
        $this->BORROWER_FATHER->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @14-9F96B532
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["HV_No"][$this->RowNumber]) && count($this->FormParameters["HV_No"][$this->RowNumber])) || strlen($this->FormParameters["HV_No"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["GP_No"][$this->RowNumber]) && count($this->FormParameters["GP_No"][$this->RowNumber])) || strlen($this->FormParameters["GP_No"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["BORROWER_NAME"][$this->RowNumber]) && count($this->FormParameters["BORROWER_NAME"][$this->RowNumber])) || strlen($this->FormParameters["BORROWER_NAME"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["BORROWER_FATHER"][$this->RowNumber]) && count($this->FormParameters["BORROWER_FATHER"][$this->RowNumber])) || strlen($this->FormParameters["BORROWER_FATHER"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @14-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @14-6B923CC2
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

//UpdateGrid Method @14-97278586
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["la_id"] = $this->CachedColumns["la_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->HV_No->SetText($this->FormParameters["HV_No"][$this->RowNumber], $this->RowNumber);
            $this->GP_No->SetText($this->FormParameters["GP_No"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_NAME->SetText($this->FormParameters["BORROWER_NAME"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_FATHER->SetText($this->FormParameters["BORROWER_FATHER"][$this->RowNumber], $this->RowNumber);
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

//UpdateRow Method @14-753CAD8A
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->HV_No->SetValue($this->HV_No->GetValue(true));
        $this->DataSource->GP_No->SetValue($this->GP_No->GetValue(true));
        $this->DataSource->BORROWER_NAME->SetValue($this->BORROWER_NAME->GetValue(true));
        $this->DataSource->BORROWER_FATHER->SetValue($this->BORROWER_FATHER->GetValue(true));
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

//FormScript Method @14-7C5A6958
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var mfi_hvf1Elements;\n";
        $script .= "var mfi_hvf1EmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "HV_NoID = 0;\n";
        $script .= "var " . $this->ComponentName . "GP_NoID = 1;\n";
        $script .= "var " . $this->ComponentName . "BORROWER_NAMEID = 2;\n";
        $script .= "var " . $this->ComponentName . "BORROWER_FATHERID = 3;\n";
        $script .= "\nfunction initmfi_hvf1Elements() {\n";
        $script .= "\tvar ED = document.forms[\"mfi_hvf1\"];\n";
        $script .= "\tmfi_hvf1Elements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.HV_No_" . $i . ", " . "ED.GP_No_" . $i . ", " . "ED.BORROWER_NAME_" . $i . ", " . "ED.BORROWER_FATHER_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @14-91E77058
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
                $this->CachedColumns["la_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["la_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @14-7BB011AA
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["la_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @14-90E2D7D7
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
        $this->ControlsVisible["HV_No"] = $this->HV_No->Visible;
        $this->ControlsVisible["GP_No"] = $this->GP_No->Visible;
        $this->ControlsVisible["BORROWER_NAME"] = $this->BORROWER_NAME->Visible;
        $this->ControlsVisible["BORROWER_FATHER"] = $this->BORROWER_FATHER->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["la_id"][$this->RowNumber] = $this->DataSource->CachedColumns["la_id"];
                    $this->HV_No->SetValue($this->DataSource->HV_No->GetValue());
                    $this->GP_No->SetValue($this->DataSource->GP_No->GetValue());
                    $this->BORROWER_NAME->SetValue($this->DataSource->BORROWER_NAME->GetValue());
                    $this->BORROWER_FATHER->SetValue($this->DataSource->BORROWER_FATHER->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->HV_No->SetText($this->FormParameters["HV_No"][$this->RowNumber], $this->RowNumber);
                    $this->GP_No->SetText($this->FormParameters["GP_No"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_NAME->SetText($this->FormParameters["BORROWER_NAME"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_FATHER->SetText($this->FormParameters["BORROWER_FATHER"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["la_id"][$this->RowNumber] = "";
                    $this->HV_No->SetText("");
                    $this->GP_No->SetText("");
                    $this->BORROWER_NAME->SetText("");
                    $this->BORROWER_FATHER->SetText("");
                } else {
                    $this->HV_No->SetText($this->FormParameters["HV_No"][$this->RowNumber], $this->RowNumber);
                    $this->GP_No->SetText($this->FormParameters["GP_No"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_NAME->SetText($this->FormParameters["BORROWER_NAME"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_FATHER->SetText($this->FormParameters["BORROWER_FATHER"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->HV_No->Show($this->RowNumber);
                $this->GP_No->Show($this->RowNumber);
                $this->BORROWER_NAME->Show($this->RowNumber);
                $this->BORROWER_FATHER->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["la_id"] == $this->CachedColumns["la_id"][$this->RowNumber])) {
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
        $this->Sorter_HV_No->Show();
        $this->Sorter_CP_No_1->Show();
        $this->Sorter_CENTRE_NAME->Show();
        $this->Sorter_GP_No_1->Show();
        $this->Sorter_GROUP_NAME->Show();
        $this->Sorter_SHG_NAME->Show();
        $this->Sorter_SHG_COUNT->Show();
        $this->Sorter_BORROWER_NAME->Show();
        $this->Sorter_BORROWER_FATHER->Show();
        $this->Navigator->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();
        $this->Label1->Show();

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

} //End mfi_hvf1 Class @14-FCB6E20C

class clsmfi_hvf1DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf1DataSource Class @14-2D65C6A0

//DataSource Variables @14-85B51E20
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
    public $HV_No;
    public $GP_No;
    public $BORROWER_NAME;
    public $BORROWER_FATHER;
//End DataSource Variables

//DataSourceClass_Initialize Event @14-D58CFC1D
    function clsmfi_hvf1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid mfi_hvf1/Error";
        $this->Initialize();
        $this->HV_No = new clsField("HV_No", ccsText, "");
        
        $this->GP_No = new clsField("GP_No", ccsText, "");
        
        $this->BORROWER_NAME = new clsField("BORROWER_NAME", ccsText, "");
        
        $this->BORROWER_FATHER = new clsField("BORROWER_FATHER", ccsText, "");
        

        $this->UpdateFields["HV No"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["GP No"] = array("Name" => "gp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["BORROWER NAME"] = array("Name" => "mfi_hvf1_customer_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["BORROWER FATHER"] = array("Name" => "mfi_hvf1_customer_father_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @14-C6A35F8C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_HV_No" => array("la_id", ""), 
            "Sorter_CP_No_1" => array("cp_id", ""), 
            "Sorter_CENTRE_NAME" => array("mfi_cp_centre_name", ""), 
            "Sorter_GP_No_1" => array("gp_id", ""), 
            "Sorter_GROUP_NAME" => array("mfi_gp_proposed_group_name", ""), 
            "Sorter_SHG_NAME" => array("shg_name", ""), 
            "Sorter_SHG_COUNT" => array("shg_group_count", ""), 
            "Sorter_BORROWER_NAME" => array("mfi_hvf1_customer_name", ""), 
            "Sorter_BORROWER_FATHER" => array("mfi_hvf1_customer_father_name", "")));
    }
//End SetOrder Method

//Prepare Method @14-2550ED9E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_GP_No", ccsText, "", "", $this->Parameters["urls_GP_No"], "", false);
        $this->wp->AddParameter("2", "urls_HV_No", ccsText, "", "", $this->Parameters["urls_HV_No"], "", false);
        $this->wp->AddParameter("3", "urlentered_by", ccsText, "", "", $this->Parameters["urlentered_by"], "", false);
        $this->wp->AddParameter("4", "urlentered_at", ccsText, "", "", $this->Parameters["urlentered_at"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "gp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "la_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "mfi_hvf1_added_by", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "mfi_hvf1_added_at", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
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

//Open Method @14-B5105E12
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf1";
        $this->SQL = "SELECT la_id, gp_id, mfi_hvf1_customer_name, mfi_hvf1_customer_father_name \n\n" .
        "FROM mfi_hvf1 {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @14-A5904485
    function SetValues()
    {
        $this->CachedColumns["la_id"] = $this->f("HV No");
        $this->HV_No->SetDBValue($this->f("HV No"));
        $this->GP_No->SetDBValue($this->f("GP No"));
        $this->BORROWER_NAME->SetDBValue($this->f("BORROWER NAME"));
        $this->BORROWER_FATHER->SetDBValue($this->f("BORROWER FATHER"));
    }
//End SetValues Method

//Update Method @14-986187F5
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "la_id=" . $this->ToSQL($this->CachedColumns["la_id"], ccsText);
        $this->UpdateFields["HV No"]["Value"] = $this->HV_No->GetDBValue(true);
        $this->UpdateFields["GP No"]["Value"] = $this->GP_No->GetDBValue(true);
        $this->UpdateFields["BORROWER NAME"]["Value"] = $this->BORROWER_NAME->GetDBValue(true);
        $this->UpdateFields["BORROWER FATHER"]["Value"] = $this->BORROWER_FATHER->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_hvf1", $this->UpdateFields, $this);
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

} //End mfi_hvf1DataSource Class @14-FCB6E20C



class clsEditableGridmfi_hvf3_mfi_hvf1 { //mfi_hvf3_mfi_hvf1 Class @62-9923451C

//Variables @62-FE4BCD55

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
    public $Sorter_HV_No;
    public $Sorter_AGRICULTURE_LAND;
    public $Sorter_TOTAL_CROPS;
    public $Sorter_MILK_SELLING;
    public $Sorter_MONTHLY_EXPENSE;
    public $Sorter_ANNUAL_EXPENSE;
    public $Sorter_ENTERED_BY;
    public $Sorter_ENTERED_AT;
//End Variables

//Class_Initialize Event @62-B93C9EE3
    function clsEditableGridmfi_hvf3_mfi_hvf1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid mfi_hvf3_mfi_hvf1/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "mfi_hvf3_mfi_hvf1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_hvf3_mfi_hvf1DataSource($this);
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

        $this->SorterName = CCGetParam("mfi_hvf3_mfi_hvf1Order", "");
        $this->SorterDirection = CCGetParam("mfi_hvf3_mfi_hvf1Dir", "");

        $this->Sorter_HV_No = new clsSorter($this->ComponentName, "Sorter_HV_No", $FileName, $this);
        $this->Sorter_AGRICULTURE_LAND = new clsSorter($this->ComponentName, "Sorter_AGRICULTURE_LAND", $FileName, $this);
        $this->Sorter_TOTAL_CROPS = new clsSorter($this->ComponentName, "Sorter_TOTAL_CROPS", $FileName, $this);
        $this->Sorter_MILK_SELLING = new clsSorter($this->ComponentName, "Sorter_MILK_SELLING", $FileName, $this);
        $this->Sorter_MONTHLY_EXPENSE = new clsSorter($this->ComponentName, "Sorter_MONTHLY_EXPENSE", $FileName, $this);
        $this->Sorter_ANNUAL_EXPENSE = new clsSorter($this->ComponentName, "Sorter_ANNUAL_EXPENSE", $FileName, $this);
        $this->Sorter_ENTERED_BY = new clsSorter($this->ComponentName, "Sorter_ENTERED_BY", $FileName, $this);
        $this->Sorter_ENTERED_AT = new clsSorter($this->ComponentName, "Sorter_ENTERED_AT", $FileName, $this);
        $this->HV_No = new clsControl(ccsTextBox, "HV_No", "HV No", ccsText, "", NULL, $this);
        $this->HV_No->Required = true;
        $this->ENTERED_BY = new clsControl(ccsTextBox, "ENTERED_BY", "ENTERED BY", ccsText, "", NULL, $this);
        $this->ENTERED_BY->Required = true;
        $this->ENTERED_AT = new clsControl(ccsTextBox, "ENTERED_AT", "ENTERED AT", ccsDate, $DefaultDateFormat, NULL, $this);
        $this->DatePicker_ENTERED_AT = new clsDatePicker("DatePicker_ENTERED_AT", "mfi_hvf3_mfi_hvf1", "ENTERED_AT", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", NULL, $this);
        $this->gp_no = new clsControl(ccsTextBox, "gp_no", "gp_no", ccsText, "", NULL, $this);
        $this->group_name = new clsControl(ccsTextBox, "group_name", "group_name", ccsText, "", NULL, $this);
        $this->group_size = new clsControl(ccsTextBox, "group_size", "group_size", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @62-CC9C2065
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_HV_No"] = CCGetFromGet("s_HV_No", NULL);
        $this->DataSource->Parameters["urls_ENTERED_BY"] = CCGetFromGet("s_ENTERED_BY", NULL);
        $this->DataSource->Parameters["urls_ENTERED_AT"] = CCGetFromGet("s_ENTERED_AT", NULL);
        $this->DataSource->Parameters["urls_GP_No"] = CCGetFromGet("s_GP_No", NULL);
    }
//End Initialize Method

//GetFormParameters Method @62-39C45D88
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["HV_No"][$RowNumber] = CCGetFromPost("HV_No_" . $RowNumber, NULL);
            $this->FormParameters["ENTERED_BY"][$RowNumber] = CCGetFromPost("ENTERED_BY_" . $RowNumber, NULL);
            $this->FormParameters["ENTERED_AT"][$RowNumber] = CCGetFromPost("ENTERED_AT_" . $RowNumber, NULL);
            $this->FormParameters["gp_no"][$RowNumber] = CCGetFromPost("gp_no_" . $RowNumber, NULL);
            $this->FormParameters["group_name"][$RowNumber] = CCGetFromPost("group_name_" . $RowNumber, NULL);
            $this->FormParameters["group_size"][$RowNumber] = CCGetFromPost("group_size_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @62-99BE4FFD
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->HV_No->SetText($this->FormParameters["HV_No"][$this->RowNumber], $this->RowNumber);
            $this->ENTERED_BY->SetText($this->FormParameters["ENTERED_BY"][$this->RowNumber], $this->RowNumber);
            $this->ENTERED_AT->SetText($this->FormParameters["ENTERED_AT"][$this->RowNumber], $this->RowNumber);
            $this->gp_no->SetText($this->FormParameters["gp_no"][$this->RowNumber], $this->RowNumber);
            $this->group_name->SetText($this->FormParameters["group_name"][$this->RowNumber], $this->RowNumber);
            $this->group_size->SetText($this->FormParameters["group_size"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @62-35A82A93
    function ValidateRow()
    {
        global $CCSLocales;
        $this->HV_No->Validate();
        $this->ENTERED_BY->Validate();
        $this->ENTERED_AT->Validate();
        $this->gp_no->Validate();
        $this->group_name->Validate();
        $this->group_size->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->HV_No->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ENTERED_BY->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ENTERED_AT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gp_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->group_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->group_size->Errors->ToString());
        $this->HV_No->Errors->Clear();
        $this->ENTERED_BY->Errors->Clear();
        $this->ENTERED_AT->Errors->Clear();
        $this->gp_no->Errors->Clear();
        $this->group_name->Errors->Clear();
        $this->group_size->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @62-BBCBCBA7
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["HV_No"][$this->RowNumber]) && count($this->FormParameters["HV_No"][$this->RowNumber])) || strlen($this->FormParameters["HV_No"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["ENTERED_BY"][$this->RowNumber]) && count($this->FormParameters["ENTERED_BY"][$this->RowNumber])) || strlen($this->FormParameters["ENTERED_BY"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["ENTERED_AT"][$this->RowNumber]) && count($this->FormParameters["ENTERED_AT"][$this->RowNumber])) || strlen($this->FormParameters["ENTERED_AT"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["gp_no"][$this->RowNumber]) && count($this->FormParameters["gp_no"][$this->RowNumber])) || strlen($this->FormParameters["gp_no"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["group_name"][$this->RowNumber]) && count($this->FormParameters["group_name"][$this->RowNumber])) || strlen($this->FormParameters["group_name"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["group_size"][$this->RowNumber]) && count($this->FormParameters["group_size"][$this->RowNumber])) || strlen($this->FormParameters["group_size"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @62-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @62-6B923CC2
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

//UpdateGrid Method @62-E8BE776C
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->HV_No->SetText($this->FormParameters["HV_No"][$this->RowNumber], $this->RowNumber);
            $this->ENTERED_BY->SetText($this->FormParameters["ENTERED_BY"][$this->RowNumber], $this->RowNumber);
            $this->ENTERED_AT->SetText($this->FormParameters["ENTERED_AT"][$this->RowNumber], $this->RowNumber);
            $this->gp_no->SetText($this->FormParameters["gp_no"][$this->RowNumber], $this->RowNumber);
            $this->group_name->SetText($this->FormParameters["group_name"][$this->RowNumber], $this->RowNumber);
            $this->group_size->SetText($this->FormParameters["group_size"][$this->RowNumber], $this->RowNumber);
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

//UpdateRow Method @62-0B911CFE
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->HV_No->SetValue($this->HV_No->GetValue(true));
        $this->DataSource->ENTERED_BY->SetValue($this->ENTERED_BY->GetValue(true));
        $this->DataSource->ENTERED_AT->SetValue($this->ENTERED_AT->GetValue(true));
        $this->DataSource->gp_no->SetValue($this->gp_no->GetValue(true));
        $this->DataSource->group_name->SetValue($this->group_name->GetValue(true));
        $this->DataSource->group_size->SetValue($this->group_size->GetValue(true));
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

//FormScript Method @62-B38906FA
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var mfi_hvf3_mfi_hvf1Elements;\n";
        $script .= "var mfi_hvf3_mfi_hvf1EmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "HV_NoID = 0;\n";
        $script .= "var " . $this->ComponentName . "ENTERED_BYID = 1;\n";
        $script .= "var " . $this->ComponentName . "ENTERED_ATID = 2;\n";
        $script .= "var " . $this->ComponentName . "gp_noID = 3;\n";
        $script .= "var " . $this->ComponentName . "group_nameID = 4;\n";
        $script .= "var " . $this->ComponentName . "group_sizeID = 5;\n";
        $script .= "\nfunction initmfi_hvf3_mfi_hvf1Elements() {\n";
        $script .= "\tvar ED = document.forms[\"mfi_hvf3_mfi_hvf1\"];\n";
        $script .= "\tmfi_hvf3_mfi_hvf1Elements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.HV_No_" . $i . ", " . "ED.ENTERED_BY_" . $i . ", " . "ED.ENTERED_AT_" . $i . ", " . "ED.gp_no_" . $i . ", " . "ED.group_name_" . $i . ", " . "ED.group_size_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @62-69E01441
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
            for($i = 2; $i < sizeof($pieces); $i = $i + 0)  {
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @62-BF9CEBD0
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @62-C58EEA73
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
        $this->ControlsVisible["HV_No"] = $this->HV_No->Visible;
        $this->ControlsVisible["ENTERED_BY"] = $this->ENTERED_BY->Visible;
        $this->ControlsVisible["ENTERED_AT"] = $this->ENTERED_AT->Visible;
        $this->ControlsVisible["DatePicker_ENTERED_AT"] = $this->DatePicker_ENTERED_AT->Visible;
        $this->ControlsVisible["gp_no"] = $this->gp_no->Visible;
        $this->ControlsVisible["group_name"] = $this->group_name->Visible;
        $this->ControlsVisible["group_size"] = $this->group_size->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->HV_No->SetValue($this->DataSource->HV_No->GetValue());
                    $this->ENTERED_BY->SetValue($this->DataSource->ENTERED_BY->GetValue());
                    $this->ENTERED_AT->SetValue($this->DataSource->ENTERED_AT->GetValue());
                    $this->gp_no->SetValue($this->DataSource->gp_no->GetValue());
                    $this->group_name->SetValue($this->DataSource->group_name->GetValue());
                    $this->group_size->SetValue($this->DataSource->group_size->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->HV_No->SetText($this->FormParameters["HV_No"][$this->RowNumber], $this->RowNumber);
                    $this->ENTERED_BY->SetText($this->FormParameters["ENTERED_BY"][$this->RowNumber], $this->RowNumber);
                    $this->ENTERED_AT->SetText($this->FormParameters["ENTERED_AT"][$this->RowNumber], $this->RowNumber);
                    $this->gp_no->SetText($this->FormParameters["gp_no"][$this->RowNumber], $this->RowNumber);
                    $this->group_name->SetText($this->FormParameters["group_name"][$this->RowNumber], $this->RowNumber);
                    $this->group_size->SetText($this->FormParameters["group_size"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->HV_No->SetText("");
                    $this->ENTERED_BY->SetText("");
                    $this->ENTERED_AT->SetText("");
                    $this->gp_no->SetText("");
                    $this->group_name->SetText("");
                    $this->group_size->SetText("");
                } else {
                    $this->HV_No->SetText($this->FormParameters["HV_No"][$this->RowNumber], $this->RowNumber);
                    $this->ENTERED_BY->SetText($this->FormParameters["ENTERED_BY"][$this->RowNumber], $this->RowNumber);
                    $this->ENTERED_AT->SetText($this->FormParameters["ENTERED_AT"][$this->RowNumber], $this->RowNumber);
                    $this->gp_no->SetText($this->FormParameters["gp_no"][$this->RowNumber], $this->RowNumber);
                    $this->group_name->SetText($this->FormParameters["group_name"][$this->RowNumber], $this->RowNumber);
                    $this->group_size->SetText($this->FormParameters["group_size"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->HV_No->Show($this->RowNumber);
                $this->ENTERED_BY->Show($this->RowNumber);
                $this->ENTERED_AT->Show($this->RowNumber);
                $this->DatePicker_ENTERED_AT->Show($this->RowNumber);
                $this->gp_no->Show($this->RowNumber);
                $this->group_name->Show($this->RowNumber);
                $this->group_size->Show($this->RowNumber);
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
                        $is_next_record =  $this->ReadAllowed && $this->DataSource->next_record() && $this->RowNumber < $this->UpdatedRows;
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
        $this->Sorter_HV_No->Show();
        $this->Sorter_AGRICULTURE_LAND->Show();
        $this->Sorter_TOTAL_CROPS->Show();
        $this->Sorter_MILK_SELLING->Show();
        $this->Sorter_MONTHLY_EXPENSE->Show();
        $this->Sorter_ANNUAL_EXPENSE->Show();
        $this->Sorter_ENTERED_BY->Show();
        $this->Sorter_ENTERED_AT->Show();
        $this->Navigator->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();
        $this->Label1->Show();

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

} //End mfi_hvf3_mfi_hvf1 Class @62-FCB6E20C

class clsmfi_hvf3_mfi_hvf1DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf3_mfi_hvf1DataSource Class @62-CDE156E2

//DataSource Variables @62-924AD344
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CurrentRow;
    public $UpdateFields = array();

    // Datasource fields
    public $HV_No;
    public $ENTERED_BY;
    public $ENTERED_AT;
    public $gp_no;
    public $group_name;
    public $group_size;
//End DataSource Variables

//DataSourceClass_Initialize Event @62-F682AC79
    function clsmfi_hvf3_mfi_hvf1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid mfi_hvf3_mfi_hvf1/Error";
        $this->Initialize();
        $this->HV_No = new clsField("HV_No", ccsText, "");
        
        $this->ENTERED_BY = new clsField("ENTERED_BY", ccsText, "");
        
        $this->ENTERED_AT = new clsField("ENTERED_AT", ccsDate, $this->DateFormat);
        
        $this->gp_no = new clsField("gp_no", ccsText, "");
        
        $this->group_name = new clsField("group_name", ccsText, "");
        
        $this->group_size = new clsField("group_size", ccsText, "");
        

        $this->UpdateFields["la_id"] = array("Name" => "la_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ENTERED BY"] = array("Name" => "ENTERED BY", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ENTERED AT"] = array("Name" => "ENTERED AT", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["gp_id"] = array("Name" => "gp_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_gp_proposed_group_name"] = array("Name" => "mfi_gp_proposed_group_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_hvf2_group_size"] = array("Name" => "mfi_hvf2_group_size", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @62-A2F9574E
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_HV_No" => array("hv_id", ""), 
            "Sorter_AGRICULTURE_LAND" => array("mfi_hvf3_agricultureland", ""), 
            "Sorter_TOTAL_CROPS" => array("mfi_hvf3_no_of_crops", ""), 
            "Sorter_MILK_SELLING" => array("mfi_hvf3_total_milk_selling", ""), 
            "Sorter_MONTHLY_EXPENSE" => array("mfi_hvf3_montly_expense", ""), 
            "Sorter_ANNUAL_EXPENSE" => array("mfi_hvf3_annual_expense", ""), 
            "Sorter_ENTERED_BY" => array("mfi_hvf3.added_by", ""), 
            "Sorter_ENTERED_AT" => array("mfi_hvf3.added_at", "")));
    }
//End SetOrder Method

//Prepare Method @62-DFEFDBEE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_HV_No", ccsText, "", "", $this->Parameters["urls_HV_No"], "", false);
        $this->wp->AddParameter("2", "urls_ENTERED_BY", ccsText, "", "", $this->Parameters["urls_ENTERED_BY"], "", false);
        $this->wp->AddParameter("3", "urls_ENTERED_AT", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_ENTERED_AT"], "", false);
        $this->wp->AddParameter("4", "urls_GP_No", ccsText, "", "", $this->Parameters["urls_GP_No"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "la_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "added_by", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "added_at", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "gp_id", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
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

//Open Method @62-CBA05EAA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf2";
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_hvf2 {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @62-515F4144
    function SetValues()
    {
        $this->HV_No->SetDBValue($this->f("la_id"));
        $this->ENTERED_BY->SetDBValue($this->f("ENTERED BY"));
        $this->ENTERED_AT->SetDBValue(trim($this->f("ENTERED AT")));
        $this->gp_no->SetDBValue($this->f("gp_id"));
        $this->group_name->SetDBValue($this->f("mfi_gp_proposed_group_name"));
        $this->group_size->SetDBValue($this->f("mfi_hvf2_group_size"));
    }
//End SetValues Method

//Update Method @62-C70E5CD9
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "";
        $this->UpdateFields["la_id"]["Value"] = $this->HV_No->GetDBValue(true);
        $this->UpdateFields["ENTERED BY"]["Value"] = $this->ENTERED_BY->GetDBValue(true);
        $this->UpdateFields["ENTERED AT"]["Value"] = $this->ENTERED_AT->GetDBValue(true);
        $this->UpdateFields["gp_id"]["Value"] = $this->gp_no->GetDBValue(true);
        $this->UpdateFields["mfi_gp_proposed_group_name"]["Value"] = $this->group_name->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_group_size"]["Value"] = $this->group_size->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_hvf2", $this->UpdateFields, $this);
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

} //End mfi_hvf3_mfi_hvf1DataSource Class @62-FCB6E20C

class clsRecordmfi_hvf1_mfi_hvf3 { //mfi_hvf1_mfi_hvf3 Class @85-120EFB84

//Variables @85-9E315808

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

//Class_Initialize Event @85-86D0DC3D
    function clsRecordmfi_hvf1_mfi_hvf3($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_hvf1_mfi_hvf3/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_hvf1_mfi_hvf3";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_GP_No = new clsControl(ccsTextBox, "s_GP_No", "s_GP_No", ccsText, "", CCGetRequestParam("s_GP_No", $Method, NULL), $this);
            $this->s_HV_No = new clsControl(ccsTextBox, "s_HV_No", "s_HV_No", ccsText, "", CCGetRequestParam("s_HV_No", $Method, NULL), $this);
            $this->s_ENTERED_BY = new clsControl(ccsTextBox, "s_ENTERED_BY", "s_ENTERED_BY", ccsText, "", CCGetRequestParam("s_ENTERED_BY", $Method, NULL), $this);
            $this->s_ENTERED_AT = new clsControl(ccsTextBox, "s_ENTERED_AT", "s_ENTERED_AT", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_ENTERED_AT", $Method, NULL), $this);
            $this->DatePicker_s_ENTERED_AT = new clsDatePicker("DatePicker_s_ENTERED_AT", "mfi_hvf1_mfi_hvf3", "s_ENTERED_AT", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @85-ABE98075
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_GP_No->Validate() && $Validation);
        $Validation = ($this->s_HV_No->Validate() && $Validation);
        $Validation = ($this->s_ENTERED_BY->Validate() && $Validation);
        $Validation = ($this->s_ENTERED_AT->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_GP_No->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_HV_No->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ENTERED_BY->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ENTERED_AT->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @85-DB42A806
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_GP_No->Errors->Count());
        $errors = ($errors || $this->s_HV_No->Errors->Count());
        $errors = ($errors || $this->s_ENTERED_BY->Errors->Count());
        $errors = ($errors || $this->s_ENTERED_AT->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_ENTERED_AT->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @85-7CB7526C
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
        $Redirect = "manageHV_PAGE12.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "manageHV_PAGE12.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @85-50EEC481
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
            $Error = ComposeStrings($Error, $this->s_GP_No->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_HV_No->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ENTERED_BY->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ENTERED_AT->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_ENTERED_AT->Errors->ToString());
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
        $this->s_GP_No->Show();
        $this->s_HV_No->Show();
        $this->s_ENTERED_BY->Show();
        $this->s_ENTERED_AT->Show();
        $this->DatePicker_s_ENTERED_AT->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_hvf1_mfi_hvf3 Class @85-FCB6E20C

class clsGridmfi_hvf2 { //mfi_hvf2 class @144-AE4C178D

//Variables @144-6E51DF5A

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

//Class_Initialize Event @144-2AAD758F
    function clsGridmfi_hvf2($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_hvf2";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_hvf2";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_hvf2DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->HV_NO = new clsControl(ccsLabel, "HV_NO", "HV_NO", ccsText, "", CCGetRequestParam("HV_NO", ccsGet, NULL), $this);
        $this->SHG_NAME = new clsControl(ccsLabel, "SHG_NAME", "SHG_NAME", ccsText, "", CCGetRequestParam("SHG_NAME", ccsGet, NULL), $this);
        $this->GP_NO = new clsControl(ccsLabel, "GP_NO", "GP_NO", ccsText, "", CCGetRequestParam("GP_NO", ccsGet, NULL), $this);
        $this->GROUP_NAME = new clsControl(ccsLabel, "GROUP_NAME", "GROUP_NAME", ccsText, "", CCGetRequestParam("GROUP_NAME", ccsGet, NULL), $this);
        $this->CP_NO = new clsControl(ccsLabel, "CP_NO", "CP_NO", ccsText, "", CCGetRequestParam("CP_NO", ccsGet, NULL), $this);
        $this->CENTRE_NAME = new clsControl(ccsLabel, "CENTRE_NAME", "CENTRE_NAME", ccsText, "", CCGetRequestParam("CENTRE_NAME", ccsGet, NULL), $this);
        $this->CUSTOMER_NAME = new clsControl(ccsLabel, "CUSTOMER_NAME", "CUSTOMER_NAME", ccsText, "", CCGetRequestParam("CUSTOMER_NAME", ccsGet, NULL), $this);
        $this->FATHER_NAME = new clsControl(ccsLabel, "FATHER_NAME", "FATHER_NAME", ccsText, "", CCGetRequestParam("FATHER_NAME", ccsGet, NULL), $this);
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->Label2 = new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", CCGetRequestParam("Label2", ccsGet, NULL), $this);
        $this->Label3 = new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @144-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @144-EA4857F3
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_GP_No"] = CCGetFromGet("s_GP_No", NULL);
        $this->DataSource->Parameters["urls_HV_No"] = CCGetFromGet("s_HV_No", NULL);
        $this->DataSource->Parameters["urls_SHG_NAME"] = CCGetFromGet("s_SHG_NAME", NULL);
        $this->DataSource->Parameters["urlentered_by"] = CCGetFromGet("entered_by", NULL);
        $this->DataSource->Parameters["urlentered_at"] = CCGetFromGet("entered_at", NULL);

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
            $this->ControlsVisible["HV_NO"] = $this->HV_NO->Visible;
            $this->ControlsVisible["SHG_NAME"] = $this->SHG_NAME->Visible;
            $this->ControlsVisible["GP_NO"] = $this->GP_NO->Visible;
            $this->ControlsVisible["GROUP_NAME"] = $this->GROUP_NAME->Visible;
            $this->ControlsVisible["CP_NO"] = $this->CP_NO->Visible;
            $this->ControlsVisible["CENTRE_NAME"] = $this->CENTRE_NAME->Visible;
            $this->ControlsVisible["CUSTOMER_NAME"] = $this->CUSTOMER_NAME->Visible;
            $this->ControlsVisible["FATHER_NAME"] = $this->FATHER_NAME->Visible;
            $this->ControlsVisible["Label1"] = $this->Label1->Visible;
            $this->ControlsVisible["Label2"] = $this->Label2->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->HV_NO->SetValue($this->DataSource->HV_NO->GetValue());
                $this->SHG_NAME->SetValue($this->DataSource->SHG_NAME->GetValue());
                $this->GP_NO->SetValue($this->DataSource->GP_NO->GetValue());
                $this->GROUP_NAME->SetValue($this->DataSource->GROUP_NAME->GetValue());
                $this->CP_NO->SetValue($this->DataSource->CP_NO->GetValue());
                $this->CENTRE_NAME->SetValue($this->DataSource->CENTRE_NAME->GetValue());
                $this->CUSTOMER_NAME->SetValue($this->DataSource->CUSTOMER_NAME->GetValue());
                $this->FATHER_NAME->SetValue($this->DataSource->FATHER_NAME->GetValue());
                $this->Label1->SetValue($this->DataSource->Label1->GetValue());
                $this->Label2->SetValue($this->DataSource->Label2->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->HV_NO->Show();
                $this->SHG_NAME->Show();
                $this->GP_NO->Show();
                $this->GROUP_NAME->Show();
                $this->CP_NO->Show();
                $this->CENTRE_NAME->Show();
                $this->CUSTOMER_NAME->Show();
                $this->FATHER_NAME->Show();
                $this->Label1->Show();
                $this->Label2->Show();
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
        $this->Label3->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @144-18CA12D5
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->HV_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SHG_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GP_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GROUP_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CP_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CENTRE_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CUSTOMER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FATHER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_hvf2 Class @144-FCB6E20C

class clsmfi_hvf2DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf2DataSource Class @144-7704F9C0

//DataSource Variables @144-41C94A7B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $HV_NO;
    public $SHG_NAME;
    public $GP_NO;
    public $GROUP_NAME;
    public $CP_NO;
    public $CENTRE_NAME;
    public $CUSTOMER_NAME;
    public $FATHER_NAME;
    public $Label1;
    public $Label2;
//End DataSource Variables

//DataSourceClass_Initialize Event @144-2002EF01
    function clsmfi_hvf2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_hvf2";
        $this->Initialize();
        $this->HV_NO = new clsField("HV_NO", ccsText, "");
        
        $this->SHG_NAME = new clsField("SHG_NAME", ccsText, "");
        
        $this->GP_NO = new clsField("GP_NO", ccsText, "");
        
        $this->GROUP_NAME = new clsField("GROUP_NAME", ccsText, "");
        
        $this->CP_NO = new clsField("CP_NO", ccsText, "");
        
        $this->CENTRE_NAME = new clsField("CENTRE_NAME", ccsText, "");
        
        $this->CUSTOMER_NAME = new clsField("CUSTOMER_NAME", ccsText, "");
        
        $this->FATHER_NAME = new clsField("FATHER_NAME", ccsText, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        
        $this->Label2 = new clsField("Label2", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @144-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @144-69C2DD4B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urls_GP_No", ccsText, "", "", $this->Parameters["urls_GP_No"], "", false);
        $this->wp->AddParameter("3", "urls_HV_No", ccsText, "", "", $this->Parameters["urls_HV_No"], "", false);
        $this->wp->AddParameter("4", "urls_SHG_NAME", ccsText, "", "", $this->Parameters["urls_SHG_NAME"], "", false);
        $this->wp->AddParameter("5", "urlentered_by", ccsText, "", "", $this->Parameters["urlentered_by"], "", false);
        $this->wp->AddParameter("6", "urlentered_at", ccsText, "", "", $this->Parameters["urlentered_at"], "", false);
        $this->wp->Criterion[1] = "( la_id not in(select hv_id from mfi_hvf3) )";
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "mfi_hvf1.gp_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "mfi_hvf1.la_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "mfi_hvf1.shg_name", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "mfi_hvf1.added_by", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "mfi_hvf1.added_at", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = "( mfi_doc_type like 'ER%' )";
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]);
    }
//End Prepare Method

//Open Method @144-773DD16A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_docs ON\n\n" .
        "mfi_hvf1.la_id = mfi_docs.mfi_doc_territory_code";
        $this->SQL = "SELECT shg_name, mfi_gp_proposed_group_name, mfi_cp_centre_name, cp_id, gp_id, mfi_hvf1_customer_name, mfi_hvf1_customer_father_name,\n\n" .
        "mfi_doc_filename, la_id, doc_rejection_reason \n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_docs ON\n\n" .
        "mfi_hvf1.la_id = mfi_docs.mfi_doc_territory_code {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @144-6DCC1E8A
    function SetValues()
    {
        $this->HV_NO->SetDBValue($this->f("HV NO"));
        $this->SHG_NAME->SetDBValue($this->f("SHG NAME"));
        $this->GP_NO->SetDBValue($this->f("GP NO"));
        $this->GROUP_NAME->SetDBValue($this->f("GROUP NAME"));
        $this->CP_NO->SetDBValue($this->f("CP NO"));
        $this->CENTRE_NAME->SetDBValue($this->f("CENTRE NAME"));
        $this->CUSTOMER_NAME->SetDBValue($this->f("CUSTOMER NAME"));
        $this->FATHER_NAME->SetDBValue($this->f("FATHER NAME"));
        $this->Label1->SetDBValue($this->f("FILE NAME"));
        $this->Label2->SetDBValue($this->f("REJECTION REASON"));
    }
//End SetValues Method

} //End mfi_hvf2DataSource Class @144-FCB6E20C

class clsEditableGridybl_kyc_mfi_hvf1 { //ybl_kyc_mfi_hvf1 Class @188-7697C5EF

//Variables @188-0AADA924

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
//End Variables

//Class_Initialize Event @188-B4CB8023
    function clsEditableGridybl_kyc_mfi_hvf1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid ybl_kyc_mfi_hvf1/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "ybl_kyc_mfi_hvf1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["la_id"][0] = "la_id";
        $this->CachedColumns["HV NO"][0] = "HV NO";
        $this->DataSource = new clsybl_kyc_mfi_hvf1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 0;
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

        $this->GP_NO = new clsControl(ccsTextBox, "GP_NO", "GP NO", ccsText, "", NULL, $this);
        $this->GP_NO->Required = true;
        $this->HV_NO = new clsControl(ccsTextBox, "HV_NO", "HV NO", ccsText, "", NULL, $this);
        $this->HV_NO->Required = true;
        $this->KYC_TYPE_1 = new clsControl(ccsTextBox, "KYC_TYPE_1", "KYC TYPE 1", ccsText, "", NULL, $this);
        $this->KYC_TYPE_2 = new clsControl(ccsTextBox, "KYC_TYPE_2", "KYC TYPE 2", ccsText, "", NULL, $this);
        $this->BORROWER_VOTER_ID_1 = new clsControl(ccsTextBox, "BORROWER_VOTER_ID_1", "BORROWER VOTER ID 1", ccsText, "", NULL, $this);
        $this->BORROWER_VOTER_ID_2 = new clsControl(ccsTextBox, "BORROWER_VOTER_ID_2", "BORROWER VOTER ID 2", ccsText, "", NULL, $this);
        $this->BORROWER_NAME1 = new clsControl(ccsTextBox, "BORROWER_NAME1", "BORROWER NAME1", ccsText, "", NULL, $this);
        $this->BORROWER_NAME2 = new clsControl(ccsTextBox, "BORROWER_NAME2", "BORROWER NAME2", ccsText, "", NULL, $this);
        $this->RELATION_TYPE1 = new clsControl(ccsTextBox, "RELATION_TYPE1", "RELATION TYPE1", ccsText, "", NULL, $this);
        $this->RELATION_TYPE2 = new clsControl(ccsTextBox, "RELATION_TYPE2", "RELATION TYPE2", ccsText, "", NULL, $this);
        $this->RELATIVE_NAME1 = new clsControl(ccsTextBox, "RELATIVE_NAME1", "RELATIVE NAME1", ccsText, "", NULL, $this);
        $this->RELATIVE_NAME2 = new clsControl(ccsTextBox, "RELATIVE_NAME2", "RELATIVE NAME2", ccsText, "", NULL, $this);
        $this->PINCODE_1 = new clsControl(ccsTextBox, "PINCODE_1", "PINCODE 1", ccsInteger, "", NULL, $this);
        $this->PINCODE_2 = new clsControl(ccsTextBox, "PINCODE_2", "PINCODE 2", ccsInteger, "", NULL, $this);
        $this->GUARANTOR_VOTER_ID1 = new clsControl(ccsTextBox, "GUARANTOR_VOTER_ID1", "GUARANTOR VOTER ID1", ccsText, "", NULL, $this);
        $this->GUARANTOR_VOTER_ID2 = new clsControl(ccsTextBox, "GUARANTOR_VOTER_ID2", "GUARANTOR VOTER ID2", ccsText, "", NULL, $this);
        $this->KYC_ENTERED_BY = new clsControl(ccsTextBox, "KYC_ENTERED_BY", "KYC ENTERED BY", ccsText, "", NULL, $this);
        $this->KYC_DEDUPED_BY = new clsControl(ccsTextBox, "KYC_DEDUPED_BY", "KYC DEDUPED BY", ccsText, "", NULL, $this);
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @188-7A032C32
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_GP_No"] = CCGetFromGet("s_GP_No", NULL);
    }
//End Initialize Method

//GetFormParameters Method @188-855EF9B2
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["GP_NO"][$RowNumber] = CCGetFromPost("GP_NO_" . $RowNumber, NULL);
            $this->FormParameters["HV_NO"][$RowNumber] = CCGetFromPost("HV_NO_" . $RowNumber, NULL);
            $this->FormParameters["KYC_TYPE_1"][$RowNumber] = CCGetFromPost("KYC_TYPE_1_" . $RowNumber, NULL);
            $this->FormParameters["KYC_TYPE_2"][$RowNumber] = CCGetFromPost("KYC_TYPE_2_" . $RowNumber, NULL);
            $this->FormParameters["BORROWER_VOTER_ID_1"][$RowNumber] = CCGetFromPost("BORROWER_VOTER_ID_1_" . $RowNumber, NULL);
            $this->FormParameters["BORROWER_VOTER_ID_2"][$RowNumber] = CCGetFromPost("BORROWER_VOTER_ID_2_" . $RowNumber, NULL);
            $this->FormParameters["BORROWER_NAME1"][$RowNumber] = CCGetFromPost("BORROWER_NAME1_" . $RowNumber, NULL);
            $this->FormParameters["BORROWER_NAME2"][$RowNumber] = CCGetFromPost("BORROWER_NAME2_" . $RowNumber, NULL);
            $this->FormParameters["RELATION_TYPE1"][$RowNumber] = CCGetFromPost("RELATION_TYPE1_" . $RowNumber, NULL);
            $this->FormParameters["RELATION_TYPE2"][$RowNumber] = CCGetFromPost("RELATION_TYPE2_" . $RowNumber, NULL);
            $this->FormParameters["RELATIVE_NAME1"][$RowNumber] = CCGetFromPost("RELATIVE_NAME1_" . $RowNumber, NULL);
            $this->FormParameters["RELATIVE_NAME2"][$RowNumber] = CCGetFromPost("RELATIVE_NAME2_" . $RowNumber, NULL);
            $this->FormParameters["PINCODE_1"][$RowNumber] = CCGetFromPost("PINCODE_1_" . $RowNumber, NULL);
            $this->FormParameters["PINCODE_2"][$RowNumber] = CCGetFromPost("PINCODE_2_" . $RowNumber, NULL);
            $this->FormParameters["GUARANTOR_VOTER_ID1"][$RowNumber] = CCGetFromPost("GUARANTOR_VOTER_ID1_" . $RowNumber, NULL);
            $this->FormParameters["GUARANTOR_VOTER_ID2"][$RowNumber] = CCGetFromPost("GUARANTOR_VOTER_ID2_" . $RowNumber, NULL);
            $this->FormParameters["KYC_ENTERED_BY"][$RowNumber] = CCGetFromPost("KYC_ENTERED_BY_" . $RowNumber, NULL);
            $this->FormParameters["KYC_DEDUPED_BY"][$RowNumber] = CCGetFromPost("KYC_DEDUPED_BY_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @188-CB47071A
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["la_id"] = $this->CachedColumns["la_id"][$this->RowNumber];
            $this->DataSource->CachedColumns["HV NO"] = $this->CachedColumns["HV NO"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->GP_NO->SetText($this->FormParameters["GP_NO"][$this->RowNumber], $this->RowNumber);
            $this->HV_NO->SetText($this->FormParameters["HV_NO"][$this->RowNumber], $this->RowNumber);
            $this->KYC_TYPE_1->SetText($this->FormParameters["KYC_TYPE_1"][$this->RowNumber], $this->RowNumber);
            $this->KYC_TYPE_2->SetText($this->FormParameters["KYC_TYPE_2"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_VOTER_ID_1->SetText($this->FormParameters["BORROWER_VOTER_ID_1"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_VOTER_ID_2->SetText($this->FormParameters["BORROWER_VOTER_ID_2"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_NAME1->SetText($this->FormParameters["BORROWER_NAME1"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_NAME2->SetText($this->FormParameters["BORROWER_NAME2"][$this->RowNumber], $this->RowNumber);
            $this->RELATION_TYPE1->SetText($this->FormParameters["RELATION_TYPE1"][$this->RowNumber], $this->RowNumber);
            $this->RELATION_TYPE2->SetText($this->FormParameters["RELATION_TYPE2"][$this->RowNumber], $this->RowNumber);
            $this->RELATIVE_NAME1->SetText($this->FormParameters["RELATIVE_NAME1"][$this->RowNumber], $this->RowNumber);
            $this->RELATIVE_NAME2->SetText($this->FormParameters["RELATIVE_NAME2"][$this->RowNumber], $this->RowNumber);
            $this->PINCODE_1->SetText($this->FormParameters["PINCODE_1"][$this->RowNumber], $this->RowNumber);
            $this->PINCODE_2->SetText($this->FormParameters["PINCODE_2"][$this->RowNumber], $this->RowNumber);
            $this->GUARANTOR_VOTER_ID1->SetText($this->FormParameters["GUARANTOR_VOTER_ID1"][$this->RowNumber], $this->RowNumber);
            $this->GUARANTOR_VOTER_ID2->SetText($this->FormParameters["GUARANTOR_VOTER_ID2"][$this->RowNumber], $this->RowNumber);
            $this->KYC_ENTERED_BY->SetText($this->FormParameters["KYC_ENTERED_BY"][$this->RowNumber], $this->RowNumber);
            $this->KYC_DEDUPED_BY->SetText($this->FormParameters["KYC_DEDUPED_BY"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @188-A145C8F6
    function ValidateRow()
    {
        global $CCSLocales;
        $this->GP_NO->Validate();
        $this->HV_NO->Validate();
        $this->KYC_TYPE_1->Validate();
        $this->KYC_TYPE_2->Validate();
        $this->BORROWER_VOTER_ID_1->Validate();
        $this->BORROWER_VOTER_ID_2->Validate();
        $this->BORROWER_NAME1->Validate();
        $this->BORROWER_NAME2->Validate();
        $this->RELATION_TYPE1->Validate();
        $this->RELATION_TYPE2->Validate();
        $this->RELATIVE_NAME1->Validate();
        $this->RELATIVE_NAME2->Validate();
        $this->PINCODE_1->Validate();
        $this->PINCODE_2->Validate();
        $this->GUARANTOR_VOTER_ID1->Validate();
        $this->GUARANTOR_VOTER_ID2->Validate();
        $this->KYC_ENTERED_BY->Validate();
        $this->KYC_DEDUPED_BY->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->GP_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->HV_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->KYC_TYPE_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->KYC_TYPE_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_VOTER_ID_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_VOTER_ID_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_NAME1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_NAME2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RELATION_TYPE1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RELATION_TYPE2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RELATIVE_NAME1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RELATIVE_NAME2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PINCODE_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PINCODE_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GUARANTOR_VOTER_ID1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GUARANTOR_VOTER_ID2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->KYC_ENTERED_BY->Errors->ToString());
        $errors = ComposeStrings($errors, $this->KYC_DEDUPED_BY->Errors->ToString());
        $this->GP_NO->Errors->Clear();
        $this->HV_NO->Errors->Clear();
        $this->KYC_TYPE_1->Errors->Clear();
        $this->KYC_TYPE_2->Errors->Clear();
        $this->BORROWER_VOTER_ID_1->Errors->Clear();
        $this->BORROWER_VOTER_ID_2->Errors->Clear();
        $this->BORROWER_NAME1->Errors->Clear();
        $this->BORROWER_NAME2->Errors->Clear();
        $this->RELATION_TYPE1->Errors->Clear();
        $this->RELATION_TYPE2->Errors->Clear();
        $this->RELATIVE_NAME1->Errors->Clear();
        $this->RELATIVE_NAME2->Errors->Clear();
        $this->PINCODE_1->Errors->Clear();
        $this->PINCODE_2->Errors->Clear();
        $this->GUARANTOR_VOTER_ID1->Errors->Clear();
        $this->GUARANTOR_VOTER_ID2->Errors->Clear();
        $this->KYC_ENTERED_BY->Errors->Clear();
        $this->KYC_DEDUPED_BY->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @188-E25CA818
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["GP_NO"][$this->RowNumber]) && count($this->FormParameters["GP_NO"][$this->RowNumber])) || strlen($this->FormParameters["GP_NO"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["HV_NO"][$this->RowNumber]) && count($this->FormParameters["HV_NO"][$this->RowNumber])) || strlen($this->FormParameters["HV_NO"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["KYC_TYPE_1"][$this->RowNumber]) && count($this->FormParameters["KYC_TYPE_1"][$this->RowNumber])) || strlen($this->FormParameters["KYC_TYPE_1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["KYC_TYPE_2"][$this->RowNumber]) && count($this->FormParameters["KYC_TYPE_2"][$this->RowNumber])) || strlen($this->FormParameters["KYC_TYPE_2"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["BORROWER_VOTER_ID_1"][$this->RowNumber]) && count($this->FormParameters["BORROWER_VOTER_ID_1"][$this->RowNumber])) || strlen($this->FormParameters["BORROWER_VOTER_ID_1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["BORROWER_VOTER_ID_2"][$this->RowNumber]) && count($this->FormParameters["BORROWER_VOTER_ID_2"][$this->RowNumber])) || strlen($this->FormParameters["BORROWER_VOTER_ID_2"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["BORROWER_NAME1"][$this->RowNumber]) && count($this->FormParameters["BORROWER_NAME1"][$this->RowNumber])) || strlen($this->FormParameters["BORROWER_NAME1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["BORROWER_NAME2"][$this->RowNumber]) && count($this->FormParameters["BORROWER_NAME2"][$this->RowNumber])) || strlen($this->FormParameters["BORROWER_NAME2"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["RELATION_TYPE1"][$this->RowNumber]) && count($this->FormParameters["RELATION_TYPE1"][$this->RowNumber])) || strlen($this->FormParameters["RELATION_TYPE1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["RELATION_TYPE2"][$this->RowNumber]) && count($this->FormParameters["RELATION_TYPE2"][$this->RowNumber])) || strlen($this->FormParameters["RELATION_TYPE2"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["RELATIVE_NAME1"][$this->RowNumber]) && count($this->FormParameters["RELATIVE_NAME1"][$this->RowNumber])) || strlen($this->FormParameters["RELATIVE_NAME1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["RELATIVE_NAME2"][$this->RowNumber]) && count($this->FormParameters["RELATIVE_NAME2"][$this->RowNumber])) || strlen($this->FormParameters["RELATIVE_NAME2"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["PINCODE_1"][$this->RowNumber]) && count($this->FormParameters["PINCODE_1"][$this->RowNumber])) || strlen($this->FormParameters["PINCODE_1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["PINCODE_2"][$this->RowNumber]) && count($this->FormParameters["PINCODE_2"][$this->RowNumber])) || strlen($this->FormParameters["PINCODE_2"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["GUARANTOR_VOTER_ID1"][$this->RowNumber]) && count($this->FormParameters["GUARANTOR_VOTER_ID1"][$this->RowNumber])) || strlen($this->FormParameters["GUARANTOR_VOTER_ID1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["GUARANTOR_VOTER_ID2"][$this->RowNumber]) && count($this->FormParameters["GUARANTOR_VOTER_ID2"][$this->RowNumber])) || strlen($this->FormParameters["GUARANTOR_VOTER_ID2"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["KYC_ENTERED_BY"][$this->RowNumber]) && count($this->FormParameters["KYC_ENTERED_BY"][$this->RowNumber])) || strlen($this->FormParameters["KYC_ENTERED_BY"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["KYC_DEDUPED_BY"][$this->RowNumber]) && count($this->FormParameters["KYC_DEDUPED_BY"][$this->RowNumber])) || strlen($this->FormParameters["KYC_DEDUPED_BY"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @188-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @188-6B923CC2
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

//UpdateGrid Method @188-D43043BE
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["la_id"] = $this->CachedColumns["la_id"][$this->RowNumber];
            $this->DataSource->CachedColumns["HV NO"] = $this->CachedColumns["HV NO"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->GP_NO->SetText($this->FormParameters["GP_NO"][$this->RowNumber], $this->RowNumber);
            $this->HV_NO->SetText($this->FormParameters["HV_NO"][$this->RowNumber], $this->RowNumber);
            $this->KYC_TYPE_1->SetText($this->FormParameters["KYC_TYPE_1"][$this->RowNumber], $this->RowNumber);
            $this->KYC_TYPE_2->SetText($this->FormParameters["KYC_TYPE_2"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_VOTER_ID_1->SetText($this->FormParameters["BORROWER_VOTER_ID_1"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_VOTER_ID_2->SetText($this->FormParameters["BORROWER_VOTER_ID_2"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_NAME1->SetText($this->FormParameters["BORROWER_NAME1"][$this->RowNumber], $this->RowNumber);
            $this->BORROWER_NAME2->SetText($this->FormParameters["BORROWER_NAME2"][$this->RowNumber], $this->RowNumber);
            $this->RELATION_TYPE1->SetText($this->FormParameters["RELATION_TYPE1"][$this->RowNumber], $this->RowNumber);
            $this->RELATION_TYPE2->SetText($this->FormParameters["RELATION_TYPE2"][$this->RowNumber], $this->RowNumber);
            $this->RELATIVE_NAME1->SetText($this->FormParameters["RELATIVE_NAME1"][$this->RowNumber], $this->RowNumber);
            $this->RELATIVE_NAME2->SetText($this->FormParameters["RELATIVE_NAME2"][$this->RowNumber], $this->RowNumber);
            $this->PINCODE_1->SetText($this->FormParameters["PINCODE_1"][$this->RowNumber], $this->RowNumber);
            $this->PINCODE_2->SetText($this->FormParameters["PINCODE_2"][$this->RowNumber], $this->RowNumber);
            $this->GUARANTOR_VOTER_ID1->SetText($this->FormParameters["GUARANTOR_VOTER_ID1"][$this->RowNumber], $this->RowNumber);
            $this->GUARANTOR_VOTER_ID2->SetText($this->FormParameters["GUARANTOR_VOTER_ID2"][$this->RowNumber], $this->RowNumber);
            $this->KYC_ENTERED_BY->SetText($this->FormParameters["KYC_ENTERED_BY"][$this->RowNumber], $this->RowNumber);
            $this->KYC_DEDUPED_BY->SetText($this->FormParameters["KYC_DEDUPED_BY"][$this->RowNumber], $this->RowNumber);
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

//FormScript Method @188-3EFB0512
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var ybl_kyc_mfi_hvf1Elements;\n";
        $script .= "var ybl_kyc_mfi_hvf1EmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "GP_NOID = 0;\n";
        $script .= "var " . $this->ComponentName . "HV_NOID = 1;\n";
        $script .= "var " . $this->ComponentName . "KYC_TYPE_1ID = 2;\n";
        $script .= "var " . $this->ComponentName . "KYC_TYPE_2ID = 3;\n";
        $script .= "var " . $this->ComponentName . "BORROWER_VOTER_ID_1ID = 4;\n";
        $script .= "var " . $this->ComponentName . "BORROWER_VOTER_ID_2ID = 5;\n";
        $script .= "var " . $this->ComponentName . "BORROWER_NAME1ID = 6;\n";
        $script .= "var " . $this->ComponentName . "BORROWER_NAME2ID = 7;\n";
        $script .= "var " . $this->ComponentName . "RELATION_TYPE1ID = 8;\n";
        $script .= "var " . $this->ComponentName . "RELATION_TYPE2ID = 9;\n";
        $script .= "var " . $this->ComponentName . "RELATIVE_NAME1ID = 10;\n";
        $script .= "var " . $this->ComponentName . "RELATIVE_NAME2ID = 11;\n";
        $script .= "var " . $this->ComponentName . "PINCODE_1ID = 12;\n";
        $script .= "var " . $this->ComponentName . "PINCODE_2ID = 13;\n";
        $script .= "var " . $this->ComponentName . "GUARANTOR_VOTER_ID1ID = 14;\n";
        $script .= "var " . $this->ComponentName . "GUARANTOR_VOTER_ID2ID = 15;\n";
        $script .= "var " . $this->ComponentName . "KYC_ENTERED_BYID = 16;\n";
        $script .= "var " . $this->ComponentName . "KYC_DEDUPED_BYID = 17;\n";
        $script .= "\nfunction initybl_kyc_mfi_hvf1Elements() {\n";
        $script .= "\tvar ED = document.forms[\"ybl_kyc_mfi_hvf1\"];\n";
        $script .= "\tybl_kyc_mfi_hvf1Elements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.GP_NO_" . $i . ", " . "ED.HV_NO_" . $i . ", " . "ED.KYC_TYPE_1_" . $i . ", " . "ED.KYC_TYPE_2_" . $i . ", " . "ED.BORROWER_VOTER_ID_1_" . $i . ", " . "ED.BORROWER_VOTER_ID_2_" . $i . ", " . "ED.BORROWER_NAME1_" . $i . ", " . "ED.BORROWER_NAME2_" . $i . ", " . "ED.RELATION_TYPE1_" . $i . ", " . "ED.RELATION_TYPE2_" . $i . ", " . "ED.RELATIVE_NAME1_" . $i . ", " . "ED.RELATIVE_NAME2_" . $i . ", " . "ED.PINCODE_1_" . $i . ", " . "ED.PINCODE_2_" . $i . ", " . "ED.GUARANTOR_VOTER_ID1_" . $i . ", " . "ED.GUARANTOR_VOTER_ID2_" . $i . ", " . "ED.KYC_ENTERED_BY_" . $i . ", " . "ED.KYC_DEDUPED_BY_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @188-7B9F5911
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
            for($i = 2; $i < sizeof($pieces); $i = $i + 2)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["la_id"][$RowNumber] = $piece;
                $piece = $pieces[$i + 1];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["HV NO"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["la_id"][$RowNumber] = "";
                $this->CachedColumns["HV NO"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @188-FF68F46C
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["la_id"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["HV NO"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @188-EB8A04A4
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
        $this->ControlsVisible["GP_NO"] = $this->GP_NO->Visible;
        $this->ControlsVisible["HV_NO"] = $this->HV_NO->Visible;
        $this->ControlsVisible["KYC_TYPE_1"] = $this->KYC_TYPE_1->Visible;
        $this->ControlsVisible["KYC_TYPE_2"] = $this->KYC_TYPE_2->Visible;
        $this->ControlsVisible["BORROWER_VOTER_ID_1"] = $this->BORROWER_VOTER_ID_1->Visible;
        $this->ControlsVisible["BORROWER_VOTER_ID_2"] = $this->BORROWER_VOTER_ID_2->Visible;
        $this->ControlsVisible["BORROWER_NAME1"] = $this->BORROWER_NAME1->Visible;
        $this->ControlsVisible["BORROWER_NAME2"] = $this->BORROWER_NAME2->Visible;
        $this->ControlsVisible["RELATION_TYPE1"] = $this->RELATION_TYPE1->Visible;
        $this->ControlsVisible["RELATION_TYPE2"] = $this->RELATION_TYPE2->Visible;
        $this->ControlsVisible["RELATIVE_NAME1"] = $this->RELATIVE_NAME1->Visible;
        $this->ControlsVisible["RELATIVE_NAME2"] = $this->RELATIVE_NAME2->Visible;
        $this->ControlsVisible["PINCODE_1"] = $this->PINCODE_1->Visible;
        $this->ControlsVisible["PINCODE_2"] = $this->PINCODE_2->Visible;
        $this->ControlsVisible["GUARANTOR_VOTER_ID1"] = $this->GUARANTOR_VOTER_ID1->Visible;
        $this->ControlsVisible["GUARANTOR_VOTER_ID2"] = $this->GUARANTOR_VOTER_ID2->Visible;
        $this->ControlsVisible["KYC_ENTERED_BY"] = $this->KYC_ENTERED_BY->Visible;
        $this->ControlsVisible["KYC_DEDUPED_BY"] = $this->KYC_DEDUPED_BY->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["la_id"][$this->RowNumber] = $this->DataSource->CachedColumns["la_id"];
                    $this->CachedColumns["HV NO"][$this->RowNumber] = $this->DataSource->CachedColumns["HV NO"];
                    $this->GP_NO->SetValue($this->DataSource->GP_NO->GetValue());
                    $this->HV_NO->SetValue($this->DataSource->HV_NO->GetValue());
                    $this->KYC_TYPE_1->SetValue($this->DataSource->KYC_TYPE_1->GetValue());
                    $this->KYC_TYPE_2->SetValue($this->DataSource->KYC_TYPE_2->GetValue());
                    $this->BORROWER_VOTER_ID_1->SetValue($this->DataSource->BORROWER_VOTER_ID_1->GetValue());
                    $this->BORROWER_VOTER_ID_2->SetValue($this->DataSource->BORROWER_VOTER_ID_2->GetValue());
                    $this->BORROWER_NAME1->SetValue($this->DataSource->BORROWER_NAME1->GetValue());
                    $this->BORROWER_NAME2->SetValue($this->DataSource->BORROWER_NAME2->GetValue());
                    $this->RELATION_TYPE1->SetValue($this->DataSource->RELATION_TYPE1->GetValue());
                    $this->RELATION_TYPE2->SetValue($this->DataSource->RELATION_TYPE2->GetValue());
                    $this->RELATIVE_NAME1->SetValue($this->DataSource->RELATIVE_NAME1->GetValue());
                    $this->RELATIVE_NAME2->SetValue($this->DataSource->RELATIVE_NAME2->GetValue());
                    $this->PINCODE_1->SetValue($this->DataSource->PINCODE_1->GetValue());
                    $this->PINCODE_2->SetValue($this->DataSource->PINCODE_2->GetValue());
                    $this->GUARANTOR_VOTER_ID1->SetValue($this->DataSource->GUARANTOR_VOTER_ID1->GetValue());
                    $this->GUARANTOR_VOTER_ID2->SetValue($this->DataSource->GUARANTOR_VOTER_ID2->GetValue());
                    $this->KYC_ENTERED_BY->SetValue($this->DataSource->KYC_ENTERED_BY->GetValue());
                    $this->KYC_DEDUPED_BY->SetValue($this->DataSource->KYC_DEDUPED_BY->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->GP_NO->SetText($this->FormParameters["GP_NO"][$this->RowNumber], $this->RowNumber);
                    $this->HV_NO->SetText($this->FormParameters["HV_NO"][$this->RowNumber], $this->RowNumber);
                    $this->KYC_TYPE_1->SetText($this->FormParameters["KYC_TYPE_1"][$this->RowNumber], $this->RowNumber);
                    $this->KYC_TYPE_2->SetText($this->FormParameters["KYC_TYPE_2"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_VOTER_ID_1->SetText($this->FormParameters["BORROWER_VOTER_ID_1"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_VOTER_ID_2->SetText($this->FormParameters["BORROWER_VOTER_ID_2"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_NAME1->SetText($this->FormParameters["BORROWER_NAME1"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_NAME2->SetText($this->FormParameters["BORROWER_NAME2"][$this->RowNumber], $this->RowNumber);
                    $this->RELATION_TYPE1->SetText($this->FormParameters["RELATION_TYPE1"][$this->RowNumber], $this->RowNumber);
                    $this->RELATION_TYPE2->SetText($this->FormParameters["RELATION_TYPE2"][$this->RowNumber], $this->RowNumber);
                    $this->RELATIVE_NAME1->SetText($this->FormParameters["RELATIVE_NAME1"][$this->RowNumber], $this->RowNumber);
                    $this->RELATIVE_NAME2->SetText($this->FormParameters["RELATIVE_NAME2"][$this->RowNumber], $this->RowNumber);
                    $this->PINCODE_1->SetText($this->FormParameters["PINCODE_1"][$this->RowNumber], $this->RowNumber);
                    $this->PINCODE_2->SetText($this->FormParameters["PINCODE_2"][$this->RowNumber], $this->RowNumber);
                    $this->GUARANTOR_VOTER_ID1->SetText($this->FormParameters["GUARANTOR_VOTER_ID1"][$this->RowNumber], $this->RowNumber);
                    $this->GUARANTOR_VOTER_ID2->SetText($this->FormParameters["GUARANTOR_VOTER_ID2"][$this->RowNumber], $this->RowNumber);
                    $this->KYC_ENTERED_BY->SetText($this->FormParameters["KYC_ENTERED_BY"][$this->RowNumber], $this->RowNumber);
                    $this->KYC_DEDUPED_BY->SetText($this->FormParameters["KYC_DEDUPED_BY"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["la_id"][$this->RowNumber] = "";
                    $this->CachedColumns["HV NO"][$this->RowNumber] = "";
                    $this->GP_NO->SetText("");
                    $this->HV_NO->SetText("");
                    $this->KYC_TYPE_1->SetText("");
                    $this->KYC_TYPE_2->SetText("");
                    $this->BORROWER_VOTER_ID_1->SetText("");
                    $this->BORROWER_VOTER_ID_2->SetText("");
                    $this->BORROWER_NAME1->SetText("");
                    $this->BORROWER_NAME2->SetText("");
                    $this->RELATION_TYPE1->SetText("");
                    $this->RELATION_TYPE2->SetText("");
                    $this->RELATIVE_NAME1->SetText("");
                    $this->RELATIVE_NAME2->SetText("");
                    $this->PINCODE_1->SetText("");
                    $this->PINCODE_2->SetText("");
                    $this->GUARANTOR_VOTER_ID1->SetText("");
                    $this->GUARANTOR_VOTER_ID2->SetText("");
                    $this->KYC_ENTERED_BY->SetText("");
                    $this->KYC_DEDUPED_BY->SetText("");
                } else {
                    $this->GP_NO->SetText($this->FormParameters["GP_NO"][$this->RowNumber], $this->RowNumber);
                    $this->HV_NO->SetText($this->FormParameters["HV_NO"][$this->RowNumber], $this->RowNumber);
                    $this->KYC_TYPE_1->SetText($this->FormParameters["KYC_TYPE_1"][$this->RowNumber], $this->RowNumber);
                    $this->KYC_TYPE_2->SetText($this->FormParameters["KYC_TYPE_2"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_VOTER_ID_1->SetText($this->FormParameters["BORROWER_VOTER_ID_1"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_VOTER_ID_2->SetText($this->FormParameters["BORROWER_VOTER_ID_2"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_NAME1->SetText($this->FormParameters["BORROWER_NAME1"][$this->RowNumber], $this->RowNumber);
                    $this->BORROWER_NAME2->SetText($this->FormParameters["BORROWER_NAME2"][$this->RowNumber], $this->RowNumber);
                    $this->RELATION_TYPE1->SetText($this->FormParameters["RELATION_TYPE1"][$this->RowNumber], $this->RowNumber);
                    $this->RELATION_TYPE2->SetText($this->FormParameters["RELATION_TYPE2"][$this->RowNumber], $this->RowNumber);
                    $this->RELATIVE_NAME1->SetText($this->FormParameters["RELATIVE_NAME1"][$this->RowNumber], $this->RowNumber);
                    $this->RELATIVE_NAME2->SetText($this->FormParameters["RELATIVE_NAME2"][$this->RowNumber], $this->RowNumber);
                    $this->PINCODE_1->SetText($this->FormParameters["PINCODE_1"][$this->RowNumber], $this->RowNumber);
                    $this->PINCODE_2->SetText($this->FormParameters["PINCODE_2"][$this->RowNumber], $this->RowNumber);
                    $this->GUARANTOR_VOTER_ID1->SetText($this->FormParameters["GUARANTOR_VOTER_ID1"][$this->RowNumber], $this->RowNumber);
                    $this->GUARANTOR_VOTER_ID2->SetText($this->FormParameters["GUARANTOR_VOTER_ID2"][$this->RowNumber], $this->RowNumber);
                    $this->KYC_ENTERED_BY->SetText($this->FormParameters["KYC_ENTERED_BY"][$this->RowNumber], $this->RowNumber);
                    $this->KYC_DEDUPED_BY->SetText($this->FormParameters["KYC_DEDUPED_BY"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->GP_NO->Show($this->RowNumber);
                $this->HV_NO->Show($this->RowNumber);
                $this->KYC_TYPE_1->Show($this->RowNumber);
                $this->KYC_TYPE_2->Show($this->RowNumber);
                $this->BORROWER_VOTER_ID_1->Show($this->RowNumber);
                $this->BORROWER_VOTER_ID_2->Show($this->RowNumber);
                $this->BORROWER_NAME1->Show($this->RowNumber);
                $this->BORROWER_NAME2->Show($this->RowNumber);
                $this->RELATION_TYPE1->Show($this->RowNumber);
                $this->RELATION_TYPE2->Show($this->RowNumber);
                $this->RELATIVE_NAME1->Show($this->RowNumber);
                $this->RELATIVE_NAME2->Show($this->RowNumber);
                $this->PINCODE_1->Show($this->RowNumber);
                $this->PINCODE_2->Show($this->RowNumber);
                $this->GUARANTOR_VOTER_ID1->Show($this->RowNumber);
                $this->GUARANTOR_VOTER_ID2->Show($this->RowNumber);
                $this->KYC_ENTERED_BY->Show($this->RowNumber);
                $this->KYC_DEDUPED_BY->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["la_id"] == $this->CachedColumns["la_id"][$this->RowNumber]) && ($this->DataSource->CachedColumns["HV NO"] == $this->CachedColumns["HV NO"][$this->RowNumber])) {
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
        $this->Button_Submit->Show();
        $this->Cancel->Show();
        $this->Label1->Show();

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

} //End ybl_kyc_mfi_hvf1 Class @188-FCB6E20C

class clsybl_kyc_mfi_hvf1DataSource extends clsDBmysql_cams_v2 {  //ybl_kyc_mfi_hvf1DataSource Class @188-5164D480

//DataSource Variables @188-D74EBB8E
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;

    // Datasource fields
    public $GP_NO;
    public $HV_NO;
    public $KYC_TYPE_1;
    public $KYC_TYPE_2;
    public $BORROWER_VOTER_ID_1;
    public $BORROWER_VOTER_ID_2;
    public $BORROWER_NAME1;
    public $BORROWER_NAME2;
    public $RELATION_TYPE1;
    public $RELATION_TYPE2;
    public $RELATIVE_NAME1;
    public $RELATIVE_NAME2;
    public $PINCODE_1;
    public $PINCODE_2;
    public $GUARANTOR_VOTER_ID1;
    public $GUARANTOR_VOTER_ID2;
    public $KYC_ENTERED_BY;
    public $KYC_DEDUPED_BY;
//End DataSource Variables

//DataSourceClass_Initialize Event @188-3BA197D3
    function clsybl_kyc_mfi_hvf1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid ybl_kyc_mfi_hvf1/Error";
        $this->Initialize();
        $this->GP_NO = new clsField("GP_NO", ccsText, "");
        
        $this->HV_NO = new clsField("HV_NO", ccsText, "");
        
        $this->KYC_TYPE_1 = new clsField("KYC_TYPE_1", ccsText, "");
        
        $this->KYC_TYPE_2 = new clsField("KYC_TYPE_2", ccsText, "");
        
        $this->BORROWER_VOTER_ID_1 = new clsField("BORROWER_VOTER_ID_1", ccsText, "");
        
        $this->BORROWER_VOTER_ID_2 = new clsField("BORROWER_VOTER_ID_2", ccsText, "");
        
        $this->BORROWER_NAME1 = new clsField("BORROWER_NAME1", ccsText, "");
        
        $this->BORROWER_NAME2 = new clsField("BORROWER_NAME2", ccsText, "");
        
        $this->RELATION_TYPE1 = new clsField("RELATION_TYPE1", ccsText, "");
        
        $this->RELATION_TYPE2 = new clsField("RELATION_TYPE2", ccsText, "");
        
        $this->RELATIVE_NAME1 = new clsField("RELATIVE_NAME1", ccsText, "");
        
        $this->RELATIVE_NAME2 = new clsField("RELATIVE_NAME2", ccsText, "");
        
        $this->PINCODE_1 = new clsField("PINCODE_1", ccsInteger, "");
        
        $this->PINCODE_2 = new clsField("PINCODE_2", ccsInteger, "");
        
        $this->GUARANTOR_VOTER_ID1 = new clsField("GUARANTOR_VOTER_ID1", ccsText, "");
        
        $this->GUARANTOR_VOTER_ID2 = new clsField("GUARANTOR_VOTER_ID2", ccsText, "");
        
        $this->KYC_ENTERED_BY = new clsField("KYC_ENTERED_BY", ccsText, "");
        
        $this->KYC_DEDUPED_BY = new clsField("KYC_DEDUPED_BY", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @188-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @188-E2CE1546
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_GP_No", ccsText, "", "", $this->Parameters["urls_GP_No"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_hvf1.gp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @188-609723E2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_kyc ON\n\n" .
        "mfi_hvf1.la_id = mfi_kyc.la_id";
        $this->SQL = "SELECT gp_id, mfi_kyc.* \n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_kyc ON\n\n" .
        "mfi_hvf1.la_id = mfi_kyc.la_id {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @188-1E11A3AB
    function SetValues()
    {
        $this->CachedColumns["la_id"] = $this->f("la_id");
        $this->CachedColumns["HV NO"] = $this->f("HV NO");
        $this->GP_NO->SetDBValue($this->f("GP NO"));
        $this->HV_NO->SetDBValue($this->f("la_id"));
        $this->KYC_TYPE_1->SetDBValue($this->f("kyc_type_primary_1"));
        $this->KYC_TYPE_2->SetDBValue($this->f("kyc_type_primary_2"));
        $this->BORROWER_VOTER_ID_1->SetDBValue($this->f("kyc_id_primary_1"));
        $this->BORROWER_VOTER_ID_2->SetDBValue($this->f("kyc_id_primary_2"));
        $this->BORROWER_NAME1->SetDBValue($this->f("member_name_1"));
        $this->BORROWER_NAME2->SetDBValue($this->f("member_name_2"));
        $this->RELATION_TYPE1->SetDBValue($this->f("member_relation_type_1"));
        $this->RELATION_TYPE2->SetDBValue($this->f("member_relation_type_2"));
        $this->RELATIVE_NAME1->SetDBValue($this->f("relation_name_1"));
        $this->RELATIVE_NAME2->SetDBValue($this->f("relation_name_2"));
        $this->PINCODE_1->SetDBValue(trim($this->f("pincode_1")));
        $this->PINCODE_2->SetDBValue(trim($this->f("pincode_2")));
        $this->GUARANTOR_VOTER_ID1->SetDBValue($this->f("guarantor_kyc_id_primery_1"));
        $this->GUARANTOR_VOTER_ID2->SetDBValue($this->f("guarantor_kyc_id_primery_2"));
        $this->KYC_ENTERED_BY->SetDBValue($this->f("added_by_1"));
        $this->KYC_DEDUPED_BY->SetDBValue($this->f("added_by_2"));
    }
//End SetValues Method

} //End ybl_kyc_mfi_hvf1DataSource Class @188-FCB6E20C



//Initialize Page @1-ED80F614
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
$TemplateFileName = "manageHV_PAGE12.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F11BEF1F
include_once("./manageHV_PAGE12_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-14D5C4B9
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incHeader = new clsincHeader("", "incHeader", $MainPage);
$incHeader->Initialize();
$incFooter = new clsincFooter("", "incFooter", $MainPage);
$incFooter->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$mfi_hvf1 = new clsEditableGridmfi_hvf1("", $MainPage);
$mfi_hvf3_mfi_hvf1 = new clsEditableGridmfi_hvf3_mfi_hvf1("", $MainPage);
$mfi_hvf1_mfi_hvf3 = new clsRecordmfi_hvf1_mfi_hvf3("", $MainPage);
$mfi_hvf2 = new clsGridmfi_hvf2("", $MainPage);
$ybl_kyc_mfi_hvf1 = new clsEditableGridybl_kyc_mfi_hvf1("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$MainPage->incMenu = & $incMenu;
$MainPage->mfi_hvf1 = & $mfi_hvf1;
$MainPage->mfi_hvf3_mfi_hvf1 = & $mfi_hvf3_mfi_hvf1;
$MainPage->mfi_hvf1_mfi_hvf3 = & $mfi_hvf1_mfi_hvf3;
$MainPage->mfi_hvf2 = & $mfi_hvf2;
$MainPage->ybl_kyc_mfi_hvf1 = & $ybl_kyc_mfi_hvf1;
$mfi_hvf1->Initialize();
$mfi_hvf3_mfi_hvf1->Initialize();
$mfi_hvf2->Initialize();
$ybl_kyc_mfi_hvf1->Initialize();

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

//Execute Components @1-C7EC0293
$ybl_kyc_mfi_hvf1->Operation();
$mfi_hvf1_mfi_hvf3->Operation();
$mfi_hvf3_mfi_hvf1->Operation();
$mfi_hvf1->Operation();
$incMenu->Operations();
$incFooter->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-EFF560E8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incFooter->Class_Terminate();
    unset($incFooter);
    $incMenu->Class_Terminate();
    unset($incMenu);
    unset($mfi_hvf1);
    unset($mfi_hvf3_mfi_hvf1);
    unset($mfi_hvf1_mfi_hvf3);
    unset($mfi_hvf2);
    unset($ybl_kyc_mfi_hvf1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0E5D84C7
$incHeader->Show();
$incFooter->Show();
$incMenu->Show();
$mfi_hvf1->Show();
$mfi_hvf3_mfi_hvf1->Show();
$mfi_hvf1_mfi_hvf3->Show();
$mfi_hvf2->Show();
$ybl_kyc_mfi_hvf1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A9A35487
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
unset($mfi_hvf1);
unset($mfi_hvf3_mfi_hvf1);
unset($mfi_hvf1_mfi_hvf3);
unset($mfi_hvf2);
unset($ybl_kyc_mfi_hvf1);
unset($Tpl);
//End Unload Page


?>
