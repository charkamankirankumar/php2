<?php
//-----------------------------------------------------------------------------------------------------------------------------
// START OF SCRIPT
//-----------------------------------------------------------------------------------------------------------------------------
error_reporting(E_ERROR);

//-----------------------------------------------------------------------------------------------------------------------------
// Maping drive if not exists
//-----------------------------------------------------------------------------------------------------------------------------
while(!is_dir("M:")){
	exec("net use M: \\APP03-CAMS\docsybl System@123 /user:APP03-CAMS\CAMSDOC-MGR /persistent:yes");
}
//-----------------------------------------------------------------------------------------------------------------------------
// Set Base Directory
//-----------------------------------------------------------------------------------------------------------------------------

$input_dir="D:\\wamp\\www\\cams_ffsl_v2\\forms-inbox\\test";
$output_dir="D:\\wamp\\www\\cams_ffsl_v2\\docs\\png\\test";
$web_path="docsybl/login-png/test";



date_default_timezone_set ( 'Asia/Kolkata');
// Establish DB Connection & Set Base Directory
//-----------------------------------------------------------------------------------------------------------------------------
$db = mysql_connect("162.216.4.50","root","System@123");
mysql_select_db("cams_ybl_v2",$db);
//-----------------------------------------------------------------------------------------------------------------------------
$fpSuccessPDF=fopen("g:\\wamp\\www\\camsybl\\logs/".date('YMd')."_SUCCESS-PDF.txt","a+");//FOR WRITING CONVERSION LOG on SUCCESS
$fpSuccessPNG=fopen("g:\\wamp\\www\\camsybl\\logs/".date('YMd')."_SUCCESS-PNG.txt","a+");//FOR WRITING CONVERSION LOG on SUCCESS
$fpFailurePDF=fopen("g:\\wamp\\www\\camsybl\\logs/".date('YMd')."_FAILURE-PDF.txt","a+");//FOR WRITING CONVERSION LOG ON FAILURE
$fpFailurePNG=fopen("g:\\wamp\\www\\camsybl\\logs/".date('YMd')."_FAILURE-PNG.txt","a+");//FOR WRITING CONVERSION LOG ON FAILURE
$fpSuccessCON=fopen("g:\\wamp\\www\\camsybl\\logs/".date('YMd')."_CONVERT-PDF.txt","a+");//FOR WRITING CONVERSION LOG

//-----------------------------------------------------------------------------------------------------------------------------
// Iterator for the Recursive Directory
//-----------------------------------------------------------------------------------------------------------------------------

$iterator = new RecursiveDirectoryIterator($input_dir);
foreach(new RecursiveIteratorIterator($iterator) as $filename => $mainfile_pgsile){
	if(!$mainfile_pgsile->isDir()){

		if(strpos($mainfile_pgsile->getpath()," ") == FALSE){
			$newfilename = str_replace(" ","_",$mainfile_pgsile->getPathname());
			rename($mainfile_pgsile ,$newfilename );
		}

    }
}
$iterator = new RecursiveDirectoryIterator($input_dir);
foreach(new RecursiveIteratorIterator($iterator) as $filename => $mainfile_pgsile){
	if(!$mainfile_pgsile->isDir()){
			$region 		= str_replace("\\","",strrchr(dirname($mainfile_pgsile->getPathname()),"\\"));

     			process_file($mainfile_pgsile,$input_dir,$output_dir,$web_path,$db,$fpSuccessPDF,$fpSuccessPNG,$fpFailurePDF,$fpFailurePNG,$fpSuccessCON);

    }
}

fclose($fpSuccessPDF);
fclose($fpSuccessPNG);
fclose($fpFailurePDF);
fclose($fpFailurePNG);
fclose($fpSuccessCON);

//-----------------------------------------------------------------------------------------------------------------------------
// Close DB Connection
//-----------------------------------------------------------------------------------------------------------------------------
mysql_close($db);

//-----------------------------------------------------------------------------------------------------------------------------
// END OF SCRIPT
//-----------------------------------------------------------------------------------------------------------------------------

//==== FUNCTION FOR COMPRESSION OF PNG USING PHP GD IMAGES ====================================================================
function compress($source, $destination, $quality){
			$info = getimagesize($source);
			if ($info['mime'] == 'image/jpeg')
				$image = imagecreatefromjpeg($source);
			elseif ($info['mime'] == 'image/gif')
				$image = imagecreatefromgif($source);
			elseif ($info['mime'] == 'image/png')
				$image = imagecreatefrompng($source);
			imagejpeg($image, $destination, $quality);
			return $destination;
}
//===============================================================================================================================

//==== FUNCTION FOR PROCESSING PDF FILE ====================================================================
function process_file($mainfile_pgsile,$input_dir,$output_dir,$web_path,$db,$fpSuccessPDF,$fpSuccessPNG,$fpFailurePDF,$fpFailurePNG,$fpSuccessCON){


		$extn = strtolower($mainfile_pgsile->getExtension());
		if($extn =="pdf" || $extn =="tif"  ){
			$out_file_subpath 	= str_replace($input_dir, $output_dir, $mainfile_pgsile->getpath());
			$out_file			= $out_file_subpath."\\".$mainfile_pgsile->getBasename(".".$extn);


				$cmd = "gswin64 -dNOPAUSE -sDEVICE=pngmono -dFirstPage=1 -dSAFER -dBATCH -dLastPage=237 -dNOPROMT -sOutputFile=".
														$out_file."_%02d.png  -dMaxBitmap=5000000000 -dAlignToPixels=0 -dGridFitTT=2 -dTextAlphaBits=4 -dGraphicsAlphaBits=4 -dPDFFitPage -dUseCropBox -dFIXEDMEDIA -r200 -q ".
														$mainfile_pgsile->getPathname()." -c quit";

			echo "\r\n".$cmd;
			fwrite($fpSuccessCON,"\r\n".date("Y-m-d H:i:s |").$cmd);
			exec($cmd);

			$mainfile_pgs	=0;
			$png_pgs		=0;
			$blank_pgs		=0;
			$region 		= str_replace("\\","",strrchr(dirname($mainfile_pgsile->getPathname()),"\\"));
			if(substr($mainfile_pgsile->getBasename(".".$extn),1,2)<>"CP"){
				//1304938_20130905110659
				//0123456789012345678901
				$batchcode = substr($mainfile_pgsile->getBasename(".".$extn),0,22);
				$deleter   = substr($batchcode,0,7);
			}else{
				$batchcode = substr($mainfile_pgsile->getBasename(".".$extn),0,10);
				$deleter   = substr($batchcode,0,10);
			}

			foreach (glob($out_file."*.png") as $filename) {
				$mainfile_pgs = $mainfile_pgs + 1;
				echo "Name:".$filename."\n";
			   	$if_blank = process_pngfile($filename);
			   	if($if_blank=="NON-BLANK"){
			   		$png_pgs = $png_pgs +1 ;
			   	}else{
			   		$blank_pgs = $blank_pgs +1;
			   	}
			}

			/*if(strlen($deleter)>6 && !strpos($mainfile_pgsile->getBasename(".".$extn),"_ERR")){
				$sql = "delete from mfi_docs where mfi_doc_filename LIKE '".$deleter."%'";
				mysql_query($sql,$db);
				sleep(10);
			}*/
			foreach (glob($out_file."*.png") as $rfilename) {
							if($strt==0)
										$sql = "insert into mfi_docs(mfi_doc_code,mfi_doc_filename,mfi_doc_path,mfi_doc_region,batch_code,file_size,file_exist) VALUES ('".$region."_".str_replace($out_file_subpath."\\","", $rfilename)."','".str_replace($out_file_subpath."\\","", $rfilename)."','http://162.216.4.50/".$web_path.$region."','".$region."','".$batchcode."','".filesize($rfilename)."','YES')";
										else
										{
											$sql.=",('".$region."_".str_replace($out_file_subpath."\\","", $rfilename)."','".str_replace($out_file_subpath."\\","", $rfilename)."','http://162.216.4.50/".$web_path.$region."','".$region."','".$batchcode."','".filesize($rfilename)."','YES')";
										}
										$strt=1;
										//echo "\r\n".$sql;

								}
								$db = mysql_connect("162.216.4.50","root","System@123");
								mysql_select_db("cams_ybl_v2",$db);
							/*if(!mysql_query($sql,$db)){
													fwrite($fpFailurePNG,"\r\n".date("Y-m-d H:i:s |").$batchcode."|".$region."_".str_replace($out_file_subpath."\\","", $rfilename)."|FAILURE|".$sql);
												}else{
													fwrite($fpSuccessPNG,"\r\n".date("Y-m-d H:i:s |").$batchcode."|".$region."_".str_replace($out_file_subpath."\\","", $rfilename)."|SUCCESS".$sql);
										}*/
		}
		else {
			return false ; 				// Ignore other files
		}
		if ($mainfile_pgs > 0){

			$sql2="INSERT INTO mfi_fileupload(`batch_code`,`region`, `file_uploaded`, `total_subfiles`,`proper_images`,`blank_images`) VALUES ('".$batchcode."','". $region ."','".$mainfile_pgsile->getBasename(".".$extn).".pdf"."',".$mainfile_pgs.",".$png_pgs.",".$blank_pgs.")";
			//echo "\r\n".$sql2;
				/*if(!mysql_query($sql2,$db)){
							fwrite($fpFailurePDF,"\r\n".date("Y-m-d H:i:s |").$batchcode."|".$region."|".$mainfile_pgsile->getBasename(".".$extn).".pdf"."|FAILURE ");
							fwrite($fpSuccessCON,"FAILED");
						}else{
							fwrite($fpSuccessPDF,"\r\n".date("Y-m-d H:i:s |").$batchcode."|".$region."|".$mainfile_pgsile->getBasename(".".$extn).".pdf"."|SUCCESS ");
							fwrite($fpSuccessCON,"|SUCCESS");
							//unlink($mainfile_pgsile->getPathname());
						}*/

			return true ;
		}else{
						fwrite($fpSuccessCON,"|FAILED");
						fwrite($fpFailurePDF,"\r\n".date("Y-m-d H:i:s |").$batchcode."|".$region."|".$mainfile_pgsile->getBasename(".".$extn).".pdf"."|FAILURE ");
						return false;
		}
}
//===============================================================================================================================

//==== FUNCTION FOR PROCESSING PDF FILE ====================================================================
function process_pngfile($filename){
	if(filesize($filename)>1000){
		//compress($filename,$filename,70);
		return "NON-BLANK";
	}else{
		//unlink($filename)
		return "BLANK";
	}

}
//===============================================================================================================================
?>