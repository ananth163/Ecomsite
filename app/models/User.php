<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for handling Users
 */
class User extends Model
{
	
	use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['username', 'fullname', 'email', 'password',
                           'address', 'role'];

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
    
}


 ?>