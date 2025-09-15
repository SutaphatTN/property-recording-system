<?php

namespace App\Exports;

use App\Models\asset_maintenance;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class MaintenanceSheet implements FromArray, WithTitle
{
    protected $year;

    public function __construct($year) { $this->year = $year; }

    public function array(): array
    {
        $reportData = asset_maintenance::with('asset_information.company')
            ->select('asset_id','repair_price')
            ->selectRaw('MONTH(repair_date) as month')
            ->whereYear('repair_date', $this->year)
            ->where('status','finished')
            ->orderBy('month')
            ->get();

        $data = [];
        $data[] = ['บริษัท','AssetCode','AssetName','เดือน','ราคา'];

        foreach ($reportData as $row) {
            if ($row->asset_information && $row->asset_information->company) {
                $data[] = [
                    $row->asset_information->company->company_name_th,
                    $row->asset_information->assetCode,
                    $row->asset_information->assetName,
                    $row->month,
                    $row->repair_price,
                ];
            }
        }

        return $data;
    }

    public function title(): string
    {
        return 'การซ่อม';
    }
}
