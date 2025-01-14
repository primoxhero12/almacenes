<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisme.article_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_id');
            $table->foreign('article_id')->references('id')->on('sisme.articles');
            $table->integer('storage_id');//para  diferenciar los historiales
            $table->foreign('storage_id')->references('id')->on('sisme.storages');
            $table->enum('type', ['Entrada', 'Salida']);
            $table->integer('article_income_item_id')->nullable(); //entradas
            $table->foreign('article_income_item_id')->references('id')->on('sisme.article_income_items');
            $table->integer('article_request_item_id')->nullable();//salidas
            $table->foreign('article_request_item_id')->references('id')->on('sisme.article_request_items');
            $table->decimal('quantity_desc')->nullable();//cantidad descontada
            $table->timestamps();
            $table->softDeletes();
        });
    }

       /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sisme.article_histories');
    }
}
