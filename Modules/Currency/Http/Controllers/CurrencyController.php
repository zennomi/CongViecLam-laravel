<?php

namespace Modules\Currency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Currency\Entities\Currency;
use Modules\Currency\Http\Requests\CurrencyCreateFormRequest;
use Modules\Currency\Http\Requests\CurrencyUpdateFormRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        abort_if(!userCan('setting.view'), 403);

        $currencies = Currency::paginate(15);

        return view('currency::index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('currency::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CurrencyCreateFormRequest $request
     * @return Renderable
     */
    public function store(CurrencyCreateFormRequest $request)
    {
        Currency::create([
            'name' => $request->name,
            'code' => $request->code,
            'symbol' => $request->symbol,
            'symbol_position' => $request->symbol_position ? 'left' : 'right',
        ]);

        flashSuccess('Currency Created Successfully');
        return redirect()->route('module.currency.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('currency::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Currency $currency
     * @return Renderable
     */
    public function edit(Currency $currency)
    {
        return view('currency::edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     * @param CurrencyUpdateFormRequest $request
     * @param Currency $currency
     * @return Renderable
     */
    public function update(CurrencyUpdateFormRequest $request, Currency $currency)
    {
        $currency->update([
            'name' => $request->name,
            'code' => $request->code,
            'symbol' => $request->symbol,
            'symbol_position' => $request->symbol_position == 'left' ? 'left' : 'right',
        ]);

        envReplace('APP_CURRENCY', $currency->code);
        envReplace('APP_CURRENCY_SYMBOL', $currency->symbol);
        envReplace('APP_CURRENCY_SYMBOL_POSITION', $currency->symbol_position);

        flashSuccess('Currency Updated Successfully');
        return redirect()->route('module.currency.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Currency $currency)
    {
        if ($currency->code == config('zakirsoft.currency')) {

            $currencyDefault = Currency::where('code', 'USD')->first();
            if ($currencyDefault) {
                envReplace('APP_CURRENCY', $currencyDefault->code);
                envReplace('APP_CURRENCY_SYMBOL', $currencyDefault->symbol);
                envReplace('APP_CURRENCY_SYMBOL_POSITION', $currencyDefault->symbol_position);
            }
        }

        $currency->delete();

        flashSuccess('Currency Deleted Successfully');
        return back();
    }

    public function defaultCurrency(Request $request)
    {

        $currency = Currency::findOrFail($request->currency);

        envReplace('APP_CURRENCY', $currency->code);
        envReplace('APP_CURRENCY_SYMBOL', $currency->symbol);
        envReplace('APP_CURRENCY_SYMBOL_POSITION', $currency->symbol_position);

        flashSuccess('Currency Changed Successfully');
        return redirect()->back();
    }

    public function example()
    {

        return view('currency::example');
    }
}
