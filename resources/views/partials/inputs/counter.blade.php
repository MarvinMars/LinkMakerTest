<div class="mb-3">
    @if($title)
        <label for="{{ $name }}" class="form-label">{{ $title }} <span id="output"></span></label>
    @endif
{{--    <div class="progress">--}}
{{--        <div class="progress-bar" role="progressbar" style="width: {{ ($value / $max) * 100 }}%;" aria-valuenow="{{ $value ?? 0 }}" aria-valuemin="{{ $min }}" aria-valuemax="{{ $max }}">{{ $value ?? 0 }}</div>--}}
{{--    </div>--}}
    <input type="range" class="form-range" min="{{ $min }}" max="{{ $max }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<script>
    const rangeInput = document.getElementById('{{ $name }}');
    rangeInput.addEventListener('input', updateTime);
    updateTime();

    function updateTime() {
        const rangeValue = parseInt(rangeInput.value);
        const hours = Math.floor(rangeValue / 3600);
        const minutes = Math.floor((rangeValue % 3600) / 60);
        const seconds = rangeValue % 60;
        const formattedTime = pad(hours) + " : " + pad(minutes) + " : " + pad(seconds);
        document.getElementById('output').innerText = formattedTime;
    }

    function pad(num) {
        return (num < 10) ? "0" + num : num;
    }
</script>