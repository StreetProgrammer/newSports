<?php

namespace App\DataTables\Club;

use App\Model\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use DB ;

class ClubUsersDatatable extends DataTable
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
            ->addColumn('checkbox', 'club.Persons.btns.checkbox')
            ->addColumn('edit', 'club.Persons.btns.edit')
            ->addColumn('delete', 'club.Persons.btns.delete')
            ->addColumn('type', 'club.Persons.btns.type')
            ->addColumn('activity', 'club.Persons.btns.activity')
            //->addColumn('playgroundName', 'club.Persons.btns.playgroundName')*/
            ->rawColumns([
                'checkbox',
                'edit',
                'delete',
                'type',
                'activity'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        if (Auth::user()->type == 2) {
            $club_id = Auth::id() ;
            $type = 00 ;
        } elseif (Auth::user()->type == 3){
            $club_id = Auth::user()->club_id;
            $type = 3 ;
        }

        return DB::table('users')
            ->select(['users.*', 'users.id'])
            ->where('users.club_id', '=', $club_id)
            ->where('users.type', '!=', $type)
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
                                    window.location.href = 'create'
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
                                'className' => 'btn bg-orange btn-flat margin delBtn',
                                'text' => '<i class="fa fa-trash"></i>'
                            ],
                        ],
                        'initComplete' => 'function () {
                                this.api().columns([]).every(function () {
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
                'title' => (direction() == 'rtl') ? 'رقم' : 'ID' , // trans("club.id"),
            ],
            [
                'name'      => 'name',
                'data'      => 'name',
                'title'     => (direction() == 'rtl') ? 'الإسم' : 'Name' , // trans("club.name"), 
            ],
            [
                'name'      => 'email',
                'data'      => 'email',
                'title'     => (direction() == 'rtl') ? 'البريد الإليكتروني' : 'Email' , // trans("club.email"),
            ],
            [
                'name'          => 'type',
                'data'          => 'type',
                'title'         => (direction() == 'rtl') ? 'وظيفه' : 'Position' , // trans('club.position'),
            ],
            [
                'name'      => 'activity',
                'data'      => 'activity',
                'title'     => (direction() == 'rtl') ? 'وظيفه' : 'Activity' , // trans('club.activity'),
            ],
            [
                'name'      => 'created_at',
                'data'      => 'created_at',
                'title'     => (direction() == 'rtl') ? 'أنشئ في' : 'Created At' , // trans('club.createdAt'), 
            ],
            [
                'name'          => 'edit',
                'data'          => 'edit',
                'title'         => (direction() == 'rtl') ? 'تعديل' : 'Edit' , // trans('club.edit'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
            ],
            [
                'name'          => 'delete',
                'data'          => 'delete',
                'title'         => (direction() == 'rtl') ? 'مسح' : 'Delete' , // trans('club.delete'),
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
        return 'ClubUsers-' . date('YmdHis');
    }
}
