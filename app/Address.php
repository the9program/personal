<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $address
 * @property int $build
 * @property int $floor
 * @property int $apt_nbr
 * @property int $zip
 * @property int $city_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property City $city
 */
class Address extends Model
{
    protected $fillable = ['address', 'build', 'floor', 'apt_nbr', 'zip', 'city_id'];

    protected $table = 'addresses';

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
