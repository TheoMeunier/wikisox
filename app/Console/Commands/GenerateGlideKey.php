<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateGlideKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'key:generate-glide-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new key for Glide';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $key = Str::random(40);

        config('glide.key', $key);

        $this->info("Generated key: $key");
    }
}
