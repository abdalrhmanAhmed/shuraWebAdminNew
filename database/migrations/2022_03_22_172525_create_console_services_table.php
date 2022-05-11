<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsoleServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('console_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('console_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('console_id')->references('id')->on('consoles');
            $table->foreign('service_id')->references('id')->on('services');
            $table->integer('type');
            $table->decimal('price',12,2);
            $table->softDeletes();
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
        Schema::dropIfExists('console_services');
    }
}
