<?php

namespace App\Services;

use App\Models\Tasks;
use App\Services\Contracts\ContractRepository;
use Illuminate\Database\Eloquent\Model;

final class TaskService extends ContractRepository
{
    public function __construct(private Tasks $tasks)
    {
        parent::__construct($tasks);
    }
    public function getLastestRecord(): ?Model
    {
        return $this->tasks->latest('priority')->where('status', 0)->first();
    }
}
