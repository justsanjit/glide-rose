<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-12 bg-white">
                <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:text-center">
                        <p class="text-base leading-6 text-indigo-600 font-semibold tracking-wide uppercase">
                            Order #{{ $order->id }}</p>
                        <h3
                            class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                            Thank you for your order.
                        </h3>
                        <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto">
                            You have successfully placed your order for <strong>{{ $order->product->name }}</strong>
                            with total ${{ $order->charge_in_dollars }}
                        </p>
                    </div>

                    <div class="lg:text-center mt-10">
                        <a href="{{ route('products')}}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Place new order
                        </a>
                    </div>
                </div>

            </div>
        </div>
</x-app-layout>