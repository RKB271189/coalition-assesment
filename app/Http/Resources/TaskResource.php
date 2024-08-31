<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        $data = [
            'id' => $this->id,
            'project_name' => $this->project->name,
            'task_name' => $this->name,
            'priority' => $this->priority,
            'status' => $this->status === 0 ? 'in progress' : 'completed',
            'created_at' => date('m-d-Y H:i', strtotime($this->created_at)),
            'updated_at' => date('m-d-Y H:i', strtotime($this->updated_at)),
        ];
        return $data;
    }
}
