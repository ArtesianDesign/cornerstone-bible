<style>
.contrast{}
.dlabel{font-size:10px;text-align:right;padding-right:2px;}
.dheader{padding:2px;text-align:left}
</style>
<?php 
    echo "<form id=GetDirection$bID method=POST>";
?>
<table style="border-collapse:collapse;border-color:#BBBBBB;" border="1" align="center">
<tr>
<td class="contrast dheader" colspan="2">Get Directions To:
<div style="padding-left:30px;font-size:85%">
<?php 
    echo "$street<br />$city, $state $zip
</div>
</td>
</tr>
<tr>
<td class='contrast dheader' colspan='2'>Starting From:</td>
</tr>
<tr align='left'>
<td class='contrast dlabel'>Street</td>
<td><input class='textForm' style='width: 150px;' name='street_address$bID' type='text' /></td>
</tr>
<tr align='left'>
<td class='contrast dlabel'>City</td>
<td><input class='textForm' style='width: 150px;' name='city$bID' type='text' /></td>
</tr>
<tr align='left'>
<td class='contrast dlabel'>State</td>
<td><input class='textForm' style='width: 150px;' name='state$bID' type='text' /></td>
</tr>
<tr align='left'>
<td class='contrast dlabel'>Zip</td>
<td><input class='textForm' style='width: 150px;' name='postal_code$bID' size='5' type='text' /></td>
</tr>

<tr>
<td class='contrast' colspan='2'>
<input onclick=\"javascript: genURL$bID(''); return true;\" name='submitbtn' type='button' value='Get Directions' />
<input onclick=\"javascript:genURL$bID('reverse'); return true;\" name='submitbtn' type='button' value='Get Reverse Directions' /></td>
</tr>
</table>
</form>


<script>
var win='';
function GDpopUp$bID(URL, type)
{
    width = 820;
    height = 640;
   var token = URL.indexOf('?') > -1 ? '&' : '?';
   var leftPosition  = (screen.width - 820) / 2;
   var topPosition = (screen.height - 640) / 4;
   //open centered
   win.close;"
   ?>
   eval("win = window.open(URL, '', 'toolbar=1,scrollbars=1,location=1,status=1,resizable=1,menubar=1,width="+width+",height="+height+",left="+leftPosition+",top="+topPosition+"');");
<?php 
    echo "
   if (parseInt(navigator.appVersion) >= 4)
   {
      win.window.focus();
   }
}

    function genURL$bID(action)
    {
        formname='GetDirection$bID';
  		var street$bID = '$street';
		var city$bID = '$city';
		var state$bID = '$state';
		var zip$bID = '$zip';


		var ToAddress$bID='';
        var sa$bID = document.getElementById(formname).street_address$bID.value;
		var cy$bID = document.getElementById(formname).city$bID.value;
		var st$bID = document.getElementById(formname).state$bID.value;
		var pc$bID = document.getElementById(formname).postal_code$bID.value;

		if(pc$bID=='')
		{
			if(cy$bID=='' || st$bID=='')
			{
				alert('Please enter a ZIP code, or a city & state.');
				return false;
			}
		}
		ToAddress$bID='';
		ToAddress$bID+=sa$bID;
        if(sa$bID){
            ToAddress$bID+=' ';
        }
		ToAddress$bID+=cy$bID;
        if(cy$bID){
            ToAddress$bID+=' ';
        }
		ToAddress$bID+=st$bID;
        if(st$bID){
            ToAddress$bID+=' ';
        }
        ToAddress$bID+=pc$bID;
        ToAddress$bID=ToAddress$bID.replace(/ /g,'+');
		FromAddress$bID='';
		FromAddress$bID+=street$bID;
        if(street$bID){
            FromAddress$bID+=' ';
        }
		FromAddress$bID+=city$bID;
        if(city$bID){
            FromAddress$bID+=' ';
        }
		FromAddress$bID+=state$bID;
        if(state$bID){
            FromAddress$bID+=' ';
        }
        FromAddress$bID+=zip$bID;
        FromAddress$bID=escape(FromAddress$bID);
        ToAddress$bID=escape(ToAddress$bID);
    	if(!action){}
    	else{
    	    xaddress$bID=FromAddress$bID;
    	    FromAddress$bID=ToAddress$bID;
    	    ToAddress$bID=xaddress$bID;
    	}

		var url$bID='http://maps.google.com/maps?f=d&saddr='+ToAddress$bID+'&daddr='+FromAddress$bID+'&pw=2';


		GDpopUp$bID(url$bID);

   }

</script>
";
?>