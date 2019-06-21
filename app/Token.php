<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $token
 * @property string $email
 * @property int $creator_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $creator
 */
class Token extends Model
{
    protected $fillable = ['token', 'email', 'creator_id'];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
