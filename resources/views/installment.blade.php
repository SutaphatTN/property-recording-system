@extends('layouts.app')
@section('title', 'Installment')
@section('content')
    <div class="container">
        <h4>คำนวณยอดผ่อน</h4>

        <div class="mb-3">
            <label>ยอดจัด (บาท):</label>
            <input type="text" id="amount" class="form-control" min="1" oninput="validateAmount()">
        </div>

        <div class="mb-3">
            <label>อัตราดอกเบี้ยต่อปี (%):</label>
            <input type="number" id="interest" class="form-control" min="0" step="0.01">
        </div>

        <div class="mb-3">
            <label>จำนวนงวดที่ต้องการเลือก:</label>
            <select id="termSelect" class="form-select">
                <option value="">-- เลือกงวด --</option>
                @for ($i = 12; $i <= 84; $i += 6)
                    <option value="{{ $i }}">{{ $i }} งวด</option>
                @endfor
            </select>
        </div>

        <button class="btn btn-primary" onclick="calculate()">คำนวณ</button>
        <button class="btn btn-danger" onclick="clearForm()" id="clearBtn" style="display: none;">เคลียร์ข้อมูล</button>

        <table class="table table-bordered text-center mt-4">
            <thead>
                <tr>
                    <th>งวด</th>
                    <th>ยอดผ่อนต่อเดือน (บาท)</th>
                </tr>
            </thead>
            <tbody id="resultBody"></tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection

<script>
    function validateAmount() {
        const amount = $('#amount').val();
        if (amount < 0 || isNaN(amount) || /[^\d]/.test(amount)) {
            alert('กรุณากรอกเฉพาะตัวเลข');
            $('#amount').val('');
        }
        toggleClearButton();
    }

    function toggleClearButton() {
        const amount = $('#amount').val();
        const interest = $('#interest').val();
        const term = $('#termSelect').val();

        if (amount || interest || term) {
            $('#clearBtn').show();
        } else {
            $('#clearBtn').hide();
        }
    }

    function clearForm() {
        $('#amount').val('');
        $('#interest').val('');
        $('#termSelect').val('');
        $('#resultBody').html('');
        toggleClearButton();
    }

    function calculate() {
        const amount = parseFloat($('#amount').val());
        const interest = parseFloat($('#interest').val());
        const term = parseInt($('#termSelect').val());
        const $resultBody = $('#resultBody');
        $resultBody.empty();

        if (!amount || !interest || !term) {
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            return;
        }

        const totalInterest = (amount * (interest / 100)) * (term / 12);
        const totalPayment = amount + totalInterest;
        const monthly = totalPayment / term;

        for (let i = 1; i <= term; i++) {
            const row = $(`
            <tr>
                <td>งวดที่ ${i}</td>
                <td ${monthly > 5000 ? 'style="color:red;"' : ''}>${monthly.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
            </tr>
        `);
            $resultBody.append(row);
        }

        toggleClearButton();
    }
</script>
