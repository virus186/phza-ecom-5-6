<?php

 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Controller; use Illuminate\Http\Request; use Illuminate\Support\Facades\Artisan; class WelcomeController extends Controller { public function welcome() { Artisan::call("\x73\164\x6f\x72\x61\x67\x65\72\x6c\x69\x6e\153"); return view("\x69\156\x73\164\x61\154\x6c\x65\x72\x2e\167\145\154\143\157\x6d\145"); } }
