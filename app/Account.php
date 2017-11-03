<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    // protected $fillable 	= array();
	protected $primaryKey 	= 'account_id';

	protected $hidden = [
        'password', '_token',
    ];

	public function auth($email, $pword)
	{
		return $this->where('email', $email)->where('pword', $pword)->first();
	}

	public function student()
	{
		return $this->belongsTo('App\Student', 'student_id');
	}
}
