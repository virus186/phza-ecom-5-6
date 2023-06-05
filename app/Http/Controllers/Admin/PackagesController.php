<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2022-08-31 19:46:26              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.Phza24@gmail.com>, September 2018
*/

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\PackageInstallationRequest;
use App\Services\PackageInstaller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PackagesController extends Controller
{
    public function index()
    {
        $installables = $this->scanPackages();
        $installs = Package::all();
        return view("\141\144\x6d\x69\156\x2e\x70\141\143\153\x61\x67\x65\163\x2e\x69\x6e\144\x65\170", compact("\x69\x6e\x73\164\x61\x6c\x6c\x61\142\x6c\x65\163", "\x69\x6e\163\164\x61\x6c\x6c\163"));
    }
    public function upload()
    {
        return view("\x61\144\x6d\x69\156\x2e\160\141\x63\153\141\x67\145\163\x2e\x5f\165\x70\154\157\x61\x64");
    }
    public function save(Request $request)
    {
        echo "\74\x70\x72\x65\76";
        print_r($request->all());
        echo "\74\x70\x72\145\x3e";
        exit("\x65\x6e\144\41");
    }
    public function initiate(Request $request, $package)
    {
        if (!(config("\141\x70\x70\56\144\x65\155\x6f") == true && config("\141\x70\160\56\144\x65\142\165\x67") !== true)) {
            goto KCZKz;
        }
        return back()->with("\167\x61\x72\x6e\151\x6e\x67", trans("\155\x65\163\163\141\x67\145\x73\56\144\145\x6d\157\137\162\x65\x73\x74\162\x69\143\x74\x69\157\156"));
        KCZKz:
        $installable = $this->scanPackages($package);
        if (!$installable) {
            goto XzIXk;
        }
        if (!Package::where("\163\x6c\165\x67", $installable["\x73\x6c\165\147"])->first()) {
            goto wu2GZ;
        }
        return back()->with("\x65\x72\162\157\x72", trans("\x6d\145\163\x73\141\147\x65\x73\56\160\x61\143\x6b\x61\147\145\x5f\x69\156\163\164\141\x6c\154\x65\x64\137\x61\x6c\x72\145\x61\x64\x79", ["\x70\x61\143\153\x61\x67\x65" => $package]));
        wu2GZ:
        XzIXk:
        return view("\141\144\155\151\x6e\x2e\160\x61\x63\153\141\x67\145\163\56\137\x69\156\x69\x74\151\x61\x74\145", compact("\x69\156\x73\164\x61\x6c\154\141\142\x6c\x65"));
    }
    public function install(PackageInstallationRequest $request, $package)
    {
        if (!(config("\141\160\160\56\x64\x65\155\x6f") == true && config("\x61\x70\160\x2e\144\x65\142\x75\x67") !== true)) {
            goto DjcVz;
        }
        return back()->with("\x77\141\x72\x6e\x69\x6e\x67", trans("\x6d\145\163\x73\141\147\145\x73\x2e\144\145\x6d\157\x5f\162\145\x73\164\162\x69\143\x74\151\x6f\156"));
        DjcVz:
        $installable = $this->scanPackages($package);
        if (!$installable) {
            goto jIZVy;
        }
        try {
            $installer = new PackageInstaller($request, $installable);
            $installer->install();
        } catch (\Exception $e) {
            Log::error($e);
            $installer->uninstall();
            $registered = Package::where("\163\154\x75\147", $package)->first();
            if (!$registered) {
                goto YGJ00;
            }
            $registered->delete();
            YGJ00:
            return back()->with("\x65\x72\162\157\x72", $e->getMessage());
        }
        Artisan::call("\143\141\143\150\x65\72\143\x6c\x65\141\x72");
        Artisan::call("\162\157\x75\164\145\72\143\x6c\x65\141\x72");
        return back()->with("\x73\165\143\143\145\163\163", trans("\155\145\163\163\x61\147\145\x73\56\160\x61\143\153\x61\x67\145\x5f\x69\156\x73\x74\141\154\154\145\144\137\163\x75\x63\x63\x65\x73\x73", ["\160\x61\x63\x6b\x61\x67\x65" => $package]));
        jIZVy:
        return back()->with("\145\x72\162\157\162", trans("\155\x65\x73\163\141\147\145\163\x2e\146\141\x69\154\x65\x64"));
    }
    public function uninstall(Request $request, $package)
    {
        if (!(config("\141\x70\x70\56\x64\145\155\157") == true && config("\x61\x70\x70\x2e\x64\x65\x62\165\x67") !== true)) {
            goto WclC2;
        }
        return back()->with("\167\141\162\156\x69\x6e\x67", trans("\x6d\x65\x73\x73\x61\147\x65\x73\56\144\145\155\x6f\137\x72\145\x73\x74\162\151\143\x74\x69\157\x6e"));
        WclC2:
        $registered = Package::where("\163\x6c\x75\x67", $package)->firstOrFail();
        $uninstallable = $this->scanPackages($package);
        DB::beginTransaction();
        try {
            $installer = new PackageInstaller($request, $uninstallable);
            if (!$installer->uninstall()) {
                goto LplA4;
            }
            Artisan::call("\x63\x61\x63\150\x65\x3a\x63\x6c\145\x61\x72");
            Artisan::call("\162\x6f\x75\164\145\x3a\143\154\x65\x61\x72");
            if (!$registered->delete()) {
                goto M1qFV;
            }
            $msg = trans("\155\145\x73\x73\141\147\145\163\x2e\160\141\x63\x6b\x61\x67\145\137\x75\156\151\156\x73\x74\x61\x6c\x6c\145\x64\137\x73\165\143\x63\x65\163\163", ["\x70\x61\x63\x6b\141\x67\x65" => $package]);
            DB::commit();
            return back()->with("\x73\165\143\143\145\x73\x73", $msg);
            M1qFV:
            LplA4:
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return back()->with("\145\x72\x72\157\162", $e->getMessage());
        }
        return back()->with("\145\x72\x72\x6f\162", trans("\155\x65\x73\163\141\x67\145\163\56\x66\x61\151\154\145\144"));
    }
    public function activation(Request $request, $package)
    {
        if (!(config("\141\x70\x70\56\144\x65\x6d\x6f") == true && config("\141\160\x70\56\144\x65\x62\165\x67") !== true)) {
            goto LqcbG;
        }
        return response("\x65\x72\162\157\x72", 444);
        LqcbG:
        if (!($registered = Package::where("\x73\x6c\165\147", $package)->first())) {
            goto N1f_P;
        }
        $registered->active = !$registered->active;
        $registered->save();
        Artisan::call("\143\x61\143\x68\145\x3a\x63\154\x65\x61\162");
        return response("\163\x75\x63\143\145\163\163", 200);
        N1f_P:
        $unregistered = $this->scanPackages($package);
        Log::info($unregistered);
        if (!$unregistered) {
            goto MC6Vh;
        }
        $registered = Package::create($unregistered);
        MC6Vh:
        return response("\163\x75\143\143\x65\x73\x73", 200);
    }
    public function updateConfig(Request $request)
    {
        if (!updateOptionTable($request)) {
            goto SXmc8;
        }
        Artisan::call("\143\141\143\x68\145\72\143\x6c\x65\x61\x72");
        return back()->with("\163\x75\x63\143\x65\163\163", trans("\x6d\x65\x73\x73\x61\147\x65\163\56\160\141\143\x6b\x61\x67\145\x5f\163\x65\164\x74\151\x6e\x67\163\137\165\x70\144\141\x74\145\144"));
        SXmc8:
        return back()->with("\145\162\x72\x6f\x72", trans("\155\x65\163\x73\x61\x67\145\163\x2e\146\x61\151\154\x65\144"));
    }
    public function toggleConfig(Request $request, $option)
    {
        if (!(config("\x61\x70\160\56\144\x65\155\x6f") == true && config("\x61\160\x70\56\x64\145\x62\165\147") !== true)) {
            goto xA0Tk;
        }
        return response("\145\162\162\x6f\162", 444);
        xA0Tk:
        if (!DB::table("\157\160\x74\151\157\156\x73")->where("\157\x70\x74\x69\x6f\156\137\x6e\141\x6d\x65", $option)->update(["\x6f\160\164\x69\157\x6e\x5f\166\x61\x6c\x75\145" => DB::raw("\x4e\x4f\124\x20\x6f\160\164\x69\157\x6e\x5f\x76\141\154\x75\145")])) {
            goto LNX70;
        }
        Artisan::call("\x63\141\x63\x68\145\72\143\x6c\145\141\162");
        return response("\x73\165\143\x63\145\163\x73", 200);
        LNX70:
        return response("\145\x72\162\157\162", 405);
    }
    private function scanPackages($slug = null)
    {
        $packages = [];
        foreach (glob(base_path("\160\141\143\x6b\141\x67\145\163\57\x2a"), GLOB_ONLYDIR) as $dir) {
            if (!file_exists($manifest = $dir . "\x2f\155\x61\x6e\151\146\145\163\x74\56\152\x73\x6f\156")) {
                goto FnV3I;
            }
            $json = file_get_contents($manifest);
            if (!($json !== '')) {
                goto Kwvlp;
            }
            $data = json_decode($json, true);
            if (!($data === null)) {
                goto jBith;
            }
            throw new \Exception("\111\156\x76\141\154\151\x64\40\x6d\x61\x6e\x69\x66\x65\x73\x74\56\x6a\x73\x6f\156\x20\146\x69\x6c\x65\40\x61\164\40\x5b{$dir}\135");
            jBith:
            $data["\160\141\x74\x68"] = $dir;
            if (!($slug && $data["\163\154\165\147"] == $slug)) {
                goto YO0CH;
            }
            return $data;
            YO0CH:
            $packages[] = $data;
            Kwvlp:
            FnV3I:
            n06Qc:
        }
        SblGd:
        return $packages;
    }
}
