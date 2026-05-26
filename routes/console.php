<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about:books-api', function (): void {
    $this->info('Books Management API is ready.');
})->purpose('Display Books Management API status');
