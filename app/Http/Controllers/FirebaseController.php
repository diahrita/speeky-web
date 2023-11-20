<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    public function index()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/firebase.json')
            ->withDatabaseUri('https://speeky-78e2e-default-rtdb.firebaseio.com');

        $database = $firebase->createDatabase();

        $siswa = $database
            ->getReference('siswa');

        echo '<pre>';
        print_r($siswa->getvalue());
        echo '</pre>';
    }
}
