<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [
        'id',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] =Str::slug($value);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
