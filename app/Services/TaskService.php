<?php

namespace App\Services;

use App\Models\Tasks;
use App\Services\Contracts\ContractRepository;

final class TaskService extends ContractRepository
{
    public function __construct(private Tasks $tasks)
    {
        parent::__construct($tasks);
    }
}
