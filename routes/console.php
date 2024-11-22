<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Torann\Currency\Console\Manage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('currency:manage {action} {currency}', function ($action, $currency) {
    $manageCommand = new Manage();
    // $manageCommand->setLaravel(app()); // Set Laravel instance if needed
    $this->comment($manageCommand->handle($action, $currency));
})->purpose('Manage currency values');

    // \Torann\Currency\Console\Update::class;
    // \Torann\Currency\Console\Cleanup::class;
    // \Torann\Currency\Console\Manage::class;
    // ExportTranslations::class;
    // Add other commands as needed
