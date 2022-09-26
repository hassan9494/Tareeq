@foreach($users as $user)
    <div class="col-md-3 mb-3">
        <div class="form-group">
            <input class="form-check-input" type="checkbox" name="users[]"
                   id="{{ $user->id }}"
                   value="{{ $user->id }}" checked>
            <label class="form-check-label" for="{{ $user->name }}">
                {{ $user->name}}
            </label>
        </div>
    </div>
@endforeach
