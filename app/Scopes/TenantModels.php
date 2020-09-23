<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;



/**
 * Created by PhpStorm.
 * User: Marcelo G
 * Date: 18/03/2018
 * Time: 15:11
 */

trait TenantModels
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());

        static::creating(function (Model $model){
           $academia_id = \Auth::user()->academia_id;
           $model->academia_id = $academia_id;
        });
    }
}