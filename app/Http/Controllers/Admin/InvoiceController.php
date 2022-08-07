<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Response;
use DataTables;

class InvoiceController extends Controller
{
    private $viewIndex  = 'admin.pages.invoices.index';
    private $viewEdit   = 'admin.pages.invoices.create_edit';
    private $route      = 'admin.invoices';
    private $service;
    private Invoice $invoice;

    public function __construct()
    {
        $this->service = new InvoiceService();
        $this->invoice = new Invoice();
    }

    public function index(Request $request) : View
    {
        return view($this->viewIndex, get_defined_vars());
    }

    public function create() : View
    {
        return view($this->viewEdit, get_defined_vars());
    }

    public function edit($id) : View
    {
        $item = $this->invoice->findOrFail($id);
        return view($this->viewEdit, get_defined_vars());
    }

    public function list(Request $request) : JsonResponse
    {
        return $this->service->getList($request);
    }
}
