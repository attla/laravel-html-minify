<?php

namespace Attla\HtmlMinify;

use Attla\HtmlMinify\Minify;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'html-minify');
    }

    /**
     * Bootstrap the application events
     *
     * @return void
     */
    public function boot()
    {
        $config = $this->app['config'];

        if ($this->app->bound('blade.compiler') && $config->get('html-minify.enable')) {
            $this->app['blade.compiler']->extend(function ($value, $compiler) use ($config) {
                return Minify::compile($value, [
                    'preserve_comments' => (bool) $config->get('html-minify.preserve_comments'),
                    'preserve_conditional_comments' => (bool) $config->get('html-minify.preserve_conditional_comments'),
                ]);
            });
        }

        $this->publishes([
            $this->configPath() => $this->app->configPath('html-minify.php'),
        ], 'attla/html-minify/config');
    }

    /**
     * Get config path
     *
     * @param bool
     */
    protected function configPath()
    {
        return __DIR__ . '/../config/html-minify.php';
    }
}
