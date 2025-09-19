<div class="d-flex flex-wrap gap-2 align-items-center justify-content-center">
    <a href="{{ route('audit.view', $cl->id) }}" class="btn btn-primary btn-sm">
        <span class="svg-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.25" d="M12 20.75C15.7279 20.75 19.1018 18.7633 21.0458 15.5C19.1018 12.2367 15.7279 10.25 12 10.25C8.2721 10.25 4.8982 12.2367 2.9542 15.5C4.8982 18.7633 8.2721 20.75 12 20.75Z" fill="currentColor"/>
                <path d="M12 13.25C13.2426 13.25 14.25 12.2426 14.25 11C14.25 9.75736 13.2426 8.75 12 8.75C10.7574 8.75 9.75 9.75736 9.75 11C9.75 12.2426 10.7574 13.25 12 13.25Z" fill="currentColor"/>
            </svg>
        </span>
        View
    </a>

    {{-- <a href="{{ route('audit.evaluate', $cl->id) }}" class="btn btn-success btn-sm">
        <span class="svg-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M6 11.5L10 15.5L18 6.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        Evaluate
    </a>

    <a href="{{ route('audit.edit', $cl->id) }}" class="btn btn-warning btn-sm">
        <span class="svg-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M4 20H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.69 6.69001L17.31 9.31001" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.30999 11.69L6.68999 14.31" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        Edit
    </a> --}}

    {{-- Uncomment if needed --}}
    {{-- 
    <a href="{{ route('audit.review', $audit->a_id) }}" class="btn btn-info btn-sm">
        <span class="svg-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M4 4H20V20H4V4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 9H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 15H12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        Review
    </a> 
    --}}

    {{-- <a href="{{ route('audit.schedule', $cl->id) }}" class="btn btn-danger btn-sm">
        <span class="svg-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M7 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M17 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5 22H19C20.1046 22 21 21.1046 21 20V10H3V20C3 21.1046 3.89543 22 5 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        Schedule
    </a> --}}
</div>
