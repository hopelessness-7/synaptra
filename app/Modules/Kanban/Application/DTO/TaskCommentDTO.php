<?php

namespace App\Modules\Kanban\Application\DTO;

use App\DTO\BaseDTO;

class TaskCommentDTO extends BaseDTO
{
    public int $task_id;
    public int $user_id;
    public ?int $parent_comment_id;
    public string $comment;
}
