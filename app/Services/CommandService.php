<?php
namespace App\Services;
use App\Models\Command;

class CommandService
{
    protected $CommandModel;

    public function __construct(Command $CommandModel)
    {
        $this->CommandModel = $CommandModel;
    }

    public function list()
    {
        return  $this->CommandModel->whereNull('deleted_at');
    }

    public function all()
    {
        return  $this->CommandModel->whereNull('deleted_at')->all();
    }

    public function find($id)
    {
        return  $this->CommandModel->find($id);
    }

    public function create(array $data)
    {
        return  $this->CommandModel->create($data);
    }

    public function update(array $data, $id)
    {
        $dataInfo =  $this->CommandModel->findOrFail($id);

        $dataInfo->update($data);

        return $dataInfo;
    }

    public function delete($id)
    {
        $dataInfo =  $this->CommandModel->find($id);

        if (!empty($dataInfo)) {

            $dataInfo->deleted_at = date('Y-m-d H:i:s');

            $dataInfo->status = 'Deleted';

            return ($dataInfo->save());
        }
        return false;
    }

    public function changeStatus($id,$status)
    {
        $dataInfo =  $this->CommandModel->findOrFail($id);
        $dataInfo->status = $status;
        $dataInfo->update();

        return $dataInfo;
    }

    public function AdminExists($userName)
    {
        return  $this->CommandModel->whereNull('deleted_at')
            ->where(function ($q) use ($userName) {
                $q->where('email', strtolower($userName))
                    ->orWhere('phone', $userName);
            })->first();

    }


    public function activeList()
    {
        return  $this->CommandModel->whereNull('deleted_at')->where('status', 'Active')->get();
    }

}

    