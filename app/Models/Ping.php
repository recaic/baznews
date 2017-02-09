<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ping_list'
    ];

    public static function validate($input) {
        $rules = array(
            'ping_list' => 'required|string',
        );
        return Validator::make($input, $rules);
    }
}
