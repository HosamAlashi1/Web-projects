<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $table = 'main_categories';
    protected $fillable = ['translation_lang','translation_of','name','slug','photo','active','created_at','updated_at'];

    // local scope when you need to call this method you call like : active()
    public function scopeActive($query){
        return $query -> where('active',1);
    }
    // local scope when you need to call this method you call like : select() || selection()
    public function scopeSelection($query){
        return $query->select('id','translation_lang','name','slug','photo','active','translation_of');
    }

    public function getActive(){
        return $this->active == 1  ? " مفعلة" : "غير مفعلة";
    }

    // Accessors for get photo
    public function getPhotoAttribute($val){
        return $val !== null ? asset($val) : '';
    }

    ################ Relations ##################

    // slef relation
    public function categories(){
        return $this->hasMany(self::class,'translation_of');
    }

    public function vendors(){
        return $this-> hasMany('App\Models\Vendor','category_id','id');
    }

}

