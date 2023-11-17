<?php

namespace App\Models;

use App\Http\Controllers\backend\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $table = "category";

    protected $guarded = [];
    const CREATED_AT ='created_at';
    const UPDATED_AT ='updated_at';

    public function products(): HasMany
    {
        return  $this->hasMany(Product::class)->with('category');
    }
    public function sub_categories() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public  function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
    public static function getCategoriesWithSubcategories()
    {
        return Category::join('category AS s', 'category.id', '=', 's.parent_category_id')
            ->select('category.*',
                's.category_name AS sub_category_name',
                's.slug AS sub_slug',
                's.is_set AS sub_is_set'
            )
            ->get();
    }

}
