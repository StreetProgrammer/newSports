<?php
namespace App\Model\Filters ;


use App\Model\QueryFilter;
use Carbon\Carbon;
/**
 * 
 */
class EventFilters extends QueryFilter
{

	public $creatorType ; // == 1 => Auth is the creator || == 2 => Auth is not the creator  
	public $name ; public $creator ;
	public $candidate ;
    
    /*
    *make sure creator not Auth
    */
	public function other($other)
	{
		return $this->builder->where('E_creator_id', '!=', $other) ;
	}
	
    
    /*
    * get events where sport = $sport
    */
    public function sport($sport)
	{
		return $this->builder->where('E_sport_id', '=', $sport) ;
    }
	
	/*
    * get events where date = $date
    */
    public function date($date)
	{
		return $this->builder->where('E_date', '=', $date) ;
	}

	/*
    * get events where from = $from
    */
    public function from($from)
	{
		return $this->builder->where('E_from', '=', $from) ;
	}

	/*
    * get events where to = $to
    */
    public function to($to)
	{
		return $this->builder->where('E_to', '=', $to) ;
	}

	/*
    * get events where still in the future 
    */
    public function future()
	{
		return $this->builder->where('E_JQueryFrom', '<', Carbon::now()) ;
	}

	/*
    * get events where creator $creator
    */
	public function creator($creator)
	{
		$this->creator = $creator ;
		return $this->builder->whereHas('creator', function ($lquery) {
		    $lquery->where('name', 'LIKE', '%'.$this->creator.'%') ;
		}) ;
		
	}

	/*
    * get events where candidate name == $candidate 
    */
	public function candidate($candidate)
	{
		$this->creatorType = $this->request->creator ;
		$this->candidate = $candidate ;

		switch ($this->creatorType) {
			case 1:
				return $this->builder->whereHas('candidate', function ($lquery) {
					$lquery->where('name', 'LIKE', '%'.$this->candidate.'%') ;
				}) ;
				break;
			case 2:
				return $this->builder->whereHas('creator', function ($lquery) {
					$lquery->where('name', 'LIKE', '%'.$this->candidate.'%') ;
				}) ;
				break;
			
			default:
				# code...
				break;
		}
		/* if (condition) {
			return $this->builder->whereHas('candidate', function ($lquery) {
				$lquery->where('name', 'LIKE', '%'.$this->candidate.'%') ;
			}) ;
		} else {
			return $this->builder->whereHas('creator', function ($lquery) {
				$lquery->where('name', 'LIKE', '%'.$this->candidate.'%') ;
			}) ;
		} */
		
		
	}

	/*
    * get events where sport = $sport
    */
    public function winner($winner)
	{
		return $this->builder->where('E_winer_id', '=', $winner) ;
	}
}
