<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
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

    public function dateFormatted( $showTimes = false){
        $format = "d/m/Y";
        if($showTimes) $format = $format. " H:i:s";
        return $this->created_at->format($format);
    }

    public function publicationLabel(){
        if (! $this->published_at) {
            return '<span class="label label-warning">Draft</span>';
        }else if( $this->published_at && $this->published_at->isFuture()){
            return '<span class="label label-info">Schedule</span>';
        }else{
            return '<span class="label label-success">Published</span>';
        }
    }
    
}
