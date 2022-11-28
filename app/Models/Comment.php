<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    // protected $guraded = [];
   protected $fillable = ['post_id','body','user_id'] ;
    public function user(){
        
        return $this->belongsTo(User::class);
    }
     // convert date
     public function getCreatedAtAttribute($date)
     {
         return Carbon::parse($date)->format('d M Y H:i');
     }
}
