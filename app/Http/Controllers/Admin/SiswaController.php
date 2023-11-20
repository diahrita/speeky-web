<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class SiswaController extends Controller
{
    public function index()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/firebase.json')
            ->withDatabaseUri('https://speeky-78e2e-default-rtdb.firebaseio.com');

        $database = $firebase->createDatabase();

        $ref = $database->getReference('siswa');

        $siswa = $ref->getvalue();

        foreach ($siswa as $siswa) {
            $all_siswa[] = $siswa;
        }

        return view('pages.siswa_list', compact('all_siswa'));
    }
    public function add_siswa(Request $request)
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/firebase.json')
            ->withDatabaseUri('https://speeky-78e2e-default-rtdb.firebaseio.com');

        $database = $firebase->createDatabase();

        $ref = $database->getReference('siswa');

        $name = $request->name;
        $email = $request->email;
        $nis = $request->nis;
        $imageUrl = $request->imageUrl;
        $kelas = $request->kelas;

        $key = $ref->push()->getKey();

        $ref->getChild($key)->set([
            'name' => $name,
            'email' => $email,
            'nis' => $nis,
            'imageUrl' => $imageUrl,
            'kelas' => $kelas
        ]);

        $siswa = $ref->getvalue();

        foreach ($siswa as $siswa) {
            $all_siswa[] = $siswa;
        }

        return view('pages.siswa_list', compact('all_siswa'));
    }
}
