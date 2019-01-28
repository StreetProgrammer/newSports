<?php

namespace App\DataTables\Club;

use App\Model\Playground;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use DB ;

class ClubPlaygroundsDatatable extends DataTable
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
            ->addColumn('checkbox', 'club.Branches.btns.checkbox')
            ->addColumn('view', 'club.Playgrounds.btns.view')
            //->addColumn('delete', 'club.Playgrounds.btns.delete')
            ->addColumn('creatorName', 'club.Playgrounds.btns.creatorName')
            ->addColumn('candidateName', 'club.Playgrounds.btns.candidateName')
            ->addColumn('playgroundName', 'club.Playgrounds.btns.playgroundName')
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
    public function query(Playground $model)
    {
        if (Auth::user()->type == 2) {
            $club_id = Auth::id() ;
            $type = 00 ;
        } elseif (Auth::user()->type == 3){
            $club_id = Auth::user()->club_id; 
            $type = 3 ; 
        }
        return DB::table('playgrounds')
            //->leftJoin('users AS Club', 'playgrounds.c_user_id', '=', 'Club.id')
            ->leftJoin('club_branches AS Branch', 'playgrounds.c_branch_id', '=', 'Branch.id')
            ->leftJoin('countries AS Country', 'playgrounds.c_b_p_country', '=', 'Country.id')
            ->leftJoin('governorates AS City', 'playgrounds.c_b_p_city', '=', 'City.id')
            ->leftJoin('areas AS Area', 'playgrounds.c_b_p_area', '=', 'Area.id')
            ->leftJoin('sports AS Sport', 'playgrounds.c_b_p_sport_id', '=', 'Sport.id')
            ->leftJoin('events', 'playgrounds.id', '=', 'events.E_playground_id')
            ->leftJoin('challenges', 'playgrounds.id', '=', 'challenges.C_playground_id')
            
            ->select(['playgrounds.*', 
                        //'Club.name as Club',
                        'Branch.c_b_name as Branch', 
                        'Country.c_en_name as enCountry',
                        'Country.c_ar_name as arCountry', 
                        'City.g_en_name as enCity',
                        'City.g_ar_name as arCity',
                        'Area.a_en_name as enArea',
                        'Area.a_ar_name as arArea',
                        //DB::raw("count(events.E_playground_id) as Events"),
                        //DB::raw("count(challenges.C_playground_id) as Challenges"),

            ])
            ->where('playgrounds.c_user_id', '=', $club_id)
            //->groupBy('playgrounds.id')
            ->get();
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
                            /*[
                                'className' => 'btn bg-orange btn-flat margin', 
                                'text' => '<i class="fa fa-plus"></i> Add New', 
                                'action' => "function(){
                                    window.location.href = '" . \URL::current() . "/create'
                                }"
                            ],*/
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
                            /*[
                                'className' => 'btn bg-orange btn-flat margin delBtn', 
                                'text' => '<i class="fa fa-trash"></i>'
                            ],*/
                        ],
                        'initComplete' => 'function () {
                                this.api().columns([1,2,3,4,5]).every(function () {
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
            /*[
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
                'name'      => 'c_b_p_name',
                'data'      => 'c_b_p_name',
                'title'     => 'Name' //trans('admin.C_name'),
            ],
            [
                'name'      => 'c_b_p_phone',
                'data'      => 'c_b_p_phone',
                'title'     => 'Phone' //trans('admin.C_email'),
            ],
            [
                'name'      => 'Branch',
                'data'      => 'Branch',
                'title'     => 'Branch ' //trans('admin.C_created_at'),
            ],
            /*[
                'name'      => 'Events',
                'data'      => 'Events',
                'title'     => 'Events ' //trans('admin.C_created_at'),
            ],
            [
                'name'      => 'Challenges',
                'data'      => 'Challenges',
                'title'     => 'Challenges ' //trans('admin.C_created_at'),
            ],
            [
                'name'      => 'Challenges',
                'data'      => 'Challenges',
                'title'     => 'Challenges ' //trans('admin.C_created_at'),
            ],*/
            [
                'name'      => 'created_at',
                'data'      => 'created_at',
                'title'     => 'Created at' //trans('admin.C_created_at'),
            ],
            [
                'name'          => 'view',
                'data'          => 'view',
                'title'         => trans('admin.C_view'),
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
            ],*/

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Playgrounds' . date('YmdHis');
    }
}
