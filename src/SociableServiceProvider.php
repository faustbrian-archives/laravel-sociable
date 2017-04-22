<?php


declare(strict_types=1);

/*
 * This file is part of Laravel Sociable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Sociable;

use BrianFaust\ServiceProvider\AbstractServiceProvider;
use BrianFaust\Sociable\Events\UserHasSocialized;
use BrianFaust\Sociable\Listeners\UserHasSocializedListener;
use Laravel\Socialite\SocialiteServiceProvider;

class SociableServiceProvider extends AbstractServiceProvider
{
    public function boot(): void
    {
        $this->publishMigrations();
    }

    public function register(): void
    {
        parent::register();

        $this->app->register(SocialiteServiceProvider::class);

        $this->app['events']->listen(
            UserHasSocialized::class,
            UserHasSocializedListener::class
        );
    }

    public function provides(): array
    {
        return array_merge(parent::provides(), [
            SocialiteServiceProvider::class,
        ]);
    }

    public function getPackageName(): string
    {
        return 'sociable';
    }
}
