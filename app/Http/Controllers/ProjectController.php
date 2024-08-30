<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $projectService) {}
    public function details()
    {
        try {
            $details = $this->projectService->getCollection();
            return response()->json(['projects' => $details], 200);
        } catch (Exception $ex) {
            Log::channel('user_exception_log')->error($ex->getMessage());
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    // public function filter(string $id){

    // }
}
