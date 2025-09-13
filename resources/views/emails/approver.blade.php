@component('mail::message')
# แจ้งขออนุมัติซ่อม

เรียน {{ $maintenance->approverUser->name ?? 'ผู้อนุมัติ' }}

มีการขออนุมัติซ่อม :

- **ชื่ออุปกรณ์ :** {{ $maintenance->asset_information->assetName ?? $maintenance->repair_name }}
- **รหัสทรัพย์สิน :** {{ $maintenance->asset_information->assetCode ?? '-' }}
- **ราคาซ่อม :** {{ number_format($maintenance->repair_price, 2) }} บาท
- **ผู้ขออนุมัติ :** {{ $maintenance->presenter }}

@component('mail::button', ['url' => url('/maintenance/view-approval?id=' . $maintenance->id)])
ดูรายละเอียด
@endcomponent

ขอแสดงความนับถือ,<br>
{{ $maintenance->presenter }}
@endcomponent
