function checkbudget()
{
var mr=parseInt(document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_monthly_receipts_total").value);
var mp=parseInt(document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_monthly_payments_total").value);
var ar=parseInt(document.getElementById("PagePanelEntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_annual_seasonal_receipts").value);
var ap=parseInt(document.getElementById("PagePanelEntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_annual_seasonal_payments").value);
var lp=parseInt(document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_monthly_payments_total").value);
var me=parseInt(document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_expenses_monthly_total").value);
var ae=parseInt(document.getElementById("PagePanelEntryHV2Panelmfi_hvf2mfi_hvf2_customer_expenses_annual_seasonal_total").value);
var nmr=(!isNaN(mr)?mr:0);
var nmp=(!isNaN(mp)?mp:0);
var nar=(!isNaN(ar)?ar:0);
var nap=(!isNaN(ap)?ap:0);
var nlp=(!isNaN(lp)?lp:0);
var nme=(!isNaN(me)?me:0);
var nae=(!isNaN(ae)?ae:0);
var tmr=(nmr+(nar/12));
var tmp=(nmp+(nap/12)+nlp+nme+(nae/12));
if(tmp>=tmr)
alert("Negative Income to Expense Ratio:");
}
function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    return unescape(dc.substring(begin + prefix.length, end));
} 
function setAge(){
        var sdob=document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_customer_dob").value;
	    if(sdob.length<10)
		{
		alert('Invalid Date');
		document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_customer_dob").value="";
		document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_customer_dob").focus();

		}
		var sy=parseInt(sdob.substr(6,4));
		//var sy=parseInt(sdob);
               var d= new Date();
                var ny=d.getFullYear();
                var age=ny-sy;
	    document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_customer_age_years").value = age;
	             }
function setDOB(obj){
validateNumberField(obj);
var sage=document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_customer_age_years").value;
if(sage<18 || sage>58)
{
alert("Age Should Be in Between 18-58");
document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_customer_age_years").value="";
document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_customer_age_years").focus();
return 0;
}
        var d = new Date();
       var dobYr = d.getFullYear() - sage;
       var dob = '01-01-'+dobYr;
           document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_customer_dob").value = dob;
}
function setHouseType()
{
var selection = document.getElementsByName("HouseType");
for (i=0; i<selection.length; i++)

  if (selection[i].checked == true)
   {
       
    document.getElementById("PagePanelPanelhv3mfi_hvf3mfi_hvf3_customer_house_type").value=selection[i].value;
   }
}

function setHouseSize()
{
var selection = document.getElementsByName("HouseSize");

for (i=0; i<selection.length; i++)

  if (selection[i].checked == true)
   {
       
        document.getElementById("PagePanelPanelhv3mfi_hvf3mfi_hvf3_customer_house_size").value=selection[i].value;
   }
}
function setLoanPremium()
{
var selection = document.getElementsByName("mfi_hvf1_loan_group_meeting_frequency");

for (i=0; i<selection.length; i++)

  if (selection[i].checked == true)
   {
       
        alert(selection[i].value);
   }
}
function setRoofType()
{
var selection = document.getElementsByName("RoofType");

for (i=0; i<selection.length; i++)

  if (selection[i].checked == true)
   {
       
document.getElementById("PagePanelPanelhv3mfi_hvf3mfi_hvf3_customer_house_roof_type").value=selection[i].value;
   }
}
function setFloorType()
{
var selection = document.getElementsByName("FloorType");

for (i=0; i<selection.length; i++)

  if (selection[i].checked == true)
   {
       
document.getElementById("PagePanelPanelhv3mfi_hvf3mfi_hvf3_customer_house_floor_type").value=selection[i].value;
   }
}
function setWaterSource()
{
var selection = document.getElementsByName("WaterSource");

for (i=0; i<selection.length; i++)

  if (selection[i].checked == true)
   {
       
document.getElementById("PagePanelPanelhv3mfi_hvf3mfi_hvf3_customer_house_water_source").value=selection[i].value;
   }
}

function setBorrowerPregnancy()
{
var selection = document.getElementsByName("BorrowerPregnancy");

for (i=0; i<selection.length; i++)
  if (selection[i].checked == true){
       
document.getElementById("PagePanelPanelhv3mfi_hvf3mfi_hvf3_customer_pregnancy").value=selection[i].value;
   }
}
function setGuarantorEducation()
{
var selection = document.getElementsByName("GuarantorEducation");

for (i=0; i<selection.length; i++)

  if (selection[i].checked == true)
   {
       
document.getElementById("PagePanelPanelhv3mfi_hvf3mfi_hvf3_customer_guarantor_education").value=selection[i].value;
   }
}
function setVote(obj)
{
     switch(obj.name)
  {
  case "Radio1": 
  document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate1_vote").value=obj.value;
  break;
  case "Radio2":
  document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate2_vote").value=obj.value;
  break;
  case "Radio3":
  document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower3_vote").value=obj.value;
  break;
  case "Radio4":
	  if(document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower4_name").value=="")
	  obj.checked=false;
	  else
	  document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower4_vote").value=obj.value;
  break;
  case "Radio5":
	  if(document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower5_name").value=="")
	  obj.checked=false;
	  else
	  document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower5_vote").value=obj.value;
  break;
  case "Radio6":
	  if(document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower6_name").value=="")
	  obj.checked=false;
	  else
	  document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower6_vote").value=obj.value;
  break;
  case "Radio7":
	  if(document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower7_name").value=="")
	  obj.checked=false;
	  else
	  document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower7_vote").value=obj.value;
  break;
  case "Radio8":
	  if(document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower8_name").value=="")
	  obj.checked=false;
	  else
	  document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower8_vote").value=obj.value;
  break;
  case "Radio9":
	  if(document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower9_name").value=="")
	  obj.checked=false;
	  else
	  document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower9_vote").value=obj.value;
  break;
  case "Radio10":
	  if(document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower10_vote").value=="")
	  obj.checked=false;
	  else
	  document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower10_vote").value=obj.value;
  break;
  }
  setVoteRank(obj);
}
function setVoteRank(ob)
{
//alert("entered voterank");
 var v=new Array();
 v[1]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate1_vote").value;
 v[2]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate2_vote").value;
 v[3]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower3_vote").value;
 v[4]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower4_vote").value;
 v[5]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower5_vote").value;
 v[6]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower6_vote").value;
 v[7]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower7_vote").value;
 v[8]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower8_vote").value;
 v[9]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower9_vote").value;
 v[10]=document.getElementById("PagePanelPanel1mfi_glemfi_gle_borrower10_vote").value;
 var fcnt=0;
 var scnt=0;
 for(var i=1;i<v.length;i++)
 {
  if(v[i]=="1")
  fcnt=fcnt+1;
  else if(v[i]=="2")
  scnt=scnt+1; 
  else
  {
   fcnt=fcnt;
   scnt=scnt;
  }
 }
 //alert("First Candidate Vote Count "+fcnt+" Second Candidate Vote Count "+scnt);
 document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate1_total_votes").value=fcnt;
 document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate2_total_votes").value=scnt;
 if(fcnt>scnt)
 {
document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate1_rank").value=1;
document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate2_rank").value=2;
document.getElementById("PagePanelPanel1mfi_glemfi_gle_elected_group_leader_name").value=document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate1_name").value;
}
else if(scnt>fcnt)
{
document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate1_rank").value=2;
document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate2_rank").value=1;
document.getElementById("PagePanelPanel1mfi_glemfi_gle_elected_group_leader_name").value=document.getElementById("PagePanelPanel1mfi_glemfi_gle_candidate2_name").value;
}
else
{

}

}
function setFrequency(){
var selection = document.getElementsByName("MFrequency");

for (i=0; i<selection.length; i++)
   if (selection[i].checked ==true)
   {
        //alert(selection[i].value + ' is selected');
        document.getElementById("PagePanelPanelGPFormmfi_gpmfi_gp_group_meeting_frequency").value=selection[i].value;
   }
}
function setSelected(sel)
{
cnt=parseInt(document.getElementById("PagePanelPanelGPFormmfi_gpmfi_gp_total_members_selected").value);
 if(sel.checked==true)
 {
 cnt=cnt+1;
 document.getElementById("PagePanelPanelGPFormmfi_gpmfi_gp_total_members_selected").value=cnt;
 }
 else
 {
 cnt=cnt-1;
 document.getElementById("PagePanelPanelGPFormmfi_gpmfi_gp_total_members_selected").value=cnt;
 }
}
function setCPFrequency()
{
var selection = document.getElementsByName("CPMFrequency");
for (i=0; i<selection.length; i++)
  if (selection[i].checked == true)
   {
        //alert(selection[i].value + ' is selected');
        document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_meeting_frequency").value=selection[i].value;
		if(selection[i].value=="Weekly")
		{
			var wselection = document.getElementsByName("MeetingWeek");
			for (j=0; j<wselection.length; j++)
			wselection[j].disabled=true;
		}
		else
		{
			var wselection = document.getElementsByName("MeetingWeek");
			for (j=0; j<wselection.length; j++)
			wselection[j].disabled=false;
		}
   }
}
function setLocationType()
{
var selection = document.getElementsByName("LocationType");
for (i=0; i<selection.length; i++)
  if (selection[i].checked == true)
   {
        //alert(selection[i].value + ' is selected');
        document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_location_type").value=selection[i].value;
   }
}
function setDistance()
{
var selection = document.getElementsByName("Distance");
for (i=0; i<selection.length; i++)
  if (selection[i].checked == true)
   {
        //alert(selection[i].value + ' is selected');
        document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_distance_from_region_or_branch").value=selection[i].value;
   }
}
function setDirection()
{
var selection = document.getElementsByName("Direction");
for (i=0; i<selection.length; i++)
  if (selection[i].checked == true)
   {
       // alert(selection[i].value + ' is selected');
        document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_direction_from_region_or_branch").value=selection[i].value;
   }
}
function setTravelTime()
{
var selection = document.getElementsByName("TravelTime");
for (i=0; i<selection.length; i++)
  if (selection[i].checked == true)
   {
       // alert(selection[i].value + ' is selected');
        document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_travel_time_from_region_or_branch").value=selection[i].value;
   }
}
function setMeetingWeek()
{
var selection = document.getElementsByName("MeetingWeek");
for (i=0; i<selection.length; i++)
  if (selection[i].checked == true)
   {
        //alert(selection[i].value + ' is selected');
        document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_1st_meeting_week_and_day_of_the_month").value=selection[i].value;
   }
}
function setMeetingDay()
{
var selection = document.getElementsByName("Meeting");
for (i=0; i<selection.length; i++)
  if (selection[i].checked == true)
   {
       // alert(selection[i].value + ' is selected');
                var s=document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_1st_meeting_week_and_day_of_the_month").value.slice(0,3);
        document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_1st_meeting_week_and_day_of_the_month").value=s+" Week "+selection[i].value;
		//alert(document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_1st_meeting_week_and_day_of_the_month").value);
   }
}
function satish()
{
//alert("hi how are u");
}

function setName()
{
//alert("changed"+document.getElementById("PagePanelPanelGPFormmfi_gpmfi_cp_no").value);
document.getElementById("PagePanelPanelGPFormmfi_gpmfi_gp_centre_name").value=document.getElementById("PagePanelPanelGPFormmfi_gpmfi_cp_no").value;
var obj=document.getElementById("PagePanelPanelGPFormmfi_gpmfi_cp_no");
document.getElementById("PagePanelPanelGPFormmfi_gpcpno").value=obj.options[obj.selectedIndex].text;
document.getElementById("PagePanelPanelGPFormmfi_gpmfi_gp_credit_officer_name").value=document.getElementById("PagePanelPanelGPFormmfi_gpListBox2").options[1].text;
document.getElementById("PagePanelPanelGPFormmfi_gpmfi_gp_emp_code").value=document.getElementById("PagePanelPanelGPFormmfi_gpListBox2").options[1].value;
}
function setImageDA()
{
//alert("entered setImage");
document.getElementById("sat").src=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_path").value+"/"+window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_filename").value;
}
function setImage_Hvno()
{
	document.getElementById("sat").src=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_path").value+"/"+window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_filename").value;
	var doctype=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_type").value;
	
switch(doctype)
{
  case "HV1": 
  document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_no").value=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_filename").value.substr(4,33);
  break;
  case "HV2":
  document.getElementById("PagePanelEntryHV2Panelmfi_hvf2mfi_hvf2_id").value=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_filename").value.substr(4,33);
  break;
  case "HV3":
  document.getElementById("PagePanelPanelhv3mfi_hvf3mfi_hvf3_id").value=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_filename").value.substr(4,33);
  break;
  case "GP":
  document.getElementById("PagePanelPanelGPFormmfi_gpmfi_gp_no").value=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_filename").value.substr(3,28);
  break;
  case "CP":
  document.getElementById("PagePanelPanelCPmfi_cpmfi_cp_no").value=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_filename").value.substr(3,28);
  break;
  case "GLE":
  document.getElementById("PagePanelPanel1mfi_glemfi_gle_gpno").value=window.parent.document.getElementById("PagePanelmfi_docsmfi_doc_filename").value.substr(4,28);
  break;
 }
}
function countMP(obj)
{
validateNumberField(obj)
var cnt=0;
bmp1=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_monthly_payments1").value;
bmp2=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_monthly_payments2").value;
gmp=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_guarantor_business_cashflow_monthly_payments").value;
omp=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_others_business_cashflow_monthly_payments").value;
if(!isNaN(bmp1)&&bmp1!="")
cnt+=parseInt(bmp1);
if(!isNaN(bmp2)&&bmp2!="")
cnt+=parseInt(bmp2);
if(!isNaN(gmp)&&gmp!="")
cnt+=parseInt(gmp);
if(!isNaN(omp)&&omp!="")
cnt+=parseInt(omp);
document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_monthly_payments_total").value=cnt;
checkbudget();
}
function countMR(obj)
{
validateNumberField(obj);
var cnt=0;
bmr1=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_monthly_receipts1").value;
bmr2=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_monthly_receipts2").value;
gmr=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_guarantor_business_cashflow_monthly_receipts").value;
omr=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_others_business_cashflow_monthly_receipts").value;
if(!isNaN(bmr1)&&bmr1!="")
cnt+=parseInt(bmr1);
if(!isNaN(bmr2)&&bmr2!="")
cnt+=parseInt(bmr2);
if(!isNaN(gmr)&&gmr!="")
cnt+=parseInt(gmr);
if(!isNaN(omr)&&omr!="")
cnt+=parseInt(omr);
document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_business_cashflow_monthly_receipts_total").value=cnt;
}
function countMLP(obj)
{
validateNumberField(obj);
var cnt=0;
bmp1=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_monthly_payments1").value;
bmp2=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_monthly_payments2").value;
bmp3=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_monthly_payments3").value;
rmp1=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_relationship1_monthly_payment").value;
rmp2=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_relationship2_monthly_payment").value;
if(!isNaN(bmp1)&&bmp1!="")
cnt+=parseInt(bmp1);
if(!isNaN(bmp2)&&bmp2!="")
cnt+=parseInt(bmp2);
if(!isNaN(bmp3)&&bmp3!="")
cnt+=parseInt(bmp3);
if(!isNaN(rmp1)&&rmp1!="")
cnt+=parseInt(rmp1);
if(!isNaN(rmp2)&&rmp2!="")
cnt+=parseInt(rmp2);
document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_monthly_payments_total").value=cnt;
}
function countLCO(obj)
{
validateNumberField(obj);
var cnt=0;
bmp1=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_current_outstanding1").value;
bmp2=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_current_outstanding2").value;
bmp3=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_current_outstanding3").value;
if(!isNaN(bmp1)&&bmp1!="")
cnt+=parseInt(bmp1);
if(!isNaN(bmp2)&&bmp2!="")
cnt+=parseInt(bmp2);
if(!isNaN(bmp3)&&bmp3!="")
cnt+=parseInt(bmp3);
document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_mfi_or_bank_loan_current_outstanding_total").value=cnt;
}
function countHPE(obj)
{
validateNumberField(obj);
var cnt=0;
e1=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_rent_expenses").value;
e2=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_food_expenses").value;
e3=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_electricity_expenses").value;
e4=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_gas_expenses").value;
e5=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_clothing_expenses").value;
e6=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_mobile_expenses").value;
e7=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_cable_tv_expenses").value;
e8=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_school_fee_expenses").value;
e9=document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_monthly_others_expenses").value;
if(!isNaN(e1)&&e1!="")
cnt+=parseInt(e1);
if(!isNaN(e2)&&e2!="")
cnt+=parseInt(e2);
if(!isNaN(e3)&&e3!="")
cnt+=parseInt(e3);
if(!isNaN(e4)&&e4!="")
cnt+=parseInt(e4);
if(!isNaN(e5)&&e5!="")
cnt+=parseInt(e5);
if(!isNaN(e6)&&e6!="")
cnt+=parseInt(e6);
if(!isNaN(e7)&&e7!="")
cnt+=parseInt(e7);
if(!isNaN(e8)&&e8!="")
cnt+=parseInt(e8);
if(!isNaN(e9)&&e9!="")
cnt+=parseInt(e9);
document.getElementById("EntryHV2Panelmfi_hvf2mfi_hvf2_customer_expenses_monthly_total").value=cnt;
checkbudget();
}
function setRadioButtonValue(radioname,rval)
{
var radioObj=document.getElementsByName(radioname);
var radioLength = radioObj.length;
for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].value.toLowerCase() == rval.toLowerCase()) 
		{
		radioObj[i].checked = true;
		}
	}

}
function setSatListBox(lname,lval)
{
	for(i=0;i<lname.options.length;i++)
	{
	  if(lname.options[i].text.toUpperCase()==lval.toUpperCase())
	  {
	  lname.options[i].selected=true;
	  break;
	  }
	}
}
function hidetextbox()
{
document.getElementById("PagePanelEntryHV1Panelmfi_hvf1mfi_hvf1_loan_purpose_details").style.display="inline";
document.getElementById("PagePanelEntryHV1Panelmfi_hvf1Hidden2").style.display="none";
}
function validateNameField(obj)
{
var str=obj.value;
var l=obj.value.length;
var pat=RegExp("[a-z A-Z.]{"+l+"}");
          var res=pat.test(str);
                  if(!res)
                  {
                  alert("Name Field is Invalid.Use Only A-Z|a-z|space|dot(.)");
                  obj.value="";
				  obj.focus();
                  }
				  else
				  {
				  var pat1=RegExp("(\\w)\\1{2,}");
				  res=pat1.test(str);
					  if(res)
					  {
						  alert(str+" is having more than 2 repeating Characters");
						  obj.value="";
						  obj.focus();
					  }
				  }
}
function validateNumberField(obj)
{
var str=obj.value;
var l=obj.value.length;
var pat=RegExp("[0-9]{"+l+"}");
          var res=pat.test(str);
                  if(!res)
                  {
                  alert("Invalid Number(Only 0-9)");
                  obj.value="";
				  obj.focus();
                  }
				  else
				  return 1;
				  
}
function disableForm(theform) {
		if (document.all || document.getElementById)
		 {
			for (i = 0; i < theform.length; i++)
			 {
				var formElement = theform.elements[i];
				if (true) 
				{
				   
				
						formElement.disabled=true;
						 formElement.style.backgroundColor="#EBEBE4";
						formElement.style.color="#933";
				}
		  	}
		}
	}
function compareDate(fd,td)
{
var temp1="";
var temp2="";
        var str1 = fd.value; 
        var str2 = td.value; 
        var dt1  = str1.substring(0,2); 
        var mon1 = str1.substring(3,5); 
        var yr1  = str1.substring(6,10);  
        var dt2  = str2.substring(0,2); 
        var mon2 = str2.substring(3,5); 
        var yr2  = str2.substring(6,10); 
        temp1 = mon1 +"/"+ dt1 +"/"+ yr1;
        temp2 = mon2 +"/"+ dt2 +"/"+ yr2;
        var cfd = Date.parse(temp1);
        var ctd = Date.parse(temp2);
        var date1 = new Date(cfd); 
        var date2 = new Date(ctd);
       if(date1 > date2) 
                { 
                alert("FROM DATE SHOULD BE MORE THAN TO DATE");
				td.value="";
                }
}
function checkDateVal(cd)
{
var temp1="";
 var str1 = cd.value; 
 var dt1  = str1.substring(0,2); 
 var mon1 = str1.substring(3,5); 
 var yr1  = str1.substring(6,10); 
temp1 = mon1 +"/"+ dt1 +"/"+ yr1;
var cfd = Date.parse(temp1);
var date1 = new Date(cfd); 
var date2 = new Date();
       if(date1 > date2) 
                { 
                alert("DATE CANNOT BE SET TO FUTURE DATE");
				cd.value="";
                }
}