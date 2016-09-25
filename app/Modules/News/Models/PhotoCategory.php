<?php

namespace App\Modules\News\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Venturecraft\Revisionable\RevisionableTrait;

class PhotoCategory extends Model
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
                'source' => ['name']
            ]
        ];
    }

    protected $table = 'photo_categories';
    protected $fillable = ['parent_id', '_lft', '_rgt', 'name', 'slug', 'description', 'keywords', 'hit', 'icon', 'is_cuff', 'is_active'];

//    public function news()
//    {
//        return $this->belongsToMany('App\Modules\News\Models\NewsCategory', 'news_categories_news', 'news_category_id', 'news_id');
//    }

    public function photo_galleries()
    {
        return $this->hasMany('App\Modules\News\Models\PhotoGallery');
    }

    public static function validate($input) {
        $rules = array(
            'name'                     => 'required',
        );
        return Validator::make($input, $rules);
    }

    public static function photoCategoryList()
    {
        return PhotoCategory::where('is_active',1)->pluck('name', 'id');
    }
}
