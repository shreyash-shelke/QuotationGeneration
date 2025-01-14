<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Excel Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Excel Data</h1>
        <form action="/process" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        @if ($loop->index > 0) <!-- Skip header row -->
                            <tr>
                                <td><input type="checkbox" name="selected_rows[]" value="{{ json_encode($row) }}"></td>
                                <td>{{ $row[0] }}</td>
                                <td>{{ $row[1] }}</td>
                                <td>{{ $row[2] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <!-- GST Selection -->
            <div class="form-group">
                <label for="gst">Include GST (18%)</label>
                <input type="checkbox" id="gst" name="include_gst">
            </div>

            <button type="submit" class="btn btn-primary">Process Selected Data</button>
        </form>
    </div>
</body>
</html>
