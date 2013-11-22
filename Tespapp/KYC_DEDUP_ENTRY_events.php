<?php
//BindEvents Method @1-41DF382D
function BindEvents()
{
    global $mfi_docs;
    $mfi_docs->Button_Update->CCSEvents["OnClick"] = "mfi_docs_Button_Update_OnClick";
    $mfi_docs->mfi_doc_entered_by->CCSEvents["BeforeShow"] = "mfi_docs_mfi_doc_entered_by_BeforeShow";
    $mfi_docs->Label1->CCSEvents["BeforeShow"] = "mfi_docs_Label1_BeforeShow";
    $mfi_docs->Label2->CCSEvents["BeforeShow"] = "mfi_docs_Label2_BeforeShow";
    $mfi_docs->ds->CCSEvents["BeforeBuildUpdate"] = "mfi_docs_ds_BeforeBuildUpdate";
    $mfi_docs->ds->CCSEvents["BeforeExecuteUpdate"] = "mfi_docs_ds_BeforeExecuteUpdate";
    $mfi_docs->CCSEvents["BeforeShow"] = "mfi_docs_BeforeShow";
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
 $query = "SELECT count(*)as cnt FROM mfi_docs WHERE (mfi_doc_status='DATA ENTERED' or mfi_doc_status='DEDUPING') and mfi_doc_region='".CCGetCookie("docregion")."' and batch_code='".CCGetCookie("batch_code")."' and mfi_doc_type='KYC'";
 $result = $db->query($query);
  if ($result){
  	$db->next_record();
	$mfi_docs->Label1->SetValue($db->f("cnt"));
	}
	if($db->f("cnt")==0)
	{
	$query="update batch_details_dedup set status='COMPLETED',DATE_COMPLETED=now() where mfi_doc_region='".CCGetCookie("docregion")."' and batch_code='".CCGetCookie("batch_code")."'";
	$db->query($query);
	}
	else
	{
	$query="update batch_details_dedup set status='INCOMPLETE' where mfi_doc_region='".CCGetCookie("docregion")."' and batch_code='".CCGetCookie("batch_code")."'";
	$db->query($query);
	}
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

//mfi_docs_BeforeShow @29-D278B992
function mfi_docs_BeforeShow(& $sender)
{
    $mfi_docs_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_BeforeShow
		$conn = new clsDBmysql_cams_v2();
		$conn->query("select mfi_doc_region,batch_code  from batch_details_dedup where ca_alloted='".strtoupper(CCGetUserLogin())."' and (status='INCOMPLETE'||status='NOT ALLOTED')");
		$conn->next_record();
		$rcnt=$conn->f("mfi_doc_region");
		if($rcnt)
		{
			CCSetCookie("docregion",$conn->f("mfi_doc_region"));
			CCSetCookie("batch_code",$conn->f("batch_code"));
			//$mfi_docs->ImageLink1->Visible=false;
		}
	
//Custom Code @70-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_BeforeShow @29-29C6B173
    return $mfi_docs_BeforeShow;
}
//End Close mfi_docs_BeforeShow


?>
