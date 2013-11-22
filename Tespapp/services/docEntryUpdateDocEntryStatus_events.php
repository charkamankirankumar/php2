<?php
//BindEvents Method @1-EE6BA374
function BindEvents()
{
    global $mfi_doc_id;
    $mfi_doc_id->CCSEvents["BeforeShow"] = "mfi_doc_id_BeforeShow";
}
//End BindEvents Method

//mfi_doc_id_BeforeShow @3-0504D59D
function mfi_doc_id_BeforeShow(& $sender)
{
    $mfi_doc_id_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_doc_id; //Compatibility
//End mfi_doc_id_BeforeShow
 $conn = new clsDBmysql_cams_v2();
    $query = "UPDATE mfi_docs set mfi_doc_status = 'DATA ENTRY',mfi_doc_updatedon = NOW()  WHERE mfi_doc_id =".$_POST[mfi_doc_id];
   $result = $conn->query($query);
   if ($result){
  	$Container->mfi_doc_id->SetValue('SUCCESS');
   }else{
  	$Container->mfi_doc_id->SetValue('FAILED');
   }
   $query = "UPDATE mfi_docs SET mfi_doc_status = 'NUMBERED', mfi_doc_updatedon = NOW()  WHERE mfi_doc_updatedon < DATE_SUB(NOW(),INTERVAL 5 MINUTE) AND mfi_doc_status = 'DATA ENTRY' AND isnull(mfi_doc_entered_at)";
   $result = $conn->query($query);
//Custom Code @4-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_doc_id_BeforeShow @3-7363DFFF
    return $mfi_doc_id_BeforeShow;
}
//End Close mfi_doc_id_BeforeShow


?>
