<?php

namespace App\Observers;

use App\Events\ModelCRUD;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CityObserver
{

    public function created(City $user)
    {
        //
    }


    public function updated(City $user)
    {
        //event(new ModelCRUD(get_class($this), __FUNCTION__, Auth::user()->UserFullName(), $record->id, Auth::user()->getUserIp()));
        event(new ModelCRUD(get_class($this), __FUNCTION__, $user->id , Auth::user()->getUserIp()));
    }

    
    public function deleting(City $user)
    {
        event(new ModelCRUD(get_class($this), __FUNCTION__, $user->id , Auth::user()->getUserIp()));
    }
}