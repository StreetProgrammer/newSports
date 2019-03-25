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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
/**
 *  used to handel generate charts
 */
trait ChartsGenrator
{

    // function to prepare chart to create 
    public static function prepareChart($userKind = 'club', $where = 'home', $chartfor, $id)
    {
        if ($userKind == 'club') {
            $chart = self::clubUser('home', $chartfor, $id);
        }
        
        return $chart ;
    }


    public static function clubUser($where = 'home', $chartfor, $id)
    {
        if ($where == 'home') {
            $chart = self::clubHome($chartfor, $id);
        }

        return $chart ;
    }

    public static function clubHome($chartfor, $id)
    {
        switch ($chartfor) {
            case 'reservationPercentage':
                $reservations = Reservation::where('R_playground_owner_id', $id)->get();
                $chart = Charts::database($reservations, 'pie', 'highcharts')
                                ->title('Reservation Percentage')
                                ->groupBy('reservedBy')
                                ->labels(['By SPORTSMATE', 'By Your Employees'])
                                ->responsive(false);
                
            break;
            case 'allReservationByYear':
            $reservations = Reservation::where('R_playground_owner_id', $id)->get();
            $chart = Charts::database($reservations, 'bar', 'highcharts')
                            ->title('All Reservations Yearly')
                            ->groupByYear()
                            ->elementLabel('Reservation')
                            ->responsive(false);
            break;
            case 'allReservationByMonth':
            $reservations = Reservation::where('R_playground_owner_id', $id)->get();
            $chart = Charts::database($reservations, 'area', 'highcharts')
                            ->title('All Reservations Monthly')
                            ->lastByMonth(10, true)
                            ->elementLabel('Reservation')
                            ->responsive(false);
            break;
            case 'allReservation':
            //////////////////////////////////////////////////////////////
            $reservations = Reservation::where('R_playground_owner_id', $id)->get();
            $dates = Reservation::where('R_playground_owner_id', $id)->orderBy('created_at', 'ASC')->pluck('created_at');
            $dates = json_decode($dates);
            if (!empty($dates)) {
                $dateArr = array();
                $total = array();
                $your_total = array();
                $mind_total = array();
                foreach ($dates as $unformatted_date) {
                    $date = new \DateTime($unformatted_date->date);
                    $date_y_m = $date->format('Y-m');
                    $date_Y_M = $date->format('Y M');
                    $dateArr[$date_y_m] = $date_Y_M ;
                    
                }
                foreach ($dateArr as $key => $date) {
                    $total[$key] = Reservation::where('R_playground_owner_id', $id)->where('created_at', 'LIKE', '%' . $key .'%')->sum('R_total_price');
                    $your_total[$key] = ($total[$key] / 100) * 80 ;
                    $mind_total[$key] = ($total[$key] / 100) * 20 ;
                }
            }
            //return $total ;
            //////////////////////////////////////////////////////////////
            $reservations = Reservation::where('R_playground_owner_id', $id)->get();
            $chart = Charts::multi('bar', 'highcharts')
                            ->responsive(false)
                            ->elementLabel('Total Revnue')
                            ->title('Distribution Of Income')
                            ->labels(array_keys($total))
                            ->dataset('Total', $total)
                            ->dataset('Club Total', $your_total)
                            ->dataset('SportsMate Total', $mind_total);
            break;
            
            default:
                # code...
                break;
        }

        return $chart ;
    }


    public function multiChart($shape = 'area', $lib = 'highcharts', $labels, $values)
    {
        $chart = Charts::create('pie', 'highcharts')
                        ->title('Reservation Percentage')
                        ->labels(['By SPORTSMATE', 'By Your Employees'])
                        ->values(['5', '20'])
                        //->dimensions(1000, 500)
                        ->responsive(false);
        return $chart ;
    }
}

