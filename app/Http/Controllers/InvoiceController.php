<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;  // Assuming you have a settings model for the invoice number

use PDF;  // We will use this for generating PDF invoices (you need to install `dompdf` library)

class InvoiceController extends Controller
{
    public function generateInvoice(Request $request)
    {
        // Retrieve data from the request
        $selectedData = json_decode($request->input('selectedData'), true);
        $totalAmount = $request->input('totalAmount');
        $gstAmount = $request->input('gstAmount');
        $totalWithGST = $request->input('totalWithGST');

        // Retrieve the last invoice number from the 'settings' table or generate a new one
        $lastInvoice = Setting::where('key', 'last_invoice_number')->first();
        $invoiceNumber = $lastInvoice ? $lastInvoice->value + 1 : 100001;  // Default to 100001 if not set

        // Update the last invoice number in the 'settings' table
        if ($lastInvoice) {
            $lastInvoice->update(['value' => $invoiceNumber]);
        } else {
            Setting::create(['key' => 'last_invoice_number', 'value' => $invoiceNumber]);
        }

        // Return the invoice view with the necessary data
        return view('invoice', compact('selectedData', 'totalAmount', 'gstAmount', 'totalWithGST', 'invoiceNumber'));
    }
}
