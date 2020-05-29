<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('acl.users.index',[
            'users'=> $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acl.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credential = $request->only(['name','email','password']);
        $credential['password'] = bcrypt($credential['password']);
        User::create($credential);
        return redirect()->route('user.index');
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
    public function edit(User $user)
    {
        return view('acl.users.edit',[
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }


    public function roles(User $user)
    {
        $roles = Role::all();

        foreach($roles as $role){
            if($user->hasRole($role->name)){
                $role->can = true;
            }else{
                $role->can = false;
            }
        }

        return view('acl.users.roles',[
            'user'=>$user,
            'roles'=>$roles
        ]);
    }

    public function rolesSync(Request $request, User $user)
    {
        $rolesRequest = $request->except(['_token','_method']);
        foreach($rolesRequest['roles'] as $key){
            $roles[] = Role::where('id',$key)->first();
        }
        if(!empty($roles)){
            $user->syncRoles($roles);
        }else{
            $user->syncRoles(null);
        }
        return redirect()->route('user.roles',[$user->id]);
    }

}
