<?php


namespace App\DataTables;

use App\Model\clubBranche;
use Yajra\DataTables\Services\DataTable;

use DB ;

class BranchesDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.Branches.btns.checkbox')
            ->addColumn('view', 'admin.Branches.btns.view')
            ->addColumn('delete', 'admin.Branches.btns.delete')
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
        return DB::table('club_branches')
        ->leftJoin('users AS Club', 'club_branches.c_b_user_id', '=', 'Club.id')
        ->leftJoin('governorates AS governorates', 'club_branches.c_b_city', '=', 'governorates.id')
        ->leftJoin('areas AS areas', 'club_branches.c_b_area', '=', 'areas.id')
        ->leftJoin('playgrounds', 'club_branches.id', '=', 'playgrounds.c_branch_id')

        ->select(['club_branches.*',
                    'Club.name as Club',
                    'governorates.g_en_name as enGovernorates',
                    'governorates.g_ar_name as arGovernorates',
                    'areas.a_en_name as enAreas',
                    'areas.a_ar_name as arAreas',
                    //DB::raw("count(playgrounds.c_branch_id) as Playgrounds"),

        ])
        //->groupBy('club_branches.id')
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
                            [
                                'className' => 'btn bg-orange btn-flat margin', 
                                'text' => '<i class="fa fa-plus"></i> Add New', 
                                'action' => "function(){
                                    window.location.href = '" . \URL::current() . "/create'
                                }"
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
                            [
                                'className' => 'btn btn-flat margin btn btn-danger delBtn', 
                                'text' => '<i class="fa fa-trash"></i>'
                            ],
                        ],
                        'initComplete' => 'function () {
                                this.api().columns([2,3,4,5]).every(function () {
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
            [
                'name'          => 'checkbox',
                'data'          => 'checkbox',
                'title'         => '<input type="checkbox" class="checkAll" onclick="check_all()" />',
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
            ],
            [
                'name'  => 'id',
                'data'  => 'id',
                'title' => 'ID',
            ],
            [
                'name'      => 'c_b_name',
                'data'      => 'c_b_name',
                'title'     => trans('admin.Branches_Datatable.Name'),
            ],
            [
                'name'      => 'c_b_phone',
                'data'      => 'c_b_phone',
                'title'     => trans('admin.Branches_Datatable.Phone'),
            ],
            [
                'name'      => 'Club',
                'data'      => 'Club',
                'title'     => trans('admin.Branches_Datatable.Club'),
            ],
            [
                'name'      => 'created_at',
                'data'      => 'created_at',
                'title'     => trans('admin.Branches_Datatable.Created_at'),
            ],
            [
                'name'          => 'view',
                'data'          => 'view',
                'title'         => trans('admin.Branches_Datatable.view'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
            ],
            [
                'name'          => 'delete',
                'data'          => 'delete',
                'title'         => trans('admin.Branches_Datatable.delete'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
            ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Branches_' . date('YmdHis');
    }
}
