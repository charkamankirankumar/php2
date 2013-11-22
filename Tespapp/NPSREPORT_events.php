<?php
//BindEvents Method @1-E4ABE8B2
function BindEvents()
{
    global $nps_master;
    global $CCSEvents;
    $nps_master->CCSEvents["BeforeShow"] = "nps_master_BeforeShow";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//nps_master_BeforeShow @2-BF395E3B
function nps_master_BeforeShow(& $sender)
{
    $nps_master_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $nps_master; //Compatibility
//End nps_master_BeforeShow
/*if (count($_GET)<=0) 
die("looking for ?url=http://.....");
$flnm=$_GET["lano"]."pdf";
$url ="localhost/nps/npsreport.php?lano=".$_GET["lano"];
$blah = exec("d:/wamp/www/NPS/wkhtmltopdfm/wkhtmltopdf.exe $url pdfdoc/".$flnm);
$db = new clsDBnps_con();
$query = "update nps_master set generated='YES' WHERE lano='".$_GET['lano']."'";
$result = $db->query($query);*/
//Custom Code @68-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close nps_master_BeforeShow @2-120C7433
    return $nps_master_BeforeShow;
}
//End Close nps_master_BeforeShow

//Page_BeforeUnload @1-244129BF
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NPSREPORT; //Compatibility
//End Page_BeforeUnload

//Custom Code @65-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload


?>
