<div>
    <div class="p-5">
        <div>
            <x-forms.input-search wire:model="search" type="search" class="w-full"
                                  :placeholder="__('input.placeholder.search')"
                                  wire:keydown.prevent.arrow-down="incrementIndex"
                                  wire:keydown.prevent.arrow-up="decrementIndex"
                                  wire:keydown.prevent.enter="selectIndex"
                                  autofocus
            />
        </div>

        @if(count($searchResults) > 0)
            <div class="search">
                @foreach($searchResults as $index => $result)
                    <div class="search-item {{ ($index === $currentIndex) ? 'search-item-active' : '' }}">
                        <div class="text-muted">{{ $result['type'] }}</div>
                        <div class="text-gray-100">|</div>
                        <a href="{{ $result['url'] }}">
                            {{ $result['name'] }}
                        </a>
                    </div>
                @endforeach
                <div class="search-footer">
                    <form action="{{ route('home.search', ['search' => $search]) }} }}" method="GET">
                        <label>
                            <input hidden name="search" value="{{ $search }}">
                        </label>

                        <button type="submit">{{ __('button.action.seeMore') }} <span class="text-indigo-500">{{ $totalResults }}</span>
                           {{ __('title.results') }}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
