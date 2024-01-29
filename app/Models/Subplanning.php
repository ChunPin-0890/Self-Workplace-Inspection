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
    public function inspections() {

        // return $this->belongsToMany(Inspection::class, 'execution_inspection');
        return $this->hasMany(Inspection::class, 'id', 'inspection_id');
    
    }

public static function createAllChildren(Inspection $inspection, $subplanning_id, $user_id)
    {

        static::create([
            'subplanning_id' => $subplanning_id,
            'inspection_id' => $inspection->id,
            'user_id' => $user_id
        ]);

        for ($i = 0; $i < count($inspection?->children); $i++) {

            static::createAllChildren($inspection?->children[$i], $subplanning_id, $user_id);

        }

    }

}
