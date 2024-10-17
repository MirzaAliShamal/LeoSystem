<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogTag;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Tag;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class EventController extends Controller
{
    use General, ImageSaveTrait;

    protected $model;
    public function __construct(Event $event)
    {
        $this->model = new Crud($event);
    }

    public function index()
    {
        if (!Auth::user()->can('manage_blog')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'Manage Events';
        $data['events'] = $this->model->getOrderById('DESC', 25);
        return view('admin.event.index', $data);
    }

    public function create()
    {
        if (!Auth::user()->can('manage_event')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'Create Event';
        $data['eventCategories'] = EventCategory::all();
        $data['countries'] = Country::all();
        $data['states'] = State::all();
        $data['cities'] = City::all();
        $data['tags'] = Tag::all();
        return view('admin.event.create', $data);
    }

    public function store(EventRequest $request)
    {
        if (!Auth::user()->can('manage_event')) {
            abort('403');
        } // end permission checking

        if (Event::where('slug', $request->slug)->count() > 0)
        {
            $slug = getSlug($request->slug) . '-'. rand(100000, 999999);
        } else {
            $slug = getSlug($request->slug);
        }

        $logo_image = $request->logo_image ? $this->uploadFileWithDetails('event', $request->logo_image) :   null;
        $main_image = $request->main_image ? $this->uploadFileWithDetails('event', $request->main_image) :   null;
        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'event_category' => $request->event_category,
            'event_status' => $request->event_status,
            'ticket_type' => $request->ticket_type,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'event_duration' => $request->event_duration,
            'min_members' => $request->min_members,
            'max_members' => $request->max_members,
            'event_organizer' => $request->event_organizer,
            'event_language' => $request->event_language,
            'num_lead_teachers' => $request->num_lead_teachers,
            'name_lead_teachers' => $request->name_lead_teachers,
            'event_sponsors' => $request->event_sponsors,
            'buffet_reception' => $request->buffet_reception,
            'event_entertainment' => $request->event_entertainment,
            'event_prizes' => $request->event_prizes,
            'event_materials' => $request->event_materials,
            'event_books' => $request->event_books,
            'event_quizzes' => $request->event_quizzes,
            'event_testing' => $request->event_testing,
            'event_party' => $request->event_party,
            'event_transfer' => $request->event_transfer,
            'event_certificate' => $request->event_certificate,
            'standard_ticket_price' => $request->standard_ticket_price,
            'standard_ticket_price_discount' => $request->standard_ticket_price_discount,
            'advanced_ticket_price' => $request->advanced_ticket_price,
            'pro_ticket_price' => $request->pro_ticket_price,
            'vip_ticket_price' => $request->vip_ticket_price,
            'logo_image' => $logo_image['path'],
            'main_image' => $main_image['path'],
            
        ];

        $event = $this->model->create($data); // create new event
        
        return $this->controlRedirection($request, 'event', 'Event');
    }

    public function edit($uuid)
    {
        if (!Auth::user()->can('manage_event')) {
            abort('403');
        } // end permission checking

        $data['title'] = 'Edit Event';
        $data['event'] = $this->model->getRecordByUuid($uuid);
        $data['eventCategories'] = EventCategory::all();
        $data['countries'] = Country::all();
        $data['states'] = State::all();
        $data['cities'] = City::all();
        return view('admin.event.edit', $data);
    }

    public function update(EventRequest $request, $uuid)
    {
        if (!Auth::user()->can('manage_event')) {
            abort('403');
        } // end permission checking

        $event = $this->model->getRecordByUuid($uuid);

        if ($request->logo_image)
        {
            $this->deleteFile($event->logo_image); // delete file from server

            $logo_image = $this->uploadFileWithDetails('event', $request->logo_image);
            $logo_image = $logo_image['path'];

        } else {
            $logo_image = $event->logo_image;
        }
        if ($request->main_image)
        {
            $this->deleteFile($event->main_image); // delete file from server

            $main_image = $this->uploadFileWithDetails('event', $request->main_image);
            $main_image = $main_image['path'];

        } else {
            $main_image = $event->logo_image;
        }

        if (Event::where('slug', $request->slug)->where('uuid', '!=', $uuid)->count() > 0)
        {
            $slug = getSlug($request->slug) . '-'. rand(100000, 999999);
        } else {
            $slug = getSlug($request->slug);
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'event_category' => $request->event_category,
            'event_status' => $request->event_status,
            'ticket_type' => $request->ticket_type,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'event_duration' => $request->event_duration,
            'min_members' => $request->min_members,
            'max_members' => $request->max_members,
            'event_organizer' => $request->event_organizer,
            'event_language' => $request->event_language,
            'num_lead_teachers' => $request->num_lead_teachers,
            'name_lead_teachers' => $request->name_lead_teachers,
            'event_sponsors' => $request->event_sponsors,
            'buffet_reception' => $request->buffet_reception,
            'event_entertainment' => $request->event_entertainment,
            'event_prizes' => $request->event_prizes,
            'event_materials' => $request->event_materials,
            'event_books' => $request->event_books,
            'event_quizzes' => $request->event_quizzes,
            'event_testing' => $request->event_testing,
            'event_party' => $request->event_party,
            'event_transfer' => $request->event_transfer,
            'event_certificate' => $request->event_certificate,
            'standard_ticket_price' => $request->standard_ticket_price,
            'standard_ticket_price_discount' => $request->standard_ticket_price_discount,
            'advanced_ticket_price' => $request->advanced_ticket_price,
            'pro_ticket_price' => $request->pro_ticket_price,
            'vip_ticket_price' => $request->vip_ticket_price,
            'logo_image' => $logo_image,
            'main_image' => $main_image,
            
        ];

        $event = $this->model->updateByUuid($data, $uuid); // update event

        return $this->controlRedirection($request, 'event', 'Event');
    }

    public function delete($uuid)
    {
        if (!Auth::user()->can('manage_event')) {
            abort('403');
        } // end permission checking

        $event = $this->model->getRecordByUuid($uuid);
        $this->deleteFile($event->logo_image); // delete file from server
        $this->deleteFile($event->main_image); // delete file from server
        $this->model->deleteByUuid($uuid); // delete record

        $this->showToastrMessage('error', __('Event has been deleted'));
        return redirect()->back();
    }
}
