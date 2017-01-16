<?php

namespace App\Modules\News\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Venturecraft\Revisionable\RevisionableTrait;

class Video extends Model
{
    use RevisionableTrait;

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source' => ['name','id']
            ]
        ];
    }

    /*
     * Alt yazı
     * Alternatif metin
     *
     *
     * */
    protected $fillable = ['video_gallery_id', 'name', 'slug', 'subtitle', 'thumbnail', 'link', 'content', 'keywords', 'order', 'is_active'];

    public function video_gallery()
    {
        return $this->belongsTo('App\Modules\News\Models\VideoGallery');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public static function validate($input) {
        $rules = array(
            'name' => 'required',
        );
        return Validator::make($input, $rules);
    }

    public static function videoList()
    {
        return Video::where('is_active',1)->pluck('name', 'id');
    }
}