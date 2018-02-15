<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $primaryKey = 'forum_comment_id';
    protected $table = "forums_comments";

}
