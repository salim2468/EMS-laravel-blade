<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('province', 20)->after('remember_token');
            $table->string('district', 20)->after('province');
            $table->string('address')->after('district');
            $table->string('phone', 20)->nullable()->after('address');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->enum('gender', ['male', 'female'])->nullable()->after('date_of_birth');
            $table->date('joined_date')->nullable()->after('gender');
            $table->string('job_title')->after('joined_date');
            $table->enum('employment_type', ['full-time', 'part-time', 'contract'])->default('full-time')->after('job_title');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('employment_type');
            $table->string('profile_img')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'province', 'district', 'address', 'phone',
                'date_of_birth',
                'gender', 'joined_date', 'job_title',
                'employment_type', 'status', 'profile_img'
            ]);
        });
    }
}
