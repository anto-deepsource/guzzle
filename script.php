<?php

$filename = 'complex_large_file.php';
$lineCount = 10000;

$file = fopen($filename, 'w');

// Start PHP tag
fwrite($file, "<?php\n\n");

// Add a simple class definition to start
fwrite($file, "class ExampleClass {\n\n");

// Method to generate simple methods
function generateMethod($index) {
    $method = "    public function method$index() {\n";
    $method .= "        \$sum = 0;\n";
    $method .= "        for (\$i = 1; \$i <= 100; \$i++) {\n";
    $method .= "            if (\$i % 2 == 0) {\n";
    $method .= "                \$sum += \$i;\n";
    $method .= "            } else {\n";
    $method .= "                \$sum -= \$i;\n";
    $method .= "            }\n";
    $method .= "        }\n";
    $method .= "        return \$sum;\n";
    $method .= "    }\n\n";
    return $method;
}

// Generate lines with methods
for ($i = 1; $i <= ($lineCount / 20); $i++) {
    $method = generateMethod($i);
    fwrite($file, $method);
}

// Close class definition
fwrite($file, "}\n\n");

// Create an instance and call methods
fwrite($file, "\$example = new ExampleClass();\n\n");

for ($i = 1; $i <= ($lineCount / 20); $i++) {
    fwrite($file, "\$result$i = \$example->method$i();\n");
    fwrite($file, "echo \"Result from method$i: \$result$i\\n\";\n");
}

// End PHP tag
fwrite($file, "\n?>");

fclose($file);

echo "Complex PHP file with $lineCount lines has been generated as $filename.\n";
