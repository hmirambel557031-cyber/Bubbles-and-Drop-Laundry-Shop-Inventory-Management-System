<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Avail Service - Bubble & Drop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-sky-100 flex items-center justify-center p-6">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8">

        <div class="text-center mb-8">

            <h1 class="text-3xl font-bold text-blue-800">
                Avail Service
            </h1>

            <p class="mt-2 text-gray-600">
                Choose the laundry service you want to avail.
            </p>

        </div>


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
            action="{{ route('customer.create-order') }}"
            method="POST"
        >

            @csrf


            {{-- Service Selection --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                @foreach ($services as $service)

                    <label class="cursor-pointer">

                        <input
                            type="radio"
                            name="service_id"
                            value="{{ $service->id }}"
                            class="peer hidden"
                            required
                        >

                        <div class="border-2 border-gray-300 rounded-2xl p-6
                                    peer-checked:border-blue-600
                                    peer-checked:bg-blue-50
                                    transition">

                            <h2 class="text-xl font-bold text-blue-800">
                                {{ $service->service_name }}
                            </h2>

                            <p class="text-2xl font-bold mt-3">
                                ₱{{ number_format($service->price, 2) }}
                            </p>

                            <p class="text-sm text-gray-600 mt-2">
                                {{ $service->description }}
                            </p>

                        </div>

                    </label>

                @endforeach

            </div>


            {{-- Customer Information --}}
            <div class="space-y-5">

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
                        placeholder="Enter your full name"
                        required
                        class="w-full rounded-lg border border-gray-300
                               px-4 py-3"
                    >

                </div>


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
                        placeholder="Enter contact number"
                        class="w-full rounded-lg border border-gray-300
                               px-4 py-3"
                    >

                </div>

            </div>


            <button
                type="submit"
                class="w-full mt-8 bg-blue-700 text-white
                       font-semibold py-3 rounded-lg
                       hover:bg-blue-800 transition"
            >
                Confirm Service
            </button>


            <a
                href="{{ route('customer.landing') }}"
                class="block text-center mt-4 text-gray-600
                       hover:text-blue-700"
            >
                Back to Home
            </a>

        </form>

    </div>

</body>
</html>