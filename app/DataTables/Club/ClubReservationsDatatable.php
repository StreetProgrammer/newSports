<?php

namespace App\DataTables\Club;

use App\Model\Reservation;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use DB ;

class ClubReservationsDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'club.Reservations.btns.checkbox')
            ->addColumn('view', 'club.Reservations.btns.view')
            //->addColumn('delete', 'club.Reservations.btns.delete')
            ->addColumn('creatorName', 'club.Reservations.btns.creatorName')
            //->addColumn('candidateName', 'club.Reservations.btns.candidateName')
            ->addColumn('playgroundName', 'club.Reservations.btns.playgroundName')
            ->rawColumns([
                'checkbox',
                'view',
                'delete'
            ]); 
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reservation $model)
    {
        if (Auth::user()->type == 2) {
            $club_id = Auth::id() ;
            $type = 00 ;
        } elseif (Auth::user()->type == 3){
            $club_id = Auth::user()->club_id; 
            $type = 3 ; 
        }

        return DB::table('reservations')
            ->leftJoin('users AS Club', 'reservations.R_playground_owner_id', '=', 'Club.id')
            ->leftJoin('playgrounds AS Playground', 'reservations.R_playground_id', '=', 'Playground.id')
            ->leftJoin('users AS Creator', 'reservations.R_creator_id', '=', 'Creator.id')
            ->leftJoin('events AS Event', 'reservations.R_event_id', '=', 'Event.id')
            ->leftJoin('days AS Day', 'reservations.R_day', '=', 'Day.day_id')
            ->leftJoin('hours AS From', 'reservations.R_from', '=', 'From.hour_id')
            ->leftJoin('hours AS To', 'reservations.R_to', '=', 'To.hour_id')
            /*->leftJoin('playgrounds AS Playground', 'reservations.R_playground_id', '=', 'Playground.id')*/
            /*->leftJoin('reservations AS Reservation', 'reservations.R_Reservation', '=', 'Reservation.id')*/
            
            ->select(['reservations.*', 
                        'Club.name as Club', 
                        'Creator.name as Creator', 
                        'Day.day_format as Day',
                        'From.hour_format as From',
                        'To.hour_format as To',
                        'Playground.c_b_p_name as Playground',

            ])
            ->where('reservations.R_playground_owner_id', '=', $club_id)
            ->get();
        //return Event::all();

        //return $model->newQuery()->select('id', 'name', 'email', 'created_at', 'updated_at')->where('type', 1);
    }

    public static function lang()
    {
        $langJson = [
                "sProcessing"           => trans('admin.sProcessing') ,
                "sLengthMenu"           => trans('admin.sLengthMenu')  ,
                "sZeroRecords"          => trans('admin.sZeroRecords') ,
                "sEmptyTable"           => trans('admin.sEmptyTable') ,
                "sInfo"                 => trans('admin.sInfo') ,
                "sInfoEmpty"            => trans('admin.sInfoEmpty') ,
                "sInfoFiltered"         => trans('admin.sInfoFiltered') ,
                "sInfoPostFix"          => trans('admin.sInfoPostFix') ,
                "sSearch"               => trans('admin.sSearch'),
                "sUrl"                  => trans('admin.sUrl') ,
                "sInfoThousands"        => trans('admin.sInfoThousands') ,
                "sLoadingRecords"       => trans('admin.sLoadingRecords') ,
                "oPaginate"             => [
                    "sFirst"        => trans('admin.sFirst') ,
                    "sLast"         => trans('admin.sLast') ,
                    "sNext"         => trans('admin.sNext') ,
                    "sPrevious"     => trans('admin.sPrevious') ,
                ],
                "oAria"                 => [
                "sSortAscending"    => trans('admin.sSortAscending') ,
                "sSortDescending"   => trans('admin.sSortDescending')
                ]
            ];

            return $langJson ;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
       
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom'           => 'Blfrtip',
                        'lengthMenu'    => [[10, 25, 50, -1], [10, 25, 50, 'All Record']],
                        'buttons'       => [
                            /*['className' => 'btn btn-primary', 'text' => '<i class="fa fa-plus"></i> Add New', 'action' => "function(){
                                    window.location.href = '" . \URL::current() . "/create'
                                }"
                            ],*/
                            [   
                                'className' => 'btn bg-orange btn-flat margin delBtn', 
                                'text' => '<i class="fa fa-plus"></i> Add New'
                            ],
                            [   
                                'extend' => 'print', 
                                'className' => 'btn btn-flat margin btn-info', 
                                'text' => '<i class="fa fa-print"></i> ' . trans("admin.ex_print")
                            ],
                            [   
                                'extend' => 'csv', 
                                'className' => 'btn btn-flat margin btn-info', 
                                'text' => '<i class="fa fa-file"></i>  ' . trans("admin.ex_csv")
                            ],
                            [   
                                'extend' => 'excel', 
                                'className' => 'btn btn-flat margin btn-info', 
                                'text' => '<i class="fa fa-file"></i>  ' . trans("admin.ex_excel") 
                            ],
                            [   
                                'extend' => 'reload', 
                                'className' => 'btn btn-flat margin btn-default', 
                                'text' => '<i class="fa fa-refresh"></i>'
                            ],
                            
                        ],
                        'initComplete' => 'function () {
                                this.api().columns([1,2,3,4,5,6,7,8,9,10,11,12]).every(function () {
                                    var column = this;
                                    var input = document.createElement("input");
                                    $(input).appendTo($(column.footer()).empty())
                                    .on("change", function () {
                                        column.search($(this).val(), false, false, true).draw();
                                    });
                                });
                            }',
                            'language' => self::lang()
                    ]);
                   
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
/*            [
                'name'          => 'checkbox',
                'data'          => 'checkbox',
                'title'         => '<input type="checkbox" class="checkAll" onclick="check_all()" />',
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
            ],*/
            [
                'name'  => 'id',
                'data'  => 'id',
                'title' => 'ID',
            ],
            [
                'name'      => 'Creator',
                'data'      => 'Creator',
                'title'     => trans('club.reservationCreator'),
            ],
            /*[
                'name'      => 'Club',
                'data'      => 'Club',
                'title'     => trans('club.branch'),
            ],*/
            [
                'name'      => 'Playground' ,
                'data'      => 'Playground' ,
                'title'     => trans('club.playground'),
            ],
            /*[
                'name'      => 'R_event_id',
                'data'      => 'R_event_id',
                'title'     => trans('club.eventID'),
            ],*/
            [
                'name'      => 'R_date',
                'data'      => 'R_date',
                'title'     => trans('club.eventDate'),
            ],
            [
                'name'      => 'Day',
                'data'      => 'Day',
                'title'     => trans('club.eventDay'),
            ],
            [
                'name'      => 'From',
                'data'      => 'From',
                'title'     => trans('club.eventFrom'),
            ],
            [
                'name'      => 'To',
                'data'      => 'To',
                'title'     => trans('club.eventTo'),
            ],
            [
                'name'      => 'R_price_per_hour',
                'data'      => 'R_price_per_hour',
                'title'     => trans('club.price/Hour'),
            ],
            [
                'name'      => 'R_hour_count',
                'data'      => 'R_hour_count',
                'title'     => trans('club.hourCount'),
            ],
            [
                'name'      => 'R_total_price',
                'data'      => 'R_total_price',
                'title'     => trans('club.totalPrice'),
            ],
            [
                'name'      => 'created_at',
                'data'      => 'created_at',
                'title'     => trans('club.C_created_at'),
            ],
            [
                'name'          => 'view',
                'data'          => 'view',
                'title'         => trans('club.view'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
            ],
            /*[
                'name'          => 'delete',
                'data'          => 'delete',
                'title'         => trans('admin.C_delete'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
            ],
*/
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Reservations_' . date('YmdHis');
    }
}
