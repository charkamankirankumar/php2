<?php
//BindEvents Method @1-9F401869
function BindEvents()
{
    global $overlap_reports1;
    $overlap_reports1->MBR_ID->CCSEvents["BeforeShow"] = "overlap_reports1_MBR_ID_BeforeShow";
}
//End BindEvents Method

//overlap_reports1_MBR_ID_BeforeShow @89-3CD2F110
function overlap_reports1_MBR_ID_BeforeShow(& $sender)
{
    $overlap_reports1_MBR_ID_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $overlap_reports1; //Compatibility
//End overlap_reports1_MBR_ID_BeforeShow

//Custom Code @90-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$conn = new clsDBmysql_cams_v2();
 $query = "overlap_reports set cb_analysys_status='PENDING' WHERE `MBR-ID` LIKE '".CCGetParam(mfi_doc_id)." ;";
 $result = $conn->query($query);
  if ($result){
  	$Container->mfi_doc_id->SetValue('SUCCESS');
	
 }else{
 	$Container->mfi_doc_id->SetValue('FAILED');
   }
  $query = "UPDATE mfi_docs SET mfi_doc_status = 'DATA ENTERED', mfi_doc_updatedon = NOW()  WHERE mfi_doc_updatedon < DATE_SUB(NOW(),INTERVAL 5 MINUTE) AND mfi_doc_status = 'VERIFYING' AND isnull(mfi_doc_verified_at); ";
   $result = $conn->query($query);
//Close overlap_reports1_MBR_ID_BeforeShow @89-96B019AB
    return $overlap_reports1_MBR_ID_BeforeShow;
}
//End Close overlap_reports1_MBR_ID_BeforeShow


?>
