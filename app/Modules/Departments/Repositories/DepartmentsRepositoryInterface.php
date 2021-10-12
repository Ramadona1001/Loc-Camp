<?php

namespace Departments\Repositories;

interface DepartmentsRepositoryInterface
{
    public function allData();

    public function dataWithConditions($conditions);

    public function getDataId($id);

    public function saveData($request);

    public function allUsers();

    public function assignManagers($id,$request);

    public function deleteData($id);
}
