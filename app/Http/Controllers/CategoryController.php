<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource of category.
     */
    public function index()
    {
         $category = Category::paginate(10);
        // return view('category.index',['category'=>$category]); 
		return response()->json($category);
		//return response(['status' => 'success', 'category' => Category::all(), 'code' => 200]);

    }
	/*
	* drop down
	*/
	public function get_all()
    {
         $category = Category::all();
        // return view('category.index',['category'=>$category]); 
		return response()->json($category);
		//return response(['status' => 'success', 'category' => Category::all(), 'code' => 200]);

    }
	

    /**
     * Show the form for creating a new resource  of category.
     */
    public function create()
    {
        return view('category.add'); 
    }

    /**
     * Store a newly created resource in storage  of category.
     */
    public function store(Request $request)//: RedirectResponse
    {
		$category =  new category;
        
		$category->cat_name  = $request->cat_name;
        $category->description  = $request->description;
		$category->save();
		
		/*return redirect()->route('category.index')
                        ->with('success','Category has been created successfully.');*/
		return response(['status' => 'success', 'category' => $category, 'code' => 200]);
    }

    /**
     * Display the specified resource of category.
     */
    public function show(Category $category,$id)
    {
		$category = $category::find($id);
        return view('category.show',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource  of category.
     */
    public function edit(Category $category,$id)
    {
		$category = $category::find($id);
        //return view('category.edit',['category'=>$category]);
		return response(['status' => 'success', 'category' => $category, 'code' => 200]);
    }

    /**
     * Update the specified resource in storage of category.
     */
    public function update(Request $request)//, Category $category,$id)
    {
		$category =  Category::find($request->id);
		$category->cat_name  = $request->cat_name;
        $category->description  = $request->description;
		$category->save();
		
		/*return redirect()->route('category.index')
                        ->with('success','Category has been updated successfully.');*/
		
		return response(['status' => 'success', 'category' => $category, 'code' => 200]);
    }

    /**
     * Remove the specified resource from storage of category.
     */
    public function destroy(Category $category,$id)
    {
		$category = category::find($id);
        $category->delete();	   
        /*return redirect()->route('category.index')
                        ->with('success','Category has been deleted successfully.');*/		
        return response(['status' => 'success', 'message' => 'deleted successfully', 'code' => 200]);	
    }
	
	/**
	* Search of category
	*/
	public function search(Request $request){
	  if (! empty($request->key)) {
            $key = $request->key;
            session(['key' =>  $key]);
        } else {
            $key = session('key');
        }

	   
	  $category = category::where('cat_name', 'LIKE', '%' . $key . '%')
				->orwhere('description', 'LIKE', '%' . $key . '%')

			 ->paginate(10);
	  //return view('category.index',['category'=>$category]); 
	  return response()->json($category);	
	}
	
	 /**
	 * Export CSV of category
	 */
	function CSV(){
          // file name
		   $filename = 'category_'.date('Ymd').'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
		   $category = category::all();

		   // file creation
		   $file = fopen('php://output', 'w');
		
		   $header = array('id', 'cat_name', 'description', 'created_at', 'updated_at');
		   fputcsv($file, $header); 
		
		   foreach ($category as $c){
			        $line = array();
				   $line[]  = $c->id;
					$line[]  = $c->cat_name;
					$line[]  = $c->description;
					$line[]  = $c->created_at;
					$line[]  = $c->updated_at;
 
			   
			fputcsv($file,$line);
		   }
		   fclose($file);
		   exit;
   }
	/**
	* Print out mPdf of category
	*/
    function Pdf(){
		require_once base_path('vendor').'/autoload.php';

		$category = category::all();

		// get the HTML
		ob_start();
		include(resource_path('views').'/category/print.blade.php');
		$html = ob_get_clean();

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	  }
	
}
