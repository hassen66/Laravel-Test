<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PDFService;

class PDFController extends Controller
{
    private $PDFService;

    public function __construct(PDFService $PDFService)
    {
        $this->PDFService = $PDFService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        return $this->PDFService->uploadPDFFile($request);
    }
}
