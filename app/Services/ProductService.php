<?php
namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use DataTables;

class ProductService
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function createItem($request): Product
    {
        $item = $this->product->create($request);
        return $item;
    }

    public function updateItem($request, $id): Product
    {
        $item = $this->product->findOrFail($id);
        $item->update($request);
        return $item;
    }

    public function deleteItem($request, $id): void
    {
        $item = $this->product->findOrFail($id);
        $item->delete();
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->product->select('*');

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
