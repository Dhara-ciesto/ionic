@extends('layouts.master')

@section('title')
    @lang('Fragrance Tone')
@endsection
<style>
    .tone {
        padding: 8px;
        border: 1px solid #ddd;
        width: 50px;
        height: 30px;
        text-align: center;
        border-radius: 0.25rem;
        margin: 2px;
    }

    .tone:focus {
        color: #495057;
        background-color: #fff;
        border-color: #b9bfc4;
        outline: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
</style>
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Masters
        @endslot
        @slot('title')
            Add Fragrance Tone
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">Fill all information below</p>
                    <form method="POST" action="{{ route('fragrance_tone.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="brand_name">Fragrance Tone<span class="error">*</span></label>
                                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                                        class="form-control" placeholder="Name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="tone_binary_digit">Tone Binary Digit</label>
                                    <br>
                                    0x<input id="tone_binary_digit" name="tone_binary_digit[]" class="tone" maxlength="2" minlength="2" type="text"  onchange="if((this.value.length)<2)this.value='0'+this.value;" value="{{ old('tone_binary_digit.0') }}">
                                    0x<input id="tone_binary_digit" name="tone_binary_digit[]" class="tone" maxlength="2"  minlength="2" type="text" onchange="if((this.value.length)<2)this.value='0'+this.value;" value="{{ old('tone_binary_digit.1') }}">

                                    0x<input id="tone_binary_digit" name="tone_binary_digit[]" class="tone" maxlength="2"  minlength="2" type="text" onchange="if((this.value.length)<2)this.value='0'+this.value;" value="{{ old('tone_binary_digit.2') }}">
                                    0x<input id="tone_binary_digit" name="tone_binary_digit[]" class="tone" maxlength="2"  minlength="2" type="text" onchange="if((this.value.length)<2)this.value='0'+this.value;" value="{{ old('tone_binary_digit.3') }}">

                                    0x<input id="tone_binary_digit" name="tone_binary_digit[]" class="tone" maxlength="2"  minlength="2" type="text" onchange="if((this.value.length)<2)this.value='0'+this.value;" value="{{ old('tone_binary_digit.4') }}">
                                    0x<input id="tone_binary_digit" name="tone_binary_digit[]" class="tone" maxlength="2"  minlength="2" type="text" onchange="if((this.value.length)<2)this.value='0'+this.value;" value="{{ old('tone_binary_digit.5') }}">

                                    0x<input id="tone_binary_digit" name="tone_binary_digit[]" class="tone" maxlength="2"  minlength="2" type="text" onchange="if((this.value.length)<2)this.value='0'+this.value;" value="{{ old('tone_binary_digit.6') }}">
                                    @error('tone_binary_digit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="brand_name">Video<span class="error">*</span></label>
                                    <input type="file" name="video" id="video" class="form-control" placeholder="Name" accept="video/*">
                                    <small>File size maximum limit 20 MB.</small>
                                    @error('video')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-outline-danger waves-effect waves-light">Save</button>
                            <a href="{{ route('fragrance_tone.index') }}"
                                class="btn btn-danger waves-effect waves-light">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $('input[name="tone_binary_digit[]"]').on('input',function(element) {
            var max_chars = 2;
            if (this.value.length == max_chars) {
                this.value = this.value.substr(0, max_chars);
                $(this).next('input').focus();
                return false;
            }
        });
    </script>
@endsection
