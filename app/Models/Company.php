<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // テーブル名の指定
    protected $table = 'companies';

    // Mass Assignmentで許可する属性
    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name',
    ];
}
