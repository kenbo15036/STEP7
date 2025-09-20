<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * メーカー一覧を取得する 
     */
    public static function getAllCompanies()
    {
        return self::all();
    }
}
