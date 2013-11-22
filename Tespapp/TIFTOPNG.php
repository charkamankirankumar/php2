<?php
	define("RelativePath", ".");
	define("PathToCurrentPage", "/");
	include_once(RelativePath . "/Common.php");
	//echo "hi";
	$db = new clsDBmysql_cams_v2();
  	$fdir="forms-inbox";
   	$mf=0;
   	$sf=0;
   	$bf=0;
	date_default_timezone_set ( 'Asia/Kolkata');
    $batchcode=date("YmdHi");
	//SPLITTING MULTIPLE IMAGE FILES
 	$iterator = new RecursiveDirectoryIterator($fdir);
	foreach(new RecursiveIteratorIterator($iterator) as $filename => $mfile)
 	{
		if($mfile->isDir())
		{
			//echo strtoupper('DIR '.$file.'</br>'), PHP_EOL;
		}
	  	else
      	{
			if((strcmp((stristr($mfile->getPathname(),".")),".db"))==0)
      		{
				continue;
      		}
	  		if((strcmp((stristr($mfile->getPathname(),".")),".pdf"))==0||(strcmp((stristr($mfile->getPathname(),".")),".TIF"))==0)
	  		{
				//echo $mfile->getPathname();
				$fln=substr(basename($mfile->getPathname()),0,strripos(basename($mfile->getPathname()),"."));
				$mpt=dirname($mfile->getPathname());
				$mpt=strrchr($mpt,"\\");
				//$mpt=substr($mpt,1);
				if((strcmp((stristr($mfile->getPathname(),".")),".pdf"))==0)
					$cmd = "convert -colorspace rgb -density 300 ".$mfile->getPathname()." -resize 35%  docs/tif".$mpt."/".$fln."_%d.png";
				else
					$cmd = "convert ".$mfile->getPathname()."   docs/tif".$mpt."/".$fln."_%d.png";
				echo $cmd;
				exec($cmd);
				unlink($mfile->getPathname());
				$fdir="docs/tif/".$mpt;
				$iterators = new RecursiveDirectoryIterator($fdir);
				$tsf=0;
				foreach(new RecursiveIteratorIterator($iterators) as $filename => $file)
				{
					if((strcmp((stristr($file->getPathname(),".")),".png"))==0)
		  			{
		  				$tsf+=1;
		    			$dname=basename($file->getPathname());
						$dpath=dirname($file->getPathname());
						if(filesize($file->getPathname())<10000)
						{
							unlink($file->getPathname());
							$bf+=1;
							continue;
						}
						$dpath=strrchr($dpath,"/");
						$dpath=str_replace("\\","/",$dpath);
						$dcode=substr($dname,0,-4);
						$dp="docs/png".$dpath;
						//moving of the file to respective png folder
						$newfile = $dp."/".$dname;
						//database insertion
						if ( rename($file->getPathname(),$newfile))
						{
				 			$sf+=1;
							if (!$db)
							{
								die ('Could not open a mysql connection:');
							}
							$dpath=substr($dpath,2);
							$pth="docs/png/";
							$sql = "insert into mfi_docs(mfi_doc_code,mfi_doc_filename,mfi_doc_path,mfi_doc_region,batch_code) VALUES ('".$dpath."_".$dcode."','".$dname."','".$pth.$dpath."','".$dpath."','".$batchcode."')";
							if(!$db->query($sql))
							{
								echo "<script language='javascript'>alert('Error:Database')</script>";
								return "Problem";
							}
							//	echo "Thank you! Information entered.\n";
	      				}
	      				else
	       				{
			  				echo "<script language='javascript'>alert('Error: cannot move file".$file." to ".$newfile1."')</script>";
							return "Problem";
	       				}
	      			}
				}
     	 	}
     	 	$sql="INSERT INTO mfi_fileupload(`batch_code`,`region`, `file_uploaded`, `total_subfiles`,`proper_images`,`blank_images`) VALUES ('".$batchcode."','".substr($mpt,1)."','".$fln."',".$tsf.",".$sf.",".$bf.")";
	  		echo "<table border='1'><tr><td>filename</td><td>total images</td><td>proper images</td><td>invalid images</td></tr>";
	  		if (!$db->query($sql))
			{
				echo "</table>";
				echo "<script language='javascript'>alert('filesupload table error')</script>";
				echo $sql;
				return "Problem";
			}
			else
			{
				echo "<tr><td>".$fln."</td><td>".$tsf."</td><td>".$sf."</td><td>".$bf."</td></tr>";
			}
			echo "</table>";
		 	$mf=0;
		 	$sf=0;
		 	$bf=0;
     	}
	}
	//mysql_close($db);
?>