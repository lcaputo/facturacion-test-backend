<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;

class BillDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function list() {
        $detail = BillDetail::all();
        return response()->json($detail);
    }

    public function detail($id) {
        $detail = BillDetail::where('bill_id', $id)->get();
        return response()->json($detail);
    }

    
    public function create(Request $request) {
        $input = $request->only('bill_id', 'product_id');
        
        try
        {
            $detail = new BillDetail();

            $detail->bill_id      = $input['bill_id'];
            $detail->product_id   = $input['product_id'];


            if ( $detail->save() ) {
                $code = 201;
                $output = [
                    'detail' => $detail,
                    'code' => $code,
                    'message' => 'Bill Detail created successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred while creating detail.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred while creating detail.'
            ];
        }

        return response()->json($output, $code);

    }

    public function update(Request $request, $id) {
        $input = $request->only('bill_id', 'product_id');
        
        try
        {
            $detail = BillDetail::find($id);
        
            $detail->bill_id      = $input['bill_id'];
            $detail->product_id   = $input['product_id'];


            if ( $detail->save() ) {
                $code = 200;
                $output = [
                    'detail' => $detail,
                    'code' => $code,
                    'message' => 'Bill Detail updated successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred updating detail.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred updating detail.'
            ];
        }
    }

    public function delete($id) {
        try
        {
            $detail = BillDetail::find($id);
            
            $detail->active = 0;
            
            if ( $detail->save() ) {
                $code = 200;
                $output = [
                    'code' => $code,
                    'message' => 'Bill deleted.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred deleting detail.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred deleting detail.'
            ];
        }
    }

    //
}
