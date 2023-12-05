<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'product_name', 'product_tags', 'product_quantity', 'product_sold' , 'product_slug', 'category_id','brand_id','product_desc','product_content','product_price',
        'product_image', 'product_file', 'product_views', 'product_status','price_cost'
    ];

    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
    public function category(){
        return $this->belongsTo('App\Models\CategoryProductModel','category_id'); 
    }
}
