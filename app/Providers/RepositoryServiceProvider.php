<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserNoteRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\NoteRepositoryInterface;
use App\Repositories\Interfaces\UserNoteRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\NoteRepository;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(UserNoteRepositoryInterface::class, UserNoteRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(NoteRepositoryInterface::class, NoteRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}