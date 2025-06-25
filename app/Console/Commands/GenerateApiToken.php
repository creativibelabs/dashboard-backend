<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GenerateApiToken extends Command
{
    protected $signature = 'token:generate';
    protected $description = 'Generate daily token for public API';

    public function handle()
    {
        $token = Hash::make(Str::random(60));
        $today = now()->toDateString();

        ApiToken::updateOrCreate(
            ['valid_for' => $today],
            ['token' => $token]
        );

        $this->info("Token generated for $today: $token");
    }
}

