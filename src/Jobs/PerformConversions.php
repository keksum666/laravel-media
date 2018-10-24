<?php

namespace Optix\Media\Jobs;

use Optix\Media\Media;
use Illuminate\Bus\Queueable;
use Optix\Media\ImageManipulator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PerformConversions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $media;

    protected $conversions;

    /**
     * Create a new job instance.
     *
     * @param  Media  $media
     * @param  array  $conversions
     */
    public function __construct(Media $media, array $conversions)
    {
        $this->media = $media;

        $this->conversions = $conversions;
    }

    /**
     * Execute the job.
     *
     * @param  ImageManipulator  $manipulator
     * @return void
     */
    public function handle(ImageManipulator $manipulator)
    {
        $manipulator->manipulate(
            $this->media, $this->conversions
        );
    }
}
