<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;
    use HasFactory;
    protected $fillable = ['mobile','email','password','name','address','category_id','active','logo','created_at','updated_at'];
    protected $hidden = ['category_id'];

    // local scope when you need to call this method you call like : active()
    public function scopeActive($query){
        return $query->where('active',1);
    }
    // local scope when you need to call this method you call like : select() || selection()
    public function scopeSelection($query){
        return $query->select('id','category_id','name','logo','mobile','password','email','active');
    }

    public function getActive(){
        return $this->active == 1  ? " مفعلة" : "غير مفعلة";
    }

    // Mutators for get photo
    public function getLogoAttribute($val){
        return $val !== null ? asset($val) : '';
    }

    // Accessor for set password
    public function setPasswordAttribute($pass){
        $this ->attributes['password'] = bcrypt($pass);
    }

    ################ Relations ##################

    public function MainCategory(){
        return $this-> belongsTo('App\Models\MainCategory','category_id','id');
    }

} 
 