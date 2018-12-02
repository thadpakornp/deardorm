<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice');
            $table->string('contract');
            $table->string('due')->nullable();
            $table->string('year')->nullable();
            $table->string('ref')->nullable();
            $table->string('service')->nullable();
            $table->string('discount')->nullable();
            $table->integer('water');
            $table->integer('power');
            $table->integer('type');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('invoice');
    }

}
