<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'date',
            'field'      => 'id',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.appointments.show',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            if($source['model'] == '\App\Models\Appointment'){
                $data = $source['model']::with('client.user')->get();
            }else{
                $data = $source['model']::all();
            }
            foreach ($data as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];
                $crudFieldValue2 = $model->getAttributes()['time'];

                if (! $crudFieldValue) {
                    continue;
                }

                if($source['model'] == '\App\Models\Appointment'){
                    $source['prefix'] = $model->client->user->name ?? '';
                }
                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $source['suffix']),
                    'start' => $crudFieldValue . " " . $crudFieldValue2,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
