<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for handling Payments
 */
class Payment extends Model
{
	
	use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['user_id', 'client_secret', 'order_no', 'amount', 'status'];

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
     * Get the Order for this Payment.
     */
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'order_no');
    }

    /**
     * Get the User for the given Payment.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }      
    
}


 ?>