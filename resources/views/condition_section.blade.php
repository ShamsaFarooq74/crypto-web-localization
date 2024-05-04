
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    <div class="ml-7  text-justify mb-12 lg:mb-12">
    <h5 class="mb-4 text-3xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                {{ __('Terms And Conditions') }}
            </h5>
            @foreach ($terms as $term)
            <h3 class="mb-4 text-2xl font-semibold">
                  @if(app()->getLocale() == 'en')
                {{ $term->titleEN }}
                @else
                {{ $term->titleAR }}
                @endif</h3>
            <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
            @if(app()->getLocale() == 'en')
                {{ $term->descriptionEN }}
                @else
                {{ $term->descriptionAR }}
                @endif</p>
            @endforeach
</div>
</div>
<script>
     function scrollTerms() {
      var section = document.getElementById('condition');
      section.scrollIntoView({ behavior: 'smooth' });
    }
</script>
