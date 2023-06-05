<?php

 namespace App\Http\Controllers\Installer\Helpers; use Illuminate\Support\Facades\DB; trait MigrationsHelper { public function getMigrations() { $migrations = glob(database_path() . DIRECTORY_SEPARATOR . "\155\151\147\162\x61\164\151\157\156\x73" . DIRECTORY_SEPARATOR . "\x2a\56\160\x68\x70"); return str_replace("\56\x70\150\160", '', $migrations); } public function getExecutedMigrations() { return DB::table("\155\x69\147\162\x61\164\151\x6f\156\x73")->get()->pluck("\155\151\147\162\x61\x74\x69\x6f\156"); } }
