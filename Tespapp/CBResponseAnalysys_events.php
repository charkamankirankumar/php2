<?php
//BindEvents Method @1-F0FDB86F
function BindEvents()
{
    global $overlap_reports;
    $overlap_reports->overlap_reports_TotalRecords->CCSEvents["BeforeShow"] = "overlap_reports_overlap_reports_TotalRecords_BeforeShow";
    $overlap_reports->CCSEvents["BeforeShowRow"] = "overlap_reports_BeforeShowRow";
    $overlap_reports->ds->CCSEvents["BeforeBuildSelect"] = "overlap_reports_ds_BeforeBuildSelect";
}
//End BindEvents Method

//overlap_reports_overlap_reports_TotalRecords_BeforeShow @17-EFEA8B99
function overlap_reports_overlap_reports_TotalRecords_BeforeShow(& $sender)
{
    $overlap_reports_overlap_reports_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $overlap_reports; //Compatibility
//End overlap_reports_overlap_reports_TotalRecords_BeforeShow

//Retrieve number of records @18-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records
$overlap_reports->overlap_reports_TotalRecords->SetValue($overlap_reports->DataSource->RecordsCount);
//Close overlap_reports_overlap_reports_TotalRecords_BeforeShow @17-9809C9AC
    return $overlap_reports_overlap_reports_TotalRecords_BeforeShow;
}
//End Close overlap_reports_overlap_reports_TotalRecords_BeforeShow

//overlap_reports_BeforeShowRow @16-59A91898
function overlap_reports_BeforeShowRow(& $sender)
{
    $overlap_reports_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $overlap_reports; //Compatibility
//End overlap_reports_BeforeShowRow

//Set Row Style @26-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close overlap_reports_BeforeShowRow @16-96ABF5C2
    return $overlap_reports_BeforeShowRow;
}
//End Close overlap_reports_BeforeShowRow

//overlap_reports_ds_BeforeBuildSelect @16-87D59F2F
function overlap_reports_ds_BeforeBuildSelect(& $sender)
{
    $overlap_reports_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $overlap_reports; //Compatibility
//End overlap_reports_ds_BeforeBuildSelect

//Custom Code @106-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
		if(isset($_COOKIE[header_id])||count($_GET)>0)
		{
		$overlap_reports->Visible=true;
		}
		else
		{
		$overlap_reports->DataSource->SQL="";
		$overlap_reports->Visible=false;
		}
//Close overlap_reports_ds_BeforeBuildSelect @16-EC904952
    return $overlap_reports_ds_BeforeBuildSelect;
}
//End Close overlap_reports_ds_BeforeBuildSelect
	

//$CBAnalysys_EFIMO_Code->Hidden1->SetValue(CCGetUserLogin());

//$CBAnalysys_EFIMO_Code->DataSource->Where=" `FILE-NAME`='".$CBAnalysys_EFIMO_Code->ListBox1->GetValue()."'";



?>
