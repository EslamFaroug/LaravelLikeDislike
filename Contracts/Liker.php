<?php

namespace EslamFaroug\LaravelLikeDislike\Contracts;

interface Liker
{
    /**
     * Relationship: Get the likes given by the liker.
     */
    public function likes();

    /**
     * Relationship: Get the dislikes given by the liker.
     */
    public function dislikes();

    /**
     * Determine if the liker has liked a specific likeable model.
     *
     * @param  Likeable  $likeable
     * @return bool
     */
    public function hasLiked(Likeable $likeable): bool;

    /**
     * Determine if the liker has disliked a specific likeable model.
     *
     * @param  Likeable  $likeable
     * @return bool
     */
    public function hasDisliked(Likeable $likeable): bool;

    /**
     * Toggle the like status of a specific likeable model for the liker.
     *
     * @param  Likeable  $likeable
     * @return bool
     */
    public function toggleLike(Likeable $likeable): bool;

    /**
     * Toggle the dislike status of a specific likeable model for the liker.
     *
     * @param  Likeable  $likeable
     * @return bool
     */
    public function toggleDislike(Likeable $likeable): bool;

    /**
     * Remove the like status of a specific likeable model for the liker.
     *
     * @param  Likeable  $likeable
     * @return bool
     */
    public function removeLike(Likeable $likeable): bool;

    /**
     * Remove the dislike status of a specific likeable model for the liker.
     *
     * @param  Likeable  $likeable
     * @return bool
     */
    public function removeDislike(Likeable $likeable): bool;
}
