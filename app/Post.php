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

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function author(){

        return $this->belongsTo(User::class);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function getDateAttribute( $value ){
        return is_null($this->published_at) ? ' ' : $this->published_at->diffForHumans();
    }

    public function getTagsHtmlAttribute(){
        $anchors = [];
        foreach($this->tags as $tag){

            $anchors[] = '<a href="'.route("tag",["tag"=>$tag->slug]).'">'.$tag->name.'</a>';
        }
      return implode(",",$anchors);
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

    public function scopeScheduled($query){
        return $query->where("published_at", ">",Carbon::now());
    }

    public function scopeDraft($query){
        return $query->whereNull("published_at");
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

    public function scopeFilter( $query, $filter){

        

           
            if (isset( $filter['month'] ) && $month = $filter['month']) {
               
                $query->whereRaw( 'MONTH(published_at) = ?', [Carbon::parse($month)->month])->get();
            }
    
            if (isset(  $filter['year'] ) && $year = $filter['year']) {
               
                $query->whereRaw( "YEAR(published_at) = ?", [Carbon::parse($year)->year])->get();
                
            }

            if (isset(  $filter['search'] ) && $search = $filter['search']) {
        
            $query->where( function( $q ) use ( $search ){

                // Search for the author in query
                    $q->whereHas('author', function($qr) use ( $search ){
                        $qr->where('name','LIKE', "%{$search}%");
                    })->get();
                // Search for the author in query
                    $q->orWhereHas('category', function($qr) use ( $search ){
                        $qr->where('title','LIKE', "%{$search}%");
                    })->get();
                    // Search for the author in query
                    $q->orWhereHas('tags', function($qr) use ( $search ){
                        $qr->where('name','LIKE', "%{$search}%");
                    })->get();
                // Search for the title in query
                    $q->orWhere('title','LIKE', "%{$search}%")->get();
                // Search for the excerpt in query
                    $q->orWhere('excerpt','LIKE', "%{$search}%")->get();
                    
                });

        }
    }
    
}
