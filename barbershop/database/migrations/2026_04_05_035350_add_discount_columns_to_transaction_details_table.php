<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('transaction_details', function (Blueprint $table) {
        $table->integer('harga_asli')->after('harga')->default(0);
        $table->decimal('diskon_persen', 5, 2)->after('harga_asli')->default(0);
    });
}

public function down()
{
    Schema::table('transaction_details', function (Blueprint $table) {
        $table->dropColumn(['harga_asli', 'diskon_persen']);
    });
}
};
