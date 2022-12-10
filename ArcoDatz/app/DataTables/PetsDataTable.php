<?php

namespace App\DataTables;

use App\Models\Pet;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PetsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {   
         $pets = Pet::all();
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($row) {
                    return "<a href=". route('pet.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                    <a href=". route('pet.show', $row->id). " class=\"btn btn-info\">Show</a> 
                    <form action=". route('pet.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            // ->addColumn('user', function (pet $pets) {
            //         return $pets->user->map(function($user) {
            //         // return str_limit($pet->pet_name, 30, '...');
            //             return "<li>".$user->name. "</li>";
            //         })->implode('<br>');
            //     })
            ->addColumn('img_path', function(Pet $pets){
             $url = url("storage/images/pets/".$pets->img_path);        
             return '<img src="'. $url .'" width="100" height="120"/>';})
            ->rawColumns(['img_path','action']);
            // ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\petsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pet $model)
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
    //                 ->setTableId('petsdatatable-table')
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
                    ->setTableId('pets-table')
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
            Column::make('name')->title('Name'),
            Column::make('type')->title('Type'),
            Column::make('breed')->title('Breed'),
            
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
        return 'pets_' . date('YmdHis');
    }
}
