<?php

namespace App\Models;

use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManualPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description',
        'status',
    ];
}
