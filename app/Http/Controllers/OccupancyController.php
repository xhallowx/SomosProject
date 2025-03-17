<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ProjectTask;

class OccupancyController extends Controller
{
    /**
     * Obtains the occupancy percentage of an owner.
     */
    public static function getOwnerOccupancy($owner)
    {
        $projectsCount = Task::where('owner', $owner)
                                ->where('project_state', '!=', 'Completed')
                                ->count();
        
        $tasksCount = ProjectTask::where('owner', $owner)
                                    ->where('task_state', '!=', 'Completed')
                                    ->count();

        $occupancy = (15 * $projectsCount) + (10 * $tasksCount);

        return[
            'projects' => $projectsCount,
            'tasks' => $tasksCount,
            'occupancy' => $occupancy
        ];
    }

    /**
     * Gets the occupancy of all owner's for the summary view.
     */
    public static function getAllOwnersSummary()
    {
        $taskOwners = Task::distinct()->pluck('owner')->toArray();
        $projectTaskOwners = ProjectTask::distinct()->pluck('owner')->toArray();
        $allOwners = array_unique(array_merge($taskOwners, $projectTaskOwners));

        $summary = [];
        foreach ($allOwners as $owner) {
            $summary[] = array_merge(['owner' => $owner], self::getOwnerOccupancy($owner));
        }

        return $summary;
    }
}
