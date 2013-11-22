<?php
//BindEvents Method @1-9B37A6CC
function BindEvents()
{
    global $updateStatus;
    $updateStatus->CCSEvents["BeforeShow"] = "updateStatus_BeforeShow";
}
//End BindEvents Method

//updateStatus_BeforeShow @2-DEFEFE2E
function updateStatus_BeforeShow(& $sender)
{
    $updateStatus_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $updateStatus; //Compatibility
//End updateStatus_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

 // -------------------------
     // Write your own code here.
  $conn = new clsDBmysql_cams();
   $query = "UPDATE mfi_docs SET mfi_doc_status = 'TAGGING', mfi_doc_updatedon = NOW()  WHERE mfi_doc_id =".CCGetParam(mfi_doc_id)." ;";
   $result = $conn->query($query);
   if ($result){
  	$Container->updateStatus->SetValue('SUCCESS');
   }else{
  	$Container->updateStatus->SetValue('FAILED');
   }
   $query = "UPDATE mfi_docs SET mfi_doc_status = 'UNTAGGED', mfi_doc_updatedon = NOW()  WHERE mfi_doc_updatedon < DATE_SUB(NOW(),INTERVAL 4 MINUTE) AND mfi_doc_status = 'TAGGING' AND isnull(mfi_doc_tagged_at)";
   $result = $conn->query($query);
 // -------------------------


//Close updateStatus_BeforeShow @2-BF3D66B5
    return $updateStatus_BeforeShow;
}
//End Close updateStatus_BeforeShow


?>