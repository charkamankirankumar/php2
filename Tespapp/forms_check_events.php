<?php
//BindEvents Method @1-1F04C896
function BindEvents()
{
    global $mfi_doc_upload;
    $mfi_doc_upload->Button_Update->CCSEvents["OnClick"] = "mfi_doc_upload_Button_Update_OnClick";
    $mfi_doc_upload->qc_done_by->CCSEvents["BeforeShow"] = "mfi_doc_upload_qc_done_by_BeforeShow";
    $mfi_doc_upload->qc_done_at->CCSEvents["BeforeShow"] = "mfi_doc_upload_qc_done_at_BeforeShow";
}
//End BindEvents Method

//mfi_doc_upload_Button_Update_OnClick @4-C3289F79
function mfi_doc_upload_Button_Update_OnClick(& $sender)
{
    $mfi_doc_upload_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_doc_upload; //Compatibility
//End mfi_doc_upload_Button_Update_OnClick

//Custom Code @44-2A29BDB7
// -------------------------
    $form_status=$mfi_doc_upload->qc_check_result->GetValue();
    $fol="";
    if($form_status=="ERROR")
    	$fol="error-form";
    else if($form_status=="SUCCESS")
    	$fol="pre-forms-inbox";
   	$reg=$mfi_doc_upload->region->GetValue();
    switch($reg)
        {
                case "CTMNI":
                        $path="RO-KA01-CTMNI";
                        break;
                case "HSKTE":
                        $path="RO-KA01-HSKTE";
                        break;
        case "KOLAR":
                        $path="RO-KA01-KOLAR";
                        break;
        case "MLBGL":
                        $path="RO-KA01-MLBGL";
                        break;
        case "DBLPR":
                        $path="RO-KA02-DBLPR";
                        break;
        case "GWBNR":
                        $path="RO-KA02-GWBNR";
                        break;
        case "VJPUR":
                        $path="RO-KA02-VJPUR";
                        break;
        case "GADAG":
                        $path="RO-KA03-GADAG";
                        break;
        case "AMBUR":
                        $path="RO-TN01-AMBUR";
                        break;
        case "KTPDI":
                        $path="RO-TN01-KTPDI";
                        break;
        case "RNIPT":
                        $path="RO-TN01-RNIPT";
                        break;
        case "TVMLA":
                        $path="RO-TN01-TVMLA";
                        break;
        case "VLLOR":
                        $path="RO-TN01-VLLOR";
                        break;
        case "ARANI":
                        $path="RO-TN02-ARANI";
                        break;
        case "CHNPT":
                        $path="RO-TN02-CHNPT";
                        break;
        case "KNCHI":
                        $path="RO-TN02-KNCHI";
                        break;
        case "TRTNI":
                        $path="RO-TN02-TRTNI";
                        break;
        case "HOSUR":
                        $path="RO-TN03-HOSUR";
                        break;
        case "KGIRI":
                        $path="RO-TN03-KGIRI";
                        break;
        case "UTNGA":
                        $path="RO-TN03-UTNGA";
                        break;
        case "VMBDI":
                        $path="RO-TN03-VMBDI";
                        break;
        case "COIMB":
                        $path="RO-TN04-COIMB";
                        break;
        case "TNJVR":
                        $path="RO-TN04-TNJVR";
                        break;
        }
        $totpath="D:/wamp/www/cams_ffsl_v2/".$fol."/".$path."/".$mfi_doc_upload->file_name->GetValue();
        $oldpath="D:/wamp/www/cams_ffsl_v2/UploadedImages/".$path."/".$mfi_doc_upload->file_name->GetValue();
        
        if(!rename($oldpath,$totpath))
        {
        	//exit($reg);
        	exit("unable to move from ".$oldpath." to ".$totpath);
        }
// -------------------------
//End Custom Code

//Close mfi_doc_upload_Button_Update_OnClick @4-2A059EAF
    return $mfi_doc_upload_Button_Update_OnClick;
}
//End Close mfi_doc_upload_Button_Update_OnClick

//mfi_doc_upload_qc_done_by_BeforeShow @38-576D9962
function mfi_doc_upload_qc_done_by_BeforeShow(& $sender)
{
    $mfi_doc_upload_qc_done_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_doc_upload; //Compatibility
//End mfi_doc_upload_qc_done_by_BeforeShow

//Custom Code @43-2A29BDB7
// -------------------------
    $mfi_doc_upload->qc_done_by->SetValue(CCGetUserLogin());
// -------------------------
//End Custom Code

//Close mfi_doc_upload_qc_done_by_BeforeShow @38-6F119C78
    return $mfi_doc_upload_qc_done_by_BeforeShow;
}
//End Close mfi_doc_upload_qc_done_by_BeforeShow

//mfi_doc_upload_qc_done_at_BeforeShow @39-A31A54AE
function mfi_doc_upload_qc_done_at_BeforeShow(& $sender)
{
    $mfi_doc_upload_qc_done_at_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_doc_upload; //Compatibility
//End mfi_doc_upload_qc_done_at_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
	
   
   date_default_timezone_set ( 'Asia/Kolkata');
    $dat=date("Y-m-d H:i:s");
   $mfi_doc_upload->qc_done_at->SetValue($dat);
// -------------------------
//End Custom Code

//Close mfi_doc_upload_qc_done_at_BeforeShow @39-C996865A
    return $mfi_doc_upload_qc_done_at_BeforeShow;
}
//End Close mfi_doc_upload_qc_done_at_BeforeShow


?>
