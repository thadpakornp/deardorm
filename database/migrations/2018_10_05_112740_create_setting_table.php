<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iddorm', 13);
            $table->string('name_en');
            $table->string('name_th');
            $table->string('address');
            $table->string('email');
            $table->string('phone', 10);
            $table->integer('rate_water');
            $table->integer('rate_elec');
            $table->integer('vat');
            $table->string('due', 2);
            $table->string('die', 2);
            $table->string('pay', 5);
            $table->string('pay_limit', 5);
            $table->string('bank');
            $table->string('contract');
            $table->string('logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('setting');
    }

}
