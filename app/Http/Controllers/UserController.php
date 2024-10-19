<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

session_start();
use File;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user = User::paginate(10);
		 return response()->json($user);
         //return view('user.index',['user'=>$user]); 
    }
	
	
	 public function get_all()
    {
         $user = User::all();	
         //return view('user.index',['user'=>$user]);
		 return response()->json($user);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.add'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)//: RedirectResponse
    {
		$user =  new user;
		$user->name  = $request->name;
		$user->email  = $request->email;
		$user->role  = $request->role;
		$user->active  = $request->active;
		//$user->email_verified_at  = $request->email_verified_at;
		$user->password  = $request->password;
		//$user->remember_token  = $request->remember_token;

		$user->save();
		
		$this->add_picture($user,$user->id);
		
		return response(['status' => 'success', 'user' => $user, 'code' => 200]);
		
		/*return redirect()->route('user.index')
                        ->with('success','User has been created successfully.');*/
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user,$id)
    {
		$user = $user::find($id);
        return view('user.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user,$id)
    {
		$user = $user::find($id);
        /*return view('user.edit',['user'=>$user]);*/
		return response(['status' => 'success', 'member' => $user, 'code' => 200]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)//, User $user,$id)
    {
		$user =  User::find($request->id);
		$user->name  = $request->name;
		$user->email  = $request->email;
		$user->role  = $request->role;
		$user->active  = $request->active;
		//$user->email_verified_at  = $request->email_verified_at;
		$user->password  = $request->password;
		//$user->remember_token  = $request->remember_token;

		$user->save();
		
		$this->add_picture($user,$user->id);
		
		/*return redirect()->route('user.index')
                        ->with('success','User has been updated successfully.');*/
		return response(['status' => 'success', 'member' => $user, 'code' => 200]);
		
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
	
	function add_picture($user,$user_id)
    {
        foreach ($_SESSION as $key => $value) {
            if (substr($key, 0, strlen("file_tmp_name")) == "file_tmp_name") {
                $time = substr($key, strlen("file_tmp_name_"), strlen($key));

                $file_tmp_name = base64_decode($_SESSION["file_tmp_name_" . $time]);
                $file_file = $_SESSION["file_file_" . $time];

                if (! file_exists(base_path()."/public/uploads/profile/$user_id")) {
                    File::makeDirectory(base_path()."/public/uploads/profile/$user_id");
					 }
                $file = $user_id . "_" . str_replace(" ", "_", strtolower($file_file));

                
                $fp = fopen(base_path()."/public/uploads/profile/$user_id/" . $file,"w");
                fwrite($fp, $file_tmp_name);
                fclose($fp);
				
				//$user =  new User;	
                $user->profile_picture  = "uploads/profile/$user_id/" . $file;
		        //$user->id  = $user_id;
		        $user->save();

                unset($_SESSION["file_tmp_name_" . $time]);
                unset($_SESSION["file_file_" . $time]);

        }
       }
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,$id)
    {
		$user = user::find($id);
        $user->delete();
	   
        /*return redirect()->route('user.index')
                        ->with('success','User has been deleted successfully.');*/
		
		 return response(['status' => 'success', 'message' => 'deleted successfully', 'code' => 200]);	
    }
    
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            $token = Auth::attempt($credentials);
            if (!$token) {
                return response()->json(['error' => 'Invalid Credentials'], 400);
            }
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
        
    }
	
	
	public function register(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
			'user_type' =>'member', 
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        Auth::login($user);
		
		$credentials = $request->only('email', 'password');
        try {
            $token = Auth::attempt($credentials);
            if (!$token) {
                return response()->json(['error' => 'Invalid Credentials'], 400);
            }
        }
        catch (Exception $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
		
		 
		 $user = Auth::user();
			return response()->json([
				'status' => 'success',
				'user' => $user,
				'authorisation' => [
					'token' => $token,
					'type' => 'bearer',
				]
			]);
		
        
    }
    
}
