<?php

namespace App\DataTables\Club;

use App\Model\clubBranche;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use DB ;

class ClubBranchesDatatable extends DataTable
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
            //->addColumn('checkbox', 'club.Branches.btns.checkbox')
            ->addColumn('view', 'club.Branches.btns.view')
            //->addColumn('delete', 'club.Branches.btns.delete')
            ->addColumn('creatorName', 'club.Branches.btns.creatorName')
            ->addColumn('candidateName', 'club.Branches.btns.candidateName')
            ->addColumn('playgroundName', 'club.Branches.btns.playgroundName')
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
    public function query(clubBranche $model)
    {
        if (Auth::user()->type == 2) {
            $club_id = Auth::id() ;
            $type = 00 ;
        } elseif (Auth::user()->type == 3){
            $club_id = Auth::user()->club_id;
            $type = 3 ;
        }

        return DB::table('club_branches')
            ->leftJoin('governorates AS governorates', 'club_branches.c_b_city', '=', 'governorates.id')
            ->leftJoin('areas AS areas', 'club_branches.c_b_area', '=', 'areas.id')
            ->leftJoin('playgrounds', 'club_branches.id', '=', 'playgrounds.c_branch_id')

            ->select(['club_branches.*',
                        'governorates.g_en_name as enGovernorates',
                        'governorates.g_ar_name as arGovernorates',
                        'areas.a_en_name as enAreas',
                        'areas.a_ar_name as arAreas',
                        //DB::raw("count(playgrounds.c_branch_id) as Playgrounds"),

            ])
            ->where('club_branches.c_b_user_id', $club_id)
            //->groupBy('club_branches.id')
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
                            /*[
                                'className' => 'btn btn-flat margin bg-orange',
                                'text' => '<a href="/updateAllData" style="color:#fff;"><i class="fa fa-plus"></i> Add New</a>', 'action' => "function(){
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
                                'className' => 'btn btn-flat margin btn-danger delBtn',
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
                'title' => trans('club.id'),
            ],
            [
                'name'      => 'c_b_name',
                'data'      => 'c_b_name',
                'title'     => trans('club.brancheName'),
            ],
            [
                'name'      => 'c_b_phone',
                'data'      => 'c_b_phone',
                'title'     => trans('club.phone'),
            ],
            [
                'name'      => (session('lang') == 'ar') ? 'arGovernorates' : 'enGovernorates' ,
                'data'      => (session('lang') == 'ar') ? 'arGovernorates' : 'enGovernorates' ,
                'title'     => trans('club.city'),
            ],
            [
                'name'      => (session('lang') == 'ar') ? 'arAreas' : 'enAreas' ,
                'data'      => (session('lang') == 'ar') ? 'arAreas' : 'enAreas' ,
                'title'     => trans('club.area'),
            ],
            /*[
                'name'      => 'Playgrounds',
                'data'      => 'Playgrounds',
                'title'     => trans('club.playgroundscount'),
            ],/*
            [
                'name'      => 'created_at',
                'data'      => 'created_at',
                'title'     => trans('admin.C_created_at'),
            ],
            [
                'name'      => 'C_date',
                'data'      => 'C_date',
                'title'     => trans('admin.eventDate'),
            ],
            [
                'name'      => 'Day',
                'data'      => 'Day',
                'title'     => trans('admin.eventDay'),
            ],
            [
                'name'      => 'From',
                'data'      => 'From',
                'title'     => trans('admin.eventFrom'),
            ],
            [
                'name'      => 'To',
                'data'      => 'To',
                'title'     => trans('admin.eventTo'),
            ],*/
            [
                'name'          => 'view',
                'data'          => 'view',
                'title'         => trans('admin.view'),
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
        return 'Challenges' . date('YmdHis');
    }
}
