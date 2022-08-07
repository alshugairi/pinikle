<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Response;
use DataTables;

class UserController extends Controller
{
    private $viewIndex  = 'admin.pages.users.index';
    private $viewEdit   = 'admin.pages.users.create_edit';
    private $viewShow   = 'admin.pages.users.show';
    private $route      = 'admin.users';
    private $service;
    private User $user;

    public function __construct()
    {
        $this->service = new UserService();
        $this->user = new User();
    }


    public function index(Request $request) : View
    {
        return view($this->viewIndex, get_defined_vars());
    }


    public function create() : View
    {
        $itemRoles = [];
        return view($this->viewEdit, get_defined_vars());
    }


    public function edit($id)
    {
        $item = $this->user->findOrFail($id);
        $itemRoles = $this->service->getItemRolesIds($item);
        return view($this->viewEdit, get_defined_vars());
    }

    public function store(UserRequest $request) : RedirectResponse
    {
        try {
            $item = $this->service->createItem($request->validated());
            flash(__('users.messages.created'))->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }
        return to_route($this->route.'.index');
    }

    public function update(UserRequest $request, $id) : RedirectResponse
    {
        try {
            $item = $this->service->updateItem($request->validated(),$id);
            flash(__('users.messages.updated'))->success();
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
