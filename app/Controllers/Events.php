<?php

namespace App\Controllers;

use App\Models\EventModel;
use CodeIgniter\Controller;

class Events extends Controller
{
    public function index()
    {
        $model = new EventModel();
        $data['events'] = $model->findAll();

        return view('events/index', $data);
    }

    public function create()
    {
        return view('events/create');
    }

    public function store()
    {
        $model = new EventModel();

        $data = [
            'event_name' => $this->request->getPost('event_name'),
            'price'      => $this->request->getPost('price')
        ];

        $model->insert($data);

        return redirect()->to('/events')->with('success', 'Event Added Successfully');
    }
}
