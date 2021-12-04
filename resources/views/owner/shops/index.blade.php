<x-app-layout>
  <x-slot name="header">owner
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <x-flash-message status="session('status')" />
                @foreach ( $shops as $shop)
                <div class="w-1/2 p-4">
                    <a href="{{ route('owner.shops.edit', ['shop' => $shop->id ]) }}">
                        <div class="border rounded-md p4">
                            <div class="mb-4">
                                @if ($shop->is_selling)
                                <span class="border rounded-md p4 bg-blue-400 text-white">販売中</span>
                                @else
                                <span class="border rounded-md p4 bg-red-400 text-white">販売停止中</span>
                                @endif
                                <div class="text-xl">{{ $shop->name }}</div>
                                <div>
                                    <x-thumbnail :filename="$shop->filename" type="shops" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                {{-- $shops->links() --}}
                <p><a href="/component-test1">てすと１</a></p>
                <p><a href="/component-test2">てすと2</a></p>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
