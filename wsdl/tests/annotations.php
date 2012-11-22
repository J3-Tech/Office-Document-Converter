<?
chdir("..");
include "common.php";

class DefaultController {
	const TYPE_PLAIN = 1;
	const TYPE_HTML = 2;
	public $type;
	public $length;
}
/**
 * @ann1('me'=>'you');
 */
class something{
	/**
	 * @var string
	 * @Controller(type => DefaultController::TYPE_PLAIN, length => 100)
	 */
	public $propertyA;
	
	/**
	 * @var string
	 * @Controller(type => DefaultController::TYPE_HTML, length => 100)
	 */
	public function methodB () {
		return "aap";
	}
}

/* Annotation example */
$rel = new IPReflectionClass("something");
$properties = $rel->getProperties();
$methods = $rel->getMethods();

var_dump($rel->getAnnotation("ann1", "stdClass"));

$property = $properties["propertyA"];
$ann = $property->getAnnotation("Controller", "DefaultController");
var_dump($ann);

$method = $methods["methodB"];
$ann = $method->getAnnotation("Controller", "DefaultController");
var_dump($ann);
?>