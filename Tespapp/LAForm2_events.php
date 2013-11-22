<?php
//BindEvents Method @1-DC8255CE
function BindEvents()
{
    global $mfi_la2;
    $mfi_la2->CCSEvents["AfterInsert"] = "mfi_la2_AfterInsert";
    $mfi_la2->CCSEvents["AfterUpdate"] = "mfi_la2_AfterUpdate";
    $mfi_la2->CCSEvents["BeforeShow"] = "mfi_la2_BeforeShow";
}
//End BindEvents Method

//mfi_la2_AfterInsert @2-F995F8AF
function mfi_la2_AfterInsert(& $sender)
{
    $mfi_la2_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_la2; //Compatibility
//End mfi_la2_AfterInsert

//Custom Code @119-2A29BDB7
// -------------------------
    $gpname=$mfi_la2->gp_no->GetValue();
    $sql="select count(*) from mfi_group_details where group_name='".$gpname."'";
    $db=new clsDBmysql_cams_v2();
    $result=$db->query($sql);
    $row=mysql_fetch_row($result);
    if($row[0]>0)
    {
    	$sql="select group_member_count from mfi_group_details where group_name='".$gpname."'";
    	$result=$db->query($sql);
    	$row=mysql_fetch_row($result);
    	$memcnt=$row[0]+1;
    	$sql="update mfi_group_details set group_member_count=".$memcnt." where group_name='".$gpname."'";
    	$result=$db->query($sql);
    }
    else
    {
    	$gpcount=$mfi_la2->group_size->GetValue();
    	$sql="insert into mfi_group_details(group_name,group_size) values('".$gpname."',".$gpcount.")";
    	$result=$db->query($sql);	
    }
// -------------------------
//End Custom Code

//Close mfi_la2_AfterInsert @2-36187AE7
    return $mfi_la2_AfterInsert;
}
//End Close mfi_la2_AfterInsert

//mfi_la2_AfterUpdate @2-F0D338BE
function mfi_la2_AfterUpdate(& $sender)
{
    $mfi_la2_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_la2; //Compatibility
//End mfi_la2_AfterUpdate

//Custom Code @120-2A29BDB7
// -------------------------
     $gpname=$mfi_la2->gp_no->GetValue();
    $sql="select count(*) from mfi_group_details where group_name='".$gpname."'";
    $db=new clsDBcams_ffsl_v2();
    $result=$db->query($sql);
    $row=mysql_fetch_row($result);
    if($row[0]>0)
    {
    	$sql="select group_member_count from mfi_group_details where group_name='".$gpname."'";
    	$result=$db->query($sql);
    	$row=mysql_fetch_row($result);
    	$memcnt=$row[0]+1;
    	$sql="update mfi_group_details set group_member_count=".$memcnt." where group_name='".$gpname."'";
    	$result=$db->query($sql);
    }
    else
    {
    	$gpcount=$mfi_la2->group_size->GetValue();
    	$sql="insert into mfi_group_details(group_name,group_size) values('".$gpname."',".$gpcount.")";
    	$result=$db->query($sql);	
    }
// -------------------------
//End Custom Code

//Close mfi_la2_AfterUpdate @2-F931BB68
    return $mfi_la2_AfterUpdate;
}
//End Close mfi_la2_AfterUpdate

//mfi_la2_BeforeShow @2-1ED744CE
function mfi_la2_BeforeShow(& $sender)
{
    $mfi_la2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_la2; //Compatibility
//End mfi_la2_BeforeShow

//Custom Code @125-2A29BDB7
// -------------------------
	date_default_timezone_set ( 'Asia/Kolkata');
    $dat=date("Y-m-d H:i:s");
    if($mfi_la2->EditMode)
    {
    	$mfi_la2->updated_by->SetValue(CCGetUserLogin());
    	$mfi_la2->updated_at->setValue($dat);
    }
    else
    {
    	$mfi_la2->added_by->SetValue(CCGetUserLogin());
    	$mfi_la2->added_at->SetValue($dat);
    }
// -------------------------
//End Custom Code

//Close mfi_la2_BeforeShow @2-6AB27AA3
    return $mfi_la2_BeforeShow;
}
//End Close mfi_la2_BeforeShow


?>
