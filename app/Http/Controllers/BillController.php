<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class BillController extends Controller
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
        $response = Bill::all();
        return response()->json($response);
    }

    public function detail($id) {
        $response = Bill::find($id);
        return response()->json($response);
    }

    public function create(Request $request) {
        $input = $request->only('employee_id', 'client_id', 'price', 'iva', 'total');
        
        try
        {
            $bill = new Bill();

            $bill->employee_id  = $input['employee_id'];
            $bill->client_id    = $input['client_id'];
            $bill->price        = $input['price'];
            $bill->iva          = $input['iva'];
            $bill->total        = $input['total'];

            if ( $bill->save() ) {
                $code = 201;
                $output = [
                    'bill' => $bill,
                    'code' => $code,
                    'message' => 'Bill created successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred while creating bill.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred while creating bill.'
            ];
        }

        return response()->json($output, $code);

    }

    public function update(Request $request, $id) {
        $input = $request->only('employee_id', 'client_id', 'price', 'iva', 'total');
        
        try
        {
            $bill = Bill::find($id);
        
            $bill->employee_id  = $input['employee_id'];
            $bill->client_id    = $input['client_id'];
            $bill->price        = $input['price'];
            $bill->iva          = $input['iva'];
            $bill->total        = $input['total'];

            if ( $bill->save() ) {
                $code = 200;
                $output = [
                    'bill' => $bill,
                    'code' => $code,
                    'message' => 'Bill updated successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'bill' => $bill,
                    'code' => $code,
                    'message' => 'An error ocurred updating bill.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred updating bill.'
            ];
        }
    }

    public function delete($id) {
        try
        {
            $bill = Bill::find($id);
            
            $bill->ative = false;
            
            if ( $bill->save() ) {
                $code = 200;
                $output = [
                    'code' => $code,
                    'message' => 'Bill deleted.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred deleting bill.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred deleting bill.'
            ];
        }
    }

    //
}
