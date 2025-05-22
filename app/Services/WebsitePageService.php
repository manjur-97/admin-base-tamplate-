<?php
namespace App\Services;
use App\Models\WebsitePage;

class WebsitePageService
{
    protected $WebsitePageModel;

    public function __construct(WebsitePage $WebsitePageModel)
    {
        $this->WebsitePageModel = $WebsitePageModel;
    }

    public function list()
    {
        return  $this->WebsitePageModel->whereNull('deleted_at');
    }

    public function all()
    {
        return  $this->WebsitePageModel->whereNull('deleted_at')->all();
    }

    public function find($id)
    {
        return  $this->WebsitePageModel->find($id);
    }

    public function create(array $data)
    {
        return  $this->WebsitePageModel->create($data);
    }

    public function update(array $data, $id)
    {
        $dataInfo =  $this->WebsitePageModel->findOrFail($id);

        $dataInfo->update($data);

        return $dataInfo;
    }

    public function delete($id)
    {
        $dataInfo =  $this->WebsitePageModel->find($id);

        if (!empty($dataInfo)) {

            $dataInfo->deleted_at = date('Y-m-d H:i:s');

            $dataInfo->status = 'Deleted';

            return ($dataInfo->save());
        }
        return false;
    }

    public function changeStatus($id,$status)
    {
        $dataInfo =  $this->WebsitePageModel->findOrFail($id);
        $dataInfo->status = $status;
        $dataInfo->update();

        return $dataInfo;
    }

    public function AdminExists($userName)
    {
        return  $this->WebsitePageModel->whereNull('deleted_at')
            ->where(function ($q) use ($userName) {
                $q->where('email', strtolower($userName))
                    ->orWhere('phone', $userName);
            })->first();

    }


    public function activeList()
    {
        return  $this->WebsitePageModel->whereNull('deleted_at')->where('status', 'Active')->get();
    }

}

