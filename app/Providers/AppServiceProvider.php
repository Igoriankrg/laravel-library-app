<?php

namespace App\Providers;

use App\Repositories\Ar\BookRepository;
use App\Repositories\Ar\UserRepository;
use App\Services\BookService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserService::class, function () {
            return new UserService(
                $this->app->get(UserRepository::class)
            );
        });

        $this->app->bind(BookService::class, function () {
            return new BookService(
                $this->app->get(BookRepository::class)
            );
        });
    }
}
