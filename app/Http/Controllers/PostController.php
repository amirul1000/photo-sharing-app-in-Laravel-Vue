<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post_photo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
session_start();
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource of post.
     */
    public function index()
    {
         //$post = Post::paginate(10);
		 //return response()->json($post);
         //return view('post.index',['post'=>$post]); 
		
		$post = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
			//->join('post_photos', 'post_photos.post_id', '=', 'posts.id')
            ->select('users.name', 'categories.cat_name',
					 'posts.*')->paginate(10);
		
		return response()->json($post);
		
    }
	
	 public function get_all()
    {
         $post = Post::all();	
         //return view('user.index',['user'=>$user]);
		 return response()->json($post);
    }


    /**
     * Show the form for creating a new resource  of post.
     */
    public function create()
    {
        return view('post.add'); 
    }

    /**
     * Store a newly created resource in storage  of post.
     */
    public function store(Request $request)//: RedirectResponse
    {
		$post =  new post;
        
		$post->user_id  = $request->user_id;
		$post->category_id  = $request->category_id;
		$post->title  = $request->title;
		$post->description  = $request->description;

		$post->save();
		
		/*return redirect()->route('post.index')
                        ->with('success','Post has been created successfully.');*/
		$this->add_picture($post->id);
		
		return response(['status' => 'success', 'post' => $post, 'code' => 200]);
    }

    /**
     * Display the specified resource of post.
     */
    public function show(Post $post,$id)
    {
		$post = $post::find($id);
        return view('post.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource  of post.
     */
    public function edit(Post $post,$id)
    {
		$post = $post::find($id);
        //return view('post.edit',['post'=>$post]);
		return response(['status' => 'success', 'post' => $post, 'code' => 200]);
    }

    /**
     * Update the specified resource in storage of post.
     */
    public function update(Request $request)//, Post $post,$id)
    {
		$post =  Post::find($request->id);
		$post->user_id  = $request->user_id;
		$post->category_id  = $request->category_id;
		$post->title  = $request->title;
		$post->description  = $request->description;

		$post->save();
		
		$this->add_picture($post->id);
		//return redirect()->route('post.index')
                //        ->with('success','Post has been updated //successfully.');
		
		return response(['status' => 'success', 'post' => $post, 'code' => 200]);
    }
	
	
	
	function photo_upload(Request $request)
    {
		  if (! empty($_FILES)) {

            if (strlen($_FILES['file']['name']) > 0 && $_FILES['file']['size'] > 0) {
                $time = time() . rand(0, 100) . rand(0, 100);
                $_SESSION['file_tmp_name_' . $time] = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
                $_SESSION['file_file_' . $time] = $_FILES['file']['name'];
                echo json_encode(array(
                    'success' => true
                ));
                exit();
            }
        } 
    }
	
	function add_picture($post_id)
    {
        foreach ($_SESSION as $key => $value) {
            if (substr($key, 0, strlen("file_tmp_name")) == "file_tmp_name") {
                $time = substr($key, strlen("file_tmp_name_"), strlen($key));

                $file_tmp_name = base64_decode($_SESSION["file_tmp_name_" . $time]);
                $file_file = $_SESSION["file_file_" . $time];

                if (! file_exists(base_path()."/public/uploads/$post_id")) {
                    File::makeDirectory(base_path()."/public/uploads/$post_id");
					 }
                $file = $post_id . "_" . str_replace(" ", "_", strtolower($file_file));

                
                $fp = fopen(base_path()."/public/uploads/$post_id/" . $file,"w");
                fwrite($fp, $file_tmp_name);
                fclose($fp);
				
				$post_photo =  new post_photo;	
                $post_photo->file_upload  = "uploads/$post_id/" . $file;
		        $post_photo->post_id  = $post_id;
		        $post_photo->save();

                unset($_SESSION["file_tmp_name_" . $time]);
                unset($_SESSION["file_file_" . $time]);

        }
       }
	}

    /**
     * Remove the specified resource from storage of post.
     */
    public function destroy(Post $post,$id)
    {
		$post = post::find($id);
        $post->delete();
	   
        /*return redirect()->route('post.index')
                        ->with('success','Post has been deleted successfully.');*/
		return response(['status' => 'success', 'message' => 'deleted successfully', 'code' => 200]);	
		
    }
	
	/**
	* Search of post
	*/
	public function search(Request $request){
	  if (! empty($request->key)) {
            $key = $request->key;
            session(['key' =>  $key]);
        } else {
            $key = session('key');
        }

	   
	  $post = post::where('user_id', 'LIKE', '%' . $key . '%')
					->orwhere('category_id', 'LIKE', '%' . $key . '%')
					->orwhere('title', 'LIKE', '%' . $key . '%')
					->orwhere('description', 'LIKE', '%' . $key . '%')

			 ->paginate(10);
	 // return view('post.index',['post'=>$post]); 
		return response()->json($post);	
	}
	
	 /**
	 * Export CSV of post
	 */
	function CSV(){
          // file name
		   $filename = 'post_'.date('Ymd').'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
		   $post = post::all();

		   // file creation
		   $file = fopen('php://output', 'w');
		
		   $header = array('id', 'user_id', 'category_id', 'title', 'description', 'created_at', 'updated_at');
		   fputcsv($file, $header); 
		
		   foreach ($post as $c){
			        $line = array();
				   $line[]  = $c->id;
					$line[]  = $c->user_id;
					$line[]  = $c->category_id;
					$line[]  = $c->title;
					$line[]  = $c->description;
					$line[]  = $c->created_at;
					$line[]  = $c->updated_at;

			   
			fputcsv($file,$line);
		   }
		   fclose($file);
		   exit;
   }
	/**
	* Print out mPdf of post
	*/
    function Pdf(){
		require_once base_path('vendor').'/autoload.php';

		$post = post::all();

		// get the HTML
		ob_start();
		include(resource_path('views').'/post/print.blade.php');
		$html = ob_get_clean();

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	  }
	
}
