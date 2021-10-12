<?php


namespace Roles\Repositories;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RoleRepositoryInterface
{
    public function allData(){
//        dd(Role::all());
        return Role::paginate(16);
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return Role::$wheres->get();
    }

    public function getDataId($id){
        return Role::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        if ($id == null) {
            if (Role::where('name',$request->name)->get()->count() == 0) {
                $role = Role::create(['name' => $request->name]);
//                saveLog('Add Role '.$role->name, 'Roles');
                return 'save';
            }else{
                return 'already';
            }
        }else{
            $role = Role::findOrfail($id);
            $role->name = $request->name;
            $role->save();
//            saveLog('Update Role '.$role->name, 'Roles');
            return 'update';
        }


    }

    public function deleteData($id)
    {
        $role = Role::findOrfail($id)->delete();
//        saveLog('Delete Role '.$user->name, 'Roles');
    }

    public function getPermissions($id){
        $role = Role::findOrfail($id);
        $permissions = Permission::all();
        $permssionsOfRole = Role::findByName($role->name)->permissions;
        $assignedPermissions = [];
        foreach ($permssionsOfRole as $permssion) {
            array_push($assignedPermissions,$permssion->id);
        }
        $permissionsName = [];
        foreach ($permissions as $p) {
            if (!in_array(explode('_',$p->name)[1],$permissionsName)) {
                array_push($permissionsName,explode('_',$p->name)[1]);
            }
        }

        return [
            $permissionsName,
            $role,
            $permissions,
            $assignedPermissions
        ];

    }

    public function getUserPermissions($id){
        $user = User::findOrfail($id);
        $permissions = Permission::all();
        $permissionsOfUser = $user->getAllPermissions();
        $assignedPermissions = [];
        foreach ($permissionsOfUser as $permssion) {
            array_push($assignedPermissions,$permssion->id);
        }
        $permissionsName = [];
        foreach ($permissions as $p) {
            if (!in_array(explode('_',$p->name)[1],$permissionsName)) {
                array_push($permissionsName,explode('_',$p->name)[1]);
            }
        }

        return [
            $permissionsName,
            $user,
            $permissions,
            $assignedPermissions
        ];

    }

    public function assignPermissions($id,$request){
        if ($request->ajax()) {
            // dd($request->permissions);
            if(isset($request->permissions)){
                $role = $this->getDataId($request->role_id);
                $role->syncPermissions();
                foreach ($request->permissions as $permission) {
                    $role->givePermissionTo(Permission::findOrfail($permission)->name);
                }
            }
            if($request->permissions == null){
                $role = Role::findOrfail($request->role_id);
                $role->syncPermissions();
            }
            return response()->json('200');
        }
    }

    public function assignUserPermissions($id,$request){
        if ($request->ajax()) {
            // dd($request->permissions);
            if(isset($request->permissions)){
                $user = User::findOrfail($id);
                $user->syncPermissions();
                foreach ($request->permissions as $permission) {
                    $user->givePermissionTo(Permission::findOrfail($permission)->name);
                }
            }
            if($request->permissions == null){
                $user = User::findOrfail($id);
                $user->syncPermissions();
            }
            return response()->json('200');
        }
    }
}
