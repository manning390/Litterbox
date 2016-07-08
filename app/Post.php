<?php

namespace App;

use Auth;
use BBCode;
use Markdown;
use App\Enums\SyntaxType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes{
        restore as baseRestore;
    }

    protected $dates = ['deleted_at'];

    protected $fillable = ['body', 'syntax', 'user_id'];

    protected $perPage = 20;

    protected $formats = [
        SyntaxType::BBCode => 'formatBBCode',
        SyntaxType::Markdown => 'formatMarkdown'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function parent(){
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function delete(){
        $this->update(['deleted_by', Auth::user()->id]);
        return parent::delete();
    }

    public function restore(){
        $this->update(['deleted_by', NULL]);
        return $this->baseRestore();
    }

    public function getHtmlAttribute() :string{
        return trim(call_user_func([$this, $this->formats[$this->syntax]]));
    }

    protected function formatBBCode() :string{
        return '<p>'.BBCode::parse($this->body).'</p>';
    }

    protected function formatMarkdown() :string{
        return Markdown::convertToHtml($this->body);
    }

    public function getIsChildAttribute(){
        return $this->parent_id != NULL;
    }

}
