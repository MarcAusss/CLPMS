<?php

namespace App\DataTables;

use App\Models\Audit;
use App\Models\ChildLaborer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class AuditsDataTable extends DataTable
{
    
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('full_name', function (ChildLaborer $cl) {
                return $cl->last_name . ', ' . $cl->first_name . ' ' . $cl->middle_name;
            })
            ->addColumn('birth_date', function (ChildLaborer $cl) {
                return Carbon::parse($cl->date_of_birth)->toFormattedDateString();
            })
            ->addColumn('province', function (ChildLaborer $cl) {
                return $cl->barangay->province->name;
            })
            ->addColumn('action', function (ChildLaborer $cl) {
                return view('pages.apps.audit-management.audits.columns._actions', compact('cl'));
            })
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(last_name, ', ', first_name, ' ', middle_name) like ?", ["%{$keyword}%"]);
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChildLaborer $model): QueryBuilder
    {
        $query = $model->newQuery();

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('child-laborers-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->dom('Bfrtip')
            ->orderBy(0)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::computed('full_name')->title('Full Name')->addClass('text-start')->searchable(),
            Column::make('sex')->title('Sex')->addClass('text-center'),
            Column::computed('birth_date')->title('Date of Birth')->addClass('text-center'),
            Column::computed('province')->title('Province')->addClass('text-start'),
            Column::make('age')->title('Age')->addClass('text-center'),
            Column::computed('action')->title('Actions')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Profiled_CL' . date('YmdHis');
    }
}
