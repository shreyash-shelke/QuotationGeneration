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
            if (!Schema::hasColumn('excel_data', 'quotation_number')) {
                $table->string('quotation_number')->nullable();
            }
            if (!Schema::hasColumn('excel_data', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
    }
    
    public function down()
    {
        Schema::table('excel_data', function (Blueprint $table) {
            $table->dropColumn('quotation_number');
            $table->dropColumn('phone');
        });
    }
    
};
