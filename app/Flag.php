<?php

namespace App;

use App\Enums\FlagType;
use App\Enums\FlagStatusType;
use App\Exceptions\EnumException;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $fillable = [
        'type', 'status', 'body'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function updateStatus(string $status){
        if(!FlagStatusType::isValidValue($status))
            throw new EnumException("Argument is not a valid value for expected Enum.");
        $this->status = $status;
        return $this->save();
    }
}
