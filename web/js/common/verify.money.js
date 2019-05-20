;(function(global){
	'use strict';
	//验证money 用法加属性money	
	function input(event){
		var target = event.target || event.srcElement;
		var start = target.setSelectionRange? target.selectionStart : 1; //ie9+
		var content = target.value;
		var regular = [/[^\d^.]/g,/^0{2,}/g,/\.{2,}/g];		
        var numlen = target.getAttribute("money");		
		if(!numlen){
			target.value = target.value.replace(regular[0], '');
			target.value = target.value.replace(regular[1], '0');
			target.value = target.value.replace(regular[2], '.');
			target.value = target.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
			target.value = target.value.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');
			if(target.value.length>=2){
				var ch1 = target.value.substr(0,1);
			    var ch2 = target.value.substr(1,1);
				if(ch1 == '0' && ch2 != '.'){
					var tmp = target.value.substr(0,1);
					var inof = target.value.indexOf('.');
					if(inof>-1){
						tmp += target.value.substr(inof);
					}
					target.value = tmp;
				}
			}			
			var end = target.setSelectionRange? target.selectionStart : 1;
			if(start < end){
				target.setSelectionRange(start, start);
			}
			return;
		}		
		if(isNaN(numlen)){return;}
		target.value = target.value.replace(regular[0], '');
		target.value = target.value.replace(regular[1], '0');
		target.value = target.value.replace(regular[2], '.');
		target.value = target.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
		target.value = target.value.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');
        if(target.value.length>=2){
			var ch1 = target.value.substr(0,1);
			var ch2 = target.value.substr(1,1);
			if(ch1 == '0' && ch2 != '.'){
				var tmp = target.value.substr(0,1);
				var inof = target.value.indexOf('.');
				if(inof>-1){
				    tmp += target.value.substr(inof);
				}
				target.value = tmp;
			}
		}		
		var indexof = target.value.indexOf(".");
		if(indexof>-1){
			var str = target.value.substr(0, indexof);
			if(str.length > numlen){
				str = str.substr(0,numlen);
				str += target.value.substr(indexof);
				target.value = str;
			}
		}else{
			target.value = target.value.substr(0, numlen);
		}		
		var end = target.setSelectionRange? target.selectionStart : 1;
		if(start < end){
			target.setSelectionRange(start, start);
		}
	}
	//load
    function load(){
		//ie
		if(!global.addEventListener){
			var childs = document.getElementByTagName("input");
			for(var i=0; i<childs.length; i++){
				var atrr = childs[i].getAttribute("money");
				if(!atrr){break;}
				childs[i].attachEvent('onpropertychange', input);
			}
		}else{
			var childs = document.querySelectorAll("input[money]");
			for(var i=0; i<childs.length;i++){
				childs[i].addEventListener('input', input);
			}
		}
	}	
	//regist
	if(!global.addEventListener){
		global.attachEvent('onload', load);
	}else{
		global.addEventListener('load', load);
	}
	
}(this));