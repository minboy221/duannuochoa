<?php
$files = [
    'resources/views/admin/discounts/create.blade.php',
    'resources/views/admin/discounts/edit.blade.php',
    'resources/views/admin/products/create.blade.php',
    'resources/views/admin/products/edit.blade.php',
    'resources/views/admin/shipping-methods/create.blade.php',
    'resources/views/admin/shipping-methods/edit.blade.php',
    'resources/views/admin/variants/create.blade.php',
    'resources/views/admin/variants/edit.blade.php',
    'app/Http/Controllers/Admin/UserController.php',
    'app/Models/User.php'
];

// Provide manual string replacements for each file since the conflict blocks are unique.
$replacements = [
    'app/Models/User.php' => [
        "<<<<<<< HEAD\n\n=======\n    protected \$primaryKey = 'user_id';\n    public \$timestamps = false;\n\n    /**\n     * Indicates if the model should be timestamped.\n     *\n     * @var bool\n     */\n>>>>>>> 65df3eff8eb5bb74e750152bc9f319fa8f64f1ba" => "    protected \$primaryKey = 'user_id';\n    public \$timestamps = false;"
    ],
    'app/Http/Controllers/Admin/UserController.php' => [
        "<<<<<<< HEAD\n    public function toggleStatus(User \$user)\n    {\n        if (\$user->role_id == 1) {\n             return redirect()->route('admin.users.index')->with('error', 'Không thể thao tác trên tài khoản Admin.');\n        }\n        // Prevent admin from locking themselves out\n        if (auth()->id() == \$user->user_id) {\n             return redirect()->route('admin.users.index')->with('error', 'Không thể khóa tài khoản của chính mình.');\n=======\n    public function update(UserRequest \$request, User \$user)\n    {\n        \$data = \$request->validated();\n        if (\$request->filled('password')) {\n            \$data['password'] = Hash::make(\$request->password);\n        } else {\n            unset(\$data['password']);\n>>>>>>> 65df3eff8eb5bb74e750152bc9f319fa8f64f1ba\n        }" => "    public function toggleStatus(User \$user)\n    {\n        if (\$user->role_id == 1) {\n             return redirect()->route('admin.users.index')->with('error', 'Không thể thao tác trên tài khoản Admin.');\n        }\n        if (auth()->id() == \$user->user_id) {\n             return redirect()->route('admin.users.index')->with('error', 'Không thể khóa tài khoản của chính mình.');\n        }"
    ],
    'resources/views/admin/products/create.blade.php' => [
        "<<<<<<< HEAD\n                <input type=\"text\" name=\"base_price\" class=\"currency-input w-full rounded-lg border-gray-300 p-3\" required value=\"0\">\n=======\n                <input type=\"number\" name=\"base_price\" class=\"w-full rounded-lg border-gray-300 p-3\" min=\"0\" value=\"{{ old('base_price', 0) }}\">\n                @error('base_price') <span class=\"text-error text-sm\">{{ \$message }}</span> @enderror\n>>>>>>> 65df3eff8eb5bb74e750152bc9f319fa8f64f1ba" => "                <input type=\"text\" name=\"base_price\" class=\"currency-input w-full rounded-lg border-gray-300 p-3\" required min=\"0\" value=\"{{ old('base_price') ? number_format((float)str_replace(',', '', old('base_price'))) : '0' }}\">\n                @error('base_price') <span class=\"text-error text-sm\">{{ \$message }}</span> @enderror"
    ],
    'resources/views/admin/discounts/create.blade.php' => [
        '<input type="number" name="discount_value" class="w-full rounded-lg border-gray-300 p-3" required min="0">' => '<input type="text" name="discount_value" value="{{ old(\'discount_value\') ? number_format((float)str_replace(\',\', \'\', old(\'discount_value\'))) : \'\' }}" class="currency-input w-full rounded-lg border-gray-300 p-3" required min="0">' . "\n                    @error('discount_value') <span class=\"text-error text-sm\">{{ \$message }}</span> @enderror",
        '<input type="number" name="min_order_value" class="w-full rounded-lg border-gray-300 p-3" value="0">' => '<input type="text" name="min_order_value" value="{{ old(\'min_order_value\') ? number_format((float)str_replace(\',\', \'\', old(\'min_order_value\'))) : \'0\' }}" class="currency-input w-full rounded-lg border-gray-300 p-3" required min="0">' . "\n                @error('min_order_value') <span class=\"text-error text-sm\">{{ \$message }}</span> @enderror"
    ]
];

foreach ($files as $f) {
    if (!file_exists($f)) continue;
    $c = file_get_contents($f);
    
    // For general blade inputs
    if (strpos($f, '.blade.php') !== false && !isset($replacements[$f])) {
        // generic conflict solver for texts
        $c = preg_replace_callback('/<<<<<<< HEAD\n\s*<input type="text" name="(\w+)"\s*(?:value="[^"]*"\s*)?class="currency-input w-full rounded-lg border-gray-300 p-3"[^>]*>\n=======\n\s*<input type="number" name="\1".*?value="\{\{ old\(\'\1\'.*?\)\b.*?>\n\s*@error\(\'\1\'\) <span class="text-error text-sm">\{\{ \$message \}\} <\/span> @enderror\n>>>>>>> [a-z0-9]+/is', function($m) {
            $name = $m[1];
            $default = "''";
            if (strpos($m[0], 'value="0"') !== false || strpos($m[0], ", 0)") !== false) $default = "'0'";
            return "                <input type=\"text\" name=\"$name\" class=\"currency-input w-full rounded-lg border-gray-300 p-3\" required min=\"0\" value=\"{{ old('$name', isset(\$$name) ? \$$name : null) ? number_format((float)str_replace(',', '', old('$name', isset(\$$name) ? \$$name : $default))) : $default }}\">\n                @error('$name') <span class=\"text-error text-sm\">{{ \$message }}</span> @enderror";
        }, $c);
    }

    if (isset($replacements[$f])) {
        foreach($replacements[$f] as $find => $replace) {
            $c = str_replace($find, $replace, $c);
        }
    }
    file_put_contents($f, $c);
}
