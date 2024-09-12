<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technician extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'technicians';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'technician_type_id',
        'identity_num',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function technicianCovenants()
    {
        return $this->hasMany(Covenant::class, 'technician_id', 'id');
    }

    public function technicianAppointments()
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function technician_type()
    {
        return $this->belongsTo(TechnicianType::class, 'technician_type_id');
    }
}
