<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thirdlayerinspection extends Model
{   use HasFactory;
    protected $table = 'inspections';
    protected $fillable = ['name'];

    /**
     * Get the parent subcategory inspection for the third layer inspection.
     */
    public function subcatinspection()
    {
        return $this->belongsTo(Subcatinspection::class, 'subcatinspection_id');
    }

    // Additional methods and relationships for the Thirdlayerinspection model
    public function inspection()
    {
        return $this->belongsTo(Inspection::class, 'inspection_id');
    }
}
