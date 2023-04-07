<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // DISABLING MASS ASSIGNMENT
    protected $guarded = [];


    public function followers() {
        return $this->belongsToMany(User::class);
    }

    public function profileImage(){
        $imagePath = ($this->image) ? $this->image : 'profile/8SFrTFmdD2J1DP7UdVoc19WbE3Is5XFVXwStb3ed.jpg';
        return '/storage/' . $imagePath;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
