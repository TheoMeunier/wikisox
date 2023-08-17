<?php

namespace App\Providers;

use App\Services\Markdown\ParserMarkdown;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MarkdownServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('markdown', function(string $expression) {
            return "<?php echo app(App\Services\Markdown\ParserMarkdown::class)->parse($expression); ?>";
        });
    }
}
