<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\GameStage;

class GameStageAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_stage_id',
        'game_stage_target_id',
        'description',
        'order'
    ];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(GameStage::class);
    }
}
