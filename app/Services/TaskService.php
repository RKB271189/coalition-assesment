<?php

namespace App\Services;

use App\Models\Tasks;
use App\Services\Contracts\ContractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class TaskService extends ContractRepository
{
    public function __construct(private Tasks $tasks)
    {
        parent::__construct($tasks);
    }
    public function getCollection(int $limit = 0): Collection
    {
        return $this->tasks->orderBy('updated_at', 'desc')->orderBy('priority')->get();
    }
    public function getLastestRecord(): ?Model
    {
        return $this->tasks->latest('priority')->where('status', 0)->first();
    }
    public function getTaskWithProject(): ?Collection
    {
        return $this->tasks->with('project')->where('status', 0)->orderBy('priority')->get();
    }
}
