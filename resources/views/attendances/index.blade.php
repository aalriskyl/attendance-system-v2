@extends('layouts.app')

@section('content')
<div class="container">
    @if(auth()->user()->role === 'employee')
        <div class="card mb-4">
            <div class="card-header">Check In</div>
            <div class="card-body">
                <form method="POST" action="{{ route('attendances.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="note" class="form-label">Note (optional)</label>
                        <textarea class="form-control" id="note" name="note" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Check In</button>
                </form>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header mb-4">Attendance Records</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        @if(auth()->user()->role === 'super_admin')
                            <th>Employee</th>
                        @endif
                        <th>Check In Time</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            @if(auth()->user()->role === 'super_admin')
                                <td>{{ $attendance->user->name }}</td>
                            @endif
                            <td>{{ $attendance->check_in->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $attendance->note }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
