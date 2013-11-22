<?php
//Include Common Files @1-76C17048
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "NPSREPORT.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//nps_master ReportGroup class @2-48D754D3
class clsReportGroupnps_master {
    public $GroupType;
    public $mode; //1 - open, 2 - close
    public $sno, $_snoAttributes;
    public $branch, $_branchAttributes;
    public $application_no, $_application_noAttributes;
    public $first_name, $_first_nameAttributes;
    public $last_name, $_last_nameAttributes;
    public $father_namef, $_father_namefAttributes;
    public $father_namel, $_father_namelAttributes;
    public $citizen_india, $_citizen_indiaAttributes;
    public $gender, $_genderAttributes;
    public $marital_status, $_marital_statusAttributes;
    public $dob, $_dobAttributes;
    public $religion, $_religionAttributes;
    public $caste, $_casteAttributes;
    public $emp_status, $_emp_statusAttributes;
    public $dno, $_dnoAttributes;
    public $taluk, $_talukAttributes;
    public $village, $_villageAttributes;
    public $state, $_stateAttributes;
    public $district, $_districtAttributes;
    public $pincode, $_pincodeAttributes;
    public $mob_no, $_mob_noAttributes;
    public $ReportLabel1, $_ReportLabel1Attributes;
    public $ReportLabel2, $_ReportLabel2Attributes;
    public $ReportLabel3, $_ReportLabel3Attributes;
    public $ReportLabel4, $_ReportLabel4Attributes;
    public $ReportLabel5, $_ReportLabel5Attributes;
    public $ReportLabel6, $_ReportLabel6Attributes;
    public $ReportLabel7, $_ReportLabel7Attributes;
    public $ReportLabel8, $_ReportLabel8Attributes;
    public $ReportLabel9, $_ReportLabel9Attributes;
    public $ReportLabel10, $_ReportLabel10Attributes;
    public $ReportLabel11, $_ReportLabel11Attributes;
    public $ReportLabel12, $_ReportLabel12Attributes;
    public $ReportLabel13, $_ReportLabel13Attributes;
    public $ReportLabel14, $_ReportLabel14Attributes;
    public $ReportLabel15, $_ReportLabel15Attributes;
    public $ReportLabel16, $_ReportLabel16Attributes;
    public $ReportLabel17, $_ReportLabel17Attributes;
    public $ReportLabel18, $_ReportLabel18Attributes;
    public $ReportLabel19, $_ReportLabel19Attributes;
    public $ReportLabel20, $_ReportLabel20Attributes;
    public $Attributes;
    public $ReportTotalIndex = 0;
    public $PageTotalIndex;
    public $PageNumber;
    public $RowNumber;
    public $Parent;

    function clsReportGroupnps_master(& $parent) {
        $this->Parent = & $parent;
        $this->Attributes = $this->Parent->Attributes->GetAsArray();
    }
    function SetControls($PrevGroup = "") {
        $this->sno = $this->Parent->sno->Value;
        $this->branch = $this->Parent->branch->Value;
        $this->application_no = $this->Parent->application_no->Value;
        $this->first_name = $this->Parent->first_name->Value;
        $this->last_name = $this->Parent->last_name->Value;
        $this->father_namef = $this->Parent->father_namef->Value;
        $this->father_namel = $this->Parent->father_namel->Value;
        $this->citizen_india = $this->Parent->citizen_india->Value;
        $this->gender = $this->Parent->gender->Value;
        $this->marital_status = $this->Parent->marital_status->Value;
        $this->dob = $this->Parent->dob->Value;
        $this->religion = $this->Parent->religion->Value;
        $this->caste = $this->Parent->caste->Value;
        $this->emp_status = $this->Parent->emp_status->Value;
        $this->dno = $this->Parent->dno->Value;
        $this->taluk = $this->Parent->taluk->Value;
        $this->village = $this->Parent->village->Value;
        $this->state = $this->Parent->state->Value;
        $this->district = $this->Parent->district->Value;
        $this->pincode = $this->Parent->pincode->Value;
        $this->mob_no = $this->Parent->mob_no->Value;
        $this->ReportLabel1 = $this->Parent->ReportLabel1->Value;
        $this->ReportLabel2 = $this->Parent->ReportLabel2->Value;
        $this->ReportLabel3 = $this->Parent->ReportLabel3->Value;
        $this->ReportLabel4 = $this->Parent->ReportLabel4->Value;
        $this->ReportLabel5 = $this->Parent->ReportLabel5->Value;
        $this->ReportLabel6 = $this->Parent->ReportLabel6->Value;
        $this->ReportLabel7 = $this->Parent->ReportLabel7->Value;
        $this->ReportLabel8 = $this->Parent->ReportLabel8->Value;
        $this->ReportLabel9 = $this->Parent->ReportLabel9->Value;
        $this->ReportLabel10 = $this->Parent->ReportLabel10->Value;
        $this->ReportLabel11 = $this->Parent->ReportLabel11->Value;
        $this->ReportLabel12 = $this->Parent->ReportLabel12->Value;
        $this->ReportLabel13 = $this->Parent->ReportLabel13->Value;
        $this->ReportLabel14 = $this->Parent->ReportLabel14->Value;
        $this->ReportLabel15 = $this->Parent->ReportLabel15->Value;
        $this->ReportLabel16 = $this->Parent->ReportLabel16->Value;
        $this->ReportLabel17 = $this->Parent->ReportLabel17->Value;
        $this->ReportLabel18 = $this->Parent->ReportLabel18->Value;
        $this->ReportLabel19 = $this->Parent->ReportLabel19->Value;
        $this->ReportLabel20 = $this->Parent->ReportLabel20->Value;
    }

    function SetTotalControls($mode = "", $PrevGroup = "") {
        $this->_snoAttributes = $this->Parent->sno->Attributes->GetAsArray();
        $this->_branchAttributes = $this->Parent->branch->Attributes->GetAsArray();
        $this->_application_noAttributes = $this->Parent->application_no->Attributes->GetAsArray();
        $this->_first_nameAttributes = $this->Parent->first_name->Attributes->GetAsArray();
        $this->_last_nameAttributes = $this->Parent->last_name->Attributes->GetAsArray();
        $this->_father_namefAttributes = $this->Parent->father_namef->Attributes->GetAsArray();
        $this->_father_namelAttributes = $this->Parent->father_namel->Attributes->GetAsArray();
        $this->_citizen_indiaAttributes = $this->Parent->citizen_india->Attributes->GetAsArray();
        $this->_genderAttributes = $this->Parent->gender->Attributes->GetAsArray();
        $this->_marital_statusAttributes = $this->Parent->marital_status->Attributes->GetAsArray();
        $this->_dobAttributes = $this->Parent->dob->Attributes->GetAsArray();
        $this->_religionAttributes = $this->Parent->religion->Attributes->GetAsArray();
        $this->_casteAttributes = $this->Parent->caste->Attributes->GetAsArray();
        $this->_emp_statusAttributes = $this->Parent->emp_status->Attributes->GetAsArray();
        $this->_dnoAttributes = $this->Parent->dno->Attributes->GetAsArray();
        $this->_talukAttributes = $this->Parent->taluk->Attributes->GetAsArray();
        $this->_villageAttributes = $this->Parent->village->Attributes->GetAsArray();
        $this->_stateAttributes = $this->Parent->state->Attributes->GetAsArray();
        $this->_districtAttributes = $this->Parent->district->Attributes->GetAsArray();
        $this->_pincodeAttributes = $this->Parent->pincode->Attributes->GetAsArray();
        $this->_mob_noAttributes = $this->Parent->mob_no->Attributes->GetAsArray();
        $this->_ReportLabel1Attributes = $this->Parent->ReportLabel1->Attributes->GetAsArray();
        $this->_ReportLabel2Attributes = $this->Parent->ReportLabel2->Attributes->GetAsArray();
        $this->_ReportLabel3Attributes = $this->Parent->ReportLabel3->Attributes->GetAsArray();
        $this->_ReportLabel4Attributes = $this->Parent->ReportLabel4->Attributes->GetAsArray();
        $this->_ReportLabel5Attributes = $this->Parent->ReportLabel5->Attributes->GetAsArray();
        $this->_ReportLabel6Attributes = $this->Parent->ReportLabel6->Attributes->GetAsArray();
        $this->_ReportLabel7Attributes = $this->Parent->ReportLabel7->Attributes->GetAsArray();
        $this->_ReportLabel8Attributes = $this->Parent->ReportLabel8->Attributes->GetAsArray();
        $this->_ReportLabel9Attributes = $this->Parent->ReportLabel9->Attributes->GetAsArray();
        $this->_ReportLabel10Attributes = $this->Parent->ReportLabel10->Attributes->GetAsArray();
        $this->_ReportLabel11Attributes = $this->Parent->ReportLabel11->Attributes->GetAsArray();
        $this->_ReportLabel12Attributes = $this->Parent->ReportLabel12->Attributes->GetAsArray();
        $this->_ReportLabel13Attributes = $this->Parent->ReportLabel13->Attributes->GetAsArray();
        $this->_ReportLabel14Attributes = $this->Parent->ReportLabel14->Attributes->GetAsArray();
        $this->_ReportLabel15Attributes = $this->Parent->ReportLabel15->Attributes->GetAsArray();
        $this->_ReportLabel16Attributes = $this->Parent->ReportLabel16->Attributes->GetAsArray();
        $this->_ReportLabel17Attributes = $this->Parent->ReportLabel17->Attributes->GetAsArray();
        $this->_ReportLabel18Attributes = $this->Parent->ReportLabel18->Attributes->GetAsArray();
        $this->_ReportLabel19Attributes = $this->Parent->ReportLabel19->Attributes->GetAsArray();
        $this->_ReportLabel20Attributes = $this->Parent->ReportLabel20->Attributes->GetAsArray();
    }
    function SyncWithHeader(& $Header) {
        $this->sno = $Header->sno;
        $Header->_snoAttributes = $this->_snoAttributes;
        $this->Parent->sno->Value = $Header->sno;
        $this->Parent->sno->Attributes->RestoreFromArray($Header->_snoAttributes);
        $this->branch = $Header->branch;
        $Header->_branchAttributes = $this->_branchAttributes;
        $this->Parent->branch->Value = $Header->branch;
        $this->Parent->branch->Attributes->RestoreFromArray($Header->_branchAttributes);
        $this->application_no = $Header->application_no;
        $Header->_application_noAttributes = $this->_application_noAttributes;
        $this->Parent->application_no->Value = $Header->application_no;
        $this->Parent->application_no->Attributes->RestoreFromArray($Header->_application_noAttributes);
        $this->first_name = $Header->first_name;
        $Header->_first_nameAttributes = $this->_first_nameAttributes;
        $this->Parent->first_name->Value = $Header->first_name;
        $this->Parent->first_name->Attributes->RestoreFromArray($Header->_first_nameAttributes);
        $this->last_name = $Header->last_name;
        $Header->_last_nameAttributes = $this->_last_nameAttributes;
        $this->Parent->last_name->Value = $Header->last_name;
        $this->Parent->last_name->Attributes->RestoreFromArray($Header->_last_nameAttributes);
        $this->father_namef = $Header->father_namef;
        $Header->_father_namefAttributes = $this->_father_namefAttributes;
        $this->Parent->father_namef->Value = $Header->father_namef;
        $this->Parent->father_namef->Attributes->RestoreFromArray($Header->_father_namefAttributes);
        $this->father_namel = $Header->father_namel;
        $Header->_father_namelAttributes = $this->_father_namelAttributes;
        $this->Parent->father_namel->Value = $Header->father_namel;
        $this->Parent->father_namel->Attributes->RestoreFromArray($Header->_father_namelAttributes);
        $this->citizen_india = $Header->citizen_india;
        $Header->_citizen_indiaAttributes = $this->_citizen_indiaAttributes;
        $this->Parent->citizen_india->Value = $Header->citizen_india;
        $this->Parent->citizen_india->Attributes->RestoreFromArray($Header->_citizen_indiaAttributes);
        $this->gender = $Header->gender;
        $Header->_genderAttributes = $this->_genderAttributes;
        $this->Parent->gender->Value = $Header->gender;
        $this->Parent->gender->Attributes->RestoreFromArray($Header->_genderAttributes);
        $this->marital_status = $Header->marital_status;
        $Header->_marital_statusAttributes = $this->_marital_statusAttributes;
        $this->Parent->marital_status->Value = $Header->marital_status;
        $this->Parent->marital_status->Attributes->RestoreFromArray($Header->_marital_statusAttributes);
        $this->dob = $Header->dob;
        $Header->_dobAttributes = $this->_dobAttributes;
        $this->Parent->dob->Value = $Header->dob;
        $this->Parent->dob->Attributes->RestoreFromArray($Header->_dobAttributes);
        $this->religion = $Header->religion;
        $Header->_religionAttributes = $this->_religionAttributes;
        $this->Parent->religion->Value = $Header->religion;
        $this->Parent->religion->Attributes->RestoreFromArray($Header->_religionAttributes);
        $this->caste = $Header->caste;
        $Header->_casteAttributes = $this->_casteAttributes;
        $this->Parent->caste->Value = $Header->caste;
        $this->Parent->caste->Attributes->RestoreFromArray($Header->_casteAttributes);
        $this->emp_status = $Header->emp_status;
        $Header->_emp_statusAttributes = $this->_emp_statusAttributes;
        $this->Parent->emp_status->Value = $Header->emp_status;
        $this->Parent->emp_status->Attributes->RestoreFromArray($Header->_emp_statusAttributes);
        $this->dno = $Header->dno;
        $Header->_dnoAttributes = $this->_dnoAttributes;
        $this->Parent->dno->Value = $Header->dno;
        $this->Parent->dno->Attributes->RestoreFromArray($Header->_dnoAttributes);
        $this->taluk = $Header->taluk;
        $Header->_talukAttributes = $this->_talukAttributes;
        $this->Parent->taluk->Value = $Header->taluk;
        $this->Parent->taluk->Attributes->RestoreFromArray($Header->_talukAttributes);
        $this->village = $Header->village;
        $Header->_villageAttributes = $this->_villageAttributes;
        $this->Parent->village->Value = $Header->village;
        $this->Parent->village->Attributes->RestoreFromArray($Header->_villageAttributes);
        $this->state = $Header->state;
        $Header->_stateAttributes = $this->_stateAttributes;
        $this->Parent->state->Value = $Header->state;
        $this->Parent->state->Attributes->RestoreFromArray($Header->_stateAttributes);
        $this->district = $Header->district;
        $Header->_districtAttributes = $this->_districtAttributes;
        $this->Parent->district->Value = $Header->district;
        $this->Parent->district->Attributes->RestoreFromArray($Header->_districtAttributes);
        $this->pincode = $Header->pincode;
        $Header->_pincodeAttributes = $this->_pincodeAttributes;
        $this->Parent->pincode->Value = $Header->pincode;
        $this->Parent->pincode->Attributes->RestoreFromArray($Header->_pincodeAttributes);
        $this->mob_no = $Header->mob_no;
        $Header->_mob_noAttributes = $this->_mob_noAttributes;
        $this->Parent->mob_no->Value = $Header->mob_no;
        $this->Parent->mob_no->Attributes->RestoreFromArray($Header->_mob_noAttributes);
        $this->ReportLabel1 = $Header->ReportLabel1;
        $Header->_ReportLabel1Attributes = $this->_ReportLabel1Attributes;
        $this->Parent->ReportLabel1->Value = $Header->ReportLabel1;
        $this->Parent->ReportLabel1->Attributes->RestoreFromArray($Header->_ReportLabel1Attributes);
        $this->ReportLabel2 = $Header->ReportLabel2;
        $Header->_ReportLabel2Attributes = $this->_ReportLabel2Attributes;
        $this->Parent->ReportLabel2->Value = $Header->ReportLabel2;
        $this->Parent->ReportLabel2->Attributes->RestoreFromArray($Header->_ReportLabel2Attributes);
        $this->ReportLabel3 = $Header->ReportLabel3;
        $Header->_ReportLabel3Attributes = $this->_ReportLabel3Attributes;
        $this->Parent->ReportLabel3->Value = $Header->ReportLabel3;
        $this->Parent->ReportLabel3->Attributes->RestoreFromArray($Header->_ReportLabel3Attributes);
        $this->ReportLabel4 = $Header->ReportLabel4;
        $Header->_ReportLabel4Attributes = $this->_ReportLabel4Attributes;
        $this->Parent->ReportLabel4->Value = $Header->ReportLabel4;
        $this->Parent->ReportLabel4->Attributes->RestoreFromArray($Header->_ReportLabel4Attributes);
        $this->ReportLabel5 = $Header->ReportLabel5;
        $Header->_ReportLabel5Attributes = $this->_ReportLabel5Attributes;
        $this->Parent->ReportLabel5->Value = $Header->ReportLabel5;
        $this->Parent->ReportLabel5->Attributes->RestoreFromArray($Header->_ReportLabel5Attributes);
        $this->ReportLabel6 = $Header->ReportLabel6;
        $Header->_ReportLabel6Attributes = $this->_ReportLabel6Attributes;
        $this->Parent->ReportLabel6->Value = $Header->ReportLabel6;
        $this->Parent->ReportLabel6->Attributes->RestoreFromArray($Header->_ReportLabel6Attributes);
        $this->ReportLabel7 = $Header->ReportLabel7;
        $Header->_ReportLabel7Attributes = $this->_ReportLabel7Attributes;
        $this->Parent->ReportLabel7->Value = $Header->ReportLabel7;
        $this->Parent->ReportLabel7->Attributes->RestoreFromArray($Header->_ReportLabel7Attributes);
        $this->ReportLabel8 = $Header->ReportLabel8;
        $Header->_ReportLabel8Attributes = $this->_ReportLabel8Attributes;
        $this->Parent->ReportLabel8->Value = $Header->ReportLabel8;
        $this->Parent->ReportLabel8->Attributes->RestoreFromArray($Header->_ReportLabel8Attributes);
        $this->ReportLabel9 = $Header->ReportLabel9;
        $Header->_ReportLabel9Attributes = $this->_ReportLabel9Attributes;
        $this->Parent->ReportLabel9->Value = $Header->ReportLabel9;
        $this->Parent->ReportLabel9->Attributes->RestoreFromArray($Header->_ReportLabel9Attributes);
        $this->ReportLabel10 = $Header->ReportLabel10;
        $Header->_ReportLabel10Attributes = $this->_ReportLabel10Attributes;
        $this->Parent->ReportLabel10->Value = $Header->ReportLabel10;
        $this->Parent->ReportLabel10->Attributes->RestoreFromArray($Header->_ReportLabel10Attributes);
        $this->ReportLabel11 = $Header->ReportLabel11;
        $Header->_ReportLabel11Attributes = $this->_ReportLabel11Attributes;
        $this->Parent->ReportLabel11->Value = $Header->ReportLabel11;
        $this->Parent->ReportLabel11->Attributes->RestoreFromArray($Header->_ReportLabel11Attributes);
        $this->ReportLabel12 = $Header->ReportLabel12;
        $Header->_ReportLabel12Attributes = $this->_ReportLabel12Attributes;
        $this->Parent->ReportLabel12->Value = $Header->ReportLabel12;
        $this->Parent->ReportLabel12->Attributes->RestoreFromArray($Header->_ReportLabel12Attributes);
        $this->ReportLabel13 = $Header->ReportLabel13;
        $Header->_ReportLabel13Attributes = $this->_ReportLabel13Attributes;
        $this->Parent->ReportLabel13->Value = $Header->ReportLabel13;
        $this->Parent->ReportLabel13->Attributes->RestoreFromArray($Header->_ReportLabel13Attributes);
        $this->ReportLabel14 = $Header->ReportLabel14;
        $Header->_ReportLabel14Attributes = $this->_ReportLabel14Attributes;
        $this->Parent->ReportLabel14->Value = $Header->ReportLabel14;
        $this->Parent->ReportLabel14->Attributes->RestoreFromArray($Header->_ReportLabel14Attributes);
        $this->ReportLabel15 = $Header->ReportLabel15;
        $Header->_ReportLabel15Attributes = $this->_ReportLabel15Attributes;
        $this->Parent->ReportLabel15->Value = $Header->ReportLabel15;
        $this->Parent->ReportLabel15->Attributes->RestoreFromArray($Header->_ReportLabel15Attributes);
        $this->ReportLabel16 = $Header->ReportLabel16;
        $Header->_ReportLabel16Attributes = $this->_ReportLabel16Attributes;
        $this->Parent->ReportLabel16->Value = $Header->ReportLabel16;
        $this->Parent->ReportLabel16->Attributes->RestoreFromArray($Header->_ReportLabel16Attributes);
        $this->ReportLabel17 = $Header->ReportLabel17;
        $Header->_ReportLabel17Attributes = $this->_ReportLabel17Attributes;
        $this->Parent->ReportLabel17->Value = $Header->ReportLabel17;
        $this->Parent->ReportLabel17->Attributes->RestoreFromArray($Header->_ReportLabel17Attributes);
        $this->ReportLabel18 = $Header->ReportLabel18;
        $Header->_ReportLabel18Attributes = $this->_ReportLabel18Attributes;
        $this->Parent->ReportLabel18->Value = $Header->ReportLabel18;
        $this->Parent->ReportLabel18->Attributes->RestoreFromArray($Header->_ReportLabel18Attributes);
        $this->ReportLabel19 = $Header->ReportLabel19;
        $Header->_ReportLabel19Attributes = $this->_ReportLabel19Attributes;
        $this->Parent->ReportLabel19->Value = $Header->ReportLabel19;
        $this->Parent->ReportLabel19->Attributes->RestoreFromArray($Header->_ReportLabel19Attributes);
        $this->ReportLabel20 = $Header->ReportLabel20;
        $Header->_ReportLabel20Attributes = $this->_ReportLabel20Attributes;
        $this->Parent->ReportLabel20->Value = $Header->ReportLabel20;
        $this->Parent->ReportLabel20->Attributes->RestoreFromArray($Header->_ReportLabel20Attributes);
    }
    function ChangeTotalControls() {
    }
}
//End nps_master ReportGroup class

//nps_master GroupsCollection class @2-6CEE3C9D
class clsGroupsCollectionnps_master {
    public $Groups;
    public $mPageCurrentHeaderIndex;
    public $PageSize;
    public $TotalPages = 0;
    public $TotalRows = 0;
    public $CurrentPageSize = 0;
    public $Pages;
    public $Parent;
    public $LastDetailIndex;

    function clsGroupsCollectionnps_master(& $parent) {
        $this->Parent = & $parent;
        $this->Groups = array();
        $this->Pages  = array();
        $this->mReportTotalIndex = 0;
        $this->mPageTotalIndex = 1;
    }

    function & InitGroup() {
        $group = new clsReportGroupnps_master($this->Parent);
        $group->RowNumber = $this->TotalRows + 1;
        $group->PageNumber = $this->TotalPages;
        $group->PageTotalIndex = $this->mPageCurrentHeaderIndex;
        return $group;
    }

    function RestoreValues() {
        $this->Parent->sno->Value = $this->Parent->sno->initialValue;
        $this->Parent->branch->Value = $this->Parent->branch->initialValue;
        $this->Parent->application_no->Value = $this->Parent->application_no->initialValue;
        $this->Parent->first_name->Value = $this->Parent->first_name->initialValue;
        $this->Parent->last_name->Value = $this->Parent->last_name->initialValue;
        $this->Parent->father_namef->Value = $this->Parent->father_namef->initialValue;
        $this->Parent->father_namel->Value = $this->Parent->father_namel->initialValue;
        $this->Parent->citizen_india->Value = $this->Parent->citizen_india->initialValue;
        $this->Parent->gender->Value = $this->Parent->gender->initialValue;
        $this->Parent->marital_status->Value = $this->Parent->marital_status->initialValue;
        $this->Parent->dob->Value = $this->Parent->dob->initialValue;
        $this->Parent->religion->Value = $this->Parent->religion->initialValue;
        $this->Parent->caste->Value = $this->Parent->caste->initialValue;
        $this->Parent->emp_status->Value = $this->Parent->emp_status->initialValue;
        $this->Parent->dno->Value = $this->Parent->dno->initialValue;
        $this->Parent->taluk->Value = $this->Parent->taluk->initialValue;
        $this->Parent->village->Value = $this->Parent->village->initialValue;
        $this->Parent->state->Value = $this->Parent->state->initialValue;
        $this->Parent->district->Value = $this->Parent->district->initialValue;
        $this->Parent->pincode->Value = $this->Parent->pincode->initialValue;
        $this->Parent->mob_no->Value = $this->Parent->mob_no->initialValue;
        $this->Parent->ReportLabel1->Value = $this->Parent->ReportLabel1->initialValue;
        $this->Parent->ReportLabel2->Value = $this->Parent->ReportLabel2->initialValue;
        $this->Parent->ReportLabel3->Value = $this->Parent->ReportLabel3->initialValue;
        $this->Parent->ReportLabel4->Value = $this->Parent->ReportLabel4->initialValue;
        $this->Parent->ReportLabel5->Value = $this->Parent->ReportLabel5->initialValue;
        $this->Parent->ReportLabel6->Value = $this->Parent->ReportLabel6->initialValue;
        $this->Parent->ReportLabel7->Value = $this->Parent->ReportLabel7->initialValue;
        $this->Parent->ReportLabel8->Value = $this->Parent->ReportLabel8->initialValue;
        $this->Parent->ReportLabel9->Value = $this->Parent->ReportLabel9->initialValue;
        $this->Parent->ReportLabel10->Value = $this->Parent->ReportLabel10->initialValue;
        $this->Parent->ReportLabel11->Value = $this->Parent->ReportLabel11->initialValue;
        $this->Parent->ReportLabel12->Value = $this->Parent->ReportLabel12->initialValue;
        $this->Parent->ReportLabel13->Value = $this->Parent->ReportLabel13->initialValue;
        $this->Parent->ReportLabel14->Value = $this->Parent->ReportLabel14->initialValue;
        $this->Parent->ReportLabel15->Value = $this->Parent->ReportLabel15->initialValue;
        $this->Parent->ReportLabel16->Value = $this->Parent->ReportLabel16->initialValue;
        $this->Parent->ReportLabel17->Value = $this->Parent->ReportLabel17->initialValue;
        $this->Parent->ReportLabel18->Value = $this->Parent->ReportLabel18->initialValue;
        $this->Parent->ReportLabel19->Value = $this->Parent->ReportLabel19->initialValue;
        $this->Parent->ReportLabel20->Value = $this->Parent->ReportLabel20->initialValue;
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
//End nps_master GroupsCollection class

class clsReportnps_master { //nps_master Class @2-2BD28A1F

//nps_master Variables @2-A15F14CD

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
//End nps_master Variables

//Class_Initialize Event @2-71AD3080
    function clsReportnps_master($RelativePath = "", & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "nps_master";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->Detail = new clsSection($this);
        $MinPageSize = 0;
        $MaxSectionSize = 0;
        $this->Detail->Height = 1;
        $MaxSectionSize = max($MaxSectionSize, $this->Detail->Height);
        $this->Report_Header = new clsSection($this);
        $this->Page_Footer = new clsSection($this);
        $this->Page_Header = new clsSection($this);
        $this->Page_Header->Height = 1;
        $MinPageSize += $this->Page_Header->Height;
        $this->Errors = new clsErrors();
        $this->DataSource = new clsnps_masterDataSource($this);
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

        $this->sno = new clsControl(ccsReportLabel, "sno", "sno", ccsInteger, "", "", $this);
        $this->branch = new clsControl(ccsReportLabel, "branch", "branch", ccsText, "", "", $this);
        $this->application_no = new clsControl(ccsReportLabel, "application_no", "application_no", ccsText, "", "", $this);
        $this->first_name = new clsControl(ccsLabel, "first_name", "first_name", ccsText, "", CCGetRequestParam("first_name", ccsGet, NULL), $this);
        $this->last_name = new clsControl(ccsLabel, "last_name", "last_name", ccsText, "", CCGetRequestParam("last_name", ccsGet, NULL), $this);
        $this->father_namef = new clsControl(ccsLabel, "father_namef", "father_namef", ccsText, "", CCGetRequestParam("father_namef", ccsGet, NULL), $this);
        $this->father_namel = new clsControl(ccsReportLabel, "father_namel", "father_namel", ccsText, "", "", $this);
        $this->citizen_india = new clsControl(ccsReportLabel, "citizen_india", "citizen_india", ccsText, "", "", $this);
        $this->gender = new clsControl(ccsReportLabel, "gender", "gender", ccsText, "", "", $this);
        $this->marital_status = new clsControl(ccsReportLabel, "marital_status", "marital_status", ccsText, "", "", $this);
        $this->dob = new clsControl(ccsReportLabel, "dob", "dob", ccsText, "", "", $this);
        $this->religion = new clsControl(ccsReportLabel, "religion", "religion", ccsText, "", "", $this);
        $this->caste = new clsControl(ccsReportLabel, "caste", "caste", ccsText, "", "", $this);
        $this->emp_status = new clsControl(ccsReportLabel, "emp_status", "emp_status", ccsText, "", "", $this);
        $this->dno = new clsControl(ccsReportLabel, "dno", "dno", ccsText, "", "", $this);
        $this->taluk = new clsControl(ccsReportLabel, "taluk", "taluk", ccsText, "", "", $this);
        $this->village = new clsControl(ccsReportLabel, "village", "village", ccsText, "", "", $this);
        $this->state = new clsControl(ccsReportLabel, "state", "state", ccsText, "", "", $this);
        $this->district = new clsControl(ccsReportLabel, "district", "district", ccsText, "", "", $this);
        $this->pincode = new clsControl(ccsReportLabel, "pincode", "pincode", ccsInteger, "", "", $this);
        $this->mob_no = new clsControl(ccsReportLabel, "mob_no", "mob_no", ccsText, "", "", $this);
        $this->ReportLabel1 = new clsControl(ccsReportLabel, "ReportLabel1", "ReportLabel1", ccsText, "", "", $this);
        $this->ReportLabel2 = new clsControl(ccsReportLabel, "ReportLabel2", "ReportLabel2", ccsText, "", "", $this);
        $this->ReportLabel3 = new clsControl(ccsReportLabel, "ReportLabel3", "ReportLabel3", ccsText, "", "", $this);
        $this->ReportLabel4 = new clsControl(ccsReportLabel, "ReportLabel4", "ReportLabel4", ccsText, "", "", $this);
        $this->ReportLabel5 = new clsControl(ccsReportLabel, "ReportLabel5", "ReportLabel5", ccsText, "", "", $this);
        $this->ReportLabel6 = new clsControl(ccsReportLabel, "ReportLabel6", "ReportLabel6", ccsText, "", "", $this);
        $this->ReportLabel7 = new clsControl(ccsReportLabel, "ReportLabel7", "ReportLabel7", ccsText, "", "", $this);
        $this->ReportLabel8 = new clsControl(ccsReportLabel, "ReportLabel8", "ReportLabel8", ccsText, "", "", $this);
        $this->ReportLabel9 = new clsControl(ccsReportLabel, "ReportLabel9", "ReportLabel9", ccsText, "", "", $this);
        $this->ReportLabel10 = new clsControl(ccsReportLabel, "ReportLabel10", "ReportLabel10", ccsText, "", "", $this);
        $this->ReportLabel11 = new clsControl(ccsReportLabel, "ReportLabel11", "ReportLabel11", ccsText, "", "", $this);
        $this->ReportLabel12 = new clsControl(ccsReportLabel, "ReportLabel12", "ReportLabel12", ccsText, "", "", $this);
        $this->ReportLabel13 = new clsControl(ccsReportLabel, "ReportLabel13", "ReportLabel13", ccsText, "", "", $this);
        $this->ReportLabel14 = new clsControl(ccsReportLabel, "ReportLabel14", "ReportLabel14", ccsText, "", "", $this);
        $this->ReportLabel15 = new clsControl(ccsReportLabel, "ReportLabel15", "ReportLabel15", ccsText, "", "", $this);
        $this->ReportLabel16 = new clsControl(ccsReportLabel, "ReportLabel16", "ReportLabel16", ccsText, "", "", $this);
        $this->ReportLabel17 = new clsControl(ccsReportLabel, "ReportLabel17", "ReportLabel17", ccsText, "", "", $this);
        $this->ReportLabel18 = new clsControl(ccsReportLabel, "ReportLabel18", "ReportLabel18", ccsText, "", "", $this);
        $this->ReportLabel19 = new clsControl(ccsReportLabel, "ReportLabel19", "ReportLabel19", ccsText, "", "", $this);
        $this->ReportLabel20 = new clsControl(ccsReportLabel, "ReportLabel20", "ReportLabel20", ccsText, "", "", $this);
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

//CheckErrors Method @2-9090E20F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->sno->Errors->Count());
        $errors = ($errors || $this->branch->Errors->Count());
        $errors = ($errors || $this->application_no->Errors->Count());
        $errors = ($errors || $this->first_name->Errors->Count());
        $errors = ($errors || $this->last_name->Errors->Count());
        $errors = ($errors || $this->father_namef->Errors->Count());
        $errors = ($errors || $this->father_namel->Errors->Count());
        $errors = ($errors || $this->citizen_india->Errors->Count());
        $errors = ($errors || $this->gender->Errors->Count());
        $errors = ($errors || $this->marital_status->Errors->Count());
        $errors = ($errors || $this->dob->Errors->Count());
        $errors = ($errors || $this->religion->Errors->Count());
        $errors = ($errors || $this->caste->Errors->Count());
        $errors = ($errors || $this->emp_status->Errors->Count());
        $errors = ($errors || $this->dno->Errors->Count());
        $errors = ($errors || $this->taluk->Errors->Count());
        $errors = ($errors || $this->village->Errors->Count());
        $errors = ($errors || $this->state->Errors->Count());
        $errors = ($errors || $this->district->Errors->Count());
        $errors = ($errors || $this->pincode->Errors->Count());
        $errors = ($errors || $this->mob_no->Errors->Count());
        $errors = ($errors || $this->ReportLabel1->Errors->Count());
        $errors = ($errors || $this->ReportLabel2->Errors->Count());
        $errors = ($errors || $this->ReportLabel3->Errors->Count());
        $errors = ($errors || $this->ReportLabel4->Errors->Count());
        $errors = ($errors || $this->ReportLabel5->Errors->Count());
        $errors = ($errors || $this->ReportLabel6->Errors->Count());
        $errors = ($errors || $this->ReportLabel7->Errors->Count());
        $errors = ($errors || $this->ReportLabel8->Errors->Count());
        $errors = ($errors || $this->ReportLabel9->Errors->Count());
        $errors = ($errors || $this->ReportLabel10->Errors->Count());
        $errors = ($errors || $this->ReportLabel11->Errors->Count());
        $errors = ($errors || $this->ReportLabel12->Errors->Count());
        $errors = ($errors || $this->ReportLabel13->Errors->Count());
        $errors = ($errors || $this->ReportLabel14->Errors->Count());
        $errors = ($errors || $this->ReportLabel15->Errors->Count());
        $errors = ($errors || $this->ReportLabel16->Errors->Count());
        $errors = ($errors || $this->ReportLabel17->Errors->Count());
        $errors = ($errors || $this->ReportLabel18->Errors->Count());
        $errors = ($errors || $this->ReportLabel19->Errors->Count());
        $errors = ($errors || $this->ReportLabel20->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//GetErrors Method @2-D91FAD85
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->sno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->branch->Errors->ToString());
        $errors = ComposeStrings($errors, $this->application_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->first_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->last_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->father_namef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->father_namel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->citizen_india->Errors->ToString());
        $errors = ComposeStrings($errors, $this->gender->Errors->ToString());
        $errors = ComposeStrings($errors, $this->marital_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dob->Errors->ToString());
        $errors = ComposeStrings($errors, $this->religion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->caste->Errors->ToString());
        $errors = ComposeStrings($errors, $this->emp_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dno->Errors->ToString());
        $errors = ComposeStrings($errors, $this->taluk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->village->Errors->ToString());
        $errors = ComposeStrings($errors, $this->state->Errors->ToString());
        $errors = ComposeStrings($errors, $this->district->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pincode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mob_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel6->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel7->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel8->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel9->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel10->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel11->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel12->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel13->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel14->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel15->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel16->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel17->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel18->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel19->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ReportLabel20->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

//Show Method @2-E42FA7D6
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

        $Groups = new clsGroupsCollectionnps_master($this);
        $Groups->PageSize = $this->PageSize > 0 ? $this->PageSize : 0;

        $is_next_record = $this->DataSource->next_record();
        $this->IsEmpty = ! $is_next_record;
        while($is_next_record) {
            $this->DataSource->SetValues();
            $this->sno->SetValue($this->DataSource->sno->GetValue());
            $this->branch->SetValue($this->DataSource->branch->GetValue());
            $this->application_no->SetValue($this->DataSource->application_no->GetValue());
            $this->first_name->SetValue($this->DataSource->first_name->GetValue());
            $this->last_name->SetValue($this->DataSource->last_name->GetValue());
            $this->father_namef->SetValue($this->DataSource->father_namef->GetValue());
            $this->father_namel->SetValue($this->DataSource->father_namel->GetValue());
            $this->citizen_india->SetValue($this->DataSource->citizen_india->GetValue());
            $this->gender->SetValue($this->DataSource->gender->GetValue());
            $this->marital_status->SetValue($this->DataSource->marital_status->GetValue());
            $this->dob->SetValue($this->DataSource->dob->GetValue());
            $this->religion->SetValue($this->DataSource->religion->GetValue());
            $this->caste->SetValue($this->DataSource->caste->GetValue());
            $this->emp_status->SetValue($this->DataSource->emp_status->GetValue());
            $this->dno->SetValue($this->DataSource->dno->GetValue());
            $this->taluk->SetValue($this->DataSource->taluk->GetValue());
            $this->village->SetValue($this->DataSource->village->GetValue());
            $this->state->SetValue($this->DataSource->state->GetValue());
            $this->district->SetValue($this->DataSource->district->GetValue());
            $this->pincode->SetValue($this->DataSource->pincode->GetValue());
            $this->mob_no->SetValue($this->DataSource->mob_no->GetValue());
            $this->ReportLabel1->SetValue($this->DataSource->ReportLabel1->GetValue());
            $this->ReportLabel2->SetValue($this->DataSource->ReportLabel2->GetValue());
            $this->ReportLabel3->SetValue($this->DataSource->ReportLabel3->GetValue());
            $this->ReportLabel4->SetValue($this->DataSource->ReportLabel4->GetValue());
            $this->ReportLabel5->SetValue($this->DataSource->ReportLabel5->GetValue());
            $this->ReportLabel6->SetValue($this->DataSource->ReportLabel6->GetValue());
            $this->ReportLabel7->SetValue($this->DataSource->ReportLabel7->GetValue());
            $this->ReportLabel8->SetValue($this->DataSource->ReportLabel8->GetValue());
            $this->ReportLabel9->SetValue($this->DataSource->ReportLabel9->GetValue());
            $this->ReportLabel10->SetValue($this->DataSource->ReportLabel10->GetValue());
            $this->ReportLabel11->SetValue($this->DataSource->ReportLabel11->GetValue());
            $this->ReportLabel12->SetValue($this->DataSource->ReportLabel12->GetValue());
            $this->ReportLabel13->SetValue($this->DataSource->ReportLabel13->GetValue());
            $this->ReportLabel14->SetValue($this->DataSource->ReportLabel14->GetValue());
            $this->ReportLabel15->SetValue($this->DataSource->ReportLabel15->GetValue());
            $this->ReportLabel16->SetValue($this->DataSource->ReportLabel16->GetValue());
            $this->ReportLabel17->SetValue($this->DataSource->ReportLabel17->GetValue());
            $this->ReportLabel18->SetValue($this->DataSource->ReportLabel18->GetValue());
            $this->ReportLabel19->SetValue($this->DataSource->ReportLabel19->GetValue());
            $this->ReportLabel20->SetValue($this->DataSource->ReportLabel20->GetValue());
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
            $this->ControlsVisible["sno"] = $this->sno->Visible;
            $this->ControlsVisible["branch"] = $this->branch->Visible;
            $this->ControlsVisible["application_no"] = $this->application_no->Visible;
            $this->ControlsVisible["first_name"] = $this->first_name->Visible;
            $this->ControlsVisible["last_name"] = $this->last_name->Visible;
            $this->ControlsVisible["father_namef"] = $this->father_namef->Visible;
            $this->ControlsVisible["father_namel"] = $this->father_namel->Visible;
            $this->ControlsVisible["citizen_india"] = $this->citizen_india->Visible;
            $this->ControlsVisible["gender"] = $this->gender->Visible;
            $this->ControlsVisible["marital_status"] = $this->marital_status->Visible;
            $this->ControlsVisible["dob"] = $this->dob->Visible;
            $this->ControlsVisible["religion"] = $this->religion->Visible;
            $this->ControlsVisible["caste"] = $this->caste->Visible;
            $this->ControlsVisible["emp_status"] = $this->emp_status->Visible;
            $this->ControlsVisible["dno"] = $this->dno->Visible;
            $this->ControlsVisible["taluk"] = $this->taluk->Visible;
            $this->ControlsVisible["village"] = $this->village->Visible;
            $this->ControlsVisible["state"] = $this->state->Visible;
            $this->ControlsVisible["district"] = $this->district->Visible;
            $this->ControlsVisible["pincode"] = $this->pincode->Visible;
            $this->ControlsVisible["mob_no"] = $this->mob_no->Visible;
            $this->ControlsVisible["ReportLabel1"] = $this->ReportLabel1->Visible;
            $this->ControlsVisible["ReportLabel2"] = $this->ReportLabel2->Visible;
            $this->ControlsVisible["ReportLabel3"] = $this->ReportLabel3->Visible;
            $this->ControlsVisible["ReportLabel4"] = $this->ReportLabel4->Visible;
            $this->ControlsVisible["ReportLabel5"] = $this->ReportLabel5->Visible;
            $this->ControlsVisible["ReportLabel6"] = $this->ReportLabel6->Visible;
            $this->ControlsVisible["ReportLabel7"] = $this->ReportLabel7->Visible;
            $this->ControlsVisible["ReportLabel8"] = $this->ReportLabel8->Visible;
            $this->ControlsVisible["ReportLabel9"] = $this->ReportLabel9->Visible;
            $this->ControlsVisible["ReportLabel10"] = $this->ReportLabel10->Visible;
            $this->ControlsVisible["ReportLabel11"] = $this->ReportLabel11->Visible;
            $this->ControlsVisible["ReportLabel12"] = $this->ReportLabel12->Visible;
            $this->ControlsVisible["ReportLabel13"] = $this->ReportLabel13->Visible;
            $this->ControlsVisible["ReportLabel14"] = $this->ReportLabel14->Visible;
            $this->ControlsVisible["ReportLabel15"] = $this->ReportLabel15->Visible;
            $this->ControlsVisible["ReportLabel16"] = $this->ReportLabel16->Visible;
            $this->ControlsVisible["ReportLabel17"] = $this->ReportLabel17->Visible;
            $this->ControlsVisible["ReportLabel18"] = $this->ReportLabel18->Visible;
            $this->ControlsVisible["ReportLabel19"] = $this->ReportLabel19->Visible;
            $this->ControlsVisible["ReportLabel20"] = $this->ReportLabel20->Visible;
            do {
                $this->Attributes->RestoreFromArray($items[$i]->Attributes);
                $this->RowNumber = $items[$i]->RowNumber;
                switch ($items[$i]->GroupType) {
                    Case "":
                        $Tpl->block_path = $ParentPath . "/" . $ReportBlock . "/Section Detail";
                        $this->sno->SetValue($items[$i]->sno);
                        $this->sno->Attributes->RestoreFromArray($items[$i]->_snoAttributes);
                        $this->branch->SetValue($items[$i]->branch);
                        $this->branch->Attributes->RestoreFromArray($items[$i]->_branchAttributes);
                        $this->application_no->SetValue($items[$i]->application_no);
                        $this->application_no->Attributes->RestoreFromArray($items[$i]->_application_noAttributes);
                        $this->first_name->SetValue($items[$i]->first_name);
                        $this->first_name->Attributes->RestoreFromArray($items[$i]->_first_nameAttributes);
                        $this->last_name->SetValue($items[$i]->last_name);
                        $this->last_name->Attributes->RestoreFromArray($items[$i]->_last_nameAttributes);
                        $this->father_namef->SetValue($items[$i]->father_namef);
                        $this->father_namef->Attributes->RestoreFromArray($items[$i]->_father_namefAttributes);
                        $this->father_namel->SetValue($items[$i]->father_namel);
                        $this->father_namel->Attributes->RestoreFromArray($items[$i]->_father_namelAttributes);
                        $this->citizen_india->SetValue($items[$i]->citizen_india);
                        $this->citizen_india->Attributes->RestoreFromArray($items[$i]->_citizen_indiaAttributes);
                        $this->gender->SetValue($items[$i]->gender);
                        $this->gender->Attributes->RestoreFromArray($items[$i]->_genderAttributes);
                        $this->marital_status->SetValue($items[$i]->marital_status);
                        $this->marital_status->Attributes->RestoreFromArray($items[$i]->_marital_statusAttributes);
                        $this->dob->SetValue($items[$i]->dob);
                        $this->dob->Attributes->RestoreFromArray($items[$i]->_dobAttributes);
                        $this->religion->SetValue($items[$i]->religion);
                        $this->religion->Attributes->RestoreFromArray($items[$i]->_religionAttributes);
                        $this->caste->SetValue($items[$i]->caste);
                        $this->caste->Attributes->RestoreFromArray($items[$i]->_casteAttributes);
                        $this->emp_status->SetValue($items[$i]->emp_status);
                        $this->emp_status->Attributes->RestoreFromArray($items[$i]->_emp_statusAttributes);
                        $this->dno->SetValue($items[$i]->dno);
                        $this->dno->Attributes->RestoreFromArray($items[$i]->_dnoAttributes);
                        $this->taluk->SetValue($items[$i]->taluk);
                        $this->taluk->Attributes->RestoreFromArray($items[$i]->_talukAttributes);
                        $this->village->SetValue($items[$i]->village);
                        $this->village->Attributes->RestoreFromArray($items[$i]->_villageAttributes);
                        $this->state->SetValue($items[$i]->state);
                        $this->state->Attributes->RestoreFromArray($items[$i]->_stateAttributes);
                        $this->district->SetValue($items[$i]->district);
                        $this->district->Attributes->RestoreFromArray($items[$i]->_districtAttributes);
                        $this->pincode->SetValue($items[$i]->pincode);
                        $this->pincode->Attributes->RestoreFromArray($items[$i]->_pincodeAttributes);
                        $this->mob_no->SetValue($items[$i]->mob_no);
                        $this->mob_no->Attributes->RestoreFromArray($items[$i]->_mob_noAttributes);
                        $this->ReportLabel1->SetValue($items[$i]->ReportLabel1);
                        $this->ReportLabel1->Attributes->RestoreFromArray($items[$i]->_ReportLabel1Attributes);
                        $this->ReportLabel2->SetValue($items[$i]->ReportLabel2);
                        $this->ReportLabel2->Attributes->RestoreFromArray($items[$i]->_ReportLabel2Attributes);
                        $this->ReportLabel3->SetValue($items[$i]->ReportLabel3);
                        $this->ReportLabel3->Attributes->RestoreFromArray($items[$i]->_ReportLabel3Attributes);
                        $this->ReportLabel4->SetValue($items[$i]->ReportLabel4);
                        $this->ReportLabel4->Attributes->RestoreFromArray($items[$i]->_ReportLabel4Attributes);
                        $this->ReportLabel5->SetValue($items[$i]->ReportLabel5);
                        $this->ReportLabel5->Attributes->RestoreFromArray($items[$i]->_ReportLabel5Attributes);
                        $this->ReportLabel6->SetValue($items[$i]->ReportLabel6);
                        $this->ReportLabel6->Attributes->RestoreFromArray($items[$i]->_ReportLabel6Attributes);
                        $this->ReportLabel7->SetValue($items[$i]->ReportLabel7);
                        $this->ReportLabel7->Attributes->RestoreFromArray($items[$i]->_ReportLabel7Attributes);
                        $this->ReportLabel8->SetValue($items[$i]->ReportLabel8);
                        $this->ReportLabel8->Attributes->RestoreFromArray($items[$i]->_ReportLabel8Attributes);
                        $this->ReportLabel9->SetValue($items[$i]->ReportLabel9);
                        $this->ReportLabel9->Attributes->RestoreFromArray($items[$i]->_ReportLabel9Attributes);
                        $this->ReportLabel10->SetValue($items[$i]->ReportLabel10);
                        $this->ReportLabel10->Attributes->RestoreFromArray($items[$i]->_ReportLabel10Attributes);
                        $this->ReportLabel11->SetValue($items[$i]->ReportLabel11);
                        $this->ReportLabel11->Attributes->RestoreFromArray($items[$i]->_ReportLabel11Attributes);
                        $this->ReportLabel12->SetValue($items[$i]->ReportLabel12);
                        $this->ReportLabel12->Attributes->RestoreFromArray($items[$i]->_ReportLabel12Attributes);
                        $this->ReportLabel13->SetValue($items[$i]->ReportLabel13);
                        $this->ReportLabel13->Attributes->RestoreFromArray($items[$i]->_ReportLabel13Attributes);
                        $this->ReportLabel14->SetValue($items[$i]->ReportLabel14);
                        $this->ReportLabel14->Attributes->RestoreFromArray($items[$i]->_ReportLabel14Attributes);
                        $this->ReportLabel15->SetValue($items[$i]->ReportLabel15);
                        $this->ReportLabel15->Attributes->RestoreFromArray($items[$i]->_ReportLabel15Attributes);
                        $this->ReportLabel16->SetValue($items[$i]->ReportLabel16);
                        $this->ReportLabel16->Attributes->RestoreFromArray($items[$i]->_ReportLabel16Attributes);
                        $this->ReportLabel17->SetValue($items[$i]->ReportLabel17);
                        $this->ReportLabel17->Attributes->RestoreFromArray($items[$i]->_ReportLabel17Attributes);
                        $this->ReportLabel18->SetValue($items[$i]->ReportLabel18);
                        $this->ReportLabel18->Attributes->RestoreFromArray($items[$i]->_ReportLabel18Attributes);
                        $this->ReportLabel19->SetValue($items[$i]->ReportLabel19);
                        $this->ReportLabel19->Attributes->RestoreFromArray($items[$i]->_ReportLabel19Attributes);
                        $this->ReportLabel20->SetValue($items[$i]->ReportLabel20);
                        $this->ReportLabel20->Attributes->RestoreFromArray($items[$i]->_ReportLabel20Attributes);
                        $this->Detail->CCSEventResult = CCGetEvent($this->Detail->CCSEvents, "BeforeShow", $this->Detail);
                        $this->Attributes->Show();
                        $this->sno->Show();
                        $this->branch->Show();
                        $this->application_no->Show();
                        $this->first_name->Show();
                        $this->last_name->Show();
                        $this->father_namef->Show();
                        $this->father_namel->Show();
                        $this->citizen_india->Show();
                        $this->gender->Show();
                        $this->marital_status->Show();
                        $this->dob->Show();
                        $this->religion->Show();
                        $this->caste->Show();
                        $this->emp_status->Show();
                        $this->dno->Show();
                        $this->taluk->Show();
                        $this->village->Show();
                        $this->state->Show();
                        $this->district->Show();
                        $this->pincode->Show();
                        $this->mob_no->Show();
                        $this->ReportLabel1->Show();
                        $this->ReportLabel2->Show();
                        $this->ReportLabel3->Show();
                        $this->ReportLabel4->Show();
                        $this->ReportLabel5->Show();
                        $this->ReportLabel6->Show();
                        $this->ReportLabel7->Show();
                        $this->ReportLabel8->Show();
                        $this->ReportLabel9->Show();
                        $this->ReportLabel10->Show();
                        $this->ReportLabel11->Show();
                        $this->ReportLabel12->Show();
                        $this->ReportLabel13->Show();
                        $this->ReportLabel14->Show();
                        $this->ReportLabel15->Show();
                        $this->ReportLabel16->Show();
                        $this->ReportLabel17->Show();
                        $this->ReportLabel18->Show();
                        $this->ReportLabel19->Show();
                        $this->ReportLabel20->Show();
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

} //End nps_master Class @2-FCB6E20C

class clsnps_masterDataSource extends clsDBmysql_cams_v2 {  //nps_masterDataSource Class @2-CC1CE9A0

//DataSource Variables @2-FFC93848
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;


    // Datasource fields
    public $sno;
    public $branch;
    public $application_no;
    public $first_name;
    public $last_name;
    public $father_namef;
    public $father_namel;
    public $citizen_india;
    public $gender;
    public $marital_status;
    public $dob;
    public $religion;
    public $caste;
    public $emp_status;
    public $dno;
    public $taluk;
    public $village;
    public $state;
    public $district;
    public $pincode;
    public $mob_no;
    public $ReportLabel1;
    public $ReportLabel2;
    public $ReportLabel3;
    public $ReportLabel4;
    public $ReportLabel5;
    public $ReportLabel6;
    public $ReportLabel7;
    public $ReportLabel8;
    public $ReportLabel9;
    public $ReportLabel10;
    public $ReportLabel11;
    public $ReportLabel12;
    public $ReportLabel13;
    public $ReportLabel14;
    public $ReportLabel15;
    public $ReportLabel16;
    public $ReportLabel17;
    public $ReportLabel18;
    public $ReportLabel19;
    public $ReportLabel20;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3D6907F9
    function clsnps_masterDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Report nps_master";
        $this->Initialize();
        $this->sno = new clsField("sno", ccsInteger, "");
        
        $this->branch = new clsField("branch", ccsText, "");
        
        $this->application_no = new clsField("application_no", ccsText, "");
        
        $this->first_name = new clsField("first_name", ccsText, "");
        
        $this->last_name = new clsField("last_name", ccsText, "");
        
        $this->father_namef = new clsField("father_namef", ccsText, "");
        
        $this->father_namel = new clsField("father_namel", ccsText, "");
        
        $this->citizen_india = new clsField("citizen_india", ccsText, "");
        
        $this->gender = new clsField("gender", ccsText, "");
        
        $this->marital_status = new clsField("marital_status", ccsText, "");
        
        $this->dob = new clsField("dob", ccsText, "");
        
        $this->religion = new clsField("religion", ccsText, "");
        
        $this->caste = new clsField("caste", ccsText, "");
        
        $this->emp_status = new clsField("emp_status", ccsText, "");
        
        $this->dno = new clsField("dno", ccsText, "");
        
        $this->taluk = new clsField("taluk", ccsText, "");
        
        $this->village = new clsField("village", ccsText, "");
        
        $this->state = new clsField("state", ccsText, "");
        
        $this->district = new clsField("district", ccsText, "");
        
        $this->pincode = new clsField("pincode", ccsInteger, "");
        
        $this->mob_no = new clsField("mob_no", ccsText, "");
        
        $this->ReportLabel1 = new clsField("ReportLabel1", ccsText, "");
        
        $this->ReportLabel2 = new clsField("ReportLabel2", ccsText, "");
        
        $this->ReportLabel3 = new clsField("ReportLabel3", ccsText, "");
        
        $this->ReportLabel4 = new clsField("ReportLabel4", ccsText, "");
        
        $this->ReportLabel5 = new clsField("ReportLabel5", ccsText, "");
        
        $this->ReportLabel6 = new clsField("ReportLabel6", ccsText, "");
        
        $this->ReportLabel7 = new clsField("ReportLabel7", ccsText, "");
        
        $this->ReportLabel8 = new clsField("ReportLabel8", ccsText, "");
        
        $this->ReportLabel9 = new clsField("ReportLabel9", ccsText, "");
        
        $this->ReportLabel10 = new clsField("ReportLabel10", ccsText, "");
        
        $this->ReportLabel11 = new clsField("ReportLabel11", ccsText, "");
        
        $this->ReportLabel12 = new clsField("ReportLabel12", ccsText, "");
        
        $this->ReportLabel13 = new clsField("ReportLabel13", ccsText, "");
        
        $this->ReportLabel14 = new clsField("ReportLabel14", ccsText, "");
        
        $this->ReportLabel15 = new clsField("ReportLabel15", ccsText, "");
        
        $this->ReportLabel16 = new clsField("ReportLabel16", ccsText, "");
        
        $this->ReportLabel17 = new clsField("ReportLabel17", ccsText, "");
        
        $this->ReportLabel18 = new clsField("ReportLabel18", ccsText, "");
        
        $this->ReportLabel19 = new clsField("ReportLabel19", ccsText, "");
        
        $this->ReportLabel20 = new clsField("ReportLabel20", ccsText, "");
        

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

//Prepare Method @2-56A9FACA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urllano", ccsText, "", "", $this->Parameters["urllano"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "lano", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-5572AE21
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM nps_master {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-2D166B40
    function SetValues()
    {
        $this->sno->SetDBValue(trim($this->f("sno")));
        $this->branch->SetDBValue($this->f("branch"));
        $this->application_no->SetDBValue($this->f("application_no"));
        $this->first_name->SetDBValue($this->f("first_name"));
        $this->last_name->SetDBValue($this->f("last_name"));
        $this->father_namef->SetDBValue($this->f("father_namef"));
        $this->father_namel->SetDBValue($this->f("father_namel"));
        $this->citizen_india->SetDBValue($this->f("citizen_india"));
        $this->gender->SetDBValue($this->f("gender"));
        $this->marital_status->SetDBValue($this->f("marital_status"));
        $this->dob->SetDBValue($this->f("dob"));
        $this->religion->SetDBValue($this->f("religion"));
        $this->caste->SetDBValue($this->f("caste"));
        $this->emp_status->SetDBValue($this->f("emp_status"));
        $this->dno->SetDBValue($this->f("dno"));
        $this->taluk->SetDBValue($this->f("taluk"));
        $this->village->SetDBValue($this->f("village"));
        $this->state->SetDBValue($this->f("state"));
        $this->district->SetDBValue($this->f("district"));
        $this->pincode->SetDBValue(trim($this->f("pincode")));
        $this->mob_no->SetDBValue($this->f("mob_no"));
        $this->ReportLabel1->SetDBValue($this->f("nominee_namef"));
        $this->ReportLabel2->SetDBValue($this->f("nominee_namem"));
        $this->ReportLabel3->SetDBValue($this->f("nominee_namel"));
        $this->ReportLabel4->SetDBValue($this->f("relation"));
        $this->ReportLabel5->SetDBValue($this->f("place"));
        $this->ReportLabel6->SetDBValue($this->f("nlcc_regn_no"));
        $this->ReportLabel7->SetDBValue($this->f("first_name"));
        $this->ReportLabel8->SetDBValue($this->f("last_name"));
        $this->ReportLabel9->SetDBValue($this->f("disbursement_date"));
        $this->ReportLabel10->SetDBValue($this->f("first_name"));
        $this->ReportLabel11->SetDBValue($this->f("last_name"));
        $this->ReportLabel12->SetDBValue($this->f("disbursement_date"));
        $this->ReportLabel13->SetDBValue($this->f("place"));
        $this->ReportLabel14->SetDBValue($this->f("disbursement_date"));
        $this->ReportLabel15->SetDBValue($this->f("first_name"));
        $this->ReportLabel16->SetDBValue($this->f("last_name"));
        $this->ReportLabel17->SetDBValue($this->f("middle_name"));
        $this->ReportLabel18->SetDBValue($this->f("father_mname"));
        $this->ReportLabel19->SetDBValue($this->f("first_name"));
        $this->ReportLabel20->SetDBValue($this->f("last_name"));
    }
//End SetValues Method

} //End nps_masterDataSource Class @2-FCB6E20C

//Initialize Page @1-70CD7AE4
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
$TemplateFileName = "NPSREPORT.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D2D84614
include_once("./NPSREPORT_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A7B97536
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$nps_master = new clsReportnps_master("", $MainPage);
$MainPage->nps_master = & $nps_master;
$nps_master->Initialize();

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

//Go to destination page @1-6B76AF1F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($nps_master);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1EAA5B59
$nps_master->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C47A96D7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($nps_master);
unset($Tpl);
//End Unload Page


?>
