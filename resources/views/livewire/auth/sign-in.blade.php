<div class="flex w-full flex-1 flex-col lg:w-1/2">
    <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
        <div>
            <div class="mb-5 sm:mb-8">
                <h1 class="text-title-sm sm:text-title-md mb-2 font-semibold text-gray-800 dark:text-white/90">
                    Sign In
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Enter your email and password to sign in!
                </p>
            </div>
            <div>
                <form wire:submit="authenticate">
                    <div class="space-y-5">

                        <!-- Email -->
                        <x-forms.input 
                            label="Username / Email"
                            placeholder="Enter your username or email"
                            required
                            name="credential"
                            errorTarget="credential" />

                        <!-- Password -->
                        <x-forms.input 
                            elementType="input-password"
                            label="Password"
                            placeholder="Enter your password"
                            required
                            name="password"
                            errorTarget="password" />

                        <!-- Checkbox -->
                        <x-forms.input 
                            elementType="checkbox-toggle"
                            label="Keep me logged in"
                            wire:model="remember" />

                        <!-- Button -->
                        <div>
                            <x-ui.button
                                type="submit"
                                wire:click="authenticate"
                                wire:target="authenticate"
                                class="w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Sign In
                            </x-ui.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
