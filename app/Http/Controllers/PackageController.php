<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\DB;

class PackageController extends Controller
{
    public function createpackage(Request $request)
    {

        $package = new Package();

        $package->title = $request->title;
        $package->userid = $request->userid;
        $package->bio = $request->bio;
        $package->description = $request->description;
        $package->tag = $request->tag;
        $package->services = $request->services;
        $package->service_details = $request->service_details;
        $package->price = $request->price;
        $package->save();

        return response()->json($package);
    }

    public function packageList($id) {
        $package = Package::where('userid', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($package, 200);
    }

    public function getPackage($id) {
        $package = Package::find($id);

        return response()->json($package);
    }

    public function allPackage() {
        $packages = Package::join("users", "users.id", "=", "packages.userid")
                            ->get(['packages.id', 'packages.title', 'packages.image', 'users.name', 'users.id as userid', 'packages.ratting', 'packages.ratting_count', 'packages.price', 'users.image as propic']);

        return response()->json($packages);
    }
}
