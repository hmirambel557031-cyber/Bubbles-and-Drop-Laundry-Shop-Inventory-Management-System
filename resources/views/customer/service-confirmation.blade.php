<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Service Confirmed - Bubble & Drop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-sky-100 flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8 text-center">

        <div class="mb-6">

            <div class="mx-auto w-20 h-20 rounded-full bg-green-100
                        flex items-center justify-center">

                <span class="text-4xl">✓</span>

            </div>

            <h1 class="text-3xl font-bold text-blue-800 mt-5">
                Service Confirmed
            </h1>

            <p class="text-gray-600 mt-2">
                Your laundry service has been successfully recorded.
            </p>

        </div>


        <div class="space-y-4 text-left">

            <div class="bg-gray-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Customer ID
                </p>

                <p class="text-lg font-semibold">
                    {{ $customer->customer_code }}
                </p>

            </div>


            <div class="bg-gray-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Customer Name
                </p>

                <p class="text-lg font-semibold">
                    {{ $customer->full_name }}
                </p>

            </div>


            <div class="bg-blue-50 rounded-lg p-5 text-center">

                <p class="text-sm text-blue-600 font-semibold">
                    SERVICE NUMBER
                </p>

                <p class="text-3xl font-bold text-blue-800 mt-2">
                    {{ $order->service_number }}
                </p>

            </div>


            <div class="bg-gray-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Service
                </p>

                <p class="text-lg font-semibold">
                    {{ $order->service->service_name }}
                </p>

            </div>


            <div class="bg-yellow-50 rounded-lg p-4 text-center">

                <p class="text-sm text-yellow-700 font-semibold">
                    STATUS
                </p>

                <p class="text-xl font-bold text-yellow-800 mt-1">
                    {{ $order->status }}
                </p>

            </div>

        </div>


        <p class="mt-6 text-sm text-gray-500">
            Please keep your Customer ID and Service Number
            for checking your laundry status later.
        </p>


        <a
            href="{{ route('customer.landing') }}"
            class="block mt-6 bg-blue-700 text-white
                   font-semibold py-3 rounded-lg
                   hover:bg-blue-800 transition"
        >
            Back to Home
        </a>

    </div>

</body>
</html>