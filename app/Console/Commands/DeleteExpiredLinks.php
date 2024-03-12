<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;

class DeleteExpiredLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Link::where('expires_at', '<', now())->delete();
    }
}
