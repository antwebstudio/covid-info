<?php
namespace Ant\Core\Widgets;

class Tab {
    protected $currentIndex = 0;
    protected $tabsCss;
    protected $containerCss;
    protected $template;
    protected $tabs = [];

    public static function make($tabsCss = 'tabs wc-tabs', $containerCss = 'woocommerce-Tabs-panel woocommerce-Tabs-panel--paym-plans panel entry-content wc-tab') {
        return new self($tabsCss, $containerCss);
    }

    public function __construct($tabsCss, $containerCss) {
        $this->tabsCss = $tabsCss;
        $this->containerCss = $containerCss;
    }

    public function tabs() {
        $tabs = [];
        foreach ($this->tabs as $i => $tab) {
            $tab['isActive'] = $i == 0;
            $tab['url'] = '#'.$tab['id'];

            $tabs[] = json_decode(json_encode($tab));
        }
        return $tabs;
    }

    public function beginTab($title = '', $id = null) {
        $this->tabs[$this->currentIndex]['title'] = $title;
        $this->tabs[$this->currentIndex]['id'] = $id ?? 'tab_'.$this->currentIndex;
        
        ob_start();
    }

    public function endTab() {
        $this->tabs[$this->currentIndex]['content'] = ob_get_contents();
        ob_end_clean();
        $this->currentIndex++;
    }

    public function render() {
        $html = '<ul class="'.$this->tabsCss.'" role="tablist">';
        foreach($this->tabs as $key => $tab) {
            $html .= '<li class="description_tab" role="tab"><a href="#'.$tab['id'].'">'.($tab['title'] ?? '').'</a></li>';
        }
        $html .= '</ul>';

        foreach($this->tabs as $key => $tab) {
            $html .= '<div id="'.$tab['id'].'" class="'.$this->containerCss.'">';
            $html .= $tab['content'] ?? '';
            $html .= '</div>';
        }
        return $html;
    }
}