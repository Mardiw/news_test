<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class CommentCreationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $commentData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($commentData)
    {
        $this->commentData = $commentData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Redis::set('comments:comment', $this->commentData['comment']);
        // Redis::set('comments:created_by', $this->commentData['user_id']);
        // Redis::set('comments:news_id', $this->commentData['news_id']);
        Comment::create([
            'created_by' => $this->commentData['created_by'],
            'news_id' => $this->commentData['news_id'],
            'comment' => $this->commentData['comment']
        ]);
    }
}
