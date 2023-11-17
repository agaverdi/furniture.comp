<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionsController extends Controller
{
    public function index() : View
    {
        $user=auth('admin')->user()->permissions;

        $permissions = Permissions::where('user_id', '<>',auth('admin')->id())
            ->where('read','<=',$user->read)
            ->where('create','<=',$user->create)
            ->where('update','<=',$user->update)
            ->where('delete','<=',$user->delete)
            ->get();
        return view('backend.permission.index', compact('permissions'));
    }

    public function edit(string $id) : View|RedirectResponse
    {
        if ($id==auth('admin')->id()){
            return redirect()->route('backend.permission.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
        }
        if (auth('admin')->user()->is_admin>=3){
            $permission = Permissions::where('user_id', $id)->firstOrFail();
            return view('backend.permission.edit', compact('permission'));
        }
        return redirect()->route('backend.permission.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');
    }

    public function update(Request $request,string $id)
    {

        $user = User::findOrFail($id);
        $user_details = UserDetails::where('user_id', $id)->firstOrFail();
        $permission = Permissions::where('user_id',$id)->firstOrFail();
        $permission_count = count($request->only('create','read','delete','update'));

        //ozunden boyuk edde bilmez admin->superAdmin
        if ($permission_count > auth('admin')->user()->is_admin){
            return redirect()->route('backend.permission.edit', [$permission->user_id])->withSuccess('Sizin buna selahiyyetiniz yoxdur');
        }

        $permission->update([
            'create'=>isset($request->create)? 2 :0,
            'read'  => isset($request->read)? 1 :0,
            'update'  => isset($request->update)? 3 :0,
            'delete'  => isset($request->delete)? 4 :0,
        ]);


        $user->update([
            'is_admin'=>$permission_count,
        ]);

        $roles = [1 => 'User', 2 => 'SuperUser', 3 => 'Admin', 4 => 'SuperAdmin'];
        $role = $roles[$permission_count] ?? 'Unknown Role';

        $user_details->update([
           'position'=>$role,
        ]);


        return redirect()->route('backend.permission.index')->withSuccess('Yeniləmə uğurla nəticələndi');
    }

    public function destroy(Request $request,int $id){
        if (auth('admin')->user()->is_admin==4) {
            $user = User::findOrFail($id);
            $user_details = UserDetails::where('user_id', $id)->firstOrFail();
            $permission = Permissions::where('user_id', $id)->firstOrFail();
            $permission_count = count($request->only('create', 'read', 'delete', 'update'));

            $permission->update([
                'create' => 0,
                'read' => 0,
                'update' => 0,
                'delete' => 0,
            ]);

            $user->update([
                'is_admin' => 0,
            ]);

            $roles = [1 => 'User', 2 => 'SuperUser', 3 => 'Admin', 4 => 'SuperAdmin'];
            $role = $roles[$permission_count] ?? 'Unknown Role';
            $user_details->update([
                'position' => $role,
            ]);

            return redirect()->route('backend.permission.index')->withSuccess('təmizləmə uğurla nəticələndi');
        }
        else{
            return redirect()->route('backend.permission.index')->withSuccess('Sizin buna icazeniz yoxdur');
        }
    }
}
