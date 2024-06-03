<x-layout>
    <div class="container">
        <h1 class="text-center">تسجيل</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="role" class="form-label">المستخدم</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="student">طالب</option>
                        <option value="coordinator">منسق</option>
                        <option value="dean">عميد</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3 d-none" id="deanField">
                <div class="col-md-6 offset-md-3">
                    <label for="dean_id" class="form-label">اختر العميد</label>
                    <select class="form-control" id="dean_id" name="dean_id">
                        <option value="" disabled selected>اختر العميد</option>
                        @foreach ($deans as $dean)
                            <option value="{{ $dean->dean_id }}">{{ $dean->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3 d-none" id="coordinatorField">
                <div class="col-md-6 offset-md-3">
                    <label for="coordinator_id" class="form-label">اختر المنسق</label>
                    <select class="form-control" id="coordinator_id" name="coordinator_id">
                        <option value="" disabled selected>اختر المنسق</option>
                        @foreach ($coordinators as $coordinator)
                            <option value="{{ $coordinator->coordinator_id }}">{{ $coordinator->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <button type="submit" class="btn btn-primary">تسجيل</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function () {
            var role = this.value;
            var deanField = document.getElementById('deanField');
            var coordinatorField = document.getElementById('coordinatorField');

            deanField.classList.add('d-none');
            coordinatorField.classList.add('d-none');

            if (role === 'coordinator') {
                deanField.classList.remove('d-none');
            } else if (role === 'dean') {
                coordinatorField.classList.remove('d-none');
            }
        });
    </script>

    <style>
        .form-select {
            max-width: 100%;
        }
    </style>
</x-layout>
