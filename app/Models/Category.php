<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //relationship for parent category
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }
    //relationship for getting subcategories
    public function subCategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function products()
    {
        return $this->belongstoMany('App\Models\Product');
    }
}
