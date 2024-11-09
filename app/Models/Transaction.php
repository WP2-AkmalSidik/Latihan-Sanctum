<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tambahkan atribut yang ingin diizinkan untuk mass assignment
    protected $fillable = [
        'title',
        'description',
        'amount',
        'type',
        'transaction_date',
        'user_id' // jika `user_id` juga diisi secara otomatis
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
