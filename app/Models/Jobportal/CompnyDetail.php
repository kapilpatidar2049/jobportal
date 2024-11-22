<?php
namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompnyDetail extends Model
{
    use HasFactory;

    protected $table = 'compny_details';

    // Fillable fields
    protected $fillable = [
        'user_id',
        'name',
        'company_name',
        'employees',
        'heared_about_us',
        'phone',
        'country',
        'language',
        'industry',
        'sub_industry',
        'description',
        'gst_number',
        'foundedin',
        'website'
    ];

    /**
     * Create or update a record with the given attributes and values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function createOrUpdate(array $attributes, array $values = [])
    {
        // Look for an existing record with the given attributes (e.g., user_id)
        $instance = static::where($attributes)->first();

        if ($instance) {
            // If the record exists, update it
            $instance->update($values);
            return $instance;
        }

        // If no record exists, create a new one with the provided attributes and values
        return static::create(array_merge($attributes, $values));
    }
}
