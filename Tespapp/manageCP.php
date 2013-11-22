<?php
//Include Common Files @1-7BD27187
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "manageCP.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



//Include Page implementation @45-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @47-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Include Page implementation @48-60E713C2
include_once(RelativePath . "/incFooter.php");
//End Include Page implementation

class clsGridmfi_cp1 { //mfi_cp1 class @51-BB617EA1

//Variables @51-8F30E6C3

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
    public $Sorter_mfi_cp_no;
    public $Sorter_mfi_cp_district;
    public $Sorter_mfi_cp_centre_name;
    public $Sorter_mfi_cp_proposal_date;
//End Variables

//Class_Initialize Event @51-2B6308D7
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
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("mfi_cp1Order", "");
        $this->SorterDirection = CCGetParam("mfi_cp1Dir", "");

        $this->mfi_cp_no = new clsControl(ccsLabel, "mfi_cp_no", "mfi_cp_no", ccsText, "", CCGetRequestParam("mfi_cp_no", ccsGet, NULL), $this);
        $this->mfi_cp_proposal_date = new clsControl(ccsLabel, "mfi_cp_proposal_date", "mfi_cp_proposal_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("mfi_cp_proposal_date", ccsGet, NULL), $this);
        $this->mfi_cp_district = new clsControl(ccsLabel, "mfi_cp_district", "mfi_cp_district", ccsText, "", CCGetRequestParam("mfi_cp_district", ccsGet, NULL), $this);
        $this->mfi_cp_centre_name = new clsControl(ccsLabel, "mfi_cp_centre_name", "mfi_cp_centre_name", ccsText, "", CCGetRequestParam("mfi_cp_centre_name", ccsGet, NULL), $this);
        $this->Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Page = "CPform.php";
        $this->mfi_cp_no1 = new clsControl(ccsLink, "mfi_cp_no1", "mfi_cp_no1", ccsText, "", CCGetRequestParam("mfi_cp_no1", ccsGet, NULL), $this);
        $this->mfi_cp_no1->Page = "DataUpdatePage.php";
        $this->Sorter_mfi_cp_no = new clsSorter($this->ComponentName, "Sorter_mfi_cp_no", $FileName, $this);
        $this->Sorter_mfi_cp_district = new clsSorter($this->ComponentName, "Sorter_mfi_cp_district", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Sorter_mfi_cp_centre_name = new clsSorter($this->ComponentName, "Sorter_mfi_cp_centre_name", $FileName, $this);
        $this->Sorter_mfi_cp_proposal_date = new clsSorter($this->ComponentName, "Sorter_mfi_cp_proposal_date", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @51-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @51-8D404B13
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_mfi_cp_no"] = CCGetFromGet("s_mfi_cp_no", NULL);
        $this->DataSource->Parameters["urls_mfi_cp_centre_name"] = CCGetFromGet("s_mfi_cp_centre_name", NULL);
        $this->DataSource->Parameters["urlcpno"] = CCGetFromGet("cpno", NULL);
        $this->DataSource->Parameters["urls_cpno"] = CCGetFromGet("s_cpno", NULL);

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
            $this->ControlsVisible["mfi_cp_no"] = $this->mfi_cp_no->Visible;
            $this->ControlsVisible["mfi_cp_proposal_date"] = $this->mfi_cp_proposal_date->Visible;
            $this->ControlsVisible["mfi_cp_district"] = $this->mfi_cp_district->Visible;
            $this->ControlsVisible["mfi_cp_centre_name"] = $this->mfi_cp_centre_name->Visible;
            $this->ControlsVisible["Link2"] = $this->Link2->Visible;
            $this->ControlsVisible["mfi_cp_no1"] = $this->mfi_cp_no1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mfi_cp_no->SetValue($this->DataSource->mfi_cp_no->GetValue());
                $this->mfi_cp_proposal_date->SetValue($this->DataSource->mfi_cp_proposal_date->GetValue());
                $this->mfi_cp_district->SetValue($this->DataSource->mfi_cp_district->GetValue());
                $this->mfi_cp_centre_name->SetValue($this->DataSource->mfi_cp_centre_name->GetValue());
                $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "doc_code", $this->DataSource->f("cp_id"));
                $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "display", view);
                $this->mfi_cp_no1->SetValue($this->DataSource->mfi_cp_no1->GetValue());
                $this->mfi_cp_no1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->mfi_cp_no1->Parameters = CCAddParam($this->mfi_cp_no1->Parameters, "doc_code", $this->DataSource->f("cp_id"));
                $this->mfi_cp_no1->Parameters = CCAddParam($this->mfi_cp_no1->Parameters, "display", update);
                $this->mfi_cp_no1->Parameters = CCAddParam($this->mfi_cp_no1->Parameters, "doc_type", cp);
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_cp_no->Show();
                $this->mfi_cp_proposal_date->Show();
                $this->mfi_cp_district->Show();
                $this->mfi_cp_centre_name->Show();
                $this->Link2->Show();
                $this->mfi_cp_no1->Show();
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
        $this->Sorter_mfi_cp_no->Show();
        $this->Sorter_mfi_cp_district->Show();
        $this->Navigator->Show();
        $this->Sorter_mfi_cp_centre_name->Show();
        $this->Sorter_mfi_cp_proposal_date->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @51-271E0577
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_cp_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_proposal_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_district->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_centre_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_cp_no1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End mfi_cp1 Class @51-FCB6E20C

class clsmfi_cp1DataSource extends clsDBmysql_cams_v2 {  //mfi_cp1DataSource Class @51-99C5CD41

//DataSource Variables @51-0A33639F
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_cp_no;
    public $mfi_cp_proposal_date;
    public $mfi_cp_district;
    public $mfi_cp_centre_name;
    public $mfi_cp_no1;
//End DataSource Variables

//DataSourceClass_Initialize Event @51-AAA090F8
    function clsmfi_cp1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid mfi_cp1";
        $this->Initialize();
        $this->mfi_cp_no = new clsField("mfi_cp_no", ccsText, "");
        
        $this->mfi_cp_proposal_date = new clsField("mfi_cp_proposal_date", ccsDate, $this->DateFormat);
        
        $this->mfi_cp_district = new clsField("mfi_cp_district", ccsText, "");
        
        $this->mfi_cp_centre_name = new clsField("mfi_cp_centre_name", ccsText, "");
        
        $this->mfi_cp_no1 = new clsField("mfi_cp_no1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @51-FEC5C84B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "mfi_cp_proposal_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mfi_cp_no" => array("mfi_cp_no", ""), 
            "Sorter_mfi_cp_district" => array("mfi_cp_district", ""), 
            "Sorter_mfi_cp_centre_name" => array("mfi_cp_centre_name", ""), 
            "Sorter_mfi_cp_proposal_date" => array("mfi_cp_proposal_date", "")));
    }
//End SetOrder Method

//Prepare Method @51-89F192DE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_mfi_cp_no", ccsText, "", "", $this->Parameters["urls_mfi_cp_no"], "", false);
        $this->wp->AddParameter("2", "urls_mfi_cp_centre_name", ccsText, "", "", $this->Parameters["urls_mfi_cp_centre_name"], "", false);
        $this->wp->AddParameter("3", "urlcpno", ccsInteger, "", "", $this->Parameters["urlcpno"], "", false);
        $this->wp->AddParameter("4", "urls_cpno", ccsInteger, "", "", $this->Parameters["urls_cpno"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "cp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "mfi_cp_centre_name", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "cp_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "cp_id", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opOR(
             false, $this->wp->opAND(
             true, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @51-A11C8661
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM mfi_cp";
        $this->SQL = "SELECT * \n\n" .
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

//SetValues Method @51-3B4BD6E4
    function SetValues()
    {
        $this->mfi_cp_no->SetDBValue($this->f("cp_id"));
        $this->mfi_cp_proposal_date->SetDBValue(trim($this->f("mfi_cp_proposal_date")));
        $this->mfi_cp_district->SetDBValue($this->f("mfi_cp_district"));
        $this->mfi_cp_centre_name->SetDBValue($this->f("mfi_cp_centre_name"));
        $this->mfi_cp_no1->SetDBValue($this->f("mfi_cp_no"));
    }
//End SetValues Method

} //End mfi_cp1DataSource Class @51-FCB6E20C



//Initialize Page @1-F9202C08
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
$TemplateFileName = "manageCP.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-53A0D57A
include_once("./manageCP_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2705FCA2
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$incFooter1 = new clsincFooter("", "incFooter1", $MainPage);
$incFooter1->Initialize();
$mfi_cp1 = new clsGridmfi_cp1("", $MainPage);
$Link1 = new clsControl(ccsImageLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Page = "CPform.php";
$MainPage->incHeader = & $incHeader;
$MainPage->incMenu = & $incMenu;
$MainPage->incFooter1 = & $incFooter1;
$MainPage->mfi_cp1 = & $mfi_cp1;
$MainPage->Link1 = & $Link1;
$mfi_cp1->Initialize();

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

//Execute Components @1-3C1B6B2B
$incFooter1->Operations();
$incMenu->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-927F3EBF
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incMenu->Class_Terminate();
    unset($incMenu);
    $incFooter1->Class_Terminate();
    unset($incFooter1);
    unset($mfi_cp1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2339CE66
$incHeader->Show();
$incMenu->Show();
$incFooter1->Show();
$mfi_cp1->Show();
$Link1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-90143438
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incMenu->Class_Terminate();
unset($incMenu);
$incFooter1->Class_Terminate();
unset($incFooter1);
unset($mfi_cp1);
unset($Tpl);
//End Unload Page


?>
