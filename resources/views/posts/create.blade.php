@extends('layouts.main')

@section('content')
            <div class="flex-col text-blue-700 mb-2 font-medium ml-4">
                <a class="block">Hint :วิธีติดต่อพนักงานสำหรับเรื่องเล็กน้อยที่สามารถจัดการได้</a>
                <a class="block">แม่บ้าน พี่สวย 08x-xxxxxxxx</a>
                <a class="block">แม่บ้าน พี่ฝน  09x-xxxxxxxx</a>
    </div >
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="relative z-0 mb-6 w-1/3 group">
            @if ($errors->has('title'))
                <p class="text-red-600 ml-4">
                    {{ $errors->first('title') }}
                </p>
            @endif
            <input type="text" name="title" id="title" class="block ml-4 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 @error('title') border-red-600 @else border-gray-300 @enderror appearance-none focus:outline-none focus:ring-0 focus:border-gray-800 peer"
            value="{{old('title')}}" placeholder=" " autocomplete="off">
            <label for="title" class="ml-4 peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Title
            </label>
        </div>

        <div class="relative z-0 mb-6 w-1/3 group">
            <input type="text" name="tags" id="tags" class="block ml-4 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-800 peer"
                value="{{old('tags')}}" placeholder=" " autocomplete="off">
            <label for="tags" class="ml-4 peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Tags (separated with commas)
            </label>
        </div>

        <label for="description" class="block ml-4 mb-2 text-sm font-medium ">
            Description
        </label>
        @if ($errors->has('description'))
            <p class="text-red-600 ml-4">
                {{ $errors->first('description') }}
            </p>
        @endif
        <textarea name="description" id="description" rows="4" class="block ml-4 p-2.5 w-1/3 text-sm text-gray-900 bg-gray-50 rounded-lg border @error('description') border-red-600 @else border-gray-300 @enderror focus:ring-gray-800 focus:border-gray-800 "
            placeholder="Your message..." autocomplete="off" onKeyPress>{{old('description')}}</textarea>

        <div class="row my-4 ml-4">
            <div class="col-md-6">
                <input type="file" name="image" id="image" class="form-control">
            </div>
        </div>
        @if ($errors->has('issue_date'))
            <p class="text-red-600 ml-4">
                {{ $errors->first('issue_date') }}
            </p>
        @endif
            </div>
            <input name="issue_date" id="issue_date" size="26" value="{{old('issue_date')}}"class="my-2 ml-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5  datepicker-input" placeholder="Issue date format:YYYY-mm-dd">
        </div>

        <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
    <div>
    <label class="switch my-2 ml-4">
    <input type="checkbox" name="incognito" id="incognito" value="1">
    <span class="slider round"></span>
    </label>
    <label class = "my-2 ml-2 text-sm max-w-sm font-medium text-gray-700 ">Incognito</label></div>


        @if ($errors->has('image'))
            <p class="text-red-600 ml-4">
                {{ $errors->first('image') }}
            </p>
        @endif

{{--        @if (count($errors) > 0)--}}
{{--            <div class="alert alert-danger">--}}
{{--                <strong>Whoops!</strong> There were some problems with your input.--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}

        <button type="submit" class="ml-4 mt-3 text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Create</button>
    </form>

@endsection
