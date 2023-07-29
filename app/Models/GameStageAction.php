<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameStageAction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'game_stage_id',
        'game_stage_target_id',
        'description',
        'order'
    ];
}
