<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $table="plans";
    protected $fillable = [
        'nameEN',
        'nameAR',
        'slug',
        'price',
        'daily_transfer_amount',
        'duration',
        'currency',
        'descriptionEN',
        'descriptionAR',
        'status',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
     public function payments()
    {
        return $this->hasMany(Payment::class);
    }

//      public function payment(){
//     return $this->belongsTo('App\Models\Payment');
// }
}
