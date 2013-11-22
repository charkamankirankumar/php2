<?php
//BindEvents Method @1-6690ADDB
function BindEvents()
{
    global $mfi_fileupload1;
    global $mfi_fileuploadSearch;
    global $CCSEvents;
    $mfi_fileupload1->State_Division->ds->CCSEvents["BeforeBuildSelect"] = "mfi_fileupload1_State_Division_ds_BeforeBuildSelect";
    $mfi_fileupload1->Region->CCSEvents["BeforeShow"] = "mfi_fileupload1_Region_BeforeShow";
    $mfi_fileupload1->mfi_uploaded_by->CCSEvents["BeforeShow"] = "mfi_fileupload1_mfi_uploaded_by_BeforeShow";
    $mfi_fileupload1->ListBox7->CCSEvents["BeforeShow"] = "mfi_fileupload1_ListBox7_BeforeShow";
    $mfi_fileupload1->cp_id->CCSEvents["BeforeShow"] = "mfi_fileupload1_cp_id_BeforeShow";
    $mfi_fileupload1->ds->CCSEvents["BeforeExecuteInsert"] = "mfi_fileupload1_ds_BeforeExecuteInsert";
    $mfi_fileuploadSearch->CCSEvents["BeforeShow"] = "mfi_fileuploadSearch_BeforeShow";
}
//End BindEvents Method

//mfi_fileupload1_State_Division_ds_BeforeBuildSelect @4-4929B0FE
function mfi_fileupload1_State_Division_ds_BeforeBuildSelect(& $sender)
{
    $mfi_fileupload1_State_Division_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_fileupload1; //Compatibility
//End mfi_fileupload1_State_Division_ds_BeforeBuildSelect

$db = new clsDBmysql_cams_v2();
	$SQL = "SELECT mfi_emp_user_type FROM mfi_emps WHERE mfi_emp_user_name='".CCGetUserLogin()."'";
    $db->query($SQL);
    $Result = $db->next_record();
    if ($Result) {
	  $uname=strtoupper(CCGetUserLogin());
      $usertype = strtoupper($db->f("mfi_emp_user_type"));
    }
		switch($usertype)
		{
			case "ADMIN":
			$str="SELECT mfi_unit_code FROM `mfi_unit_divisions` WHERE mfi_unit_code LIKE 'DV-%' group by mfi_unit_code order by mfi_unit_code";
			$mfi_fileupload1->State_Division->DataSource->SQL=$str;
			break;
		    /*case "STATE HEAD":$region=substr($uname,-2);
			$str="SELECT mfi_unit_code FROM `mfi_unit_divisions` WHERE mfi_unit_cluster_code LIKE '".$region."%' group by mfi_unit_code order by mfi_unit_code";
			$mfi_fileupload1->State_Division->DataSource->SQL=$str;
			break;
			case "CLUSTER MANAGER":$region=substr($uname,-4);
			$str="SELECT mfi_unit_code FROM `mfi_unit_divisions` WHERE mfi_unit_cluster_code LIKE '".$region."%' group by mfi_unit_code order by mfi_unit_code";
			$mfi_fileupload1->State_Division->DataSource->SQL=$str;
			break;
			case "DIVISIONAL MANAGER":$region=substr($uname,-4);
			$str="SELECT mfi_unit_code FROM `mfi_unit_divisions` WHERE mfi_unit_code LIKE 'DV-".$region."%' group by mfi_unit_code order by mfi_unit_code";
			$mfi_fileupload1->State_Division->DataSource->SQL="";
			break;
			case "REGIONAL MANAGER":$region=substr($uname,-10);
			$str="SELECT mfi_unit_code FROM `mfi_unit_regions` WHERE mfi_unit_code LIKE 'RO-".$region."%' group by mfi_unit_code order by mfi_unit_code";
			//$mfi_fileupload1->mfi_territorycode->SetValue("RO-".$region);
			$mfi_fileupload1->State_Division->DataSource->SQL="";
			$mfi_fileupload1->Region->DataSource->SQL="";
			break;
			case "BRANCH MANAGER":$region=substr($uname,4,9);
			$str="SELECT mfi_unit_code FROM `mfi_unit_regions` WHERE mfi_unit_code LIKE 'RO-".$region."%' group by mfi_unit_code order by mfi_unit_code";
			//$mfi_fileupload1->mfi_territorycode->SetValue("RO-".$region);
			$mfi_fileupload1->State_Division->DataSource->SQL="";
			$mfi_fileupload1->Region->DataSource->SQL="";
			break;*/
			case "DATA ENTRY OPERATOR":$region=substr($uname,3);
			$str="SELECT mfi_unit_code FROM `mfi_unit_regions` WHERE mfi_unit_code LIKE '%".$region."%' group by mfi_unit_code order by mfi_unit_code";
		
			$mfi_fileupload1->State_Division->DataSource->SQL="";
			$mfi_fileupload1->Region->DataSource->SQL="";
			$db->query($str);
   			$Result = $db->next_record();
    		if ($Result)
				 {
				 	$rgn=strtoupper($db->f("mfi_unit_code"));
	  				$mfi_fileupload1->Label6->SetValue($rgn);
					$str="SELECT mfi_unit_code FROM `mfi_unit_branches` WHERE mfi_unit_region_code LIKE '".$rgn."' group by mfi_unit_code order by mfi_unit_code";
					$mfi_fileupload1->branch->DataSource->SQL=$str;
					//$mfi_fileupload1->branch->DataSource->SQL=$str;
					//$mfi_fileupload1->mfi_territorycode->SetValue(strtoupper($db->f("mfi_unit_code")));
   				 }
			break;
			case "CREDIT ANALYST":$region=substr($uname,3);
			$str="SELECT mfi_unit_code FROM `mfi_unit_regions` WHERE mfi_unit_code LIKE 'RO-".$region."%' group by mfi_unit_code order by mfi_unit_code";
			$mfi_fileupload1->State_Division->DataSource->SQL="";
			$mfi_fileupload1->Region->DataSource->SQL="";
			$db->query($str);
   			$Result = $db->next_record();
    		if ($Result)
				 {
				 	$rgn=strtoupper($db->f("mfi_unit_code"));
	  				$mfi_fileupload1->Label6->SetValue($rgn);
					
				//$mfi_fileupload1->mfi_territorycode->SetValue(strtoupper($db->f("mfi_unit_code")));
   				 }
			break;
		}
	   	
		//$mfi_fileupload1->TextBox1->SetValue($region); 
		$db->close();
		
	//$mfi_fileupload1->TextBox1->SetValue("changed".);

    return $mfi_fileupload1_State_Division_ds_BeforeBuildSelect;
//Custom Code @55-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_fileupload1_State_Division_ds_BeforeBuildSelect @4-97CDBE88
    return $mfi_fileupload1_State_Division_ds_BeforeBuildSelect;
}
//End Close mfi_fileupload1_State_Division_ds_BeforeBuildSelect

//mfi_fileupload1_Region_BeforeShow @5-C85954A2
function mfi_fileupload1_Region_BeforeShow(& $sender)
{
    $mfi_fileupload1_Region_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_fileupload1; //Compatibility
//End mfi_fileupload1_Region_BeforeShow

//Close mfi_fileupload1_Region_BeforeShow @5-B905A119
    return $mfi_fileupload1_Region_BeforeShow;
}
//End Close mfi_fileupload1_Region_BeforeShow

//mfi_fileupload1_mfi_uploaded_by_BeforeShow @48-06018C0A
function mfi_fileupload1_mfi_uploaded_by_BeforeShow(& $sender)
{
    $mfi_fileupload1_mfi_uploaded_by_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_fileupload1; //Compatibility
//End mfi_fileupload1_mfi_uploaded_by_BeforeShow

//Custom Code @49-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$mfi_fileupload1->mfi_uploaded_by->SetValue(CCGetUserLogin());
//Close mfi_fileupload1_mfi_uploaded_by_BeforeShow @48-F4E0C5C6
    return $mfi_fileupload1_mfi_uploaded_by_BeforeShow;
}
//End Close mfi_fileupload1_mfi_uploaded_by_BeforeShow

//mfi_fileupload1_ListBox7_BeforeShow @146-6795C909
function mfi_fileupload1_ListBox7_BeforeShow(& $sender)
{
    $mfi_fileupload1_ListBox7_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_fileupload1; //Compatibility
//End mfi_fileupload1_ListBox7_BeforeShow

//Close mfi_fileupload1_ListBox7_BeforeShow @146-196258F4
    return $mfi_fileupload1_ListBox7_BeforeShow;
}
//End Close mfi_fileupload1_ListBox7_BeforeShow

//mfi_fileupload1_cp_id_BeforeShow @159-0FE3820E
function mfi_fileupload1_cp_id_BeforeShow(& $sender)
{
    $mfi_fileupload1_cp_id_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_fileupload1; //Compatibility
//End mfi_fileupload1_cp_id_BeforeShow

//PTAutocomplete1 BeforeShow @161-1015BE95
    $Component->Attributes->SetValue('id', 'mfi_fileupload1cp_id');
//End PTAutocomplete1 BeforeShow

//Close mfi_fileupload1_cp_id_BeforeShow @159-738B2CA0
    return $mfi_fileupload1_cp_id_BeforeShow;
}
//End Close mfi_fileupload1_cp_id_BeforeShow

//mfi_fileupload1_ds_BeforeExecuteInsert @41-0A1C4357
function mfi_fileupload1_ds_BeforeExecuteInsert(& $sender)
{
    $mfi_fileupload1_ds_BeforeExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_fileupload1; //Compatibility
//End mfi_fileupload1_ds_BeforeExecuteInsert

//Custom Code @68-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close mfi_fileupload1_ds_BeforeExecuteInsert @41-85FC131B
    return $mfi_fileupload1_ds_BeforeExecuteInsert;
}
//End Close mfi_fileupload1_ds_BeforeExecuteInsert

//if((strcmp($Container->mfi_fileuploadSearch->s_mfi_territorycode->GetValue(),""))==0)
//$mfi_fileupload->Visible=false;

//mfi_fileuploadSearch_BeforeShow @16-F9BA7009
function mfi_fileuploadSearch_BeforeShow(& $sender)
{
    $mfi_fileuploadSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mfi_fileuploadSearch; //Compatibility
//End mfi_fileuploadSearch_BeforeShow

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
//Close mfi_fileuploadSearch_BeforeShow @16-F6795E83
    return $mfi_fileuploadSearch_BeforeShow;
}
//End Close mfi_fileuploadSearch_BeforeShow

//Page_BeforeInitialize @1-49067C9D
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $manageFileUpload_old; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill1 Initialization @162-7EBBD25B
    if ('mfi_fileupload1cp_idPTAutoFill1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill1 Initialization

//PTAutoFill1 DataSource @162-009AC5D3
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill1 DataSource

//PTAutoFill1 DataFields @162-5B8F0C04
        $Service->AddDataSourceField('cp_name',ccsText,"");
//End PTAutoFill1 DataFields

//PTAutoFill1 Execution @162-028A6C4C
        echo $Service->Execute();
//End PTAutoFill1 Execution

//PTAutoFill1 Loading @162-27890EF8
        exit;
    }
//End PTAutoFill1 Loading

//PTAutocomplete1 Initialization @161-FCD98788
    global $Charset;
    if ('mfi_fileupload1cp_idPTAutocomplete1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new ListFormatter());
//End PTAutocomplete1 Initialization

//PTAutocomplete1 DataSource @161-5D2AD034
        $Service->DataSource = new clsDBmysql_cams_v2();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM mfi_doc_upload {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Parameters["postcp_id"] = CCGetFromPost("cp_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "postcp_id", ccsText, "", "", $Service->DataSource->Parameters["postcp_id"], -1, false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opBeginsWith, "cp_id", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsText),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutocomplete1 DataSource

//PTAutocomplete1 Charset @161-4F7C968C
        $Service->AddHttpHeader("Content-type", "text/html; charset=" . $Charset);
//End PTAutocomplete1 Charset

//PTAutocomplete1 DataFields @161-A0443435
        $Service->AddDataSourceField('cp_id');
//End PTAutocomplete1 DataFields

//PTAutocomplete1 Execution @161-D749E478
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End PTAutocomplete1 Execution

//PTAutocomplete1 Tail @161-27890EF8
        exit;
    }
//End PTAutocomplete1 Tail

 //$mfi_fileupload->Visible=false;
 //Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
