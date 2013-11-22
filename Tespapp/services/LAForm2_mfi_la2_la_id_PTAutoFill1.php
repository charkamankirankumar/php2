<?php
//Include Common Files @1-C5A7C5CE
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "LAForm2_mfi_la2_la_id_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridmfi_kyc { //mfi_kyc class @2-F9895217

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

//Class_Initialize Event @2-EC22E7F6
    function clsGridmfi_kyc($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_kyc";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_kyc";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_kycDataSource($this);
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

        $this->la_id = new clsControl(ccsLabel, "la_id", "la_id", ccsText, "", CCGetRequestParam("la_id", ccsGet, NULL), $this);
        $this->member_relation_type_1 = new clsControl(ccsLabel, "member_relation_type_1", "member_relation_type_1", ccsText, "", CCGetRequestParam("member_relation_type_1", ccsGet, NULL), $this);
        $this->relation_name_1 = new clsControl(ccsLabel, "relation_name_1", "relation_name_1", ccsText, "", CCGetRequestParam("relation_name_1", ccsGet, NULL), $this);
        $this->guarantor_kyc_type_primery_1 = new clsControl(ccsLabel, "guarantor_kyc_type_primery_1", "guarantor_kyc_type_primery_1", ccsText, "", CCGetRequestParam("guarantor_kyc_type_primery_1", ccsGet, NULL), $this);
        $this->guarantor_kyc_id_primery_1 = new clsControl(ccsLabel, "guarantor_kyc_id_primery_1", "guarantor_kyc_id_primery_1", ccsText, "", CCGetRequestParam("guarantor_kyc_id_primery_1", ccsGet, NULL), $this);
        $this->gurantor_current_age_1 = new clsControl(ccsLabel, "gurantor_current_age_1", "gurantor_current_age_1", ccsInteger, "", CCGetRequestParam("gurantor_current_age_1", ccsGet, NULL), $this);
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

//Show Method @2-28C7B9AB
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlkeyword"] = CCGetFromGet("keyword", NULL);

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
            $this->ControlsVisible["la_id"] = $this->la_id->Visible;
            $this->ControlsVisible["member_relation_type_1"] = $this->member_relation_type_1->Visible;
            $this->ControlsVisible["relation_name_1"] = $this->relation_name_1->Visible;
            $this->ControlsVisible["guarantor_kyc_type_primery_1"] = $this->guarantor_kyc_type_primery_1->Visible;
            $this->ControlsVisible["guarantor_kyc_id_primery_1"] = $this->guarantor_kyc_id_primery_1->Visible;
            $this->ControlsVisible["gurantor_current_age_1"] = $this->gurantor_current_age_1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->la_id->SetValue($this->DataSource->la_id->GetValue());
                $this->member_relation_type_1->SetValue($this->DataSource->member_relation_type_1->GetValue());
                $this->relation_name_1->SetValue($this->DataSource->relation_name_1->GetValue());
                $this->guarantor_kyc_type_primery_1->SetValue($this->DataSource->guarantor_kyc_type_primery_1->GetValue());
                $this->guarantor_kyc_id_primery_1->SetValue($this->DataSource->guarantor_kyc_id_primery_1->GetValue());
                $this->gurantor_current_age_1->SetValue($this->DataSource->gurantor_current_age_1->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->la_id->Show();
                $this->member_relation_type_1->Show();
                $this->relation_name_1->Show();
                $this->guarantor_kyc_type_primery_1->Show();
                $this->guarantor_kyc_id_primery_1->Show();
                $this->gurantor_current_age_1->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
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

//GetErrors Method @2-BB910CB6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->la_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->member_relation_type_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->relation_name_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->guarantor_kyc_type_primery_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->guarantor_kyc_id_primery_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gurantor_current_age_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_kyc Class @2-FCB6E20C

class clsmfi_kycDataSource extends clsDBmysql_cams_v2 {  //mfi_kycDataSource Class @2-51DA9DC9

//DataSource Variables @2-FB25FDAF
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $la_id;
    public $member_relation_type_1;
    public $relation_name_1;
    public $guarantor_kyc_type_primery_1;
    public $guarantor_kyc_id_primery_1;
    public $gurantor_current_age_1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-729E4BCF
    function clsmfi_kycDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_kyc";
        $this->Initialize();
        $this->la_id = new clsField("la_id", ccsText, "");
        
        $this->member_relation_type_1 = new clsField("member_relation_type_1", ccsText, "");
        
        $this->relation_name_1 = new clsField("relation_name_1", ccsText, "");
        
        $this->guarantor_kyc_type_primery_1 = new clsField("guarantor_kyc_type_primery_1", ccsText, "");
        
        $this->guarantor_kyc_id_primery_1 = new clsField("guarantor_kyc_id_primery_1", ccsText, "");
        
        $this->gurantor_current_age_1 = new clsField("gurantor_current_age_1", ccsInteger, "");
        

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

//Prepare Method @2-F08D34C2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsText, "", "", $this->Parameters["urlkeyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "la_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = "( isnull(test_result) )";
        $this->wp->Criterion[3] = "( kyc_id_primary_2 is not null )";
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-AA3BBC56
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_kyc";
        $this->SQL = "SELECT la_id, guarantor_kyc_type_primery_1, guarantor_kyc_id_primery_1, member_relation_type_1, relation_name_1, gurantor_current_age_1 \n\n" .
        "FROM mfi_kyc {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-61F99E74
    function SetValues()
    {
        $this->la_id->SetDBValue($this->f("la_id"));
        $this->member_relation_type_1->SetDBValue($this->f("member_relation_type_1"));
        $this->relation_name_1->SetDBValue($this->f("relation_name_1"));
        $this->guarantor_kyc_type_primery_1->SetDBValue($this->f("guarantor_kyc_type_primery_1"));
        $this->guarantor_kyc_id_primery_1->SetDBValue($this->f("guarantor_kyc_id_primery_1"));
        $this->gurantor_current_age_1->SetDBValue(trim($this->f("gurantor_current_age_1")));
    }
//End SetValues Method

} //End mfi_kycDataSource Class @2-FCB6E20C

//Initialize Page @1-F8F8B534
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
$TemplateFileName = "LAForm2_mfi_la2_la_id_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6148DE44
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_kyc = new clsGridmfi_kyc("", $MainPage);
$MainPage->mfi_kyc = & $mfi_kyc;
$mfi_kyc->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-28BF1EE2
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
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-C0D40AD4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_kyc);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-51631257
$mfi_kyc->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-97C213B2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_kyc);
unset($Tpl);
//End Unload Page


?>
