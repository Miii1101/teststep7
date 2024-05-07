<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // ProductモデルとCompanyモデルのリレーションシップを定義
    public function company() {
        // ProductがbelongsToで関連づけられるCompanyモデルを返す
        return $this->belongsTo(Company::class);
    }
}
