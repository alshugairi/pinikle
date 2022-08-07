<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Response;
use DataTables;

class ProductController extends Controller
{
    private $viewIndex  = 'admin.pages.products.index';
    private $viewEdit   = 'admin.pages.products.create_edit';
    private $route      = 'admin.products';
    private $service;
    private Product $product;

    public function __construct()
    {
        $this->service = new ProductService();
        $this->product = new Product();
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
        $item = $this->product->findOrFail($id);
        return view($this->viewEdit, get_defined_vars());
    }

    public function store(ProductRequest $request) : RedirectResponse
    {
        try {
            $item = $this->service->createItem($request->validated());
            flash(__('products.messages.created'))->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }
        return to_route($this->route.'.index');
    }

    public function update(ProductRequest $request, $id) : RedirectResponse
    {
        try {
            $item = $this->service->updateItem($request->validated(),$id);
            flash(__('products.messages.updated'))->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }
        return to_route($this->route.'.index');
    }

    public function list(Request $request) : JsonResponse
    {
        return $this->service->getList($request);
    }
}
