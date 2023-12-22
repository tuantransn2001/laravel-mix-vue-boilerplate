<?php

namespace App\Providers;

use App\Repositories\IEloquentRepository;
use App\Repositories\UserRepository;
use BaseRepository;
use Illuminate\Support\ServiceProvider;
use IUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services. 
     * 
     * @return void  
     */
    public function register(): void
    {
        $this->app->bind(IEloquentRepository::class, BaseRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap services. 
     * 
     * @return void  
     */
    public function boot(): void
    {
        //
    }
}
