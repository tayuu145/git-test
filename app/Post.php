<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     *
     */
    public function comments()
    {
        // 投稿は複数のコメントを持つ
        return $this->hasMany('App\Comment');
    }

    /**
     *
     */
    public function category()
    {
        // 投稿は1つのカテゴリーに属する
        return $this->belongsTo('App\Category');
    }

    public function user() { //1対多の「１」側なので単数系
        return $this->belongsTo('App\User');
    }



}
