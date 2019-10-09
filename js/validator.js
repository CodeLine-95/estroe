var Validator=new Object;
Validator.result=true;
Validator.checkSubmit=function(formE){
	Validator.result=true;
	var elements=formE.elements;
	Validator.hiddenMsg();
	for(var i=0;i<elements.length;i++){
		var element=elements[i];
		var mode=element.getAttribute('mode');
		if(mode!=null){
			switch(mode.toLowerCase()){
				case 'require':
				Validator.require(element);
				break;
				case 'require_email':
				Validator.isEmail(element,true);
				break;
				case 'email':
				Validator.isEmail(element,false);
				break;
				case 'isnumber':
				Validator.isNumber(element,false);
				break;
				case 'require_isnumber':
				Validator.isNumber(element,true);
				break;
				case 'compare':
				Validator.compare(element,element.getAttribute('to'));
				break;
				case 'require_time':
				Validator.isTime(element,true);
				break;
				default:
				break;
			}
		}
	}
	return Validator.result;
}
Validator.require=function(element){
	if(Utils.isEmpty(Utils.getValue(element))){
		Validator.showMsg(element.id);
		Validator.result=false;
	}
}
Validator.isEmail=function(element,require){
	 var email = Utils.trim(Utils.getValue(element));

    if ( ! require && email == '')
    {
      return;
    }

    if ( ! Utils.isEmail(email))
    {
      Validator.showMsg(element.id);
	  Validator.result=false;
    }
}

Validator.isTime=function(element,require){
	 var time = Utils.trim(Utils.getValue(element));
	 
    if ( ! require && time == '')
    {
      return;
    }

    if ( ! Utils.isTime(time))
    {
      Validator.showMsg(element.id);
	  Validator.result=false;
    }
}

Validator.isNumber=function(element,require){
	
	 var number= Utils.trim(Utils.getValue(element));
    if ( ! require&& number == '')
    {
      return;
    }

    if ( ! Utils.isNumber(number))
    {
      Validator.showMsg(element.id);
	  Validator.result=false;
    }
}
Validator.compare=function(element,to){
	var elvalue1=Utils.getValue(element);
	var elvalue2=document.getElementById(to).value;
	if(elvalue1==elvalue2)
		return;
	else{
		Validator.showMsg(element.id);
		Validator.result=false;
	}
}
Validator.showMsg=function(elementId){
	var errorid="ck"+elementId;
	document.getElementById(errorid).style.display="inline";
}
Validator.hiddenMsg=function()
{
	var errors=document.getElementsByTagName("span");
	for(var i=0;i<errors.length;i++)
		if(errors[i].className=="errorinfo"){
			var erid=errors[i].id;
			document.getElementById(erid).style.display="none";
		}
}