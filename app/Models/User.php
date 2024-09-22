<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'users';

    public const NATIONALITY_SELECT = [   
        "AF" => "Afghan",
        "AL" => "Albanian",
        "DZ" => "Algerian",
        "US" => "American",
        "AD" => "Andorran",
        "AO" => "Angolan",
        "AG" => "Antiguan",
        "AR" => "Argentine",
        "AM" => "Armenian",
        "AU" => "Australian",
        "AT" => "Austrian",
        "AZ" => "Azerbaijani",
        "BS" => "Bahamian",
        "BH" => "Bahraini",
        "BD" => "Bangladeshi",
        "BB" => "Barbadian",
        "BY" => "Belarusian",
        "BE" => "Belgian",
        "BZ" => "Belizean",
        "BJ" => "Beninese",
        "BT" => "Bhutanese",
        "BO" => "Bolivian",
        "BA" => "Bosnian",
        "BW" => "Botswanan",
        "BR" => "Brazilian",
        "GB" => "British",
        "BN" => "Bruneian",
        "BG" => "Bulgarian",
        "BF" => "Burkinabe",
        "MM" => "Burmese",
        "BI" => "Burundian",
        "KH" => "Cambodian",
        "CM" => "Cameroonian",
        "CA" => "Canadian",
        "CV" => "Cape Verdean",
        "CF" => "Central African",
        "TD" => "Chadian",
        "CL" => "Chilean",
        "CN" => "Chinese",
        "CO" => "Colombian",
        "KM" => "Comoran",
        "CG" => "Congolese (Congo-Brazzaville)",
        "CD" => "Congolese (Congo-Kinshasa)",
        "CR" => "Costa Rican",
        "HR" => "Croatian",
        "CU" => "Cuban",
        "CY" => "Cypriot",
        "CZ" => "Czech",
        "DK" => "Danish",
        "DJ" => "Djiboutian",
        "DO" => "Dominican",
        "NL" => "Dutch",
        "TL" => "East Timorese",
        "EC" => "Ecuadorean",
        "EG" => "Egyptian",
        "AE" => "Emirati",
        "GQ" => "Equatorial Guinean",
        "ER" => "Eritrean",
        "EE" => "Estonian",
        "ET" => "Ethiopian",
        "FJ" => "Fijian",
        "FI" => "Finnish",
        "FR" => "French",
        "GA" => "Gabonese",
        "GM" => "Gambian",
        "GE" => "Georgian",
        "DE" => "German",
        "GH" => "Ghanaian",
        "GR" => "Greek",
        "GD" => "Grenadian",
        "GT" => "Guatemalan",
        "GN" => "Guinean",
        "GW" => "Guinea-Bissauan",
        "GY" => "Guyanese",
        "HT" => "Haitian",
        "HN" => "Honduran",
        "HU" => "Hungarian",
        "IS" => "Icelander",
        "IN" => "Indian",
        "ID" => "Indonesian",
        "IR" => "Iranian",
        "IQ" => "Iraqi",
        "IE" => "Irish",
        "IL" => "Israeli",
        "IT" => "Italian",
        "CI" => "Ivorian",
        "JM" => "Jamaican",
        "JP" => "Japanese",
        "JO" => "Jordanian",
        "KZ" => "Kazakh",
        "KE" => "Kenyan",
        "KI" => "Kiribati",
        "KW" => "Kuwaiti",
        "KG" => "Kyrgyz",
        "LA" => "Laotian",
        "LV" => "Latvian",
        "LB" => "Lebanese",
        "LR" => "Liberian",
        "LY" => "Libyan",
        "LI" => "Liechtensteiner",
        "LT" => "Lithuanian",
        "LU" => "Luxembourger",
        "MK" => "Macedonian",
        "MG" => "Malagasy",
        "MW" => "Malawian",
        "MY" => "Malaysian",
        "MV" => "Maldivian",
        "ML" => "Malian",
        "MT" => "Maltese",
        "MH" => "Marshallese",
        "MR" => "Mauritanian",
        "MU" => "Mauritian",
        "MX" => "Mexican",
        "FM" => "Micronesian",
        "MD" => "Moldovan",
        "MC" => "Monacan",
        "MN" => "Mongolian",
        "ME" => "Montenegrin",
        "MA" => "Moroccan",
        "MZ" => "Mozambican",
        "NA" => "Namibian",
        "NR" => "Nauruan",
        "NP" => "Nepalese",
        "NZ" => "New Zealander",
        "NI" => "Nicaraguan",
        "NE" => "Nigerien",
        "NG" => "Nigerian",
        "KP" => "North Korean",
        "NO" => "Norwegian",
        "OM" => "Omani",
        "PK" => "Pakistani",
        "PW" => "Palauan",
        "PS" => "Palestinian",
        "PA" => "Panamanian",
        "PG" => "Papua New Guinean",
        "PY" => "Paraguayan",
        "PE" => "Peruvian",
        "PH" => "Philippine",
        "PL" => "Polish",
        "PT" => "Portuguese",
        "QA" => "Qatari",
        "RO" => "Romanian",
        "RU" => "Russian",
        "RW" => "Rwandan",
        "LC" => "Saint Lucian",
        "SV" => "Salvadoran",
        "WS" => "Samoan",
        "SM" => "San Marinese",
        "ST" => "Sao Tomean",
        "SA" => "Saudi",
        "SN" => "Senegalese",
        "RS" => "Serbian",
        "SC" => "Seychellois",
        "SL" => "Sierra Leonean",
        "SG" => "Singaporean",
        "SK" => "Slovak",
        "SI" => "Slovenian",
        "SB" => "Solomon Islander",
        "SO" => "Somali",
        "ZA" => "South African",
        "KR" => "South Korean",
        "SS" => "South Sudanese",
        "ES" => "Spanish",
        "LK" => "Sri Lankan",
        "SD" => "Sudanese",
        "SR" => "Surinamer",
        "SZ" => "Swazi",
        "SE" => "Swedish",
        "CH" => "Swiss",
        "SY" => "Syrian",
        "TW" => "Taiwanese",
        "TJ" => "Tajik",
        "TZ" => "Tanzanian",
        "TH" => "Thai",
        "TG" => "Togolese",
        "TO" => "Tongan",
        "TT" => "Trinidadian",
        "TN" => "Tunisian",
        "TR" => "Turkish",
        "TM" => "Turkmen",
        "TV" => "Tuvaluan",
        "UG" => "Ugandan",
        "UA" => "Ukrainian",
        "UY" => "Uruguayan",
        "UZ" => "Uzbek",
        "VU" => "Vanuatuan",
        "VE" => "Venezuelan",
        "VN" => "Vietnamese",
        "YE" => "Yemeni",
        "ZM" => "Zambian",
        "ZW" => "Zimbabwean" 
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ]; 

    public const USER_TYPE_SELECT = [
        'staff'      => 'staff',
        'client'     => 'client',
        'technician' => 'technician',
    ];

    public const CONTRACT_BY_SELECT = [
        'ajir'     => 'نظام اجير',
        'external' => 'عقد تعاون خارجي',
    ];

    protected $appends = [
        'photo',
        'commerical_image',
        'contract_image',
        'commissioner_id_image',
        'commissioner_image',
    ];

    public const CONTRACT_TYPE_SELECT = [
        'on_bail'       => 'علي الكفالة',
        'subcontractor' => 'متعاقد من الباطن',
    ];

    protected $dates = [
        'email_verified_at',
        'contract_start',
        'contract_end',
        'commissioner_id_start',
        'commissioner_id_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'remember_token',
        'user_type',
        'identity_num',
        'nationality',
        'contract_type',
        'job_num',
        'company_name',
        'company_field',
        'commerical_num',
        'manager_name',
        'manager_phone',
        'manager_email',
        'company_address',
        'company_website',
        'contract_by',
        'contract_start',
        'contract_end',
        'commissioner_name',
        'commissioner_nationality',
        'commissioner_id_number',
        'commissioner_id_start',
        'commissioner_id_end',
        'commissioner_job',
        'commissioner_phone',
        'commissioner_email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getCommericalImageAttribute()
    {
        return $this->getMedia('commerical_image')->last();
    }

    public function getContractImageAttribute()
    {
        return $this->getMedia('contract_image')->last();
    }

    public function getContractStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setContractStartAttribute($value)
    {
        $this->attributes['contract_start'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getContractEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setContractEndAttribute($value)
    {
        $this->attributes['contract_end'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCommissionerIdImageAttribute()
    {
        return $this->getMedia('commissioner_id_image')->last();
    }

    public function getCommissionerIdStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCommissionerIdStartAttribute($value)
    {
        $this->attributes['commissioner_id_start'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCommissionerIdEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCommissionerIdEndAttribute($value)
    {
        $this->attributes['commissioner_id_end'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCommissionerImageAttribute()
    {
        return $this->getMedia('commissioner_image')->last();
    }
}