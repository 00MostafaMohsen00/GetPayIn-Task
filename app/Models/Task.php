<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category_id',
        'due_date',
        'status',
    ];

    protected $appends = [
        'status_text',
    ];

    public static function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'due_date' => 'required|date|after_or_equal:today',

        ];
    }
    public static function statusText($index = null)
    {
        $statuses = [
            '0' => 'Pending',
            '1' => 'Completed',
        ];

        return isset($index) ? $statuses[$index] : $statuses;
    }
    public function getStatusTextAttribute()
    {
        return $this->statusText($this->status);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                $query->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        })
            ->when($filters['deleted'] ?? false, function ($query) use ($filters) {
                return $query->withTrashed();
            })->when($filters['category_id'] ?? false, function ($query) use ($filters) {
                $query->where('category_id', $filters['category_id']);
            })->when(array_key_exists('status', $filters) && $filters['status'] != '', function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })->when(array_key_exists('due_date', $filters) && $filters['due_date'] != '', function ($query) use ($filters) {
                $query->whereDate('due_date', $filters['due_date']);
            })->when(array_key_exists('sort', $filters) && $filters['sort'] != '', function ($query) use ($filters) {
                $query->orderBy('created_at', $filters['sort']);
            });
    }
}
