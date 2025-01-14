@extends('layouts.app')

@section('content')
    <div class="quotation-details">
        <h1>Quotation Details</h1>

        <table>
            <tr>
                <th>Quotation Number</th>
                <td>{{ $quotation->quotation_number }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $quotation->description }}</td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td>{{ $quotation->qty }}</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>{{ $quotation->amount }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $quotation->phone }}</td>
            </tr>
        </table>

        <a href="/quotation" class="back-btn">Back to Quotations</a>
    </div>
@endsection
