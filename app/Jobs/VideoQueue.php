<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class VideoQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $cmd;
    protected $video_path;
    public function __construct($cmd,$video_path)
    {
        $this->cmd=$cmd;
        $this->video_path=$video_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        exec($this->cmd, $status);
        \DB::table('videos')->where('video_path',$this->video_path)->update(['state'=>'1']);
    }
}
