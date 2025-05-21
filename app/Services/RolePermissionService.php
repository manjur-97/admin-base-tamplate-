<?php
namespace App\Services;
use App\Models\RolePermission;

class RolePermissionService
{
    protected $RolePermissionModel;

    public function __construct(RolePermission $RolePermissionModel)
    {
        $this->RolePermissionModel = $RolePermissionModel;
    }

    public function listOfRolePermissions($role_id)
    {
        return  $this->RolePermissionModel->where('role_id',$role_id )->get();
    }

    public function all()
    {
        return  $this->RolePermissionModel->whereNull('deleted_at')->all();
    }

    public function find($id)
    {
        return  $this->RolePermissionModel->find($id);
    }

    public function store(array $data)
    {
        return  $this->RolePermissionModel->create($data);
    }

    public function update(array $data, $id)
    {
        $dataInfo =  $this->RolePermissionModel->findOrFail($id);

        $dataInfo->update($data);

        return $dataInfo;
    }

    public function delete($id)
    {
        $dataInfo =  $this->RolePermissionModel->find($id);

        $dataInfo->delete();
    }

 




   

}

    