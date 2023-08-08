<?php

namespace Eslamfaroug\LaravelLikeDislike\Interfaces;

interface LikeSystemInterface
{
    public function like($liker, $likeable);

    public function dislike($liker, $likeable);

    public function hasLiked($liker, $likeable);

    public function hasDisliked($liker, $likeable);

    public function toggleLike($liker, $likeable);

    public function getLikesCount($likeable);

    public function getDislikesCount($likeable);
}
