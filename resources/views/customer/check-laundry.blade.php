<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Check My Laundry - Bubble & Drop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-sky-100 flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">

        <div class="text-center mb-8">

            <h1 class="text-3xl font-bold text-blue-800">
                Check My Laundry
            </h1>

            <p class="mt-2 text-gray-600">
                Enter your customer information to check your laundry status.
            </p>

        </div>


        {{-- Error message --}}
        @if (session('error'))

            <div class="mb-6 rounded-lg bg-red-100 border border-red-300
                        text-red-700 px-4 py-3">

                {{ session('error') }}

            </div>

        @endif


        {{-- Validation errors --}}
        @if ($errors->any())

            <div class="mb-6 rounded-lg bg-red-100 border border-red-300
                        text-red-700 px-4 py-3">

                <ul class="list-disc list-inside">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('customer.search-laundry') }}"
            method="POST"
            class="space-y-5"
        >

            @csrf


            {{-- Customer ID --}}
            <div>

                <label
                    for="customer_code"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Customer ID
                </label>

                <input
                    type="text"
                    id="customer_code"
                    name="customer_code"
                    value="{{ old('customer_code') }}"
                    placeholder="Example: 101"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                           focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Full Name --}}
            <div>

                <label
                    for="full_name"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Full Name
                </label>

                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="{{ old('full_name') }}"
                    placeholder="Example: Maria Santos"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                           focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Optional contact --}}
            <div>

                <label
                    for="contact_number"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Contact Number
                    <span class="font-normal text-gray-500">
                        (Optional)
                    </span>
                </label>

                <input
                    type="text"
                    id="contact_number"
                    name="contact_number"
                    value="{{ old('contact_number') }}"
                    placeholder="Example: 09171234567"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                           focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            <button
                type="submit"
                class="w-full bg-blue-700 text-white font-semibold
                       py-3 rounded-lg hover:bg-blue-800 transition"
            >
                Search Laundry
            </button>


            <a
                href="{{ route('customer.landing') }}"
                class="block text-center text-gray-600 hover:text-blue-700"
            >
                Back to Home
            </a>

        </form>

    </div>

</body>
</html>