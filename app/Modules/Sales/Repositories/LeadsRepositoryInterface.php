<?php

namespace Sales\Repositories;

interface LeadsRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function saveData($id = null,$request);
    public function deleteData($id);
    public function searchData($search);
    public function addFollowLead($request);
    public function showFollows();
}
