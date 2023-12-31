<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\Game;
use App\Http\Requests\Game\GameSaveRequest;
use App\Http\Requests\Game\GameUpdateRequest;
use App\Http\Requests\Game\GameDeleteRequest;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function create(Request $request): Response
    {
        return Inertia::render('Game/Form', ['game' => new Game()]);
    }

    public function edit(Request $request): Response
    {
        $game = Game::find($request->input('id'));

        return Inertia::render('Game/Form', ['game' => $game]);
    }

    public function delete(Request $request): Response
    {
        $game = Game::find($request->input('id'));

        return Inertia::render('Game/Delete', ['game' => $game]);
    }

    public function save(GameSaveRequest $request): RedirectResponse
    {
        $game = new Game();
        $game->fill($request->all());
        $game->user_id = Auth::id();
        $game->save();

        return Redirect::route('game.edit', ['id' => $game->id]);
    }

    public function update(GameUpdateRequest $request): RedirectResponse
    {
        $game = Game::find($request->input('id'));
        $game->fill($request->all());
        $game->save();

        return Redirect::route('game.edit', ['id' => $game->id]);
    }

    public function destroy(GameDeleteRequest $request): RedirectResponse
    {
        Game::find($request->input('id'))->delete();

        return Redirect::route('dashboard');
    }

    public function manage(Request $request): Response
    {
        $game = Game::with(['stages', 'stages.actions'])->find($request->input('id'));

        return Inertia::render('Game/Manage', ['game' => $game]);
    }
}
