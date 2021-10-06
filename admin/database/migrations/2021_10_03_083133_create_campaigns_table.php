<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->index();
            $table->string('slug')->index();
            $table->string('image', 150)->nullable();
            $table->enum('is_active', [1,0])->default(0);
            $table->string('excerpt', 250)->nullable();
            $table->longText('description')->nullable();
            $table->string('location', 200)->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('likes')->default(0);
            $table->bigInteger('created_by')->unsigned()->index();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('campaigns');
    }
}
