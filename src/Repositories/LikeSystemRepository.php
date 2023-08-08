<?php

namespace Eslamfaroug\LaravelLikeDislike\Repositories;


use EslamFaroug\LaravelLikeDislike\Like;

class LikeSystemRepository
{
    public function createLike($liker, $likeable, $type)
    {
        $like = new Like([
            'liker_id' => $liker->id,
            'liker_type' => get_class($liker),
            'likeable_id' => $likeable->id,
            'likeable_type' => get_class($likeable),
            'type' => $type,
        ]);

        $like->save();

        return $like;
    }

    public function hasLike($liker, $likeable)
    {
        return Like::where([
            'liker_id' => $liker->id,
            'liker_type' => get_class($liker),
            'likeable_id' => $likeable->id,
            'likeable_type' => get_class($likeable),
        ])->exists();
    }

    public function deleteLike($liker, $likeable)
    {
        return Like::where([
            'liker_id' => $liker->id,
            'liker_type' => get_class($liker),
            'likeable_id' => $likeable->id,
            'likeable_type' => get_class($likeable),
        ])->delete();
    }

    public function toggleLike($liker, $likeable, $type)
    {
        if ($this->hasLike($liker, $likeable)) {
            $this->deleteLike($liker, $likeable);
        } else {
            $this->createLike($liker, $likeable, $type);
        }
    }

    public function getLikesCount($likeable)
    {
        return Like::where([
            'likeable_id' => $likeable->id,
            'likeable_type' => get_class($likeable),
            'type' => 'like',
        ])->count();
    }

    public function getDislikesCount($likeable)
    {
        return Like::where([
            'likeable_id' => $likeable->id,
            'likeable_type' => get_class($likeable),
            'type' => 'dislike',
        ])->count();
    }
}
