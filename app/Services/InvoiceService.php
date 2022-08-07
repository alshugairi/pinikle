<?php
namespace App\Services;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use DataTables;

class InvoiceService
{
    private Invoice $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice();
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->invoice->select('*');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($item) {
                return '<span dir="ltr">'.$item->created_at->format('d-m-Y H:i A').'</span>';
            })
            ->editColumn('actions', function ($item) {})
            ->rawColumns(['created_at', 'created_by','actions'])
            ->make(true);
    }
}
