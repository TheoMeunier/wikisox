<x-app-layout>
    <section class="container">

        <header>
            <h1>{{ $totalResults }} {{ __('title.results') }}</h1>
        </header>

        <div class="mt-8">
            @foreach($results as $result)
                <article class="py-4 border-b-2 border-gray-100">
                    <a href="{{ $result['url'] }}" class="hover:text-indigo-500">
                        <div class="flex justify-between items-center">
                            <h2 class="h3">{{ $result['name'] }}</h2>
                        </div>

                        <p class="mt-2">
                            {{ $result['description'] }}
                        </p>
                    </a>
                </article>
            @endforeach
        </div>

        <div class="pagination">
            {{ $results->links("components.modules.pagination") }}
        </div>
    </section>
</x-app-layout>
