<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function createItem($request): User
    {
        $password = $request['password'];
        unset($request['password']);
        $request['is_admin'] = 1;
        $item = $this->user->create($request);
        $this->savePassword($item,$password);
        //$this->assignRole($item,$request['role_id']);
        return $item;
    }

    public function updateItem($request, $id): User
    {
        $item = $this->user->findOrFail($id);
        $password = $request['password'];
        unset($request['password']);
        $request['is_admin'] = 1;
        $item->update($request);
        $this->savePassword($item,$password);
        //$this->assignRole($item,$request['role_id']);
        return $item;
    }

    public function deleteItem($request, $id): void
    {
        $item = $this->user->findOrFail($id);
        $item->delete();
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->user->select('*');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($item) {
                return '<span dir="ltr">'.$item->created_at->format('d-m-Y H:i A').'</span>';
            })
            ->editColumn('actions', function ($item) {})
            ->rawColumns(['created_at', 'created_by','actions'])
            ->make(true);
    }

    public function getItemRolesIds(User $item): array
    {
        $roles = $item->roles;
        return $roles ? $roles->pluck('id')->toArray() : [];
    }

    public function assignRole($item, $roleId): void
    {
        if ($roleId != null) {
            $item->roles()->detach();
            $item->syncRoles([$roleId]);
        }
    }

    public function savePassword(User $item, $password): void
    {
        if ($password != null) {
            $item->password = Hash::make($password);
            $item->save();
        }
    }
}
