<?php

namespace Departments\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Departments\Repositories\DepartmentsRepository;
use Crypt;

class DepartmentsController extends Controller
{
    public $path;
    private $departmentsRepository;

    public function __construct(DepartmentsRepository $departmentsRepository)
    {
        $this->middleware('auth');
        $this->path = 'Departments::';
        $this->departmentsRepository = $departmentsRepository;
    }

    public function index()
    {
        hasPermissions('show_departments');
        $title = transWord('Departments');
        $pages = [
            [transWord('Departments'),'departments']
        ];
        $departments = $this->departmentsRepository->allData();
        $users = $this->departmentsRepository->allUsers();
        return view($this->path.'index',compact('departments','pages','title','users'));
    }

    public function create()
    {
        hasPermissions('create_departments');
        $title = transWord('Create Departments');
        $pages = [
            [transWord('Departments'),'departments'],
            [transWord('Create Departments'),'create_departments']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(Request $request)
    {
        hasPermissions('create_departments');
        $this->departmentsRepository->saveData($request);
        return redirect()->route('departments')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_departments');
        $title = transWord('Update Departments');
        $pages = [
            [transWord('Departments'),'departments'],
            [transWord('Update Departments'),'#']
        ];
        $id = Crypt::decrypt($id);
        $department = $this->departmentsRepository->getDataId($id);
        return view($this->path.'edit',compact('pages','title','department'));
    }

    public function update($id,Request $request)
    {
        hasPermissions('update_departments');
        $id = Crypt::decrypt($id);
        $this->departmentsRepository->saveData($request,$id);
        return redirect()->route('departments')->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_departments');
        $title = transWord('Show Departments');
        $pages = [
            [transWord('Departments'),'departments'],
            [transWord('Show Departments'),'#']
        ];
        $id = Crypt::decrypt($id);
        $department = $this->departmentsRepository->getDataId($id);
        return view($this->path.'show',compact('pages','title','department'));
    }

    public function delete($id)
    {
        hasPermissions('delete_departments');
        $id = Crypt::decrypt($id);
        $this->departmentsRepository->deleteData($id);
        return redirect()->route('departments')->with('success','');
    }

    public function assignManagers($id,Request $request)
    {
        hasPermissions('assign_departments_manager');
        $id = Crypt::decrypt($id);
        $this->departmentsRepository->assignManagers($id,$request);
        return redirect()->route('departments')->with('success','');
    }

}
