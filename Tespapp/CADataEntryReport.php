<?php
//Include Common Files @1-372016CD
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "CADataEntryReport.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//mfi_docs ReportGroup class @2-6388AD3E
class clsReportGroupmfi_docs {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $mfi_doc_entered_by, $_mfi_doc_entered_byAttributes;
    public $Expr1, $_Expr1Attributes;
    public $ReportLabel1, $_ReportLabel1Attributes;
    public $Sum_Expr1, $_Sum_Expr1Attributes;
    public $TotalSum_Expr1, $_TotalSum_Expr1Attributes;
    public $Report_CurrentDate, $_Report_CurrentDateAttributes;
    public $Report_CurrentPage, $_Report_CurrentPageAttributes;
    public $Report_TotalPages, $_Report_TotalPagesAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $mfi_doc_entered_byTotalIndex;

    function clsReportGroupmfi_docs(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->mfi_doc_entered_by = $this->Parent->mfi_doc_entered_by->Value;
        $this->Expr1 = $this->Parent->Expr1->Value;
        $this->ReportLabel1 = $this->Parent->ReportLabel1->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Sum_Expr1 = $this->Parent->Sum_Expr1->GetTotalValue($mode);
        $this->TotalSum_Expr1 = $this->Parent->TotalSum_Expr1->GetTotalValue($mode);
        $this->_Sorter_Expr1Attributes = $this->Parent->Sorter_Expr1->Attributes->GetAsArray();
        $this->_mfi_doc_entered_byAttributes = $this->Parent->mfi_doc_entered_by->Attributes->GetAsArray();
        $this->_Expr1Attributes = $this->Parent->Expr1->Attributes->GetAsArray();
        $this->_ReportLabel1Attributes = $this->Parent->ReportLabel1->Attributes->GetAsArray();
        $this->_Sum_Expr1Attributes = $this->Parent->Sum_Expr1->Attributes->GetAsArray();
        $this->_TotalSum_Expr1Attributes = $this->Parent->TotalSum_Expr1->Attributes->GetAsArray();
        $this->_Report_CurrentDateAttributes = $this->Parent->Report_CurrentDate->Attributes->GetAsArray();
        $this->_Report_CurrentPageAttributes = $this->Parent->Report_CurrentPage->Attributes->GetAsArray();
        $this->_Report_TotalPagesAttributes = $this->Parent->Report_TotalPages->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Sum_Expr1 = $this->Sum_Expr1;
        $Header->_Sum_Expr1Attributes = $this->_Sum_Expr1Attributes;
        $Header->TotalSum_Expr1 = $this->TotalSum_Expr1;
        $Header->_TotalSum_Expr1Attributes = $this->_TotalSum_Expr1Attributes;
        $this->mfi_doc_entered_by = $Header->mfi_doc_entered_by;
        $Header->_mfi_doc_entered_byAttributes = $this->_mfi_doc_entered_byAttributes;
        $this->Parent->mfi_doc_entered_by->Value = $Header->mfi_doc_entered_by;
        $this->Parent->mfi_doc_entered_by->Attributes->RestoreFromArray($Header->_mfi_doc_entered_byAttributes);
        $this->Expr1 = $Header->Expr1;
        $Header->_Expr1Attributes = $this->_Expr1Attributes;
        $this->Parent->Expr1->Value = $Header->Expr1;
        $this->Parent->Expr1->Attributes->RestoreFromArray($Header->_Expr1Attributes);
        $this->ReportLabel1 = $Header->ReportLabel1;
        $Header->_ReportLabel1Attributes = $this->_ReportLabel1Attributes;
        $this->Parent->ReportLabel1->Value = $Header->ReportLabel1;
        $this->Parent->ReportLabel1->Attributes->RestoreFromArray($Header->_ReportLabel1Attributes);
    }
    function ChangeTotalControls() {
        $this->Sum_Expr1 = $this->Parent->Sum_Expr1->GetValue();
        $this->TotalSum_Expr1 = $this->Parent->TotalSum_Expr1->GetValue();
    }
}
//End mfi_docs ReportGroup class

//mfi_docs GroupsCollection class @2-A45E59E3
class clsGroupsCollectionmfi_docs {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mmfi_doc_entered_byCurrentHeaderIndex;
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
        $this->mmfi_doc_entered_byCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_docs($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->mfi_doc_entered_byTotalIndex = $this->mmfi_doc_entered_byCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->mfi_doc_entered_by->Value = $this->Parent->mfi_doc_entered_by->initialValue;
        $this->Parent->Expr1->Value = $this->Parent->Expr1->initialValue;
        $this->Parent->ReportLabel1->Value = $this->Parent->ReportLabel1->initialValue;
        $this->Parent->Sum_Expr1->Value = $this->Parent->Sum_Expr1->initialValue;
        $this->Parent->TotalSum_Expr1->Value = $this->Parent->TotalSum_Expr1->initialValue;
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
        if ($groupName == "mfi_doc_entered_by") {
            $Groupmfi_doc_entered_by = & $this->InitGroup(true);
            $this->Parent->mfi_doc_entered_by_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_entered_by_Header->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_entered_by_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mfi_doc_entered_by_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mfi_doc_entered_by_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mfi_doc_entered_by_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mfi_doc_entered_by_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_entered_by_Header->Height;
                $Groupmfi_doc_entered_by->SetTotalControls("GetNextValue");
            $this->Parent->mfi_doc_entered_by_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_entered_by_Header->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_entered_by_Header);
            $Groupmfi_doc_entered_by->SetControls();
            $Groupmfi_doc_entered_by->Mode = 1;
            $Groupmfi_doc_entered_by->GroupType = "mfi_doc_entered_by";
            $this->mmfi_doc_entered_byCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_doc_entered_by;
            $this->Parent->Sum_Expr1->Reset();
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
        $Groupmfi_doc_entered_by = & $this->InitGroup(true);
        $this->Parent->mfi_doc_entered_by_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_entered_by_Footer->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_entered_by_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mfi_doc_entered_by_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mfi_doc_entered_by_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mfi_doc_entered_by_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmfi_doc_entered_by->SetTotalControls("GetPrevValue");
        $Groupmfi_doc_entered_by->SyncWithHeader($this->Groups[$this->mmfi_doc_entered_byCurrentHeaderIndex]);
        if ($this->Parent->mfi_doc_entered_by_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_entered_by_Footer->Height;
        $this->Parent->mfi_doc_entered_by_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_entered_by_Footer->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_entered_by_Footer);
        $Groupmfi_doc_entered_by->SetControls();
        $this->Parent->Sum_Expr1->Reset();
        $this->RestoreValues();
        $Groupmfi_doc_entered_by->Mode = 2;
        $Groupmfi_doc_entered_by->GroupType ="mfi_doc_entered_by";
        $this->Groups[] = & $Groupmfi_doc_entered_by;
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

class clsReportmfi_docs { //mfi_docs Class @2-B705B3B8

//mfi_docs Variables @2-9FD51AD7

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
    public $mfi_doc_entered_by_HeaderBlock, $mfi_doc_entered_by_Header;
    public $mfi_doc_entered_by_FooterBlock, $mfi_doc_entered_by_Footer;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $mfi_doc_entered_by_HeaderControls, $mfi_doc_entered_by_FooterControls;
    public $Sorter_Expr1;
//End mfi_docs Variables

//Class_Initialize Event @2-EB20AA80
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
        $this->mfi_doc_entered_by_Footer = new clsSection($this);
        $this->mfi_doc_entered_by_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_entered_by_Footer->Height);
        $this->mfi_doc_entered_by_Header = new clsSection($this);
        $this->mfi_doc_entered_by_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_entered_by_Header->Height);
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
        $this->SorterName = CCGetParam("mfi_docsOrder", "");
        $this->SorterDirection = CCGetParam("mfi_docsDir", "");

        $this->Sorter_Expr1 = new clsSorter($this->ComponentName, "Sorter_Expr1", $FileName, $this);
        $this->mfi_doc_entered_by = new clsControl(ccsReportLabel, "mfi_doc_entered_by", "mfi_doc_entered_by", ccsText, "", "", $this);
        $this->Expr1 = new clsControl(ccsReportLabel, "Expr1", "Expr1", ccsInteger, "", "", $this);
        $this->ReportLabel1 = new clsControl(ccsReportLabel, "ReportLabel1", "ReportLabel1", ccsText, "", "", $this);
        $this->Sum_Expr1 = new clsControl(ccsReportLabel, "Sum_Expr1", "Sum_Expr1", ccsInteger, "", "", $this);
        $this->Sum_Expr1->TotalFunction = "Sum";
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->TotalSum_Expr1 = new clsControl(ccsReportLabel, "TotalSum_Expr1", "TotalSum_Expr1", ccsInteger, "", "", $this);
        $this->TotalSum_Expr1->TotalFunction = "Sum";
        $this->Report_CurrentDate = new clsControl(ccsReportLabel, "Report_CurrentDate", "Report_CurrentDate", ccsText, array('ShortDate'), "", $this);
        $this->Report_CurrentPage = new clsControl(ccsReportLabel, "Report_CurrentPage", "Report_CurrentPage", ccsInteger, "", "", $this);
        $this->Report_TotalPages = new clsControl(ccsReportLabel, "Report_TotalPages", "Report_TotalPages", ccsInteger, "", "", $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
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

//CheckErrors Method @2-B768D03F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_entered_by->Errors->Count());
        $errors = ($errors || $this->Expr1->Errors->Count());
        $errors = ($errors || $this->ReportLabel1->Errors->Count());
        $errors = ($errors || $this->Sum_Expr1->Errors->Count());
        $errors = ($errors || $this->TotalSum_Expr1->Errors->Count());
        $errors = ($errors || $this->Report_CurrentDate->Errors->Count());
        $errors = ($errors || $this->Report_CurrentPage->Errors->Count());
        $errors = ($errors || $this->Report_TotalPages->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-5EED125B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_doc_entered_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_CurrentPage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_TotalPages->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-82ACAF77
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_mfi_doc_entered_by"] = CCGetFromGet("s_mfi_doc_entered_by", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_entered_at"] = CCGetFromGet("s_mfi_doc_entered_at", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_entered_atfrm"] = CCGetFromGet("s_mfi_doc_entered_atfrm", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_entered_atto"] = CCGetFromGet("s_mfi_doc_entered_atto", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $mfi_doc_entered_byKey = "";
        $Groups = new clsGroupsCollectionmfi_docs($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->mfi_doc_entered_by->SetValue($this->DataSource->mfi_doc_entered_by->GetValue());
            $this->Expr1->SetValue($this->DataSource->Expr1->GetValue());
            $this->ReportLabel1->SetValue($this->DataSource->ReportLabel1->GetValue());
            $this->Sum_Expr1->SetValue($this->DataSource->Sum_Expr1->GetValue());
            $this->TotalSum_Expr1->SetValue($this->DataSource->TotalSum_Expr1->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $mfi_doc_entered_byKey != $this->DataSource->f("mfi_doc_entered_by")) {
                $Groups->OpenGroup("mfi_doc_entered_by");
            }
            $Groups->AddItem();
            $mfi_doc_entered_byKey = $this->DataSource->f("mfi_doc_entered_by");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $mfi_doc_entered_byKey != $this->DataSource->f("mfi_doc_entered_by")) {
                $Groups->CloseGroup("mfi_doc_entered_by");
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
            $this->ControlsVisible["mfi_doc_entered_by"] = $this->mfi_doc_entered_by->Visible;
            $this->ControlsVisible["Expr1"] = $this->Expr1->Visible;
            $this->ControlsVisible["ReportLabel1"] = $this->ReportLabel1->Visible;
            $this->ControlsVisible["Sum_Expr1"] = $this->Sum_Expr1->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->Expr1->SetValue($items[$i]->Expr1);
                        $this->Expr1->Attributes->RestoreFromArray($items[$i]->_Expr1Attributes);
                        $this->ReportLabel1->SetValue($items[$i]->ReportLabel1);
                        $this->ReportLabel1->Attributes->RestoreFromArray($items[$i]->_ReportLabel1Attributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->Expr1->Show();
                        $this->ReportLabel1->Show();
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
                            $this->TotalSum_Expr1->SetValue($items[$i]->TotalSum_Expr1);
                            $this->TotalSum_Expr1->Attributes->RestoreFromArray($items[$i]->_TotalSum_Expr1Attributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalSum_Expr1->Show();
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
                                $this->Sorter_Expr1->Show();
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
                    case "mfi_doc_entered_by":
                        if ($items[$i]->Mode == 1) {
                            $this->mfi_doc_entered_by->SetValue($items[$i]->mfi_doc_entered_by);
                            $this->mfi_doc_entered_by->Attributes->RestoreFromArray($items[$i]->_mfi_doc_entered_byAttributes);
                            $this->mfi_doc_entered_by_Header->CCSEventResult = CCGetEvent($this->mfi_doc_entered_by_Header->CCSEvents, "BeforeShow", $this->mfi_doc_entered_by_Header);
                            if ($this->mfi_doc_entered_by_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_entered_by_Header";
                                $this->Attributes->Show();
                                $this->mfi_doc_entered_by->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_entered_by_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Sum_Expr1->SetValue($items[$i]->Sum_Expr1);
                            $this->Sum_Expr1->Attributes->RestoreFromArray($items[$i]->_Sum_Expr1Attributes);
                            $this->mfi_doc_entered_by_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_entered_by_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_entered_by_Footer);
                            if ($this->mfi_doc_entered_by_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_entered_by_Footer";
                                $this->Sum_Expr1->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_entered_by_Footer", true, "Section Detail");
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

} //End mfi_docs Class @2-FCB6E20C

class clsmfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_docsDataSource Class @2-BC5AABD7

//DataSource Variables @2-67D91757
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $mfi_doc_entered_by;
    public $Expr1;
    public $ReportLabel1;
    public $Sum_Expr1;
    public $TotalSum_Expr1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-18C1C257
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_docs";
        $this->Initialize();
        $this->mfi_doc_entered_by = new clsField("mfi_doc_entered_by", ccsText, "");
        
        $this->Expr1 = new clsField("Expr1", ccsInteger, "");
        
        $this->ReportLabel1 = new clsField("ReportLabel1", ccsText, "");
        
        $this->Sum_Expr1 = new clsField("Sum_Expr1", ccsInteger, "");
        
        $this->TotalSum_Expr1 = new clsField("TotalSum_Expr1", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B0E7B06B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_Expr1" => array("Expr1", "")));
    }
//End SetOrder Method

//Prepare Method @2-46F25A34
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_mfi_doc_entered_by", ccsText, "", "", $this->Parameters["urls_mfi_doc_entered_by"], "", false);
        $this->wp->AddParameter("2", "urls_mfi_doc_entered_at", ccsText, "", "", $this->Parameters["urls_mfi_doc_entered_at"], "", false);
        $this->wp->AddParameter("3", "urls_mfi_doc_entered_atfrm", ccsText, "", "", $this->Parameters["urls_mfi_doc_entered_atfrm"], "", false);
        $this->wp->AddParameter("4", "urls_mfi_doc_entered_atto", ccsText, "", "", $this->Parameters["urls_mfi_doc_entered_atto"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "mfi_doc_entered_by", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "mfi_doc_entered_at", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opGreaterThanOrEqual, "mfi_doc_entered_at", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opLessThanOrEqual, "mfi_doc_entered_at", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = "( mfi_doc_type NOT LIKE 'KYC' )";
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), $this->wp->opAND(
             true, 
             $this->wp->Criterion[3], 
             $this->wp->Criterion[4])), 
             $this->wp->Criterion[5]);
    }
//End Prepare Method

//Open Method @2-4FFB206E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT mfi_doc_entered_by, mfi_doc_entered_at, mfi_doc_type, count(*) AS Expr1, mfi_doc_id \n\n" .
        "FROM mfi_docs {SQL_Where}\n\n" .
        "GROUP BY mfi_doc_entered_by, mfi_doc_type {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "mfi_doc_entered_by asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-7D93E9BC
    function SetValues()
    {
        $this->mfi_doc_entered_by->SetDBValue($this->f("mfi_doc_entered_by"));
        $this->Expr1->SetDBValue(trim($this->f("Expr1")));
        $this->ReportLabel1->SetDBValue($this->f("mfi_doc_type"));
        $this->Sum_Expr1->SetDBValue(trim($this->f("Expr1")));
        $this->TotalSum_Expr1->SetDBValue(trim($this->f("Expr1")));
    }
//End SetValues Method

} //End mfi_docsDataSource Class @2-FCB6E20C

class clsRecordmfi_docsSearch { //mfi_docsSearch Class @8-50AD3A7F

//Variables @8-9E315808

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

//Class_Initialize Event @8-4C6A9CAD
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
            $this->s_mfi_doc_entered_by = new clsControl(ccsTextBox, "s_mfi_doc_entered_by", "s_mfi_doc_entered_by", ccsText, "", CCGetRequestParam("s_mfi_doc_entered_by", $Method, NULL), $this);
            $this->s_mfi_doc_entered_at = new clsControl(ccsTextBox, "s_mfi_doc_entered_at", "s_mfi_doc_entered_at", ccsText, "", CCGetRequestParam("s_mfi_doc_entered_at", $Method, NULL), $this);
            $this->s_mfi_doc_entered_atfrm = new clsControl(ccsTextBox, "s_mfi_doc_entered_atfrm", "s_mfi_doc_entered_atfrm", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_mfi_doc_entered_atfrm", $Method, NULL), $this);
            $this->s_mfi_doc_entered_atto = new clsControl(ccsTextBox, "s_mfi_doc_entered_atto", "s_mfi_doc_entered_atto", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_mfi_doc_entered_atto", $Method, NULL), $this);
            $this->DatePicker_s_mfi_doc_entered_atfrm1 = new clsDatePicker("DatePicker_s_mfi_doc_entered_atfrm1", "mfi_docsSearch", "s_mfi_doc_entered_atfrm", $this);
            $this->DatePicker_s_mfi_doc_entered_atto1 = new clsDatePicker("DatePicker_s_mfi_doc_entered_atto1", "mfi_docsSearch", "s_mfi_doc_entered_atto", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @8-23D656D2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mfi_doc_entered_by->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_entered_at->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_entered_atfrm->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_entered_atto->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mfi_doc_entered_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_entered_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_entered_atfrm->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_entered_atto->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @8-8312141C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mfi_doc_entered_by->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_entered_at->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_entered_atfrm->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_entered_atto->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_mfi_doc_entered_atfrm1->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_mfi_doc_entered_atto1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @8-15C222FC
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
        $Redirect = "CADataEntryReport.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "CADataEntryReport.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @8-8CFA6540
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
            $Error = ComposeStrings($Error, $this->s_mfi_doc_entered_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_entered_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_entered_atfrm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_entered_atto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_mfi_doc_entered_atfrm1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_mfi_doc_entered_atto1->Errors->ToString());
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
        $this->s_mfi_doc_entered_by->Show();
        $this->s_mfi_doc_entered_at->Show();
        $this->s_mfi_doc_entered_atfrm->Show();
        $this->s_mfi_doc_entered_atto->Show();
        $this->DatePicker_s_mfi_doc_entered_atfrm1->Show();
        $this->DatePicker_s_mfi_doc_entered_atto1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_docsSearch Class @8-FCB6E20C

//Initialize Page @1-C12BA685
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
$TemplateFileName = "CADataEntryReport.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A3E7588E
include_once("./CADataEntryReport_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3DC045FD
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_docs = new clsReportmfi_docs("", $MainPage);
$mfi_docsSearch = new clsRecordmfi_docsSearch("", $MainPage);
$MainPage->mfi_docs = & $mfi_docs;
$MainPage->mfi_docsSearch = & $mfi_docsSearch;
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

//Execute Components @1-99235C90
$mfi_docsSearch->Operation();
//End Execute Components

//Go to destination page @1-70D2A103
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_docs);
    unset($mfi_docsSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7F4F4F61
$mfi_docs->Show();
$mfi_docsSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5F96CCD9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_docs);
unset($mfi_docsSearch);
unset($Tpl);
//End Unload Page


?>
