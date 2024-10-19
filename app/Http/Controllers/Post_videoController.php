<?php

namespace App\Http\Controllers;

use App\Models\Post_video;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Post_videoController extends Controller
{
    /**
     * Display a listing of the resource of post_video.
     */
    public function index()
    {
         $post_video = Post_video::paginate(10);
         return view('post_video.index',['post_video'=>$post_video]); 
    }

    /**
     * Show the form for creating a new resource  of post_video.
     */
    public function create()
    {
        return view('post_video.add'); 
    }

    /**
     * Store a newly created resource in storage  of post_video.
     */
    public function store(Request $request): RedirectResponse
    {
		$post_video =  new post_video;
		
        
						              if ($request->hasFile('file_upload')) {
						                $file = $request->file('file_upload');
										$destinationPath = 'uploads/post_video';
										if (!is_dir($destinationPath)) {
											mkdir($destinationPath, 0777, TRUE);
										}
										chmod($destinationPath, 0777);
												
										$originalFile = $file->getClientOriginalName();
										$file->move($destinationPath, $originalFile);
										$post_video->file_upload  = $destinationPath.'/'.$originalFile;
										}
        
		$post_video->post_id  = $request->post_id;

		$post_video->save();
		
		return redirect()->route('post_video.index')
                        ->with('success','Post_video has been created successfully.');
    }

    /**
     * Display the specified resource of post_video.
     */
    public function show(Post_video $post_video,$id)
    {
		$post_video = $post_video::find($id);
        return view('post_video.show',['post_video'=>$post_video]);
    }

    /**
     * Show the form for editing the specified resource  of post_video.
     */
    public function edit(Post_video $post_video,$id)
    {
		$post_video = $post_video::find($id);
        return view('post_video.edit',['post_video'=>$post_video]);
    }

    /**
     * Update the specified resource in storage of post_video.
     */
    public function update(Request $request, Post_video $post_video,$id)
    {
		 $post_video =  $post_video::find($id);
		 
		
						              if ($request->hasFile('file_upload')) {
						                $file = $request->file('file_upload');
										$destinationPath = 'uploads/post_video';
										if (!is_dir($destinationPath)) {
											mkdir($destinationPath, 0777, TRUE);
										}
										chmod($destinationPath, 0777);
												
										$originalFile = $file->getClientOriginalName();
										$file->move($destinationPath, $originalFile);
										$post_video->file_upload  = $destinationPath.'/'.$originalFile;
										}
       
		$post_video->post_id  = $request->post_id;

		$post_video->save();
		
		return redirect()->route('post_video.index')
                        ->with('success','Post_video has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage of post_video.
     */
    public function destroy(Post_video $post_video,$id)
    {
		$post_video = post_video::find($id);
        $post_video->delete();
	   
        return redirect()->route('post_video.index')
                        ->with('success','Post_video has been deleted successfully.');
    }
	
	/**
	* Search of post_video
	*/
	public function search(Request $request){
	  if (! empty($request->key)) {
            $key = $request->key;
            session(['key' =>  $key]);
        } else {
            $key = session('key');
        }

	   
	  $post_video = post_video::where('post_id', 'LIKE', '%' . $key . '%')

			 ->paginate(10);
	  return view('post_video.index',['post_video'=>$post_video]); 
	}
	
	 /**
	 * Export CSV of post_video
	 */
	function CSV(){
          // file name
		   $filename = 'post_video_'.date('Ymd').'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
		   $post_video = post_video::all();

		   // file creation
		   $file = fopen('php://output', 'w');
		
		   $header = array('id', 'post_id', 'file_upload', 'created_at', 'updated_at');
		   fputcsv($file, $header); 
		
		   foreach ($post_video as $c){
			        $line = array();
				   $line[]  = $c->id;
$line[]  = $c->post_id;
$line[]  = $c->file_upload;
$line[]  = $c->created_at;
$line[]  = $c->updated_at;
 
			   
			fputcsv($file,$line);
		   }
		   fclose($file);
		   exit;
   }
	/**
	* Print out mPdf of post_video
	*/
    function Pdf(){
		require_once base_path('vendor').'/autoload.php';

		$post_video = post_video::all();

		// get the HTML
		ob_start();
		include(resource_path('views').'/post_video/print.blade.php');
		$html = ob_get_clean();

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	  }
	
}
