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
        $table->string('phone')->nullable(); // Add the phone column, nullable if it's optional
    });
}

public function down()
{
    Schema::table('excel_data', function (Blueprint $table) {
        $table->dropColumn('phone'); // This will drop the phone column when rolling back
    });
}
};
