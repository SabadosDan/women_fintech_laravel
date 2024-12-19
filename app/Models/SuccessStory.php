<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class SuccessStory extends Model
{
    protected $table = 'success_stories';

    use HasFactory;

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
