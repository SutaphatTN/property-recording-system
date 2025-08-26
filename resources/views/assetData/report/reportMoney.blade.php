@extends('layouts.app')
@section('title', 'Report')
@section('content')

<div class="text-center mt-4 mb-3">
    <h3><b>รายงานการใช้งบประมาณ</b></h3>
</div>

<div class="mb-3 text-center">
    <form method="GET" action="{{ route('assetData.reportMoney') }}">
        <label for="year">เลือกปี: </label>
        <select name="year" id="yearSelect">
            @for($y = date('Y'); $y >= 2010; $y--)
            <option value="{{ $y }}" @if($year==$y) selected @endif>{{ $y }}</option>
            @endfor
        </select>
    </form>
</div>

<div class="card text-center">
    <div class="card-header d-flex justify-content-between align-items-center">
        <ul class="nav nav-tabs card-header-tabs" id="reportTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="asset-tab" data-toggle="tab" href="#asset" role="tab">ทรัพย์สิน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="maintenance-tab" data-toggle="tab" href="#maintenance" role="tab">การซ่อม</a>
            </li>
        </ul>

        <a href="{{ route('assetData.exportExcel', ['year'=>$year]) }}" class="btn btn-success">
            รายงาน
        </a>

    </div>

    <div id="reportContent">
        <div class="card-body tab-content">
            <div class="tab-pane fade show active" id="asset" role="tabpanel">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>บริษัท</th>
                            @for($m = 1; $m <= 12; $m++)
                                <th>{{ DateTime::createFromFormat('!m', $m)->format('M') }}</th>
                                @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tableData as $companyName => $months)
                        <tr>
                            <td>{{ $companyName }}</td>
                            @foreach($months as $total)
                            <td>
                                {{ number_format($total, 2) }}
                            </td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center text-muted">ไม่มีข้อมูลของปีนี้</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="maintenance" role="tabpanel">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>บริษัท</th>
                            @for($m = 1; $m <= 12; $m++)
                                <th>{{ DateTime::createFromFormat('!m', $m)->format('M') }}</th>
                                @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($maintenanceTableData as $companyName => $months)
                        <tr>
                            <td>{{ $companyName }}</td>
                            @foreach($months as $total)
                            <td>{{ number_format($total, 2) }}</td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center text-muted">ไม่มีข้อมูลของปีนี้</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#yearSelect').change(function() {
            let year = $(this).val();

            $.ajax({
                url: "{{ route('assetData.reportMoney') }}",
                type: "GET",
                data: {
                    year: year
                },
                success: function(response) {
                    $('#reportContent').html($(response).find('#reportContent').html());
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                }
            });
        });
    });
</script>

@endsection