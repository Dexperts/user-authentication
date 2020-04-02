<?php
namespace Dexperts\Authentication\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MinimalSetupSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
	    DB::table( 'users' )->insert( [
		    'name'              => 'Administrator Dexperts',
		    'email'             => 'administrator@dexperts.nl',
		    'email_verified_at' => now(),
		    'password'          => Hash::make( '$$Admin123' ),
		    'type'              => 'admin',
		    'remember_token'    => Str::random( 10 )
	    ] );
    }
}
