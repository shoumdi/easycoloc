<?php

use App\Models\Colocation;
use App\Models\Depense;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('depts', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->boolean('is_paid')->default(false);
            $table->foreignIdFor(Colocation::class,'colocation_id')->constrained();
            $table->foreignIdFor(User::class,'creditor_id')->constrained();
            $table->foreignIdFor(User::class,'debitor_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depts');
    }
};
