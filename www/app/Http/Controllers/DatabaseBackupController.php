<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupController extends Controller
{
    public function backup(Request $request)
    {
        // copy database.sqlite from database/ to the required path from the request
        $destination = $request["destination"];
        return copy('storage\app\database.sqlite', $destination . 'database.sqlite');

    }

    public function restore(Request $request)
    {
        
        $request->file($request["path"])->storeAs('', 'database.sqlite');
    }
}
