<?php
define("RelativePath", ".");
		   define("PathToCurrentPage", "/");
		   include_once(RelativePath . "/Common.php");
$db = new clsDBmysql_cams_v2();
	function CapSplit($str)
		{
			$string = trim($str);

						$count = strlen($string);

						$i = 0;
						$ii = 0;

						$strings=preg_split("/[\s,]+/", $string);
								if(count($strings)==1)
								{
										$newstr[0]=trim($strings[0]);
										$newstr[1]="-";
										$newstr[2]="-";
								}
								if(count($strings)==2)
								{
										$newstr[0]=trim($strings[0]);
										$newstr[1]=trim($strings[1]);
										$newstr[2]="-";
								}
								if(count($strings)==3)
								{
										$newstr[0]=trim($strings[0]);
										$newstr[1]=trim($strings[1]);
										$newstr[2]=trim($strings[2]);
								}
								if(count($strings)==4)
								{
										 $newstr[0]=trim($strings[0]).trim($strings[1]);
										$newstr[1]=trim($strings[2]);
										$newstr[2]=trim($strings[3]);
								}
								if(count($strings)==5)
								{
										$newstr[0]=trim($strings[0]).trim($strings[1]);
										$newstr[1]=trim($strings[2]).trim($strings[3]);
										$newstr[2]=trim($strings[4]);
								}
								if(count($strings)==6)
								{
										$newstr[0]=trim($strings[0]).trim($strings[1]);
										$newstr[1]=trim($strings[2]).trim($strings[3]);
										$newstr[2]=trim($strings[4]).trim($strings[5]);
								}
					return ($newstr);

	}
function SplitAddress($astr)
{
	$addr=explode(",",$astr,3);
	return($addr);

}
				$query="SELECT LA_NO,REGION,BORROWER_NAME,FATHER_NAME,GUARANTOR_NAME,'INDIAN','Mrs.','F','Married',BORROWER_DOB,
  'Others',CURRENT_ADDRESS,AREA,AREA,STATE,PIN_CODE,MOBILE_NO,BORROWER_KYC_TYPE,BORROWER_KYC_ID,'','',LA_NO,'2013-06-18' from camsdata123_grid
  WHERE GP_NO='".$_GET['gp_no']."'";
  $db1=mysql_connect("localhost","root","");
   mysql_select_db("cams_ffsl_v2", $db1);
			$result=mysql_query($query,$db1);

			while($row = mysql_fetch_array($result))
				{
				   //Remove any excess whitespace from start and end of the row:
				    $nmstr=$row{2};
  				    $bfullnm=CapSplit(" ".$nmstr." ");
  				       $bfn=$bfullnm[0];
					   $bmn=$bfullnm[1];
					   $bln=$bfullnm[2];
					$nmstr=$row{3};
                   	$ffullnm=CapSplit(" ".$nmstr." ");
					   $ffn=$ffullnm[0];
					   $fmn=$ffullnm[1];
					   $fln=$ffullnm[2];
				   $nmstr=$row{4};
				   $nfullnm=CapSplit(" ".$nmstr." ");
					   $nfn=$nfullnm[0];
					   $nmn=$nfullnm[1];
					   $nln=$nfullnm[2];
				  $fuladdr=SplitAddress($row[11]);
				   if(count($fuladdr)==1)
                   {
					$dno=$fuladdr[0];
					$vil=$fuladdr[0];
				   }
				   elseif(count($fuladdr)==2)
				   {
					$dno=$fuladdr[0];
					$vil=$fuladdr[1];
				   }
				  elseif(count($fuladdr)==3)
				  {
					$dno=$fuladdr[0].$fuladdr[1];
					$vil=$fuladdr[2];
					}
				  elseif(count($fuladdr)==4)
				  {
				  	$dno=$fuladdr[0].$fuladdr[1];
					$vil=$fuladdr[2].$fuladdr[3];
					}
	$nlcc=$row[2];
				   if($z!=0)
				   $str.=",";
				   $str.="('".$row[21]."','".$row[1]."','".$bfn."','".$bmn."','".$bln."','".$row[9]."','".$ffn."','".$fmn."','".$fln."','".$row[16].
				   "','".$dno."','".$vil."','".$row[12]."','".$row[13]."','".$row[14]."','INDIA','".$row[15]."','".$nfn."','".$nmn."','".$nln.
				  "','HUSBAND','100%','".$row[23]."','IFMR Rural Finance Services Pvt. Ltd.','8002562','".$row[1]."','".$nlcc."','SWAVALAMBAN','1000','FEMALE','MARRIED','".$_GET['updby']."')";
				$z++;
		  	}

 			$db->query("start transaction;");

 			$query="insert into nps_master(lano,branch,	first_name,	middle_name,last_name,dob,father_namef,	father_mname,father_namel,	mob_no,	dno,	village,	taluk,	district,	state,	country,	pincode,	nominee_namef,	nominee_namem,	nominee_namel,	relation,	percentage_share,	disbursement_date,	aggregator,	agg_regn_no,	place,	nlcc_regn_no,	scheme,	amount,	gender,	marital_status,uploaded_by) values".$str;
echo $query;
			$result=$db->query($query,$db);
if($result)
{
$db->query("commit;");
}
else
{
//echo "Wrong Fomat/Invalid Data/Duplicate ID Please check ";
echo mysql_error($db);
$db->query("rollback;");
}

	?>