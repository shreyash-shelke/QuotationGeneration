<?php 
 namespace App\Http\Controllers;

use App\Models\ExcelData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use Illuminate\Support\Facades\DB;

class ExcelController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
{
    // Validate the file
    $request->validate([
        'file' => 'required|mimes:xlsx,csv|max:2048',
    ]);

    // Store the uploaded file
    $filePath = $request->file('file')->store('uploads');

    // Parse the file using Maatwebsite Excel
    $data = Excel::toArray(new ExcelImport, $filePath);

    // Loop through the data (skip the first row if it's a header)
    foreach ($data[0] as $index => $row) {
        if ($index == 0 || strtolower($row[0]) == 'description' || strtolower($row[1]) == 'qty' || strtolower($row[2]) == 'amount') {
            continue;
        }

        // Insert the data into the database
        if (isset($row[0]) && is_numeric($row[1]) && is_numeric($row[2])) {
            ExcelData::create([
                'description' => $row[0],
                'qty' => (int) $row[1],
                'amount' => (float) $row[2],
                'phone' => $row[3] ?? null, // Assuming phone number is in the 4th column
                'quotation_number' => $this->generateQuotationNumber(), // Use the generateQuotationNumber method for each row
            ]);
        }
    }

    // Redirect to the page that displays the data
    return view('display', ['data' => $data[0]]);
}

    

    public function processData(Request $request)
    {
        // Retrieve the selected rows
        $selectedRows = $request->input('selected_rows');
        $selectedData = [];

        if ($selectedRows) {
            foreach ($selectedRows as $row) {
                $selectedData[] = json_decode($row, true);  // Decode JSON data back to an array
            }
        }

        // Check if GST is selected
        $includeGST = $request->has('include_gst'); // This will be true if the checkbox is checked

        // Generate a new Quotation Number
        $quotationNumber = $this->generateQuotationNumber();

        // Pass the selected data, GST flag, and Quotation Number to the quotation view
        return view('quotation', [
            'selectedData' => $selectedData,
            'includeGST' => $includeGST,
            'quotationNumber' => $quotationNumber
        ]);
    }

    public function showQuotation()
    {
        // Fetch all quotations from the database
        $quotations = ExcelData::all();
        
        // Pass the quotations to the view
        return view('dashboard.quotation', compact('quotations'));
    }

    public function searchQuotation(Request $request)
    {
        // Validate the phone input
        $request->validate([
            'phone' => 'required|string|min:3', // Adjust validation as needed
        ]);
    
        $phone = $request->input('phone');
    
        // Search in ExcelData where phone contains the search term
        $quotations = ExcelData::where('phone', 'like', '%' . $phone . '%')->get();
        // If no quotations found, you can add a message or redirect with a "no results" message
        if ($quotations->isEmpty()) {
            return back()->with('message', 'No quotations found for the provided phone number.');
        }
    
        return view('dashboard.quotation', compact('quotations'));
    }
    

public function viewQuotation($id)
{
    // Retrieve the quotation by ID
    $quotation = ExcelData::findOrFail($id);  // This will fetch the record or throw a 404 error if not found

    // Return a view to show the quotation details
    return view('dashboard.quotation_details', compact('quotation'));
}

    private function generateQuotationNumber()
    {
        // Fetch the last generated quotation number (for example from a 'settings' table)
        $lastQuotation = DB::table('settings')->where('key', 'last_quotation_number')->first();

        $lastNumber = $lastQuotation ? (int) $lastQuotation->value : 0;

        // Increment the number and format to 6 digits
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);

        // Update the last quotation number in the database
        DB::table('settings')->updateOrInsert(
            ['key' => 'last_quotation_number'],
            ['value' => $newNumber]
        );

        return $newNumber;
    }
}
