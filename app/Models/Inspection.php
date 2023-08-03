<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
       
        'type',
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Inspection::class, 'parent_id', 'id');

    }
    public function parent()
    {
        return $this->belongsTo(Inspection::class, 'parent_id');
    }
    
    public function topParent()
    {
        return $this->parent ? $this->parent->topParent() : $this;
    }
}