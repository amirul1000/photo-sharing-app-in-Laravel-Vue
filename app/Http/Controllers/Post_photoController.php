<?php

namespace App\Http\Controllers;

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

class Post_photoController extends Controller
{
    /**
     * Display a listing of the resource of post_photo.
     */
    public function index()
    {
         $post_photo = Post_photo::paginate(10);
         return view('post_photo.index',['post_photo'=>$post_photo]); 
    }
	
	 public function get_all(Request $request)
    {
         $post_photo = DB::table('post_photos')->where( 'post_id', '=', $request->id)->get();
		 return response()->json($post_photo);
         //return view('post_photo.index',['post_photo'=>$post_photo]); 
    }


    /**
     * Show the form for creating a new resource  of post_photo.
     */
    public function create()
    {
        return view('post_photo.add'); 
    }

    /**
     * Store a newly created resource in storage  of post_photo.
     */
    public function store(Request $request): RedirectResponse
    {
		$post_photo =  new post_photo;
		
        
						              if ($request->hasFile('file_upload')) {
						                $file = $request->file('file_upload');
										$destinationPath = 'uploads/post_photo';
										if (!is_dir($destinationPath)) {
											mkdir($destinationPath, 0777, TRUE);
										}
										chmod($destinationPath, 0777);
												
										$originalFile = $file->getClientOriginalName();
										$file->move($destinationPath, $originalFile);
										$post_photo->file_upload  = $destinationPath.'/'.$originalFile;
										}
        
		$post_photo->post_id  = $request->post_id;

		$post_photo->save();
		
		return redirect()->route('post_photo.index')
                        ->with('success','Post_photo has been created successfully.');
    }

    /**
     * Display the specified resource of post_photo.
     */
    public function show(Post_photo $post_photo,$id)
    {
		$post_photo = $post_photo::find($id);
        return view('post_photo.show',['post_photo'=>$post_photo]);
    }

    /**
     * Show the form for editing the specified resource  of post_photo.
     */
    public function edit(Post_photo $post_photo,$id)
    {
		$post_photo = $post_photo::find($id);
        return view('post_photo.edit',['post_photo'=>$post_photo]);
    }

    /**
     * Update the specified resource in storage of post_photo.
     */
    public function update(Request $request, Post_photo $post_photo,$id)
    {
		 $post_photo =  $post_photo::find($id);
		 
		
						              if ($request->hasFile('file_upload')) {
						                $file = $request->file('file_upload');
										$destinationPath = 'uploads/post_photo';
										if (!is_dir($destinationPath)) {
											mkdir($destinationPath, 0777, TRUE);
										}
										chmod($destinationPath, 0777);
												
										$originalFile = $file->getClientOriginalName();
										$file->move($destinationPath, $originalFile);
										$post_photo->file_upload  = $destinationPath.'/'.$originalFile;
										}
       
		$post_photo->post_id  = $request->post_id;

		$post_photo->save();
		
		return redirect()->route('post_photo.index')
                        ->with('success','Post_photo has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage of post_photo.
     */
    public function destroy(Post_photo $post_photo,$id)
    {
		$post_photo = post_photo::find($id);
        $post_photo->delete();
	   
        return redirect()->route('post_photo.index')
                        ->with('success','Post_photo has been deleted successfully.');
    }
	
	/**
	* Search of post_photo
	*/
	public function search(Request $request){
	  if (! empty($request->key)) {
            $key = $request->key;
            session(['key' =>  $key]);
        } else {
            $key = session('key');
        }

	   
	  $post_photo = post_photo::where('post_id', 'LIKE', '%' . $key . '%')

			 ->paginate(10);
	  return view('post_photo.index',['post_photo'=>$post_photo]); 
	}
	
	 /**
	 * Export CSV of post_photo
	 */
	function CSV(){
          // file name
		   $filename = 'post_photo_'.date('Ymd').'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
		   $post_photo = post_photo::all();

		   // file creation
		   $file = fopen('php://output', 'w');
		
		   $header = array('id', 'post_id', 'file_upload', 'created_at', 'updated_at');
		   fputcsv($file, $header); 
		
		   foreach ($post_photo as $c){
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
	* Print out mPdf of post_photo
	*/
    function Pdf(){
		require_once base_path('vendor').'/autoload.php';

		$post_photo = post_photo::all();

		// get the HTML
		ob_start();
		include(resource_path('views').'/post_photo/print.blade.php');
		$html = ob_get_clean();

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	  }
	
}
