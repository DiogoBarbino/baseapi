<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('acl.roles.index',[
            'roles'=> $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acl.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role;
        $role->name = $request->guard_name.'-'.$request->name;
        $role->guard_name = $request->guard_name;
        $role->save();
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('acl.roles.edit',[
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Role $role)
    {
        $role->name = $request->guard_name.'-'.$request->name;
        $role->guard_name = $request->guard_name;
        $role->save();
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index');
    }

    public function permissions(Role $role)
    {
        $permissions = Permission::where('guard_name',$role->guard_name)->get();

        foreach($permissions as $permission){
            if($role->hasPermissionTo($permission->name,$role->guard_name)){
                $permission->can = true;
            }else{
                $permission->can = false;
            }
        }

        return view('acl.roles.permissions',[
            'role'=>$role,
            'permissions'=>$permissions
        ]);
    }

    public function permissionsSync(Request $request, Role $role)
    {
        $permissionsRequest = $request->except(['_token','_method']);
        foreach($permissionsRequest['permissions'] as $key){
            $permissions[] = Permission::where('id',$key)->first();
        }
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }else{
            $role->syncPermissions(null);
        }
        return redirect()->route('role.permissions',[$role->id]);
    }
}
