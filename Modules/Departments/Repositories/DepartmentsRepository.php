<?php


namespace Departments\Repositories;

use App\User;
use Departments\Models\DepartmentManager;
use Departments\Models\Departments;
use File;

class DepartmentsRepository implements DepartmentsRepositoryInterface
{
    public function allData(){
        return Departments::paginate(9);
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return Departments::$wheres->get();
    }

    public function getDataId($id){
        return Departments::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        $title = json_encode($request->title);
        $content = json_encode($request->content);

        if ($id == null) {
            $department = new Departments();
        }else{
            $department = $this->getDataId($id);
        }

        $department->title = $title;
        $department->content = $content;
        $department->save();
    }

    public function deleteData($id)
    {
        $department = $this->getDataId($id);
        $department->delete();
    }

    public function allUsers()
    {
        return User::all();
    }

    public function assignManagers($id,$request)
    {
        $managers = $request->managers;
        if ($managers != null) {
            foreach ($managers as $manager) {
                \DB::select('delete from department_mangers where department_id = '.$id);
                if (!in_array($manager,getDepartmentManagersIds($id))) {
                    $departmentManager = new DepartmentManager();
                    $departmentManager->user_id = $manager;
                    $departmentManager->department_id = $id;
                    $departmentManager->save();
                }
            }
        }else{
            \DB::select('delete from department_mangers where department_id = '.$id);
        }
    }
}
