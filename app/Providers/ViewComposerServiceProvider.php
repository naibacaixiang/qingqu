<?php
namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('widgets.nav', 'App\Http\ViewComposers\NavComposer');
        View::composer('widgets.categories', 'App\Http\ViewComposers\CategoriesComposer');
    }
    /**
     * 注册服务提供者
     *
     * @return void
     */
    public function register()
    {
        // TODO: 实现 register() 方法。
    }
}