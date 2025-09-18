@component('mail::message')
# แจ้งดำเนินการซ่อม

มีการแจ้งเรื่องซ่อม :

- **ชื่ออุปกรณ์ :** {{ $maintenance->asset_information->assetCode ?? $maintenance->repair_name }}
- **วันที่แจ้งซ่อม :** {{ $maintenance->repair_date_formatted }}
- **เหตุผลการซ่อม :** {{ $maintenance->repair_reason }}
- **ผู้แจ้งซ่อม :** {{ $maintenance->presenterUser->full_name }}

@component('mail::button', ['url' => url('/maintenance/view-audit?id=' . $maintenance->id)])
ดูรายละเอียด
@endcomponent

โปรดตรวจสอบข้อมูล
@endcomponent