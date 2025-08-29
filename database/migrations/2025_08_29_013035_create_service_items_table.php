<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->onDelete('cascade'); // kalau service dihapus, item ikut hilang
            $table->string('item_name');   // Nama sparepart / item perbaikan
            $table->integer('item_price'); // Harga per item
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
        Schema::dropIfExists('service_items');
    }
}
