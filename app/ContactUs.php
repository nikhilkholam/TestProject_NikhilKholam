<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = [
        'firstName', 'middleName', 'lastName', 'primaryPhone', 'emailId', 'image','active','updatedBy'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ]; 

    public function sharelist()
    {
        return $this->hasMany(ShareList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
