<?php

namespace App\Exports;

use App\Models\asset_information;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssetExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $assets;

    public function __construct($assets)
    {
        $this->assets = $assets;
    }

    public function collection()
    {
        return $this->assets->map(function ($row) {
            return [
                'รูปทรัพย์สิน'   => $row->images ? asset('storage/' . $row->images) : 'ไม่มีรูป',
                'Qr Code'   => $row->qrCode ? asset('storage/' . $row->qrCode) : 'ไม่มี Qr Code',
                'Asset Code'   => $row->assetCode,
                'Asset Name'   => $row->assetName,
                'บริษัท'      => $row->company->company_name ?? '-',
                'แผนก'      => $row->department->department_name ?? '-',
                'สาขา'      => $row->branch->branch_name ?? '-',
                'ตำแหน่งรับผิดชอบ'      => $row->position->position_name ?? '-',
                'location ย่อย' => $row->location_sub,
                'ราคา'   => $row->purchase_price,
                'วันที่ซื้อ'   => $row->purchase_date,
                'วันที่หมดประกัน'   => $row->expiration_date,
                'สถานะ'   => $row->status,
                'สถานะทรัพย์สิน'   => $row->asset_status,
                'รายละเอียดทรัพย์สิน'   => $row->detail_property,
                'สาเหตุ'   => $row->purchase_reason,
                'ผู้แจ้งซื้อ'   => $row->presenter,
            ];
        });
    }

    public function headings(): array
    {
        return ['รูปทรัพย์สิน', 'Qr Code', 'Asset Code', 'Asset Name', 'บริษัท', 'แผนก', 'สาขา', 'ตำแหน่งรับผิดชอบ', 'location ย่อย', 'ราคา', 'วันที่ซื้อ', 'วันที่หมดประกัน', 'สถานะ', 'สถานะทรัพย์สิน', 'รายละเอียดทรัพย์สิน', 'สาเหตุ', 'ผู้แจ้งซื้อ'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DDDDDD']
                ]
            ]
        ];
    }
}
