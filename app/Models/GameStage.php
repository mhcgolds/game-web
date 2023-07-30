<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\GameStageAction;
use App\Models\Game;

class GameStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'game_id',
        'type',
        'x',
        'y'
    ];

    public function actions(): HasMany
    {
        return $this->hasMany(GameStageAction::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
