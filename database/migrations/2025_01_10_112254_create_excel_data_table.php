<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelDataTable extends Migration
{
    public function up()
    {
        Schema::create('excel_data', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('qty');
            $table->decimal('amount', 8, 2);
            $table->string('phone')->nullable(); // Add phone field
            $table->string('quotation_number')->nullable(); // Add quotation number field
            $table->timestamps();
        });
    }
     

    public function down()
    {
        Schema::dropIfExists('excel_data');
    }
}
