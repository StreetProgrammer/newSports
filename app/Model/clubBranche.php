<?php

namespace App\Model;

use App\Model\Playground;

use Illuminate\Database\Eloquent\Model;


class clubBranche extends Model
{
	protected $fillable = [

        'c_b_user_id', 
        'c_b_name', 
        'c_b_phone', 
        'c_b_country', 
        'c_b_city', 
        'c_b_area', 
        'c_b_address', 
        'c_b_lat',
        'c_b_lng',
        'our_is_active',
        'c_b_banner',
    ];

    /**
     * Get the user of type club that owns the branch.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'c_b_user_id')->withDefault();
    }

     /**
     * Get the playgrounds belongs to the branch of club 
     */
    public function branchPlaygrounds()
    {
        return $this->hasMany(Playground::class,'c_branch_id');
    }  

    public function courtsIds()
    {
        return $this->branchPlaygrounds->pluck('id');
    }


    public function AddPlayground($request)
    {
        Playground::create([

                       'c_user_id'        => $this->c_b_user_id,//Auth::user()->id,
                       'c_branch_id'      => $this->id,
                       'c_b_p_name'       => request('c_b_p_name'),
                       'c_b_phone'        => request('c_b_p_phone'),
                       'c_b_p_address'    => $this->c_b_address,

                        'c_b_p_country'   => $this->c_b_country,
                       'c_b_p_city'       => $this->c_b_city,
                       'c_b_p_area'       => $this->c_b_area,

                       'c_b_p_desc'       => request('c_b_p_desc'),
                       'c_b_p_sport_id'   => request('c_b_p_sport_id'),
                       'slug'             => str_slug(request('c_b_p_name')),
                       'rating'           => 0,
                       'is_active'        => 1 ,
                       'active_code'      => 749012840,
                    ]);

          
    }

    /**
     * Get the country of the branch.
     */
    public function c_b_Country()
    {
        return $this->belongsTo(country::class, 'c_b_country');
    }

    /**
     * Get the city of the branch.
     */
    public function c_b_City()
    {
        return $this->belongsTo(Governorate::class, 'c_b_city');
    }

    /**
     * Get the city of the branch.
     */
    public function c_b_Area()
    {
        return $this->belongsTo(area::class, 'c_b_area');
    }
     		
}
