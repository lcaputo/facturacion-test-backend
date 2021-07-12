<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
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
        $client = Client::all();
        return response()->json($client);
    }

    public function detail($id) {
        $client = Client::find($id);
        return response()->json($client);
    }

    public function findByCC($cc) {
        $client = Client::find($cc);
        if ( $client ) {
            $code = 200;
            $output = [
                'client' => $client,
                'code' => $code,
                'message' => 'Client found.'
            ];
        } else {
            $code = 404;
            $output = [
                'code' => $code,
                'message' => 'Client not found.'
            ];
        }
        return response()->json($output, $code);
    }

    public function create(Request $request) {
        $input = $request->only('name', 'CC');
        
        try
        {
            $client = new Client();

            $client->name  = $input['name'];
            $client->CC    = $input['CC'];

            if ( $client->save() ) {
                $code = 201;
                $output = [
                    'client' => $client,
                    'code' => $code,
                    'message' => 'Client created successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred while creating client.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred while creating client.'
            ];
        }

        return response()->json($output, $code);

    }

    public function update(Request $request, $id) {
        $input = $request->only('name', 'CC');
        
        try
        {
            $client = Client::find($id);
        
            $client->name  = $input['name'];
            $client->CC    = $input['CC'];

            if ( $client->save() ) {
                $code = 200;
                $output = [
                    'client' => $client,
                    'code' => $code,
                    'message' => 'Client updated successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred updating client.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred updating client.'
            ];
        }
    }

    public function delete($id) {
        try
        {
            $client = Client::find($id);
            
            $client->active = 0;
            
            if ( $client->save() ) {
                $code = 200;
                $output = [
                    'code' => $code,
                    'message' => 'Client deleted.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred deleting client.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred deleting client.'
            ];
        }
    }

    //
}
