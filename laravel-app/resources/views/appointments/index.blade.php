<x-layout>
    <div class="container">
        <h1>مــواعـيـدي</h1>
        <br>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">احجز موعد</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>رقم الموعد</th>
                <th>اسم العميد</th>
                <th>الوقت</th>
                <th>الحالة</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->appointment_id }}</td>
                    <td>{{ $appointment->dean->user->name }}</td> <!-- Display Dean's name -->
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>{{ __('statuses.' . $appointment->status) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
