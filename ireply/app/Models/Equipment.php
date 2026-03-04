<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'type',
        'status',
        'description',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}

