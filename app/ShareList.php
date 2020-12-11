<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareList extends Model
{
    public function contactus()
    {
        return $this->belongsTo(ContactUs::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
