<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToBackOfficeUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('back_office_utilisateurs', function (Blueprint $table) {
            $table->string('image')->nullable()->after('motDePasse');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('back_office_utilisateurs', function (Blueprint $table) {
            Schema::table('back_office_utilisateurs', function (Blueprint $table) {
                $table->dropColumn('image');
            });

        });
    }
}
