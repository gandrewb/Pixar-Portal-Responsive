function iTunes(){
	var encoded = encodeURIComponent(encodeURIComponent(prompt('iTunes Link')));
	textInject('itunes', encoded);
}

function textInject(ikey, iprompt){
	codes[ikey][0] = codes[ikey][0].replace(/###/g, iprompt); 
	console.log(codes[ikey][0]);
	textInsert(ikey);
}

function textInsert(which){
	var s = tbox.selectionStart; var e = tbox.selectionEnd;
	var t = tbox.value;
	tbox.value = t.substring(0, s) + codes[which][0] + t.substring(s, e) + codes[which][1] + t.substring(e);
	var selection = codes[which][0].length - codes[which][2];
	tbox.selectionStart = s + selection; tbox.selectionEnd = s + selection;
	setVars();
}

$(function(){
	$('.colorbox').click(function(){
		$('[name=color]').val($(this).attr('id'));
		$('.colorbox').removeClass('selected');
		$(this).addClass('selected');
	});
	
	$('#margin_toggle').click(function(){
		var inp = $('[name=to_edges]');
		inp.val((inp.val()=='on') ? 'off' : 'on');
	});
});