<?php

namespace App\Modules\Book\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BookCategory extends Model
{
    use Sluggable;
    use NodeTrait;

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

    protected $table = 'book_categories';
    protected $fillable = ['parent_id', '_lft', '_rgt', 'name', 'slug', 'description', 'keywords', 'thumbnail', 'is_cuff', 'is_active'];

    public function books()
    {
        return $this->belongsToMany('App\Modules\Book\Models\Book', 'book_categories_books', 'book_category_id', 'book_id');
    }

    public static function validate($input) {
        $rules = array(
            'name' => 'required',
            'thumbnail' => 'image|max:255',
        );
        return Validator::make($input, $rules);
    }

    public static function bookCategoryList()
    {
        return BookCategory::where('is_active',1)->pluck('name', 'id');
    }
}
