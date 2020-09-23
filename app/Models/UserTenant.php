<?php
/**
 * Created by PhpStorm.
 * User: Marcelo G
 * Date: 20/04/2018
 * Time: 21:10
 */

namespace App\Models;


use App\Scopes\TenantModels;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTenant extends User
{
    use TenantModels;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'academia_id', 'tipo_user', 'codg_user'
    ];


    public function getUsers($filtro)
    {
      return  $this->where([['codg_user', 'like', '%'.$filtro.'%'],['academia_id', \Auth::user()->academia_id] ])
            ->orWhere([
                ['name','LIKE', '%'.$filtro.'%'],
                ['academia_id', \Auth::user()->academia_id]
            ])
            ->orderBy('name')->paginate(15);
    }



    public function getTipoUserFormattedAttribute()
    {
        $value = $this->tipo_user;
        if ($value == 'A') {
            $value = 'ADMINISTRADOR';
        } elseif ($value == 'P') {
            $value = 'PROFESSOR';
        } else {
            $value = 'RECEPCIONISTA';
        }
        return $value;
    }


    public function academia()
    {
        return $this->belongsTo(Academia::class);
    }

    public function tipo($user = null)
    {
        $tipo = [
            'A' => 'ADMINISTRADOR',
            'P' => 'PROFESSOR',
            'R' => 'RECEPCIONISTA'
        ];
        if (!$user)
            return $tipo;
        return $tipo[$user];
    }


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function getCodigoControle()
    {
        $codigo = DB::table('users as u')->join('academias as a', 'u.academia_id', 'a.id')->where('a.id', \Auth::user()->academia_id)->max('codg_user');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;
    }
}