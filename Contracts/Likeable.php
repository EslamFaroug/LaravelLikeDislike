<?php

namespace EslamFaroug\LaravelLikeDislike\Contracts;

interface Likeable
{
    /**
     * Get the ID of the likeable model.
     *
     * @return mixed
     */
    public function getLikeableId();

    /**
     * Get the type of the likeable model.
     *
     * @return string
     */
    public function getLikeableType();

    /**
     * Get the liker type that can like this model.
     *
     * @return string
     */
    public function getLikerType();
}
