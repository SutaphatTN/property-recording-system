<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperasset_information
 */
class asset_information extends Model
{
    use SoftDeletes;

    protected $table = 'asset_information';

    protected $fillable = [
        'images',
        'assetCode',
        'assetName',
        'qrCode',
        'detail_property',
        'company_id',
        'branch_id',
        'location_sub',
        'department_id',
        'position_id',
        'purchase_date',
        'expiration_date',
        'purchase_price',
        'purchase_reason',
        'status',
        'presenter',
        'asset_status',
    ];

    protected $dates = ['deleted_at'];

    public function presenterUser()
    {
        return $this->belongsTo(User::class, 'presenter', 'id');
    }

    public function asset_maintenance()
    {
        return $this->hasMany(asset_maintenance::class, 'asset_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(company::class);
    }

    public function branch()
    {
        return $this->belongsTo(branch::class);
    }

    public function department()
    {
        return $this->belongsTo(department::class);
    }

    public function position()
    {
        return $this->belongsTo(position::class);
    }

    public function getPurchaseDateFormattedAttribute()
    {
        return $this->purchase_date
            ? \Carbon\Carbon::parse($this->purchase_date)->format('d/m/Y')
            : '-';
    }

    public function getExpirationDateFormattedAttribute()
    {
        return $this->expiration_date
            ? \Carbon\Carbon::parse($this->expiration_date)->format('d/m/Y')
            : '-';
    }
}
