<?php

namespace App;

trait OfficeProcessor {
    //
    /**
     * Mengambil variabel template dari file Word.
     *
     * Fungsi ini membaca file template Word yang diberikan dan mengekstrak semua variabel
     * yang ada di dalamnya. Variabel diidentifikasi dengan pola '${...}' dan disimpan dalam
     * array yang dikembalikan oleh fungsi ini.
     *
     * @param string $lokasiTemplate Lokasi file template Word yang akan dibaca.
     * @return array Daftar variabel yang ditemukan dalam template.
     */
    public function ambilVariabelTemplate($lokasiTemplate): array {
        $dataVar = [];
        // read template file
        $reader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        $phpWord = $reader->load(storage_path('app/public/' . $lokasiTemplate));
        $section = $phpWord->getSections();
        foreach ($section as $s) {
            $elements = $s->getElements();
            // dd($elements);
            foreach ($elements as $element) {
                // echo "TextRun: " . (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun' ? 'true' : 'false') . "<br>";
                if (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun') {
                    $textRun = $element->getElements();
                    foreach ($textRun as $text) {
                        // echo "Text :" . $text->getText() . "<br>";
                        if (strpos($text->getText(), '${') !== false) {
                            // echo "Text: " . ($text->getText()) . "<br>";
                            $dataVar[] = preg_replace('/[^A-Za-z0-9\-]/', '', $text->getText());
                        }
                    }
                }
                if (get_class($element) == 'PhpOffice\PhpWord\Element\ListItemRun') {
                    $listItemRun = $element->getElements();
                    foreach ($listItemRun as $text) {
                        // echo "Text :" . $text->getText() . "<br>";
                        if (strpos($text->getText(), '${') !== false) {
                            // echo "Text: " . ($text->getText()) . "<br>";
                            $dataVar[] = preg_replace('/[^A-Za-z0-9\-]/', '', $text->getText());
                        }
                    }
                }
            }
        }
        return $dataVar;
    }

    public function ambilVariabelTemplateDalamTable($lokasiFile) {
        // Open the Docx file
        $dataVar = [];
        $reader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        $phpWord = $reader->load(storage_path('app/public/' . $lokasiFile));

        $section = $phpWord->getSections();
        // dd($section);
        foreach ($section as $s) {
            $elements = $s->getElements();
            // dd($elements);
            foreach ($elements as $element) {
                // echo "TextRun: " . (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun' ? 'true' : 'false') . "<br>";
                // get table
                if (get_class($element) == 'PhpOffice\PhpWord\Element\Table') {
                    $table = $element->getRows();
                    foreach ($table as $row) {
                        // dd($row);
                        $cell = $row->getCells();
                        foreach ($cell as $item) {
                            // dd($item);
                            $element = $item->getElements();
                            foreach ($element as $el) {
                                // dd($el);
                                if (get_class($el) == 'PhpOffice\PhpWord\Element\TextRun') {
                                    // dd($element);
                                    // echo "Text :" . $text->getText() . "<br>";
                                    if (strpos($el->getText(), '${') !== false) {
                                        echo "Text: " . preg_replace('/[^A-Za-z0-9\-]/', '', $el->getText()) . "<br>";
                                        $dataVar[] = preg_replace('/[^A-Za-z0-9\-]/', '', $el->getText());
                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
        return $dataVar;
    }
}