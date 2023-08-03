<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $fillable = [
        'name',
        'year'
    ];
    use HasFactory;

    public function inspections()
    {
        return $this->hasMany(Inspection::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Subplanning::class, 'planning_id', 'id');
    }
}
