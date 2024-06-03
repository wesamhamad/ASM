<x-layout>
    <div class="container mt-5">
        <h1 class="text-right mb-4">حــجــز موعــد</h1>
        <form action="{{ route('appointments.store') }}" method="POST" class="shadow p-4 bg-white rounded">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="dean_id" class="form-label">اختر العميد</label>
                    <select class="form-control" id="dean_id" name="dean_id" required>
                        <option value="" disabled selected>اختر العميد</option>
                        @foreach ($deans as $dean)
                            <option value="{{ $dean->dean_id }}">{{ $dean->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="slot_id" class="form-label">وقت الموعد</label>
                    <select class="form-control" id="slot_id" name="slot_id" required>
                        <option value="" disabled selected>اختر الوقت</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">احـجـز</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('dean_id').addEventListener('change', function () {
            var deanId = this.value;
            fetch('/api/dean/' + deanId + '/available-slots')
                .then(response => response.json())
                .then(data => {
                    var slotSelect = document.getElementById('slot_id');
                    slotSelect.innerHTML = '<option value="" disabled selected>اختر الوقت</option>';
                    data.forEach((slot, index) => {
                        if (slot.status === 'available') {
                            var option = document.createElement('option');
                            option.value = index;
                            option.textContent = new Date(slot.time).toLocaleString('ar-EG');
                            slotSelect.appendChild(option);
                        }
                    });
                });
        });
    </script>
</x-layout>
