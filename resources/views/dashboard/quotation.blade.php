@extends('layouts.app')

@section('content')
    <div class="quotation-container">
        <h1>Quotation Management</h1>

        <!-- Search form -->
        <form method="GET" action="{{ route('search.quotation') }}">
            <input type="text" name="phone" placeholder="Search by Phone Number" required>
            <button type="submit">Search</button>
        </form>

        <!-- Display quotations -->
        <h2>All Quotations</h2>
        <table>
            <thead>
                <tr>
                    <th>Quotation Number</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Amount</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotations as $quotation)
                    <tr>
                        <td>{{ $quotation->quotation_number }}</td> <!-- Display the quotation number -->
                        <td>{{ $quotation->description }}</td>
                        <td>{{ $quotation->qty }}</td>
                        <td>{{ $quotation->amount }}</td>
                        <td>{{ $quotation->phone }}</td> <!-- Display the phone number -->
                        <td><a href="{{ route('quotation.view', $quotation->id) }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


<style>
    .quotation-container {
        margin: 2rem auto;
        max-width: 800px;
        padding: 2rem;
        background-color: #f9f9f9;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .quotation-container h1 {
        text-align: center;
        color: #333;
        margin-bottom: 1.5rem;
        font-size: 2rem;
    }

    .search-form {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .search-form input {
        width: 70%;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px 0 0 4px;
        font-size: 1rem;
    }

    .search-form button {
        padding: 0.5rem 1rem;
        border: none;
        background-color: #007bff;
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        border-radius: 0 4px 4px 0;
        transition: background-color 0.3s;
    }

    .search-form button:hover {
        background-color: #0056b3;
    }

    .quotation-table {
        width: 100%;
        border-collapse: collapse;
    }

    .quotation-table thead {
        background-color: #007bff;
        color: #fff;
    }

    .quotation-table th, .quotation-table td {
        padding: 0.75rem;
        text-align: left;
        border: 1px solid #ddd;
    }

    .quotation-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .quotation-table a {
        color: #007bff;
        text-decoration: none;
    }

    .quotation-table a:hover {
        text-decoration: underline;
    }
</style>
