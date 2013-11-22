<?php
//Include Common Files @1-083D4315
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "welcalls.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridwelcomecalls { //welcomecalls class @2-DAC0A037

//Variables @2-6E51DF5A

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

//Class_Initialize Event @2-B9BEE480
    function clsGridwelcomecalls($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "welcomecalls";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid welcomecalls";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clswelcomecallsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 1;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->MEMBER_ID = new clsControl(ccsTextBox, "MEMBER_ID", "MEMBER_ID", ccsText, "", CCGetRequestParam("MEMBER_ID", ccsGet, NULL), $this);
        $this->ListBox1 = new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", ccsGet, NULL), $this);
        $this->ListBox1->DSType = dsListOfValues;
        $this->ListBox1->Values = array(array("CONNECTED", "CONNECTED"), array("SWITCHED OFF", "SWITCHED OFF"), array("NOT REACHABLE", "NOT REACHABLE"), array("MEMBER NOT PRESENT", "MEMBER NOT PRESENT"), array("INVALID NO", "INVALID NO"), array("NUMBER NOT MENTIONED", "NUMBER NOT MENTIONED"), array("WRONG NUMBER", "WRONG NUMBER"), array("NOT ANSWERED", "NOT ANSWERED"));
        $this->MOBILE_NO = new clsControl(ccsLabel, "MOBILE_NO", "MOBILE_NO", ccsText, "", CCGetRequestParam("MOBILE_NO", ccsGet, NULL), $this);
        $this->GROUP_NAME = new clsControl(ccsLabel, "GROUP_NAME", "GROUP_NAME", ccsText, "", CCGetRequestParam("GROUP_NAME", ccsGet, NULL), $this);
        $this->ListBox2 = new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", ccsGet, NULL), $this);
        $this->ListBox2->DSType = dsListOfValues;
        $this->ListBox2->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->VILLAGE = new clsControl(ccsLabel, "VILLAGE", "VILLAGE", ccsText, "", CCGetRequestParam("VILLAGE", ccsGet, NULL), $this);
        $this->ListBox3 = new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", ccsGet, NULL), $this);
        $this->ListBox3->DSType = dsListOfValues;
        $this->ListBox3->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->CENTER_NAME = new clsControl(ccsLabel, "CENTER_NAME", "CENTER_NAME", ccsText, "", CCGetRequestParam("CENTER_NAME", ccsGet, NULL), $this);
        $this->ListBox4 = new clsControl(ccsListBox, "ListBox4", "ListBox4", ccsText, "", CCGetRequestParam("ListBox4", ccsGet, NULL), $this);
        $this->ListBox4->DSType = dsListOfValues;
        $this->ListBox4->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->BORROWER_NAME = new clsControl(ccsLabel, "BORROWER_NAME", "BORROWER_NAME", ccsText, "", CCGetRequestParam("BORROWER_NAME", ccsGet, NULL), $this);
        $this->BORROWER_CURRENT_AGE = new clsControl(ccsLabel, "BORROWER_CURRENT_AGE", "BORROWER_CURRENT_AGE", ccsInteger, "", CCGetRequestParam("BORROWER_CURRENT_AGE", ccsGet, NULL), $this);
        $this->ListBox5 = new clsControl(ccsListBox, "ListBox5", "ListBox5", ccsText, "", CCGetRequestParam("ListBox5", ccsGet, NULL), $this);
        $this->ListBox5->DSType = dsListOfValues;
        $this->ListBox5->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->ListBox6 = new clsControl(ccsListBox, "ListBox6", "ListBox6", ccsText, "", CCGetRequestParam("ListBox6", ccsGet, NULL), $this);
        $this->ListBox6->DSType = dsListOfValues;
        $this->ListBox6->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->SANCTIONED_AMOUNT = new clsControl(ccsLabel, "SANCTIONED_AMOUNT", "SANCTIONED_AMOUNT", ccsInteger, "", CCGetRequestParam("SANCTIONED_AMOUNT", ccsGet, NULL), $this);
        $this->DISBURSEMENT_DATE = new clsControl(ccsLabel, "DISBURSEMENT_DATE", "DISBURSEMENT_DATE", ccsText, "", CCGetRequestParam("DISBURSEMENT_DATE", ccsGet, NULL), $this);
        $this->ListBox8 = new clsControl(ccsListBox, "ListBox8", "ListBox8", ccsText, "", CCGetRequestParam("ListBox8", ccsGet, NULL), $this);
        $this->ListBox8->DSType = dsListOfValues;
        $this->ListBox8->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->TextBox2 = new clsControl(ccsListBox, "TextBox2", "TextBox2", ccsText, "", CCGetRequestParam("TextBox2", ccsGet, NULL), $this);
        $this->TextBox2->DSType = dsListOfValues;
        $this->TextBox2->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->TextBox3 = new clsControl(ccsListBox, "TextBox3", "TextBox3", ccsText, "", CCGetRequestParam("TextBox3", ccsGet, NULL), $this);
        $this->TextBox3->DSType = dsListOfValues;
        $this->TextBox3->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->ListBox9 = new clsControl(ccsListBox, "ListBox9", "ListBox9", ccsText, "", CCGetRequestParam("ListBox9", ccsGet, NULL), $this);
        $this->ListBox9->DSType = dsListOfValues;
        $this->ListBox9->Values = array(array("CORRECT", "CORRECT"), array("PARTIALLY CORRECT", "PARTIALLY CORRECT"), array("INCORRECT", "INCORRECT"));
        $this->BORROWER_NAME1 = new clsControl(ccsTextBox, "BORROWER_NAME1", "BORROWER_NAME1", ccsText, "", CCGetRequestParam("BORROWER_NAME1", ccsGet, NULL), $this);
        $this->ListBox7 = new clsControl(ccsListBox, "ListBox7", "ListBox7", ccsText, "", CCGetRequestParam("ListBox7", ccsGet, NULL), $this);
        $this->ListBox7->DSType = dsListOfValues;
        $this->ListBox7->Values = array(array("YES", "YES"), array("NO", "NO"));
        $this->Label1 = new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $this);
        $this->Label2 = new clsControl(ccsLabel, "Label2", "Label2", ccsText, "", CCGetRequestParam("Label2", ccsGet, NULL), $this);
        $this->Label3 = new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", ccsGet, NULL), $this);
        $this->Label4 = new clsControl(ccsLabel, "Label4", "Label4", ccsText, "", CCGetRequestParam("Label4", ccsGet, NULL), $this);
        $this->Label5 = new clsControl(ccsLabel, "Label5", "Label5", ccsText, "", CCGetRequestParam("Label5", ccsGet, NULL), $this);
        $this->Label6 = new clsControl(ccsLabel, "Label6", "Label6", ccsText, "", CCGetRequestParam("Label6", ccsGet, NULL), $this);
        $this->Hidden1 = new clsControl(ccsHidden, "Hidden1", "Hidden1", ccsText, "", CCGetRequestParam("Hidden1", ccsGet, NULL), $this);
        $this->ListBox10 = new clsControl(ccsListBox, "ListBox10", "ListBox10", ccsText, "", CCGetRequestParam("ListBox10", ccsGet, NULL), $this);
        $this->ListBox10->DSType = dsListOfValues;
        $this->ListBox10->Values = array(array("3", "3"), array("4", "4"), array("5", "5"), array("6", "6"), array("7", "7"), array("8", "8"), array("9", "9"), array("10", "10"));
        $this->Hidden2 = new clsControl(ccsHidden, "Hidden2", "Hidden2", ccsText, "", CCGetRequestParam("Hidden2", ccsGet, NULL), $this);
        $this->Hidden3 = new clsControl(ccsHidden, "Hidden3", "Hidden3", ccsText, "", CCGetRequestParam("Hidden3", ccsGet, NULL), $this);
        $this->Hidden4 = new clsControl(ccsHidden, "Hidden4", "Hidden4", ccsText, "", CCGetRequestParam("Hidden4", ccsGet, NULL), $this);
        $this->Hidden5 = new clsControl(ccsHidden, "Hidden5", "Hidden5", ccsText, "", CCGetRequestParam("Hidden5", ccsGet, NULL), $this);
        $this->Hidden6 = new clsControl(ccsHidden, "Hidden6", "Hidden6", ccsText, "", CCGetRequestParam("Hidden6", ccsGet, NULL), $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-CC4D34D7
    function Show()
    {
        $Tpl = & CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlgp_id"] = CCGetFromGet("gp_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->ListBox1->Prepare();
        $this->ListBox2->Prepare();
        $this->ListBox3->Prepare();
        $this->ListBox4->Prepare();
        $this->ListBox5->Prepare();
        $this->ListBox6->Prepare();
        $this->ListBox8->Prepare();
        $this->TextBox2->Prepare();
        $this->TextBox3->Prepare();
        $this->ListBox9->Prepare();
        $this->ListBox7->Prepare();
        $this->ListBox10->Prepare();

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
            $this->ControlsVisible["MEMBER_ID"] = $this->MEMBER_ID->Visible;
            $this->ControlsVisible["ListBox1"] = $this->ListBox1->Visible;
            $this->ControlsVisible["MOBILE_NO"] = $this->MOBILE_NO->Visible;
            $this->ControlsVisible["GROUP_NAME"] = $this->GROUP_NAME->Visible;
            $this->ControlsVisible["ListBox2"] = $this->ListBox2->Visible;
            $this->ControlsVisible["VILLAGE"] = $this->VILLAGE->Visible;
            $this->ControlsVisible["ListBox3"] = $this->ListBox3->Visible;
            $this->ControlsVisible["CENTER_NAME"] = $this->CENTER_NAME->Visible;
            $this->ControlsVisible["ListBox4"] = $this->ListBox4->Visible;
            $this->ControlsVisible["BORROWER_NAME"] = $this->BORROWER_NAME->Visible;
            $this->ControlsVisible["BORROWER_CURRENT_AGE"] = $this->BORROWER_CURRENT_AGE->Visible;
            $this->ControlsVisible["ListBox5"] = $this->ListBox5->Visible;
            $this->ControlsVisible["ListBox6"] = $this->ListBox6->Visible;
            $this->ControlsVisible["SANCTIONED_AMOUNT"] = $this->SANCTIONED_AMOUNT->Visible;
            $this->ControlsVisible["DISBURSEMENT_DATE"] = $this->DISBURSEMENT_DATE->Visible;
            $this->ControlsVisible["ListBox8"] = $this->ListBox8->Visible;
            $this->ControlsVisible["TextBox2"] = $this->TextBox2->Visible;
            $this->ControlsVisible["TextBox3"] = $this->TextBox3->Visible;
            $this->ControlsVisible["ListBox9"] = $this->ListBox9->Visible;
            $this->ControlsVisible["BORROWER_NAME1"] = $this->BORROWER_NAME1->Visible;
            $this->ControlsVisible["ListBox7"] = $this->ListBox7->Visible;
            $this->ControlsVisible["Label1"] = $this->Label1->Visible;
            $this->ControlsVisible["Label2"] = $this->Label2->Visible;
            $this->ControlsVisible["Label3"] = $this->Label3->Visible;
            $this->ControlsVisible["Label4"] = $this->Label4->Visible;
            $this->ControlsVisible["Label5"] = $this->Label5->Visible;
            $this->ControlsVisible["Label6"] = $this->Label6->Visible;
            $this->ControlsVisible["Hidden1"] = $this->Hidden1->Visible;
            $this->ControlsVisible["ListBox10"] = $this->ListBox10->Visible;
            $this->ControlsVisible["Hidden2"] = $this->Hidden2->Visible;
            $this->ControlsVisible["Hidden3"] = $this->Hidden3->Visible;
            $this->ControlsVisible["Hidden4"] = $this->Hidden4->Visible;
            $this->ControlsVisible["Hidden5"] = $this->Hidden5->Visible;
            $this->ControlsVisible["Hidden6"] = $this->Hidden6->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->MEMBER_ID->SetValue($this->DataSource->MEMBER_ID->GetValue());
                $this->MOBILE_NO->SetValue($this->DataSource->MOBILE_NO->GetValue());
                $this->GROUP_NAME->SetValue($this->DataSource->GROUP_NAME->GetValue());
                $this->VILLAGE->SetValue($this->DataSource->VILLAGE->GetValue());
                $this->CENTER_NAME->SetValue($this->DataSource->CENTER_NAME->GetValue());
                $this->BORROWER_NAME->SetValue($this->DataSource->BORROWER_NAME->GetValue());
                $this->BORROWER_CURRENT_AGE->SetValue($this->DataSource->BORROWER_CURRENT_AGE->GetValue());
                $this->SANCTIONED_AMOUNT->SetValue($this->DataSource->SANCTIONED_AMOUNT->GetValue());
                $this->DISBURSEMENT_DATE->SetValue($this->DataSource->DISBURSEMENT_DATE->GetValue());
                $this->BORROWER_NAME1->SetValue($this->DataSource->BORROWER_NAME1->GetValue());
                $this->Label1->SetValue($this->DataSource->Label1->GetValue());
                $this->Label2->SetValue($this->DataSource->Label2->GetValue());
                $this->Label3->SetValue($this->DataSource->Label3->GetValue());
                $this->Label4->SetValue($this->DataSource->Label4->GetValue());
                $this->Label5->SetValue($this->DataSource->Label5->GetValue());
                $this->Hidden2->SetValue($this->DataSource->Hidden2->GetValue());
                $this->Hidden3->SetValue($this->DataSource->Hidden3->GetValue());
                $this->Hidden4->SetValue($this->DataSource->Hidden4->GetValue());
                $this->Hidden5->SetValue($this->DataSource->Hidden5->GetValue());
                $this->Hidden6->SetValue($this->DataSource->Hidden6->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->MEMBER_ID->Show();
                $this->ListBox1->Show();
                $this->MOBILE_NO->Show();
                $this->GROUP_NAME->Show();
                $this->ListBox2->Show();
                $this->VILLAGE->Show();
                $this->ListBox3->Show();
                $this->CENTER_NAME->Show();
                $this->ListBox4->Show();
                $this->BORROWER_NAME->Show();
                $this->BORROWER_CURRENT_AGE->Show();
                $this->ListBox5->Show();
                $this->ListBox6->Show();
                $this->SANCTIONED_AMOUNT->Show();
                $this->DISBURSEMENT_DATE->Show();
                $this->ListBox8->Show();
                $this->TextBox2->Show();
                $this->TextBox3->Show();
                $this->ListBox9->Show();
                $this->BORROWER_NAME1->Show();
                $this->ListBox7->Show();
                $this->Label1->Show();
                $this->Label2->Show();
                $this->Label3->Show();
                $this->Label4->Show();
                $this->Label5->Show();
                $this->Label6->Show();
                $this->Hidden1->Show();
                $this->ListBox10->Show();
                $this->Hidden2->Show();
                $this->Hidden3->Show();
                $this->Hidden4->Show();
                $this->Hidden5->Show();
                $this->Hidden6->Show();
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
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-21431CB5
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->MEMBER_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MOBILE_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GROUP_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->VILLAGE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CENTER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_CURRENT_AGE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox6->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SANCTIONED_AMOUNT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DISBURSEMENT_DATE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox8->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextBox2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextBox3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox9->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BORROWER_NAME1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox7->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Label6->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Hidden1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ListBox10->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Hidden2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Hidden3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Hidden4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Hidden5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Hidden6->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End welcomecalls Class @2-FCB6E20C

class clswelcomecallsDataSource extends clsDBmysql_cams_v2 {  //welcomecallsDataSource Class @2-13B8BA2E

//DataSource Variables @2-AFA4ADC6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $MEMBER_ID;
    public $MOBILE_NO;
    public $GROUP_NAME;
    public $VILLAGE;
    public $CENTER_NAME;
    public $BORROWER_NAME;
    public $BORROWER_CURRENT_AGE;
    public $SANCTIONED_AMOUNT;
    public $DISBURSEMENT_DATE;
    public $BORROWER_NAME1;
    public $Label1;
    public $Label2;
    public $Label3;
    public $Label4;
    public $Label5;
    public $Hidden2;
    public $Hidden3;
    public $Hidden4;
    public $Hidden5;
    public $Hidden6;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-975E6BD3
    function clswelcomecallsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid welcomecalls";
        $this->Initialize();
        $this->MEMBER_ID = new clsField("MEMBER_ID", ccsText, "");
        
        $this->MOBILE_NO = new clsField("MOBILE_NO", ccsText, "");
        
        $this->GROUP_NAME = new clsField("GROUP_NAME", ccsText, "");
        
        $this->VILLAGE = new clsField("VILLAGE", ccsText, "");
        
        $this->CENTER_NAME = new clsField("CENTER_NAME", ccsText, "");
        
        $this->BORROWER_NAME = new clsField("BORROWER_NAME", ccsText, "");
        
        $this->BORROWER_CURRENT_AGE = new clsField("BORROWER_CURRENT_AGE", ccsInteger, "");
        
        $this->SANCTIONED_AMOUNT = new clsField("SANCTIONED_AMOUNT", ccsInteger, "");
        
        $this->DISBURSEMENT_DATE = new clsField("DISBURSEMENT_DATE", ccsText, "");
        
        $this->BORROWER_NAME1 = new clsField("BORROWER_NAME1", ccsText, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        
        $this->Label2 = new clsField("Label2", ccsText, "");
        
        $this->Label3 = new clsField("Label3", ccsText, "");
        
        $this->Label4 = new clsField("Label4", ccsText, "");
        
        $this->Label5 = new clsField("Label5", ccsText, "");
        
        $this->Hidden2 = new clsField("Hidden2", ccsText, "");
        
        $this->Hidden3 = new clsField("Hidden3", ccsText, "");
        
        $this->Hidden4 = new clsField("Hidden4", ccsText, "");
        
        $this->Hidden5 = new clsField("Hidden5", ccsText, "");
        
        $this->Hidden6 = new clsField("Hidden6", ccsText, "");
        

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

//Prepare Method @2-E75B6161
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlgp_id", ccsText, "", "", $this->Parameters["urlgp_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Group_Code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-0B80EFBB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM welcomecalls";
        $this->SQL = "SELECT * \n\n" .
        "FROM welcomecalls {SQL_Where} {SQL_OrderBy}";
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

//SetValues Method @2-82EBBD92
    function SetValues()
    {
        $this->MEMBER_ID->SetDBValue($this->f("Member_Code"));
        $this->MOBILE_NO->SetDBValue($this->f("Phone"));
        $this->GROUP_NAME->SetDBValue($this->f("Group"));
        $this->VILLAGE->SetDBValue($this->f("Village"));
        $this->CENTER_NAME->SetDBValue($this->f("Center"));
        $this->BORROWER_NAME->SetDBValue($this->f("Member_name"));
        $this->BORROWER_CURRENT_AGE->SetDBValue(trim($this->f("Age")));
        $this->SANCTIONED_AMOUNT->SetDBValue(trim($this->f("Disb_Amt")));
        $this->DISBURSEMENT_DATE->SetDBValue($this->f("Disb_Date"));
        $this->BORROWER_NAME1->SetDBValue($this->f("Member_name"));
        $this->Label1->SetDBValue($this->f("Center_Meeting_Day"));
        $this->Label2->SetDBValue($this->f("Processing_Fee"));
        $this->Label3->SetDBValue($this->f("Insurance"));
        $this->Label4->SetDBValue($this->f("Frequency"));
        $this->Label5->SetDBValue($this->f("Inst_Amount"));
        $this->Hidden2->SetDBValue($this->f("Region"));
        $this->Hidden3->SetDBValue($this->f("Branch"));
        $this->Hidden4->SetDBValue($this->f("Center"));
        $this->Hidden5->SetDBValue($this->f("Group"));
        $this->Hidden6->SetDBValue($this->f("Group_Code"));
    }
//End SetValues Method

} //End welcomecallsDataSource Class @2-FCB6E20C

class clsRecordwc_reports { //wc_reports Class @80-12A01640

//Variables @80-9E315808

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

//Class_Initialize Event @80-8405ED3A
    function clsRecordwc_reports($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record wc_reports/Error";
        $this->DataSource = new clswc_reportsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "wc_reports";
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
            $this->member_id = new clsControl(ccsHidden, "member_id", "Member Id", ccsText, "", CCGetRequestParam("member_id", $Method, NULL), $this);
            $this->member_id->Required = true;
            $this->member_name = new clsControl(ccsHidden, "member_name", "Member Name", ccsText, "", CCGetRequestParam("member_name", $Method, NULL), $this);
            $this->call_log = new clsControl(ccsHidden, "call_log", "Call Log", ccsText, "", CCGetRequestParam("call_log", $Method, NULL), $this);
            $this->ans_1 = new clsControl(ccsHidden, "ans_1", "Ans 1", ccsText, "", CCGetRequestParam("ans_1", $Method, NULL), $this);
            $this->ans_2 = new clsControl(ccsHidden, "ans_2", "Ans 2", ccsText, "", CCGetRequestParam("ans_2", $Method, NULL), $this);
            $this->ans_3 = new clsControl(ccsHidden, "ans_3", "Ans 3", ccsText, "", CCGetRequestParam("ans_3", $Method, NULL), $this);
            $this->ans_4 = new clsControl(ccsHidden, "ans_4", "Ans 4", ccsText, "", CCGetRequestParam("ans_4", $Method, NULL), $this);
            $this->ans_5 = new clsControl(ccsHidden, "ans_5", "Ans 5", ccsText, "", CCGetRequestParam("ans_5", $Method, NULL), $this);
            $this->ans_6 = new clsControl(ccsHidden, "ans_6", "Ans 6", ccsText, "", CCGetRequestParam("ans_6", $Method, NULL), $this);
            $this->ans_7 = new clsControl(ccsHidden, "ans_7", "Ans 7", ccsText, "", CCGetRequestParam("ans_7", $Method, NULL), $this);
            $this->ans_8 = new clsControl(ccsHidden, "ans_8", "Ans 8", ccsText, "", CCGetRequestParam("ans_8", $Method, NULL), $this);
            $this->ans_9 = new clsControl(ccsHidden, "ans_9", "Ans 9", ccsText, "", CCGetRequestParam("ans_9", $Method, NULL), $this);
            $this->ans_10 = new clsControl(ccsHidden, "ans_10", "Ans 10", ccsText, "", CCGetRequestParam("ans_10", $Method, NULL), $this);
            $this->ans_11 = new clsControl(ccsHidden, "ans_11", "Ans 11", ccsText, "", CCGetRequestParam("ans_11", $Method, NULL), $this);
            $this->telecaller_remarks = new clsControl(ccsTextArea, "telecaller_remarks", "Telecaller Remarks", ccsText, "", CCGetRequestParam("telecaller_remarks", $Method, NULL), $this);
            $this->called_by = new clsControl(ccsHidden, "called_by", "Called By", ccsText, "", CCGetRequestParam("called_by", $Method, NULL), $this);
            $this->region = new clsControl(ccsHidden, "region", "Region", ccsText, "", CCGetRequestParam("region", $Method, NULL), $this);
            $this->branch = new clsControl(ccsHidden, "branch", "Branch", ccsText, "", CCGetRequestParam("branch", $Method, NULL), $this);
            $this->centre_name = new clsControl(ccsHidden, "centre_name", "Centre Name", ccsText, "", CCGetRequestParam("centre_name", $Method, NULL), $this);
            $this->group_name = new clsControl(ccsHidden, "group_name", "Group Name", ccsText, "", CCGetRequestParam("group_name", $Method, NULL), $this);
            $this->group_id = new clsControl(ccsHidden, "group_id", "Group Id", ccsText, "", CCGetRequestParam("group_id", $Method, NULL), $this);
            $this->telecaller_status = new clsControl(ccsListBox, "telecaller_status", "Telecaller Status", ccsText, "", CCGetRequestParam("telecaller_status", $Method, NULL), $this);
            $this->telecaller_status->DSType = dsListOfValues;
            $this->telecaller_status->Values = array(array("SATISFACTORY", "SATISFACTORY"), array("UNSATISFACTORY", "UNSATISFACTORY"));
        }
    }
//End Class_Initialize Event

//Initialize Method @80-6794E18E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlmember_id"] = CCGetFromGet("member_id", NULL);
    }
//End Initialize Method

//Validate Method @80-A339BA4F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->member_id->Validate() && $Validation);
        $Validation = ($this->member_name->Validate() && $Validation);
        $Validation = ($this->call_log->Validate() && $Validation);
        $Validation = ($this->ans_1->Validate() && $Validation);
        $Validation = ($this->ans_2->Validate() && $Validation);
        $Validation = ($this->ans_3->Validate() && $Validation);
        $Validation = ($this->ans_4->Validate() && $Validation);
        $Validation = ($this->ans_5->Validate() && $Validation);
        $Validation = ($this->ans_6->Validate() && $Validation);
        $Validation = ($this->ans_7->Validate() && $Validation);
        $Validation = ($this->ans_8->Validate() && $Validation);
        $Validation = ($this->ans_9->Validate() && $Validation);
        $Validation = ($this->ans_10->Validate() && $Validation);
        $Validation = ($this->ans_11->Validate() && $Validation);
        $Validation = ($this->telecaller_remarks->Validate() && $Validation);
        $Validation = ($this->called_by->Validate() && $Validation);
        $Validation = ($this->region->Validate() && $Validation);
        $Validation = ($this->branch->Validate() && $Validation);
        $Validation = ($this->centre_name->Validate() && $Validation);
        $Validation = ($this->group_name->Validate() && $Validation);
        $Validation = ($this->group_id->Validate() && $Validation);
        $Validation = ($this->telecaller_status->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->member_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->member_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->call_log->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_6->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_7->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_8->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_9->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_10->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ans_11->Errors->Count() == 0);
        $Validation =  $Validation && ($this->telecaller_remarks->Errors->Count() == 0);
        $Validation =  $Validation && ($this->called_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->region->Errors->Count() == 0);
        $Validation =  $Validation && ($this->branch->Errors->Count() == 0);
        $Validation =  $Validation && ($this->centre_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->group_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->group_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->telecaller_status->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @80-E1D65C8C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->member_id->Errors->Count());
        $errors = ($errors || $this->member_name->Errors->Count());
        $errors = ($errors || $this->call_log->Errors->Count());
        $errors = ($errors || $this->ans_1->Errors->Count());
        $errors = ($errors || $this->ans_2->Errors->Count());
        $errors = ($errors || $this->ans_3->Errors->Count());
        $errors = ($errors || $this->ans_4->Errors->Count());
        $errors = ($errors || $this->ans_5->Errors->Count());
        $errors = ($errors || $this->ans_6->Errors->Count());
        $errors = ($errors || $this->ans_7->Errors->Count());
        $errors = ($errors || $this->ans_8->Errors->Count());
        $errors = ($errors || $this->ans_9->Errors->Count());
        $errors = ($errors || $this->ans_10->Errors->Count());
        $errors = ($errors || $this->ans_11->Errors->Count());
        $errors = ($errors || $this->telecaller_remarks->Errors->Count());
        $errors = ($errors || $this->called_by->Errors->Count());
        $errors = ($errors || $this->region->Errors->Count());
        $errors = ($errors || $this->branch->Errors->Count());
        $errors = ($errors || $this->centre_name->Errors->Count());
        $errors = ($errors || $this->group_name->Errors->Count());
        $errors = ($errors || $this->group_id->Errors->Count());
        $errors = ($errors || $this->telecaller_status->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @80-EFC50250
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

//InsertRow Method @80-EBBD04E3
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->member_id->SetValue($this->member_id->GetValue(true));
        $this->DataSource->member_name->SetValue($this->member_name->GetValue(true));
        $this->DataSource->call_log->SetValue($this->call_log->GetValue(true));
        $this->DataSource->ans_1->SetValue($this->ans_1->GetValue(true));
        $this->DataSource->ans_2->SetValue($this->ans_2->GetValue(true));
        $this->DataSource->ans_3->SetValue($this->ans_3->GetValue(true));
        $this->DataSource->ans_4->SetValue($this->ans_4->GetValue(true));
        $this->DataSource->ans_5->SetValue($this->ans_5->GetValue(true));
        $this->DataSource->ans_6->SetValue($this->ans_6->GetValue(true));
        $this->DataSource->ans_7->SetValue($this->ans_7->GetValue(true));
        $this->DataSource->ans_8->SetValue($this->ans_8->GetValue(true));
        $this->DataSource->ans_9->SetValue($this->ans_9->GetValue(true));
        $this->DataSource->ans_10->SetValue($this->ans_10->GetValue(true));
        $this->DataSource->ans_11->SetValue($this->ans_11->GetValue(true));
        $this->DataSource->telecaller_remarks->SetValue($this->telecaller_remarks->GetValue(true));
        $this->DataSource->called_by->SetValue($this->called_by->GetValue(true));
        $this->DataSource->region->SetValue($this->region->GetValue(true));
        $this->DataSource->branch->SetValue($this->branch->GetValue(true));
        $this->DataSource->centre_name->SetValue($this->centre_name->GetValue(true));
        $this->DataSource->group_name->SetValue($this->group_name->GetValue(true));
        $this->DataSource->group_id->SetValue($this->group_id->GetValue(true));
        $this->DataSource->telecaller_status->SetValue($this->telecaller_status->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @80-276B509D
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

        $this->telecaller_status->Prepare();

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
                    $this->member_id->SetValue($this->DataSource->member_id->GetValue());
                    $this->member_name->SetValue($this->DataSource->member_name->GetValue());
                    $this->call_log->SetValue($this->DataSource->call_log->GetValue());
                    $this->ans_1->SetValue($this->DataSource->ans_1->GetValue());
                    $this->ans_2->SetValue($this->DataSource->ans_2->GetValue());
                    $this->ans_3->SetValue($this->DataSource->ans_3->GetValue());
                    $this->ans_4->SetValue($this->DataSource->ans_4->GetValue());
                    $this->ans_5->SetValue($this->DataSource->ans_5->GetValue());
                    $this->ans_6->SetValue($this->DataSource->ans_6->GetValue());
                    $this->ans_7->SetValue($this->DataSource->ans_7->GetValue());
                    $this->ans_8->SetValue($this->DataSource->ans_8->GetValue());
                    $this->ans_9->SetValue($this->DataSource->ans_9->GetValue());
                    $this->ans_10->SetValue($this->DataSource->ans_10->GetValue());
                    $this->ans_11->SetValue($this->DataSource->ans_11->GetValue());
                    $this->telecaller_remarks->SetValue($this->DataSource->telecaller_remarks->GetValue());
                    $this->called_by->SetValue($this->DataSource->called_by->GetValue());
                    $this->region->SetValue($this->DataSource->region->GetValue());
                    $this->branch->SetValue($this->DataSource->branch->GetValue());
                    $this->centre_name->SetValue($this->DataSource->centre_name->GetValue());
                    $this->group_name->SetValue($this->DataSource->group_name->GetValue());
                    $this->group_id->SetValue($this->DataSource->group_id->GetValue());
                    $this->telecaller_status->SetValue($this->DataSource->telecaller_status->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->member_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->member_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->call_log->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_7->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_8->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_9->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_10->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ans_11->Errors->ToString());
            $Error = ComposeStrings($Error, $this->telecaller_remarks->Errors->ToString());
            $Error = ComposeStrings($Error, $this->called_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->region->Errors->ToString());
            $Error = ComposeStrings($Error, $this->branch->Errors->ToString());
            $Error = ComposeStrings($Error, $this->centre_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->group_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->group_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->telecaller_status->Errors->ToString());
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
        $this->member_id->Show();
        $this->member_name->Show();
        $this->call_log->Show();
        $this->ans_1->Show();
        $this->ans_2->Show();
        $this->ans_3->Show();
        $this->ans_4->Show();
        $this->ans_5->Show();
        $this->ans_6->Show();
        $this->ans_7->Show();
        $this->ans_8->Show();
        $this->ans_9->Show();
        $this->ans_10->Show();
        $this->ans_11->Show();
        $this->telecaller_remarks->Show();
        $this->called_by->Show();
        $this->region->Show();
        $this->branch->Show();
        $this->centre_name->Show();
        $this->group_name->Show();
        $this->group_id->Show();
        $this->telecaller_status->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End wc_reports Class @80-FCB6E20C

class clswc_reportsDataSource extends clsDBmysql_cams_v2 {  //wc_reportsDataSource Class @80-7066FB0F

//DataSource Variables @80-9428B16D
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
    public $member_id;
    public $member_name;
    public $call_log;
    public $ans_1;
    public $ans_2;
    public $ans_3;
    public $ans_4;
    public $ans_5;
    public $ans_6;
    public $ans_7;
    public $ans_8;
    public $ans_9;
    public $ans_10;
    public $ans_11;
    public $telecaller_remarks;
    public $called_by;
    public $region;
    public $branch;
    public $centre_name;
    public $group_name;
    public $group_id;
    public $telecaller_status;
//End DataSource Variables

//DataSourceClass_Initialize Event @80-61703853
    function clswc_reportsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record wc_reports/Error";
        $this->Initialize();
        $this->member_id = new clsField("member_id", ccsText, "");
        
        $this->member_name = new clsField("member_name", ccsText, "");
        
        $this->call_log = new clsField("call_log", ccsText, "");
        
        $this->ans_1 = new clsField("ans_1", ccsText, "");
        
        $this->ans_2 = new clsField("ans_2", ccsText, "");
        
        $this->ans_3 = new clsField("ans_3", ccsText, "");
        
        $this->ans_4 = new clsField("ans_4", ccsText, "");
        
        $this->ans_5 = new clsField("ans_5", ccsText, "");
        
        $this->ans_6 = new clsField("ans_6", ccsText, "");
        
        $this->ans_7 = new clsField("ans_7", ccsText, "");
        
        $this->ans_8 = new clsField("ans_8", ccsText, "");
        
        $this->ans_9 = new clsField("ans_9", ccsText, "");
        
        $this->ans_10 = new clsField("ans_10", ccsText, "");
        
        $this->ans_11 = new clsField("ans_11", ccsText, "");
        
        $this->telecaller_remarks = new clsField("telecaller_remarks", ccsText, "");
        
        $this->called_by = new clsField("called_by", ccsText, "");
        
        $this->region = new clsField("region", ccsText, "");
        
        $this->branch = new clsField("branch", ccsText, "");
        
        $this->centre_name = new clsField("centre_name", ccsText, "");
        
        $this->group_name = new clsField("group_name", ccsText, "");
        
        $this->group_id = new clsField("group_id", ccsText, "");
        
        $this->telecaller_status = new clsField("telecaller_status", ccsText, "");
        

        $this->InsertFields["member_id"] = array("Name" => "member_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["member_name"] = array("Name" => "member_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["call_log"] = array("Name" => "call_log", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_1"] = array("Name" => "ans_1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_2"] = array("Name" => "ans_2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_3"] = array("Name" => "ans_3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_4"] = array("Name" => "ans_4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_5"] = array("Name" => "ans_5", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_6"] = array("Name" => "ans_6", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_7"] = array("Name" => "ans_7", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_8"] = array("Name" => "ans_8", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_9"] = array("Name" => "ans_9", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_10"] = array("Name" => "ans_10", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ans_11"] = array("Name" => "ans_11", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["telecaller_remarks"] = array("Name" => "telecaller_remarks", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["called_by"] = array("Name" => "called_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["region"] = array("Name" => "region", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["branch"] = array("Name" => "branch", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["centre_name"] = array("Name" => "centre_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["group_name"] = array("Name" => "group_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["group_id"] = array("Name" => "group_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["telecaller_status"] = array("Name" => "telecaller_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @80-E823C3DB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlmember_id", ccsText, "", "", $this->Parameters["urlmember_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "member_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @80-B7D5D697
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM wc_reports {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @80-C901065A
    function SetValues()
    {
        $this->member_id->SetDBValue($this->f("member_id"));
        $this->member_name->SetDBValue($this->f("member_name"));
        $this->call_log->SetDBValue($this->f("call_log"));
        $this->ans_1->SetDBValue($this->f("ans_1"));
        $this->ans_2->SetDBValue($this->f("ans_2"));
        $this->ans_3->SetDBValue($this->f("ans_3"));
        $this->ans_4->SetDBValue($this->f("ans_4"));
        $this->ans_5->SetDBValue($this->f("ans_5"));
        $this->ans_6->SetDBValue($this->f("ans_6"));
        $this->ans_7->SetDBValue($this->f("ans_7"));
        $this->ans_8->SetDBValue($this->f("ans_8"));
        $this->ans_9->SetDBValue($this->f("ans_9"));
        $this->ans_10->SetDBValue($this->f("ans_10"));
        $this->ans_11->SetDBValue($this->f("ans_11"));
        $this->telecaller_remarks->SetDBValue($this->f("telecaller_remarks"));
        $this->called_by->SetDBValue($this->f("called_by"));
        $this->region->SetDBValue($this->f("region"));
        $this->branch->SetDBValue($this->f("branch"));
        $this->centre_name->SetDBValue($this->f("centre_name"));
        $this->group_name->SetDBValue($this->f("group_name"));
        $this->group_id->SetDBValue($this->f("group_id"));
        $this->telecaller_status->SetDBValue($this->f("telecaller_status"));
    }
//End SetValues Method

//Insert Method @80-767F67BD
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["member_id"]["Value"] = $this->member_id->GetDBValue(true);
        $this->InsertFields["member_name"]["Value"] = $this->member_name->GetDBValue(true);
        $this->InsertFields["call_log"]["Value"] = $this->call_log->GetDBValue(true);
        $this->InsertFields["ans_1"]["Value"] = $this->ans_1->GetDBValue(true);
        $this->InsertFields["ans_2"]["Value"] = $this->ans_2->GetDBValue(true);
        $this->InsertFields["ans_3"]["Value"] = $this->ans_3->GetDBValue(true);
        $this->InsertFields["ans_4"]["Value"] = $this->ans_4->GetDBValue(true);
        $this->InsertFields["ans_5"]["Value"] = $this->ans_5->GetDBValue(true);
        $this->InsertFields["ans_6"]["Value"] = $this->ans_6->GetDBValue(true);
        $this->InsertFields["ans_7"]["Value"] = $this->ans_7->GetDBValue(true);
        $this->InsertFields["ans_8"]["Value"] = $this->ans_8->GetDBValue(true);
        $this->InsertFields["ans_9"]["Value"] = $this->ans_9->GetDBValue(true);
        $this->InsertFields["ans_10"]["Value"] = $this->ans_10->GetDBValue(true);
        $this->InsertFields["ans_11"]["Value"] = $this->ans_11->GetDBValue(true);
        $this->InsertFields["telecaller_remarks"]["Value"] = $this->telecaller_remarks->GetDBValue(true);
        $this->InsertFields["called_by"]["Value"] = $this->called_by->GetDBValue(true);
        $this->InsertFields["region"]["Value"] = $this->region->GetDBValue(true);
        $this->InsertFields["branch"]["Value"] = $this->branch->GetDBValue(true);
        $this->InsertFields["centre_name"]["Value"] = $this->centre_name->GetDBValue(true);
        $this->InsertFields["group_name"]["Value"] = $this->group_name->GetDBValue(true);
        $this->InsertFields["group_id"]["Value"] = $this->group_id->GetDBValue(true);
        $this->InsertFields["telecaller_status"]["Value"] = $this->telecaller_status->GetDBValue(true);
        $this->SQL = CCBuildInsert("wc_reports", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End wc_reportsDataSource Class @80-FCB6E20C

//Initialize Page @1-68A34067
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
$TemplateFileName = "welcalls.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-AE607485
include_once("./welcalls_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-149095BE
$DBmysql_cams_v2 = new clsDBmysql_cams_v2();
$MainPage->Connections["mysql_cams_v2"] = & $DBmysql_cams_v2;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$welcomecalls = new clsGridwelcomecalls("", $MainPage);
$wc_reports = new clsRecordwc_reports("", $MainPage);
$MainPage->welcomecalls = & $welcomecalls;
$MainPage->wc_reports = & $wc_reports;
$welcomecalls->Initialize();
$wc_reports->Initialize();

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

//Execute Components @1-0D952088
$wc_reports->Operation();
//End Execute Components

//Go to destination page @1-AC750D88
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBmysql_cams_v2->close();
    header("Location: " . $Redirect);
    unset($welcomecalls);
    unset($wc_reports);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-793CAEE8
$welcomecalls->Show();
$wc_reports->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6EE809CC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBmysql_cams_v2->close();
unset($welcomecalls);
unset($wc_reports);
unset($Tpl);
//End Unload Page


?>
