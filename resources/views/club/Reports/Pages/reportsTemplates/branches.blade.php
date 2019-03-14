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
        $reservation = $reservations->whereIn('R_playground_id', $branch->courtsIds());
        
        
      @endphp
      <h3 style="color: #4CAF50;text-align: center;">
        {{ $branch->c_b_name }}
      </h3>
      {{-- start court total revenue report --}}
    <table class="pdfTable">
      <tr>
        <th>Total Revenue</th>
        <th>Club Revenue</th>
        <th>SportsMate Revenue</th>
        <th>Total Reservations</th>
        <th>Reserved By Club</th>
        <th>Reserved By SportsMate</th>
        <th>Total Hours</th>
      </tr>
      <tr>
        <td>{{ $reservation->sum('R_total_price') }} LE</td>
        <td>{{ ($reservation->sum('R_total_price') / 100) * 90 }} LE</td>
        <td>{{ ($reservation->sum('R_total_price') / 100) * 10 }} LE</td>
        <td>{{ $reservation->count() }}</td>
        <td>{{ $reservation->whereIn('reservedBy', [2, 3, 4])->count() }}</td>
        <td>{{ $reservation->count() - $reservation->whereIn('reservedBy', [2, 3, 4])->count() }}</td>
        <td>{{ $reservation->sum('R_hour_count') }}</td>
      </tr>
    </table>
    {{---------------}}

    {{-- start court all reservations report --}}
    <table class="pdfTable">
      <tr>
        <th>#ID</th>
        <th>Court</th>
        <th>Player</th>
        <th>Reserved By</th>
        <th>Position</th>
        <th>Date & Time</th>
        <th>Per Hour</th>
        <th>Total Hours</th>
        <th>Total Price</th>
        <th>Reserved On</th>
      </tr>
    @foreach ($reservation as $res)
      <tr>
        <td>{{ $res->id }}</td>
        <td>{{ $res->Playground }}</td>
        <td>{{ $res->resOwner }}</td>
        <td>{{ $res->Creator }}</td>
        <td>{{ $res->Position == 1 ? 'Player' : $res->Position == 2 ? 'Owner' : $res->Position == 3 ? 'Admin' : $res->Position == 4 ? 'Manager' : ''}}</td>
        <td>{{ $res->R_date }} - {{ $res->Day }} - {{ $res->From }} - {{ $res->To }}</td>
        <td>{{ $res->R_price_per_hour }} LE</td>
        <td>{{ $res->R_hour_count }}</td>
        <td>{{ $res->R_total_price }} LE</td>
        <td>{{ $res->created_at }}</td>
      </tr>
    @endforeach
    </table>
    {{-- end court all reservations report --}}

    {{-------------------}}
    @endforeach
  {{-- start a branch loop --}}
   

@endsection