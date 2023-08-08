<?php

namespace EslamFaroug\LaravelLikeDislike\Traits;

use EslamFaroug\LaravelLikeDislike\Contracts\Likeable;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait LikerTrait
{
    /**
     * Relationship: Get the likes associated with the liker.
     *
     * @return MorphMany
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(config('like-system.like_model'), 'liker');
    }

    /**
     * Like a likeable model.
     *
     * @param  Likeable  $likeable
     * @param  string|null  $type
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function like(Likeable $likeable, string $type = null): \Illuminate\Database\Eloquent\Model
    {
        return $this->likes()->updateOrCreate(
            [
                'likeable_id' => $likeable->getLikeableId(),
                'likeable_type' => $likeable->getLikeableType(),
            ],
            ['type' => $type ?: 'like']
        );
    }

    /**
     * Dislike a likeable model.
     *
     * @param  Likeable  $likeable
     */
    public function dislike(Likeable $likeable)
    {
        return $this->likes()->updateOrCreate(
            [
                'likeable_id' => $likeable->getLikeableId(),
                'likeable_type' => $likeable->getLikeableType(),
            ],
            ['type' => 'dislike']
        );
    }

    /**
     * Toggle the like status of a likeable model.
     *
     * @param  Likeable  $likeable
     * @param  string|null  $type
     */
    public function toggleLike(Likeable $likeable, string $type = null)
    {
        $existingLike = $this->likes()->where([
            'likeable_id' => $likeable->getLikeableId(),
            'likeable_type' => $likeable->getLikeableType(),
        ])->first();

        if ($existingLike) {
            return $this->unlike($likeable);
        }

        return $this->like($likeable, $type);
    }

    /**
     * Toggle the dislike status of a likeable model.
     *
     * @param  Likeable  $likeable
     */
    public function toggleDislike(Likeable $likeable)
    {
        $existingLike = $this->likes()->where([
            'likeable_id' => $likeable->getLikeableId(),
            'likeable_type' => $likeable->getLikeableType(),
        ])->first();

        if ($existingLike && $existingLike->type === 'dislike') {
            return $this->unlike($likeable);
        }

        return $this->dislike($likeable);
    }

    /**
     * Remove a like from a likeable model.
     *
     * @param  Likeable  $likeable
     * @return bool|null
     */
    public function unlike(Likeable $likeable): ?bool
    {
        $like = $this->likes()->where([
            'likeable_id' => $likeable->getLikeableId(),
            'likeable_type' => $likeable->getLikeableType(),
        ])->first();

        if ($like) {
            return $like->delete();
        }

        return null;
    }
}
