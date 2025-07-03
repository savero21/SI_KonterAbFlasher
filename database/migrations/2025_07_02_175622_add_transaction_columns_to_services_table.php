<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionColumnsToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::table('services', function (Blueprint $table) {
        $table->string('pickup_code')->nullable()->after('status');
        $table->integer('total_price')->nullable()->after('pickup_code');
    });
}

public function down()
{
    Schema::table('services', function (Blueprint $table) {
        $table->dropColumn(['pickup_code', 'total_price']);
    });
}

}
