<?php
//Include Common Files @1-C022D96F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "file_upload_report.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//mfi_doc_upload ReportGroup class @2-EC31DED2
class clsReportGroupmfi_doc_upload {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $sno, $_snoAttributes;
    public $batch_code, $_batch_codeAttributes;
    public $gp_name, $_gp_nameAttributes;
    public $gp_size, $_gp_sizeAttributes;
    public $gp_code, $_gp_codeAttributes;
    public $mfi_docs_batchcode, $_mfi_docs_batchcodeAttributes;
    public $region, $_regionAttributes;
    public $file_type, $_file_typeAttributes;
    public $file_uploaded, $_file_uploadedAttributes;
    public $uploaded_date, $_uploaded_dateAttributes;
    public $uploaded_by, $_uploaded_byAttributes;
    public $file_upload_region, $_file_upload_regionAttributes;
    public $file_upload_branch, $_file_upload_branchAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupmfi_doc_upload(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->sno = $this->Parent->sno->Value;
        $this->batch_code = $this->Parent->batch_code->Value;
        $this->gp_name = $this->Parent->gp_name->Value;
        $this->gp_size = $this->Parent->gp_size->Value;
        $this->gp_code = $this->Parent->gp_code->Value;
        $this->mfi_docs_batchcode = $this->Parent->mfi_docs_batchcode->Value;
        $this->region = $this->Parent->region->Value;
        $this->file_type = $this->Parent->file_type->Value;
        $this->file_uploaded = $this->Parent->file_uploaded->Value;
        $this->uploaded_date = $this->Parent->uploaded_date->Value;
        $this->uploaded_by = $this->Parent->uploaded_by->Value;
        $this->file_upload_region = $this->Parent->file_upload_region->Value;
        $this->file_upload_branch = $this->Parent->file_upload_branch->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_snoAttributes = $this->Parent->sno->Attributes->GetAsArray();
        $this->_batch_codeAttributes = $this->Parent->batch_code->Attributes->GetAsArray();
        $this->_gp_nameAttributes = $this->Parent->gp_name->Attributes->GetAsArray();
        $this->_gp_sizeAttributes = $this->Parent->gp_size->Attributes->GetAsArray();
        $this->_gp_codeAttributes = $this->Parent->gp_code->Attributes->GetAsArray();
        $this->_mfi_docs_batchcodeAttributes = $this->Parent->mfi_docs_batchcode->Attributes->GetAsArray();
        $this->_regionAttributes = $this->Parent->region->Attributes->GetAsArray();
        $this->_file_typeAttributes = $this->Parent->file_type->Attributes->GetAsArray();
        $this->_file_uploadedAttributes = $this->Parent->file_uploaded->Attributes->GetAsArray();
        $this->_uploaded_dateAttributes = $this->Parent->uploaded_date->Attributes->GetAsArray();
        $this->_uploaded_byAttributes = $this->Parent->uploaded_by->Attributes->GetAsArray();
        $this->_file_upload_regionAttributes = $this->Parent->file_upload_region->Attributes->GetAsArray();
        $this->_file_upload_branchAttributes = $this->Parent->file_upload_branch->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->sno = $Header->sno;
        $Header->_snoAttributes = $this->_snoAttributes;
        $this->Parent->sno->Value = $Header->sno;
        $this->Parent->sno->Attributes->RestoreFromArray($Header->_snoAttributes);
        $this->batch_code = $Header->batch_code;
        $Header->_batch_codeAttributes = $this->_batch_codeAttributes;
        $this->Parent->batch_code->Value = $Header->batch_code;
        $this->Parent->batch_code->Attributes->RestoreFromArray($Header->_batch_codeAttributes);
        $this->gp_name = $Header->gp_name;
        $Header->_gp_nameAttributes = $this->_gp_nameAttributes;
        $this->Parent->gp_name->Value = $Header->gp_name;
        $this->Parent->gp_name->Attributes->RestoreFromArray($Header->_gp_nameAttributes);
        $this->gp_size = $Header->gp_size;
        $Header->_gp_sizeAttributes = $this->_gp_sizeAttributes;
        $this->Parent->gp_size->Value = $Header->gp_size;
        $this->Parent->gp_size->Attributes->RestoreFromArray($Header->_gp_sizeAttributes);
        $this->gp_code = $Header->gp_code;
        $Header->_gp_codeAttributes = $this->_gp_codeAttributes;
        $this->Parent->gp_code->Value = $Header->gp_code;
        $this->Parent->gp_code->Attributes->RestoreFromArray($Header->_gp_codeAttributes);
        $this->mfi_docs_batchcode = $Header->mfi_docs_batchcode;
        $Header->_mfi_docs_batchcodeAttributes = $this->_mfi_docs_batchcodeAttributes;
        $this->Parent->mfi_docs_batchcode->Value = $Header->mfi_docs_batchcode;
        $this->Parent->mfi_docs_batchcode->Attributes->RestoreFromArray($Header->_mfi_docs_batchcodeAttributes);
        $this->region = $Header->region;
        $Header->_regionAttributes = $this->_regionAttributes;
        $this->Parent->region->Value = $Header->region;
        $this->Parent->region->Attributes->RestoreFromArray($Header->_regionAttributes);
        $this->file_type = $Header->file_type;
        $Header->_file_typeAttributes = $this->_file_typeAttributes;
        $this->Parent->file_type->Value = $Header->file_type;
        $this->Parent->file_type->Attributes->RestoreFromArray($Header->_file_typeAttributes);
        $this->file_uploaded = $Header->file_uploaded;
        $Header->_file_uploadedAttributes = $this->_file_uploadedAttributes;
        $this->Parent->file_uploaded->Value = $Header->file_uploaded;
        $this->Parent->file_uploaded->Attributes->RestoreFromArray($Header->_file_uploadedAttributes);
        $this->uploaded_date = $Header->uploaded_date;
        $Header->_uploaded_dateAttributes = $this->_uploaded_dateAttributes;
        $this->Parent->uploaded_date->Value = $Header->uploaded_date;
        $this->Parent->uploaded_date->Attributes->RestoreFromArray($Header->_uploaded_dateAttributes);
        $this->uploaded_by = $Header->uploaded_by;
        $Header->_uploaded_byAttributes = $this->_uploaded_byAttributes;
        $this->Parent->uploaded_by->Value = $Header->uploaded_by;
        $this->Parent->uploaded_by->Attributes->RestoreFromArray($Header->_uploaded_byAttributes);
        $this->file_upload_region = $Header->file_upload_region;
        $Header->_file_upload_regionAttributes = $this->_file_upload_regionAttributes;
        $this->Parent->file_upload_region->Value = $Header->file_upload_region;
        $this->Parent->file_upload_region->Attributes->RestoreFromArray($Header->_file_upload_regionAttributes);
        $this->file_upload_branch = $Header->file_upload_branch;
        $Header->_file_upload_branchAttributes = $this->_file_upload_branchAttributes;
        $this->Parent->file_upload_branch->Value = $Header->file_upload_branch;
        $this->Parent->file_upload_branch->Attributes->RestoreFromArray($Header->_file_upload_branchAttributes);
    }
    function ChangeTotalControls() {
    }
}
//End mfi_doc_upload ReportGroup class

//mfi_doc_upload GroupsCollection class @2-5FECF685
class clsGroupsCollectionmfi_doc_upload {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionmfi_doc_upload(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_doc_upload($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->sno->Value = $this->Parent->sno->initialValue;
        $this->Parent->batch_code->Value = $this->Parent->batch_code->initialValue;
        $this->Parent->gp_name->Value = $this->Parent->gp_name->initialValue;
        $this->Parent->gp_size->Value = $this->Parent->gp_size->initialValue;
        $this->Parent->gp_code->Value = $this->Parent->gp_code->initialValue;
        $this->Parent->mfi_docs_batchcode->Value = $this->Parent->mfi_docs_batchcode->initialValue;
        $this->Parent->region->Value = $this->Parent->region->initialValue;
        $this->Parent->file_type->Value = $this->Parent->file_type->initialValue;
        $this->Parent->file_uploaded->Value = $this->Parent->file_uploaded->initialValue;
        $this->Parent->uploaded_date->Value = $this->Parent->uploaded_date->initialValue;
        $this->Parent->uploaded_by->Value = $this->Parent->uploaded_by->initialValue;
        $this->Parent->file_upload_region->Value = $this->Parent->file_upload_region->initialValue;
        $this->Parent->file_upload_branch->Value = $this->Parent->file_upload_branch->initialValue;
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
//End mfi_doc_upload GroupsCollection class

class clsReportmfi_doc_upload { //mfi_doc_upload Class @2-A2E38144

//mfi_doc_upload Variables @2-944D286E

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
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
//End mfi_doc_upload Variables

//Class_Initialize Event @2-1C802D34
    function clsReportmfi_doc_upload($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_doc_upload";
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
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 1;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->Errors = new clsErrors();
        $this->DataSource = new clsmfi_doc_uploadDataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 10;
             else if ($PageSize == "0")
                $this->PageSize = 100;
             else 
                $this->PageSize = min(100, $PageSize);
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }

        $this->sno = new clsControl(ccsReportLabel, "sno", "sno", ccsInteger, "", "", $this);
        $this->batch_code = new clsControl(ccsReportLabel, "batch_code", "batch_code", ccsText, "", "", $this);
        $this->gp_name = new clsControl(ccsReportLabel, "gp_name", "gp_name", ccsText, "", "", $this);
        $this->gp_size = new clsControl(ccsReportLabel, "gp_size", "gp_size", ccsInteger, "", "", $this);
        $this->gp_code = new clsControl(ccsReportLabel, "gp_code", "gp_code", ccsText, "", "", $this);
        $this->mfi_docs_batchcode = new clsControl(ccsReportLabel, "mfi_docs_batchcode", "mfi_docs_batchcode", ccsText, "", "", $this);
        $this->region = new clsControl(ccsReportLabel, "region", "region", ccsText, "", "", $this);
        $this->file_type = new clsControl(ccsReportLabel, "file_type", "file_type", ccsText, "", "", $this);
        $this->file_uploaded = new clsControl(ccsReportLabel, "file_uploaded", "file_uploaded", ccsText, "", "", $this);
        $this->uploaded_date = new clsControl(ccsReportLabel, "uploaded_date", "uploaded_date", ccsText, "", "", $this);
        $this->uploaded_by = new clsControl(ccsReportLabel, "uploaded_by", "uploaded_by", ccsText, "", "", $this);
        $this->file_upload_region = new clsControl(ccsReportLabel, "file_upload_region", "file_upload_region", ccsText, "", "", $this);
        $this->file_upload_branch = new clsControl(ccsReportLabel, "file_upload_branch", "file_upload_branch", ccsText, "", "", $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @2-7EAC55C1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->sno->Errors->Count());
        $errors = ($errors || $this->batch_code->Errors->Count());
        $errors = ($errors || $this->gp_name->Errors->Count());
        $errors = ($errors || $this->gp_size->Errors->Count());
        $errors = ($errors || $this->gp_code->Errors->Count());
        $errors = ($errors || $this->mfi_docs_batchcode->Errors->Count());
        $errors = ($errors || $this->region->Errors->Count());
        $errors = ($errors || $this->file_type->Errors->Count());
        $errors = ($errors || $this->file_uploaded->Errors->Count());
        $errors = ($errors || $this->uploaded_date->Errors->Count());
        $errors = ($errors || $this->uploaded_by->Errors->Count());
        $errors = ($errors || $this->file_upload_region->Errors->Count());
        $errors = ($errors || $this->file_upload_branch->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-BC89A468
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->sno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->batch_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gp_size->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gp_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_docs_batchcode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->file_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->file_uploaded->Errors->ToString());
        $errors = ComposeStrings($errors, $this->uploaded_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->uploaded_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->file_upload_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->file_upload_branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-81A0E862
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_batch_code"] = CCGetFromGet("s_batch_code", NULL);
        $this->DataSource->Parameters["urls_gp_code"] = CCGetFromGet("s_gp_code", NULL);
        $this->DataSource->Parameters["urls_file_type"] = CCGetFromGet("s_file_type", NULL);
        $this->DataSource->Parameters["urls_uploaded_date"] = CCGetFromGet("s_uploaded_date", NULL);
        $this->DataSource->Parameters["urls_uploaded_by"] = CCGetFromGet("s_uploaded_by", NULL);
        $this->DataSource->Parameters["urls_file_upload_region"] = CCGetFromGet("s_file_upload_region", NULL);
        $this->DataSource->Parameters["urls_file_upload_branch"] = CCGetFromGet("s_file_upload_branch", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionmfi_doc_upload($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->sno->SetValue($this->DataSource->sno->GetValue());
            $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
            $this->gp_name->SetValue($this->DataSource->gp_name->GetValue());
            $this->gp_size->SetValue($this->DataSource->gp_size->GetValue());
            $this->gp_code->SetValue($this->DataSource->gp_code->GetValue());
            $this->mfi_docs_batchcode->SetValue($this->DataSource->mfi_docs_batchcode->GetValue());
            $this->region->SetValue($this->DataSource->region->GetValue());
            $this->file_type->SetValue($this->DataSource->file_type->GetValue());
            $this->file_uploaded->SetValue($this->DataSource->file_uploaded->GetValue());
            $this->uploaded_date->SetValue($this->DataSource->uploaded_date->GetValue());
            $this->uploaded_by->SetValue($this->DataSource->uploaded_by->GetValue());
            $this->file_upload_region->SetValue($this->DataSource->file_upload_region->GetValue());
            $this->file_upload_branch->SetValue($this->DataSource->file_upload_branch->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            $Groups->AddItem();
            $is_next_record = $this->DataSource->next_record();
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
            $this->ControlsVisible["sno"] = $this->sno->Visible;
            $this->ControlsVisible["batch_code"] = $this->batch_code->Visible;
            $this->ControlsVisible["gp_name"] = $this->gp_name->Visible;
            $this->ControlsVisible["gp_size"] = $this->gp_size->Visible;
            $this->ControlsVisible["gp_code"] = $this->gp_code->Visible;
            $this->ControlsVisible["mfi_docs_batchcode"] = $this->mfi_docs_batchcode->Visible;
            $this->ControlsVisible["region"] = $this->region->Visible;
            $this->ControlsVisible["file_type"] = $this->file_type->Visible;
            $this->ControlsVisible["file_uploaded"] = $this->file_uploaded->Visible;
            $this->ControlsVisible["uploaded_date"] = $this->uploaded_date->Visible;
            $this->ControlsVisible["uploaded_by"] = $this->uploaded_by->Visible;
            $this->ControlsVisible["file_upload_region"] = $this->file_upload_region->Visible;
            $this->ControlsVisible["file_upload_branch"] = $this->file_upload_branch->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->sno->SetValue($items[$i]->sno);
                        $this->sno->Attributes->RestoreFromArray($items[$i]->_snoAttributes);
                        $this->batch_code->SetValue($items[$i]->batch_code);
                        $this->batch_code->Attributes->RestoreFromArray($items[$i]->_batch_codeAttributes);
                        $this->gp_name->SetValue($items[$i]->gp_name);
                        $this->gp_name->Attributes->RestoreFromArray($items[$i]->_gp_nameAttributes);
                        $this->gp_size->SetValue($items[$i]->gp_size);
                        $this->gp_size->Attributes->RestoreFromArray($items[$i]->_gp_sizeAttributes);
                        $this->gp_code->SetValue($items[$i]->gp_code);
                        $this->gp_code->Attributes->RestoreFromArray($items[$i]->_gp_codeAttributes);
                        $this->mfi_docs_batchcode->SetValue($items[$i]->mfi_docs_batchcode);
                        $this->mfi_docs_batchcode->Attributes->RestoreFromArray($items[$i]->_mfi_docs_batchcodeAttributes);
                        $this->region->SetValue($items[$i]->region);
                        $this->region->Attributes->RestoreFromArray($items[$i]->_regionAttributes);
                        $this->file_type->SetValue($items[$i]->file_type);
                        $this->file_type->Attributes->RestoreFromArray($items[$i]->_file_typeAttributes);
                        $this->file_uploaded->SetValue($items[$i]->file_uploaded);
                        $this->file_uploaded->Attributes->RestoreFromArray($items[$i]->_file_uploadedAttributes);
                        $this->uploaded_date->SetValue($items[$i]->uploaded_date);
                        $this->uploaded_date->Attributes->RestoreFromArray($items[$i]->_uploaded_dateAttributes);
                        $this->uploaded_by->SetValue($items[$i]->uploaded_by);
                        $this->uploaded_by->Attributes->RestoreFromArray($items[$i]->_uploaded_byAttributes);
                        $this->file_upload_region->SetValue($items[$i]->file_upload_region);
                        $this->file_upload_region->Attributes->RestoreFromArray($items[$i]->_file_upload_regionAttributes);
                        $this->file_upload_branch->SetValue($items[$i]->file_upload_branch);
                        $this->file_upload_branch->Attributes->RestoreFromArray($items[$i]->_file_upload_branchAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->sno->Show();
                        $this->batch_code->Show();
                        $this->gp_name->Show();
                        $this->gp_size->Show();
                        $this->gp_code->Show();
                        $this->mfi_docs_batchcode->Show();
                        $this->region->Show();
                        $this->file_type->Show();
                        $this->file_uploaded->Show();
                        $this->uploaded_date->Show();
                        $this->uploaded_by->Show();
                        $this->file_upload_region->Show();
                        $this->file_upload_branch->Show();
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
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
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
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode) && ($this->Navigator->TotalPages > 1);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
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

} //End mfi_doc_upload Class @2-FCB6E20C

class clsmfi_doc_uploadDataSource extends clsDBmysql_cams_v2 {  //mfi_doc_uploadDataSource Class @2-4E2DB1E5

//DataSource Variables @2-C8A3EC52
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $sno;
    public $batch_code;
    public $gp_name;
    public $gp_size;
    public $gp_code;
    public $mfi_docs_batchcode;
    public $region;
    public $file_type;
    public $file_uploaded;
    public $uploaded_date;
    public $uploaded_by;
    public $file_upload_region;
    public $file_upload_branch;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C65F5E37
    function clsmfi_doc_uploadDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_doc_upload";
        $this->Initialize();
        $this->sno = new clsField("sno", ccsInteger, "");
        
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->gp_name = new clsField("gp_name", ccsText, "");
        
        $this->gp_size = new clsField("gp_size", ccsInteger, "");
        
        $this->gp_code = new clsField("gp_code", ccsText, "");
        
        $this->mfi_docs_batchcode = new clsField("mfi_docs_batchcode", ccsText, "");
        
        $this->region = new clsField("region", ccsText, "");
        
        $this->file_type = new clsField("file_type", ccsText, "");
        
        $this->file_uploaded = new clsField("file_uploaded", ccsText, "");
        
        $this->uploaded_date = new clsField("uploaded_date", ccsText, "");
        
        $this->uploaded_by = new clsField("uploaded_by", ccsText, "");
        
        $this->file_upload_region = new clsField("file_upload_region", ccsText, "");
        
        $this->file_upload_branch = new clsField("file_upload_branch", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-EF81058E
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "batch_code";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-6AF1787A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_batch_code", ccsText, "", "", $this->Parameters["urls_batch_code"], "", false);
        $this->wp->AddParameter("2", "urls_gp_code", ccsText, "", "", $this->Parameters["urls_gp_code"], "", false);
        $this->wp->AddParameter("3", "urls_file_type", ccsText, "", "", $this->Parameters["urls_file_type"], "", false);
        $this->wp->AddParameter("4", "urls_uploaded_date", ccsText, "", "", $this->Parameters["urls_uploaded_date"], "", false);
        $this->wp->AddParameter("5", "urls_uploaded_by", ccsText, "", "", $this->Parameters["urls_uploaded_by"], "", false);
        $this->wp->AddParameter("6", "urls_file_upload_region", ccsText, "", "", $this->Parameters["urls_file_upload_region"], "", false);
        $this->wp->AddParameter("7", "urls_file_upload_branch", ccsText, "", "", $this->Parameters["urls_file_upload_branch"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "batch_code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "gp_code", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "file_type", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "uploaded_date", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "uploaded_by", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "file_upload_region", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opContains, "file_upload_branch", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsText),false);
        $this->Where = $this->wp->opOR(
             false, $this->wp->opOR(
             false, $this->wp->opOR(
             false, $this->wp->opOR(
             false, $this->wp->opOR(
             false, $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]);
    }
//End Prepare Method

//Open Method @2-6AFE61EB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT *, gp_code \n\n" .
        "FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-52111B33
    function SetValues()
    {
        $this->sno->SetDBValue(trim($this->f("sno")));
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->gp_name->SetDBValue($this->f("gp_name"));
        $this->gp_size->SetDBValue(trim($this->f("gp_size")));
        $this->gp_code->SetDBValue($this->f("gp_code"));
        $this->mfi_docs_batchcode->SetDBValue($this->f("mfi_docs_batchcode"));
        $this->region->SetDBValue($this->f("region"));
        $this->file_type->SetDBValue($this->f("file_type"));
        $this->file_uploaded->SetDBValue($this->f("file_uploaded"));
        $this->uploaded_date->SetDBValue($this->f("uploaded_date"));
        $this->uploaded_by->SetDBValue($this->f("uploaded_by"));
        $this->file_upload_region->SetDBValue($this->f("file_upload_region"));
        $this->file_upload_branch->SetDBValue($this->f("file_upload_branch"));
    }
//End SetValues Method

} //End mfi_doc_uploadDataSource Class @2-FCB6E20C

class clsRecordmfi_doc_uploadSearch { //mfi_doc_uploadSearch Class @32-92DB2FC5

//Variables @32-9E315808

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

//Class_Initialize Event @32-176F10B9
    function clsRecordmfi_doc_uploadSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_doc_uploadSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_doc_uploadSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_batch_code = new clsControl(ccsTextBox, "s_batch_code", $CCSLocales->GetText("batch_code"), ccsText, "", CCGetRequestParam("s_batch_code", $Method, NULL), $this);
            $this->s_gp_code = new clsControl(ccsTextBox, "s_gp_code", $CCSLocales->GetText("gp_code"), ccsText, "", CCGetRequestParam("s_gp_code", $Method, NULL), $this);
            $this->s_file_type = new clsControl(ccsTextBox, "s_file_type", $CCSLocales->GetText("file_type"), ccsText, "", CCGetRequestParam("s_file_type", $Method, NULL), $this);
            $this->s_uploaded_date = new clsControl(ccsTextBox, "s_uploaded_date", $CCSLocales->GetText("uploaded_date"), ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("s_uploaded_date", $Method, NULL), $this);
            $this->s_uploaded_by = new clsControl(ccsTextBox, "s_uploaded_by", $CCSLocales->GetText("uploaded_by"), ccsText, "", CCGetRequestParam("s_uploaded_by", $Method, NULL), $this);
            $this->s_file_upload_region = new clsControl(ccsTextBox, "s_file_upload_region", $CCSLocales->GetText("file_upload_region"), ccsText, "", CCGetRequestParam("s_file_upload_region", $Method, NULL), $this);
            $this->s_file_upload_branch = new clsControl(ccsTextBox, "s_file_upload_branch", $CCSLocales->GetText("file_upload_branch"), ccsText, "", CCGetRequestParam("s_file_upload_branch", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @32-17D45B5C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_batch_code->Validate() && $Validation);
        $Validation = ($this->s_gp_code->Validate() && $Validation);
        $Validation = ($this->s_file_type->Validate() && $Validation);
        $Validation = ($this->s_uploaded_date->Validate() && $Validation);
        $Validation = ($this->s_uploaded_by->Validate() && $Validation);
        $Validation = ($this->s_file_upload_region->Validate() && $Validation);
        $Validation = ($this->s_file_upload_branch->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_batch_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_gp_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_file_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_uploaded_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_uploaded_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_file_upload_region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_file_upload_branch->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @32-A70A4D46
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_batch_code->Errors->Count());
        $errors = ($errors || $this->s_gp_code->Errors->Count());
        $errors = ($errors || $this->s_file_type->Errors->Count());
        $errors = ($errors || $this->s_uploaded_date->Errors->Count());
        $errors = ($errors || $this->s_uploaded_by->Errors->Count());
        $errors = ($errors || $this->s_file_upload_region->Errors->Count());
        $errors = ($errors || $this->s_file_upload_branch->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @32-1F9145E7
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
        $Redirect = "file_upload_report.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "file_upload_report.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @32-AFFF8615
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
            $Error = ComposeStrings($Error, $this->s_batch_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_gp_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_file_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_uploaded_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_uploaded_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_file_upload_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_file_upload_branch->Errors->ToString());
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
        $this->s_gp_code->Show();
        $this->s_file_type->Show();
        $this->s_uploaded_date->Show();
        $this->s_uploaded_by->Show();
        $this->s_file_upload_region->Show();
        $this->s_file_upload_branch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_doc_uploadSearch Class @32-FCB6E20C

//Initialize Page @1-7C77F318
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
$TemplateFileName = "file_upload_report.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-EFD5D09A
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_doc_upload = new clsReportmfi_doc_upload("", $MainPage);
$mfi_doc_uploadSearch = new clsRecordmfi_doc_uploadSearch("", $MainPage);
$MainPage->mfi_doc_upload = & $mfi_doc_upload;
$MainPage->mfi_doc_uploadSearch = & $mfi_doc_uploadSearch;
$mfi_doc_upload->Initialize();

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

//Execute Components @1-9EF76175
$mfi_doc_uploadSearch->Operation();
//End Execute Components

//Go to destination page @1-542111AE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_doc_upload);
    unset($mfi_doc_uploadSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3E177056
$mfi_doc_upload->Show();
$mfi_doc_uploadSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AF638853
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_doc_upload);
unset($mfi_doc_uploadSearch);
unset($Tpl);
//End Unload Page


?>
