<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->text('event');
            $table->uuid('auditable_id');
            $table->string('auditable_type');
            $table->index([
                'auditable_id', 
                'auditable_type',
            ]);
            $table->text('url')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('tags')->nullable();
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audits');
    }
}
