(function(){
    $('#treeviewSection').length>0 && $('#treeviewSection').treeview();
    $(window).resize(checkHeight);
    setTimeout(checkHeight,0);
})();

function chkNessInput($form){
	var msg = '';
	$.each($form.find('.ness'), function(i,v){
		if(msg) return false;
		var $v = $(v);				
		var type = getNessInputType($v);
		
		msg = chkNessInputByTypt($v, type);
		if(msg) msg = '請輸入' + msg;		
	});
	$.each($form.find('.ness_dep'), function(i,v){
		if(msg) return false;
		var $v = $(v);		
		
		if(!isDependValueSelected($v)) return;		
		
		var type = getNessInputType($v);		
		
		msg = chkNessInputByTypt($v, type);
		if(msg) msg = '請輸入' + msg;		
	});	
	if(msg){
		alert(msg);
		return false;
	}
	return true;
}

function getNessInputType($el){
	var type = '';
	var tagname = $el[0].tagName.toLowerCase();
	switch(tagname){
		case 'textarea': {
			type = tagname;
			break;
		}
		default: {
			type = $el.attr('type');
		}
	}
	return type;
}

function chkNessInputByTypt($el, type){
	var msg = '';
	var name = $el.attr('name');
	var nessname = $el.data('ness');
	switch(type){
		case 'text': {}
		case 'textarea': {
			if($el.hasClass('ishtml')){
				eval('var html = CKEDITOR.instances.' + name + '.getData();');
				html = stripHtmlTag(html);
				if(html == '') msg = nessname;					
			}	
			else if($el.val() == '') msg = nessname;				
			break;
		}
		case 'radio': {}
		case 'checkbox': {
			var grp = $el.data('grp');	
			if($('[data-grp='+grp+']:checked').length == 0) msg = nessname;
			break;
		}
		case 'file': {				
			var file = $el.data('file');
			var $o_file = $('input[name=' + file + ']');
			if(!$el.val() && !$o_file.val()) msg = nessname;
			break;
		}
		default: {
			if($el.val() == '') msg = nessname;
		}
	}
	return msg;
}

function isDependValueSelected($el){
	var dep = $el.data('dep').split(',');
	var dep_name = dep[0];
	var dep_value = dep[1];
	var $dep = $('[name=' + dep_name + ']');		
	if($dep.val() == dep_value) return true;
	return false;
}

function stripHtmlTag(htmlstr){
	return htmlstr.replace(/(<([^>]+)>)/ig,'').replace(/\n|\r|\s/g,'');
}