<?php
//Include Common Files @1-BA7293DF
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "tc_display_bor_inf.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//mfi_hvf1_mfi_hvf2 ReportGroup class @2-6B26F8FA
class clsReportGroupmfi_hvf1_mfi_hvf2 {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $mfi_hvf1_customer_name, $_mfi_hvf1_customer_nameAttributes;
    public $mfi_hvf1_customer_occupation, $_mfi_hvf1_customer_occupationAttributes;
    public $mfi_hvf1_customer_guarantor_occupation, $_mfi_hvf1_customer_guarantor_occupationAttributes;
    public $mfi_hvf2_customer_guarantor_name, $_mfi_hvf2_customer_guarantor_nameAttributes;
    public $mfi_hvf1_la_id, $_mfi_hvf1_la_idAttributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupmfi_hvf1_mfi_hvf2(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->mfi_hvf1_customer_name = $this->Parent->mfi_hvf1_customer_name->Value;
        $this->mfi_hvf1_customer_occupation = $this->Parent->mfi_hvf1_customer_occupation->Value;
        $this->mfi_hvf1_customer_guarantor_occupation = $this->Parent->mfi_hvf1_customer_guarantor_occupation->Value;
        $this->mfi_hvf2_customer_guarantor_name = $this->Parent->mfi_hvf2_customer_guarantor_name->Value;
        $this->mfi_hvf1_la_id = $this->Parent->mfi_hvf1_la_id->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_mfi_hvf1_customer_nameAttributes = $this->Parent->mfi_hvf1_customer_name->Attributes->GetAsArray();
        $this->_mfi_hvf1_customer_occupationAttributes = $this->Parent->mfi_hvf1_customer_occupation->Attributes->GetAsArray();
        $this->_mfi_hvf1_customer_guarantor_occupationAttributes = $this->Parent->mfi_hvf1_customer_guarantor_occupation->Attributes->GetAsArray();
        $this->_mfi_hvf2_customer_guarantor_nameAttributes = $this->Parent->mfi_hvf2_customer_guarantor_name->Attributes->GetAsArray();
        $this->_mfi_hvf1_la_idAttributes = $this->Parent->mfi_hvf1_la_id->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->mfi_hvf1_customer_name = $Header->mfi_hvf1_customer_name;
        $Header->_mfi_hvf1_customer_nameAttributes = $this->_mfi_hvf1_customer_nameAttributes;
        $this->Parent->mfi_hvf1_customer_name->Value = $Header->mfi_hvf1_customer_name;
        $this->Parent->mfi_hvf1_customer_name->Attributes->RestoreFromArray($Header->_mfi_hvf1_customer_nameAttributes);
        $this->mfi_hvf1_customer_occupation = $Header->mfi_hvf1_customer_occupation;
        $Header->_mfi_hvf1_customer_occupationAttributes = $this->_mfi_hvf1_customer_occupationAttributes;
        $this->Parent->mfi_hvf1_customer_occupation->Value = $Header->mfi_hvf1_customer_occupation;
        $this->Parent->mfi_hvf1_customer_occupation->Attributes->RestoreFromArray($Header->_mfi_hvf1_customer_occupationAttributes);
        $this->mfi_hvf1_customer_guarantor_occupation = $Header->mfi_hvf1_customer_guarantor_occupation;
        $Header->_mfi_hvf1_customer_guarantor_occupationAttributes = $this->_mfi_hvf1_customer_guarantor_occupationAttributes;
        $this->Parent->mfi_hvf1_customer_guarantor_occupation->Value = $Header->mfi_hvf1_customer_guarantor_occupation;
        $this->Parent->mfi_hvf1_customer_guarantor_occupation->Attributes->RestoreFromArray($Header->_mfi_hvf1_customer_guarantor_occupationAttributes);
        $this->mfi_hvf2_customer_guarantor_name = $Header->mfi_hvf2_customer_guarantor_name;
        $Header->_mfi_hvf2_customer_guarantor_nameAttributes = $this->_mfi_hvf2_customer_guarantor_nameAttributes;
        $this->Parent->mfi_hvf2_customer_guarantor_name->Value = $Header->mfi_hvf2_customer_guarantor_name;
        $this->Parent->mfi_hvf2_customer_guarantor_name->Attributes->RestoreFromArray($Header->_mfi_hvf2_customer_guarantor_nameAttributes);
        $this->mfi_hvf1_la_id = $Header->mfi_hvf1_la_id;
        $Header->_mfi_hvf1_la_idAttributes = $this->_mfi_hvf1_la_idAttributes;
        $this->Parent->mfi_hvf1_la_id->Value = $Header->mfi_hvf1_la_id;
        $this->Parent->mfi_hvf1_la_id->Attributes->RestoreFromArray($Header->_mfi_hvf1_la_idAttributes);
    }
    function ChangeTotalControls() {
    }
}
//End mfi_hvf1_mfi_hvf2 ReportGroup class

//mfi_hvf1_mfi_hvf2 GroupsCollection class @2-BDBF2164
class clsGroupsCollectionmfi_hvf1_mfi_hvf2 {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionmfi_hvf1_mfi_hvf2(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupmfi_hvf1_mfi_hvf2($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->mfi_hvf1_customer_name->Value = $this->Parent->mfi_hvf1_customer_name->initialValue;
        $this->Parent->mfi_hvf1_customer_occupation->Value = $this->Parent->mfi_hvf1_customer_occupation->initialValue;
        $this->Parent->mfi_hvf1_customer_guarantor_occupation->Value = $this->Parent->mfi_hvf1_customer_guarantor_occupation->initialValue;
        $this->Parent->mfi_hvf2_customer_guarantor_name->Value = $this->Parent->mfi_hvf2_customer_guarantor_name->initialValue;
        $this->Parent->mfi_hvf1_la_id->Value = $this->Parent->mfi_hvf1_la_id->initialValue;
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
//End mfi_hvf1_mfi_hvf2 GroupsCollection class

class clsReportmfi_hvf1_mfi_hvf2 { //mfi_hvf1_mfi_hvf2 Class @2-88D816CE

//mfi_hvf1_mfi_hvf2 Variables @2-944D286E

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
//End mfi_hvf1_mfi_hvf2 Variables

//Class_Initialize Event @2-64EA435D
    function clsReportmfi_hvf1_mfi_hvf2($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "mfi_hvf1_mfi_hvf2";
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
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->Errors = new clsErrors();
        $this->DataSource = new clsmfi_hvf1_mfi_hvf2DataSource($this);
        $this->ds = & $this->DataSource;
        $PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(is_numeric($PageSize) && $PageSize > 0) {
            $this->PageSize = $PageSize;
        } else {
            if (!is_numeric($PageSize) || $PageSize < 0)
                $this->PageSize = 20;
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

        $this->mfi_hvf1_customer_name = new clsControl(ccsReportLabel, "mfi_hvf1_customer_name", "mfi_hvf1_customer_name", ccsText, "", "", $this);
        $this->mfi_hvf1_customer_occupation = new clsControl(ccsReportLabel, "mfi_hvf1_customer_occupation", "mfi_hvf1_customer_occupation", ccsText, "", "", $this);
        $this->mfi_hvf1_customer_guarantor_occupation = new clsControl(ccsReportLabel, "mfi_hvf1_customer_guarantor_occupation", "mfi_hvf1_customer_guarantor_occupation", ccsText, "", "", $this);
        $this->mfi_hvf2_customer_guarantor_name = new clsControl(ccsReportLabel, "mfi_hvf2_customer_guarantor_name", "mfi_hvf2_customer_guarantor_name", ccsText, "", "", $this);
        $this->mfi_hvf1_la_id = new clsControl(ccsReportLabel, "mfi_hvf1_la_id", "mfi_hvf1_la_id", ccsText, "", "", $this);
        $this->NoRecords = new clsPanel("NoRecords", $this);
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

//CheckErrors Method @2-6BB42B69
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_hvf1_customer_name->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_occupation->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_customer_guarantor_occupation->Errors->Count());
        $errors = ($errors || $this->mfi_hvf2_customer_guarantor_name->Errors->Count());
        $errors = ($errors || $this->mfi_hvf1_la_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-7EC99551
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_occupation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_guarantor_occupation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_customer_guarantor_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_la_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-CACACF6A
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $ShownRecords = 0;

        $this->DataSource->Parameters["urlgp_id"] = CCGetFromGet("gp_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();

        $Groups = new clsGroupsCollectionmfi_hvf1_mfi_hvf2($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->mfi_hvf1_customer_name->SetValue($this->DataSource->mfi_hvf1_customer_name->GetValue());
            $this->mfi_hvf1_customer_occupation->SetValue($this->DataSource->mfi_hvf1_customer_occupation->GetValue());
            $this->mfi_hvf1_customer_guarantor_occupation->SetValue($this->DataSource->mfi_hvf1_customer_guarantor_occupation->GetValue());
            $this->mfi_hvf2_customer_guarantor_name->SetValue($this->DataSource->mfi_hvf2_customer_guarantor_name->GetValue());
            $this->mfi_hvf1_la_id->SetValue($this->DataSource->mfi_hvf1_la_id->GetValue());
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
            $this->ControlsVisible["mfi_hvf1_customer_name"] = $this->mfi_hvf1_customer_name->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_occupation"] = $this->mfi_hvf1_customer_occupation->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_guarantor_occupation"] = $this->mfi_hvf1_customer_guarantor_occupation->Visible;
            $this->ControlsVisible["mfi_hvf2_customer_guarantor_name"] = $this->mfi_hvf2_customer_guarantor_name->Visible;
            $this->ControlsVisible["mfi_hvf1_la_id"] = $this->mfi_hvf1_la_id->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->mfi_hvf1_customer_name->SetValue($items[$i]->mfi_hvf1_customer_name);
                        $this->mfi_hvf1_customer_name->Attributes->RestoreFromArray($items[$i]->_mfi_hvf1_customer_nameAttributes);
                        $this->mfi_hvf1_customer_occupation->SetValue($items[$i]->mfi_hvf1_customer_occupation);
                        $this->mfi_hvf1_customer_occupation->Attributes->RestoreFromArray($items[$i]->_mfi_hvf1_customer_occupationAttributes);
                        $this->mfi_hvf1_customer_guarantor_occupation->SetValue($items[$i]->mfi_hvf1_customer_guarantor_occupation);
                        $this->mfi_hvf1_customer_guarantor_occupation->Attributes->RestoreFromArray($items[$i]->_mfi_hvf1_customer_guarantor_occupationAttributes);
                        $this->mfi_hvf2_customer_guarantor_name->SetValue($items[$i]->mfi_hvf2_customer_guarantor_name);
                        $this->mfi_hvf2_customer_guarantor_name->Attributes->RestoreFromArray($items[$i]->_mfi_hvf2_customer_guarantor_nameAttributes);
                        $this->mfi_hvf1_la_id->SetValue($items[$i]->mfi_hvf1_la_id);
                        $this->mfi_hvf1_la_id->Attributes->RestoreFromArray($items[$i]->_mfi_hvf1_la_idAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->mfi_hvf1_customer_name->Show();
                        $this->mfi_hvf1_customer_occupation->Show();
                        $this->mfi_hvf1_customer_guarantor_occupation->Show();
                        $this->mfi_hvf2_customer_guarantor_name->Show();
                        $this->mfi_hvf1_la_id->Show();
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
                            $this->Page_Footer->CCSEventResult = CCGetEvent($this->Page_Footer->CCSEvents, "BeforeShow", $this->Page_Footer);
                            if ($this->Page_Footer->Visible) {
                                $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Page_Footer";
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

} //End mfi_hvf1_mfi_hvf2 Class @2-FCB6E20C

class clsmfi_hvf1_mfi_hvf2DataSource extends clsDBmysql_cams_v2 {  //mfi_hvf1_mfi_hvf2DataSource Class @2-68135EA4

//DataSource Variables @2-E24AEA40
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $mfi_hvf1_customer_name;
    public $mfi_hvf1_customer_occupation;
    public $mfi_hvf1_customer_guarantor_occupation;
    public $mfi_hvf2_customer_guarantor_name;
    public $mfi_hvf1_la_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3D8C001E
    function clsmfi_hvf1_mfi_hvf2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_hvf1_mfi_hvf2";
        $this->Initialize();
        $this->mfi_hvf1_customer_name = new clsField("mfi_hvf1_customer_name", ccsText, "");
        
        $this->mfi_hvf1_customer_occupation = new clsField("mfi_hvf1_customer_occupation", ccsText, "");
        
        $this->mfi_hvf1_customer_guarantor_occupation = new clsField("mfi_hvf1_customer_guarantor_occupation", ccsText, "");
        
        $this->mfi_hvf2_customer_guarantor_name = new clsField("mfi_hvf2_customer_guarantor_name", ccsText, "");
        
        $this->mfi_hvf1_la_id = new clsField("mfi_hvf1_la_id", ccsText, "");
        

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

//Prepare Method @2-72B5FA74
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgp_id", ccsText, "", "", $this->Parameters["urlgp_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_hvf2.gp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-70EA3A91
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT mfi_hvf1.la_id AS mfi_hvf1_la_id, mfi_hvf1_customer_name, mfi_hvf2_customer_guarantor_name, mfi_hvf1_customer_occupation, mfi_hvf1_customer_guarantor_occupation \n\n" .
        "FROM mfi_hvf1 INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-7962FD98
    function SetValues()
    {
        $this->mfi_hvf1_customer_name->SetDBValue($this->f("mfi_hvf1_customer_name"));
        $this->mfi_hvf1_customer_occupation->SetDBValue($this->f("mfi_hvf1_customer_occupation"));
        $this->mfi_hvf1_customer_guarantor_occupation->SetDBValue($this->f("mfi_hvf1_customer_guarantor_occupation"));
        $this->mfi_hvf2_customer_guarantor_name->SetDBValue($this->f("mfi_hvf2_customer_guarantor_name"));
        $this->mfi_hvf1_la_id->SetDBValue($this->f("mfi_hvf1_la_id"));
    }
//End SetValues Method

} //End mfi_hvf1_mfi_hvf2DataSource Class @2-FCB6E20C

//Initialize Page @1-153325F1
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
$TemplateFileName = "tc_display_bor_inf.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-434FA3C1
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_hvf1_mfi_hvf2 = new clsReportmfi_hvf1_mfi_hvf2("", $MainPage);
$MainPage->mfi_hvf1_mfi_hvf2 = & $mfi_hvf1_mfi_hvf2;
$mfi_hvf1_mfi_hvf2->Initialize();

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

//Go to destination page @1-8786FA88
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_hvf1_mfi_hvf2);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D318DA1E
$mfi_hvf1_mfi_hvf2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-82AFF32B
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_hvf1_mfi_hvf2);
unset($Tpl);
//End Unload Page


?>
