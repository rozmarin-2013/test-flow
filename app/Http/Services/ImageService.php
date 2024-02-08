<?php

namespace App\Http\Services;


use App\Models\FileInterface;
use App\Models\Image;
use App\Models\ImageableInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image as ResizeImage;

class ImageService
{
    public function upload(
        UploadedFile $file,
        ImageableInterface $entity,
        FileInterface $image
    ): Image {
        $url = Storage::putFileAs($image::getStorage(), $file, $this->getNewNameFile($file));

        return $this->createImage($entity, $image, $url);
    }

    public function deleteImage(ImageableInterface $entity): void
    {
        if ($entity->image) {
            Storage::delete($entity->image->url);
            $entity->image()->delete();
        }
    }

    public function uploadResize(
        UploadedFile $file,
        ImageableInterface $entity,
        FileInterface $image
    ): Image {
        $url = $image::getStorage() . '/' . $this->getNewNameFile($file);

        ResizeImage::make($file)
            ->resize($image::getWidth(), $image::getHeight())
            ->save(Storage::path('') . $url);

        return $this->createImage($entity, $image, $url);
    }

    private function createImage(
        ImageableInterface $entity,
        FileInterface $image,
        string $url
    ): Image {
        $image->url = $url;

        $entity->image()->save($image);

        return $image;
    }

    public function getNewNameFile(UploadedFile $file): string
    {
        $name = Str::random(10);

        return  $name . '.' . $file->extension();
    }
}
