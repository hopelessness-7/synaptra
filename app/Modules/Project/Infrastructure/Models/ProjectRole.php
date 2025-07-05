<?php

namespace App\Modules\Project\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    protected $fillable = ['name', 'description'];

    public $timestamps = false;
}
