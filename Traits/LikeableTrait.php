<?php

namespace EslamFaroug\LaravelLikeDislike\Traits;

use EslamFaroug\LaravelLikeDislike\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use EslamFaroug\LaravelLikeDislike\Contracts\Liker;

trait LikeableTrait
{
    /**
     * Relationship: Get the likes associated with the likeable model.
     *
     * @return MorphMany
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(config('like-system.like_model'), 'likeable');
    }

    /**
     * Relationship: Get the likers who liked the likeable model.
     *
     * @return MorphToMany
     */
    public function likers(): MorphToMany
    {
        return $this->morphToMany(
            Liker::class,
            'likeable',
            config('like-system.like_model'),
            'likeable_id',
            'liker_id'
        )->wherePivot('type', Like::LIKE);
    }

    /**
     * Relationship: Get the dislikers who disliked the likeable model.
     *
     * @return MorphToMany
     */
    public function dislikers(): MorphToMany
    {
        return $this->morphToMany(
            Liker::class,
            'likeable',
            config('like-system.like_model'),
            'likeable_id',
            'liker_id'
        )->wherePivot('type', Like::DISLIKE);
    }

    /**
     * Determine if the likeable model is liked by a specific liker.
     *
     * @param  Liker  $liker
     * @return bool
     */
    public function isLikedBy(Liker $liker): bool
    {
        return $this->likers->contains($liker);
    }

    /**
     * Determine if the likeable model is disliked by a specific liker.
     *
     * @param  Liker  $liker
     * @return bool
     */
    public function isDislikedBy(Liker $liker): bool
    {
        return $this->dislikers->contains($liker);
    }

    /**
     * Get the total like count for the likeable model.
     *
     * @return int
     */
    public function getLikeCountAttribute(): int
    {
        return $this->likes->where('type', Like::LIKE)->count();
    }

    /**
     * Get the total dislike count for the likeable model.
     *
     * @return int
     */
    public function getDislikeCountAttribute(): int
    {
        return $this->likes->where('type', Like::DISLIKE)->count();
    }
}
