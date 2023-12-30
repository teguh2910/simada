<?php

namespace App\Http\Controllers;
use App\stock, Excel;

use Illuminate\Http\Request;

class stockController extends Controller
{
    public function index()
    {
        // Assuming $data is the variable you want to pass to the view
        $data = stock::first();
        //dd($data->fc_4);
        // Pass the formatted data to the view
        return view('stock', compact('data'));
    }
    public function upload_stock() {
        return view('upload_stock');
    }
    public function store_upload_stock(Request $request) {
        // Check if a file was uploaded
        if ($request->hasFile('data_fc')) {
            // Get the uploaded file
            $file = $request->file('data_fc');
            // Process the Excel file
            Excel::load($file, function($reader) use($request) {
    
                // Getting all results
                $results = $reader->get();
            
                foreach($results as $result){
                    if($result->part_no == null){
                        break;
                    }
                    $fc = new stock;
                    $fc->fc_4 = $result->fc_4;
                    $fc->fc_5 = $result->fc_5;
                    $fc->fc_6 = $request->fc_6;
                    $fc->fc_7 = $request->fc_7;
                    $fc->fc_8 = $request->fc_8;
                    $fc->fc_9 = $request->fc_9;
                    $fc->fc_10 = $request->fc_10;
                    $fc->fc_11 = $request->fc_11;
                    $fc->fc_12 = $request->fc_12;
                    $fc->fc_1 = $request->fc_1;
                    $fc->fc_2 = $request->fc_2;
                    $fc->fc_3 = $request->fc_3;
                    $fc->save();
                }
                });                
            }elseif ($request->hasFile('incoming_supplier')) {
                // Get the uploaded file
                $file = $request->file('incoming_supplier');
                // Process the Excel file
                Excel::load($file, function($reader) use($request) {
        
                    // Getting all results
                    $results = $reader->get();
                
                    foreach($results as $result){
                        if($result->part_no == null){
                            break;
                        }
                        $incoming_supplier = new stock;
                        $incoming_supplier->incoming_supplier_4 = $result->incoming_supplier_4;
                        $incoming_supplier->incoming_supplier_5 = $result->incoming_supplier_5;
                        $incoming_supplier->incoming_supplier_6 = $request->incoming_supplier_6;
                        $incoming_supplier->incoming_supplier_7 = $request->incoming_supplier_7;
                        $incoming_supplier->incoming_supplier_8 = $request->incoming_supplier_8;
                        $incoming_supplier->incoming_supplier_9 = $request->incoming_supplier_9;
                        $incoming_supplier->incoming_supplier_10 = $request->incoming_supplier_10;
                        $incoming_supplier->incoming_supplier_11 = $request->incoming_supplier_11;
                        $incoming_supplier->incoming_supplier_12 = $request->incoming_supplier_12;
                        $incoming_supplier->incoming_supplier_1 = $request->incoming_supplier_1;
                        $incoming_supplier->incoming_supplier_2 = $request->incoming_supplier_2;
                        $incoming_supplier->incoming_supplier_3 = $request->incoming_supplier_3;
                        $incoming_supplier->save();
                    }
                    });                
                }elseif ($request->hasFile('gr_aisin')) {
                    // Get the uploaded file
                    $file = $request->file('gr_aisin');
                    // Process the Excel file
                    Excel::load($file, function($reader) use($request) {
            
                        // Getting all results
                        $results = $reader->get();
                    
                        foreach($results as $result){
                            if($result->part_no == null){
                                break;
                            }
                            $gr_aisin = new stock;
                            $gr_aisin->gr_aisin_4 = $result->gr_aisin_4;
                            $gr_aisin->gr_aisin_5 = $result->gr_aisin_5;
                            $gr_aisin->gr_aisin_6 = $request->gr_aisin_6;
                            $gr_aisin->gr_aisin_7 = $request->gr_aisin_7;
                            $gr_aisin->gr_aisin_8 = $request->gr_aisin_8;
                            $gr_aisin->gr_aisin_9 = $request->gr_aisin_9;
                            $gr_aisin->gr_aisin_10 = $request->gr_aisin_10;
                            $gr_aisin->gr_aisin_11 = $request->gr_aisin_11;
                            $gr_aisin->gr_aisin_12 = $request->gr_aisin_12;
                            $gr_aisin->gr_aisin_1 = $request->gr_aisin_1;
                            $gr_aisin->gr_aisin_2 = $request->gr_aisin_2;
                            $gr_aisin->gr_aisin_3 = $request->gr_aisin_3;
                            $gr_aisin->save();
                        }
                        });                
                    }
            return redirect('stock');
        }            
}
