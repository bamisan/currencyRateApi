<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class CurrencyExchangeController extends Controller
{
    public function getWeeklyExchangeRates($selectedDate, $currency = 'USD')
    {
        $carbonDate = Carbon::parse($selectedDate);
        $currency = $currency;

        // dummy data for the last 7 days
        $dummyRates = [
            $carbonDate->copy()->subDays(1)->toDateString() => rand(100, 400),
            $carbonDate->copy()->subDays(2)->toDateString() => rand(100, 400),
            $carbonDate->copy()->subDays(3)->toDateString() => rand(100, 400),
            $carbonDate->copy()->subDays(4)->toDateString() => rand(100, 400),
            $carbonDate->copy()->subDays(5)->toDateString() => rand(100, 400),
            $carbonDate->copy()->subDays(6)->toDateString() => rand(100, 400),
            $carbonDate->copy()->subDays(7)->toDateString() => rand(100, 400)
        ];

        $averageRate = collect($dummyRates)->avg();

        $rates = collect($dummyRates)->map(function ($rate, $date) use ($currency) {
            return [
                'date' => $date,
                'rate' => $currency . ' ' . number_format($rate, 4),
            ];
        });

        return response()->json([
            'rates' => $rates,
            'current_rate' => number_format($averageRate, 4),
            'average_rate' => number_format($averageRate, 4),
            
        ]);
    }

    public function store(Request $request)
    {
        // Store the exchange rate data in the database
        $exchangeRate = \App\Models\ExchangeRate::create($request->all());

        return response()->json(['message' => 'Exchange rate stored successfully', 'data' => $exchangeRate], 201);
    }

    public function listAll()
    {
        $exchangeRates = \App\Models\ExchangeRate::all();

        return response()->json(['exchangeRates' => $exchangeRates]);
    }
}
