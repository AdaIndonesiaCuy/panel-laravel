<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance', 10, 2)->default(0.00)->after('email');
            $table->string('role')->default('user')->after('balance');
            $table->decimal('spent', 10, 2)->default(0.00)->after('role');
            $table->decimal('profit', 10, 2)->default(0.00)->after('spent');
            $table->timestamp('last_login')->nullable()->after('profit');
            $table->string('pin')->nullable()->after('last_login');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balance');
            $table->dropColumn('role');
            $table->dropColumn('spent');
            $table->dropColumn('profit');
            $table->dropColumn('last_login');
            $table->dropColumn('pin');
        });
    }
};

// $user = auth()->user();

// $userBalance = $user->balance;
// $userRole = $user->role;
// $userSpent = $user->spent;
// $userProfit = $user->profit;
// $userLastLogin = $user->last_login;
// $userPin = $user->pin;
