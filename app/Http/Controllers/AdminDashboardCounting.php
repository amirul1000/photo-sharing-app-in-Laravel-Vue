<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\post;
use App\Models\share;
use App\Models\User;
use App\Models\friend;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdminDashboardCounting extends Controller
{
     /**
     * Display a listing of the resource of category.
     */
    public function counting()
    {
         $category = Category::count();
		 $post = post::count();
		 $share = share::count();
		 $user = User::count();
		 $friend = friend::count();
		
		 $data = array('category'=>$category,
					   'post' =>$post,
					   'share' => $share,
					   'users' =>$user,
					   'friend' =>$friend 
					  );
        
		return response()->json($data);
		

    }
}
