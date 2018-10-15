<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cert extends Model
{
	protected $fillable = ['cn', 'certificate_type', 'digest_alg', 'serial', 'csrprint','certprint','keyprint', 'p12', 'status'];
	
}
