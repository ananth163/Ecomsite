<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for handling Categories
 */
class Category extends Model
{
	
	use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['name', 'slug'];

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
     * Get the subcategories for the product category.
     */
    public function subcategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    /**
     * Get the products for the product category.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}


 ?>