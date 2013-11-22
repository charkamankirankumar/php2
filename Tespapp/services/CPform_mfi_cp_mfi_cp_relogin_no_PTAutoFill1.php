<?php
//Include Common Files @1-EF84D361
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "CPform_mfi_cp_mfi_cp_relogin_no_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridmfi_cp1 { //mfi_cp1 class @2-BB617EA1

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

//Class_Initialize Event @2-C5C54720
    function clsGridmfi_cp1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_cp1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid mfi_cp1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmfi_cp1DataSource($this);
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

        $this->cp_id = new clsControl(ccsLabel, "cp_id", "cp_id", ccsText, "", CCGetRequestParam("cp_id", ccsGet, NULL), $this);
        $this->cp_route = new clsControl(ccsLabel, "cp_route", "cp_route", ccsText, "", CCGetRequestParam("cp_route", ccsGet, NULL), $this);
        $this->mfi_cp_rural_urban = new clsControl(ccsLabel, "mfi_cp_rural_urban", "mfi_cp_rural_urban", ccsInteger, "", CCGetRequestParam("mfi_cp_rural_urban", ccsGet, NULL), $this);
        $this->mfi_cp_census_village = new clsControl(ccsLabel, "mfi_cp_census_village", "mfi_cp_census_village", ccsText, "", CCGetRequestParam("mfi_cp_census_village", ccsGet, NULL), $this);
        $this->mfi_cp_cansus_village_code = new clsControl(ccsLabel, "mfi_cp_cansus_village_code", "mfi_cp_cansus_village_code", ccsText, "", CCGetRequestParam("mfi_cp_cansus_village_code", ccsGet, NULL), $this);
        $this->mfi_cp_address1 = new clsControl(ccsLabel, "mfi_cp_address1", "mfi_cp_address1", ccsText, "", CCGetRequestParam("mfi_cp_address1", ccsGet, NULL), $this);
        $this->mfi_cp_village_or_locality = new clsControl(ccsLabel, "mfi_cp_village_or_locality", "mfi_cp_village_or_locality", ccsText, "", CCGetRequestParam("mfi_cp_village_or_locality", ccsGet, NULL), $this);
        $this->mfi_cp_pincode = new clsControl(ccsLabel, "mfi_cp_pincode", "mfi_cp_pincode", ccsInteger, "", CCGetRequestParam("mfi_cp_pincode", ccsGet, NULL), $this);
        $this->mfi_cp_taluk_or_town = new clsControl(ccsLabel, "mfi_cp_taluk_or_town", "mfi_cp_taluk_or_town", ccsText, "", CCGetRequestParam("mfi_cp_taluk_or_town", ccsGet, NULL), $this);
        $this->mfi_cp_district = new clsControl(ccsLabel, "mfi_cp_district", "mfi_cp_district", ccsText, "", CCGetRequestParam("mfi_cp_district", ccsGet, NULL), $this);
        $this->mfi_cp_centre_name = new clsControl(ccsLabel, "mfi_cp_centre_name", "mfi_cp_centre_name", ccsText, "", CCGetRequestParam("mfi_cp_centre_name", ccsGet, NULL), $this);
        $this->mfi_cp_location_type = new clsControl(ccsLabel, "mfi_cp_location_type", "mfi_cp_location_type", ccsInteger, "", CCGetRequestParam("mfi_cp_location_type", ccsGet, NULL), $this);
        $this->mfi_cp_distance_from_region_or_branch = new clsControl(ccsLabel, "mfi_cp_distance_from_region_or_branch", "mfi_cp_distance_from_region_or_branch", ccsInteger, "", CCGetRequestParam("mfi_cp_distance_from_region_or_branch", ccsGet, NULL), $this);
        $this->mfi_cp_meeting_frequency = new clsControl(ccsLabel, "mfi_cp_meeting_frequency", "mfi_cp_meeting_frequency", ccsInteger, "", CCGetRequestParam("mfi_cp_meeting_frequency", ccsGet, NULL), $this);
        $this->mfi_cp_1st_meeting_week_and_day_of_the_month = new clsControl(ccsLabel, "mfi_cp_1st_meeting_week_and_day_of_the_month", "mfi_cp_1st_meeting_week_and_day_of_the_month", ccsText, "", CCGetRequestParam("mfi_cp_1st_meeting_week_and_day_of_the_month", ccsGet, NULL), $this);
        $this->mfi_cp_latitude1 = new clsControl(ccsLabel, "mfi_cp_latitude1", "mfi_cp_latitude1", ccsText, "", CCGetRequestParam("mfi_cp_latitude1", ccsGet, NULL), $this);
        $this->mfi_cp_latitude2 = new clsControl(ccsLabel, "mfi_cp_latitude2", "mfi_cp_latitude2", ccsText, "", CCGetRequestParam("mfi_cp_latitude2", ccsGet, NULL), $this);
        $this->mfi_cp_longitude1 = new clsControl(ccsLabel, "mfi_cp_longitude1", "mfi_cp_longitude1", ccsText, "", CCGetRequestParam("mfi_cp_longitude1", ccsGet, NULL), $this);
        $this->mfi_cp_longitude2 = new clsControl(ccsLabel, "mfi_cp_longitude2", "mfi_cp_longitude2", ccsText, "", CCGetRequestParam("mfi_cp_longitude2", ccsGet, NULL), $this);
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

//Show Method @2-0378D787
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
            $this->ControlsVisible["cp_id"] = $this->cp_id->Visible;
            $this->ControlsVisible["cp_route"] = $this->cp_route->Visible;
            $this->ControlsVisible["mfi_cp_rural_urban"] = $this->mfi_cp_rural_urban->Visible;
            $this->ControlsVisible["mfi_cp_census_village"] = $this->mfi_cp_census_village->Visible;
            $this->ControlsVisible["mfi_cp_cansus_village_code"] = $this->mfi_cp_cansus_village_code->Visible;
            $this->ControlsVisible["mfi_cp_address1"] = $this->mfi_cp_address1->Visible;
            $this->ControlsVisible["mfi_cp_village_or_locality"] = $this->mfi_cp_village_or_locality->Visible;
            $this->ControlsVisible["mfi_cp_pincode"] = $this->mfi_cp_pincode->Visible;
            $this->ControlsVisible["mfi_cp_taluk_or_town"] = $this->mfi_cp_taluk_or_town->Visible;
            $this->ControlsVisible["mfi_cp_district"] = $this->mfi_cp_district->Visible;
            $this->ControlsVisible["mfi_cp_centre_name"] = $this->mfi_cp_centre_name->Visible;
            $this->ControlsVisible["mfi_cp_location_type"] = $this->mfi_cp_location_type->Visible;
            $this->ControlsVisible["mfi_cp_distance_from_region_or_branch"] = $this->mfi_cp_distance_from_region_or_branch->Visible;
            $this->ControlsVisible["mfi_cp_meeting_frequency"] = $this->mfi_cp_meeting_frequency->Visible;
            $this->ControlsVisible["mfi_cp_1st_meeting_week_and_day_of_the_month"] = $this->mfi_cp_1st_meeting_week_and_day_of_the_month->Visible;
            $this->ControlsVisible["mfi_cp_latitude1"] = $this->mfi_cp_latitude1->Visible;
            $this->ControlsVisible["mfi_cp_latitude2"] = $this->mfi_cp_latitude2->Visible;
            $this->ControlsVisible["mfi_cp_longitude1"] = $this->mfi_cp_longitude1->Visible;
            $this->ControlsVisible["mfi_cp_longitude2"] = $this->mfi_cp_longitude2->Visible;
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
                $this->cp_id->SetValue($this->DataSource->cp_id->GetValue());
                $this->cp_route->SetValue($this->DataSource->cp_route->GetValue());
                $this->mfi_cp_rural_urban->SetValue($this->DataSource->mfi_cp_rural_urban->GetValue());
                $this->mfi_cp_census_village->SetValue($this->DataSource->mfi_cp_census_village->GetValue());
                $this->mfi_cp_cansus_village_code->SetValue($this->DataSource->mfi_cp_cansus_village_code->GetValue());
                $this->mfi_cp_address1->SetValue($this->DataSource->mfi_cp_address1->GetValue());
                $this->mfi_cp_village_or_locality->SetValue($this->DataSource->mfi_cp_village_or_locality->GetValue());
                $this->mfi_cp_pincode->SetValue($this->DataSource->mfi_cp_pincode->GetValue());
                $this->mfi_cp_taluk_or_town->SetValue($this->DataSource->mfi_cp_taluk_or_town->GetValue());
                $this->mfi_cp_district->SetValue($this->DataSource->mfi_cp_district->GetValue());
                $this->mfi_cp_centre_name->SetValue($this->DataSource->mfi_cp_centre_name->GetValue());
                $this->mfi_cp_location_type->SetValue($this->DataSource->mfi_cp_location_type->GetValue());
                $this->mfi_cp_distance_from_region_or_branch->SetValue($this->DataSource->mfi_cp_distance_from_region_or_branch->GetValue());
                $this->mfi_cp_meeting_frequency->SetValue($this->DataSource->mfi_cp_meeting_frequency->GetValue());
                $this->mfi_cp_1st_meeting_week_and_day_of_the_month->SetValue($this->DataSource->mfi_cp_1st_meeting_week_and_day_of_the_month->GetValue());
                $this->mfi_cp_latitude1->SetValue($this->DataSource->mfi_cp_latitude1->GetValue());
                $this->mfi_cp_latitude2->SetValue($this->DataSource->mfi_cp_latitude2->GetValue());
                $this->mfi_cp_longitude1->SetValue($this->DataSource->mfi_cp_longitude1->GetValue());
                $this->mfi_cp_longitude2->SetValue($this->DataSource->mfi_cp_longitude2->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->cp_id->Show();
                $this->cp_route->Show();
                $this->mfi_cp_rural_urban->Show();
                $this->mfi_cp_census_village->Show();
                $this->mfi_cp_cansus_village_code->Show();
                $this->mfi_cp_address1->Show();
                $this->mfi_cp_village_or_locality->Show();
                $this->mfi_cp_pincode->Show();
                $this->mfi_cp_taluk_or_town->Show();
                $this->mfi_cp_district->Show();
                $this->mfi_cp_centre_name->Show();
                $this->mfi_cp_location_type->Show();
                $this->mfi_cp_distance_from_region_or_branch->Show();
                $this->mfi_cp_meeting_frequency->Show();
                $this->mfi_cp_1st_meeting_week_and_day_of_the_month->Show();
                $this->mfi_cp_latitude1->Show();
                $this->mfi_cp_latitude2->Show();
                $this->mfi_cp_longitude1->Show();
                $this->mfi_cp_longitude2->Show();
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

//GetErrors Method @2-3A4891F1
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->cp_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cp_route->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_rural_urban->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_census_village->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_cansus_village_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_address1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_village_or_locality->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_pincode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_taluk_or_town->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_district->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_centre_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_location_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_distance_from_region_or_branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_meeting_frequency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_1st_meeting_week_and_day_of_the_month->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_latitude1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_latitude2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_longitude1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_longitude2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_cp1 Class @2-FCB6E20C

class clsmfi_cp1DataSource extends clsDBmysql_cams_v2 {  //mfi_cp1DataSource Class @2-99C5CD41

//DataSource Variables @2-39B2FF76
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $cp_id;
    public $cp_route;
    public $mfi_cp_rural_urban;
    public $mfi_cp_census_village;
    public $mfi_cp_cansus_village_code;
    public $mfi_cp_address1;
    public $mfi_cp_village_or_locality;
    public $mfi_cp_pincode;
    public $mfi_cp_taluk_or_town;
    public $mfi_cp_district;
    public $mfi_cp_centre_name;
    public $mfi_cp_location_type;
    public $mfi_cp_distance_from_region_or_branch;
    public $mfi_cp_meeting_frequency;
    public $mfi_cp_1st_meeting_week_and_day_of_the_month;
    public $mfi_cp_latitude1;
    public $mfi_cp_latitude2;
    public $mfi_cp_longitude1;
    public $mfi_cp_longitude2;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6708F12F
    function clsmfi_cp1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_cp1";
        $this->Initialize();
        $this->cp_id = new clsField("cp_id", ccsText, "");
        
        $this->cp_route = new clsField("cp_route", ccsText, "");
        
        $this->mfi_cp_rural_urban = new clsField("mfi_cp_rural_urban", ccsInteger, "");
        
        $this->mfi_cp_census_village = new clsField("mfi_cp_census_village", ccsText, "");
        
        $this->mfi_cp_cansus_village_code = new clsField("mfi_cp_cansus_village_code", ccsText, "");
        
        $this->mfi_cp_address1 = new clsField("mfi_cp_address1", ccsText, "");
        
        $this->mfi_cp_village_or_locality = new clsField("mfi_cp_village_or_locality", ccsText, "");
        
        $this->mfi_cp_pincode = new clsField("mfi_cp_pincode", ccsInteger, "");
        
        $this->mfi_cp_taluk_or_town = new clsField("mfi_cp_taluk_or_town", ccsText, "");
        
        $this->mfi_cp_district = new clsField("mfi_cp_district", ccsText, "");
        
        $this->mfi_cp_centre_name = new clsField("mfi_cp_centre_name", ccsText, "");
        
        $this->mfi_cp_location_type = new clsField("mfi_cp_location_type", ccsInteger, "");
        
        $this->mfi_cp_distance_from_region_or_branch = new clsField("mfi_cp_distance_from_region_or_branch", ccsInteger, "");
        
        $this->mfi_cp_meeting_frequency = new clsField("mfi_cp_meeting_frequency", ccsInteger, "");
        
        $this->mfi_cp_1st_meeting_week_and_day_of_the_month = new clsField("mfi_cp_1st_meeting_week_and_day_of_the_month", ccsText, "");
        
        $this->mfi_cp_latitude1 = new clsField("mfi_cp_latitude1", ccsText, "");
        
        $this->mfi_cp_latitude2 = new clsField("mfi_cp_latitude2", ccsText, "");
        
        $this->mfi_cp_longitude1 = new clsField("mfi_cp_longitude1", ccsText, "");
        
        $this->mfi_cp_longitude2 = new clsField("mfi_cp_longitude2", ccsText, "");
        

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

//Prepare Method @2-847DA2FC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlkeyword", ccsText, "", "", $this->Parameters["urlkeyword"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "cp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),true);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-B3D284F9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_cp";
        $this->SQL = "SELECT cp_id, cp_route, mfi_cp_rural_urban, mfi_cp_census_village, mfi_cp_cansus_village_code, mfi_cp_address1, mfi_cp_village_or_locality,\n\n" .
        "mfi_cp_pincode, mfi_cp_taluk_or_town, mfi_cp_district, mfi_cp_centre_name, mfi_cp_location_type, mfi_cp_distance_from_region_or_branch,\n\n" .
        "mfi_cp_meeting_frequency, mfi_cp_1st_meeting_week_and_day_of_the_month, mfi_cp_latitude1, mfi_cp_latitude2, mfi_cp_longitude1,\n\n" .
        "mfi_cp_longitude2 \n\n" .
        "FROM mfi_cp {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-E22551B7
    function SetValues()
    {
        $this->cp_id->SetDBValue($this->f("cp_id"));
        $this->cp_route->SetDBValue($this->f("cp_route"));
        $this->mfi_cp_rural_urban->SetDBValue(trim($this->f("mfi_cp_rural_urban")));
        $this->mfi_cp_census_village->SetDBValue($this->f("mfi_cp_census_village"));
        $this->mfi_cp_cansus_village_code->SetDBValue($this->f("mfi_cp_cansus_village_code"));
        $this->mfi_cp_address1->SetDBValue($this->f("mfi_cp_address1"));
        $this->mfi_cp_village_or_locality->SetDBValue($this->f("mfi_cp_village_or_locality"));
        $this->mfi_cp_pincode->SetDBValue(trim($this->f("mfi_cp_pincode")));
        $this->mfi_cp_taluk_or_town->SetDBValue($this->f("mfi_cp_taluk_or_town"));
        $this->mfi_cp_district->SetDBValue($this->f("mfi_cp_district"));
        $this->mfi_cp_centre_name->SetDBValue($this->f("mfi_cp_centre_name"));
        $this->mfi_cp_location_type->SetDBValue(trim($this->f("mfi_cp_location_type")));
        $this->mfi_cp_distance_from_region_or_branch->SetDBValue(trim($this->f("mfi_cp_distance_from_region_or_branch")));
        $this->mfi_cp_meeting_frequency->SetDBValue(trim($this->f("mfi_cp_meeting_frequency")));
        $this->mfi_cp_1st_meeting_week_and_day_of_the_month->SetDBValue($this->f("mfi_cp_1st_meeting_week_and_day_of_the_month"));
        $this->mfi_cp_latitude1->SetDBValue($this->f("mfi_cp_latitude1"));
        $this->mfi_cp_latitude2->SetDBValue($this->f("mfi_cp_latitude2"));
        $this->mfi_cp_longitude1->SetDBValue($this->f("mfi_cp_longitude1"));
        $this->mfi_cp_longitude2->SetDBValue($this->f("mfi_cp_longitude2"));
    }
//End SetValues Method

} //End mfi_cp1DataSource Class @2-FCB6E20C

//Initialize Page @1-54A388DC
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
$TemplateFileName = "CPform_mfi_cp_mfi_cp_relogin_no_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-815319E7
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_cp1 = new clsGridmfi_cp1("", $MainPage);
$MainPage->mfi_cp1 = & $mfi_cp1;
$mfi_cp1->Initialize();

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

//Go to destination page @1-35C75552
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_cp1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EBDC30E1
$mfi_cp1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8AB60751
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_cp1);
unset($Tpl);
//End Unload Page


?>
