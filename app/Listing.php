<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    //protected $fillable = ['title', 'company', 'email', 'location', 'website', 'tags', 'desc'];
    //scop filtering
    public function scopeFilter($query, array $filters){
        //dd($query);
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%'. request('tag'). '%');
        }

        if($filters['search'] ?? false){
            $query->where('title', 'like', '%'. request('search'). '%')->
            orWhere('desc', 'like', '%'. request('search'). '%')->
            orWhere('tags', 'like', '%'. request('search'). '%');
        }
    }

    //relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
