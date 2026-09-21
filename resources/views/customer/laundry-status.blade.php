<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laundry Status - Bubble & Drop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-sky-100 flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">

        <div class="text-center mb-8">

            <h1 class="text-3xl font-bold text-blue-800">
                Laundry Status
            </h1>

            <p class="mt-2 text-gray-600">
                Here is the current information for your laundry.
            </p>

        </div>


        <div class="space-y-4">

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">
                    Customer
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->full_name }}
                </p>
            </div>


            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">
                    Customer ID
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $customer->customer_code }}
                </p>
            </div>


            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">
                    Service Number
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $order->service_number }}
                </p>
            </div>


            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">
                    Service
                </p>

                <p class="text-lg font-semibold text-gray-800">
                    {{ $order->service->service_name }}
                </p>
            </div>


            <div class="rounded-xl bg-blue-50 p-6 text-center">

                <p class="text-sm text-blue-600 font-semibold uppercase">
                    Current Status
                </p>

                <p class="text-3xl font-bold text-blue-800 mt-2">
                    {{ $order->status }}
                </p>

            </div>

        </div>


        <a
            href="{{ route('customer.check-laundry') }}"
            class="block text-center mt-8 text-blue-700
                   font-semibold hover:underline"
        >
            Check Another Laundry
        </a>

    </div>

</body>
</html>