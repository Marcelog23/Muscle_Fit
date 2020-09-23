<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Created by PhpStorm.
 * User: Marcelo G
 * Date: 18/03/2018
 * Time: 15:07
 */

class TenantScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder $builder
     * @param  Model $model
     * @return void
     */
    //classe de escopo global para a consulta pelo id da academia
    public function apply(Builder $builder, Model $model)
    {
       // dd($model);

        $id = \Auth::user()->academia_id;
        $builder->where('academia_id', $id);

    }
}


