<?php

use Illuminate\Database\Seeder;

class UserArchive extends \Eloquent {

    protected $connection = 'cl_archive';
    protected $table = 'users';
    protected $dates = [
        'created_at', 'updated_at', 'logon_at'
    ];

    public function profile(){
        return $this->hasOne(ProfileArchive::class, 'user_id');
    }
}

class ProfileArchive extends \Eloquent {
    protected $connection = 'cl_archive';
    protected $table = 'profiles';

    public function user(){
        return $this->belongsTo(UserArchive::class, 'user_id', 'users');
    }
}

class UserArchiveTableSeeder extends Seeder {
    public function run(){
        $userData = UserArchive::all();
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table('users')->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        Eloquent::unguard();
        foreach ($userData as $userSingle){
            $archiveOptions = json_decode($userSingle->meta);
            $options = [
                'color' => $archiveOptions->color ?? '#222223',
                'syntax' => \App\Enums\SyntaxType::Markdown,
                'nsfw' => $archiveOptions->show_nsfw ?? 'false',
                'mentionsNotify' => $archiveOptions->notify_about_mentions ?? true,
                'pmsNotify' => $archiveOptions->notify_about_pms ?? true,
            ];
            try {
                App\User::create([
                    'id'    => $userSingle->id,
                    'name'  => $userSingle->name,
                    'password'  => $userSingle->password_hash ?? $userSingle->password,
                    'email'     => $userSingle->email,
                    'points'    => $userSingle->points,
                    'profile'   => $userSingle->profile->content ?? '',
                    'options'   => json_encode($options),
                    'login_at'  => $userSingle->logon_at,
                    'created_at' => $userSingle->created_at,
                ]);
            } catch (Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    $first = App\User::whereEmail($userSingle->email)->first();
                    echo "Duplicate Entry for user $userSingle->id ($userSingle->name) and $first->id ($first->name)\n";
                }else{
                    echo "Encountered error ".$e->errorInfo[1]." on user $userSingle->id ($userSingle->name): ".$e->errorInfo[2]."\n";
                }
            }
        }
    }
}