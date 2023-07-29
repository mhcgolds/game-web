<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameStage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content',
        'game_id',
        'type'
    ];
}
