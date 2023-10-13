<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('transactions')->orderBy('id','desc')->get();

        $response = [
            'message' => 'Successfully retrieved all invoices',
            'invoices' => $invoices
        ];

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $invoice = Invoice::with('transactions')->with('transactions.product')->find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        $response = [
            'message' => 'Successfully retrieved the invoice',
            'invoice' => $invoice
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $invoiceData = $request->only(['customer_name', 'invoice_date']);
        $transactionsData = $request->input('transactions', []);

        $totalAmount = 0;
        foreach ($transactionsData as &$transaction) {
            $product = Product::findOrFail($transaction['product_id']);
            $transaction['product_id'] = $product->id;

            // Calculate total price considering product discount
            $transaction['item_price'] = $product->price;
            $transaction['item_discount'] = $product->discount;
            $transaction['total_price'] = $transaction['item_quantity'] * $transaction['item_price'] * (1 - $transaction['item_discount'] / 100);

            $totalAmount += $transaction['total_price'];
        }

        $invoiceData['total_amount'] = $totalAmount;

        // Create the invoice
        $invoice = Invoice::create($invoiceData);

        // Generate invoice number based on the specified format using the obtained invoice ID
        $invoiceDate = Carbon::parse($request->input('invoice_date'));
        $invoiceNumber = $invoiceDate->format('ymd') . '/INV/' . str_pad($invoice->id, 3, '0', STR_PAD_LEFT);

        // Update the invoice with the generated invoice number
        $invoice->update(['invoice_number' => $invoiceNumber]);

        // Create transactions associated with the invoice
        foreach ($transactionsData as $transactionData) {
            $invoice->transactions()->create($transactionData);
        }

        $response = [
            'message' => 'Invoice and transactions created successfully',
            'invoice' => $invoice->load('transactions')
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoiceData = $request->only(['customer_name', 'invoice_date']);

        // Delete all existing transactions associated with the invoice
    $invoice->transactions()->delete();

        // Calculate the total_price for each transaction and sum up for total_amount
        $totalAmount = 0;
        $transactionsData = $request->input('transactions', []);

        foreach ($transactionsData as $transactionData) {
            $product = Product::findOrFail($transactionData['product_id']);

            $transaction = new InvoiceDetail();

            $transaction['product_id'] = $product->id;
            $transaction['invoice_id'] = $invoice->id;

            // Calculate total price considering product discount
            $transaction['item_quantity'] = $transactionData['item_quantity'];
            $transaction['item_price'] = $product->price;
            $transaction['item_discount'] = $product->discount;
            $transaction['total_price'] = $transaction['item_quantity'] * $transaction['item_price'] * (1 - $transaction['item_discount'] / 100);
        
            $invoice->transactions()->save($transaction);
            
            $totalAmount += $transaction['total_price'];
        }

        // Update the invoice details
        $invoiceDate = Carbon::parse($request->input('invoice_date'));
        $invoiceData['invoice_number'] = $invoiceDate->format('ymd') . '/INV/' . str_pad($invoice->id, 3, '0', STR_PAD_LEFT);
        $invoiceData['total_amount'] = $totalAmount;
        $invoice->update($invoiceData);


        // Delete transactions that were removed
        $transactionIds = collect($transactionsData)->pluck('id');
        $invoice->transactions()->whereNotIn('id', $transactionIds)->delete();

        $response = [
            'message' => 'Invoice and transactions updated successfully',
            'invoice' => $invoice->load('transactions')
        ];

        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(['message' => 'Invoice and associated transactions deleted successfully'], 200);
    }
}
