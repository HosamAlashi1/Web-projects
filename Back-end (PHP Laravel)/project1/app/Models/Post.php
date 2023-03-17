<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title','description','user_id'];
    // before create this relation must create forgein key by create migration to this column look the file php explian
    // one to many relation
    public function user(){
        return $this->belongsTo(User::class); // User::class >> user modle 
    }
}
