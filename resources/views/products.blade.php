<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow">
                  <div class="flex-1 flex flex-col p-8">
                    <img class="w-128 h-128 flex-shrink-0 mx-auto bg-black" src="https://picsum.photos/256" alt="">
                      <h3 class="mt-6 text-gray-900 text-sm leading-5 font-medium">Product</h3>
                      <dl class="mt-1 flex-grow flex flex-col justify-between">
                        <dt class="sr-only">Title</dt>
                        <dd class="text-gray-500 text-sm leading-5">Proudct description</dd>
                        <dt class="sr-only">Price</dt>
                        <dd class="mt-3">
                          <span class="px-2 py-1 text-teal-800 text-xs leading-4 font-medium bg-teal-100 rounded-full">$49.98</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="border-t border-gray-200">
                      <div class="-mt-px flex">
                        <div class="w-0 flex-1 flex border-r border-gray-200">
                          <a href="#" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                            <span>Purchase</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
            </ul>
        </div>
    </div>
</x-app-layout>
    