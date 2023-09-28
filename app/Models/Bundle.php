<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;

class Bundle extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at', 'updated_at'];
    const MONTHLY = 1;
    const QUARTERLY = 2;
    const SEMI_ANNUAL = 3;
    const ANNUAL = 4;

    public function label()
    {
        return match($this->payment_system)
        {
            self::MONTHLY => 'شهري',
            self::QUARTERLY => 'ربع سنوي',
            self::SEMI_ANNUAL => 'نصف سنوي',
            self::ANNUAL => 'سنوي',
            default => 'unknown',
        };
    }

    public static function getPaymentSystem(){
        return [
                self::MONTHLY,
                self::QUARTERLY,
                self::SEMI_ANNUAL,
                self::ANNUAL,
            ];
    }



    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

}
