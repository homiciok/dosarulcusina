<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Upvote;
use Auth;

/**
* 
*/
class PostController extends Controller
{
	public function getHomepage(){

		$posts = Post::orderBy('created_at', 'desc')->get();
		return view('homepage', ['posts' => $posts]);
	}

	
	public function postCreatePost(Request $request)
	{
		$this->validate($request, [
			'post_title'=> 'required|max:36',
			'post_body' => 'required|max:1000'
		]);
		$post = new Post();
		$post->post_title= $request['post_title'];
		$post->post_body = $request['post_body'];
		$post->thread_id= 0; //to be added
		$post->status= 0; //to be added
		$message  = 'there is an error';
		if($request->user()->posts()->save($post)){
			$message = "Post was created";
		}
			return redirect()->route('homepage')->with(['message' => $message]);
	}

	public function getDeletePost($post_id){
		$post = Post::where('id', $post_id)->first();
		if (Auth::user() != $post->user) {
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('homepage')->with(['message' => 'Succesful deleted']);
	}

	public function postEditPost(Request $request){
		$this->validate($request, [
			'post_title'=> 'required',
			'post_body' => 'required'
		]);
		$post = Post::find($request['postId']);
		if (Auth::user() != $post->user) {
			return redirect()->back();
		}
		$post->post_title = $request['post_title'];
		$post->post_body = $request['post_body'];
		$post->update();
		return response()->json(['new_body' => $post->post_body, 'new_title' =>  $post->post_title], 200);
	}

	
	public function postUpVotePost(Request $request){
		$post_id = $request['postId'];
		$is_upvote = $request['isUpvote'] === 'true';
		$update = false;
		$post = Post::find($post_id);
		if(!$post){
			return null;
		}

		$user = Auth::user();
		$upvote = $user->upvotes()->where('post_id', $post_id)->first();
		if($upvote){
			$upvoted = $upvote->upvote;
			$update = true;
			if($upvoted == $is_upvote){
				$upvote->delete();
				return null;
			}
		}else{
			$upvote = new Upvote();
		}
		$upvote->upvote = $is_upvote;
		$upvote->user_id = $user->id;
		$upvote->post_id = $post->id;
		if($update){
			$upvote->update();
		}else{
			$upvote->save();
		}
		return null;
	}

}