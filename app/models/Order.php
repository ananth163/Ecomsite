<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for handling Orders
 */
class Order extends Model
{
	
	use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['user_id', 'product_id', 'unit_price',
                            'total', 'status', 'order_no'];

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
     * Get the product for the given Order.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Get the User for the given Order.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the Payments for the given Order.
     */
    public function payments()
    {
        return $this->hasMany('App\Models\Payment', 'order_no', 'order_no');
    }    
    
}


 ?>