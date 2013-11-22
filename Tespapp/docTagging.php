<?php
//Include Common Files @1-58D51EF9
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "docTagging.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @3-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

class clsRecordmfi_docs { //mfi_docs Class @128-9966F844

//Variables @128-9E315808

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

//Class_Initialize Event @128-E308B46D
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
            $this->mfi_doc_territory_code = new clsControl(ccsHidden, "mfi_doc_territory_code", $CCSLocales->GetText("mfi_doc_territory_code"), ccsText, "", CCGetRequestParam("mfi_doc_territory_code", $Method, NULL), $this);
            $this->mfi_doc_status = new clsControl(ccsHidden, "mfi_doc_status", $CCSLocales->GetText("mfi_doc_status"), ccsText, "", CCGetRequestParam("mfi_doc_status", $Method, NULL), $this);
            $this->mfi_doc_status->Required = true;
            $this->mfi_doc_tagged_by = new clsControl(ccsHidden, "mfi_doc_tagged_by", $CCSLocales->GetText("mfi_doc_updatedby"), ccsText, "", CCGetRequestParam("mfi_doc_tagged_by", $Method, NULL), $this);
            $this->mfi_doc_tagged_by->Required = true;
            $this->mfi_doc_code = new clsControl(ccsHidden, "mfi_doc_code", $CCSLocales->GetText("mfi_doc_code"), ccsText, "", CCGetRequestParam("mfi_doc_code", $Method, NULL), $this);
            $this->mfi_doc_code->Required = true;
            $this->mfi_doc_id = new clsControl(ccsHidden, "mfi_doc_id", "mfi_doc_id", ccsText, "", CCGetRequestParam("mfi_doc_id", $Method, NULL), $this);
            $this->mfi_doc_id->Required = true;
            $this->mfi_doc_filename = new clsControl(ccsHidden, "mfi_doc_filename", $CCSLocales->GetText("mfi_doc_filename"), ccsText, "", CCGetRequestParam("mfi_doc_filename", $Method, NULL), $this);
            $this->mfi_doc_filename->Required = true;
            $this->mfi_doc_path = new clsControl(ccsHidden, "mfi_doc_path", $CCSLocales->GetText("mfi_doc_path"), ccsText, "", CCGetRequestParam("mfi_doc_path", $Method, NULL), $this);
            $this->mfi_doc_img = new clsControl(ccsImage, "mfi_doc_img", "mfi_doc_img", ccsText, "", CCGetRequestParam("mfi_doc_img", $Method, NULL), $this);
            $this->mfi_doc_type = new clsControl(ccsHidden, "mfi_doc_type", "mfi_doc_type", ccsText, "", CCGetRequestParam("mfi_doc_type", $Method, NULL), $this);
            $this->no_records = new clsControl(ccsLabel, "no_records", "no_records", ccsText, "", CCGetRequestParam("no_records", $Method, NULL), $this);
            $this->mfi_doc_tagged_at = new clsControl(ccsHidden, "mfi_doc_tagged_at", "mfi_doc_tagged_at", ccsText, "", CCGetRequestParam("mfi_doc_tagged_at", $Method, NULL), $this);
            $this->mfi_doc_region = new clsControl(ccsTextBox, "mfi_doc_region", "mfi_doc_region", ccsText, "", CCGetRequestParam("mfi_doc_region", $Method, NULL), $this);
            $this->Button1 = new clsButton("Button1", $Method, $this);
            $this->ListBox3 = new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", $Method, NULL), $this);
            $this->ListBox3->DSType = dsListOfValues;
            $this->ListBox3->Values = array(array("CP", "Centre Proposal"), array("LA1", "LA FORM1"), array("LA2", "LA FORM 2"), array("INVALID IMAGE", "INVALID IMAGE"), array("KYC", "KYC"));
            $this->batch_code = new clsControl(ccsLabel, "batch_code", "batch_code", ccsText, "", CCGetRequestParam("batch_code", $Method, NULL), $this);
            $this->batch_no = new clsControl(ccsTextBox, "batch_no", "batch_no", ccsText, "", CCGetRequestParam("batch_no", $Method, NULL), $this);
            $this->tot_images = new clsControl(ccsLabel, "tot_images", "tot_images", ccsText, "", CCGetRequestParam("tot_images", $Method, NULL), $this);
            $this->ncp = new clsControl(ccsLabel, "ncp", "ncp", ccsText, "", CCGetRequestParam("ncp", $Method, NULL), $this);
            $this->ngp = new clsControl(ccsLabel, "ngp", "ngp", ccsText, "", CCGetRequestParam("ngp", $Method, NULL), $this);
            $this->ngle = new clsControl(ccsLabel, "ngle", "ngle", ccsText, "", CCGetRequestParam("ngle", $Method, NULL), $this);
            $this->nla1 = new clsControl(ccsLabel, "nla1", "nla1", ccsText, "", CCGetRequestParam("nla1", $Method, NULL), $this);
            $this->nla2 = new clsControl(ccsLabel, "nla2", "nla2", ccsText, "", CCGetRequestParam("nla2", $Method, NULL), $this);
            $this->nhv1 = new clsControl(ccsLabel, "nhv1", "nhv1", ccsText, "", CCGetRequestParam("nhv1", $Method, NULL), $this);
            $this->nhv2 = new clsControl(ccsLabel, "nhv2", "nhv2", ccsText, "", CCGetRequestParam("nhv2", $Method, NULL), $this);
            $this->nii = new clsControl(ccsLabel, "nii", "nii", ccsText, "", CCGetRequestParam("nii", $Method, NULL), $this);
            $this->tot_img = new clsControl(ccsLabel, "tot_img", "tot_img", ccsText, "", CCGetRequestParam("tot_img", $Method, NULL), $this);
            $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", $Method, NULL), $this);
            $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsTable;
            $this->ListBox1->DataSource = new clsDBmysql_cams_v2();
            $this->ListBox1->ds = & $this->ListBox1->DataSource;
            $this->ListBox1->DataSource->SQL = "SELECT * \n" .
"FROM mfi_unit_regions {SQL_Where} {SQL_OrderBy}";
            list($this->ListBox1->BoundColumn, $this->ListBox1->TextColumn, $this->ListBox1->DBFormat) = array("mfi_unit_code", "mfi_unit_name", "");
            $this->Button2 = new clsButton("Button2", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->mfi_doc_status->Value) && !strlen($this->mfi_doc_status->Value) && $this->mfi_doc_status->Value !== false)
                    $this->mfi_doc_status->SetText("TAGGED");
            }
            if(!is_array($this->no_records->Value) && !strlen($this->no_records->Value) && $this->no_records->Value !== false)
                $this->no_records->SetText("");
        }
    }
//End Class_Initialize Event

//Initialize Method @128-E1F57694
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Order = "batch_code";

        $this->DataSource->Parameters["cookbatch_code"] = CCGetCookie("batch_code", NULL);
        $this->DataSource->Parameters["expr241"] = 'UNTAGGED';
    }
//End Initialize Method

//Validate Method @128-18B03098
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->mfi_doc_territory_code->Validate() && $Validation);
        $Validation = ($this->mfi_doc_status->Validate() && $Validation);
        $Validation = ($this->mfi_doc_tagged_by->Validate() && $Validation);
        $Validation = ($this->mfi_doc_code->Validate() && $Validation);
        $Validation = ($this->mfi_doc_id->Validate() && $Validation);
        $Validation = ($this->mfi_doc_filename->Validate() && $Validation);
        $Validation = ($this->mfi_doc_path->Validate() && $Validation);
        $Validation = ($this->mfi_doc_type->Validate() && $Validation);
        $Validation = ($this->mfi_doc_tagged_at->Validate() && $Validation);
        $Validation = ($this->mfi_doc_region->Validate() && $Validation);
        $Validation = ($this->ListBox3->Validate() && $Validation);
        $Validation = ($this->batch_no->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_doc_territory_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_tagged_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_filename->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_path->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_tagged_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_doc_region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->batch_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @128-B94ACB8B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_status->Errors->Count());
        $errors = ($errors || $this->mfi_doc_tagged_by->Errors->Count());
        $errors = ($errors || $this->mfi_doc_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_id->Errors->Count());
        $errors = ($errors || $this->mfi_doc_filename->Errors->Count());
        $errors = ($errors || $this->mfi_doc_path->Errors->Count());
        $errors = ($errors || $this->mfi_doc_img->Errors->Count());
        $errors = ($errors || $this->mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->no_records->Errors->Count());
        $errors = ($errors || $this->mfi_doc_tagged_at->Errors->Count());
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->ListBox3->Errors->Count());
        $errors = ($errors || $this->batch_code->Errors->Count());
        $errors = ($errors || $this->batch_no->Errors->Count());
        $errors = ($errors || $this->tot_images->Errors->Count());
        $errors = ($errors || $this->ncp->Errors->Count());
        $errors = ($errors || $this->ngp->Errors->Count());
        $errors = ($errors || $this->ngle->Errors->Count());
        $errors = ($errors || $this->nla1->Errors->Count());
        $errors = ($errors || $this->nla2->Errors->Count());
        $errors = ($errors || $this->nhv1->Errors->Count());
        $errors = ($errors || $this->nhv2->Errors->Count());
        $errors = ($errors || $this->nii->Errors->Count());
        $errors = ($errors || $this->tot_img->Errors->Count());
        $errors = ($errors || $this->Label1->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @128-2AB170CE
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button2";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            } else if($this->Button2->Pressed) {
                $this->PressedButton = "Button2";
            }
        }
        $Redirect = "docTagging.php";
        if($this->PressedButton == "Button_Update") {
            if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button2") {
                if(!CCGetEvent($this->Button2->CCSEvents, "OnClick", $this->Button2)) {
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

//UpdateRow Method @128-44A19B04
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->mfi_doc_id->SetValue($this->mfi_doc_id->GetValue(true));
        $this->DataSource->mfi_doc_territory_code->SetValue($this->mfi_doc_territory_code->GetValue(true));
        $this->DataSource->mfi_doc_tagged_by->SetValue($this->mfi_doc_tagged_by->GetValue(true));
        $this->DataSource->mfi_doc_code->SetValue($this->mfi_doc_code->GetValue(true));
        $this->DataSource->mfi_doc_type->SetValue($this->mfi_doc_type->GetValue(true));
        $this->DataSource->mfi_doc_filename->SetValue($this->mfi_doc_filename->GetValue(true));
        $this->DataSource->mfi_doc_path->SetValue($this->mfi_doc_path->GetValue(true));
        $this->DataSource->mfi_doc_tagged_at->SetValue($this->mfi_doc_tagged_at->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @128-8FD01F3D
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

        $this->ListBox3->Prepare();
        $this->ListBox1->Prepare();

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
                $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
                if(!$this->FormSubmitted){
                    $this->mfi_doc_territory_code->SetValue($this->DataSource->mfi_doc_territory_code->GetValue());
                    $this->mfi_doc_tagged_by->SetValue($this->DataSource->mfi_doc_tagged_by->GetValue());
                    $this->mfi_doc_code->SetValue($this->DataSource->mfi_doc_code->GetValue());
                    $this->mfi_doc_id->SetValue($this->DataSource->mfi_doc_id->GetValue());
                    $this->mfi_doc_filename->SetValue($this->DataSource->mfi_doc_filename->GetValue());
                    $this->mfi_doc_path->SetValue($this->DataSource->mfi_doc_path->GetValue());
                    $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
                    $this->mfi_doc_tagged_at->SetValue($this->DataSource->mfi_doc_tagged_at->GetValue());
                    $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
                    $this->batch_no->SetValue($this->DataSource->batch_no->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_doc_territory_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_tagged_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_filename->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_path->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_img->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->no_records->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_tagged_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_doc_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->batch_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->batch_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tot_images->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ncp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ngp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ngle->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nla1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nla2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nhv1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nhv2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nii->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tot_img->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
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
        $this->Button1->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->mfi_doc_territory_code->Show();
        $this->mfi_doc_status->Show();
        $this->mfi_doc_tagged_by->Show();
        $this->mfi_doc_code->Show();
        $this->mfi_doc_id->Show();
        $this->mfi_doc_filename->Show();
        $this->mfi_doc_path->Show();
        $this->mfi_doc_img->Show();
        $this->mfi_doc_type->Show();
        $this->no_records->Show();
        $this->mfi_doc_tagged_at->Show();
        $this->mfi_doc_region->Show();
        $this->Button1->Show();
        $this->ListBox3->Show();
        $this->batch_code->Show();
        $this->batch_no->Show();
        $this->tot_images->Show();
        $this->ncp->Show();
        $this->ngp->Show();
        $this->ngle->Show();
        $this->nla1->Show();
        $this->nla2->Show();
        $this->nhv1->Show();
        $this->nhv2->Show();
        $this->nii->Show();
        $this->tot_img->Show();
        $this->Label1->Show();
        $this->ListBox1->Show();
        $this->Button2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_docs Class @128-FCB6E20C

class clsmfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_docsDataSource Class @128-BC5AABD7

//DataSource Variables @128-7FAAAA20
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
    public $mfi_doc_territory_code;
    public $mfi_doc_status;
    public $mfi_doc_tagged_by;
    public $mfi_doc_code;
    public $mfi_doc_id;
    public $mfi_doc_filename;
    public $mfi_doc_path;
    public $mfi_doc_img;
    public $mfi_doc_type;
    public $no_records;
    public $mfi_doc_tagged_at;
    public $mfi_doc_region;
    public $ListBox3;
    public $batch_code;
    public $batch_no;
    public $tot_images;
    public $ncp;
    public $ngp;
    public $ngle;
    public $nla1;
    public $nla2;
    public $nhv1;
    public $nhv2;
    public $nii;
    public $tot_img;
    public $Label1;
    public $ListBox1;
//End DataSource Variables

//DataSourceClass_Initialize Event @128-64613CF6
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_docs/Error";
        $this->Initialize();
        $this->mfi_doc_territory_code = new clsField("mfi_doc_territory_code", ccsText, "");
        
        $this->mfi_doc_status = new clsField("mfi_doc_status", ccsText, "");
        
        $this->mfi_doc_tagged_by = new clsField("mfi_doc_tagged_by", ccsText, "");
        
        $this->mfi_doc_code = new clsField("mfi_doc_code", ccsText, "");
        
        $this->mfi_doc_id = new clsField("mfi_doc_id", ccsText, "");
        
        $this->mfi_doc_filename = new clsField("mfi_doc_filename", ccsText, "");
        
        $this->mfi_doc_path = new clsField("mfi_doc_path", ccsText, "");
        
        $this->mfi_doc_img = new clsField("mfi_doc_img", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsText, "");
        
        $this->no_records = new clsField("no_records", ccsText, "");
        
        $this->mfi_doc_tagged_at = new clsField("mfi_doc_tagged_at", ccsText, "");
        
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->ListBox3 = new clsField("ListBox3", ccsText, "");
        
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->batch_no = new clsField("batch_no", ccsText, "");
        
        $this->tot_images = new clsField("tot_images", ccsText, "");
        
        $this->ncp = new clsField("ncp", ccsText, "");
        
        $this->ngp = new clsField("ngp", ccsText, "");
        
        $this->ngle = new clsField("ngle", ccsText, "");
        
        $this->nla1 = new clsField("nla1", ccsText, "");
        
        $this->nla2 = new clsField("nla2", ccsText, "");
        
        $this->nhv1 = new clsField("nhv1", ccsText, "");
        
        $this->nhv2 = new clsField("nhv2", ccsText, "");
        
        $this->nii = new clsField("nii", ccsText, "");
        
        $this->tot_img = new clsField("tot_img", ccsText, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        

        $this->UpdateFields["mfi_doc_territory_code"] = array("Name" => "mfi_doc_territory_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_status"] = array("Name" => "mfi_doc_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_tagged_by"] = array("Name" => "mfi_doc_tagged_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_code"] = array("Name" => "mfi_doc_code", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_type"] = array("Name" => "mfi_doc_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_filename"] = array("Name" => "mfi_doc_filename", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_path"] = array("Name" => "mfi_doc_path", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["mfi_doc_tagged_at"] = array("Name" => "mfi_doc_tagged_at", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @128-1DF75ABD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "cookbatch_code", ccsText, "", "", $this->Parameters["cookbatch_code"], "", false);
        $this->wp->AddParameter("2", "expr241", ccsText, "", "", $this->Parameters["expr241"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "batch_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "mfi_doc_status", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @128-BA24A483
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT *, mfi_doc_id \n\n" .
        "FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @128-B2C0A49A
    function SetValues()
    {
        $this->mfi_doc_territory_code->SetDBValue($this->f("mfi_doc_territory_code"));
        $this->mfi_doc_tagged_by->SetDBValue($this->f("mfi_doc_tagged_by"));
        $this->mfi_doc_code->SetDBValue($this->f("mfi_doc_code"));
        $this->mfi_doc_id->SetDBValue($this->f("mfi_doc_id"));
        $this->mfi_doc_filename->SetDBValue($this->f("mfi_doc_filename"));
        $this->mfi_doc_path->SetDBValue($this->f("mfi_doc_path"));
        $this->mfi_doc_type->SetDBValue($this->f("mfi_doc_type"));
        $this->mfi_doc_tagged_at->SetDBValue($this->f("mfi_doc_tagged_at"));
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->batch_no->SetDBValue($this->f("batch_code"));
    }
//End SetValues Method

//Update Method @128-DC61E24B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["mfi_doc_territory_code"] = new clsSQLParameter("ctrlmfi_doc_territory_code", ccsText, "", "", $this->mfi_doc_territory_code->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_status"] = new clsSQLParameter("expr163", ccsText, "", "", "TAGGED", NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_tagged_by"] = new clsSQLParameter("ctrlmfi_doc_tagged_by", ccsText, "", "", $this->mfi_doc_tagged_by->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_code"] = new clsSQLParameter("ctrlmfi_doc_code", ccsText, "", "", $this->mfi_doc_code->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_type"] = new clsSQLParameter("ctrlmfi_doc_type", ccsText, "", "", $this->mfi_doc_type->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_filename"] = new clsSQLParameter("ctrlmfi_doc_filename", ccsText, "", "", $this->mfi_doc_filename->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_path"] = new clsSQLParameter("ctrlmfi_doc_path", ccsText, "", "", $this->mfi_doc_path->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mfi_doc_tagged_at"] = new clsSQLParameter("ctrlmfi_doc_tagged_at", ccsText, "", "", $this->mfi_doc_tagged_at->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "postmfi_doc_id", ccsInteger, "", "", CCGetFromPost("mfi_doc_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "ctrlmfi_doc_id", ccsInteger, "", "", $this->mfi_doc_id->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("3", "postmfi_doc_id", ccsInteger, "", "", CCGetFromPost("mfi_doc_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["mfi_doc_territory_code"]->GetValue()) and !strlen($this->cp["mfi_doc_territory_code"]->GetText()) and !is_bool($this->cp["mfi_doc_territory_code"]->GetValue())) 
            $this->cp["mfi_doc_territory_code"]->SetValue($this->mfi_doc_territory_code->GetValue(true));
        if (!is_null($this->cp["mfi_doc_status"]->GetValue()) and !strlen($this->cp["mfi_doc_status"]->GetText()) and !is_bool($this->cp["mfi_doc_status"]->GetValue())) 
            $this->cp["mfi_doc_status"]->SetValue("TAGGED");
        if (!is_null($this->cp["mfi_doc_tagged_by"]->GetValue()) and !strlen($this->cp["mfi_doc_tagged_by"]->GetText()) and !is_bool($this->cp["mfi_doc_tagged_by"]->GetValue())) 
            $this->cp["mfi_doc_tagged_by"]->SetValue($this->mfi_doc_tagged_by->GetValue(true));
        if (!is_null($this->cp["mfi_doc_code"]->GetValue()) and !strlen($this->cp["mfi_doc_code"]->GetText()) and !is_bool($this->cp["mfi_doc_code"]->GetValue())) 
            $this->cp["mfi_doc_code"]->SetValue($this->mfi_doc_code->GetValue(true));
        if (!is_null($this->cp["mfi_doc_type"]->GetValue()) and !strlen($this->cp["mfi_doc_type"]->GetText()) and !is_bool($this->cp["mfi_doc_type"]->GetValue())) 
            $this->cp["mfi_doc_type"]->SetValue($this->mfi_doc_type->GetValue(true));
        if (!is_null($this->cp["mfi_doc_filename"]->GetValue()) and !strlen($this->cp["mfi_doc_filename"]->GetText()) and !is_bool($this->cp["mfi_doc_filename"]->GetValue())) 
            $this->cp["mfi_doc_filename"]->SetValue($this->mfi_doc_filename->GetValue(true));
        if (!is_null($this->cp["mfi_doc_path"]->GetValue()) and !strlen($this->cp["mfi_doc_path"]->GetText()) and !is_bool($this->cp["mfi_doc_path"]->GetValue())) 
            $this->cp["mfi_doc_path"]->SetValue($this->mfi_doc_path->GetValue(true));
        if (!is_null($this->cp["mfi_doc_tagged_at"]->GetValue()) and !strlen($this->cp["mfi_doc_tagged_at"]->GetText()) and !is_bool($this->cp["mfi_doc_tagged_at"]->GetValue())) 
            $this->cp["mfi_doc_tagged_at"]->SetValue($this->mfi_doc_tagged_at->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "mfi_doc_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "mfi_doc_id", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsInteger),false);
        $wp->Criterion[3] = $wp->Operation(opEqual, "mfi_doc_id", $wp->GetDBValue("3"), $this->ToSQL($wp->GetDBValue("3"), ccsInteger),false);
        $Where = $wp->opAND(
             false, $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]), 
             $wp->Criterion[3]);
        $this->UpdateFields["mfi_doc_territory_code"]["Value"] = $this->cp["mfi_doc_territory_code"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_status"]["Value"] = $this->cp["mfi_doc_status"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_tagged_by"]["Value"] = $this->cp["mfi_doc_tagged_by"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_code"]["Value"] = $this->cp["mfi_doc_code"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_type"]["Value"] = $this->cp["mfi_doc_type"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_filename"]["Value"] = $this->cp["mfi_doc_filename"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_path"]["Value"] = $this->cp["mfi_doc_path"]->GetDBValue(true);
        $this->UpdateFields["mfi_doc_tagged_at"]["Value"] = $this->cp["mfi_doc_tagged_at"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("mfi_docs", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End mfi_docsDataSource Class @128-FCB6E20C







//Include Page implementation @217-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Include Page implementation @2-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Initialize Page @1-AFDEDAD3
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
$TemplateFileName = "docTagging.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-AE3F2EB6
include_once("./docTagging_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DDC339C4
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$PagePanel = new clsPanel("PagePanel", $MainPage);
$mfi_docs = new clsRecordmfi_docs("", $MainPage);
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$MainPage->incFooter = & $incFooter;
$MainPage->PagePanel = & $PagePanel;
$MainPage->mfi_docs = & $mfi_docs;
$MainPage->incMenu = & $incMenu;
$MainPage->incHeader = & $incHeader;
$PagePanel->AddComponent("mfi_docs", $mfi_docs);
$PagePanel->AddComponent("incMenu", $incMenu);
$mfi_docs->Initialize();

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

//Execute Components @1-121C9527
$incHeader->Operations();
$incMenu->Operations();
$mfi_docs->Operation();
$incFooter->Operations();
//End Execute Components

//Go to destination page @1-0214133F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incFooter->Class_Terminate();
    unset($incFooter);
    unset($mfi_docs);
    $incMenu->Class_Terminate();
    unset($incMenu);
    $incHeader->Class_Terminate();
    unset($incHeader);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-25FCDEFA
$incFooter->Show();
$incHeader->Show();
$PagePanel->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4087FB3D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incFooter->Class_Terminate();
unset($incFooter);
unset($mfi_docs);
$incMenu->Class_Terminate();
unset($incMenu);
$incHeader->Class_Terminate();
unset($incHeader);
unset($Tpl);
//End Unload Page


?>
