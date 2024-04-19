<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'title', 'description', 'borrowed_by', 'returned_by', 'borrowed_date', 'returned_date'];

    // Define relationship with User for borrowed_by
    public function borrowedBy()
    {
        return $this->belongsTo(User::class, 'borrowed_by');
    }

    // Define relationship with User for returned_by
    public function returnedBy()
    {
        return $this->belongsTo(User::class, 'returned_by');
    }

    // Accessor to get the name of the borrower
    public function getBorrowedByNameAttribute()
    {
        return $this->borrowedBy ? $this->borrowedBy->name : null;
    }

    // Accessor to get the name of the returner
    public function getReturnedByNameAttribute()
    {
        return $this->returnedBy ? $this->returnedBy->name : null;
    }

    // Generate unique slug based on title
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
