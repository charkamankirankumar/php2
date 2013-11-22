<?php
//Include Common Files @1-EBE8367C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "CBEnquiryPage.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-9CFED1A6
include_once(RelativePath . "/./incHeader.php");
//End Include Page implementation

//Include Page implementation @3-F9F79F99
include_once(RelativePath . "/./incFooter.php");
//End Include Page implementation

//Include Page implementation @4-D1FB8BC8
include_once(RelativePath . "/incMenu.php");
//End Include Page implementation

class clsGridcams_himark_view { //cams_himark_view class @5-57E769B6

//Variables @5-510A673C

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_Applicant_Age;
    public $Sorter_Applicant_Age_asondate;
//End Variables

//Class_Initialize Event @5-F58EF202
    function clsGridcams_himark_view($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "cams_himark_view";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid cams_himark_view";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscams_himark_viewDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("cams_himark_viewOrder", "");
        $this->SorterDirection = CCGetParam("cams_himark_viewDir", "");

        $this->Segment_Identifier = new clsControl(ccsLabel, "Segment_Identifier", "Segment_Identifier", ccsText, "", CCGetRequestParam("Segment_Identifier", ccsGet, NULL), $this);
        $this->Credit_Request_Type = new clsControl(ccsLabel, "Credit_Request_Type", "Credit_Request_Type", ccsMemo, "", CCGetRequestParam("Credit_Request_Type", ccsGet, NULL), $this);
        $this->Credit_Report_Transaction_ID = new clsControl(ccsLabel, "Credit_Report_Transaction_ID", "Credit_Report_Transaction_ID", ccsMemo, "", CCGetRequestParam("Credit_Report_Transaction_ID", ccsGet, NULL), $this);
        $this->Credit_Inquiry_Purpose_Type = new clsControl(ccsLabel, "Credit_Inquiry_Purpose_Type", "Credit_Inquiry_Purpose_Type", ccsMemo, "", CCGetRequestParam("Credit_Inquiry_Purpose_Type", ccsGet, NULL), $this);
        $this->Credit_Inquiry_Purpose_Type_Description = new clsControl(ccsLabel, "Credit_Inquiry_Purpose_Type_Description", "Credit_Inquiry_Purpose_Type_Description", ccsMemo, "", CCGetRequestParam("Credit_Inquiry_Purpose_Type_Description", ccsGet, NULL), $this);
        $this->Credit_Inquiry_Stage = new clsControl(ccsLabel, "Credit_Inquiry_Stage", "Credit_Inquiry_Stage", ccsMemo, "", CCGetRequestParam("Credit_Inquiry_Stage", ccsGet, NULL), $this);
        $this->Credit_Report_Transaction_DateTime = new clsControl(ccsLabel, "Credit_Report_Transaction_DateTime", "Credit_Report_Transaction_DateTime", ccsMemo, "", CCGetRequestParam("Credit_Report_Transaction_DateTime", ccsGet, NULL), $this);
        $this->Applicant_Name1 = new clsControl(ccsLabel, "Applicant_Name1", "Applicant_Name1", ccsMemo, "", CCGetRequestParam("Applicant_Name1", ccsGet, NULL), $this);
        $this->Applicant_Name2 = new clsControl(ccsLabel, "Applicant_Name2", "Applicant_Name2", ccsMemo, "", CCGetRequestParam("Applicant_Name2", ccsGet, NULL), $this);
        $this->Applicant_Name3 = new clsControl(ccsLabel, "Applicant_Name3", "Applicant_Name3", ccsMemo, "", CCGetRequestParam("Applicant_Name3", ccsGet, NULL), $this);
        $this->Applicant_Name4 = new clsControl(ccsLabel, "Applicant_Name4", "Applicant_Name4", ccsMemo, "", CCGetRequestParam("Applicant_Name4", ccsGet, NULL), $this);
        $this->Applicant_Name5 = new clsControl(ccsLabel, "Applicant_Name5", "Applicant_Name5", ccsMemo, "", CCGetRequestParam("Applicant_Name5", ccsGet, NULL), $this);
        $this->Member_Father_Name = new clsControl(ccsLabel, "Member_Father_Name", "Member_Father_Name", ccsMemo, "", CCGetRequestParam("Member_Father_Name", ccsGet, NULL), $this);
        $this->Member_Mother_Name = new clsControl(ccsLabel, "Member_Mother_Name", "Member_Mother_Name", ccsMemo, "", CCGetRequestParam("Member_Mother_Name", ccsGet, NULL), $this);
        $this->Member_Spouse_Name = new clsControl(ccsLabel, "Member_Spouse_Name", "Member_Spouse_Name", ccsMemo, "", CCGetRequestParam("Member_Spouse_Name", ccsGet, NULL), $this);
        $this->Member_relationship_Type1 = new clsControl(ccsLabel, "Member_relationship_Type1", "Member_relationship_Type1", ccsMemo, "", CCGetRequestParam("Member_relationship_Type1", ccsGet, NULL), $this);
        $this->Member_relationship_Name1 = new clsControl(ccsLabel, "Member_relationship_Name1", "Member_relationship_Name1", ccsMemo, "", CCGetRequestParam("Member_relationship_Name1", ccsGet, NULL), $this);
        $this->Member_relationship_Type2 = new clsControl(ccsLabel, "Member_relationship_Type2", "Member_relationship_Type2", ccsMemo, "", CCGetRequestParam("Member_relationship_Type2", ccsGet, NULL), $this);
        $this->Member_relationship_Name2 = new clsControl(ccsLabel, "Member_relationship_Name2", "Member_relationship_Name2", ccsMemo, "", CCGetRequestParam("Member_relationship_Name2", ccsGet, NULL), $this);
        $this->Member_relationship_Type3 = new clsControl(ccsLabel, "Member_relationship_Type3", "Member_relationship_Type3", ccsMemo, "", CCGetRequestParam("Member_relationship_Type3", ccsGet, NULL), $this);
        $this->Member_relationship_Name3 = new clsControl(ccsLabel, "Member_relationship_Name3", "Member_relationship_Name3", ccsMemo, "", CCGetRequestParam("Member_relationship_Name3", ccsGet, NULL), $this);
        $this->Member_relationship_Type4 = new clsControl(ccsLabel, "Member_relationship_Type4", "Member_relationship_Type4", ccsMemo, "", CCGetRequestParam("Member_relationship_Type4", ccsGet, NULL), $this);
        $this->Member_relationship_Name4 = new clsControl(ccsLabel, "Member_relationship_Name4", "Member_relationship_Name4", ccsMemo, "", CCGetRequestParam("Member_relationship_Name4", ccsGet, NULL), $this);
        $this->Applicant_BirthDate = new clsControl(ccsLabel, "Applicant_BirthDate", "Applicant_BirthDate", ccsMemo, "", CCGetRequestParam("Applicant_BirthDate", ccsGet, NULL), $this);
        $this->Applicant_Age = new clsControl(ccsLabel, "Applicant_Age", "Applicant_Age", ccsFloat, "", CCGetRequestParam("Applicant_Age", ccsGet, NULL), $this);
        $this->Applicant_Age_asondate = new clsControl(ccsLabel, "Applicant_Age_asondate", "Applicant_Age_asondate", ccsDate, $DefaultDateFormat, CCGetRequestParam("Applicant_Age_asondate", ccsGet, NULL), $this);
        $this->Applicant_ID_Type1 = new clsControl(ccsLabel, "Applicant_ID_Type1", "Applicant_ID_Type1", ccsMemo, "", CCGetRequestParam("Applicant_ID_Type1", ccsGet, NULL), $this);
        $this->Applicant_ID1 = new clsControl(ccsLabel, "Applicant_ID1", "Applicant_ID1", ccsMemo, "", CCGetRequestParam("Applicant_ID1", ccsGet, NULL), $this);
        $this->Applicant_ID_Type2 = new clsControl(ccsLabel, "Applicant_ID_Type2", "Applicant_ID_Type2", ccsMemo, "", CCGetRequestParam("Applicant_ID_Type2", ccsGet, NULL), $this);
        $this->Applicant_ID2 = new clsControl(ccsLabel, "Applicant_ID2", "Applicant_ID2", ccsMemo, "", CCGetRequestParam("Applicant_ID2", ccsGet, NULL), $this);
        $this->Acct_Open_Date = new clsControl(ccsLabel, "Acct_Open_Date", "Acct_Open_Date", ccsMemo, "", CCGetRequestParam("Acct_Open_Date", ccsGet, NULL), $this);
        $this->Application_ID_AccountNo = new clsControl(ccsLabel, "Application_ID_AccountNo", "Application_ID_AccountNo", ccsMemo, "", CCGetRequestParam("Application_ID_AccountNo", ccsGet, NULL), $this);
        $this->Branch_ID = new clsControl(ccsLabel, "Branch_ID", "Branch_ID", ccsMemo, "", CCGetRequestParam("Branch_ID", ccsGet, NULL), $this);
        $this->Member_ID = new clsControl(ccsLabel, "Member_ID", "Member_ID", ccsMemo, "", CCGetRequestParam("Member_ID", ccsGet, NULL), $this);
        $this->Kendra_ID = new clsControl(ccsLabel, "Kendra_ID", "Kendra_ID", ccsMemo, "", CCGetRequestParam("Kendra_ID", ccsGet, NULL), $this);
        $this->Applied_for_amt_Current_balance = new clsControl(ccsLabel, "Applied_for_amt_Current_balance", "Applied_for_amt_Current_balance", ccsMemo, "", CCGetRequestParam("Applied_for_amt_Current_balance", ccsGet, NULL), $this);
        $this->KeyPerson_Name = new clsControl(ccsLabel, "KeyPerson_Name", "KeyPerson_Name", ccsMemo, "", CCGetRequestParam("KeyPerson_Name", ccsGet, NULL), $this);
        $this->KeyPerson_Relation = new clsControl(ccsLabel, "KeyPerson_Relation", "KeyPerson_Relation", ccsMemo, "", CCGetRequestParam("KeyPerson_Relation", ccsGet, NULL), $this);
        $this->Nominee_Name = new clsControl(ccsLabel, "Nominee_Name", "Nominee_Name", ccsMemo, "", CCGetRequestParam("Nominee_Name", ccsGet, NULL), $this);
        $this->Nominee_Relationship_Type = new clsControl(ccsLabel, "Nominee_Relationship_Type", "Nominee_Relationship_Type", ccsMemo, "", CCGetRequestParam("Nominee_Relationship_Type", ccsGet, NULL), $this);
        $this->Applicant_Telephone_Number_Type1 = new clsControl(ccsLabel, "Applicant_Telephone_Number_Type1", "Applicant_Telephone_Number_Type1", ccsMemo, "", CCGetRequestParam("Applicant_Telephone_Number_Type1", ccsGet, NULL), $this);
        $this->Applicant_Telephone_Number1 = new clsControl(ccsLabel, "Applicant_Telephone_Number1", "Applicant_Telephone_Number1", ccsMemo, "", CCGetRequestParam("Applicant_Telephone_Number1", ccsGet, NULL), $this);
        $this->Applicant_Telephone_Number_Type2 = new clsControl(ccsLabel, "Applicant_Telephone_Number_Type2", "Applicant_Telephone_Number_Type2", ccsMemo, "", CCGetRequestParam("Applicant_Telephone_Number_Type2", ccsGet, NULL), $this);
        $this->Applicant_Telephone_Number2 = new clsControl(ccsLabel, "Applicant_Telephone_Number2", "Applicant_Telephone_Number2", ccsMemo, "", CCGetRequestParam("Applicant_Telephone_Number2", ccsGet, NULL), $this);
        $this->Applicant_Address_Type1 = new clsControl(ccsLabel, "Applicant_Address_Type1", "Applicant_Address_Type1", ccsMemo, "", CCGetRequestParam("Applicant_Address_Type1", ccsGet, NULL), $this);
        $this->Applicant_Address1 = new clsControl(ccsLabel, "Applicant_Address1", "Applicant_Address1", ccsMemo, "", CCGetRequestParam("Applicant_Address1", ccsGet, NULL), $this);
        $this->Applicant_Address1_City = new clsControl(ccsLabel, "Applicant_Address1_City", "Applicant_Address1_City", ccsMemo, "", CCGetRequestParam("Applicant_Address1_City", ccsGet, NULL), $this);
        $this->Applicant_Address1_State = new clsControl(ccsLabel, "Applicant_Address1_State", "Applicant_Address1_State", ccsMemo, "", CCGetRequestParam("Applicant_Address1_State", ccsGet, NULL), $this);
        $this->Applicant_Address1_PINCode = new clsControl(ccsLabel, "Applicant_Address1_PINCode", "Applicant_Address1_PINCode", ccsMemo, "", CCGetRequestParam("Applicant_Address1_PINCode", ccsGet, NULL), $this);
        $this->Applicant_Address_Type2 = new clsControl(ccsLabel, "Applicant_Address_Type2", "Applicant_Address_Type2", ccsMemo, "", CCGetRequestParam("Applicant_Address_Type2", ccsGet, NULL), $this);
        $this->Applicant_Address2 = new clsControl(ccsLabel, "Applicant_Address2", "Applicant_Address2", ccsMemo, "", CCGetRequestParam("Applicant_Address2", ccsGet, NULL), $this);
        $this->Applicant_Address2_City = new clsControl(ccsLabel, "Applicant_Address2_City", "Applicant_Address2_City", ccsMemo, "", CCGetRequestParam("Applicant_Address2_City", ccsGet, NULL), $this);
        $this->Applicant_Address2_State = new clsControl(ccsLabel, "Applicant_Address2_State", "Applicant_Address2_State", ccsMemo, "", CCGetRequestParam("Applicant_Address2_State", ccsGet, NULL), $this);
        $this->Applicant_Address2_PINCode = new clsControl(ccsLabel, "Applicant_Address2_PINCode", "Applicant_Address2_PINCode", ccsMemo, "", CCGetRequestParam("Applicant_Address2_PINCode", ccsGet, NULL), $this);
        $this->cams_himark_view_TotalRecords = new clsControl(ccsLabel, "cams_himark_view_TotalRecords", "cams_himark_view_TotalRecords", ccsText, "", CCGetRequestParam("cams_himark_view_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_Applicant_Age = new clsSorter($this->ComponentName, "Sorter_Applicant_Age", $FileName, $this);
        $this->Sorter_Applicant_Age_asondate = new clsSorter($this->ComponentName, "Sorter_Applicant_Age_asondate", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @5-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @5-711DB69C
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_Branch_ID"] = CCGetFromGet("s_Branch_ID", NULL);
        $this->DataSource->Parameters["urls_Member_ID"] = CCGetFromGet("s_Member_ID", NULL);
        $this->DataSource->Parameters["urls_Kendra_ID"] = CCGetFromGet("s_Kendra_ID", NULL);
        $this->DataSource->Parameters["urls_Enquiry_Add_at"] = CCGetFromGet("s_Enquiry_Add_at", NULL);
        $this->DataSource->Parameters["urls_enquiry_status"] = CCGetFromGet("s_enquiry_status", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["Segment_Identifier"] = $this->Segment_Identifier->Visible;
            $this->ControlsVisible["Credit_Request_Type"] = $this->Credit_Request_Type->Visible;
            $this->ControlsVisible["Credit_Report_Transaction_ID"] = $this->Credit_Report_Transaction_ID->Visible;
            $this->ControlsVisible["Credit_Inquiry_Purpose_Type"] = $this->Credit_Inquiry_Purpose_Type->Visible;
            $this->ControlsVisible["Credit_Inquiry_Purpose_Type_Description"] = $this->Credit_Inquiry_Purpose_Type_Description->Visible;
            $this->ControlsVisible["Credit_Inquiry_Stage"] = $this->Credit_Inquiry_Stage->Visible;
            $this->ControlsVisible["Credit_Report_Transaction_DateTime"] = $this->Credit_Report_Transaction_DateTime->Visible;
            $this->ControlsVisible["Applicant_Name1"] = $this->Applicant_Name1->Visible;
            $this->ControlsVisible["Applicant_Name2"] = $this->Applicant_Name2->Visible;
            $this->ControlsVisible["Applicant_Name3"] = $this->Applicant_Name3->Visible;
            $this->ControlsVisible["Applicant_Name4"] = $this->Applicant_Name4->Visible;
            $this->ControlsVisible["Applicant_Name5"] = $this->Applicant_Name5->Visible;
            $this->ControlsVisible["Member_Father_Name"] = $this->Member_Father_Name->Visible;
            $this->ControlsVisible["Member_Mother_Name"] = $this->Member_Mother_Name->Visible;
            $this->ControlsVisible["Member_Spouse_Name"] = $this->Member_Spouse_Name->Visible;
            $this->ControlsVisible["Member_relationship_Type1"] = $this->Member_relationship_Type1->Visible;
            $this->ControlsVisible["Member_relationship_Name1"] = $this->Member_relationship_Name1->Visible;
            $this->ControlsVisible["Member_relationship_Type2"] = $this->Member_relationship_Type2->Visible;
            $this->ControlsVisible["Member_relationship_Name2"] = $this->Member_relationship_Name2->Visible;
            $this->ControlsVisible["Member_relationship_Type3"] = $this->Member_relationship_Type3->Visible;
            $this->ControlsVisible["Member_relationship_Name3"] = $this->Member_relationship_Name3->Visible;
            $this->ControlsVisible["Member_relationship_Type4"] = $this->Member_relationship_Type4->Visible;
            $this->ControlsVisible["Member_relationship_Name4"] = $this->Member_relationship_Name4->Visible;
            $this->ControlsVisible["Applicant_BirthDate"] = $this->Applicant_BirthDate->Visible;
            $this->ControlsVisible["Applicant_Age"] = $this->Applicant_Age->Visible;
            $this->ControlsVisible["Applicant_Age_asondate"] = $this->Applicant_Age_asondate->Visible;
            $this->ControlsVisible["Applicant_ID_Type1"] = $this->Applicant_ID_Type1->Visible;
            $this->ControlsVisible["Applicant_ID1"] = $this->Applicant_ID1->Visible;
            $this->ControlsVisible["Applicant_ID_Type2"] = $this->Applicant_ID_Type2->Visible;
            $this->ControlsVisible["Applicant_ID2"] = $this->Applicant_ID2->Visible;
            $this->ControlsVisible["Acct_Open_Date"] = $this->Acct_Open_Date->Visible;
            $this->ControlsVisible["Application_ID_AccountNo"] = $this->Application_ID_AccountNo->Visible;
            $this->ControlsVisible["Branch_ID"] = $this->Branch_ID->Visible;
            $this->ControlsVisible["Member_ID"] = $this->Member_ID->Visible;
            $this->ControlsVisible["Kendra_ID"] = $this->Kendra_ID->Visible;
            $this->ControlsVisible["Applied_for_amt_Current_balance"] = $this->Applied_for_amt_Current_balance->Visible;
            $this->ControlsVisible["KeyPerson_Name"] = $this->KeyPerson_Name->Visible;
            $this->ControlsVisible["KeyPerson_Relation"] = $this->KeyPerson_Relation->Visible;
            $this->ControlsVisible["Nominee_Name"] = $this->Nominee_Name->Visible;
            $this->ControlsVisible["Nominee_Relationship_Type"] = $this->Nominee_Relationship_Type->Visible;
            $this->ControlsVisible["Applicant_Telephone_Number_Type1"] = $this->Applicant_Telephone_Number_Type1->Visible;
            $this->ControlsVisible["Applicant_Telephone_Number1"] = $this->Applicant_Telephone_Number1->Visible;
            $this->ControlsVisible["Applicant_Telephone_Number_Type2"] = $this->Applicant_Telephone_Number_Type2->Visible;
            $this->ControlsVisible["Applicant_Telephone_Number2"] = $this->Applicant_Telephone_Number2->Visible;
            $this->ControlsVisible["Applicant_Address_Type1"] = $this->Applicant_Address_Type1->Visible;
            $this->ControlsVisible["Applicant_Address1"] = $this->Applicant_Address1->Visible;
            $this->ControlsVisible["Applicant_Address1_City"] = $this->Applicant_Address1_City->Visible;
            $this->ControlsVisible["Applicant_Address1_State"] = $this->Applicant_Address1_State->Visible;
            $this->ControlsVisible["Applicant_Address1_PINCode"] = $this->Applicant_Address1_PINCode->Visible;
            $this->ControlsVisible["Applicant_Address_Type2"] = $this->Applicant_Address_Type2->Visible;
            $this->ControlsVisible["Applicant_Address2"] = $this->Applicant_Address2->Visible;
            $this->ControlsVisible["Applicant_Address2_City"] = $this->Applicant_Address2_City->Visible;
            $this->ControlsVisible["Applicant_Address2_State"] = $this->Applicant_Address2_State->Visible;
            $this->ControlsVisible["Applicant_Address2_PINCode"] = $this->Applicant_Address2_PINCode->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Segment_Identifier->SetValue($this->DataSource->Segment_Identifier->GetValue());
                $this->Credit_Request_Type->SetValue($this->DataSource->Credit_Request_Type->GetValue());
                $this->Credit_Report_Transaction_ID->SetValue($this->DataSource->Credit_Report_Transaction_ID->GetValue());
                $this->Credit_Inquiry_Purpose_Type->SetValue($this->DataSource->Credit_Inquiry_Purpose_Type->GetValue());
                $this->Credit_Inquiry_Purpose_Type_Description->SetValue($this->DataSource->Credit_Inquiry_Purpose_Type_Description->GetValue());
                $this->Credit_Inquiry_Stage->SetValue($this->DataSource->Credit_Inquiry_Stage->GetValue());
                $this->Credit_Report_Transaction_DateTime->SetValue($this->DataSource->Credit_Report_Transaction_DateTime->GetValue());
                $this->Applicant_Name1->SetValue($this->DataSource->Applicant_Name1->GetValue());
                $this->Applicant_Name2->SetValue($this->DataSource->Applicant_Name2->GetValue());
                $this->Applicant_Name3->SetValue($this->DataSource->Applicant_Name3->GetValue());
                $this->Applicant_Name4->SetValue($this->DataSource->Applicant_Name4->GetValue());
                $this->Applicant_Name5->SetValue($this->DataSource->Applicant_Name5->GetValue());
                $this->Member_Father_Name->SetValue($this->DataSource->Member_Father_Name->GetValue());
                $this->Member_Mother_Name->SetValue($this->DataSource->Member_Mother_Name->GetValue());
                $this->Member_Spouse_Name->SetValue($this->DataSource->Member_Spouse_Name->GetValue());
                $this->Member_relationship_Type1->SetValue($this->DataSource->Member_relationship_Type1->GetValue());
                $this->Member_relationship_Name1->SetValue($this->DataSource->Member_relationship_Name1->GetValue());
                $this->Member_relationship_Type2->SetValue($this->DataSource->Member_relationship_Type2->GetValue());
                $this->Member_relationship_Name2->SetValue($this->DataSource->Member_relationship_Name2->GetValue());
                $this->Member_relationship_Type3->SetValue($this->DataSource->Member_relationship_Type3->GetValue());
                $this->Member_relationship_Name3->SetValue($this->DataSource->Member_relationship_Name3->GetValue());
                $this->Member_relationship_Type4->SetValue($this->DataSource->Member_relationship_Type4->GetValue());
                $this->Member_relationship_Name4->SetValue($this->DataSource->Member_relationship_Name4->GetValue());
                $this->Applicant_BirthDate->SetValue($this->DataSource->Applicant_BirthDate->GetValue());
                $this->Applicant_Age->SetValue($this->DataSource->Applicant_Age->GetValue());
                $this->Applicant_Age_asondate->SetValue($this->DataSource->Applicant_Age_asondate->GetValue());
                $this->Applicant_ID_Type1->SetValue($this->DataSource->Applicant_ID_Type1->GetValue());
                $this->Applicant_ID1->SetValue($this->DataSource->Applicant_ID1->GetValue());
                $this->Applicant_ID_Type2->SetValue($this->DataSource->Applicant_ID_Type2->GetValue());
                $this->Applicant_ID2->SetValue($this->DataSource->Applicant_ID2->GetValue());
                $this->Acct_Open_Date->SetValue($this->DataSource->Acct_Open_Date->GetValue());
                $this->Application_ID_AccountNo->SetValue($this->DataSource->Application_ID_AccountNo->GetValue());
                $this->Branch_ID->SetValue($this->DataSource->Branch_ID->GetValue());
                $this->Member_ID->SetValue($this->DataSource->Member_ID->GetValue());
                $this->Kendra_ID->SetValue($this->DataSource->Kendra_ID->GetValue());
                $this->Applied_for_amt_Current_balance->SetValue($this->DataSource->Applied_for_amt_Current_balance->GetValue());
                $this->KeyPerson_Name->SetValue($this->DataSource->KeyPerson_Name->GetValue());
                $this->KeyPerson_Relation->SetValue($this->DataSource->KeyPerson_Relation->GetValue());
                $this->Nominee_Name->SetValue($this->DataSource->Nominee_Name->GetValue());
                $this->Nominee_Relationship_Type->SetValue($this->DataSource->Nominee_Relationship_Type->GetValue());
                $this->Applicant_Telephone_Number_Type1->SetValue($this->DataSource->Applicant_Telephone_Number_Type1->GetValue());
                $this->Applicant_Telephone_Number1->SetValue($this->DataSource->Applicant_Telephone_Number1->GetValue());
                $this->Applicant_Telephone_Number_Type2->SetValue($this->DataSource->Applicant_Telephone_Number_Type2->GetValue());
                $this->Applicant_Telephone_Number2->SetValue($this->DataSource->Applicant_Telephone_Number2->GetValue());
                $this->Applicant_Address_Type1->SetValue($this->DataSource->Applicant_Address_Type1->GetValue());
                $this->Applicant_Address1->SetValue($this->DataSource->Applicant_Address1->GetValue());
                $this->Applicant_Address1_City->SetValue($this->DataSource->Applicant_Address1_City->GetValue());
                $this->Applicant_Address1_State->SetValue($this->DataSource->Applicant_Address1_State->GetValue());
                $this->Applicant_Address1_PINCode->SetValue($this->DataSource->Applicant_Address1_PINCode->GetValue());
                $this->Applicant_Address_Type2->SetValue($this->DataSource->Applicant_Address_Type2->GetValue());
                $this->Applicant_Address2->SetValue($this->DataSource->Applicant_Address2->GetValue());
                $this->Applicant_Address2_City->SetValue($this->DataSource->Applicant_Address2_City->GetValue());
                $this->Applicant_Address2_State->SetValue($this->DataSource->Applicant_Address2_State->GetValue());
                $this->Applicant_Address2_PINCode->SetValue($this->DataSource->Applicant_Address2_PINCode->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Segment_Identifier->Show();
                $this->Credit_Request_Type->Show();
                $this->Credit_Report_Transaction_ID->Show();
                $this->Credit_Inquiry_Purpose_Type->Show();
                $this->Credit_Inquiry_Purpose_Type_Description->Show();
                $this->Credit_Inquiry_Stage->Show();
                $this->Credit_Report_Transaction_DateTime->Show();
                $this->Applicant_Name1->Show();
                $this->Applicant_Name2->Show();
                $this->Applicant_Name3->Show();
                $this->Applicant_Name4->Show();
                $this->Applicant_Name5->Show();
                $this->Member_Father_Name->Show();
                $this->Member_Mother_Name->Show();
                $this->Member_Spouse_Name->Show();
                $this->Member_relationship_Type1->Show();
                $this->Member_relationship_Name1->Show();
                $this->Member_relationship_Type2->Show();
                $this->Member_relationship_Name2->Show();
                $this->Member_relationship_Type3->Show();
                $this->Member_relationship_Name3->Show();
                $this->Member_relationship_Type4->Show();
                $this->Member_relationship_Name4->Show();
                $this->Applicant_BirthDate->Show();
                $this->Applicant_Age->Show();
                $this->Applicant_Age_asondate->Show();
                $this->Applicant_ID_Type1->Show();
                $this->Applicant_ID1->Show();
                $this->Applicant_ID_Type2->Show();
                $this->Applicant_ID2->Show();
                $this->Acct_Open_Date->Show();
                $this->Application_ID_AccountNo->Show();
                $this->Branch_ID->Show();
                $this->Member_ID->Show();
                $this->Kendra_ID->Show();
                $this->Applied_for_amt_Current_balance->Show();
                $this->KeyPerson_Name->Show();
                $this->KeyPerson_Relation->Show();
                $this->Nominee_Name->Show();
                $this->Nominee_Relationship_Type->Show();
                $this->Applicant_Telephone_Number_Type1->Show();
                $this->Applicant_Telephone_Number1->Show();
                $this->Applicant_Telephone_Number_Type2->Show();
                $this->Applicant_Telephone_Number2->Show();
                $this->Applicant_Address_Type1->Show();
                $this->Applicant_Address1->Show();
                $this->Applicant_Address1_City->Show();
                $this->Applicant_Address1_State->Show();
                $this->Applicant_Address1_PINCode->Show();
                $this->Applicant_Address_Type2->Show();
                $this->Applicant_Address2->Show();
                $this->Applicant_Address2_City->Show();
                $this->Applicant_Address2_State->Show();
                $this->Applicant_Address2_PINCode->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->cams_himark_view_TotalRecords->Show();
        $this->Sorter_Applicant_Age->Show();
        $this->Sorter_Applicant_Age_asondate->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-BBBD3C4B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Segment_Identifier->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Credit_Request_Type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Credit_Report_Transaction_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Credit_Inquiry_Purpose_Type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Credit_Inquiry_Purpose_Type_Description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Credit_Inquiry_Stage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Credit_Report_Transaction_DateTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Name1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Name2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Name3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Name4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Name5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_Father_Name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_Mother_Name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_Spouse_Name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_relationship_Type1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_relationship_Name1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_relationship_Type2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_relationship_Name2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_relationship_Type3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_relationship_Name3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_relationship_Type4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_relationship_Name4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_BirthDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Age->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Age_asondate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_ID_Type1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_ID1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_ID_Type2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_ID2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Acct_Open_Date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Application_ID_AccountNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Branch_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Member_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Kendra_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applied_for_amt_Current_balance->Errors->ToString());
        $errors = ComposeStrings($errors, $this->KeyPerson_Name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->KeyPerson_Relation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Nominee_Name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Nominee_Relationship_Type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Telephone_Number_Type1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Telephone_Number1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Telephone_Number_Type2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Telephone_Number2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address_Type1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address1_City->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address1_State->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address1_PINCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address_Type2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address2_City->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address2_State->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Applicant_Address2_PINCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End cams_himark_view Class @5-FCB6E20C

class clscams_himark_viewDataSource extends clsDBmysql_cams_v2 {  //cams_himark_viewDataSource Class @5-9CE1DE64

//DataSource Variables @5-5336B8F8
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Segment_Identifier;
    public $Credit_Request_Type;
    public $Credit_Report_Transaction_ID;
    public $Credit_Inquiry_Purpose_Type;
    public $Credit_Inquiry_Purpose_Type_Description;
    public $Credit_Inquiry_Stage;
    public $Credit_Report_Transaction_DateTime;
    public $Applicant_Name1;
    public $Applicant_Name2;
    public $Applicant_Name3;
    public $Applicant_Name4;
    public $Applicant_Name5;
    public $Member_Father_Name;
    public $Member_Mother_Name;
    public $Member_Spouse_Name;
    public $Member_relationship_Type1;
    public $Member_relationship_Name1;
    public $Member_relationship_Type2;
    public $Member_relationship_Name2;
    public $Member_relationship_Type3;
    public $Member_relationship_Name3;
    public $Member_relationship_Type4;
    public $Member_relationship_Name4;
    public $Applicant_BirthDate;
    public $Applicant_Age;
    public $Applicant_Age_asondate;
    public $Applicant_ID_Type1;
    public $Applicant_ID1;
    public $Applicant_ID_Type2;
    public $Applicant_ID2;
    public $Acct_Open_Date;
    public $Application_ID_AccountNo;
    public $Branch_ID;
    public $Member_ID;
    public $Kendra_ID;
    public $Applied_for_amt_Current_balance;
    public $KeyPerson_Name;
    public $KeyPerson_Relation;
    public $Nominee_Name;
    public $Nominee_Relationship_Type;
    public $Applicant_Telephone_Number_Type1;
    public $Applicant_Telephone_Number1;
    public $Applicant_Telephone_Number_Type2;
    public $Applicant_Telephone_Number2;
    public $Applicant_Address_Type1;
    public $Applicant_Address1;
    public $Applicant_Address1_City;
    public $Applicant_Address1_State;
    public $Applicant_Address1_PINCode;
    public $Applicant_Address_Type2;
    public $Applicant_Address2;
    public $Applicant_Address2_City;
    public $Applicant_Address2_State;
    public $Applicant_Address2_PINCode;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-2DBA13C6
    function clscams_himark_viewDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid cams_himark_view";
        $this->Initialize();
        $this->Segment_Identifier = new clsField("Segment_Identifier", ccsText, "");
        
        $this->Credit_Request_Type = new clsField("Credit_Request_Type", ccsMemo, "");
        
        $this->Credit_Report_Transaction_ID = new clsField("Credit_Report_Transaction_ID", ccsMemo, "");
        
        $this->Credit_Inquiry_Purpose_Type = new clsField("Credit_Inquiry_Purpose_Type", ccsMemo, "");
        
        $this->Credit_Inquiry_Purpose_Type_Description = new clsField("Credit_Inquiry_Purpose_Type_Description", ccsMemo, "");
        
        $this->Credit_Inquiry_Stage = new clsField("Credit_Inquiry_Stage", ccsMemo, "");
        
        $this->Credit_Report_Transaction_DateTime = new clsField("Credit_Report_Transaction_DateTime", ccsMemo, "");
        
        $this->Applicant_Name1 = new clsField("Applicant_Name1", ccsMemo, "");
        
        $this->Applicant_Name2 = new clsField("Applicant_Name2", ccsMemo, "");
        
        $this->Applicant_Name3 = new clsField("Applicant_Name3", ccsMemo, "");
        
        $this->Applicant_Name4 = new clsField("Applicant_Name4", ccsMemo, "");
        
        $this->Applicant_Name5 = new clsField("Applicant_Name5", ccsMemo, "");
        
        $this->Member_Father_Name = new clsField("Member_Father_Name", ccsMemo, "");
        
        $this->Member_Mother_Name = new clsField("Member_Mother_Name", ccsMemo, "");
        
        $this->Member_Spouse_Name = new clsField("Member_Spouse_Name", ccsMemo, "");
        
        $this->Member_relationship_Type1 = new clsField("Member_relationship_Type1", ccsMemo, "");
        
        $this->Member_relationship_Name1 = new clsField("Member_relationship_Name1", ccsMemo, "");
        
        $this->Member_relationship_Type2 = new clsField("Member_relationship_Type2", ccsMemo, "");
        
        $this->Member_relationship_Name2 = new clsField("Member_relationship_Name2", ccsMemo, "");
        
        $this->Member_relationship_Type3 = new clsField("Member_relationship_Type3", ccsMemo, "");
        
        $this->Member_relationship_Name3 = new clsField("Member_relationship_Name3", ccsMemo, "");
        
        $this->Member_relationship_Type4 = new clsField("Member_relationship_Type4", ccsMemo, "");
        
        $this->Member_relationship_Name4 = new clsField("Member_relationship_Name4", ccsMemo, "");
        
        $this->Applicant_BirthDate = new clsField("Applicant_BirthDate", ccsMemo, "");
        
        $this->Applicant_Age = new clsField("Applicant_Age", ccsFloat, "");
        
        $this->Applicant_Age_asondate = new clsField("Applicant_Age_asondate", ccsDate, $this->DateFormat);
        
        $this->Applicant_ID_Type1 = new clsField("Applicant_ID_Type1", ccsMemo, "");
        
        $this->Applicant_ID1 = new clsField("Applicant_ID1", ccsMemo, "");
        
        $this->Applicant_ID_Type2 = new clsField("Applicant_ID_Type2", ccsMemo, "");
        
        $this->Applicant_ID2 = new clsField("Applicant_ID2", ccsMemo, "");
        
        $this->Acct_Open_Date = new clsField("Acct_Open_Date", ccsMemo, "");
        
        $this->Application_ID_AccountNo = new clsField("Application_ID_AccountNo", ccsMemo, "");
        
        $this->Branch_ID = new clsField("Branch_ID", ccsMemo, "");
        
        $this->Member_ID = new clsField("Member_ID", ccsMemo, "");
        
        $this->Kendra_ID = new clsField("Kendra_ID", ccsMemo, "");
        
        $this->Applied_for_amt_Current_balance = new clsField("Applied_for_amt_Current_balance", ccsMemo, "");
        
        $this->KeyPerson_Name = new clsField("KeyPerson_Name", ccsMemo, "");
        
        $this->KeyPerson_Relation = new clsField("KeyPerson_Relation", ccsMemo, "");
        
        $this->Nominee_Name = new clsField("Nominee_Name", ccsMemo, "");
        
        $this->Nominee_Relationship_Type = new clsField("Nominee_Relationship_Type", ccsMemo, "");
        
        $this->Applicant_Telephone_Number_Type1 = new clsField("Applicant_Telephone_Number_Type1", ccsMemo, "");
        
        $this->Applicant_Telephone_Number1 = new clsField("Applicant_Telephone_Number1", ccsMemo, "");
        
        $this->Applicant_Telephone_Number_Type2 = new clsField("Applicant_Telephone_Number_Type2", ccsMemo, "");
        
        $this->Applicant_Telephone_Number2 = new clsField("Applicant_Telephone_Number2", ccsMemo, "");
        
        $this->Applicant_Address_Type1 = new clsField("Applicant_Address_Type1", ccsMemo, "");
        
        $this->Applicant_Address1 = new clsField("Applicant_Address1", ccsMemo, "");
        
        $this->Applicant_Address1_City = new clsField("Applicant_Address1_City", ccsMemo, "");
        
        $this->Applicant_Address1_State = new clsField("Applicant_Address1_State", ccsMemo, "");
        
        $this->Applicant_Address1_PINCode = new clsField("Applicant_Address1_PINCode", ccsMemo, "");
        
        $this->Applicant_Address_Type2 = new clsField("Applicant_Address_Type2", ccsMemo, "");
        
        $this->Applicant_Address2 = new clsField("Applicant_Address2", ccsMemo, "");
        
        $this->Applicant_Address2_City = new clsField("Applicant_Address2_City", ccsMemo, "");
        
        $this->Applicant_Address2_State = new clsField("Applicant_Address2_State", ccsMemo, "");
        
        $this->Applicant_Address2_PINCode = new clsField("Applicant_Address2_PINCode", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-C70EA8EA
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_Applicant_Age" => array("Applicant Age", ""), 
            "Sorter_Applicant_Age_asondate" => array("Applicant Age asondate", "")));
    }
//End SetOrder Method

//Prepare Method @5-61CB0847
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_Branch_ID", ccsMemo, "", "", $this->Parameters["urls_Branch_ID"], null, false);
        $this->wp->AddParameter("2", "urls_Member_ID", ccsMemo, "", "", $this->Parameters["urls_Member_ID"], null, false);
        $this->wp->AddParameter("3", "urls_Kendra_ID", ccsMemo, "", "", $this->Parameters["urls_Kendra_ID"], null, false);
        $this->wp->AddParameter("4", "urls_Enquiry_Add_at", ccsMemo, "", "", $this->Parameters["urls_Enquiry_Add_at"], null, false);
        $this->wp->AddParameter("5", "urls_enquiry_status", ccsMemo, "", "", $this->Parameters["urls_enquiry_status"], null, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "`Branch ID`", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsMemo),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "`Member ID`", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsMemo),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "`Kendra ID`", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsMemo),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "Enquiry_Add_at", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsMemo),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "enquiry_status", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsMemo),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]);
    }
//End Prepare Method

//Open Method @5-F5662E65
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM himark";
        $this->SQL = "SELECT * \n\n" .
        "FROM himark {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @5-31670561
    function SetValues()
    {
        $this->Segment_Identifier->SetDBValue($this->f("[Segment Identifier]"));
        $this->Credit_Request_Type->SetDBValue($this->f("[Credit Request Type]"));
        $this->Credit_Report_Transaction_ID->SetDBValue($this->f("[Credit Report Transaction ID]"));
        $this->Credit_Inquiry_Purpose_Type->SetDBValue($this->f("[Credit Inquiry Purpose Type]"));
        $this->Credit_Inquiry_Purpose_Type_Description->SetDBValue($this->f("[Credit Inquiry Purpose Type Description]"));
        $this->Credit_Inquiry_Stage->SetDBValue($this->f("[Credit Inquiry Stage]"));
        $this->Credit_Report_Transaction_DateTime->SetDBValue($this->f("[Credit Report Transaction DateTime]"));
        $this->Applicant_Name1->SetDBValue($this->f("[Applicant Name1]"));
        $this->Applicant_Name2->SetDBValue($this->f("[Applicant Name2]"));
        $this->Applicant_Name3->SetDBValue($this->f("[Applicant Name3]"));
        $this->Applicant_Name4->SetDBValue($this->f("[Applicant Name4]"));
        $this->Applicant_Name5->SetDBValue($this->f("[Applicant Name5]"));
        $this->Member_Father_Name->SetDBValue($this->f("[Member Father Name]"));
        $this->Member_Mother_Name->SetDBValue($this->f("[Member Mother Name]"));
        $this->Member_Spouse_Name->SetDBValue($this->f("[Member Spouse Name]"));
        $this->Member_relationship_Type1->SetDBValue($this->f("Member_relationship_Type1"));
        $this->Member_relationship_Name1->SetDBValue($this->f("[Member relationship Name1]"));
        $this->Member_relationship_Type2->SetDBValue($this->f("[Member relationship Type2]"));
        $this->Member_relationship_Name2->SetDBValue($this->f("[Member relationship Name2]"));
        $this->Member_relationship_Type3->SetDBValue($this->f("[Member relationship Type3]"));
        $this->Member_relationship_Name3->SetDBValue($this->f("[Member relationship Name3]"));
        $this->Member_relationship_Type4->SetDBValue($this->f("[Member relationship Type4]"));
        $this->Member_relationship_Name4->SetDBValue($this->f("[Member relationship Name4]"));
        $this->Applicant_BirthDate->SetDBValue($this->f("[Applicant BirthDate]"));
        $this->Applicant_Age->SetDBValue(trim($this->f("[Applicant Age]")));
        $this->Applicant_Age_asondate->SetDBValue(trim($this->f("Applicant_Age_asondate")));
        $this->Applicant_ID_Type1->SetDBValue($this->f("[Applicant ID Type1]"));
        $this->Applicant_ID1->SetDBValue($this->f("[Applicant ID1]"));
        $this->Applicant_ID_Type2->SetDBValue($this->f("[Applicant ID Type2]"));
        $this->Applicant_ID2->SetDBValue($this->f("[Applicant ID2]"));
        $this->Acct_Open_Date->SetDBValue($this->f("[Acct Open Date]"));
        $this->Application_ID_AccountNo->SetDBValue($this->f("[Application ID AccountNo]"));
        $this->Branch_ID->SetDBValue($this->f("[Branch ID]"));
        $this->Member_ID->SetDBValue($this->f("[Member ID]"));
        $this->Kendra_ID->SetDBValue($this->f("[Kendra ID]"));
        $this->Applied_for_amt_Current_balance->SetDBValue($this->f("[Applied for amt Current balance]"));
        $this->KeyPerson_Name->SetDBValue($this->f("[KeyPerson Name]"));
        $this->KeyPerson_Relation->SetDBValue($this->f("[KeyPerson Relation]"));
        $this->Nominee_Name->SetDBValue($this->f("[Nominee Name]"));
        $this->Nominee_Relationship_Type->SetDBValue($this->f("[Nominee Relationship Type]"));
        $this->Applicant_Telephone_Number_Type1->SetDBValue($this->f("[Applicant Telephone Number Type1]"));
        $this->Applicant_Telephone_Number1->SetDBValue($this->f("[Applicant Telephone Number1]"));
        $this->Applicant_Telephone_Number_Type2->SetDBValue($this->f("[Applicant Telephone Number Type2]"));
        $this->Applicant_Telephone_Number2->SetDBValue($this->f("[Applicant Telephone Number2]"));
        $this->Applicant_Address_Type1->SetDBValue($this->f("[Applicant Address Type1]"));
        $this->Applicant_Address1->SetDBValue($this->f("[Applicant Address1]"));
        $this->Applicant_Address1_City->SetDBValue($this->f("[Applicant Address1 City]"));
        $this->Applicant_Address1_State->SetDBValue($this->f("[Applicant Address2 State]"));
        $this->Applicant_Address1_PINCode->SetDBValue($this->f("[Applicant Address1 PINCode]"));
        $this->Applicant_Address_Type2->SetDBValue($this->f("[Applicant Address Type2]"));
        $this->Applicant_Address2->SetDBValue($this->f("[Applicant Address2]"));
        $this->Applicant_Address2_City->SetDBValue($this->f("[Applicant Address2 City]"));
        $this->Applicant_Address2_State->SetDBValue($this->f("[Applicant Address2 State]"));
        $this->Applicant_Address2_PINCode->SetDBValue($this->f("[Applicant Address2 PINCode]"));
    }
//End SetValues Method

} //End cams_himark_viewDataSource Class @5-FCB6E20C

class clsRecordcams_himark_viewSearch { //cams_himark_viewSearch Class @6-7EB69985

//Variables @6-9E315808

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

//Class_Initialize Event @6-700245EE
    function clsRecordcams_himark_viewSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record cams_himark_viewSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "cams_himark_viewSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_Branch_ID = new clsControl(ccsListBox, "s_Branch_ID", "s_Branch_ID", ccsText, "", CCGetRequestParam("s_Branch_ID", $Method, NULL), $this);
            $this->s_Branch_ID->DSType = dsTable;
            $this->s_Branch_ID->DataSource = new clsDBmysql_cams_v2();
            $this->s_Branch_ID->ds = & $this->s_Branch_ID->DataSource;
            $this->s_Branch_ID->DataSource->SQL = "SELECT Branch_ID \n" .
"FROM himark {SQL_Where}\n" .
"GROUP BY Branch_ID {SQL_OrderBy}";
            $this->s_Branch_ID->DataSource->Order = "Branch_ID";
            list($this->s_Branch_ID->BoundColumn, $this->s_Branch_ID->TextColumn, $this->s_Branch_ID->DBFormat) = array("Branch_ID", "Branch_ID", "");
            $this->s_Branch_ID->DataSource->Order = "Branch_ID";
            $this->s_Member_ID = new clsControl(ccsTextBox, "s_Member_ID", "s_Member_ID", ccsMemo, "", CCGetRequestParam("s_Member_ID", $Method, NULL), $this);
            $this->s_Kendra_ID = new clsControl(ccsListBox, "s_Kendra_ID", "s_Kendra_ID", ccsMemo, "", CCGetRequestParam("s_Kendra_ID", $Method, NULL), $this);
            $this->s_Kendra_ID->DSType = dsTable;
            $this->s_Kendra_ID->DataSource = new clsDBmysql_cams_v2();
            $this->s_Kendra_ID->ds = & $this->s_Kendra_ID->DataSource;
            $this->s_Kendra_ID->DataSource->SQL = "SELECT * \n" .
"FROM cams_himark_view {SQL_Where}\n" .
"GROUP BY ";
            $this->s_Kendra_ID->DataSource->Order = "`Kendra ID`";
            list($this->s_Kendra_ID->BoundColumn, $this->s_Kendra_ID->TextColumn, $this->s_Kendra_ID->DBFormat) = array("Kendra ID", "Kendra ID", "");
            $this->s_Kendra_ID->DataSource->Order = "`Kendra ID`";
            $this->s_Enquiry_Add_at = new clsControl(ccsTextBox, "s_Enquiry_Add_at", "s_Enquiry_Add_at", ccsMemo, "", CCGetRequestParam("s_Enquiry_Add_at", $Method, NULL), $this);
            $this->s_enquiry_status = new clsControl(ccsListBox, "s_enquiry_status", "s_enquiry_status", ccsMemo, "", CCGetRequestParam("s_enquiry_status", $Method, NULL), $this);
            $this->s_enquiry_status->DSType = dsListOfValues;
            $this->s_enquiry_status->Values = array(array("DOC ADDED", "DOC ADDED"), array("ENQUIRY GENERATED", "ENQUIRY GENERATED"));
            $this->genfrm = new clsControl(ccsTextBox, "genfrm", "genfrm", ccsText, "", CCGetRequestParam("genfrm", $Method, NULL), $this);
            $this->gento = new clsControl(ccsTextBox, "gento", "gento", ccsText, "", CCGetRequestParam("gento", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @6-B35EA728
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_Branch_ID->Validate() && $Validation);
        $Validation = ($this->s_Member_ID->Validate() && $Validation);
        $Validation = ($this->s_Kendra_ID->Validate() && $Validation);
        $Validation = ($this->s_Enquiry_Add_at->Validate() && $Validation);
        $Validation = ($this->s_enquiry_status->Validate() && $Validation);
        $Validation = ($this->genfrm->Validate() && $Validation);
        $Validation = ($this->gento->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_Branch_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_Member_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_Kendra_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_Enquiry_Add_at->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_enquiry_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->genfrm->Errors->Count() == 0);
        $Validation =  $Validation && ($this->gento->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @6-C064F520
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_Branch_ID->Errors->Count());
        $errors = ($errors || $this->s_Member_ID->Errors->Count());
        $errors = ($errors || $this->s_Kendra_ID->Errors->Count());
        $errors = ($errors || $this->s_Enquiry_Add_at->Errors->Count());
        $errors = ($errors || $this->s_enquiry_status->Errors->Count());
        $errors = ($errors || $this->genfrm->Errors->Count());
        $errors = ($errors || $this->gento->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @6-DD94EE4C
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
        $Redirect = $FileName;
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @6-9EF11D00
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

        $this->s_Branch_ID->Prepare();
        $this->s_Kendra_ID->Prepare();
        $this->s_enquiry_status->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_Branch_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_Member_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_Kendra_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_Enquiry_Add_at->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_enquiry_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->genfrm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->gento->Errors->ToString());
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
        $this->s_Branch_ID->Show();
        $this->s_Member_ID->Show();
        $this->s_Kendra_ID->Show();
        $this->s_Enquiry_Add_at->Show();
        $this->s_enquiry_status->Show();
        $this->genfrm->Show();
        $this->gento->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End cams_himark_viewSearch Class @6-FCB6E20C

class clsRecordNewRecord1 { //NewRecord1 Class @96-D7EDAFB1

//Variables @96-9E315808

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

//Class_Initialize Event @96-A6AE5BAC
    function clsRecordNewRecord1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->DataSource = new clsNewRecord1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "NewRecord1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->TextBox1 = new clsControl(ccsLabel, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @96-F1475965
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["expr108"] = 'DOC ADDED';
    }
//End Initialize Method

//Validate Method @96-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @96-E0715A77
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->TextBox1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @96-30484AC8
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        $Redirect = $FileName;
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @96-D513D636
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->TextBox1->SetValue($this->TextBox1->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @96-561A093B
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                $this->TextBox1->SetValue($this->DataSource->TextBox1->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
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

        $this->TextBox1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End NewRecord1 Class @96-FCB6E20C

class clsNewRecord1DataSource extends clsDBmysql_cams_v2 {  //NewRecord1DataSource Class @96-9538A357

//DataSource Variables @96-71D7349E
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $TextBox1;
//End DataSource Variables

//DataSourceClass_Initialize Event @96-995FDF26
    function clsNewRecord1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->Initialize();
        $this->TextBox1 = new clsField("TextBox1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @96-BB88AE56
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr108", ccsText, "", "", $this->Parameters["expr108"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Status", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @96-65117D8C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT COUNT(*) AS Expr1 \n\n" .
        "FROM himark {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @96-3EDE725F
    function SetValues()
    {
        $this->TextBox1->SetDBValue($this->f("Expr1"));
    }
//End SetValues Method

//Update Method @96-AFBFD25E
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->SQL = CCBuildUpdate("himark", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End NewRecord1DataSource Class @96-FCB6E20C

//Initialize Page @1-81E226E9
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
$TemplateFileName = "CBEnquiryPage.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-4ECDCE1A
include_once("./CBEnquiryPage_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-71946E72
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$incHeader = new clsincHeader("./", "incHeader", $MainPage);
$incHeader->Initialize();
$incFooter = new clsincFooter("./", "incFooter", $MainPage);
$incFooter->Initialize();
$incMenu = new clsincMenu("", "incMenu", $MainPage);
$incMenu->Initialize();
$cams_himark_view = new clsGridcams_himark_view("", $MainPage);
$cams_himark_viewSearch = new clsRecordcams_himark_viewSearch("", $MainPage);
$NewRecord1 = new clsRecordNewRecord1("", $MainPage);
$Button3 = new clsButton("Button3", ccsGet, $MainPage);
$MainPage->incHeader = & $incHeader;
$MainPage->incFooter = & $incFooter;
$MainPage->incMenu = & $incMenu;
$MainPage->cams_himark_view = & $cams_himark_view;
$MainPage->cams_himark_viewSearch = & $cams_himark_viewSearch;
$MainPage->NewRecord1 = & $NewRecord1;
$MainPage->Button3 = & $Button3;
$cams_himark_view->Initialize();
$NewRecord1->Initialize();

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

//Execute Components @1-85128D87
$NewRecord1->Operation();
$cams_himark_viewSearch->Operation();
$incMenu->Operations();
$incFooter->Operations();
$incHeader->Operations();
//End Execute Components

//Go to destination page @1-47C1767A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    $incHeader->Class_Terminate();
    unset($incHeader);
    $incFooter->Class_Terminate();
    unset($incFooter);
    $incMenu->Class_Terminate();
    unset($incMenu);
    unset($cams_himark_view);
    unset($cams_himark_viewSearch);
    unset($NewRecord1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-27C651E3
$incHeader->Show();
$incFooter->Show();
$incMenu->Show();
$cams_himark_view->Show();
$cams_himark_viewSearch->Show();
$NewRecord1->Show();
$Button3->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-57BEDE67
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
$incHeader->Class_Terminate();
unset($incHeader);
$incFooter->Class_Terminate();
unset($incFooter);
$incMenu->Class_Terminate();
unset($incMenu);
unset($cams_himark_view);
unset($cams_himark_viewSearch);
unset($NewRecord1);
unset($Tpl);
//End Unload Page


?>
