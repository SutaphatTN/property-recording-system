<?php

namespace App\Http\Controllers;

use App\Models\asset_information;
use App\Models\asset_maintenance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\branch;
use App\Models\company;
use App\Models\department;
use App\Models\position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AssetExport;
use App\Exports\ReportMoneyExport;

class AssetController extends Controller
{

    public function index()
    {
        $asset = asset_information::with(['company', 'branch', 'department', 'position'])->get();
        return view('assetData.view', compact('asset'));
    }

    public function show($id)
    {
        $asset = asset_information::with(['company', 'branch', 'department', 'position'])->findOrFail($id);
        return view('assetData.show', compact('asset'));
    }

    public function viewMore($id)
    {
        $asset = asset_information::findOrFail($id);
        $companies = company::all();
        $branches = branch::all();
        $departments = department::all();
        $positions = position::all();

        $maintenances = asset_maintenance::where('asset_id', $id)
            ->where('status', 'finished')
            ->orderBy('repair_date', 'desc')
            ->get();

        return view('assetData.viewMore', compact('asset', 'companies', 'branches', 'departments', 'positions', 'maintenances'));
    }

    public function getByCompany($companyId)
    {
        $departments = department::whereRaw("FIND_IN_SET('" . $companyId . "', company_id)")->get();
        $branches = branch::whereRaw("FIND_IN_SET('" . $companyId . "', company_id)")->get();

        return response()->json([
            'departments' => $departments,
            'branches' => $branches
        ]);
    }

    public function create()
    {
        $companies = company::all();
        $branches = branch::all();
        $departments = department::all();
        $positions = position::all();

        return view('assetData.store', compact('companies', 'branches', 'departments', 'positions'));
    }

    public function store(Request $request)
    {
        try {
            $exists = asset_information::where('assetCode', $request->assetCode)->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'มีข้อมูล Asset Code นี้แล้ว กรุณากรอก Asset Code ใหม่'
                ], 400);
            }

            $data = [
                'assetCode' => $request->assetCode,
                'assetName' => $request->assetName,
                'detail_property' => $request->detail_property,
                'company_id' => $request->company_id,
                'branch_id' => $request->branch_id,
                'location_sub' => $request->location_sub,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
                'purchase_date' => $request->purchase_date,
                'expiration_date' => $request->expiration_date,
                'purchase_price' => str_replace(',', '', $request->purchase_price),
                'purchase_reason' => $request->purchase_reason,
                'status' => $request->status,
                'presenter' => $request->presenter,
                'asset_status' => $request->asset_status,
            ];

            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());

                $img = $manager->read($image)->scaleDown(width: 1200);
                $img->save(storage_path('app/public/uploads/' . $filename));

                $data['images'] = 'uploads/' . $filename;
            }

            $asset = asset_information::create($data);

            $assetText = route('maintenance.createFromQr', ['asset_id' => $asset->id]);
            $qrFile = "qrcodes/{$request->assetCode}.png";

            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($assetText)
                ->size(300)
                ->margin(10)
                ->build();

            Storage::disk('public')->put($qrFile, $result->getString());
            $asset->update(['qrCode' => $qrFile]);

            return response()->json([
                'success' => true,
                'message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function edit($id)
    {
        $asset = asset_information::findOrFail($id);
        $companies = company::all();
        $branches = branch::all();
        $departments = department::all();
        $positions = position::all();

        return view('assetData.edit', compact('asset', 'companies', 'branches', 'departments', 'positions'));
    }

    public function update(Request $request, $id)
    {
        try {
            $asset = asset_information::findOrFail($id);

            $data = $request->except(['_token', '_method']);

            if ($request->purchase_price) {
                $data['purchase_price'] = str_replace(',', '', $request->purchase_price);
            }

            if ($request->hasFile('images')) {
                if ($asset->images && Storage::disk('public')->exists($asset->images)) {
                    Storage::disk('public')->delete($asset->images);
                }

                $data['images'] = $request->file('images')->store('uploads', 'public');
            }

            $asset->update($data);

            return response()->json([
                'success' => true,
                'message' => 'แก้ไขข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $asset = asset_information::findOrFail($id);

            if ($asset->asset_maintenance()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่สามารถลบข้อมูลนี้ได้ เนื่องจากอยู่ในรายการซ่อม'
                ], 400);
            }

            if ($asset->images && Storage::disk('public')->exists($asset->images)) {
                Storage::disk('public')->delete($asset->images);
            }

            $asset->delete();

            return response()->json([
                'success' => true,
                'message' => 'ลบข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function createAsset()
    {
        $companies = company::all();
        $branches = branch::all();
        $departments = department::all();
        $positions = position::all();

        return view('assetData.storeAsset', compact('companies', 'branches', 'departments', 'positions'));
    }

    public function storeAsset(Request $request)
    {
        try {
            $company = company::findOrFail($request->company_id);
            $companyCode = strtoupper(substr($company->company_name, 0, 3));

            $department = department::findOrFail($request->department_id);
            $departmentCode = strtoupper(substr($department->department_name, 0, 3));

            $branch = branch::findOrFail($request->branch_id);
            $branchCode = strtoupper(substr($branch->branch_name, 0, 3));

            $purchaseYear = \Carbon\Carbon::parse($request->purchase_date)->format('Y');

            $prefix = $companyCode . $departmentCode . $branchCode . $purchaseYear;

            $lastAsset = asset_information::where('assetCode', 'like', $prefix . '%')
                ->orderBy('assetCode', 'desc')
                ->first();

            if ($lastAsset) {
                $lastNumber = intval(substr($lastAsset->assetCode, -4));
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            $assetCode = $prefix . $newNumber;

            $exists = asset_information::where('assetCode', $assetCode)->exists();
            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'รหัส Asset Code ถูกสร้างซ้ำ กรุณาบันทึกใหม่'
                ], 400);
            }

            $data = [
                'assetCode' => $assetCode,
                'assetName' => $request->assetName,
                'detail_property' => $request->detail_property,
                'company_id' => $request->company_id,
                'branch_id' => $request->branch_id,
                'location_sub' => $request->location_sub,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
                'purchase_date' => $request->purchase_date,
                'expiration_date' => $request->expiration_date,
                'purchase_price' => str_replace(',', '', $request->purchase_price),
                'purchase_reason' => $request->purchase_reason,
                'status' => $request->status,
                'presenter' => $request->presenter,
                'asset_status' => $request->asset_status,
            ];

            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());
                $img = $manager->read($image)->scaleDown(width: 1200);
                $img->save(storage_path('app/public/uploads/' . $filename));

                $data['images'] = 'uploads/' . $filename;
            }

            $asset = asset_information::create($data);

            $assetText = route('maintenance.createFromQr', ['asset_id' => $asset->id]);
            $qrFile = "qrcodes/{$request->assetCode}.png";

            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($assetText)
                ->size(300)
                ->margin(10)
                ->build();

            Storage::disk('public')->put($qrFile, $result->getString());
            $asset->update(['qrCode' => $qrFile]);

            return response()->json([
                'success' => true,
                'message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function printAll(Request $request)
    {
        $asset = asset_information::with(['company', 'branch', 'department', 'position'])->get();
        return view('assetData.report.printAll', compact('asset'));
    }

    public function downloadPrintAll(Request $request)
    {
        $fromDate = $request->Fromdate;
        $toDate   = $request->Todate;

        $asset = asset_information::with(['company', 'branch', 'department', 'position'])
            ->whereBetween('purchase_date', [$fromDate, $toDate])
            ->get();

        if ($asset->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'ไม่พบข้อมูลในช่วงวันที่เลือก'
            ]);
        }

        $pdf = Pdf::loadView('assetData.report.printAll_pdf', compact('asset'))
            ->setPaper('A4', 'portrait');

        return response($pdf->stream(), 200)
            ->header('Content-Type', 'application/pdf');
    }


    public function downloadPrintOne($id)
    {
        $asset = asset_information::with(['company', 'branch', 'department', 'position'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('assetData.report.printAll_pdf', compact('asset'))
            ->setPaper('A4', 'portrait');

        $filename = 'asset_' . $asset->assetCode . '_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->stream($filename);
    }

    public function excel(Request $request)
    {
        $asset = asset_information::with(['company', 'branch', 'department', 'position'])->get();
        return view('assetData.report.excel', compact('asset'));
    }

    public function printExcel(Request $request)
    {
        $from = $request->from_date;
        $to   = $request->to_date;

        $asset = asset_information::with(['company', 'branch', 'department', 'position'])
            ->whereBetween('purchase_date', [$from, $to])
            ->get();

        return Excel::download(new AssetExport($asset), 'asset_report.xlsx');
    }

    public function reportMoney(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $reportData = asset_information::with('company')
            ->select('company_id')
            ->selectRaw('MONTH(purchase_date) as month')
            ->selectRaw('SUM(purchase_price) as total')
            ->whereYear('purchase_date', $year)
            ->groupBy('company_id', 'month')
            ->get();

        $companies = $reportData->pluck('company')->unique('id');
        $tableData = [];

        foreach ($companies as $company) {
            $tableData[$company->company_name] = array_fill(1, 12, 0);
        }

        foreach ($reportData as $data) {
            $companyName = $data->company->company_name;
            $month = $data->month;
            $tableData[$companyName][$month] = $data->total;
        }

        $maintenanceData = asset_maintenance::with('asset_information.company')
            ->select('asset_id')
            ->selectRaw('MONTH(repair_date) as month')
            ->selectRaw('SUM(repair_price) as total')
            ->whereYear('repair_date', $year)
            ->where('status', 'finished')
            ->groupBy('asset_id', 'month')
            ->get();

        $maintenanceTableData = [];

        foreach ($maintenanceData as $data) {
            if ($data->asset_information && $data->asset_information->company) {
                $companyName = $data->asset_information->company->company_name;
                $month = $data->month;

                if (!isset($maintenanceTableData[$companyName])) {
                    $maintenanceTableData[$companyName] = array_fill(1, 12, 0);
                }

                $maintenanceTableData[$companyName][$month] += $data->total;
            }
        }

        return view('assetData.report.reportMoney', compact('tableData', 'maintenanceTableData', 'year'));
    }

    public function exportExcel(Request $request)
    {
        $year = $request->input('year', date('Y'));
        return Excel::download(new ReportMoneyExport($year), "report_$year.xlsx");
    }
}
