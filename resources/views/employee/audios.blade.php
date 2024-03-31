@extends('employee.lteLayout.master')

@section('title')
    @lang('messages.show') @lang('messages.alarm_tones')
@endsection

@section('styles')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('messages.add') @lang('messages.alarm_tones') </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                @include('flash::message')
                <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php $emp = Auth::guard('employee')->user(); ?>
                        <form role="form" action="{{route('store_audios')}}" method="post"
                              enctype="multipart/form-data">
                            <input type='hidden' name='_token' value='{{Session::token()}}'>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label"> النغمة 1 </label>
                                    <input name="audio" type="radio" value="audio1.wav" {{$emp->audio_name == 'الكنيسة.amr' ? 'checked' : ''}}>
                                    <audio controls>
                                        <source src="{{asset('/audios/رنه هاديه.mp3')}}" type="audio/wav">
                                    </audio>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> النغمة 2 </label>
                                    <input name="audio" type="radio" value="audio2.wav" {{$emp->audio_name == 'audio2.wav' ? 'checked' : ''}}>
                                    <audio controls>
                                        <source src="{{asset('/audios/audio2.wav')}}" type="audio/wav">
                                    </audio>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> النغمة 3 </label>
                                    <input name="audio" type="radio" value="audio3.wav" {{$emp->audio_name == 'audio3.wav' ? 'checked' : ''}}>
                                    <audio controls>
                                        <source src="{{asset('/audios/audio3.wav')}}" type="audio/wav">
                                    </audio>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> النغمة 4 </label>
                                    <input name="audio" type="radio" value="audio4.wav" {{$emp->audio_name == 'audio4.wav' ? 'checked' : ''}}>
                                    <audio controls>
                                        <source src="{{asset('/audios/audio4.wav')}}" type="audio/wav">
                                    </audio>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> النغمة 5 </label>
                                    <input name="audio" type="radio" value="audio5.wav" {{$emp->audio_name == 'audio5.wav' ? 'checked' : ''}}>
                                    <audio controls>
                                        <source src="{{asset('/audios/audio5.wav')}}" type="audio/wav">
                                    </audio>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> النغمة 6 </label>
                                    <input name="audio" type="radio" value="audio6.wav" {{$emp->audio_name == 'audio6.wav' ? 'checked' : ''}}>
                                    <audio controls>
                                        <source src="{{asset('/audios/audio6.wav')}}" type="audio/wav">
                                    </audio>
                                </div>
                                @if ($errors->has('audio'))
                                    <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('audio') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')

@endsection
