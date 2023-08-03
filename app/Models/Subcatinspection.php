<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcatinspection extends Model
{
    use HasFactory;
    protected $table = 'inspections';
    protected $fillable = [
        'name',
        // Other attributes...
    ];

    /**
     * Get the inspection associated with the subcategory inspection.
     */
    public function inspection()
    {
        return $this->belongsTo(Inspection::class, 'inspection_id');
    }

    /**
     * Get the third layer inspections associated with the subcategory inspection.
     */
    public function thirdlayerinspections()
    {
        return $this->hasMany(Thirdlayerinspection::class, 'subcatinspection_id');
    }
}
