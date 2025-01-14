<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - ATJOIN PVT. LTD.</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        h1, h5 {
            color: #333;
        }
        .header-section h1 {
            border-bottom: 2px solid #333;
            display: inline-block;
            padding-bottom: 5px;
        }
        .section-title {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .text-end h6, .text-end p {
            margin: 0;
        }
        .text-end h6 {
            font-weight: bold;
        }
        .total-section h6 {
            font-weight: bold;
        }
        .note-section, .terms-section {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Header Section -->
        <div class="header-section text-center">
            <h1>Invoice</h1>
            <hr>
        </div>

        <!-- Customer Information -->
        <div class="row">
            <div class="col-md-6">
                <h5 class="section-title">Company Information</h5>
                <h6>Company Name:</h6>
                <p>ATJOIN PVT. LTD.</p>
                <h6>Address:</h6>
                <p>5th Floor, Luv-Kush Apt., Seasons Business Center, opposite Kothari Hyundai Showroom, Sanewadi, Aundh, Pune, Maharashtra 411007</p>
                <h6>Contact:</h6>
                <p>09422333387</p>
                <h6>Website:</h6>
                <p><a href="https://atjoin.in/" target="_blank">https://atjoin.in/</a></p>
                <h6>GST No:</h6>
                <p>123456789012</p>
            </div>
            <div class="col-md-6">
                <h5 class="section-title">Customer Information</h5>
                <!-- Customer data -->
                
                <h6>Customer Name:</h6>
                <input type="text" placeholder="Enter Customer Name" required>
                <h6>Phone:</h6>
                <input type="text" id="phone" name="phone" maxlength="10" pattern="\d{10}" title="Enter a valid 10-digit phone number" required>
                <h6>GST No:</h6>
                <input type="text" placeholder="Enter GST Number">
                <h6>Email:</h6>
                <input type="email" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@gmail\.com" title="Enter a valid Gmail ID (e.g., example@gmail.com)" required>
                <h6>City:</h6>
                <input type="text" placeholder="Enter City">
                <h6>State:</h6>
                <input type="text" placeholder="Enter State">
                <h6>Place of Supply:</h6>
                <input type="text" placeholder="Enter Place of Supply">
            </div>
                <!-- Assuming you passed the customer details along -->
            </div>
        </div>

        <!-- Date & Invoice Number -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h6>Date:</h6>
                <p>{{ date('Y-m-d') }}</p>
                <h6>Invoice Number:</h6>
                <p>#{{ str_pad($invoiceNumber, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <!-- Quotation Details -->
        <h5 class="section-title mt-4">Invoice Details</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($selectedData as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row[0] }}</td>
                        <td>{{ $row[1] }}</td>
                        <td>₹{{ number_format($row[2], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="text-end total-section">
            <h6>Total: ₹{{ number_format($totalAmount, 2) }}</h6>
            @if ($gstAmount)
                <h6>GST (18%): ₹{{ number_format($gstAmount, 2) }}</h6>
            @else
                <h6>No GST Applied</h6>
            @endif
            <h6>Total with GST: ₹{{ number_format($totalWithGST, 2) }}</h6>
        </div>

        <!-- Payment Details -->
        <div class="note-section">
            <h5>Payment Details</h5>
            <p>Account Number: 1234567890</p>
            <p>IFSC Code: ABCD0123456</p>
            <p>Bank Name: XYZ Bank</p>
            <p>Branch Name: Pune</p>
        </div>

        <!-- Notes and Terms -->
        <div class="terms-section">
            <h5>Note:</h5>
            <p>All prices are inclusive of applicable taxes. This invoice is valid for 15 days from the date of issue.</p>
            <h5>Terms and Conditions:</h5>
            <p>Payment is to be made within 15 days of receiving the invoice.</p>
        </div>
    </div>

    <div class="text-center mt-4">
    <button class="btn btn-success" onclick="window.print()">Print Invoice</button>
    </div>
</body>
</html>
