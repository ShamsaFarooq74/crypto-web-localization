@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
<header>
    <nav class="border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800 w-30 bg-cyan-700 text-white">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">CRYPTO_WEB</span>
            </a>
            <div class="flex items-center lg:order-2">
                @if(!Auth::check())
                <!-- Modal toggle -->
               <!--  <button class="w-90 text-gray-800 text-white hover:bg-cyan-600 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none hover:bg-cyan-600" onclick="scrollTerms()"> {{ __('Terms And Conditions') }}</button>
                <button class="w-80 text-gray-800 text-white font-medium rounded-lg text-sm px-4 hover:bg-cyan-600 lg:px-5 py-2 lg:py-2.5 mr-2" onclick="scrollToSection()"> {{ __('Privacy And Policy') }}</button> -->
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"class="w-30 text-gray-800 text-white  font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none hover:bg-cyan-600"> {{ __('Login') }}</button>
                <button data-modal-target="auth-modal" data-modal-toggle="auth-modal"class="w-30 text-gray-800 text-white font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  focus:outline-none  hover:bg-cyan-600"> {{ __('Register') }}</button>
                @else
                   <button class="w-60 text-gray-800 text-white  font-medium rounded-lg text-sm pt-2.5 focus:outline-none hover:bg-cyan-600"><form action="{{ route('logout-user') }}" id="myform" method="Post">
                    @csrf
                    <a onclick="document.getElementById('myform').submit()">Log
                    Out</a>
                </form>
            </button>
                <button class="text-gray-800 text-white  font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2">{{Auth::user()->name}}</button>
                @endif
                <select id="countries" class="w-20 block appearance-none w-full bg-cyan-600 border-gray-300 text-white py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-900 text-sm">
               <!--   <option value="en"><i class="flag-icon flag-icon-us text-2xl"></i>English</option>
                 <option value="ar"><i class="flag-icon flag-icon-sa text-2xl"></i>Arabic</option> -->
                 <option value="en" @if (app()->getLocale() == 'en') selected @endif>English</option>
                 <option value="ar" @if (app()->getLocale() == 'ar') selected @endif>Arabic</option>
                 </select>
            </div>
               <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                         <button class="block text-gray-800 text-white font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  focus:outline-none  hover:bg-cyan-600" onclick="scrollTerms()"> {{ __('Terms And Conditions') }}</button>
                    </li>
                    <li>
                        <button class="block text-gray-800 text-white font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  focus:outline-none  hover:bg-cyan-600" onclick="scrollToSection()"> {{ __('Privacy And Policy') }}</button>
                    </li> 
                     <li>
                        <a href= "{{route('binance.success')}}" class="block text-gray-800 text-white font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  focus:outline-none  hover:bg-cyan-600">Success</a>
                    </li>
                     <li>
                        <a href= "{{route('binance.duration')}}" class="block text-gray-800 text-white font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  focus:outline-none  hover:bg-cyan-600">Duration</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Banner -->
<div class="bg-gray-200">
    <img src="https://dummyimage.com/1200x200" alt="Banner" class="w-full h-auto">
</div>
<section>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white ">
                {{ __('Designed for business teams like yours') }}
            </h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">
                {{ __('Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.') }}
            </p>
        </div>
        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
            @foreach ($plans as $plan)
            <div
            class="flex flex-col p-6 mx-auto max-w-lg text-center text-white bg-cyan-700 rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 text-white">
            <h3 class="mb-4 text-2xl font-semibold">
                @if(app()->getLocale() == 'en')
                {{ $plan->nameEN }}
                @else
                {{ $plan->nameAR }}
                @endif
           </h3>
            <p class="font-light text-gray-500 sm:text-lg text-white">{{ $plan->descriptionEN }}</p>
            <div class="flex justify-center items-baseline my-8 bg-cyan-800 py-4">
                <span class="mr-2 text-5xl font-extrabold">{{ $plan->price }}</span>
                <span class="text-gray-500  text-white">{{ $plan->currency }}</span>
            </div>
            <ul role="list" class="mb-8 space-y-4 text-left">
                <li class="flex items-center space-x-3">
                    <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
                </svg>
                <span>{{ $plan->duration }} {{ __('days') }}</span>
            </li>
            <li class="flex items-center space-x-3">
                <!-- Icon -->
                <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd"></path>
            </svg>
            <span>{{ __('No setup or hidden fees') }}</span>
        </li>
        <li class="flex items-center space-x-3">
            <!-- Icon -->
            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
            clip-rule="evenodd"></path>
        </svg>
        <span>{{ __('Team size') }} <span class="font-semibold">{{ __('10 developers') }}</span></span>
    </li>
    <li class="flex items-center space-x-3">
        <!-- Icon -->
        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
        clip-rule="evenodd"></path>
    </svg>
    <span>{{ __('Premium support') }}: <span class="font-semibold">{{ __('24 months') }}</span></span>
</li>
<li class="flex items-center space-x-3">
    <!-- Icon -->
    <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd"
    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
    clip-rule="evenodd"></path>
</svg>
<span>{{ __('Free updates') }}: <span class="font-semibold">{{ __('24 months') }}</span></span>
</li>
</ul>
 @if(!Auth::check())
 <button type="button"onclick="customAlert('please login Or Register First')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
{{ __('Purchase') }}</button>
 @else

<a href="{{ url('binance-payment/'. $plan->id)}}"
class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
{{ __('Purchase') }}</a>
 @endif

</div>
@endforeach
</div>
</div>
</section>
<hr class="h-px mx-auto my-8 bg-white border-0 rounded md:my-12 ">
<section  id="section">
   @include('privacy_section')
</section>
<hr class="h-px mx-auto my-8 bg-white border-0 rounded md:my-12 ">
<section  id="condition" class="py-6">
    @include('condition_section')
<!-- Login-->
<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ __('Sign in to our platform') }}</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Your password') }}</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Remember me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-700 dark:text-blue-500">{{ __('Lost Password?') }}</a>
                        @endif
                    </div>
                    <button type="submit" class=" mt-3 w-full text-white bg-cyan-700 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Login to your account') }}</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        {{ __('Not registered?') }} <a href="#" class="text-blue-700 dark:text-blue-500">{{ __('Create account') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<!-- Register-->
<!-- Main modal -->
<div id="auth-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="auth-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ __('Sign Up to our platform') }}</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     <div>
                        <label for="birth_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Date Of Birth') }}</label>
                        <input type="date" name="birth_date" id="birth_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                        @error('birth_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     <div>
                        <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Phone No') }}</label>
                        <input type="text" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="123456" required>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Your password') }}</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password-confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Confirm password') }}</label>
                        <input type="password" name="password_confirmation" id="password-confirm" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <button type="submit" class=" mt-4 w-full text-white bg-cyan-700 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Register your account') }}</button>
                </form>
            </div>
        </div>
    </div>
</div> 

@endsection

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add the JavaScript code -->
<script>
    $(document).ready(function() {
// When the toggle button is clicked, toggle the visibility of the modal
        $('[data-modal-toggle="authentication-modal"]').click(function() {
            $('#authentication-modal').toggleClass('hidden');
            $('body').toggleClass('overflow-hidden');
        });

// When the close button is clicked, hide the modal
        $('[data-modal-hide="authentication-modal"]').click(function() {
            $('#authentication-modal').addClass('hidden');
            $('body').removeClass('overflow-hidden');
        });
    });
</script>

<script>
    $(document).ready(function() {
// When the toggle button is clicked, toggle the visibility of the modal
        $('[data-modal-toggle="auth-modal"]').click(function() {
            $('#auth-modal').toggleClass('hidden');
            $('body').toggleClass('overflow-hidden');
        });

// When the close button is clicked, hide the modal
        $('[data-modal-hide="auth-modal"]').click(function() {
            $('#auth-modal').addClass('hidden');
            $('body').removeClass('overflow-hidden');
        });
    });
</script>



<script>
  $(document).ready(function() {
    $('#countries').change(function() {
      var selectedValue = $(this).val();
      if (selectedValue=="en") {
         window.location.href = '/home/en';
      }
      if (selectedValue=="ar") {
        window.location.href = '/home/ar';
      } 
    });
  });
</script>

<script>
     function scrollToSection() {
      var section = document.getElementById('section');
      section.scrollIntoView({ behavior: 'smooth' });
    }
</script>


<script>
  function customAlert(message) {
    const alertContainer = document.createElement('div');
    alertContainer.className = 'fixed inset-0 flex items-center justify-center';
    
    const alertBox = document.createElement('div');
    alertBox.className = 'bg-white border border-gray-300 shadow-lg rounded-lg p-4';

    const alertMessage = document.createElement('p');
    alertMessage.className = 'text-gray-800';
    alertMessage.textContent = message;

    alertBox.appendChild(alertMessage);
    alertContainer.appendChild(alertBox);
    document.body.appendChild(alertContainer);
  }
</script>


