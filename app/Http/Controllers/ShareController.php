<?php

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource of share.
     */
    public function index()
    {
         /*$share = Share::paginate(10);
		 return response()->json($share);*/
         //return view('share.index',['share'=>$share]);
		
		$post = DB::table('shares')
            ->leftJoin('users as a', 'a.id', '=', 'shares.from_user_id')
			->leftJoin('users as b', 'b.id', '=', 'shares.to_user_id')
            ->leftJoin('posts', 'posts.id', '=', 'shares.post_id')
            ->select('a.name as from_user','b.name as to_user', 'posts.title',
					 'shares.*')->paginate(10);
		
		return response()->json($post); 
		
    }

    /**
     * Show the form for creating a new resource  of share.
     */
    public function create()
    {
        return view('share.add'); 
    }

    /**
     * Store a newly created resource in storage  of share.
     */
    public function store(Request $request)//: RedirectResponse
    {
		$share =  new share;
		
		$share->from_user_id  = $request->from_user_id;
		$share->to_user_id  = $request->to_user_id;
		$share->post_id  = $request->post_id;
		$share->status  = $request->status;

		$share->save();
		
		return response(['status' => 'success', 'share' => $share, 'code' => 200]);
    }

    /**
     * Display the specified resource of share.
     */
    public function show(Share $share,$id)
    {
		$share = $share::find($id);
        return view('share.show',['share'=>$share]);
    }

    /**
     * Show the form for editing the specified resource  of share.
     */
    public function edit(Share $share,$id)
    {
		$share = $share::find($id);
        return response(['status' => 'success', 'share' => $share, 'code' => 200]);
    }

    /**
     * Update the specified resource in storage of share.
     */
    public function update(Request $request)//, Share $share,$id)
    {
		$share =  Share::find($request->id);
       
		$share->from_user_id  = $request->from_user_id;
		$share->to_user_id  = $request->to_user_id;
		$share->post_id  = $request->post_id;
		$share->status  = $request->status;

		$share->save();
		
		/*return redirect()->route('share.index')
                        ->with('success','Share has been updated successfully.');*/
		
		return response(['status' => 'success', 'share' => $share, 'code' => 200]);
    }

    /**
     * Remove the specified resource from storage of share.
     */
    public function destroy(Share $share,$id)
    {
		$share = share::find($id);
        $share->delete();
	   
       return response(['status' => 'success', 'message' => 'deleted successfully', 'code' => 200]);	
    }
	
	/**
	* Search of share
	*/
	public function search(Request $request){
	  if (! empty($request->key)) {
            $key = $request->key;
            session(['key' =>  $key]);
        } else {
            $key = session('key');
        }

	   
	  $share = share::where('from_user_id', 'LIKE', '%' . $key . '%')
				->orwhere('to_user_id', 'LIKE', '%' . $key . '%')
				->orwhere('post_id', 'LIKE', '%' . $key . '%')
				->orwhere('status', 'LIKE', '%' . $key . '%')
		        ->paginate(10);
	  return response()->json($share);	
	}
	
	 /**
	 * Export CSV of share
	 */
	function CSV(){
          // file name
		   $filename = 'share_'.date('Ymd').'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
		   $share = share::all();

		   // file creation
		   $file = fopen('php://output', 'w');
		
		   $header = array('id', 'from_user_id', 'to_user_id', 'post_id', 'status', 'created_at', 'updated_at');
		   fputcsv($file, $header); 
		
		   foreach ($share as $c){
			        $line = array();
				    $line[]  = $c->id;
					$line[]  = $c->from_user_id;
					$line[]  = $c->to_user_id;
					$line[]  = $c->post_id;
					$line[]  = $c->status;
					$line[]  = $c->created_at;
					$line[]  = $c->updated_at;
 
			   
			fputcsv($file,$line);
		   }
		   fclose($file);
		   exit;
   }
	/**
	* Print out mPdf of share
	*/
    function Pdf(){
		require_once base_path('vendor').'/autoload.php';

		$share = share::all();

		// get the HTML
		ob_start();
		include(resource_path('views').'/share/print.blade.php');
		$html = ob_get_clean();

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	  }
	
}
