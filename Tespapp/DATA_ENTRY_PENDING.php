<?php
//Include Common Files @1-E3CE5321
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "DATA_ENTRY_PENDING.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//mfi_docs ReportGroup class @2-12A4D1CC
class clsReportGroupmfi_docs {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $mfi_doc_region, $_mfi_doc_regionAttributes;
    public $mfi_doc_type, $_mfi_doc_typeAttributes;
    public $Expr1, $_Expr1Attributes;
    public $Sum_Expr1, $_Sum_Expr1Attributes;
    public $TotalSum_Expr1, $_TotalSum_Expr1Attributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $mfi_doc_regionTotalIndex;

    function clsReportGroupmfi_docs(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->mfi_doc_region = $this->Parent->mfi_doc_region->Value;
        $this->mfi_doc_type = $this->Parent->mfi_doc_type->Value;
        $this->Expr1 = $this->Parent->Expr1->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Sum_Expr1 = $this->Parent->Sum_Expr1->GetTotalValue($mode);
        $this->TotalSum_Expr1 = $this->Parent->TotalSum_Expr1->GetTotalValue($mode);
        $this->_Sorter_mfi_doc_typeAttributes = $this->Parent->Sorter_mfi_doc_type->Attributes->GetAsArray();
        $this->_Sorter_Expr1Attributes = $this->Parent->Sorter_Expr1->Attributes->GetAsArray();
        $this->_mfi_doc_regionAttributes = $this->Parent->mfi_doc_region->Attributes->GetAsArray();
        $this->_mfi_doc_typeAttributes = $this->Parent->mfi_doc_type->Attributes->GetAsArray();
        $this->_Expr1Attributes = $this->Parent->Expr1->Attributes->GetAsArray();
        $this->_Sum_Expr1Attributes = $this->Parent->Sum_Expr1->Attributes->GetAsArray();
        $this->_TotalSum_Expr1Attributes = $this->Parent->TotalSum_Expr1->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Sum_Expr1 = $this->Sum_Expr1;
        $Header->_Sum_Expr1Attributes = $this->_Sum_Expr1Attributes;
        $Header->TotalSum_Expr1 = $this->TotalSum_Expr1;
        $Header->_TotalSum_Expr1Attributes = $this->_TotalSum_Expr1Attributes;
        $this->mfi_doc_region = $Header->mfi_doc_region;
        $Header->_mfi_doc_regionAttributes = $this->_mfi_doc_regionAttributes;
        $this->Parent->mfi_doc_region->Value = $Header->mfi_doc_region;
        $this->Parent->mfi_doc_region->Attributes->RestoreFromArray($Header->_mfi_doc_regionAttributes);
        $this->mfi_doc_type = $Header->mfi_doc_type;
        $Header->_mfi_doc_typeAttributes = $this->_mfi_doc_typeAttributes;
        $this->Parent->mfi_doc_type->Value = $Header->mfi_doc_type;
        $this->Parent->mfi_doc_type->Attributes->RestoreFromArray($Header->_mfi_doc_typeAttributes);
        $this->Expr1 = $Header->Expr1;
        $Header->_Expr1Attributes = $this->_Expr1Attributes;
        $this->Parent->Expr1->Value = $Header->Expr1;
        $this->Parent->Expr1->Attributes->RestoreFromArray($Header->_Expr1Attributes);
    }
    function ChangeTotalControls() {
        $this->Sum_Expr1 = $this->Parent->Sum_Expr1->GetValue();
        $this->TotalSum_Expr1 = $this->Parent->TotalSum_Expr1->GetValue();
    }
}
//End mfi_docs ReportGroup class

//mfi_docs GroupsCollection class @2-A3BB0CB7
class clsGroupsCollectionmfi_docs {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mmfi_doc_regionCurrentHeaderIndex;
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
        $this->mmfi_doc_regionCurrentHeaderIndex = 1;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_docs($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->mfi_doc_regionTotalIndex = $this->mmfi_doc_regionCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->mfi_doc_region->Value = $this->Parent->mfi_doc_region->initialValue;
        $this->Parent->mfi_doc_type->Value = $this->Parent->mfi_doc_type->initialValue;
        $this->Parent->Expr1->Value = $this->Parent->Expr1->initialValue;
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
            $Groupmfi_doc_region->GroupType = "mfi_doc_region";
            $this->mmfi_doc_regionCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_doc_region;
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
        $this->Parent->Sum_Expr1->Reset();
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
//End mfi_docs GroupsCollection class

class clsReportmfi_docs { //mfi_docs Class @2-B705B3B8

//mfi_docs Variables @2-F9E03918

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
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $mfi_doc_region_HeaderControls, $mfi_doc_region_FooterControls;
    public $Sorter_mfi_doc_type;
    public $Sorter_Expr1;
//End mfi_docs Variables

//Class_Initialize Event @2-C0413F56
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
        $this->mfi_doc_region_Footer = new clsSection($this);
        $this->mfi_doc_region_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_region_Footer->Height);
        $this->mfi_doc_region_Header = new clsSection($this);
        $this->mfi_doc_region_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_region_Header->Height);
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

        $this->Sorter_mfi_doc_type = new clsSorter($this->ComponentName, "Sorter_mfi_doc_type", $FileName, $this);
        $this->Sorter_Expr1 = new clsSorter($this->ComponentName, "Sorter_Expr1", $FileName, $this);
        $this->mfi_doc_region = new clsControl(ccsReportLabel, "mfi_doc_region", "mfi_doc_region", ccsText, "", "", $this);
        $this->mfi_doc_type = new clsControl(ccsReportLabel, "mfi_doc_type", "mfi_doc_type", ccsText, "", "", $this);
        $this->Expr1 = new clsControl(ccsReportLabel, "Expr1", "Expr1", ccsInteger, "", "", $this);
        $this->Sum_Expr1 = new clsControl(ccsReportLabel, "Sum_Expr1", "Sum_Expr1", ccsInteger, "", "", $this);
        $this->Sum_Expr1->TotalFunction = "Sum";
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->TotalSum_Expr1 = new clsControl(ccsReportLabel, "TotalSum_Expr1", "TotalSum_Expr1", ccsInteger, "", "", $this);
        $this->TotalSum_Expr1->TotalFunction = "Sum";
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

//CheckErrors Method @2-15F3C4E6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->Expr1->Errors->Count());
        $errors = ($errors || $this->Sum_Expr1->Errors->Count());
        $errors = ($errors || $this->TotalSum_Expr1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-433B74FC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_doc_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Sum_Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalSum_Expr1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-E61BAA05
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $mfi_doc_regionKey = "";
        $Groups = new clsGroupsCollectionmfi_docs($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
            $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
            $this->Expr1->SetValue($this->DataSource->Expr1->GetValue());
            $this->Sum_Expr1->SetValue($this->DataSource->Sum_Expr1->GetValue());
            $this->TotalSum_Expr1->SetValue($this->DataSource->TotalSum_Expr1->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->OpenGroup("mfi_doc_region");
            }
            $Groups->AddItem();
            $mfi_doc_regionKey = $this->DataSource->f("mfi_doc_region");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->CloseGroup("mfi_doc_region");
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
            $this->ControlsVisible["mfi_doc_type"] = $this->mfi_doc_type->Visible;
            $this->ControlsVisible["Expr1"] = $this->Expr1->Visible;
            $this->ControlsVisible["Sum_Expr1"] = $this->Sum_Expr1->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->mfi_doc_type->SetValue($items[$i]->mfi_doc_type);
                        $this->mfi_doc_type->Attributes->RestoreFromArray($items[$i]->_mfi_doc_typeAttributes);
                        $this->Expr1->SetValue($items[$i]->Expr1);
                        $this->Expr1->Attributes->RestoreFromArray($items[$i]->_Expr1Attributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->mfi_doc_type->Show();
                        $this->Expr1->Show();
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
                                $this->Sorter_mfi_doc_type->Show();
                                $this->Sorter_Expr1->Show();
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
                            $this->Sum_Expr1->SetValue($items[$i]->Sum_Expr1);
                            $this->Sum_Expr1->Attributes->RestoreFromArray($items[$i]->_Sum_Expr1Attributes);
                            $this->mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_region_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_region_Footer);
                            if ($this->mfi_doc_region_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_region_Footer";
                                $this->Sum_Expr1->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_region_Footer", true, "Section Detail");
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

//DataSource Variables @2-0AAFBC8F
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $mfi_doc_region;
    public $mfi_doc_type;
    public $Expr1;
    public $Sum_Expr1;
    public $TotalSum_Expr1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-189657DB
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_docs";
        $this->Initialize();
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsText, "");
        
        $this->Expr1 = new clsField("Expr1", ccsInteger, "");
        
        $this->Sum_Expr1 = new clsField("Sum_Expr1", ccsInteger, "");
        
        $this->TotalSum_Expr1 = new clsField("TotalSum_Expr1", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-477C7662
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mfi_doc_type" => array("mfi_doc_type", ""), 
            "Sorter_Expr1" => array("Expr1", "")));
    }
//End SetOrder Method

//Prepare Method @2-03DFDD05
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->Criterion[1] = "( mfi_doc_status='NUMBERED' or mfi_doc_status='DATA ENTRY' )";
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-77098CCA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT mfi_doc_region, mfi_doc_type, COUNT(*) AS Expr1, mfi_doc_id \n\n" .
        "FROM mfi_docs {SQL_Where}\n\n" .
        "GROUP BY mfi_doc_region, mfi_doc_type {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "mfi_doc_region asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C0AF93F0
    function SetValues()
    {
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->mfi_doc_type->SetDBValue($this->f("mfi_doc_type"));
        $this->Expr1->SetDBValue(trim($this->f("Expr1")));
        $this->Sum_Expr1->SetDBValue(trim($this->f("Expr1")));
        $this->TotalSum_Expr1->SetDBValue(trim($this->f("Expr1")));
    }
//End SetValues Method

} //End mfi_docsDataSource Class @2-FCB6E20C









//Initialize Page @1-54B25161
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
$TemplateFileName = "DATA_ENTRY_PENDING.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-3676308E
include_once("./DATA_ENTRY_PENDING_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D69F29EE
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_docs = new clsReportmfi_docs("", $MainPage);
$MainPage->mfi_docs = & $mfi_docs;
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

//Go to destination page @1-9D69B6C2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_docs);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-15F6F1DA
$mfi_docs->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4E09D87D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_docs);
unset($Tpl);
//End Unload Page


?>
