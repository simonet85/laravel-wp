<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function author(){

        return $this->belongsTo(User::class);
    }

    public function getDateAttribute( $value ){
        return $this->created_at->diffForHumans();
    }

    public function scopeLatestFirst($query){
        return $this->orderBy('created_at', 'desc');
    }
    
}
