<?php

namespace Eslamfaroug\LaravelLikeDislike\Facades;

use Illuminate\Support\Facades\Facade;

class LikeSystem extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'like-system';
    }
}
