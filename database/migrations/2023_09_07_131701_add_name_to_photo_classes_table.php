<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToPhotoClassesTable extends Migration
{
    public function up()
    {
        Schema::table('photo_classes', function (Blueprint $table) {
            $table->string('name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('photo_classes', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
