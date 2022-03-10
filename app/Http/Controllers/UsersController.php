<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;

use Auth;
use Hash;
use Validator;
use Mail;

use App\Lib\Image;
use App\Lib\ImageRepository;
use App\User;



class UsersController extends Controller
{

	protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }



    public function index(Request $request)
    {	
        $this->authorize('index', User::class);

        $deleted = User::onlyTrashed()->count();

        $authUser = $request->user();
        $users = User::orderBy('role', 'asc');

        if($authUser->isSuperAdmin())
            $list = $users->orderBy('name', 'asc')->get();
        elseif($authUser->isAdmin())
            $list = $users->where('role','!=', 'superadmin')->orderBy('name', 'asc')->get();
        elseif($authUser->isUser())
            $list = $users->where('role', 'user')->orderBy('name', 'asc')->get();

        return view('admin.pages.users.listing')->with('users', $list)->with('deleted', $deleted);
    }

    public function deleted(Request $request)
    {
        
        $this->authorize('index', User::class);

        $authUser = $request->user();
        $users = User::onlyTrashed()->orderBy('role', 'asc');

        if($authUser->isSuperAdmin())
            $list = $users->orderBy('name', 'asc')->get();
        elseif($authUser->isAdmin())
            $list = $users->where('role','!=', 'superadmin')->orderBy('name', 'asc')->get();
        elseif($authUser->isUser())
            $list = $users->where('role', 'user')->orderBy('name', 'asc')->get();

        return view('admin.pages.users.deleted')->with('users', $list);
    }


    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        return redirect()->route('users.index');
    }

	public function edit(User $user){ 

        $this->authorize('update', $user);

		return view('admin.pages.users.edit')->with('user', $user);

	}


    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $user = new User();
        $user->name = ucfirst(strtolower($request->name));
        $user->surname = ucfirst(strtolower($request->surname));
        $user->gender = $request->gender;
        $user->email = strtolower($request->newemail);
        $user->role = $request->role;
        $user->password = Hash::make($request->pwd);
        $user->save();

        if(isset($request->send)){
            Mail::send('email.out-auth-new_user-2b', ['user' => $user, 'password' => $request->pwd ], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject(trans('email.obj-new-user'));
            });
        }

        return redirect()->route('users.edit', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return redirect()->route('users.edit', ['user' => $user]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        $this->authorize('update', $user);

        $user->name = ucfirst(strtolower($request->name));
        $user->surname = ucfirst(strtolower($request->surname));
        $user->gender = $request->gender;
        $user->email = strtolower($request->email);
        $user->role = $request->role;
        $user->timezone = $request->timezone;
        $user->lang = $request->lang;
        $user->save();
       
        //return back()->with('ok-update', 'Dati salvati con successo');

    }



	public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
    }


	public function restore(User $usertrash)
    {
        $usertrash->restore();
    }

    /*public function forceDestroy(User $usertrash)
    {   
        //CANCELLO IMMAGINI ASSOCIATE
        $images = $usertrash->images;
        foreach($images as $img){
            $this->image->delete( $img->id, $usertrash );
        }

        //FORZO CANCELLAZIONE ELEMENTO
        $usertrash->forceDelete();
        
    }*/



	//IMMAGINE PROFILO

    public function uploadImg(User $user)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $user);

        $img_id = $response->getData()->id;
        
        return $response;
    }

    public function getImg(User $user)
    {

        $images = $user->images;
        
        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'id' => $image->id,
                'server' => $image->filename,
                'size' => File::size(config('paths.users_img').$user->id."/".$image->filename)
            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }

    public function deleteImg(User $user)
    {
        $img_id = Input::get('id');

        if(!$img_id) { return 0; }

        $response = $this->image->delete( $img_id, $user );

        return $response;
       
    }


    public function checkEmail(Request $request, User $user){
        
        $response = true;

        if(isset($request->newemail)){
            if(User::withTrashed()->where('email', $request->newemail)->first()){
                $response = false;
            }
        }
        elseif(isset($request->email)){
            if(User::withTrashed()->where('email', $request->email)->where('id', '!=', $user->id)->first()){
                $response = false;
            }
        }
        
        echo json_encode(array(
            'valid' => $response,
        ));
    }



    public function changePassword(Request $request, User $user){

        if(Input::get('pwd') == Input::get('confirm_pwd')){
        	
            $new_pwd = Input::get('pwd');

    		$user->password = Hash::make($new_pwd);
    		$user->save();

            if(isset($request->send)){
                Mail::send('email.change-password', ['user' => $user, 'password' => $new_pwd ], function ($m) use ($user) {
                    $m->to($user->email, $user->name)->subject(trans('email.obj-change-pwd'));
                });
            }

        }else
            return false;

    }


}
