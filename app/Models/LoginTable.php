<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 06/06/18
 * Time: 16.50
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class LoginTable extends  Model
{
    public $timestamps = false;
    protected $table = 'login_table';

    protected $guarded = ['id'];




}