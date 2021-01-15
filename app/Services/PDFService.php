<?php

namespace App\Services;

use Illuminate\Http\Request;
use DB;

class PDFService 
{
    /**
     * A Method that can handle an upload of PDF file 
     * 
     * @param [\lluminate\Http\Request] $request
     * @return JSON
     */
    public function uploadPDFFile(Request $request){


        $request->validate([
            'pdf' => 'required|file|mimes:pdf',
        ]);

        $pdfContent = file_get_contents($request->pdf);

        if( strpos($pdfContent,'Proposal') !== false) {

            $fileName = $request->pdf->getClientOriginalName();

            $size = $request->file('pdf')->getSize();

            $exist = DB::table('pdf')->where('name',$fileName)->where('size',$size)->first() != null ? true : false;

            if($exist){

                $request->file('pdf')->storeAs(
                    'public', $fileName
                );
            }
            else{

                $request->file('pdf')->storeAs(
                    'public', $fileName
                );

                DB::table('pdf')->insert([
                    'name' => $fileName,
                    'size' => $size
                ]);
            }

            return response()->json([
                'status' => 'upload_sucess'
            ]);
        }

        return response()->json([
            'status' => 'upload_failed'
        ], 422);

    }

}