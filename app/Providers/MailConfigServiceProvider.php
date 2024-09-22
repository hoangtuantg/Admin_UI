<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\SystemEmail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('system_email')) {
            $gmail = SystemEmail::first();

            if ($gmail) {
                config([
                    'mail.mailers.smtp.transport' => 'smtp',
                    'mail.mailers.smtp.host' => 'smtp.gmail.com',
                    'mail.mailers.smtp.port' => 587,
                    'mail.mailers.smtp.encryption' => 'tls',
                    'mail.mailers.smtp.username' => $gmail->mail_username,
                    'mail.mailers.smtp.password' => $gmail->mail_password,
                    'mail.from.address' => $gmail->mail_username,
                    'mail.from.name' => $gmail->mail_from_name,
                ]);
            }
        }
    }
}
