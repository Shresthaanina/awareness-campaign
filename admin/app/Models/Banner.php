<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','excerpt','button_text','button_link','image','is_active'
    ];

    public function create($data){
        $new_engty               = new static();
        $new_engty->title        = $data['title'] ?? NULL;
        $new_engty->excerpt      = $data['excerpt'] ?? NULL;
        $new_engty->button_text  = $data['button_text'] ?? NULL;
        $new_engty->button_link  = $data['button_link'] ?? NULL;
        $new_engty->image        = $data['image'] ?? NULL;
        $new_engty->is_active    = $data['is_active'] ?? 1;
        $new_engty->save();
        return $new_engty;
    }

    public function updateBanner($data, $id){
        $saved_entry = $this->where('id', $id)->first();

        $saved_entry->title         = $data['title'] ?? $saved_entry->title;
        $saved_entry->excerpt       = $data['excerpt'] ?? NULL;
        $saved_entry->button_text   = $data['button_text'] ?? NULL;
        $saved_entry->button_link   = $data['button_link'] ?? NULL;
        $saved_entry->image         = $data['image'] ?? NULL;
        $saved_entry->save();
        return $saved_entry;
    }
}
