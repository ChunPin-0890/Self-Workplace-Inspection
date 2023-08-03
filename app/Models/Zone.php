<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';
    protected $fillable = [
        'type'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'zone_group');
    }

}
