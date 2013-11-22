<?php
//BindEvents Method @1-28F75CF4
function BindEvents()
{
    global $NewRecord1;
    global $CCSEvents;
    $NewRecord1->ListBox1->CCSEvents["BeforeShow"] = "NewRecord1_ListBox1_BeforeShow";
    $NewRecord1->Hidden1->CCSEvents["BeforeShow"] = "NewRecord1_Hidden1_BeforeShow";
    $NewRecord1->ds->CCSEvents["AfterExecuteInsert"] = "NewRecord1_ds_AfterExecuteInsert";
}
//End BindEvents Method

//NewRecord1_ListBox1_BeforeShow @8-7690D27B
function NewRecord1_ListBox1_BeforeShow(& $sender)
{
    $NewRecord1_ListBox1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
//End NewRecord1_ListBox1_BeforeShow

//Close NewRecord1_ListBox1_BeforeShow @8-6383F350
    return $NewRecord1_ListBox1_BeforeShow;
}
//End Close NewRecord1_ListBox1_BeforeShow

//NewRecord1_Hidden1_BeforeShow @26-745D7D2C
function NewRecord1_Hidden1_BeforeShow(& $sender)
{
    $NewRecord1_Hidden1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
//End NewRecord1_Hidden1_BeforeShow
$NewRecord1->Hidden1->SetValue(CCGetUserLogin());
//Custom Code @27-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close NewRecord1_Hidden1_BeforeShow @26-2303E5FF
    return $NewRecord1_Hidden1_BeforeShow;
}
//End Close NewRecord1_Hidden1_BeforeShow

//NewRecord1_ds_AfterExecuteInsert @7-84CE8BF2
function NewRecord1_ds_AfterExecuteInsert(& $sender)
{
    $NewRecord1_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
//End NewRecord1_ds_AfterExecuteInsert
//CCSetCookie("docregion",$NewRecord1->ListBox2->GetValue());
//CCSetCookie("batch_code",$NewRecord1->ListBox1->GetValue());

//Custom Code @28-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close NewRecord1_ds_AfterExecuteInsert @7-14E07D06
    return $NewRecord1_ds_AfterExecuteInsert;
}
//End Close NewRecord1_ds_AfterExecuteInsert

//Page_BeforeInitialize @1-2B7CB698
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ChangeRegionBatch; //Compatibility
//End Page_BeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
