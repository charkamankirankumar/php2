<?php
//Include Common Files @1-B737AF47
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "process_uploaded_img.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmfi_docs { //mfi_docs Class @2-9966F844

//Variables @2-9E315808

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

//Class_Initialize Event @2-F0C984E1
    function clsRecordmfi_docs($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_docs/Error";
        $this->DataSource = new clsmfi_docsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_docs";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->mfi_doc_filename = new clsControl(ccsHidden, "mfi_doc_filename", "Filename", ccsText, "", CCGetRequestParam("mfi_doc_filename", $Method, NULL), $this);
            $this->mfi_doc_filename->Required = true;
            $this->numbered_by = new clsControl(ccsTextArea, "numbered_by", "Numbered By", ccsText, "", CCGetRequestParam("numbered_by", $Method, NULL), $this);
            $this->numbered_by->Required = true;
            $this->numbering_errors = new clsControl(ccsTextBox, "numbering_errors", "Numbering Errors", ccsText, "", CCGetRequestParam("numbering_errors", $Method, NULL), $this);
            $this->mfi_doc_region = new clsControl(ccsHidden, "mfi_doc_region", "Region", ccsText, "", CCGetRequestParam("mfi_doc_region", $Method, NULL), $this);
            $this->mfi_doc_region->Required = true;
            $this->pre_numbered_by = new clsControl(ccsListBox, "pre_numbered_by", "Pre Numbered By", ccsText, "", CCGetRequestParam("pre_numbered_by", $Method, NULL), $this);
            $this->pre_numbered_by->DSType = dsListOfValues;
            $this->pre_numbered_by->Values = array(array("PROCESS", "PROCESS"), array("RAP", "RAP"));
        }
    }
//End Class_Initialize Event

//Initialize Method @2-60C8AF49
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlgp_code"] = CCGetFromGet("gp_code", NULL);
    }
//End Initialize Method

//Validate Method @2-C9B70698
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->mfi_doc_filename->Validate() && $Validation);
        $Validation = ($this->numbered_by->Validate() && $Validation);
        $Validation = ($this->numbering_errors->Validate() && $Validation);
        $Validation = ($this->mfi_doc_region->Validate() && $Validation);
        $Validation = ($this->pre_numbered_by->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_doc_filename->Errors->Count() == 0);
        $Validation =  $Validation && ($this->numbered_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->numbering_errors->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pre_numbered_by->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-610582DC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_filename->Errors->Count());
        $errors = ($errors || $this->numbered_by->Errors->Count());
        $errors = ($errors || $this->numbering_errors->Errors->Count());
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->pre_numbered_by->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-517B5C36
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//UpdateRow Method @2-FE217568
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->mfi_doc_filename->SetValue($this->mfi_doc_filename->GetValue(true));
        $this->DataSource->numbered_by->SetValue($this->numbered_by->GetValue(true));
        $this->DataSource->numbering_errors->SetValue($this->numbering_errors->GetValue(true));
        $this->DataSource->mfi_doc_region->SetValue($this->mfi_doc_region->GetValue(true));
        $this->DataSource->pre_numbered_by->SetValue($this->pre_numbered_by->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-589F180B
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

        $this->pre_numbered_by->Prepare();

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
                    $this->mfi_doc_filename->SetValue($this->DataSource->mfi_doc_filename->GetValue());
                    $this->numbered_by->SetValue($this->DataSource->numbered_by->GetValue());
                    $this->numbering_errors->SetValue($this->DataSource->numbering_errors->GetValue());
                    $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
                    $this->pre_numbered_by->SetValue($this->DataSource->pre_numbered_by->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_doc_filename->Errors->ToString());
            $Error = ComposeStrings($Error, $this->numbered_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->numbering_errors->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pre_numbered_by->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->mfi_doc_filename->Show();
        $this->numbered_by->Show();
        $this->numbering_errors->Show();
        $this->mfi_doc_region->Show();
        $this->pre_numbered_by->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_docs Class @2-FCB6E20C

class clsmfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_docsDataSource Class @2-BC5AABD7

//DataSource Variables @2-3BB3E47F
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $mfi_doc_filename;
    public $numbered_by;
    public $numbering_errors;
    public $mfi_doc_region;
    public $pre_numbered_by;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-84C80D37
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_docs/Error";
        $this->Initialize();
        $this->mfi_doc_filename = new clsField("mfi_doc_filename", ccsText, "");
        
        $this->numbered_by = new clsField("numbered_by", ccsText, "");
        
        $this->numbering_errors = new clsField("numbering_errors", ccsText, "");
        
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->pre_numbered_by = new clsField("pre_numbered_by", ccsText, "");
        

        $this->UpdateFields["mfi_doc_filename"] = array("Name" => "mfi_doc_filename", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["rap_reason"] = array("Name" => "rap_reason", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["numbering_errors"] = array("Name" => "numbering_errors", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_region"] = array("Name" => "mfi_doc_region", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["status"] = array("Name" => "status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-38A97B32
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgp_code", ccsText, "", "", $this->Parameters["urlgp_code"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "gp_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-C27D5C5E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C69184E3
    function SetValues()
    {
        $this->mfi_doc_filename->SetDBValue($this->f("mfi_doc_filename"));
        $this->numbered_by->SetDBValue($this->f("rap_reason"));
        $this->numbering_errors->SetDBValue($this->f("numbering_errors"));
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->pre_numbered_by->SetDBValue($this->f("status"));
    }
//End SetValues Method

//Update Method @2-B6574D3D
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["mfi_doc_filename"]["Value"] = $this->mfi_doc_filename->GetDBValue(true);
        $this->UpdateFields["rap_reason"]["Value"] = $this->numbered_by->GetDBValue(true);
        $this->UpdateFields["numbering_errors"]["Value"] = $this->numbering_errors->GetDBValue(true);
        $this->UpdateFields["mfi_doc_region"]["Value"] = $this->mfi_doc_region->GetDBValue(true);
        $this->UpdateFields["status"]["Value"] = $this->pre_numbered_by->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_doc_upload", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End mfi_docsDataSource Class @2-FCB6E20C

//Include Page implementation @14-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @15-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

//Initialize Page @1-8AFDF286
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
$TemplateFileName = "process_uploaded_img.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-60974087
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_docs = new clsRecordmfi_docs("", $MainPage);
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$MainPage->mfi_docs = & $mfi_docs;
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$mfi_docs->Initialize();

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

//Execute Components @1-E14DCAFE
$incFooter->Operations();
$incHeader->Operations();
$mfi_docs->Operation();
//End Execute Components

//Go to destination page @1-C8E9C3C3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_docs);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incFooter->Class_Terminate();
    unset($incFooter);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C43F1C21
$mfi_docs->Show();
$incHeader->Show();
$incFooter->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1D9756B1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_docs);
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
unset($Tpl);
//End Unload Page


?>
