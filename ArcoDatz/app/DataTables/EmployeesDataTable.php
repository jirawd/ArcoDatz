<?php

namespace App\DataTables;

use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {   
         $employees = Employee::all();
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($row) {
                    return "<a href=". route('employee.edit', $row->id). " class=\"btn btn-warning\">Edit</a>
                    <a href=". route('employee.show', $row->id). " class=\"btn btn-info\">Show</a>  

                    <form action=". route('employee.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            // ->addColumn('user', function (Employee $employees) {
            //         return $employees->user->map(function($user) {
            //         // return str_limit($employee->employee_name, 30, '...');
            //             return "<li>".$user->name. "</li>";
            //         })->implode('<br>');
            //     })
            ->addColumn('img_path', function(Employee $employees){
             $url = url("storage/images/employees/".$employees->img_path);        
             return '<img src="'. $url .'" width="100" height="120"/>';})
            ->rawColumns(['user','img_path','action']);
            // ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\employeesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
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
    //                 ->setTableId('employeesdatatable-table')
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
                    ->setTableId('employees-table')
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
            Column::make('title')->title('Title'),
            Column::make('fname')->title('First Name'),
            Column::make('lname')->title('Last Name'),
            Column::make('addressline')->title('Addressline'),
            Column::make('town')->title('Town'),
            Column::make('zipcode')->title('Zipcode'),
            Column::make('phonenumber')->title('Phonenumber'),
            Column::make('img_path')->title('Image'),
            // Column::make('albums')->name('albums.album_name')->title('albums'),
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
        return 'Employees_' . date('YmdHis');
    }
}
