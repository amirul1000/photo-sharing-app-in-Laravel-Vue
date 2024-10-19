<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource of friend.
     */
    public function index()
    {
         $friend = DB::table('friends')
            ->join('users as a', 'a.id', '=', 'friends.from_user_id')
			->join('users as b', 'b.id', '=', 'friends.to_user_id')
            ->select('a.name as from_user_name', 'b.name as to_user_name',
					 'friends.*')->paginate(10);
		 return response()->json($friend);
         //return view('friend.index',['friend'=>$friend]); 
    }

    /**
     * Show the form for creating a new resource  of friend.
     */
    public function create()
    {
        return view('friend.add'); 
    }

    /**
     * Store a newly created resource in storage  of friend.
     */
    public function store(Request $request)//: RedirectResponse
    {
		$friend =  new friend;
		$friend->from_user_id  = $request->from_user_id;
		$friend->to_user_id  = $request->to_user_id;
		$friend->status  = $request->status;
		$friend->active  = $request->active;
		$friend->save();
		
		/*return redirect()->route('friend.index')
                        ->with('success','Friend has been created successfully.');*/
		return response(['status' => 'success', 'friend' => $friend, 'code' => 200]);
    }

    /**
     * Display the specified resource of friend.
     */
    public function show(Friend $friend,$id)
    {
		$friend = $friend::find($id);
        return view('friend.show',['friend'=>$friend]);
    }

    /**
     * Show the form for editing the specified resource  of friend.
     */
    public function edit(Friend $friend,$id)
    {
		$friend = $friend::find($id);
        //return view('friend.edit',['friend'=>$friend]);
		return response(['status' => 'success', 'friend' => $friend, 'code' => 200]);
    }

    /**
     * Update the specified resource in storage of friend.
     */
    public function update(Request $request)//, Friend $friend,$id)
    {
		 $friend =  friend::find($request->id);
       
		$friend->from_user_id  = $request->from_user_id;
		$friend->to_user_id  = $request->to_user_id;
		$friend->status  = $request->status;
		$friend->active  = $request->active;

		$friend->save();
		
		/*return redirect()->route('friend.index')
                        ->with('success','Friend has been updated successfully.');*/
		return response(['status' => 'success', 'friend' => $friend, 'code' => 200]);
    }

    /**
     * Remove the specified resource from storage of friend.
     */
    public function destroy(Friend $friend,$id)
    {
		$friend = friend::find($id);
        $friend->delete();
	   
        /*return redirect()->route('friend.index')
                        ->with('success','Friend has been deleted successfully.');*/
		return response(['status' => 'success', 'message' => 'deleted successfully', 'code' => 200]);
    }
	
	/**
	* Search of friend
	*/
	public function search(Request $request){
	  if (! empty($request->key)) {
            $key = $request->key;
            session(['key' =>  $key]);
        } else {
            $key = session('key');
        }

	   
	  $friend = friend::where('from_user_id', 'LIKE', '%' . $key . '%')
->orwhere('to_user_id', 'LIKE', '%' . $key . '%')
->orwhere('status', 'LIKE', '%' . $key . '%')
->orwhere('active', 'LIKE', '%' . $key . '%')

			 ->paginate(10);
	  return view('friend.index',['friend'=>$friend]); 
	}
	
	 /**
	 * Export CSV of friend
	 */
	function CSV(){
          // file name
		   $filename = 'friend_'.date('Ymd').'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
		   $friend = friend::all();

		   // file creation
		   $file = fopen('php://output', 'w');
		
		   $header = array('id', 'from_user_id', 'to_user_id', 'status', 'active', 'created_at', 'updated_at');
		   fputcsv($file, $header); 
		
		   foreach ($friend as $c){
			        $line = array();
				   $line[]  = $c->id;
$line[]  = $c->from_user_id;
$line[]  = $c->to_user_id;
$line[]  = $c->status;
$line[]  = $c->active;
$line[]  = $c->created_at;
$line[]  = $c->updated_at;
 
			   
			fputcsv($file,$line);
		   }
		   fclose($file);
		   exit;
   }
	/**
	* Print out mPdf of friend
	*/
    function Pdf(){
		require_once base_path('vendor').'/autoload.php';

		$friend = friend::all();

		// get the HTML
		ob_start();
		include(resource_path('views').'/friend/print.blade.php');
		$html = ob_get_clean();

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	  }
	
}
