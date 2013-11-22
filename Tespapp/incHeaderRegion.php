<?php

class clsincHeaderRegion { //incHeaderRegion class @1-E59616C6

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

//Class_Initialize Event @1-75621319
    function clsincHeaderRegion($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "incHeaderRegion.php";
        $this->Redirect = "";
        $this->TemplateFileName = "incHeaderRegion.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-32FD4740
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
    }
//End Class_Terminate Event

//BindEvents Method @1-B4EA16FE
    function BindEvents()
    {
        $this->lblUserName->CCSEvents["BeforeShow"] = "incHeaderRegion_lblUserName_BeforeShow";
        $this->pnlLogout->CCSEvents["BeforeShow"] = "incHeaderRegion_pnlLogout_BeforeShow";
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

//Initialize Method @1-04123D6A
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
        $this->pnlLogout = new clsPanel("pnlLogout", $this);
        $this->lblUserName = new clsControl(ccsLabel, "lblUserName", "lblUserName", ccsText, "", CCGetRequestParam("lblUserName", ccsGet, NULL), $this);
        $this->linkLogout = new clsControl(ccsImageLink, "linkLogout", "linkLogout", ccsText, "", CCGetRequestParam("linkLogout", ccsGet, NULL), $this);
        $this->linkLogout->Page = ServerURL . "index.php";
        $this->Link1 = new clsControl(ccsImageLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "userHomeRegion.php";
        $this->pnlLogout->AddComponent("lblUserName", $this->lblUserName);
        $this->pnlLogout->AddComponent("linkLogout", $this->linkLogout);
        $this->pnlLogout->AddComponent("Link1", $this->Link1);
        if(!is_array($this->linkLogout->Value) && !strlen($this->linkLogout->Value) && $this->linkLogout->Value !== false)
            $this->linkLogout->SetText('Logout');
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
        $this->linkLogout->Parameters = "";
        $this->linkLogout->Parameters = CCAddParam($this->linkLogout->Parameters, "Logout", true);
    }
//End Initialize Method

//Show Method @1-354B7A63
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
        $this->pnlLogout->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
        $TplData = $Tpl->GetVar($this->ComponentName);
        $Tpl->SetVar($this->ComponentName, $TplData);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
    }
//End Show Method

} //End incHeaderRegion Class @1-FCB6E20C

//Include Event File @1-10ACBE2E
include_once(RelativePath . "/incHeaderRegion_events.php");
//End Include Event File


?>
