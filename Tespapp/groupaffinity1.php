<?php
//Include Common Files @1-4972263E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "groupaffinity1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



class clsGridcbodataentry_mfi_gp_mfi_h { //cbodataentry_mfi_gp_mfi_h class @16-5AECFA55

//Variables @16-6E51DF5A

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
//End Variables

//Class_Initialize Event @16-C689E0A9
    function clsGridcbodataentry_mfi_gp_mfi_h($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "cbodataentry_mfi_gp_mfi_h";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid cbodataentry_mfi_gp_mfi_h";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clscbodataentry_mfi_gp_mfi_hDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->mfi_hvf2_customer_mfi_or_bank_loan_amount1 = new clsControl(ccsLabel, "mfi_hvf2_customer_mfi_or_bank_loan_amount1", "mfi_hvf2_customer_mfi_or_bank_loan_amount1", ccsInteger, "", CCGetRequestParam("mfi_hvf2_customer_mfi_or_bank_loan_amount1", ccsGet, NULL), $this);
        $this->mfi_hvf2_customer_mfi_or_bank_loan_amount2 = new clsControl(ccsLabel, "mfi_hvf2_customer_mfi_or_bank_loan_amount2", "mfi_hvf2_customer_mfi_or_bank_loan_amount2", ccsInteger, "", CCGetRequestParam("mfi_hvf2_customer_mfi_or_bank_loan_amount2", ccsGet, NULL), $this);
        $this->mfi_hvf2_customer_mfi_or_bank_loan_details2 = new clsControl(ccsLabel, "mfi_hvf2_customer_mfi_or_bank_loan_details2", "mfi_hvf2_customer_mfi_or_bank_loan_details2", ccsText, "", CCGetRequestParam("mfi_hvf2_customer_mfi_or_bank_loan_details2", ccsGet, NULL), $this);
        $this->mfi_hvf2_customer_mfi_or_bank_loan_details1 = new clsControl(ccsLabel, "mfi_hvf2_customer_mfi_or_bank_loan_details1", "mfi_hvf2_customer_mfi_or_bank_loan_details1", ccsText, "", CCGetRequestParam("mfi_hvf2_customer_mfi_or_bank_loan_details1", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_nature_of_residence = new clsControl(ccsLabel, "mfi_hvf1_customer_nature_of_residence", "mfi_hvf1_customer_nature_of_residence", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_nature_of_residence", ccsGet, NULL), $this);
        $this->mfi_hvf3_customer_children_15yrs = new clsControl(ccsLabel, "mfi_hvf3_customer_children_15yrs", "mfi_hvf3_customer_children_15yrs", ccsInteger, "", CCGetRequestParam("mfi_hvf3_customer_children_15yrs", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_guarantor_occupation = new clsControl(ccsLabel, "mfi_hvf1_customer_guarantor_occupation", "mfi_hvf1_customer_guarantor_occupation", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_guarantor_occupation", ccsGet, NULL), $this);
        $this->mfi_hvf1_customer_occupation = new clsControl(ccsLabel, "mfi_hvf1_customer_occupation", "mfi_hvf1_customer_occupation", ccsText, "", CCGetRequestParam("mfi_hvf1_customer_occupation", ccsGet, NULL), $this);
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->ListBox3 = new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", ccsGet, NULL), $this);
        $this->ListBox3->DSType = dsListOfValues;
        $this->ListBox3->Values = array(array("NOT KNOWN", "NOT KNOWN"), array("<6 Months", "<6 Months"), array("1 YEAR", "1 YEAR"), array("1-2 YEARS", "1-2 YEARS"), array("2-3 YEARS", "2-3 YEARS"), array(">3 YEARS", ">3 YEARS"));
        $this->ListBox4 = new clsControl(ccsListBox, "ListBox4", "ListBox4", ccsText, "", CCGetRequestParam("ListBox4", ccsGet, NULL), $this);
        $this->ListBox4->DSType = dsListOfValues;
        $this->ListBox4->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->ListBox5 = new clsControl(ccsListBox, "ListBox5", "ListBox5", ccsText, "", CCGetRequestParam("ListBox5", ccsGet, NULL), $this);
        $this->ListBox5->DSType = dsListOfValues;
        $this->ListBox5->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->ListBox6 = new clsControl(ccsListBox, "ListBox6", "ListBox6", ccsText, "", CCGetRequestParam("ListBox6", ccsGet, NULL), $this);
        $this->ListBox6->DSType = dsListOfValues;
        $this->ListBox6->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->ListBox7 = new clsControl(ccsListBox, "ListBox7", "ListBox7", ccsText, "", CCGetRequestParam("ListBox7", ccsGet, NULL), $this);
        $this->ListBox7->DSType = dsListOfValues;
        $this->ListBox7->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->ListBox8 = new clsControl(ccsListBox, "ListBox8", "ListBox8", ccsText, "", CCGetRequestParam("ListBox8", ccsGet, NULL), $this);
        $this->ListBox8->DSType = dsListOfValues;
        $this->ListBox8->Values = array(array("OVER-DEBTED", "OVER-DEBTED"), array("DEFAULTED", "DEFAULTED"), array("OVER-DEBTED &  DEFAULTED", "OVER-DEBTED &  DEFAULTED"), array("GOOD BORROWER", "GOOD BORROWER"), array("NO OTHER LOANS", "NO OTHER LOANS"));
        $this->ListBox9 = new clsControl(ccsListBox, "ListBox9", "ListBox9", ccsText, "", CCGetRequestParam("ListBox9", ccsGet, NULL), $this);
        $this->ListBox9->DSType = dsListOfValues;
        $this->ListBox9->Values = array(array("YES FROM MFIs", "YES FROM MFIs"), array("YES FROM MLs", "YES FROM MLs"), array("YES FROM BANKs", "YES FROM BANKs"), array("NO", "NO"), array("UNKNOWN", "UNKNOWN"));
        $this->ListBox10 = new clsControl(ccsListBox, "ListBox10", "ListBox10", ccsText, "", CCGetRequestParam("ListBox10", ccsGet, NULL), $this);
        $this->ListBox10->DSType = dsListOfValues;
        $this->ListBox10->Values = array(array("YES ALWAYS", "YES ALWAYS"), array("YES SOMETIMES", "YES SOMETIMES"), array("MAY BE", "MAY BE"), array("NO", "NO"));
        $this->ListBox11 = new clsControl(ccsListBox, "ListBox11", "ListBox11", ccsText, "", CCGetRequestParam("ListBox11", ccsGet, NULL), $this);
        $this->ListBox11->DSType = dsListOfValues;
        $this->ListBox11->Values = array(array("YES FROM MFIs", "YES FROM MFIs"), array("YES FROM MLs", "YES FROM MLs"), array("YES FROM BANKs", "YES FROM BANKs"), array("NO", "NO"), array("UNKNOWN", "UNKNOWN"));
        $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", ccsGet, NULL), $this);
        $this->ListBox1->DSType = dsListOfValues;
        $this->ListBox1->Values = array(array("SATISFACTORY", "SATISFACTORY"), array("UNSATISFACTORY", "UNSATISFACTORY"));
    }
//End Class_Initialize Event

//Initialize Method @16-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @16-ADADE0C3
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlgp_id"] = CCGetFromGet("gp_id", NULL);
        $this->DataSource->Parameters["urlla_id"] = CCGetFromGet("la_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->ListBox3->Prepare();
        $this->ListBox4->Prepare();
        $this->ListBox5->Prepare();
        $this->ListBox6->Prepare();
        $this->ListBox7->Prepare();
        $this->ListBox8->Prepare();
        $this->ListBox9->Prepare();
        $this->ListBox10->Prepare();
        $this->ListBox11->Prepare();
        $this->ListBox1->Prepare();

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
            $this->ControlsVisible["mfi_hvf2_customer_mfi_or_bank_loan_amount1"] = $this->mfi_hvf2_customer_mfi_or_bank_loan_amount1->Visible;
            $this->ControlsVisible["mfi_hvf2_customer_mfi_or_bank_loan_amount2"] = $this->mfi_hvf2_customer_mfi_or_bank_loan_amount2->Visible;
            $this->ControlsVisible["mfi_hvf2_customer_mfi_or_bank_loan_details2"] = $this->mfi_hvf2_customer_mfi_or_bank_loan_details2->Visible;
            $this->ControlsVisible["mfi_hvf2_customer_mfi_or_bank_loan_details1"] = $this->mfi_hvf2_customer_mfi_or_bank_loan_details1->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_nature_of_residence"] = $this->mfi_hvf1_customer_nature_of_residence->Visible;
            $this->ControlsVisible["mfi_hvf3_customer_children_15yrs"] = $this->mfi_hvf3_customer_children_15yrs->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_guarantor_occupation"] = $this->mfi_hvf1_customer_guarantor_occupation->Visible;
            $this->ControlsVisible["mfi_hvf1_customer_occupation"] = $this->mfi_hvf1_customer_occupation->Visible;
            $this->ControlsVisible["Label1"] = $this->Label1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->mfi_hvf2_customer_mfi_or_bank_loan_amount1->SetValue($this->DataSource->mfi_hvf2_customer_mfi_or_bank_loan_amount1->GetValue());
                $this->mfi_hvf2_customer_mfi_or_bank_loan_amount2->SetValue($this->DataSource->mfi_hvf2_customer_mfi_or_bank_loan_amount2->GetValue());
                $this->mfi_hvf2_customer_mfi_or_bank_loan_details2->SetValue($this->DataSource->mfi_hvf2_customer_mfi_or_bank_loan_details2->GetValue());
                $this->mfi_hvf2_customer_mfi_or_bank_loan_details1->SetValue($this->DataSource->mfi_hvf2_customer_mfi_or_bank_loan_details1->GetValue());
                $this->mfi_hvf1_customer_nature_of_residence->SetValue($this->DataSource->mfi_hvf1_customer_nature_of_residence->GetValue());
                $this->mfi_hvf3_customer_children_15yrs->SetValue($this->DataSource->mfi_hvf3_customer_children_15yrs->GetValue());
                $this->mfi_hvf1_customer_guarantor_occupation->SetValue($this->DataSource->mfi_hvf1_customer_guarantor_occupation->GetValue());
                $this->mfi_hvf1_customer_occupation->SetValue($this->DataSource->mfi_hvf1_customer_occupation->GetValue());
                $this->Label1->SetValue($this->DataSource->Label1->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->mfi_hvf2_customer_mfi_or_bank_loan_amount1->Show();
                $this->mfi_hvf2_customer_mfi_or_bank_loan_amount2->Show();
                $this->mfi_hvf2_customer_mfi_or_bank_loan_details2->Show();
                $this->mfi_hvf2_customer_mfi_or_bank_loan_details1->Show();
                $this->mfi_hvf1_customer_nature_of_residence->Show();
                $this->mfi_hvf3_customer_children_15yrs->Show();
                $this->mfi_hvf1_customer_guarantor_occupation->Show();
                $this->mfi_hvf1_customer_occupation->Show();
                $this->Label1->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->ListBox3->Show();
        $this->ListBox4->Show();
        $this->ListBox5->Show();
        $this->ListBox6->Show();
        $this->ListBox7->Show();
        $this->ListBox8->Show();
        $this->ListBox9->Show();
        $this->ListBox10->Show();
        $this->ListBox11->Show();
        $this->ListBox1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @16-EBD7FC7C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->mfi_hvf2_customer_mfi_or_bank_loan_amount1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_customer_mfi_or_bank_loan_amount2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_customer_mfi_or_bank_loan_details2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf2_customer_mfi_or_bank_loan_details1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_nature_of_residence->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf3_customer_children_15yrs->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_guarantor_occupation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mfi_hvf1_customer_occupation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End cbodataentry_mfi_gp_mfi_h Class @16-FCB6E20C

class clscbodataentry_mfi_gp_mfi_hDataSource extends clsDBmysql_cams_v2 {  //cbodataentry_mfi_gp_mfi_hDataSource Class @16-15A35A68

//DataSource Variables @16-4CDE5B10
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $mfi_hvf2_customer_mfi_or_bank_loan_amount1;
    public $mfi_hvf2_customer_mfi_or_bank_loan_amount2;
    public $mfi_hvf2_customer_mfi_or_bank_loan_details2;
    public $mfi_hvf2_customer_mfi_or_bank_loan_details1;
    public $mfi_hvf1_customer_nature_of_residence;
    public $mfi_hvf3_customer_children_15yrs;
    public $mfi_hvf1_customer_guarantor_occupation;
    public $mfi_hvf1_customer_occupation;
    public $Label1;
//End DataSource Variables

//DataSourceClass_Initialize Event @16-F1FD9CB6
    function clscbodataentry_mfi_gp_mfi_hDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid cbodataentry_mfi_gp_mfi_h";
        $this->Initialize();
        $this->mfi_hvf2_customer_mfi_or_bank_loan_amount1 = new clsField("mfi_hvf2_customer_mfi_or_bank_loan_amount1", ccsInteger, "");
        
        $this->mfi_hvf2_customer_mfi_or_bank_loan_amount2 = new clsField("mfi_hvf2_customer_mfi_or_bank_loan_amount2", ccsInteger, "");
        
        $this->mfi_hvf2_customer_mfi_or_bank_loan_details2 = new clsField("mfi_hvf2_customer_mfi_or_bank_loan_details2", ccsText, "");
        
        $this->mfi_hvf2_customer_mfi_or_bank_loan_details1 = new clsField("mfi_hvf2_customer_mfi_or_bank_loan_details1", ccsText, "");
        
        $this->mfi_hvf1_customer_nature_of_residence = new clsField("mfi_hvf1_customer_nature_of_residence", ccsText, "");
        
        $this->mfi_hvf3_customer_children_15yrs = new clsField("mfi_hvf3_customer_children_15yrs", ccsInteger, "");
        
        $this->mfi_hvf1_customer_guarantor_occupation = new clsField("mfi_hvf1_customer_guarantor_occupation", ccsText, "");
        
        $this->mfi_hvf1_customer_occupation = new clsField("mfi_hvf1_customer_occupation", ccsText, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @16-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @16-1D150F91
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgp_id", ccsText, "", "", $this->Parameters["urlgp_id"], "", true);
        $this->wp->AddParameter("2", "urlla_id", ccsText, "", "", $this->Parameters["urlla_id"], "", true);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_hvf1.gp_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),true);
        $this->wp->Criterion[2] = $this->wp->Operation(opNotEqual, "mfi_hvf1.la_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),true);
        $this->wp->Criterion[3] = "( mfi_hvf2.cb_analysys_result='SANCTIONED' )";
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @16-7809A1EE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM camsdata123, mfi_hvf1 INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id";
        $this->SQL = "SELECT * \n\n" .
        "FROM camsdata123, mfi_hvf1 INNER JOIN mfi_hvf2 ON\n\n" .
        "mfi_hvf1.la_id = mfi_hvf2.la_id {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @16-4B814D7D
    function SetValues()
    {
        $this->mfi_hvf2_customer_mfi_or_bank_loan_amount1->SetDBValue(trim($this->f("loan_amount1")));
        $this->mfi_hvf2_customer_mfi_or_bank_loan_amount2->SetDBValue(trim($this->f("loan_amount2")));
        $this->mfi_hvf2_customer_mfi_or_bank_loan_details2->SetDBValue($this->f("mfi_bank_name2"));
        $this->mfi_hvf2_customer_mfi_or_bank_loan_details1->SetDBValue($this->f("mfi_bank_name1"));
        $this->mfi_hvf1_customer_nature_of_residence->SetDBValue($this->f("mfi_hvf1_customer_nature_of_residence"));
        $this->mfi_hvf3_customer_children_15yrs->SetDBValue(trim($this->f("TOTAL CHILDREN")));
        $this->mfi_hvf1_customer_guarantor_occupation->SetDBValue($this->f("mfi_hvf1_customer_guarantor_occupation"));
        $this->mfi_hvf1_customer_occupation->SetDBValue($this->f("mfi_hvf1_customer_occupation"));
        $this->Label1->SetDBValue($this->f("mfi_hvf1_customer_name"));
    }
//End SetValues Method

} //End cbodataentry_mfi_gp_mfi_hDataSource Class @16-FCB6E20C



class clsRecordmfi_tc_ga_sanction_detail { //mfi_tc_ga_sanction_detail Class @86-ED087119

//Variables @86-9E315808

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

//Class_Initialize Event @86-6E17C8EE
    function clsRecordmfi_tc_ga_sanction_detail($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_tc_ga_sanction_detail/Error";
        $this->DataSource = new clsmfi_tc_ga_sanction_detailDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_tc_ga_sanction_detail";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->mfi_gp_no = new clsControl(ccsHidden, "mfi_gp_no", "Mfi Gp No", ccsText, "", CCGetRequestParam("mfi_gp_no", $Method, NULL), $this);
            $this->mfi_gp_no->Required = true;
            $this->mfi_group_sanction_by = new clsControl(ccsHidden, "mfi_group_sanction_by", "Mfi Group Sanction By", ccsText, "", CCGetRequestParam("mfi_group_sanction_by", $Method, NULL), $this);
            $this->Hidden1 = new clsControl(ccsHidden, "Hidden1", "Hidden1", ccsText, "", CCGetRequestParam("Hidden1", $Method, NULL), $this);
            $this->group_sanction_buton_status = new clsControl(ccsHidden, "group_sanction_buton_status", "group_sanction_buton_status", ccsText, "", CCGetRequestParam("group_sanction_buton_status", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @86-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @86-219D93D4
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->mfi_gp_no->Validate() && $Validation);
        $Validation = ($this->mfi_group_sanction_by->Validate() && $Validation);
        $Validation = ($this->Hidden1->Validate() && $Validation);
        $Validation = ($this->group_sanction_buton_status->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_gp_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_group_sanction_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Hidden1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->group_sanction_buton_status->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @86-FDF8AB67
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_gp_no->Errors->Count());
        $errors = ($errors || $this->mfi_group_sanction_by->Errors->Count());
        $errors = ($errors || $this->Hidden1->Errors->Count());
        $errors = ($errors || $this->group_sanction_buton_status->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @86-F62CEE75
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @86-BC5464B6
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->mfi_gp_no->SetValue($this->mfi_gp_no->GetValue(true));
        $this->DataSource->mfi_group_sanction_by->SetValue($this->mfi_group_sanction_by->GetValue(true));
        $this->DataSource->Hidden1->SetValue($this->Hidden1->GetValue(true));
        $this->DataSource->group_sanction_buton_status->SetValue($this->group_sanction_buton_status->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @86-DE8790BF
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
                if(!$this->FormSubmitted){
                    $this->mfi_gp_no->SetValue($this->DataSource->mfi_gp_no->GetValue());
                    $this->mfi_group_sanction_by->SetValue($this->DataSource->mfi_group_sanction_by->GetValue());
                    $this->Hidden1->SetValue($this->DataSource->Hidden1->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_gp_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_group_sanction_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Hidden1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->group_sanction_buton_status->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->mfi_gp_no->Show();
        $this->mfi_group_sanction_by->Show();
        $this->Hidden1->Show();
        $this->group_sanction_buton_status->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_tc_ga_sanction_detail Class @86-FCB6E20C

class clsmfi_tc_ga_sanction_detailDataSource extends clsDBmysql_cams_v2 {  //mfi_tc_ga_sanction_detailDataSource Class @86-AC92AF1D

//DataSource Variables @86-560AFFF0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();

    // Datasource fields
    public $mfi_gp_no;
    public $mfi_group_sanction_by;
    public $Hidden1;
    public $group_sanction_buton_status;
//End DataSource Variables

//DataSourceClass_Initialize Event @86-5EF6D73C
    function clsmfi_tc_ga_sanction_detailDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_tc_ga_sanction_detail/Error";
        $this->Initialize();
        $this->mfi_gp_no = new clsField("mfi_gp_no", ccsText, "");
        
        $this->mfi_group_sanction_by = new clsField("mfi_group_sanction_by", ccsText, "");
        
        $this->Hidden1 = new clsField("Hidden1", ccsText, "");
        
        $this->group_sanction_buton_status = new clsField("group_sanction_buton_status", ccsText, "");
        

        $this->InsertFields["mfi_gp_no"] = array("Name" => "mfi_gp_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_group_sanction_by"] = array("Name" => "mfi_group_sanction_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_group_status"] = array("Name" => "mfi_group_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @86-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @86-0D563B5C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_tc_ga_sanction_details {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @86-F3F2F0CE
    function SetValues()
    {
        $this->mfi_gp_no->SetDBValue($this->f("mfi_gp_no"));
        $this->mfi_group_sanction_by->SetDBValue($this->f("mfi_group_sanction_by"));
        $this->Hidden1->SetDBValue($this->f("mfi_group_status"));
    }
//End SetValues Method

//Insert Method @86-61546B80
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["mfi_gp_no"]["Value"] = $this->mfi_gp_no->GetDBValue(true);
        $this->InsertFields["mfi_group_sanction_by"]["Value"] = $this->mfi_group_sanction_by->GetDBValue(true);
        $this->InsertFields["mfi_group_status"]["Value"] = $this->Hidden1->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_tc_ga_sanction_details", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End mfi_tc_ga_sanction_detailDataSource Class @86-FCB6E20C

class clsRecordmfi_tc_group_affinity_che { //mfi_tc_group_affinity_che Class @149-0AE792F8

//Variables @149-9E315808

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

//Class_Initialize Event @149-CD5B607F
    function clsRecordmfi_tc_group_affinity_che($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_tc_group_affinity_che/Error";
        $this->DataSource = new clsmfi_tc_group_affinity_cheDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_tc_group_affinity_che";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->la_no = new clsControl(ccsHidden, "la_no", "La No", ccsText, "", CCGetRequestParam("la_no", $Method, NULL), $this);
            $this->la_no->Required = true;
            $this->mfi_hvf_group_id = new clsControl(ccsHidden, "mfi_hvf_group_id", "Mfi Hvf Group Id", ccsText, "", CCGetRequestParam("mfi_hvf_group_id", $Method, NULL), $this);
            $this->mfi_hvf_group_id->Required = true;
            $this->mfi_tc_gf_6a_ans = new clsControl(ccsHidden, "mfi_tc_gf_6a_ans", "Mfi Tc Gf 6a Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_6a_ans", $Method, NULL), $this);
            $this->mfi_tc_gf_6a_ans->Required = true;
            $this->mfi_tc_gf_6b_ans = new clsControl(ccsHidden, "mfi_tc_gf_6b_ans", "Mfi Tc Gf 6b Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_6b_ans", $Method, NULL), $this);
            $this->mfi_tc_gf_6b_ans->Required = true;
            $this->mfi_tc_gf_6c_ans = new clsControl(ccsHidden, "mfi_tc_gf_6c_ans", "Mfi Tc Gf 6c Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_6c_ans", $Method, NULL), $this);
            $this->mfi_tc_gf_6d_ans = new clsControl(ccsHidden, "mfi_tc_gf_6d_ans", "Mfi Tc Gf 6d Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_6d_ans", $Method, NULL), $this);
            $this->mfi_tc_gf_6e_ans = new clsControl(ccsHidden, "mfi_tc_gf_6e_ans", "Mfi Tc Gf 6e Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_6e_ans", $Method, NULL), $this);
            $this->mfi_tc_gf_6e_ans->Required = true;
            $this->mfi_tc_gf_6f_ans = new clsControl(ccsHidden, "mfi_tc_gf_6f_ans", "Mfi Tc Gf 6f Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_6f_ans", $Method, NULL), $this);
            $this->mfi_tc_gf_6g_ans = new clsControl(ccsHidden, "mfi_tc_gf_6g_ans", "Mfi Tc Gf 6g Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_6g_ans", $Method, NULL), $this);
            $this->mfi_tc_gf_6h_ans = new clsControl(ccsHidden, "mfi_tc_gf_6h_ans", "Mfi Tc Gf 6h Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_6h_ans", $Method, NULL), $this);
            $this->mfi_tc_gf_5a_ans = new clsControl(ccsHidden, "mfi_tc_gf_5a_ans", "Mfi Tc Gf 5a Ans", ccsText, "", CCGetRequestParam("mfi_tc_gf_5a_ans", $Method, NULL), $this);
            $this->mfi_tc_ga_status = new clsControl(ccsHidden, "mfi_tc_ga_status", "Mfi Tc Ga Status", ccsText, "", CCGetRequestParam("mfi_tc_ga_status", $Method, NULL), $this);
            $this->called_by = new clsControl(ccsHidden, "called_by", "Called By", ccsText, "", CCGetRequestParam("called_by", $Method, NULL), $this);
            $this->called_by->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @149-CFC718D9
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlla_no"] = CCGetFromGet("la_no", NULL);
    }
//End Initialize Method

//Validate Method @149-C46B6460
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->la_no->Validate() && $Validation);
        $Validation = ($this->mfi_hvf_group_id->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_6a_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_6b_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_6c_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_6d_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_6e_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_6f_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_6g_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_6h_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_gf_5a_ans->Validate() && $Validation);
        $Validation = ($this->mfi_tc_ga_status->Validate() && $Validation);
        $Validation = ($this->called_by->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->la_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_hvf_group_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_6a_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_6b_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_6c_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_6d_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_6e_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_6f_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_6g_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_6h_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_gf_5a_ans->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_tc_ga_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->called_by->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @149-8796FE3C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->la_no->Errors->Count());
        $errors = ($errors || $this->mfi_hvf_group_id->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_6a_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_6b_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_6c_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_6d_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_6e_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_6f_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_6g_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_6h_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_gf_5a_ans->Errors->Count());
        $errors = ($errors || $this->mfi_tc_ga_status->Errors->Count());
        $errors = ($errors || $this->called_by->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @149-EFC50250
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

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @149-55807144
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->la_no->SetValue($this->la_no->GetValue(true));
        $this->DataSource->mfi_hvf_group_id->SetValue($this->mfi_hvf_group_id->GetValue(true));
        $this->DataSource->mfi_tc_gf_6a_ans->SetValue($this->mfi_tc_gf_6a_ans->GetValue(true));
        $this->DataSource->mfi_tc_gf_6b_ans->SetValue($this->mfi_tc_gf_6b_ans->GetValue(true));
        $this->DataSource->mfi_tc_gf_6c_ans->SetValue($this->mfi_tc_gf_6c_ans->GetValue(true));
        $this->DataSource->mfi_tc_gf_6d_ans->SetValue($this->mfi_tc_gf_6d_ans->GetValue(true));
        $this->DataSource->mfi_tc_gf_6e_ans->SetValue($this->mfi_tc_gf_6e_ans->GetValue(true));
        $this->DataSource->mfi_tc_gf_6f_ans->SetValue($this->mfi_tc_gf_6f_ans->GetValue(true));
        $this->DataSource->mfi_tc_gf_6g_ans->SetValue($this->mfi_tc_gf_6g_ans->GetValue(true));
        $this->DataSource->mfi_tc_gf_6h_ans->SetValue($this->mfi_tc_gf_6h_ans->GetValue(true));
        $this->DataSource->mfi_tc_gf_5a_ans->SetValue($this->mfi_tc_gf_5a_ans->GetValue(true));
        $this->DataSource->mfi_tc_ga_status->SetValue($this->mfi_tc_ga_status->GetValue(true));
        $this->DataSource->called_by->SetValue($this->called_by->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @149-4BB528A0
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
                if(!$this->FormSubmitted){
                    $this->la_no->SetValue($this->DataSource->la_no->GetValue());
                    $this->mfi_hvf_group_id->SetValue($this->DataSource->mfi_hvf_group_id->GetValue());
                    $this->mfi_tc_gf_6a_ans->SetValue($this->DataSource->mfi_tc_gf_6a_ans->GetValue());
                    $this->mfi_tc_gf_6b_ans->SetValue($this->DataSource->mfi_tc_gf_6b_ans->GetValue());
                    $this->mfi_tc_gf_6c_ans->SetValue($this->DataSource->mfi_tc_gf_6c_ans->GetValue());
                    $this->mfi_tc_gf_6d_ans->SetValue($this->DataSource->mfi_tc_gf_6d_ans->GetValue());
                    $this->mfi_tc_gf_6e_ans->SetValue($this->DataSource->mfi_tc_gf_6e_ans->GetValue());
                    $this->mfi_tc_gf_6f_ans->SetValue($this->DataSource->mfi_tc_gf_6f_ans->GetValue());
                    $this->mfi_tc_gf_6g_ans->SetValue($this->DataSource->mfi_tc_gf_6g_ans->GetValue());
                    $this->mfi_tc_gf_6h_ans->SetValue($this->DataSource->mfi_tc_gf_6h_ans->GetValue());
                    $this->mfi_tc_gf_5a_ans->SetValue($this->DataSource->mfi_tc_gf_5a_ans->GetValue());
                    $this->mfi_tc_ga_status->SetValue($this->DataSource->mfi_tc_ga_status->GetValue());
                    $this->called_by->SetValue($this->DataSource->called_by->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->la_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_hvf_group_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_6a_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_6b_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_6c_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_6d_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_6e_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_6f_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_6g_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_6h_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_gf_5a_ans->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_tc_ga_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->called_by->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->la_no->Show();
        $this->mfi_hvf_group_id->Show();
        $this->mfi_tc_gf_6a_ans->Show();
        $this->mfi_tc_gf_6b_ans->Show();
        $this->mfi_tc_gf_6c_ans->Show();
        $this->mfi_tc_gf_6d_ans->Show();
        $this->mfi_tc_gf_6e_ans->Show();
        $this->mfi_tc_gf_6f_ans->Show();
        $this->mfi_tc_gf_6g_ans->Show();
        $this->mfi_tc_gf_6h_ans->Show();
        $this->mfi_tc_gf_5a_ans->Show();
        $this->mfi_tc_ga_status->Show();
        $this->called_by->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_tc_group_affinity_che Class @149-FCB6E20C

class clsmfi_tc_group_affinity_cheDataSource extends clsDBmysql_cams_v2 {  //mfi_tc_group_affinity_cheDataSource Class @149-7CA7136D

//DataSource Variables @149-58A193E6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();

    // Datasource fields
    public $la_no;
    public $mfi_hvf_group_id;
    public $mfi_tc_gf_6a_ans;
    public $mfi_tc_gf_6b_ans;
    public $mfi_tc_gf_6c_ans;
    public $mfi_tc_gf_6d_ans;
    public $mfi_tc_gf_6e_ans;
    public $mfi_tc_gf_6f_ans;
    public $mfi_tc_gf_6g_ans;
    public $mfi_tc_gf_6h_ans;
    public $mfi_tc_gf_5a_ans;
    public $mfi_tc_ga_status;
    public $called_by;
//End DataSource Variables

//DataSourceClass_Initialize Event @149-5C43E913
    function clsmfi_tc_group_affinity_cheDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_tc_group_affinity_che/Error";
        $this->Initialize();
        $this->la_no = new clsField("la_no", ccsText, "");
        
        $this->mfi_hvf_group_id = new clsField("mfi_hvf_group_id", ccsText, "");
        
        $this->mfi_tc_gf_6a_ans = new clsField("mfi_tc_gf_6a_ans", ccsText, "");
        
        $this->mfi_tc_gf_6b_ans = new clsField("mfi_tc_gf_6b_ans", ccsText, "");
        
        $this->mfi_tc_gf_6c_ans = new clsField("mfi_tc_gf_6c_ans", ccsText, "");
        
        $this->mfi_tc_gf_6d_ans = new clsField("mfi_tc_gf_6d_ans", ccsText, "");
        
        $this->mfi_tc_gf_6e_ans = new clsField("mfi_tc_gf_6e_ans", ccsText, "");
        
        $this->mfi_tc_gf_6f_ans = new clsField("mfi_tc_gf_6f_ans", ccsText, "");
        
        $this->mfi_tc_gf_6g_ans = new clsField("mfi_tc_gf_6g_ans", ccsText, "");
        
        $this->mfi_tc_gf_6h_ans = new clsField("mfi_tc_gf_6h_ans", ccsText, "");
        
        $this->mfi_tc_gf_5a_ans = new clsField("mfi_tc_gf_5a_ans", ccsText, "");
        
        $this->mfi_tc_ga_status = new clsField("mfi_tc_ga_status", ccsText, "");
        
        $this->called_by = new clsField("called_by", ccsText, "");
        

        $this->InsertFields["la_no"] = array("Name" => "la_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_hvf_group_id"] = array("Name" => "mfi_hvf_group_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_6a_ans"] = array("Name" => "mfi_tc_gf_6a_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_6b_ans"] = array("Name" => "mfi_tc_gf_6b_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_6c_ans"] = array("Name" => "mfi_tc_gf_6c_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_6d_ans"] = array("Name" => "mfi_tc_gf_6d_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_6e_ans"] = array("Name" => "mfi_tc_gf_6e_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_6f_ans"] = array("Name" => "mfi_tc_gf_6f_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_6g_ans"] = array("Name" => "mfi_tc_gf_6g_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_6h_ans"] = array("Name" => "mfi_tc_gf_6h_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_gf_5a_ans"] = array("Name" => "mfi_tc_gf_5a_ans", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_tc_ga_status"] = array("Name" => "mfi_tc_ga_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["called_by"] = array("Name" => "called_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @149-DDF7B1B1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlla_no", ccsText, "", "", $this->Parameters["urlla_no"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "la_no", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @149-AED5D9BB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_tc_group_affinity_check {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @149-349ECB99
    function SetValues()
    {
        $this->la_no->SetDBValue($this->f("la_no"));
        $this->mfi_hvf_group_id->SetDBValue($this->f("mfi_hvf_group_id"));
        $this->mfi_tc_gf_6a_ans->SetDBValue($this->f("mfi_tc_gf_6a_ans"));
        $this->mfi_tc_gf_6b_ans->SetDBValue($this->f("mfi_tc_gf_6b_ans"));
        $this->mfi_tc_gf_6c_ans->SetDBValue($this->f("mfi_tc_gf_6c_ans"));
        $this->mfi_tc_gf_6d_ans->SetDBValue($this->f("mfi_tc_gf_6d_ans"));
        $this->mfi_tc_gf_6e_ans->SetDBValue($this->f("mfi_tc_gf_6e_ans"));
        $this->mfi_tc_gf_6f_ans->SetDBValue($this->f("mfi_tc_gf_6f_ans"));
        $this->mfi_tc_gf_6g_ans->SetDBValue($this->f("mfi_tc_gf_6g_ans"));
        $this->mfi_tc_gf_6h_ans->SetDBValue($this->f("mfi_tc_gf_6h_ans"));
        $this->mfi_tc_gf_5a_ans->SetDBValue($this->f("mfi_tc_gf_5a_ans"));
        $this->mfi_tc_ga_status->SetDBValue($this->f("mfi_tc_ga_status"));
        $this->called_by->SetDBValue($this->f("called_by"));
    }
//End SetValues Method

//Insert Method @149-2D22F52A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["la_no"]["Value"] = $this->la_no->GetDBValue(true);
        $this->InsertFields["mfi_hvf_group_id"]["Value"] = $this->mfi_hvf_group_id->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_6a_ans"]["Value"] = $this->mfi_tc_gf_6a_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_6b_ans"]["Value"] = $this->mfi_tc_gf_6b_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_6c_ans"]["Value"] = $this->mfi_tc_gf_6c_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_6d_ans"]["Value"] = $this->mfi_tc_gf_6d_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_6e_ans"]["Value"] = $this->mfi_tc_gf_6e_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_6f_ans"]["Value"] = $this->mfi_tc_gf_6f_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_6g_ans"]["Value"] = $this->mfi_tc_gf_6g_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_6h_ans"]["Value"] = $this->mfi_tc_gf_6h_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_gf_5a_ans"]["Value"] = $this->mfi_tc_gf_5a_ans->GetDBValue(true);
        $this->InsertFields["mfi_tc_ga_status"]["Value"] = $this->mfi_tc_ga_status->GetDBValue(true);
        $this->InsertFields["called_by"]["Value"] = $this->called_by->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_tc_group_affinity_check", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End mfi_tc_group_affinity_cheDataSource Class @149-FCB6E20C

class clsRecordNewRecord1 { //NewRecord1 Class @169-D7EDAFB1

//Variables @169-9E315808

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

//Class_Initialize Event @169-3BEF58A1
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
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "NewRecord1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->TextBox1 = new clsControl(ccsTextBox, "TextBox1", "TextBox1", ccsText, "", CCGetRequestParam("TextBox1", $Method, NULL), $this);
            $this->TextBox2 = new clsControl(ccsTextBox, "TextBox2", "TextBox2", ccsText, "", CCGetRequestParam("TextBox2", $Method, NULL), $this);
            $this->TextBox3 = new clsControl(ccsTextBox, "TextBox3", "TextBox3", ccsText, "", CCGetRequestParam("TextBox3", $Method, NULL), $this);
            $this->TextBox4 = new clsControl(ccsTextBox, "TextBox4", "TextBox4", ccsText, "", CCGetRequestParam("TextBox4", $Method, NULL), $this);
            $this->TextBox5 = new clsControl(ccsTextBox, "TextBox5", "TextBox5", ccsText, "", CCGetRequestParam("TextBox5", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @169-02303D1D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->TextBox1->Validate() && $Validation);
        $Validation = ($this->TextBox2->Validate() && $Validation);
        $Validation = ($this->TextBox3->Validate() && $Validation);
        $Validation = ($this->TextBox4->Validate() && $Validation);
        $Validation = ($this->TextBox5->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->TextBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextBox5->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @169-15B9789B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->TextBox1->Errors->Count());
        $errors = ($errors || $this->TextBox2->Errors->Count());
        $errors = ($errors || $this->TextBox3->Errors->Count());
        $errors = ($errors || $this->TextBox4->Errors->Count());
        $errors = ($errors || $this->TextBox5->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @169-82225C24
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
    }
//End Operation Method

//Show Method @169-13A2D3BB
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
            $Error = ComposeStrings($Error, $this->TextBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextBox5->Errors->ToString());
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

        $this->TextBox1->Show();
        $this->TextBox2->Show();
        $this->TextBox3->Show();
        $this->TextBox4->Show();
        $this->TextBox5->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End NewRecord1 Class @169-FCB6E20C

class clsRecordmfi_tc_ga_sanction_detail1 { //mfi_tc_ga_sanction_detail1 Class @177-7BC54007

//Variables @177-9E315808

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

//Class_Initialize Event @177-768BE63D
    function clsRecordmfi_tc_ga_sanction_detail1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record mfi_tc_ga_sanction_detail1/Error";
        $this->DataSource = new clsmfi_tc_ga_sanction_detail1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "mfi_tc_ga_sanction_detail1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->mfi_gp_no = new clsControl(ccsHidden, "mfi_gp_no", "Mfi Gp No", ccsText, "", CCGetRequestParam("mfi_gp_no", $Method, NULL), $this);
            $this->mfi_gp_no->Required = true;
            $this->mfi_group_sanction_by = new clsControl(ccsHidden, "mfi_group_sanction_by", "Mfi Group Sanction By", ccsText, "", CCGetRequestParam("mfi_group_sanction_by", $Method, NULL), $this);
            $this->mfi_group_status = new clsControl(ccsHidden, "mfi_group_status", "Mfi Group Status", ccsText, "", CCGetRequestParam("mfi_group_status", $Method, NULL), $this);
            $this->mfi_group_status->Required = true;
            $this->TextArea1 = new clsControl(ccsTextArea, "TextArea1", "TextArea1", ccsText, "", CCGetRequestParam("TextArea1", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @177-A46624A5
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlmfi_gp_no"] = CCGetFromGet("mfi_gp_no", NULL);
    }
//End Initialize Method

//Validate Method @177-01C62DAD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->mfi_gp_no->Validate() && $Validation);
        $Validation = ($this->mfi_group_sanction_by->Validate() && $Validation);
        $Validation = ($this->mfi_group_status->Validate() && $Validation);
        $Validation = ($this->TextArea1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->mfi_gp_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_group_sanction_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mfi_group_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextArea1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @177-8A832E03
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->mfi_gp_no->Errors->Count());
        $errors = ($errors || $this->mfi_group_sanction_by->Errors->Count());
        $errors = ($errors || $this->mfi_group_status->Errors->Count());
        $errors = ($errors || $this->TextArea1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @177-EFC50250
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

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @177-ED7DB423
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->mfi_gp_no->SetValue($this->mfi_gp_no->GetValue(true));
        $this->DataSource->mfi_group_sanction_by->SetValue($this->mfi_group_sanction_by->GetValue(true));
        $this->DataSource->mfi_group_status->SetValue($this->mfi_group_status->GetValue(true));
        $this->DataSource->TextArea1->SetValue($this->TextArea1->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @177-836F703A
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
                if(!$this->FormSubmitted){
                    $this->mfi_gp_no->SetValue($this->DataSource->mfi_gp_no->GetValue());
                    $this->mfi_group_sanction_by->SetValue($this->DataSource->mfi_group_sanction_by->GetValue());
                    $this->mfi_group_status->SetValue($this->DataSource->mfi_group_status->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->mfi_gp_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_group_sanction_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mfi_group_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextArea1->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->mfi_gp_no->Show();
        $this->mfi_group_sanction_by->Show();
        $this->mfi_group_status->Show();
        $this->TextArea1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End mfi_tc_ga_sanction_detail1 Class @177-FCB6E20C

class clsmfi_tc_ga_sanction_detail1DataSource extends clsDBmysql_cams_v2 {  //mfi_tc_ga_sanction_detail1DataSource Class @177-7BB74BEB

//DataSource Variables @177-9A182BB0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();

    // Datasource fields
    public $mfi_gp_no;
    public $mfi_group_sanction_by;
    public $mfi_group_status;
    public $TextArea1;
//End DataSource Variables

//DataSourceClass_Initialize Event @177-2C4327A2
    function clsmfi_tc_ga_sanction_detail1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record mfi_tc_ga_sanction_detail1/Error";
        $this->Initialize();
        $this->mfi_gp_no = new clsField("mfi_gp_no", ccsText, "");
        
        $this->mfi_group_sanction_by = new clsField("mfi_group_sanction_by", ccsText, "");
        
        $this->mfi_group_status = new clsField("mfi_group_status", ccsText, "");
        
        $this->TextArea1 = new clsField("TextArea1", ccsText, "");
        

        $this->InsertFields["mfi_gp_no"] = array("Name" => "mfi_gp_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_group_sanction_by"] = array("Name" => "mfi_group_sanction_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["mfi_group_status"] = array("Name" => "mfi_group_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @177-CE523D53
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlmfi_gp_no", ccsText, "", "", $this->Parameters["urlmfi_gp_no"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "mfi_gp_no", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @177-0D563B5C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM mfi_tc_ga_sanction_details {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @177-45D7E3F6
    function SetValues()
    {
        $this->mfi_gp_no->SetDBValue($this->f("mfi_gp_no"));
        $this->mfi_group_sanction_by->SetDBValue($this->f("mfi_group_sanction_by"));
        $this->mfi_group_status->SetDBValue($this->f("mfi_group_status"));
    }
//End SetValues Method

//Insert Method @177-089C2E32
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["mfi_gp_no"]["Value"] = $this->mfi_gp_no->GetDBValue(true);
        $this->InsertFields["mfi_group_sanction_by"]["Value"] = $this->mfi_group_sanction_by->GetDBValue(true);
        $this->InsertFields["mfi_group_status"]["Value"] = $this->mfi_group_status->GetDBValue(true);
        $this->SQL = CCBuildInsert("mfi_tc_ga_sanction_details", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End mfi_tc_ga_sanction_detail1DataSource Class @177-FCB6E20C







//Initialize Page @1-B393FE2A
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
$TemplateFileName = "groupaffinity1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-50ABCC61
include_once("./groupaffinity1_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B4C7F017
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$ga_pnl = new clsPanel("ga_pnl", $MainPage);
$cbodataentry_mfi_gp_mfi_h = new clsGridcbodataentry_mfi_gp_mfi_h("", $MainPage);
$mfi_tc_ga_sanction_detail = new clsRecordmfi_tc_ga_sanction_detail("", $MainPage);
$mfi_tc_group_affinity_che = new clsRecordmfi_tc_group_affinity_che("", $MainPage);
$NewRecord1 = new clsRecordNewRecord1("", $MainPage);
$mfi_tc_ga_sanction_detail1 = new clsRecordmfi_tc_ga_sanction_detail1("", $MainPage);
$MainPage->ga_pnl = & $ga_pnl;
$MainPage->cbodataentry_mfi_gp_mfi_h = & $cbodataentry_mfi_gp_mfi_h;
$MainPage->mfi_tc_ga_sanction_detail = & $mfi_tc_ga_sanction_detail;
$MainPage->mfi_tc_group_affinity_che = & $mfi_tc_group_affinity_che;
$MainPage->NewRecord1 = & $NewRecord1;
$MainPage->mfi_tc_ga_sanction_detail1 = & $mfi_tc_ga_sanction_detail1;
$ga_pnl->AddComponent("cbodataentry_mfi_gp_mfi_h", $cbodataentry_mfi_gp_mfi_h);
$cbodataentry_mfi_gp_mfi_h->Initialize();
$mfi_tc_ga_sanction_detail->Initialize();
$mfi_tc_group_affinity_che->Initialize();
$mfi_tc_ga_sanction_detail1->Initialize();

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

//Execute Components @1-EF017283
$mfi_tc_ga_sanction_detail1->Operation();
$NewRecord1->Operation();
$mfi_tc_group_affinity_che->Operation();
$mfi_tc_ga_sanction_detail->Operation();
//End Execute Components

//Go to destination page @1-A34B3231
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($cbodataentry_mfi_gp_mfi_h);
    unset($mfi_tc_ga_sanction_detail);
    unset($mfi_tc_group_affinity_che);
    unset($NewRecord1);
    unset($mfi_tc_ga_sanction_detail1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CEFC1E02
$mfi_tc_ga_sanction_detail->Show();
$mfi_tc_group_affinity_che->Show();
$NewRecord1->Show();
$mfi_tc_ga_sanction_detail1->Show();
$ga_pnl->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5FB95778
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($cbodataentry_mfi_gp_mfi_h);
unset($mfi_tc_ga_sanction_detail);
unset($mfi_tc_group_affinity_che);
unset($NewRecord1);
unset($mfi_tc_ga_sanction_detail1);
unset($Tpl);
//End Unload Page


?>
