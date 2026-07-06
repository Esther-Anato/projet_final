<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Builder::defaultStringLength(191);
        Paginator::useTailwind();
    }
}
