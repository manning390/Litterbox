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

    protected $fillable = ['body', 'syntax'];

    protected $formats = [
        SyntaxType::BBCode => 'formatBBCode',
        SyntaxType::Markdown => 'formatMarkdown'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function thread(){
        $this->belongsTo(Thread::class);
    }

    public function parent(){
        $this->belongsTo(Post::class, 'parent_id');
    }

    public function children(){
        $this->hasMany(Post::class, 'parent_id');
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

}
