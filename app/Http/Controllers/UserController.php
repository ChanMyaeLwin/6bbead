<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use Illuminate\Http\Request;
use App\User; 
use App\Role; 

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(\Auth::user()->can('super-admin')){
            return view('users.create');
        // }
        // abort('404');

    }
    /**
    * Get Specific clinic
    *
    * @param Clinic $clinic
    * @return void
    */
    public function show($id)
    {
        
        $user = User::findOrFail($id);
        return view('users.show',compact('user'));
    }

    /**
    * Get Specific clinic
    *
    * @param Clinic $clinic
    * @return void
    */
    public function assign($id)
    {
        $user = User::findOrFail($id);
        $role = Role::all();
        $userRole = $rolePermissions = \DB::table("model_has_roles")->where("model_has_roles.model_id",$id)
        ->pluck('model_has_roles.role_id','model_has_roles.role_id')
        ->all();
        return view('users.assign',compact('user','role','userRole'));
    }

    public function store_assign(userstoreRequest $request,$id)
    {
        // dd($request,$id);
        $roles = $request['role'];

            $user = User::findOrFail($id);

            foreach ($roles as $key => $role )
            {   
                $role = Role::find($role);
                // dd($role);
                $user->assignRole($role['name']);
            } 
            
            return redirect()->route('users.index')
            ->with('success','User is assigned successfully');  
    }

    /**
     * Store user 
     *
     * @param userstoreRequest $request
     * @return void
     */
    public function store(userstoreRequest $request)
    {
        // dd($request);
            $user = user::create($request->all());
            return redirect()->route('users.index')
            ->with('success','user is created successfully');  
    }

    public function edit($id){
        $user = user::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update user
     *
     * @param userUpdateRequest $request
     * @return void
     */
    public function update(userUpdateRequest $request,$id)
    {
            $user = user::findOrFail($id);
            $user->fill($request->all())->save();
            return redirect()->route('users.index')
            ->with('success','user is updated successfully');
      }

    public function destroy($id)
    {
        $user = user::findOrFail($id);
        // dd($user);
        $user = $user->delete();
        return redirect()->route('users.index')
        ->with('success','user is delected successfully');
    }

}
