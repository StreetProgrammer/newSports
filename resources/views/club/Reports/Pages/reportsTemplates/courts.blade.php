@extends('club.Reports.Pages.reportsIndex')

@section('content')
  <h1 style="color: #4CAF50">Courts Report</h1>
  <h3 style="color: #4CAF50">
    Contain Selected Courts Data Report
    {{ $fromDate == null ? '' : ' From ' . $fromDate }}  {{ $toDate == null ? '' : ' To ' . $toDate }}
  </h3>
  </div>
  @foreach ($courts as $court)
  
  @php
    $reservation = $reservations->where('R_playground_id', $court);
    $court = \App\Model\Playground::find($court);
  @endphp
   
  <table class="pdfTable">
      <tr>
        <th>Court</th>
        <th>Total Revenue</th>
        <th>Club Revenue</th>
        <th>SportsMate Revenue</th>
        <th>Total Reservations</th>
        <th>Reserved By Club</th>
        <th>Reserved By SportsMate</th>
        <th>Total Hours</th>
      </tr>
      <tr>
        <td>{{ $court->c_b_p_name }}</td>
        <td>{{ $reservation->sum('R_total_price') }} LE</td>
        <td>{{ ($reservation->sum('R_total_price') / 100) * 90 }} LE</td>
        <td>{{ ($reservation->sum('R_total_price') / 100) * 10 }} LE</td>
        <td>{{  $reservation->count() }}</td>
        <td>{{ $reservation->whereIn('reservedBy', [2, 3, 4])->count() }}</td>
        <td>{{ $reservation->count() - $reservation->whereIn('reservedBy', [2, 3, 4])->count() }}</td>
        <td>{{ $reservation->sum('R_hour_count') }}</td>
      </tr>
  </table>
  @endforeach
  <table class="pdfTable">
  <tr>
    <th>Court</th>
    <th>Total Revenue</th>
    <th>Club Revenue</th>
    <th>SportsMate Revenue</th>
    <th>Total Reservations</th>
    <th>Reserved By Club</th>
    <th>Reserved By SportsMate</th>
    <th>Total Hours</th>
  </tr>
  <tr>
    <td></td>
    <td>{{ $reservations->sum('R_total_price') }} LE</td>
    <td>{{ ($reservations->sum('R_total_price') / 100) * 90 }} LE</td>
    <td>{{ ($reservations->sum('R_total_price') / 100) * 10 }} LE</td>
    <td>{{  $reservations->count() }}</td>
    <td>{{ $reservations->whereIn('reservedBy', [2, 3, 4])->count() }}</td>
    <td>{{ $reservations->count() - $reservations->whereIn('reservedBy', [2, 3, 4])->count() }}</td>
    <td>{{ $reservations->sum('R_hour_count') }}</td>
  </tr>
  </table>
  
  {{--
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
    @foreach ($reservations as $reservation)
      <tr>
        <td>{{ $reservation->id }}</td>
        <td>{{ $reservation->Playground }}</td>
        <td>{{ $reservation->resOwner }}</td>
        <td>{{ $reservation->Creator }}</td>
        <td>{{ $reservation->Position == 1 ? 'Player' : $reservation->Position == 2 ? 'Owner' : $reservation->Position == 3 ? 'Admin' : $reservation->Position == 4 ? 'Manager' : ''}}</td>
        <td>{{ $reservation->R_date }} - {{ $reservation->Day }} - {{ $reservation->From }} - {{ $reservation->To }}</td>
        <td>{{ $reservation->R_price_per_hour }} LE</td>
        <td>{{ $reservation->R_hour_count }}</td>
        <td>{{ $reservation->R_total_price }} LE</td>
        <td>{{ $reservation->created_at }}</td>
      </tr>
    @endforeach
  
  </table>
  --}}
@endsection