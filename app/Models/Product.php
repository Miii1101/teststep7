<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_path',
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment',
        'created_at',
        'updated_at',
    ];

    use Sortable;
    public $sortable = [
        'id', 'product_name', 'price', 'stock', 'company_id'
    ];

    // ProductモデルとCompanyモデルのリレーションシップを定義
    public function company() {
        // ProductがbelongsToで関連づけられるCompanyモデルを返す
        return $this->belongsTo(Company::class);
    }
}
