<form action="{{ route('registerHandle') }}" method="post">
    @csrf
    @if (session('error'))
        <p class="modTextFormError is_show"><span>{{ session()->get('error') }}</span></p>
    @endif
    <dl class="modContentItem @if ($errors->has('name')) modContentItem--error @endif">
        <dd class="modContentItem__inputBox">
            <input type="text" name="name" id="" value="{{ old('name') }}" class="modInputText">
            @error('name')
                <p class="modContentItem__inputBox__errorText">{{ $message }}</p>
            @enderror
        </dd>
    </dl>
    <dl class="modContentItem @if ($errors->has('email')) modContentItem--error @endif">
        <dd class="modContentItem__inputBox">
            <input type="text" name="email" id="" value="{{ old('email') }}" class="modInputText">
            @error('email')
                <p class="modContentItem__inputBox__errorText">{{ $message }}</p>
            @enderror
        </dd>
    </dl>
    <dl class="modContentItem @if ($errors->has('password')) modContentItem--error @endif">
        <dd class="modContentItem__inputBox">
            <div class="modInputPassword js-input-password">
                <input type="password" name="password" class="">
                <span class="modInputPassword__eye"></span>
            </div>
            @error('password')
                <p class="modContentItem__inputBox__errorText">{{ $message }}</p>
            @enderror
        </dd>
    </dl>
    <button type="submit" class="modBtnRounded">{{ __('auth.btn_submit') }}</button>
</form>
