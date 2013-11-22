<?php
//BindEvents Method @1-7CF2C824
function BindEvents()
{
    global $mfi_docs;
    $mfi_docs->Button_Update->CCSEvents["OnClick"] = "mfi_docs_Button_Update_OnClick";
    $mfi_docs->mfi_doc_entered_by->CCSEvents["BeforeShow"] = "mfi_docs_mfi_doc_entered_by_BeforeShow";
    $mfi_docs->Label1->CCSEvents["BeforeShow"] = "mfi_docs_Label1_BeforeShow";
    $mfi_docs->Label2->CCSEvents["BeforeShow"] = "mfi_docs_Label2_BeforeShow";
    $mfi_docs->ds->CCSEvents["BeforeBuildUpdate"] = "mfi_docs_ds_BeforeBuildUpdate";
    $mfi_docs->ds->CCSEvents["BeforeExecuteUpdate"] = "mfi_docs_ds_BeforeExecuteUpdate";
}
//End BindEvents Method

//mfi_docs_Button_Update_OnClick @6-3CD88230
function mfi_docs_Button_Update_OnClick(& $sender)
{
    $mfi_docs_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_Button_Update_OnClick

//Custom Code @30-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_Button_Update_OnClick @6-C87324B4
    return $mfi_docs_Button_Update_OnClick;
}
//End Close mfi_docs_Button_Update_OnClick

//mfi_docs_mfi_doc_entered_by_BeforeShow @14-C55D6CA5
function mfi_docs_mfi_doc_entered_by_BeforeShow(& $sender)
{
    $mfi_docs_mfi_doc_entered_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_mfi_doc_entered_by_BeforeShow

//Custom Code @31-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_docs->mfi_doc_entered_by->SetValue(CCGetUserLogin());
//Close mfi_docs_mfi_doc_entered_by_BeforeShow @14-5E496FAB
    return $mfi_docs_mfi_doc_entered_by_BeforeShow;
}
//End Close mfi_docs_mfi_doc_entered_by_BeforeShow

//mfi_docs_Label1_BeforeShow @53-51DB119E
function mfi_docs_Label1_BeforeShow(& $sender)
{
    $mfi_docs_Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_Label1_BeforeShow

//Custom Code @60-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$db = new clsDBmysql_cams_v2();
	$sql = "SELECT count(*) FROM mfi_docs WHERE (mfi_doc_status='TAGGED' or mfi_doc_status='DATA ENTRY') and mfi_doc_region='".CCGetCookie("docregion")."'";
	$export = $db->query($sql);
    $row = mysql_fetch_row($export);
	$mfi_docs->Label1->SetValue($row[0]);
	 mysql_close($db);
//Close mfi_docs_Label1_BeforeShow @53-CB07D350
    return $mfi_docs_Label1_BeforeShow;
}
//End Close mfi_docs_Label1_BeforeShow

//mfi_docs_Label2_BeforeShow @61-00909E6F
function mfi_docs_Label2_BeforeShow(& $sender)
{
    $mfi_docs_Label2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_Label2_BeforeShow

//Custom Code @62-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_docs->Label2->SetValue(CCGetCookie("docregion"));
//Close mfi_docs_Label2_BeforeShow @61-B766F68B
    return $mfi_docs_Label2_BeforeShow;
}
//End Close mfi_docs_Label2_BeforeShow



//mfi_docs_ds_BeforeBuildUpdate @29-536480B4
function mfi_docs_ds_BeforeBuildUpdate(& $sender)
{
    $mfi_docs_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_ds_BeforeBuildUpdate

//Custom Code @32-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_ds_BeforeBuildUpdate @29-414F6709
    return $mfi_docs_ds_BeforeBuildUpdate;
}
//End Close mfi_docs_ds_BeforeBuildUpdate

//mfi_docs_ds_BeforeExecuteUpdate @29-27FC880D
function mfi_docs_ds_BeforeExecuteUpdate(& $sender)
{
    $mfi_docs_ds_BeforeExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_ds_BeforeExecuteUpdate

//Custom Code @33-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_ds_BeforeExecuteUpdate @29-137409CA
    return $mfi_docs_ds_BeforeExecuteUpdate;
}
//End Close mfi_docs_ds_BeforeExecuteUpdate


?>
