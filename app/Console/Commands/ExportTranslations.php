<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportTranslations extends Command
{
    protected $signature = 'translations:export {locale}';
    protected $description = 'Export translations to a file';

    public function handle()
    {
        $locale = $this->argument('locale');
        $translations = trans($locale);

        // Save to file or any logic you need
        File::put(resource_path("lang/{$locale}.json"), json_encode($translations, JSON_PRETTY_PRINT));

        $this->info("Translations for {$locale} exported successfully!");
    }
}
