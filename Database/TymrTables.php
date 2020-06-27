<?php

namespace Tymr\Plugins\Contact\Database;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TymrTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the table as you need per project
        Schema::create('contact_users', function (Blueprint $table) { 
            $table->increments('id'); 
            $table->string('name'); 
            $table->string('email'); 
            $table->text('message'); 
            $table->timestamps(); 
        });

        // You may need multiple contacts forms, if they have different fields crerate a seperate table      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_users');
    }
}
