<?php
namespace App\Services;
use App\Models\WebsiteMenu;

class WebsiteMenuService
{
    protected $WebsiteMenuModel;

    public function __construct(WebsiteMenu $WebsiteMenuModel)
    {
        $this->WebsiteMenuModel = $WebsiteMenuModel;
    }

    public function list()
    {
        return  $this->WebsiteMenuModel->whereNull('deleted_at');
    }

    public function all()
    {
        return  $this->WebsiteMenuModel->whereNull('deleted_at')->all();
    }

    public function find($id)
    {
        return  $this->WebsiteMenuModel->find($id);
    }

    public function create(array $data)
    {
        return  $this->WebsiteMenuModel->create($data);
    }

    public function update(array $data, $id)
    {
        $dataInfo =  $this->WebsiteMenuModel->findOrFail($id);

        $dataInfo->update($data);

        return $dataInfo;
    }

    public function delete($id)
    {
        $dataInfo =  $this->WebsiteMenuModel->find($id);

        if (!empty($dataInfo)) {

            $dataInfo->deleted_at = date('Y-m-d H:i:s');

            $dataInfo->status = 'Deleted';

            return ($dataInfo->save());
        }
        return false;
    }

    public function changeStatus($id,$status)
    {
        $dataInfo =  $this->WebsiteMenuModel->findOrFail($id);
        $dataInfo->status = $status;
        $dataInfo->update();

        return $dataInfo;
    }

    public function AdminExists($userName)
    {
        return  $this->WebsiteMenuModel->whereNull('deleted_at')
            ->where(function ($q) use ($userName) {
                $q->where('email', strtolower($userName))
                    ->orWhere('phone', $userName);
            })->first();

    }


    public function activeList()
    {
        return  $this->WebsiteMenuModel->whereNull('deleted_at')->where('status', 'Active')->get();
    }

}

