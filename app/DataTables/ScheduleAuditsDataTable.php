<?php

namespace App\DataTables;

use App\Models\AuditEngagementPlan;
use App\Models\AuditExecution;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ScheduleAuditsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('office', function (AuditExecution $execution) {
                return $execution->office->office_name; // Adjust based on your relationship
            })
            ->addColumn('activity', function (AuditExecution $execution) {
                return $execution->auditEngagementPlan->aep_section.' - '. $execution->auditEngagementPlan->aep_activity;
            })
            ->addColumn('date_range', function (AuditExecution $execution) {
                return '<span class="badge badge-primary">' . 
                    Carbon::parse($execution->aex_start)->format('F j, Y') . 
                    '</span> to <span class="badge badge-danger">' . 
                    Carbon::parse($execution->aex_end)->format('F j, Y') . '</span>';
            })
            ->addColumn('specifics', function (AuditExecution $execution) {
                // Check if audit_specs is not empty
                if ($execution->audit_specs->isNotEmpty()) {
                    return $execution->audit_specs
                        ->map(fn($specific) => '<span class="badge badge-info">' . $specific->specific_detail . '</span>')
                        ->join('<br>');
                }
                return ''; // Return empty string if audit_specs is empty
            })
            // ->addColumn('action', function (AuditExecution $execution) {
            //     return view('pages.schedule-audits.columns._actions', compact('execution'));
            // })
            ->rawColumns(['date_range', 'specifics','activity', 'office'])
            ->setRowId('id');
    }

    public function query(AuditExecution $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->with(['audit_specs', 'office'])
            ->whereIn('fk_aep', $this->aep_ids);
        return $query;
    }
    

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('schedule-audits-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('aex_id')->title('ID'),
            Column::make('office')->title('Office'),
            Column::make('activity')->title('Audit Activity'),
            Column::computed('date_range')->title('Date Range')->addClass('text-center'),
            Column::computed('specifics')->title('Specific Details')->addClass('text-center'),
            // Column::computed('action')->title('Actions')->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'ScheduleAudits_' . date('YmdHis');
    }
}
