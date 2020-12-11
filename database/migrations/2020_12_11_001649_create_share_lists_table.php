<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userId');
            $table->bigInteger('shareUserId');
            $table->bigInteger('contactId');
            $table->string('updatedBy');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('share_lists');
    }
}
