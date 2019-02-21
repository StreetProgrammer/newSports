@extends('club.Reports.Pages.reportsIndex')

@section('content')
  <h1 style="color: #4CAF50">Courts Report</h1>
  <h3 style="color: #4CAF50">
    Contain Selected Courts Data Report
    {{ $fromDate == null ? '' : ' From ' . $fromDate }}  {{ $toDate == null ? '' : ' To ' . $toDate }}
  </h3>
  <hr style="width: 100px;">
  </div>
  @foreach ($courts as $court)
  
    @php
      $reservation = $reservations->where('R_playground_id', $court);
      $court = \App\Model\Playground::find($court);
    @endphp
    <h3 style="color: #000;text-align: center;">
      Contain {{ $court->c_b_p_name }} Report
      {{ $fromDate == null ? '' : ' From ' . $fromDate }}  {{ $toDate == null ? '' : ' To ' . $toDate }}
    </h3>

    {{-- start court total revenue report --}}
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
        <td>{{ $reservation->count() }}</td>
        <td>{{ $reservation->whereIn('reservedBy', [2, 3, 4])->count() }}</td>
        <td>{{ $reservation->count() - $reservation->whereIn('reservedBy', [2, 3, 4])->count() }}</td>
        <td>{{ $reservation->sum('R_hour_count') }}</td>
      </tr>
    </table>
    {{-- end court total revenue report --}}

    {{-- start court info report --}}
    {{--
    <table class="pdfTable">
      <tr>
        <th>Branch</th>
        <th>Sport</th>
        <th>Per Hour</th>
      </tr>
      <tr>
        <td>{{ $court->branch()->c_b_name }}</td>
        <td>{{ $court->sport()->en_sport_name }}</td>
        <td>{{ $court->c_b_p_price_per_hour }} LE</td>
      </tr>
    </table>
    --}}
    {{-- end court info report --}}

    {{-- start court users report --}}
    <table class="pdfTable">
      <tr>
        <th>User</th>
        <th>Position</th>
        <th>Account Status</th>
      </tr>
      @foreach ($court->users() as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->name }} LE</td>
        </tr>
      @endforeach
    </table>
    {{-- end court users report --}}

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
    <br><br>
  @endforeach
   

@endsection