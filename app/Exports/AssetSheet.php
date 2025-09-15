<?php

namespace App\Exports;

use App\Models\asset_information;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class AssetSheet implements FromArray, WithTitle
{
    protected $year;

    public function __construct($year) { $this->year = $year; }

    public function array(): array
    {
        $reportData = asset_information::with('company')
            ->select('company_id','assetCode','assetName','purchase_price')
            ->selectRaw('MONTH(purchase_date) as month')
            ->whereYear('purchase_date', $this->year)
            ->orderBy('month')
            ->get();

        $data = [];

        $data[] = array_merge(['บริษัท','AssetCode','AssetName','เดือน','ราคา']);

        foreach ($reportData as $row) {
            $data[] = [
                $row->company->company_name_th ?? '',
                $row->assetCode,
                $row->assetName,
                $row->month,
                $row->purchase_price,
            ];
        }

        return $data;
    }

    public function title(): string
    {
        return 'ทรัพย์สิน';
    }
}
