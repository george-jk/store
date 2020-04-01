<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('family');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('address');
            $table->string('province');
            $table->string('village');
            $table->string('company_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('company_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->boolean('subscribe');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
