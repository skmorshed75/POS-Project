<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    
    function invoiceCreate(Request $request){
        DB::beginTransaction();

        try{
            $user_id = $request->header('id');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $customer_id = $request->input('customer_id');

            $invoice = Invoice::create([
                'total' => $total,
                'discount' => $discount,
                'vat' => $vat,
                'user_id'=> $user_id,
                'customer_id' => $customer_id,
            ]);

            $invoiceID = $invoice->id;

            $products = $request->input('products');

            foreach($products as $EachProduct) {
                InvoiceProduct::create([
                    'invoice_id'=> $invoiceID,
                    'product_id'=> $EachProduct['product_id'],
                    'qty' => $EachProduct['qty'],
                    'sale_price' => $EachProduct['sale_price'],
                ]);
            }
            DB::commit();
            return 1;
        }
        catch(Exception $e){
            DB::rollback();
            return 0;
        }
    }
}   
