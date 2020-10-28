<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    protected $dates = ['published_at'];

    public function author(){

        return $this->belongsTo(User::class);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function getDateAttribute( $value ){
        return is_null($this->published_at) ? ' ' : $this->published_at->diffForHumans();
    }

    public function scopeLatestFirst($query){
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePopular($query){
        return $query->orderBy('view_count', 'desc');
    }


    public function scopePublished($query){
        return $query->where("published_at", "<=",Carbon::now());
    }
    
}
