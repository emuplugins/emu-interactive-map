<?php 

class Widget {
    private $content;
    private $type;
    private $options;
    private $link;
    private $x;
    private $y;
    private $weight;
    private $color;
    private $customClass;

    public function __construct($content, $type, $options, $link, $x, $y, $weight, $color, $customClass = null) {
        $this->content = $content;
        $this->type = $type;
        $this->options = $options;
        $this->link = $link;
        $this->x = $x;
        $this->y = $y;
        $this->weight = $weight;
        $this->color = $color;
        $this->customClass = $customClass;
    }
    
    public function render() {
        $output = $this->link ? sprintf('<a xlink:href="%s">', $this->link) : '';
        $customClass = $this->customClass ? ' ' . $this->customClass : '';
    
        if ($this->type === 'text') {
            $fontSize = $this->options['fontSize'] ?? '12';
            $output .= sprintf(
                '<text x="%d" y="%d" class="state-label%s" style="font-size: %spx; font-weight: %d; fill: %s">%s</text>', 
                $this->x, $this->y, $customClass, $fontSize, $this->weight, $this->color, $this->content
            );
        } elseif ($this->type === 'image') {
            $width = $this->options['width'] ?? '30';
            $height = $this->options['height'] ?? '30';
            $output .= sprintf(
                '<image x="%d" y="%d" width="%s" height="%s" href="%s"%s />', 
                $this->x, $this->y, $width, $height, $this->content, $customClass ? sprintf(' class="%s"', trim($customClass)) : ''
            );
        } else {
            $output .= sprintf(
                '<g transform="translate(%d, %d)"%s>%s</g>', 
                $this->x, $this->y, $customClass ? sprintf(' class="%s"', trim($customClass)) : '', $this->content
            );
        }
    
        return $this->link ? $output . '</a>' : $output;
    }

    public function get_custom_class() {
        return $this->customClass;
    }

    public function set_custom_class($customClass) {
        $this->customClass = $customClass;
    }
}
