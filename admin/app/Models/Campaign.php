<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','slug','excerpt','description','location','image','is_published','start_date','end_date','likes','created_by'
    ];

    public function getStartDateAttribute($val){
        return date('Y-m-d', strtotime($val));
    }

    public function getEndDateAttribute($val){
        return date('Y-m-d', strtotime($val));
    }

    public function create($data){
        $new_campiagn               = new static();
        $new_campiagn->name         = $data['name'] ?? NULL;
        $randNo = crc32( uniqid());
        if($data['name'] !== null){
            $new_campiagn->slug         = $data['name'] ? Str::slug($data['name'], '-') .'-'. $randNo : NULL;
        }
        $new_campiagn->excerpt      = $data['excerpt'] ?? NULL;
        $new_campiagn->description  = $data['description'] ?? NULL;
        $new_campiagn->location     = $data['location'] ?? NULL;
        $new_campiagn->image        = $data['image'] ?? NULL;
        $new_campiagn->start_date   = $data['start_date'] ?? NULL;
        $new_campiagn->end_date     = $data['end_date'] ?? NULL;
        $new_campiagn->category_id  = $data['category_id'] ?? NULL;
        $new_campiagn->created_by   = Auth::user()->id;
        $new_campiagn->save();
        return $new_campiagn;
    }

    public function updateCampaign($data, $id){
        $saved_entry = $this->where('id', $id)->first();

        $saved_entry->name         = $data['name'] ?? $saved_entry->name;
        $randNo = crc32( uniqid());
        if($data['name'] !== null){
            $saved_entry->slug         = $data['name'] ? Str::slug($data['name'], '-') .'-'. $randNo : NULL;
        }
        $saved_entry->excerpt      = $data['excerpt'] ?? NULL;
        $saved_entry->description  = $data['description'] ?? NULL;
        $saved_entry->location     = $data['location'] ?? NULL;
        $saved_entry->image        = $data['image'] ?? NULL;
        $saved_entry->is_published = $data['is_published'] ?? $saved_entry->is_published;
        $saved_entry->is_featured  = $data['is_featured'] ?? $saved_entry->is_featured;
        $saved_entry->start_date   = $data['start_date'] ?? NULL;
        $saved_entry->end_date     = $data['end_date'] ?? NULL;
        $saved_entry->category_id  = $data['category_id'] ?? NULL;
        $saved_entry->created_by   = Auth::user()->id;
        $saved_entry->save();
        return $saved_entry;
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\User','created_by')->select('id','name','image');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id')->select('id','name');
    }
}
