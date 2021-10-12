<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Spatie\Permission\Models\Role;
use File;
use Hash;
use Roles\Repositories\RoleRepository;

class UserController extends Controller
{
    public $path = 'pages.users.';
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        hasPermissions('show_users');
        $title = transWord('Users');
        $pages = [
            [transWord('Users'),'users']
        ];
        $users = User::whereHas("roles", function($q){ $q->where("name","<>", "Admin"); })->get();
        return view($this->path.'index',compact('users','pages','title'));
    }

    public function create()
    {
        hasPermissions('create_users');
        $title = transWord('Create New User');
        $pages = [
            [transWord('Users'),'users'],
            [transWord('Create New User'),'create_users']
        ];
        $roles = Role::all();
        return view($this->path.'create',compact('roles','pages','title'));
    }

    public function store(Request $request)
    {
        hasPermissions('create_users');
        $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6|max:255',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        foreach ($request->roles as $role) {
            $roleName = Role::findOrfail($role);
            $user->assignRole($roleName->name);
        }
        return redirect()->route('users')->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_users');
        $title =transWord('Show User Data');
        $user = User::findOrfail($id);
        $pages = [
            [transWord('Users'),'users'],
            [$user->name,'']
        ];
        return view($this->path.'show',compact('user','pages','title'));
    }

    public function premissions($id)
    {
        hasPermissions('premissions_users');
        $title =transWord('Assign Premssions To User');
        $user = User::findOrfail($id);
        $pages = [
            [transWord('Users'),'users'],
            [$user->name,'']
        ];
        $permissionsName = $this->roleRepository->getUserPermissions($id)[0];
        $user = $this->roleRepository->getUserPermissions($id)[1];
        $permissions = $this->roleRepository->getUserPermissions($id)[2];
        $assignedPermissions = $this->roleRepository->getUserPermissions($id)[3];

        return view($this->path.'permissions',compact('permissionsName','user','permissions','assignedPermissions','pages','title'));
    }

    public function assignPremissions(Request $request,$id)
    {
        hasPermissions('premissions_users');
        $this->roleRepository->assignUserPermissions($id,$request);
    }

    public function edit($id)
    {
        hasPermissions('update_users');
        $title =transWord('Edit User Data');
        $user = User::findOrfail($id);
        $showUrl = route('show_users', ['id'=>$user->id]);
        $pages = [
            [transWord('Users'),'users'],
            [$user->name,['show_users',$user->id]]
        ];
        $roles = Role::all();
        return view($this->path.'edit',compact('user','roles','pages','title'));
    }

    public function profile()
    {
        hasPermissions('show_users');
        $title =transWord('Edit My Profile');
        $user = Auth::user();
        $pages = [
            [transWord('My Profile'),''],
        ];
        $roles = Role::all();
        return view($this->path.'profile',compact('user','roles','pages','title'));
    }

    public function update($id,Request $request)
    {
        hasPermissions('update_users');
        $user = User::findOrfail($id);

        if ($request->password) {
            $request->validate([
                'name' => 'required|min:2|max:255',
                'email' => 'unique:users,email,'.$user->id,
                'password' => 'confirmed|min:6|max:255',
            ]);
        }else{
            $request->validate([
                'name' => 'required|min:2|max:255',
                'email' => 'unique:users,email,'.$user->id,
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $pathImage = public_path().'/uploads/backend/users/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);

        if ($request->hasFile('avatar')){
            if($user->avatar != 'avatar'){
                $image_path = public_path($user->avatar);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->move($pathImage, $imageName);
            $user->avatar = $imageName;
        }

        $user->save();

        if (isset($request->roles)) {
            foreach ($request->roles as $role) {
                $roleName = Role::findOrfail($role);
                $user->syncRoles($roleName->name);
            }
        }

        return redirect()->route('users')->with('success','');
    }

    public function destroy($id)
    {
        hasPermissions('delete_users');
        $user = User::findOrfail($id);
        if($user->avatar != 'avatar'){
            $image_path = public_path($user->avatar);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $user->delete();
        return redirect()->route('users')->with('success','');
    }

    public function logout()
    {
        if (!\Auth::user()->hasRole('Admin')) {
            $checkUserLoginCount = \DB::select('select * from student_login where user_id = '.\Auth::user()->id);
            $count = $checkUserLoginCount[0]->count;
            $count = $count - 1;
            \DB::select('update student_login set count = '.$count.' where user_id = '.\Auth::user()->id);
        }
        Auth::logout();
        return redirect()->route('website');
    }
}
