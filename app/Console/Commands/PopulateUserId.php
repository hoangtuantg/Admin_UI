<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateUserId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-user-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $tables = ['products', 'categories'];
        $userId = 1;

        foreach ($tables as $table) {
            DB::table($table)->update(['user_id' => $userId]);
            $this->info("Đã cập nhật user_id cho bảng: {$table}");
        }

        $this->info('Đã cập nhật user_id cho tất cả các bảng');
    }
}
