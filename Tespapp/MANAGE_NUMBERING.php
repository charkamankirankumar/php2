<?php
//Include Common Files @1-0B52119B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "MANAGE_NUMBERING.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//mfi_docs ReportGroup class @2-FC547FF5
class clsReportGroupmfi_docs {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $batch_code, $_batch_codeAttributes;
    public $mfi_doc_code, $_mfi_doc_codePage, $_mfi_doc_codeParameters, $_mfi_doc_codeAttributes;
    public $mfi_doc_pre_number_code, $_mfi_doc_pre_number_codeAttributes;
    public $mfi_doc_territory_code, $_mfi_doc_territory_codeAttributes;
    public $pre_numbered_by, $_pre_numbered_byAttributes;
    public $numbered_by, $_numbered_byAttributes;
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
        $this->mfi_doc_code = $this->Parent->mfi_doc_code->Value;
        $this->mfi_doc_pre_number_code = $this->Parent->mfi_doc_pre_number_code->Value;
        $this->mfi_doc_territory_code = $this->Parent->mfi_doc_territory_code->Value;
        $this->pre_numbered_by = $this->Parent->pre_numbered_by->Value;
        $this->numbered_by = $this->Parent->numbered_by->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_mfi_doc_codePage = $this->Parent->mfi_doc_code->Page;
        $this->_mfi_doc_codeParameters = $this->Parent->mfi_doc_code->Parameters;
        $this->_batch_codeAttributes = $this->Parent->batch_code->Attributes->GetAsArray();
        $this->_mfi_doc_codeAttributes = $this->Parent->mfi_doc_code->Attributes->GetAsArray();
        $this->_mfi_doc_pre_number_codeAttributes = $this->Parent->mfi_doc_pre_number_code->Attributes->GetAsArray();
        $this->_mfi_doc_territory_codeAttributes = $this->Parent->mfi_doc_territory_code->Attributes->GetAsArray();
        $this->_pre_numbered_byAttributes = $this->Parent->pre_numbered_by->Attributes->GetAsArray();
        $this->_numbered_byAttributes = $this->Parent->numbered_by->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->batch_code = $Header->batch_code;
        $Header->_batch_codeAttributes = $this->_batch_codeAttributes;
        $this->Parent->batch_code->Value = $Header->batch_code;
        $this->Parent->batch_code->Attributes->RestoreFromArray($Header->_batch_codeAttributes);
        $this->mfi_doc_code = $Header->mfi_doc_code;
        $this->_mfi_doc_codePage = $Header->_mfi_doc_codePage;
        $this->_mfi_doc_codeParameters = $Header->_mfi_doc_codeParameters;
        $Header->_mfi_doc_codeAttributes = $this->_mfi_doc_codeAttributes;
        $this->Parent->mfi_doc_code->Value = $Header->mfi_doc_code;
        $this->Parent->mfi_doc_code->Attributes->RestoreFromArray($Header->_mfi_doc_codeAttributes);
        $this->mfi_doc_pre_number_code = $Header->mfi_doc_pre_number_code;
        $Header->_mfi_doc_pre_number_codeAttributes = $this->_mfi_doc_pre_number_codeAttributes;
        $this->Parent->mfi_doc_pre_number_code->Value = $Header->mfi_doc_pre_number_code;
        $this->Parent->mfi_doc_pre_number_code->Attributes->RestoreFromArray($Header->_mfi_doc_pre_number_codeAttributes);
        $this->mfi_doc_territory_code = $Header->mfi_doc_territory_code;
        $Header->_mfi_doc_territory_codeAttributes = $this->_mfi_doc_territory_codeAttributes;
        $this->Parent->mfi_doc_territory_code->Value = $Header->mfi_doc_territory_code;
        $this->Parent->mfi_doc_territory_code->Attributes->RestoreFromArray($Header->_mfi_doc_territory_codeAttributes);
        $this->pre_numbered_by = $Header->pre_numbered_by;
        $Header->_pre_numbered_byAttributes = $this->_pre_numbered_byAttributes;
        $this->Parent->pre_numbered_by->Value = $Header->pre_numbered_by;
        $this->Parent->pre_numbered_by->Attributes->RestoreFromArray($Header->_pre_numbered_byAttributes);
        $this->numbered_by = $Header->numbered_by;
        $Header->_numbered_byAttributes = $this->_numbered_byAttributes;
        $this->Parent->numbered_by->Value = $Header->numbered_by;
        $this->Parent->numbered_by->Attributes->RestoreFromArray($Header->_numbered_byAttributes);
    }
    function ChangeTotalControls() {
    }
}
//End mfi_docs ReportGroup class

//mfi_docs GroupsCollection class @2-B161CDFD
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
        $this->Parent->batch_code->Value = $this->Parent->batch_code->initialValue;
        $this->Parent->mfi_doc_code->Value = $this->Parent->mfi_doc_code->initialValue;
        $this->Parent->mfi_doc_pre_number_code->Value = $this->Parent->mfi_doc_pre_number_code->initialValue;
        $this->Parent->mfi_doc_territory_code->Value = $this->Parent->mfi_doc_territory_code->initialValue;
        $this->Parent->pre_numbered_by->Value = $this->Parent->pre_numbered_by->initialValue;
        $this->Parent->numbered_by->Value = $this->Parent->numbered_by->initialValue;
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

class clsReportmfi_docs { //mfi_docs Class @2-B705B3B8

//mfi_docs Variables @2-944D286E

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

//Class_Initialize Event @2-A9D5C9FD
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
                $this->PageSize = 200;
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

        $this->batch_code = new clsControl(ccsReportLabel, "batch_code", "batch_code", ccsText, "", "", $this);
        $this->mfi_doc_code = new clsControl(ccsLink, "mfi_doc_code", "mfi_doc_code", ccsText, "", CCGetRequestParam("mfi_doc_code", ccsGet, NULL), $this);
        $this->mfi_doc_code->Page = "upd_number.php";
        $this->mfi_doc_pre_number_code = new clsControl(ccsReportLabel, "mfi_doc_pre_number_code", "mfi_doc_pre_number_code", ccsText, "", "", $this);
        $this->mfi_doc_territory_code = new clsControl(ccsReportLabel, "mfi_doc_territory_code", "mfi_doc_territory_code", ccsText, "", "", $this);
        $this->pre_numbered_by = new clsControl(ccsReportLabel, "pre_numbered_by", "pre_numbered_by", ccsText, "", "", $this);
        $this->numbered_by = new clsControl(ccsReportLabel, "numbered_by", "numbered_by", ccsText, "", "", $this);
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

//CheckErrors Method @2-9961FCD9
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->batch_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_pre_number_code->Errors->Count());
        $errors = ($errors || $this->mfi_doc_territory_code->Errors->Count());
        $errors = ($errors || $this->pre_numbered_by->Errors->Count());
        $errors = ($errors || $this->numbered_by->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-5F8E1227
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->batch_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_pre_number_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_doc_territory_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pre_numbered_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->numbered_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-67AB9F81
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
            $this->mfi_doc_code->SetValue($this->DataSource->mfi_doc_code->GetValue());
            $this->mfi_doc_pre_number_code->SetValue($this->DataSource->mfi_doc_pre_number_code->GetValue());
            $this->mfi_doc_territory_code->SetValue($this->DataSource->mfi_doc_territory_code->GetValue());
            $this->pre_numbered_by->SetValue($this->DataSource->pre_numbered_by->GetValue());
            $this->numbered_by->SetValue($this->DataSource->numbered_by->GetValue());
            $this->mfi_doc_code->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->mfi_doc_code->Parameters = CCAddParam($this->mfi_doc_code->Parameters, "doc_id", $this->DataSource->f("mfi_doc_code"));
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
            $this->ControlsVisible["mfi_doc_code"] = $this->mfi_doc_code->Visible;
            $this->ControlsVisible["mfi_doc_pre_number_code"] = $this->mfi_doc_pre_number_code->Visible;
            $this->ControlsVisible["mfi_doc_territory_code"] = $this->mfi_doc_territory_code->Visible;
            $this->ControlsVisible["pre_numbered_by"] = $this->pre_numbered_by->Visible;
            $this->ControlsVisible["numbered_by"] = $this->numbered_by->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->batch_code->SetValue($items[$i]->batch_code);
                        $this->batch_code->Attributes->RestoreFromArray($items[$i]->_batch_codeAttributes);
                        $this->mfi_doc_code->SetValue($items[$i]->mfi_doc_code);
                        $this->mfi_doc_code->Page = $items[$i]->_mfi_doc_codePage;
                        $this->mfi_doc_code->Parameters = $items[$i]->_mfi_doc_codeParameters;
                        $this->mfi_doc_code->Attributes->RestoreFromArray($items[$i]->_mfi_doc_codeAttributes);
                        $this->mfi_doc_pre_number_code->SetValue($items[$i]->mfi_doc_pre_number_code);
                        $this->mfi_doc_pre_number_code->Attributes->RestoreFromArray($items[$i]->_mfi_doc_pre_number_codeAttributes);
                        $this->mfi_doc_territory_code->SetValue($items[$i]->mfi_doc_territory_code);
                        $this->mfi_doc_territory_code->Attributes->RestoreFromArray($items[$i]->_mfi_doc_territory_codeAttributes);
                        $this->pre_numbered_by->SetValue($items[$i]->pre_numbered_by);
                        $this->pre_numbered_by->Attributes->RestoreFromArray($items[$i]->_pre_numbered_byAttributes);
                        $this->numbered_by->SetValue($items[$i]->numbered_by);
                        $this->numbered_by->Attributes->RestoreFromArray($items[$i]->_numbered_byAttributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->batch_code->Show();
                        $this->mfi_doc_code->Show();
                        $this->mfi_doc_pre_number_code->Show();
                        $this->mfi_doc_territory_code->Show();
                        $this->pre_numbered_by->Show();
                        $this->numbered_by->Show();
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

} //End mfi_docs Class @2-FCB6E20C

class clsmfi_docsDataSource extends clsDBmysql_cams_v2 {  //mfi_docsDataSource Class @2-BC5AABD7

//DataSource Variables @2-1BF33A51
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $batch_code;
    public $mfi_doc_code;
    public $mfi_doc_pre_number_code;
    public $mfi_doc_territory_code;
    public $pre_numbered_by;
    public $numbered_by;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-BA36327F
    function clsmfi_docsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report mfi_docs";
        $this->Initialize();
        $this->batch_code = new clsField("batch_code", ccsText, "");
        
        $this->mfi_doc_code = new clsField("mfi_doc_code", ccsText, "");
        
        $this->mfi_doc_pre_number_code = new clsField("mfi_doc_pre_number_code", ccsText, "");
        
        $this->mfi_doc_territory_code = new clsField("mfi_doc_territory_code", ccsText, "");
        
        $this->pre_numbered_by = new clsField("pre_numbered_by", ccsText, "");
        
        $this->numbered_by = new clsField("numbered_by", ccsText, "");
        

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

//Prepare Method @2-217340F9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->Criterion[1] = "( numbering_errors like 'MISMATCH' )";
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-92E33FC2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_docs {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-479F396A
    function SetValues()
    {
        $this->batch_code->SetDBValue($this->f("batch_code"));
        $this->mfi_doc_code->SetDBValue($this->f("mfi_doc_code"));
        $this->mfi_doc_pre_number_code->SetDBValue($this->f("mfi_doc_pre_number_code"));
        $this->mfi_doc_territory_code->SetDBValue($this->f("mfi_doc_territory_code"));
        $this->pre_numbered_by->SetDBValue($this->f("pre_numbered_by"));
        $this->numbered_by->SetDBValue($this->f("numbered_by"));
    }
//End SetValues Method

} //End mfi_docsDataSource Class @2-FCB6E20C

//Include Page implementation @20-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @21-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

//Include Page implementation @22-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

//Initialize Page @1-09CC1DD8
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
$TemplateFileName = "MANAGE_NUMBERING.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F46E111F
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$mfi_docs = new clsReportmfi_docs("", $MainPage);
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$MainPage->mfi_docs = & $mfi_docs;
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
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

//Execute Components @1-BD4576F4
$incMenu->Operations();
$incFooter->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-4C216507
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($mfi_docs);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incFooter->Class_Terminate();
    unset($incFooter);
    $incMenu->Class_Terminate();
    unset($incMenu);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3642DFCF
$mfi_docs->Show();
$incHeader->Show();
$incFooter->Show();
$incMenu->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3FD7D2DD
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($mfi_docs);
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
unset($Tpl);
//End Unload Page


?>
