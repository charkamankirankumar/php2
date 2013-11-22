<?php
	define("RelativePath", ".");
			   define("PathToCurrentPage", "/");
			   include_once(RelativePath . "/Common.php");
$db = new clsDBmysql_cams_v2();
$query = "select lano,branch,taluk from nps_master where branch='".$_GET['ListBox1']."' and generated is null";
$result = $db->query($query,$db);
$row = mysql_fetch_row($result);
date_default_timezone_set ( 'Asia/Kolkata');
$brnch=$_GET['ListBox1']."_".date('YmdHis');
$zip = new ZipArchive;
$flnmarr=array();
$i=0;
if(count($row)<0)
die("Branch Name Not Available in  DataBase");
elseif(count($row)>0)
{
	do
	{
		if(!file_exists("zipfolder/".$brnch."_".$row[2].".zip"))
				{
					$zres=$zip->open("zipfolder/".$brnch."_".$row[2].".zip",ZIPARCHIVE::CREATE);
					$flnmarr[$i++]=$brnch."_".$row[2].".zip";
		 		}
		$flnm=$row[1]."_".$row[2]."_".$row[0].".pdf";
		$flnmr=$row[1]."_".$row[2]."_".$row[0]."_Receipt.pdf";
		$url ="D:/wamp/www/NPS/wkhtmltopdfm/wkhtmltopdf.exe localhost/cams_ffsl_v2/npsreport.php?lano=".$row[0]." pdfdoc/".$flnm;
		$urlr ="D:/wamp/www/NPS/wkhtmltopdfm/wkhtmltopdf.exe localhost/cams_ffsl_v2/NPS_RECEIPT.php?lano=".$row[0]." pdfdoc/".$flnmr;
		$io=array();
		$blah=exec($url);
		$blah=exec($urlr);
		if(!file_exists("pdfdoc/".$flnm)&&!file_exists("pdfdoc/".$flnmr))
			echo "Either of one file doesnot exists".$flnm;
		else
		{
			$zip->addFile("pdfdoc/".$flnm,$flnm);
			$zip->addFile("pdfdoc/".$flnmr,$flnmr);
		}


	}while($row = mysql_fetch_row($result));
	$zip->close();
	$flnmarr=array_unique($flnmarr);
	for($j=0;$j<count($flnmarr);$j++)
	{
			  if(file_exists("zipfolder/".$flnmarr[$j]))
			  {
						echo $flnmarr[$j];
						$vil=substr(strrchr($flnmarr[$j],"_"),1,-4);
						$sql="update nps_master set generated='YES' where branch='".$_GET['ListBox1']."' and taluk='".$vil."' and generated is null";
						$result = $db->query($sql,$db);
			  }
	}
}
else
{
 echo "Please Generated the Documents Again";
}
?>