<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button wire:click="previousMonth" class="btn btn-primary">Previous</button>
        <h2 class="text-center">{{ $monthName }} {{ $currentYear }}</h2>
        <button wire:click="nextMonth" class="btn btn-primary">Next</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" style="table-layout: fixed;">
            <thead class="table-dark">
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $dayOfWeek = \Carbon\Carbon::create($currentYear, $currentMonth, 1)->dayOfWeek;
                    $daysPrinted = 0;
                @endphp
                <tr>
                    @for ($i = 0; $i < $dayOfWeek; $i++)
                        <td></td>
                        @php $daysPrinted++; @endphp
                    @endfor

                    @for ($day = 1; $day <= $days; $day++)
                        <td class="position-relative">
                            <div><strong>{{ $day }}</strong></div>

                            {{-- Display all events overlapping with this day --}}
                            @foreach ($events as $event)
                                @php
                                    $eventStart = \Carbon\Carbon::parse($event['start']);
                                    $eventEnd = \Carbon\Carbon::parse($event['end']);
                                @endphp

                                @if (
                                    $eventStart->lessThanOrEqualTo(\Carbon\Carbon::create($currentYear, $currentMonth, $day)) &&
                                    $eventEnd->greaterThanOrEqualTo(\Carbon\Carbon::create($currentYear, $currentMonth, $day))
                                )
                                    <span class="badge bg-primary text-light mt-1 d-block">
                                        {{ $event['title'] }}
                                    </span>
                                @endif
                            @endforeach
                        </td>
                        @php
                            $daysPrinted++;
                            if ($daysPrinted % 7 === 0) echo '</tr><tr>';
                        @endphp
                    @endfor

                    @while ($daysPrinted % 7 !== 0)
                        <td></td>
                        @php $daysPrinted++; @endphp
                    @endwhile
                </tr>
            </tbody>
        </table>
    </div>
</div>
