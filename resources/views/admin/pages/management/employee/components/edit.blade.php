<input type="hidden" id="update_id" name="user_id" value="{{ $edit->id }}">
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

<!-- Email Address -->
<div class="form-group">
    <x-input-label for="update_email" :value="__('Email')" />
    <div class="input-group">
        <span class="input-group-text">
            <i class="icon-email"></i>
        </span>
        <x-text-input id="update_email" class="form-control" type="email" name="email" :value="$string[1]"
            placeholder="Masukkan Email" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <div class="invalid-tooltip">Please enter proper email</div>
    </div>
</div>
</div>
