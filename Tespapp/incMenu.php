<?php

class clsMenuincMenuMenu1 extends clsMenu { //Menu1 class @2-ED9E52BB

//Class_Initialize Event @2-4165877A
    function clsMenuincMenuMenu1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Menu1";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu Menu1";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("Customer, Groups & Centres"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("Manage Customer,Groups and Centres"));
        $this->StaticItems[] = array("item_id" => "MenuItem3Item1", "item_id_parent" => "MenuItem3", "item_caption" => $CCSLocales->GetText("MANAGE NUMBERING"), "item_url" => array("Page" => $this->RelativePath . "MANAGE_NUMBERING.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("MANAGE NUMBERING"));
        $this->StaticItems[] = array("item_id" => "MenuItem3Item2", "item_id_parent" => "MenuItem3", "item_caption" => $CCSLocales->GetText("MANAGE KYC"), "item_url" => array("Page" => $this->RelativePath . "ManageKYC.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("MANAGE KYC"));
        $this->StaticItems[] = array("item_id" => "MenuItem3Item3", "item_id_parent" => "MenuItem3", "item_caption" => $CCSLocales->GetText("MANAGE CP"), "item_url" => array("Page" => $this->RelativePath . "manageCP.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("MANAGE CP"));
        $this->StaticItems[] = array("item_id" => "MenuItem3Item5", "item_id_parent" => "MenuItem3", "item_caption" => $CCSLocales->GetText("MANAGE LA"), "item_url" => array("Page" => $this->RelativePath . "ManageLAForm.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem3Item4", "item_id_parent" => "MenuItem3", "item_caption" => $CCSLocales->GetText("File Upload"), "item_url" => array("Page" => $this->RelativePath . "manageFileUpload.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("File Upload"));
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("Credit Appraisal"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem2Item1", "item_id_parent" => "MenuItem2", "item_caption" => $CCSLocales->GetText("CB VERIFICATION"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("CB VERIFICATION"));
        $this->StaticItems[] = array("item_id" => "MenuItem2Item1Item1", "item_id_parent" => "MenuItem2Item1", "item_caption" => $CCSLocales->GetText("DOWNLOAD TXT FOR CB"), "item_url" => array("Page" => $this->RelativePath . "CBEnquiryPage.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("DOWNLOAD TXT FOR CB"));
        $this->StaticItems[] = array("item_id" => "MenuItem2Item1Item2", "item_id_parent" => "MenuItem2Item1", "item_caption" => $CCSLocales->GetText("UPLOAD & RUN CB (XML)"), "item_url" => array("Page" => $this->RelativePath . "CBResponseUpload.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("UPLOAD & RUN CB (XML)"));
        $this->StaticItems[] = array("item_id" => "MenuItem2Item1Item3", "item_id_parent" => "MenuItem2Item1", "item_caption" => $CCSLocales->GetText("CHECK CB ANALYSIS"), "item_url" => array("Page" => $this->RelativePath . "CBResponseAnalysys.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("CHECK CB ANALYSIS"));
        $this->StaticItems[] = array("item_id" => "MenuItem2Item2", "item_id_parent" => "MenuItem2", "item_caption" => $CCSLocales->GetText("TELE VERIFICATION"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("TELE VERIFICATION"));
        $this->StaticItems[] = array("item_id" => "MenuItem2Item2Item1", "item_id_parent" => "MenuItem2Item2", "item_caption" => $CCSLocales->GetText("TELECALLING"), "item_url" => array("Page" => $this->RelativePath . "TCSearch.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("TELECALLING"));
        $this->StaticItems[] = array("item_id" => "MenuItem2Item2Item2", "item_id_parent" => "MenuItem2Item2", "item_caption" => $CCSLocales->GetText("WELCOME CALLS"), "item_url" => array("Page" => $this->RelativePath . "TC_WEL_SEARCH.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("WELCOME CALLS"));
        $this->StaticItems[] = array("item_id" => "MenuItem6", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("Reports & Analytics"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item1", "item_id_parent" => "MenuItem6", "item_caption" => $CCSLocales->GetText("TRACKER DOWNLOAD"), "item_url" => array("Page" => $this->RelativePath . "DATA_ENTRY_REPORT.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("TRACKER DOWNLOAD"));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item2", "item_id_parent" => "MenuItem6", "item_caption" => $CCSLocales->GetText("STATUS UPDATE"), "item_url" => array("Page" => $this->RelativePath . "LAStatusCheck.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("STATUS UPDATE"));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item3", "item_id_parent" => "MenuItem6", "item_caption" => $CCSLocales->GetText("BATCH SUMMARY"), "item_url" => array("Page" => $this->RelativePath . "Doc_Tagging_Report_Summary.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("STATUS UPDATE"));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item4", "item_id_parent" => "MenuItem6", "item_caption" => $CCSLocales->GetText("TC REPORT"), "item_url" => array("Page" => $this->RelativePath . "TC_DATA_REPORT.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("TC REPORT"));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item5", "item_id_parent" => "MenuItem6", "item_caption" => $CCSLocales->GetText("DATA ENTRY PENDING"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("DATA ENTRY PENDING"));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item5Item1", "item_id_parent" => "MenuItem6Item5", "item_caption" => $CCSLocales->GetText("DATA ENTRY"), "item_url" => array("Page" => $this->RelativePath . "satdocpending.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item5Item2", "item_id_parent" => "MenuItem6Item5", "item_caption" => $CCSLocales->GetText("NUBERING PENDING"), "item_url" => array("Page" => $this->RelativePath . "number_pending.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item7", "item_id_parent" => "MenuItem6", "item_caption" => $CCSLocales->GetText("ERROR REJECTION"), "item_url" => array("Page" => $this->RelativePath . "ERROR_REJECTION.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item8", "item_id_parent" => "MenuItem6", "item_caption" => $CCSLocales->GetText("Region File Upload Report"), "item_url" => array("Page" => $this->RelativePath . "file_upload_report.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem6Item9", "item_id_parent" => "MenuItem6", "item_caption" => $CCSLocales->GetText("TBD Generate"), "item_url" => array("Page" => $this->RelativePath . "tbd_gen.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem9", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("NewDataEntry"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem9Item3", "item_id_parent" => "MenuItem9", "item_caption" => $CCSLocales->GetText("Doc Tagging"), "item_url" => array("Page" => $this->RelativePath . "docTagging.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("Set Image Type"));
        $this->StaticItems[] = array("item_id" => "MenuItem9Item4", "item_id_parent" => "MenuItem9", "item_caption" => $CCSLocales->GetText("DOC NUMBERING"), "item_url" => array("Page" => "", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("DOC NUMBERING"));
        $this->StaticItems[] = array("item_id" => "MenuItem9Item4Item1", "item_id_parent" => "MenuItem9Item4", "item_caption" => $CCSLocales->GetText("DOC PRE NUMBERING"), "item_url" => array("Page" => $this->RelativePath . "doc_Pre_Numbering.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("DOC PRE NUMBERING"));
        $this->StaticItems[] = array("item_id" => "MenuItem9Item4Item2", "item_id_parent" => "MenuItem9Item4", "item_caption" => $CCSLocales->GetText("DOC NUMBERING"), "item_url" => array("Page" => $this->RelativePath . "doc_Numbering.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("DOC NUMBERING"));
        $this->StaticItems[] = array("item_id" => "MenuItem9Item5", "item_id_parent" => "MenuItem9", "item_caption" => $CCSLocales->GetText("DATA ENTRY(BATCH WISE)"), "item_url" => array("Page" => $this->RelativePath . "BatchDataEntry.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("DATA ENTRY(BATCH WISE)"));
        $this->StaticItems[] = array("item_id" => "MenuItem9Item6", "item_id_parent" => "MenuItem9", "item_caption" => $CCSLocales->GetText("KYC DEDUPE"), "item_url" => array("Page" => $this->RelativePath . "KYC_DEDUP_ENTRY.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText("KYC DEDUPE"));
        $this->StaticItems[] = array("item_id" => "MenuItem9Item7", "item_id_parent" => "MenuItem9", "item_caption" => $CCSLocales->GetText("ERROR ENTRY"), "item_url" => array("Page" => $this->RelativePath . "ErrorEntry.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));
        $this->StaticItems[] = array("item_id" => "MenuItem7", "item_id_parent" => null, "item_caption" => $CCSLocales->GetText("Change Password"), "item_url" => array("Page" => $this->RelativePath . "ChangePassword.php", "Parameters" => null), "item_target" => "", "item_title" => $CCSLocales->GetText(""));

        $this->DataSource = new clsincMenuMenu1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);

        $this->ItemLink = new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @2-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @2-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End Menu1 Class @2-FCB6E20C

//incMenuMenu1DataSource Class @2-02B7D116
class clsincMenuMenu1DataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clsincMenuMenu1DataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu Menu1";
        $this->ItemLink = new clsField("ItemLink", ccsText, "");
        $this->FieldsList["ItemLink"] = & $this->ItemLink;
    }

    function Prepare()
    {
    }

    function Open()
    {
        $this->query($this->Parent->StaticItems);
    }

    function SetValues()
    {
        $this->ItemLink->SetDBValue($this->f("item_caption"));
    }
}
//End incMenuMenu1DataSource Class

class clsincMenu { //incMenu class @1-9402F1D9

//Variables @1-EEEBE252
    public $ComponentType = "IncludablePage";
    public $Connections = array();
    public $FileName = "";
    public $Redirect = "";
    public $Tpl = "";
    public $TemplateFileName = "";
    public $BlockToParse = "";
    public $ComponentName = "";
    public $Attributes = "";

    // Events;
    public $CCSEvents = "";
    public $CCSEventResult = "";
    public $RelativePath;
    public $Visible;
    public $Parent;
    public $TemplateSource;
//End Variables

//Class_Initialize Event @1-F3633701
    function clsincMenu($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "incMenu.php";
        $this->Redirect = "";
        $this->TemplateFileName = "incMenu.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-D27CC112
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->Menu1);
    }
//End Class_Terminate Event

//BindEvents Method @1-0DAD0D56
    function BindEvents()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-9FAC36EE
    function Initialize($Path = "")
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->Menu1 = new clsMenuincMenuMenu1($this->RelativePath, $this);
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-8F5A1CD0
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        if ($this->TemplateSource) {
            $Tpl->LoadTemplateFromStr($this->TemplateSource, $this->ComponentName, $this->TemplateEncoding);
        } else {
            $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        }
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->Menu1->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
        $TplData = $Tpl->GetVar($this->ComponentName);
        $Tpl->SetVar($this->ComponentName, $TplData);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
    }
//End Show Method

} //End incMenu Class @1-FCB6E20C


?>
