<?php

namespace App\Http\Controllers\Club;
use App\Http\Controllers\Controller ;
use Storage ;

use App\Model\User ;
use App\Model\clubBranche ;
use App\Model\Playground ;
use App\Model\Country ;
use App\Model\Governorate ;
use App\Model\Sport ;
use App\Model\Photo ;
use App\DataTables\ClubBranchesDatatable ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubBranchesController extends Controller
{
    /*
    * this function for create branch record in [[ register proccess ]]
    */
    public function StoreRegisterClubBranch(Request $request)
    {

        //return $request ;
        if (Auth::id() == $request->clubId) {

            $newBranch = new clubBranche;

            $newBranch->c_b_user_id   =   $request->clubId;
            $newBranch->c_b_name      =   $request->c_b_name;
            $newBranch->c_b_phone     =   $request->c_b_phone;
            $newBranch->c_b_country   =   Auth::user()->clubProfile->c_country;
            $newBranch->c_b_city      =   $request->c_b_city;
            $newBranch->c_b_area      =   $request->c_b_area;
            $newBranch->c_b_address   =   $request->c_b_address;
            $newBranch->c_b_desc      =   $request->c_b_desc;

            $newBranch->save();
        }

        if ($newBranch) {
              return response()->json(['success'=>'done']);         
        } else {
            return 'failed' ;
        }
    }
    
    /*
    * this function for delete branch record in [[ register proccess ]]
    */
    public function DeleteRegisterClubBranch(Request $request)
    {
        $Branch = clubBranche::find( $request->BranchId );

        if ($Branch->branchPlaygrounds->count() > 0) {

            foreach ($Branch->branchPlaygrounds as $Playground) {
                //////
                if ( $Playground->Photos->count() > 0 ) {
                  // for delete playground Photos from our photo files
                  foreach ($Playground->Photos as $photo) {
                    Storage::has($photo->path)? Storage::delete($photo->path) :'' ;
                  }

                    $PlaygroundPhotosRows = Photo::where('owner_id', $Playground->id)
                                                    ->where('owner_type', 'playground')
                                                    ->delete();
                }
            }
                //////
            $BranchPlaygroundRows = Playground::where('c_branch_id', $request->BranchId)->delete();
        }

        $Branch->delete();


        if ($Branch) {
              return response()->json(['success'=>'done']);         
        } else {
            return 'failed' ;
        }
    }

    /*
    * this function for update branch record in [[ register proccess ]]
    */
    public function updateRegisterClubBranch(Request $request)
    {
        //return $request ;
        $Branch = clubBranche::find( $request->clubBranch );

        if (Auth::user()->id == $Branch->c_b_user_id) {
            clubBranche::where('c_b_user_id', '=', Auth::user()->id)
                        ->where('id', '=', $request->clubBranch)
                        ->update(array(
                            'c_b_name'      => $request->c_b_name,
                            'c_b_phone'     => $request->c_b_phone,
                            'c_b_city'      => $request->c_b_city,
                            'c_b_area'      => $request->c_b_area,
                            'c_b_address'   => $request->c_b_address,
                            'c_b_desc'      => $request->c_b_desc,
                            //'p_date' => $request->p_born_date,
                        ));
            return $request->name ;
        } else {
            return 'failed' ;
        }
    }

    public function index(ClubBranchesDatatable $branches)
    {
       
        return $branches->render('club.Branches.index', ['title' => 'Branches']) ;
    }

    public function create()
    {
        $club = User::where('users.id', '=', Auth::user()->id)
                    ->firstOrFail();
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $title = 'Create New Branche' ;
        return view('club.Branches.Pages.create', compact('title', 'club', 'governorate', 'countries'));
    }

    public function store(Request $request)
    {

        $photoc_b_logodatabaseRecord = $photoc_b_bannerdatabaseRecord = '' ;
    	//return $request ;
    	if (Auth::id() == $request->clubId) {

            $newBranch = new clubBranche;

            $newBranch->c_b_user_id   =   $request->clubId;
            $newBranch->c_b_name      =   $request->c_b_name;
            $newBranch->c_b_phone     =   $request->c_b_phone;
            $newBranch->c_b_country   =   Auth::user()->clubProfile->c_country;
            $newBranch->c_b_city      =   $request->c_b_city;
            $newBranch->c_b_area      =   $request->c_b_area;
            $newBranch->c_b_address   =   $request->c_b_address;
            $newBranch->c_b_desc      =   $request->c_b_desc;

            $newBranch->save();

            //for branch logo
            if (!empty($request->c_b_logo)) {
                $c_b_logo = $request->c_b_logo;


                list($type, $c_b_logo) = explode(';', $c_b_logo);
                list(, $c_b_logo)      = explode(',', $c_b_logo);


                $c_b_logo = base64_decode($c_b_logo);
                $logo = $newBranch->id . '-' . Auth::id() . '-logo-' . Auth::user()->slug . '-' . time() . '.png';

                $photoc_b_logodatabaseRecord = "/branchesPhotos/" . $logo;

                Storage::disk('local')->put('public/' . $photoc_b_logodatabaseRecord, $c_b_logo);

            }
            
            //for branch banner
            if (!empty($request->c_b_banner)) {
                $c_b_banner = $request->c_b_banner;


                list($type, $c_b_banner) = explode(';', $c_b_banner);
                list(, $c_b_banner)      = explode(',', $c_b_banner);


                $c_b_banner = base64_decode($c_b_banner);
                $banner = $newBranch->id . '-' . Auth::id() . '-banner-' . Auth::user()->slug . '-' . time() . '.png';

                $photoc_b_bannerdatabaseRecord = "/branchesPhotos/" . $banner;

                Storage::disk('local')->put('public/' . $photoc_b_bannerdatabaseRecord, $c_b_banner);
            }
        }

        if (Auth::user()->id == $request->clubId) {
            clubBranche::where('id', '=', $newBranch->id)
                        ->update(array(
                            'c_b_logo'   => $photoc_b_logodatabaseRecord,
                            'c_b_banner' => $photoc_b_bannerdatabaseRecord,
                        ));
              return response()->json(['success'=>'done']);         
        } else {
            return 'failed' ;
        }
    }

    //display Branch details
    public function show(clubBranche $clubBranche)
    {
        //return $clubBranche ;
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $lang = session()->get('lang');
        //return $lang ;

        if ($lang == 'ar') {
            $sports = Sport::select(['id','ar_sport_name'])->get();
        } elseif ($lang == 'en') {
            $sports = Sport::select(['id','en_sport_name'])->get();
        }elseif(setting()->main_lang == 'ar' ){
            $sports = Sport::select(['id','ar_sport_name'])->get();
        }elseif(setting()->main_lang == 'en' ){
            $sports = Sport::select(['id','en_sport_name'])->get();
        }

        $clubBranche = clubBranche::with('user.clubProfile')
                        ->with('branchPlaygrounds.sport')
                        ->with('branchPlaygrounds.playgroundEvents')
                        ->where('id', $clubBranche->id)
                        ->firstOrFail();
        //dd($user);
        //return $clubBranche ;

        return view('club.Branches.Pages.BranchDisplayEdit', compact('clubBranche', 'governorate', 'countries', 'sports'));
    
    }

    // update Branch main info (( Except Images ))
    public function update(Request $request)
    {   
        //return $request ;
        if (Auth::user()->id == $request->clubId) {
            clubBranche::where('c_b_user_id', '=', Auth::user()->id)
                        ->where('id', '=', $request->branchId)
                        ->update(array(
                            'c_b_name'      => $request->c_b_name,
                            'c_b_phone'     => $request->c_b_phone,
                            'c_b_city'      => $request->c_b_city,
                            'c_b_area'      => $request->c_b_area,
                            'c_b_address'   => $request->c_b_address,
                            'c_b_desc'      => $request->c_b_desc,
                            //'p_date' => $request->p_born_date,
                        ));
            return $request->name ;
        } else {
            return 'failed' ;
        }

    }

    // update Branch only Images [[ Logo Or Banner ]]
    public function updateLogoImage(Request $request)
    {
        //return $request ;
        $oldImagePath = '';
        $clubBranch = clubBranche::where('id', $request->clubBranchId)
                        ->firstOrFail();

        if (Auth::id() == $request->clubId) {

            if ($request->type == 'logo') {
                $oldImagePath = $clubBranch->c_b_logo ;
            } elseif($request->type == 'banner') {
                $oldImagePath = $clubBranch->c_b_banner ;
            }
            
        }

        $data = $request->image;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name = $clubBranch->id . '-' .  Auth::id() . '-' . $request->type . '-' . time() . '.png';

        $photoDatabaseRecord = "/branchesPhotos/" . $image_name;

        Storage::disk('local')->put('public/' . $photoDatabaseRecord, $data);

        Storage::has($oldImagePath)? Storage::delete($oldImagePath) :'' ;

        if ($request->type == 'logo') {
            clubBranche::where('id', '=', $clubBranch->id)
                        ->update(array(
                            'c_b_logo' => $photoDatabaseRecord,
                        ));
              return response()->json(['success'=>'done','imgUrl'=>Storage::url($photoDatabaseRecord)]);         
        } elseif ($request->type == 'banner') {
            clubBranche::where('id', '=', $clubBranch->id)
                        ->update(array(
                            'c_b_banner' => $photoDatabaseRecord,
                        ));
            return response()->json(['success'=>'done','imgUrl'=>Storage::url($photoDatabaseRecord)]);
        } 
        
    }

    //%%%%%%%%%%%%%%%%%%% Start ajax functions for load partial views %%%%%%%%%%%%%%%%%%//
    
    /*
    * function to load patrial view for A branch update main info [[ register proccess ]]
    */
    public function DisplayEditBranchRegister($clubBranch, $when = '')
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $clubBranch = clubBranche::where('id', $clubBranch)
                        ->firstOrFail();
        // ear => edit after register
        if ($when == 'ear') {
            return view('club.Edits.pageParts.editBranch', compact('clubBranch', 'governorate', 'countries')) ;
        } else {
            return view('club.register.pageParts.editBranch', compact('clubBranch', 'governorate', 'countries')) ;
        }
    }

    /*
    * function to load patrial view after A branch update main info
    */
    public function mainInfoDivLoad($clubBranche)
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $clubBranche = clubBranche::with('user.clubProfile')
                        ->with('branchPlaygrounds.sport')
                        ->with('branchPlaygrounds.playgroundEvents')
                        ->where('id', $clubBranche)
                        ->firstOrFail();

        return view('club.Branches.pageParts.branchdisplay.mainBranchInfo', compact('clubBranche', 'governorate', 'countries')) ;
    }
    
    /*
    * function to load patrial view after A branch update Images [[ Logo Or Branch ]]
    */
    public function imagesinfodivload($clubBranche)
    {
        $clubBranche = clubBranche::with('user.clubProfile')
                        ->with('branchPlaygrounds.sport')
                        ->with('branchPlaygrounds.playgroundEvents')
                        ->where('id', $clubBranche)
                        ->firstOrFail();

        return view('club.Branches.pageParts.branchdisplay.BranchImageDiv', compact('clubBranche')) ;
    }

    //%%%%%%%%%%%%%%%%%%% End ajax functions for load partial views %%%%%%%%%%%%%%%%%%//

}
