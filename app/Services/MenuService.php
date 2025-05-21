<?php
namespace App\Services;
use App\Models\Menu;

class MenuService
{
    protected $MenuModel;

    public function __construct(Menu $MenuModel)
    {
        $this->MenuModel = $MenuModel;
    }

    public function list()
    {
        return  $this->MenuModel->whereNull('deleted_at');
    }

    public function all()
    {
        return  $this->MenuModel->whereNull('deleted_at')->all();
    }

    public function find($id)
    {
        return  $this->MenuModel->find($id);
    }

    public function create(array $data)
    {
        return  $this->MenuModel->create($data);
    }

    public function update(array $data, $id)
    {
        $dataInfo =  $this->MenuModel->findOrFail($id);

        $dataInfo->update($data);

        return $dataInfo;
    }

    public function delete($id)
    {
        $dataInfo =  $this->MenuModel->find($id);

        if (!empty($dataInfo)) {

            $dataInfo->deleted_at = date('Y-m-d H:i:s');

            $dataInfo->status = 'Deleted';

            return ($dataInfo->save());
        }
        return false;
    }

    public function changeStatus($id,$status)
    {
        $dataInfo =  $this->MenuModel->findOrFail($id);
        $dataInfo->status = $status;
        $dataInfo->update();

        return $dataInfo;
    }

    public function AdminExists($userName)
    {
        return  $this->MenuModel->whereNull('deleted_at')
            ->where(function ($q) use ($userName) {
                $q->where('email', strtolower($userName))
                    ->orWhere('phone', $userName);
            })->first();

    }


    public function activeList()
    {
        return  $this->MenuModel->whereNull('deleted_at')->where('status', 'Active')->get();
    }

}

    