<?php

namespace EslamFaroug\LaravelLikeDislike;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'liker_id', 'liker_type', 'likeable_id', 'likeable_type', 'type',
    ];
    const LIKE = 'like';
    const DISLIKE = 'dislike';

    public function likeable()
    {
        return $this->morphTo('likeable');
    }

    public function liker()
    {
        return $this->morphTo('liker');
    }

    public function scopeWithType($query, $type)
    {
        return $query->where('type', $type);
    }
}
