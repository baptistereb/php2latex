# LaTeX Compiler

This project is a simple PHP-based LaTeX compiler. It reads a LaTeX template file, allows the addition of content, and compiles the resulting LaTeX code into a PDF.

## Usage - example

##### Structure :

php2latex/  
├── output/             # Directory where PDFs will be saved  
├── template.tex        # Your LaTeX template file  
├── php2latex.php       # The PHP class file  
└── index.php           # Example usage file  

##### Code :

```php
require 'php2latex.php';

// Create an instance of the compiler
$compiler = new LatexCompiler("./template.tex", "./output");

// Add content to the LaTeX document (LaTeX code in string format)
$compiler->addContent("First line");
$compiler->addContent("\section{first section}");
$compiler->addContent("content");

// Compile the document to PDF
$pdfFile = $compiler->compileToPDF();
```

## Installation
Ensure PHP is installed on your system.
Ensure LaTeX is installed on your system (pdflatex command should be available).
Then :
```git
git clone https://github.com/yourusername/latex-compiler.git
```

## Troubleshooting

##### Permissions:

Verify that the function compileToPDF has the necessary permissions to execute. This is particularly crucial when running under Apache, as the web server must have the appropriate permissions to run external commands.

> Ensure that Apache has write permissions to the current directory and the output directory. Without these permissions, the script will not be able to create temporary files or move the generated PDF.