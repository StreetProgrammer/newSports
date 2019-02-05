<?php

namespace App\Http\Controllers\Club;
use App\Http\Controllers\Controller ;

use Storage ;

use App\Model\Playground;
use App\Model\clubBranche;
use App\Model\Country ;
use App\Model\Governorate ;
use App\Model\Sport;
use App\Model\Photo;

use App\DataTables\Club\ClubPlaygroundsDatatable;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PlaygroundsController extends Controller
{


    public function index(ClubPlaygroundsDatatable $playgrounds)
    {
      $title = direction() == 'ltr' ?  'Courts' : 'الملاعب' ;
      return $playgrounds->render('club.Playgrounds.index', ['title' => $title]);
    }

    public function show($Playground)
    {
      $countries = Country::get();
      $governorate = Governorate::with('areas')->get();
      $sports = Sport::all();
      $Playground = Playground::find($Playground) ;
      $clubBranch = clubBranche::where('id', $Playground->c_branch_id)->firstOrFail();
      
      //return $Playground ;

      return view('club.Playgrounds.Pages.displayEditPlayground', compact('Playground', 'governorate', 'countries', 'sports'));
    }

    public function StoreRegisterClubPlayground(Request $request)
    {
      //return $request->photosArr[0] ;
      /*foreach ($request->photosArr as $key => $PhotoData) {
        return $PhotoData ;
      }*/

      $features = [
              'feature1'    => 0 ,
              'feature2'    => 0 ,
              'feature3'    => 0 ,
              'feature4'    => 0 ,
              'feature5'    => 0 ,
              'feature6'    => 0 ,
              'feature7'    => 0 ,
              'feature8'    => 0 ,
              'feature9'    => 0 ,
              'feature10'   => 0 ,
      ] ;
      foreach ($features as $key => $value) {
        if ( in_array($key, $request->features) ) {
          $features[$key] = 1 ;
        }
      }
      //return $features ;
      
      $slugCode = substr(str_shuffle(str_repeat("0123456789", 5)), 0, 5);
        $slug = str_slug($request->c_b_p_name . '-' . $slugCode, '-');
        $activateCode = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);

        $Branch = clubBranche::find($request->branchId);

        if (Auth::id() == $request->clubId) {
            //////////// IF Registering User type is Club ////////////
             $playground = Playground::create([
                'c_user_id'               => $request->clubId,
                'c_branch_id'             => $request->branchId,
                'c_b_p_name'              => $request->c_b_p_name,
                'c_b_p_phone'             => $request->c_b_p_phone,
                'c_b_p_desc'              => $request->c_b_p_desc,
                'c_b_p_sport_id'          => $request->c_b_p_sport_id,
                'c_b_p_price_per_hour'    => $request->c_b_p_price_per_hour,
                'c_b_p_country'           => $Branch->c_b_country,
                'c_b_p_city'              => $request->c_b_p_city,
                'c_b_p_area'              => $request->c_b_p_area,
                'c_b_p_address'           => $request->c_b_p_address,
                'slug'                    => $slug,
                'is_active'               => 1,
                'our_is_active'           => 0,
                'active_code'             => $activateCode,
                'feature1'                => $features['feature1'],
                'feature2'                => $features['feature2'],
                'feature3'                => $features['feature3'],
                'feature4'                => $features['feature4'],
                'feature5'                => $features['feature5'],
                'feature6'                => $features['feature6'],
                'feature7'                => $features['feature7'],
                'feature8'                => $features['feature8'],
                'feature9'                => $features['feature9'],
                'feature10'               => $features['feature10'],
                ]);

             //for club logo
            if (!empty($request->photosArr)) {
              foreach ($request->photosArr as $key => $photoData) {
                //$user_img = $request->user_img;
                list($type, $photoData) = explode(';', $photoData);
                list(, $photoData)      = explode(',', $photoData);

                $photoData = base64_decode($photoData);
                $photoName = $key. '-' . $playground->id . '-' . $playground->slug . '-' . time() . '.png';

                $playgroundPhotodatabaseRecord = "/playgroundsPhotos/" . $photoName;

                Storage::disk('local')->put('public/' . $playgroundPhotodatabaseRecord, $photoData);

                $photo = Photo::create([
                                'owner_id'        => $playground->id,
                                'owner_type'      => 'playground',
                                'path'            => $playgroundPhotodatabaseRecord,
                                'photo_type'      => 'playgroundGallary',
                ]);

              }//end foreach
                
            }//end if

          }// end if ( Auth::id() == $request->clubId )

    } // end function

    public function UpdateRegisterClubPlayground(Request $request)
    {
      $Playground = Playground::find($request->playgroundId) ;

      $features = [
              'feature1'    => $Playground->feature1 ,
              'feature2'    => $Playground->feature2 ,
              'feature3'    => $Playground->feature3 ,
              'feature4'    => $Playground->feature4 ,
              'feature5'    => $Playground->feature5 ,
              'feature6'    => $Playground->feature6 ,
              'feature7'    => $Playground->feature7 ,
              'feature8'    => $Playground->feature8 ,
              'feature9'    => $Playground->feature9 ,
              'feature10'   => $Playground->feature10 ,
      ] ;
      foreach ($features as $key => $value) {
        if ( in_array($key, $request->features) ) {
          $features[$key] = 1 ;
        }else{
          $features[$key] = 0 ;
        }
      }
      //return $features ;
      
      $slugCode = substr(str_shuffle(str_repeat("0123456789", 5)), 0, 5);
      $slug = str_slug($request->c_b_p_name . '-' . $slugCode, '-');
      $activateCode = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);


            //////////// IF Registering User type is Club ////////////
             $playground = Playground::where('id', $request->playgroundId)
                                      ->update([
                        'c_b_p_name'              => $request->c_b_p_name,
                        'c_b_p_phone'             => $request->c_b_p_phone,
                        'c_b_p_desc'              => $request->c_b_p_desc,
                        'c_b_p_sport_id'          => $request->c_b_p_sport_id,
                        'c_b_p_price_per_hour'    => $request->c_b_p_price_per_hour,
                        'c_b_p_city'              => $request->c_b_p_city,
                        'c_b_p_area'              => $request->c_b_p_area,
                        'c_b_p_address'           => $request->c_b_p_address,
                        'slug'                    => $slug,
                        'feature1'                => $features['feature1'],
                        'feature2'                => $features['feature2'],
                        'feature3'                => $features['feature3'],
                        'feature4'                => $features['feature4'],
                        'feature5'                => $features['feature5'],
                        'feature6'                => $features['feature6'],
                        'feature7'                => $features['feature7'],
                        'feature8'                => $features['feature8'],
                        'feature9'                => $features['feature9'],
                        'feature10'               => $features['feature10'],
                        ]);


    }
    public function DeleteRegisterClubPlayground(Request $request)
    {
        $Playground = Playground::find($request->PlaygroundId) ;
        $DeletedPlaygroundId = $Playground->id ;

        //$Branch = clubBranche::find( $request->BranchId );

        if ( $Playground->Photos->count() > 0 ) {
          // for delete playground Photos from our photo files
          foreach ($Playground->Photos as $photo) {
            Storage::has($photo->path)? Storage::delete($photo->path) :'' ;
          }

            $PlaygroundPhotosRows = Photo::where('owner_id', $DeletedPlaygroundId)
                                            ->where('owner_type', 'playground')
                                            ->delete();
        }

        $Playground->delete();


        if ($Playground) {
              return response()->json(['success'=>'done']);         
        } else {
            return 'failed' ;
        }
    }

    public function addRegisterPlaygroundPhoto(Request $request)
    {
        $playground = Playground::find($request->playgroundId) ;
        $photoData = $request->image ;
        $key = rand(1, 9) ;

        if ($playground->photos->count() > 4) {
          return false  ;

        }else{

          list($type, $photoData) = explode(';', $photoData);
          list(, $photoData)      = explode(',', $photoData);

          $photoData = base64_decode($photoData);
          $photoName = $key. '-' . $playground->id . '-' . $playground->slug . '-' . time() . '.png';

          $playgroundPhotodatabaseRecord = "/playgroundsPhotos/" . $photoName;

          Storage::disk('local')->put('public/' . $playgroundPhotodatabaseRecord, $photoData);

          $photo = Photo::create([
                          'owner_id'        => $request->playgroundId,
                          'owner_type'      => 'playground',
                          'path'            => $playgroundPhotodatabaseRecord,
                          'photo_type'      => 'playgroundGallary',
          ]);
          return $photo->id ;
          
        }
      
    }

    public function DeleteRegisterPlaygroundPhoto(Request $request)
    {
      $photo = Photo::where('id', $request->photoId)
                      ->where('owner_id', $request->PlaygroundId)
                      ->firstOrFail();

      Storage::has($photo->path)? Storage::delete($photo->path) :'' ;

      $photo->delete() ;
    }

    //////////////////////////// start i think it's old, check before delete //////////////////////////////////////////
     public function create()
    {

    	//return  request()->all() ;
      $request = request() ;

      //return $clubBranche ;

      $clubBranche->AddPlayground($request) ;

 		  return back() ;

    }

    public function PlaygroundInfo(Playground $Playground)
    {
          if (Auth::id() == $Playground->c_user_id) {
            $id = $Playground->id ;
          	$Playground = Playground::with('Branch.user.clubProfile')
                                  ->with('sport')
                                  ->with('playgroundEvents')
                                  ->where('id', '=', $id)
                                  ->firstOrFail();

             	//return $Playground ;

             	return view('playground.playgroundForOwner', compact('Playground'));

          }else {
            $id = $Playground->id ;
          	$Playground = Playground::with('Branch.user.clubProfile')
                                  ->with('sport')
                                  ->with('playgroundEvents')
                                  ->where('id', '=', $id)
                                  ->firstOrFail();

             	//return $Playground ;

             	return view('playground.playgroundInfo', compact('Playground'));
          }

    }

    public function PlaygroundEdit(Playground $Playground)
    {
        //return $Playground ;
        return view('playground.playgroundEdit', compact('Playground'));
    }

    //////////////////////////// start i think it's old, check before delete //////////////////////////////////////////




    //%%%%%%%%%%%%%%%%%%% Start ajax functions for load partial views %%%%%%%%%%%%%%%%%%//
    
    /*
    * function to load patrial view for A branch update main info [[ register proccess ]]
    */
    public function DisplayAddPlaygroundRegister($clubBranch, $when = '')
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $sports = Sport::all();
        $clubBranch = clubBranche::where('id', $clubBranch)
                        ->firstOrFail();

        $title = direction() == 'ltr' ? 'Add New Court' : 'أضف ملعب جديد' ;
        if ($when == 'ear') {
          return view('club.Edits.pageParts.addNewPlayground', compact('clubBranch', 'governorate', 'countries', 'sports', 'title')) ;
        } else {
          return view('club.register.pageParts.addNewPlayground', compact('clubBranch', 'governorate', 'countries', 'sports', 'title')) ;
        }
    }

     /*
    * function to load patrial view for A playground update main info [[ register proccess ]]
    */
    public function DisplayEditPlaygroundRegister($Playground, $when = '')
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $sports = Sport::all();
        $Playground = Playground::where('id', $Playground)
                        ->firstOrFail();
        $clubBranch = clubBranche::where('id', $Playground->c_branch_id)
                      ->firstOrFail();
        $title = direction() == 'ltr' ? 'Edit ' . $Playground->c_b_p_name . ' Court' : 'تعديل ' . $Playground->c_b_p_name ;
        if ($when == 'ear') {
          return view('club.Edits.pageParts.editPlayground', compact('Playground', 'governorate', 'countries', 'sports', 'clubBranch', 'title')) ;
        } else {
          return view('club.register.pageParts.editPlayground', compact('Playground', 'governorate', 'countries', 'sports', 'clubBranch', 'title')) ;;
        }
        
    }

    

    //%%%%%%%%%%%%%%%%%%% End ajax functions for load partial views %%%%%%%%%%%%%%%%%%//

}
