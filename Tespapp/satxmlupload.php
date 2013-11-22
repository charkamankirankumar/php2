<?php
/*XML to Database storing*/
function storeXMLtoDatabase($satfile,$un)
{
$db = mysql_connect("localhost", "root", "");
mysql_select_db("cams_ffsl_v2",$db);
$sql = "insert into overlap_header(uploaded_by,`REPORT-TYPE`, `REPORT-DATE`, `FILE-NAME`, `RESPONSE-CNT-FILE`, `INQ-CNT-FILE`) values('".$un."','";
$objDOM = new DOMDocument();
$objDOM->load($satfile);
$items=$objDOM->getElementsByTagName("OVERLAP-FILE-HEADER");
foreach($items->item(0)->childNodes as $s)
{
 if($s->nodeName!="#text")
 {
  if($s->nodeName=="FILE-NAME")
  $filenam=$s->nodeValue;
   if(!$s->nextSibling->nextSibling)
   {
     $sql.=$s->nodeValue."')";
   }
  else
     $sql.=$s->nodeValue."','";
 }
}
//echo $sql;
if (!mysql_query($sql,$db))
  {
  die('Error: ' . mysql_error());
  }
//echo "1 record added";
$objDOM = new DOMDocument();
$objDOM->load($satfile);
$myhead=$objDOM->getElementsByTagName("OVERLAP-REPORT");
//echo $myhead->length;
$i=0;
foreach($myhead as $items)
{
$coln="";
$sql="";
	$par=$items->getElementsByTagName("HEADER");
	$ch=$par->item(0)->childNodes->length;
        //echo "child length is ".$ch;
	foreach($par->item(0)->childNodes as $s)
	{
	 if($s->nodeName!="#text")
	 {
	 if($s->nodeName=="REPORT-ID")
	 $rid=$s->nodeValue;
	   if(!$s->nextSibling->nextSibling)
	   {
	     foreach($s->childNodes as $sub)
	     {
	       if($sub->nodeName!="#text" && $sub->nodeName!="ERRORS")
	         if(!$sub->nextSibling->nextSibling)
				 {
					 $coln.=$sub->nodeName."`,`";
				 	 $sql.=$sub->nodeValue."','";
                 }
	       else
                 {
				 	 $coln.=$sub->nodeName."`,`";
					 $sql.=$sub->nodeValue."','";
                 }
	     }
	   }
	   else
	   {
             $coln.=$s->nodeName."`,`";
	     $sql.=$s->nodeValue."','";
	   }
	 }
	}
	$par=$items->getElementsByTagName("REQUEST");
	$ch=$par->item(0)->childNodes->length;
	//echo $ch;
	foreach($par->item(0)->childNodes as $s)
	{
	 if($s->nodeName!="#text" && $s->nodeName!="DOB")
	 {
	 	if($s->nodeName=="MBR-ID")
	 	$mid=$s->nodeValue;
	   if(!$s->nextSibling->nextSibling)
	   {
               $coln.=$s->nodeName."`)";
	       $sql.=$s->nodeValue."')";
	   }
	   else
	   {
	       $sql.=$s->nodeValue."','";
               $coln.=$s->nodeName."`,`";
       }
	 }
	}
$sql=str_replace("'(","'",$sql);
$sql=str_replace(")'","'",$sql);
/*echo $sql."</br></br></br>";*/
//echo $coln;
$txt="insert into overlap_reports(`header_id`,`".$coln." values('".$filenam."','".$sql;
//echo $txt." Record to be added";
if (!mysql_query($txt,$db))
  {
  die('Error: ' . mysql_error());
  }
$i++;
/*response file*/
$coln="";
$sql="";
        $mid=$items->getElementsByTagName("REQUEST");
        $smid=$mid->item(0)->lastChild->previousSibling->nodeValue;
        $par=$items->getElementsByTagName("RESPONSES");
	$ch=$par->item(0)->childNodes->length;
        if($ch>0)
        {
       	$spar=$par->item(0)->getElementsByTagName("RESPONSE");
		foreach($spar as $sres)
		{
		$coln="";
		$sql="";
		if($sres->nodeName!="#text")
		foreach($sres->childNodes as $s)
		  {
              if($s->nodeName!="#text")
			 {
                if($s->nodeName!="LOAN-DETAILS")
			    {
                                 //echo $s->nodeName."</br>";
                         $coln.=$s->nodeName."`,`";
						 $vl=str_replace("'","",$s->nodeValue);
    			         $sql.=$vl."','";
                 }
                else
			    {
			      foreach($s->childNodes as $sub)
			      {
	    			   if($sub->nodeName!="#text")
						{
							 $coln.=$sub->nodeName."`,`";
							 $sql.=$sub->nodeValue."','";
						}
	     	       }
	  	        }
	          }
           }
       $sql=str_replace("'(","'",$sql);
       $sql=str_replace(")'","'",$sql);
       $coln=substr_replace($coln ,")",-2);
       $sql=substr_replace($sql ,")",-2);
        $sql=str_replace("''","'",$sql);
	$txt="insert into overlap_response(`header_id`,`report_id`,`MBR-ID`,`".$coln." value('".$filenam."','".$rid."','".$smid."','".$sql;
        //echo $txt." Record to be added";
			if (!mysql_query($txt,$db))
			{
			 die('Error: ' . mysql_error());
			}
		}
	}

}

}
/*end of XML to Database storing*/
//$uploads_dir  = "ftp/forms-inbox/".$_POST["udirect"]."/";
$uploads_dir  = "docs/xmlresponse/";
$uname=$_POST["uploaded_by_name"];
 $i=1;
 $db = mysql_connect("localhost", "root", "");
 mysql_select_db("cams_ffsl_v2",$db);
 foreach($_FILES as $file)
 {
   			 IF(move_uploaded_file($file["tmp_name"],$uploads_dir.$file["name"]))
			 {
  				//$sql="insert into cb_response_upload(mfi_file_name,mfi_territorycode,mfi_uploaded_by)values(";
                //$sql.="'".$file["name"]."',";
				//$sql.="'".$file["name"]."',";
				//$sql.="'".$uname."')";
			 	//$res=mysql_query($sql,$db);
				$xmlres=storeXMLtoDatabase($uploads_dir.$file["name"],$uname);
				$str.="<li> uploaded-".$uploads_dir.$file["name"]." ".$xmlres."</li>";
			 }
 }
echo $str;
?>