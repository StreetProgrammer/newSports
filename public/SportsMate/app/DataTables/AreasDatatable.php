<?php

namespace App\DataTables;

use App\Model\Area;
use Yajra\DataTables\Services\DataTable;
use DB;

class AreasDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.Areas.btns.checkbox')
            ->addColumn('edit', 'admin.Areas.btns.edit')
            ->addColumn('delete', 'admin.Areas.btns.delete')
            ->addColumn('flag', 'admin.Areas.btns.flag')
            ->rawColumns([
                'checkbox',
                'edit',
                'delete',
                'flag'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\country $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(Area $model)
    {
        return DB::table('areas')
            ->leftJoin('governorates AS governorate', 'areas.a_governorate_id', '=', 'governorate.id')
            //->leftJoin('users AS Candidate', 'events.E_candidate_id', '=', 'Candidate.id')

            
            ->select(['areas.*',  
                        'governorate.g_ar_name as ar_governorate',
                        'governorate.g_en_name as en_governorate',
                        // 'Day.day_format as Day',

            ])
            ->get();
    }

    /*public function query(Area $model)
    {
        return $model->newQuery()->select('id', 'a_en_name', 'a_ar_name', 'a_governorate_id');
    }*/

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
                                'className' => 'btn btn-flat margin btn-danger delBtn', 
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
                'name'      => 'a_en_name',
                'data'      => 'a_en_name',
                'title'     => trans('admin.country_name_en'),
            ],
            [
                'name'      => 'a_ar_name',
                'data'      => 'a_ar_name',
                'title'     => trans('admin.country_name_ar'),
            ],
            [
                'name'      => (direction() == 'rtl') ? 'ar_governorate' : 'en_governorate' ,
                'data'      => (direction() == 'rtl') ? 'ar_governorate' : 'en_governorate' ,
                'title'     => trans('admin.CityName'),
            ],
            [
                'name'          => 'edit',
                'data'          => 'edit',
                'title'         => trans('admin.C_edit'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
            ],
            [
                'name'          => 'delete',
                'data'          => 'delete',
                'title'         => trans('admin.C_delete'),
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
        return 'ares_' . date('YmdHis');
    }
}
