<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PostPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Scheduled Posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Post::filter(['command' => '1'])->update(['status' => '1']);
    }
}
