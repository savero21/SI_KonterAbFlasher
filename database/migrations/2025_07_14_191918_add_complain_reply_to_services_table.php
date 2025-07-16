<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComplainReplyToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'complain_reply')) {
                $table->text('complain_reply')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('complain_reply');
        });
    }
}
