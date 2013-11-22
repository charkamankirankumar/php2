<?php
//BindEvents Method @1-C9606C2B
function BindEvents()
{
    global $mfi_tc_individualcheck;
    global $gac;
    global $udgapnl;
    global $Gpbtn;
    global $gpudpnl;
    global $mfi_hvf1_mfi_hvf2_mfi_hvf;
    global $CCSEvents;
    $mfi_tc_individualcheck->mfi_region_name->CCSEvents["BeforeShow"] = "mfi_tc_individualcheck_mfi_region_name_BeforeShow";
    $mfi_tc_individualcheck->mfi_center_name->CCSEvents["BeforeShow"] = "mfi_tc_individualcheck_mfi_center_name_BeforeShow";
    $mfi_tc_individualcheck->mfi_group_name->CCSEvents["BeforeShow"] = "mfi_tc_individualcheck_mfi_group_name_BeforeShow";
    $mfi_tc_individualcheck->called_by->CCSEvents["BeforeShow"] = "mfi_tc_individualcheck_called_by_BeforeShow";
    $mfi_tc_individualcheck->Hidden3->CCSEvents["BeforeShow"] = "mfi_tc_individualcheck_Hidden3_BeforeShow";
    $gac->Hidden1->CCSEvents["BeforeShow"] = "gac_Hidden1_BeforeShow";
    $udgapnl->CCSEvents["BeforeShow"] = "udgapnl_BeforeShow";
    $Gpbtn->Button1->CCSEvents["OnClick"] = "Gpbtn_Button1_OnClick";
    $Gpbtn->TextBox1->CCSEvents["BeforeShow"] = "Gpbtn_TextBox1_BeforeShow";
    $gpudpnl->CCSEvents["BeforeShow"] = "gpudpnl_BeforeShow";
    $mfi_hvf1_mfi_hvf2_mfi_hvf->TextBox1->CCSEvents["BeforeShow"] = "mfi_hvf1_mfi_hvf2_mfi_hvf_TextBox1_BeforeShow";
    $mfi_hvf1_mfi_hvf2_mfi_hvf->CCSEvents["BeforeShow"] = "mfi_hvf1_mfi_hvf2_mfi_hvf_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//mfi_tc_individualcheck_mfi_region_name_BeforeShow @114-E03ECB43
function mfi_tc_individualcheck_mfi_region_name_BeforeShow(& $sender)
{
    $mfi_tc_individualcheck_mfi_region_name_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_individualcheck; //Compatibility
//End mfi_tc_individualcheck_mfi_region_name_BeforeShow

//Custom Code @147-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	//$Container->mfi_region_name->SetValue($_GET["reg_name"]);
  // -------------------------


//Close mfi_tc_individualcheck_mfi_region_name_BeforeShow @114-6CF722C6
    return $mfi_tc_individualcheck_mfi_region_name_BeforeShow;
}
//End Close mfi_tc_individualcheck_mfi_region_name_BeforeShow

//mfi_tc_individualcheck_mfi_center_name_BeforeShow @115-B3FC6F57
function mfi_tc_individualcheck_mfi_center_name_BeforeShow(& $sender)
{
    $mfi_tc_individualcheck_mfi_center_name_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_individualcheck; //Compatibility
//End mfi_tc_individualcheck_mfi_center_name_BeforeShow

//Custom Code @148-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	//$Container->mfi_center_name->SetValue($_GET["cent"]);
  // -------------------------


//Close mfi_tc_individualcheck_mfi_center_name_BeforeShow @115-7B796DF0
    return $mfi_tc_individualcheck_mfi_center_name_BeforeShow;
}
//End Close mfi_tc_individualcheck_mfi_center_name_BeforeShow

//mfi_tc_individualcheck_mfi_group_name_BeforeShow @116-D21B31C3
function mfi_tc_individualcheck_mfi_group_name_BeforeShow(& $sender)
{
    $mfi_tc_individualcheck_mfi_group_name_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_individualcheck; //Compatibility
//End mfi_tc_individualcheck_mfi_group_name_BeforeShow

//Custom Code @149-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	//$Container->mfi_group_name->SetValue($_GET["gp_id"]);
  // -------------------------


//Close mfi_tc_individualcheck_mfi_group_name_BeforeShow @116-7EF207CB
    return $mfi_tc_individualcheck_mfi_group_name_BeforeShow;
}
//End Close mfi_tc_individualcheck_mfi_group_name_BeforeShow

//mfi_tc_individualcheck_called_by_BeforeShow @117-6C67ACAF
function mfi_tc_individualcheck_called_by_BeforeShow(& $sender)
{
    $mfi_tc_individualcheck_called_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_individualcheck; //Compatibility
//End mfi_tc_individualcheck_called_by_BeforeShow

//Custom Code @132-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Container->called_by->SetValue(CCGetUserLogin());
  // -------------------------


//Close mfi_tc_individualcheck_called_by_BeforeShow @117-75769CD2
    return $mfi_tc_individualcheck_called_by_BeforeShow;
}
//End Close mfi_tc_individualcheck_called_by_BeforeShow

//mfi_tc_individualcheck_Hidden3_BeforeShow @170-58769D62
function mfi_tc_individualcheck_Hidden3_BeforeShow(& $sender)
{
    $mfi_tc_individualcheck_Hidden3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_tc_individualcheck; //Compatibility
//End mfi_tc_individualcheck_Hidden3_BeforeShow

//Custom Code @171-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	//$Container->Hidden3->SetValue($_GET["gp_name"]);
  // -------------------------


//Close mfi_tc_individualcheck_Hidden3_BeforeShow @170-E0526E23
    return $mfi_tc_individualcheck_Hidden3_BeforeShow;
}
//End Close mfi_tc_individualcheck_Hidden3_BeforeShow

//gac_Hidden1_BeforeShow @159-4095F528
function gac_Hidden1_BeforeShow(& $sender)
{
    $gac_Hidden1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $gac; //Compatibility
//End gac_Hidden1_BeforeShow

//Custom Code @160-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	//$Container->Hidden1->SetValue($_GET["gp_id"]);
  // -------------------------


//Close gac_Hidden1_BeforeShow @159-09D432F1
    return $gac_Hidden1_BeforeShow;
}
//End Close gac_Hidden1_BeforeShow

//udgapnl_BeforeShow @150-19535784
function udgapnl_BeforeShow(& $sender)
{
    $udgapnl_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $udgapnl; //Compatibility
//End udgapnl_BeforeShow

//udgapnlUpdatePanel Page BeforeShow @151-6A2D77F5
    global $CCSFormFilter;
    if ($CCSFormFilter == "udgapnl") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"udgapnl\">";
        $Component->BlockSuffix = "</div>";
    }
//End udgapnlUpdatePanel Page BeforeShow

//Close udgapnl_BeforeShow @150-FBFDF08B
    return $udgapnl_BeforeShow;
}
//End Close udgapnl_BeforeShow

//Gpbtn_Button1_OnClick @157-0E412456
function Gpbtn_Button1_OnClick(& $sender)
{
    $Gpbtn_Button1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Gpbtn; //Compatibility
//End Gpbtn_Button1_OnClick

//Custom Code @167-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  /*	$gp=$Container->TextBox1->GetValue();
  	$un=CCGetUserLogin();
  	$db = new clsDBmysql_cams();
      $result1 = $db->query("update mfi_gp set mfi_telecall_status='TC Done',tc_done_by='$un' where gp_id='$gp'",$db);*/
  
  // -------------------------


//Close Gpbtn_Button1_OnClick @157-7F87AA13
    return $Gpbtn_Button1_OnClick;
}
//End Close Gpbtn_Button1_OnClick

//Gpbtn_TextBox1_BeforeShow @172-4277651C
function Gpbtn_TextBox1_BeforeShow(& $sender)
{
    $Gpbtn_TextBox1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Gpbtn; //Compatibility
//End Gpbtn_TextBox1_BeforeShow

//Custom Code @173-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  //	$Container->TextBox1->SetValue($_GET["gp_id"]);
  // -------------------------


//Close Gpbtn_TextBox1_BeforeShow @172-F84ABF30
    return $Gpbtn_TextBox1_BeforeShow;
}
//End Close Gpbtn_TextBox1_BeforeShow

//gpudpnl_BeforeShow @154-ED83B418
function gpudpnl_BeforeShow(& $sender)
{
    $gpudpnl_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $gpudpnl; //Compatibility
//End gpudpnl_BeforeShow

//gpudpnlUpdatePanel Page BeforeShow @155-3CE9EB02
    global $CCSFormFilter;
    if ($CCSFormFilter == "gpudpnl") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"gpudpnl\">";
        $Component->BlockSuffix = "</div>";
    }
//End gpudpnlUpdatePanel Page BeforeShow

//Close gpudpnl_BeforeShow @154-F406C0DD
    return $gpudpnl_BeforeShow;
}
//End Close gpudpnl_BeforeShow

//mfi_hvf1_mfi_hvf2_mfi_hvf_TextBox1_BeforeShow @62-931788D3
function mfi_hvf1_mfi_hvf2_mfi_hvf_TextBox1_BeforeShow(& $sender)
{
    $mfi_hvf1_mfi_hvf2_mfi_hvf_TextBox1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf1_mfi_hvf2_mfi_hvf; //Compatibility
//End mfi_hvf1_mfi_hvf2_mfi_hvf_TextBox1_BeforeShow

//Custom Code @123-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
      $hv=$Container->TextBox2->GetValue();
   $db = new clsDBmysql_cams_v2();
   $query = "select mfi_telecaller_status as mts from mfi_hvf1 where la_id='$hv'";
   $result1 = $db->query($query);
   $db->next_record();
     $re11 =$db->f("mts");
  	   //$ic=	$re11;
  	   if($re11!="SANCTIONED")
  	   {
  	   if($re11!="IA Check")
  	   {
  	   if($re11=="REJECTED")
  	   {
  	   $Container->TextBox1->SetValue("");
  		echo "<script language='javascript'> alert('This Borrower is Rejected');</script>";
  	   }
  		else
  	   {
     	   $query = "select mfi_tc_call_attempt as mta from mfi_tc_individualcheck where la_id='$hv' order by mfi_tc_call_attempt desc limit 1";
  	   $result= $db->query($query);
  	   $db->next_record();
  	   $re=$db->f("mta");
  	   $re1=substr($re,0,1);
  	   switch($re1)
  	   {
  	    case "":$Container->TextBox1->SetValue("1st");
  				break;
  	   case 1:$Container->TextBox1->SetValue("2nd");
  	   		  break;
  	   case 2:$Container->TextBox1->SetValue("3rd");
  	   		  break;
  	   case 3:$Container->TextBox1->SetValue("4th");
  	   		  break;
  		case 4:$Container->TextBox1->SetValue("5th");
  	   		  break;
  		case 5:$Container->TextBox1->SetValue("6th");
  	   		  break;
  		case 6:$Container->TextBox1->SetValue("7th");
  	   		  break;
  		case 7:$Container->TextBox1->SetValue("8th");
  	   		  break;
  		case 8:$Container->TextBox1->SetValue("9th");
  	   		  break;
  		case 9:$Container->TextBox1->SetValue("10th");
  	   		  break;
  		default:$Container->TextBox1->SetValue("10+");
  	   		  break;
  	  }
  	  }
  
    }
    else
    echo "<script language='javascript'> alert('This Borrower is IA Check');</script>";
  	}
  
  		else
  		echo "<script language='javascript'> alert('This Borrower is Sanctioned".$re11."');</script>";
  
  // -------------------------


//Close mfi_hvf1_mfi_hvf2_mfi_hvf_TextBox1_BeforeShow @62-7AAB163B
    return $mfi_hvf1_mfi_hvf2_mfi_hvf_TextBox1_BeforeShow;
}
//End Close mfi_hvf1_mfi_hvf2_mfi_hvf_TextBox1_BeforeShow

//mfi_hvf1_mfi_hvf2_mfi_hvf_BeforeShow @2-077D48ED
function mfi_hvf1_mfi_hvf2_mfi_hvf_BeforeShow(& $sender)
{
    $mfi_hvf1_mfi_hvf2_mfi_hvf_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_hvf1_mfi_hvf2_mfi_hvf; //Compatibility
//End mfi_hvf1_mfi_hvf2_mfi_hvf_BeforeShow

//Custom Code @184-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_hvf1_mfi_hvf2_mfi_hvf_BeforeShow @2-5F37E1AA
    return $mfi_hvf1_mfi_hvf2_mfi_hvf_BeforeShow;
}
//End Close mfi_hvf1_mfi_hvf2_mfi_hvf_BeforeShow

  // -------------------------
      // Write your own code here.
  // -------------------------

//Page_BeforeInitialize @1-0050A342
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $TeleCalling1; //Compatibility
//End Page_BeforeInitialize

//udgapnlUpdatePanel PageBeforeInitialize @151-6856C0DC
    if (CCGetFromGet("FormFilter") == "udgapnl" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $CCSLocales, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $CCSLocales->GetFormatInfo("PHPEncoding"));
        $CCSIsParamsEncoded = true;
    }
//End udgapnlUpdatePanel PageBeforeInitialize

//gpudpnlUpdatePanel PageBeforeInitialize @155-3A600969
    if (CCGetFromGet("FormFilter") == "gpudpnl" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $CCSLocales, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $CCSLocales->GetFormatInfo("PHPEncoding"));
        $CCSIsParamsEncoded = true;
    }
//End gpudpnlUpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-012E5795
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $TeleCalling1; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-0A7B1754
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $TeleCalling1; //Compatibility
//End Page_BeforeShow

//udgapnlUpdatePanel Page BeforeShow @151-39E46DCF
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "udgapnl") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End udgapnlUpdatePanel Page BeforeShow

//gpudpnlUpdatePanel Page BeforeShow @155-28D84DA0
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "gpudpnl") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End gpudpnlUpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-F19CEFC7
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $TeleCalling1; //Compatibility
//End Page_BeforeOutput

//udgapnlUpdatePanel PageBeforeOutput @151-16CC8F4E
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "udgapnl") {
        $main_block = $_SERVER["REQUEST_URI"] . "|" . $Tpl->getvar("/Panel udgapnl");
    }
//End udgapnlUpdatePanel PageBeforeOutput

//gpudpnlUpdatePanel PageBeforeOutput @155-92F73294
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "gpudpnl") {
        $main_block = $_SERVER["REQUEST_URI"] . "|" . $Tpl->getvar("/Panel gpudpnl");
    }
//End gpudpnlUpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-E4E21669
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $TeleCalling1; //Compatibility
//End Page_BeforeUnload

//udgapnlUpdatePanel PageBeforeUnload @151-2E94AF6D
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "udgapnl") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End udgapnlUpdatePanel PageBeforeUnload

//gpudpnlUpdatePanel PageBeforeUnload @155-6CDF57D5
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "gpudpnl") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End gpudpnlUpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload


?>
