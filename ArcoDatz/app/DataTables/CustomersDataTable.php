<?php

namespace App\DataTables;

use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {   
        $customers = Customer::with('pets');
        return datatables()
            ->eloquent($customers)
            ->addColumn('action', function($row) {
                    return "<a href=". route('customer.edit', $row->id). " class=\"btn btn-warning\">Edit</a>
                    <a href=". route('customer.show', $row->id). " class=\"btn btn-info\">Show</a> 
                    <form action=". route('customer.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            ->addColumn('pets', function (Customer $customers) {
                    return $customers->pets->map(function($pet) {
                    // return str_limit($customer->customer_name, 30, '...');
                        return "<li>".$pet->pet_name. "</li>";
                    })->implode('<br>');
                })
            ->addColumn('img_path', function(Customer $customers){
             $url = url("storage/images/customers/".$customers->img_path);        
             return '<img src="'. $url .'" width="100" height="120"/>';})
            ->rawColumns(['pets','img_path','action']);
            // ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CustomersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
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
    //                 ->setTableId('customersdatatable-table')
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
                    ->setTableId('customers-table')
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
        return 'Customers_' . date('YmdHis');
    }
}
