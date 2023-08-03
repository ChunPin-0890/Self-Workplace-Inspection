<?php

namespace App\Models;
use App\Models\Execution;
use App\Models\Oprunit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subplanning extends Model

{
    use HasFactory;

    protected $table = 'subplannings';
    protected $fillable = [
        'start_date',
        'end_date',
        'planning_id'
    ];
    
    public function parent()
    {

        return $this->belongsTo(Planning::class, 'planning_id', 'id');

    }
    
    public function groups(){

        return $this->belongsToMany(Group::class, 'schedule_group');
    
    }

    public function operatingUnits(){

        return $this->belongsToMany(OprUnit::class, 'schedule_ou', 'subplanning_id', 'ou_id');
    
    }

    public function executions()
    {
        return $this->hasMany(Execution::class);
    }
}
