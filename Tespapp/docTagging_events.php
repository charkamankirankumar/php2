<?php
//BindEvents Method @1-824BB2FF
function BindEvents()
{
    global $mfi_docs;
    global $PagePanel;
    $mfi_docs->mfi_doc_tagged_by->CCSEvents["BeforeShow"] = "mfi_docs_mfi_doc_tagged_by_BeforeShow";
    $mfi_docs->mfi_doc_filename->CCSEvents["BeforeShow"] = "mfi_docs_mfi_doc_filename_BeforeShow";
    $mfi_docs->no_records->CCSEvents["BeforeShow"] = "mfi_docs_no_records_BeforeShow";
    $mfi_docs->batch_code->CCSEvents["BeforeShow"] = "mfi_docs_batch_code_BeforeShow";
    $mfi_docs->CCSEvents["BeforeUpdate"] = "mfi_docs_BeforeUpdate";
    $mfi_docs->CCSEvents["BeforeShow"] = "mfi_docs_BeforeShow";
    $mfi_docs->CCSEvents["AfterUpdate"] = "mfi_docs_AfterUpdate";
    $mfi_docs->ds->CCSEvents["BeforeBuildSelect"] = "mfi_docs_ds_BeforeBuildSelect";
    $mfi_docs->ds->CCSEvents["BeforeBuildUpdate"] = "mfi_docs_ds_BeforeBuildUpdate";
    $PagePanel->CCSEvents["BeforeShow"] = "PagePanel_BeforeShow";
}
//End BindEvents Method

//mfi_docs_mfi_doc_tagged_by_BeforeShow @137-682D373E
function mfi_docs_mfi_doc_tagged_by_BeforeShow(& $sender)
{
    $mfi_docs_mfi_doc_tagged_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_mfi_doc_tagged_by_BeforeShow

//Custom Code @220-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_docs->mfi_doc_tagged_by->SetValue(CCGetUserLogin());
//Close mfi_docs_mfi_doc_tagged_by_BeforeShow @137-CFBD99D9
    return $mfi_docs_mfi_doc_tagged_by_BeforeShow;
}
//End Close mfi_docs_mfi_doc_tagged_by_BeforeShow

//mfi_docs_mfi_doc_filename_BeforeShow @133-477CE0DC
function mfi_docs_mfi_doc_filename_BeforeShow(& $sender)
{
    $mfi_docs_mfi_doc_filename_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_mfi_doc_filename_BeforeShow

//Retrieve Value for Variable @189-F9B3FCF7
    $oldtiffile = $Container->mfi_doc_path->GetValue()."/".$Container->mfi_doc_filename->GetValue();
//End Retrieve Value for Variable

//Retrieve Value for Variable @190-362AF915
    $oldjpgfile = $Container->mfi_doc_path->GetValue()."/".substr($Container->mfi_doc_filename->GetValue(),0,strripos($Container->mfi_doc_filename->GetValue(),".")).".jpg";
//End Retrieve Value for Variable

//Custom Code @191-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
    
//Close mfi_docs_mfi_doc_filename_BeforeShow @133-3F1A5C1B
    return $mfi_docs_mfi_doc_filename_BeforeShow;
}
//End Close mfi_docs_mfi_doc_filename_BeforeShow

//mfi_docs_no_records_BeforeShow @195-C43BCA8C
function mfi_docs_no_records_BeforeShow(& $sender)
{
    $mfi_docs_no_records_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_no_records_BeforeShow

//Retrieve Value for Control @196-52DF9AD4
    $Container->no_records->SetValue($Container->mfi_doc_id->GetValue() == NULL ? "No documents" : "");
//End Retrieve Value for Control

//Close mfi_docs_no_records_BeforeShow @195-2938C4DC
    return $mfi_docs_no_records_BeforeShow;
}
//End Close mfi_docs_no_records_BeforeShow

//mfi_docs_batch_code_BeforeShow @61-113E335D
function mfi_docs_batch_code_BeforeShow(& $sender)
{
    $mfi_docs_batch_code_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_batch_code_BeforeShow

//Custom Code @62-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_batch_code_BeforeShow @61-12D80A96
    return $mfi_docs_batch_code_BeforeShow;
}
//End Close mfi_docs_batch_code_BeforeShow

//mfi_docs_BeforeUpdate @128-71335C8D
function mfi_docs_BeforeUpdate(& $sender)
{
    $mfi_docs_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_BeforeUpdate

//Custom Code @186-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$Container->mfi_doc_tagged_at->SetValue(date("Y-m-d H:i:s"));
//Close mfi_docs_BeforeUpdate @128-2DD083C3
    return $mfi_docs_BeforeUpdate;
}
//End Close mfi_docs_BeforeUpdate

//mfi_docs_BeforeShow @128-D278B992
function mfi_docs_BeforeShow(& $sender)
{
    $mfi_docs_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_BeforeShow

//Custom Code @200-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
if(CCGetCookie('batch_code'))
{
$db = new clsDBmysql_cams_v2();
$query = "select count(*)from mfi_docs where batch_code='".CCGetCookie('batch_code')."' and mfi_doc_status='UNTAGGED'";
$export  = $db->query($query);
	$row = mysql_fetch_row($export);
	$mfi_docs->Label1->SetValue($row[0]);
	if($row[0]>0)
	{
	$query = "select count(*),mfi_doc_type from mfi_docs where batch_code='".CCGetCookie('batch_code')."' group by mfi_doc_type";
	$export  = $db->query($query);
	$row1 = mysql_fetch_row($export);
	$pdng=$row1[0];

			$t=0;
			while($row1 = mysql_fetch_row($export))
			{
				switch($row1[1])
				{
				  case "GP":
				  $mfi_docs->ngp->SetValue($row1[0]);
				  $t+=$row[0];
				  break;
				  case "CP":
				  $mfi_docs->ncp->SetValue($row1[0]);
				  $t+=$row1[0];
				  break;
				  case "GLE":
				  $mfi_docs->ngle->SetValue($row1[0]);
				  $t+=$row1[0];
				  break;
				  case "LA1":
				  $mfi_docs->nla1->SetValue($row1[0]);
				  $t+=$row1[0];
				  break;
				  case "LA2":
				  $mfi_docs->nla2->SetValue($row1[0]);
				  $t+=$row1[0];
				  break;
				  case "HV1":
				  $mfi_docs->nhv1->SetValue($row1[0]);
				  $t+=$row1[0];
				  break;
				  case "HV2":
				  $mfi_docs->nhv2->SetValue($row1[0]);
				  $t+=$row1[0];
				  break;
				  case "INVALID IMAGE":
				  $mfi_docs->nii->SetValue($row1[0]);
				  $t+=$row1[0];
				  break;
		 
			    }

			}
			$mfi_docs->tot_images->SetValue($pdng+$t);
			$mfi_docs->tot_img->SetValue($t);
		
	}
	else 
	{
		$db1 = new clsDBmysql_cams_v2();
	 	$sql="delete from doctagging where batch_code='".CCGetCookie('batch_code')."'";
	 	//echo "<script language='javascript'>alert('".$sql."');</script>";
	 	$export  = $db1->query($sql);
	 	CCSetCookie("batch_code","",1);
	 	
	}	 
}
else
{
$db = new clsDBmysql_cams_v2();
$query = "select batch_code from mfi_docs where mfi_doc_status='UNTAGGED' and batch_code not in(select batch_code from doctagging)group by batch_code limit 1";
$export  = $db->query($query);
	$row = mysql_fetch_row($export);
	if(count($row)>0)
	{
		$query = "insert into doctagging values('".$row[0]."','".CCGetUserLogin()."')";
		if($export  = $db->query($query))
		{
			CCSetCookie("batch_code",$row[0]);
			
		}
	}
}
//Close mfi_docs_BeforeShow @128-29C6B173
    return $mfi_docs_BeforeShow;
}
//End Close mfi_docs_BeforeShow



//mfi_docs_AfterUpdate @128-22727223
function mfi_docs_AfterUpdate(& $sender)
{
    $mfi_docs_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_AfterUpdate

//Custom Code @192-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_AfterUpdate @128-7FA11D77
    return $mfi_docs_AfterUpdate;
}
//End Close mfi_docs_AfterUpdate

//mfi_docs_ds_BeforeBuildSelect @128-54F2C970
function mfi_docs_ds_BeforeBuildSelect(& $sender)
{
    $mfi_docs_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_ds_BeforeBuildSelect

//Custom Code @214-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_ds_BeforeBuildSelect @128-7B3F5F2B
    return $mfi_docs_ds_BeforeBuildSelect;
}
//End Close mfi_docs_ds_BeforeBuildSelect

//mfi_docs_ds_BeforeBuildUpdate @128-536480B4
function mfi_docs_ds_BeforeBuildUpdate(& $sender)
{
    $mfi_docs_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_docs; //Compatibility
//End mfi_docs_ds_BeforeBuildUpdate

//Custom Code @219-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_docs_ds_BeforeBuildUpdate @128-414F6709
    return $mfi_docs_ds_BeforeBuildUpdate;
}
//End Close mfi_docs_ds_BeforeBuildUpdate

//PagePanel_BeforeShow @6-A8A39FD9
function PagePanel_BeforeShow(& $sender)
{
    $PagePanel_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $PagePanel; //Compatibility
//End PagePanel_BeforeShow

//Hide-Show Component @125-499CD87D
    $Parameter1 = CCGetUserLogin();
    $Parameter2 = NULL;
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close PagePanel_BeforeShow @6-D3554952
    return $PagePanel_BeforeShow;
}
//End Close PagePanel_BeforeShow

?>
