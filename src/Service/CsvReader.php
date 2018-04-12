<?php
namespace Service;

class CsvReader
{
    protected $content;
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->content = [];
    }

    public function getContent()
    {
        if (!$this->content) {
            $this->loadContent();
        }

        return $this->content;
    }

    protected function loadContent()
    {
        $totalFilepath = __DIR__ . "/../../" . $this->filePath;
        $file = fopen($totalFilepath, "r+");
        $this->content = [];

        while ($data = fgetcsv($file, 9999, ",")) {
            $this->content[] = $data;
        }

        fclose($file);
    }
}
?>
