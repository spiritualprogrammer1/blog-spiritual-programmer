<?php
/**
 * Created by PhpStorm.
 * User: nan
 * Date: 05/12/2018
 * Time: 15:04
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $guarded=[];
    public function getRouteKeyName()
    {
        return 'slug';
    }

}