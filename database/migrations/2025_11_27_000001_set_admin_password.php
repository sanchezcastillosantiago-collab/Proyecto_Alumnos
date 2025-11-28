<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set the password for any admin users to the literal string 'contraseña' (hashed)
        try {
            DB::table('users')
                ->where('role', 'admin')
                ->update(['password' => Hash::make('contraseña')]);

            // Attempt to send the password by email to any admin user we updated.
            // This will silently continue if mail is not configured.
            $admins = DB::table('users')->where('role', 'admin')->get();
            foreach ($admins as $admin) {
                try {
                    // resolve the user model to include helper methods if needed
                    $userModel = \App\Models\User::find($admin->id);
                    if ($userModel && filter_var($userModel->email, FILTER_VALIDATE_EMAIL)) {
                        \Illuminate\Support\Facades\Mail::to($userModel->email)->send(new \App\Mail\AdminPasswordSet($userModel, 'contraseña'));
                    }
                } catch (\Throwable $e) {
                    // ignore mailing errors during migration
                }
            }
        } catch (\Throwable $e) {
            // ignore if users table doesn't exist yet or other issues
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: we don't know previous passwords. Leave as-is.
    }
};
