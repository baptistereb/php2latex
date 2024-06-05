<?php

class LatexCompiler {
    private $templateFile;
    private $beginId;
    private $endId;
    private $path_output;

    public $latexContent;
    public $return;

    private function setID($beginId, $endId) {
        $this->beginId = $beginId;
        $this->endId = $endId;
    }

    public function __construct($templateFile, $output) {
        $this->templateFile = $templateFile;
        $this->latexContent = file_get_contents($templateFile);
        $this->setID("%begin-content","%end-content");
        $this->path_output = $output;
    }

    public function addContent($content) {
        $startPos = strpos($this->latexContent, $this->beginId);
        $endPos = strpos($this->latexContent, $this->endId);
        
        if ($startPos === false || $endPos === false) {
            $this->latexContent .= $content;
        } else {
            $this->latexContent = substr_replace($this->latexContent, $content, $endPos, 0);
        }
    }

    public function compileToPDF() : bool
    {
        $tempLatexFile = "./temp.tex";
        file_put_contents($tempLatexFile, $this->latexContent);

        $command = "/usr/bin/pdflatex -interaction=nonstopmode ".escapeshellarg($tempLatexFile);

        try {
            $this->return = shell_exec($command);
            shell_exec("rm temp.aux; rm temp.log; rm temp.tex");
            shell_exec("mv temp.pdf ".escapeshellarg($this->path_output."/".uniqid().".pdf"));
            return true;
        } catch (Exception $e) {
            $this->return = 'Exception reçue : '.$e->getMessage();
            return false;
        }
    }
}
?>
