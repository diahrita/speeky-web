<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

use function PHPUnit\Framework\returnSelf;

class AdminController extends Controller
{
    // public function __construct(Database $database)
    // {
    //     $this->database = $database;
    //     $this->tablename  = 'admin';
    // }
    public function index()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/firebase.json')
            ->withDatabaseUri('https://speeky-78e2e-default-rtdb.firebaseio.com');

        $database = $firebase->createDatabase();

        $ref = $database->getReference('admin');

        $admin = $ref->getvalue();

        foreach ($admin as $admin) {
            $all_admin[] = $admin;
        }

        return view('pages.admin_list', compact('all_admin'));
    }
    public function add_admin(Request $request)
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/firebase.json')
            ->withDatabaseUri('https://speeky-78e2e-default-rtdb.firebaseio.com');

        $database = $firebase->createDatabase();

        $ref = $database->getReference('admin');

        $name = $request->name;
        $email = $request->email;
        $imageUrl = $request->imageUrl;
        $id = $request->id;

        $key = $ref->push()->getKey();

        $ref->getChild($key)->set([
            'name' => $name,
            'email' => $email,
            'imageUrl' => $imageUrl,
            'id' => $id
        ]);

        $admin = $ref->getvalue();

        foreach ($admin as $admin) {
            $all_admin[] = $admin;
        }

        return view('pages.admin_list', compact('all_admin'));
    }
    public function edit_admin($id)
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/firebase.json')
            ->withDatabaseUri('https://speeky-78e2e-default-rtdb.firebaseio.com');

        $database = $firebase->createDatabase();

        $key = $id;
        $edit = $database->getReference('admin')->getChild($key)->getValue();
        if ($edit) {
            return view('pages.admin_list', compact('edit', 'key'));
        } else {
            return redirect('admin')->with('status', 'id admin tidak ditemukan');
        }
        return view('pages.admin_list');
    }


    public function delete($id)
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/firebase.json')
            ->withDatabaseUri('https://speeky-78e2e-default-rtdb.firebaseio.com');

        $database = $firebase->createDatabase();

        $key = $id;

        // Correct the line below
        $del = $database->getReference('admin/' . $key)->remove();

        if ($del) {
            return redirect('admin')->with('status', 'Admin Deleted Successfully');
        } else {
            return redirect('admin')->with('status', 'Admin Not Deleted');
        }
    }
}
