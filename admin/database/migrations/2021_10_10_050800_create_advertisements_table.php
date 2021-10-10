<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->index();
            $table->string('excerpt',200)->nullable();
            $table->string('image',200)->nullable();
            $table->enum('contact_type', ['mail','phone'])->default('mail');
            $table->string('contact_detail',50)->nullable();
            $table->enum('is_published',[2,1,0])->default(0);

            $table->bigInteger('created_by')->unsigned()->index();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('advertisements');
    }
}
