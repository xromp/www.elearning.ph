<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    // protected $fillable 	= array();
	protected $primaryKey 	= 'category_id';

	public function questionCategory()
	{
		return $this->belongsTo('App\Question', 'category_id', 'category_code');
	}
}
