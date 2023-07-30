<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('games')->truncate();
        DB::table('game_stages')->truncate();
        DB::table('game_stage_actions')->truncate();
        Schema::disableForeignKeyConstraints();

        // Test game #1
        DB::table('games')->insert([ // game id = 1
            'title' => 'My First Game',
            'user_id' => 1
        ]);

        DB::table('game_stages')->insert([ // stage id = 1
            'game_id' => 1,
            'type' => 'start',
            'title' => 'Stage #1',
            'content' => 'You are in a room with no windows and two doors. One door is red with a sign that says "DEATH". The other door is green with a sign that says "VICTORY". Which one would you choose?',
            'x' => 0,
            'y' => 0
        ]);

        DB::table('game_stages')->insert([ // stage id = 2
            'game_id' => 1,
            'type' => 'death',
            'title' => 'You died',
            'content' => 'You have chosen DEATH.',
            'x' => 250,
            'y' => 0
        ]);

        DB::table('game_stages')->insert([ // stage id = 3
            'game_id' => 1,
            'type' => 'victory',
            'title' => 'You win',
            'content' => 'You have chosen VICTORY.',
            'x' => 500,
            'y' => 0
        ]);

        DB::table('game_stage_actions')->insert([ // stage action id = 1
            'game_stage_id' => 1,
            'game_stage_target_id' => 2,
            'description' => 'Red DEATH door',
            'order' => 1
        ]);

        DB::table('game_stage_actions')->insert([ // stage action id = 2
            'game_stage_id' => 1,
            'game_stage_target_id' => 3,
            'description' => 'Red DEATH door',
            'order' => 2
        ]);
    }
}
