<?php

namespace App\Http\Controllers\TenantClientAuth;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Stancl\Tenancy\Facades\Tenancy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $domain = request()->getHost();
        $parts = explode('.', $domain);
        $tenantId = $parts[0];
        $tenant = Tenant::findOrFail($tenantId);
        // Tenancy::init($tenant);




// Use the tenant database connection to perform operations within the context of the selected tenant...

        return view('tenants_pages.client_auth.register',['tenantId' => $tenantId]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            //'tenant_id' => 'required|exists:tenants,id',
        ]);


        // $domain = request()->getHost();
        // $parts = explode('.', $domain);
        // $tenantId = $parts[0];
        // $tenant = Tenant::findOrFail($tenantId);
        //    Tenancy::init($tenant);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::CLIENT);
    }
}
