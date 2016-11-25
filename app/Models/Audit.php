<?php
/**
 * Created by PhpStorm.
 * User: savva
 * Date: 11/25/2016
 * Time: 8:20 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Audit extends Model
{

    protected $table='audits';
    protected $fillable = [
        'route',
        'method',
        'userid'
    ];

}