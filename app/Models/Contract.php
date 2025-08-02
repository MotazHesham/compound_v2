<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Contract extends Model implements HasMedia
{
    use SoftDeletes, Auditable, HasFactory, InteractsWithMedia  ;

    public $table = 'contracts';

    
    public const STATUS_SELECT = [
        'active'     => 'تنشيط',
        'canceled' => 'الغاء',
        'tmp_stop' => 'ايقاف مؤقت',
    ];

    protected $appends = [
        'contract_file',
    ];

    protected $dates = [
        'start_date',
        'end_date', 
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'start_date',
        'end_date',
        'chosen_day',
        'time',
        'num_of_visits',
        'services',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function contractAppointments()
    {
        return $this->hasMany(Appointment::class, 'contract_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    } 

    public function getContractFileAttribute()
    {
        $file = $this->getMedia('contract_file')->last();  
        return $file;
    }
}
