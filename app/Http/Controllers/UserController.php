<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // // tambah data user dengan Eloquent Model
        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4,
        // ];
        // UserModel::insert($data);   // tambahkan data ke tabel m_user

        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-1')->update($data); // update data user

        //     $data = [
        //         'level_id' => 2,
        //         'username' => 'manager_tiga',
        //         'nama' => 'Manager 3',
        //         'password' => Hash::make('12345')
        //     ];
        //     UserModel::create($data);

        //     // coba akses model UserModel
        //     $user = UserModel::all();   // ambil semua data dari tabel m_user
        //     return view('user', ['data' => $user]);

        // $user = UserModel::firstWhere('level_id', 1);


        // $user = UserModel::findOr(20, ['username', 'nama', function ()  {
        //     abort(404);
        // }]);

        // $userCount = UserModel::where('level_id', 2)->count();
        // return view('user', ['userCount' => $userCount]);

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );

        $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ],
        );
        $user->save();
        return view('user', ['data' => $user]);
    }
}