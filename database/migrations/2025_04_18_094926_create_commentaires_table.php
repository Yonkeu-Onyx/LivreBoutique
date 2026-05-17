<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string("contenu");
            $table->enum("statut", ["en attente", "valide", "rejete"])->default("en attente");
            $table->foreignId("livre_id")
                ->references("id")->on("livres")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreignId("client_id")
                ->references("id")->on("clients")
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
        Schema::dropIfExists('commentaires');
    }
}
