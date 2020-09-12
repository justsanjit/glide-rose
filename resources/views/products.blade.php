<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <!-- Login Attention -->
      @guest
      <div class="rounded-md bg-yellow-50 p-4 mb-8">
        <div class="flex">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <h3 class="text-sm leading-5 font-medium text-yellow-800">
              Attention needed
            </h3>
            <div class="mt-2 text-sm leading-5 text-yellow-700">
              <p>
                You need an account to purchase a product.
              </p>
            </div>
            <div class="mt-4">
              <div class="-mx-2 -my-1.5 flex">
                <a href="{{ route('login')}}"
                  class="px-2 py-1.5 rounded-md text-sm leading-5 font-medium text-yellow-800 hover:bg-yellow-100 focus:outline-none focus:bg-yellow-100 transition ease-in-out duration-150">
                  Login
                </a>
                <a href="{{ route('register')}}"
                  class="ml-3 px-2 py-1.5 rounded-md text-sm leading-5 font-medium text-yellow-800 hover:bg-yellow-100 focus:outline-none focus:bg-yellow-100 transition ease-in-out duration-150">
                  Register
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

      <!-- Global session errors -->
      @if(session()->has('error'))
      <div class="rounded-md bg-red-50 p-4 mb-8">
        <div class="flex">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <h3 class="text-sm leading-5 font-medium text-red-800">
              {{ session()->get('error')}}
            </h3>
          </div>
        </div>
      </div>
      @endif

      <!-- Product list -->
      <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach($products as $product)
        <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow">
          <div class="flex-1 flex flex-col p-8">
            <img class="w-128 h-128 flex-shrink-0 mx-auto bg-black" src="{{ $product->preview_image}}"
              alt="{{ $product->title}}">
            <h3 class="mt-6 text-gray-900 text-sm leading-5 font-medium">{{ $product->name}} -
              ${{ $product->price_in_dollars}}</h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
              <dd class="text-gray-500 text-sm leading-5">{{ $product->description}}</dd>
              <dd class="mt-3">
                @if ($product->stock > 0 )
                <span class="px-2 py-1 text-teal-800 text-xs leading-4 font-medium bg-teal-100 rounded-full">
                  {{ $product->stock }} in Stock
                </span>
                @else
                <span class="px-2 py-1 text-red-800 text-xs leading-4 font-medium bg-red-100 rounded-full">
                  Out of Stock
                </span>
                @endif
              </dd>
            </dl>
          </div>
          <div class="border-t border-gray-200">
            @if($product->inStock())
            <form method="post" action="{{ route('orders.store', $product) }}" class="-mt-px flex">
              <div class="w-0 flex-1 flex border-r border-gray-200">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id}}" />
                <button type="submit"
                  class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                  Purchase
                </button>
              </div>
            </form>
            @else

            @endif
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</x-app-layout>