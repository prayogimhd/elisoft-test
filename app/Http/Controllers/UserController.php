<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    public function listUsers()
    {
        //Soal no 5
        //route localhost:8000/api/listUsers
        try {
            $data       = User::all();
            $response   = [
                'status'    => true,
                'message'   => 'Success',
                'data'      => $data
            ];
        } catch (\Throwable $th) {
            $response = [
                'status'    => false,
                'message'   => $th->getMessage(),
            ];
        }
        return response()->json($response);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="editUser"  data-user="' . $row->id . '" class="btn btn-primary"> <i class="fa fa-edit"> Edit </i> </a>
                    <a href="javascript:void(0)" id="deleteUser"  data-user="' . $row->id . '" class="btn btn-danger"> <i class="fa fa-trash"> Delete </i> </a>';
                    if ($row->id == Session::get('id')) {
                        $btn = '
                        <a href="javascript:void(0)" id="editUser"  data-user="' . $row->id . '" class="btn btn-primary"> <i class="fa fa-edit"> Edit </i> </a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $title = 'List Users';
        return view('user.index', compact('title'));
    }

    public function formUser(Request $request)
    {
        $id             = $request->user_id;
        $user           = User::find($id);
        $data           = [
            'data'    => $user,
        ];

        $view       = view('user.formUser', $data)->render();
        $response   = [
            'success' => $view
        ];
        return response()->json($response);
    }

    public function actionUser(Request $request)
    {
        $id             = $request->user_id;
        if ($id) {
            $request->validate(
                [
                    'name'              => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                    'email'             => 'required|email',
                ]
            );
            try {
                $categories = User::find($id);
                $password   = $categories->password;
                if ($request->password) {
                    $password = Hash::make($request->password);
                }
                $categories->name       = $request->name;
                $categories->email      = $request->email;
                $categories->password   = $password;
                $categories->save();
                $response = [
                    'status'    => 200,
                    'message'   => 'User berhasil diperbarui!'
                ];
            } catch (\Exception $e) {
                $response = [
                    'status'    => 500,
                    'message'   => $e->getMessage()
                ];
            }
        } else {
            $request->validate(
                [
                    'name'          => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                    'email'         => 'required|unique:users,email|email',
                    'password'      => 'required|min:8',
                ]
            );
            try {
                $categories = new User;
                $categories->name       = $request->name;
                $categories->email      = $request->email;
                $categories->password   =  Hash::make($request->password);
                $categories->save();

                $response = [
                    'status'    => 200,
                    'message'   => 'User berhasil ditambahkan'
                ];
            } catch (\Exception $e) {
                $response = [
                    'status'    => 500,
                    'message'   => $e->getMessage()
                ];
            }
        }

        return response()->json($response);
    }

    public function deleteUser($id)
    {
        try {
            User::find($id)->delete();
            $response = [
                'status'    => 200,
                'message'   => 'User berhasil dihapus!'
            ];
        } catch (\Exception $e) {
            $response = [
                'status'    => 500,
                'message'   => $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
