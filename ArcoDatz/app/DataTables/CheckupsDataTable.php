<?php

namespace App\DataTables;

use App\Models\Checkup;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CheckupsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {   
        $Checkups = Checkup::with('pet')->employee;
        return datatables()
            ->eloquent($Checkups)
            ->addColumn('action', function($row) {
                    return "<a href=". route('Checkup.edit', $row->id). " class=\"btn btn-warning\">Edit</a>
                    <a href=". route('Checkup.show', $row->id). " class=\"btn btn-info\">Show</a> 
                    <form action=". route('Checkup.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            ->addColumn('pet', function (Checkup $Checkups) {
                    return $Checkups->pets->map(function($pet) {
                    // return str_limit($Checkup->Checkup_name, 30, '...');
                        return "<li>".$pet->pet_name. "</li>";
                    })->implode('<br>');
                })
            ->addColumn('employee', function (Checkup $Checkups) {
                    return $Checkups->employee->map(function($employee) {
                    // return str_limit($Checkup->Checkup_name, 30, '...');
                        return "<li>".$employee->fname. "</li>";
                    })->implode('<br>');
                })
            ->rawColumns(['pets','employee','action']);
            // ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CheckupsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Checkup $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    // public function html()
    // {
    //     return $this->builder()
    //                 ->setTableId('Checkupsdatatable-table')
    //                 ->columns($this->getColumns())
    //                 ->minifiedAjax()
    //                 ->dom('Bfrtip')
    //                 ->orderBy(1)
    //                 ->buttons(
    //                     Button::make('create'),
    //                     Button::make('export'),
    //                     Button::make('print'),
    //                     Button::make('reset'),
    //                     Button::make('reload')
    //                 );
    // }
    public function html()
    {
        return $this->builder()
                    ->setTableId('Checkups-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                       
                        Button::make('export'),
                        // Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
                    // ->parameters([
                    //     'buttons' => ['excel','pdf','csv'],
                    // ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    // protected function getColumns()
    // {
    //     return [
    //         Column::computed('action')
    //               ->exportable(false)
    //               ->printable(false)
    //               ->width(60)
    //               ->addClass('text-center'),
    //         Column::make('id'),
    //         Column::make('add your columns'),
    //         Column::make('created_at'),
    //         Column::make('updated_at'),
    //     ];
    // }
     protected function getColumns()
    {
        return [
            Column::make('id'),
 
            Column::make('pet')->name('pet.name')->title('Pet Name'),
            Column::make('employee')->name('employee.fname')->title('Employee Name'),
            Column::make('disease')->name('disease')->title('Disease'),
            Column::make('comments')->name('comments')->title('Comments'),
            Column::make('status')->name('status')->title('Status'),
            // Column::make('albums')->title('albums'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
            ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }
    
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Checkups_' . date('YmdHis');
    }
}
