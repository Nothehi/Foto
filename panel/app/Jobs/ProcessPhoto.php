<?php

namespace App\Jobs;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class ProcessPhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user,
        public Photo $photo
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->getFaces() as $face) {
            $character = null;

            if ($knowingFace = $this->user->guessFace($face->image)) {
                if (! $character = $knowingFace->character) {
                    $character = $knowingFace->character()->create(['face_id' => $knowingFace->id]);
                    $knowingFace->update(['character_id' => $character->id]);

                    $characterFacesPath = "faces/{$character->key}";
                    Storage::disk('public')->makeDirectory($characterFacesPath);

                    $knowingFacePath = $characterFacesPath.'/'.basename($knowingFace->image);
                    Storage::disk('public')->move($knowingFace->image, $knowingFacePath);
                    $knowingFace->update(['image' => $knowingFacePath]);
                }

                $facePath = "faces/{$character->key}/".basename($face->image);
                Storage::disk('public')->move($face->image, $facePath);
                $face->image = $facePath;
            }

            $this->photo->faces()->create([
                'character_id' => $character?->id,
                'image' => $face->image,
                'coordinate' => $face->coordinate,
                'encoding' => $face->encoding,
            ]);
        }
    }

    public function getFaces(): array
    {
        $faces = Process::path(base_path('../vision'))
            ->run(['./main.py', 'face', "../storage/{$this->photo->path}"])
            ->output();

        return json_decode(str_replace('\'', '"', $faces));
    }
}
