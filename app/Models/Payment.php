<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table="payments";
     protected $fillable = [
        'user_id',
        'plan_id',
        'status',
     ];
     
      public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
// public function plan()
//    {
//     return $this->hasMany('App\Models\Plan');
//    }
}
