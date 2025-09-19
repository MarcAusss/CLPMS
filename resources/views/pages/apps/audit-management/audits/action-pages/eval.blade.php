<x-default-layout>
    @section('title')
        Audit Evaluation
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('audit.evaluate', $audit) }}
    @endsection

    <livewire:audit.evaluate-audit :audit="$audit" />
    
    
    
</x-default-layout>
