<?php
  
  use Illuminate\Support\Facades\Schema;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;
  
  class CreateDescriptionAudioTable extends Migration
  {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('description_audio', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('description_id');
        $table->unsignedInteger('audio_id');
        $table->foreign('description_id')->references('id')->on('descriptions')->onDelete('cascade');
        $table->foreign('audio_id')->references('id')->on('audios')->onDelete('cascade');
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
      Schema::dropIfExists('description_audios');
    }
  }
