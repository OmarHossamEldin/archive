<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupController extends Controller
{

    public function backup(Request $request)
    {
        $pos = strpos(__dir__, "app\Http\Controllers");
        $database_source = substr_replace(__dir__, "database\database.sqlite", $pos);

        // copy database.sqlite from database/ to the required path from the request
        $destination = $request["destination"];
        
        return copy($database_source, $destination . 'database.sqlite');

    }

    public function restore(Request $request)
    {
        
        $pos = strpos(__dir__, "app\Http\Controllers");
        $database_source = substr_replace(__dir__, "database\database.sqlite", $pos);
        
        $request->file("path")->storeAs('', 'database.sqlite');

        $storage_path = substr_replace(__dir__, "storage\app\database.sqlite", $pos);

        return copy($storage_path, $database_source);
    }
}
