<?php
define("RelativePath", ".");
define("PathToCurrentPage", "/");
include_once(RelativePath . "/Common.php");
$db = new clsDBmysql_cams_v2();
$rgndir='RO-'.substr($_POST["udirect"],3,10);
$uploads_dir  = "UploadedImages/".$rgndir."/";
$gpname=$_POST["gpname"];
$gpcode=$_POST["gpcode"];
$gpsize=$_POST["gpsize"];
$extn=$_POST["ext"];
$str=array();
 //$str="COUNT IN SERVER".count($_FILES);
 if($_POST["filetyp"]=="new")
 {
		 $i=1;
		 date_default_timezone_set ( 'Asia/Kolkata');
		 $batch=date('YmdHis');
		 foreach($_FILES as $file)
		 {
		 		if(($gpname!=null||$gpname!='')&&($gpsize!=null||$gpsize!=''))
				{
				$qry="select concat((substr(year(now()),3,2)),right(concat('0000',max(gp_code)+1), 5)) from mfi_doc_upload where gp_code like '13%'";
										$res = $db->query($qry);
										$row = mysql_fetch_row($res);

					$fln=$row[0]."_".$batch."_".$extn."_".substr($file["name"],0,strripos($file["name"],"."));
		 			 if(move_uploaded_file($file["tmp_name"],$uploads_dir.$fln.".pdf"))
					 {

				  				 $SQL="insert into mfi_doc_upload(batch_code,region,file_uploaded,uploaded_by,gp_code,file_type,cp_id,cp_name,gp_name,gp_size)values('".$batch."','".$_POST["udirect"]."','".$fln."','".$_POST["updby"]."','".$row[0]."','".$_POST["filetyp"]."','".$_POST["cpid"]."','".$_POST["cpname"]."','".$gpname."','".$gpsize."')";
								 $Result = $db->query($SQL);
				   				 if ($Result)
								 {
				   				$str[0]="<font size=4 color='red'>".$batch."</font>.Please Note this Batch For Future Reference";
								$str[1]=$file["name"]."Uploaded Successfully.GP CODE<font size=3 color='blue'>".$row[0]."</font>";
								 }
								 else
								 {
								  $str[0]=$SQL;
								  $str[1]=$file["name"]."File Already Exists.";
								 }
					 }
					 else
					 {
					   $str[0]="Error";
					   $str[1]="Reupload ".$file["name"]." Error In Uploading";
					 }
				}

		 }
$retarr=json_encode($str);
echo $retarr;
 }
 elseif($_POST["filetyp"]=="cp")
 {
 	foreach($_FILES as $file)
	{
		 $fln="CP_".substr($file["name"],0,strripos($file["name"],"."));
		if(move_uploaded_file($file["tmp_name"],$uploads_dir.$fln.".pdf"))
		 {

			 $SQL="insert into mfi_doc_upload(batch_code,region,file_uploaded,uploaded_by,file_type,cp_id,cp_name)values('".$_POST["batcode"]."','".$_POST["udirect"]."','".$fln."','".$_POST["updby"]."','".$_POST["filetyp"]."','".$_POST["cpid"]."','".$_POST["cpname"]."')";

			 $Result = $db->query($SQL);
			 if ($Result)
			 {
				$str[0]=$file["name"];
				$str[1]="Uploaded Successfully.";
				//echo $file["name"];
			 }
			 else
			 {
				$str[0]=$file["name"];
				$str[1]="error db";
			 }
		 }
		 else
		 {
			$str[0]="file not uploaded";
			$str[1]="upload again";
		 }
	}
$retarr=json_encode($str);
echo $retarr;
 }
elseif($_POST["filetyp"]!="new" && $_POST["filetyp"]!="cp")
 {
 foreach($_FILES as $file)
		 {
 		if(move_uploaded_file($file["tmp_name"],$uploads_dir.$file["name"]))
					 {
					   		     $fln=$gpcode."_".substr($file["name"],0,strripos($file["name"],"."));
				  				 $SQL="insert into mfi_doc_upload(cp_id,region,file_uploaded,uploaded_by,gp_code,file_type)values('".$_POST["batcode"]."','".$_POST["udirect"]."','".$fln."','".$_POST["updby"]."','".$gpcode."','".$_POST["filetyp"]."')";
								 //echo $SQL;
								 $Result = $db->query($SQL);
				   				 if ($Result)
								 {
				   				$str[0]=$file["name"]."Uploaded Successfully.";
								 }
								 else
								 {

								   $str[0]="Reupload ".$file["name"]." Error In Uploading";
								 }

 					}
		 }
$retarr=json_encode($str);
echo $retarr;
}
?>