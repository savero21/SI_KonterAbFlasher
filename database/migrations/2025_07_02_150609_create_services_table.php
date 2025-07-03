<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('customer');
        $table->string('phone_model');
        $table->string('damage');
        $table->enum('status', ['masuk', 'diperbaiki', 'selesai'])->default('masuk');
        $table->date('received_at')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
