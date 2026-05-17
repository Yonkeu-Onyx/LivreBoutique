<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string("titre");
            $table->string("description");
            $table->integer("stock");
            $table->double("prix");
            $table->enum("niveauExpertise", ["debutant", "amateur", "chef"])->default("debutant");
            $table->string("image");
            $table->foreignId("categorie_id")
                ->references("id")->on("categories")
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
        Schema::dropIfExists('livres');
    }
}
