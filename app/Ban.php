<?php

namespace App;

use Carbon\Carbon;
use App\Enums\BanType;
use App\Exceptions\EnumException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\ModerationActionEvent as ActionEvent;

class Ban extends Model
{
    use SoftDeletes;

    public $timestamps = [
        'expires', 'deleted_at'
    ];

    protected $casts = [
        'meta' => 'json'
    ];

    public function creators(){
        return $this->hasManyThrough(User::class, Action::class);
    }

    public function users(){
        return $this->morphedByMany(User::class, 'bannable');
    }

    public function ips(){
        return $this->morphedByMany(Ip::class, 'bannable');
    }

    public function actions(){
        return $this->hasMany(Action::class);
    }

    /**
     * Creates a ban on a bannable object
     *
     * @param misc      $bannable   Object or id to be banned
     * @param string   $type       Enum of BanType
     * @param string    $reason     Reason for ban
     * @param Carbon    $expires    Date the ban auto expires
     * @return bool
     */
    public static function apply($bannables, string $type, string $reason, $expires = null){
        if(!BanType::isValidValue($type)) throw new EnumException("Argument is not a valid value for expected Enum.");

        $ban = new self;
        $ban->expires = $expires;
        $ban->type = $type;

        if(!is_array($bannables)) $bannables = [$bannables];
        foreach($bannables as &$bannable){
            if(!$bannable instanceof BanType::$typeMap[$type])
                $bannable = (BanType::$typeMap[$type])::findOrFail($bannable);
            $bannable->bans()->save($ban);
        }

        // Report the Moderation Action
        event(new ActionEvent(\Auth::user(), $type, $reason, $ban));

        return $ban;
    }

}
