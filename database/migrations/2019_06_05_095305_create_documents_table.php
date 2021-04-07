<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('document_oid');
            $table->integer('product_oid');
            $table->char('language', 8);
            $table->jsonb('context')->default('{}');
            $table->tinyInteger('status')->default(0);
            $table->string('created_by', 36);
            $table->string('updated_by', 36);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['product_oid', 'language']);
            $table->index(['language', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
