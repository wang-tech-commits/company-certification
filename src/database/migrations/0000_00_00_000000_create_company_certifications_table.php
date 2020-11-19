<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industry_id')->comment('行业');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('title', 100);
            $table->string('name', 32)->nullable();
            $table->string('id_card', 32)->nullable();
            $table->string('phone', 16)->nullable();
            $table->tinyInteger('code_type')->comment('机构代码类型')->default(1);
            $table->string('organization_code', 100);
            $table->tinyInteger('status')->default(0);
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('company_certifications');
    }
}
