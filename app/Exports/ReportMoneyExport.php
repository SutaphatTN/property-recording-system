<?php

namespace App\Exports;

use App\Models\asset_information;
use App\Models\asset_maintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportMoneyExport implements WithMultipleSheets
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function sheets(): array
    {
        return [
            new AssetSheet($this->year),
            new MaintenanceSheet($this->year)
        ];
    }
}
