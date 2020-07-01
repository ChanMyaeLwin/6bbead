<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\RolestoreRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use Illuminate\Http\Request;
use App\Plan; 
use App\Role;
use App\Permission;

class RoleController extends Controller
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
        $roles = Role::orderBy('id','DESC')->with('permissions')->paginate(5);
        // dd($roles);
        // foreach ($roles as $key => $role){
        //    dd($role->permissions);
        // }

        return view('roles.index',compact('roles'))
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
           
            $permission = Permission::orderBy('name')->get();
            return view('roles.create',compact('permission'));
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
        
        $role = Role::with('permissions')->findOrFail($id);
        return view('roles.show',compact('role','permissions'));
    }

    /**
     * Store Role 
     *
     * @param RolestoreRequest $request
     * @return void
     */
    public function store(RolestoreRequest $request)
    {
        $permissions = $request['permission'];

            $role = Role::create(['name' =>$request['roles_name'], 'guard_name'=>'web']);

            foreach ($permissions as $key => $permission )
            {   
                $permission = Permission::find($permission);
                $role->givePermissionTo($permission['name']);
            } 
            
            return redirect()->route('roles.index')
            ->with('success','Role is created successfully');  
    }

    public function edit($id){
        $role = Role::with('permissions')->findOrFail($id);
        $permission = Permission::orderBy('name')->get();
        $rolePermissions = \DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        // dd($role->permissions);
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update Plan
     *
     * @param RoleUpdateRequest $request
     * @return void
     */
    public function update(RoleUpdateRequest $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
      }

    public function destroy($id)
    {
        \DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

}
