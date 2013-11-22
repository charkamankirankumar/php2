<?php
//Include Common Files @1-844282EE
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "CBResponseAnalysys.php");
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

//Include Page implementation @4-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation



class clsGridoverlap_reports { //overlap_reports class @16-C3717FDE

//Variables @16-5DF28882

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
    public $Sorter_MBR_ID;
    public $Sorter_NAME;
    public $Sorter_SPOUSE;
    public $Sorter_ID_VALUE_1;
    public $Sorter_final_result;
    public $Sorter_suggested_amount;
    public $Sorter_rejection_reason;
//End Variables

//Class_Initialize Event @16-20B30E41
    function clsGridoverlap_reports($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "overlap_reports";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid overlap_reports";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsoverlap_reportsDataSource($this);
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
        $this->SorterName = CCGetParam("overlap_reportsOrder", "");
        $this->SorterDirection = CCGetParam("overlap_reportsDir", "");

        $this->MBR_ID = new clsControl(ccsLabel, "MBR_ID", "MBR_ID", ccsText, "", CCGetRequestParam("MBR_ID", ccsGet, NULL), $this);
        $this->NAME = new clsControl(ccsLabel, "NAME", "NAME", ccsText, "", CCGetRequestParam("NAME", ccsGet, NULL), $this);
        $this->SPOUSE = new clsControl(ccsLabel, "SPOUSE", "SPOUSE", ccsText, "", CCGetRequestParam("SPOUSE", ccsGet, NULL), $this);
        $this->ID_VALUE_1 = new clsControl(ccsLabel, "ID_VALUE_1", "ID_VALUE_1", ccsText, "", CCGetRequestParam("ID_VALUE_1", ccsGet, NULL), $this);
        $this->final_result = new clsControl(ccsLabel, "final_result", "final_result", ccsText, "", CCGetRequestParam("final_result", ccsGet, NULL), $this);
        $this->suggested_amount = new clsControl(ccsLabel, "suggested_amount", "suggested_amount", ccsText, "", CCGetRequestParam("suggested_amount", ccsGet, NULL), $this);
        $this->rejection_reason = new clsControl(ccsLabel, "rejection_reason", "rejection_reason", ccsText, "", CCGetRequestParam("rejection_reason", ccsGet, NULL), $this);
        $this->primary_match = new clsControl(ccsLabel, "primary_match", "primary_match", ccsText, "", CCGetRequestParam("primary_match", ccsGet, NULL), $this);
        $this->tlo = new clsControl(ccsLabel, "tlo", "tlo", ccsText, "", CCGetRequestParam("tlo", ccsGet, NULL), $this);
        $this->tla = new clsControl(ccsLabel, "tla", "tla", ccsText, "", CCGetRequestParam("tla", ccsGet, NULL), $this);
        $this->overlap_reports_TotalRecords = new clsControl(ccsLabel, "overlap_reports_TotalRecords", "overlap_reports_TotalRecords", ccsText, "", CCGetRequestParam("overlap_reports_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_MBR_ID = new clsSorter($this->ComponentName, "Sorter_MBR_ID", $FileName, $this);
        $this->Sorter_NAME = new clsSorter($this->ComponentName, "Sorter_NAME", $FileName, $this);
        $this->Sorter_SPOUSE = new clsSorter($this->ComponentName, "Sorter_SPOUSE", $FileName, $this);
        $this->Sorter_ID_VALUE_1 = new clsSorter($this->ComponentName, "Sorter_ID_VALUE_1", $FileName, $this);
        $this->Sorter_final_result = new clsSorter($this->ComponentName, "Sorter_final_result", $FileName, $this);
        $this->Sorter_suggested_amount = new clsSorter($this->ComponentName, "Sorter_suggested_amount", $FileName, $this);
        $this->Sorter_rejection_reason = new clsSorter($this->ComponentName, "Sorter_rejection_reason", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @16-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @16-89A4A366
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlheader_id"] = CCGetFromGet("header_id", NULL);

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
            $this->ControlsVisible["MBR_ID"] = $this->MBR_ID->Visible;
            $this->ControlsVisible["NAME"] = $this->NAME->Visible;
            $this->ControlsVisible["SPOUSE"] = $this->SPOUSE->Visible;
            $this->ControlsVisible["ID_VALUE_1"] = $this->ID_VALUE_1->Visible;
            $this->ControlsVisible["final_result"] = $this->final_result->Visible;
            $this->ControlsVisible["suggested_amount"] = $this->suggested_amount->Visible;
            $this->ControlsVisible["rejection_reason"] = $this->rejection_reason->Visible;
            $this->ControlsVisible["primary_match"] = $this->primary_match->Visible;
            $this->ControlsVisible["tlo"] = $this->tlo->Visible;
            $this->ControlsVisible["tla"] = $this->tla->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->MBR_ID->SetValue($this->DataSource->MBR_ID->GetValue());
                $this->NAME->SetValue($this->DataSource->NAME->GetValue());
                $this->SPOUSE->SetValue($this->DataSource->SPOUSE->GetValue());
                $this->ID_VALUE_1->SetValue($this->DataSource->ID_VALUE_1->GetValue());
                $this->final_result->SetValue($this->DataSource->final_result->GetValue());
                $this->suggested_amount->SetValue($this->DataSource->suggested_amount->GetValue());
                $this->rejection_reason->SetValue($this->DataSource->rejection_reason->GetValue());
                $this->primary_match->SetValue($this->DataSource->primary_match->GetValue());
                $this->tlo->SetValue($this->DataSource->tlo->GetValue());
                $this->tla->SetValue($this->DataSource->tla->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->MBR_ID->Show();
                $this->NAME->Show();
                $this->SPOUSE->Show();
                $this->ID_VALUE_1->Show();
                $this->final_result->Show();
                $this->suggested_amount->Show();
                $this->rejection_reason->Show();
                $this->primary_match->Show();
                $this->tlo->Show();
                $this->tla->Show();
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
        $this->overlap_reports_TotalRecords->Show();
        $this->Sorter_MBR_ID->Show();
        $this->Sorter_NAME->Show();
        $this->Sorter_SPOUSE->Show();
        $this->Sorter_ID_VALUE_1->Show();
        $this->Sorter_final_result->Show();
        $this->Sorter_suggested_amount->Show();
        $this->Sorter_rejection_reason->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @16-9147C9B5
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->MBR_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SPOUSE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ID_VALUE_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->final_result->Errors->ToString());
        $errors = ComposeStrings($errors, $this->suggested_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rejection_reason->Errors->ToString());
        $errors = ComposeStrings($errors, $this->primary_match->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tlo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tla->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End overlap_reports Class @16-FCB6E20C

class clsoverlap_reportsDataSource extends clsDBmysql_cams_v2 {  //overlap_reportsDataSource Class @16-FEFA7ABA

//DataSource Variables @16-95639EA0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $MBR_ID;
    public $NAME;
    public $SPOUSE;
    public $ID_VALUE_1;
    public $final_result;
    public $suggested_amount;
    public $rejection_reason;
    public $primary_match;
    public $tlo;
    public $tla;
//End DataSource Variables

//DataSourceClass_Initialize Event @16-C3DBF5F9
    function clsoverlap_reportsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid overlap_reports";
        $this->Initialize();
        $this->MBR_ID = new clsField("MBR_ID", ccsText, "");
        
        $this->NAME = new clsField("NAME", ccsText, "");
        
        $this->SPOUSE = new clsField("SPOUSE", ccsText, "");
        
        $this->ID_VALUE_1 = new clsField("ID_VALUE_1", ccsText, "");
        
        $this->final_result = new clsField("final_result", ccsText, "");
        
        $this->suggested_amount = new clsField("suggested_amount", ccsText, "");
        
        $this->rejection_reason = new clsField("rejection_reason", ccsText, "");
        
        $this->primary_match = new clsField("primary_match", ccsText, "");
        
        $this->tlo = new clsField("tlo", ccsText, "");
        
        $this->tla = new clsField("tla", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @16-2FF68EF5
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "cb_updated_at desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_MBR_ID" => array("MBR-ID", ""), 
            "Sorter_NAME" => array("NAME", ""), 
            "Sorter_SPOUSE" => array("SPOUSE", ""), 
            "Sorter_ID_VALUE_1" => array("ID-VALUE-1", ""), 
            "Sorter_final_result" => array("final_result", ""), 
            "Sorter_suggested_amount" => array("suggested_amount", ""), 
            "Sorter_rejection_reason" => array("rejection_reason", "")));
    }
//End SetOrder Method

//Prepare Method @16-340D072A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlheader_id", ccsText, "", "", $this->Parameters["urlheader_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "header_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @16-1C3C9EEE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM overlap_reports";
        $this->SQL = "SELECT *,  total_LA_own+total_LA_other AS tla, total_LO_own+total_LO_other AS tlo\n\n" .
        "FROM overlap_reports {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @16-31DD2752
    function SetValues()
    {
        $this->MBR_ID->SetDBValue($this->f("MBR-ID"));
        $this->NAME->SetDBValue($this->f("NAME"));
        $this->SPOUSE->SetDBValue($this->f("SPOUSE"));
        $this->ID_VALUE_1->SetDBValue($this->f("ID-VALUE-1"));
        $this->final_result->SetDBValue($this->f("final_result"));
        $this->suggested_amount->SetDBValue($this->f("suggested_amount"));
        $this->rejection_reason->SetDBValue($this->f("rejection_reason"));
        $this->primary_match->SetDBValue($this->f("primary_match"));
        $this->tlo->SetDBValue($this->f("tlo"));
        $this->tla->SetDBValue($this->f("tla"));
    }
//End SetValues Method

} //End overlap_reportsDataSource Class @16-FCB6E20C





class clsRecordSearchCBAnalysys { //SearchCBAnalysys Class @218-48B44820

//Variables @218-9E315808

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

//Class_Initialize Event @218-6F975228
    function clsRecordSearchCBAnalysys($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SearchCBAnalysys/Error";
        $this->DataSource = new clsSearchCBAnalysysDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SearchCBAnalysys";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->header_id = new clsControl(ccsListBox, "header_id", "header_id", ccsText, "", CCGetRequestParam("header_id", $Method, NULL), $this);
            $this->header_id->DSType = dsTable;
            $this->header_id->DataSource = new clsDBmysql_cams_v2();
            $this->header_id->ds = & $this->header_id->DataSource;
            $this->header_id->DataSource->SQL = "SELECT * \n" .
"FROM overlap_reports {SQL_Where}\n" .
"GROUP BY header_id {SQL_OrderBy}";
            list($this->header_id->BoundColumn, $this->header_id->TextColumn, $this->header_id->DBFormat) = array("header_id", "header_id", "");
            $this->header_id->DataSource->wp = new clsSQLParameters();
            $this->header_id->DataSource->wp->Criterion[1] = "( analysys_status='COMPLETED' )";
            $this->header_id->DataSource->Where = 
                 $this->header_id->DataSource->wp->Criterion[1];
            $this->ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->Button1 = new clsButton("Button1", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @218-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @218-75092B18
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->header_id->Validate() && $Validation);
        $Validation = ($this->ListBox2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->header_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @218-1CF64B6E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->header_id->Errors->Count());
        $errors = ($errors || $this->ListBox2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @218-F24D9AF2
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
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            } else if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = $FileName;
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "CBResponseAnalysys.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "Button1", "Button1_x", "Button1_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
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

//Show Method @218-C7A9657F
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

        $this->header_id->Prepare();
        $this->ListBox2->Prepare();

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
                    $this->header_id->SetValue($this->DataSource->header_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->header_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox2->Errors->ToString());
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

        $this->header_id->Show();
        $this->ListBox2->Show();
        $this->Button_DoSearch->Show();
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End SearchCBAnalysys Class @218-FCB6E20C

class clsSearchCBAnalysysDataSource extends clsDBmysql_cams_v2 {  //SearchCBAnalysysDataSource Class @218-1EDBE99F

//DataSource Variables @218-F1126677
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $header_id;
    public $ListBox2;
//End DataSource Variables

//DataSourceClass_Initialize Event @218-4F323FDA
    function clsSearchCBAnalysysDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record SearchCBAnalysys/Error";
        $this->Initialize();
        $this->header_id = new clsField("header_id", ccsText, "");
        
        $this->ListBox2 = new clsField("ListBox2", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @218-D556B04B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = "( analysys_status='COMPLETED' )";
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @218-008E80BD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM overlap_reports {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @218-6986474D
    function SetValues()
    {
        $this->header_id->SetDBValue($this->f("header_id"));
    }
//End SetValues Method

} //End SearchCBAnalysysDataSource Class @218-FCB6E20C



//Initialize Page @1-AC1B15ED
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
$TemplateFileName = "CBResponseAnalysys.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-AFA0C48C
include_once("./CBResponseAnalysys_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0C4E20AA
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
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$overlap_reports = new clsGridoverlap_reports("", $MainPage);
$SearchCBAnalysys = new clsRecordSearchCBAnalysys("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$MainPage->incMenu = & $incMenu;
$MainPage->overlap_reports = & $overlap_reports;
$MainPage->SearchCBAnalysys = & $SearchCBAnalysys;
$overlap_reports->Initialize();
$SearchCBAnalysys->Initialize();

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

//Execute Components @1-1AEBECCA
$SearchCBAnalysys->Operation();
$incMenu->Operations();
$incFooter->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-191F39BA
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
    unset($overlap_reports);
    unset($SearchCBAnalysys);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CA8059BF
$incHeader->Show();
$incFooter->Show();
$incMenu->Show();
$overlap_reports->Show();
$SearchCBAnalysys->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1DF39449
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
unset($overlap_reports);
unset($SearchCBAnalysys);
unset($Tpl);
//End Unload Page


?>
