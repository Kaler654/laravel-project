<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleMail;
use App\Models\Article;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $article;

    /**
     * Create a new job instance.
     */
    public function __construct(Article $article)
    {
        $this->article=$article;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(new ArticleMail($this->article));
    }
}
