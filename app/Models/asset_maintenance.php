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

    public function approverUser()
    {
        return $this->belongsTo(User::class, 'approver', 'id');
    }

    public function getApproverNameAttribute()
    {
        $user = User::find($this->approver);
        return $user ? $user->name : '-';
    }

    public function getApprovDateThaiAttribute()
    {
        $months = [
            1 => 'มกราคม',
            2 => 'กุมภาพันธ์',
            3 => 'มีนาคม',
            4 => 'เมษายน',
            5 => 'พฤษภาคม',
            6 => 'มิถุนายน',
            7 => 'กรกฎาคม',
            8 => 'สิงหาคม',
            9 => 'กันยายน',
            10 => 'ตุลาคม',
            11 => 'พฤศจิกายน',
            12 => 'ธันวาคม'
        ];

        $date = Carbon::parse($this->approv_date);
        return $date->day . ' ' . $months[$date->month] . ' ' . ($date->year + 543);
    }

    private function thaiBahtText($number)
    {
        $txtnum1 = ['ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];
        $txtnum2 = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];
        $number = str_replace(',', '', $number);
        $number = str_replace(' ', '', $number);
        $number = str_replace('บาท', '', $number);
        $number = explode('.', $number);
        $strlen = strlen($number[0]);
        $convert = '';
        for ($i = 0; $i < $strlen; $i++) {
            $n = substr($number[0], $i, 1);
            if ($n != 0) {
                if ($i == ($strlen - 1) && $n == 1 && $strlen > 1) {
                    $convert .= 'เอ็ด';
                } elseif ($i == ($strlen - 2) && $n == 2) {
                    $convert .= 'ยี่';
                } elseif ($i == ($strlen - 2) && $n == 1) {
                    $convert .= '';
                } else {
                    $convert .= $txtnum1[$n];
                }
                $convert .= $txtnum2[$strlen - $i - 1];
            }
        }
        $convert .= 'บาทถ้วน';
        return $convert;
    }

    public function getRepairPriceTextAttribute()
    {
        return $this->thaiBahtText($this->repair_price);
    }

    public function getResultDateFormattedAttribute()
    {
        return $this->result_date
            ? \Carbon\Carbon::parse($this->result_date)->format('d/m/Y')
            : '-';
    }

    public function getRepairDateFormattedAttribute()
    {
        return $this->repair_date
            ? \Carbon\Carbon::parse($this->repair_date)->format('d/m/Y')
            : '-';
    }

    public function getProcessDateFormattedAttribute()
    {
        return $this->process_date
            ? \Carbon\Carbon::parse($this->process_date)->format('d/m/Y')
            : '-';
    }

    public function getApprovDateFormattedAttribute()
    {
        return $this->approv_date
            ? \Carbon\Carbon::parse($this->approv_date)->format('d/m/Y')
            : '-';
    }
}
