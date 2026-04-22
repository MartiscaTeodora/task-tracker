<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function isCompleted()
    {
        if($this->status==1) return true;
        return false;

    }
    public function colab()
    {   if($this->project==null) return false;
        if($this->project->col()){
             return true;
        }
        return false;

    }
}
