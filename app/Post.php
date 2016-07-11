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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'syntax', 'user_id', 'thread_id'
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * The mappings for the SyntaxType enum to foatmat methods
     *
     * @var array
     */
    protected $formats = [
        SyntaxType::BBCode => 'formatBBCode',
        SyntaxType::Markdown => 'formatMarkdown'
    ];

    /**
     * Many Posts are created by Users
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Many Posts belong to a Thread
     */
    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    /**
     * A Post may have a parent Post
     */
    public function parent(){
        return $this->belongsTo(Post::class, 'parent_id');
    }

    /**
     * A Post may have child Posts
     */
    public function children(){
        return $this->hasMany(Post::class, 'parent_id');
    }

    /**
     * Override to update who deleted a Post
     */
    public function delete(){
        $this->update(['deleted_by', Auth::user()->id]);
        return parent::delete();
    }

    /**
     * Override to reset who deleted a Post
     */
    public function restore(){
        $this->update(['deleted_by', NULL]);
        return $this->baseRestore();
    }

    /**
     * The html content of the Post
     *
     * @var string
     */
    public function getHtmlAttribute() :string{
        return trim(call_user_func([$this, $this->formats[$this->syntax]]));
    }

    /**
     * Converts the Post to Html from BBCode format
     *
     * @return string
     */
    protected function formatBBCode() :string{
        return '<p>'.BBCode::parse($this->body).'</p>';
    }

    /**
     * Returns the page number the Post is on
     *
     * @param int
     * @return int
     */
    public function getPage(int $perPage = NULL){
        $perPage = $perPage ?? $this->perPage;
        $postsBefore = $this->thread->posts()->where('id', '<', $this->id)->count();
        return (int)($postsBefore / $perPage + 1);
    }

    /**
     * Converts the Post to Html from Markdown format
     *
     * @return string
     */
    protected function formatMarkdown() :string{
        return Markdown::convertToHtml($this->body);
    }

    /**
     * If the Post is a child or not
     *
     * @return bool
     */
    public function getIsChildAttribute(){
        return $this->parent_id != NULL;
    }

    /**
     * Returns the permalink to the Post
     *
     * @return string
     */
    public function getPermalinkAttribute(){
        return route('thread.show', [$post->thread, 'page'=>$post->getPage()]).'#'.$post->id;
    }
}
