<input type="hidden" id="update_id" name="uuid_user" value="{{ $edit->id }}">
<div class="form-group">
    <x-input-label for="update_name" :value="__('Name')" />
    <div class="input-group">
        <span class="input-group-text">
            <i class="icon-user"></i>
        </span>
        <x-text-input id="update_name" class="form-control" type="text" name="name" :value="$edit->name" required
            autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <div class="invalid-tooltip">Please enter name</div>
    </div>
</div>
</div>

<div class="form-group">
    <x-input-label for="update_username" :value="__('Username')" />
    <div class="input-group">
        <span class="input-group-text">
            <i class="icon-user"></i>
        </span>
        <x-text-input id="update_username" class="form-control" type="text" name="username" :value="$string[1]"
            placeholder="Masukkan username" />
        <x-input-error :messages="$errors->get('username')" class="mt-2" />
        <div class="invalid-tooltip">Please enter proper username</div>
    </div>
</div>
