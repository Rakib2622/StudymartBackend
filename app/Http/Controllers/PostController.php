<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\post;
class PostController extends Controller
{
    public function getAllpost() {
      $post = post::get()->toJson(JSON_PRETTY_PRINT);
      return response($post, 200);

  }


public function getpost($id) {
      if (post::where('id', $id)->exists()) {
        $post = post::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($post, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createpost(Request $request)
   {
    $post = new post();
    $post->content = $request->input('content');
    $post->user_id = $request->input('user_id');
    $post->vote_id = $request->input('vote_id');



   $post->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updatepost(Request $request, $id) {
      if (post::where('id', $id)->exists()) {
        $post= post::find($id);

        $post->content = is_null($request->content) ? $post->content : $request->content;
        $post->user_id = is_null($request->user_id) ? $post->user_id : $request->user_id;
        $post->vote_id = is_null($request->vote_id) ? $post->vote_id : $request->vote_id;


        $post->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deletepost ($id) {
      if(post::where('id', $id)->exists()) {
        $post = post::find($id);
        $post->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }
}
