<?php
//Include Common Files @1-B6BAAA29
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "PENDING_BATCHWISE.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



//Include Page implementation @41-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @4-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Include Page implementation @42-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

//mfi_docs ReportGroup class @43-1FE0572B
class clsReportGroupmfi_docs {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $mfi_docs_mfi_doc_region, $_mfi_docs_mfi_doc_regionAttributes;
    public $mfi_docs_batch_code, $_mfi_docs_batch_codeAttributes;
    public $mfi_doc_type, $_mfi_doc_typeAttributes;
    public $PAGE_COUNT, $_PAGE_COUNTAttributes;
    public $Sum_PAGE_COUNT1, $_Sum_PAGE_COUNT1Attributes;
    public $Sum_PAGE_COUNT, $_Sum_PAGE_COUNTAttributes;
    public $mfi_docs_mfi_doc_region1, $_mfi_docs_mfi_doc_region1Attributes;
    public $TotalSum_PAGE_COUNT, $_TotalSum_PAGE_COUNTAttributes;
    public $Report_CurrentDate, $_Report_CurrentDateAttributes;
    public $Report_CurrentPage, $_Report_CurrentPageAttributes;
    public $Report_TotalPages, $_Report_TotalPagesAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $mfi_docs_mfi_doc_regionTotalIndex;
    public $mfi_docs_batch_codeTotalIndex;

    function clsReportGroupmfi_docs(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->mfi_docs_mfi_doc_region = $this->Parent->mfi_docs_mfi_doc_region->Value;
        $this->mfi_docs_batch_code = $this->Parent->mfi_docs_batch_code->Value;
        $this->mfi_doc_type = $this->Parent->mfi_doc_type->Value;
        $this->PAGE_COUNT = $this->Parent->PAGE_COUNT->Value;
        $this->mfi_docs_mfi_doc_region1 = $this->Parent->mfi_docs_mfi_doc_region1->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Sum_PAGE_COUNT1 = $this->Parent->Sum_PAGE_COUNT1->GetTotalValue($mode);
        $this->Sum_PAGE_COUNT = $this->Parent->Sum_PAGE_COUNT->GetTotalValue($mode);
        $this->TotalSum_PAGE_COUNT = $this->Parent->TotalSum_PAGE_COUNT->GetTotalValue($mode);
        $this->_mfi_docs_mfi_doc_regionAttributes = $this->Parent->mfi_docs_mfi_doc_region->Attributes->GetAsArray();
        $this->_mfi_docs_batch_codeAttributes = $this->Parent->mfi_docs_batch_code->Attributes->GetAsArray();
        $this->_mfi_doc_typeAttributes = $this->Parent->mfi_doc_type->Attributes->GetAsArray();
        $this->_PAGE_COUNTAttributes = $this->Parent->PAGE_COUNT->Attributes->GetAsArray();
        $this->_Sum_PAGE_COUNT1Attributes = $this->Parent->Sum_PAGE_COUNT1->Attributes->GetAsArray();
        $this->_Sum_PAGE_COUNTAttributes = $this->Parent->Sum_PAGE_COUNT->Attributes->GetAsArray();
        $this->_mfi_docs_mfi_doc_region1Attributes = $this->Parent->mfi_docs_mfi_doc_region1->Attributes->GetAsArray();
        $this->_TotalSum_PAGE_COUNTAttributes = $this->Parent->TotalSum_PAGE_COUNT->Attributes->GetAsArray();
        $this->_Report_CurrentDateAttributes = $this->Parent->Report_CurrentDate->Attributes->GetAsArray();
        $this->_Report_CurrentPageAttributes = $this->Parent->Report_CurrentPage->Attributes->GetAsArray();
        $this->_Report_TotalPagesAttributes = $this->Parent->Report_TotalPages->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Sum_PAGE_COUNT1 = $this->Sum_PAGE_COUNT1;
        $Header->_Sum_PAGE_COUNT1Attributes = $this->_Sum_PAGE_COUNT1Attributes;
        $Header->Sum_PAGE_COUNT = $this->Sum_PAGE_COUNT;
        $Header->_Sum_PAGE_COUNTAttributes = $this->_Sum_PAGE_COUNTAttributes;
        $Header->TotalSum_PAGE_COUNT = $this->TotalSum_PAGE_COUNT;
        $Header->_TotalSum_PAGE_COUNTAttributes = $this->_TotalSum_PAGE_COUNTAttributes;
        $this->mfi_docs_mfi_doc_region = $Header->mfi_docs_mfi_doc_region;
        $Header->_mfi_docs_mfi_doc_regionAttributes = $this->_mfi_docs_mfi_doc_regionAttributes;
        $this->Parent->mfi_docs_mfi_doc_region->Value = $Header->mfi_docs_mfi_doc_region;
        $this->Parent->mfi_docs_mfi_doc_region->Attributes->RestoreFromArray($Header->_mfi_docs_mfi_doc_regionAttributes);
        $this->mfi_docs_batch_code = $Header->mfi_docs_batch_code;
        $Header->_mfi_docs_batch_codeAttributes = $this->_mfi_docs_batch_codeAttributes;
        $this->Parent->mfi_docs_batch_code->Value = $Header->mfi_docs_batch_code;
        $this->Parent->mfi_docs_batch_code->Attributes->RestoreFromArray($Header->_mfi_docs_batch_codeAttributes);
        $this->mfi_doc_type = $Header->mfi_doc_type;
        $Header->_mfi_doc_typeAttributes = $this->_mfi_doc_typeAttributes;
        $this->Parent->mfi_doc_type->Value = $Header->mfi_doc_type;
        $this->Parent->mfi_doc_type->Attributes->RestoreFromArray($Header->_mfi_doc_typeAttributes);
        $this->PAGE_COUNT = $Header->PAGE_COUNT;
        $Header->_PAGE_COUNTAttributes = $this->_PAGE_COUNTAttributes;
        $this->Parent->PAGE_COUNT->Value = $Header->PAGE_COUNT;
        $this->Parent->PAGE_COUNT->Attributes->RestoreFromArray($Header->_PAGE_COUNTAttributes);
        $this->mfi_docs_mfi_doc_region1 = $Header->mfi_docs_mfi_doc_region1;
        $Header->_mfi_docs_mfi_doc_region1Attributes = $this->_mfi_docs_mfi_doc_region1Attributes;
        $this->Parent->mfi_docs_mfi_doc_region1->Value = $Header->mfi_docs_mfi_doc_region1;
        $this->Parent->mfi_docs_mfi_doc_region1->Attributes->RestoreFromArray($Header->_mfi_docs_mfi_doc_region1Attributes);
    }
    function ChangeTotalControls() {
        $this->Sum_PAGE_COUNT1 = $this->Parent->Sum_PAGE_COUNT1->GetValue();
        $this->Sum_PAGE_COUNT = $this->Parent->Sum_PAGE_COUNT->GetValue();
        $this->TotalSum_PAGE_COUNT = $this->Parent->TotalSum_PAGE_COUNT->GetValue();
    }
}
//End mfi_docs ReportGroup class

//mfi_docs GroupsCollection class @43-4417F9C1
class clsGroupsCollectionmfi_docs {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mmfi_docs_mfi_doc_regionCurrentHeaderIndex;
    public $mmfi_docs_batch_codeCurrentHeaderIndex;
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
        $this->mmfi_docs_mfi_doc_regionCurrentHeaderIndex = 1;
        $this->mmfi_docs_batch_codeCurrentHeaderIndex = 2;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_docs($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->mfi_docs_mfi_doc_regionTotalIndex = $this->mmfi_docs_mfi_doc_regionCurrentHeaderIndex;
        $group->mfi_docs_batch_codeTotalIndex = $this->mmfi_docs_batch_codeCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->mfi_docs_mfi_doc_region->Value = $this->Parent->mfi_docs_mfi_doc_region->initialValue;
        $this->Parent->mfi_docs_batch_code->Value = $this->Parent->mfi_docs_batch_code->initialValue;
        $this->Parent->mfi_doc_type->Value = $this->Parent->mfi_doc_type->initialValue;
        $this->Parent->PAGE_COUNT->Value = $this->Parent->PAGE_COUNT->initialValue;
        $this->Parent->Sum_PAGE_COUNT1->Value = $this->Parent->Sum_PAGE_COUNT1->initialValue;
        $this->Parent->Sum_PAGE_COUNT->Value = $this->Parent->Sum_PAGE_COUNT->initialValue;
        $this->Parent->mfi_docs_mfi_doc_region1->Value = $this->Parent->mfi_docs_mfi_doc_region1->initialValue;
        $this->Parent->TotalSum_PAGE_COUNT->Value = $this->Parent->TotalSum_PAGE_COUNT->initialValue;
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
        if ($groupName == "mfi_docs_mfi_doc_region") {
            $Groupmfi_docs_mfi_doc_region = & $this->InitGroup(true);
            $this->Parent->mfi_docs_mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_docs_mfi_doc_region_Header->CCSEvents, "OnInitialize", $this->Parent->mfi_docs_mfi_doc_region_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mfi_docs_mfi_doc_region_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mfi_docs_mfi_doc_region_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mfi_docs_mfi_doc_region_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mfi_docs_mfi_doc_region_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_docs_mfi_doc_region_Header->Height;
                $Groupmfi_docs_mfi_doc_region->SetTotalControls("GetNextValue");
            $this->Parent->mfi_docs_mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_docs_mfi_doc_region_Header->CCSEvents, "OnCalculate", $this->Parent->mfi_docs_mfi_doc_region_Header);
            $Groupmfi_docs_mfi_doc_region->SetControls();
            $Groupmfi_docs_mfi_doc_region->Mode = 1;
            $OpenFlag = true;
            $Groupmfi_docs_mfi_doc_region->GroupType = "mfi_docs_mfi_doc_region";
            $this->mmfi_docs_mfi_doc_regionCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_docs_mfi_doc_region;
            $this->Parent->Sum_PAGE_COUNT->Reset();
        }
        if ($groupName == "mfi_docs_batch_code" or $OpenFlag) {
            $Groupmfi_docs_batch_code = & $this->InitGroup(true);
            $this->Parent->mfi_docs_batch_code_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_docs_batch_code_Header->CCSEvents, "OnInitialize", $this->Parent->mfi_docs_batch_code_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mfi_docs_batch_code_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mfi_docs_batch_code_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mfi_docs_batch_code_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mfi_docs_batch_code_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_docs_batch_code_Header->Height;
                $Groupmfi_docs_batch_code->SetTotalControls("GetNextValue");
            $this->Parent->mfi_docs_batch_code_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_docs_batch_code_Header->CCSEvents, "OnCalculate", $this->Parent->mfi_docs_batch_code_Header);
            $Groupmfi_docs_batch_code->SetControls();
            $Groupmfi_docs_batch_code->Mode = 1;
            $Groupmfi_docs_batch_code->GroupType = "mfi_docs_batch_code";
            $this->mmfi_docs_batch_codeCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_docs_batch_code;
            $this->Parent->Sum_PAGE_COUNT1->Reset();
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
        $Groupmfi_docs_batch_code = & $this->InitGroup(true);
        $this->Parent->mfi_docs_batch_code_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_docs_batch_code_Footer->CCSEvents, "OnInitialize", $this->Parent->mfi_docs_batch_code_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mfi_docs_batch_code_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mfi_docs_batch_code_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mfi_docs_batch_code_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmfi_docs_batch_code->SetTotalControls("GetPrevValue");
        $Groupmfi_docs_batch_code->SyncWithHeader($this->Groups[$this->mmfi_docs_batch_codeCurrentHeaderIndex]);
        if ($this->Parent->mfi_docs_batch_code_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_docs_batch_code_Footer->Height;
        $this->Parent->mfi_docs_batch_code_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_docs_batch_code_Footer->CCSEvents, "OnCalculate", $this->Parent->mfi_docs_batch_code_Footer);
        $Groupmfi_docs_batch_code->SetControls();
        $this->Parent->Sum_PAGE_COUNT1->Reset();
        $this->RestoreValues();
        $Groupmfi_docs_batch_code->Mode = 2;
        $Groupmfi_docs_batch_code->GroupType ="mfi_docs_batch_code";
        $this->Groups[] = & $Groupmfi_docs_batch_code;
        if ($groupName == "mfi_docs_batch_code") return;
        $Groupmfi_docs_mfi_doc_region = & $this->InitGroup(true);
        $this->Parent->mfi_docs_mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_docs_mfi_doc_region_Footer->CCSEvents, "OnInitialize", $this->Parent->mfi_docs_mfi_doc_region_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mfi_docs_mfi_doc_region_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mfi_docs_mfi_doc_region_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mfi_docs_mfi_doc_region_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmfi_docs_mfi_doc_region->SetTotalControls("GetPrevValue");
        $Groupmfi_docs_mfi_doc_region->SyncWithHeader($this->Groups[$this->mmfi_docs_mfi_doc_regionCurrentHeaderIndex]);
        if ($this->Parent->mfi_docs_mfi_doc_region_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_docs_mfi_doc_region_Footer->Height;
        $this->Parent->mfi_docs_mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_docs_mfi_doc_region_Footer->CCSEvents, "OnCalculate", $this->Parent->mfi_docs_mfi_doc_region_Footer);
        $Groupmfi_docs_mfi_doc_region->SetControls();
        $this->Parent->Sum_PAGE_COUNT->Reset();
        $this->RestoreValues();
        $Groupmfi_docs_mfi_doc_region->Mode = 2;
        $Groupmfi_docs_mfi_doc_region->GroupType ="mfi_docs_mfi_doc_region";
        $this->Groups[] = & $Groupmfi_docs_mfi_doc_region;
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

class clsReportmfi_docs { //mfi_docs Class @43-B705B3B8

//mfi_docs Variables @43-DEEA5FF2

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
    public $mfi_docs_mfi_doc_region_HeaderBlock, $mfi_docs_mfi_doc_region_Header;
    public $mfi_docs_mfi_doc_region_FooterBlock, $mfi_docs_mfi_doc_region_Footer;
    public $mfi_docs_batch_code_HeaderBlock, $mfi_docs_batch_code_Header;
    public $mfi_docs_batch_code_FooterBlock, $mfi_docs_batch_code_Footer;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $mfi_docs_mfi_doc_region_HeaderControls, $mfi_docs_mfi_doc_region_FooterControls;
    public $mfi_docs_batch_code_HeaderControls, $mfi_docs_batch_code_FooterControls;
//End mfi_docs Variables

//Class_Initialize Event @43-978196DD
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
        $this->Report_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Report_Footer->Height);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Footer->Height = 1;
        $MinPageSize += $this->Page_Footer->Height;
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->mfi_docs_mfi_doc_region_Footer = new clsSection($this);
        $this->mfi_docs_mfi_doc_region_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_docs_mfi_doc_region_Footer->Height);
        $this->mfi_docs_mfi_doc_region_Header = new clsSection($this);
        $this->mfi_docs_mfi_doc_region_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_docs_mfi_doc_region_Header->Height);
        $this->mfi_docs_batch_code_Footer = new clsSection($this);
        $this->mfi_docs_batch_code_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_docs_batch_code_Footer->Height);
        $this->mfi_docs_batch_code_Header = new clsSection($this);
        $this->mfi_docs_batch_code_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_docs_batch_code_Header->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsmfi_docsDataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 100;
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

        $this->mfi_docs_mfi_doc_region = new clsControl(ccsReportLabel, "mfi_docs_mfi_doc_region", "mfi_docs_mfi_doc_region", ccsText, "", "", $this);
        $this->mfi_docs_batch_code = new clsControl(ccsReportLabel, "mfi_docs_batch_code", "mfi_docs_batch_code", ccsText, "", "", $this);
        $this->mfi_doc_type = new clsControl(ccsReportLabel, "mfi_doc_type", "mfi_doc_type", ccsText, "", "", $this);
        $this->PAGE_COUNT = new clsControl(ccsReportLabel, "PAGE_COUNT", "PAGE_COUNT", ccsInteger, "", "", $this);
        $this->Sum_PAGE_COUNT1 = new clsControl(ccsReportLabel, "Sum_PAGE_COUNT1", "Sum_PAGE_COUNT1", ccsInteger, "", "", $this);
        $this->Sum_PAGE_COUNT1->TotalFunction = "Sum";
        $this->Sum_PAGE_COUNT = new clsControl(ccsReportLabel, "Sum_PAGE_COUNT", "Sum_PAGE_COUNT", ccsInteger, "", "", $this);
        $this->Sum_PAGE_COUNT->TotalFunction = "Sum";
        $this->mfi_docs_mfi_doc_region1 = new clsControl(ccsReportLabel, "mfi_docs_mfi_doc_region1", "mfi_docs_mfi_doc_region1", ccsText, "", "", $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->TotalSum_PAGE_COUNT = new clsControl(ccsReportLabel, "TotalSum_PAGE_COUNT", "TotalSum_PAGE_COUNT", ccsInteger, "", "", $this);
        $this->TotalSum_PAGE_COUNT->TotalFunction = "Sum";
        $this->Report_CurrentDate = new clsControl(ccsReportLabel, "Report_CurrentDate", "Report_CurrentDate", ccsText, array('ShortDate'), "", $this);
        $this->Report_CurrentPage = new clsControl(ccsReportLabel, "Report_CurrentPage", "Report_CurrentPage", ccsInteger, "", "", $this);
        $this->Report_TotalPages = new clsControl(ccsReportLabel, "Report_TotalPages", "Report_TotalPages", ccsInteger, "", "", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @43-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @43-B430AF44
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_docs_mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->mfi_docs_batch_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->PAGE_COUNT->Errors->Count());
        $errors = ($errors || $this->Sum_PAGE_COUNT1->Errors->Count());
        $errors = ($errors || $this->Sum_PAGE_COUNT->Errors->Count());
        $errors = ($errors || $this->mfi_docs_mfi_doc_region1->Errors->Count());
        $errors = ($errors || $this->TotalSum_PAGE_COUNT->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDate->Errors->Count());
        $errors = ($errors || $this->Report_CurrentPage->Errors->Count());
        $errors = ($errors || $this->Report_TotalPages->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @43-4370A650
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_docs_mfi_doc_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_docs_batch_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PAGE_COUNT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_PAGE_COUNT1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_PAGE_COUNT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_docs_mfi_doc_region1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_PAGE_COUNT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentPage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_TotalPages->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @43-21D3583B
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_mfi_docs_mfi_doc_region"] = CCGetFromGet("s_mfi_docs_mfi_doc_region", NULL);
        $this->DataSource->Parameters["urls_mfi_docs_batch_code"] = CCGetFromGet("s_mfi_docs_batch_code", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $mfi_docs_mfi_doc_regionKey = "";
        $mfi_docs_batch_codeKey = "";
        $Groups = new clsGroupsCollectionmfi_docs($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->mfi_docs_mfi_doc_region->SetValue($this->DataSource->mfi_docs_mfi_doc_region->GetValue());
            $this->mfi_docs_batch_code->SetValue($this->DataSource->mfi_docs_batch_code->GetValue());
            $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
            $this->PAGE_COUNT->SetValue($this->DataSource->PAGE_COUNT->GetValue());
            $this->Sum_PAGE_COUNT1->SetValue($this->DataSource->Sum_PAGE_COUNT1->GetValue());
            $this->Sum_PAGE_COUNT->SetValue($this->DataSource->Sum_PAGE_COUNT->GetValue());
            $this->mfi_docs_mfi_doc_region1->SetValue($this->DataSource->mfi_docs_mfi_doc_region1->GetValue());
            $this->TotalSum_PAGE_COUNT->SetValue($this->DataSource->TotalSum_PAGE_COUNT->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $mfi_docs_mfi_doc_regionKey != $this->DataSource->f("mfi_docs_mfi_doc_region")) {
                $Groups->OpenGroup("mfi_docs_mfi_doc_region");
            } elseif ($mfi_docs_batch_codeKey != $this->DataSource->f("mfi_docs_batch_code")) {
                $Groups->OpenGroup("mfi_docs_batch_code");
            }
            $Groups->AddItem();
            $mfi_docs_mfi_doc_regionKey = $this->DataSource->f("mfi_docs_mfi_doc_region");
            $mfi_docs_batch_codeKey = $this->DataSource->f("mfi_docs_batch_code");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $mfi_docs_mfi_doc_regionKey != $this->DataSource->f("mfi_docs_mfi_doc_region")) {
                $Groups->CloseGroup("mfi_docs_mfi_doc_region");
            } elseif ($mfi_docs_batch_codeKey != $this->DataSource->f("mfi_docs_batch_code")) {
                $Groups->CloseGroup("mfi_docs_batch_code");
            }
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
            $this->ControlsVisible["mfi_docs_mfi_doc_region"] = $this->mfi_docs_mfi_doc_region->Visible;
            $this->ControlsVisible["mfi_docs_batch_code"] = $this->mfi_docs_batch_code->Visible;
            $this->ControlsVisible["mfi_doc_type"] = $this->mfi_doc_type->Visible;
            $this->ControlsVisible["PAGE_COUNT"] = $this->PAGE_COUNT->Visible;
            $this->ControlsVisible["Sum_PAGE_COUNT1"] = $this->Sum_PAGE_COUNT1->Visible;
            $this->ControlsVisible["Sum_PAGE_COUNT"] = $this->Sum_PAGE_COUNT->Visible;
            $this->ControlsVisible["mfi_docs_mfi_doc_region1"] = $this->mfi_docs_mfi_doc_region1->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->mfi_doc_type->SetValue($items[$i]->mfi_doc_type);
                        $this->mfi_doc_type->Attributes->RestoreFromArray($items[$i]->_mfi_doc_typeAttributes);
                        $this->PAGE_COUNT->SetValue($items[$i]->PAGE_COUNT);
                        $this->PAGE_COUNT->Attributes->RestoreFromArray($items[$i]->_PAGE_COUNTAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->mfi_doc_type->Show();
                        $this->PAGE_COUNT->Show();
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
                            $this->TotalSum_PAGE_COUNT->SetValue($items[$i]->TotalSum_PAGE_COUNT);
                            $this->TotalSum_PAGE_COUNT->Attributes->RestoreFromArray($items[$i]->_TotalSum_PAGE_COUNTAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_PAGE_COUNT->Show();
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
                            $this->Report_CurrentDate->SetValue(CCFormatDate(CCGetDateArray(), $this->Report_CurrentDate->Format));
                            $this->Report_CurrentDate->Attributes->RestoreFromArray($items[$i]->_Report_CurrentDateAttributes);
                            $this->Report_CurrentPage->SetValue($items[$i]->PageNumber);
                            $this->Report_CurrentPage->Attributes->RestoreFromArray($items[$i]->_Report_CurrentPageAttributes);
                            $this->Report_TotalPages->SetValue($Groups->TotalPages);
                            $this->Report_TotalPages->Attributes->RestoreFromArray($items[$i]->_Report_TotalPagesAttributes);
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode) && ($this->Navigator->TotalPages > 1);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->Report_CurrentDate->Show();
                                $this->Report_CurrentPage->Show();
                                $this->Report_TotalPages->Show();
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "mfi_docs_mfi_doc_region":
                        if ($items[$i]->Mode == 1) {
                            $this->mfi_docs_mfi_doc_region->SetValue($items[$i]->mfi_docs_mfi_doc_region);
                            $this->mfi_docs_mfi_doc_region->Attributes->RestoreFromArray($items[$i]->_mfi_docs_mfi_doc_regionAttributes);
                            $this->mfi_docs_mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->mfi_docs_mfi_doc_region_Header->CCSEvents, "BeforeShow", $this->mfi_docs_mfi_doc_region_Header);
                            if ($this->mfi_docs_mfi_doc_region_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_docs_mfi_doc_region_Header";
                                $this->Attributes->Show();
                                $this->mfi_docs_mfi_doc_region->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_docs_mfi_doc_region_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Sum_PAGE_COUNT->SetValue($items[$i]->Sum_PAGE_COUNT);
                            $this->Sum_PAGE_COUNT->Attributes->RestoreFromArray($items[$i]->_Sum_PAGE_COUNTAttributes);
                            $this->mfi_docs_mfi_doc_region1->SetValue($items[$i]->mfi_docs_mfi_doc_region1);
                            $this->mfi_docs_mfi_doc_region1->Attributes->RestoreFromArray($items[$i]->_mfi_docs_mfi_doc_region1Attributes);
                            $this->mfi_docs_mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->mfi_docs_mfi_doc_region_Footer->CCSEvents, "BeforeShow", $this->mfi_docs_mfi_doc_region_Footer);
                            if ($this->mfi_docs_mfi_doc_region_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_docs_mfi_doc_region_Footer";
                                $this->Sum_PAGE_COUNT->Show();
                                $this->mfi_docs_mfi_doc_region1->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_docs_mfi_doc_region_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "mfi_docs_batch_code":
                        if ($items[$i]->Mode == 1) {
                            $this->mfi_docs_batch_code->SetValue($items[$i]->mfi_docs_batch_code);
                            $this->mfi_docs_batch_code->Attributes->RestoreFromArray($items[$i]->_mfi_docs_batch_codeAttributes);
                            $this->mfi_docs_batch_code_Header->CCSEventResult = CCGetEvent($this->mfi_docs_batch_code_Header->CCSEvents, "BeforeShow", $this->mfi_docs_batch_code_Header);
                            if ($this->mfi_docs_batch_code_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_docs_batch_code_Header";
                                $this->Attributes->Show();
                                $this->mfi_docs_batch_code->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_docs_batch_code_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Sum_PAGE_COUNT1->SetValue($items[$i]->Sum_PAGE_COUNT1);
                            $this->Sum_PAGE_COUNT1->Attributes->RestoreFromArray($items[$i]->_Sum_PAGE_COUNT1Attributes);
                            $this->mfi_docs_batch_code_Footer->CCSEventResult = CCGetEvent($this->mfi_docs_batch_code_Footer->CCSEvents, "BeforeShow", $this->mfi_docs_batch_code_Footer);
                            if ($this->mfi_docs_batch_code_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_docs_batch_code_Footer";
                                $this->Sum_PAGE_COUNT1->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_docs_batch_code_Footer", true, "Section Detail");
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

} //End mfi_docs Class @43-FCB6E20C

class clsmfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_docsDataSource Class @43-BC5AABD7

//DataSource Variables @43-1BC270B3
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $mfi_docs_mfi_doc_region;
    public $mfi_docs_batch_code;
    public $mfi_doc_type;
    public $PAGE_COUNT;
    public $Sum_PAGE_COUNT1;
    public $Sum_PAGE_COUNT;
    public $mfi_docs_mfi_doc_region1;
    public $TotalSum_PAGE_COUNT;
//End DataSource Variables

//DataSourceClass_Initialize Event @43-6E28D812
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_docs";
        $this->Initialize();
        $this->mfi_docs_mfi_doc_region = new clsField("mfi_docs_mfi_doc_region", ccsText, "");
        
        $this->mfi_docs_batch_code = new clsField("mfi_docs_batch_code", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsText, "");
        
        $this->PAGE_COUNT = new clsField("PAGE_COUNT", ccsInteger, "");
        
        $this->Sum_PAGE_COUNT1 = new clsField("Sum_PAGE_COUNT1", ccsInteger, "");
        
        $this->Sum_PAGE_COUNT = new clsField("Sum_PAGE_COUNT", ccsInteger, "");
        
        $this->mfi_docs_mfi_doc_region1 = new clsField("mfi_docs_mfi_doc_region1", ccsText, "");
        
        $this->TotalSum_PAGE_COUNT = new clsField("TotalSum_PAGE_COUNT", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @43-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @43-07F71BCE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urls_mfi_docs_mfi_doc_region", ccsText, "", "", $this->Parameters["urls_mfi_docs_mfi_doc_region"], "", false);
        $this->wp->AddParameter("3", "urls_mfi_docs_batch_code", ccsText, "", "", $this->Parameters["urls_mfi_docs_batch_code"], "", false);
        $this->wp->Criterion[1] = "( mfi_doc_status='NUMBERED' or mfi_doc_status='DATA ENTRY' )";
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "mfi_doc_region", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "batch_code", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @43-DE4056DA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT mfi_docs.batch_code AS mfi_docs_batch_code, mfi_docs.mfi_doc_region AS mfi_docs_mfi_doc_region, mfi_doc_type, COUNT(*) AS PAGE_COUNT,\n\n" .
        "mfi_doc_id \n\n" .
        "FROM mfi_docs {SQL_Where}\n\n" .
        "GROUP BY mfi_doc_region, batch_code, mfi_doc_type {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "mfi_doc_region asc,batch_code asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @43-EA4A81B0
    function SetValues()
    {
        $this->mfi_docs_mfi_doc_region->SetDBValue($this->f("mfi_docs_mfi_doc_region"));
        $this->mfi_docs_batch_code->SetDBValue($this->f("mfi_docs_batch_code"));
        $this->mfi_doc_type->SetDBValue($this->f("mfi_doc_type"));
        $this->PAGE_COUNT->SetDBValue(trim($this->f("PAGE_COUNT")));
        $this->Sum_PAGE_COUNT1->SetDBValue(trim($this->f("PAGE_COUNT")));
        $this->Sum_PAGE_COUNT->SetDBValue(trim($this->f("PAGE_COUNT")));
        $this->mfi_docs_mfi_doc_region1->SetDBValue($this->f("mfi_docs_mfi_doc_region"));
        $this->TotalSum_PAGE_COUNT->SetDBValue(trim($this->f("PAGE_COUNT")));
    }
//End SetValues Method

} //End mfi_docsDataSource Class @43-FCB6E20C

class clsRecordmfi_docsSearch { //mfi_docsSearch Class @50-50AD3A7F

//Variables @50-9E315808

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

//Class_Initialize Event @50-7466C5BF
    function clsRecordmfi_docsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_docsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_docsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_mfi_docs_mfi_doc_region = new clsControl(ccsTextBox, "s_mfi_docs_mfi_doc_region", "s_mfi_docs_mfi_doc_region", ccsText, "", CCGetRequestParam("s_mfi_docs_mfi_doc_region", $Method, NULL), $this);
            $this->s_mfi_docs_batch_code = new clsControl(ccsTextBox, "s_mfi_docs_batch_code", "s_mfi_docs_batch_code", ccsText, "", CCGetRequestParam("s_mfi_docs_batch_code", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @50-EA8D3F68
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mfi_docs_mfi_doc_region->Validate() && $Validation);
        $Validation = ($this->s_mfi_docs_batch_code->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mfi_docs_mfi_doc_region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_docs_batch_code->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @50-1C998765
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mfi_docs_mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->s_mfi_docs_batch_code->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @50-C57C1C0F
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
        $Redirect = "PENDING_BATCHWISE.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "PENDING_BATCHWISE.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @50-ABB8E3EF
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_mfi_docs_mfi_doc_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_docs_batch_code->Errors->ToString());
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
        $this->s_mfi_docs_mfi_doc_region->Show();
        $this->s_mfi_docs_batch_code->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_docsSearch Class @50-FCB6E20C

//batch_details ReportGroup class @83-D7C47B62
class clsReportGroupbatch_details {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $mfi_doc_region, $_mfi_doc_regionAttributes;
    public $ca_alloted, $_ca_allotedAttributes;
    public $status, $_statusAttributes;
    public $batch_code, $_batch_codeAttributes;
    public $Report_CurrentDate, $_Report_CurrentDateAttributes;
    public $Report_CurrentPage, $_Report_CurrentPageAttributes;
    public $Report_TotalPages, $_Report_TotalPagesAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $mfi_doc_regionTotalIndex;
    public $batch_codeTotalIndex;

    function clsReportGroupbatch_details(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->mfi_doc_region = $this->Parent->mfi_doc_region->Value;
        $this->ca_alloted = $this->Parent->ca_alloted->Value;
        $this->status = $this->Parent->status->Value;
        $this->batch_code = $this->Parent->batch_code->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_mfi_doc_regionAttributes = $this->Parent->mfi_doc_region->Attributes->GetAsArray();
        $this->_ca_allotedAttributes = $this->Parent->ca_alloted->Attributes->GetAsArray();
        $this->_statusAttributes = $this->Parent->status->Attributes->GetAsArray();
        $this->_batch_codeAttributes = $this->Parent->batch_code->Attributes->GetAsArray();
        $this->_Report_CurrentDateAttributes = $this->Parent->Report_CurrentDate->Attributes->GetAsArray();
        $this->_Report_CurrentPageAttributes = $this->Parent->Report_CurrentPage->Attributes->GetAsArray();
        $this->_Report_TotalPagesAttributes = $this->Parent->Report_TotalPages->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->mfi_doc_region = $Header->mfi_doc_region;
        $Header->_mfi_doc_regionAttributes = $this->_mfi_doc_regionAttributes;
        $this->Parent->mfi_doc_region->Value = $Header->mfi_doc_region;
        $this->Parent->mfi_doc_region->Attributes->RestoreFromArray($Header->_mfi_doc_regionAttributes);
        $this->ca_alloted = $Header->ca_alloted;
        $Header->_ca_allotedAttributes = $this->_ca_allotedAttributes;
        $this->Parent->ca_alloted->Value = $Header->ca_alloted;
        $this->Parent->ca_alloted->Attributes->RestoreFromArray($Header->_ca_allotedAttributes);
        $this->status = $Header->status;
        $Header->_statusAttributes = $this->_statusAttributes;
        $this->Parent->status->Value = $Header->status;
        $this->Parent->status->Attributes->RestoreFromArray($Header->_statusAttributes);
        $this->batch_code = $Header->batch_code;
        $Header->_batch_codeAttributes = $this->_batch_codeAttributes;
        $this->Parent->batch_code->Value = $Header->batch_code;
        $this->Parent->batch_code->Attributes->RestoreFromArray($Header->_batch_codeAttributes);
    }
    function ChangeTotalControls() {
    }
}
//End batch_details ReportGroup class

//batch_details GroupsCollection class @83-4B1BD302
class clsGroupsCollectionbatch_details {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mmfi_doc_regionCurrentHeaderIndex;
    public $mbatch_codeCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionbatch_details(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mmfi_doc_regionCurrentHeaderIndex = 1;
        $this->mbatch_codeCurrentHeaderIndex = 2;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupbatch_details($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->mfi_doc_regionTotalIndex = $this->mmfi_doc_regionCurrentHeaderIndex;
        $group->batch_codeTotalIndex = $this->mbatch_codeCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->mfi_doc_region->Value = $this->Parent->mfi_doc_region->initialValue;
        $this->Parent->ca_alloted->Value = $this->Parent->ca_alloted->initialValue;
        $this->Parent->status->Value = $this->Parent->status->initialValue;
        $this->Parent->batch_code->Value = $this->Parent->batch_code->initialValue;
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
        if ($groupName == "mfi_doc_region") {
            $Groupmfi_doc_region = & $this->InitGroup(true);
            $this->Parent->mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_region_Header->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_region_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mfi_doc_region_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mfi_doc_region_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mfi_doc_region_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mfi_doc_region_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_region_Header->Height;
                $Groupmfi_doc_region->SetTotalControls("GetNextValue");
            $this->Parent->mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_region_Header->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_region_Header);
            $Groupmfi_doc_region->SetControls();
            $Groupmfi_doc_region->Mode = 1;
            $OpenFlag = true;
            $Groupmfi_doc_region->GroupType = "mfi_doc_region";
            $this->mmfi_doc_regionCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_doc_region;
        }
        if ($groupName == "batch_code" or $OpenFlag) {
            $Groupbatch_code = & $this->InitGroup(true);
            $this->Parent->batch_code_Header->CCSEventResult = CCGetEvent($this->Parent->batch_code_Header->CCSEvents, "OnInitialize", $this->Parent->batch_code_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->batch_code_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->batch_code_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->batch_code_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->batch_code_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->batch_code_Header->Height;
                $Groupbatch_code->SetTotalControls("GetNextValue");
            $this->Parent->batch_code_Header->CCSEventResult = CCGetEvent($this->Parent->batch_code_Header->CCSEvents, "OnCalculate", $this->Parent->batch_code_Header);
            $Groupbatch_code->SetControls();
            $Groupbatch_code->Mode = 1;
            $Groupbatch_code->GroupType = "batch_code";
            $this->mbatch_codeCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupbatch_code;
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
        $Groupbatch_code = & $this->InitGroup(true);
        $this->Parent->batch_code_Footer->CCSEventResult = CCGetEvent($this->Parent->batch_code_Footer->CCSEvents, "OnInitialize", $this->Parent->batch_code_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->batch_code_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->batch_code_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->batch_code_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupbatch_code->SetTotalControls("GetPrevValue");
        $Groupbatch_code->SyncWithHeader($this->Groups[$this->mbatch_codeCurrentHeaderIndex]);
        if ($this->Parent->batch_code_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->batch_code_Footer->Height;
        $this->Parent->batch_code_Footer->CCSEventResult = CCGetEvent($this->Parent->batch_code_Footer->CCSEvents, "OnCalculate", $this->Parent->batch_code_Footer);
        $Groupbatch_code->SetControls();
        $this->RestoreValues();
        $Groupbatch_code->Mode = 2;
        $Groupbatch_code->GroupType ="batch_code";
        $this->Groups[] = & $Groupbatch_code;
        if ($groupName == "batch_code") return;
        $Groupmfi_doc_region = & $this->InitGroup(true);
        $this->Parent->mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_region_Footer->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_region_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mfi_doc_region_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mfi_doc_region_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mfi_doc_region_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmfi_doc_region->SetTotalControls("GetPrevValue");
        $Groupmfi_doc_region->SyncWithHeader($this->Groups[$this->mmfi_doc_regionCurrentHeaderIndex]);
        if ($this->Parent->mfi_doc_region_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_region_Footer->Height;
        $this->Parent->mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_region_Footer->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_region_Footer);
        $Groupmfi_doc_region->SetControls();
        $this->RestoreValues();
        $Groupmfi_doc_region->Mode = 2;
        $Groupmfi_doc_region->GroupType ="mfi_doc_region";
        $this->Groups[] = & $Groupmfi_doc_region;
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
//End batch_details GroupsCollection class

class clsReportbatch_details { //batch_details Class @83-74D94C9A

//batch_details Variables @83-64FDA743

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
    public $mfi_doc_region_HeaderBlock, $mfi_doc_region_Header;
    public $mfi_doc_region_FooterBlock, $mfi_doc_region_Footer;
    public $batch_code_HeaderBlock, $batch_code_Header;
    public $batch_code_FooterBlock, $batch_code_Footer;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $mfi_doc_region_HeaderControls, $mfi_doc_region_FooterControls;
    public $batch_code_HeaderControls, $batch_code_FooterControls;
//End batch_details Variables

//Class_Initialize Event @83-C369204D
    function clsReportbatch_details($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "batch_details";
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
        $this->mfi_doc_region_Footer = new clsSection($this);
        $this->mfi_doc_region_Header = new clsSection($this);
        $this->mfi_doc_region_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_region_Header->Height);
        $this->batch_code_Footer = new clsSection($this);
        $this->batch_code_Header = new clsSection($this);
        $this->batch_code_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->batch_code_Header->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsbatch_detailsDataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 40;
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

        $this->mfi_doc_region = new clsControl(ccsReportLabel, "mfi_doc_region", "mfi_doc_region", ccsText, "", "", $this);
        $this->ca_alloted = new clsControl(ccsReportLabel, "ca_alloted", "ca_alloted", ccsText, "", "", $this);
        $this->status = new clsControl(ccsReportLabel, "status", "status", ccsText, "", "", $this);
        $this->batch_code = new clsControl(ccsReportLabel, "batch_code", "batch_code", ccsText, "", "", $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->Report_CurrentDate = new clsControl(ccsReportLabel, "Report_CurrentDate", "Report_CurrentDate", ccsText, array('ShortDate'), "", $this);
        $this->Report_CurrentPage = new clsControl(ccsReportLabel, "Report_CurrentPage", "Report_CurrentPage", ccsInteger, "", "", $this);
        $this->Report_TotalPages = new clsControl(ccsReportLabel, "Report_TotalPages", "Report_TotalPages", ccsInteger, "", "", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @83-6C59EE65
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = $this->PageSize;
        $this->DataSource->AbsolutePage = $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//CheckErrors Method @83-3724406E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->ca_alloted->Errors->Count());
        $errors = ($errors || $this->status->Errors->Count());
        $errors = ($errors || $this->batch_code->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDate->Errors->Count());
        $errors = ($errors || $this->Report_CurrentPage->Errors->Count());
        $errors = ($errors || $this->Report_TotalPages->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @83-FE1A1A72
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_doc_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ca_alloted->Errors->ToString());
        $errors = ComposeStrings($errors, $this->status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->batch_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentPage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_TotalPages->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @83-25B054F8
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_mfi_doc_region"] = CCGetFromGet("s_mfi_doc_region", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $mfi_doc_regionKey = "";
        $batch_codeKey = "";
        $Groups = new clsGroupsCollectionbatch_details($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
            $this->ca_alloted->SetValue($this->DataSource->ca_alloted->GetValue());
            $this->status->SetValue($this->DataSource->status->GetValue());
            $this->batch_code->SetValue($this->DataSource->batch_code->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->OpenGroup("mfi_doc_region");
            } elseif ($batch_codeKey != $this->DataSource->f("batch_code")) {
                $Groups->OpenGroup("batch_code");
            }
            $Groups->AddItem();
            $mfi_doc_regionKey = $this->DataSource->f("mfi_doc_region");
            $batch_codeKey = $this->DataSource->f("batch_code");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->CloseGroup("mfi_doc_region");
            } elseif ($batch_codeKey != $this->DataSource->f("batch_code")) {
                $Groups->CloseGroup("batch_code");
            }
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
            $this->ControlsVisible["mfi_doc_region"] = $this->mfi_doc_region->Visible;
            $this->ControlsVisible["ca_alloted"] = $this->ca_alloted->Visible;
            $this->ControlsVisible["status"] = $this->status->Visible;
            $this->ControlsVisible["batch_code"] = $this->batch_code->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->ca_alloted->SetValue($items[$i]->ca_alloted);
                        $this->ca_alloted->Attributes->RestoreFromArray($items[$i]->_ca_allotedAttributes);
                        $this->status->SetValue($items[$i]->status);
                        $this->status->Attributes->RestoreFromArray($items[$i]->_statusAttributes);
                        $this->batch_code->SetValue($items[$i]->batch_code);
                        $this->batch_code->Attributes->RestoreFromArray($items[$i]->_batch_codeAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->ca_alloted->Show();
                        $this->status->Show();
                        $this->batch_code->Show();
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
                            $this->Report_CurrentDate->SetValue(CCFormatDate(CCGetDateArray(), $this->Report_CurrentDate->Format));
                            $this->Report_CurrentDate->Attributes->RestoreFromArray($items[$i]->_Report_CurrentDateAttributes);
                            $this->Report_CurrentPage->SetValue($items[$i]->PageNumber);
                            $this->Report_CurrentPage->Attributes->RestoreFromArray($items[$i]->_Report_CurrentPageAttributes);
                            $this->Report_TotalPages->SetValue($Groups->TotalPages);
                            $this->Report_TotalPages->Attributes->RestoreFromArray($items[$i]->_Report_TotalPagesAttributes);
                            $this->Navigator->PageNumber = $items[$i]->PageNumber;
                            $this->Navigator->TotalPages = $Groups->TotalPages;
                            $this->Navigator->Visible = ("Print" != $this->ViewMode) && ($this->Navigator->TotalPages > 1);
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
                                $this->Report_CurrentDate->Show();
                                $this->Report_CurrentPage->Show();
                                $this->Report_TotalPages->Show();
                                $this->Navigator->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section Page_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "mfi_doc_region":
                        if ($items[$i]->Mode == 1) {
                            $this->mfi_doc_region->SetValue($items[$i]->mfi_doc_region);
                            $this->mfi_doc_region->Attributes->RestoreFromArray($items[$i]->_mfi_doc_regionAttributes);
                            $this->mfi_doc_region_Header->CCSEventResult = CCGetEvent($this->mfi_doc_region_Header->CCSEvents, "BeforeShow", $this->mfi_doc_region_Header);
                            if ($this->mfi_doc_region_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_region_Header";
                                $this->Attributes->Show();
                                $this->mfi_doc_region->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_region_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_region_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_region_Footer);
                            if ($this->mfi_doc_region_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_region_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_region_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "batch_code":
                        if ($items[$i]->Mode == 1) {
                            $this->batch_code_Header->CCSEventResult = CCGetEvent($this->batch_code_Header->CCSEvents, "BeforeShow", $this->batch_code_Header);
                            if ($this->batch_code_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section batch_code_Header";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section batch_code_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->batch_code_Footer->CCSEventResult = CCGetEvent($this->batch_code_Footer->CCSEvents, "BeforeShow", $this->batch_code_Footer);
                            if ($this->batch_code_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section batch_code_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section batch_code_Footer", true, "Section Detail");
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

} //End batch_details Class @83-FCB6E20C

class clsbatch_detailsDataSource extends clsDBmysql_cams_v2 {  //batch_detailsDataSource Class @83-0FDAE394

//DataSource Variables @83-0117D50B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $mfi_doc_region;
    public $ca_alloted;
    public $status;
    public $batch_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @83-EC095A9D
    function clsbatch_detailsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report batch_details";
        $this->Initialize();
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->ca_alloted = new clsField("ca_alloted", ccsText, "");
        
        $this->status = new clsField("status", ccsText, "");
        
        $this->batch_code = new clsField("batch_code", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @83-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @83-5A85ECDB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urls_mfi_doc_region", ccsText, "", "", $this->Parameters["urls_mfi_doc_region"], "", false);
        $this->wp->Criterion[1] = "( status='INCOMPLETE' OR status='NOT ALLOTED' )";
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "mfi_doc_region", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @83-E2B1CF60
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM batch_details {SQL_Where}\n\n" .
        "GROUP BY mfi_doc_region, batch_code {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "mfi_doc_region asc,batch_code asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @83-1FD35297
    function SetValues()
    {
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->ca_alloted->SetDBValue($this->f("ca_alloted"));
        $this->status->SetDBValue($this->f("status"));
        $this->batch_code->SetDBValue($this->f("batch_code"));
    }
//End SetValues Method

} //End batch_detailsDataSource Class @83-FCB6E20C

class clsRecordbatch_detailsSearch { //batch_detailsSearch Class @133-15643032

//Variables @133-9E315808

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

//Class_Initialize Event @133-63DBA846
    function clsRecordbatch_detailsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record batch_detailsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "batch_detailsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_mfi_doc_region = new clsControl(ccsTextBox, "s_mfi_doc_region", "s_mfi_doc_region", ccsText, "", CCGetRequestParam("s_mfi_doc_region", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @133-F6E66720
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mfi_doc_region->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mfi_doc_region->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @133-C279B255
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @133-C57C1C0F
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
        $Redirect = "PENDING_BATCHWISE.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "PENDING_BATCHWISE.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @133-D29E368B
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_mfi_doc_region->Errors->ToString());
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
        $this->s_mfi_doc_region->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End batch_detailsSearch Class @133-FCB6E20C









//Initialize Page @1-22A338BE
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
$TemplateFileName = "PENDING_BATCHWISE.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-EF813555
include_once("./PENDING_BATCHWISE_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-885DDCD8
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
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$mfi_docs = new clsReportmfi_docs("", $MainPage);
$mfi_docsSearch = new clsRecordmfi_docsSearch("", $MainPage);
$batch_details = new clsReportbatch_details("", $MainPage);
$batch_detailsSearch = new clsRecordbatch_detailsSearch("", $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incMenu = & $incMenu;
$MainPage->incFooter = & $incFooter;
$MainPage->mfi_docs = & $mfi_docs;
$MainPage->mfi_docsSearch = & $mfi_docsSearch;
$MainPage->batch_details = & $batch_details;
$MainPage->batch_detailsSearch = & $batch_detailsSearch;
$mfi_docs->Initialize();
$batch_details->Initialize();

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

//Execute Components @1-8C258652
$batch_detailsSearch->Operation();
$mfi_docsSearch->Operation();
$incFooter->Operations();
$incMenu->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-835336F1
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incMenu->Class_Terminate();
    unset($incMenu);
    $incFooter->Class_Terminate();
    unset($incFooter);
    unset($mfi_docs);
    unset($mfi_docsSearch);
    unset($batch_details);
    unset($batch_detailsSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2C203533
$incHeader->Show();
$incMenu->Show();
$incFooter->Show();
$mfi_docs->Show();
$mfi_docsSearch->Show();
$batch_details->Show();
$batch_detailsSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C61E43E4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incMenu->Class_Terminate();
unset($incMenu);
$incFooter->Class_Terminate();
unset($incFooter);
unset($mfi_docs);
unset($mfi_docsSearch);
unset($batch_details);
unset($batch_detailsSearch);
unset($Tpl);
//End Unload Page


?>
