<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $category
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $users
 */
class Category extends Model
{
    protected $fillable = ['category'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
