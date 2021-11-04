<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user.show');
        $this->middleware('permission:user.create')->only('create','store');
        $this->middleware('permission:user.edit')->only('edit','update');
        $this->middleware('permission:user.delete')->only('destroy');
    }

    public function index()
    {
        $users = User::whereKeyNot(auth()->id())->paginate();


        return inertia('Admin/User/Index', [
            'page_users' => $users
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return redirect()->route('admin.user.edit',$id);
    }

    public function edit($id)
    {
        $user = User::whereKeyNot(auth()->id())->findOrFail($id);
        $roles = Role::all();
        $perms = Permission::all();

        return inertia('Admin/User/Edit', [
            'page_user' => $user,
            'page_permissions' => $perms,
            'page_roles' => $roles
        ]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::whereKeyNot(auth()->id())->findOrFail($id);

        $user->update($request->validated());

        flash('Kullanıcı bilgileri güncellendi')->success();
        return back();
    }
    public function update_permission(Request $request, $id)
    {
        if(!$request->has('permissions')){
            flash('Yetki alanı gerekli.')->error();
            return back();
        }
        $user = User::whereKeyNot(auth()->id())->findOrFail($id);
        $perms = collect($request->input('permissions'))
            ->diff($user->getPermissionsViaRoles()->pluck('name'));

        $user->syncPermissions($perms);

        flash('Kullanıcı yetkileri güncellendi')->success();
        return back();
    }
    public function update_role(Request $request, $id)
    {
        if($request->input('role') === null){
            flash('Rol alanı gerekli.')->error();
            return back();
        }
        $user = User::whereKeyNot(auth()->id())->findOrFail($id);

        $user->syncRoles($request->input('role'));

        flash('Kullanıcı rolü güncellendi')->success();
        return back();
    }

    public function destroy($id)
    {
        //
    }
}
