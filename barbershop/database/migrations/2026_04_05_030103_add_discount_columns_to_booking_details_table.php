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
    Schema::table('booking_details', function (Blueprint $table) {
        $table->integer('harga_asli')->after('harga')->default(0);
        $table->decimal('diskon_persen', 5, 2)->after('harga_asli')->default(0);
        $table->integer('harga_bayar')->after('diskon_persen')->default(0);
        $table->unsignedBigInteger('discount_id')->nullable()->after('harga_bayar');
        $table->foreign('discount_id')->references('id')->on('discounts')->nullOnDelete();
    });
}

public function down()
{
    Schema::table('booking_details', function (Blueprint $table) {
        $table->dropForeign(['discount_id']);
        $table->dropColumn(['harga_asli', 'diskon_persen', 'harga_bayar', 'discount_id']);
    });
}
};
