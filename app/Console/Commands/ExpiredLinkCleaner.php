<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class ExpiredLinkCleaner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expired-link-cleaner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for clean old links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Link::orderBy('created_at')->chunk(100, function (Collection $links) {
            foreach ($links as $link) {
                if ($link->isExpired() || ! $link->hasRedirectAttempts()) {
                    $link->delete();
                }
            }
        });
    }
}
