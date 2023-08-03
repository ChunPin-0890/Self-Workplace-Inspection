<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionForm extends Model
{
    use HasFactory;

protected $fillable = ['users'];

public function opr()
{
    return $this->belongsTo(User::class,'user_id');


}

public function works()
{
    return $this->hasMany(Work::class);
}

}
