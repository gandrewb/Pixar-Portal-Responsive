$('#lcol .delete').click(function(){
	if(confirm('Are you sure you want to delete this article?')){
		var div = $(this).parent();
		$.ajax({
			url: 'scripts/addarticle.php',
			type: 'POST',
			data: 'action=delete&id='+$(this).attr("data-id")
		}).done(function(){
			div.remove();
		});
	}
});

$('#rcol .delete').click(function(){
	if(confirm('Are you sure you want to delete this comment?')){
		var div = $(this).parent();
		$.ajax({
			url: 'scripts/comments.php',
			type: 'POST',
			data: 'action=delete&id='+$(this).attr("data-id")
		}).done(function(){
			div.remove();
		});
	}
});

$('#rcol .approve').click(function(){
	var div = $(this).parent();
	$.ajax({
		url: 'scripts/comments.php',
		type: 'POST',
		data: 'action=approve&id='+$(this).attr("data-id")+'&comment='+div.find('[contenteditable]').html()
	}).done(function(){
		div.remove();
	});
});