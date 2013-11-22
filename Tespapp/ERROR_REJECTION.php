<?php
//Include Common Files @1-B18ECA3E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ERROR_REJECTION.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @55-60E713C2
include_once(RelativePath . "/incFooter.php");
//End Include Page implementation

//mfi_docs ReportGroup class @56-EF8A4D20
class clsReportGroupmfi_docs {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $Report_TotalRecords, $_Report_TotalRecordsAttributes;
    public $batch_code, $_batch_codeAttributes;
    public $mfi_doc_type, $_mfi_doc_typeAttributes;
    public $mfi_doc_region, $_mfi_doc_regionAttributes;
    public $mfi_doc_territory_code, $_mfi_doc_territory_codePage, $_mfi_doc_territory_codeParameters, $_mfi_doc_territory_codeAttributes;
    public $mfi_doc_entered_by, $_mfi_doc_entered_byAttributes;
    public $doc_rejection_reason, $_doc_rejection_reasonAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupmfi_docs(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->batch_code = $this->Parent->batch_code->Value;
        $this->mfi_doc_type = $this->Parent->mfi_doc_type->Value;
        $this->mfi_doc_region = $this->Parent->mfi_doc_region->Value;
        $this->mfi_doc_territory_code = $this->Parent->mfi_doc_territory_code->Value;
        $this->mfi_doc_entered_by = $this->Parent->mfi_doc_entered_by->Value;
        $this->doc_rejection_reason = $this->Parent->doc_rejection_reason->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Report_TotalRecords = $this->Parent->Report_TotalRecords->GetTotalValue($mode);
        $this->_mfi_doc_territory_codePage = $this->Parent->mfi_doc_territory_code->Page;
        $this->_mfi_doc_territory_codeParameters = $this->Parent->mfi_doc_territory_code->Parameters;
        $this->_Report_TotalRecordsAttributes = $this->Parent->Report_TotalRecords->Attributes->GetAsArray();
        $this->_Button1Attributes = $this->Parent->Button1->Attributes->GetAsArray();
        $this->_batch_codeAttributes = $this->Parent->batch_code->Attributes->GetAsArray();
        $this->_mfi_doc_typeAttributes = $this->Parent->mfi_doc_type->Attributes->GetAsArray();
        $this->_mfi_doc_regionAttributes = $this->Parent->mfi_doc_region->Attributes->GetAsArray();
        $this->_mfi_doc_territory_codeAttributes = $this->Parent->mfi_doc_territory_code->Attributes->GetAsArray();
        $this->_mfi_doc_entered_byAttributes = $this->Parent->mfi_doc_entered_by->Attributes->GetAsArray();
        $this->_doc_rejection_reasonAttributes = $this->Parent->doc_rejection_reason->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Report_TotalRecords = $this->Report_TotalRecords;
        $Header->_Report_TotalRecordsAttributes = $this->_Report_TotalRecordsAttributes;
        $this->batch_code = $Header->batch_code;
        $Header->_batch_codeAttributes = $this->_batch_codeAttributes;
        $this->Parent->batch_code->Value = $Header->batch_code;
        $this->Parent->batch_code->Attributes->RestoreFromArray($Header->_batch_codeAttributes);
        $this->mfi_doc_type = $Header->mfi_doc_type;
        $Header->_mfi_doc_typeAttributes = $this->_mfi_doc_typeAttributes;
        $this->Parent->mfi_doc_type->Value = $Header->mfi_doc_type;
        $this->Parent->mfi_doc_type->Attributes->RestoreFromArray($Header->_mfi_doc_typeAttributes);
        $this->mfi_doc_region = $Header->mfi_doc_region;
        $Header->_mfi_doc_regionAttributes = $this->_mfi_doc_regionAttributes;
        $this->Parent->mfi_doc_region->Value = $Header->mfi_doc_region;
        $this->Parent->mfi_doc_region->Attributes->RestoreFromArray($Header->_mfi_doc_regionAttributes);
        $this->mfi_doc_territory_code = $Header->mfi_doc_territory_code;
        $this->_mfi_doc_territory_codePage = $Header->_mfi_doc_territory_codePage;
        $this->_mfi_doc_territory_codeParameters = $Header->_mfi_doc_territory_codeParameters;
        $Header->_mfi_doc_territory_codeAttributes = $this->_mfi_doc_territory_codeAttributes;
        $this->Parent->mfi_doc_territory_code->Value = $Header->mfi_doc_territory_code;
        $this->Parent->mfi_doc_territory_code->Attributes->RestoreFromArray($Header->_mfi_doc_territory_codeAttributes);
        $this->mfi_doc_entered_by = $Header->mfi_doc_entered_by;
        $Header->_mfi_doc_entered_byAttributes = $this->_mfi_doc_entered_byAttributes;
        $this->Parent->mfi_doc_entered_by->Value = $Header->mfi_doc_entered_by;
        $this->Parent->mfi_doc_entered_by->Attributes->RestoreFromArray($Header->_mfi_doc_entered_byAttributes);
        $this->doc_rejection_reason = $Header->doc_rejection_reason;
        $Header->_doc_rejection_reasonAttributes = $this->_doc_rejection_reasonAttributes;
        $this->Parent->doc_rejection_reason->Value = $Header->doc_rejection_reason;
        $this->Parent->doc_rejection_reason->Attributes->RestoreFromArray($Header->_doc_rejection_reasonAttributes);
    }
    function ChangeTotalControls() {
        $this->Report_TotalRecords = $this->Parent->Report_TotalRecords->GetValue();
    }
}
//End mfi_docs ReportGroup class

//mfi_docs GroupsCollection class @56-85F30CE2
class clsGroupsCollectionmfi_docs {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionmfi_docs(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_docs($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->Report_TotalRecords->Value = $this->Parent->Report_TotalRecords->initialValue;
        $this->Parent->batch_code->Value = $this->Parent->batch_code->initialValue;
        $this->Parent->mfi_doc_type->Value = $this->Parent->mfi_doc_type->initialValue;
        $this->Parent->mfi_doc_region->Value = $this->Parent->mfi_doc_region->initialValue;
        $this->Parent->mfi_doc_territory_code->Value = $this->Parent->mfi_doc_territory_code->initialValue;
        $this->Parent->mfi_doc_entered_by->Value = $this->Parent->mfi_doc_entered_by->initialValue;
        $this->Parent->doc_rejection_reason->Value = $this->Parent->doc_rejection_reason->initialValue;
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
//End mfi_docs GroupsCollection class

class clsReportmfi_docs { //mfi_docs Class @56-B705B3B8

//mfi_docs Variables @56-944D286E

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
//End mfi_docs Variables

//Class_Initialize Event @56-7406970F
    function clsReportmfi_docs($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_docs";
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
        $this->DataSource = new clsmfi_docsDataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 300;
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

        $this->Report_TotalRecords = new clsControl(ccsReportLabel, "Report_TotalRecords", "Report_TotalRecords", ccsInteger, "", 0, $this);
        $this->Report_TotalRecords->TotalFunction = "Count";
        $this->Report_TotalRecords->IsEmptySource = true;
        $this->Button1 = new clsButton("Button1", ccsGet, $this);
        $this->batch_code = new clsControl(ccsReportLabel, "batch_code", "batch_code", ccsText, "", "", $this);
        $this->mfi_doc_type = new clsControl(ccsReportLabel, "mfi_doc_type", "mfi_doc_type", ccsInteger, "", "", $this);
        $this->mfi_doc_region = new clsControl(ccsReportLabel, "mfi_doc_region", "mfi_doc_region", ccsText, "", "", $this);
        $this->mfi_doc_territory_code = new clsControl(ccsLink, "mfi_doc_territory_code", "mfi_doc_territory_code", ccsText, "", CCGetRequestParam("mfi_doc_territory_code", ccsGet, NULL), $this);
        $this->mfi_doc_territory_code->Page = "DataUpdatePage.php";
        $this->mfi_doc_entered_by = new clsControl(ccsReportLabel, "mfi_doc_entered_by", "mfi_doc_entered_by", ccsText, "", "", $this);
        $this->doc_rejection_reason = new clsControl(ccsReportLabel, "doc_rejection_reason", "doc_rejection_reason", ccsText, "", "", $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @56-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @56-90CF5226
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Report_TotalRecords->Errors->Count());
        $errors = ($errors || $this->batch_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_entered_by->Errors->Count());
        $errors = ($errors || $this->doc_rejection_reason->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @56-61B319E8
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Report_TotalRecords->Errors->ToString());
        $errors = ComposeStrings($errors, $this->batch_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_territory_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_entered_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->doc_rejection_reason->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @56-0F921C02
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionmfi_docs($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
            $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
            $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
            $this->mfi_doc_territory_code->SetValue($this->DataSource->mfi_doc_territory_code->GetValue());
            $this->mfi_doc_entered_by->SetValue($this->DataSource->mfi_doc_entered_by->GetValue());
            $this->doc_rejection_reason->SetValue($this->DataSource->doc_rejection_reason->GetValue());
            $this->mfi_doc_territory_code->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->mfi_doc_territory_code->Parameters = CCAddParam($this->mfi_doc_territory_code->Parameters, "doc_code", $this->DataSource->f("mfi_doc_territory_code"));
            $this->mfi_doc_territory_code->Parameters = CCAddParam($this->mfi_doc_territory_code->Parameters, "doc_type", $this->DataSource->f("mfi_doc_type"));
            $this->Report_TotalRecords->SetValue(1);
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
            $this->ControlsVisible["batch_code"] = $this->batch_code->Visible;
            $this->ControlsVisible["mfi_doc_type"] = $this->mfi_doc_type->Visible;
            $this->ControlsVisible["mfi_doc_region"] = $this->mfi_doc_region->Visible;
            $this->ControlsVisible["mfi_doc_territory_code"] = $this->mfi_doc_territory_code->Visible;
            $this->ControlsVisible["mfi_doc_entered_by"] = $this->mfi_doc_entered_by->Visible;
            $this->ControlsVisible["doc_rejection_reason"] = $this->doc_rejection_reason->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->batch_code->SetValue($items[$i]->batch_code);
                        $this->batch_code->Attributes->RestoreFromArray($items[$i]->_batch_codeAttributes);
                        $this->mfi_doc_type->SetValue($items[$i]->mfi_doc_type);
                        $this->mfi_doc_type->Attributes->RestoreFromArray($items[$i]->_mfi_doc_typeAttributes);
                        $this->mfi_doc_region->SetValue($items[$i]->mfi_doc_region);
                        $this->mfi_doc_region->Attributes->RestoreFromArray($items[$i]->_mfi_doc_regionAttributes);
                        $this->mfi_doc_territory_code->SetValue($items[$i]->mfi_doc_territory_code);
                        $this->mfi_doc_territory_code->Page = $items[$i]->_mfi_doc_territory_codePage;
                        $this->mfi_doc_territory_code->Parameters = $items[$i]->_mfi_doc_territory_codeParameters;
                        $this->mfi_doc_territory_code->Attributes->RestoreFromArray($items[$i]->_mfi_doc_territory_codeAttributes);
                        $this->mfi_doc_entered_by->SetValue($items[$i]->mfi_doc_entered_by);
                        $this->mfi_doc_entered_by->Attributes->RestoreFromArray($items[$i]->_mfi_doc_entered_byAttributes);
                        $this->doc_rejection_reason->SetValue($items[$i]->doc_rejection_reason);
                        $this->doc_rejection_reason->Attributes->RestoreFromArray($items[$i]->_doc_rejection_reasonAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->batch_code->Show();
                        $this->mfi_doc_type->Show();
                        $this->mfi_doc_region->Show();
                        $this->mfi_doc_territory_code->Show();
                        $this->mfi_doc_entered_by->Show();
                        $this->doc_rejection_reason->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        break;
                    case "Report":
                        if ($items[$i]->Mode == 1) {
                            $this->Report_TotalRecords->SetValue($items[$i]->Report_TotalRecords);
                            $this->Report_TotalRecords->Attributes->RestoreFromArray($items[$i]->_Report_TotalRecordsAttributes);
                            $this->Report_Header->CCSEventResult = CCGetEvent($this->Report_Header->CCSEvents, "BeforeShow", $this->Report_Header);
                            if ($this->Report_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Header";
                                $this->Attributes->Show();
                                $this->Report_TotalRecords->Show();
                                $this->Button1->Show();
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

} //End mfi_docs Class @56-FCB6E20C

class clsmfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_docsDataSource Class @56-BC5AABD7

//DataSource Variables @56-1B4FCDB3
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $batch_code;
    public $mfi_doc_type;
    public $mfi_doc_region;
    public $mfi_doc_territory_code;
    public $mfi_doc_entered_by;
    public $doc_rejection_reason;
//End DataSource Variables

//DataSourceClass_Initialize Event @56-A3C92A07
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_docs";
        $this->Initialize();
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsInteger, "");
        
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->mfi_doc_territory_code = new clsField("mfi_doc_territory_code", ccsText, "");
        
        $this->mfi_doc_entered_by = new clsField("mfi_doc_entered_by", ccsText, "");
        
        $this->doc_rejection_reason = new clsField("doc_rejection_reason", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @56-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @56-6B07A5D8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->Criterion[1] = "( doc_rejection_reason is not null )";
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @56-B641A75B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT mfi_doc_id, mfi_doc_code, batch_code, mfi_doc_region, mfi_doc_territory_code, doc_rejection_reason, mfi_doc_entered_by, mfi_doc_type \n\n" .
        "FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @56-D8EE386B
    function SetValues()
    {
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->mfi_doc_type->SetDBValue(trim($this->f("mfi_doc_type")));
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->mfi_doc_territory_code->SetDBValue($this->f("mfi_doc_territory_code"));
        $this->mfi_doc_entered_by->SetDBValue($this->f("mfi_doc_entered_by"));
        $this->doc_rejection_reason->SetDBValue($this->f("doc_rejection_reason"));
    }
//End SetValues Method

} //End mfi_docsDataSource Class @56-FCB6E20C

//Include Page implementation @84-05EE5DFD
include_once(RelativePath . "/incHeader.php");
//End Include Page implementation

//Include Page implementation @54-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Initialize Page @1-AEEEB1BC
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
$TemplateFileName = "ERROR_REJECTION.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-629DE586
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incFooter1 = new clsincFooter("", "incFooter1", $MainPage);
$incFooter1->Initialize();
$mfi_docs = new clsReportmfi_docs("", $MainPage);
$incHeader = new clsincHeader("", "incHeader", $MainPage);
$incHeader->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$MainPage->incFooter1 = & $incFooter1;
$MainPage->mfi_docs = & $mfi_docs;
$MainPage->incHeader = & $incHeader;
$MainPage->incMenu = & $incMenu;
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

//Execute Components @1-5BF9DBF2
$incMenu->Operations();
$incHeader->Operations();
$incFooter1->Operations();
//End Execute Components

//Go to destination page @1-A33F8DB9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incFooter1->Class_Terminate();
    unset($incFooter1);
    unset($mfi_docs);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incMenu->Class_Terminate();
    unset($incMenu);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E9DE5EED
$incFooter1->Show();
$mfi_docs->Show();
$incHeader->Show();
$incMenu->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-56C68DF9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incFooter1->Class_Terminate();
unset($incFooter1);
unset($mfi_docs);
$incHeader->Class_Terminate();
unset($incHeader);
$incMenu->Class_Terminate();
unset($incMenu);
unset($Tpl);
//End Unload Page


?>
