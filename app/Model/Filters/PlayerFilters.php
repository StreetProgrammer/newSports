<?php
namespace App\Model\Filters ;

use App\Model\QueryFilter;
/**
 * 
 */
class PlayerFilters extends QueryFilter
{

	public $country ; public $city ; public $area ; public $phone ; 
	public $sport ; public $p_gender ; public $p_preferred_gender ;

	public function type($type)
	{
		return $this->builder->where('type', '=', $type) ;
	}

	public function name($name)
	{
		return $this->builder->where('name', 'LIKE', '%'.$name.'%') ;
	}

	public function sport($sport)
	{
		$this->sport = $sport ;
		return $this->builder->whereHas('sports', function ($lquery) {
		    $lquery->where('id', '=', $this->sport);
		}) ;
	}

	public function preferred_gender($p_gender)
	{   
		$this->p_preferred_gender = $p_gender ;
		return $this->builder->whereHas('playerProfile', function ($lquery) {
		    $lquery->where('p_preferred_gender', '=', $this->p_preferred_gender);
		}) ;
	}

	public function gender($gender)
	{   
		$this->p_gender = $gender ;
		if ($this->p_gender == 3) {
			return $this->builder->whereHas('playerProfile',function($query){
				$query->whereIn('p_gender', [0, 1, 2]);
			}) ;
		} else {
			return $this->builder->whereHas('playerProfile', function ($lquery) {
				$lquery->where('p_gender', '=', $this->p_gender);
			}) ;
		}
		
		
	}

	public function country($country)
	{   
		$this->country = $country ;
		return $this->builder->whereHas('playerProfile', function ($lquery) {
		    $lquery->where('p_country', '=', $this->country);
		}) ;
	}

	public function city($city)
	{   
		$this->city = $city ;
		return $this->builder->whereHas('playerProfile', function ($lquery) {
		    $lquery->where('p_city', '=', $this->city);
		}) ;
	}

	public function area($area)
	{   
		$this->area = $area ;
		return $this->builder->whereHas('playerProfile', function ($lquery) {
		    $lquery->where('p_area', '=', $this->area);
		}) ;
	}
}
