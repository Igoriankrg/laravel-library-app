<?php

namespace App\Providers;

use App\Repositories\Ar\BookAuthorRepository;
use App\Repositories\Ar\BookRepository;
use App\Repositories\Ar\UserRepository;
use App\Services\BookAuthorService;
use App\Services\BookService;
use App\Services\Interfaces\BookAuthorServiceInterface;
use App\Services\Interfaces\BookServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
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
        $this->app->bind(UserServiceInterface::class, function () {
            return new UserService(
                $this->app->get(UserRepository::class)
            );
        });

        $this->app->bind(BookServiceInterface::class, function () {
            return new BookService(
                $this->app->get(BookRepository::class)
            );
        });

        $this->app->bind(BookAuthorServiceInterface::class, function () {
            return new BookAuthorService(
                $this->app->get(BookAuthorRepository::class)
            );
        });
    }
}
