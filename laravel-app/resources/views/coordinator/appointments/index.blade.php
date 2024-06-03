
                        <x-layout>
                            <div class="container">
                                <h1>مـواعـيد الـعـمـيـد</h1>
                                <br>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('coordinator.appointments.updateMultiple') }}" method="POST">
                                    @csrf
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>رقم الموعد</th>
                                            <th>اسم الطالب</th>
                                            <th>اسم العميد</th>
                                            <th>الوقت</th>
                                            <th>الحالة</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($appointments as $appointment)
                                            <tr>
                                                <td><input type="checkbox" name="appointment_ids[]" value="{{ $appointment->appointment_id }}"></td>
                                                <td>{{ $appointment->appointment_id }}</td>
                                                <td>{{ $appointment->student->user->name }}</td>
                                                <td>{{ $appointment->dean->user->name }}</td>
                                                <td><input type="datetime-local" name="appointment_time[{{ $appointment->appointment_id }}]" value="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('Y-m-d\TH:i') }}" class="form-control"></td>
                                                <td>
                                                    <select name="status[{{ $appointment->appointment_id }}]" class="form-control">
                                                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>معلق</option>
                                                        <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                                                        <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>ملغى</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary mt-3">تحديث المواعيد المختارة</button>
                                </form>
                            </div>
                        </x-layout>
