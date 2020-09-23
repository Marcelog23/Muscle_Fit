<?php

namespace App;

use App\Models\Academia;
use App\Notifications\UserAcade;
use App\Notifications\UserAcadeReset;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'academia_id', 'tipo_user','codg_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function academia()
    {
        return $this->belongsTo(Academia::class);
    }

    public function tipo($user = null){

        $tipo = [
            'A' => 'ADMINISTRADOR',
            'P' => 'PROFESSOR',
            'R' => 'RECEPCIONISTA'

        ];
        if(!$user)
            return $tipo;
        return $tipo[$user];
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



    public static function newUser($nome, $email, $id)
    {
        $codigo = DB::table('users as u')
                    ->join('academias as a', 'u.academia_id', 'a.id')
                    ->where('u.academia_id', $id)
                    ->max('codg_user');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        $user = parent::create([
            'name'        => $nome,
            'email'       => $email,
            'password'    => bcrypt(123456),
            'tipo_user'   => 'A',
            'codg_user'   => $codigo,
            'academia_id' => $id
        ]);

        // gera um novo token para enviar junto a rota que ira fazer a o recadastramento do login
        $token = \Password::broker()->createToken($user);

        $user->notify(new UserAcade($token));
    }


    public  function resetPasswordUser($user)
    {
        // gera um novo token para enviar junto a rota que ira fazer a o recadastramento do login
        $token = \Password::broker()->createToken($user);
        $user->notify(new UserAcadeReset($token));

        return true;
    }

}
