<?php
//Include Common Files @1-70327573
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "DOC_MIS_PAGE.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

//mfi_docs ReportGroup class @2-39FEEF6E
class clsReportGroupmfi_docs {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $mfi_doc_region, $_mfi_doc_regionAttributes;
    public $mfi_doc_filename, $_mfi_doc_filenameAttributes;
    public $mfi_doc_type, $_mfi_doc_typeAttributes;
    public $Report_Row_Number, $_Report_Row_NumberAttributes;
    public $mfi_doc_territory_code, $_mfi_doc_territory_codeAttributes;
    public $doc_rejection_reason, $_doc_rejection_reasonAttributes;
    public $GPNO, $_GPNOAttributes;
    public $Count_mfi_doc_territory_code2, $_Count_mfi_doc_territory_code2Attributes;
    public $Count_mfi_doc_territory_code1, $_Count_mfi_doc_territory_code1Attributes;
    public $Count_mfi_doc_territory_code, $_Count_mfi_doc_territory_codeAttributes;
    public $TotalCount_mfi_doc_territory_code, $_TotalCount_mfi_doc_territory_codeAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;
    public $mfi_doc_regionTotalIndex;
    public $mfi_doc_filenameTotalIndex;
    public $mfi_doc_typeTotalIndex;

    function clsReportGroupmfi_docs(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->mfi_doc_region = $this->Parent->mfi_doc_region->Value;
        $this->mfi_doc_filename = $this->Parent->mfi_doc_filename->Value;
        $this->mfi_doc_type = $this->Parent->mfi_doc_type->Value;
        $this->mfi_doc_territory_code = $this->Parent->mfi_doc_territory_code->Value;
        $this->doc_rejection_reason = $this->Parent->doc_rejection_reason->Value;
        $this->GPNO = $this->Parent->GPNO->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetTotalValue($mode);
        $this->Count_mfi_doc_territory_code2 = $this->Parent->Count_mfi_doc_territory_code2->GetTotalValue($mode);
        $this->Count_mfi_doc_territory_code1 = $this->Parent->Count_mfi_doc_territory_code1->GetTotalValue($mode);
        $this->Count_mfi_doc_territory_code = $this->Parent->Count_mfi_doc_territory_code->GetTotalValue($mode);
        $this->TotalCount_mfi_doc_territory_code = $this->Parent->TotalCount_mfi_doc_territory_code->GetTotalValue($mode);
        $this->_Sorter_mfi_doc_territory_codeAttributes = $this->Parent->Sorter_mfi_doc_territory_code->Attributes->GetAsArray();
        $this->_Sorter_doc_rejection_reasonAttributes = $this->Parent->Sorter_doc_rejection_reason->Attributes->GetAsArray();
        $this->_Sorter_GPNOAttributes = $this->Parent->Sorter_GPNO->Attributes->GetAsArray();
        $this->_mfi_doc_regionAttributes = $this->Parent->mfi_doc_region->Attributes->GetAsArray();
        $this->_mfi_doc_filenameAttributes = $this->Parent->mfi_doc_filename->Attributes->GetAsArray();
        $this->_mfi_doc_typeAttributes = $this->Parent->mfi_doc_type->Attributes->GetAsArray();
        $this->_Report_Row_NumberAttributes = $this->Parent->Report_Row_Number->Attributes->GetAsArray();
        $this->_mfi_doc_territory_codeAttributes = $this->Parent->mfi_doc_territory_code->Attributes->GetAsArray();
        $this->_doc_rejection_reasonAttributes = $this->Parent->doc_rejection_reason->Attributes->GetAsArray();
        $this->_GPNOAttributes = $this->Parent->GPNO->Attributes->GetAsArray();
        $this->_Count_mfi_doc_territory_code2Attributes = $this->Parent->Count_mfi_doc_territory_code2->Attributes->GetAsArray();
        $this->_Count_mfi_doc_territory_code1Attributes = $this->Parent->Count_mfi_doc_territory_code1->Attributes->GetAsArray();
        $this->_Count_mfi_doc_territory_codeAttributes = $this->Parent->Count_mfi_doc_territory_code->Attributes->GetAsArray();
        $this->_TotalCount_mfi_doc_territory_codeAttributes = $this->Parent->TotalCount_mfi_doc_territory_code->Attributes->GetAsArray();
        $this->_NavigatorAttributes = $this->Parent->Navigator->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $Header->Report_Row_Number = $this->Report_Row_Number;
        $Header->_Report_Row_NumberAttributes = $this->_Report_Row_NumberAttributes;
        $Header->Count_mfi_doc_territory_code2 = $this->Count_mfi_doc_territory_code2;
        $Header->_Count_mfi_doc_territory_code2Attributes = $this->_Count_mfi_doc_territory_code2Attributes;
        $Header->Count_mfi_doc_territory_code1 = $this->Count_mfi_doc_territory_code1;
        $Header->_Count_mfi_doc_territory_code1Attributes = $this->_Count_mfi_doc_territory_code1Attributes;
        $Header->Count_mfi_doc_territory_code = $this->Count_mfi_doc_territory_code;
        $Header->_Count_mfi_doc_territory_codeAttributes = $this->_Count_mfi_doc_territory_codeAttributes;
        $Header->TotalCount_mfi_doc_territory_code = $this->TotalCount_mfi_doc_territory_code;
        $Header->_TotalCount_mfi_doc_territory_codeAttributes = $this->_TotalCount_mfi_doc_territory_codeAttributes;
        $this->mfi_doc_region = $Header->mfi_doc_region;
        $Header->_mfi_doc_regionAttributes = $this->_mfi_doc_regionAttributes;
        $this->Parent->mfi_doc_region->Value = $Header->mfi_doc_region;
        $this->Parent->mfi_doc_region->Attributes->RestoreFromArray($Header->_mfi_doc_regionAttributes);
        $this->mfi_doc_filename = $Header->mfi_doc_filename;
        $Header->_mfi_doc_filenameAttributes = $this->_mfi_doc_filenameAttributes;
        $this->Parent->mfi_doc_filename->Value = $Header->mfi_doc_filename;
        $this->Parent->mfi_doc_filename->Attributes->RestoreFromArray($Header->_mfi_doc_filenameAttributes);
        $this->mfi_doc_type = $Header->mfi_doc_type;
        $Header->_mfi_doc_typeAttributes = $this->_mfi_doc_typeAttributes;
        $this->Parent->mfi_doc_type->Value = $Header->mfi_doc_type;
        $this->Parent->mfi_doc_type->Attributes->RestoreFromArray($Header->_mfi_doc_typeAttributes);
        $this->mfi_doc_territory_code = $Header->mfi_doc_territory_code;
        $Header->_mfi_doc_territory_codeAttributes = $this->_mfi_doc_territory_codeAttributes;
        $this->Parent->mfi_doc_territory_code->Value = $Header->mfi_doc_territory_code;
        $this->Parent->mfi_doc_territory_code->Attributes->RestoreFromArray($Header->_mfi_doc_territory_codeAttributes);
        $this->doc_rejection_reason = $Header->doc_rejection_reason;
        $Header->_doc_rejection_reasonAttributes = $this->_doc_rejection_reasonAttributes;
        $this->Parent->doc_rejection_reason->Value = $Header->doc_rejection_reason;
        $this->Parent->doc_rejection_reason->Attributes->RestoreFromArray($Header->_doc_rejection_reasonAttributes);
        $this->GPNO = $Header->GPNO;
        $Header->_GPNOAttributes = $this->_GPNOAttributes;
        $this->Parent->GPNO->Value = $Header->GPNO;
        $this->Parent->GPNO->Attributes->RestoreFromArray($Header->_GPNOAttributes);
    }
    function ChangeTotalControls() {
        $this->Report_Row_Number = $this->Parent->Report_Row_Number->GetValue();
        $this->Count_mfi_doc_territory_code2 = $this->Parent->Count_mfi_doc_territory_code2->GetValue();
        $this->Count_mfi_doc_territory_code1 = $this->Parent->Count_mfi_doc_territory_code1->GetValue();
        $this->Count_mfi_doc_territory_code = $this->Parent->Count_mfi_doc_territory_code->GetValue();
        $this->TotalCount_mfi_doc_territory_code = $this->Parent->TotalCount_mfi_doc_territory_code->GetValue();
    }
}
//End mfi_docs ReportGroup class

//mfi_docs GroupsCollection class @2-B0F42CA1
class clsGroupsCollectionmfi_docs {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $mmfi_doc_regionCurrentHeaderIndex;
    public $mmfi_doc_filenameCurrentHeaderIndex;
    public $mmfi_doc_typeCurrentHeaderIndex;
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
        $this->mmfi_doc_filenameCurrentHeaderIndex = 2;
        $this->mmfi_doc_typeCurrentHeaderIndex = 3;
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_docs($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        $group->mfi_doc_regionTotalIndex = $this->mmfi_doc_regionCurrentHeaderIndex;
        $group->mfi_doc_filenameTotalIndex = $this->mmfi_doc_filenameCurrentHeaderIndex;
        $group->mfi_doc_typeTotalIndex = $this->mmfi_doc_typeCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->mfi_doc_region->Value = $this->Parent->mfi_doc_region->initialValue;
        $this->Parent->mfi_doc_filename->Value = $this->Parent->mfi_doc_filename->initialValue;
        $this->Parent->mfi_doc_type->Value = $this->Parent->mfi_doc_type->initialValue;
        $this->Parent->Report_Row_Number->Value = $this->Parent->Report_Row_Number->initialValue;
        $this->Parent->mfi_doc_territory_code->Value = $this->Parent->mfi_doc_territory_code->initialValue;
        $this->Parent->doc_rejection_reason->Value = $this->Parent->doc_rejection_reason->initialValue;
        $this->Parent->GPNO->Value = $this->Parent->GPNO->initialValue;
        $this->Parent->Count_mfi_doc_territory_code2->Value = $this->Parent->Count_mfi_doc_territory_code2->initialValue;
        $this->Parent->Count_mfi_doc_territory_code1->Value = $this->Parent->Count_mfi_doc_territory_code1->initialValue;
        $this->Parent->Count_mfi_doc_territory_code->Value = $this->Parent->Count_mfi_doc_territory_code->initialValue;
        $this->Parent->TotalCount_mfi_doc_territory_code->Value = $this->Parent->TotalCount_mfi_doc_territory_code->initialValue;
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
            $this->Parent->Report_Row_Number->Reset();
            $this->Parent->Count_mfi_doc_territory_code->Reset();
        }
        if ($groupName == "mfi_doc_filename" or $OpenFlag) {
            $Groupmfi_doc_filename = & $this->InitGroup(true);
            $this->Parent->mfi_doc_filename_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_filename_Header->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_filename_Header);
            if ($this->Parent->Page_Footer->Visible) 
                $OverSize = $this->Parent->mfi_doc_filename_Header->Height + $this->Parent->Page_Footer->Height;
            else
                $OverSize = $this->Parent->mfi_doc_filename_Header->Height;
            if (($this->PageSize > 0) and $this->Parent->mfi_doc_filename_Header->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
                $this->ClosePage();
                $this->OpenPage();
            }
            if ($this->Parent->mfi_doc_filename_Header->Visible)
                $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_filename_Header->Height;
                $Groupmfi_doc_filename->SetTotalControls("GetNextValue");
            $this->Parent->mfi_doc_filename_Header->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_filename_Header->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_filename_Header);
            $Groupmfi_doc_filename->SetControls();
            $Groupmfi_doc_filename->Mode = 1;
            $OpenFlag = true;
            $Groupmfi_doc_filename->GroupType = "mfi_doc_filename";
            $this->mmfi_doc_filenameCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_doc_filename;
            $this->Parent->Count_mfi_doc_territory_code1->Reset();
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
            $Groupmfi_doc_type->GroupType = "mfi_doc_type";
            $this->mmfi_doc_typeCurrentHeaderIndex = count($this->Groups);
            $this->Groups[] = & $Groupmfi_doc_type;
            $this->Parent->Count_mfi_doc_territory_code2->Reset();
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
        $this->Parent->Count_mfi_doc_territory_code2->Reset();
        $this->RestoreValues();
        $Groupmfi_doc_type->Mode = 2;
        $Groupmfi_doc_type->GroupType ="mfi_doc_type";
        $this->Groups[] = & $Groupmfi_doc_type;
        if ($groupName == "mfi_doc_type") return;
        $Groupmfi_doc_filename = & $this->InitGroup(true);
        $this->Parent->mfi_doc_filename_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_filename_Footer->CCSEvents, "OnInitialize", $this->Parent->mfi_doc_filename_Footer);
        if ($this->Parent->Page_Footer->Visible) 
            $OverSize = $this->Parent->mfi_doc_filename_Footer->Height + $this->Parent->Page_Footer->Height;
        else
            $OverSize = $this->Parent->mfi_doc_filename_Footer->Height;
        if (($this->PageSize > 0) and $this->Parent->mfi_doc_filename_Footer->Visible and ($this->CurrentPageSize + $OverSize > $this->PageSize)) {
            $this->ClosePage();
            $this->OpenPage();
        }
        $Groupmfi_doc_filename->SetTotalControls("GetPrevValue");
        $Groupmfi_doc_filename->SyncWithHeader($this->Groups[$this->mmfi_doc_filenameCurrentHeaderIndex]);
        if ($this->Parent->mfi_doc_filename_Footer->Visible)
            $this->CurrentPageSize = $this->CurrentPageSize + $this->Parent->mfi_doc_filename_Footer->Height;
        $this->Parent->mfi_doc_filename_Footer->CCSEventResult = CCGetEvent($this->Parent->mfi_doc_filename_Footer->CCSEvents, "OnCalculate", $this->Parent->mfi_doc_filename_Footer);
        $Groupmfi_doc_filename->SetControls();
        $this->Parent->Count_mfi_doc_territory_code1->Reset();
        $this->RestoreValues();
        $Groupmfi_doc_filename->Mode = 2;
        $Groupmfi_doc_filename->GroupType ="mfi_doc_filename";
        $this->Groups[] = & $Groupmfi_doc_filename;
        if ($groupName == "mfi_doc_filename") return;
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
        $this->Parent->Report_Row_Number->Reset();
        $this->Parent->Count_mfi_doc_territory_code->Reset();
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

//mfi_docs Variables @2-5801780E

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
    public $mfi_doc_filename_HeaderBlock, $mfi_doc_filename_Header;
    public $mfi_doc_filename_FooterBlock, $mfi_doc_filename_Footer;
    public $mfi_doc_type_HeaderBlock, $mfi_doc_type_Header;
    public $mfi_doc_type_FooterBlock, $mfi_doc_type_Footer;
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
    public $mfi_doc_region_HeaderControls, $mfi_doc_region_FooterControls;
    public $mfi_doc_filename_HeaderControls, $mfi_doc_filename_FooterControls;
    public $mfi_doc_type_HeaderControls, $mfi_doc_type_FooterControls;
    public $Sorter_mfi_doc_territory_code;
    public $Sorter_doc_rejection_reason;
    public $Sorter_GPNO;
//End mfi_docs Variables

//Class_Initialize Event @2-764E992F
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
        $this->mfi_doc_filename_Footer = new clsSection($this);
        $this->mfi_doc_filename_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_filename_Footer->Height);
        $this->mfi_doc_filename_Header = new clsSection($this);
        $this->mfi_doc_filename_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_filename_Header->Height);
        $this->mfi_doc_type_Footer = new clsSection($this);
        $this->mfi_doc_type_Footer->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_type_Footer->Height);
        $this->mfi_doc_type_Header = new clsSection($this);
        $this->mfi_doc_type_Header->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->mfi_doc_type_Header->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsmfi_docsDataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 1000;
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

        $this->Sorter_mfi_doc_territory_code = new clsSorter($this->ComponentName, "Sorter_mfi_doc_territory_code", $FileName, $this);
        $this->Sorter_doc_rejection_reason = new clsSorter($this->ComponentName, "Sorter_doc_rejection_reason", $FileName, $this);
        $this->Sorter_GPNO = new clsSorter($this->ComponentName, "Sorter_GPNO", $FileName, $this);
        $this->mfi_doc_region = new clsControl(ccsReportLabel, "mfi_doc_region", "mfi_doc_region", ccsText, "", "", $this);
        $this->mfi_doc_filename = new clsControl(ccsReportLabel, "mfi_doc_filename", "mfi_doc_filename", ccsText, "", "", $this);
        $this->mfi_doc_type = new clsControl(ccsReportLabel, "mfi_doc_type", "mfi_doc_type", ccsInteger, "", "", $this);
        $this->Report_Row_Number = new clsControl(ccsReportLabel, "Report_Row_Number", "Report_Row_Number", ccsInteger, "", 0, $this);
        $this->Report_Row_Number->TotalFunction = "Count";
        $this->Report_Row_Number->IsEmptySource = true;
        $this->mfi_doc_territory_code = new clsControl(ccsReportLabel, "mfi_doc_territory_code", "mfi_doc_territory_code", ccsText, "", "", $this);
        $this->doc_rejection_reason = new clsControl(ccsReportLabel, "doc_rejection_reason", "doc_rejection_reason", ccsText, "", "", $this);
        $this->GPNO = new clsControl(ccsReportLabel, "GPNO", "GPNO", ccsText, "", "", $this);
        $this->Count_mfi_doc_territory_code2 = new clsControl(ccsReportLabel, "Count_mfi_doc_territory_code2", "Count_mfi_doc_territory_code2", ccsInteger, "", 0, $this);
        $this->Count_mfi_doc_territory_code2->TotalFunction = "Count";
        $this->Count_mfi_doc_territory_code2->IsEmptySource = true;
        $this->Count_mfi_doc_territory_code1 = new clsControl(ccsReportLabel, "Count_mfi_doc_territory_code1", "Count_mfi_doc_territory_code1", ccsInteger, "", 0, $this);
        $this->Count_mfi_doc_territory_code1->TotalFunction = "Count";
        $this->Count_mfi_doc_territory_code1->IsEmptySource = true;
        $this->Count_mfi_doc_territory_code = new clsControl(ccsReportLabel, "Count_mfi_doc_territory_code", "Count_mfi_doc_territory_code", ccsInteger, "", 0, $this);
        $this->Count_mfi_doc_territory_code->TotalFunction = "Count";
        $this->Count_mfi_doc_territory_code->IsEmptySource = true;
        $this->NoRecords = new clsPanel("NoRecords", $this);
        $this->TotalCount_mfi_doc_territory_code = new clsControl(ccsReportLabel, "TotalCount_mfi_doc_territory_code", "TotalCount_mfi_doc_territory_code", ccsInteger, "", 0, $this);
        $this->TotalCount_mfi_doc_territory_code->TotalFunction = "Count";
        $this->TotalCount_mfi_doc_territory_code->IsEmptySource = true;
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

//CheckErrors Method @2-50AF7C4A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->mfi_doc_filename->Errors->Count());
        $errors = ($errors || $this->mfi_doc_type->Errors->Count());
        $errors = ($errors || $this->Report_Row_Number->Errors->Count());
        $errors = ($errors || $this->mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->doc_rejection_reason->Errors->Count());
        $errors = ($errors || $this->GPNO->Errors->Count());
        $errors = ($errors || $this->Count_mfi_doc_territory_code2->Errors->Count());
        $errors = ($errors || $this->Count_mfi_doc_territory_code1->Errors->Count());
        $errors = ($errors || $this->Count_mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->TotalCount_mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-A020739F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_doc_region->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_filename->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Report_Row_Number->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_territory_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->doc_rejection_reason->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GPNO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Count_mfi_doc_territory_code2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Count_mfi_doc_territory_code1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Count_mfi_doc_territory_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalCount_mfi_doc_territory_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-D88EF8DF
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urls_mfi_doc_region"] = CCGetFromGet("s_mfi_doc_region", NULL);
        $this->DataSource->Parameters["urls_mfi_doc_territory_code"] = CCGetFromGet("s_mfi_doc_territory_code", NULL);
        $this->DataSource->Parameters["urls_doc_rejection_reason"] = CCGetFromGet("s_doc_rejection_reason", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $mfi_doc_regionKey = "";
        $mfi_doc_filenameKey = "";
        $mfi_doc_typeKey = "";
        $Groups = new clsGroupsCollectionmfi_docs($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->mfi_doc_region->SetValue($this->DataSource->mfi_doc_region->GetValue());
            $this->mfi_doc_filename->SetValue($this->DataSource->mfi_doc_filename->GetValue());
            $this->mfi_doc_type->SetValue($this->DataSource->mfi_doc_type->GetValue());
            $this->mfi_doc_territory_code->SetValue($this->DataSource->mfi_doc_territory_code->GetValue());
            $this->doc_rejection_reason->SetValue($this->DataSource->doc_rejection_reason->GetValue());
            $this->GPNO->SetValue($this->DataSource->GPNO->GetValue());
            $this->Report_Row_Number->SetValue(1);
            $this->Count_mfi_doc_territory_code2->SetValue(1);
            $this->Count_mfi_doc_territory_code1->SetValue(1);
            $this->Count_mfi_doc_territory_code->SetValue(1);
            $this->TotalCount_mfi_doc_territory_code->SetValue(1);
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            if (count($Groups->Groups) == 2 or $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->OpenGroup("mfi_doc_region");
            } elseif ($mfi_doc_filenameKey != $this->DataSource->f("substr(mfi_doc_filename,1,7)")) {
                $Groups->OpenGroup("mfi_doc_filename");
            } elseif ($mfi_doc_typeKey != $this->DataSource->f("mfi_doc_type")) {
                $Groups->OpenGroup("mfi_doc_type");
            }
            $Groups->AddItem();
            $mfi_doc_regionKey = $this->DataSource->f("mfi_doc_region");
            $mfi_doc_filenameKey = $this->DataSource->f("substr(mfi_doc_filename,1,7)");
            $mfi_doc_typeKey = $this->DataSource->f("mfi_doc_type");
            $is_next_record = $this->DataSource->next_record();
            if (!$is_next_record || $mfi_doc_regionKey != $this->DataSource->f("mfi_doc_region")) {
                $Groups->CloseGroup("mfi_doc_region");
            } elseif ($mfi_doc_filenameKey != $this->DataSource->f("substr(mfi_doc_filename,1,7)")) {
                $Groups->CloseGroup("mfi_doc_filename");
            } elseif ($mfi_doc_typeKey != $this->DataSource->f("mfi_doc_type")) {
                $Groups->CloseGroup("mfi_doc_type");
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
            $this->ControlsVisible["mfi_doc_filename"] = $this->mfi_doc_filename->Visible;
            $this->ControlsVisible["mfi_doc_type"] = $this->mfi_doc_type->Visible;
            $this->ControlsVisible["Report_Row_Number"] = $this->Report_Row_Number->Visible;
            $this->ControlsVisible["mfi_doc_territory_code"] = $this->mfi_doc_territory_code->Visible;
            $this->ControlsVisible["doc_rejection_reason"] = $this->doc_rejection_reason->Visible;
            $this->ControlsVisible["GPNO"] = $this->GPNO->Visible;
            $this->ControlsVisible["Count_mfi_doc_territory_code2"] = $this->Count_mfi_doc_territory_code2->Visible;
            $this->ControlsVisible["Count_mfi_doc_territory_code1"] = $this->Count_mfi_doc_territory_code1->Visible;
            $this->ControlsVisible["Count_mfi_doc_territory_code"] = $this->Count_mfi_doc_territory_code->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->Report_Row_Number->SetValue($items[$i]->Report_Row_Number);
                        $this->Report_Row_Number->Attributes->RestoreFromArray($items[$i]->_Report_Row_NumberAttributes);
                        $this->mfi_doc_territory_code->SetValue($items[$i]->mfi_doc_territory_code);
                        $this->mfi_doc_territory_code->Attributes->RestoreFromArray($items[$i]->_mfi_doc_territory_codeAttributes);
                        $this->doc_rejection_reason->SetValue($items[$i]->doc_rejection_reason);
                        $this->doc_rejection_reason->Attributes->RestoreFromArray($items[$i]->_doc_rejection_reasonAttributes);
                        $this->GPNO->SetValue($items[$i]->GPNO);
                        $this->GPNO->Attributes->RestoreFromArray($items[$i]->_GPNOAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->Report_Row_Number->Show();
                        $this->mfi_doc_territory_code->Show();
                        $this->doc_rejection_reason->Show();
                        $this->GPNO->Show();
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
                            $this->TotalCount_mfi_doc_territory_code->SetValue($items[$i]->TotalCount_mfi_doc_territory_code);
                            $this->TotalCount_mfi_doc_territory_code->Attributes->RestoreFromArray($items[$i]->_TotalCount_mfi_doc_territory_codeAttributes);
                            $this->Report_Footer->CCSEventResult = CCGetEvent($this->Report_Footer->CCSEvents, "BeforeShow", $this->Report_Footer);
                            if ($this->Report_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Report_Footer";
                                $this->NoRecords->Show();
                                $this->TotalCount_mfi_doc_territory_code->Show();
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
                                $this->Sorter_mfi_doc_territory_code->Show();
                                $this->Sorter_doc_rejection_reason->Show();
                                $this->Sorter_GPNO->Show();
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
                            $this->Count_mfi_doc_territory_code->SetValue($items[$i]->Count_mfi_doc_territory_code);
                            $this->Count_mfi_doc_territory_code->Attributes->RestoreFromArray($items[$i]->_Count_mfi_doc_territory_codeAttributes);
                            $this->mfi_doc_region_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_region_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_region_Footer);
                            if ($this->mfi_doc_region_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_region_Footer";
                                $this->Count_mfi_doc_territory_code->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_region_Footer", true, "Section Detail");
                            }
                        }
                        break;
                    case "mfi_doc_filename":
                        if ($items[$i]->Mode == 1) {
                            $this->mfi_doc_filename->SetValue($items[$i]->mfi_doc_filename);
                            $this->mfi_doc_filename->Attributes->RestoreFromArray($items[$i]->_mfi_doc_filenameAttributes);
                            $this->mfi_doc_filename_Header->CCSEventResult = CCGetEvent($this->mfi_doc_filename_Header->CCSEvents, "BeforeShow", $this->mfi_doc_filename_Header);
                            if ($this->mfi_doc_filename_Header->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_filename_Header";
                                $this->Attributes->Show();
                                $this->mfi_doc_filename->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_filename_Header", true, "Section Detail");
                            }
                        }
                        if ($items[$i]->Mode == 2) {
                            $this->Count_mfi_doc_territory_code1->SetValue($items[$i]->Count_mfi_doc_territory_code1);
                            $this->Count_mfi_doc_territory_code1->Attributes->RestoreFromArray($items[$i]->_Count_mfi_doc_territory_code1Attributes);
                            $this->mfi_doc_filename_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_filename_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_filename_Footer);
                            if ($this->mfi_doc_filename_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_filename_Footer";
                                $this->Count_mfi_doc_territory_code1->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_filename_Footer", true, "Section Detail");
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
                            $this->Count_mfi_doc_territory_code2->SetValue($items[$i]->Count_mfi_doc_territory_code2);
                            $this->Count_mfi_doc_territory_code2->Attributes->RestoreFromArray($items[$i]->_Count_mfi_doc_territory_code2Attributes);
                            $this->mfi_doc_type_Footer->CCSEventResult = CCGetEvent($this->mfi_doc_type_Footer->CCSEvents, "BeforeShow", $this->mfi_doc_type_Footer);
                            if ($this->mfi_doc_type_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section mfi_doc_type_Footer";
                                $this->Count_mfi_doc_territory_code2->Show();
                                $this->Attributes->Show();
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                                $Tpl->parseto("Section mfi_doc_type_Footer", true, "Section Detail");
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

//DataSource Variables @2-A2C81CFD
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $mfi_doc_region;
    public $mfi_doc_filename;
    public $mfi_doc_type;
    public $mfi_doc_territory_code;
    public $doc_rejection_reason;
    public $GPNO;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-8D598AE9
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_docs";
        $this->Initialize();
        $this->mfi_doc_region = new clsField("mfi_doc_region", ccsText, "");
        
        $this->mfi_doc_filename = new clsField("mfi_doc_filename", ccsText, "");
        
        $this->mfi_doc_type = new clsField("mfi_doc_type", ccsInteger, "");
        
        $this->mfi_doc_territory_code = new clsField("mfi_doc_territory_code", ccsText, "");
        
        $this->doc_rejection_reason = new clsField("doc_rejection_reason", ccsText, "");
        
        $this->GPNO = new clsField("GPNO", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-6C4F864A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_mfi_doc_territory_code" => array("mfi_doc_territory_code", ""), 
            "Sorter_doc_rejection_reason" => array("doc_rejection_reason", ""), 
            "Sorter_GPNO" => array("substr(mfi_doc_filename,1,7)", "")));
    }
//End SetOrder Method

//Prepare Method @2-2CDAE67B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_mfi_doc_region", ccsText, "", "", $this->Parameters["urls_mfi_doc_region"], "", false);
        $this->wp->AddParameter("2", "urls_mfi_doc_territory_code", ccsText, "", "", $this->Parameters["urls_mfi_doc_territory_code"], "", false);
        $this->wp->AddParameter("3", "urls_doc_rejection_reason", ccsText, "", "", $this->Parameters["urls_doc_rejection_reason"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "mfi_doc_region", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "mfi_doc_territory_code", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "doc_rejection_reason", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-B52B51DF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT mfi_doc_type, mfi_doc_filename, mfi_doc_region, mfi_doc_territory_code, doc_rejection_reason, substr(mfi_doc_filename,1,7) AS GPNO,\n\n" .
        "mfi_doc_id \n\n" .
        "FROM mfi_docs {SQL_Where}\n\n" .
        "GROUP BY mfi_doc_region {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, " asc,substr(mfi_doc_filename,1,7) asc, asc" .  ($this->Order ? ", " . $this->Order: "")));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-609CB35A
    function SetValues()
    {
        $this->mfi_doc_region->SetDBValue($this->f("mfi_doc_region"));
        $this->mfi_doc_filename->SetDBValue($this->f("mfi_doc_filename"));
        $this->mfi_doc_type->SetDBValue(trim($this->f("mfi_doc_type")));
        $this->mfi_doc_territory_code->SetDBValue($this->f("mfi_doc_territory_code"));
        $this->doc_rejection_reason->SetDBValue($this->f("doc_rejection_reason"));
        $this->GPNO->SetDBValue($this->f("GPNO"));
    }
//End SetValues Method

} //End mfi_docsDataSource Class @2-FCB6E20C

class clsRecordmfi_docsSearch { //mfi_docsSearch Class @44-50AD3A7F

//Variables @44-9E315808

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

//Class_Initialize Event @44-37E4CE75
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
            $this->s_mfi_doc_region = new clsControl(ccsTextBox, "s_mfi_doc_region", $CCSLocales->GetText("mfi_doc_region"), ccsText, "", CCGetRequestParam("s_mfi_doc_region", $Method, NULL), $this);
            $this->s_mfi_doc_territory_code = new clsControl(ccsTextBox, "s_mfi_doc_territory_code", $CCSLocales->GetText("mfi_doc_territory_code"), ccsText, "", CCGetRequestParam("s_mfi_doc_territory_code", $Method, NULL), $this);
            $this->s_doc_rejection_reason = new clsControl(ccsTextBox, "s_doc_rejection_reason", $CCSLocales->GetText("doc_rejection_reason"), ccsText, "", CCGetRequestParam("s_doc_rejection_reason", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @44-9498CB8B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_mfi_doc_region->Validate() && $Validation);
        $Validation = ($this->s_mfi_doc_territory_code->Validate() && $Validation);
        $Validation = ($this->s_doc_rejection_reason->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_mfi_doc_region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_mfi_doc_territory_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_doc_rejection_reason->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @44-1DC23A9D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_mfi_doc_region->Errors->Count());
        $errors = ($errors || $this->s_mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->s_doc_rejection_reason->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @44-115E2283
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
        $Redirect = "DOC_MIS_PAGE.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "DOC_MIS_PAGE.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @44-AF1F3319
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
            $Error = ComposeStrings($Error, $this->s_mfi_doc_region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_mfi_doc_territory_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_doc_rejection_reason->Errors->ToString());
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
        $this->s_mfi_doc_territory_code->Show();
        $this->s_doc_rejection_reason->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End mfi_docsSearch Class @44-FCB6E20C

//Initialize Page @1-41411135
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
$TemplateFileName = "DOC_MIS_PAGE.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8B221981
include_once("./DOC_MIS_PAGE_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0D5F334F
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
