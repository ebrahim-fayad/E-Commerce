<?php

namespace App\Providers;

use App\Interfaces\Admin\Auth\AdminAuthRepositoryInterface;
use App\Interfaces\Admin\Auth\AdminForgetPasswordRepositoryInterface;
use App\Interfaces\Admin\Categories\CategoryRepositoryInterface;
use App\Interfaces\Admin\Profile\AdminProfileRepositoryInterface;
use App\Interfaces\Admin\Settings\SettingRepositoryInterface;
use App\Interfaces\Seller\Auth\SellerAuthRepositoryInterface;
use App\Interfaces\Seller\Auth\SellerForgetPasswordRepositoryInterface;
use App\Repository\Admin\Auth\AdminAuthRepository;
use App\Repository\Admin\Auth\AdminForgetPasswordRepository;
use App\Repository\Admin\Categories\CategoryRepository;
use App\Repository\Admin\Profile\AdminProfileRepository;
use App\Repository\Admin\Settings\SettingRepository;
use App\Repository\Seller\Auth\SellerAuthRepository;
use App\Repository\Seller\Auth\SellerForgetPasswordRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AdminAuthRepositoryInterface::class, AdminAuthRepository::class);
        $this->app->bind(AdminForgetPasswordRepositoryInterface::class, AdminForgetPasswordRepository::class);
        $this->app->bind(AdminProfileRepositoryInterface::class, AdminProfileRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SellerAuthRepositoryInterface::class, SellerAuthRepository::class);
        $this->app->bind(SellerForgetPasswordRepositoryInterface::class, SellerForgetPasswordRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
