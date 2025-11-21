<?php

namespace App\DataTables;

use App\Models\Audit;
use App\Models\ChildLaborer;
use App\Models\PhilippineProvince;
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
                // Handle null middle name
                $middleName = $cl->middle_name ? ' ' . $cl->middle_name : '';
                $suffix = $cl->suffix ? ' ' . $cl->suffix : '';
                return trim($cl->last_name . ', ' . $cl->first_name . $middleName . $suffix);
            })
            ->addColumn('birth_date', function (ChildLaborer $cl) {
                return $cl->date_of_birth 
                    ? Carbon::parse($cl->date_of_birth)->toFormattedDateString() 
                    : 'N/A';
            })
            ->addColumn('province', function (ChildLaborer $cl) {
                // FIX: Use the joined province_name or fetch it
                if (isset($cl->province_name)) {
                    return $cl->province_name;
                }
                
                // Fallback: Fetch province name if not joined
                if ($cl->address_province) {
                    $province = PhilippineProvince::where('province_code', $cl->address_province)->first();
                    return $province ? $province->name : 'N/A';
                }
                
                return 'N/A';
            })
            ->addColumn('status', function (ChildLaborer $cl) {
                // Add status logic if you have a status field
                return 'Active';
            })
            ->addColumn('action', function (ChildLaborer $cl) {
                return view('pages.apps.audit-management.audits.columns._actions', compact('cl'));
            })
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(last_name, ', ', first_name, ' ', COALESCE(middle_name, '')) like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('province', function($query, $keyword) {
                // Search in the joined province name
                $query->whereHas('addressProvince', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChildLaborer $model): QueryBuilder
    {
        // CRITICAL FIX: Add the join here to get province names
        $query = $model->newQuery()
            ->leftJoin('philippine_provinces', 'child_laborers.address_province', '=', 'philippine_provinces.province_code')
            ->leftJoin('philippine_cities', 'child_laborers.address_city', '=', 'philippine_cities.city_code')
            ->select([
                'child_laborers.*',
                'philippine_provinces.name as province_name',
                'philippine_cities.name as city_name'
            ]);

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
            ->drawCallback('function() { KTMenu.createInstances(); }') // For Metronic dropdowns
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
            Column::make('id')->title('ID')->width(60),
            Column::computed('full_name')
                ->title('Full Name')
                ->addClass('text-start')
                ->searchable(true),
            Column::make('sex')
                ->title('Sex')
                ->addClass('text-center')
                ->width(80),
            Column::computed('birth_date')
                ->title('Date of Birth')
                ->addClass('text-center')
                ->width(120),
            Column::computed('province')
                ->title('Province')
                ->addClass('text-start')
                ->searchable(true),
            Column::make('age')
                ->title('Age')
                ->addClass('text-center')
                ->width(60),
            Column::computed('action')
                ->title('Actions')
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false)
                ->width(100),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Profiled_CL_' . date('YmdHis');
    }
}