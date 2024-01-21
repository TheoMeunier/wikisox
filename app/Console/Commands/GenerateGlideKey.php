<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
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

        $this->setEnv('GLIDE_KEY', $key);

        $this->info('GLIDE_KEY generated and set in the .env file.');
    }

    private function setEnv(string $key, string $value): void
    {
        $path = base_path('.env');

        if (File::exists($path)) {
            $envFile = File::get($path);

            $newEnvValue   = $key.'='.$value;
            $existingValue = env($key);

            if ($existingValue) {
                $envFile = str_replace($key.'='.$existingValue, $newEnvValue, $envFile);
            } else {
                $envFile .= "\n".$newEnvValue;
            }

            File::put($path, $envFile);
            $this->call('config:clear');
        }
    }
}
