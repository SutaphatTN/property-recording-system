<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * @mixin IdeHelperasset_maintenance
 */
class asset_maintenance extends Model
{
    use SoftDeletes;

    protected $table = 'asset_maintenance';

    protected $fillable = [
        'asset_id',
        'result_date',
        'repair_name',
        'repair_reason',
        'repair_price',
        'presenter',
        'repair_date',
        'process_date',
        'note',
        'quotation',
        'approver',
        'approv_date',
        'status',
        'operator',
        'category',
        'repair_result',
    ];

    protected $dates = ['deleted_at'];

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_FINISHED = 'finished';

    public function asset_information()
    {
        return $this->belongsTo(asset_information::class, 'asset_id', 'id');
    }
}
