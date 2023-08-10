<?php

namespace App\Services\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

trait StorageTrait
{
    /**
     * Store image.
     *
     * @param object $image
     * @return void
     */
    public function storeImages(array &$data): void
    {
        foreach ($data as $key => $image) {
            $name = md5(Carbon::now() . '_' . $image
                        ->getClientOriginalName()) . '.' . $image
                    ->getClientOriginalExtension();

            $image = Storage::disk('public')->putFileAs('/images', $image, $name);

            $image = $this->getImageRepository()->store([
                'path' => $image,
                'url' => url('/storage/' . $image),
            ]);

            Cache::put("images:$image->id", $image);

            $data[$key] = $image->id;
        }
    }

    /**
     * Update image.
     *
     * @param int $imageId
     * @param object $image
     * @return void
     */
    public function updateImage(int $imageId, object &$image): void
    {
        $name = md5(Carbon::now() . '_' . $image
                    ->getClientOriginalName()) . '.' . $image
                ->getClientOriginalExtension();
        $image = Storage::disk('public')->putFileAs('/images', $image, $name);
        $imageModel = $this->getImageRepository()->findById($imageId);
        Storage::disk('public')->delete($imageModel->path);
        $this->getImageRepository()->update($imageId, [
            'path' => $image,
            'url' => url('/storage/' . $image),
        ]);
        $imageModel = $this->getImageRepository()->findById($imageId);
        Cache::put("images:$imageId", $imageModel);
    }

    /** Destroy image.
     * @param int $imageId
     * @return void
     */
    public function destroyImage(int $imageId): void
    {
        $image = $this->getImageRepository()->findById($imageId);
        Storage::disk('public')->delete($image->path);
        $this->getImageRepository()->destroy($imageId);
        Cache::forget("images:$imageId");
    }
}
