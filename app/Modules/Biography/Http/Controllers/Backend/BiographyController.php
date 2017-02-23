<?php

namespace App\Modules\Biography\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Library\Uploader;
use App\Modules\Biography\Models\Biography;
use App\Modules\Biography\Repositories\BiographyRepository as Repo;
use Caffeinated\Themes\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Image;

class BiographyController extends Controller
{
    private $repo;
    private $view = 'biography.';
    private $redirectViewName = 'backend.';
    private $redirectRouteName = '';

    public function __construct(Repo $repo)
    {
        $this->middleware(function ($request, $next) {

            $this->permisson_check();

            return $next($request);
        });

        $this->repo= $repo;
    }

    public function getViewName($methodName)
    {
        return $this->redirectViewName . $this->view . $methodName;
    }


    public function index()
    {
        $records = $this->repo->orderBy('updated_at', 'desc')->findAll();
        return Theme::view('biography::' . $this->getViewName(__FUNCTION__), compact(['records']));
    }


    public function create()
    {
        $record = $this->repo->createModel();
        return Theme::view('biography::' . $this->getViewName(__FUNCTION__), compact(['record']));
    }


    public function store(Request $request)
    {
        return $this->save($this->repo->createModel());
    }


    public function show(Biography $record)
    {
        return Theme::view('biography::' . $this->getViewName(__FUNCTION__), compact('record'));
    }


    public function edit(Biography $record)
    {
        return Theme::view('biography::' . $this->getViewName(__FUNCTION__), compact(['record']));
    }


    public function update(Request $request, Biography $record)
    {
        return $this->save($record);
    }


    public function destroy(Biography $record)
    {
        $this->repo->delete($record->id);
        return redirect()->route($this->redirectRouteName . $this->view . 'index');
    }


    public function save($record)
    {
        $input = Input::all();

        $input['is_cuff'] = Input::get('is_cuff') == "on" ? true : false;
        $input['is_active'] = Input::get('is_active') == "on" ? true : false;
        $input['user_id'] = Auth::user()->id;

        $v = Biography::validate($input);

        if ($v->fails()) {
            return Redirect::back()
                ->withErrors($v)
                ->withInput($input);
        } else {

            if (isset($record->id)) {
                $result = $this->repo->update($record->id, $input);
            } else {
                $result = $this->repo->create($input);
            }
            if ($result[0]) {

                if(!empty($input['photo'])) {
                    $oldPath = $record->photo;
                    $document_name = $input['photo']->getClientOriginalName();
                    $destination = '/images/biographies/'. $result[1]->id .'/thumbnail';
                    Uploader::fileUpload($result[1], 'photo', $input['photo'] , $destination , $document_name);
                    Uploader::removeFile($oldPath);

                    Image::make(public_path('images/biographies/' . $result[1]->id .'/thumbnail/'. $result[1]->photo))
                        ->fit(104, 78)
                        ->save(public_path('images/biographies/' . $result[1]->id . '/104x78_' . $document_name));

                }

                Session::flash('flash_message', trans('common.message_model_updated'));
                return Redirect::route($this->redirectRouteName . $this->view . 'index', $record);
            } else {
                return Redirect::back()
                    ->withErrors(trans('common.save_failed'))
                    ->withInput($input);
            }
        }
    }
}
