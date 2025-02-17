<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->date('date_debut')->comment('Date de début du contrat');
            $table->date('date_fin')->nullable()->comment('Date de fin du contrat');
            $table->decimal('prix_mois', 10, 2)->comment('Prix mensuel du contrat');

            // Clés étrangères
            $table->unsignedBigInteger('user_id')->comment('Utilisateur propriétaire de la box');
            $table->unsignedBigInteger('locataire_id')->comment('Locataire lié au contrat');
            $table->unsignedBigInteger('box_id')->comment('Box lié au contrat');
            $table->unsignedBigInteger('template_id')->nullable()->comment('Modèle de contrat utilisé');

            $table->timestamps();

            // Définir les relations avec les tables associées
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('locataire_id')->references('id')->on('locataires')->onDelete('cascade');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrats');
    }
}
