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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Appointment extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'appointments';

    protected $appends = [
        'problem_photos',
        'problem_photos_by_tech',
    ];

    public const TIMES_SELECT = [
        '08:00'     => '08:00 am', 
        '08:30'     => '08:30 am', 
        '09:00'     => '09:00 am', 
        '09:30'     => '09:30 am', 
        '10:00'     => '10:00 am', 
        '10:30'     => '10:30 am', 
        '11:00'     => '11:00 am', 
        '11:30'     => '11:30 am', 
        '12:00'     => '12:00 pm', 
        '12:30'     => '12:30 pm', 
        '13:00'     => '01:00 pm', 
        '13:30'     => '01:30 pm', 
        '14:00'     => '02:00 pm', 
        '14:30'     => '02:30 pm', 
        '15:00'     => '03:00 pm', 
        '15:30'     => '03:30 pm', 
        '16:00'     => '04:00 pm', 
        '16:30'     => '04:30 pm', 
        '17:00'     => '05:00 pm', 
        '17:30'     => '05:30 pm', 
        '18:00'     => '06:00 pm', 
        '18:30'     => '06:30 pm', 
        '19:00'     => '07:00 pm', 
        '19:30'     => '07:30 pm', 
        '20:00'     => '08:00 pm', 
        '20:30'     => '08:30 pm', 
        '21:00'     => '09:00 pm', 
    ];
    
    public const STATUS_SELECT = [
        'pending' => 'قيد الانتظار',
        'working' => 'قيد التنفيذ',
        'completed' => 'تم الأنتهاء',
        'canceled' => 'تم الألغاء',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'scheduled' => 'مجدولة',
        'emergency' => 'طارئة',
    ];

    protected $fillable = [
        'type',
        'date',
        'time',
        'status',
        'finish_code',
        'problem_description',
        'problem_description_by_tech',
        'review',
        'rate',
        'cancel_reason',
        'arrived_lat',
        'arrived_lng',
        'contract_id',
        'client_id',
        'malfunction_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($model) {
            $model->update(['finish_code' => random_int(100000, 999999)]); 
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function appointmentAppointmentCovenants()
    {
        return $this->hasMany(AppointmentCovenant::class, 'appointment_id', 'id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getProblemPhotosAttribute()
    {
        $files = $this->getMedia('problem_photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
    public function getProblemPhotosByTechAttribute()
    {
        $files = $this->getMedia('problem_photos_by_tech');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function technicians()
    {
        return $this->belongsToMany(Technician::class);
    }

    public function malfunctionType()
    {
        return $this->belongsTo(MalfunctionType::class, 'malfunction_type_id');
    }
}
