<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for handling SubCategories
 */
class Product extends Model
{
	
	use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['name', 'price', 'description', 'quantity',
                           'category_id', 'sub_category_id', 'image_path'];

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = true;

	/**
     * Array containing deleted timestamps.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the Cateogry that owns the Product.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get the SubCateogry that owns the Product.
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }
    
}


 ?>