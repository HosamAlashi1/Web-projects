<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';
    protected $fillable = ['name', 'abbr', 'locale', 'direction', 'active', 'created_at', 'updated_at'];


    // local scope when you need to call this method you call like : active()
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    // local scope when you need to call this method you call like : select()
    public function scopeSelection($query)
    {
        return $query->select('id','abbr', 'direction', 'name', 'active');
    }

     
    public function getActive()
    {
        return $this->active == 1 ? 'مفعلة' : 'غير مفعلة';
    }


    public function getDirection()
    {
        return $this->direction == 'ltr' ? 'من اليسار الى اليمين' : 'من اليمين الى اليسار';
    }
}
