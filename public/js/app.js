
var postId = 0;
var postTitleElement = null;
var postBodyElement = null;


$('.edit').click(function(event){
	event.preventDefault();

	postTitleElement = event.target.parentNode.parentNode.children[0];
	postBodyElement = event.target.parentNode.parentNode.children[1];

	var postTitle = event.target.parentNode.parentNode.children[0].textContent;
	var postBody = event.target.parentNode.parentNode.children[1].textContent;
	postId = event.target.parentNode.parentNode.dataset['postid'];
 	$('#post-title').val(postTitle);
 	$('#post-body').val(postBody);
    $('#edit-modal').modal('show');
	
});

$('#modal-save').click(function(){
	$.ajax({
		method: 'POST',
		url: urlEdit,
		data: {post_body: $('#post-body').val(), post_title: $('#post-title').val(), postId: postId, _token: token}
	})
	.done(function(msg){
		$(postTitleElement).text(msg['new_title']);
		$(postBodyElement).text(msg['new_body']);
		$('#edit-modal').modal('hide')
	});


});


$('.upvote').click(function(event){
	event.preventDefault();
	postId = event.target.parentNode.parentNode.dataset['postid'];
	var isUpvote = event.target.previousElementSibling == null;
	console.log(isUpvote);
	$.ajax({
		method: 'POST',
		url: urlUpvote,
		data: {isUpvote: isUpvote, postId: postId, _token: token}
	})


	.done(function(){
		event.target.innerText = isUpvote ? event.target.innerText == 'Upvote' ? 'You liked this post' : 'Upvote' : event.target.innerText == 'Downvote' ? 'You  do not like this post' : 'Downvote' ;
		if(isUpvote){
			event.target.nextElementSibling.innerText = 'Downvote';
		}else{
			event.target.previousElementSibling.innerText = 'Upvote';
		}
	});
});

