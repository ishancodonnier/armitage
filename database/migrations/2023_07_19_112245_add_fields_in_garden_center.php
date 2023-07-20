<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInGardenCenter extends Migration
{
    public function up()
    {
        Schema::table('garden_center', function (Blueprint $table) {
            $table->boolean('status')->nullable();
            $table->boolean('is_delete')->nullable()->default(0);
        });
    }

    public function down()
    {
        Schema::table('garden_center', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('is_delete');
        });
    }
}
