<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, ImageTrait;

    protected $fillable = ['title', 'content', 'user_id', 'image', 'status', 'scheduled_time'];

    protected $folder = 'posts';

    protected $appends = [
        'status_text',
    ];

    public static function rules()
    {
        return [
            'title' => 'required|string|max:255|min:3',
            'content' => 'required|string|min:3|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'sometimes|in:0,2',
            'scheduled_time' => 'required|date|after_or_equal:today',
            'platforms' => 'required|array',
            'platforms.*' => 'required|exists:platforms,id',
        ];
    }

    public static function statusText($index = null)
    {
        $statuses = [
            '0' => 'Drafted',
            '1' => 'Published',
            '2' => 'Scheduled',
        ];

        return isset($index) ? $statuses[$index] : $statuses;
    }
    public function getStatusTextAttribute()
    {
        return $this->statusText($this->status);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(array_key_exists('status', $filters) && $filters['status'] != '', function ($query) use ($filters) {
            $query->where('status', '' . $filters['status'] . '');
        })->when(array_key_exists('date', $filters) && $filters['date'] != '', function ($query) use ($filters) {
            $query->whereDate('scheduled_time', $filters['date']);
        })->when(array_key_exists('command', $filters) && $filters['command'] != '', function ($query) {
            $query->where('scheduled_time', '<=', now())->where('status', '2');
        })->orderBy('created_at', 'desc');
    }

    public function scopeEditable($query)
    {
        return $query->whereIn('status', ['0', '2']);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'post_platforms');
    }
}
