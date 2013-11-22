<?php
//Include Common Files @1-1638FB30
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "NPS_RECEIPT.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//nps_master_camsdata123 ReportGroup class @2-CA60C6CE
class clsReportGroupnps_master_camsdata123 {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $region7, $_region7Attributes;
    public $region8, $_region8Attributes;
    public $TextBox3, $_TextBox3Attributes;
    public $bname2, $_bname2Attributes;
    public $group2, $_group2Attributes;
    public $centre2, $_centre2Attributes;
    public $village2, $_village2Attributes;
    public $region9, $_region9Attributes;
    public $region10, $_region10Attributes;
    public $TextBox4, $_TextBox4Attributes;
    public $bname3, $_bname3Attributes;
    public $group3, $_group3Attributes;
    public $centre3, $_centre3Attributes;
    public $village3, $_village3Attributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupnps_master_camsdata123(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->region7 = $this->Parent->region7->Value;
        $this->region8 = $this->Parent->region8->Value;
        $this->TextBox3 = $this->Parent->TextBox3->Value;
        $this->bname2 = $this->Parent->bname2->Value;
        $this->group2 = $this->Parent->group2->Value;
        $this->centre2 = $this->Parent->centre2->Value;
        $this->village2 = $this->Parent->village2->Value;
        $this->region9 = $this->Parent->region9->Value;
        $this->region10 = $this->Parent->region10->Value;
        $this->TextBox4 = $this->Parent->TextBox4->Value;
        $this->bname3 = $this->Parent->bname3->Value;
        $this->group3 = $this->Parent->group3->Value;
        $this->centre3 = $this->Parent->centre3->Value;
        $this->village3 = $this->Parent->village3->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_region7Attributes = $this->Parent->region7->Attributes->GetAsArray();
        $this->_region8Attributes = $this->Parent->region8->Attributes->GetAsArray();
        $this->_TextBox3Attributes = $this->Parent->TextBox3->Attributes->GetAsArray();
        $this->_bname2Attributes = $this->Parent->bname2->Attributes->GetAsArray();
        $this->_group2Attributes = $this->Parent->group2->Attributes->GetAsArray();
        $this->_centre2Attributes = $this->Parent->centre2->Attributes->GetAsArray();
        $this->_village2Attributes = $this->Parent->village2->Attributes->GetAsArray();
        $this->_region9Attributes = $this->Parent->region9->Attributes->GetAsArray();
        $this->_region10Attributes = $this->Parent->region10->Attributes->GetAsArray();
        $this->_TextBox4Attributes = $this->Parent->TextBox4->Attributes->GetAsArray();
        $this->_bname3Attributes = $this->Parent->bname3->Attributes->GetAsArray();
        $this->_group3Attributes = $this->Parent->group3->Attributes->GetAsArray();
        $this->_centre3Attributes = $this->Parent->centre3->Attributes->GetAsArray();
        $this->_village3Attributes = $this->Parent->village3->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->region7 = $Header->region7;
        $Header->_region7Attributes = $this->_region7Attributes;
        $this->Parent->region7->Value = $Header->region7;
        $this->Parent->region7->Attributes->RestoreFromArray($Header->_region7Attributes);
        $this->region8 = $Header->region8;
        $Header->_region8Attributes = $this->_region8Attributes;
        $this->Parent->region8->Value = $Header->region8;
        $this->Parent->region8->Attributes->RestoreFromArray($Header->_region8Attributes);
        $this->TextBox3 = $Header->TextBox3;
        $Header->_TextBox3Attributes = $this->_TextBox3Attributes;
        $this->Parent->TextBox3->Value = $Header->TextBox3;
        $this->Parent->TextBox3->Attributes->RestoreFromArray($Header->_TextBox3Attributes);
        $this->bname2 = $Header->bname2;
        $Header->_bname2Attributes = $this->_bname2Attributes;
        $this->Parent->bname2->Value = $Header->bname2;
        $this->Parent->bname2->Attributes->RestoreFromArray($Header->_bname2Attributes);
        $this->group2 = $Header->group2;
        $Header->_group2Attributes = $this->_group2Attributes;
        $this->Parent->group2->Value = $Header->group2;
        $this->Parent->group2->Attributes->RestoreFromArray($Header->_group2Attributes);
        $this->centre2 = $Header->centre2;
        $Header->_centre2Attributes = $this->_centre2Attributes;
        $this->Parent->centre2->Value = $Header->centre2;
        $this->Parent->centre2->Attributes->RestoreFromArray($Header->_centre2Attributes);
        $this->village2 = $Header->village2;
        $Header->_village2Attributes = $this->_village2Attributes;
        $this->Parent->village2->Value = $Header->village2;
        $this->Parent->village2->Attributes->RestoreFromArray($Header->_village2Attributes);
        $this->region9 = $Header->region9;
        $Header->_region9Attributes = $this->_region9Attributes;
        $this->Parent->region9->Value = $Header->region9;
        $this->Parent->region9->Attributes->RestoreFromArray($Header->_region9Attributes);
        $this->region10 = $Header->region10;
        $Header->_region10Attributes = $this->_region10Attributes;
        $this->Parent->region10->Value = $Header->region10;
        $this->Parent->region10->Attributes->RestoreFromArray($Header->_region10Attributes);
        $this->TextBox4 = $Header->TextBox4;
        $Header->_TextBox4Attributes = $this->_TextBox4Attributes;
        $this->Parent->TextBox4->Value = $Header->TextBox4;
        $this->Parent->TextBox4->Attributes->RestoreFromArray($Header->_TextBox4Attributes);
        $this->bname3 = $Header->bname3;
        $Header->_bname3Attributes = $this->_bname3Attributes;
        $this->Parent->bname3->Value = $Header->bname3;
        $this->Parent->bname3->Attributes->RestoreFromArray($Header->_bname3Attributes);
        $this->group3 = $Header->group3;
        $Header->_group3Attributes = $this->_group3Attributes;
        $this->Parent->group3->Value = $Header->group3;
        $this->Parent->group3->Attributes->RestoreFromArray($Header->_group3Attributes);
        $this->centre3 = $Header->centre3;
        $Header->_centre3Attributes = $this->_centre3Attributes;
        $this->Parent->centre3->Value = $Header->centre3;
        $this->Parent->centre3->Attributes->RestoreFromArray($Header->_centre3Attributes);
        $this->village3 = $Header->village3;
        $Header->_village3Attributes = $this->_village3Attributes;
        $this->Parent->village3->Value = $Header->village3;
        $this->Parent->village3->Attributes->RestoreFromArray($Header->_village3Attributes);
    }
    function ChangeTotalControls() {
    }
}
//End nps_master_camsdata123 ReportGroup class

//nps_master_camsdata123 GroupsCollection class @2-B0D1F0C2
class clsGroupsCollectionnps_master_camsdata123 {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionnps_master_camsdata123(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupnps_master_camsdata123($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->region7->Value = $this->Parent->region7->initialValue;
        $this->Parent->region8->Value = $this->Parent->region8->initialValue;
        $this->Parent->TextBox3->Value = $this->Parent->TextBox3->initialValue;
        $this->Parent->bname2->Value = $this->Parent->bname2->initialValue;
        $this->Parent->group2->Value = $this->Parent->group2->initialValue;
        $this->Parent->centre2->Value = $this->Parent->centre2->initialValue;
        $this->Parent->village2->Value = $this->Parent->village2->initialValue;
        $this->Parent->region9->Value = $this->Parent->region9->initialValue;
        $this->Parent->region10->Value = $this->Parent->region10->initialValue;
        $this->Parent->TextBox4->Value = $this->Parent->TextBox4->initialValue;
        $this->Parent->bname3->Value = $this->Parent->bname3->initialValue;
        $this->Parent->group3->Value = $this->Parent->group3->initialValue;
        $this->Parent->centre3->Value = $this->Parent->centre3->initialValue;
        $this->Parent->village3->Value = $this->Parent->village3->initialValue;
    }

    function OpenPage() {
        $this->TotalPages++;
        $Group = & $this->InitGroup();
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
            $Group->SetControls();
            $Group->Mode = 1;
            $Group->GroupType = "Report";
            $this->Groups[] = & $Group;
            $this->OpenPage();
        }
    }

    function ClosePage() {
        $Group = & $this->InitGroup();
        $Group->SetTotalControls("GetPrevValue");
        $Group->SyncWithHeader($this->Groups[$this->mPageCurrentHeaderIndex]);
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
            $Group->SetTotalControls("GetPrevValue");
            $Group->SyncWithHeader($this->Groups[0]);
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
//End nps_master_camsdata123 GroupsCollection class

class clsReportnps_master_camsdata123 { //nps_master_camsdata123 Class @2-8A74A7C4

//nps_master_camsdata123 Variables @2-DDFF83C0

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
    public $SorterName, $SorterDirection;

    public $ds;
    public $DataSource;
    public $UseClientPaging = false;

    //Report Controls
    public $StaticControls, $RowControls, $Report_FooterControls, $Report_HeaderControls;
    public $Page_FooterControls, $Page_HeaderControls;
//End nps_master_camsdata123 Variables

//Class_Initialize Event @2-3D161A53
    function clsReportnps_master_camsdata123($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "nps_master_camsdata123";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 8;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Errors = new clsErrors();
        $this->DataSource = new clsnps_master_camsdata123DataSource($this);
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

        $this->region7 = new clsControl(ccsReportLabel, "region7", "region7", ccsText, "", "", $this);
        $this->region8 = new clsControl(ccsReportLabel, "region8", "region8", ccsText, "", "", $this);
        $this->TextBox3 = new clsControl(ccsTextBox, "TextBox3", "TextBox3", ccsText, "", CCGetRequestParam("TextBox3", ccsGet, NULL), $this);
        $this->bname2 = new clsControl(ccsReportLabel, "bname2", "bname2", ccsText, "", "", $this);
        $this->group2 = new clsControl(ccsReportLabel, "group2", "group2", ccsText, "", "", $this);
        $this->centre2 = new clsControl(ccsReportLabel, "centre2", "centre2", ccsText, "", "", $this);
        $this->village2 = new clsControl(ccsReportLabel, "village2", "village2", ccsText, "", "", $this);
        $this->region9 = new clsControl(ccsReportLabel, "region9", "region9", ccsText, "", "", $this);
        $this->region10 = new clsControl(ccsReportLabel, "region10", "region10", ccsText, "", "", $this);
        $this->TextBox4 = new clsControl(ccsTextBox, "TextBox4", "TextBox4", ccsText, "", CCGetRequestParam("TextBox4", ccsGet, NULL), $this);
        $this->bname3 = new clsControl(ccsReportLabel, "bname3", "bname3", ccsText, "", "", $this);
        $this->group3 = new clsControl(ccsReportLabel, "group3", "group3", ccsText, "", "", $this);
        $this->centre3 = new clsControl(ccsReportLabel, "centre3", "centre3", ccsText, "", "", $this);
        $this->village3 = new clsControl(ccsReportLabel, "village3", "village3", ccsText, "", "", $this);
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

//CheckErrors Method @2-7E5524C0
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->region7->Errors->Count());
        $errors = ($errors || $this->region8->Errors->Count());
        $errors = ($errors || $this->TextBox3->Errors->Count());
        $errors = ($errors || $this->bname2->Errors->Count());
        $errors = ($errors || $this->group2->Errors->Count());
        $errors = ($errors || $this->centre2->Errors->Count());
        $errors = ($errors || $this->village2->Errors->Count());
        $errors = ($errors || $this->region9->Errors->Count());
        $errors = ($errors || $this->region10->Errors->Count());
        $errors = ($errors || $this->TextBox4->Errors->Count());
        $errors = ($errors || $this->bname3->Errors->Count());
        $errors = ($errors || $this->group3->Errors->Count());
        $errors = ($errors || $this->centre3->Errors->Count());
        $errors = ($errors || $this->village3->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-A521E7AF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->region7->Errors->ToString());
        $errors = ComposeStrings($errors, $this->region8->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextBox3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->bname2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->group2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->centre2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->village2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->region9->Errors->ToString());
        $errors = ComposeStrings($errors, $this->region10->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextBox4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->bname3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->group3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->centre3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->village3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-FE75DDC5
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urllano"] = CCGetFromGet("lano", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionnps_master_camsdata123($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->region7->SetValue($this->DataSource->region7->GetValue());
            $this->region8->SetValue($this->DataSource->region8->GetValue());
            $this->TextBox3->SetValue($this->DataSource->TextBox3->GetValue());
            $this->bname2->SetValue($this->DataSource->bname2->GetValue());
            $this->group2->SetValue($this->DataSource->group2->GetValue());
            $this->centre2->SetValue($this->DataSource->centre2->GetValue());
            $this->village2->SetValue($this->DataSource->village2->GetValue());
            $this->region9->SetValue($this->DataSource->region9->GetValue());
            $this->region10->SetValue($this->DataSource->region10->GetValue());
            $this->TextBox4->SetValue($this->DataSource->TextBox4->GetValue());
            $this->bname3->SetValue($this->DataSource->bname3->GetValue());
            $this->group3->SetValue($this->DataSource->group3->GetValue());
            $this->centre3->SetValue($this->DataSource->centre3->GetValue());
            $this->village3->SetValue($this->DataSource->village3->GetValue());
            if (count($Groups->Groups) == 0) $Groups->OpenGroup("Report");
            $Groups->AddItem();
            $is_next_record = $this->DataSource->next_record();
        }
        if (!count($Groups->Groups)) 
            $Groups->OpenGroup("Report");
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
            $this->ControlsVisible["region7"] = $this->region7->Visible;
            $this->ControlsVisible["region8"] = $this->region8->Visible;
            $this->ControlsVisible["TextBox3"] = $this->TextBox3->Visible;
            $this->ControlsVisible["bname2"] = $this->bname2->Visible;
            $this->ControlsVisible["group2"] = $this->group2->Visible;
            $this->ControlsVisible["centre2"] = $this->centre2->Visible;
            $this->ControlsVisible["village2"] = $this->village2->Visible;
            $this->ControlsVisible["region9"] = $this->region9->Visible;
            $this->ControlsVisible["region10"] = $this->region10->Visible;
            $this->ControlsVisible["TextBox4"] = $this->TextBox4->Visible;
            $this->ControlsVisible["bname3"] = $this->bname3->Visible;
            $this->ControlsVisible["group3"] = $this->group3->Visible;
            $this->ControlsVisible["centre3"] = $this->centre3->Visible;
            $this->ControlsVisible["village3"] = $this->village3->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->region7->SetValue($items[$i]->region7);
                        $this->region7->Attributes->RestoreFromArray($items[$i]->_region7Attributes);
                        $this->region8->SetValue($items[$i]->region8);
                        $this->region8->Attributes->RestoreFromArray($items[$i]->_region8Attributes);
                        $this->TextBox3->SetValue($items[$i]->TextBox3);
                        $this->TextBox3->Attributes->RestoreFromArray($items[$i]->_TextBox3Attributes);
                        $this->bname2->SetValue($items[$i]->bname2);
                        $this->bname2->Attributes->RestoreFromArray($items[$i]->_bname2Attributes);
                        $this->group2->SetValue($items[$i]->group2);
                        $this->group2->Attributes->RestoreFromArray($items[$i]->_group2Attributes);
                        $this->centre2->SetValue($items[$i]->centre2);
                        $this->centre2->Attributes->RestoreFromArray($items[$i]->_centre2Attributes);
                        $this->village2->SetValue($items[$i]->village2);
                        $this->village2->Attributes->RestoreFromArray($items[$i]->_village2Attributes);
                        $this->region9->SetValue($items[$i]->region9);
                        $this->region9->Attributes->RestoreFromArray($items[$i]->_region9Attributes);
                        $this->region10->SetValue($items[$i]->region10);
                        $this->region10->Attributes->RestoreFromArray($items[$i]->_region10Attributes);
                        $this->TextBox4->SetValue($items[$i]->TextBox4);
                        $this->TextBox4->Attributes->RestoreFromArray($items[$i]->_TextBox4Attributes);
                        $this->bname3->SetValue($items[$i]->bname3);
                        $this->bname3->Attributes->RestoreFromArray($items[$i]->_bname3Attributes);
                        $this->group3->SetValue($items[$i]->group3);
                        $this->group3->Attributes->RestoreFromArray($items[$i]->_group3Attributes);
                        $this->centre3->SetValue($items[$i]->centre3);
                        $this->centre3->Attributes->RestoreFromArray($items[$i]->_centre3Attributes);
                        $this->village3->SetValue($items[$i]->village3);
                        $this->village3->Attributes->RestoreFromArray($items[$i]->_village3Attributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->region7->Show();
                        $this->region8->Show();
                        $this->TextBox3->Show();
                        $this->bname2->Show();
                        $this->group2->Show();
                        $this->centre2->Show();
                        $this->village2->Show();
                        $this->region9->Show();
                        $this->region10->Show();
                        $this->TextBox4->Show();
                        $this->bname3->Show();
                        $this->group3->Show();
                        $this->centre3->Show();
                        $this->village3->Show();
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock;
                        if ($this->Detail->Visible)
                            $Tpl->parseto("Section Detail", true, "Section Detail");
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

} //End nps_master_camsdata123 Class @2-FCB6E20C

class clsnps_master_camsdata123DataSource extends clsDBmysql_cams_v2 {  //nps_master_camsdata123DataSource Class @2-F92F4ADC

//DataSource Variables @2-12C99D85
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $region7;
    public $region8;
    public $TextBox3;
    public $bname2;
    public $group2;
    public $centre2;
    public $village2;
    public $region9;
    public $region10;
    public $TextBox4;
    public $bname3;
    public $group3;
    public $centre3;
    public $village3;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-689762B5
    function clsnps_master_camsdata123DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report nps_master_camsdata123";
        $this->Initialize();
        $this->region7 = new clsField("region7", ccsText, "");
        
        $this->region8 = new clsField("region8", ccsText, "");
        
        $this->TextBox3 = new clsField("TextBox3", ccsText, "");
        
        $this->bname2 = new clsField("bname2", ccsText, "");
        
        $this->group2 = new clsField("group2", ccsText, "");
        
        $this->centre2 = new clsField("centre2", ccsText, "");
        
        $this->village2 = new clsField("village2", ccsText, "");
        
        $this->region9 = new clsField("region9", ccsText, "");
        
        $this->region10 = new clsField("region10", ccsText, "");
        
        $this->TextBox4 = new clsField("TextBox4", ccsText, "");
        
        $this->bname3 = new clsField("bname3", ccsText, "");
        
        $this->group3 = new clsField("group3", ccsText, "");
        
        $this->centre3 = new clsField("centre3", ccsText, "");
        
        $this->village3 = new clsField("village3", ccsText, "");
        

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

//Prepare Method @2-329EBC22
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urllano", ccsText, "", "", $this->Parameters["urllano"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "nps_master.lano", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),true);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-FF6FC898
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT GROUP_NAME, BORROWER_NAME, CENTER_NAME, camsdata123_grid.BRANCH, REGION, camsdata123_grid.VILLAGE, lano, LPAD(id,6,'0') AS recno \n\n" .
        "FROM nps_master INNER JOIN camsdata123_grid ON\n\n" .
        "nps_master.lano = camsdata123_grid.LA_NO {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-5D07825F
    function SetValues()
    {
        $this->region7->SetDBValue($this->f("REGION"));
        $this->region8->SetDBValue($this->f("BRANCH"));
        $this->TextBox3->SetDBValue($this->f("recno"));
        $this->bname2->SetDBValue($this->f("BORROWER_NAME"));
        $this->group2->SetDBValue($this->f("GROUP_NAME"));
        $this->centre2->SetDBValue($this->f("CENTER_NAME"));
        $this->village2->SetDBValue($this->f("VILLAGE"));
        $this->region9->SetDBValue($this->f("REGION"));
        $this->region10->SetDBValue($this->f("BRANCH"));
        $this->TextBox4->SetDBValue($this->f("recno"));
        $this->bname3->SetDBValue($this->f("BORROWER_NAME"));
        $this->group3->SetDBValue($this->f("GROUP_NAME"));
        $this->centre3->SetDBValue($this->f("CENTER_NAME"));
        $this->village3->SetDBValue($this->f("VILLAGE"));
    }
//End SetValues Method

} //End nps_master_camsdata123DataSource Class @2-FCB6E20C

//Initialize Page @1-D8E891BB
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
$TemplateFileName = "NPS_RECEIPT.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-BBC5BB3E
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$nps_master_camsdata123 = new clsReportnps_master_camsdata123("", $MainPage);
$MainPage->nps_master_camsdata123 = & $nps_master_camsdata123;
$nps_master_camsdata123->Initialize();

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

//Go to destination page @1-A473BC19
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($nps_master_camsdata123);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7D08566E
$nps_master_camsdata123->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B85732FF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($nps_master_camsdata123);
unset($Tpl);
//End Unload Page


?>
