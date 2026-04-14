<?php
$files = [
    'resources/views/admin/discounts/edit.blade.php',
    'resources/views/admin/products/edit.blade.php',
    'resources/views/admin/shipping-methods/create.blade.php',
    'resources/views/admin/shipping-methods/edit.blade.php',
    'resources/views/admin/variants/create.blade.php',
    'resources/views/admin/variants/edit.blade.php',
];

foreach ($files as $f) {
    if (!file_exists($f)) continue;
    $c = file_get_contents($f);
    
    // Find all conflict blocks
    $c = preg_replace_callback('/<<<<<<< HEAD\s*<input type="text" name="([^"]+)"(?: value="\{\{ number_format\(([^)]+)\) \}\}")? class="currency-input w-full rounded-lg border-gray-300 p-3" required(?: value="\{\{ number_format\(([^)]+)\) \}\}")?>\s*=======\s*<input type="number" name="\1" value="\{\{ old\(\'\1\', ([^}]+)\) \}\}" class="w-full rounded-lg border-gray-300 p-3"(?: min="0")?>\s*@error\(\'\1\'\) <span class="text-error text-sm">\{\{ \$message \}\} <\/span> @enderror\s*>>>>>>> [a-z0-9]+/s', function($m) {
        $name = $m[1];
        $val1 = trim($m[2] ? $m[2] : ($m[3] ? $m[3] : ''));
        $old_fallback = trim($m[4]);
        
        // Ensure we combine them correctly
        return "                    <input type=\"text\" name=\"$name\" value=\"{{ old('$name', $old_fallback) ? number_format((float)str_replace(',', '', old('$name', $old_fallback))) : '0' }}\" class=\"currency-input w-full rounded-lg border-gray-300 p-3\" required>\n                    @error('$name') <span class=\"text-error text-sm\">{{ \$message }}</span> @enderror";
    }, $c);

    // Some inputs don't have required attribute in HEAD or they might have it structured differently. Let's do a more robust approach:
    // Just find any conflict block that involves currency-input
    $c = preg_replace_callback('/<<<<<<< HEAD\s*(<input type="text" name="([^"]+)".*?class="currency-input.*?>)\s*=======\s*<input type="number" name="\2" value="\{\{ old\(\'\2\', ([^}]+)\) \}\}".*?>\s*(@error\(\'\2\'\).*?@enderror)\s*>>>>>>> [a-z0-9]+/is', function($m) {
        $name = $m[2];
        $old_fallback = trim($m[3]);
        $error_tag = trim($m[4]);
        
        return "                    <input type=\"text\" name=\"$name\" value=\"{{ old('$name', $old_fallback) != '' ? number_format((float)str_replace(',', '', old('$name', $old_fallback))) : '' }}\" class=\"currency-input w-full rounded-lg border-gray-300 p-3\" required>\n                    $error_tag";
    }, $c);

    file_put_contents($f, $c);
}
