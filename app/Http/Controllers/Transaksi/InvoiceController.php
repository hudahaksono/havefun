<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\OrderModels;
use App\Models\PaymentModels;
use App\Helpers\Helper;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class InvoiceController extends Controller
{
    public function generatelunas()
    {
        $data = ['title' => 'Invoice No : 12345'];
        $pdf = PDF::loadView('office.invoice.invoice-lunas', $data);
        return $pdf->stream();
    }
    public function generateoutstanding()
    {
        $data = ['title' => 'Invoice No : 54321'];
        $pdf = PDF::loadView('office.invoice.invoice-outstanding', $data);
        return $pdf->stream();
    }
}
