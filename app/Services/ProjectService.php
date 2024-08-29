<?php

namespace App\Services;

use App\Models\Projects;
use App\Services\Contracts\ContractRepository;

final class ProjectService extends ContractRepository
{
    public function __construct(private Projects $projects)
    {
        parent::__construct($projects);
    }
}
