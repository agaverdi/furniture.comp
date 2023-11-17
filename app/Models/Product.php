<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $table = "product";


    protected $guarded = [];

    const CREATED_AT ='created_at';
    const UPDATED_AT ='updated_at';

    public function set_products():HasMany
    {
        return $this->hasMany(SetProduct::class,'set_product_id',)->with('product');
    }

    public function category(): BelongsTo
    {
        return  $this->belongsTo(Category::class);
    }
    public function subCategory():BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }
    public static function getProductsWithCategory()
    {
        return Product::join('category as s_c', 's_c.id', '=', 'product.sub_category_id')
            ->join('category as c', 'c.id', '=', 'product.category_id')
            ->select('product.*', 's_c.category_name as sub_category_name', 'c.category_name as category_name')
            ->get();
    }
    public static function showSetProduct($id)
    {
        return Product::join('set_product', 'set_product.set_product_id' ,'=' ,'product.id')
            ->select('set_product.*')
            ->where('product.id',$id)
            ->get();
    }

    public function comments() :HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function product_details(): HasMany
    {
        return $this->hasMany(ProductDetails::class, 'product_id');
    }
    public static function getByPriceRange($from, $to,$product_sub_category_id)
    {
        return self::where(function ($query) use ($from, $to) {
            $query->whereNull('discount_price')
                ->where('price', '>=', $from)
                ->where('price', '<=', $to);
        })
            ->orWhere(function ($query) use ($from, $to) {
                $query->whereNotNull('discount_price')
                    ->where('discount_price', '>=', $from)
                    ->where('discount_price', '<=', $to);
            })
            ->where('sub_category_id', $product_sub_category_id)
            ->join('category', 'product.sub_category_id', '=', 'category.id')
            ->select('product.*', 'category.slug as category_slug');
    }

    public static function getByPriceRangeAllProduct($from, $to,$product_category_id)
    {
        return self::where(function ($query) use ($from, $to) {
            $query->whereNull('discount_price')
                ->where('price', '>=', $from)
                ->where('price', '<=', $to);
        })
            ->orWhere(function ($query) use ($from, $to) {
                $query->whereNotNull('discount_price')
                    ->where('discount_price', '>=', $from)
                    ->where('discount_price', '<=', $to);
            })
            ->where('category_id', $product_category_id)
            ->join('category', 'product.sub_category_id', '=', 'category.id')
            ->select('product.*', 'category.slug as category_slug');
    }
    public function userWishList($user_id=null,$product_id){
        return WishList::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('active',0)
            ->exists();
    }
    public function product_wish():HasMany
    {
        return $this->hasMany(WishList::class);
    }

    public function cartToCheckout()
    {
        return $this->hasOne(CartToCheckout::class, 'product_id');
    }
}
