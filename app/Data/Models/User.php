<?php

namespace App\Data\Models;

use App\Data\Repositories\TiposUsuarios;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Venturecraft\Revisionable\RevisionableTrait;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class User extends Authenticatable implements MustVerifyEmail, AuditableContract
{
    use Notifiable;
    use RevisionableTrait;
    use AuditableTrait;
    //use SoftDeletes;

    /**
     * @var array
     */
    protected $with = ['userType'];
    //protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'user_type_id',
        'disabled_by_id',
        'disabled_at',
        'personal_email',
        'all_notifications',
        'no_notifications',
        'last_login_at',
    ];

    protected $appends = ['model'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userType()
    {
        return $this->belongsTo(TipoUsuario::class, 'user_type_id');
    }

    /**
     * @param $query
     * @param $type
     *
     * @return mixed
     */
    public function scopeType($query, $type)
    {
        return $query->where(
            'user_type_id',
            app(TiposUsuarios::class)->findByName($type)->id
        );
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @return string
     */
    public function routeNotificationForSlack()
    {
        return config('services.slack.webhook_url');
    }

    public function routeNotificationForMail()
    {
        return $this->preferredEmail;
    }

    public function getPreferredEmailAttribute()
    {
        return $this->personal_email ?: $this->email;
    }

    public function getIsProcuradorAttribute()
    {
        return strtolower($this->userType->nome) == 'procurador';
    }

    public function getIsAdministratorAttribute()
    {
        return strtolower($this->userType->nome) == 'administrador';
    }

    public function getModelAttribute()
    {
        return get_class($this);
    }
}
