<?php
namespace App\Traits;

use Charts ;

use App\Model\Admin;
use App\Model\User;

use App\Model\clubProfile;
use App\Model\playerProfile;

use App\Model\clubBranche;
use App\Model\Playground;

use App\Model\Country;
use App\Model\Governorate;
use App\Model\Area;
use App\Model\Sport;
use App\Model\Reservation;
use App\Model\PendingEdit ;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/**
 *  used to handel generate charts
 */
trait Olddatakepper
{
    public static function prepare($target_model, $target_id, $model, Request $request)
    {
        $oldModelData = [] ;
        foreach ($model->toArray() as $key => $value) {
            if ($request->has($key)) {
                $oldModelData[$key] = $value ;
            }
        }

        $deletedRows = PendingEdit::where('taraget_model_id', $target_id)->first();
        if ($deletedRows) {
            $deletedRows->delete();
        } 

        $PendingEdit = new PendingEdit;

        $PendingEdit->taraget_model_type = $target_model;
        $PendingEdit->taraget_model_id   = $target_id;
        $PendingEdit->user_id            = Auth::id();
        $PendingEdit->old_data           = json_encode($oldModelData);
        $PendingEdit->new_data           = json_encode($oldModelData);

        $PendingEdit->save();
        return $PendingEdit ;
    }

}

