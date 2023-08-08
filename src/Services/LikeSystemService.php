<?php

namespace Eslamfaroug\LaravelLikeDislike\Services;

use Eslamfaroug\LaravelLikeDislike\Interfaces\LikeSystemInterface;
use EslamFaroug\LaravelLikeDislike\Like;
use Illuminate\Support\Facades\DB;

class LikeSystemService implements LikeSystemInterface
{
    public function like($liker, $likeable)
    {
        $this->toggleLikeStatus($liker, $likeable, 'like');
    }

    public function dislike($liker, $likeable)
    {
        $this->toggleLikeStatus($liker, $likeable, 'dislike');
    }

    public function hasLiked($liker, $likeable)
    {
        return $this->checkLikeStatus($liker, $likeable, 'like');
    }

    public function hasDisliked($liker, $likeable)
    {
        return $this->checkLikeStatus($liker, $likeable, 'dislike');
    }

    public function toggleLike($liker, $likeable)
    {
        DB::transaction(function () use ($liker, $likeable) {
            if ($this->hasLiked($liker, $likeable)) {
                $this->removeLikeStatus($liker, $likeable);
            } else {
                $this->like($liker, $likeable);
            }
        });
    }

    public function getLikesCount($likeable)
    {
        return $this->getLikeCount($likeable, 'like');
    }

    public function getDislikesCount($likeable)
    {
        return $this->getLikeCount($likeable, 'dislike');
    }

    protected function toggleLikeStatus($liker, $likeable, $type)
    {
        Like::updateOrCreate([
            'liker_type' => get_class($liker),
            'liker_id' => $liker->id,
            'likeable_type' => get_class($likeable),
            'likeable_id' => $likeable->id,
        ], [
            'type' => $type,
        ]);
    }

    protected function checkLikeStatus($liker, $likeable, $type)
    {
        return Like::where([
            'liker_type' => get_class($liker),
            'liker_id' => $liker->id,
            'likeable_type' => get_class($likeable),
            'likeable_id' => $likeable->id,
            'type' => $type,
        ])->exists();
    }

    protected function removeLikeStatus($liker, $likeable)
    {
        Like::where([
            'liker_type' => get_class($liker),
            'liker_id' => $liker->id,
            'likeable_type' => get_class($likeable),
            'likeable_id' => $likeable->id,
        ])->delete();
    }

    protected function getLikeCount($likeable, $type)
    {
        return Like::where([
            'likeable_type' => get_class($likeable),
            'likeable_id' => $likeable->id,
            'type' => $type,
        ])->count();
    }
}
