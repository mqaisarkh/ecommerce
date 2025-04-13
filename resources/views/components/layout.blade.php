<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="bg-white">
        <!--
          Mobile menu
      
          Off-canvas menu for mobile, show/hide based on off-canvas menu state.
        -->
        <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
          <!--
            Off-canvas menu backdrop, show/hide based on off-canvas menu state.
      
            Entering: "transition-opacity ease-linear duration-300"
              From: "opacity-0"
              To: "opacity-100"
            Leaving: "transition-opacity ease-linear duration-300"
              From: "opacity-100"
              To: "opacity-0"
          -->
          <div class="fixed inset-0 bg-black/25" aria-hidden="true"></div>
      
          <div class="fixed inset-0 z-40 flex">
            <!--
              Off-canvas menu, show/hide based on off-canvas menu state.
      
              Entering: "transition ease-in-out duration-300 transform"
                From: "-translate-x-full"
                To: "translate-x-0"
              Leaving: "transition ease-in-out duration-300 transform"
                From: "translate-x-0"
                To: "-translate-x-full"
            -->
            <div class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
              <div class="flex px-4 pt-5 pb-2">
                <button type="button" class="relative -m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400">
                  <span class="absolute -inset-0.5"></span>
                  <span class="sr-only">Close menu</span>
                  <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
      
              <!-- Links -->
              <div class="mt-2">
                <div class="border-b border-gray-200">
                  <div class="-mb-px flex space-x-8 px-4" aria-orientation="horizontal" role="tablist">
                    <!-- Selected: "border-indigo-600 text-indigo-600", Not Selected: "border-transparent text-gray-900" -->
                    <button id="tabs-1-tab-1" class="flex-1 border-b-2 border-transparent px-1 py-4 text-base font-medium whitespace-nowrap text-gray-900" aria-controls="tabs-1-panel-1" role="tab" type="button">Women</button>
                    <!-- Selected: "border-indigo-600 text-indigo-600", Not Selected: "border-transparent text-gray-900" -->
                    <button id="tabs-1-tab-2" class="flex-1 border-b-2 border-transparent px-1 py-4 text-base font-medium whitespace-nowrap text-gray-900" aria-controls="tabs-1-panel-2" role="tab" type="button">Men</button>
                  </div>
                </div>
              </div>
      
              <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                <div class="flow-root">
                  <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Company</a>
                </div>
                <div class="flow-root">
                  <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Stores</a>
                </div>
              </div>
      
              <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                <div class="flow-root">
                  <a href="/login" class="-m-2 block p-2 font-medium text-gray-900">Log In</a>
                </div>
                <div class="flow-root">
                  <a href="/register" class="-m-2 block p-2 font-medium text-gray-900">Create account</a>
                </div>
              </div>
      
              <div class="border-t border-gray-200 px-4 py-6">
                <a href="#" class="-m-2 flex items-center p-2">
                  <img src="https://tailwindcss.com/plus-assets/img/flags/flag-canada.svg" alt="" class="block h-auto w-5 shrink-0">
                  <span class="ml-3 block text-base font-medium text-gray-900">CAD</span>
                  <span class="sr-only">, change currency</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      
        <header class="relative bg-white">
          <p class="flex h-10 items-center justify-center bg-indigo-600 px-4 text-sm font-medium text-white sm:px-6 lg:px-8">Get free delivery on orders over $100</p>
      
          <nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="border-b border-gray-200">
              <div class="flex h-16 items-center">
                <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                <button type="button" class="relative rounded-md bg-white p-2 text-gray-400 lg:hidden">
                  <span class="absolute -inset-0.5"></span>
                  <span class="sr-only">Open menu</span>
                  <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                  </svg>
                </button>
      
                <!-- Logo -->
                <div class="ml-4 flex lg:ml-0">
                  <a href="#">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="">
                  </a>
                </div>
      
                <!-- Flyout menus -->
                <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                  <div class="flex h-full space-x-8">
                    <div class="flex">
                      <div class="relative flex">
                        <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                        <button type="button" class="relative z-10 -mb-px flex items-center border-b-2 border-transparent pt-px text-sm font-medium text-gray-700 transition-colors duration-200 ease-out hover:text-gray-800" aria-expanded="false">Women</button>
                      </div>
      
                      <!--
                        'Women' flyout menu, show/hide based on flyout menu state.
      
                        Entering: "transition ease-out duration-200"
                          From: "opacity-0"
                          To: "opacity-100"
                        Leaving: "transition ease-in duration-150"
                          From: "opacity-100"
                          To: "opacity-0"
                      -->
                      
                    </div>
                    <div class="flex">
                      <div class="relative flex">
                        <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                        <button type="button" class="relative z-10 -mb-px flex items-center border-b-2 border-transparent pt-px text-sm font-medium text-gray-700 transition-colors duration-200 ease-out hover:text-gray-800" aria-expanded="false">Men</button>
                      </div>
      
                      <!--
                        'Men' flyout menu, show/hide based on flyout menu state.
      
                        Entering: "transition ease-out duration-200"
                          From: "opacity-0"
                          To: "opacity-100"
                        Leaving: "transition ease-in duration-150"
                          From: "opacity-100"
                          To: "opacity-0"
                      -->
                      <div class="absolute inset-x-0 top-full text-sm text-gray-500">
                        <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                        <div class="absolute inset-0 top-1/2 bg-white shadow-sm" aria-hidden="true"></div>
      
                      </div>
                    </div>
      
                    <a href="#" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Company</a>
                    <a href="#" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Stores</a>
                  </div>
                </div>
                
                <div class="ml-auto flex items-center">

                  @auth
                    <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                        <x-forms.form method="POST" action="/logout">
                            @csrf
                            @method('DELETE')
                            <button class="cursor-pointer text-sm font-medium text-gray-700 hover:text-gray-800" >Log Out</button>
                        </x-forms.form>
                    </div>
                  @endauth

                  @guest
                    <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                      <a href="/login" class="text-sm font-medium text-gray-700 hover:text-gray-800">Log In</a>
                      <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                      <a href="/register" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create account</a>
                    </div>
                  @endguest
                  <div class="hidden lg:ml-8 lg:flex">
                    <a href="#" class="flex items-center text-gray-700 hover:text-gray-800">
                      <img src="https://tailwindcss.com/plus-assets/img/flags/flag-canada.svg" alt="" class="block h-auto w-5 shrink-0">
                      <span class="ml-3 block text-sm font-medium">CAD</span>
                      <span class="sr-only">, change currency</span>
                    </a>
                  </div>
      
                  <!-- Search -->
                  <div class="flex lg:ml-6">
                    <a href="#" class="p-2 text-gray-400 hover:text-gray-500">
                      <span class="sr-only">Search</span>
                      <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                      </svg>
                    </a>
                  </div>
      
                  <!-- Cart -->
                  <div class="ml-4 flow-root lg:ml-6">
                    <a href="#" class="group -m-2 flex items-center p-2">
                      <svg class="size-6 shrink-0 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                      </svg>
                      <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                      <span class="sr-only">items in cart, view bag</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </header>
    </div>

    <main class="mt-10 max-w-[986px] mx-auto">
      {{ $slot }}
    </main>

</body>
</html>