<?php

namespace App\Http\Livewire\Audit;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Audit;

class Lcalendar extends Component
{
    public $currentMonth;
    public $currentYear;
    public $daysInMonth;
    public $events = [];
    public $audit;
    public $audit_id;

    public function mount($audit)
    {
        $this->audit_id = $audit->a_id;
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;
        $this->loadEvents();
    }

    public function loadEvents()
    {
        // dd($this->audit_id);
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->startOfMonth();
        $endOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->endOfMonth();

        $audit = Audit::with(['auditEngagementPlans' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->where(function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('aep_start', [$startOfMonth, $endOfMonth])
                      ->orWhereBetween('aep_end', [$startOfMonth, $endOfMonth])
                      ->orWhere(function ($q) use ($startOfMonth, $endOfMonth) {
                          $q->where('aep_start', '<=', $startOfMonth)
                            ->where('aep_end', '>=', $endOfMonth);
                      });
            });
        }])->findOrFail($this->audit_id);

        $this->events = $audit->auditEngagementPlans->map(function ($event) {
            return [
                'title' => $event->aep_activity,
                'start' => $event->aep_start,
                'end' => $event->aep_end,
            ];
        })->toArray();
    }

    public function nextMonth()
    {
        $this->currentMonth++;
        if ($this->currentMonth > 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        }
        $this->loadEvents();
    }

    public function previousMonth()
    {
        $this->currentMonth--;
        if ($this->currentMonth < 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        }
        $this->loadEvents();
    }

    public function render()
    {
        $this->daysInMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->daysInMonth;

        return view('livewire.audit.lcalendar', [
            'days' => $this->daysInMonth,
            'monthName' => Carbon::create($this->currentYear, $this->currentMonth, 1)->format('F'),
        ]);
    }
}
