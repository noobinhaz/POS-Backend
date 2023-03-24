<?php

use App\Engine\DbFields\Fields;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->autoIncrement()->primary();
            $table->uuid('products_id');
            $table->string('price');
            $table->integer('quantity');
            $table->integer('unit_id');
            $table->string('clientName')->nullable()->default(Null);
            $table->string('clientEmail')->nullable()->default(Null);
            Fields::AddCommonField($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
