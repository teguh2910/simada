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
        if ($request->hasFile('data_excel')) {
            // Get the uploaded file
            $file = $request->file('data_excel');
            // Process the Excel file
            Excel::load($file, function($reader) use($request) {
    
                // Getting all results
                $results = $reader->get();
            
                foreach($results as $result){
                    if($result->part_no == null){
                        break;
                    }
                    $sto = new stock;
                    $sto->part_no = $result->part_no;
                    $sto->qty_sto = $result->qty_sto;
                    $sto->tgl_sto = $request->tgl_sto;
                    $sto->save();
                }
                });
                return redirect('gudangsatu');
            }
            return 'No file uploaded.';
        }            
}
