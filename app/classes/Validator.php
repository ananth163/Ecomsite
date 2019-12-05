<?php 

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Validator class to validate the input
 *
 * @method static make(array|object $data, array $rules) instantiate the Validator
 * @method passes() checks if validation passed
 * @method fails() checks if validation failed
 * @method error() returns the error messages
 *
 **/

class Validator {
	
	/**
     * Template for error messages.
     *
     * @var array
     */
	protected $messageTemplate = [

    'alpha' 		=> 'The :attribute may only contain letters.',
    'alpha_dash' 	=> 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' 	=> 'The :attribute may only contain letters and numbers.',
    'email' 		=> 'The :attribute must be a valid email address.',
    'max' 			=> 'The :attribute may not be greater than :max',    
    'min' 			=> 'The :attribute must be at least :min',
    'mixed' 		=> 'The :attribute contains invalid characters',        
    'numeric' 		=> 'The :attribute must be a number.',
    'required' 		=> 'The :attribute field is required.',
    'unique' 		=> 'The :attribute has already been taken.',
    'image'         => 'Upload valid images. Only PNG and JPEG are allowed.'
    ];

    /**
     * error messages.
     *
     * @var array
     */
    protected $messages =[];

    /**
     * The data under validation.
     *
     * @var array
     */
    protected $data;

    /**
     * The initial rules provided.
     *
     * @var array
     */
    protected $initialRules;

    /**
     * The rules to be applied to the data.
     *
     * @var array
     */
    protected $rules;

    /**
     * The failed validation rules.
     *
     * @var array
     */
    protected $failedRules = [];

    /**
     * Create a new Validator instance.
     *
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @return void
     **/
    protected function __construct( array $data, array $rules)
    {
    	$this->data = $data;

    	$this->initialRules = $rules;

    	//Parse the human-friendly rules into a full rules array for the validator.
    	$this->setRules($rules);
    }

    /**
     * Set the validation rules.
     *
     * @param  array  $rules
     * @return void
     */
    protected function setRules($rules)
    {
    	// $rules = ['name' => 'unique:categories|min:5|max:25|email']
    	// Explode the rules into an array of explicit rules
    	foreach ($rules as $key => $rule) {
    		
    		$rules[$key] = explode('|', $rule);
    	}

    	// output ['name' => ['unique:categories','min:5','max:25','email']]
    	$this->rules = $rules;
    }

    /**
     * Determine if the data passes the validation rules.
     *
     * @return bool
     */
    public function passes()
    {
    	// We will loop through each attribute and validate
        // it against the provided rules
        //['name' => ['unique:categories','min:5','max:25','email']]
        foreach ($this->rules as $attribute => $rules) {        	

            foreach ($rules as $rule) {
        	
        		// Check if attribute is a file
                if (in_array('file', $rules)) {
                
                    $this->validateFile($attribute, $rule);

                } else {

                    $this->validateAttribute($attribute, $rule);
                }                
        	}
        }

        if( count($this->failedRules))
        {
        	return false;
        }

        return true;

    }

    /**
     * Validates the file against a rule.
     *
     * @param  string  $attribute
     * @param  string  $rule
     * @return void
     */
    protected function validateFile($attribute, $rule)
    {
        // 'name' , 'unique:categories' or 'email'
        // 'product_image' , 'file|image|min:250|max:2048'
        list($rule, $parameter) = array_pad(explode(':', $rule), 2, null);

        $valid = call_user_func([$this, $rule],
                                $attribute,
                                $this->data[$attribute],
                                $parameter);
        if (!$valid) {
            
            $this->addFailure($attribute, $rule, $parameter, true);
        }
    }

    /**
     * Validate a given attribute against a rule.
     *
     * @param  string  $attribute
     * @param  string  $rule
     * @return void
     */
    protected function validateAttribute($attribute, $rule)
    {
    	// 'name' , 'unique:categories' or 'email'
        list($rule, $parameter) = array_pad(explode(':', $rule), 2, null);

        $valid = call_user_func([$this, $rule],
                				$attribute,
                				$this->data[$attribute],
                				$parameter);        

        if (!$valid) {
        	
        	$this->addFailure($attribute, $rule, $parameter);
        }
    }

    /**
     * Add a failed rule and error message to the collection.
     *
     * @param  string  $attribute
     * @param  string  $rule
     * @param  string  $parameter
     * @return void
     */
    protected function addFailure($attribute, $rule, $parameter = '', $is_file = false)
    {
    	$this->failedRules[$attribute][$rule] = $parameter;

    	if ($is_file)
        {            
            $this->messages[] = str_replace([':attribute', ':min', ':max'],
                                        [$attribute, "{$this->convertBytes($parameter)} size.",
                                                     "{$this->convertBytes($parameter)} size."],
                                        $this->messageTemplate[$rule]);
        } else
        {
            $this->messages[] = str_replace([':attribute', ':min', ':max'],
                                        [$attribute, "{$parameter} characters.", "{$parameter} characters."],
                                        $this->messageTemplate[$rule]);
        }
        
    }

    /**
     * Convert bytes to Kb/Mb
     *
     * @param  string/int  $value in Bytes
     * 
     * @return value in Kb/Mb
     */
    protected function convertBytes($value)
    {
        if ( (int) $value < 1024) {
            
            return "{$value} Bytes";
        }

        if ( (int) $value < 1048576) {
            
            $valueKB = (int) $value/1024;

            return "{$valueKB} KB";
        }

        if ( (int) $value < 1073741824) {
            
            $valueMB = (int) $value/1048576;

            return "{$valueKB} MB";
        }
        
    }

    protected function convertToMb($value)
    {
        return (int) $value/1048576;
    }

    /**
     * Display error message.
     *
     * @return array An array of error messages
     */
    public function errors()
    {
    	return $this->messages;
    }

    /**
     * Determine if the data fails the validation rules.
     *
     * @return bool
     */
    public function fails()
    {
        return ! $this->passes();
    }

	/**
     * Create a new Validator instance.
     *
     * @param  array|object  $data
     * @param  array  		$rules
     * @return self
     */
	public static function make ($data, array $rules)
	{
		// $data = ['name' => 'abcd', 'token' => ' addf48u5']
		// $rules = ['name' => 'unique:categories|min:5|max:25']
		
		// Get the keys for whom rules are defined
		// Typecast to array if object is provided
		$data = array_intersect_key((array)$data, $rules);

		return new static($data, $rules);
	}


	/**
     * Checks if the file is uploaded
     *
     **/
    protected function file($column, $value, $policy)
    {
        return true;

        //return file_exists($value->tmp_name);
    }

    /**
     * Checks if the file is image
     *
     **/
    protected function image($column, $value, $policy)
    {
        $allowed_image_extension = ['png', 'jpg', 'jpeg'];
        
        // If file doesn't exist, prevent multiple errors
        if (! file_exists($value->tmp_name)) {
            return true;
        }

        // Get image file extension
        $file_extension = pathinfo($value->name, PATHINFO_EXTENSION);

        return in_array($file_extension, $allowed_image_extension);
    }

    /**
	 * Checks if the given field matches the field under validation
	 *
	 **/
	protected function unique($column, $value, $policy)
	{
		if (empty(trim($value))) {
			return true;
		}
		return Capsule::table($policy)->where($column, $value)->doesntExist();
	}

    /**
     * Update error message template for given rule
     * column:password2, value:error, policy:'same@Passwords do not match'
     *
     **/
    protected function error($column, $value, $policy)
    {
        list($rule, $errorMessage) = array_pad(explode('@', $policy), 2, null);

        $this->messageTemplate[$rule] = $errorMessage;
        
        return true;
    }

    /**
     * Checks if the value is unique
     *
     **/
    protected function same($column, $value, $policy)
    {
        return $value == $this->data[$policy];
    }

	/**
	 * Check if value is not empty
	 *
	 * returns True if the value is not empty and False, if not
	 *
	 **/
	protected function required($column, $value, $policy)
	{
		// If it's a file, check if file exist
        if (is_object($value)) {
            
            return file_exists($value->tmp_name);
        }        

        return !empty(trim($value));
	}

	/**
	 * Check if string length >= minimum
     * or File size >= minimum
	 *
	 **/
	protected function min($column, $value, $policy)
	{
		// If it's a file, check size
        if (is_object($value)) {
			
            // If file doesn't exist, prevent multiple errors
            if (! file_exists($value->tmp_name)) {
            
                return true;
            }

            return $value->size >= $policy;
		}

        if(empty(trim($value)))
        {
            return true;
        }

		return strlen($value) >= $policy;
	}

	/**
	 * Check if string length <= maximum
     * or File size <= maximum
	 *
	 **/
	protected function max($column, $value, $policy)
	{
		// If it's a file, check size
        if (is_object($value)) {
            
            // If file doesn't exist, prevent multiple errors
            if (! file_exists($value->tmp_name)) {
            
                return true;
            }

            return $value->size <= $policy;
        }

        if(empty(trim($value)))
        {
            return true;
        }

		return strlen($value) <= $policy;
	}

	/**
	 * Check if the value is valid Email address
	 *
	 **/
	protected function email($column, $value, $policy)
	{
		if (empty(trim($value))) {
            return true;
        }

        if (!is_string($value)) {
			return false;
		}
        
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	/**
	 * Check if the value is mixed [a-z][A-Z]numbers and special chars
	 *
	 **/
	protected function mixed($column, $value, $policy)
	{
		if(empty(trim($value)))
		{
			return true;
		}

		if(!preg_match('/^[a-zA-Z0-9.,_~@&%\\s\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:\-\#]+$/', $value))
		{
			return false;
		}

		return true;
	}

	/**
	 * Check if value is only Alphabets
	 *
	 **/
	protected function alpha($column, $value, $policy)
	{
		if(empty(trim($value)))
		{
			return true;
		}

		if(!preg_match('/^[a-zA-Z]+$/', $value))
		{
			return false;
		}

		return true;
	}

	/**
	 * Check if value is only Alphabets
	 *
	 **/
	protected function alpha_dash($column, $value, $policy)
	{
		if(empty(trim($value)))
		{
			return true;
		}

		if(!preg_match('/^[a-zA-Z_\-]+$/', $value))
		{
			return false;
		}

		return true;
	}

	/**
	 * Check if value is only Alphabets and numbers
	 *
	 **/
	protected function alpha_num($column, $value, $policy)
	{
		if(empty(trim($value)))
		{
			return true;
		}

		if(!preg_match('/^[a-zA-Z0-9]+$/', $value))
		{
			return false;
		}

		return true;
	}

	/**
	 * Check if value is number
	 *
	 **/
	protected function numeric($column, $value, $policy)
	{
		if(empty(trim($value)))
		{
			return true;
		}

		if(!preg_match('/^[0-9.,]+$/', $value))
		{
			return false;
		}

		return true;
	}

}


 ?>