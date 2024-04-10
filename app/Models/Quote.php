<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'author', 'created_by'];

    // Define relationship with User for created_by
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
