<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->string('id')->primary(); // Clé primaire personnalisée
            $table->foreignId('contrat_id')->constrained()->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->dateTime('date_creation');
            $table->integer('periode');
            $table->date('date_paiement')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('factures');
    }
};
