<?php

namespace App\Modules\News\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Library\Uploader;
use App\Models\Tag;
use App\Modules\News\Models\Video;
use App\Modules\News\Models\VideoCategory;
use App\Modules\News\Models\VideoGallery;
use App\Modules\News\Repositories\VideoRepository as Repo;
use Caffeinated\Themes\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class VideoController extends BackendController
{
    public function __construct(Repo $repo)
    {
        parent::__construct();

        $this->view = 'video.';
        $this->redirectViewName = 'backend.';
        $this->repo= $repo;
    }


    public function index()
    {
        $records = $this->repo->orderBy('updated_at', 'desc')->findAll();
        return Theme::view('news::' . $this->getViewName(__FUNCTION__),compact(['records']));
    }


    public function create()
    {
        $tagIDs = [];

        $record = $this->repo->createModel();
        $videoCategoryList = VideoCategory::videoCategoryList();
        $videoGalleryList = VideoGallery::videoGalleryList();
        $tagList = Tag::tagList();

        return Theme::view('news::' . $this->getViewName(__FUNCTION__),compact([
            'record',
            'videoCategoryList',
            'videoGalleryList',
            'tagList',
            'tagIDs',
        ]));
    }


    public function store(Request $request)
    {
        return $this->save($this->repo->createModel());
    }


    public function show(Video $record)
    {
        return Theme::view('news::' . $this->getViewName(__FUNCTION__),compact('record'));
    }


    public function edit(Video $record)
    {
        $tagIDs = [];
        $videoCategoryList = VideoCategory::videoCategoryList();
        $videoGalleryList = VideoGallery::videoGalleryList();
        $tagList = Tag::tagList();

        foreach ($record->tags as $index => $tag){
            $tagIDs[$index] = $tag->id;
        }


        return Theme::view('news::' . $this->getViewName(__FUNCTION__),compact([
            'record',
            'videoCategoryList',
            'videoGalleryList',
            'tagList',
            'tagIDs',
        ]));
    }


    public function update(Request $request, Video $record)
    {
        return $this->save($record);
    }


    public function destroy(Video $record)
    {
        $this->repo->delete($record->id);
        return redirect()->route($this->redirectRouteName . $this->view .'index');
    }


    public function save($record)
    {
        $input = Input::all();

        /*todo
         *
         * migrate schema da set null ve cascade parametrelerini demememe rağmen
         * null olarak kayıt yaptırmaya çalıştığmızda hata veriyor.
        */
        if(empty($input['video_category_id']))
            unset($input['video_category_id']);

        if(empty($input['video_gallery_id']))
            unset($input['video_gallery_id']);

        $input['is_active'] = Input::get('is_active') == "on" ? true : false;

        $v = Video::validate($input);


        if ($v->fails()) {
            return Redirect::back()
                ->withErrors($v)
                ->withInput($input);
        } else {

            if (isset($record->id)) {
                list($status, $instance) = $this->repo->update($record->id,$input);
            } else {
                list($status, $instance) = $this->repo->create($input);
            }

            if ($status) {

                //todo video yüklenebilecek.
                //file
                if(!empty($input['thumbnail'])) {
                    $oldPath = $record->thumbnail;
                    $document_name = $input['thumbnail']->getClientOriginalName();
                    $destination = '/videos/'. $instance->id;
                    Uploader::fileUpload($instance , 'thumbnail', $input['thumbnail'] , $destination , $document_name);
                    Uploader::removeFile($destination . '/' . $oldPath);


                    Image::make(public_path('videos/'. $instance->id .'/'. $instance->thumbnail))
                        ->resize(58, 58)
                        ->save(public_path('videos/'. $instance->id .'/58x58_' . $document_name));

                    Image::make(public_path('videos/'. $instance->id .'/'. $instance->thumbnail))
                        ->resize(497, 358)
                        ->save(public_path('videos/'. $instance->id .'/497x358_' . $document_name));

                    Image::make(public_path('videos/'. $instance->id .'/'. $instance->thumbnail))
                        ->resize(658, 404)
                        ->save(public_path('videos/'. $instance->id .'/658x404_' . $document_name));

                    Image::make(public_path('videos/'. $instance->id .'/'. $instance->thumbnail))
                        ->resize(224, 195)
                        ->save(public_path('videos/'. $instance->id .'/224x195_' . $document_name));

                    Image::make(public_path('videos/'. $instance->id .'/'. $instance->thumbnail))
                        ->resize(165, 90)
                        ->save(public_path('videos/'. $instance->id .'/165x90_' . $document_name));

                    Image::make(public_path('videos/'. $instance->id .'/'. $instance->thumbnail))
                        ->resize(457, 250)
                        ->save(public_path('videos/'. $instance->id .'/257x250_' . $document_name));
                }


                $this->tagsVideoStore($instance,$input);

                Session::flash('flash_message', trans('common.message_model_updated'));
                return Redirect::route($this->redirectRouteName . $this->view . 'index', $record);
            } else {
                return Redirect::back()
                    ->withErrors(trans('common.save_failed'))
                    ->withInput($input);
            }
        }
    }


    public function tagsVideoStore(Video $record, $input)
    {
        if(isset($input['tags_ids'])) {
            $record->tags()->sync($input['tags_ids']);
        }
    }

}
