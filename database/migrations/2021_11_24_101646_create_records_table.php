<?php

use App\Models\records;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('image_path');
            $table->string('name');
            $table->integer('age');
            $table->string('contact');
            $table->string('email');
            $table->string('password');
            $table->boolean('is_email_verified')->default(0);
            $table->timestamps();
        });

        Schema::create('users_verify', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('records')->onDelete('cascade');
            $table->string('token');
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
        Schema::dropIfExists('records');
    }
}
