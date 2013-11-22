<?php
//BindEvents Method @1-80452091
function BindEvents()
{
    global $centre_meeting_to;
    $centre_meeting_to->CCSEvents["BeforeShow"] = "centre_meeting_to_BeforeShow";
}
//End BindEvents Method

//centre_meeting_to_BeforeShow @2-511F2561
function centre_meeting_to_BeforeShow(& $sender)
{
    $centre_meeting_to_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $centre_meeting_to; //Compatibility
//End centre_meeting_to_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//DEL  // -------------------------
//DEL      // Write your own code here.
$timeStr= '06:45|07:00|07:15|07:30|07:45|08:00|08:15|08:30|08:45|09:00|09:15|09:30|09:45|10:00|10:15|10:30|10:45|11:00|11:15|11:30|11:45|12:00|12:15|12:30|12:45|13:00';
 	$timeArr=explode('|',$timeStr);
 	$fromKey=array_search(CCGetParam('keyword'),$timeArr);
	if ($fromKey <> FALSE){
 		$timeArrLast = count($timeArr) -1;
		$toKey = $fromKey+4;
  		if ($toKey > $timeArrLast)
 			$toKey = $timeArrLast;
 		$meeting_time = '';
  
 		for ($i=$fromKey+1 ; $i<=$toKey; $i++){
			if($i<$toKey){
  				// Running Item
 				$meeting_time = $meeting_time."[".  '"'.$timeArr[$i].'",'."". '"'.$timeArr[$i].'"'."" . "],\n";
 			}else{
  				// Last Item
 				$meeting_time = "[\n".$meeting_time."[".  '"'.$timeArr[$i].'",'."". '"'.$timeArr[$i].'"'."" . "]"."\n]";
			}
 		}
  		$Container->centre_meeting_to->SetValue($meeting_time);
  	}
 
//DEL  // -------------------------


//Close centre_meeting_to_BeforeShow @2-A01D9634
    return $centre_meeting_to_BeforeShow;
}
//End Close centre_meeting_to_BeforeShow


?>
