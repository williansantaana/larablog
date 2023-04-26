<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, mixed $user_id)
 * @method static create(array $input)
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['contPost::all();ent'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
