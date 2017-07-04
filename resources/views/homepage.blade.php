@extends ('layouts.master')

@section('content')
	@include('includes.messages-block')
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
		<header><h3>What do you have to blah blah?</h3></header>
			<form action="{{route('post.create')}}" method="post">
				<div class="form-group">
					<textarea class="form-control" name="post_title" id="new-titlet" rows="1" placeholder="Title"></textarea>
					<textarea class="form-control" name="post_body" id="new-post" rows="5" placeholder="Your post"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Create post</button>
				   <input type="hidden" name="_token" value="{{Session::token()}}">
			</form>
		</div>
	</section>
	
	<section class="rows posts">
		<div class="col-md-6 col-md-offset-3" >
			<header><h3>What other people says</h3></header>
			@foreach($posts as $post)
				<article class="post" data-postid="{{$post->id}}">
					
						<p class="post-group">{{$post->post_title}}</p>
			
						<p class="post-group">{{$post->post_body}}</p>
					
					<div class="info">
						Posted by {{ $post->user->name}} on {{ $post->user->created_at}} updated {{$post->user->updated_at}}
					</div>
					<div class="interaction">
						<a href="#" class="upvote" > {{Auth::user()->upvotes()->where('post_id', $post->id)->first() ? Auth::user()->upvotes()->where('post_id', $post->id)->first()->upvote == 1 ? 'You liked this post ' : 'Upvote' : 'Upvote' }} </a> <!--Do this in a user controller, check if the authentificated user liked the post -->
						<a href="#" class="upvote"> {{Auth::user()->upvotes()->where('post_id', $post->id)->first() ? Auth::user()->upvotes()->where('post_id', $post->id)->first()->upvote == 0 ? 'You do not like this post ' : 'Downvote' : 'Downvote' }} </a>
						
						@if(Auth::user() == $post->user )
						<a href="#" class="edit" >Edit</a>
						<a href="{{route('post.delete', ['post_id' => $post->id])}}">Delete</a>
						@endif

					</div>
				</article>
			@endforeach

		</div>
	</section>


	<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Edit post</h4>
	      </div>
	      <div class="modal-body">
	       	<form>
	       		<div class="form-group">
	       			
	       			<textarea class="form-control" name="post-title" id="post-title" rows="1"></textarea>
	       			<textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
	       			
	       		</div>
	       	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
	        
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script>
		var token = '{{Session::token()}}';
		var urlEdit = '{{route('edit')}}';
		var urlUpvote = '{{route('upvote')}}';
	</script>
@endsection