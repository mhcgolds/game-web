<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    // Main dashboard page
    public function index(Request $request): Response
    {
        $games = \App\Models\Game::orderBy('title')->get()->toArray();

        return Inertia::render('Dashboard/Index', ['games' => $games, 'game_count' => count($games)]);
    }
}
