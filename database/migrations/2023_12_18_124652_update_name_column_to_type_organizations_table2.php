<?php

use App\TypeOrganization;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class UpdateNameColumnToTypeOrganizationsTable2 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        TypeOrganization::where('id', '1')->update(['name' => 'Persona Jurídica', 'code' => '1']);
        TypeOrganization::where('id', '2')->update(['name' => 'Persona Natural', 'code' => '2']);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        TypeOrganization::where('id', '1')->update(['name' => 'Persona Jurídica y asimiladas', 'code' => '1']);
        TypeOrganization::where('id', '2')->update(['name' => 'Persona Natural y asimiladas', 'code' => '2']);
	}
}
