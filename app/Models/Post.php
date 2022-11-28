<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guareded = [];
   
      protected $fillable = ['title','body','category_id','photo','slug','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->orderby('created_at','DESC');
    }
    
    public function scopeLatest($query){
        return $query->orderBy('created_at','DESC');
    }
    // convert date
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d M Y H:i');
    }
    public function getRouterKeyName(){
        return 'slug';
    }

}
