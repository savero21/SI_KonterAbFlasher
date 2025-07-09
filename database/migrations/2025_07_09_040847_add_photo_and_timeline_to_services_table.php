<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoAndTimelineToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::table('services', function (Blueprint $table) {
        if (!Schema::hasColumn('services', 'photo_path')) {
            $table->string('photo_path')->nullable()->after('total_price');
        }

        if (!Schema::hasColumn('services', 'timeline')) {
            $table->text('timeline')->nullable()->after('photo_path');
        }
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('photo_path');
            $table->dropColumn('timeline');
        });
    }
}
