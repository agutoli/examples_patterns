<?php



/**
 * The Client depends only on this abstraction, whatever graph is built using
 * the specializations.
 * @author: Giorgio Sironi
 * @link: http://www.giorgiosironi.com/2010/01/practical-php-patterns-composite.html
 * 
 * *** This example was modified by me, your original code can be seen on the link below
 * 
 */
interface HtmlElements
{
    /**
     * @return string   representation
     */
    public function __toString();
    public function addChild(HtmlElements $element);
}

abstract class AbstractHtmlElements implements HtmlElements {
    
    protected $_children = array();
    protected $_attrs    = array();
 
    public function addChild(HtmlElements $element) {
        $this->_children[] = $element;
    }

    public function addAttr(HtmlAttributes $attr) {
        $this->_attrs[] = $attr;
    }

    public function addAttrs(array $attrs) {
        foreach($attrs as $attr) {
            if ($attr instanceof HtmlAttributes) {
                $this->_attrs[] = $attr;
            }
        }
    }
}

/**
 * Implementation by Bruno Agutoli
 */
interface HtmlAttributes
{
    public function __construct($name, $value);
    public function getName();
    public function getValue();
}

/**
 * Implementation by Bruno Agutoli
 */
class Attribute implements HtmlAttributes {
   
    private $_value = 'undefined';
    private $_name  = 'undefined'; 
 
    public function __construct ($name, $value) {
        $this->_name  = $name;
        $this->_value = $value;
    }

    public function getName() {
       return $this->_name;
    }
 
    public function getValue() {
       return $this->_value; 
    }
}

/**
 * Leaf sample implementation.
 * Represents an <h1> element.
 */
class H1 extends AbstractHtmlElements
{
    private $_text;

    public function __construct($text)
    {
        $this->_text = $text;
    }

    public function __toString()
    {
        return "<h1>{$this->_text}</h1>";
    }
}

/**
 * Leaf sample implementation.
 * Represents a <p> element.
 */
class P extends AbstractHtmlElements 
{
    private $_text;

    public function __construct($text)
    {
        $this->_text = $text;
    }

    public function __toString()
    {
        return "<p>{$this->_text}</p>";
    }
}

/**
 * A Composite implementation, which accepts as children generic Components.
 * These children may be H1, P or even other Divs.
 */
class Div extends AbstractHtmlElements
{
    public function __toString()
    {

        $html = "<div";
        foreach ($this->_attrs as $child) {
               $html .= ' ' . $child->getName(). "=\"{$child->getValue()}\""; 
        }
        $html .= ">\n";
        foreach ($this->_children as $child) {
            $childRepresentation = (string) $child;
            $childRepresentation = str_replace("\n", "\n    ", $childRepresentation);
            $html .= '    ' . $childRepresentation . "\n";
        }
        $html .= "</div>";
        return $html;
    }
}


// Client code
$div = new Div();
$div->addAttr(new Attribute('style', 'color:red;'));
$div->addAttr(new Attribute('id', 'test'));

$div->addChild(new H1('Title'));
$div->addChild(new P('Lorem ipsum...'));

$sub = new Div();
$sub->addAttrs(array(
    new Attribute('id', 'test-2'),
    new Attribute('style', 'color:green;')
));

$sub->addChild(new P('Dolor sit amet...'));
$div->addChild($sub);
echo $div, "\n";
