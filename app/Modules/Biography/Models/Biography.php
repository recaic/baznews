<?php

namespace App\Modules\Biography\Models;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Biography extends Model
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
                'source' => ['title','id']
            ]
        ];
    }

    protected $table = 'biographies';
    //todo biografiye title veya name alanı eklenecek
    protected $fillable = ['user_id', 'title', 'spot', 'name', 'slug', 'content', 'photo', 'description', 'keywords', 'order', 'hit', 'status', 'is_cuff', 'is_active'];

    public static $statuses = ['Passive', 'Active', 'Draft', 'On Air', 'Preparing', 'Pending for Editor Approval', 'Garbage'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function validate($input) {
        $rules = array(
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'content' => 'required',
            'photo' => 'image|max:255',
            'description' => 'max:255',
            'keywords' => 'max:255',
            'order' => 'integer',
            'hit' => 'integer',
            'status' => 'integer',
        );
        return Validator::make($input, $rules);
    }

    public static function biographyList()
    {
        return Biography::where('is_active',1)->pluck('full_name', 'id');
    }
}