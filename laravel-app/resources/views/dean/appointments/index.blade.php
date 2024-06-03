<x-layout>
    <div class="container">
        <h1>مــواعـيـدي</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="GET" action="{{ route('dean.appointments.filter') }}">
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" name="date_range" class="form-control" placeholder="التاريخ والوقت (YYYY-MM-DD - YYYY-MM-DD)" value="{{ request('date_range') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="student_name" class="form-control" placeholder="اسم الطالب" value="{{ request('student_name') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">تصفية</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th>رقم الموعد</th>
                <th>اسم الطالب</th>
                <th>الوقت</th>
                <th>الحالة</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->appointment_id }}</td>
                    <td>{{ $appointment->student->user->name }}</td> <!-- Display Student's name -->
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>{{ __('statuses.' . $appointment->status) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
