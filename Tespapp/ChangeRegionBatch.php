<?php
//Include Common Files @1-F38089D0
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ChangeRegionBatch.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordNewRecord1 { //NewRecord1 Class @7-D7EDAFB1

//Variables @7-9E315808

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

//Class_Initialize Event @7-3D0A7FEC
    function clsRecordNewRecord1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->DataSource = new clsNewRecord1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "NewRecord1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", $Method, NULL), $this);
            $this->ListBox2->DSType = dsTable;
            $this->ListBox2->DataSource = new clsDBmysql_cams_v2();
            $this->ListBox2->ds = & $this->ListBox2->DataSource;
            $this->ListBox2->DataSource->SQL = "SELECT * \n" .
"FROM mfi_unit_regions {SQL_Where} {SQL_OrderBy}";
            $this->ListBox2->DataSource->Order = "mfi_unit_name";
            list($this->ListBox2->BoundColumn, $this->ListBox2->TextColumn, $this->ListBox2->DBFormat) = array("mfi_unit_code", "mfi_unit_name", "");
            $this->ListBox2->DataSource->Order = "mfi_unit_name";
            $this->ListBox2->Required = true;
            $this->Hidden1 = new clsControl(ccsHidden, "Hidden1", "Hidden1", ccsText, "", CCGetRequestParam("Hidden1", $Method, NULL), $this);
            $this->Hidden1->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @7-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @7-10A61165
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->ListBox2->Validate() && $Validation);
        $Validation = ($this->Hidden1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @7-9FAA1512
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->ListBox2->Errors->Count());
        $errors = ($errors || $this->Hidden1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @7-07DEF910
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update)) {
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

//InsertRow Method @7-FA28EC37
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ListBox1->SetValue($this->ListBox1->GetValue(true));
        $this->DataSource->ListBox2->SetValue($this->ListBox2->GetValue(true));
        $this->DataSource->Hidden1->SetValue($this->Hidden1->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @7-17477E46
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

        $this->ListBox1->Prepare();
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
                    $this->ListBox1->SetValue($this->DataSource->ListBox1->GetValue());
                    $this->ListBox2->SetValue($this->DataSource->ListBox2->GetValue());
                    $this->Hidden1->SetValue($this->DataSource->Hidden1->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden1->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->ListBox1->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->ListBox2->Show();
        $this->Hidden1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End NewRecord1 Class @7-FCB6E20C

class clsNewRecord1DataSource extends clsDBmysql_cams_v2 {  //NewRecord1DataSource Class @7-9538A357

//DataSource Variables @7-33B8D78B
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
    public $ListBox1;
    public $ListBox2;
    public $Hidden1;
//End DataSource Variables

//DataSourceClass_Initialize Event @7-1D17EE12
    function clsNewRecord1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->Initialize();
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        
        $this->ListBox2 = new clsField("ListBox2", ccsText, "");
        
        $this->Hidden1 = new clsField("Hidden1", ccsText, "");
        

        $this->InsertFields["batch_code"] = array("Name" => "batch_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_doc_region"] = array("Name" => "mfi_doc_region", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ca_alloted"] = array("Name" => "ca_alloted", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @7-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @7-E63B7A70
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT batch_code, mfi_doc_region, ca_alloted \n\n" .
        "FROM batch_details {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @7-9E04910E
    function SetValues()
    {
        $this->ListBox1->SetDBValue($this->f("batch_code"));
        $this->ListBox2->SetDBValue($this->f("mfi_doc_region"));
        $this->Hidden1->SetDBValue($this->f("ca_alloted"));
    }
//End SetValues Method

//Insert Method @7-474FC246
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["batch_code"]["Value"] = $this->ListBox1->GetDBValue(true);
        $this->InsertFields["mfi_doc_region"]["Value"] = $this->ListBox2->GetDBValue(true);
        $this->InsertFields["ca_alloted"]["Value"] = $this->Hidden1->GetDBValue(true);
        $this->SQL = CCBuildInsert("batch_details", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End NewRecord1DataSource Class @7-FCB6E20C

//Initialize Page @1-A020CEB4
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
$TemplateFileName = "ChangeRegionBatch.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-FAE09364
include_once("./ChangeRegionBatch_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-047B7559
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$NewRecord1 = new clsRecordNewRecord1("", $MainPage);
$MainPage->NewRecord1 = & $NewRecord1;
$NewRecord1->Initialize();

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

//Execute Components @1-A09052E6
$NewRecord1->Operation();
//End Execute Components

//Go to destination page @1-87A5BC84
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($NewRecord1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-686669AC
$NewRecord1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5D6E7A39
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($NewRecord1);
unset($Tpl);
//End Unload Page


?>
