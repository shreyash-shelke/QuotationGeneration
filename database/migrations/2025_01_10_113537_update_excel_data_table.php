<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('excel_data', function (Blueprint $table) {
        $table->integer('qty')->change();  // Ensure it's an integer
        $table->decimal('amount', 10, 2)->change();  // Ensure it's a decimal
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('excel_data', function (Blueprint $table) {
            //
        });
    }
};
