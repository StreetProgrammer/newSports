@extends('club.Reports.Pages.reportsIndex')

@section('content')
  <h1 style="color: #4CAF50">Courts Report</h1>
  <h3 style="color: #4CAF50">
    Contain Selected Courts Data Report
    {{ $fromDate == null ? '' : ' From ' . $fromDate }}  {{ $toDate == null ? '' : ' To ' . $toDate }}
  </h3>
  <hr style="width: 100px;">
  </div>
  {{-- start a branch loop --}}
    @foreach ($branches as $branch)
    
      @php
        $branch = \App\Model\clubBranche::with('branchPlaygrounds')->find($branch);
        //return $branch ;
        // $reservation = $reservations->where('R_playground_id', $court);
        
        
      @endphp
      {{ $branch->c_b_name }}
      <br>
      {{ $branch->branchPlaygrounds->count() }}
      <br>
      @foreach ($branch->branchPlaygrounds as $court)
        {{ $court->id }}
      @endforeach
    
    @endforeach
  {{-- start a branch loop --}}
   

@endsection