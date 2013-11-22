<?php
//Include Common Files @1-89EC451A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ManageLAForm_dup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsGridmfi_hvf2_mfi_hvf1 { //mfi_hvf2_mfi_hvf1 class @2-13FEA03E

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

//Class_Initialize Event @2-BFEFF98D
    function clsGridmfi_hvf2_mfi_hvf1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_hvf2_mfi_hvf1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_hvf2_mfi_hvf1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_hvf2_mfi_hvf1DataSource($this);
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

        $this->mfi_hvf1_la_id = new clsControl(ccsLabel, "mfi_hvf1_la_id", "mfi_hvf1_la_id", ccsText, "", CCGetRequestParam("mfi_hvf1_la_id", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_name = new clsControl(ccsLabel, "mfi_hvf1_customer_name", "mfi_hvf1_customer_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_father_name = new clsControl(ccsLabel, "mfi_hvf1_customer_father_name", "mfi_hvf1_customer_father_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_father_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_husband_name = new clsControl(ccsLabel, "mfi_hvf1_customer_husband_name", "mfi_hvf1_customer_husband_name", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_husband_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_mobile_no = new clsControl(ccsLabel, "mfi_hvf1_customer_mobile_no", "mfi_hvf1_customer_mobile_no", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_mobile_no", ccsGet, NULL), $this);
        $this->mfi_gp_proposed_group_name = new clsControl(ccsLabel, "mfi_gp_proposed_group_name", "mfi_gp_proposed_group_name", ccsText, "", CCGetRequestParam("mfi_gp_proposed_group_name", ccsGet, NULL), $this);
        $this->mfi_hvf2_group_size = new clsControl(ccsLabel, "mfi_hvf2_group_size", "mfi_hvf2_group_size", ccsInteger, "", CCGetRequestParam("mfi_hvf2_group_size", ccsGet, NULL), $this);
        $this->mfi_hvf2_customer_guarantor_type = new clsControl(ccsLabel, "mfi_hvf2_customer_guarantor_type", "mfi_hvf2_customer_guarantor_type", ccsText, "", CCGetRequestParam("mfi_hvf2_customer_guarantor_type", ccsGet, NULL), $this);
        $this->mfi_hvf2_customer_guarantor_name = new clsControl(ccsLabel, "mfi_hvf2_customer_guarantor_name", "mfi_hvf2_customer_guarantor_name", ccsText, "", CCGetRequestParam("mfi_hvf2_customer_guarantor_name", ccsGet, NULL), $this);
        $this->mfi_hvf1_error_cols = new clsControl(ccsLabel, "mfi_hvf1_error_cols", "mfi_hvf1_error_cols", ccsText, "", CCGetRequestParam("mfi_hvf1_error_cols", ccsGet, NULL), $this);
        $this->mfi_hvf2_error_cols = new clsControl(ccsLabel, "mfi_hvf2_error_cols", "mfi_hvf2_error_cols", ccsText, "", CCGetRequestParam("mfi_hvf2_error_cols", ccsGet, NULL), $this);
        $this->mfi_hvf1_gp_id = new clsControl(ccsLabel, "mfi_hvf1_gp_id", "mfi_hvf1_gp_id", ccsText, "", CCGetRequestParam("mfi_hvf1_gp_id", ccsGet, NULL), $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
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

//Show Method @2-F5BA19B0
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_mfi_hvf1_la_id"] = CCGetFromGet("s_mfi_hvf1_la_id", NULL);
        $this->DataSource->Parameters["urls_mfi_hvf1_gp_id"] = CCGetFromGet("s_mfi_hvf1_gp_id", NULL);

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
            $this->ControlsVisible["mfi_hvf1_la_id"] = $this->mfi_hvf1_la_id->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_name"] = $this->mfi_hvf1_customer_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_father_name"] = $this->mfi_hvf1_customer_father_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_husband_name"] = $this->mfi_hvf1_customer_husband_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_mobile_no"] = $this->mfi_hvf1_customer_mobile_no->Visible;
            $this->ControlsVisible["mfi_gp_proposed_group_name"] = $this->mfi_gp_proposed_group_name->Visible;
            $this->ControlsVisible["mfi_hvf2_group_size"] = $this->mfi_hvf2_group_size->Visible;
            $this->ControlsVisible["mfi_hvf2_customer_guarantor_type"] = $this->mfi_hvf2_customer_guarantor_type->Visible;
            $this->ControlsVisible["mfi_hvf2_customer_guarantor_name"] = $this->mfi_hvf2_customer_guarantor_name->Visible;
            $this->ControlsVisible["mfi_hvf1_error_cols"] = $this->mfi_hvf1_error_cols->Visible;
            $this->ControlsVisible["mfi_hvf2_error_cols"] = $this->mfi_hvf2_error_cols->Visible;
            $this->ControlsVisible["mfi_hvf1_gp_id"] = $this->mfi_hvf1_gp_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mfi_hvf1_la_id->SetValue($this->DataSource->mfi_hvf1_la_id->GetValue());
                $this->mfi_hvf1_customer_name->SetValue($this->DataSource->mfi_hvf1_customer_name->GetValue());
                $this->mfi_hvf1_customer_father_name->SetValue($this->DataSource->mfi_hvf1_customer_father_name->GetValue());
                $this->mfi_hvf1_customer_husband_name->SetValue($this->DataSource->mfi_hvf1_customer_husband_name->GetValue());
                $this->mfi_hvf1_customer_mobile_no->SetValue($this->DataSource->mfi_hvf1_customer_mobile_no->GetValue());
                $this->mfi_gp_proposed_group_name->SetValue($this->DataSource->mfi_gp_proposed_group_name->GetValue());
                $this->mfi_hvf2_group_size->SetValue($this->DataSource->mfi_hvf2_group_size->GetValue());
                $this->mfi_hvf2_customer_guarantor_type->SetValue($this->DataSource->mfi_hvf2_customer_guarantor_type->GetValue());
                $this->mfi_hvf2_customer_guarantor_name->SetValue($this->DataSource->mfi_hvf2_customer_guarantor_name->GetValue());
                $this->mfi_hvf1_error_cols->SetValue($this->DataSource->mfi_hvf1_error_cols->GetValue());
                $this->mfi_hvf2_error_cols->SetValue($this->DataSource->mfi_hvf2_error_cols->GetValue());
                $this->mfi_hvf1_gp_id->SetValue($this->DataSource->mfi_hvf1_gp_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_hvf1_la_id->Show();
                $this->mfi_hvf1_customer_name->Show();
                $this->mfi_hvf1_customer_father_name->Show();
                $this->mfi_hvf1_customer_husband_name->Show();
                $this->mfi_hvf1_customer_mobile_no->Show();
                $this->mfi_gp_proposed_group_name->Show();
                $this->mfi_hvf2_group_size->Show();
                $this->mfi_hvf2_customer_guarantor_type->Show();
                $this->mfi_hvf2_customer_guarantor_name->Show();
                $this->mfi_hvf1_error_cols->Show();
                $this->mfi_hvf2_error_cols->Show();
                $this->mfi_hvf1_gp_id->Show();
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

//GetErrors Method @2-C5CD025C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_hvf1_la_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_father_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_husband_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_mobile_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_gp_proposed_group_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_group_size->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_customer_guarantor_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_customer_guarantor_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_error_cols->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_error_cols->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_gp_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_hvf2_mfi_hvf1 Class @2-FCB6E20C

class clsmfi_hvf2_mfi_hvf1DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf2_mfi_hvf1DataSource Class @2-B228CD71

//DataSource Variables @2-0DDEF92E
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_hvf1_la_id;
    public $mfi_hvf1_customer_name;
    public $mfi_hvf1_customer_father_name;
    public $mfi_hvf1_customer_husband_name;
    public $mfi_hvf1_customer_mobile_no;
    public $mfi_gp_proposed_group_name;
    public $mfi_hvf2_group_size;
    public $mfi_hvf2_customer_guarantor_type;
    public $mfi_hvf2_customer_guarantor_name;
    public $mfi_hvf1_error_cols;
    public $mfi_hvf2_error_cols;
    public $mfi_hvf1_gp_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-AB2A7903
    function clsmfi_hvf2_mfi_hvf1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_hvf2_mfi_hvf1";
        $this->Initialize();
        $this->mfi_hvf1_la_id = new clsField("mfi_hvf1_la_id", ccsText, "");
        
        $this->mfi_hvf1_customer_name = new clsField("mfi_hvf1_customer_name", ccsText, "");
        
        $this->mfi_hvf1_customer_father_name = new clsField("mfi_hvf1_customer_father_name", ccsText, "");
        
        $this->mfi_hvf1_customer_husband_name = new clsField("mfi_hvf1_customer_husband_name", ccsText, "");
        
        $this->mfi_hvf1_customer_mobile_no = new clsField("mfi_hvf1_customer_mobile_no", ccsText, "");
        
        $this->mfi_gp_proposed_group_name = new clsField("mfi_gp_proposed_group_name", ccsText, "");
        
        $this->mfi_hvf2_group_size = new clsField("mfi_hvf2_group_size", ccsInteger, "");
        
        $this->mfi_hvf2_customer_guarantor_type = new clsField("mfi_hvf2_customer_guarantor_type", ccsText, "");
        
        $this->mfi_hvf2_customer_guarantor_name = new clsField("mfi_hvf2_customer_guarantor_name", ccsText, "");
        
        $this->mfi_hvf1_error_cols = new clsField("mfi_hvf1_error_cols", ccsText, "");
        
        $this->mfi_hvf2_error_cols = new clsField("mfi_hvf2_error_cols", ccsText, "");
        
        $this->mfi_hvf1_gp_id = new clsField("mfi_hvf1_gp_id", ccsText, "");
        

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

//Prepare Method @2-23B62033
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_mfi_hvf1_la_id", ccsText, "", "", $this->Parameters["urls_mfi_hvf1_la_id"], "", false);
        $this->wp->AddParameter("2", "urls_mfi_hvf1_gp_id", ccsText, "", "", $this->Parameters["urls_mfi_hvf1_gp_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "mfi_hvf1.la_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "mfi_hvf1.gp_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-E56154F7
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_hvf1 LEFT JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id";
        $this->SQL = "SELECT mfi_hvf1.la_id AS mfi_hvf1_la_id, mfi_hvf1_customer_name, mfi_hvf1_customer_father_name, mfi_hvf1_customer_husband_name, mfi_hvf1_customer_mobile_no,\n\n" .
        "mfi_hvf1.gp_id AS mfi_hvf1_gp_id, mfi_gp_proposed_group_name, mfi_hvf2_group_size, mfi_hvf2_customer_guarantor_type, mfi_hvf2_customer_guarantor_name,\n\n" .
        "mfi_hvf1.error_cols AS mfi_hvf1_error_cols, mfi_hvf2.error_cols AS mfi_hvf2_error_cols \n\n" .
        "FROM mfi_hvf1 LEFT JOIN mfi_hvf2 ON\n\n" .
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

//SetValues Method @2-533E7F4B
    function SetValues()
    {
        $this->mfi_hvf1_la_id->SetDBValue($this->f("mfi_hvf1_la_id"));
        $this->mfi_hvf1_customer_name->SetDBValue($this->f("mfi_hvf1_customer_name"));
        $this->mfi_hvf1_customer_father_name->SetDBValue($this->f("mfi_hvf1_customer_father_name"));
        $this->mfi_hvf1_customer_husband_name->SetDBValue($this->f("mfi_hvf1_customer_husband_name"));
        $this->mfi_hvf1_customer_mobile_no->SetDBValue($this->f("mfi_hvf1_customer_mobile_no"));
        $this->mfi_gp_proposed_group_name->SetDBValue($this->f("mfi_gp_proposed_group_name"));
        $this->mfi_hvf2_group_size->SetDBValue(trim($this->f("mfi_hvf2_group_size")));
        $this->mfi_hvf2_customer_guarantor_type->SetDBValue($this->f("mfi_hvf2_customer_guarantor_type"));
        $this->mfi_hvf2_customer_guarantor_name->SetDBValue($this->f("mfi_hvf2_customer_guarantor_name"));
        $this->mfi_hvf1_error_cols->SetDBValue($this->f("mfi_hvf1_error_cols"));
        $this->mfi_hvf2_error_cols->SetDBValue($this->f("mfi_hvf2_error_cols"));
        $this->mfi_hvf1_gp_id->SetDBValue($this->f("mfi_hvf1_gp_id"));
    }
//End SetValues Method

} //End mfi_hvf2_mfi_hvf1DataSource Class @2-FCB6E20C

class clsRecordmfi_hvf2_mfi_hvf2 { //mfi_hvf2_mfi_hvf2 Class @33-92F7ACC4

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

//Class_Initialize Event @33-EBC93A67
    function clsRecordmfi_hvf2_mfi_hvf2($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_hvf2_mfi_hvf2/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_hvf2_mfi_hvf2";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_mfi_hvf1_la_id = new clsControl(ccsTextBox, "s_mfi_hvf1_la_id", $CCSLocales->GetText("mfi_hvf1_la_id"), ccsText, "", CCGetRequestParam("s_mfi_hvf1_la_id", $Method, NULL), $this);
            $this->s_mfi_hvf1_gp_id = new clsControl(ccsTextBox, "s_mfi_hvf1_gp_id", $CCSLocales->GetText("mfi_hvf1_gp_id"), ccsText, "", CCGetRequestParam("s_mfi_hvf1_gp_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @33-E574F208
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mfi_hvf1_la_id->Validate() && $Validation);
        $Validation = ($this->s_mfi_hvf1_gp_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mfi_hvf1_la_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_hvf1_gp_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @33-C8AB51D2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mfi_hvf1_la_id->Errors->Count());
        $errors = ($errors || $this->s_mfi_hvf1_gp_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @33-2DBD2A09
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
        $Redirect = "ManageLAForm_dup.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ManageLAForm_dup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @33-14A575FC
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
            $Error = ComposeStrings($Error, $this->s_mfi_hvf1_la_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_hvf1_gp_id->Errors->ToString());
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
        $this->s_mfi_hvf1_la_id->Show();
        $this->s_mfi_hvf1_gp_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_hvf2_mfi_hvf2 Class @33-FCB6E20C

//Include Page implementation @39-05EE5DFD
include_once(RelativePath . "/incHeader.php");
//End Include Page implementation

//Include Page implementation @40-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Include Page implementation @41-60E713C2
include_once(RelativePath . "/incFooter.php");
//End Include Page implementation

//Initialize Page @1-48742E80
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
$TemplateFileName = "ManageLAForm_dup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-6E0819C3
include_once("./ManageLAForm_dup_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-BFDFB291
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_hvf2_mfi_hvf1 = new clsGridmfi_hvf2_mfi_hvf1("", $MainPage);
$mfi_hvf2_mfi_hvf2 = new clsRecordmfi_hvf2_mfi_hvf2("", $MainPage);
$incHeader = new clsincHeader("", "incHeader", $MainPage);
$incHeader->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$incFooter = new clsincFooter("", "incFooter", $MainPage);
$incFooter->Initialize();
$MainPage->mfi_hvf2_mfi_hvf1 = & $mfi_hvf2_mfi_hvf1;
$MainPage->mfi_hvf2_mfi_hvf2 = & $mfi_hvf2_mfi_hvf2;
$MainPage->incHeader = & $incHeader;
$MainPage->incMenu = & $incMenu;
$MainPage->incFooter = & $incFooter;
$mfi_hvf2_mfi_hvf1->Initialize();

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

//Execute Components @1-D5773EC4
$incFooter->Operations();
$incMenu->Operations();
$incHeader->Operations();
$mfi_hvf2_mfi_hvf2->Operation();
//End Execute Components

//Go to destination page @1-6A1DCFE0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_hvf2_mfi_hvf1);
    unset($mfi_hvf2_mfi_hvf2);
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

//Show Page @1-B0029992
$mfi_hvf2_mfi_hvf1->Show();
$mfi_hvf2_mfi_hvf2->Show();
$incHeader->Show();
$incMenu->Show();
$incFooter->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B3D709A8
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_hvf2_mfi_hvf1);
unset($mfi_hvf2_mfi_hvf2);
$incHeader->Class_Terminate();
unset($incHeader);
$incMenu->Class_Terminate();
unset($incMenu);
$incFooter->Class_Terminate();
unset($incFooter);
unset($Tpl);
//End Unload Page


?>
