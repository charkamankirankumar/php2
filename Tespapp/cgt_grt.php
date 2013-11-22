<?php
//Include Common Files @1-8F895C4E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "cgt_grt.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

//Include Page implementation @2-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation



class clsRecordcamsdata123_cgt_grtSearch { //camsdata123_cgt_grtSearch Class @33-84273E26

//Variables @33-9E315808

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

//Class_Initialize Event @33-3673CD5E
    function clsRecordcamsdata123_cgt_grtSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record camsdata123_cgt_grtSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "camsdata123_cgt_grtSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_GP_NO = new clsControl(ccsListBox, "s_GP_NO", "s_GP_NO", ccsText, "", CCGetRequestParam("s_GP_NO", $Method, NULL), $this);
            $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsTable;
            $this->ListBox1->DataSource = new clsDBmysql_cams_v2();
            $this->ListBox1->ds = & $this->ListBox1->DataSource;
            $this->ListBox1->DataSource->SQL = "SELECT BRANCH, ROUTE_CODE \n" .
"FROM camsdata123_grid {SQL_Where}\n" .
"GROUP BY BRANCH {SQL_OrderBy}";
            list($this->ListBox1->BoundColumn, $this->ListBox1->TextColumn, $this->ListBox1->DBFormat) = array("ROUTE_CODE", "ROUTE_CODE", "");
            $this->ListBox1->DataSource->Parameters["cookregion"] = CCGetCookie("region", NULL);
            $this->ListBox1->DataSource->wp = new clsSQLParameters();
            $this->ListBox1->DataSource->wp->AddParameter("1", "cookregion", ccsText, "", "", $this->ListBox1->DataSource->Parameters["cookregion"], "", false);
            $this->ListBox1->DataSource->wp->Criterion[1] = $this->ListBox1->DataSource->wp->Operation(opContains, "ROUTE_CODE", $this->ListBox1->DataSource->wp->GetDBValue("1"), $this->ListBox1->DataSource->ToSQL($this->ListBox1->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->ListBox1->DataSource->Where = 
                 $this->ListBox1->DataSource->wp->Criterion[1];
            $this->ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @33-2A5BDFB3
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_GP_NO->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->ListBox2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_GP_NO->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @33-9807E9A8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_GP_NO->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->ListBox2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @33-144FBB7D
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
        $Redirect = "cgt_grt.php" . "?" . CCGetQueryString("All", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "cgt_grt.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_GP_NO", "ListBox1", "ListBox2", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @33-4F85F368
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

        $this->s_GP_NO->Prepare();
        $this->ListBox1->Prepare();
        $this->ListBox2->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_GP_NO->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        if($this->FormSubmitted || CCGetFromGet("ccsForm")) {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        } else {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("All", ""), "ccsForm", $CCSForm);
        }
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
        $this->s_GP_NO->Show();
        $this->ListBox1->Show();
        $this->ListBox2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End camsdata123_cgt_grtSearch Class @33-FCB6E20C

class clsEditableGridmfi_hvf1_mfi_hvf2 { //mfi_hvf1_mfi_hvf2 Class @168-EA62AF1E

//Variables @168-B861FE5A

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
    public $Sorter_mfi_hvf2_la_id;
    public $Sorter_mfi_hvf1_customer_name;
    public $Sorter_mfi_hvf1_customer_father_name;
    public $Sorter_mfi_hvf1_customer_husband_name;
    public $Sorter_final_result;
    public $Sorter_mfi_hvf2_loan_amount;
    public $Sorter_tdb_result;
//End Variables

//Class_Initialize Event @168-D3BF0C6B
    function clsEditableGridmfi_hvf1_mfi_hvf2($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid mfi_hvf1_mfi_hvf2/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "mfi_hvf1_mfi_hvf2";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["la_id"][0] = "la_id";
        $this->CachedColumns["la_id"][0] = "la_id";
        $this->DataSource = new clsmfi_hvf1_mfi_hvf2DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
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

        $this->SorterName = CCGetParam("mfi_hvf1_mfi_hvf2Order", "");
        $this->SorterDirection = CCGetParam("mfi_hvf1_mfi_hvf2Dir", "");

        $this->Sorter_mfi_hvf2_la_id = new clsSorter($this->ComponentName, "Sorter_mfi_hvf2_la_id", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_name = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_name", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_father_name = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_father_name", $FileName, $this);
        $this->Sorter_mfi_hvf1_customer_husband_name = new clsSorter($this->ComponentName, "Sorter_mfi_hvf1_customer_husband_name", $FileName, $this);
        $this->Sorter_final_result = new clsSorter($this->ComponentName, "Sorter_final_result", $FileName, $this);
        $this->Sorter_mfi_hvf2_loan_amount = new clsSorter($this->ComponentName, "Sorter_mfi_hvf2_loan_amount", $FileName, $this);
        $this->Sorter_tdb_result = new clsSorter($this->ComponentName, "Sorter_tdb_result", $FileName, $this);
        $this->mfi_hvf2_la_id = new clsControl(ccsLabel, "mfi_hvf2_la_id", "mfi_hvf2_la_id", ccsText, "", NULL, $this);
        $this->mfi_hvf1_customer_name = new clsControl(ccsLabel, "mfi_hvf1_customer_name", "mfi_hvf1_customer_name", ccsText, "", NULL, $this);
        $this->mfi_hvf1_customer_father_name = new clsControl(ccsLabel, "mfi_hvf1_customer_father_name", "mfi_hvf1_customer_father_name", ccsText, "", NULL, $this);
        $this->mfi_hvf1_customer_husband_name = new clsControl(ccsLabel, "mfi_hvf1_customer_husband_name", "mfi_hvf1_customer_husband_name", ccsText, "", NULL, $this);
        $this->final_result = new clsControl(ccsLabel, "final_result", "final_result", ccsText, "", NULL, $this);
        $this->mfi_hvf2_loan_amount = new clsControl(ccsTextBox, "mfi_hvf2_loan_amount", $CCSLocales->GetText("mfi_hvf2_loan_amount"), ccsInteger, "", NULL, $this);
        $this->mfi_hvf2_loan_amount->Required = true;
        $this->tdb_result = new clsControl(ccsCheckBox, "tdb_result", $CCSLocales->GetText("tdb_result"), ccsText, "", NULL, $this);
        $this->tdb_result->CheckedValue = $this->tdb_result->GetParsedValue("Y");
        $this->tdb_result->UncheckedValue = $this->tdb_result->GetParsedValue("N");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", NULL, $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link1->Page = "";
        $this->freq = new clsControl(ccsHidden, "freq", "freq", ccsText, "", NULL, $this);
        $this->RequestTbd = new clsButton("RequestTbd", $Method, $this);
        $this->Button1 = new clsButton("Button1", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @168-7E321CA4
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_GP_NO"] = CCGetFromGet("s_GP_NO", NULL);
    }
//End Initialize Method

//GetFormParameters Method @168-6B2E7FD6
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["mfi_hvf2_loan_amount"][$RowNumber] = CCGetFromPost("mfi_hvf2_loan_amount_" . $RowNumber, NULL);
            $this->FormParameters["tdb_result"][$RowNumber] = CCGetFromPost("tdb_result_" . $RowNumber, NULL);
            $this->FormParameters["freq"][$RowNumber] = CCGetFromPost("freq_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @168-995DFD75
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["la_id"] = $this->CachedColumns["la_id"][$this->RowNumber];
            $this->DataSource->CachedColumns["la_id"] = $this->CachedColumns["la_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->mfi_hvf2_loan_amount->SetText($this->FormParameters["mfi_hvf2_loan_amount"][$this->RowNumber], $this->RowNumber);
            $this->tdb_result->SetText($this->FormParameters["tdb_result"][$this->RowNumber], $this->RowNumber);
            $this->freq->SetText($this->FormParameters["freq"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @168-D362275A
    function ValidateRow()
    {
        global $CCSLocales;
        $this->mfi_hvf2_loan_amount->Validate();
        $this->tdb_result->Validate();
        $this->freq->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_hvf2_loan_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tdb_result->Errors->ToString());
        $errors = ComposeStrings($errors, $this->freq->Errors->ToString());
        $this->mfi_hvf2_loan_amount->Errors->Clear();
        $this->tdb_result->Errors->Clear();
        $this->freq->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @168-83744783
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["mfi_hvf2_loan_amount"][$this->RowNumber]) && count($this->FormParameters["mfi_hvf2_loan_amount"][$this->RowNumber])) || strlen($this->FormParameters["mfi_hvf2_loan_amount"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["tdb_result"][$this->RowNumber]) && count($this->FormParameters["tdb_result"][$this->RowNumber])) || strlen($this->FormParameters["tdb_result"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["freq"][$this->RowNumber]) && count($this->FormParameters["freq"][$this->RowNumber])) || strlen($this->FormParameters["freq"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @168-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @168-A6EB00DC
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
        } else if($this->RequestTbd->Pressed) {
            $this->PressedButton = "RequestTbd";
        } else if($this->Button1->Pressed) {
            $this->PressedButton = "Button1";
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
        } else if($this->PressedButton == "RequestTbd") {
            if(!CCGetEvent($this->RequestTbd->CCSEvents, "OnClick", $this->RequestTbd)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button1") {
            if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @168-A74C6D5F
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["la_id"] = $this->CachedColumns["la_id"][$this->RowNumber];
            $this->DataSource->CachedColumns["la_id"] = $this->CachedColumns["la_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->mfi_hvf2_loan_amount->SetText($this->FormParameters["mfi_hvf2_loan_amount"][$this->RowNumber], $this->RowNumber);
            $this->tdb_result->SetText($this->FormParameters["tdb_result"][$this->RowNumber], $this->RowNumber);
            $this->freq->SetText($this->FormParameters["freq"][$this->RowNumber], $this->RowNumber);
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

//UpdateRow Method @168-9ED0C042
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->mfi_hvf2_la_id->SetValue($this->mfi_hvf2_la_id->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_name->SetValue($this->mfi_hvf1_customer_name->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_father_name->SetValue($this->mfi_hvf1_customer_father_name->GetValue(true));
        $this->DataSource->mfi_hvf1_customer_husband_name->SetValue($this->mfi_hvf1_customer_husband_name->GetValue(true));
        $this->DataSource->final_result->SetValue($this->final_result->GetValue(true));
        $this->DataSource->mfi_hvf2_loan_amount->SetValue($this->mfi_hvf2_loan_amount->GetValue(true));
        $this->DataSource->tdb_result->SetValue($this->tdb_result->GetValue(true));
        $this->DataSource->freq->SetValue($this->freq->GetValue(true));
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

//FormScript Method @168-8FC6E7B5
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var mfi_hvf1_mfi_hvf2Elements;\n";
        $script .= "var mfi_hvf1_mfi_hvf2EmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "mfi_hvf2_loan_amountID = 0;\n";
        $script .= "var " . $this->ComponentName . "tdb_resultID = 1;\n";
        $script .= "var " . $this->ComponentName . "freqID = 2;\n";
        $script .= "\nfunction initmfi_hvf1_mfi_hvf2Elements() {\n";
        $script .= "\tvar ED = document.forms[\"mfi_hvf1_mfi_hvf2\"];\n";
        $script .= "\tmfi_hvf1_mfi_hvf2Elements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.mfi_hvf2_loan_amount_" . $i . ", " . "ED.tdb_result_" . $i . ", " . "ED.freq_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @168-8484DF4C
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
                $this->CachedColumns["la_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["la_id"][$RowNumber] = "";
                $this->CachedColumns["la_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @168-B4D8FFF0
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["la_id"][$i]));
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["la_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @168-C9D02ADE
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
        $this->ControlsVisible["mfi_hvf2_la_id"] = $this->mfi_hvf2_la_id->Visible;
        $this->ControlsVisible["mfi_hvf1_customer_name"] = $this->mfi_hvf1_customer_name->Visible;
        $this->ControlsVisible["mfi_hvf1_customer_father_name"] = $this->mfi_hvf1_customer_father_name->Visible;
        $this->ControlsVisible["mfi_hvf1_customer_husband_name"] = $this->mfi_hvf1_customer_husband_name->Visible;
        $this->ControlsVisible["final_result"] = $this->final_result->Visible;
        $this->ControlsVisible["mfi_hvf2_loan_amount"] = $this->mfi_hvf2_loan_amount->Visible;
        $this->ControlsVisible["tdb_result"] = $this->tdb_result->Visible;
        $this->ControlsVisible["freq"] = $this->freq->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["la_id"][$this->RowNumber] = $this->DataSource->CachedColumns["la_id"];
                    $this->CachedColumns["la_id"][$this->RowNumber] = $this->DataSource->CachedColumns["la_id"];
                    $this->mfi_hvf2_la_id->SetValue($this->DataSource->mfi_hvf2_la_id->GetValue());
                    $this->mfi_hvf1_customer_name->SetValue($this->DataSource->mfi_hvf1_customer_name->GetValue());
                    $this->mfi_hvf1_customer_father_name->SetValue($this->DataSource->mfi_hvf1_customer_father_name->GetValue());
                    $this->mfi_hvf1_customer_husband_name->SetValue($this->DataSource->mfi_hvf1_customer_husband_name->GetValue());
                    $this->final_result->SetValue($this->DataSource->final_result->GetValue());
                    $this->mfi_hvf2_loan_amount->SetValue($this->DataSource->mfi_hvf2_loan_amount->GetValue());
                    $this->tdb_result->SetValue($this->DataSource->tdb_result->GetValue());
                    $this->freq->SetValue($this->DataSource->freq->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->mfi_hvf2_la_id->SetText("");
                    $this->mfi_hvf1_customer_name->SetText("");
                    $this->mfi_hvf1_customer_father_name->SetText("");
                    $this->mfi_hvf1_customer_husband_name->SetText("");
                    $this->final_result->SetText("");
                    $this->mfi_hvf2_la_id->SetValue($this->DataSource->mfi_hvf2_la_id->GetValue());
                    $this->mfi_hvf1_customer_name->SetValue($this->DataSource->mfi_hvf1_customer_name->GetValue());
                    $this->mfi_hvf1_customer_father_name->SetValue($this->DataSource->mfi_hvf1_customer_father_name->GetValue());
                    $this->mfi_hvf1_customer_husband_name->SetValue($this->DataSource->mfi_hvf1_customer_husband_name->GetValue());
                    $this->final_result->SetValue($this->DataSource->final_result->GetValue());
                    $this->mfi_hvf2_loan_amount->SetText($this->FormParameters["mfi_hvf2_loan_amount"][$this->RowNumber], $this->RowNumber);
                    $this->tdb_result->SetText($this->FormParameters["tdb_result"][$this->RowNumber], $this->RowNumber);
                    $this->freq->SetText($this->FormParameters["freq"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["la_id"][$this->RowNumber] = "";
                    $this->CachedColumns["la_id"][$this->RowNumber] = "";
                    $this->mfi_hvf2_la_id->SetText("");
                    $this->mfi_hvf1_customer_name->SetText("");
                    $this->mfi_hvf1_customer_father_name->SetText("");
                    $this->mfi_hvf1_customer_husband_name->SetText("");
                    $this->final_result->SetText("");
                    $this->mfi_hvf2_loan_amount->SetText("");
                    $this->tdb_result->SetValue(true);
                    $this->freq->SetText("");
                } else {
                    $this->mfi_hvf2_la_id->SetText("");
                    $this->mfi_hvf1_customer_name->SetText("");
                    $this->mfi_hvf1_customer_father_name->SetText("");
                    $this->mfi_hvf1_customer_husband_name->SetText("");
                    $this->final_result->SetText("");
                    $this->mfi_hvf2_loan_amount->SetText($this->FormParameters["mfi_hvf2_loan_amount"][$this->RowNumber], $this->RowNumber);
                    $this->tdb_result->SetText($this->FormParameters["tdb_result"][$this->RowNumber], $this->RowNumber);
                    $this->freq->SetText($this->FormParameters["freq"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_hvf2_la_id->Show($this->RowNumber);
                $this->mfi_hvf1_customer_name->Show($this->RowNumber);
                $this->mfi_hvf1_customer_father_name->Show($this->RowNumber);
                $this->mfi_hvf1_customer_husband_name->Show($this->RowNumber);
                $this->final_result->Show($this->RowNumber);
                $this->mfi_hvf2_loan_amount->Show($this->RowNumber);
                $this->tdb_result->Show($this->RowNumber);
                $this->freq->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["la_id"] == $this->CachedColumns["la_id"][$this->RowNumber]) && ($this->DataSource->CachedColumns["la_id"] == $this->CachedColumns["la_id"][$this->RowNumber])) {
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
        $this->Sorter_mfi_hvf2_la_id->Show();
        $this->Sorter_mfi_hvf1_customer_name->Show();
        $this->Sorter_mfi_hvf1_customer_father_name->Show();
        $this->Sorter_mfi_hvf1_customer_husband_name->Show();
        $this->Sorter_final_result->Show();
        $this->Sorter_mfi_hvf2_loan_amount->Show();
        $this->Sorter_tdb_result->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();
        $this->Link1->Show();
        $this->RequestTbd->Show();
        $this->Button1->Show();

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

} //End mfi_hvf1_mfi_hvf2 Class @168-FCB6E20C

class clsmfi_hvf1_mfi_hvf2DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf1_mfi_hvf2DataSource Class @168-68135EA4

//DataSource Variables @168-25601216
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
    public $mfi_hvf2_la_id;
    public $mfi_hvf1_customer_name;
    public $mfi_hvf1_customer_father_name;
    public $mfi_hvf1_customer_husband_name;
    public $final_result;
    public $mfi_hvf2_loan_amount;
    public $tdb_result;
    public $freq;
//End DataSource Variables

//DataSourceClass_Initialize Event @168-A61A3A56
    function clsmfi_hvf1_mfi_hvf2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid mfi_hvf1_mfi_hvf2/Error";
        $this->Initialize();
        $this->mfi_hvf2_la_id = new clsField("mfi_hvf2_la_id", ccsText, "");
        
        $this->mfi_hvf1_customer_name = new clsField("mfi_hvf1_customer_name", ccsText, "");
        
        $this->mfi_hvf1_customer_father_name = new clsField("mfi_hvf1_customer_father_name", ccsText, "");
        
        $this->mfi_hvf1_customer_husband_name = new clsField("mfi_hvf1_customer_husband_name", ccsText, "");
        
        $this->final_result = new clsField("final_result", ccsText, "");
        
        $this->mfi_hvf2_loan_amount = new clsField("mfi_hvf2_loan_amount", ccsInteger, "");
        
        $this->tdb_result = new clsField("tdb_result", ccsText, "");
        
        $this->freq = new clsField("freq", ccsText, "");
        

        $this->UpdateFields["mfi_hvf2_loan_amount"] = array("Name" => "mfi_hvf2_loan_amount", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tdb_result"] = array("Name" => "tdb_result", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["mfi_hvf2_loan_group_meeting_frequency"] = array("Name" => "mfi_hvf2_loan_group_meeting_frequency", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @168-46A29CFE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mfi_hvf2_la_id" => array("mfi_hvf2_la_id", ""), 
            "Sorter_mfi_hvf1_customer_name" => array("mfi_hvf1_customer_name", ""), 
            "Sorter_mfi_hvf1_customer_father_name" => array("mfi_hvf1_customer_father_name", ""), 
            "Sorter_mfi_hvf1_customer_husband_name" => array("mfi_hvf1_customer_husband_name", ""), 
            "Sorter_final_result" => array("final_result", ""), 
            "Sorter_mfi_hvf2_loan_amount" => array("mfi_hvf2_loan_amount", ""), 
            "Sorter_tdb_result" => array("tdb_result", "")));
    }
//End SetOrder Method

//Prepare Method @168-F65FA440
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_GP_NO", ccsText, "", "", $this->Parameters["urls_GP_NO"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_hvf2.gp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = "( mfi_hvf2.final_result='SANCTIONED' )";
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @168-C67A76B7
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id";
        $this->SQL = "SELECT mfi_hvf1_customer_name, mfi_hvf1_customer_father_name, mfi_hvf1_customer_husband_name, mfi_hvf2_loan_amount, final_result,\n\n" .
        "mfi_hvf2.la_id AS mfi_hvf2_la_id, mfi_hvf2_loan_group_meeting_frequency, tdb_result \n\n" .
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

//SetValues Method @168-59726CBE
    function SetValues()
    {
        $this->CachedColumns["la_id"] = $this->f("mfi_hvf2_la_id");
        $this->CachedColumns["la_id"] = $this->f("mfi_hvf2_la_id");
        $this->mfi_hvf2_la_id->SetDBValue($this->f("mfi_hvf2_la_id"));
        $this->mfi_hvf1_customer_name->SetDBValue($this->f("mfi_hvf1_customer_name"));
        $this->mfi_hvf1_customer_father_name->SetDBValue($this->f("mfi_hvf1_customer_father_name"));
        $this->mfi_hvf1_customer_husband_name->SetDBValue($this->f("mfi_hvf1_customer_husband_name"));
        $this->final_result->SetDBValue($this->f("final_result"));
        $this->mfi_hvf2_loan_amount->SetDBValue(trim($this->f("mfi_hvf2_loan_amount")));
        $this->tdb_result->SetDBValue($this->f("tdb_result"));
        $this->freq->SetDBValue($this->f("mfi_hvf2_loan_group_meeting_frequency"));
    }
//End SetValues Method

//Update Method @168-B17C9ADE
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "la_id=" . $this->ToSQL($this->CachedColumns["la_id"], ccsText);
        $this->UpdateFields["mfi_hvf2_loan_amount"]["Value"] = $this->mfi_hvf2_loan_amount->GetDBValue(true);
        $this->UpdateFields["tdb_result"]["Value"] = $this->tdb_result->GetDBValue(true);
        $this->UpdateFields["mfi_hvf2_loan_group_meeting_frequency"]["Value"] = $this->freq->GetDBValue(true);
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

} //End mfi_hvf1_mfi_hvf2DataSource Class @168-FCB6E20C

class clsEditableGridmfi_group_details_mfi_hvf { //mfi_group_details_mfi_hvf Class @198-D7942CC1

//Variables @198-05470A9C

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
    public $Sorter_cp_id;
    public $Sorter_mfi_cp_centre_name;
    public $Sorter_group_name;
    public $Sorter_mfi_gp_proposed_group_name;
    public $Sorter_cgt_date1;
    public $Sorter_cgt_date2;
    public $Sorter_grt_date;
    public $Sorter_mfi_group_details_grt_result;
    public $Sorter_mfi_group_details_disbursement_date;
//End Variables

//Class_Initialize Event @198-B9AC5A59
    function clsEditableGridmfi_group_details_mfi_hvf($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid mfi_group_details_mfi_hvf/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "mfi_group_details_mfi_hvf";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["group_name"][0] = "group_name";
        $this->DataSource = new clsmfi_group_details_mfi_hvfDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
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

        $this->SorterName = CCGetParam("mfi_group_details_mfi_hvfOrder", "");
        $this->SorterDirection = CCGetParam("mfi_group_details_mfi_hvfDir", "");

        $this->Sorter_cp_id = new clsSorter($this->ComponentName, "Sorter_cp_id", $FileName, $this);
        $this->Sorter_mfi_cp_centre_name = new clsSorter($this->ComponentName, "Sorter_mfi_cp_centre_name", $FileName, $this);
        $this->Sorter_group_name = new clsSorter($this->ComponentName, "Sorter_group_name", $FileName, $this);
        $this->Sorter_mfi_gp_proposed_group_name = new clsSorter($this->ComponentName, "Sorter_mfi_gp_proposed_group_name", $FileName, $this);
        $this->Sorter_cgt_date1 = new clsSorter($this->ComponentName, "Sorter_cgt_date1", $FileName, $this);
        $this->Sorter_cgt_date2 = new clsSorter($this->ComponentName, "Sorter_cgt_date2", $FileName, $this);
        $this->Sorter_grt_date = new clsSorter($this->ComponentName, "Sorter_grt_date", $FileName, $this);
        $this->Sorter_mfi_group_details_grt_result = new clsSorter($this->ComponentName, "Sorter_mfi_group_details_grt_result", $FileName, $this);
        $this->Sorter_mfi_group_details_disbursement_date = new clsSorter($this->ComponentName, "Sorter_mfi_group_details_disbursement_date", $FileName, $this);
        $this->cp_id = new clsControl(ccsLabel, "cp_id", "cp_id", ccsText, "", NULL, $this);
        $this->mfi_cp_centre_name = new clsControl(ccsLabel, "mfi_cp_centre_name", "mfi_cp_centre_name", ccsText, "", NULL, $this);
        $this->group_name = new clsControl(ccsLabel, "group_name", "group_name", ccsText, "", NULL, $this);
        $this->mfi_gp_proposed_group_name = new clsControl(ccsLabel, "mfi_gp_proposed_group_name", "mfi_gp_proposed_group_name", ccsText, "", NULL, $this);
        $this->cgt_date1 = new clsControl(ccsTextBox, "cgt_date1", $CCSLocales->GetText("cgt_date1"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), NULL, $this);
        $this->cgt_date2 = new clsControl(ccsTextBox, "cgt_date2", $CCSLocales->GetText("cgt_date2"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), NULL, $this);
        $this->grt_date = new clsControl(ccsTextBox, "grt_date", $CCSLocales->GetText("grt_date"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), NULL, $this);
        $this->mfi_group_details_grt_result = new clsControl(ccsTextBox, "mfi_group_details_grt_result", $CCSLocales->GetText("mfi_group_details_grt_result"), ccsText, "", NULL, $this);
        $this->mfi_group_details_disbursement_date = new clsControl(ccsTextBox, "mfi_group_details_disbursement_date", $CCSLocales->GetText("mfi_group_details_disbursement_date"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), NULL, $this);
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
        $this->firstcollectiondate = new clsControl(ccsTextBox, "firstcollectiondate", "firstcollectiondate", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @198-1CE90CA3
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_GP_NO"] = CCGetFromGet("s_GP_NO", NULL);
        $this->DataSource->Parameters["expr345"] = null;
    }
//End Initialize Method

//GetFormParameters Method @198-94B20047
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["cgt_date1"][$RowNumber] = CCGetFromPost("cgt_date1_" . $RowNumber, NULL);
            $this->FormParameters["cgt_date2"][$RowNumber] = CCGetFromPost("cgt_date2_" . $RowNumber, NULL);
            $this->FormParameters["grt_date"][$RowNumber] = CCGetFromPost("grt_date_" . $RowNumber, NULL);
            $this->FormParameters["mfi_group_details_grt_result"][$RowNumber] = CCGetFromPost("mfi_group_details_grt_result_" . $RowNumber, NULL);
            $this->FormParameters["mfi_group_details_disbursement_date"][$RowNumber] = CCGetFromPost("mfi_group_details_disbursement_date_" . $RowNumber, NULL);
            $this->FormParameters["firstcollectiondate"][$RowNumber] = CCGetFromPost("firstcollectiondate_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @198-ECC6A22A
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["group_name"] = $this->CachedColumns["group_name"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->cgt_date1->SetText($this->FormParameters["cgt_date1"][$this->RowNumber], $this->RowNumber);
            $this->cgt_date2->SetText($this->FormParameters["cgt_date2"][$this->RowNumber], $this->RowNumber);
            $this->grt_date->SetText($this->FormParameters["grt_date"][$this->RowNumber], $this->RowNumber);
            $this->mfi_group_details_grt_result->SetText($this->FormParameters["mfi_group_details_grt_result"][$this->RowNumber], $this->RowNumber);
            $this->mfi_group_details_disbursement_date->SetText($this->FormParameters["mfi_group_details_disbursement_date"][$this->RowNumber], $this->RowNumber);
            $this->firstcollectiondate->SetText($this->FormParameters["firstcollectiondate"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @198-91BB8860
    function ValidateRow()
    {
        global $CCSLocales;
        $this->cgt_date1->Validate();
        $this->cgt_date2->Validate();
        $this->grt_date->Validate();
        $this->mfi_group_details_grt_result->Validate();
        $this->mfi_group_details_disbursement_date->Validate();
        $this->firstcollectiondate->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->cgt_date1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cgt_date2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->grt_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_group_details_grt_result->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_group_details_disbursement_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->firstcollectiondate->Errors->ToString());
        $this->cgt_date1->Errors->Clear();
        $this->cgt_date2->Errors->Clear();
        $this->grt_date->Errors->Clear();
        $this->mfi_group_details_grt_result->Errors->Clear();
        $this->mfi_group_details_disbursement_date->Errors->Clear();
        $this->firstcollectiondate->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @198-C3143899
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["cgt_date1"][$this->RowNumber]) && count($this->FormParameters["cgt_date1"][$this->RowNumber])) || strlen($this->FormParameters["cgt_date1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["cgt_date2"][$this->RowNumber]) && count($this->FormParameters["cgt_date2"][$this->RowNumber])) || strlen($this->FormParameters["cgt_date2"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["grt_date"][$this->RowNumber]) && count($this->FormParameters["grt_date"][$this->RowNumber])) || strlen($this->FormParameters["grt_date"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["mfi_group_details_grt_result"][$this->RowNumber]) && count($this->FormParameters["mfi_group_details_grt_result"][$this->RowNumber])) || strlen($this->FormParameters["mfi_group_details_grt_result"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["mfi_group_details_disbursement_date"][$this->RowNumber]) && count($this->FormParameters["mfi_group_details_disbursement_date"][$this->RowNumber])) || strlen($this->FormParameters["mfi_group_details_disbursement_date"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["firstcollectiondate"][$this->RowNumber]) && count($this->FormParameters["firstcollectiondate"][$this->RowNumber])) || strlen($this->FormParameters["firstcollectiondate"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @198-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @198-6B923CC2
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

//UpdateGrid Method @198-F7EB87A9
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["group_name"] = $this->CachedColumns["group_name"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->cgt_date1->SetText($this->FormParameters["cgt_date1"][$this->RowNumber], $this->RowNumber);
            $this->cgt_date2->SetText($this->FormParameters["cgt_date2"][$this->RowNumber], $this->RowNumber);
            $this->grt_date->SetText($this->FormParameters["grt_date"][$this->RowNumber], $this->RowNumber);
            $this->mfi_group_details_grt_result->SetText($this->FormParameters["mfi_group_details_grt_result"][$this->RowNumber], $this->RowNumber);
            $this->mfi_group_details_disbursement_date->SetText($this->FormParameters["mfi_group_details_disbursement_date"][$this->RowNumber], $this->RowNumber);
            $this->firstcollectiondate->SetText($this->FormParameters["firstcollectiondate"][$this->RowNumber], $this->RowNumber);
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

//UpdateRow Method @198-A06FE7C8
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->cp_id->SetValue($this->cp_id->GetValue(true));
        $this->DataSource->mfi_cp_centre_name->SetValue($this->mfi_cp_centre_name->GetValue(true));
        $this->DataSource->group_name->SetValue($this->group_name->GetValue(true));
        $this->DataSource->mfi_gp_proposed_group_name->SetValue($this->mfi_gp_proposed_group_name->GetValue(true));
        $this->DataSource->cgt_date1->SetValue($this->cgt_date1->GetValue(true));
        $this->DataSource->cgt_date2->SetValue($this->cgt_date2->GetValue(true));
        $this->DataSource->grt_date->SetValue($this->grt_date->GetValue(true));
        $this->DataSource->mfi_group_details_grt_result->SetValue($this->mfi_group_details_grt_result->GetValue(true));
        $this->DataSource->mfi_group_details_disbursement_date->SetValue($this->mfi_group_details_disbursement_date->GetValue(true));
        $this->DataSource->firstcollectiondate->SetValue($this->firstcollectiondate->GetValue(true));
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

//FormScript Method @198-E6460E65
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var mfi_group_details_mfi_hvfElements;\n";
        $script .= "var mfi_group_details_mfi_hvfEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "cgt_date1ID = 0;\n";
        $script .= "var " . $this->ComponentName . "cgt_date2ID = 1;\n";
        $script .= "var " . $this->ComponentName . "grt_dateID = 2;\n";
        $script .= "var " . $this->ComponentName . "mfi_group_details_grt_resultID = 3;\n";
        $script .= "var " . $this->ComponentName . "mfi_group_details_disbursement_dateID = 4;\n";
        $script .= "var " . $this->ComponentName . "firstcollectiondateID = 5;\n";
        $script .= "\nfunction initmfi_group_details_mfi_hvfElements() {\n";
        $script .= "\tvar ED = document.forms[\"mfi_group_details_mfi_hvf\"];\n";
        $script .= "\tmfi_group_details_mfi_hvfElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.cgt_date1_" . $i . ", " . "ED.cgt_date2_" . $i . ", " . "ED.grt_date_" . $i . ", " . "ED.mfi_group_details_grt_result_" . $i . ", " . "ED.mfi_group_details_disbursement_date_" . $i . ", " . "ED.firstcollectiondate_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @198-26D961BB
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
                $this->CachedColumns["group_name"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["group_name"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @198-BD2541E1
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["group_name"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @198-3F3504DD
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
        $this->ControlsVisible["cp_id"] = $this->cp_id->Visible;
        $this->ControlsVisible["mfi_cp_centre_name"] = $this->mfi_cp_centre_name->Visible;
        $this->ControlsVisible["group_name"] = $this->group_name->Visible;
        $this->ControlsVisible["mfi_gp_proposed_group_name"] = $this->mfi_gp_proposed_group_name->Visible;
        $this->ControlsVisible["cgt_date1"] = $this->cgt_date1->Visible;
        $this->ControlsVisible["cgt_date2"] = $this->cgt_date2->Visible;
        $this->ControlsVisible["grt_date"] = $this->grt_date->Visible;
        $this->ControlsVisible["mfi_group_details_grt_result"] = $this->mfi_group_details_grt_result->Visible;
        $this->ControlsVisible["mfi_group_details_disbursement_date"] = $this->mfi_group_details_disbursement_date->Visible;
        $this->ControlsVisible["firstcollectiondate"] = $this->firstcollectiondate->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["group_name"][$this->RowNumber] = $this->DataSource->CachedColumns["group_name"];
                    $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                    $this->mfi_cp_centre_name->SetValue($this->DataSource->mfi_cp_centre_name->GetValue());
                    $this->group_name->SetValue($this->DataSource->group_name->GetValue());
                    $this->mfi_gp_proposed_group_name->SetValue($this->DataSource->mfi_gp_proposed_group_name->GetValue());
                    $this->cgt_date1->SetValue($this->DataSource->cgt_date1->GetValue());
                    $this->cgt_date2->SetValue($this->DataSource->cgt_date2->GetValue());
                    $this->grt_date->SetValue($this->DataSource->grt_date->GetValue());
                    $this->mfi_group_details_grt_result->SetValue($this->DataSource->mfi_group_details_grt_result->GetValue());
                    $this->mfi_group_details_disbursement_date->SetValue($this->DataSource->mfi_group_details_disbursement_date->GetValue());
                    $this->firstcollectiondate->SetValue($this->DataSource->firstcollectiondate->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->cp_id->SetText("");
                    $this->mfi_cp_centre_name->SetText("");
                    $this->group_name->SetText("");
                    $this->mfi_gp_proposed_group_name->SetText("");
                    $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                    $this->mfi_cp_centre_name->SetValue($this->DataSource->mfi_cp_centre_name->GetValue());
                    $this->group_name->SetValue($this->DataSource->group_name->GetValue());
                    $this->mfi_gp_proposed_group_name->SetValue($this->DataSource->mfi_gp_proposed_group_name->GetValue());
                    $this->cgt_date1->SetText($this->FormParameters["cgt_date1"][$this->RowNumber], $this->RowNumber);
                    $this->cgt_date2->SetText($this->FormParameters["cgt_date2"][$this->RowNumber], $this->RowNumber);
                    $this->grt_date->SetText($this->FormParameters["grt_date"][$this->RowNumber], $this->RowNumber);
                    $this->mfi_group_details_grt_result->SetText($this->FormParameters["mfi_group_details_grt_result"][$this->RowNumber], $this->RowNumber);
                    $this->mfi_group_details_disbursement_date->SetText($this->FormParameters["mfi_group_details_disbursement_date"][$this->RowNumber], $this->RowNumber);
                    $this->firstcollectiondate->SetText($this->FormParameters["firstcollectiondate"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["group_name"][$this->RowNumber] = "";
                    $this->cp_id->SetText("");
                    $this->mfi_cp_centre_name->SetText("");
                    $this->group_name->SetText("");
                    $this->mfi_gp_proposed_group_name->SetText("");
                    $this->cgt_date1->SetText("");
                    $this->cgt_date2->SetText("");
                    $this->grt_date->SetText("");
                    $this->mfi_group_details_grt_result->SetText("");
                    $this->mfi_group_details_disbursement_date->SetText("");
                    $this->firstcollectiondate->SetText("");
                } else {
                    $this->cp_id->SetText("");
                    $this->mfi_cp_centre_name->SetText("");
                    $this->group_name->SetText("");
                    $this->mfi_gp_proposed_group_name->SetText("");
                    $this->cgt_date1->SetText($this->FormParameters["cgt_date1"][$this->RowNumber], $this->RowNumber);
                    $this->cgt_date2->SetText($this->FormParameters["cgt_date2"][$this->RowNumber], $this->RowNumber);
                    $this->grt_date->SetText($this->FormParameters["grt_date"][$this->RowNumber], $this->RowNumber);
                    $this->mfi_group_details_grt_result->SetText($this->FormParameters["mfi_group_details_grt_result"][$this->RowNumber], $this->RowNumber);
                    $this->mfi_group_details_disbursement_date->SetText($this->FormParameters["mfi_group_details_disbursement_date"][$this->RowNumber], $this->RowNumber);
                    $this->firstcollectiondate->SetText($this->FormParameters["firstcollectiondate"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->cp_id->Show($this->RowNumber);
                $this->mfi_cp_centre_name->Show($this->RowNumber);
                $this->group_name->Show($this->RowNumber);
                $this->mfi_gp_proposed_group_name->Show($this->RowNumber);
                $this->cgt_date1->Show($this->RowNumber);
                $this->cgt_date2->Show($this->RowNumber);
                $this->grt_date->Show($this->RowNumber);
                $this->mfi_group_details_grt_result->Show($this->RowNumber);
                $this->mfi_group_details_disbursement_date->Show($this->RowNumber);
                $this->firstcollectiondate->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["group_name"] == $this->CachedColumns["group_name"][$this->RowNumber])) {
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
        $this->Sorter_cp_id->Show();
        $this->Sorter_mfi_cp_centre_name->Show();
        $this->Sorter_group_name->Show();
        $this->Sorter_mfi_gp_proposed_group_name->Show();
        $this->Sorter_cgt_date1->Show();
        $this->Sorter_cgt_date2->Show();
        $this->Sorter_grt_date->Show();
        $this->Sorter_mfi_group_details_grt_result->Show();
        $this->Sorter_mfi_group_details_disbursement_date->Show();
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

} //End mfi_group_details_mfi_hvf Class @198-FCB6E20C

class clsmfi_group_details_mfi_hvfDataSource extends clsDBmysql_cams_v2 {  //mfi_group_details_mfi_hvfDataSource Class @198-D6D90EF9

//DataSource Variables @198-4DF40A11
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
    public $cp_id;
    public $mfi_cp_centre_name;
    public $group_name;
    public $mfi_gp_proposed_group_name;
    public $cgt_date1;
    public $cgt_date2;
    public $grt_date;
    public $mfi_group_details_grt_result;
    public $mfi_group_details_disbursement_date;
    public $firstcollectiondate;
//End DataSource Variables

//DataSourceClass_Initialize Event @198-817A37C5
    function clsmfi_group_details_mfi_hvfDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid mfi_group_details_mfi_hvf/Error";
        $this->Initialize();
        $this->cp_id = new clsField("cp_id", ccsText, "");
        
        $this->mfi_cp_centre_name = new clsField("mfi_cp_centre_name", ccsText, "");
        
        $this->group_name = new clsField("group_name", ccsText, "");
        
        $this->mfi_gp_proposed_group_name = new clsField("mfi_gp_proposed_group_name", ccsText, "");
        
        $this->cgt_date1 = new clsField("cgt_date1", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
        
        $this->cgt_date2 = new clsField("cgt_date2", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
        
        $this->grt_date = new clsField("grt_date", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
        
        $this->mfi_group_details_grt_result = new clsField("mfi_group_details_grt_result", ccsText, "");
        
        $this->mfi_group_details_disbursement_date = new clsField("mfi_group_details_disbursement_date", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
        
        $this->firstcollectiondate = new clsField("firstcollectiondate", ccsText, "");
        

        $this->UpdateFields["cgt_date1"] = array("Name" => "cgt_date1", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["cgt_date2"] = array("Name" => "cgt_date2", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["grt_date"] = array("Name" => "grt_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_group_details_grt_result"] = array("Name" => "grt_result", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_group_details_disbursement_date"] = array("Name" => "disbursement_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["first_collection_date"] = array("Name" => "first_collection_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @198-3C92DAAE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_cp_id" => array("cp_id", ""), 
            "Sorter_mfi_cp_centre_name" => array("mfi_cp_centre_name", ""), 
            "Sorter_group_name" => array("group_name", ""), 
            "Sorter_mfi_gp_proposed_group_name" => array("mfi_gp_proposed_group_name", ""), 
            "Sorter_cgt_date1" => array("cgt_date1", ""), 
            "Sorter_cgt_date2" => array("cgt_date2", ""), 
            "Sorter_grt_date" => array("grt_date", ""), 
            "Sorter_mfi_group_details_grt_result" => array("mfi_group_details_grt_result", ""), 
            "Sorter_mfi_group_details_disbursement_date" => array("mfi_group_details_disbursement_date", "")));
    }
//End SetOrder Method

//Prepare Method @198-141FC3AD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_GP_NO", ccsText, "", "", $this->Parameters["urls_GP_NO"], "", false);
        $this->wp->AddParameter("3", "expr345", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["expr345"], "", true);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "group_name", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = "( tc_status='SANCTIONED' )";
        $this->wp->Criterion[3] = $this->wp->Operation(opIsNull, "mfi_group_details.disbursement_date", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),true);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @198-5EE186B6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT group_name, mfi_gp_proposed_group_name, cp_id, mfi_cp_centre_name, cgt_date1, cgt_date2, grt_date, mfi_group_details.grt_result AS mfi_group_details_grt_result,\n\n" .
        "mfi_group_details.disbursement_date AS mfi_group_details_disbursement_date, first_collection_date \n\n" .
        "FROM mfi_group_details INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_group_details.group_name = mfi_hvf2.gp_id {SQL_Where}\n\n" .
        "GROUP BY group_name {SQL_OrderBy}";
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

//SetValues Method @198-205BE483
    function SetValues()
    {
        $this->CachedColumns["group_name"] = $this->f("group_name");
        $this->cp_id->SetDBValue($this->f("cp_id"));
        $this->mfi_cp_centre_name->SetDBValue($this->f("mfi_cp_centre_name"));
        $this->group_name->SetDBValue($this->f("group_name"));
        $this->mfi_gp_proposed_group_name->SetDBValue($this->f("mfi_gp_proposed_group_name"));
        $this->cgt_date1->SetDBValue(trim($this->f("cgt_date1")));
        $this->cgt_date2->SetDBValue(trim($this->f("cgt_date2")));
        $this->grt_date->SetDBValue(trim($this->f("grt_date")));
        $this->mfi_group_details_grt_result->SetDBValue($this->f("mfi_group_details_grt_result"));
        $this->mfi_group_details_disbursement_date->SetDBValue(trim($this->f("mfi_group_details_disbursement_date")));
        $this->firstcollectiondate->SetDBValue($this->f("first_collection_date"));
    }
//End SetValues Method

//Update Method @198-BB17EB07
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "group_name=" . $this->ToSQL($this->CachedColumns["group_name"], ccsText);
        $this->UpdateFields["cgt_date1"]["Value"] = $this->cgt_date1->GetDBValue(true);
        $this->UpdateFields["cgt_date2"]["Value"] = $this->cgt_date2->GetDBValue(true);
        $this->UpdateFields["grt_date"]["Value"] = $this->grt_date->GetDBValue(true);
        $this->UpdateFields["mfi_group_details_grt_result"]["Value"] = $this->mfi_group_details_grt_result->GetDBValue(true);
        $this->UpdateFields["mfi_group_details_disbursement_date"]["Value"] = $this->mfi_group_details_disbursement_date->GetDBValue(true);
        $this->UpdateFields["first_collection_date"]["Value"] = $this->firstcollectiondate->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_group_details", $this->UpdateFields, $this);
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

} //End mfi_group_details_mfi_hvfDataSource Class @198-FCB6E20C

class clsGridcamsdata123_grid { //camsdata123_grid class @254-AC389AF8

//Variables @254-6E51DF5A

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

//Class_Initialize Event @254-3BEF7890
    function clsGridcamsdata123_grid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "camsdata123_grid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid camsdata123_grid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscamsdata123_gridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->CP_NO = new clsControl(ccsLabel, "CP_NO", "CP_NO", ccsText, "", CCGetRequestParam("CP_NO", ccsGet, NULL), $this);
        $this->CENTER_NAME = new clsControl(ccsLabel, "CENTER_NAME", "CENTER_NAME", ccsText, "", CCGetRequestParam("CENTER_NAME", ccsGet, NULL), $this);
        $this->GP_NO = new clsControl(ccsLabel, "GP_NO", "GP_NO", ccsText, "", CCGetRequestParam("GP_NO", ccsGet, NULL), $this);
        $this->GROUP_NAME = new clsControl(ccsLabel, "GROUP_NAME", "GROUP_NAME", ccsText, "", CCGetRequestParam("GROUP_NAME", ccsGet, NULL), $this);
        $this->LA_NO = new clsControl(ccsLabel, "LA_NO", "LA_NO", ccsText, "", CCGetRequestParam("LA_NO", ccsGet, NULL), $this);
        $this->BORROWER_NAME = new clsControl(ccsLabel, "BORROWER_NAME", "BORROWER_NAME", ccsText, "", CCGetRequestParam("BORROWER_NAME", ccsGet, NULL), $this);
        $this->FATHER_NAME = new clsControl(ccsLabel, "FATHER_NAME", "FATHER_NAME", ccsText, "", CCGetRequestParam("FATHER_NAME", ccsGet, NULL), $this);
        $this->HUSBAND_NAME = new clsControl(ccsLabel, "HUSBAND_NAME", "HUSBAND_NAME", ccsText, "", CCGetRequestParam("HUSBAND_NAME", ccsGet, NULL), $this);
        $this->REASON_REJECTION = new clsControl(ccsLabel, "REASON_REJECTION", "REASON_REJECTION", ccsText, "", CCGetRequestParam("REASON_REJECTION", ccsGet, NULL), $this);
        $this->FINAL_RESULT = new clsControl(ccsLabel, "FINAL_RESULT", "FINAL_RESULT", ccsText, "", CCGetRequestParam("FINAL_RESULT", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @254-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @254-FD9A4131
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_GP_NO"] = CCGetFromGet("s_GP_NO", NULL);

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
            $this->ControlsVisible["CP_NO"] = $this->CP_NO->Visible;
            $this->ControlsVisible["CENTER_NAME"] = $this->CENTER_NAME->Visible;
            $this->ControlsVisible["GP_NO"] = $this->GP_NO->Visible;
            $this->ControlsVisible["GROUP_NAME"] = $this->GROUP_NAME->Visible;
            $this->ControlsVisible["LA_NO"] = $this->LA_NO->Visible;
            $this->ControlsVisible["BORROWER_NAME"] = $this->BORROWER_NAME->Visible;
            $this->ControlsVisible["FATHER_NAME"] = $this->FATHER_NAME->Visible;
            $this->ControlsVisible["HUSBAND_NAME"] = $this->HUSBAND_NAME->Visible;
            $this->ControlsVisible["REASON_REJECTION"] = $this->REASON_REJECTION->Visible;
            $this->ControlsVisible["FINAL_RESULT"] = $this->FINAL_RESULT->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->CP_NO->SetValue($this->DataSource->CP_NO->GetValue());
                $this->CENTER_NAME->SetValue($this->DataSource->CENTER_NAME->GetValue());
                $this->GP_NO->SetValue($this->DataSource->GP_NO->GetValue());
                $this->GROUP_NAME->SetValue($this->DataSource->GROUP_NAME->GetValue());
                $this->LA_NO->SetValue($this->DataSource->LA_NO->GetValue());
                $this->BORROWER_NAME->SetValue($this->DataSource->BORROWER_NAME->GetValue());
                $this->FATHER_NAME->SetValue($this->DataSource->FATHER_NAME->GetValue());
                $this->HUSBAND_NAME->SetValue($this->DataSource->HUSBAND_NAME->GetValue());
                $this->REASON_REJECTION->SetValue($this->DataSource->REASON_REJECTION->GetValue());
                $this->FINAL_RESULT->SetValue($this->DataSource->FINAL_RESULT->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->CP_NO->Show();
                $this->CENTER_NAME->Show();
                $this->GP_NO->Show();
                $this->GROUP_NAME->Show();
                $this->LA_NO->Show();
                $this->BORROWER_NAME->Show();
                $this->FATHER_NAME->Show();
                $this->HUSBAND_NAME->Show();
                $this->REASON_REJECTION->Show();
                $this->FINAL_RESULT->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @254-36A309D3
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->CP_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CENTER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GP_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GROUP_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LA_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FATHER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->HUSBAND_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->REASON_REJECTION->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FINAL_RESULT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End camsdata123_grid Class @254-FCB6E20C

class clscamsdata123_gridDataSource extends clsDBmysql_cams_v2 {  //camsdata123_gridDataSource Class @254-13305504

//DataSource Variables @254-5C72F903
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $CP_NO;
    public $CENTER_NAME;
    public $GP_NO;
    public $GROUP_NAME;
    public $LA_NO;
    public $BORROWER_NAME;
    public $FATHER_NAME;
    public $HUSBAND_NAME;
    public $REASON_REJECTION;
    public $FINAL_RESULT;
//End DataSource Variables

//DataSourceClass_Initialize Event @254-E83EAA7B
    function clscamsdata123_gridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid camsdata123_grid";
        $this->Initialize();
        $this->CP_NO = new clsField("CP_NO", ccsText, "");
        
        $this->CENTER_NAME = new clsField("CENTER_NAME", ccsText, "");
        
        $this->GP_NO = new clsField("GP_NO", ccsText, "");
        
        $this->GROUP_NAME = new clsField("GROUP_NAME", ccsText, "");
        
        $this->LA_NO = new clsField("LA_NO", ccsText, "");
        
        $this->BORROWER_NAME = new clsField("BORROWER_NAME", ccsText, "");
        
        $this->FATHER_NAME = new clsField("FATHER_NAME", ccsText, "");
        
        $this->HUSBAND_NAME = new clsField("HUSBAND_NAME", ccsText, "");
        
        $this->REASON_REJECTION = new clsField("REASON_REJECTION", ccsText, "");
        
        $this->FINAL_RESULT = new clsField("FINAL_RESULT", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @254-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @254-FAB7181C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_GP_NO", ccsText, "", "", $this->Parameters["urls_GP_NO"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "GP_NO", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = "( FINAL_RESULT='REJECTED' )";
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @254-D61AA21C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM camsdata123_grid";
        $this->SQL = "SELECT CP_NO, CENTER_NAME, GP_NO, GROUP_NAME, LA_NO, BORROWER_NAME, FATHER_NAME, HUSBAND_NAME, FINAL_RESULT, REASON_REJECTION \n\n" .
        "FROM camsdata123_grid {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @254-23F93A33
    function SetValues()
    {
        $this->CP_NO->SetDBValue($this->f("CP_NO"));
        $this->CENTER_NAME->SetDBValue($this->f("CENTER_NAME"));
        $this->GP_NO->SetDBValue($this->f("GP_NO"));
        $this->GROUP_NAME->SetDBValue($this->f("GROUP_NAME"));
        $this->LA_NO->SetDBValue($this->f("LA_NO"));
        $this->BORROWER_NAME->SetDBValue($this->f("BORROWER_NAME"));
        $this->FATHER_NAME->SetDBValue($this->f("FATHER_NAME"));
        $this->HUSBAND_NAME->SetDBValue($this->f("HUSBAND_NAME"));
        $this->REASON_REJECTION->SetDBValue($this->f("REASON_REJECTION"));
        $this->FINAL_RESULT->SetDBValue($this->f("FINAL_RESULT"));
    }
//End SetValues Method

} //End camsdata123_gridDataSource Class @254-FCB6E20C

//Include Page implementation @3-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation



//Initialize Page @1-75256D69
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
$TemplateFileName = "cgt_grt.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-21029DD3
include_once("./cgt_grt_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-57558945
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$camsdata123_cgt_grtSearch = new clsRecordcamsdata123_cgt_grtSearch("", $MainPage);
$mfi_hvf1_mfi_hvf2 = new clsEditableGridmfi_hvf1_mfi_hvf2("", $MainPage);
$mfi_group_details_mfi_hvf = new clsEditableGridmfi_group_details_mfi_hvf("", $MainPage);
$camsdata123_grid = new clsGridcamsdata123_grid("", $MainPage);
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$MainPage->incHeader = & $incHeader;
$MainPage->camsdata123_cgt_grtSearch = & $camsdata123_cgt_grtSearch;
$MainPage->mfi_hvf1_mfi_hvf2 = & $mfi_hvf1_mfi_hvf2;
$MainPage->mfi_group_details_mfi_hvf = & $mfi_group_details_mfi_hvf;
$MainPage->camsdata123_grid = & $camsdata123_grid;
$MainPage->incFooter = & $incFooter;
$mfi_hvf1_mfi_hvf2->Initialize();
$mfi_group_details_mfi_hvf->Initialize();
$camsdata123_grid->Initialize();

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

//Execute Components @1-4658CD00
$incFooter->Operations();
$mfi_group_details_mfi_hvf->Operation();
$mfi_hvf1_mfi_hvf2->Operation();
$camsdata123_cgt_grtSearch->Operation();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-62D42140
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incHeader->Class_Terminate();
    unset($incHeader);
    unset($camsdata123_cgt_grtSearch);
    unset($mfi_hvf1_mfi_hvf2);
    unset($mfi_group_details_mfi_hvf);
    unset($camsdata123_grid);
    $incFooter->Class_Terminate();
    unset($incFooter);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-DE47CA03
$incHeader->Show();
$camsdata123_cgt_grtSearch->Show();
$mfi_hvf1_mfi_hvf2->Show();
$mfi_group_details_mfi_hvf->Show();
$camsdata123_grid->Show();
$incFooter->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-28E61DA6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
unset($camsdata123_cgt_grtSearch);
unset($mfi_hvf1_mfi_hvf2);
unset($mfi_group_details_mfi_hvf);
unset($camsdata123_grid);
$incFooter->Class_Terminate();
unset($incFooter);
unset($Tpl);
//End Unload Page


?>
