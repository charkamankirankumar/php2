<?php
//BindEvents Method @1-77C683D2
function BindEvents()
{
    global $mfi_fileupload1;
    global $mfi_fileuploadSearch;
    global $CCSEvents;
    $mfi_fileupload1->State_Division->ds->CCSEvents["BeforeBuildSelect"] = "mfi_fileupload1_State_Division_ds_BeforeBuildSelect";
    $mfi_fileupload1->Region->CCSEvents["BeforeShow"] = "mfi_fileupload1_Region_BeforeShow";
    $mfi_fileupload1->mfi_uploaded_by->CCSEvents["BeforeShow"] = "mfi_fileupload1_mfi_uploaded_by_BeforeShow";
    $mfi_fileupload1->ListBox7->CCSEvents["BeforeShow"] = "mfi_fileupload1_ListBox7_BeforeShow";
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

//Page_BeforeInitialize @1-7BB8D4E8
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $manageFileUpload_tmp; //Compatibility
//End Page_BeforeInitialize
 //$mfi_fileupload->Visible=false;
 //Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
