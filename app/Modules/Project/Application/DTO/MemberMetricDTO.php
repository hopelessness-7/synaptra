<?php

namespace App\Modules\Project\Application\DTO;

class MemberMetricDTO
{
    public ?int $id;
    public int $member_id;
    public int $tasks_completed;
    public ?float $avg_task_time;
    public ?float $total_work_time;
    public ?float $quality_score;
    public ?float $activity_score;
}
