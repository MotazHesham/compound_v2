<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CLIENT_STATUS_SELECT = [
        'active'                => 'نشط',
        'non-active'            => 'غير نشط',
        'temporarily-suspended' => 'موقوف مؤقتا',
    ];

    protected $fillable = [
        'user_id',
        'address',
        'property_type_id',
        'phone_2',
        'client_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }
    
    public function clientContracts()
    {
        return $this->hasMany(Contract::class, 'client_id', 'id');
    }

    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
