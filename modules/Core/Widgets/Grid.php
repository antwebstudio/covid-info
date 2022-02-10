<?php
namespace Ant\Core\Widgets;

class Grid {
    protected $cssClass;
    protected $containerCss;
    protected $options;

    protected $currentIndex = 0;
    protected $rowIndex = 0;

    protected $rows = [];
    protected $rowHeaders = [];
    protected $rowHeaderIndex;
    protected $tagStack;
    
    public $models;

    public static function make($models, $cssClass = '', $containerCss = '', $options = []) {
        return new self($models, $cssClass, $containerCss, $options);
    }

    public function __construct($models, $cssClass, $containerCss, $options) {
        $this->models = $models;
        $this->cssClass = $cssClass;
        $this->containerCss = $containerCss;
        $this->options = $options;
        $this->tagStack = collect();
    }

    public function beginColumn($tag = 'td', $header = null) {
        $this->tagStack->push($tag);
        ob_start();

        if (isset($header) && $this->currentIndex == 0) {
            $this->beginColumn('th');
            echo $header;
            $this->endColumn();
        }

        echo '<'.$tag.' class="'.($this->options['columnCss'] ?? 'compare-col').'">';
    }

    public function endColumn() {
        $tag = $this->tagStack->pop();
        echo '</'.$tag.'>';
        $this->rows[$this->rowIndex][$this->currentIndex]['content'] = ob_get_contents();
        ob_end_clean();
        $this->currentIndex++;
    }

    public function beginRow($header = null) {
    }

    public function endRow() {
        $this->rowIndex++;
        $this->currentIndex = 0;
    }

    public function beginRowHeader() {
        ob_start();
        echo '<th>';
    }

    public function endRowHeader() {
        echo '</th>';
        $this->rowHeaders[$this->rowHeaderIndex] = ob_get_contents();
        ob_end_clean();
        $this->rowHeaderIndex++;
    }

    public function render() {
        $html = '<table class="'.$this->cssClass.'">';
         foreach($this->rows as $key => $row) {
            $html .= '<tr>';

            foreach ($this->rowHeaders as $header) {
                $html .= $header;
            }

            foreach ($row as $column) {
                $html .= $column['content'];
            }
            $html .= '</tr>';
        }
        $html .= '</table>';

        // foreach($this->tabs as $key => $tab) {
        //     $html .= '<div id="'.$tab['id'].'" class="'.$this->containerCss.'">';
        //     $html .= $tab['content'] ?? '';
        //     $html .= '</div>';
        // }
        return $html;
    }
}