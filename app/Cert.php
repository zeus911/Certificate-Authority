<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cert extends Model
{
	protected $fillable = ['cn', 'certificate_type', 'digest_alg', 'serial', 'key_length', 'csrprint','certprint','keyprint', 'p12'];
	
}
