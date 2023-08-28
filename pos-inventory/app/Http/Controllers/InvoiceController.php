<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    
    function invoiceCreate(Request $request){
        
        DB::beginTransaction();
        try {
            $user_id=$request->header('id');
            $total=$request->input('total');
            $discount=$request->input('discount');
            $vat=$request->input('vat');
            $customer_id=$request->input('customer_id');            

            $invoice= Invoice::create([                
                'total'=>$total,
                'discount'=>$discount,
                'vat'=>$vat,
                'user_id'=>$user_id,
                'customer_id'=>$customer_id
            ]);
            

            $invoiceID = $invoice->id;

            //$invoiceID = 1;

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

    function invoiceSelect(Request $request){
        $user_id = $request->header('id');
        return Invoice::where('user_id',$user_id)->with('customer')->get();
    }

    function invoiceDetails(Request $request){
        $user_id = $request->header('id');
        $customerDetails = Customer::where('user_id',$user_id)
        ->where('id',$request->input('cus_id'))
        ->first();

        $invoiceTotal = Invoice::Where('user_id',$user_id)
        ->where('id',$request->input('invoice_id'))
        ->first();

        $invoiceProduct = InvoiceProduct::Where('invoice_id',$request->input('invoice_id'))
        ->get();

        return array(
            'customer' => $customerDetails,
            'invoice' => $invoiceTotal,
            'product' => $invoiceProduct
        );

    }

    function invoiceDelete(Request $request){
        DB::beginTransaction();

        try{
            InvoiceProduct::where('invoice_id',$request->input('invoice_id'))->delete();
            Invoice::where('id',$request->input('invoice_id'))->delete();

            DB::Commit();
            return 1;
        }
        catch(Exception $e) {
            DB::rollBack();
            return 0;
        }
    }
}   
