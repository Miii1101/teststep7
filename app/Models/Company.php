<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use HasFactory;

    // テーブル名の指定
    protected $table = 'companies';

    // Mass Assignmentで許可する属性
    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name'
    ];

    // ソート機能追加
    use Sortable;
    public $sortable = [
        'id',
        'company_name'
    ];
}
