<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('code')->unique(); // for new registrations of workers
            $table->bigInteger('categoria_id');
            $table->bigInteger('business_id')->unsigned();
            $table->boolean('waiting_api')->default(False);
            $table->boolean('disabled')->default(False);
            $table->timestamps();

            $table->foreign('business_id')
                ->references('id')
                ->on('businesses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
