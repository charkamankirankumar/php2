<?php
//Include Common Files @1-E514DAFD
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Doc_Tagging_Report_Summary.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmfi_docsSearch { //mfi_docsSearch Class @25-50AD3A7F

//Variables @25-9E315808

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

//Class_Initialize Event @25-9EC8C343
    function clsRecordmfi_docsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_docsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_docsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_batch_code = new clsControl(ccsTextBox, "s_batch_code", "s_batch_code", ccsText, "", CCGetRequestParam("s_batch_code", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @25-8D863637
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_batch_code->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_batch_code->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @25-9D8688E8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_batch_code->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @25-83EBB23B
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
        $Redirect = "Doc_Tagging_Report_Summary.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "Doc_Tagging_Report_Summary.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @25-FC25B558
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
        $this->s_batch_code->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_docsSearch Class @25-FCB6E20C

class clsGridmfi_docs_mfi_hvf2 { //mfi_docs_mfi_hvf2 class @54-AED17FDD

//Variables @54-494C8A4A

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
    public $Sorter_batch_code;
    public $Sorter_la_id;
    public $Sorter_cb_analysys_result;
    public $Sorter_cd_analysys_result;
    public $Sorter_mfi_telecaller_status;
    public $Sorter_final_result;
    public $Sorter_cb_approved_loan_amount;
//End Variables

//Class_Initialize Event @54-ED6B9F9F
    function clsGridmfi_docs_mfi_hvf2($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_docs_mfi_hvf2";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_docs_mfi_hvf2";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_docs_mfi_hvf2DataSource($this);
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
        $this->SorterName = CCGetParam("mfi_docs_mfi_hvf2Order", "");
        $this->SorterDirection = CCGetParam("mfi_docs_mfi_hvf2Dir", "");

        $this->batch_code = new clsControl(ccsLabel, "batch_code", "batch_code", ccsText, "", CCGetRequestParam("batch_code", ccsGet, NULL), $this);
        $this->la_id = new clsControl(ccsLabel, "la_id", "la_id", ccsText, "", CCGetRequestParam("la_id", ccsGet, NULL), $this);
        $this->cb_analysys_result = new clsControl(ccsLabel, "cb_analysys_result", "cb_analysys_result", ccsText, "", CCGetRequestParam("cb_analysys_result", ccsGet, NULL), $this);
        $this->cd_analysys_result = new clsControl(ccsLabel, "cd_analysys_result", "cd_analysys_result", ccsText, "", CCGetRequestParam("cd_analysys_result", ccsGet, NULL), $this);
        $this->mfi_telecaller_status = new clsControl(ccsLabel, "mfi_telecaller_status", "mfi_telecaller_status", ccsText, "", CCGetRequestParam("mfi_telecaller_status", ccsGet, NULL), $this);
        $this->final_result = new clsControl(ccsLabel, "final_result", "final_result", ccsText, "", CCGetRequestParam("final_result", ccsGet, NULL), $this);
        $this->cb_approved_loan_amount = new clsControl(ccsLabel, "cb_approved_loan_amount", "cb_approved_loan_amount", ccsInteger, "", CCGetRequestParam("cb_approved_loan_amount", ccsGet, NULL), $this);
        $this->Sorter_batch_code = new clsSorter($this->ComponentName, "Sorter_batch_code", $FileName, $this);
        $this->Sorter_la_id = new clsSorter($this->ComponentName, "Sorter_la_id", $FileName, $this);
        $this->Sorter_cb_analysys_result = new clsSorter($this->ComponentName, "Sorter_cb_analysys_result", $FileName, $this);
        $this->Sorter_cd_analysys_result = new clsSorter($this->ComponentName, "Sorter_cd_analysys_result", $FileName, $this);
        $this->Sorter_mfi_telecaller_status = new clsSorter($this->ComponentName, "Sorter_mfi_telecaller_status", $FileName, $this);
        $this->Sorter_final_result = new clsSorter($this->ComponentName, "Sorter_final_result", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->Sorter_cb_approved_loan_amount = new clsSorter($this->ComponentName, "Sorter_cb_approved_loan_amount", $FileName, $this);
        $this->Label4 = new clsControl(ccsLabel, "Label4", "Label4", ccsText, "", CCGetRequestParam("Label4", ccsGet, NULL), $this);
        $this->Label2 = new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", CCGetRequestParam("Label2", ccsGet, NULL), $this);
        $this->Label3 = new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @54-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @54-D8ED2AE2
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_batch_code"] = CCGetFromGet("s_batch_code", NULL);
        $this->DataSource->Parameters["urlmfi_doc_region"] = CCGetFromGet("mfi_doc_region", NULL);

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
            $this->ControlsVisible["batch_code"] = $this->batch_code->Visible;
            $this->ControlsVisible["la_id"] = $this->la_id->Visible;
            $this->ControlsVisible["cb_analysys_result"] = $this->cb_analysys_result->Visible;
            $this->ControlsVisible["cd_analysys_result"] = $this->cd_analysys_result->Visible;
            $this->ControlsVisible["mfi_telecaller_status"] = $this->mfi_telecaller_status->Visible;
            $this->ControlsVisible["final_result"] = $this->final_result->Visible;
            $this->ControlsVisible["cb_approved_loan_amount"] = $this->cb_approved_loan_amount->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
                $this->la_id->SetValue($this->DataSource->la_id->GetValue());
                $this->cb_analysys_result->SetValue($this->DataSource->cb_analysys_result->GetValue());
                $this->cd_analysys_result->SetValue($this->DataSource->cd_analysys_result->GetValue());
                $this->mfi_telecaller_status->SetValue($this->DataSource->mfi_telecaller_status->GetValue());
                $this->final_result->SetValue($this->DataSource->final_result->GetValue());
                $this->cb_approved_loan_amount->SetValue($this->DataSource->cb_approved_loan_amount->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->batch_code->Show();
                $this->la_id->Show();
                $this->cb_analysys_result->Show();
                $this->cd_analysys_result->Show();
                $this->mfi_telecaller_status->Show();
                $this->final_result->Show();
                $this->cb_approved_loan_amount->Show();
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
        $this->Sorter_batch_code->Show();
        $this->Sorter_la_id->Show();
        $this->Sorter_cb_analysys_result->Show();
        $this->Sorter_cd_analysys_result->Show();
        $this->Sorter_mfi_telecaller_status->Show();
        $this->Sorter_final_result->Show();
        $this->Navigator->Show();
        $this->Label1->Show();
        $this->Sorter_cb_approved_loan_amount->Show();
        $this->Label4->Show();
        $this->Label2->Show();
        $this->Label3->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @54-AE7C1006
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->batch_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->la_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cb_analysys_result->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cd_analysys_result->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_telecaller_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->final_result->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cb_approved_loan_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_docs_mfi_hvf2 Class @54-FCB6E20C

class clsmfi_docs_mfi_hvf2DataSource extends clsDBmysql_cams_v2 {  //mfi_docs_mfi_hvf2DataSource Class @54-3F2E558F

//DataSource Variables @54-D42E1F58
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $batch_code;
    public $la_id;
    public $cb_analysys_result;
    public $cd_analysys_result;
    public $mfi_telecaller_status;
    public $final_result;
    public $cb_approved_loan_amount;
//End DataSource Variables

//DataSourceClass_Initialize Event @54-80580AFD
    function clsmfi_docs_mfi_hvf2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_docs_mfi_hvf2";
        $this->Initialize();
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->la_id = new clsField("la_id", ccsText, "");
        
        $this->cb_analysys_result = new clsField("cb_analysys_result", ccsText, "");
        
        $this->cd_analysys_result = new clsField("cd_analysys_result", ccsText, "");
        
        $this->mfi_telecaller_status = new clsField("mfi_telecaller_status", ccsText, "");
        
        $this->final_result = new clsField("final_result", ccsText, "");
        
        $this->cb_approved_loan_amount = new clsField("cb_approved_loan_amount", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @54-81E5EE6F
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_batch_code" => array("batch_code", ""), 
            "Sorter_la_id" => array("la_id", ""), 
            "Sorter_cb_analysys_result" => array("cb_analysys_result", ""), 
            "Sorter_cd_analysys_result" => array("cd_analysys_result", ""), 
            "Sorter_mfi_telecaller_status" => array("mfi_telecaller_status", ""), 
            "Sorter_final_result" => array("final_result", ""), 
            "Sorter_cb_approved_loan_amount" => array("cb_approved_loan_amount", "")));
    }
//End SetOrder Method

//Prepare Method @54-BE29AC05
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_batch_code", ccsText, "", "", $this->Parameters["urls_batch_code"], "", false);
        $this->wp->AddParameter("2", "urlmfi_doc_region", ccsText, "", "", $this->Parameters["urlmfi_doc_region"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "mfi_docs.batch_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "mfi_docs.mfi_doc_region", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = "( mfi_docs.mfi_doc_type LIKE 'LA1' )";
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @54-778EA492
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_docs INNER JOIN camsdata123 ON\n\n" .
        "mfi_docs.mfi_doc_territory_code = camsdata123.";
        $this->SQL = "SELECT mfi_doc_type, mfi_doc_territory_code, batch_code, , , , , ,  \n\n" .
        "FROM mfi_docs INNER JOIN camsdata123 ON\n\n" .
        "mfi_docs.mfi_doc_territory_code = camsdata123. {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @54-CFEA918C
    function SetValues()
    {
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->la_id->SetDBValue($this->f("LA NO"));
        $this->cb_analysys_result->SetDBValue($this->f("INDIVIDUAL CREDIT DECISION"));
        $this->cd_analysys_result->SetDBValue($this->f("BUDGET ANALLYSYS"));
        $this->mfi_telecaller_status->SetDBValue($this->f("TELECALLING RESULT"));
        $this->final_result->SetDBValue($this->f("FINAL RESULT"));
        $this->cb_approved_loan_amount->SetDBValue(trim($this->f("SANCTIONED AMOUNT")));
    }
//End SetValues Method

} //End mfi_docs_mfi_hvf2DataSource Class @54-FCB6E20C

//mfi_docs1 ReportGroup class @17-0A5F3F46
class clsReportGroupmfi_docs1 {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $mfi_doc_region, $_mfi_doc_regionAttributes;
    public $batch_code, $_batch_codePage, $_batch_codeParameters, $_batch_codeAttributes;
    public $mfi_doc_type, $_mfi_doc_typeAttributes;
    public $Expr1, $_Expr1Attributes;
    public $Sum_Expr11, $_Sum_Expr11Attributes;
    public $Sum_Expr1, $_Sum_Expr1Attributes;
    public $TotalSum_Expr1, $_TotalSum_Expr1Attributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $mfi_doc_regionTotalIndex;
    public $batch_codeTotalIndex;

    function clsReportGroupmfi_docs1(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->mfi_doc_region = $this->Parent->mfi_doc_region->Value;
        $this->batch_code = $this->Parent->batch_code->Value;
        $this->mfi_doc_type = $this->Parent->mfi_doc_type->Value;
        $this->Expr1 = $this->Parent->Expr1->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Sum_Expr11 = $this->Parent->Sum_Expr11->GetTotalValue($mode);
        $this->Sum_Expr1 = $this->Parent->Sum_Expr1->GetTotalValue($mode);
        $this->TotalSum_Expr1 = $this->Parent->TotalSum_Expr1->GetTotalValue($mode);
        $this->_batch_codePage = $this->Parent->batch_code->Page;
        $this->_batch_codeParameters = $this->Parent->batch_code->Parameters;
        $this->_mfi_doc_regionAttributes = $this->Parent->mfi_doc_region->Attributes->GetAsArray();
        $this->_batch_codeAttributes = $this->Parent->batch_code->Attributes->GetAsArray();
        $this->_mfi_doc_typeAttributes = $this->Parent->mfi_doc_type->Attributes->GetAsArray();
        $this->_Expr1Attributes = $this->Parent->Expr1->Attributes->GetAsArray();
        $this->_Sum_Expr11Attributes = $this->Parent->Sum_Expr11->Attributes->GetAsArray();
        $this->_Sum_Expr1Attributes = $this->Parent->Sum_Expr1->Attributes->GetAsArray();
        $this->_TotalSum_Expr1Attributes = $this->Parent->TotalSum_Expr1->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Sum_Expr11 = $this->Sum_Expr11;
        $Header->_Sum_Expr11Attributes = $this->_Sum_Expr11Attributes;
        $Header->Sum_Expr1 = $this->Sum_Expr1;
        $Header->_Sum_Expr1Attributes = $this->_Sum_Expr1Attributes;
        $Header->TotalSum_Expr1 = $this->TotalSum_Expr1;
        $Header->_TotalSum_Expr1Attributes = $this->_TotalSum_Expr1Attributes;
        $this->mfi_doc_region = $Header->mfi_doc_region;
        $Header->_mfi_doc_regionAttributes = $this->_mfi_doc_regionAttributes;
        $this->Parent->mfi_doc_region->Value = $Header->mfi_doc_region;
        $this->Parent->mfi_doc_region->Attributes->RestoreFromArray($Header->_mfi_doc_regionAttributes);
        $this->batch_code = $Header->batch_code;
        $this->_batch_codePage = $Header->_batch_codePage;
        $this->_batch_codeParameters = $Header->_batch_codeParameters;
        $Header->_batch_codeAttributes = $this->_batch_codeAttributes;
        $this->Parent->batch_code->Value = $Header->batch_code;
        $this->Parent->batch_code->Attributes->RestoreFromArray($Header->_batch_codeAttributes);
        $this->mfi_doc_type = $Header->mfi_doc_type;
        $Header->_mfi_doc_typeAttributes = $this->_mfi_doc_typeAttributes;
        $this->Parent->mfi_doc_type->Value = $Header->mfi_doc_type;
        $this->Parent->mfi_doc_type->Attributes->RestoreFromArray($Header->_mfi_doc_typeAttributes);
        $this->Expr1 = $Header->Expr1;
        $Header->_Expr1Attributes = $this->_Expr1Attributes;
        $this->Parent->Expr1->Value = $Header->Expr1;
        $this->Parent->Expr1->Attributes->RestoreFromArray($Header->_Expr1Attributes);
    }
    function ChangeTotalControls() {
        $this->Sum_Expr11 = $this->Parent->Sum_Expr11->GetValue();
        $this->Sum_Expr1 = $this->Parent->Sum_Expr1->GetValue();
        $this->TotalSum_Expr1 = $this->Parent->TotalSum_Expr1->GetValue();
    }
}
//End mfi_docs1 ReportGroup class

//mfi_docs1 GroupsCollection class @17-F5B95294
class clsGroupsCollectionmfi_docs1 {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mmfi_doc_regionCurrentHeaderIndex;
    public $mbatch_codeCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionmfi_docs1(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mmfi_doc_regionCurrentHeaderIndex = 1;
        $this->mbatch_codeCurrentHeaderIndex = 2;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_docs1($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->mfi_doc_regionTotalIndex = $this->mmfi_doc_regionCurrentHeaderIndex;
        $group->batch_codeTotalIndex = $this->mbatch_codeCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->mfi_doc_region->Value = $this->Parent->mfi_doc_region->initialValue;
        $this->Parent->batch_code->Value = $this->Parent->batch_code->initialValue;
        $this->Parent->mfi_doc_type->Value = $this->Parent->mfi_doc_type->initialValue;
        $this->Parent->Expr1->Value = $this->Parent->Expr1->initialValue;
        $this->Parent->Sum_Expr11->Value = $this->Parent->Sum_Expr11->initialValue;
        $this->Parent->Sum_Expr1->Value = $this->Parent->Sum_Expr1->initialValue;
        $this->Parent->TotalSum_Expr1->Value = $this->Parent->TotalSum_Expr1->initialValue;
    }

    function OpenPage() {
        $this->TotalPages++;
        $Group = & $this->InitGroup();
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnInitialize", $this->Parent->Page_Header);
        if ($this->Parent->Page_Header->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Page_Header->Height;
        $Group->SetTotalControls("GetNextValue");
        $this->Parent->Page_Header->CCSEventResult = CCGetEvent($this->Parent->Page_Header->CCSEvents, "OnCalculate", $this->Parent->Page_Header);
        $Group->SetControls();
        $Group->Mode = 1;
        $Group->GroupType = "Page";
        $Group->PageTotalIndex = count($this->Groups);
        $this->mPageCurrentHeaderIndex = count($this->Groups);
        $this->Groups[] =  & $Group;
        $this->Pages[] =  count($this->Groups) == 2 ? 0 : count($this->Groups) - 1;
    }

    function OpenGroup($groupName) {
        $Group = "";
        $OpenFlag = false;
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnInitialize", $this->Parent->Report_Header);
            if ($this->Parent->Report_Header->Visible) 
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Header->Height;
                $Group->SetTotalControls("GetNextValue");
            $this->Parent->Report_Header->CCSEventResult = CCGetEvent($this->Parent->Report_Header->CCSEvents, "OnCalculate", $this->Parent->Report_Header);
            $Group->SetControls();
            $Group->Mode = 1;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->OpenPage();
        }
        if ($groupName == "mfi_doc_region") {
            $Groupmfi_doc_region = & $this->InitGroup(true);
            $this->Parent->mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_region_Header->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_region_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mfi_doc_region_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mfi_doc_region_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mfi_doc_region_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mfi_doc_region_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_region_Header->Height;
                $Groupmfi_doc_region->SetTotalControls("GetNextValue");
            $this->Parent->mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_region_Header->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_region_Header);
            $Groupmfi_doc_region->SetControls();
            $Groupmfi_doc_region->Mode = 1;
            $OpenFlag = true;
            $Groupmfi_doc_region->GroupType = "mfi_doc_region";
            $this->mmfi_doc_regionCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_doc_region;
            $this->Parent->Sum_Expr1->Reset();
        }
        if ($groupName == "batch_code" or $OpenFlag) {
            $Groupbatch_code = & $this->InitGroup(true);
            $this->Parent->batch_code_Header->CCSEventResult = CCGetEvent($this->Parent->batch_code_Header->CCSEvents, "OnInitialize", $this->Parent->batch_code_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->batch_code_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->batch_code_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->batch_code_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->batch_code_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->batch_code_Header->Height;
                $Groupbatch_code->SetTotalControls("GetNextValue");
            $this->Parent->batch_code_Header->CCSEventResult = CCGetEvent($this->Parent->batch_code_Header->CCSEvents, "OnCalculate", $this->Parent->batch_code_Header);
            $Groupbatch_code->SetControls();
            $Groupbatch_code->Mode = 1;
            $Groupbatch_code->GroupType = "batch_code";
            $this->mbatch_codeCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupbatch_code;
            $this->Parent->Sum_Expr11->Reset();
        }
    }

    function ClosePage() {
        $Group = & $this->InitGroup();
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnInitialize", $this->Parent->Page_Footer);
        $Group->SetTotalControls("GetPrevValue");
        $Group->SyncWithHeader($this->Groups[$this->mPageCurrentHeaderIndex]);
        $this->Parent->Page_Footer->CCSEventResult = CCGetEvent($this->Parent->Page_Footer->CCSEvents, "OnCalculate", $this->Parent->Page_Footer);
        $Group->SetControls();
        $this->RestoreValues();
        $this->CurrentPageSize = 0;
        $Group->Mode = 2;
        $Group->GroupType = "Page";
        $this->Groups[] = & $Group;
    }

    function CloseGroup($groupName)
    {
        $Group = "";
        if ($groupName == "Report") {
            $Group = & $this->InitGroup(true);
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnInitialize", $this->Parent->Report_Footer);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->Report_Footer->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->Report_Footer->Height;
            if (($this->PageSize > 0) and $this->Parent->Report_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            $Group->SetTotalControls("GetPrevValue");
            $Group->SyncWithHeader($this->Groups[0]);
            if ($this->Parent->Report_Footer->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Report_Footer->Height;
            $this->Parent->Report_Footer->CCSEventResult = CCGetEvent($this->Parent->Report_Footer->CCSEvents, "OnCalculate", $this->Parent->Report_Footer);
            $Group->SetControls();
            $this->RestoreValues();
            $Group->Mode = 2;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->ClosePage();
            return;
        }
        $Groupbatch_code = & $this->InitGroup(true);
        $this->Parent->batch_code_Footer->CCSEventResult = CCGetEvent($this->Parent->batch_code_Footer->CCSEvents, "OnInitialize", $this->Parent->batch_code_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->batch_code_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->batch_code_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->batch_code_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupbatch_code->SetTotalControls("GetPrevValue");
        $Groupbatch_code->SyncWithHeader($this->Groups[$this->mbatch_codeCurrentHeaderIndex]);
        if ($this->Parent->batch_code_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->batch_code_Footer->Height;
        $this->Parent->batch_code_Footer->CCSEventResult = CCGetEvent($this->Parent->batch_code_Footer->CCSEvents, "OnCalculate", $this->Parent->batch_code_Footer);
        $Groupbatch_code->SetControls();
        $this->Parent->Sum_Expr11->Reset();
        $this->RestoreValues();
        $Groupbatch_code->Mode = 2;
        $Groupbatch_code->GroupType ="batch_code";
        $this->Groups[] = & $Groupbatch_code;
        if ($groupName == "batch_code") return;
        $Groupmfi_doc_region = & $this->InitGroup(true);
        $this->Parent->mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_region_Footer->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_region_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mfi_doc_region_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mfi_doc_region_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mfi_doc_region_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmfi_doc_region->SetTotalControls("GetPrevValue");
        $Groupmfi_doc_region->SyncWithHeader($this->Groups[$this->mmfi_doc_regionCurrentHeaderIndex]);
        if ($this->Parent->mfi_doc_region_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_region_Footer->Height;
        $this->Parent->mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_region_Footer->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_region_Footer);
        $Groupmfi_doc_region->SetControls();
        $this->Parent->Sum_Expr1->Reset();
        $this->RestoreValues();
        $Groupmfi_doc_region->Mode = 2;
        $Groupmfi_doc_region->GroupType ="mfi_doc_region";
        $this->Groups[] = & $Groupmfi_doc_region;
    }

    function AddItem()
    {
        $Group = & $this->InitGroup(true);
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnInitialize", $this->Parent->Detail);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->Detail->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->Detail->Height;
        if (($this->PageSize > 0) and $this->Parent->Detail->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $this->TotalRows++;
        if ($this->LastDetailIndex)
            $PrevGroup = & $this->Groups[$this->LastDetailIndex];
        else
            $PrevGroup = "";
        $Group->SetTotalControls("", $PrevGroup);
        if ($this->Parent->Detail->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->Detail->Height;
        $this->Parent->Detail->CCSEventResult = CCGetEvent($this->Parent->Detail->CCSEvents, "OnCalculate", $this->Parent->Detail);
        $Group->SetControls($PrevGroup);
        $this->LastDetailIndex = count($this->Groups);
        $this->Groups[] = & $Group;
    }
}
//End mfi_docs1 GroupsCollection class

class clsReportmfi_docs1 { //mfi_docs1 Class @17-DA4EDEBB

//mfi_docs1 Variables @17-64FDA743

    public $ComponentType = "Report";
    public $PageSize;
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $CCSEvents = array();
    public $CCSEventResult;
    public $RelativePath = "";
    public $ViewMode = "Web";
    public $TemplateBlock;
    public $PageNumber;
    public $RowNumber;
    public $TotalRows;
    public $TotalPages;
    public $ControlsVisible = array();
    public $IsEmpty;
    public $Attributes;
    public $DetailBlock, $Detail;
    public $Report_FooterBlock, $Report_Footer;
    public $Report_HeaderBlock, $Report_Header;
    public $Page_FooterBlock, $Page_Footer;
    public $Page_HeaderBlock, $Page_Header;
    public $mfi_doc_region_HeaderBlock, $mfi_doc_region_Header;
    public $mfi_doc_region_FooterBlock, $mfi_doc_region_Footer;
    public $batch_code_HeaderBlock, $batch_code_Header;
    public $batch_code_FooterBlock, $batch_code_Footer;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $mfi_doc_region_HeaderControls, $mfi_doc_region_FooterControls;
    public $batch_code_HeaderControls, $batch_code_FooterControls;
//End mfi_docs1 Variables

//Class_Initialize Event @17-D145C39B
    function clsReportmfi_docs1($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_docs1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Footer = new clsSection($this);
        $this->Report_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Report_Footer->Height);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->mfi_doc_region_Footer = new clsSection($this);
        $this->mfi_doc_region_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_region_Footer->Height);
        $this->mfi_doc_region_Header = new clsSection($this);
        $this->mfi_doc_region_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_region_Header->Height);
        $this->batch_code_Footer = new clsSection($this);
        $this->batch_code_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->batch_code_Footer->Height);
        $this->batch_code_Header = new clsSection($this);
        $this->batch_code_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->batch_code_Header->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsmfi_docs1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->ViewMode = CCGetParam("ViewMode", "Web");
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else if($this->ViewMode == "Print") {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 0;
             else if ($PageSize == "0")
                $this->PageSize = 0;
             else 
                $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 0;
             else if ($PageSize == "0")
                $this->PageSize = 0;
             else 
                $this->PageSize = $PageSize;
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }

        $this->mfi_doc_region = new clsControl(ccsReportLabel, "mfi_doc_region", "mfi_doc_region", ccsText, "", "", $this);
        $this->batch_code = new clsControl(ccsLink, "batch_code", "batch_code", ccsText, "", CCGetRequestParam("batch_code", ccsGet, NULL), $this);
        $this->batch_code->Page = "";
        $this->mfi_doc_type = new clsControl(ccsReportLabel, "mfi_doc_type", "mfi_doc_type", ccsText, "", "", $this);
        $this->Expr1 = new clsControl(ccsReportLabel, "Expr1", "Expr1", ccsInteger, "", "", $this);
        $this->Sum_Expr11 = new clsControl(ccsReportLabel, "Sum_Expr11", "Sum_Expr11", ccsInteger, "", "", $this);
        $this->Sum_Expr11->TotalFunction = "Sum";
        $this->Sum_Expr1 = new clsControl(ccsReportLabel, "Sum_Expr1", "Sum_Expr1", ccsInteger, "", "", $this);
        $this->Sum_Expr1->TotalFunction = "Sum";
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->TotalSum_Expr1 = new clsControl(ccsReportLabel, "TotalSum_Expr1", "TotalSum_Expr1", ccsInteger, "", "", $this);
        $this->TotalSum_Expr1->TotalFunction = "Sum";
    }
//End Class_Initialize Event

//Initialize Method @17-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @17-24D45E39
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->batch_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->Expr1->Errors->Count());
        $errors = ($errors || $this->Sum_Expr11->Errors->Count());
        $errors = ($errors || $this->Sum_Expr1->Errors->Count());
        $errors = ($errors || $this->TotalSum_Expr1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @17-C556172E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_doc_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->batch_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_Expr11->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @17-9402E6D0
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_batch_code"] = CCGetFromGet("s_batch_code", NULL);
        $this->DataSource->Parameters["urlmfi_doc_region"] = CCGetFromGet("mfi_doc_region", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $mfi_doc_regionKey = "";
        $batch_codeKey = "";
        $Groups = new clsGroupsCollectionmfi_docs1($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
            $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
            $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
            $this->Expr1->SetValue($this->DataSource->Expr1->GetValue());
            $this->Sum_Expr11->SetValue($this->DataSource->Sum_Expr11->GetValue());
            $this->Sum_Expr1->SetValue($this->DataSource->Sum_Expr1->GetValue());
            $this->TotalSum_Expr1->SetValue($this->DataSource->TotalSum_Expr1->GetValue());
            $this->batch_code->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->batch_code->Parameters = CCAddParam($this->batch_code->Parameters, "s_batch_code", $this->DataSource->f("batch_code"));
            $this->batch_code->Parameters = CCAddParam($this->batch_code->Parameters, "mfi_doc_region", $this->DataSource->f("mfi_doc_region"));
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->OpenGroup("mfi_doc_region");
            } elseif ($batch_codeKey != $this->DataSource->f("batch_code")) {
                $Groups->OpenGroup("batch_code");
            }
            $Groups->AddItem();
            $mfi_doc_regionKey = $this->DataSource->f("mfi_doc_region");
            $batch_codeKey = $this->DataSource->f("batch_code");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->CloseGroup("mfi_doc_region");
            } elseif ($batch_codeKey != $this->DataSource->f("batch_code")) {
                $Groups->CloseGroup("batch_code");
            }
        }
        if (!count($Groups->Groups)) 
            $Groups->OpenGroup("Report");
        else
            $this->NoRecords->Visible = false;
        $Groups->CloseGroup("Report");
        $this->TotalPages = $Groups->TotalPages;
        $this->TotalRows = $Groups->TotalRows;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $this->Attributes->Show();
        $ReportBlock = "Report " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;

        if($this->CheckErrors()) {
            $Tpl->replaceblock("", $this->GetErrors());
            $Tpl->block_path = $ParentPath;
            return;
        } else {
            $items = & $Groups->Groups;
            $i = $Groups->Pages[min($this->PageNumber, $Groups->TotalPages) - 1];
            $this->ControlsVisible["mfi_doc_region"] = $this->mfi_doc_region->Visible;
            $this->ControlsVisible["batch_code"] = $this->batch_code->Visible;
            $this->ControlsVisible["mfi_doc_type"] = $this->mfi_doc_type->Visible;
            $this->ControlsVisible["Expr1"] = $this->Expr1->Visible;
            $this->ControlsVisible["Sum_Expr11"] = $this->Sum_Expr11->Visible;
            $this->ControlsVisible["Sum_Expr1"] = $this->Sum_Expr1->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->mfi_doc_type->SetValue($items[$i]->mfi_doc_type);
                        $this->mfi_doc_type->Attributes->RestoreFromArray($items[$i]->_mfi_doc_typeAttributes);
                        $this->Expr1->SetValue($items[$i]->Expr1);
                        $this->Expr1->Attributes->RestoreFromArray($items[$i]->_Expr1Attributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->mfi_doc_type->Show();
                        $this->Expr1->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->TotalSum_Expr1->SetValue($items[$i]->TotalSum_Expr1);
                            $this->TotalSum_Expr1->Attributes->RestoreFromArray($items[$i]->_TotalSum_Expr1Attributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_Expr1->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Report_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "Page":
                        if ($items[$i]->Mode == 1) {
                            $this->Page_Header->CCSEventResult = CCGetEvent($this->Page_Header->CCSEvents, "BeforeShow", $this->Page_Header);
                            if ($this->Page_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2 && !$this->UseClientPaging || $items[$i]->Mode == 1 && $this->UseClientPaging) {
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "mfi_doc_region":
                        if ($items[$i]->Mode == 1) {
                            $this->mfi_doc_region->SetValue($items[$i]->mfi_doc_region);
                            $this->mfi_doc_region->Attributes->RestoreFromArray($items[$i]->_mfi_doc_regionAttributes);
                            $this->mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->mfi_doc_region_Header->CCSEvents, "BeforeShow", $this->mfi_doc_region_Header);
                            if ($this->mfi_doc_region_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_region_Header";
                                $this->Attributes->Show();
                                $this->mfi_doc_region->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_region_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Sum_Expr1->SetValue($items[$i]->Sum_Expr1);
                            $this->Sum_Expr1->Attributes->RestoreFromArray($items[$i]->_Sum_Expr1Attributes);
                            $this->mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_region_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_region_Footer);
                            if ($this->mfi_doc_region_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_region_Footer";
                                $this->Sum_Expr1->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_region_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "batch_code":
                        if ($items[$i]->Mode == 1) {
                            $this->batch_code->SetValue($items[$i]->batch_code);
                            $this->batch_code->Page = $items[$i]->_batch_codePage;
                            $this->batch_code->Parameters = $items[$i]->_batch_codeParameters;
                            $this->batch_code->Attributes->RestoreFromArray($items[$i]->_batch_codeAttributes);
                            $this->batch_code_Header->CCSEventResult = CCGetEvent($this->batch_code_Header->CCSEvents, "BeforeShow", $this->batch_code_Header);
                            if ($this->batch_code_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section batch_code_Header";
                                $this->Attributes->Show();
                                $this->batch_code->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section batch_code_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Sum_Expr11->SetValue($items[$i]->Sum_Expr11);
                            $this->Sum_Expr11->Attributes->RestoreFromArray($items[$i]->_Sum_Expr11Attributes);
                            $this->batch_code_Footer->CCSEventResult = CCGetEvent($this->batch_code_Footer->CCSEvents, "BeforeShow", $this->batch_code_Footer);
                            if ($this->batch_code_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section batch_code_Footer";
                                $this->Sum_Expr11->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section batch_code_Footer", true, "Section Detail");
                            }
                        }
                        break;
                }
                $i++;
            } while ($i < count($items) && ($this->ViewMode == "Print" ||  !($i > 1 && $items[$i]->GroupType == 'Page' && $items[$i]->Mode == 1)));
            $Tpl->block_path = $ParentPath;
            $Tpl->parse($ReportBlock);
            $this->DataSource->close();
        }

    }
//End Show Method

} //End mfi_docs1 Class @17-FCB6E20C

class clsmfi_docs1DataSource extends clsDBmysql_cams_v2 {  //mfi_docs1DataSource Class @17-0016A841

//DataSource Variables @17-31B2DCF9
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $mfi_doc_region;
    public $batch_code;
    public $mfi_doc_type;
    public $Expr1;
    public $Sum_Expr11;
    public $Sum_Expr1;
    public $TotalSum_Expr1;
//End DataSource Variables

//DataSourceClass_Initialize Event @17-5FDA24A3
    function clsmfi_docs1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_docs1";
        $this->Initialize();
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsText, "");
        
        $this->Expr1 = new clsField("Expr1", ccsInteger, "");
        
        $this->Sum_Expr11 = new clsField("Sum_Expr11", ccsInteger, "");
        
        $this->Sum_Expr1 = new clsField("Sum_Expr1", ccsInteger, "");
        
        $this->TotalSum_Expr1 = new clsField("TotalSum_Expr1", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @17-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @17-5726937F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urls_batch_code", ccsText, "", "", $this->Parameters["urls_batch_code"], "", false);
        $this->wp->AddParameter("3", "urlmfi_doc_region", ccsText, "", "", $this->Parameters["urlmfi_doc_region"], "", false);
        $this->wp->Criterion[1] = "( batch_code='{batch_code}' )";
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "batch_code", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "mfi_doc_region", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @17-64D05B92
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT batch_code, mfi_doc_type, mfi_doc_region, count(*) AS Expr1, mfi_doc_id \n\n" .
        "FROM mfi_docs {SQL_Where}\n\n" .
        "GROUP BY mfi_doc_region, mfi_doc_type {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "mfi_doc_region asc,batch_code asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @17-391DC483
    function SetValues()
    {
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->mfi_doc_type->SetDBValue($this->f("mfi_doc_type"));
        $this->Expr1->SetDBValue(trim($this->f("Expr1")));
        $this->Sum_Expr11->SetDBValue(trim($this->f("Expr1")));
        $this->Sum_Expr1->SetDBValue(trim($this->f("Expr1")));
        $this->TotalSum_Expr1->SetDBValue(trim($this->f("Expr1")));
    }
//End SetValues Method

} //End mfi_docs1DataSource Class @17-FCB6E20C

class clsGridPENDING_LA_NO_IN_BATCH { //PENDING_LA_NO_IN_BATCH class @110-B7EE67BB

//Variables @110-C60273D3

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
    public $Sorter_mfi_doc_territory_code;
//End Variables

//Class_Initialize Event @110-293F0E4A
    function clsGridPENDING_LA_NO_IN_BATCH($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "PENDING_LA_NO_IN_BATCH";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid PENDING_LA_NO_IN_BATCH";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsPENDING_LA_NO_IN_BATCHDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 30;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("PENDING_LA_NO_IN_BATCHOrder", "");
        $this->SorterDirection = CCGetParam("PENDING_LA_NO_IN_BATCHDir", "");

        $this->mfi_doc_territory_code = new clsControl(ccsLabel, "mfi_doc_territory_code", "mfi_doc_territory_code", ccsText, "", CCGetRequestParam("mfi_doc_territory_code", ccsGet, NULL), $this);
        $this->Sorter_mfi_doc_territory_code = new clsSorter($this->ComponentName, "Sorter_mfi_doc_territory_code", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @110-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @110-CE69FE2C
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_batch_code"] = CCGetFromGet("s_batch_code", NULL);

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
            $this->ControlsVisible["mfi_doc_territory_code"] = $this->mfi_doc_territory_code->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mfi_doc_territory_code->SetValue($this->DataSource->mfi_doc_territory_code->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_doc_territory_code->Show();
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
        $this->Sorter_mfi_doc_territory_code->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @110-55FB6925
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_doc_territory_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End PENDING_LA_NO_IN_BATCH Class @110-FCB6E20C

class clsPENDING_LA_NO_IN_BATCHDataSource extends clsDBmysql_cams_v2 {  //PENDING_LA_NO_IN_BATCHDataSource Class @110-5291201A

//DataSource Variables @110-87EC34E0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_doc_territory_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @110-D36A43DB
    function clsPENDING_LA_NO_IN_BATCHDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid PENDING_LA_NO_IN_BATCH";
        $this->Initialize();
        $this->mfi_doc_territory_code = new clsField("mfi_doc_territory_code", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @110-7AD2C7FE
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mfi_doc_territory_code" => array("mfi_doc_territory_code", "")));
    }
//End SetOrder Method

//Prepare Method @110-CADBFB12
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_batch_code", ccsText, "", "", $this->Parameters["urls_batch_code"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_docs.batch_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = "( mfi_docs.mfi_doc_territory_code IS NOT NULL )";
        $this->wp->Criterion[3] = "( mfi_docs.mfi_doc_type='LA1' and mfi_docs.mfi_doc_status='DATA ENTERED' )";
        $this->wp->Criterion[4] = "( camsdata123.`LA NO` IS NULL )";
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

//Open Method @110-571917AF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_docs LEFT JOIN camsdata123 ON\n\n" .
        "mfi_docs.mfi_doc_territory_code = camsdata123.";
        $this->SQL = "SELECT mfi_doc_territory_code \n\n" .
        "FROM mfi_docs LEFT JOIN camsdata123 ON\n\n" .
        "mfi_docs.mfi_doc_territory_code = camsdata123. {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @110-418FA59E
    function SetValues()
    {
        $this->mfi_doc_territory_code->SetDBValue($this->f("mfi_doc_territory_code"));
    }
//End SetValues Method

} //End PENDING_LA_NO_IN_BATCHDataSource Class @110-FCB6E20C

//Include Page implementation @2-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @4-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Include Page implementation @3-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation



//Initialize Page @1-6DA63E53
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
$TemplateFileName = "Doc_Tagging_Report_Summary.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-5F3AC0AD
include_once("./Doc_Tagging_Report_Summary_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CE6F4B0A
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_docsSearch = new clsRecordmfi_docsSearch("", $MainPage);
$Report_Print = new clsControl(ccsLink, "Report_Print", "Report_Print", ccsText, "", CCGetRequestParam("Report_Print", ccsGet, NULL), $MainPage);
$Report_Print->Page = "Doc_Tagging_Report_Summary.php";
$Panel1 = new clsPanel("Panel1", $MainPage);
$mfi_docs_mfi_hvf2 = new clsGridmfi_docs_mfi_hvf2("", $MainPage);
$mfi_docs1 = new clsReportmfi_docs1("", $MainPage);
$PENDING_LA_NO_IN_BATCH = new clsGridPENDING_LA_NO_IN_BATCH("", $MainPage);
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$MainPage->mfi_docsSearch = & $mfi_docsSearch;
$MainPage->Report_Print = & $Report_Print;
$MainPage->Panel1 = & $Panel1;
$MainPage->mfi_docs_mfi_hvf2 = & $mfi_docs_mfi_hvf2;
$MainPage->mfi_docs1 = & $mfi_docs1;
$MainPage->PENDING_LA_NO_IN_BATCH = & $PENDING_LA_NO_IN_BATCH;
$MainPage->incHeader = & $incHeader;
$MainPage->incMenu = & $incMenu;
$MainPage->incFooter = & $incFooter;
$Panel1->AddComponent("mfi_docs_mfi_hvf2", $mfi_docs_mfi_hvf2);
$Panel1->AddComponent("mfi_docs1", $mfi_docs1);
$Panel1->AddComponent("PENDING_LA_NO_IN_BATCH", $PENDING_LA_NO_IN_BATCH);
$Report_Print->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Report_Print->Parameters = CCAddParam($Report_Print->Parameters, "ViewMode", "Print");
$mfi_docs_mfi_hvf2->Initialize();
$mfi_docs1->Initialize();
$PENDING_LA_NO_IN_BATCH->Initialize();

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

//Execute Components @1-233BC2BF
$incFooter->Operations();
$incMenu->Operations();
$incHeader->Operations();
$mfi_docsSearch->Operation();
//End Execute Components

//Go to destination page @1-DBA25BE7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_docsSearch);
    unset($mfi_docs_mfi_hvf2);
    unset($mfi_docs1);
    unset($PENDING_LA_NO_IN_BATCH);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incMenu->Class_Terminate();
    unset($incMenu);
    $incFooter->Class_Terminate();
    unset($incFooter);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E2FCD4D6
$mfi_docsSearch->Show();
$incHeader->Show();
$incMenu->Show();
$incFooter->Show();
$Report_Print->Show();
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1146F75A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_docsSearch);
unset($mfi_docs_mfi_hvf2);
unset($mfi_docs1);
unset($PENDING_LA_NO_IN_BATCH);
$incHeader->Class_Terminate();
unset($incHeader);
$incMenu->Class_Terminate();
unset($incMenu);
$incFooter->Class_Terminate();
unset($incFooter);
unset($Tpl);
//End Unload Page


?>
