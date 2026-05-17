<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieLivresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_livres', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_categorie")
                ->references("id")->on("categories")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreignId("id_livre")
                ->references("id")->on("livres")
                ->onDelete("cascade")
                ->onUpdate("cascade");
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
        Schema::dropIfExists('categorie_livres');
    }
}
