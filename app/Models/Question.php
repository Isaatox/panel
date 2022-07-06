<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $replies
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'answer',
        'replies',
        'validate',
    ];

    const UPDATED_AT = null;

    public function replies()
    {
        return explode(',', $this->replies);
    }

}
