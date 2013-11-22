<?php
//Include Common Files @1-ABD1DA5B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "sat_doc_mis_page.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

//mfi_doc_upload_mfi_docs ReportGroup class @2-764F1BEA
class clsReportGroupmfi_doc_upload_mfi_docs {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $mfi_doc_region, $_mfi_doc_regionAttributes;
    public $gp_code, $_gp_codeAttributes;
    public $mfi_doc_type, $_mfi_doc_typeAttributes;
    public $mfi_doc_territory_code, $_mfi_doc_territory_codeAttributes;
    public $Report_Row_Number, $_Report_Row_NumberAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $mfi_doc_regionTotalIndex;
    public $gp_codeTotalIndex;
    public $mfi_doc_typeTotalIndex;
    public $mfi_doc_territory_codeTotalIndex;

    function clsReportGroupmfi_doc_upload_mfi_docs(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->mfi_doc_region = $this->Parent->mfi_doc_region->Value;
        $this->gp_code = $this->Parent->gp_code->Value;
        $this->mfi_doc_type = $this->Parent->mfi_doc_type->Value;
        $this->mfi_doc_territory_code = $this->Parent->mfi_doc_territory_code->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetTotalValue($mode);
        $this->_mfi_doc_regionAttributes = $this->Parent->mfi_doc_region->Attributes->GetAsArray();
        $this->_gp_codeAttributes = $this->Parent->gp_code->Attributes->GetAsArray();
        $this->_mfi_doc_typeAttributes = $this->Parent->mfi_doc_type->Attributes->GetAsArray();
        $this->_mfi_doc_territory_codeAttributes = $this->Parent->mfi_doc_territory_code->Attributes->GetAsArray();
        $this->_Report_Row_NumberAttributes = $this->Parent->Report_Row_Number->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Report_Row_Number = $this->Report_Row_Number;
        $Header->_Report_Row_NumberAttributes = $this->_Report_Row_NumberAttributes;
        $this->mfi_doc_region = $Header->mfi_doc_region;
        $Header->_mfi_doc_regionAttributes = $this->_mfi_doc_regionAttributes;
        $this->Parent->mfi_doc_region->Value = $Header->mfi_doc_region;
        $this->Parent->mfi_doc_region->Attributes->RestoreFromArray($Header->_mfi_doc_regionAttributes);
        $this->gp_code = $Header->gp_code;
        $Header->_gp_codeAttributes = $this->_gp_codeAttributes;
        $this->Parent->gp_code->Value = $Header->gp_code;
        $this->Parent->gp_code->Attributes->RestoreFromArray($Header->_gp_codeAttributes);
        $this->mfi_doc_type = $Header->mfi_doc_type;
        $Header->_mfi_doc_typeAttributes = $this->_mfi_doc_typeAttributes;
        $this->Parent->mfi_doc_type->Value = $Header->mfi_doc_type;
        $this->Parent->mfi_doc_type->Attributes->RestoreFromArray($Header->_mfi_doc_typeAttributes);
        $this->mfi_doc_territory_code = $Header->mfi_doc_territory_code;
        $Header->_mfi_doc_territory_codeAttributes = $this->_mfi_doc_territory_codeAttributes;
        $this->Parent->mfi_doc_territory_code->Value = $Header->mfi_doc_territory_code;
        $this->Parent->mfi_doc_territory_code->Attributes->RestoreFromArray($Header->_mfi_doc_territory_codeAttributes);
    }
    function ChangeTotalControls() {
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetValue();
    }
}
//End mfi_doc_upload_mfi_docs ReportGroup class

//mfi_doc_upload_mfi_docs GroupsCollection class @2-8FD7D382
class clsGroupsCollectionmfi_doc_upload_mfi_docs {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mmfi_doc_regionCurrentHeaderIndex;
    public $mgp_codeCurrentHeaderIndex;
    public $mmfi_doc_typeCurrentHeaderIndex;
    public $mmfi_doc_territory_codeCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionmfi_doc_upload_mfi_docs(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mmfi_doc_regionCurrentHeaderIndex = 1;
        $this->mgp_codeCurrentHeaderIndex = 2;
        $this->mmfi_doc_typeCurrentHeaderIndex = 3;
        $this->mmfi_doc_territory_codeCurrentHeaderIndex = 4;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_doc_upload_mfi_docs($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->mfi_doc_regionTotalIndex = $this->mmfi_doc_regionCurrentHeaderIndex;
        $group->gp_codeTotalIndex = $this->mgp_codeCurrentHeaderIndex;
        $group->mfi_doc_typeTotalIndex = $this->mmfi_doc_typeCurrentHeaderIndex;
        $group->mfi_doc_territory_codeTotalIndex = $this->mmfi_doc_territory_codeCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->mfi_doc_region->Value = $this->Parent->mfi_doc_region->initialValue;
        $this->Parent->gp_code->Value = $this->Parent->gp_code->initialValue;
        $this->Parent->mfi_doc_type->Value = $this->Parent->mfi_doc_type->initialValue;
        $this->Parent->mfi_doc_territory_code->Value = $this->Parent->mfi_doc_territory_code->initialValue;
        $this->Parent->Report_Row_Number->Value = $this->Parent->Report_Row_Number->initialValue;
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
        if ($groupName == "gp_code" or $OpenFlag) {
            $Groupgp_code = & $this->InitGroup(true);
            $this->Parent->gp_code_Header->CCSEventResult = CCGetEvent($this->Parent->gp_code_Header->CCSEvents, "OnInitialize", $this->Parent->gp_code_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->gp_code_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->gp_code_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->gp_code_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->gp_code_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->gp_code_Header->Height;
                $Groupgp_code->SetTotalControls("GetNextValue");
            $this->Parent->gp_code_Header->CCSEventResult = CCGetEvent($this->Parent->gp_code_Header->CCSEvents, "OnCalculate", $this->Parent->gp_code_Header);
            $Groupgp_code->SetControls();
            $Groupgp_code->Mode = 1;
            $OpenFlag = true;
            $Groupgp_code->GroupType = "gp_code";
            $this->mgp_codeCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupgp_code;
        }
        if ($groupName == "mfi_doc_type" or $OpenFlag) {
            $Groupmfi_doc_type = & $this->InitGroup(true);
            $this->Parent->mfi_doc_type_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_type_Header->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_type_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mfi_doc_type_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mfi_doc_type_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mfi_doc_type_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mfi_doc_type_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_type_Header->Height;
                $Groupmfi_doc_type->SetTotalControls("GetNextValue");
            $this->Parent->mfi_doc_type_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_type_Header->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_type_Header);
            $Groupmfi_doc_type->SetControls();
            $Groupmfi_doc_type->Mode = 1;
            $OpenFlag = true;
            $Groupmfi_doc_type->GroupType = "mfi_doc_type";
            $this->mmfi_doc_typeCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_doc_type;
            $this->Parent->Report_Row_Number->Reset();
        }
        if ($groupName == "mfi_doc_territory_code" or $OpenFlag) {
            $Groupmfi_doc_territory_code = & $this->InitGroup(true);
            $this->Parent->mfi_doc_territory_code_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_territory_code_Header->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_territory_code_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mfi_doc_territory_code_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mfi_doc_territory_code_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mfi_doc_territory_code_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mfi_doc_territory_code_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_territory_code_Header->Height;
                $Groupmfi_doc_territory_code->SetTotalControls("GetNextValue");
            $this->Parent->mfi_doc_territory_code_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_territory_code_Header->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_territory_code_Header);
            $Groupmfi_doc_territory_code->SetControls();
            $Groupmfi_doc_territory_code->Mode = 1;
            $Groupmfi_doc_territory_code->GroupType = "mfi_doc_territory_code";
            $this->mmfi_doc_territory_codeCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_doc_territory_code;
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
        $Groupmfi_doc_territory_code = & $this->InitGroup(true);
        $this->Parent->mfi_doc_territory_code_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_territory_code_Footer->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_territory_code_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mfi_doc_territory_code_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mfi_doc_territory_code_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mfi_doc_territory_code_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmfi_doc_territory_code->SetTotalControls("GetPrevValue");
        $Groupmfi_doc_territory_code->SyncWithHeader($this->Groups[$this->mmfi_doc_territory_codeCurrentHeaderIndex]);
        if ($this->Parent->mfi_doc_territory_code_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_territory_code_Footer->Height;
        $this->Parent->mfi_doc_territory_code_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_territory_code_Footer->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_territory_code_Footer);
        $Groupmfi_doc_territory_code->SetControls();
        $this->RestoreValues();
        $Groupmfi_doc_territory_code->Mode = 2;
        $Groupmfi_doc_territory_code->GroupType ="mfi_doc_territory_code";
        $this->Groups[] = & $Groupmfi_doc_territory_code;
        if ($groupName == "mfi_doc_territory_code") return;
        $Groupmfi_doc_type = & $this->InitGroup(true);
        $this->Parent->mfi_doc_type_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_type_Footer->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_type_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mfi_doc_type_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mfi_doc_type_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mfi_doc_type_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmfi_doc_type->SetTotalControls("GetPrevValue");
        $Groupmfi_doc_type->SyncWithHeader($this->Groups[$this->mmfi_doc_typeCurrentHeaderIndex]);
        if ($this->Parent->mfi_doc_type_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_type_Footer->Height;
        $this->Parent->mfi_doc_type_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_type_Footer->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_type_Footer);
        $Groupmfi_doc_type->SetControls();
        $this->Parent->Report_Row_Number->Reset();
        $this->RestoreValues();
        $Groupmfi_doc_type->Mode = 2;
        $Groupmfi_doc_type->GroupType ="mfi_doc_type";
        $this->Groups[] = & $Groupmfi_doc_type;
        if ($groupName == "mfi_doc_type") return;
        $Groupgp_code = & $this->InitGroup(true);
        $this->Parent->gp_code_Footer->CCSEventResult = CCGetEvent($this->Parent->gp_code_Footer->CCSEvents, "OnInitialize", $this->Parent->gp_code_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->gp_code_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->gp_code_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->gp_code_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupgp_code->SetTotalControls("GetPrevValue");
        $Groupgp_code->SyncWithHeader($this->Groups[$this->mgp_codeCurrentHeaderIndex]);
        if ($this->Parent->gp_code_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->gp_code_Footer->Height;
        $this->Parent->gp_code_Footer->CCSEventResult = CCGetEvent($this->Parent->gp_code_Footer->CCSEvents, "OnCalculate", $this->Parent->gp_code_Footer);
        $Groupgp_code->SetControls();
        $this->RestoreValues();
        $Groupgp_code->Mode = 2;
        $Groupgp_code->GroupType ="gp_code";
        $this->Groups[] = & $Groupgp_code;
        if ($groupName == "gp_code") return;
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
//End mfi_doc_upload_mfi_docs GroupsCollection class

class clsReportmfi_doc_upload_mfi_docs { //mfi_doc_upload_mfi_docs Class @2-0431D1DF

//mfi_doc_upload_mfi_docs Variables @2-1CA44DAF

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
    public $gp_code_HeaderBlock, $gp_code_Header;
    public $gp_code_FooterBlock, $gp_code_Footer;
    public $mfi_doc_type_HeaderBlock, $mfi_doc_type_Header;
    public $mfi_doc_type_FooterBlock, $mfi_doc_type_Footer;
    public $mfi_doc_territory_code_HeaderBlock, $mfi_doc_territory_code_Header;
    public $mfi_doc_territory_code_FooterBlock, $mfi_doc_territory_code_Footer;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $mfi_doc_region_HeaderControls, $mfi_doc_region_FooterControls;
    public $gp_code_HeaderControls, $gp_code_FooterControls;
    public $mfi_doc_type_HeaderControls, $mfi_doc_type_FooterControls;
    public $mfi_doc_territory_code_HeaderControls, $mfi_doc_territory_code_FooterControls;
//End mfi_doc_upload_mfi_docs Variables

//Class_Initialize Event @2-8491F0A7
    function clsReportmfi_doc_upload_mfi_docs($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_doc_upload_mfi_docs";
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
        $this->gp_code_Footer = new clsSection($this);
        $this->gp_code_Header = new clsSection($this);
        $this->gp_code_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->gp_code_Header->Height);
        $this->mfi_doc_type_Footer = new clsSection($this);
        $this->mfi_doc_type_Header = new clsSection($this);
        $this->mfi_doc_type_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_type_Header->Height);
        $this->mfi_doc_territory_code_Footer = new clsSection($this);
        $this->mfi_doc_territory_code_Header = new clsSection($this);
        $this->mfi_doc_territory_code_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_territory_code_Header->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsmfi_doc_upload_mfi_docsDataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 500;
             else if ($PageSize == "0")
                $this->PageSize = 500;
             else 
                $this->PageSize = min(500, $PageSize);
        }
        $MinPageSize += $MaxSectionSize;
        if ($this->PageSize && $MinPageSize && $this->PageSize < $MinPageSize)
            $this->PageSize = $MinPageSize;
        $this->PageNumber = $this->ViewMode == "Print" ? 1 : intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0 ) {
            $this->PageNumber = 1;
        }

        $this->mfi_doc_region = new clsControl(ccsReportLabel, "mfi_doc_region", "mfi_doc_region", ccsText, "", "", $this);
        $this->gp_code = new clsControl(ccsReportLabel, "gp_code", "gp_code", ccsText, "", "", $this);
        $this->mfi_doc_type = new clsControl(ccsReportLabel, "mfi_doc_type", "mfi_doc_type", ccsText, "", "", $this);
        $this->mfi_doc_territory_code = new clsControl(ccsReportLabel, "mfi_doc_territory_code", "mfi_doc_territory_code", ccsText, "", "", $this);
        $this->Report_Row_Number = new clsControl(ccsReportLabel, "Report_Row_Number", "Report_Row_Number", ccsInteger, "", 0, $this);
        $this->Report_Row_Number->TotalFunction = "Count";
        $this->Report_Row_Number->IsEmptySource = true;
        $this->NoRecords = new clsPanel("NoRecords", $this);
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

//CheckErrors Method @2-20CA5C32
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->gp_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->Report_Row_Number->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-BB698461
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_doc_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gp_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_territory_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_Row_Number->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-30086AD8
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_gp_code"] = CCGetFromGet("s_gp_code", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_region"] = CCGetFromGet("s_mfi_doc_region", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $mfi_doc_regionKey = "";
        $gp_codeKey = "";
        $mfi_doc_typeKey = "";
        $mfi_doc_territory_codeKey = "";
        $Groups = new clsGroupsCollectionmfi_doc_upload_mfi_docs($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
            $this->gp_code->SetValue($this->DataSource->gp_code->GetValue());
            $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
            $this->mfi_doc_territory_code->SetValue($this->DataSource->mfi_doc_territory_code->GetValue());
            $this->Report_Row_Number->SetValue(1);
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->OpenGroup("mfi_doc_region");
            } elseif ($gp_codeKey != $this->DataSource->f("gp_code")) {
                $Groups->OpenGroup("gp_code");
            } elseif ($mfi_doc_typeKey != $this->DataSource->f("mfi_doc_type")) {
                $Groups->OpenGroup("mfi_doc_type");
            } elseif ($mfi_doc_territory_codeKey != $this->DataSource->f("mfi_doc_territory_code")) {
                $Groups->OpenGroup("mfi_doc_territory_code");
            }
            $Groups->AddItem();
            $mfi_doc_regionKey = $this->DataSource->f("mfi_doc_region");
            $gp_codeKey = $this->DataSource->f("gp_code");
            $mfi_doc_typeKey = $this->DataSource->f("mfi_doc_type");
            $mfi_doc_territory_codeKey = $this->DataSource->f("mfi_doc_territory_code");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->CloseGroup("mfi_doc_region");
            } elseif ($gp_codeKey != $this->DataSource->f("gp_code")) {
                $Groups->CloseGroup("gp_code");
            } elseif ($mfi_doc_typeKey != $this->DataSource->f("mfi_doc_type")) {
                $Groups->CloseGroup("mfi_doc_type");
            } elseif ($mfi_doc_territory_codeKey != $this->DataSource->f("mfi_doc_territory_code")) {
                $Groups->CloseGroup("mfi_doc_territory_code");
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
            $this->ControlsVisible["gp_code"] = $this->gp_code->Visible;
            $this->ControlsVisible["mfi_doc_type"] = $this->mfi_doc_type->Visible;
            $this->ControlsVisible["mfi_doc_territory_code"] = $this->mfi_doc_territory_code->Visible;
            $this->ControlsVisible["Report_Row_Number"] = $this->Report_Row_Number->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        if ($this->Detail->Visible) {
                            $this->Attributes->Show();
                            $Tpl->parseto("Section Detail", true, "Section Detail");
                        }
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
                    case "gp_code":
                        if ($items[$i]->Mode == 1) {
                            $this->gp_code->SetValue($items[$i]->gp_code);
                            $this->gp_code->Attributes->RestoreFromArray($items[$i]->_gp_codeAttributes);
                            $this->gp_code_Header->CCSEventResult = CCGetEvent($this->gp_code_Header->CCSEvents, "BeforeShow", $this->gp_code_Header);
                            if ($this->gp_code_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section gp_code_Header";
                                $this->Attributes->Show();
                                $this->gp_code->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section gp_code_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->gp_code_Footer->CCSEventResult = CCGetEvent($this->gp_code_Footer->CCSEvents, "BeforeShow", $this->gp_code_Footer);
                            if ($this->gp_code_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section gp_code_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section gp_code_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "mfi_doc_type":
                        if ($items[$i]->Mode == 1) {
                            $this->mfi_doc_type->SetValue($items[$i]->mfi_doc_type);
                            $this->mfi_doc_type->Attributes->RestoreFromArray($items[$i]->_mfi_doc_typeAttributes);
                            $this->mfi_doc_type_Header->CCSEventResult = CCGetEvent($this->mfi_doc_type_Header->CCSEvents, "BeforeShow", $this->mfi_doc_type_Header);
                            if ($this->mfi_doc_type_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_type_Header";
                                $this->Attributes->Show();
                                $this->mfi_doc_type->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_type_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->mfi_doc_type_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_type_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_type_Footer);
                            if ($this->mfi_doc_type_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_type_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_type_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "mfi_doc_territory_code":
                        if ($items[$i]->Mode == 1) {
                            $this->mfi_doc_territory_code->SetValue($items[$i]->mfi_doc_territory_code);
                            $this->mfi_doc_territory_code->Attributes->RestoreFromArray($items[$i]->_mfi_doc_territory_codeAttributes);
                            $this->Report_Row_Number->SetValue($items[$i]->Report_Row_Number);
                            $this->Report_Row_Number->Attributes->RestoreFromArray($items[$i]->_Report_Row_NumberAttributes);
                            $this->mfi_doc_territory_code_Header->CCSEventResult = CCGetEvent($this->mfi_doc_territory_code_Header->CCSEvents, "BeforeShow", $this->mfi_doc_territory_code_Header);
                            if ($this->mfi_doc_territory_code_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_territory_code_Header";
                                $this->Attributes->Show();
                                $this->mfi_doc_territory_code->Show();
                                $this->Report_Row_Number->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_territory_code_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->mfi_doc_territory_code_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_territory_code_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_territory_code_Footer);
                            if ($this->mfi_doc_territory_code_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_territory_code_Footer";
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_territory_code_Footer", true, "Section Detail");
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

} //End mfi_doc_upload_mfi_docs Class @2-FCB6E20C

class clsmfi_doc_upload_mfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_doc_upload_mfi_docsDataSource Class @2-68599498

//DataSource Variables @2-8F4BF54D
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $mfi_doc_region;
    public $gp_code;
    public $mfi_doc_type;
    public $mfi_doc_territory_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EAA15987
    function clsmfi_doc_upload_mfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_doc_upload_mfi_docs";
        $this->Initialize();
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->gp_code = new clsField("gp_code", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsText, "");
        
        $this->mfi_doc_territory_code = new clsField("mfi_doc_territory_code", ccsText, "");
        

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

//Prepare Method @2-604B2185
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urls_gp_code", ccsText, "", "", $this->Parameters["urls_gp_code"], "", false);
        $this->wp->AddParameter("3", "urls_mfi_doc_region", ccsText, "", "", $this->Parameters["urls_mfi_doc_region"], "", false);
        $this->wp->Criterion[1] = "( mfi_doc_type not like 'INV%' )";
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "gp_code", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "mfi_doc_region", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-91885837
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT gp_code, mfi_doc_type, mfi_doc_region, mfi_doc_territory_code, mismatch_size \n\n" .
        "FROM mfi_docs INNER JOIN mfi_doc_upload ON\n\n" .
        "mfi_docs.batch_code = mfi_doc_upload.mfi_docs_batchcode AND mfi_doc_upload.file_uploaded = mfi_docs.mfi_doc_filename {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, "mfi_docs.mfi_doc_region asc,mfi_doc_upload.gp_code asc,mfi_docs.mfi_doc_type asc,mfi_docs.mfi_doc_territory_code asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-637FCF0A
    function SetValues()
    {
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->gp_code->SetDBValue($this->f("gp_code"));
        $this->mfi_doc_type->SetDBValue($this->f("mfi_doc_type"));
        $this->mfi_doc_territory_code->SetDBValue($this->f("mfi_doc_territory_code"));
    }
//End SetValues Method

} //End mfi_doc_upload_mfi_docsDataSource Class @2-FCB6E20C

class clsRecordmfi_docs_mfi_doc_upload { //mfi_docs_mfi_doc_upload Class @41-7076FD3F

//Variables @41-9E315808

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

//Class_Initialize Event @41-EC287354
    function clsRecordmfi_docs_mfi_doc_upload($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_docs_mfi_doc_upload/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_docs_mfi_doc_upload";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_gp_code = new clsControl(ccsTextBox, "s_gp_code", $CCSLocales->GetText("gp_code"), ccsText, "", CCGetRequestParam("s_gp_code", $Method, NULL), $this);
            $this->s_mfi_doc_region = new clsControl(ccsTextBox, "s_mfi_doc_region", $CCSLocales->GetText("mfi_doc_region"), ccsText, "", CCGetRequestParam("s_mfi_doc_region", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @41-AEEEE18A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_gp_code->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_region->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_gp_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_region->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @41-56841D4C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_gp_code->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @41-A2E233FC
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
        $Redirect = "sat_doc_mis_page.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "sat_doc_mis_page.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @41-587FD7E4
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
            $Error = ComposeStrings($Error, $this->s_gp_code->Errors->ToString());
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
        $this->s_gp_code->Show();
        $this->s_mfi_doc_region->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_docs_mfi_doc_upload Class @41-FCB6E20C

//Initialize Page @1-37851768
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
$TemplateFileName = "sat_doc_mis_page.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-EB5400F4
include_once("./sat_doc_mis_page_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-125366F7
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_doc_upload_mfi_docs = new clsReportmfi_doc_upload_mfi_docs("", $MainPage);
$mfi_docs_mfi_doc_upload = new clsRecordmfi_docs_mfi_doc_upload("", $MainPage);
$MainPage->mfi_doc_upload_mfi_docs = & $mfi_doc_upload_mfi_docs;
$MainPage->mfi_docs_mfi_doc_upload = & $mfi_docs_mfi_doc_upload;
$mfi_doc_upload_mfi_docs->Initialize();

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

//Execute Components @1-C0E341E5
$mfi_docs_mfi_doc_upload->Operation();
//End Execute Components

//Go to destination page @1-27E627BE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_doc_upload_mfi_docs);
    unset($mfi_docs_mfi_doc_upload);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-77F02E9E
$mfi_doc_upload_mfi_docs->Show();
$mfi_docs_mfi_doc_upload->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C949F3B5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_doc_upload_mfi_docs);
unset($mfi_docs_mfi_doc_upload);
unset($Tpl);
//End Unload Page


?>
