<?php

namespace App\Http\Traits;

trait ImageTrait
{
    use FileUpload;

    public function setImageAttribute($value)
    {
        if (!empty($value)) {
            if (gettype($value) == 'object') {
                return $this->saveImage($value);
            } else {
                return $this->attributes['image'] = $value;
            }
        }
    }

    public function getImageAttribute()
    {
        if (!empty($this->attributes['image'])) {
            return str_starts_with($this->attributes['image'], 'http') ? $this->attributes['image'] :  asset('storage/' .  $this->attributes['image']);
        }
    }

    public static  function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
            if (!empty($model->image)) {
                $file = explode('/', $model->image);
                $fileName = end($file);
                $model->removeImage($model->folder, $fileName);
            }
        });
    }

    public function saveImage($value)
    {
        if (isset($this->attributes['image'])) {
            $file = explode('/', $this->attributes['image']);
            $this->removeImage($file[0], $file[1]);
        }
        $fileName = $this->uploadImage($value, $this->folder);

        return $this->attributes['image'] = $fileName;
    }
}
