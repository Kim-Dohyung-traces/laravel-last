<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program_attachment extends Model
{
    protected $fillable = [
        'filename',
        'bytes',
        'mime',
    ];
    protected $hidden = [
        'program_id',
        'created_at',
        'updated_at',
    ];
    protected $appends = [
        'url',
    ];
    public function program()
    {
        return $this->belongsTo(program::class);
    }
    /* Accessors */
    public function getBytesAttribute($value)
    {
        return format_filesize($value);
    }
    public function getUrlAttribute()
    {
        return url('files/' . $this->filename);
    }
}
