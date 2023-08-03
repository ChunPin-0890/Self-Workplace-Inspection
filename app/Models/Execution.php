<?php

namespace App\Models;
use App\Models\Inspection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    use HasFactory;
    protected $table = 'executions';

    protected $fillable = [
        'subplanning_id',
        'inspection_id',
        'user_id',
        'status',
        'comment'
    ];
   
    public function inspection() {

        // return $this->belongsToMany(Inspection::class, 'execution_inspection');
        return $this->hasOne(Inspection::class, 'id', 'inspection_id');
    
    }

    
    public function parent()
    {
        return $this->belongsTo(Subplanning::class, 'subplanning_id');
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
