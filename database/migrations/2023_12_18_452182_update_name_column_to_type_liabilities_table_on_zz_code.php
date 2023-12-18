<?php

use App\TypeLiability;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class UpdateNameColumnToTypeLiabilitiesTableOnZZCode extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        TypeLiability::where('id', '117')->update(['name' => 'No aplica', 'code' => 'ZZ']);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        TypeLiability::where('id', '117')->update(['name' => 'No aplica – Otros', 'code' => 'R-99-PN']);
	}
}
